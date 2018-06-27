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
		$query = $this->Products->query();
		$query->update()
		->set(['sold' => 1])
		->where(['end_date <=' => $now->format("Y-m-d H:i:s")])
		->execute();
		// 終了した商品をsold=1にします
		
		$user_id=$this->MyAuth->user('id');
		$this->paginate = [
				'contain'=>['Categories','Users','Favorites','Images','Bids'],
		];
		
		$my_exhibits=$this->Products->find()
						->contain(['Categories','Users','Bids','Images'])
						->where(['Products.user_id'=>$user_id])
						/*
						->matching('Images', function($q) {
							return $q->where(['Images.main_image'=>1]);
						})
						*/
						//	->andwhere(['Images.main_image'=>1])
						->select([
										"id","product_name","categories.name","users.user_name","sold","end_date","user_id","category_id",
										"images.image_url","images.main_image"
								])
						->leftJoinWith('Images',function($q){
							return $q->where(['Images.main_image'=>1]);
						})
						->all();
		//dump($my_exhibits);
		
		$my_bids_histories=$this->Products->find()
		->contain(['Categories','Users','Bids','Images'])
		->select([
				"id","product_name","categories.name","users.user_name","sold","end_date",
				"images.image_url","images.main_image","user_id","category_id"
		])
		->leftJoinWith('Images',function($q){
			return $q->where(['Images.main_image'=>1]);
		})
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
		->contain(['Categories','Users','Bids','Favorites','Images'])
		->select([
				"id","product_name","categories.name","users.user_name","sold","end_date",
				"images.image_url","images.main_image","user_id","category_id"
		])
		->leftJoinWith('Images',function($q){
			return $q->where(['Images.main_image'=>1]);
		})
		->innerJoinWith('Favorites', function($q) use ($user_id) {
			return $q->where(['Favorites.user_id'=>$user_id]);
		})
		//->group(['Products.id'])
		->all();
		//dump($my_favorites);
		$this->set(compact('my_exhibits','bids','my_bids_histories','my_favorites'));
	}
}