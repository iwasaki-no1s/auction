<?php
namespace App\Controller\Admin;

use App\Controller\Admin\AppController;

class CategoriesController extends AppController
{
	public function index($category_id = null)
	{
		if ($this->request->is ( [
				'ajax'
		] )) {
			
		}else{
			$categories = $this->Categories->find('list');
			$this->set ( compact ( 'categories' ) );
		}
	}
}