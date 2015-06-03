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
								Check In
							</div>
						</li>
					</ul>
				</div>
				<div class="page-content">
					<div class="m-overlay">
					<div class="m-overlay-items">
						<div class="mo-container">
							
								<?php
								$bookingID = @$_GET['id'];
								$roomID = @$_GET['RoomID'];
								if(!$bookingID){
								
								}else{
									if(!$roomID){
										
									?>
										<div class="mo-title">Select A Room</div>
										<div class="list-view-container lv-bordered">
										<div class="lv-main-container">
										<?php 
										$roomQuery = mysqli_query($db,"SELECT * FROM `room` WHERE `Status` = 'Empty' OR `Status` ORDER BY `RoomID` ASC");
										
										if(mysqli_num_rows($roomQuery) == 0){
											echo '<div class="mo-title">No Rooms Available</div>';
										}else{
										while($room = mysqli_fetch_assoc($roomQuery)){ 
										
										?>
										<a href="check-in.php?RoomID=<?php echo $room['RoomID']; ?>&id=<?php echo $bookingID; ?>">
										<div class="lv-item">	
											<div class="lv-item-content">
												<div class="lv-item-title-nowrap">
													<?php echo $room['Location']; ?>
												</div>
												<ul class="lv-meta">
													<li>
														Rate: $<?php echo $room['Rate']; ?>
													</li>
												</ul>
											</div>
										</div></a>
									<?php 
									}
									}

									?>
									</div>
									</div>
									</div>
									<?php 
									}else{
										$query = "UPDATE `Room` SET `Status` = 'Occupied' WHERE `RoomID` = '$roomID'";
										if(mysqli_query($db,$query)){
											$query2 = "UPDATE `Booking` SET `RoomID` = '$roomID', `Status` = 'Checked In' WHERE `BookingID` = '$bookingID'";
											if(mysqli_query($db,$query2)){
												echo "Success!";
												echo "<script>window.location = 'booking-view.php'</script>";
											}
										}
									}
								}
								?>
							
					</div>
				</div>
				</div>
			</div>
		</div>	
		</div> 
		<script type="text/javascript" src="assets/js/delonix-admin-master.js?<?php echo rand(); ?>"></script>
	</body>
</html>