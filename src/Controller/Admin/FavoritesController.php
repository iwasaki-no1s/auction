<?php
namespace App\Controller\Admin;

use App\Controller\Admin\AppController;

class FavoritesController extends AppController
{	
	public function delete($product_id=null)
	{
		$user_id=$this->MyAuth->user('id');
		$check=$this->Favorites
					->find()
					->where(['user_id'=>$user_id])
					->andwhere(['product_id'=>$product_id])
					->first();
		try{
			$favorite=$this->Favorites->get($check->id);
		}catch(\Exception $e){
			$this->Flash->error(__('エラーが起きました'));
			return $this->redirect(['controller'=>'MyPages','action'=>'index']);
		}
		$this->Favorites->delete($favorite);
		$this->Flash->success(__('お気に入りを削除しました'));
		return $this->redirect(['controller'=>'MyPages','action'=>'index']);
	}
}