<?php $this->prepend('script',$this->Html->script('admin_bids_history'));?>
<h1 class="page-header"><?= $product->product_name ?></h1>
<div id="detail-box">
	<div id="detail-image">
		<?php
			$main_image_check=false;
			foreach($product->images as $image){
				if($image->main_image==1){
					echo $this->Html->image("/upload_img/{$image->image_url}");
					$main_image_check=true;
				}
			}
			if($main_image_check==false){
				echo $this->Html->image("/upload_img/no_image.png");
			}
/*
			//dump($product->images[0]);
			$size=count($product->images);	
			if($product->images){
				$i=0;
				if($i==$size){
					$i=0;
				}else if($i==-1){
					$i=$size-1;
				}
				echo $this->Html->image("/upload_img/{$product->images[$i]->image_url}");
			}else{
				echo $this->Html->image("/upload_img/no_image.png");
			}
*/
		?>
	</div>
	<div id="detail-description">
		<div>出品者　：　<?=$this->Html->link($product->user->user_name,["controller"=>"products","action"=>"user",$product->user_id]); ?></div>
		<div>カテゴリー: <?=$this->Html->link($product->category->name,["controller"=>"categories","action"=>"index",$product->category_id]); ?></div>
		<div>入札数　：   <?= count($product->bids); ?></div>
		<div>終了時刻：  <?=h($product->end_date->format("Y年m月d日H時i分")); ?></div>
		<!--オークションが終了している，かつ自分が出品した商品は落札者の氏名と住所を表示-->
		<?php if($product->sold==1 && $user_id==$product->user_id){ ?>
			<?php //dump($bids); ?>
			<?php //if($bids){ ?>
				<div>落札者　　: </div>
				<div>住所　　　 : </div>
			<?php } ?>
		<?php //} ?>
		<?php if($product->detail){ ?>
			<div>詳細　　:  <?=h($product->detail); ?></div>
		<?php } ?>
		<?php if($product->sold==0){ ?>
			<?php if($user_id==$product->user_id){ ?>
				<div><?=$this->Html->link("編集する",["controller"=>"products","action"=>"edit",$product->id],["class"=>["btn btn-success"]]); ?></div>
			<?php }else{ ?>
				<div><?=$this->Html->link("入札する",["controller"=>"products","action"=>"bid",$product->id],["class"=>["btn btn-info"]]); ?></div>
			<?php } ?>
		<?php }else{ ?>
			<h4>オークションが終了した商品です</h4>
		<?php } ?>
		<?php if($favorite_check==0){ ?>
			<?=$this->Html->link("お気に入りに追加する",["controller"=>"products","action"=>"favorite",$product->id],["class"=>["btn btn-default"]]); ?>
		<?php }else{ ?>
			<?=$this->Html->link("お気に入りを削除する",["controller"=>"favorites","action"=>"delete",$product->id],["class"=>["btn btn-warning"]]); ?>
		<?php } ?>
		<br/><br/>
		<div style="margin-left : 20px">
			<?php 
				$i=1;
				echo "<ul>";
				foreach($bids as $bid){
					echo "<li id='bid_no$i' class='bid_his'>";
					echo "<span class='bid_user'>".$bid->user->user_name."</span>";
					echo "<span class='bid_price'>".$bid->price."</span></li>";
					$i++;
				}
				echo "</ul>";
			?>
		</div>
	</div>
</div>