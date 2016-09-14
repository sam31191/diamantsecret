<!doctype html>
<!--[if IE 8 ]>    <html lang="en" class="no-js ie8"> <![endif]-->
<!--[if (gt IE 9)|!(IE)]><!--> <html lang="en" class="no-js"> <!--<![endif]-->
<head>
  <meta charset="UTF-8">
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1" />
  <link rel="canonical" href="/" />
  <meta name="description" content="" />
  <title>Contact Page</title>
  
    <link href="./assets/stylesheets/font.css" rel='stylesheet' type='text/css'>
  
	<link href="./assets/stylesheets/font-awesome.min.css" rel="stylesheet" type="text/css" media="all"> 	
	<link href="./assets/stylesheets/bootstrap.min.3x.css" rel="stylesheet" type="text/css" media="all">
	<link href="./assets/stylesheets/cs.bootstrap.3x.css" rel="stylesheet" type="text/css" media="all">
	<link href="./assets/stylesheets/cs.animate.css" rel="stylesheet" type="text/css" media="all">
	<link href="./assets/stylesheets/cs.global.css" rel="stylesheet" type="text/css" media="all">
	<link href="./assets/stylesheets/cs.style.css" rel="stylesheet" type="text/css" media="all">
	<link href="./assets/stylesheets/cs.media.3x.css" rel="stylesheet" type="text/css" media="all">
	<link href="./assets/stylesheets/site.css" rel="stylesheet" type="text/css" media="all">
  	<link rel="icon" href="./images/gfx/favicon.png?v=1" type="image/png" sizes="16x16">
	
	<script src="./assets/javascripts/jquery-1.9.1.min.js" type="text/javascript"></script>
	<script src="./assets/javascripts/bootstrap.min.3x.js" type="text/javascript"></script>
</head>
<?php

if ( session_status() == PHP_SESSION_NONE ) {
	session_start();
}
include 'url/require.php';

?>
<body itemscope="" itemtype="http://schema.org/WebPage" class="templatePage notouch">
  
	<?php include'./url/header.php'; ?>
  
	<div id="content-wrapper-parent">
		<div id="content-wrapper">   
			<!-- Content -->
			<div id="content" class="clearfix">                
				<div id="breadcrumb" class="breadcrumb">
					<div itemprop="breadcrumb" class="container">
						<div class="row">
							<div class="col-md-24">
								<a href="/" class="homepage-link" title="Back to the frontpage">Home</a>
								<span>/</span>
								<span class="page-title">Contact</span>
							</div>
						</div>
					</div>
				</div>               
				<section class="content">    
					<div class="container">
						<div class="row">
							<div id="page-header">
								<h1 id="page-title"></h1>
							</div>
						</div>
					</div>
					<div id="col-main" class="contact-page clearfix">
						<div class="group-contact clearfix">
							<div class="container">
								<div class="row">
									<div class="right-block contact-content col-md-12">
										<h6 class="sb-title"><i class="fa fa-home"></i> Contact Information</h6>
										<ul class="right-content">
											<li class="title">
											<h6>Office Address</h6>
											</li>
											<li class="address">
											<p>
												Hoveniersstraat 30 Suite: 924 <br> 2018 Antwerpen - Belgium
											</p>
											</li><div>
											<li class="phone">+32 3 298 58 66</li>
											<li class="email"><i class="fa fa-envelope"></i> contact@diamantsecret.com</li></div>
										</ul>
									</div>
									<div class="col-md-12">
										
										<div id="map" style="height:350px"></div>

										<script>

										function myMap() {
										  var mapCanvas = document.getElementById("map");
										  var latlng = new google.maps.LatLng(51.2151102,4.4165775);
										  var mapOptions = {
										    center: latlng, 
										    zoom: 15,
										  }
										  var map = new google.maps.Map(mapCanvas, mapOptions);
										  var marker = new google.maps.Marker({
								                map: map,
								                position: latlng,
								            });

										}
										</script>

										<script src="https://maps.googleapis.com/maps/api/js?callback=myMap&v=3&key=AIzaSyD6JnbJVXXq-jmg_hqNOl5yWGyJraxSbd4"></script>
									</div>
								</div>
							</div>
							<div id="contact_map_wrapper">

							</div>
						</div>
					</div> 
				</section>        
			</div>
		</div>
	</div>

	<?php include './url/footer.php'; ?>
</body>