
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

function tableAttr(data){
	$('#result').text('');
	var products = data.products;
	var login_user_id = data.login_user_id;
	if(products.length==0){
		$('#result table').remove();
		$('#result').text('選択されたカテゴリーには商品がありません');
		return;
	}
	$('#result').append('<table>');
	$.each(products, function(key, value){
		var end_date = new Date(value.end_date);
		if(login_user_id !== value.user.id){
			var link = '<a href="/auction/admin/products/bid/'+value.id+'" class="btn btn-info">入札する</a>';
		}else{
		    var link = '<a href="/auction/admin/products/edit/'+value.id+'" class="btn btn-success">編集する</a>';
		}		
		$('#result table').append('<tr class="product-info">'
	                   +'<td class="image">商品画像</td>'
	                   +'<td class="description">'
	                   +'商品名　   :  <a href="/auction/admin/products/detail/'+value.id+'">'+value.id+'</a><br/>'
	                   +'出品者　   :  <a href="/auction/admin/products/user/'+value.user.id+'">'+value.user.user_name+'</a><br/>'
	                   +'入札数　   : '+value.bids.length+'<br/>'
	                   +'終了時刻  : '+end_date.getFullYear()+'年'
	                                + end_date.getMonth()+1 +'月'
	                                + end_date.getDate() + "日　"
					   	            + end_date.getHours() + "時"
						            + end_date.getMinutes() + "分"+'<br/>'
						            + link
						            +'</td></tr>');
	});
	$("#result").after("</table>")
}
function tableAttrOnLoad(data){
	var products = data.products;
	var login_user_id = data.login_user_id;
	$('#result').text('');
	if(products.length==0){
		$('#result table').remove();
		return;
	}
	$('#result').append('<table>');
	$.each(products, function(key, value){
	    if(login_user_id !== value.user.id){
			var link = '<a href="/auction/admin/products/bid/'+value.id+'" class="btn btn-info">入札する</a>';
		}else{
		    var link = '<a href="/auction/admin/products/edit/'+value.id+'" class="btn btn-success">編集する</a>';
		}
	$('#result table').append('<tr class="product-info">'
	                   +'<td class="image">商品画像</td>'
	                   +'<td class="description">'
	                   +'商品名　   : <a href="/auction/admin/products/detail/'+value.id+'">'+value.id+'</a><br/>'
	                   +'出品者　   : <a href="/auction/admin/products/user/'+value.user.id+'">'+value.user.user_name+'</a><br/>'
	                   +'入札数　   : '+value.bids.length+'<br/>'
	                   +'終了時刻  : '+value.end_date+'<br/>'
	                   + link
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