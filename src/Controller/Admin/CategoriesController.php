<?php
namespace App\Controller\Admin;

use App\Controller\Admin\AppController;
use Cake\ORM\TableRegistry;
use Cake\I18n\Time;
use Cake\Datasource\ConnectionManager;

class CategoriesController extends AppController
{
	public function initialize()
	{
		parent::initialize();
		$this->Products = TableRegistry::get('Products');
		$this->Bids=TableRegistry::get('Bids');
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
			$login_user_id[] = "";
			$login_user_id = $this->MyAuth->user('id');
			echo json_encode(compact('products','login_user_id'));
		}else{
			$categories = $this->Categories->find('list');
			$this->set ( compact ( 'categories','selected_id') );
		}
	}
}