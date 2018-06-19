<?php
namespace App\Controller\Admin;

use App\Controller\Admin\AppController;

class CategoriesController extends AppController
{
	public function index()
	{
		$categories = $this->Categories->find('list');
		$this->set(compact('categories'));
	}
	public function index($category_id = null)
	{
		if ($this->request->is ( [
				'ajax'
		] )) {
			$this->autoRender = FALSE;
			$result = [ ];
			$category_id = $this->request->data ['id'];
			$order_detail = 
			$order_detail = $this->OrderDetails->patchEntity ( $order_detail, $this->request->data );
			if ($this->OrderDetails->save ( $order_detail )) {
				$result ['status'] = "success";
				echo json_encode ( $result );
				return;
			} else {
				$result ['errors'] = $order_detail->errors ();
				echo json_encode ( $result );
				return;
			}
		}else{
			$categories = $this->Categories->find('list');
			$this->set ( compact ( 'categories' ) );
		}
	}
}