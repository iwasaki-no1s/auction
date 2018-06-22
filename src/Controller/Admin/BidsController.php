<?php
namespace App\Controller\Admin;

use App\Controller\Admin\AppController;
use Cake\ORM\TableRegistry;
use Cake\I18n\Time;

class BidsController extends AppController
{
	public function add($product_id=null)
	{
		$user_id=$this->MyAuth->user('id');
		$bid=$this->Bids->newEntity();
		$bid->user_id=$user_id;
		$bid->product_id=$product_id;
		$bid=$this->Bids->patchEntity($bid,$this->request->data);
		
		$current = $this->Bids
					->find()
					->where(['product_id'=>$bid->product_id]);
		$current_price = $current
					->select(['max_price' => $current->func()->max('price')])
					->first();
		if($bid->price <= $current_price->max_price){     ;//if文の左辺が入力値でデータベースの値(右辺）と比べている
			$this->Flash->error ( __ ( 'その金額では入札できません' ) );
			return $this->redirect ( [
					'controller' => 'products',
					'action' => 'bid',$bid->product_id
			]);
		}
		
		$product = $this->Bids->Products->find()->where(['id'=>$product_id])->first();
		$now = Time::now();
		if($now>=$product->end_date){
			$this->Flash->error(__('すでに終了した商品です'));
			return $this->redirect([
					'controller' => 'products',
					'action' => 'index'
			]);
		}
		if($product->sold==1){
			$this->Flash->error(__('申し訳ございません、入札した商品は現在売り切れです'));
			return $this->redirect([
					'controller'=>'products',
					'action'=>'index'
			]);
		}
		$end_price = $product->end_price;
		$bid_price = $bid->price;
		if($end_price　>=　$bid_price){
			$this->Bids->save($bid);
			$this->Flash->success(__('即決価格です、落札しました'));
			return $this->redirect([
					'controller'=>'products',
					'action'=>'soldout',$bid->product_id
			]);
		}
	
		if($this->Bids->save($bid)){
			$this->Flash->success(__('入札しました'));
			return $this->redirect(['controller'=>'MyPages','action'=>'index']);
		}
		$this->Flash->error(__('入札に失敗しました'));
		return $this->redirect(['controller'=>'MyPages','action'=>'index']);
	}
	
}