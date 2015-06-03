$(document).ready(function() {
	updateHeight();
	$('.expending-input').autogrow();
	
	$('.material-input-floating-lbl>input').focusin(function () {
		$(this).parent().addClass('material-input-floating-lbl-active');
	});
	
	$('.material-input-floating-lbl>textarea').focusin(function () {
		$(this).parent().addClass('material-input-floating-lbl-active');
	});
	
	$('.material-input-floating-lbl>input').focusout(function () {
		//$(this).parent().removeClass('material-input-floating-lbl-active');
		if($(this).val() == '' && !$(this).hasClass('date-picker')){
			$(this).parent().removeClass('material-input-floating-lbl-active');
		}
	});
	
	$('.material-input-floating-lbl>textarea').focusout(function () {
		//$(this).parent().removeClass('material-input-floating-lbl-active');
		if($(this).val() == ''){
			$(this).parent().removeClass('material-input-floating-lbl-active');
		}
	});
	
	$('.image-select-card').click(function () {
		$('.form-triggers').css('display','none');
		$(this).parent().parent().parent().find('.image-select-card-selected').removeClass('image-select-card-selected');
		$(this).addClass('image-select-card-selected');
		if($(this).attr('data-trigger-switch')){
			$($(this).attr('data-trigger-switch')).css('display','block');
		}
	});
	
	$('.material-input-floating-lbl>.placeholder').click(function () {
		$(this).parent().find('input').focus();
		$(this).parent().find('textarea').focus();
	});
	
	$('.select-switch').click(function () {
		if($(this).hasClass('switch-on')){
			$(this).removeClass('switch-on');
			$(this).addClass('switch-off');
			if($(this).attr('data-trigger-switch')){
				showInput(this);
			}
		}else{
			$(this).removeClass('switch-off');
			$(this).addClass('switch-on');
			if($(this).attr('data-trigger-switch')){
				showInput(this);
			}

		}
	});
	
	$('.eo-close-btn').click(function () {
		$('.m-overlay').fadeOut(200,function () {
			$('.m-overlay').addClass('m-hidden');
		});
		return false;
	});
});

$(document).ready(function() {
	updateHeight();
});

$(window).resize(function() {
    updateHeight();
});

function updateHeight() {
    $('.full-height').css('min-height', $(window).height() + 'px');
	$('.doc-full-height').css('min-height', $('.page-content').height() + 'px');
}

$('body').on("keyup",".number-only",function () {
	console.log('num');
	var removedText = $(this).val().replace(/[^0-9\.]/g, ''); 
	$(this).val(removedText);	
});


function validateForm(form){
	var errors = 0;
	$('.eo-list').html(' ');
	$('.required-field').removeClass('validator-required');
	$('.required-field').each(function () {
		console.log(this);
		if($(this).find('input').val() == ''||$(this).hasClass('force-validator-fail')){
			console.log("Looking at: "+this);
			if($(this).find('input').val() == ''||$(this).find('textarea').val() == ''){
				$(this).addClass('validator-required');
			}
			$('.eo-list').append((errors + 1)+". "+$(this).attr('data-validator-error')+"<br />");
			errors++;
		}
	});
	if(errors != 0){
			
		$('.validator-error-count').html(errors);
		$('.m-overlay').fadeIn(200,function () {
			//scrollTo('.m-overlay',100);
		});
		$('.m-overlay').removeClass('m-hidden');
	}else{
		$(form).submit();
	}
	
	return false;
}

function OverrideValidator(){
	$('.required-field').removeClass('required-field');
	alert('Validator Overritten Please Submit the Form again!');
	return false;
}

function showInput(element){
	var target = $(element).attr('data-trigger-switch');
	if($(target).css("display") == 'none'){
		$(target).css("display","block");
	}else{
		$(target).css("display","none");
	}
}

function scrollTo(target,time) {
    $('.main-content').scrollTo(target, time)
}