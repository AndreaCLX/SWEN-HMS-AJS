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
					$staffID = @$_GET['StaffID'];
					$staffQuery = mysqli_query($db,"SELECT * FROM `staff` WHERE `StaffID` = '$staffID'");
					$staff = mysqli_fetch_assoc($staffQuery);
					
					$dutyQuery = mysqli_query($db,"SELECT * FROM `duty` WHERE `StaffID` = '$staffID' ORDER BY `Schedule` ASC");
					?>
					<div class="card" >
						<div class="card-header" style="background-color:#1D5902">
							<div class="card-title">
								Viewing Schedule For: <?php echo $staff['Username']; ?>
							</div>
							<div class="card-subtitle">
								
							</div>
						</div>
						<div class="card-main-content">
						
						<table>
						<?php
						while($d = mysqli_fetch_assoc($dutyQuery)){
							?>
							<tr>
								<td>Duty Date:</td>
								<td><div style="width:20px;"></div></td>
								<td><?php echo $d['Schedule']; ?></td>
								<td style="text-align:right;padding-left:10px;"> <a href="duty-edit.php?DutyID=<?php echo $d['DutyID'];?>" class="btn btn-warning btn-square btn-xs"><i class="fa fa-pencil"></i></a> <a href="duty-delete.php?DutyID=<?php echo $d['DutyID'];?>" class="btn btn-danger btn-square btn-xs"><i class="fa fa-trash-o"></i></a></td>
							</tr>
							<tr>
								<td>Room Location:</td>
								<td><div style="width:20px;"></div></td>
								<td><?php 
									$roomQuery = mysqli_query($db,"SELECT * FROM `room` WHERE `RoomID` = '".$d['RoomID']."'");
									$r = mysqli_fetch_assoc($roomQuery);
									echo $r['Location'];
								?></td>
								
							</tr>
							<tr>
								
							</tr>
							<tr style="border-bottom:1px solid #E3E3E3">
								<td></td>
								<td></td>
								<td></td>
								<td></td>
							</tr>
							<?php
						}
						?>
						</table>
						</div>
					</div>
				</div>	
			</div>
			
		</div> 
	</body>
</html>