<script src="http://code.jquery.com/jquery-2.1.1.min.js"></script>
<script>
	$(function(){
		$("#selectCategories").on('change',function(){
			$("table").attr("class","passive");
			$("table:eq(0)").attr("class","active");
			var display=document.getElementById(this.id);
			$("table[name="+display.id+"]").attr("class","active");
			$("#mypage-menu td").css("background-color","#fff")
			$(this).css("background-color","#b2ff99")
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