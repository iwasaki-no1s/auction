$(function(){
	$('#selectCategories').change(categorySearchRequest);
	$(window).load(categorySelectedRequest);
});


function categorySelectedRequest(event){
	categorySearchFormInit();
	var data = $('#selectCategories').serialize();
	$.ajax({
		url:"/auction/admin/categories/index/",
		type:"PATCH",
		data:data,
		dataType:"json",
		success:tableAttrOnLoad,  //パラメーターなしでloadした際に下に選択してくださいを出さないため
		error:adminCategorySearchError,
	});
}

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
		$('#result table').remove();
		$('#result').text('選択されたカテゴリーには商品がありません');
		return;
	}
	$('#result').append('<table>');
	$.each(products, function(key, value){
	$('#result table').append('<tr class="product-info">'
	                   +'<td class="image">商品画像</td>'
	                   +'<td class="description">'
	                   +'商品名　   : '+value.product_name+'<br/>'
	                   +'出品者　   : '+value.user.user_name+'<br/>'
	                   +'入札数　   : '+value.bids.length+'<br/>'
	                   +'終了時刻  : '+value.end_date+'<br/>'
	                   +'<a href="/auction/admin/products/bid/'+value.id+'" class="btn btn-info">入札する</a>'
	                   +'</td></tr>');
	});
	$("#result").after("</table>")
}
function tableAttrOnLoad(products){
	$('#result').text('');
	if(products.length==0){
		$('#result table').remove();
		return;
	}
	$('#result').append('<table>');
	$.each(products, function(key, value){
	$('#result table').append('<tr class="product-info">'
	                   +'<td class="image">商品画像</td>'
	                   +'<td class="description">'
	                   +'商品名　   : '+value.product_name+'<br/>'
	                   +'出品者　   : '+value.user.user_name+'<br/>'
	                   +'入札数　   : '+value.bids.length+'<br/>'
	                   +'終了時刻  : '+value.end_date+'<br/>'
	                   +'<a href="/auction/admin/products/bid/'+value.id+'" class="btn btn-info">入札する</a>'
	                   +'</td></tr>');
	});
	$("#result").append("</table>")
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