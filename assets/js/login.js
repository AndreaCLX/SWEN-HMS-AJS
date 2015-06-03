var $_GET = {};
document.location.search.replace(/\??(?:([^=]+)=([^&]*)&?)/g, function() {
    function decode(s) {
        return decodeURIComponent(s.split("+").join(" "));
    }
    $_GET[decode(arguments[1])] = decode(arguments[2]);
});

window.addEventListener("load", function() { window.scrollTo(0, 1); });

$(document).ready(function () {
	centerTop('.loginLoading');
	centerTop('.loginContainer');
	updateHeight();
	
	var step = 0;
	var footerQuotes = ["","Forget regret, or life is yours to miss","No other road, no other way","No Day But Today!","Manjusri Red Fox Scouts | iScout V3.0 "];
	
	$('.footer').click(function () {
		if(step == footerQuotes.length){
			step = 0;
		}
		$('.footer').fadeOut(250,function () {
			$('.footer').html(footerQuotes[step]);
		});
		$('.footer').fadeIn(250);
		step++;
	});
	
});

$(window).load(function() {
    updateHeight();
	
    $(".loginLoading").fadeOut(1000,function () {
		$({blurRadius: 0}).animate({blurRadius: 5}, {
        duration: 500,
        easing: 'linear',
        step: function() {
            console.log(this.blurRadius);
            $('.masterBackground').css({
                "-webkit-filter": "blur("+this.blurRadius+"px)",
                "filter": "blur("+this.blurRadius+"px)"
            });
        }
		});
		$(".loginContainer").fadeIn(2000);
		
	});
	centerTop('.loginLoading');
	centerTop('.loginContainer');
});
$(window).resize(function() {
    updateHeight();
	centerTop('.loginLoading');
	centerTop('.loginContainer');
});
$(window).scroll(function() {
    if ($(window).scrollTop() > 10) {
        $('.navbar').addClass('navbar-scrolled');
    } else {
        $('.navbar').removeClass('navbar-scrolled');
    }
});

function updateHeight() {
    $('.fullHeight').css('height', $(window).height() + 'px');
}


function scrollTo(target) {
    $(window).scrollTo(target, 500)
}

function centerTop(elm) {
    $(elm).css('top', (($(window).height() - $(elm).height()) / 2) + 'px');
    $(elm).css('left', (($(window).width() - $(elm).width()) / 2) + 'px');
}

function processLogin(){
	var username = $('#username').val();
    var password = $('#password').val();
	
	var gotChiBai = false;
	
	$('#username').attr('disabled','disabled');
	$('#password').attr('disabled','disabled');
	
	$('.button-submit-big').attr('disabled', 'disabled');
    $('.button-submit-big').val('Loading...');
    $('.button-submit-big').addClass('button-submit-disabled');
	
	if (username == '' || password == '') {
        $('.login-feedback').html('You do know your username and password needs to be filled in right?');
        $('.login-feedback').fadeIn(2000);
        $('#username').removeAttr('disabled');
        $('#password').removeAttr('disabled');
        $('.button-submit-big').removeAttr('disabled');
        $('.button-submit-big').removeClass('button-submit-disabled');
        $('.button-submit-big').val('Login!');
		
		var gotChiBai = true;
    }
	
	if(gotChiBai == false){
	
		//Use the current time to generate a seed
		var time = String(Math.round((new Date()).getTime() / 1000));
		var p = time.charCodeAt(7);
		
		var Usernamebytes = [];
		var pswbytes = [];
		
		//Encrypt the username bytes
		for (var i = 0; i < username.length; ++i){
			var byte_enc = Math.pow((username.charCodeAt(i)*p),2);
			Usernamebytes.push(byte_enc);
		}
		var n_str = Usernamebytes.join(',');
		
		//Encrypt the password bytes
		for (var i = 0; i < password.length; ++i){
			var byte_enc = Math.pow((password.charCodeAt(i)*p),2);
			pswbytes.push(byte_enc);
		}
		var p_str = pswbytes.join(',');
		
		//Parse the whole thing into a single string
		var str = 's='+base64_encode(n_str+'{rfs}'+p_str);
		
		//Send the information via AJAX
		$.ajax({
		
			type : 'POST',
			url : 'ajax_login.php',
			data : str,
			dataType: 'json',
			success : function(data){
				var success = data.success;
				
				if(success == 'true'){
					if ($_GET['action'] == "extend") {
						window.close();
					}
					if ($_GET['returnUrl']) {
						window.location = decodeURIComponent($_GET['returnUrl']);
					} else {
						window.location = 'index.php';
					}
				}else{
					$('.login-feedback').html(data.message);
                    $('.login-feedback').fadeIn(2000);
                    $('#username').removeAttr('disabled');
                    $('#password').removeAttr('disabled');
                    $('.button-submit-big').removeAttr('disabled');
                    $('.button-submit-big').removeClass('button-submit-disabled');
                    $('.button-submit-big').val('Login!');
					console.log(data);
				}
				
			},
			
			error: function(jqXHR, textStatus, errorThrown) {
				//$('.login-feedback').html(errorThrown);
				$('.login-feedback').html("Login Does Not Work Yet!");
                $('.login-feedback').fadeIn(2000);
                $('#username').removeAttr('disabled');
                $('#password').removeAttr('disabled');
                $('.button-submit-big').removeAttr('disabled');
                $('.button-submit-big').removeClass('button-submit-disabled');
                $('.button-submit-big').val('Login!');
				console.log(data);
            }
		
		});
		
	}
	
}

var keyStr = "ABCDEFGHIJKLMNOP" + "QRSTUVWXYZabcdef" + "ghijklmnopqrstuv" + "wxyz0123456789+/" + "=";

function base64_encode(input) {
    input = escape(input);
    var output = "";
    var chr1, chr2, chr3 = "";
    var enc1, enc2, enc3, enc4 = "";
    var i = 0;
    do {
        chr1 = input.charCodeAt(i++);
        chr2 = input.charCodeAt(i++);
        chr3 = input.charCodeAt(i++);
        enc1 = chr1 >> 2;
        enc2 = ((chr1 & 3) << 4) | (chr2 >> 4);
        enc3 = ((chr2 & 15) << 2) | (chr3 >> 6);
        enc4 = chr3 & 63;
        if (isNaN(chr2)) {
            enc3 = enc4 = 64;
        } else if (isNaN(chr3)) {
            enc4 = 64;
        }
        output = output + keyStr.charAt(enc1) + keyStr.charAt(enc2) + keyStr.charAt(enc3) + keyStr.charAt(enc4);
        chr1 = chr2 = chr3 = "";
        enc1 = enc2 = enc3 = enc4 = "";
    } while (i < input.length);
    return output;
}

function base64_decode(input) {
    var output = "";
    var chr1, chr2, chr3 = "";
    var enc1, enc2, enc3, enc4 = "";
    var i = 0;
    var base64test = /[^A-Za-z0-9\+\/\=]/g;
    if (base64test.exec(input)) {
        alert("There were invalid base64 characters in the input text.\n" + "Valid base64 characters are A-Z, a-z, 0-9, '+', '/',and '='\n" + "Expect errors in decoding.");
    }
    input = input.replace(/[^A-Za-z0-9\+\/\=]/g, "");
    do {
        enc1 = keyStr.indexOf(input.charAt(i++));
        enc2 = keyStr.indexOf(input.charAt(i++));
        enc3 = keyStr.indexOf(input.charAt(i++));
        enc4 = keyStr.indexOf(input.charAt(i++));
        chr1 = (enc1 << 2) | (enc2 >> 4);
        chr2 = ((enc2 & 15) << 4) | (enc3 >> 2);
        chr3 = ((enc3 & 3) << 6) | enc4;
        output = output + String.fromCharCode(chr1);
        if (enc3 != 64) {
            output = output + String.fromCharCode(chr2);
        }
        if (enc4 != 64) {
            output = output + String.fromCharCode(chr3);
        }
        chr1 = chr2 = chr3 = "";
        enc1 = enc2 = enc3 = enc4 = "";
    } while (i < input.length);
    return unescape(output);
}