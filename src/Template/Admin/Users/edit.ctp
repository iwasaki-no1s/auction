<h1 class="page-header">ユーザー編集</h1>
<?php
echo $this->Form->create($user);
echo $this->Form->input('user_name');
echo $this->Form->input('password');
echo $this->Form->button("登録");
echo $this->Form->end();
?>