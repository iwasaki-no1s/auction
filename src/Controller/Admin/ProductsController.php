<?php
namespace App\Controller\Admin;

use App\Controller\Admin\AppController;

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
		$id = $this->MyAuth->user('id');
		$category = $this->Products->Categories->find('list');
		$product = $this->Products->newEntity();
		if($this->request->is('post')){
			$product = $this->Products->patchEntity($product,$this->request->data);
			if($this->Products->save($product)){
				$this->Flash->success(__('出品しました'));
				return $this->redirect(['controller'=>'MyPages','action'=>'index']);
			}
			$this->Flash->error(__('出品に失敗しました'));
		}
		$this->set(compact('product','id','category'));
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
		
		$product = $this->Products
					->get($product_id);
		if($product->user_id == $user_id){
			$this->Flash->error(__('自分で出品した商品です'));
			return $this->redirect(['controller'=>'MyPages','action'=>'index']);
		}
		if($product->sold == 1){
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
		$favorite=$this->Products->Favorites
					->newEntity();
		$favorite->user_id=$user_id;
		$favorite->product_id=$product_id;
		if($this->Products->Favorites->save($favorite)){
			$this->Flash->success(__('お気に入りに登録しました'));
			return $this->redirect(['controller'=>'Mypages','action'=>'index']);
		}
		$this->Flash->error(__('お気に入りの登録に失敗しました'));
		return $this->redirect(['controller'=>'MyPages','action'=>'index']);
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
		$user=$this->Products->Users->get($user_id);
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
		$product=$this->Products->get($product_id,[
								'contain'=>['Users','Categories','Bids']
		]);
		//dump($product);
		$favorite_check=$this->Products->Favorites
							->find()
							->where(['product_id'=>$product_id])
							->andwhere(['user_id'=>$user_id])
							->count();
		//dump($favorite_check);
		$this->set(compact('user_id','product','favorite_check'));
	}
	
	public function soldout($product_id = null)
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
		dump($current);
		if($product->max_price<=($current && $product->sold==0)){  //渡された商品が現在データベー上での最高落札価格であり、即決価格を超えかつ売れてなければ落札決定
			$product = $this->Products->query();
			$product->update()
			->set(['sold' => 1])
			->where(['id' => $product_id])
			->execute();
			return $this->redirect(['controller'=>'products','action'=>'detail',$product_id]);
		}
	}
}