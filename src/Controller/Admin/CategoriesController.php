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
			$categories = $this->Categories->find('list');
			$my_exhibits=$this->Categories->Products->find()
			->contain(['Users'])
			->all();
			$this->set ( compact ( 'categories','my_exhibits' ) );
		}else{
			$categories = $this->Categories->find('list');
			$this->set ( compact ( 'categories') );
		}
	}
}