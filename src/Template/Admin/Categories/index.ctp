<h1 class="page-header">カテゴリーで探す</h1>

<?php $this->prepend('script',$this->Html->script('admin_orderdetails'));?>
<?php
echo $this->Form->input('category_id',[
	'options'=>$categories,
	'label'=>"カテゴリー",
	]);
?>
	