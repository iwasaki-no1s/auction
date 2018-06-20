<?php
namespace App\Controller\Admin;

use App\Controller\Admin\AppController;

class CategoriesController extends AppController
{
	public function index()
	{
		if ($this->request->is ( [
				'ajax'
		] )) {
			$this->autoRender = FALSE;
			$category_id = $this->request->data ['category_id'];
			//$categories = $this->Categories->find('list');
			$products = $this->Categories->Products->find()
			->contain(['Users'])
			->where(['category_id'=>$category_id])
			->all();
			//$bids= $this->Categories->Products->Bids->find()->all();
			//$this->set ( compact ( 'categories','products','bids' ) );
			echo json_encode($products);
		}else{
			$categories = $this->Categories->find('list');
			$this->set ( compact ( 'categories') );
		}
	}
}