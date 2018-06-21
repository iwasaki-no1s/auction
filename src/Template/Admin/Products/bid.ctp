<h1 class="page-header">入札</h1>
<h3><?= $product->product_name ?></h3>
<?php
	echo $this->Form->create($bid,['url'=>["controller"=>"bids","action"=>"add",$product->id]]);
	echo "現在の入札価格 : ".$current->max_price;
	echo $this->Form->input('price',[
		'default'=>$current->max_price,
		'min'=>$current->max_price+1,
		'label'=>"入札価格"
		]);
	echo $this->Form->button("入札");
	echo $this->Form->end();
?>