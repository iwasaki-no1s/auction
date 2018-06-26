<h1 class="page-header">「<?= $key_word ?>」の検索結果</h1>
<table>
<?php foreach($products as $product){ ?>
	<tr class="product-info">
		<td class="image">
			<?php
				//dump($product->images);
				if($product->images["image_url"]){
					echo $this->Html->image("/upload_img/{$product->images['image_url']}");
				}else{
					echo $this->Html->image("/upload_img/no_image.png");
				}
			?>
		</td>
		<td class="description">
			<div>商品名　  : <?=$this->Html->link($product->product_name,["controller"=>"products","action"=>"detail",$product->id]); ?></div>
			<div>出品者　  : <?=$this->Html->link($product->users["user_name"],["controller"=>"products","action"=>"user",$product->user_id]); ?></div>
			<div>カテゴリー  : <?=$this->Html->link($product->categories["name"],["controller"=>"categories","action"=>"index",$product->category_id]); ?></div>
			<div>入札数　  ：  <?= count($product->bids); ?></div>
			<div>終了時刻 ：  <?=h($product->end_date->format("Y年m月d日H時i分")); ?></div>
			<?php if($product->sold==0){ ?>
			<?php if($user_id==$product->users["id"]){ ?>
				<div><?=$this->Html->link("編集する",["controller"=>"products","action"=>"edit",$product->id],["class"=>["btn btn-success"]]); ?></div>
			<?php }else{ ?>
				<div><?=$this->Html->link("入札する",["controller"=>"products","action"=>"bid",$product->id],["class"=>["btn btn-info"]]); ?></div>
			<?php } ?>
		<?php }else{ ?>
			<h4>オークションが終了した商品です</h4>
		<?php } ?>
		</td>
	</tr>
<?php } ?>
</table>