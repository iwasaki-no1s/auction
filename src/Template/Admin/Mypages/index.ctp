<script src="http://code.jquery.com/jquery-2.1.1.min.js"></script>
<script>
	$(function(){
		$("#mypage-menu td").on('click',function(){
			$("table").attr("class","passive");
			$("table:eq(0)").attr("class","active");
			var display=document.getElementById(this.id);
			$("table[name="+display.id+"]").attr("class","active");
			$("#mypage-menu td").css("background-color","#fff")
			$(this).css("background-color","#b2ff99")
		})
	});
</script>
<table id="mypage-menu">
	<tr><td id="my-exhibit"><h3>出品した商品</h3></td><td id="my-bids-history"><h3>入札履歴</h3></td><td id="my-favorites"><h3>☆</h3></td></tr>
</table>
<table name="my-exhibit">
	<?php foreach($my_exhibits as $my_exhibit){ ?>
	<tr class="product-info">
		<td class="image">がぞー</td>
		<td class="description">
			<div><?=$this->Html->link($my_exhibit->product_name,["controller"=>"products","action"=>"detail"]); ?></div>
			<div><?=$this->Html->link($my_exhibit->user->user_name,["controller"=>"products","action"=>"user"]); ?></div>
			<div><?=$this->Html->link($my_exhibit->category->name,["controller"=>"products","action"=>"catogory"]); ?></div>
			<?php
				$bids_count=0;
				//入札の数をカウントする
				foreach($bids as $bid){
					
				}
			?>
			<div>入札数：<?php $bids_count ?></div>
			<div>終了時刻：<?=h($my_exhibit->end_date->format("Y年m月d日H時i分")) ?></div>
		</td>
	</tr>
	<?php } ?>
</table>
<table name="my-bids-history">
	<tr>
	
	</tr>
</table>
<table name="my-favorites">
	<tr>
	
	</tr>
</table>