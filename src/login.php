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
	
	<script src="./assets/javascripts/jquery-1.9.1.min.js" type="text/javascript"></script>
	<script src="./assets/javascripts/bootstrap.min.3x.js" type="text/javascript"></script>
</head>

<body itemscope="" itemtype="http://schema.org/WebPage" class="templateCustomersRegister notouch">
  
<?php

if ( session_status() == PHP_SESSION_NONE ) {
	session_start();
}
echo var_dump($_POST);
include 'url/require.php';

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
	echo var_dump("No User Found");
}
?>
	<!-- Header -->
	<header id="top" class="clearfix">
		<!--top-->
		<div class="container">
		  <div class="top row">
			<div class="col-md-6 phone-shopping">
			  <span>PHONE SHOPING (01) 123 456 UJ</span>
			</div>
			<div class="col-md-18">
			  <ul class="text-right">
				<li class="customer-links hidden-xs">
					<ul id="accounts" class="list-inline">
						<li class="my-account">
							<a href="./account.html">My Account</a>
						</li>  
						<li class="login">    
							<span id="loginButton" class="dropdown-toggle" data-toggle="dropdown">
								<a href="./login.html">Login</a>
								<i class="sub-dropdown1"></i>
								<i class="sub-dropdown"></i>
							</span>
							<!-- Customer Account Login -->
							<div id="loginBox" class="dropdown-menu text-left">
							<form method="post" action="#" id="customer_loginf" accept-charset="UTF-8"><input type="hidden" value="customer_login" name="form_type"><input type="hidden" name="utf8" value="✓">
								<div id="bodyBox">
									<ul class="control-container customer-accounts list-unstyled">
										<li class="clearfix">
											<label for="customer_email_box" class="control-label">Email Address <span class="req">*</span></label>
											<input type="email" value="" name="customer[email]" id="customer_email_box" class="form-control">
										</li>						 
										<li class="clearfix">
											<label for="customer_password_box" class="control-label">Password <span class="req">*</span></label>
											<input type="password" value="" name="customer[password]" id="customer_password_box" class="form-control password">
										</li>						  
										<li class="clearfix">
											<a class="action btn btn-1" href="./login.html">Login</a>
										</li>
										<li class="clearfix">
											<a class="action btn btn-1" href="./register.html">Create an account</a>
										</li>
									</ul>
								</div>
							</form>
							</div>    
						</li>
						<li>/</li>   
						<li class="register">
							<a href="./register.html" id="customer_register_link">Create an account</a>
						</li> 
					</ul>
				</li>      
				<li id="widget-social">
				  <ul class="list-inline">            
					<li><a target="_blank" href="#" class="btooltip swing" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Facebook"><i class="fa fa-facebook"></i></a></li>
					<li><a target="_blank" href="#" class="btooltip swing" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Twitter"><i class="fa fa-twitter"></i></a></li>                        
					<li><a target="_blank" href="#" class="btooltip swing" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Pinterest"><i class="fa fa-pinterest"></i></a></li>           
				  </ul>
				</li>        
			  </ul>
			</div>
		  </div>
		</div>
		<!--End top-->
		<div class="line"></div>
		<!-- Navigation -->
		<div class="container">
			<div class="top-navigation">
				<ul class="list-inline">
					<li class="top-logo">
						<a id="site-title" href="./index.html" title="Jewelry - HTML Template theme">          
						<img class="img-responsive" src="assets/images/logo.png" alt="Jewelry - HTML Template theme">          
						</a>
					</li>
					<li class="navigation">			
						<nav class="navbar">
							<div class="clearfix">
								<div class="navbar-header">
									<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
									<span class="sr-only">Toggle main navigation</span>
									<span class="icon-bar"></span>
									<span class="icon-bar"></span>
									<span class="icon-bar"></span>
									</button>
								</div>
								<div class="is-mobile visible-xs">
									<ul class="list-inline">
										<li class="is-mobile-menu">
										<div class="btn-navbar" data-toggle="collapse" data-target=".navbar-collapse">
											<span class="icon-bar-group">
											<span class="icon-bar"></span>
											<span class="icon-bar"></span>
											<span class="icon-bar"></span>
											</span>
										</div>
										</li>
										<li class="is-mobile-login">
										<div class="btn-group">
											<div class="dropdown-toggle" data-toggle="dropdown">
												<i class="fa fa-user"></i>
											</div>
											<ul class="customer dropdown-menu">
												<li class="logout">
												<a href="#">Login</a>
												</li>
												<li class="account last">
												<a href="register.html">Register</a>
												</li>
											</ul>
										</div>
										</li>
										<li class="is-mobile-wl">
										<a href="#"><i class="fa fa-heart"></i></a>
										</li>
										<li class="is-mobile-cart">
										<a href="#"><i class="fa fa-shopping-cart"></i></a>
										</li>
									</ul>
								</div>
								<div class="collapse navbar-collapse">
									<ul class="nav navbar-nav hoverMenuWrapper">
										<li class="nav-item active">
										<a href="#">
										<span>Home</span>
										</a>
										</li>
										<li class="dropdown mega-menu">
										<a href="./collection.html" class="dropdown-toggle dropdown-link" data-toggle="dropdown">
										<span>Collections</span>
										<i class="fa fa-caret-down"></i>
										<i class="sub-dropdown1 visible-sm visible-md visible-lg"></i>
										<i class="sub-dropdown visible-sm visible-md visible-lg"></i>
										</a>
										<div class="megamenu-container megamenu-container-1 dropdown-menu banner-bottom mega-col-4" style="">
											<ul class="sub-mega-menu">
												<li>
												<ul>
													<li class="list-title">Collection Links</li>
													<li class="list-unstyled li-sub-mega">
													<a href="#">Dolorem Sed </a>
													</li>
													<li class="list-unstyled li-sub-mega">
													<a href="#">Proident Nulla </a>
													</li>
													<li class="list-unstyled li-sub-mega">
													<a href="#">Phasellus Leo <span class="megamenu-label hot-label">Hot</span>
													</a>
													</li>
													<li class="list-unstyled li-sub-mega">
													<a href="#">Tristique Amet <span class="megamenu-label feature-label">Featured</span>
													</a>
													</li>
												</ul>
												</li>
												<li>
												<ul>
													<li class="list-title">Collection Links</li>
													<li class="list-unstyled li-sub-mega">
													<a href="#">Dolorem Sed </a>
													</li>
													<li class="list-unstyled li-sub-mega">
													<a href="#">Proident Nulla <span class="megamenu-label new-label">New</span>
													</a>
													</li>
													<li class="list-unstyled li-sub-mega">
													<a href="#">Phasellus Leo </a>
													</li>
													<li class="list-unstyled li-sub-mega">
													<a href="#">Tristique Amet </a>
													</li>
												</ul>
												</li>
												<li>
												<ul>
													<li class="list-title">Collection Links</li>
													<li class="list-unstyled li-sub-mega">
													<a href="#">Dolorem Sed </a>
													</li>
													<li class="list-unstyled li-sub-mega">
													<a href="#">Proident Nulla </a>
													</li>
													<li class="list-unstyled li-sub-mega">
													<a href="#">Phasellus Leo <span class="megamenu-label sale-label">Sale</span>
													</a>
													</li>
													<li class="list-unstyled li-sub-mega">
													<a href="#">Tristique Amet </a>
													</li>
												</ul>
												</li>
												<li>
												<ul>
													<li class="list-title">Collection Links</li>
													<li class="list-unstyled li-sub-mega">
													<a href="#">Dolorem Sed <span class="megamenu-label new-label">New</span>
													</a>
													</li>
													<li class="list-unstyled li-sub-mega">
													<a href="#">Proident Nulla </a>
													</li>
													<li class="list-unstyled li-sub-mega">
													<a href="./product.html">Phasellus Leo </a>
													</li>
													<li class="list-unstyled li-sub-mega last">
													<a href="./product.html">Tristique Amet <span class="megamenu-label hot-label">Hot</span>
													</a>
													</li>
												</ul>
												</li>
											</ul>
										</div>
										</li>
										<li class="dropdown mega-menu">
										<a href="./collection.html" class="dropdown-toggle dropdown-link" data-toggle="dropdown">
										<span>Pages</span>
										<i class="fa fa-caret-down"></i>
										<i class="sub-dropdown1 visible-sm visible-md visible-lg"></i>
										<i class="sub-dropdown visible-sm visible-md visible-lg"></i>
										</a>
										<div class="megamenu-container megamenu-container-2 dropdown-menu banner-right mega-col-2" style="display: none;">
											<ul class="sub-mega-menu">
												<li>
												<ul>
													<li class="list-title">Page Layout</li>
													<li class="list-unstyled li-sub-mega">
													<a href="./collection.html">Collection full width </a>
													</li>
													<li class="list-unstyled li-sub-mega">
													<a href="./collection-left.html">Collection - left sidebar </a>
													</li>
													<li class="list-unstyled li-sub-mega">
													<a href="./collection-right.html">Collection - right sidebar </a>
													</li>
													<li class="list-unstyled li-sub-mega">
													<a href="./product.html">Product full width </a>
													</li>
													<li class="list-unstyled li-sub-mega">
													<a href="./product-left.html">Product - left sidebar </a>
													</li>
													<li class="list-unstyled li-sub-mega">
													<a href="./product-right.html">Product - right sidebar </a>
													</li>
												</ul>
												</li>
												<li>
												<ul>
													<li class="list-title">Page Content</li>
													<li class="list-unstyled li-sub-mega">
													<a href="./about-us.html">About </a>
													</li>
													<li class="list-unstyled li-sub-mega">
													<a href="./price-table.html">Price table </a>
													</li>
													<li class="list-unstyled li-sub-mega">
													<a href="./faqs.html">FAQs </a>
													</li>
													<li class="list-unstyled li-sub-mega">
													<a href="./testimonials.html">Testimonial </a>
													</li>
													<li class="list-unstyled li-sub-mega">
													<a href="./collection.html">New product introduction </a>
													</li>
													<li class="list-unstyled li-sub-mega last">
													<a href="./contact.html"> Contact </a>
													</li>
												</ul>
												</li>
											</ul>
										</div>
										</li>
										<li class="nav-item dropdown">
										<a href="./blog-full.html" class="dropdown-toggle dropdown-link" data-toggle="dropdown">
										<span>Blog</span>
										<i class="fa fa-caret-down"></i>
										<i class="sub-dropdown1 visible-sm visible-md visible-lg"></i>
										<i class="sub-dropdown visible-sm visible-md visible-lg"></i>
										</a>
										<ul class="dropdown-menu">
											<li class=""><a tabindex="-1" href="./blog-3-col.html">Blog grid 3 columns</a></li>
											<li class=""><a tabindex="-1" href="./blog-2-col.html">Blog grid 2 columns</a></li>
											<li class=""><a tabindex="-1" href="./blog.html">Blog grid full width</a></li>
											<li class=""><a tabindex="-1" href="./blog-left.html">Blog - left sidebar</a></li>
											<li class=""><a tabindex="-1" href="./blog-right.html">Blog - right sidebar</a></li>
											<li class=""><a tabindex="-1" href="./article.html">Post full width</a></li>
											<li class=""><a tabindex="-1" href="./article-left.html"> Post - left sidebar</a></li>
											<li class="last"><a tabindex="-1" href="./article-right.html">Post - right sidebar</a></li>
										</ul>
										</li>
										<li class="nav-item">
										<a href="./contact.html">
										<span>Contact</span>
										</a>
										</li>
									</ul>
								</div>
							</div>
						</nav>
					</li>		  
					<li class="top-search hidden-xs">
						<div class="header-search">
							<a href="#">
							<span data-toggle="dropdown">
							<i class="fa fa-search"></i>
							<i class="sub-dropdown1"></i>
							<i class="sub-dropdown"></i>
							</span>
							</a>
							<form id="header-search" class="search-form dropdown-menu" action="search.html" method="get">
								<input type="hidden" name="type" value="product">
								<input type="text" name="q" value="" accesskey="4" autocomplete="off" placeholder="Search something...">
								<button type="submit" class="btn">Search</button>
							</form>
						</div>
					</li>					
					<li class="umbrella hidden-xs">
						<div id="umbrella" class="list-inline unmargin">
							<div class="cart-link">
								<a href="./cart.html" class="dropdown-toggle dropdown-link" data-toggle="dropdown">
									<i class="sub-dropdown1"></i>
									<i class="sub-dropdown"></i>
									<div class="num-items-in-cart">
										<span class="icon">
										  Cart
										  <span class="number">1</span>
										</span>
									</div>
								</a>
								<div id="cart-info" class="dropdown-menu" style="display: none;">
									<div id="cart-content">
										<div class="items control-container">
											<div class="row items-wrapper">
												<a class="cart-close" title="Remove" href="javascript:void(0);"><i class="fa fa-times"></i></a>
												<div class="col-md-8 cart-left">
													<a class="cart-image" href="./product.html"><img src="./assets/images/demo_77x77.png" alt="" title=""></a>
												</div>
												<div class="col-md-16 cart-right">
													<div class="cart-title">
														<a href="./product.html">Product with left sidebar - black / small</a>
													</div>
													<div class="cart-price">
														$200.00<span class="x"> x </span>1
													</div>
												</div>
											</div>
										</div>
										<div class="subtotal">
											<span>Subtotal:</span><span class="cart-total-right">$200.00</span>
										</div>
										<div class="action">
											<button class="btn" onclick="window.location='./cart.html'">CHECKOUT</button><a class="btn btn-1" href="./cart.html">View Cart</a>
										</div>
									</div>
								</div>
							</div>
						</div>
					</li>		  		 
					<li class="mobile-search visible-xs">
						<form id="mobile-search" class="search-form" action="search.html" method="get">
							<input type="hidden" name="type" value="product">
							<input type="text" class="" name="q" value="" accesskey="4" autocomplete="off" placeholder="Search something...">
							<button type="submit" class="search-submit" title="search"><i class="fa fa-search"></i></button>
						</form>
					</li>		  
				</ul>
			</div>
			<!--End Navigation-->
			<script>
			  function addaffix(scr){
				if($(window).innerWidth() >= 1024){
				  if(scr > $('#top').innerHeight()){
					if(!$('#top').hasClass('affix')){
					  $('#top').addClass('affix').addClass('animated');
					}
				  }
				  else{
					if($('#top').hasClass('affix')){
					  $('#top').prev().remove();
					  $('#top').removeClass('affix').removeClass('animated');
					}
				  }
				}
				else $('#top').removeClass('affix');
			  }
			  $(window).scroll(function() {
				var scrollTop = $(this).scrollTop();
				addaffix(scrollTop);
			  });
			  $( window ).resize(function() {
				var scrollTop = $(this).scrollTop();
				addaffix(scrollTop);
			  });
			</script>
		</div>
    </header>
  
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
											<form method="post" action="./login.html" id="customer_login" accept-charset="UTF-8">
												<input type="hidden" value="customer_login" name="form_type"><input type="hidden" name="utf8" value="✓">
												<div class="col-md-21 login-alert">
													<div class="alert alert-danger">
														<button type="button" class="close btooltip" data-toggle="tooltip" data-placement="top" title="" data-dismiss="alert" data-original-title="Close">×</button>
														<div class="errors">
															<ul>
																<li>Invalid login credentials.</li>
															</ul>
														</div>
													</div>
												</div>
												<ul id="login-form" class="list-unstyled">
													<li class="clearfix"></li>
													<li id="login_email" class="col-md-21">
													<label class="control-label" for="customer_email">Email Address <span class="req">*</span></label>
													<input type="email" value="" name="customer[email]" id="customer_email" class="form-control">
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
														or <a class="return" href="./index.html">Return to store</a>
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