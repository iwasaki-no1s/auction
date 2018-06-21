$(function(){
	$('#selectCategories').change(categorySearchRequest);
});
<<<<<<< HEAD
$(function(){
	$('#selectCategories').onload(categorySelectedhRequest);
});
=======

$(function(){
	$('#selectCategories').change(categorySearchRequest);
});


>>>>>>> iwasaki
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
		console.log(products);
		$('#result table').remove();
		$('#result').text('選択されたカテゴリーには商品がありません');
		return;
	}
	$('#result').append('<div id="mes">'+'検索結果 ： '+products[0].category.name+'</div>');
	$('#result').append('<table>');
	$.each(products, function(key, value){
		 console.log(value);
	$('#result table').append('<tr class="product-info">'
	                   +'<td class="image" style="background-color:red">商品画像</td>'
	                   +'<td class="description" style="background-color:blue">'
	                   +'商品名　   : '+value.product_name+'<br/>'
	                   +'出品者　   : '+value.user.user_name+'<br/>'
	                   +'入札数　   : '+value.bids.length+'<br/>'
	                   +'終了時刻  : '+value.end_date+'<br/>'
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