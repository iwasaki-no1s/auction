<?php $this->prepend('script',$this->Html->script('admin_categories'));?>
<h1 class="page-header">カテゴリーで探す</h1>
<?php
echo $this->Form->input('category_id',[
	'options'=>$categories,
	'empty'=>"選択してください",
	'label'=>"カテゴリー",
	'id'=>'selectCategories',
	]);
?>
<div id="result">
</div>