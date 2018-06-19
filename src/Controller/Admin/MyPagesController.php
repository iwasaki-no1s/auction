<?php
namespace App\Controller\Admin;

use App\Controller\Admin\AppController;
use Cake\ORM\TableRegistry;

class MyPagesController extends AppController
{
	public function initialize()
	{
		parent::initialize();
		$this->Products = TableRegistry::get('Products');
	}
	
	public function index()
	{
		$user_id=$this->MyAuth->user('id');
		$this->paginate = [
				'contain'=>['Categories','Users','Favorites','Images','Bids'],
		];
		
		$my_exhibits=$this->Products->find()
						->contain(['Categories','Users'])
						->where(['user_id'=>$user_id])
						->all();
		$bids=$this->Products->Bids->find()->all();
		dump($my_exhibits);
		$this->set(compact('my_exhibits','bids'));
	}
}