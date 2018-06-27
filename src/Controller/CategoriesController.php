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
		
			$products = $this->Categories->Products
			->find()
			->contain(['Users','Categories','Bids','Images'])
			->where(['category_id'=>$category_id])
			->andwhere(['sold'=>0])
			->all();
			echo json_encode($products);
		}else{
			$categories = $this->Categories->find('list');
			$this->set ( compact ( 'categories','selected_id') );
		}
	}
}