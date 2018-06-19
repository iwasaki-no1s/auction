<h1 class="page-header">出品</h1>

<?php
echo $this->Form->create($product);
echo $this->Form->input('name');
echo $this->Form->input('category_id',['options'=>$category]);
echo $this->Form->hidden('user_id',['value'=>$id]);
echo $this->Form->button("登録");
echo $this->Form->end();
?>