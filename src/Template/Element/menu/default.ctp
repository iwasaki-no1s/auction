<div class="navbar navbar-default navbar-fixed-top" role="navigation">
	<div class="container-fluid">
		<div class="navbar-header">
		<?=$this->Html->link("落とします（仮）","/users/login",["class"=>"navbar-brand"]);?>
		</div>
		<div class="collapse navbar-collapse">
			<ul class="nav navbar-nav">
				<li class="dropdown">
					<?=$this->Html->link("出品商品一覧","/products/index");?>
				</li>
				<li class="dropdown">
					<?=$this->Html->link("ユーザー登録","/users/register");?>
				</li>
				<li class="dropdown">
					<?=$this->Html->link("ログイン","/users/login");?>
				</li>
			</ul>
		</div>
	</div>
</div>