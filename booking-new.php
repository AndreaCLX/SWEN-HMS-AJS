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
					<nav class="main-nav list-group panel" id="main-menu">
						<a href="#" class="list-group-item" data-parent="#main-menu">Dashboard</a>
						<a href="#meeting-menu" class="list-group-item" data-toggle="collapse"  data-parent="#main-menu">Meeting Plan</a>
						<div class="collapse" id="meeting-menu">
							<a href="meeting.php" class="list-group-item list-group-sub-menu" data-parent="#member-menu">View Meeting Plans</a>
							<a href="meeting.php?action=new" class="list-group-item list-group-sub-menu" data-parent="#member-menu">Create Meeting Plan</a>
						</div>
					</nav>
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
				$GuestID = @$_GET['GuestID'];
				if(!$GuestID){
				?>
				
				<div class="m-overlay">
					<div class="m-overlay-items">
						<div class="mo-container">
							<div class="mo-title">Select A Guest</div>
							<div class="list-view-container lv-bordered">
							<div class="lv-main-container">
								<?php
								$guestQuery = "SELECT * FROM `guest` ORDER BY `Name` ASC";
								$query = mysqli_query($db,$guestQuery);
								while($guest = mysqli_fetch_assoc($query)){
								?>
								<a href="booking-new.php?GuestID=<?php echo $guest['GuestID']; ?>">
								<div class="lv-item">	
									<div class="lv-item-content">
										<div class="lv-item-title-nowrap">
											<?php echo $guest['Name']; ?>
										</div>
										<ul class="lv-meta">
											<li>
												Email: <?php echo $guest['Email']; ?>
											</li>
											<li>
												Country: <?php echo $guest['Country']; ?>
											</li>
										</ul>
									</div>
								</div></a>
									<?php } ?>
								
							</div>
						</div>
						</div>
					</div>
				</div>
				<?php
				}else{
				$guest = mysqli_fetch_assoc(mysqli_query($db,"SELECT * FROM `guest` WHERE `GuestID` = '$GuestID'"));
				?>
				<script>
					var adultTemplate = "";
					var childrenTemplate = "";
					
					$(document).ready(function () {
					
						adultTemplate = "<tr class=\"contact-template contact-table\">"+$('.contact-template-adult').html()+"</tr>";
						console.log(adultTemplate);
						
						childrenTemplate = "<tr class=\"contact-template contact-table\">"+$('.cost-template-children').html()+"</tr>";
						
						$('#date-check-in').datepicker({
							minDate: 0,
							"dateFormat": "yy-mm-dd"
						});
						$('#date-check-out').datepicker({
							minDate: 0,
							"dateFormat": "yy-mm-dd"
						});

						$('#date-check-in').change(function() {
							var checkInDate = new Date($('#date-check-in').val());
							var now = new Date();

							var timeDiff = Math.abs(checkInDate.getTime() - now.getTime());
							var dates = Math.ceil(timeDiff / (1000 * 3600 * 24));

							//console.log(dates);

							$('#date-check-out').datepicker("option", "minDate", dates);
						});
						
						$('.credit-card-validator').validateCreditCard(function (result) {
							console.log(result.luhn_valid);
							$(this).parent().removeClass('validator-invalid');
							$(this).parent().removeClass('validator-valid');
							
							if(result.luhn_valid && result.length_valid){
								$(this).parent().addClass('validator-valid');
								$(this).parent().find('.CreditCardType').val(result.card_type.name);
							}else{
								$(this).parent().addClass('validator-invalid');
							}
						});
					});
					
					function addAdult(){
						$('.contact-adult').append(adultTemplate);
					}
					
					function removeAdult(t){
						$(t).parent().parent().remove();
						return false;
					}
				</script>
				<form action="booking-insert.php" method="POST" class="BookingForm">
				<div class="page-content">
				
					<div class="m-overlay doc-full-height m-hidden">
						<div class="error-overlay-container">
							<div class="eo-header">
								<div class="eo-close"><a href class="eo-close-btn"><i class="fa fa-close"></i></a></div>
								<i class="fa fa-exclamation-circle icon-header"></i><br />
								Validation Errors Has Occurred!
							</div>
							<div class="eo-body">
								<div class="eo-section-title"><span class="validator-error-count">{Number}</span> validation errors has occured in this form.</div>
								The following must be fixed before submitting the form:<br />
								<ul class="eo-list">
									<li>Check in Date is a required field!</li>
								</ul>
							</div>
							<div class="eo-footer">
								
							</div>
						</div>
					</div>
				
					<div class="card card-orange">
						<div class="card-header">
							<div class="card-title">
								<i class="fa fa-male"></i><i class="fa fa-female"></i> Guests Information
							</div>
							<div class="card-subtitle">
								Information About the Guest
							</div>
						</div>
						
						<div class="card-main-content">
							
							<div class="material-input material-input-floating-lbl material-input-floating-lbl-active">
								<input type="text" name="text" readonly="readonly" value="<?php echo $guest['Name']; ?>"/>
								<input type="hidden" name="GuestID" value="<?php echo $guest['GuestID']; ?>" />
								<label class="placeholder"><i class="fa fa-male"></i><i class="fa fa-female"></i> Guest Name</label>
							</div>
							
							<a href="booking-new.php" class="btn btn-warning btn-square">Change</a>
							
						</div>
					</div>
					
					<div class="card">
						<div class="card-header">
							<div class="card-title">
								<i class="fa fa-bed"></i> Booking Information
							</div>
							<div class="card-subtitle">
								Basic Information About The Stay
							</div>
						</div>
						<div class="card-main-content">
							
							<div class="material-input material-input-floating-lbl required-field" data-validator-error="Check In Date is a Required Field!">
								<input type="text" class="date-picker" id="date-check-in" name="CheckInDate" />
								<label class="placeholder"><i class="fa fa-calendar"></i> Check In Date</label>
							</div>
							
							<div class="material-input material-input-floating-lbl required-field" data-validator-error="Check Out Date is a Required Field!">
								<input type="text" class="date-picker" id="date-check-out" name="CheckOutDate" />
								<label class="placeholder"><i class="fa fa-calendar"></i> Check Out Date</label>
							</div>
							
							<ul class="input-list">
								<li>
									<div class="material-input">
										<label class="placeholder-fixed"><i class="fa fa-bed"></i> Bed Type</label><br />
										<div class="select-style">
											<select name="BedType" class="select">
												<option value="Queen Bed">Queen Bed</option>
												<option value="King Bed">King Bed</option>
											</select>
										</div>
									</div>
								</li>
								<li>
									<div class="material-input">
										
										<label class="placeholder-fixed"><i class="smoking-icon"></i> Smoking Room</label>
										<input type="checkbox" id="SmokingRoom" name="SmokingRoom" value="Smoking Room" style="display:none;"/><br />
										<div class="input-switch">
											<label for="SmokingRoom" class="select-switch switch-off switch-pink"></label>
										</div>
									</div>
								</li>
							</ul>
							
							<ul class="input-list">
								<li>
									<div class="material-input" height="height:46px;">
										<input type="checkbox" id="LateCheckOut" name="LateCheckOut" value="Late Checkout" style="display:none;"/>
										<label class="placeholder-fixed inline-placeholder"><i class="fa fa-clock-o"></i> Late Checkout?</label>
										<div class="input-switch inline-switch">
											<label for="LateCheckOut" class="select-switch switch-off" data-trigger-switch="#late-checkout"></label>
										</div>
									</div>
								</li>
								<li>
									<div class="material-input" id="late-checkout" style="display:none;">
										<label class="placeholder-fixed">Checkout Time</label>
										<input type="text" name="LateCheckOutTime" id="late-checkout-input"  value="12:00AM"/>
									</div>
								</li>
							</ul>
						</div>
					</div>
					
					<div class="card card-gold">
						<div class="card-header">
							<div class="card-title">
								<i class="fa fa-credit-card"></i> Payment Information
							</div>
							<div class="card-subtitle">
								
							</div>
						</div>
						<div class="card-main-content">
							<input type="radio" id="PaymentMethodCash" name="PaymentMethod" value="Cash" style="display:none;" />
							<input type="radio" id="PaymentMethodCredit" name="PaymentMethod" value="Credit Card" style="display:none;"/>
							<div class="image-select">
								<ul>
									<li>
										<label for="PaymentMethodCash">
										<div class="image-select-card">
											
											<div class="image-select-image">
												$
											</div>
											<div class="image-select-description">
												Cash
											</div>
										</div>
										</label>
									</li>
									<li>
										<label for="PaymentMethodCredit">
										<div class="image-select-card" data-trigger-switch="#credit-card-form">
											<div class="image-select-image">
												<i class="fa fa-credit-card"></i>
											</div>
											<div class="image-select-description">
												Credit Card
											</div>
										</div>
										</label>
									</li>
								</ul>
							</div>
							
							<div id="credit-card-form" class="form-triggers">
								<div class="material-input material-input-floating-lbl">
									<input type="text" name="CreditCardName" />
									<label class="placeholder">Name on Card</label>
								</div>
								
								<div class="material-input material-input-floating-lbl">
									<input type="text" name="CreditCardNumber" class="credit-card-validator"/>
									<input type="hidden" class="CreditCardType" name="CreditCardType" value=""/>
									<label class="placeholder">Card Number</label>
								</div>
								
								<div class="material-input material-input-floating-lbl">
									<input type="text" name="CreditCardCCV" />
									<label class="placeholder">Card Validation Value (CVV)</label>
								</div>
								
								<div class="material-input">
									<label class="placeholder-fixed">Card Expiry Number</label><br />
									<div class="select-style">
										<select name="CreditCardExpMonth" class="CreditCardExpMonth">
											<option value="">Month</option>
											<option value="1">January</option>
											<option value="2">February</option>
											<option value="3">March</option>
										</select>
									</div>
									<div class="select-style">
										<select name="CreditCardExpYear" class="select" class="CreditCardExpYear">
											<option value="">Year</option>
											<option value="2016">2016</option>
										</select>
									</div>
								</div>
							</div>
							
						</div>
					</div>
					
					<div class="card card-teal">
						<div class="card-header">
							<div class="card-title">
								<i class="fa fa-plus"></i> Additional Guests
							</div>
							<div class="card-subtitle">
						
							</div>
						</div>
						
						<div class="card-main-content">
							<table class="guests-adult-table table table-stripped">
								<thead>
									<tr>
										<td>Name</td>
										<td></td>
										<td>Contact Number</td>
										<td>
											
										</td>
									</tr>
								</thead>
								<tbody class="contact-adult">
									<tr class="contact-template-adult contact-table">
										<td>
											<input type="text" name="AdditionalName[]" />
										</td>
										<td>
										</td>
										<td>
											<input type="text" name="AdditionalNumber[]" />
										</td>
										<td>
											<button class="contact-table-delete-btn" onclick="removeAdult(this);" style="padding: 1px 1px 1px 1px;"><i class="fa fa-times	"></i></button>
										</td>
									</tr>
									
								</tbody>
							</table>
							<button onclick="addAdult();return false;" class="btn btn-info btn-square">Add Guest </button>
							
							<br /><br />							
						</div>
					</div>
					
					<div class="form-submit-menu">
						<input type="button" onClick="validateForm('.BookingForm');" value="Create Booking" class="btn btn-square btn-success">
					</div>
					
				</div>
				</form>
				<?php } ?>
			</div>
		</div> 
	</body>
</html>