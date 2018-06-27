<h1 class="page-header">画像登録</h1>
<?php
	echo $this->Html->link("編集を終了する",["controller"=>"products","action"=>"detail",$product->id],["class"=>["btn btn-success"]]);
	echo $this->Html->link("出品を取り消す",["controller"=>"products","action"=>"delete",$product->id],["class"=>["btn btn-danger"]]);
?>
<?php
	echo $this->Form->create($image,["enctype"=>"multipart/form-data"]);
	echo $this->Form->input('file_name',["type"=>"file",
									 "label"=>"",
	]);
	echo $this->Form->input('image_name');
?>
<?php //dump($main_image_count) ?>
<?php if($main_image_count==0){ ?>
	<div class="passive">
	<?=$this->Form->checkbox('main_image',['checked'=>1]); ?>メイン画像に設定する</br>
	</div>
<?php }else{ ?>
	<?=$this->Form->checkbox('main_image',['checked'=>1]); ?>メイン画像に設定する</br>
<?php } ?>	
<?php
	echo $this->Form->button("画像を登録する");
	echo $this->Form->end();
?>