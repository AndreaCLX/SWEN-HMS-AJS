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
								Staff Management 
							</div>
						</li>
					</ul>
				</div>
				<div class="page-content">
				<?php 
				$bookingID = @$_GET['id'];
				if(!$bookingID){
				?>
					<div class="list-view-container lv-bordered">
						<div class="lv-header lv-header-fixed">
							<div class="lv-title">
								View Bookings
							</div>
							<div class="lv-title-actions">
								<div class="lv-pull-left">
									<span class="lv-title-actions-item">0</span>
								</div>
								<div class="lv-pull-right">
									<button class="lv-button-action"><i class="md md-delete"></i></button>
								</div>
							</div>
						</div>
						
						<div class="lv-main-container">
							<?php
							$query = mysqli_query($db,"SELECT * FROM `booking` ORDER BY `BookingID` DESC ");
							while($booking = mysqli_fetch_assoc($query)){
							$GuestID = $booking['GuestID'];
							$query1 = mysqli_query($db,"SELECT * FROM `guest` WHERE `GuestID` = '$GuestID'");
							$guest = mysqli_fetch_assoc($query1);
							?>
							<div class="lv-item">
								<div class="lv-item-content">
									<div class="lv-item-title-nowrap lv-title-larger">
										<?php echo $guest['Name'].' '.'{'.$booking['CheckInDate'].' - '.$booking['CheckOutDate'].'}'; ?>
									</div>
									<ul class="lv-meta">
										<li>
											Status: <?php echo $booking['Status']; ?>
										</li>
									</ul>
									
									<div class="lv-item-menu">
										<a href data-toggle="dropdown">
											<i class="fa fa-ellipsis-v"></i>
										</a>
										
										<ul class="lv-dropdown dropdown-menu dropdown-menu-right">
											<?php if($booking['Status'] == "Checked In"){ ?>
											<li><a href="check-out.php?id=<?php echo $booking['BookingID'] ?>">Check Out</a></li>
											<li><a href="booking-edit.php?id=<?php echo $booking['BookingID'] ?>">Edit Booking</a></li>
											<?php }elseif($booking['Status'] == "Confirmed"){ ?>
											<li><a href="check-in.php?id=<?php echo $booking['BookingID'] ?>">Check In</a></li>
											<li><a href="booking-edit.php?id=<?php echo $booking['BookingID'] ?>">Edit Booking</a></li>
											<li><a href="booking-cancel.php?id=<?php echo $booking['BookingID'] ?>">Edit Booking</a></li>
											<?php }elseif($booking['Status'] == "Invoiced"){ ?>
											<li><a href="invoice.php?action=view&BookingID=<?php echo $booking['BookingID'] ?>">View Invoice</a></li>
											<?php } ?>
										</ul>
									</div>
									
								</div>
							</div>
								<?php
								}
								?>
							
						</div>
					</div>
					<?php } ?>
					</div>
				</div>
			</div>
			
		</div> 
		<script type="text/javascript" src="assets/js/delonix-admin-master.js?<?php echo rand(); ?>"></script>
	</body>
</html>