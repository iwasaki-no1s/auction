<script src="http://code.jquery.com/jquery-2.1.1.min.js"></script>
<script>
	$(function(){
		$(".mypage-menu>td").on('click',function(){
			console.log(this.id);
			$("table").attr("class","passive");
			var display=document.getElementById(this.id);
			console.log(display.id);
			$(".mypage-menu>td").css("background-color","#fff")
			$(this).css("background-color","#b2ff99")
		})
	});
</script>
<table name="my-exhibit">
	<tr class="mypage-menu"><td id="my-products"><h3>出品した商品</h3></td><td id="my-bids-history"><h3>入札履歴</h3></td><td id="my-favorites"><h3>☆</h3></td></tr>
	<tr class="product-info">
		<td class="image">がぞー</td>
		<td class="description" colspan="2">
			<div><?=$this->Html->link("商品名",["controller"=>"products","action"=>"detail"]); ?></div>
			<div><?=$this->Html->link("出品者名",["controller"=>"products","action"=>"user"]); ?></div>
			<div><?=$this->Html->link("カテゴリー",["controller"=>"products","action"=>"catogory"]); ?></div>
			<div>入札数：</div>
			<div>残り時間：</div>
		</td>
	</tr>
</table>
<table name="my-bids-history">
	<tr>
	
	</tr>
</table>
<table name="my-favorites">
	<tr>
	
	</tr>
</table>