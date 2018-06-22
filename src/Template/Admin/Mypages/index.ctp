<script>
	$(function(){
		$("#mypage-menu td").on('click',function(){
			$("table").attr("class","passive");
			$("table:eq(0)").attr("class","active");
			var display=document.getElementById(this.id);
			$("table[name="+display.id+"]").attr("class","active");
			$("#mypage-menu td").css("background-color","#fff")
			$(this).css("background-color","#b2ff99")
		})
	});
</script>
<table id="mypage-menu">
	<tr><td id="my-exhibit"><h3>出品した商品</h3></td><td id="my-bids-history"><h3>入札履歴</h3></td><td id="my-favorites"><h1>☆</h1></td></tr>
</table>
<table name="my-exhibit" class="active">
	<?php foreach($my_exhibits as $my_exhibit){ ?>
	<tr class="product-info">
		<td class="image">画像</td>
		<td class="description">
			<div>商品名　: <?=$this->Html->link($my_exhibit->product_name,["controller"=>"products","action"=>"detail",$my_exhibit->id]); ?></div>
			<div>出品者　: <?=$this->Html->link($my_exhibit->user->user_name,["controller"=>"products","action"=>"user",$my_exhibit->user_id]); ?></div>
			<div>カテゴリー: <?=$this->Html->link($my_exhibit->category->name,["controller"=>"categories","action"=>"index",$my_exhibit->category_id]); ?></div>
			<div>入札数　：   <?= count($my_exhibit->bids); ?></div>
			<div>終了時刻：  <?=h($my_exhibit->end_date->format("Y年m月d日H時i分")); ?></div>
			<?php if($my_exhibit->sold==0){ ?>
				<div><?=$this->Html->link("編集する",["controller"=>"products","action"=>"edit",$my_exhibit->id],["class"=>["btn btn-success"]]); ?></div>
			<?php }else{ ?>
				<h4>オークションが終了した商品です</h4>
			<?php } ?>
		</td>
	</tr>
	<?php } ?>
</table>
<table name="my-bids-history" class="passive">
	<?php foreach($my_bids_histories as $my_bids_history){ ?>
	<tr class="product-info">
		<td class="image">画像</td>
		<td class="description">
			<div>商品名　: <?=$this->Html->link($my_bids_history->product_name,["controller"=>"products","action"=>"detail",$my_bids_history->id]); ?></div>
			<div>出品者　: <?=$this->Html->link($my_bids_history->user->user_name,["controller"=>"products","action"=>"user",$my_bids_history->user_id]); ?></div>
			<div>カテゴリー: <?=$this->Html->link($my_bids_history->category->name,["controller"=>"categories","action"=>"index",$my_bids_history->category_id]); ?></div>
			<div>入札数　：   <?= count($my_bids_history->bids); ?></div>
			<div>終了時刻：  <?=h($my_bids_history->end_date->format("Y年m月d日H時i分")); ?></div>
			<?php if($my_bids_history->sold==0){ ?>
				<div><?=$this->Html->link("入札する",["controller"=>"products","action"=>"bid",$my_bids_history->id],["class"=>["btn btn-info"]]); ?></div>
			<?php }else{ ?>
				<h4>オークションが終了した商品です</h4>
			<?php } ?>
		</td>
	</tr>
	<?php } ?>
</table>
<table name="my-favorites" class="passive">
	<?php foreach($my_favorites as $my_favorite){ ?>
	<tr class="product-info">
		<td class="image">がぞー</td>
		<td class="description">
			<div>商品名　: <?=$this->Html->link($my_favorite->product_name,["controller"=>"products","action"=>"detail",$my_favorite->id]); ?></div>
			<div>出品者　: <?=$this->Html->link($my_favorite->user->user_name,["controller"=>"products","action"=>"user",$my_favorite->user_id]); ?></div>
			<div>カテゴリー: <?=$this->Html->link($my_favorite->category->name,["controller"=>"categories","action"=>"index",$my_favorite->category_id]); ?></div>
			<div>入札数　：   <?= count($my_favorite->bids); ?></div>
			<div>終了時刻：  <?=h($my_favorite->end_date->format("Y年m月d日H時i分")); ?></div>
			<?php if($my_favorite->sold==1){ ?>
				<h4>オークションが終了した商品です</h4>
			<?php } ?>
			<div><?=$this->Html->link("お気に入りを削除する",["controller"=>"favorites","action"=>"delete",$my_favorite->id],["class"=>["btn btn-warning"]]); ?></div>
		</td>
	</tr>
	<?php } ?>
</table>