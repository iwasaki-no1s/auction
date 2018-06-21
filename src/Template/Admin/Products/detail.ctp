<h1 class="page-header"><?= $product->product_name ?></h1>
<div id="detail-box">
	<div id="detail-image">がぞー</div>
	<div id="detail-description">
		<div>出品者　：　<?=$this->Html->link($product->user->user_name,["controller"=>"products","action"=>"user",$product->user_id]); ?></div>
		<div>カテゴリー: <?=$this->Html->link($product->category->name,["controller"=>"categories","action"=>"index",$product->category_id]); ?></div>
		<div>入札数　：   <?= count($product->bids); ?></div>
		<div>終了時刻：  <?=h($product->end_date->format("Y年m月d日H時i分")); ?></div>
		<?php if($user_id==$product->user_id){ ?>
			<div><?=$this->Html->link("編集する",["controller"=>"products","action"=>"edit",$product->id],["class"=>["btn btn-success"]]); ?></div>
		<?php }else{ ?>
			<div><?=$this->Html->link("入札する",["controller"=>"products","action"=>"bid",$product->id],["class"=>["btn btn-info"]]); ?></div>
		<?php } ?>
		<?php if($favorite_check==0){ ?>
			<?=$this->Html->link("お気に入りに追加する",["controller"=>"products","action"=>"favorite",$product->id],["class"=>["btn btn-default"]]); ?>
		<?php }else{ ?>
			<?=$this->Html->link("お気に入りを削除する",["controller"=>"favorites","action"=>"delete",$product->id],["class"=>["btn btn-warning"]]); ?>
		<?php } ?>
	</div>
</div>