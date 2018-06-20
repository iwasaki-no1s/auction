<h1 class="page-header">入札</h1>

<h3><?= $product->product_name ?></h3>
<?php
	echo $this->Form->create($product,['url'=>["controller"=>"bids","action"=>"add"]]);
//	echo $this->Form->hidden('product_id',['value'=>$product->id]);
	echo $this->Form->input('price',[
		'default'=>0,
		'min'=>0,
		'label'=>"入札価格"
		]);
	echo $this->Form->button("入札");
	echo $this->Form->end();
?>