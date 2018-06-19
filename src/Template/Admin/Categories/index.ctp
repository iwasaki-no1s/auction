<script src="http://code.jquery.com/jquery-2.1.1.min.js"></script>
<script>
	$(function(){
		$("#selectCategories").on('change',function(){
			$("table").attr("class","passive");
			$("table:eq(0)").attr("class","active");
			var display=document.getElementById(this.id);
			$("table[name="+display.id+"]").attr("class","active");
			$("#mypage-menu td").css("background-color","#fff");
		})
	});
</script>

<h1 class="page-header">カテゴリーで探す</h1>
<?php
echo $this->Form->input('category_id',[
	'options'=>$categories,
	'empty'=>"選択してください",
	'label'=>"カテゴリー",
	'id'=>'selectCategories',
	]);
?>

<table name="my-exhibit" class="display-none">
	<?php foreach($my_exhibits as $my_exhibit){ ?>
	<tr class="product-info">
		<td class="image">がぞー</td>
		<td class="description">
			<div><?=$this->Html->link($my_exhibit->product_name,["controller"=>"products","action"=>"detail"]); ?></div>
			<div><?=$this->Html->link($my_exhibit->user->user_name,["controller"=>"products","action"=>"user"]); ?></div>
			<div><?=$this->Html->link($my_exhibit->category->name,["controller"=>"products","action"=>"catogory"]); ?></div>
			<?php
				$count = 0;
				foreach($bids as $bid){
					if($bid->product_id==$my_exhibit->id){
						$count++;
					}
				}
			?>
			<div>入札数：<?php echo $count ?></div>
			<div>終了時刻：<?=h($my_exhibit->end_date->format("Y年m月d日H時i分")) ?></div>
		</td>
	</tr>
	<?php } ?>
</table>