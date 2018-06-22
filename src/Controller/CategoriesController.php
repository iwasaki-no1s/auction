<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\Datasource\ConnectionManager;
use Cake\ORM\TableRegistry;

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
			->contain(['Users','Categories','Bids'])
			->where(['category_id'=>$category_id])
			->all();
			echo json_encode($products);
		}else{
			$now = date("Y-m-d H:i:s");
			$conn = ConnectionManager::get('default');
			$sql = "UPDATE products SET sold = 1 Where end_date < '$now'";
			$conn->query($sql)->execute();
			// 終了した商品をsold=1にします
			$categories = $this->Categories->find('list');
			$this->set ( compact ( 'categories','selected_id') );
		}
	}
}