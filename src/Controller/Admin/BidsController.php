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
		//dump($bid);
		if($this->Bids->save($bid)){
			$this->Flash->success(__('入札しました'));
			return $this->redirect(['controller'=>'MyPages','action'=>'index']);
		}
		$this->Flash->error(__('入札に失敗しました'));
		return $this->redirect(['controller'=>'MyPages','action'=>'index']);
	}
	
}