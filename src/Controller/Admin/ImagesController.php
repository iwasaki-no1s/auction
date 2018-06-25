<?php
namespace App\Controller\Admin;

use App\Controller\Admin\AppController;
use Cake\ORM\TableRegistry;
use Cake\I18n\Time;
use Cake\Datasource\ConnectionManager;

class ImagesController extends AppController
{
	public function add($product_id=null)
	{
		try{
			$product=$this->Images->Products->get($product_id);
		}catch(\Exception $e){
			$this->Flash->error(__('存在しない商品です'));
			return $this->redirect(['controller'=>'MyPages','action'=>'index']);
		}
	}
}