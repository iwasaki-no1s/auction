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