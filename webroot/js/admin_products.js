$(function(){
	$('#max').each(priceRequest);
});


function priceRequest(event){
	productRegisterFormInit();
	var data = $('#start').serialize();
	$.ajax({
		url:"/auction/admin/products/register/",
		type:"PUT",
		data:data,
		dataType:"json",
		success:priceChecker, 
		error:adminProductRegisterError,
	});
}

function productRegisterFormInit(){
	$('#message').remove();
	$('.help-block').remove();
	$('.form-group').removeClass('has-error');
}
function priceChecker(products){
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

function adminProductRegisterError(result){
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