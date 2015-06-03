
<!DOCTYPE html>
<html>
	<head>
		<title>iScout Login | Red Fox Scouts</title>
		
		<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
		<meta name="DC.rights" scheme="DCTERMS.URI" content="http://creativecommons.org/licenses/by-sa/4.0/deed.en_US/" />

		
		<link rel="stylesheet" href="assets/css/reset.css" />
		<link rel="stylesheet" href="assets/css/fonts.css?74519707" />
		<link rel="stylesheet" href="assets/css/bootstrap.min.css" />
		<link href='http://fonts.googleapis.com/css?family=Roboto+Slab:300,400|Roboto:100,400,300,700,900' rel='stylesheet' type='text/css'>
		<link rel="stylesheet" href="assets/css/loading.css?711526556" />
		<link rel="stylesheet" href="assets/css/login.css?317992989" />
		
		<link rel="shortcut icon" href="assets/images/favico.png"/>
		<!--[if IE]->
		<link rel="shortcut icon" href="assets/images/favico.ico"/>
		<![endif]-->
		
		<script type="text/javascript" src="assets/js/jquery-1.11.2.min.js"></script>
		<script type="text/javascript" src="assets/js/bootstrap.min.js"></script>
		<script type="text/javascript" src="assets/js/login.js?399083654"></script>
		
	</head>
	<body>
		<div class="masterBackgroundOverflow">
			<div class="masterBackground fullHeight">
				
			</div>
		</div>
		<div class="backgroundFilter fullHeight">
				<div class="loginLoading">
					<div class="spinner">
					  <div class="spinner-container container1">
						<div class="circle1"></div>
						<div class="circle2"></div>
						<div class="circle3"></div>
						<div class="circle4"></div>
					  </div>
					  <div class="spinner-container container2">
						<div class="circle1"></div>
						<div class="circle2"></div>
						<div class="circle3"></div>
						<div class="circle4"></div>
					  </div>
					  <div class="spinner-container container3">
						<div class="circle1"></div>
						<div class="circle2"></div>
						<div class="circle3"></div>
						<div class="circle4"></div>
					  </div>
					</div>
				</div>
				<div class="loginContainer" style="display:none;">
					<div class="loginContent">
						<div style="width:350px;margin-left:auto;margin-right:auto;padding-top:100px;">
							<img src="assets/images/Delonix-Regia-Logo-White.png" height="100%" width="100%"/>
						</div>
						
						<div class="login-main floating">
						<div class="loginText">
							Login to Delonix Regina Hotel Management System
						</div>
						<br />
						
						<div class="login-feedback">You do know your username and password needs to be filled in right?</div>

						
						<input class="login-form-input input-large font-light" type="text" id="username" placeholder="Username" autocomplete="off"/>
						<input class="login-form-input input-large font-light" type="password" id="password" placeholder="Password" autocomplete="off"/>
						<input type="button" class="button-submit-big" onClick="processLogin()" value="Login!"/>
						<div style="text-align:right">
							<a href="#help" class="helpTrigger" data-toggle="modal" data-target="#help">Login Help</a>
						</div>
						</div>

					</div>
					<!--<div class="helpButton">
						<a href="#help" class="helpTrigger" data-toggle="modal" data-target="#help">?</a>
					</div>-->
				</div>
				<footer class="footer hide-mobile">
					Delonix Regina Hotel | Hotel Management System
				</footer>
				<div class="modal fade" id="help" tabindex="-1" role="dialog" aria-labelledby="helpTitle" aria-hidden="true">
				  <div class="modal-dialog">
					<div class="modal-content">
					  <div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						<h4 class="modal-title" id="helpTitle">Login Help</h4>
					  </div>
					  <div class="modal-body">
						Help stuff here...
					  </div>
					</div>
				  </div>
				</div>
			</div>
	</body>
</html>