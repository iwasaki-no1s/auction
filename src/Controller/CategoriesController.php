<?php
namespace App\Controller;

use App\Controller\AppController;

class CategoriesController extends AppController
{
	
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
			$categories = $this->Categories->find('list');
			$this->set ( compact ( 'categories','selected_id') );
		}
	}
}