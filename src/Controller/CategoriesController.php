<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\Datasource\ConnectionManager;
use Cake\ORM\TableRegistry;
use Cake\I18n\Time;

class CategoriesController extends AppController
{
	public function initialize()
	{
		parent::initialize();
		$this->Products = TableRegistry::get('Products');
	}
	
	public function index($selected_id = null)
	{
		if ($this->request->is ( [
				'ajax'
		] )) {
			$this->autoRender = FALSE;
			$category_id = $this->request->data ['category_id'];
				
			$products = $this->Categories->Products->find()
			->contain(['Users','Categories','Bids','Images'])
			->where(['category_id'=>$category_id])
			->all();
			echo json_encode($products);
		}else{
			Time::setJsonEncodeFormat("Y-m-d H:i:s");
			$now = Time::now();
			$query = $this->Products->query();
			$query->update()
			->set(['sold' => 1])
			->where(['end_date <=' => $now->format("Y-m-d H:i:s")])
			->execute();
			// 終了した商品をsold=1にします
			$categories = $this->Categories->find('list');
			$this->set ( compact ( 'categories','selected_id') );
		}
	}
}