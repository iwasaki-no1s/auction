$(function(){
	$('#max').change(priceRequest);
});


function priceRequest(event){
	productRegisterFormInit();
	if($('#max').val() <= $('#start').val()){
		adminPriceCheckerError(result);
		showValidationMessage();
		return false;
	}
	return true;
}

function productRegisterFormInit(){
	$('#message').remove();
	$('.help-block').remove();
	$('.form-group').removeClass('has-error');
}

function adminPriceCheckerError(){
	showErrorMessage('即決価格はスタート価格より高くしてください')
}

function　showErrorMessage(message){
	var tag = '<div id="message" class="alert alert-danger">';
	tag +=message;
	tag +='</div>';
	$('.main').prepend(tag);
}
function showValidationMessage(errors){
	for (key in errors){
		var obj = $("[max_price='"+key+"']");
		obj.parent().addClass('has-error');
		var field = error[key];
		for (var value in field){
			var tag='<div class="help-block">'+field[value]+'</div>';
			obj.after(tag);
		}
	}
}