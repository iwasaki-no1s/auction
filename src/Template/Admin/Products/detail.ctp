<h1 class="page-header"><?= $product->product_name ?></h1>
<div id="detail-box">
	<div id="detail-image">がぞー</div>
	<div id="detail-description>
		<div>出品者　：　<?=$this->Html->link($product->user->user_name,["controller"=>"products","action"=>"user",$product->user_id]); ?></div>
		<div>カテゴリー: <?=$this->Html->link($product->category->name,["controller"=>"categories","action"=>"index",$product->category_id]); ?></div>
		<div>入札数　：   <?= count($product->bids); ?></div>
		<div>終了時刻：  <?=h($product->end_date->format("Y年m月d日H時i分")); ?></div>
		<?php if($user_id==$product->user_id){ ?>
			<div><?=$this->Html->link("編集する",["controller"=>"products","action"=>"edit",$product->id]); ?></div>
		<?php }else{ ?>
			<div><?=$this->Html->link("入札する",["controller"=>"products","action"=>"bid",$product->id]); ?></div>
		<?php } ?>
		<?php if($favorite_check==0){ ?>
			<button class="add-favorite"><?=$this->Html->link("お気に入りに追加する",["controller"=>"products","action"=>"favorite",$product->id]); ?></button>
		<?php }else{ ?>
			<div><?=$this->Html->link("お気に入りを削除する",["controller"=>"favorites","action"=>"delete",$product->id]); ?></div>
		<?php } ?>
			<button class="add-favorite">★</button>
	</div>
</div>
<?=$this->Html->link("お気に入りに追加する",["controller"=>"products","action"=>"favorite",$product->id]); ?>