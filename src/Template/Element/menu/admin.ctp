<div class="navbar navbar-default navbar-fixed-top" role="navigation">
	<div class="container-fluid">
		<div class="navbar-header">
			<?=$this->Html->link("コロリちゃん",["controller"=>"MyPages","action"=>"index"],["class"=>"navbar-brand"]); ?>
		</div>
<<<<<<< HEAD
		<div class="collapse" navbar-collapse">
=======
		<div class="collapse navbar-collapse" style="height:55px">
>>>>>>> origin/iwasaki
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
<<<<<<< HEAD
=======
			</ul>
			
			<ul class="nav navbar-nav navbar-right">
				<p class="navbar-text">ようこそ、<?=$auth["user_name"];?> さん</p>
>>>>>>> origin/iwasaki
				<li class="dropdown">
					<?=$this->Html->link("ユーザ","#",["data-toggle"=>"dropdown"]);?>
					<ul class="dropdown-menu">
						<li><?=$this->Html->link("マイページ","/admin/my-pages/index");?></li>
						<li><?=$this->Html->link("ユーザ情報変更","/admin/users/edit");?></li>
						<li><?=$this->Html->link("ログアウト","/admin/users/logout");?></li>
					</ul>
				</li>
			</ul>
<<<<<<< HEAD
=======
			<?php 
				echo $this->Form->create("",[
					'url'=>["controller"=>"products","action"=>"search"],
					'class'=>["navbar-form navbar-right"],
				]);
			?>
        	<div class="form-group">
        	<?php 
        		echo $this->Form->input("search_word",[
        			'class'=>["form-control"],
        			'placeholder'=>["キーワードを入力"],
        			"label"=>"",
        		]);
        		echo $this->Form->end();
        	?>
        	</div>
      		</form>
>>>>>>> origin/iwasaki
		</div>
	</div>
</div>
