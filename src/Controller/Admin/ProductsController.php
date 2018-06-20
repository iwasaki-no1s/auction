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
	
	//入札(仮)
	public function add($product_id=null)
	{
		$user_id=$this->MyAuth->user('id');
		$product=$this->Products->get($product_id);
		if($this->request->is('post')){
			
		}
		//dump($product);
		$this->set(compact('user_id','product'));
	}
}