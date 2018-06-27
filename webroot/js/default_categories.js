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
		var image_url = "";
		if(value.images.length == 0){
			image_url = "no_image.png";
		}else{
			$.each(value.images, function(key, img){
				image_url = img.image_url;
				if(img.main_image == 1){
					image_url = img.image_url;
				}
			});
		}// 空だったらno_image.png　あればURLに画像を設定、メインがあればそれを設定
		
		$('#result table').append('<tr class="product-info">'
	                   +'<td class="image"><img src="http://localhost/auction/webroot/upload_img/'+image_url+'"></td>'
	                   +'<td class="description">'
	                   +'商品名　   :  <a href="/auction/products/detail/'+value.id+'">'+value.product_name+'</a><br/>'
	                   +'出品者　   :  <a href="/auction/products/user/'+value.user.id+'">'+value.user.user_name+'</a><br/>'
	                   +'入札数　   : '+value.bids.length+'<br/>'
	                   +'終了時刻  : '+end_date.getFullYear()+'年'
	                                + end_date.getMonth()+1 +'月'
	                                + end_date.getDate() + "日　"
					   	            + end_date.getHours() + "時"
						            + end_date.getMinutes() + "分"+'<br/>'
						            +'<a href="/auction/users/register/'+value.id+'" class="btn btn-primary">新規登録して入札</a><br/>'
					                +'<a href="/auction/users/login/'+value.id+'" class="btn btn-info">ログインして入札</a>'
						            +'</td></tr>');
	});
	$("#result").after("</table>")
}
function tableAttrOnLoad(data){
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
		var image_url = "";
		if(value.images.length == 0){
			image_url = "no_image.png";
		}else{
			$.each(value.images, function(key, img){
				image_url = img.image_url;
				if(img.main_image == 1){
					image_url = img.image_url;
				}
			});
		}// 空だったらno_image.png　あればURLに画像を設定、メインがあればそれを設定
		
		$('#result table').append('<tr class="product-info">'
	                   +'<td class="image"><img src="http://localhost/auction/webroot/upload_img/'+image_url+'"></td>'
	                   +'<td class="description">'
	                   +'商品名　   :  <a href="/auction/products/detail/'+value.id+'">'+value.product_name+'</a><br/>'
	                   +'出品者　   :  <a href="/auction/products/user/'+value.user.id+'">'+value.user.user_name+'</a><br/>'
	                   +'入札数　   : '+value.bids.length+'<br/>'
	                   +'終了時刻  : '+end_date.getFullYear()+'年'
	                                + end_date.getMonth()+1 +'月'
	                                + end_date.getDate() + "日　"
					   	            + end_date.getHours() + "時"
						            + end_date.getMinutes() + "分"+'<br/>'
						            +'<a href="/auction/users/register/'+value.id+'" class="btn btn-primary">新規登録して入札</a><br/>'
					                +'<a href="/auction/users/login/'+value.id+'" class="btn btn-info">ログインして入札</a>'
						            +'</td></tr>');
	});
	$("#result").after("</table>")
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