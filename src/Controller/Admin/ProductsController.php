<?php
namespace App\Controller\Admin;

use App\Controller\Admin\AppController;

class ProductsController extends AppController
{	
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
	
	public function favorites($product_id=null)
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
}