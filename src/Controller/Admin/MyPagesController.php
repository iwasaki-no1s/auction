<?php
namespace App\Controller\Admin;

use App\Controller\Admin\AppController;
use Cake\ORM\TableRegistry;
use Cake\I18n\Time;
use Cake\Datasource\ConnectionManager;

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
		
		Time::setJsonEncodeFormat("Y-m-d H:i:s");
		$now = Time::now();
		$conn = ConnectionManager::get('default');
		$sql = "UPDATE products SET sold = 1 Where end_date < '$now'";
		$conn->query($sql)->execute();
		// 終了した商品をsold=1にします
		
		$user_id=$this->MyAuth->user('id');
		$this->paginate = [
				'contain'=>['Categories','Users','Favorites','Images','Bids'],
		];
		
		$my_exhibits=$this->Products->find()
						->contain(['Categories','Users','Bids'])
						->where(['Products.user_id'=>$user_id])
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
		
		$my_favorites=$this->Products->find()
		->contain(['Categories','Users','Bids','Favorites'])
		->innerJoinWith('Favorites', function($q) use ($user_id) {
			return $q->where(['Favorites.user_id'=>$user_id]);
		})
		//->group(['Products.id'])
		->all();
		//dump($my_favorites);
		$this->set(compact('my_exhibits','bids','my_bids_histories','my_favorites'));
	}
}