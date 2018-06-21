<?php
namespace App\Controller;

use App\Controller\AppController;

class UsersController extends AppController
{
	public function initialize()
	{
		parent::initialize();
		$this->loadComponent("MyAuth");
		$this->MyAuth->allow(["login","register"]);
	}
	
	public function login($product_id=null)
	{
		$user = $this->Users->newEntity();
		if($this->request->is('post')){
			$user = $this->MyAuth->identify();
			if($user){
				$this->MyAuth->setUser($user);
				if($product_id){
					return $this->redirect(["prefix"=>"admin","controller"=>"products","action"=>"bid",$product_id]);
				}else{
					return $this->redirect($this->MyAuth->redirectUrl());
				}
			}else{
				$this->Flash->error(__('email、またはパスワードが間違っています'));
			}
		}
		$this->set(compact('user'));
	}
	
	public function register()
	{
		$user = $this->Users->newEntity();
		if($this->request->is('post')){
			$user = $this->Users->patchEntity($user,$this->request->data);
			if($this->Users->save($user)){
				$this->MyAuth->setUser($user);
				$this->Flash->success("ユーザー登録が完了しました");
				if($product_id){
					return $this->redirect(["prefix"=>"admin","controller"=>"products","action"=>"bid",$product_id]);
				}else{
					return $this->redirect($this->MyAuth->redirectUrl());
				}
			}
			$this->Flash->error(__('ユーザー登録に失敗しました'));
		}
		$this->set(compact('user'));
	}
}