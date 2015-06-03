<!DOCTYPE HTML>
<html>
	<head>
		<title>Home | Delonix Regia Hotel Management System</title>
		
		<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
		<meta name="DC.rights" scheme="DCTERMS.URI" content="http://creativecommons.org/licenses/by-sa/4.0/deed.en_US/" />
		
		<link rel="stylesheet" type="text/css" href="assets/css/reset.css" />
		<link rel="stylesheet" type="text/css" href="assets/css/fonts.css" />
		<link rel="stylesheet" type="text/css" href="assets/css/bootstrap.min.css" />
		<link rel="stylesheet" type="text/css" href="assets/css/font-awesome.min.css" />
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
			<script type="text/javascript" src="assets/js/menu.js?<?php echo rand(); ?>"></script>
		<script type="text/javascript" src="assets/js/delonix-admin-master.js?<?php echo rand(); ?>"></script>
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
								Hotel Management System
							</div>
						</li>
					</ul>
				</div>
				<div class="page-content">
				This is the master template for the page
				<?php
					for($x=0;$x<100;$x++){
						echo "<br />";
						if($x%10 == 0){
							echo "<hr />";
						}
					}
				?>
			</div>
			</div>
			
		</div> 
	</body>
</html>