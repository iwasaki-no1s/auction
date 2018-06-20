$(function(){
	$('#selectCategories').change(categorySearchRequest);
});

function categorySearchRequest(event){
	categorySearchFormInit();
	var data = $('#selectCategories').serialize();
	$.ajax({
		url:"/auction/admin/categories/index/",
		type:"PUT",
		data:data,
		dataType:"json",
		success:tableAttr,
		error:adminCategorySearchError,
	});
}
function categorySearchFormInit(){
	$('#message').remove();
	$('.help-block').remove();
	$('.form-group').removeClass('has-error');
}
function tableAttr(products){
	$('#result').text('');
	if(products.length==0){
		$('#result').text('選択されたカテゴリーには商品がありません');
		return;
	}
	$('#result').append('<table>');
	 $.each(products, function(i, value){
		 console.log(value);
	$('#result').after('<tr class="product-info">'
	                   +'<td class="image" style="background-color:red">商品画像</td>'
	                   +'<td class="description" style="background-color:blue">'
	                   +value.product_name+'<br/>'
	                   //+value.user[user_name]+'<br/>'
	                   +value.detail+'<br/>'
	                   +'</td></tr>');
	});
	$("#result").after("</table>")
}
function adminCategorySearchError(result){
	showErrorMessage("そのカテゴリーには商品はありません")
}

function　showErrorMessage(message){
	var tag = '<div id="message" class="alert alert-danger">';
	tag +=message;
	tag +='</div>';
	$('.main').prepend(tag);
}
function showValidationMessage(errors){
	for (key in errors){
		var obj = $("[name='"+key+"']");
		obj.parent().addClass('has-error');
		var field = error[key];
		for (var value in field){
			var tag='<div class="help-block">'+field[value]+'</div>';
			obj.after(tag);
		}
	}
}