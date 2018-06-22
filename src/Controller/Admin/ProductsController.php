<?php
namespace App\Controller\Admin;

use App\Controller\Admin\AppController;
use Cake\I18n\Time;
use Cake\Datasource\ConnectionManager;

class ProductsController extends AppController
{	
	public function index()
	{
		$user_id=$this->MyAuth->user('id');
		$products = $this->Products->find()
		->contain(['Users','Categories','Bids'])
		->where(['sold'=>0])
		->all();
		$this->set(compact('user_id','products'));
	}
	public function register()
	{
		$user_id = $this->MyAuth->user('id');
		$category = $this->Products->Categories->find('list');
		$product = $this->Products->newEntity();
		if($this->request->is('post')){
			$product->user_id=$user_id;
			$product = $this->Products->patchEntity($product,$this->request->data);
			if($this->Products->save($product)){
				$this->Flash->success(__('出品しました'));
				return $this->redirect(['controller'=>'MyPages','action'=>'index']);
			}
			$this->Flash->error(__('出品に失敗しました'));
		}
		$this->set(compact('product','category'));
	}
	

	public function bid($product_id=null)
	{
		$user_id = $this->MyAuth->user('id');
		$bids = $this->Products->Bids
					->find()
					->where(['product_id'=>$product_id]);
		$current = $bids
					->select(['max_price' => $bids->func()->max('price')])
					->first();
		$bid = $this->Products->Bids
					->newEntity();
		try{
			$product = $this->Products
					->get($product_id);
		}catch(\Exception $e){
			$this->Flash->error(__("存在しない商品です"));
			return $this->redirect(['controller'=>'MyPages','action'=>'index']);
		}
		if($product->user_id == $user_id){
			$this->Flash->error(__('自分で出品した商品です'));
			return $this->redirect(['controller'=>'MyPages','action'=>'index']);
		}
		$now=Time::now();
		if($product->sold == 1 || $product->end_date <= $now){
			$this->changeValueSold($product->id);
			$this->Flash->error(__('終了した商品は入札できません'));
			return $this->redirect(['controller'=>'MyPages','action'=>'index']);
		}
		if(empty($current->max_price)){
			$current->max_price = $product->start_price;
		}
		$this->set(compact('user_id','product','bid','current'));
	}
	
	public function favorite($product_id=null)
	{
		$user_id=$this->MyAuth->user('id');
		$favorite_check=$this->check_f($user_id,$product_id);
		//dump($favorite_check);
		if($favorite_check===0){
			$favorite=$this->Products->Favorites
						->newEntity();
			$favorite->user_id=$user_id;
			$favorite->product_id=$product_id;
			if($this->Products->Favorites->save($favorite)){
				$this->Flash->success(__('お気に入りに登録しました'));
				return $this->redirect(['controller'=>'MyPages','action'=>'index']);
			}
			$this->Flash->error(__('お気に入りの登録に失敗しました'));
			return $this->redirect(['controller'=>'MyPages','action'=>'index']);
		}else{
			$this->Flash->error(__('既にお気に入りに登録されています'));
			return $this->redirect(['controller'=>'MyPages','action'=>'index']);
		}
	}
	
	public function delete($product_id=null)
	{
		$user_id=$this->MyAuth->user('id');
		$check=$this->Products
					->find()
					->contain(['Bids'])
					->where(['id'=>$product_id])
					->first();
		try{
			$product=$this->Products->get($check->id);
		}catch(\Exception $e){
			$this->Flash->error(__('商品が存在しません'));
			return $this->redirect(['controller'=>'MyPages','action'=>'index']);
		}
		if( count($check->bids) >0){
			$this->Flash->error(__('入札者がいます'));
			return $this->redirect(['controller'=>'MyPages','action'=>'index']);
		}
		if($check->user_id==$user_id){
			$this->Products->delete($product);
			$this->Flash->success(__('出品を取り消しました'));
			return $this->redirect(['controller'=>'MyPages','action'=>'index']);
		}
		$this->Flash->error(__('削除権限がありません'));
		return $this->redirect(['controller'=>'MyPages','action'=>'index']);
	}
	
	public function user($user_id)
	{
		$login_user_id=$this->MyAuth->user('id');
		try{
			$user=$this->Products->Users->get($user_id);
		}catch(\Exception $e){
			$this->Flash->error(__('存在しないユーザです'));
			return $this->redirect(['controller'=>'MyPages','action'=>'index']);
		}
		//dump($user);
		$products=$this->Products
						->find()
						->contain(['Users','Categories'])
						->where(['user_id'=>$user_id])
						->all();
		//dump($products);
		$this->set(compact('login_user_id','user','products'));
	}
	
	public function search()
	{
		$search_word=$this->request->data;
		//dump($search_word);
		$key_word=$search_word["search_word"];
		$conditions=array('OR'=>array(
				array('product_name LIKE' 		=> '%'.$key_word.'%'),
				array('Users.user_name LIKE'		=> '%'.$key_word.'%'),
				array('Categories.name LIKE'		=> '%'.$key_word.'%'),
				)
		);
		$products=$this->Products
						->find('all',array('conditions'=>$conditions))
						->contain(['Users','Categories'])
						->all();
		//dump($products);
		
		$this->set(compact('key_word','products'));
	}
	
	public function detail($product_id)
	{
		$user_id=$this->MyAuth->user('id');
		try{
			$product=$this->Products->get($product_id,[
								'contain'=>['Users','Categories','Bids']
			]);
		}catch(\Exception $e){
			$this->Flash->error(__('存在しない商品です'));
			return $this->redirect(['controller'=>'MyPages','action'=>'index']);
		}
		//dump($product);
		$favorite_check=$this->check_f($user_id,$product_id);
		//dump($favorite_check);
		$this->set(compact('user_id','product','favorite_check'));
	}
	
	public function soldout($product_id = null)
	{
		try{
			$this->Products->get($product_id);
		}catch(\Exception $e){
			$this->Flash->error(__('エラーが起きました'));
			return $this->redirect(['controller'=>'MyPages','action'=>'index']);
		}
		$product = $this->Products->find()
			->where(['id'=>$product_id])
			->first();
		$bids = $this->Products->Bids
			->find()
			->where(['product_id'=>$product_id]);
		$current = $bids
			->select(['max_price' => $bids->func()->max('price')])
			->first();
		if($product->max_price<=($current && $product->sold==0)){  //渡された商品が現在データベー上での最高落札価格であり、即決価格を超えかつ売れてなければ落札決定
			$product = $this->Products->query();
			$product->update()
			->set(['sold' => 1])
			->where(['id' => $product_id])
			->execute();
			return $this->redirect(['controller'=>'products','action'=>'detail',$product_id]);
		}
	}
	
	public function edit($product_id){
		$user_id=$this->MyAuth->user('id');
		try{
			$product=$this->Products->get($product_id,[
					'contain'=>['Users','Categories']
			]);
		}catch(\Exception $e){
			$this->Flash->error(__("存在しない商品です"));
			return $this->redirect(['controller'=>'my-pages','action'=>'index']);
		}
		//dump($product);
		$category = $this->Products->Categories->find('list');
		
		if($product->user_id==$user_id){
			if($product->sold==0){
				if($this->request->is(['patch','post','put'])){
					 $product=$this->Products->patchEntity($product,$this->request->data);
					if($this->Products->save($product)){
						$this->Flash->success(__('商品情報を変更しました'));
						return $this->redirect(['action'=>'detail',$product_id]);
					}
					$this->Flash->error(__('商品情報の変更に失敗しました'));
					$this->set(compact(['product','category']));
				}
				$this->set(compact('product','category'));
			}else{
				$this->Flash->error(__("落札された商品です，編集できません"));
				return $this->redirect(['action'=>'detail',$product_id]);
			}
		}else{
			$this->Flash->error(__("編集権限がありません"));
			return $this->redirect(['controller'=>'my-pages','action'=>'index']);
		}
	}
	
	public function changeValueSold($product_id = null)
	{
		$this->Products->get($product_id);
		$product = $this->Products->find()
		->where(['id'=>$product_id])
		->first();
		$bids = $this->Products->Bids
		->find()
		->where(['product_id'=>$product_id]);
		$current = $bids
		->select(['max_price' => $bids->func()->max('price')])
		->first();
		if($product->max_price<=($current && $product->sold==0)){  //渡された商品が現在データベー上での最高落札価格であり、即決価格を超えかつ売れてなければ落札決定
			$product = $this->Products->query();
			$product->update()
			->set(['sold' => 1])
			->where(['id' => $product_id])
			->execute();
		}
	}
	
	//お気に入りが既に登録されているかのcheck
	public function check_f($user_id,$product_id){
		$favorite_check=$this->Products->Favorites
		->find()
		->where(['user_id'=>$user_id])
		->andwhere(['product_id'=>$product_id])
		->count();
		return $favorite_check;
	}
}