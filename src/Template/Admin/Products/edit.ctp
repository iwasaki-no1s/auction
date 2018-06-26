<h1 class="page-header">商品編集</h1>

<?php
echo $this->Form->create($product);
echo $this->Form->input('product_name',['label'=>"商品名"]);
?>
<div style="font-weight:bold">詳細</div>
<?php
echo $this->Form->textarea('detail',[
	'label'=>"商品詳細",
	]);
echo $this->Form->input('max_price',[
	'default'=>0,
	'min'=>0,
	'label'=>"即決価格",
	]);
echo $this->Form->input('category_id',[
	'options'=>$category,
	'label'=>"カテゴリー",
	'empty'=>'選択してください',
	]);
echo $this->Form->button("編集を確定する");
echo $this->Form->end();

echo $this->Form->create($images);
echo $this->Form->input('image_id',[
	'options'=>$image,
//	'default'=>,
	'label'=>"main画像",
	]);
echo $this->Form->button("main画像を変更する");
echo $this->Form->end();
echo $this->Html->link("画像を追加する",["controller"=>"images","action"=>"add",$product->id],["class"=>["btn btn-primary"]]);
echo $this->Html->link("現在の価格でオークションを終了する",["controller"=>"products","action"=>"finish",$product->id],["class"=>["btn btn-warning"]]);
echo $this->Html->link("出品を取り消す",["controller"=>"products","action"=>"delete",$product->id],["class"=>["btn btn-danger"]]);
?>