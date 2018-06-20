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
		$this->Bids=TableRegistry::get('Bids');
	}
	
	public function index()
	{
		$user_id=$this->MyAuth->user('id');
		$this->paginate = [
				'contain'=>['Categories','Users','Favorites','Images','Bids'],
		];
		
		$my_exhibits=$this->Products->find()
						->contain(['Categories','Users','Bids'])
						->where(['user_id'=>$user_id])
						->all();
		//dump($my_exhibits);
		
		$my_bids_histories=$this->Products->find()
		->contain(['Categories','Users','Bids'])
		->innerJoinWith('Bids', function($q) use ($user_id) {
			return $q->where(['Bids.user_id'=>$user_id]);
			})
		->group(['Products.id'])
		->all();
		//dump($my_bids_histories);
		
						
		// success
		/*
		$my_bids_history=$this->Bids->find()
							->contain(['Products','Products.Users','Products.Bids'])
							->where(['Bids.user_id'=>$user_id])
							->all();
		
		dump($my_bids_history);
		*/
		$this->set(compact('my_exhibits','bids','my_bids_histories'));
	}
}