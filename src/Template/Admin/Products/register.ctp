<h1 class="page-header">出品</h1>

<?php
echo $this->Form->create($product);
echo $this->Form->input('product_name',['label'=>"商品名"]);
?>
<div style="font-weight:bold">詳細</div>
<?php
echo $this->Form->textarea('detail',[
	'label'=>"商品詳細",
	]);
echo $this->Form->input('start_price',[
	'default'=>0,
	'min'=>0,
	'label'=>"スタート価格",
	]);
echo $this->Form->input('max_price',[
	'default'=>0,
	'min'=>0,
	'label'=>"即決価格",
	]);
echo $this->Form->input('end_date',[
	'type' => 'datetime',
	'label'=>"オークション終了日",
    'dateFormat' => 'Y-m-d H:i:s',
    'default'=>date('Y-m-d H:i:s',strtotime('now')),
    'min'=>date('Y-m-d H:i:s',strtotime('now')),
    'monthNames' => false,
    'empty' => '選択してください']);
echo $this->Form->input('category_id',[
	'options'=>$category,
	'label'=>"カテゴリー",
	'empty'=>"選択してください",
	]);
echo $this->Form->hidden('sold',['default'=>0]);
echo $this->Form->button("商品画像登録へ");
echo $this->Form->end();
?>