$(document).ready(function () {
	
	var lastScrollTop = 0;
	$('.main-content').scroll(function(event){
	   var st = $(this).scrollTop();
	   if (st > lastScrollTop){
		   $('.material-side-button').addClass('sb-button-hidden');
		   if($('.lv-header').position().top > st){
			   
		   }
	   } else {
		    $('.material-side-button').removeClass('sb-button-hidden');
	   }
	   lastScrollTop = st;
	});
	
	/*$('img').each(function () {
		$(this).attr('src','assets/images/P04136.jpg');
	});*/
	
	var selectedCount = 0;
	
	$('.lv-photo-container').click(function () {
		if($(this).find('.lv-photo-checkbox-container').css('display') == 'none' && !$(this).find('.lv-photo-checkbox-container').attr('data-ev-pause')){
			$(this).find('.lv-photo-checkbox-container').fadeIn(200);
			$(this).parent().addClass('lv-selected');
			if($('.lv-title-actions').css('display') == 'none'){
				$('.lv-title-actions').fadeIn(200);
				$('.lv-header').addClass('lv-header-actions-active');
				$('.lv-title').css('display','none');
			}
			selectedCount++;
			$('.lv-title-actions-item').html(selectedCount);
		}
		
	});
	
	$('.lv-photo-checkbox-container').click(function() {
		$(this).attr('data-ev-pause','true');
		$(this).fadeOut(200,function () {
			$(this).removeAttr('data-ev-pause');
		});
		$(this).parent().parent().removeClass('lv-selected');
		
		selectedCount--;
		if(selectedCount<=0){
			selectedCount = 0;
			$('.lv-title-actions').fadeOut(200);
			$('.lv-header').removeClass('lv-header-actions-active');
			$('.lv-title').css('display','block');
		}else{
			$('.lv-title-actions-item').html(selectedCount);
		}
	});
	
});