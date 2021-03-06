<?php
namespace App\Controller\Admin;

use Cake\Controller\Controller;
use Cake\Event\Event;

class AppController extends Controller
{
	
	public function initialize()
	{
		parent::initialize();
		$this->loadComponent('RequestHandler');
		$this->loadComponent('Flash');
		$this->loadComponent('MyAuth');
	}
	
	public function beforeFilter(Event $event)
	{
		parent::beforeFilter($event);
		$user = $this->MyAuth->user();
		$menu = "default";
		if($user){
			$this->set("auth",$user);
			$menu="admin";
		}
		$this->set("menu",$menu);
	}
	
	public function isAuthorized($user = null)
	{
		if($user !== null){
			return true;
		}
		return false;
	}
}