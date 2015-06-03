<?php
require('assets/core/database.php');
?>
<!DOCTYPE HTML>
<html>
	<head>
		<title>New Booking | Delonix Regia Hotel Management System</title>
		
		<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
		<meta name="DC.rights" scheme="DCTERMS.URI" content="http://creativecommons.org/licenses/by-sa/4.0/deed.en_US/" />
		
		<link rel="stylesheet" type="text/css" href="assets/css/reset.css" />
		<link rel="stylesheet" type="text/css" href="assets/css/fonts.css" />
		<link rel="stylesheet" type="text/css" href="assets/css/bootstrap.min.css" />
		<link rel="stylesheet" type="text/css" href="assets/css/font-awesome.min.css" />
		<link rel="stylesheet" type="text/css" href="assets/css/bootstrap-timepicker.min.css" />
		<link rel="stylesheet" type="text/css" href="assets/jQueryUI/jquery-ui.min.css" />
		<link rel="stylesheet" type="text/css" href="assets/jQueryUI/jquery-ui.theme.min.css" />
		<link href='http://fonts.googleapis.com/css?family=Roboto+Slab:300,400|Roboto:100,400,300,700,900' rel='stylesheet' type='text/css'>
		<link rel="stylesheet" type="text/css" href="assets/css/delonix-admin-master.css?<?php echo rand(); ?>" />
		
		<link rel="shortcut icon" href="assets/images/favicon.png"/>
		<!--[if IE]->
		<link rel="shortcut icon" href="assets/images/favico.ico"/>
		<![endif]-->
		
		<script type="text/javascript" src="assets/js/jquery-1.11.2.min.js"></script>
		<script type="text/javascript" src="assets/js/bootstrap.min.js"></script>
		<script type="text/javascript" src="assets/jQueryUI/jquery-ui.min.js"></script>
		<script type="text/javascript" src="assets/js/autogrow.js"></script>
		<script type="text/javascript" src="assets/js/bootstrap-timepicker.js"></script>
		<script type="text/javascript" src="assets/js/menu.js?<?php echo rand(); ?>"></script>
		<script type="text/javascript" src="assets/js/jquery.creditCardValidator.js"></script>
		<script type="text/javascript" src="assets/js/scrollTo.js"></script>
		<script type="text/javascript" src="assets/js/delonix-admin-master.js?<?php echo rand(); ?>"></script>
		<script type="text/javascript">
			$(document).ready(function () {
				$('#late-checkout-input').timepicker({disableFocus: true,defaultTime:false});
			});
		</script>
	</head>
	
	<body>
		<div class="main-container">
			<div class="side-menu-container">
				<div class="side-menu-header">
					<div class="side-menu-header-logo">
					</div>
					<div class="side-menu-greeting">
						Welcome, {User.Name}!
					</div>
				</div>
				
				<div class="side-menu">
					<?php include('menu.php'); ?>
				</div>
			</div>
			
			<div class="main-content">
				<div class="main-content-header">
					<ul class="header-items header-left">
						<li>
							<button class="side-menu-toggle">
								<i class="fa fa-bars"></i>
							</button>
						</li>
						<li>
							<div class="page-title">
								New Booking
							</div>
						</li>
					</ul>
				</div>
				<?php
				$GuestID = @$_POST['GuestID'];
				if(!$GuestID){
				?>
				<div class="error">You are missing some required information please try again!</div>
				<?php 
				}else{
					$GuestID = mysqli_real_escape_string($db,@$_POST['GuestID']);
					$CheckInDate = mysqli_real_escape_string($db,@$_POST['CheckInDate']);
					$CheckOutDate = mysqli_real_escape_string($db,@$_POST['CheckOutDate']);
					$BedType = mysqli_real_escape_string($db,@$_POST['BedType']);
					$SmokingRoom = mysqli_real_escape_string($db,@$_POST['SmokingRoom']);
					$LateCheckOut = mysqli_real_escape_string($db,@$_POST['LateCheckOut']);
					$LateCheckOutTime = mysqli_real_escape_string($db,@$_POST['LateCheckOutTime']);
					$PaymentMethod = mysqli_real_escape_string($db,@$_POST['PaymentMethod']);
					$CreditCardName = mysqli_real_escape_string($db,@$_POST['CreditCardName']);
					$CreditCardNumber = mysqli_real_escape_string($db,@$_POST['CreditCardNumber']);
					$CreditCardType = mysqli_real_escape_string($db,@$_POST['CreditCardType']);
					$CreditCardCCV = mysqli_real_escape_string($db,@$_POST['CreditCardCCV']);
					$CreditCardExpMonth = mysqli_real_escape_string($db,@$_POST['CreditCardExpMonth']);
					$CreditCardExpYear = mysqli_real_escape_string($db,@$_POST['CreditCardExpYear']);
					
					if($LateCheckOut != 'Late Checkout'){
						$LateCheckOutTime = '0';
					}
					
					$additionalGuest = array();
					for($x = 0; $x < count($_POST['AdditionalName']); $x++){
						$additionalGuest[$x]["AdditionalGuestName"] = mysqli_real_escape_string($db,$_POST['AdditionalName'][$x]);
						$additionalGuest[$x]["AdditionalGuestContact"] = mysqli_real_escape_string($db,$_POST['AdditionalNumber'][$x]);
					}
					
					$AddtionalGuestCompiled = json_encode($additionalGuest);
					
					$PaymentAdditionalInfo = array();
					$PaymentAdditionalInfo["CreditCardName"] = $CreditCardName;
					$PaymentAdditionalInfo["CreditCardNumber"] = $CreditCardNumber;
					$PaymentAdditionalInfo["CreditCardType"] = $CreditCardType;
					$PaymentAdditionalInfo["CreditCardCCV"] = $CreditCardCCV;
					$PaymentAdditionalInfo["CreditCardExpMonth"] = $CreditCardExpMonth;
					$PaymentAdditionalInfo["CreditCardExpYear"] = $CreditCardExpYear;
					
					$PaymentAdditionalInfo = json_encode($PaymentAdditionalInfo);
					
					$query = "INSERT INTO `booking` (`GuestID`,`BedType`,`SmokingRoom`,`AdditionalGuests`,`PaymentMethod`,`PaymentAdditionalInfo`,`CheckInDate` , `CheckOutDate`,`CheckOutTime`,`Status`) VALUES ('$GuestID','$BedType','$SmokingRoom','$AddtionalGuestCompiled','$PaymentMethod','$PaymentAdditionalInfo','$CheckInDate','$CheckOutDate','$LateCheckOutTime','Confirmed')";
					
					if(mysqli_query($db,$query)){
						echo "Success!";
						echo '<script>window.location="booking-view.php"</script>';
					}else{
						echo "Error!<br /><br />".mysqli_error($db)."<br /><br />Query: ".$query;
					}
					
				}
				?>
				
			</div>
		</div> 
	</body>
</html>