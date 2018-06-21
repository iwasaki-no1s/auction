<?php
namespace App\Controller\Admin;

use App\Controller\Admin\AppController;

class ProductsController extends AppController
{	
	public function index()
	{
		$products = $this->Products->find()
		->contain(['Users','Categories','Bids'])
		->where(['sold'=>0])
		->all();
		$this->set(compact('products'));
	}
	public function register()
	{
		$id = $this->MyAuth->user('id');
		$category = $this->Products->Categories->find('list');
		$product = $this->Products->newEntity();
		if($this->request->is('post')){
			$product = $this->Products->patchEntity($product,$this->request->data);
			if($this->Products->save($product)){
				$this->Flash->success(__('商品を出品しました'));
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
		//dump($current);
		$product = $this->Products
					->get($product_id);
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
		$user=$this->Products->Users->get($user_id);
		//dump($user);
		$products=$this->Products
						->find()
						->contain(['Users','Categories'])
						->where(['user_id'=>$user_id])
						->all();
		//dump($products);
		$this->set(compact('user','products'));
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
}