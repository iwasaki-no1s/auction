<h1 class="page-header"><?= $product->product_name ?></h1>
<div id="detail-box">
	<div id="detail-image">
		<?php
			$image_check=false;
			foreach($product->images as $image){
				if($image->main_image==1){
					echo $this->Html->image("/upload_img/{$image->image_url}");
					$image_check=true;
				}
			}
			if($image_check==false){
				echo $this->Html->image("/upload_img/no_image.png");
			}
		?>
	</div>
	<div id="detail-description">
		<div>出品者　：　<?=$this->Html->link($product->user->user_name,["controller"=>"products","action"=>"user",$product->user_id]); ?></div>
		<div>カテゴリー: <?=$this->Html->link($product->category->name,["controller"=>"categories","action"=>"index",$product->category_id]); ?></div>
		<div>入札数　：   <?= count($product->bids); ?></div>
		<div>終了時刻：  <?=h($product->end_date->format("Y年m月d日H時i分")); ?></div>
		<div>詳細　　:  <?=h($product->detail); ?></div>
		<div><?=$this->Html->link("新規登録して入札",["controller"=>"users","action"=>"register",$product->id],["class"=>["btn btn-primary"]]); ?></div>
		<div><?=$this->Html->link("ログインして入札",["controller"=>"users","action"=>"login",$product->id],["class"=>["btn btn-info"]]); ?></div>
	</div>
</div>