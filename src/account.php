<!doctype html>
<!--[if IE 8 ]>    <html lang="en" class="no-js ie8"> <![endif]-->
<!--[if (gt IE 9)|!(IE)]><!--> <html lang="en" class="no-js"> <!--<![endif]-->
<head>
  <meta charset="UTF-8">
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1" />
  <link rel="canonical" href="/" />
  <meta name="description" content="" />
  <title>Account Page</title>
  
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

<?php
if ( session_status() == PHP_SESSION_NONE ) {
	session_start();
}
include './url/require.php';

if ( isset($_POST['removeFromFav'])) {
	pconsole($_POST['removeFromFav']);
	$getcurrentFavs = $pdo->prepare("SELECT `favorites` FROM `accounts` WHERE `username` = :username");
	$getcurrentFavs->execute(array(":username" => $_SESSION['username']));

	$result = $getcurrentFavs->fetch(PDO::FETCH_ASSOC);
	$currentFav = $result['favorites'];

	$currentFav = str_replace(',' . $_POST['removeFromFav'], "", $currentFav);

	$updateFav = $pdo->prepare("UPDATE `accounts` SET `favorites` = :favs WHERE `username` = :username");
	$updateFav->execute ( array (":favs" => $currentFav, ":username" => $_SESSION['username']) );
} else if ( isset($_POST['removeFromCart']) ) {
	$getCart = $pdo->prepare("SELECT `cart` FROM `accounts` WHERE `username` = :user");
	$getCart->execute(array(
		":user" => $_SESSION['username']
	));
	$inputCart = $getCart->fetch(PDO::FETCH_ASSOC);
	$cart = $inputCart['cart'];
		
	$cart = str_replace($_POST['unique_key'] . '|' . $_POST['size'] . '|' . $_POST['quantity'] . ',', "", $cart);
	
	$addToCart = $pdo->prepare("UPDATE `accounts` SET `cart` = :cart WHERE `username` = :user");
	$addToCart->execute(array(
		":cart" => $cart,
		":user" => $_SESSION['username']
	));
}

?>
<body itemscope="" itemtype="http://schema.org/WebPage" class="templateCustomersRegister notouch">
  
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
								<span class="page-title">My Account</span>
							</div>
						</div>
					</div>
				</div>              
				<section class="content">
					<div class="container">
						<div class="row">
							<div id="page-header" class="col-md-24">
								<h1 id="page-title">My Account</h1> 
							</div>
							<div class="col-sm-6 col-md-6 sidebar">
								<div class="group_sidebar">
									<div class="row sb-wrapper unpadding-top">
										<h6 class="sb-title">Account Details</h6>
										<span class="mini-line"></span>
										<?php
										$getUser = $pdo->prepare("SELECT * FROM `accounts` WHERE `username` = :user");
										$getUser->execute(array(":user" => $_SESSION['username']));

										if ( $getUser->rowCount() > 0 ) {
											$user = $getUser->fetch(PDO::FETCH_ASSOC);
											echo '
											<ul id="customer_detail" class="list-unstyled sb-content">
												<li>
												<address class="clearfix">
												<div class="info">
													<i class="fa fa-user"></i>
													<span class="address-group">
													<span class="author">'. $user['first_name'] . ' ' . $user['last_name'] .'</span>
													<span class="email">'. $user['email'] .'</span>
													</span>
												</div>
												<div class="address">
													<span class="address-group">
													<span class="address1">'. $user['address'] .'<span class="phone-number">'. $user['mobileno'] .'</span></span>
													</span>
												</div>
												</address>
												</li>
												<li>
												<button class="btn btn-1" id="view_address" onclick="window.location=\'address.html\'">Settings</button>
												</li>
											</ul>
											';
										} else {
											header("location: ./login.php");
										}
										?>
									</div>
								</div>
							</div>
							<div id="col-main" class="account-page col-sm-18 col-md-18 clearfix">
								<div id="customer_orders">
									<h6 class="sb-title">Favorites</h6>
									<span class="mini-line"></span>
									<div class="row wrap-table">
										<table class="table-hover">
										<thead>
										<tr>
											<th class="order_number">
												Item
											</th>
											<th class="date">
												Value
											</th>
											<th class="payment_status">
												
											</th>
											<th class="total">
												
											</th>
										</tr>
										</thead>
										<tbody>
										<?php
										$getFavs = $pdo->prepare("SELECT * FROM `accounts` WHERE `username` = :user");
										$getFavs->execute(array(":user" => $_SESSION['username']));

										if ( $getFavs->rowCount() > 0 ) {
											$user = $getFavs->fetch(PDO::FETCH_ASSOC);

											$favorites = explode(",", $user['favorites']);

											foreach ( $favorites as $item ) {
												if ( !empty($item) ) {
													$getItemInfo = $pdo->prepare("SELECT * FROM `items` WHERE `unique_key` = :key");
													$getItemInfo->execute(array(":key" => $item));

													if ( $getItemInfo->rowCount() > 0 ) {
														$itemInfo = $getItemInfo->fetch(PDO::FETCH_ASSOC);
														$price = '<span class="price">€'. $itemInfo['item_value'] .'</span>';
														if ( $itemInfo['discount'] > 0 ) {
															
															$value = $itemInfo['item_value'] -  (($itemInfo['discount'] / 100 ) * $itemInfo['item_value']);
															$sale = '<span class="sale_banner"><span class="sale_text">Sale</span></span>';
															$price = '<span class="price_sale">€'. number_format($value, 2, ".", "") .'</span><del class="price_compare">€'. $itemInfo['item_value'] .'</del>';
														}
														echo '
														<tr class="odd ">
															<td>
																<a href="./product.php?view='. $item .'" title="">'. $itemInfo['item_name'] .'</a>
															</td>
															<td>
																<span class="note">'. $price .'</span>
															</td>
															<td>
																<span class="status_authorized"><a class="btn btn-custom" href="./product.php?view='. $item .'">View</a></span>
															</td>
															<td>
																<span class="total"><form method="post"><button class="btn btn-custom" name="removeFromFav" value="'. $item .'">Remove</button></form></span>
															</td>
														</tr>';
													} else {
														echo '
														<tr class="odd ">
															<td>
																<a href="#" title="">Item Not Found</a>
															</td>
															<td>
																<span class="note">N/A</span>
															</td>
															<td>
																<span class="status_authorized">N/A</span>
															</td>
															<td>
																<span class="status_unfulfilled">N/A</span>
															</td>
															<td>
																<span class="total"><form method="post"><button class="btn btn-custom" name="removeFromFav" value="'. $item .'">Remove</button></form></span>
															</td>
														</tr>';
													}
												}
											}
										}
										?>
										</tbody>
										</table>
									</div>
								</div>
							</div>  
						</div>
					</div>
				</section>        
			</div>
		</div>
	</div>

	<?php include './url/footer.php'; ?>


	<div id="quick-shop-modal" class="modal in" role="dialog" aria-hidden="false" tabindex="-1" data-width="800">
		<div class="modal-backdrop in" style="height: 742px;">
		</div>
		<div class="modal-dialog rotateInDownLeft animated">
			<div class="modal-content" style="min-height: 0px;">
				<div class="modal-header">
					<i class="close fa fa-times btooltip" data-toggle="tooltip" data-placement="top" title="" data-dismiss="modal" aria-hidden="true" data-original-title="Close"></i>
				</div>
				<div class="modal-body">
					<div class="quick-shop-modal-bg" style="display: none;">
					</div>
					<div class="row">
						<div class="col-md-12 product-image">
							<div id="quick-shop-image" class="product-image-wrapper">
								<a class="main-image"><img class="img-zoom img-responsive image-fly" src="./assets/images/demo_354x354.png" data-zoom-image="./assets/images/demo_354x354.png" alt=""/></a>
								<div id="gallery_main_qs" class="product-image-thumb">
								</div>	
							</div>
						</div>
						<div class="col-md-12 product-information">
							<h1 id="quick-shop-title"><span> <a href="/products/curabitur-cursus-dignis"></a></span></h1>
							<div id="quick-shop-infomation" class="description">
								<div id="quick-shop-description" class="text-left">
									
								</div>
							</div>
							<div id="quick-shop-container">
								<div id="quick-shop-relative" class="relative text-left">
									<ul class="list-unstyled">
										<li class="control-group vendor">
										<span class="control-label"></a>
										</li>
										<li class="control-group type">
										<span class="control-label"></a>
										</li>
									</ul>
								</div>
								<form method="post" enctype="multipart/form-data">
									<div id="quick-shop-price-container" class="detail-price">
										
									</div>
									<div class="quantity-wrapper clearfix">
										<label class="wrapper-title">Quantity</label>
										<div class="wrapper">
											<input type="text" id="qs-quantity" size="5" class="item-quantity" name="quantity" value="1">
											<span class="qty-group">
											<span class="qty-wrapper">
											<span class="qty-up" title="Increase" data-src="#qs-quantity">
											<i class="fa fa-plus"></i>
											</span>
											<span class="qty-down" title="Decrease" data-src="#qs-quantity">
											<i class="fa fa-minus"></i>
											</span>
											</span>
											</span>
										</div>
									</div>
                
                                    <label class="label-quick-shop">Material <span id="material-carat" style="font-size: 12px; color: #aaa; font-weight: bold;"></span></label>
                                    <input id="quick-shop-material-value" name="material" hidden />
                                    <div class="input-group" id="quick-shop-material">
                                    	<a class="btn material-badge" name="1">Yellow Gold</a>
                                    	<a class="btn material-badge" name="2">White Gold</a>
                                    	<a class="btn material-badge" name="3">Pink Gold</a>
                                    	<a class="btn material-badge" name="4">Silver</a>
                                    	<a class="btn material-badge" name="5">Platinum</a>
                                    </div>
                                    <div id="quick-shop-size">
	                                    <label class="label-quick-shop">Size <span id="material-carat" style="font-size: 12px; color: #aaa; font-weight: bold;"></span></label> 
	                                    <input id="quick-shop-size-value" name="size" value="0" hidden />
	                                    <div class="input-group" id="quick-shop-size-container">
	                                    	<!-- Sizes go here -->
	                                    </div>
	                                </div>
                                    
                                    <input id="quick-shop-unique-key" name="unique_key" hidden />
                                    <button class="btn" type="submit" name="addToCart" style="position: fixed; bottom: 15px; right: 15px; width: 200px;">Add to Cart</button>
                                    
								</form>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</body>