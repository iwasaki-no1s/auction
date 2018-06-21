<?php
namespace App\Controller\Admin;

use App\Controller\Admin\AppController;
use Cake\ORM\TableRegistry;

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
		if($this->Bids->save($bid)){
			$this->Flash->success(__('入札しました'));
			return $this->redirect(['controller'=>'MyPages','action'=>'index']);
		}
		$this->Flash->error(__('入札に失敗しました'));
		return $this->redirect(['controller'=>'MyPages','action'=>'index']);
	}
	
}