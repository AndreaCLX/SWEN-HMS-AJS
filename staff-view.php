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
					<div class="list-view-container lv-bordered">
						<div class="lv-header lv-header-fixed">
							<div class="lv-title">
								List of Staff
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
							$q = mysqli_query($db,"SELECT * FROM `staff`");
							while($s = mysqli_fetch_assoc($q)){
							?>
							<div class="lv-item">
							
								<div class="lv-item-content">
									<div class="lv-item-title">
										<?php echo $s['Username']; ?>
									</div>
									<ul class="lv-meta">
										<li>
											Phone Number: <?php echo $s['PhoneNumber']; ?>
										</li>
									</ul>
								</div>
							
								<div class="lv-item-menu">
									<a href data-toggle="dropdown">
										<i class="fa fa-ellipsis-v"></i>
									</a>
								
									<ul class="lv-dropdown dropdown-menu dropdown-menu-right">
										<li><a href="staff-edit.php?StaffID=<?php echo $s['StaffID']; ?>">Edit</a></li>
										<li><a href="staff-delete.php?id=<?php echo $s['StaffID']; ?>">Delete</a></li>
										<li><a href="duty-view.php?StaffID=<?php echo $s['StaffID']; ?>">View Schedule</a></li>
									</ul>
								</div>
							</div>
							<?php } ?>
						</div>
					</div>
					
					<div class="material-side-button">
						<a href="staff-new.php" >+</a>
					</div>
						
					</div>
				</div>
			</div>
			
		</div> 
	</body>
</html>