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
		<link rel="stylesheet" type="text/css" href="assets/css/material-design-iconic-font.min.css" />lo
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
				<div class="page-content">
					<script>
						$(document).ready(function () {
							$('textarea').autogrow();
						});
					</script>
					<div class="card" >
						<div class="card-header" style="background-color:#1D5902">
							<div class="card-title">
								<i class="md md-verified-user"></i> Staff Basic Information
							</div>
							<div class="card-subtitle">
								
							</div>
						</div>
						<div class="card-main-content">
							
							<form action="staff-insert.php" method="POST" class="BookingForm">
								<div class="material-input material-input-floating-lbl required-field" data-validator-error="Name is a Required Field!">
									<input type="text" name="Name" />
									<label class="placeholder">Name</label>
								</div>
								
								<div class="material-input material-input-floating-lbl required-field" data-validator-error="Email is a Required Field!">
									<input type="text" name="Email" />
									<label class="placeholder">Email</label>
								</div>
								
								<div class="material-input material-input-floating-lbl required-field" data-validator-error="Phone Number is a Required Field!">
									<input type="text" name="PhoneNumber" />
									<label class="placeholder">Phone Number</label>
								</div>
								
								<div class="material-input material-input-floating-lbl required-field" data-validator-error="Bank Account is a Required Field!">
									<input type="text" name="BankAccount" />
									<label class="placeholder">Bank Account</label>
								</div>
								
								<div class="material-input required-field" data-validator-error="Room Location is a Required Field!">
									<label class="placeholder-fixed">Address</label>
									<textarea class="autogrow" name="Address"></textarea>
								</div>
								
								<div class="material-input material-input-floating-lbl required-field" data-validator-error="Postal Code is a Required Field!">
									<input type="text" name="PostalCode" />
									<label class="placeholder">Postal Code</label>
								</div>
								
							</form>
							
						</div>
					</div>
					
					<div class="form-submit-menu">
						<input type="button" onClick="validateForm('.BookingForm');" value="Create Staff" class="btn btn-square btn-success">
					</div>
					
				</div>
			</div>
		</div> 
	</body>
</html>