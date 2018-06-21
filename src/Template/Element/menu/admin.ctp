<div class="navbar navbar-default navbar-fixed-top" role="navigation">
	<div class="container-fluid">
		<div class="navbar-header">
			<?=$this->Html->link("コロリちゃん",["controller"=>"MyPages","action"=>"index"],["class"=>"navbar-brand"]); ?>
		</div>
		<div class="collapse navbar-collapse">
			<ul class="nav navbar-nav">
				<li class="dropdown">
					<?=$this->Html->link("出品","#",["data-toggle"=>"dropdown"]); ?>
					<ul class="dropdown-menu">
						<li><?=$this->Html->link("出品する","/admin/products/register");?></li>
					</ul>
				</li>
				<li class="dropdown">
					<?=$this->Html->link("商品一覧","#",["data-toggle"=>"dropdown"]);?>
					<ul class="dropdown-menu">
						<li><?=$this->Html->link("商品一覧","/admin/products/index");?></li>
						<li><?=$this->Html->link("カテゴリーで探す","/admin/categories/index");?></li>
					</ul>
				</li>
			</ul>
			<ul class="nav navbar-nav navbar-right">
				
				<p class="navbar-text">ようこそ、<?=$auth["user_name"];?></p>
				<li class="dropdown">
					<?=$this->Html->link("ユーザ","#",["data-toggle"=>"dropdown"]);?>
					<ul class="dropdown-menu">
						<li><?=$this->Html->link("マイページ","/admin/my-pages/index");?></li>
						<li><?=$this->Html->link("ユーザ情報変更","/admin/users/edit");?></li>
						<li><?=$this->Html->link("ログアウト","/admin/users/logout");?></li>
					</ul>
				</li>
			</ul>
		</div>
	</div>
</div>
