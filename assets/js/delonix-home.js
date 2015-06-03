$(document).ready(function() {
	$('#date-check-in').datepicker({minDate: 0,"dateFormat": "d-MM-y"});
	$('#date-check-out').datepicker({minDate: 0,"dateFormat": "d-MM-y"});
	
	$('#date-check-in').change(function () {
		var checkInDate = new Date($('#date-check-in').val());
		var now = new Date();
		
		var timeDiff = Math.abs(checkInDate.getTime() - now.getTime());
		var dates = Math.ceil(timeDiff / (1000 * 3600 * 24)); 
		
		//console.log(dates);
		
		$('#date-check-out').datepicker("option","minDate",dates);
	});
	
	$('#date-check-out').change(function () {
		var checkInDate = new Date($('#date-check-in').val());
		var checkOutDate = new Date($('#date-check-out').val());
		
		var timeDiff = Math.abs(checkOutDate.getTime() - checkInDate.getTime());
		var dates = Math.ceil(timeDiff / (1000 * 3600 * 24)); 
		
		var return_ = dates+" Night";
		if(dates>1){
			return_ += "s";
		}
		
		$('#date-nights').html(return_);
	});

	
	
	moveFooter();
});	

$(window).load(function() {
    moveFooter();
});

$(window).resize(function() {
    moveFooter();
});

function moveFooter(){
	$('#slides').css('width',$(window).width());	
	$('#header-ss').css('width',$(window).width());	
}
