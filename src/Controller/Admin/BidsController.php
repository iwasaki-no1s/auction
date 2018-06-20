<?php
namespace App\Controller\Admin;

use App\Controller\Admin\AppController;
use Cake\ORM\TableRegistry;

class BidsController extends AppController
{
	public function add($product_id=null)
	{
		$user_id=$this->MyAuth->user('id');
		
	}
	
}