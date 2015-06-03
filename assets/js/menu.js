var menuClosed = false;
var clickSide = false;
//var mobileTest = /Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent);
var mobileTest = ($(window).width() >= 767 ? false : true);

$(document).ready(function() {
	
	console.log("Mobile Test : "+mobileTest);
	
	if (mobileTest) {
        menuClosed = true;
        $('.main-content').css('left', '0px');
    } else {

    }

    window.setTimeout(function() {
        $('.main-content').addClass('main-content-animator');
    }, 1);
	
	$('.page-content').click(function() {
		if(menuClosed == false && mobileTest == true && clickSide == true){
            menuClosed = true;
            $('.main-content').css('left', '0px');
            $('.main-content').delay(500).css('width', '100%');
            console.log('close');
			
			if(mobileTest){
				clickSide = false;
			}
		}
	});

    $('.side-menu-toggle').click(function() {
        if (menuClosed == true) {
			//Menu is opened;
            menuClosed = false;
            $('.main-content').css('left', '200px');
            /*window.setTimeout(function () {
				$('.main-content').css('width','calc(100% - 200px)')
			 },500)*/
            $('.main-content').css('width', 'calc(100% - 200px)');
            console.log('open');
			
			if(mobileTest){
				$('.main-container').css('overflow','hidden');
				clickSide = true;
			}

        } else if (menuClosed == false) {
			//Menu is closed
            menuClosed = true;
            $('.main-content').css('left', '0px');
            $('.main-content').delay(500).css('width', '100%');
            console.log('close');
			
			if(mobileTest){
				clickSide = false;
			}
        }
    });
});

function closeMenu(){
	
}


$(window).resize(function () {
	mobileTest = ($(window).width() >= 767 ? false : true);
	console.log("Mobile Test : "+mobileTest);
});
 