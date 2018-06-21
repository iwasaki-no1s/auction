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
	
	public function user($user_id)
	{
		$user=$this->Products->Users->get($user_id);
		$products=$this->Products
		->find()
		->contain(['Users','Categories'])
		->where(['user_id'=>$user_id])
		->all();
		$this->set(compact('user','products'));
	}
}
