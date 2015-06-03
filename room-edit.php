<?php
require('assets/core/database.php');
?>
<!DOCTYPE HTML>
<html>
	<head>
		<title>{page.title} | Delonix Regia Hotel Management System</title>
		
		<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
		<meta name="DC.rights" scheme="DCTERMS.URI" content="http://creativecommons.org/licenses/by-sa/4.0/deed.en_US/" />
		
		<link rel="stylesheet" type="text/css" href="assets/css/reset.css" />
		<link rel="stylesheet" type="text/css" href="assets/css/fonts.css" />
		<link rel="stylesheet" type="text/css" href="assets/css/bootstrap.min.css" />
		<link rel="stylesheet" type="text/css" href="assets/css/font-awesome.min.css" />
		<link rel="stylesheet" type="text/css" href="assets/css/material-design-iconic-font.min.css" />
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
		<script type="text/javascript" src="assets/js/scrollTo.js"></script>
		<script type="text/javascript" src="assets/js/menu.js?<?php echo rand(); ?>"></script>
		<script type="text/javascript" src="assets/js/delonix-admin-master.js?<?php echo rand(); ?>"></script>
			<script type="text/javascript" src="assets/js/delonix-admin-plus-button.js?<?php echo rand(); ?>"></script>
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
						<a href="#meeting-menu" class="list-group-item" data-toggle="collapse"  data-parent="#main-menu">Staff Management</a>
						<div class="collapse" id="meeting-menu">
							<a href="meeting.php" class="list-group-item list-group-sub-menu" data-parent="#member-menu">View Meeting Plans</a>
							<a href="meeting.php?action=new" class="list-group-item list-group-sub-menu" data-parent="#member-menu">Create Meeting Plan</a>
						</div>
						<a href="#meeting-menu" class="list-group-item" data-toggle="collapse"  data-parent="#main-menu">Bookings</a>
						<div class="collapse" id="meeting-menu">
							<a href="meeting.php" class="list-group-item list-group-sub-menu" data-parent="#member-menu">View Meeting Plans</a>
							<a href="meeting.php?action=new" class="list-group-item list-group-sub-menu" data-parent="#member-menu">Create Meeting Plan</a>
						</div>
						<a href="#meeting-menu" class="list-group-item" data-toggle="collapse"  data-parent="#main-menu">Reporting</a>
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
								Edit Room
							</div>
						</li>
					</ul>
				</div>
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
				<?php
				$RoomID = @$_GET['RoomID'];
				if(!$RoomID){
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
				$query = mysqli_query($db,"SELECT * FROM `room` WHERE `RoomID` = '$RoomID'");
				$room = mysqli_fetch_assoc($query);
				?>
				<div class="card">
					<div class="card-header">
						<div class="card-title">
							<i class="fa fa-bed"></i> Add Room
						</div>
						<div class="card-subtitle">
							
						</div>
					</div>
					<div class="card-main-content">
						<form action="room-update.php?RoomID=<?php echo $RoomID; ?>" method="POST" class="BookingForm">
							<div class="material-input material-input-floating-lbl required-field material-input-floating-lbl-active" data-validator-error="Room Type is a Required Field!">
								<input type="text" name="RoomType" value="<?php echo $room['Type']; ?>"/>
								<label class="placeholder">Room Type</label>
							</div>
							
							<div class="material-input material-input-floating-lbl required-field material-input-floating-lbl-active" data-validator-error="Room Location is a Required Field!">
								<input type="text" name="RoomLocation" value="<?php echo $room['Location']; ?>"/>
								<label class="placeholder">Room Location</label>
							</div>
							
							<div class="material-input material-input-floating-lbl required-field material-input-floating-lbl-active" data-validator-error="Room Rate is a Required Field!">
								<input type="text" class="number-only" name="RoomRate" value="<?php echo $room['Rate']; ?>"/>
								<label class="placeholder">Room Rate</label>
							</div>
							<div class="form-submit-menu">
								<input type="button" onClick="validateForm('.BookingForm');" value="Update Room" class="btn btn-square btn-success">
							</div>
						</form>
					</div>
				</div>
				</div>
				<?php } ?>
			</div>
			
		</div> 
		<script type="text/javascript" src="assets/js/delonix-admin-master.js?<?php echo rand(); ?>"></script>
	</body>
</html>