$(function(){
	$('#max').change(priceRequest);
});


function priceRequest(event){
	productRegisterFormInit();
	if($('#max').val() <= $('#start').val()){
		adminPriceCheckerError();
		//showValidationMessage();
		var obj = $("[name=max_price]");
		obj.parent().addClass('has-error');
		var tag='<div class="help-block">即決価格はスタート価格より高くしてください</div>';
		obj.after(tag);
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
		var obj = $("[name='"+key+"']");
		obj.parent().addClass('has-error');
		var field = error[key];
		for (var value in field){
			var tag='<div class="help-block">'+field[value]+'</div>';
			obj.after(tag);
		}
	}
}