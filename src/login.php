<!doctype html>
<!--[if IE 8 ]>    <html lang="en" class="no-js ie8"> <![endif]-->
<!--[if (gt IE 9)|!(IE)]><!--> <html lang="en" class="no-js"> <!--<![endif]-->
<head>
  <meta charset="UTF-8">
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1" />
  <link rel="canonical" href="/" />
  <meta name="description" content="" />
  <title>Login Page</title>
  
    <link href="./assets/stylesheets/font.css" rel='stylesheet' type='text/css'>
  
	<link href="./assets/stylesheets/font-awesome.min.css" rel="stylesheet" type="text/css" media="all"> 	
	<link href="./assets/stylesheets/bootstrap.min.3x.css" rel="stylesheet" type="text/css" media="all">
	<link href="./assets/stylesheets/cs.bootstrap.3x.css" rel="stylesheet" type="text/css" media="all">
	<link href="./assets/stylesheets/cs.animate.css" rel="stylesheet" type="text/css" media="all">
	<link href="./assets/stylesheets/cs.global.css" rel="stylesheet" type="text/css" media="all">
	<link href="./assets/stylesheets/cs.style.css" rel="stylesheet" type="text/css" media="all">
	<link href="./assets/stylesheets/cs.media.3x.css" rel="stylesheet" type="text/css" media="all">
  	<link href="./assets/stylesheets/site.css" rel="stylesheet" type="text/css" media="all">
	
	<script src="./assets/javascripts/jquery-1.9.1.min.js" type="text/javascript"></script>
	<script src="./assets/javascripts/bootstrap.min.3x.js" type="text/javascript"></script>
</head>

<body itemscope="" itemtype="http://schema.org/WebPage" class="templateCustomersRegister notouch">
  
<?php

if ( session_status() == PHP_SESSION_NONE ) {
	session_start();
}
include 'url/require.php';

pconsole($_POST);

if ( isset($_POST['login']['username']) ) {
	$checkUser = $pdo->prepare("SELECT `username` FROM `accounts` WHERE `username` = :user");
	$checkUser->execute(array(":user" => $_POST['login']['username']));

	if ( $checkUser->rowCount() > 0 ) {
		echo var_dump("User Exist");
		$authenticate = $pdo->prepare("SELECT * FROM `accounts` WHERE `username` = :user AND `password` = :pass");
		$authenticate->execute (
			array(
				":user" => $_POST['login']['username'],
				":pass" => $_POST['login']['password']
			));

		if ( $authenticate->rowCount() > 0 ) {
			$result = $authenticate->fetch(PDO::FETCH_ASSOC);

			$_SESSION['username'] = $result['username'];
			$_SESSION['email'] = $result['email'];
			$_SESSION['loggedIn'] = true;

			if ( $result['type'] > 0 ) {
				$_SESSION['admin'] = $result['type'];
			}

			header("Location: index.php");
		}
	} else {
		$error = "No User Found";
	}
} else if ( isset($_POST['form_type']) ) {
	$checkUser = $pdo->prepare("SELECT `username` FROM `accounts` WHERE `username` = :user");
	$checkUser->execute(array(":user" => $_POST['customer']['username']));

	if ( $checkUser->rowCount() > 0 ) {
		echo var_dump("User Exist");
		$authenticate = $pdo->prepare("SELECT * FROM `accounts` WHERE `username` = :user AND `password` = :pass");
		$authenticate->execute (
			array(
				":user" => $_POST['customer']['username'],
				":pass" => $_POST['customer']['password']
			));

		if ( $authenticate->rowCount() > 0 ) {
			$result = $authenticate->fetch(PDO::FETCH_ASSOC);

			$_SESSION['username'] = $result['username'];
			$_SESSION['email'] = $result['email'];
			$_SESSION['loggedIn'] = true;

			if ( $result['type'] > 0 ) {
				$_SESSION['admin'] = $result['type'];
			}

			header("Location: index.php");
		}
	} else {
		$error = "No User Found";
	}
}
?>
	<!-- Header -->
	<?php include './url/header.php'; ?>
  
	<div id="content-wrapper-parent">
		<div id="content-wrapper">  
			<!-- Content -->
			<div id="content" class="clearfix">        
				<div id="breadcrumb" class="breadcrumb">
					<div itemprop="breadcrumb" class="container">
						<div class="row">
							<div class="col-md-24">
								<a href="./index.html" class="homepage-link" title="Back to the frontpage">Home</a>
								<span>/</span>
								<span class="page-title">Login</span>
							</div>
						</div>
					</div>
				</div>              
				<section class="content">
					<div class="container">
						<div class="row">
							<div id="page-header" class="col-md-24">
								<h1 id="page-title">Login</h1> 
							</div>
							<div id="col-main" class="col-md-24 register-page clearfix">
								<div class="row checkout-form">
									<div class="col-md-12 row-left">
										<!-- Customer Account Login -->
										<div id="customer-login">
											<div class="checkout-title">
												<span class="general-title">Customer Login</span>
											</div>
											<form method="post" id="customer_login" accept-charset="UTF-8">
												<input type="hidden" value="customer_login" name="form_type"><input type="hidden" name="utf8" value="✓">
												<?php if ( !empty($error) ) {
													echo '
														<div class="col-md-21 login-alert">
															<div class="alert alert-danger">
																<button type="button" class="close btooltip" data-toggle="tooltip" data-placement="top" title="" data-dismiss="alert" data-original-title="Close">×</button>
																<div class="errors">
																	<ul>
																		<li>'. $error .'</li>
																	</ul>
																</div>
															</div>
														</div>';
												}
												?>
												<ul id="login-form" class="list-unstyled">
													<li class="clearfix"></li>
													<li id="login_email" class="col-md-21">
													<label class="control-label" for="customer_email">Username <span class="req">*</span></label>
													<input type="text" value="" name="customer[username]" id="customer_email" class="form-control">
													</li>
													<li class="clearfix"></li>
													<li id="login_password" class="col-md-21">
													<label class="control-label" for="customer_password">Password <span class="req">*</span></label>
													<input type="password" value="" name="customer[password]" id="customer_password" class="form-control password">
													</li>
													<li class="col-md-21 unpadding-top">
													<ul class="login-wrapper list-unstyled">
														<li>
														<button class="btn" type="submit">Login</button>
														</li>
														<li>
														<a class="action" href="javascript:;" onclick="showRecoverPasswordForm()">Forgot your password?</a>
														</li>
														<li>
														or <a class="return" href="./index.php">Return to store</a>
														</li>
													</ul>
													</li>
												</ul>
											</form>
										</div>
										<!-- Password Recovery -->
										<div id="recover-password" style="display: none;">
											<div class="checkout-title">
												<span class="general-title">Reset Password</span>
												<span class="line"></span>
											</div>
											<p class="note">
												We will send you an email to reset your password.
											</p>
											<form method="post" action="/account/recover" accept-charset="UTF-8">
												<input type="hidden" value="recover_customer_password" name="form_type"><input type="hidden" name="utf8" value="✓">
												<ul id="recover-form" class="list-unstyled clearfix">
													<li class="clearfix"></li>
													<li id="recover_email" class="col-md-21">
													<label class="control-label">Email Address <span class="req">*</span></label>
													<input type="email" value="" name="email" id="recover-email" class="form-control">
													</li>
													<li class="col-md-21 unpadding-top">
													<ul class="login-wrapper list-unstyled">
														<li>
														<a class="action" href="javascript:;" onclick="hideRecoverPasswordForm()">Return to login?</a>
														or <a class="return" href="./index.html">Return to store</a>
														</li>
														<li>
														<button class="btn btn-1" type="submit">Submit</button>
														</li>
													</ul>
													</li>
												</ul>
											</form>
										</div>
									</div>
								</div>
							</div>   
						</div>
					</div>
				</section>        
			</div>
		</div>
	</div>

	<footer id="footer">      
		<div id="footer-content">
			<h6 class="general-title contact-footer-title">Newsletter</h6>  
			<div id="widget-newsletter">
				<div class="container">            
				  <div class="newsletter col-md-24">
					<form action="http://codespot.us5.list-manage.com/subscribe/post?u=ed73bc2d2f8ae97778246702e&id=c63b4d644d" method="post" id="mc-embedded-subscribe-form" name="mc-embedded-subscribe-form" target="_blank">
					  <span class="news-desc">We promise only send the good things</span>
					  <div class="group_input">
						<input class="form-control" type="email" placeholder="Your Email Address" name="Email" id="email-input">
						<div class="unpadding-top"><button class="btn btn-1" type="submit"><i class="fa fa-paper-plane"></i></button></div>
					  </div>              
					</form>
				  </div>						
				</div>
			</div>
			
			<div class="footer-content footer-content-top clearfix">
				<div class="container">
					<div class="footer-link-list col-md-6">
					  <div class="group">
						<h5 class="general-title">About Us</h5>						
						<ul class="list-unstyled list-styled">						  
						  <li class="list-unstyled">
							<a href="./account.html">Store Locations</a>
						  </li>						  
						  <li class="list-unstyled">
							<a href="./account.html">Whosesalers</a>
						  </li>						  
						  <li class="list-unstyled">
							<a href="./account.html">Map Site</a>
						  </li>						  
						  <li class="list-unstyled">
							<a href="./account.html">Contact Us</a>
						  </li>						  
						</ul>
					  </div>
					</div>   
					<div class="footer-link-list col-md-6">
					  <div class="group">
						<h5 class="general-title">Information</h5>						
						<ul class="list-unstyled list-styled">						  
						  <li class="list-unstyled">
							<a href="./account.html">Help &amp; FAQs</a>
						  </li>						  
						  <li class="list-unstyled">
							<a href="./account.html">Advance Search</a>
						  </li>						  
						  <li class="list-unstyled">
							<a href="./account.html">Gift Cards</a>
						  </li>						  
						  <li class="list-unstyled">
							<a href="./account.html">Shop By Brands</a>
						  </li>						  
						</ul>
					  </div>
					</div>
					<div class="footer-link-list col-md-6">
					  <div class="group">
						<h5 class="general-title">Account</h5>						
						<ul class="list-unstyled list-styled">						  
						  <li class="list-unstyled">
							<a href="./account.html">Preferences</a>
						  </li>						  
						  <li class="list-unstyled">
							<a href="./account.html">Order History</a>
						  </li>						  
						  <li class="list-unstyled">
							<a href="./account.html">Cart Page</a>
						  </li>						  
						  <li class="list-unstyled">
							<a href="./account.html">Sign In</a>
						  </li>						  
						</ul>
					  </div>
					</div>
					<div class="footer-link-list col-md-6">
					  <div class="group">
						<h5 class="general-title">Customer</h5>						
						<ul class="list-unstyled list-styled">						  
							<li class="list-unstyled">
								<a href="./search.html">Search Advanced</a>
							</li>						  
							<li class="list-unstyled">
								<a href="#">Return Policy</a>
							</li>						  
							<li class="list-unstyled">
								<a href="#">Privacy Policy</a>
							</li>						  
							<li class="list-unstyled">
								<a href="#">Help &amp; Contact</a>
							</li>						  
						</ul>
					  </div>
					</div>   
				</div>
			</div>
			<div class="footer-content footer-content-bottom clearfix">
				<div class="container">
					<div class="copyright col-md-12">
						© 2015 <a href="./about-us.html">Jewelry - HTML template</a>. All Rights Reserved.
					</div>
					<div id="widget-payment" class="col-md-12">
						<ul id="payments" class="list-inline animated">
							<li class="btooltip tada" data-toggle="tooltip" data-placement="top" title="" data-original-title="Visa"><a href="#" class="icons visa"></a></li>
							<li class="btooltip tada" data-toggle="tooltip" data-placement="top" title="" data-original-title="Mastercard"><a href="#" class="icons mastercard"></a></li>
							<li class="btooltip tada" data-toggle="tooltip" data-placement="top" title="" data-original-title="American Express"><a href="#" class="icons amex"></a></li>
							<li class="btooltip tada" data-toggle="tooltip" data-placement="top" title="" data-original-title="Paypal"><a href="#" class="icons paypal"></a></li>
							<li class="btooltip tada" data-toggle="tooltip" data-placement="top" title="" data-original-title="Moneybookers"><a href="#;" class="icons moneybookers"></a></li>
						</ul>
					</div>
				</div>
			</div>
		</div>   
	</footer>
</body>