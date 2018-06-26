<?php
	//独自のCSS
	$this->prepend('css',$this->Html->css([
		'style.css'
	]));
	//BootstrapをCDNから取得
	$this->prepend('css',$this->Html->css([
		'//maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css'
	]));
	//BootstrapのJSをCDNから取得
	$this->prepend('script',$this->Html->script([
		'//maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js'
	]));
	$this->prepend('script',$this->Html->script([
		'//ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js'
	]));
	//jQueryをCDNから取得
	$this->prepend('script',$this->Html->script([
		'//code.jquery.com/jquery-2.2.4.js'
	]));
	
?>
<!DOCTYPE html>
<html>
<head>
	<?=$this->Html->charset() ?>
	<?=$this->Html->meta('icon') ?>
	<?=$this->fetch('script') ?>
	<title><?=$this->fetch('title') ?></title>
	<?=$this->fetch('css') ?>
</head>
<body>
	<?=$this->element("menu/".$menu) ?>
	<?=$this->element('content') ?>
</body>
</html>