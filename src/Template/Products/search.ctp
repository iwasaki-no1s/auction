<h1 class="page-header">「<?= $key_word ?>」の検索結果</h1>
<h3>検索結果：<?php echo count($products); ?>件</h3>
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
			<div><?=$this->Html->link("新規登録して入札",["controller"=>"users","action"=>"register",$product->id],["class"=>["btn btn-primary"]]); ?></div>
			<div><?=$this->Html->link("ログインして入札",["controller"=>"users","action"=>"login",$product->id],["class"=>["btn btn-info"]]); ?></div>
		</td>
	</tr>
<?php } ?>
</table>