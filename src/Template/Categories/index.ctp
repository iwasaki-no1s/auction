<?php $this->prepend('script',$this->Html->script('default_categories'));?>
<h1 class="page-header">カテゴリーで探す</h1>
<?php
echo $this->Form->input('category_id',[
	'options'=>$categories,
	'empty'=>"選択してください",
	'default'=>$selected_id,
	'label'=>"カテゴリー",
	'id'=>'selectCategories',
	]);
?>
<div id="result">
</div>