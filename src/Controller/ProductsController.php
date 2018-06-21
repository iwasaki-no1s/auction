<?php
namespace App\Controller;

use App\Controller\AppController;

class ProductsController extends AppController
{	
	public function index()
	{
		$products = $this->Products->find()
		->contain(['Users','Categories','Bids'])
		->where(['sold'=>0])
		->all();
		$this->set(compact('products'));
	}
}
