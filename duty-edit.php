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
					<?php include('menu.php'); ?>
				</div>
			</div>
			
			<div class="main-content">
				
				<?php
				$DutyID = @$_GET['DutyID'];
				if(!$DutyID){
				?>
				<div class="m-overlay doc-full-height">
					<div class="error-overlay-container">
						<div class="eo-close"></div>
						<div class="eo-header">
							<i class="fa fa-exclamation-circle icon-header"></i><br />
							Error Occurred in Data Stream!
						</div>
						<div class="eo-body">
							An error has occurred while parsing the information please try again!
						</div>
						<div class="eo-footer">
							
						</div>
					</div>
				</div>
				<?php
				}else{
				$query = mysqli_query($db,"SELECT * FROM `duty` WHERE `DutyID` = '$DutyID'");
				$dr = mysqli_fetch_assoc($query);
				?>
			
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
							<small><a href="javascript:return false;" onClick="OverrideValidator()">Override Validator (Testing Only)</a></small>
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
								<i class="md md-verified-user"></i> Duty Information
							</div>
							<div class="card-subtitle">
								
							</div>
						</div>
						<div class="card-main-content">
							
							<form action="duty-update.php?DutyID=<?php echo $DutyID; ?>" method="POST" class="BookingForm">
								
								<div class="material-inputrequired-field" data-validator-error="Name is a Required Field!">
									<label class="placeholder-fixed">Staff Name</label>
									<div class="select-style">
										<select name="StaffID" class="StaffID">
											<?php
											$query = mysqli_query($db,"SELECT * FROM `staff` ORDER BY `Username` ASC");
											while($s = mysqli_fetch_assoc($query)){
												echo '<option value="'.$s['StaffID'].'"';
												if($s['StaffID'] == $dr['StaffID']){
													echo 'selected="selected"';
												}
												echo '>'.$s['StaffID'].'. '.$s['Username'].'</option>';
											}
											?>
										</select>
									</div>
								</div>
								
								<div class="material-inputrequired-field" data-validator-error="Name is a Required Field!">
									<label class="placeholder-fixed">Room Assigned</label>
									<div class="select-style">
										<select name="RoomID" class="RoomID">
											<?php
											$query = mysqli_query($db,"SELECT * FROM `room` ORDER BY `Location` ASC");
											while($r = mysqli_fetch_assoc($query)){
												echo '<option value="'.$r['RoomID'].'">'.$r['Location'].'</option>';
											}
											?>
										</select>
									</div>
								</div>
								
								<div class="material-input material-input-floating-lbl-active material-input-floating-lbl required-field" data-validator-error="Duty Date is a Required Field!">
									<input type="text" name="Schedule" class="date-picker" id="duty-date" value="<?php echo $dr['Schedule']; ?>"/>
									<label class="placeholder">Date</label>
								</div>
								
								<div class="material-input material-input-floating-lbl-active material-input-floating-lbl required-field" data-validator-error="Duty Type is a Required Field!">
									<input type="text" name="DutyType" id="duty-date" value="<?php echo $dr['Type']; ?>"/>
									<label class="placeholder">Duty Type</label>
								</div>
								
							</form>
							
						</div>
					</div>
					
					<div class="form-submit-menu">
						<input type="button" onClick="validateForm('.BookingForm');" value="Update Duty" class="btn btn-square btn-success">
					</div>
					
				</div>
				<?php } ?>
			</div>
		</div> 
	</body>
</html>