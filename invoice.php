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
		<link rel="stylesheet" type="text/css" href="assets/css/material-design-iconic-font.min.css" />
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
								Invoice
							</div>
						</li>
					</ul>
				</div>
				
				
				<div class="page-content">
					
					<?php
					$action = @$_GET['action'];
					if(!$action){
						?>
						<div class="list-view-container lv-bordered">
							<div class="lv-header lv-header-fixed">
								<div class="lv-title">
									Invoices
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
								$query = mysqli_query($db,"SELECT * FROM `invoice` ORDER BY `InvoiceID` DESC");
								while($invoice = mysqli_fetch_assoc($query)){
								$bookingID = $invoice['BookingID'];
							
								$bookingQuery = "SELECT * FROM `booking` WHERE `BookingID` = '$bookingID'";
								$booking = mysqli_fetch_assoc(mysqli_query($db,$bookingQuery));
								
								$guestID = $booking['GuestID'];
								
								$guestQuery = "SELECT * FROM `guest` WHERE `GuestID` = '$guestID'";
								$guest = mysqli_fetch_assoc(mysqli_query($db,$guestQuery));
								?>
								<a href="invoice.php?action=view&InvoiceID=<?php echo $invoice['InvoiceID']; ?>">
								<div class="lv-item">	
									<div class="lv-item-content">
										<div class="lv-item-title-nowrap">
											<?php echo $invoice['InvoiceID']; ?>. <?php echo $guest['Name']; ?>
										</div>
										<ul class="lv-meta">
											<li>
												Check In: <?php echo $booking['CheckInDate']; ?>
											</li>
											<li>
												Check Out: <?php echo $booking['CheckOutDate']; ?>
											</li>
											<li>
												Total Charges: $<?php echo $invoice['TotalCharges']; ?>
											</li>
										</ul>
									</div>
								</div></a>
								<?php } ?>
							</div>
						</div>
						<?php
					}elseif($action == 'generate'){
						if(@$_POST['generateInvoice'] != 'Generate Invoice'||!@$_GET['BookingID']){
							echo "<div class=\"error\">You are missing some required information please try again!</div>";
						}else{
							$bookingID = $_GET['BookingID'];
							
							$query = mysqli_query($db,"SELECT * FROM `booking` WHERE `BookingID` = '$bookingID'");
							$booking = mysqli_fetch_assoc($query);
							$query1 = mysqli_query($db,"SELECT * FROM `guest` WHERE `GuestID` = '".$booking['GuestID']."'");
							$guest = mysqli_fetch_assoc($query1);
							
							$totalCharges = 0.00;
						
							$diff = abs(strtotime($booking['CheckOutDate']) - strtotime($booking['CheckInDate']));
							$years = floor($diff / (365*60*60*24));
							$months = floor(($diff - $years * 365*60*60*24) / (30*60*60*24));
							$days = floor(($diff - $years * 365*60*60*24 - $months*30*60*60*24)/ (60*60*24));
							
							$roomRate = mysqli_real_escape_string($db,$_POST['rate']);
							$charges = array();
							
							$totalCharges += $days*$roomRate;
							
							$addtionalChargesTotal = 0.00;
							
							for($x = 0; $x < count($_POST['itemName']); $x++){
								$charges[$x]["ItemName"] = mysqli_real_escape_string($db,$_POST['itemName'][$x]);
								$charges[$x]["ItemCost"] = mysqli_real_escape_string($db,$_POST['itemCost'][$x]);
								$addtionalChargesTotal += $charges[$x]["ItemCost"];
							}
							
							//$charges["Subtotal"] = $addtionalChargesTotal;
							
							$totalCharges += $addtionalChargesTotal;
							
							/*echo "<pre>";
							PRINT_R(json_encode($charges));
							echo "</pre>";*/
							
							$addtionalCharges = json_encode($charges);
							
							$query = "INSERT INTO `invoice` (`BookingID`,`AddtionalCharges`,`RoomRate`,`TotalNumberOfNights`,`TotalCharges`) VALUES ('$bookingID','$addtionalCharges','$roomRate','$days','$totalCharges')";
							
							if(mysqli_query($db,$query)){
								echo "Success!";
							}else{
								echo "<div class=\"error\">There was an error with database communication!</div>";
							}
						}
					}elseif($action == 'view'){
						if(!@$_GET['InvoiceID']&&!@_GET['BookingID']){
							echo "<div class=\"error\">You are missing some required information please try again!</div>";
						}else{
							$invoiceID = mysqli_real_escape_string($db,@$_GET['InvoiceID']);
							$bookingID = mysqli_real_escape_string($db,@$_GET['BookingID']);
							
							if($invoiceID){
								$invoiceQuery = "SELECT * FROM `invoice` WHERE `InvoiceID` = '$invoiceID'";
							
							}else{
								$invoiceQuery = "SELECT * FROM `invoice` WHERE `BookingID` = '$bookingID'";
							}
							$invoice = mysqli_fetch_assoc(mysqli_query($db,$invoiceQuery));
							
							$bookingID = $invoice['BookingID'];
							
							$bookingQuery = "SELECT * FROM `booking` WHERE `BookingID` = '$bookingID'";
							$booking = mysqli_fetch_assoc(mysqli_query($db,$bookingQuery));
							
							$guestID = $booking['GuestID'];
							$roomID = $booking['RoomID'];
							
							$guestQuery = "SELECT * FROM `guest` WHERE `GuestID` = '$guestID'";
							$guest = mysqli_fetch_assoc(mysqli_query($db,$guestQuery));
							
							$roomQuery = "SELECT * FROM `Room` WHERE `RoomID` = '$roomID'";
							$room = mysqli_fetch_assoc(mysqli_query($db,$roomQuery));
							
							?>
							<div class="card">
								<div class="card-header" style="background-color:#0C8705;">
									<div class="card-title">
										Invoice for <?php echo $guest['Name']; ?>
									</div>
									<div class="card-subtitle">
										
									</div>
								</div>
								<div class="card-main-content">
									<div class="card-section-title">Guest Information</div>
									<table class="table table-striped">
										<tr>
											<td class="s-table-header">Name </td>
											<td>&nbsp </td>
											<td><?php echo $guest['Name']; ?></td>
										</tr>
										<tr>
											<td class="s-table-header">Email </td>
											<td>&nbsp </td>
											<td><?php echo $guest['Email']; ?></td>
										</tr>
										<tr>
											<td class="s-table-header">Contact Number </td>
											<td>&nbsp </td>
											<td><?php echo $guest['ContactNumber']; ?></td>
										</tr>
										<tr>
											<td class="s-table-header">Address </td>
											<td>&nbsp </td>
											<td><?php echo $guest['Address']; ?><br /><?php echo $guest['Country']; ?>(<?php echo $guest['PostalCode']; ?>)</td>
										</tr>
										<tr>
											<td class="s-table-header">Country </td>
											<td>&nbsp </td>
											<td><?php echo $guest['Country']; ?></td>
										</tr>
									</table>
									
									<div class="card-section-title">Payment Information</div>
									<table class="table table-striped">
										<tr>
											<td class="s-table-header">Method </td>
											<td>&nbsp </td>
											<td><?php echo $booking['PaymentMethod']; ?></td>
										</tr>
										<?php if($booking['PaymentMethod'] == 'Credit Card'){ ?>
										<tr>
											<td class="s-table-header">Card Number </td>
											<td>&nbsp </td>
											<td><?php echo $booking['PaymentMethod']; ?></td>
										</tr>
										<tr>
											<td class="s-table-header">Status </td>
											<td>&nbsp </td>
											<td><?php echo $booking['PaymentMethod']; ?></td>
										</tr>
										
										<?php } ?>
									</table>
									
									<div class="card-section-title">Stay Information</div>
									<table class="table table-striped">
										<tr>
											<td class="s-table-header">Check In </td>
											<td>&nbsp </td>
											<td><?php echo $booking['CheckInDate']; ?></td>
										</tr>
										<tr>
											<td class="s-table-header">Check Out </td>
											<td>&nbsp </td>
											<td><?php echo $booking['CheckOutDate']; ?></td>
										</tr>
										<tr>
											<td class="s-table-header">Nights </td>
											<td>&nbsp </td>
											<td><?php echo $invoice['TotalNumberOfNights']; ?></td>
										</tr>
										<tr>
											<td class="s-table-header">Room </td>
											<td>&nbsp </td>
											<td><?php echo $room['Location']; ?></td>
										</tr>
										<tr>
											<td class="s-table-header">Room Rate </td>
											<td>&nbsp </td>
											<td>$<?php echo $invoice['RoomRate']; ?>/Night</td>
										</tr>
									</table>
									
									<div class="card-section-title">Charges</div>
									<table class="table table-striped">
										<tr>
											<td class="s-table-header">Room Charges </td>
											<td>&nbsp </td>
											<td>$<?php echo $invoice['RoomRate']*$invoice['TotalNumberOfNights']; ?></td>
										</tr>
										<?php
										$addtional = json_decode($invoice['AddtionalCharges'],true);
										for($x = 0; $x<count($addtional); $x++){
											
											?>
											<tr>
												<td class="s-table-header"><?php echo $addtional[$x]['ItemName']; ?> </td>
												<td>&nbsp </td>
												<td>$<?php echo $addtional[$x]['ItemCost']; ?></td>
											</tr>
											<?php
										}
										?>
										<tr>
											<td class="s-table-header" style="text-align:right;">Grand Total </td>
											<td>&nbsp </td>
											<td>$<?php echo $invoice['TotalCharges']; ?></td>
										</tr>
										<tr>
											<td class="s-table-header" style="text-align:right;">GST (inclusive) </td>
											<td>&nbsp </td>
											<td>$<?php echo round($invoice['TotalCharges']*$GST,2); ?></td>
										</tr>
								</div>
							</div>
							
							<div class="material-side-button">
								<a href style="background-color:#1998FF;"><i style="display:inline;" class="md md-print"></i></a>
							</div>
							<?php
						}
					}
					?>
				</div>
			</div>
		</div> 
	</body>
</html>