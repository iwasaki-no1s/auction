$(function(){
	$('#selectCategories').change(categorySearchRequest);
	$(window).load(categorySelectedRequest);
});


function categorySelectedRequest(event){
	categorySelectFormInit();
	var data = $('#selectCategories').serialize();
	$.ajax({
		url:"/auction/categories/index/",
		type:"PATCH",
		data:data,
		dataType:"json",
		success:tableAttrOnLoad, //load時は「選択したカテゴリーに商品はありません」が必要ないため
		error:defaultCategorySearchError,
	});
}

function categorySearchRequest(event){
	categorySearchFormInit();
	var data = $('#selectCategories').serialize();
	$.ajax({
		url:"/auction/categories/index/",
		type:"PUT",
		data:data,
		dataType:"json",
		success:tableAttr,
		error:defaultCategorySearchError,
	});
}
function categorySearchFormInit(){
	$('#message').remove();
	$('.help-block').remove();
	$('.form-group').removeClass('has-error');
}
function categorySelectFormInit(){
	$('#result').text("")
	$('#message').remove();
	$('.help-block').remove();
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
	                   +'<td class="image">aaa</td>'
	                   +'<td class="description">'
	                   +'商品名　   : '+value.product_name+'<br/>'
	                   +'出品者　   : '+value.user.user_name+'<br/>'
	                   +'入札数　   : '+value.bids.length+'<br/>'
	                   +'終了時刻  : '+value.end_date+'<br/>'
	                   +'<a href="/auction/users/register/'+value.id+'" class="btn btn-primary">新規登録して入札</a><br/>'
	                   +'<a href="/auction/users/login/'+value.id+'" class="btn btn-info">ログインして入札</a>'
	                   +'</td></tr>');
	});
	$("#result").append("</table>")
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
	                   +'<a href="/auction/users/register/'+value.id+'" class="btn btn-primary">新規登録して入札</a><br/>'
	                   +'<a href="/auction/users/login/'+value.id+'" class="btn btn-info">ログインして入札</a>'
	                   +'</td></tr>');
	});
	$("#result").append("</table>")
}

function defaultCategorySearchError(result){
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