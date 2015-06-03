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
								Reports
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
							$query = mysqli_query($db,"SELECT * FROM `booking` WHERE `Status` = 'Checked In'");
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
									<ul class="lv-meta-buttons">
										<li>
											<button onClick="window.location = 'check-out.php?id=<?php echo urlencode($booking['BookingID']); ?>'" class="btn btn-warning btn-square"><i class="fa fa-eye"></i>  Check Out</button>
										</li>
									</ul>
								</div>
								
								<?php
								}
								?>
							
						</div>
					</div>
				<?php 
				}else{
				$query = mysqli_query($db,"SELECT * FROM `booking` WHERE `BookingID` = '$bookingID'");
				$booking = mysqli_fetch_assoc($query);
				$query1 = mysqli_query($db,"SELECT * FROM `guest` WHERE `GuestID` = '".$booking['GuestID']."'");
				$guest = mysqli_fetch_assoc($query1);
				?>
				<script>
				var datatypeTemplate = "";
				$(document).ready(function () {
					$('#rate').change(function () {
						var total = parseFloat($('#rate').val()) * parseFloat($('#noDays').val());
						$('#totalRoomCost').html(total);
						console.log(total);
						updateTotalCost();
					});
					
					datatypeTemplate = "<tr class=\"contact-template contact-table\">"+$('.cost-template').html()+"</tr>";
						console.log(datatypeTemplate);
				});
				
				function updateSubTotal(){
					var totalCost = 0.00;
					$('.itemCost').each(function () {
						totalCost += parseFloat($(this).val());
					});
					$('#subTotal').html(totalCost);
					updateTotalCost();
				}
				
				function updateTotalCost(){
					$('#totalCost').html( (parseFloat($('#subTotal').html()) + parseFloat($('#totalRoomCost').html())) );
				}
				
				function addDatatypeItem(){
					$('.datatype-item').append(datatypeTemplate);
					return false;	
				}
				
				function removeDatatypeItem(t){
					$(t).parent().parent().remove();
					return false;
				}
				</script>
				<form action="invoice.php?action=generate&BookingID=<?php echo $bookingID; ?>" method="POST">
				<div class="card">
					<div class="card-header">
						<div class="card-title">
							Generate Invoice
						</div>
						<div class="card-subtitle">
							
						</div>
					</div>
					<div class="card-main-content">
						<table>
							<tr>
								<td>Guest Name: </td>
								<td>&nbsp </td>
								<td><?php echo $guest['Name']; ?></td>
							</tr>
							<tr>
								<td>Check In Date: </td>
								<td>&nbsp </td>
								<td><?php echo $booking['CheckInDate']; ?></td>
							</tr>
							<tr>
								<td>Check Out Date: </td>
								<td>&nbsp </td>
								<td><?php echo $booking['CheckOutDate']; ?></td>
							</tr>
							<tr>
								<td>Total Number of Days:</td>
								<td>&nbsp </td>
								<td><?php
								$diff = abs(strtotime($booking['CheckOutDate']) - strtotime($booking['CheckInDate']));
								$years = floor($diff / (365*60*60*24));
								$months = floor(($diff - $years * 365*60*60*24) / (30*60*60*24));
								$days = floor(($diff - $years * 365*60*60*24 - $months*30*60*60*24)/ (60*60*24));
								echo $days;
								?></td>
							</tr>
							<tr class="contact-template contact-table datatype-template">
								<td>Room Rate: </td>
								<td>&nbsp </td>
								<td>$ <input type="text" id="rate" name="rate" style="width:auto;" class="number-only" value="0" /><input type="hidden" id="noDays" value="<?php echo $days; ?>"/></td>
							</tr>
							<tr>
								<td>Total Room Cost: </td>
								<td>&nbsp </td>
								<td>$<span id="totalRoomCost"></span></td>
							</tr>
						</table>
					</div>
				</div>
				
				<div class="card">
					<div class="card-header" style="background-color:#D60B66">
						<div class="card-title">
							Additional Charges
						</div>
						<div class="card-subtitle">
							
						</div>
					</div>
					<div class="card-main-content">
						<table class="guests-adult-table table table-stripped">
								<thead>
									<tr>
										<td>Item Name</td>
										<td></td>
										<td>Cost</td>
										<td></td>
									</tr>
								</thead>
								<tbody class="datatype-item">
									<tr class="contact-template contact-table cost-template">
										<td>
											<input type="text" name="itemName[]" style="width:100%;"/>
										</td>
										<td>
										</td>
										<td>
											<input type="text" onchange="updateSubTotal()" class="itemCost number-only" name="itemCost[]" style="width:100%;"/>
										</td> 	
										<td>
											<button class="contact-table-delete-btn" onclick="removeDatatypeItem(this);" style="padding: 1px 1px 1px 1px;"><i class="fa fa-times"></i></button>
										</td>
									</tr>
									
								</tbody>
							</table>
							<div class="addtional-item-subtotal">Sub Total: $<span id="subTotal">0.00</span></div>
							<button onclick="addDatatypeItem();return false;" class="btn btn-info btn-square">Add New Field</button>
					</div>
				</div>
				
				<div class="card">
					<div class="card-header" style="background-color:#0C8705;">
						<div class="card-title">
							Invoice Summary
						</div>
						<div class="card-subtitle">
							
						</div>
					</div>
					<div class="card-main-content">
						<table>
							<tr>
								<td>Total Cost: </td>
								<td>&nbsp </td>
								<td>$<span id="totalCost"></span></td>
							</tr>
						</table>
					</div>
				</div>
				<div class="form-submit-menu">
					<input type="submit" name="generateInvoice" value="Generate Invoice" class="btn btn-square btn-success">
				</div>
				</form>
				<?php
				}
				?>
					</div>
				</div>
			</div>
			
		</div> 
		<script type="text/javascript" src="assets/js/delonix-admin-master.js?<?php echo rand(); ?>"></script>
	</body>
</html>