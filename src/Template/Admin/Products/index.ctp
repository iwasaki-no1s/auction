<h1 class="page-header">開催中の商品一覧</h1>
<table>
<?php foreach($products as $product){ ?>
	<tr class="product-info">
		<td class="image">画像</td>
		<td class="description">
			<div>商品名　  : <?=$this->Html->link($product->product_name,["controller"=>"products","action"=>"detail",$product->id]); ?></div>
			<div>出品者　  : <?=$this->Html->link($product->user->user_name,["controller"=>"products","action"=>"user",$product->user_id]); ?></div>
			<div>カテゴリー  : <?=$this->Html->link($product->category->name,["controller"=>"categories","action"=>"index",$product->category_id]); ?></div>
			<div>入札数　  ：  <?= count($product->bids); ?></div>
			<div>終了時刻 ：  <?=h($product->end_date->format("Y年m月d日H時i分")); ?></div>
			<div><?=$this->Html->link("入札する",["controller"=>"products","action"=>"bid",$product->id]); ?></div>
		</td>
	</tr>
<?php } ?>
</table>