<div class="navbar navbar-default navbar-fixed-top" role="navigation">
	<div class="container-fluid">
		<div class="navbar-header">
		<?=$this->Html->link("コロリちゃん","/users/login",["class"=>"navbar-brand"]);?>
		</div>
		<div class="collapse navbar-collapse">
			<ul class="nav navbar-nav">
				<li class="dropdown">
					<?=$this->Html->link("商品を探す","#",["data-toggle"=>"dropdown"]);?>
					<ul class="dropdown-menu">
						<li><?=$this->Html->link("出品商品一覧","/products/index");?></li>
						<li><?=$this->Html->link("カテゴリーで探す","/categories/index");?></li>
					</ul>
				</li>
				<li class="dropdown">
					<?=$this->Html->link("ユーザー登録","/users/register");?>
				</li>
			</ul>
			<ul class ="nav navbar-nav navbar-right">
				<li class="dropdown">
					<?=$this->Html->link("ログイン","/users/login");?>
				</li>
			</ul>
			<?php 
				echo $this->Form->create("",[
					'url'=>["controller"=>"products","action"=>"search"],
					'class'=>["navbar-form navbar-right"],
				]);
			?>
        		<div class="form-group">
          			<input type="text" class="form-control" placeholder="Search">
        		</div>
      		</form>
		</div>
	</div>
</div>