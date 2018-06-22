<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\I18n\Time;

class ProductsController extends AppController
{	
	public function index()
	{
		$now = Time::now();
		$product = $this->Products->query();
		$product->update()
		->set(['sold' => 1])
		->where(['end_date'<= $now])
		->execute(); // 終了した商品をsold=1にします
		
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
	
	public function search()
	{
		$search_word=$this->request->data;
		$key_word=$search_word["search_word"];
		$conditions=array('OR'=>array(
				array('product_name LIKE' 		=> '%'.$key_word.'%'),
				array('Users.user_name LIKE'		=> '%'.$key_word.'%'),
				array('Categories.name LIKE'		=> '%'.$key_word.'%'),
		)
		);
		$products=$this->Products
		->find('all',array('conditions'=>$conditions))
		->contain(['Users','Categories'])
		->all();
		//dump($products);
	
		$this->set(compact('key_word','products'));
	}
	
	public function detail($product_id)
	{
		$product=$this->Products->get($product_id,[
				'contain'=>['Users','Categories','Bids']
		]);
		//dump($product);
		$this->set(compact('product'));
	}
}
