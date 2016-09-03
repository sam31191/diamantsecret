<!doctype html>
<!--[if IE 8 ]>    <html lang="en" class="no-js ie8"> <![endif]-->
<!--[if (gt IE 9)|!(IE)]><!--> <html lang="en" class="no-js"> <!--<![endif]-->
<head>
  <meta charset="UTF-8">
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1" />
  <link rel="canonical" href="/" />
  <meta name="description" content="" />
  <title>Jewelry HTML Template</title>
  
    <link href="./assets/stylesheets/font.css" rel='stylesheet' type='text/css'>
  
	<link href="./assets/stylesheets/font-awesome.min.css" rel="stylesheet" type="text/css" media="all"> 
	<link href="./assets/stylesheets/jquery.camera.css" rel="stylesheet" type="text/css" media="all">
	<link href="./assets/stylesheets/jquery.fancybox-buttons.css" rel="stylesheet" type="text/css" media="all">
	<link href="./assets/stylesheets/cs.animate.css" rel="stylesheet" type="text/css" media="all">
	<link href="./assets/stylesheets/application.css" rel="stylesheet" type="text/css" media="all">
	<link href="./assets/stylesheets/swatch.css" rel="stylesheet" type="text/css" media="all">
	<link href="./assets/stylesheets/jquery.owl.carousel.css" rel="stylesheet" type="text/css" media="all">
	<link href="./assets/stylesheets/jquery.bxslider.css" rel="stylesheet" type="text/css" media="all">
	<link href="./assets/stylesheets/bootstrap.min.3x.css" rel="stylesheet" type="text/css" media="all">
	<link href="./assets/stylesheets/cs.bootstrap.3x.css" rel="stylesheet" type="text/css" media="all">
	<link href="./assets/stylesheets/cs.global.css" rel="stylesheet" type="text/css" media="all">
	<link href="./assets/stylesheets/cs.style.css" rel="stylesheet" type="text/css" media="all">
	<link href="./assets/stylesheets/cs.media.3x.css" rel="stylesheet" type="text/css" media="all">
  	<link href="./assets/stylesheets/site.css" rel="stylesheet" type="text/css" media="all">
	
	<script src="./assets/javascripts/jquery-1.9.1.min.js" type="text/javascript"></script>
	<script src="./assets/javascripts/jquery.imagesloaded.min.js" type="text/javascript"></script>
	<script src="./assets/javascripts/bootstrap.min.3x.js" type="text/javascript"></script>
	<script src="./assets/javascripts/jquery.easing.1.3.js" type="text/javascript"></script>
	<script src="./assets/javascripts/jquery.camera.min.js" type="text/javascript"></script>	
	<script src="./assets/javascripts/cookies.js" type="text/javascript"></script>
	<script src="./assets/javascripts/modernizr.js" type="text/javascript"></script>  
	<script src="./assets/javascripts/application.js" type="text/javascript"></script>
	<script src="./assets/javascripts/jquery.owl.carousel.min.js" type="text/javascript"></script>
	<script src="./assets/javascripts/jquery.bxslider.js" type="text/javascript"></script>
	<script src="./assets/javascripts/skrollr.min.js" type="text/javascript"></script>
	<script src="./assets/javascripts/jquery.fancybox-buttons.js" type="text/javascript"></script>
	<script src="./assets/javascripts/jquery.zoom.js" type="text/javascript"></script>	
	<script src="./assets/javascripts/cs.script.js" type="text/javascript"></script>
</head>

<body class="templateIndex notouch">

<?php
if ( session_status() == PHP_SESSION_NONE ) {
	session_start();
}
include 'url/require.php';
if ( isset($_POST['addToCart']) ) {/*
	$getCart = $pdo->prepare("SELECT `cart`, `cart_quantity`, `cart_size` FROM `accounts` WHERE `username` = :user");
	$getCart->execute(array(
		":user" => $_SESSION['username']
	));
	$inputCart = $getCart->fetch(PDO::FETCH_ASSOC);
	$cart = $inputCart['cart'];
	$quantity = $inputCart['cart_quantity'];
	$size = $inputCart['cart_size'];

	if ( strstr($cart, $_POST['unique_key']) ) {
		//echo var_dump("Shit has already been carted dude");
		$cartItems = explode(",", $cart);
		$cartItemsQ = explode(",", $quantity);
		$cartItemsS = explode(",", $size);

		for ( $i = 0; $i < sizeof($cartItems); $i++ ) {
			if ( $cartItems[$i] == $_POST['unique_key'] && $cartItemsS[$i] == $_POST['size'] ) {
				$cartItemsQ[$i] += $_POST['quantity'];

				$cart = "";
				$quantity = "";
				$size = "";
				for ( $i = 0; $i < sizeof($cartItems) - 1; $i++ ) {
					$cart .= $cartItems[$i] . ",";
					$quantity .= $cartItemsQ[$i] . ",";
					$size .= $cartItemsS[$i] . ",";
				}
			} else if ( $cartItems[$i] == $_POST['unique_key'] && $cartItemsS[$i] !== $_POST['size'] ) {
				$cart .= $_POST['unique_key'] . ",";
				$quantity .= $_POST['quantity'] . ",";
				$size .= $_POST['size'] . ",";
			}
		}

	} else {
		$cart .= $_POST['unique_key'] . ",";
		$quantity .= $_POST['quantity'] . ",";
		$size .= $_POST['size'] . ",";
	}

	$addToCart = $pdo->prepare("UPDATE `accounts` SET `cart` = :cart, `cart_quantity` = :quantity, `cart_size` = :size WHERE `username` = :user");
	$addToCart->execute(array(
		":cart" => $cart,
		":quantity" => $quantity,
		":size" => $size,
		":user" => $_SESSION['username']
	));*/

	$cartElement = $_POST['unique_key'] . '|' . $_POST['size'] . '|';
	$fetchCurrentCart = $pdo->prepare("SELECT `cart` FROM `accounts` WHERE `username` = :user");
	$fetchCurrentCart->execute(array(":user" => $_SESSION['username']));

	$currentCart = $fetchCurrentCart->fetch(PDO::FETCH_ASSOC);
	$currentCart = $currentCart['cart'];

	if ( strstr($currentCart, $cartElement) ) { //Cart alrady has this item + size
		$cartArray = explode(",", $currentCart);
		//$carArray[2] = intval($cartArray[2]) + intval($_POST['quantity']);

		//$currentCart = $cartArray[0] . '|' . $cartArray[1] . '|' . $cartArray[2] . ','; 
		pconsole($cartArray);
		pconsole("This Echo");

		$currentCart = "";
		foreach ( $cartArray as $cartItem ) {
			if ( $cartItem !== "" ) {
				pconsole($cartItem);
				if ( strstr($cartItem, $cartElement) ) { // Match Found
					$currentQuantity = str_replace($cartElement, "", $cartItem);
					$newQ = $currentQuantity + $_POST['quantity'];

					$cartItem = $_POST['unique_key'] . '|' . $_POST['size'] . '|' . $newQ;
				}
				$currentCart .= $cartItem . ",";

				pconsole("New Cart: " . $currentCart);
			}
		}
	} else { //Cart doesn't have this, adding new
		$currentCart .= $cartElement . $_POST['quantity'] . ",";
	}

	$updateCart = $pdo->prepare("UPDATE `accounts` SET `cart` = :cart WHERE `username` = :user");
	$updateCart->execute(array(":cart" => $currentCart, ":user" => $_SESSION['username']));
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
  
	<!-- Header -->
	<?php include 'url/header.php'; ?>
  
    <div id="content-wrapper-parent">
        <div id="content-wrapper">  
			<!-- Main Slideshow -->
			<div class="home-slider-wrapper clearfix">
				<div class="camera_wrap" id="home-slider">
					<div data-src="./images/slide-image-1.jpg">
						<div class="camera_caption camera_title_1 fadeIn">
						  <a href="./collection.html" style="color:#010101;">Live the moment</a>
						</div>
						<div class="camera_caption camera_caption_1 fadeIn" style="color: rgb(1, 1, 1);">
							people of class deserve the classiest of Jewels
						</div>
						<div class="camera_caption camera_image-caption_1 moveFromLeft">
							<img src="./images/slide-image-caption-1.png" alt="image_caption">
						</div>
						<div class="camera_cta_1">
							<a href="./collection.html" class="btn">See Collection</a>
						</div>
					</div>
					<div data-src="./images/slide-image-2.jpg">
						<div class="camera_caption camera_title_2 moveFromLeft">
						  <a href="./collection.html" style="color:#666666;">Love’s embrace</a>
						</div>
						<div class="camera_caption camera_image-caption_2 moveFromLeft" style="visibility: hidden;">
							<img src="./images/slide-image-caption-2.png" alt="image_caption">
						</div>
						<div class="camera_cta_1">
							<a href="./collection.html" class="btn">See Collection</a>
						</div>
					</div>
					<div data-src="./images/slide-image-3.jpg">
						<div class="camera_caption camera_image-caption_3 moveFromLeft">
							<img src="./images/slide-image-caption-3.png" alt="image_caption">
						</div>
						<div class="camera_cta_1">
							<a href="./collection.html" class="btn">See Collection</a>
						</div>
					</div>
				</div>
			</div> 
			<!-- Content -->
			<div id="content" class="clearfix">                       
				<section class="content">  
					<div id="col-main" class="clearfix">
						<div class="home-popular-collections">
							<div class="container">
								<div class="group_home_collections row">
									<div class="col-md-24">
										<div class="home_collections">
											<h6 class="general-title">Popular Collections</h6>
											<div class="home_collections_wrapper">												
												<div id="home_collections">
																<div class="home_collections_item">
																	<div class="home_collections_item_inner">
																		<div class="collection-details">
																			<a href="./collection.html" title="Browse our Rings">
																				<img src="./images/ring_270x270.png" alt="Rings">
																			</a>
																		</div>
																		<div class="hover-overlay">
																			<span class="col-name"><a href="./collection.html">Rings</a></span>
																			<div class="collection-action">
																				<a href="./collection.html">See the Collection</a>
																			</div>
																		</div>
																	</div>
																</div>
																<div class="home_collections_item">
																	<div class="home_collections_item_inner">
																		<div class="collection-details">
																			<a href="./collection.html" title="Browse our Earrings">
																			<img src="./images/earring_270x270.png" alt="Earrings">
																			</a>
																		</div>
																		<div class="hover-overlay">
																			<span class="col-name"><a href="./collection.html">Earrings</a></span>
																			<div class="collection-action">
																				<a href="./collection.html">See the Collection</a>
																			</div>
																		</div>
																	</div>
																</div>
																<div class="home_collections_item">
																	<div class="home_collections_item_inner">
																		<div class="collection-details">
																			<a href="./collection.html" title="Browse our Pendants">
																			<img src="./images/pendant_270x270.png" alt="Pendants">
																			</a>
																		</div>
																		<div class="hover-overlay">
																			<span class="col-name"><a href="./collection.html">Pendants</a></span>
																			<div class="collection-action">
																				<a href="./collection.html">See the Collection</a>
																			</div>
																		</div>
																	</div>
																</div>
																<div class="home_collections_item">
																	<div class="home_collections_item_inner">
																		<div class="collection-details">
																			<a href="./collection.html" title="Browse our Necklaces">
																			<img src="./images/necklace_270x270.png" alt="Necklaces">
																			</a>
																		</div>
																		<div class="hover-overlay">
																			<span class="col-name"><a href="./collection.html">Necklaces</a></span>
																			<div class="collection-action">
																				<a href="./collection.html">See the Collection</a>
																			</div>
																		</div>
																	</div>
																</div>
																<div class="home_collections_item">
																	<div class="home_collections_item_inner">
																		<div class="collection-details">
																			<a href="./collection.html" title="Browse our Bracelets">
																				<img src="./images/bracelet_270x270.png" alt="Bracelets">
																			</a>
																		</div>
																		<div class="hover-overlay">
																			<span class="col-name"><a href="./collection.html">Bracelets</a></span>
																			<div class="collection-action">
																				<a href="./collection.html">See the Collection</a>
																			</div>
																		</div>
																	</div>
																</div>
													</div>													
												</div>
											</div>
										</div>
										<script>
										  $(document).ready(function() {
											$('.collection-details').hover(
											  function() {
												$(this).parent().addClass("collection-hovered");
											  },
											  function() {
											  $(this).parent().removeClass("collection-hovered");
											  });
										  });
										</script>
									</div>
								</div>
						</div>
						<div class="home-newproduct">
							<div class="container">
								<div class="group_home_products row">
									<div class="col-md-24">
										<div class="home_products">
											<h6 class="general-title">New Products</h6>
											<div class="home_products_wrapper">
												<div id="home_products">
                                                <?php
												$fetchNew = $pdo->prepare("SELECT * FROM `items` ORDER BY `date_added` DESC LIMIT 6");
												$fetchNew->execute();
												
												$newProducts = $fetchNew->fetchAll();
												
												foreach ( $newProducts as $product ) {
													switch ($product['category']) {
														case 1: {
															$getInfo = $pdo->prepare("SELECT * FROM `rings` WHERE `unique_key` = :unique_key");
															break;
														} case 2: {
															$getInfo = $pdo->prepare("SELECT * FROM `earrings` WHERE `unique_key` = :unique_key");
															break;
														} case 3: {
															$getInfo = $pdo->prepare("SELECT * FROM `pendants` WHERE `unique_key` = :unique_key");
															break;
														} case 4: {
															$getInfo = $pdo->prepare("SELECT * FROM `necklaces` WHERE `unique_key` = :unique_key");
															break;
														} case 5: {
															$getInfo = $pdo->prepare("SELECT * FROM `bracelets` WHERE `unique_key` = :unique_key");
															break;
														} 
														default:
															# code...
															break;
													}

													$getInfo->execute(array(":unique_key" => $product['unique_key']));
													$info = $getInfo->fetch(PDO::FETCH_ASSOC);

													$images = $info['images'];
													$images = explode(",", $images);

													if ( $images[0] == "" ) {
														$images[0] = "0.png";
													}
													
													$sale = "";
													$price = '<span class="price">€'. $product['item_value'] .'</span>';
													if ( $product['discount'] > 0 ) {
														
														$value = $product['item_value'] -  (($product['discount'] / 100 ) * $product['item_value']);
														$sale = '<span class="sale_banner"><span class="sale_text">Sale</span></span>';
														$price = '<span class="price_sale">€'. round($value, 2) .'</span><del class="price_compare">€'. $product['item_value'] .'</del>';
													}

													if ( strstr($favorites, $product['unique_key']) ) {
														$wishlist = '<a class="wish-list" href="javascript:void(0);" id="fav_'. $product['unique_key'] .'" onClick="removeFromWishlist(\''. $product['unique_key'] .'\')"><i class="fa fa-heart fav-true"></i><span class="list-mode">Remove from Wishlist</span></a>';
													} else {
														$wishlist = '<a class="wish-list" href="javascript:void(0);" id="fav_'. $product['unique_key'] .'" onClick="addToWishlist(\''. $product['unique_key'] .'\')"><i class="fa fa-heart"></i><span class="list-mode">Add to Wishlist</span></a>';
													}
													
													echo '
												<div class="element no_full_width col-md-8 col-sm-8 not-animated" data-animate="fadeInUp" data-delay="0">
														<ul class="row-container list-unstyled clearfix">
															<li class="row-left">
															<a href="./product.html?show='. $product['unique_key'] .'" class="container_item"  style="height:375px;">
															<img src="./images/'. $images[0] .'" class="img-responsive" alt="Curabitur cursus dignis">
															'. $sale .'
															</a>
															<div class="hbw">
																<span class="hoverBorderWrapper"></span>
															</div>
															</li>
															<li class="row-right parent-fly animMix">
															<div class="product-content-left">
																<a class="title-5" href="./product.html?show='. $product['unique_key'] .'">'. $product['item_name'] .'</a>
																<span class="spr-badge" id="spr_badge_12932382113" data-rating="0.0">
																<span class="spr-starrating spr-badge-starrating"><i class="spr-icon spr-icon-star-empty" style=""></i><i class="spr-icon spr-icon-star-empty" style=""></i><i class="spr-icon spr-icon-star-empty" style=""></i><i class="spr-icon spr-icon-star-empty" style=""></i><i class="spr-icon spr-icon-star-empty" style=""></i></span>
																<span class="spr-badge-caption">
																No reviews </span>
																</span>
															</div>
															<div class="product-content-right">
																<div class="product-price">
																	'. $price .'
																</div>
															</div>
															<div class="list-mode-description">
																 Nam libero tempore, cum soluta nobis est eligendi optio cumque nihil impedit quo minus id quod maxime placeat facere possimus, omnis amet voluptas assumenda est, omnis dolor repellendus quis nostrum. Temporibus autem quibusdam et aut officiis debitis aut rerum dolorem necessitatibus saepe eveniet ut et neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit, sed...
															</div>
															<div class="hover-appear">
																<form action="./product.html" method="post">
																	<div class="effect-ajax-cart">
																		<input type="hidden" name="quantity" value="1">
																		<button class="select-option" type="button" onclick="window.location.href=\'product.html\'"><i class="fa fa-th-list" title="Select Options"></i><span class="list-mode">Select Option</span></button>
																	</div>
																</form>
																<div class="product-ajax-qs hidden-xs hidden-sm">
																	<div data-href="./ajax/_product-qs.html" class="quick_shop" onclick="quickShop(\''. $product['unique_key'] .'\')">
																		<i class="fa fa-eye" title="Quick view"></i><span class="list-mode">Quick View</span>																		
																	</div>
																</div>
																'. $wishlist .'
															</div>
															</li>
														</ul>
													</div> 
													';
												}
												?>
													               
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="home-banner-wrapper">
							<div class="container">
								<div id="home-banner" class="text-center clearfix">
									<img class="pulse img-banner-caption" src="./images/home_banner_image_text.png" alt="">
									<div class="home-banner-caption">
										<p>
											Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.<br>
											 Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.
										</p>
									</div>
									<div class="home-banner-action">
										<a href="./collection.html">Shop Now</a>
									</div>
								</div>
							</div>
						</div>

						<!-- Home Blog Removed Here -->


						<div class="home-feature">
							<div class="container">
								<div class="group_featured_products row">
									<div class="col-md-24">
										<div class="home_fp">
											<h6 class="general-title">Featured Products</h6>
											<div class="home_fp_wrapper">
												<div id="home_fp">
													<?php
													$fetchFeatured = $pdo->prepare("SELECT * FROM `items` WHERE `featured` = 1");
													$fetchFeatured->execute();

													$featuredItems = $fetchFeatured->fetchAll();


													$delay = 0;
													foreach ( $featuredItems as $product ) {
														switch ($product['category']) {
														case 1: {
															$getInfo = $pdo->prepare("SELECT * FROM `rings` WHERE `unique_key` = :unique_key");
															break;
														} case 2: {
															$getInfo = $pdo->prepare("SELECT * FROM `earrings` WHERE `unique_key` = :unique_key");
															break;
														} case 3: {
															$getInfo = $pdo->prepare("SELECT * FROM `pendants` WHERE `unique_key` = :unique_key");
															break;
														} case 4: {
															$getInfo = $pdo->prepare("SELECT * FROM `necklaces` WHERE `unique_key` = :unique_key");
															break;
														} case 5: {
															$getInfo = $pdo->prepare("SELECT * FROM `bracelets` WHERE `unique_key` = :unique_key");
															break;
														} 
														default:
															# code...
															break;
													}

													$getInfo->execute(array(":unique_key" => $product['unique_key']));
													$info = $getInfo->fetch(PDO::FETCH_ASSOC);

													$images = $info['images'];
													$images = explode(",", $images);

													if ( $images[0] == "" ) {
														$images[0] = "0.png";
													}

														$sale = "";
														$price = '<span class="price">€'. $product['item_value'] .'</span>';
														if ( $product['discount'] > 0 ) {
															
															$value = $product['item_value'] -  (($product['discount'] / 100 ) * $product['item_value']);
															$sale = '<span class="sale_banner"><span class="sale_text">Sale</span></span>';
															$price = '<span class="price_sale">€'. round($value, 2) .'</span><del class="price_compare">€'. $product['item_value'] .'</del>';
														}


														if ( strstr($favorites, $product['unique_key']) ) {
															$wishlist = '<a class="wish-list" href="javascript:void(0);" id="fav_'. $product['unique_key'] .'_FEAT" onClick="removeFromWishlist(\''. $product['unique_key'] .'\')"><i class="fa fa-heart fav-true"></i><span class="list-mode">Remove from Wishlist</span></a>';
														} else {
															$wishlist = '<a class="wish-list" href="javascript:void(0);" id="fav_'. $product['unique_key'] .'_FEAT" onClick="addToWishlist(\''. $product['unique_key'] .'\')"><i class="fa fa-heart"></i><span class="list-mode">Add to Wishlist</span></a>';
														}
														

														echo '   																						
													<div class="element no_full_width not-animated" data-animate="fadeInUp" data-delay="'. $delay .'">
														<ul class="row-container list-unstyled clearfix">
															<li class="row-left">
															<a href="./product.html" class="container_item" style="height:277px;">
															<img src="./images/'. $images[0] .'" class="img-responsive" alt="Curabitur cursus dignis">
															'. $sale .'
															</a>
															<div class="hbw">
																<span class="hoverBorderWrapper"></span>
															</div>
															</li>
															<li class="row-right parent-fly animMix">
															<div class="product-content-left">
																<a class="title-5" href="./product.html">'. $product['item_name'] .'</a>
																<span class="spr-badge" id="spr_badge_1293238211" data-rating="0.0">
																<span class="spr-starrating spr-badge-starrating"><i class="spr-icon spr-icon-star-empty" style=""></i><i class="spr-icon spr-icon-star-empty" style=""></i><i class="spr-icon spr-icon-star-empty" style=""></i><i class="spr-icon spr-icon-star-empty" style=""></i><i class="spr-icon spr-icon-star-empty" style=""></i></span>
																<span class="spr-badge-caption">
																No reviews </span>
																</span>
															</div>
															<div class="product-content-right">
															'. $price .'
															</div>
															<div class="list-mode-description">
																 Nam libero tempore, cum soluta nobis est eligendi optio cumque nihil impedit quo minus id quod maxime placeat facere possimus, omnis amet voluptas assumenda est, omnis dolor repellendus quis nostrum. Temporibus autem quibusdam et aut officiis debitis aut rerum dolorem necessitatibus saepe eveniet ut et neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit, sed...
															</div>
															<div class="hover-appear">
																<form action="./product.html" method="post">
																	<div class="effect-ajax-cart">
																		<input type="hidden" name="quantity" value="1">
																		<button class="select-option" type="button" onclick="window.location.href=\'product.html\'"><i class="fa fa-th-list" title="Select Options"></i><span class="list-mode">Select Option</span></button>
																	</div>
																</form>
																<div class="product-ajax-qs hidden-xs hidden-sm">
																	<div data-href="./ajax/_product-qs.html" class="quick_shop" onclick="quickShop(\''. $product['unique_key'] .'\')">
																		<i class="fa fa-eye" title="Quick view"></i><span class="list-mode">Quick View</span>																		
																	</div>
																</div>
																'. $wishlist .'
															</div>
															</li>
														</ul>
													</div>';

													$delay += 200;
													}
													?> 			                          
												</div>
											</div>
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
	
	<?php include 'url/footer.php'; ?>
	
	<div class="newsletter-popup" style="display: none;">
		<form action="http://codespot.us5.list-manage.com/subscribe/post?u=ed73bc2d2f8ae97778246702e&amp;id=c63b4d644d" method="post" name="mc-embedded-subscribe-form" target="_blank">
			<h4>-50% Deal</h4>
			<p class="tagline">
				subscribe for newsletter and get the item for 50% off
			</p>
			<div class="group_input">
				<input class="form-control" type="email" name="EMAIL" placeholder="YOUR EMAIL">
				<button class="btn" type="submit"><i class="fa fa-paper-plane"></i></button>
			</div>
		</form>
		<div id="popup-hide">
			<input type="checkbox" id="mc-popup-hide" value="1" checked="checked"><label for="mc-popup-hide">Never show this message again</label>
		</div>
	</div>
	
	<script src="assets/javascripts/cs.global.js" type="text/javascript"></script>
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
							<h1 id="quick-shop-title"><span> <a href="/products/curabitur-cursus-dignis">Curabitur cursus dignis</a></span></h1>
							<div id="quick-shop-infomation" class="description">
								<div id="quick-shop-description" class="text-left">
									<p>
										Nam libero tempore, cum soluta nobis est eligendi optio cumque nihil impedit quo minus id quod maxime placeat facere possimus, omnis amet voluptas assumenda est, omnis dolor repellendus quis nostrum.
									</p>
									<p>
										Temporibus autem quibusdam et aut officiis debitis aut rerum dolorem necessitatibus saepe eveniet ut et neque porro quisquam est, qui dolorem ipsum quia dolor s...
									</p>
								</div>
							</div>
							<div id="quick-shop-container">
								<div id="quick-shop-relative" class="relative text-left">
									<ul class="list-unstyled">
										<li class="control-group vendor">
										<span class="control-label">Vendor :</span><a href="/collections/vendors?q=Vendor+1"> Vendor 1</a>
										</li>
										<li class="control-group type">
										<span class="control-label">Type :</span><a href="/collections/types?q=Sweaters+Wear"> Sweaters Wear</a>
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
<script>
function quickDisplay(src) {
	//alert($(src).attr("value"));
	
	$("#quick-shop-image .main-image img").attr("src", $(src).attr("value"));
	//$('#quick-shop-img').attr("src", src);
}

function quickShop(id) {
	if (id == "") {
		document.getElementById("quick-shop-modal").innerHTML = "";
		return;
	} else { 
		if (window.XMLHttpRequest) {
			// code for IE7+, Firefox, Chrome, Opera, Safari
			xmlhttp = new XMLHttpRequest();
		} else {
			// code for IE6, IE5
			xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
		}
		xmlhttp.onreadystatechange = function() {
			if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
				var result = JSON.parse(xmlhttp.responseText);
				console.log(result);
				images = result['images'].split(",");
				//$("#quick-shop-modal").html(xmlhttp.responseText);
				//console.log(xmlhttp.responseText);
				//Item Image
				if ( result['images'] == "" ) {
					images[0] = "0.png";
				}	
				$("#quick-shop-image .main-image img").attr("src", "./images/" + images[0]);
				
				//Remove old Thumbs if any
				var currentThumbs = $(".image-thumb").length;
				for (var i = 0; i < currentThumbs; i++ ) {
					//console.log("1 Item Removed");
					$('#gallery_main_qs').owlCarousel().data('owlCarousel').removeItem();
				}
				//Item Thumbnals
				for ( var i = 0; i < images.length-1; i++ ) {
					content = '<a class="image-thumb" onClick="quickDisplay(this)" value="./images/'+ images[i] +'" ><img src="./images/thumbnails/'+ images[i] +'" alt=""/></a>';
					//console.log("1 Item Added");
					$('#gallery_main_qs').owlCarousel().data('owlCarousel').addItem(content);
					$('.owl-item').toggleClass('show-item');
				}
				//Item Name
				$("#quick-shop-title a").text(result['item_name']);
				
				//Desc
				$("#quick-shop-description").html(result['description']);
				
				//Price
				if ( result['discount'] > 0 ) {
					discount = result['item_value'] - ( (result['discount'] / 100 ) * result['item_value']);
					price = '<span class="price_sale">€'+ discount.toFixed(2) +'</span><span class="dash">/</span><del class="price_compare">€'+ result['item_value'] +'</del>';
				} else {
					price = '<span class="price">€'+ result['item_value'] +'</span><span class="dash">';
				}
				$("#quick-shop-price-container").html(price);

				//Quantity 
				$("#qs-quantity").attr("max", result['pieces_in_stock']);
				
				//Material
				$("#material-carat").text(result['total_carat_weight'] + " ct.");
				$("#quick-shop-material a").each(function(index, element) {
					//alert ($(element).attr("name"));
					if ( $(element).attr("name") !== result['material'] ) {
						$(element).attr("disabled", true);
					} else {
						$(element).attr("disabled", false);
					}
                });
				
				//Size
				if ( result['category'] == 1 ) {
					sizehtml = "";
					sizes = result['ring_size'].split(",");
					//console.log(sizes);
					for ( var i = 0; i < sizes.length; i++ ) {
						if ( i == 0 ) {
							sizehtml += '<a class="btn size-badge size-badge-active" name="'+ sizes[i] +'" onClick="selectSize(this)">'+ sizes[i] +'</a>';
							$("#quick-shop-size-value").val(sizes[i]);
						} else {
							sizehtml += '<a class="btn size-badge" name="'+ sizes[i] +'" onClick="selectSize(this)">'+ sizes[i] +'</a>';
						}
					}
					//console.log(sizehtml);
					$("#quick-shop-size-container").html(sizehtml);
					$("#quick-shop-size").show();
				} else {
					$("#quick-shop-size").hide();
				}

				$("#quick-shop-unique-key").val(result['unique_key']);
				$("#quick-shop-modal").modal("toggle");
			}
		};
		xmlhttp.open("GET","./url/fetch_item_info.php?id="+id, true);
		xmlhttp.send();
	}
}

function selectSize (e) {
	$(".size-badge").each(function(index, element) {
        if ( $(element).attr("name") == $(e).attr("name") ) {
			$(element).addClass("size-badge-active");
			$("#quick-shop-size-value").val($(element).attr("name"));
			
			console.log("Value: " + $("#quick-shop-size").val());
		} else {
			$(element).removeClass("size-badge-active");
		}
    });
};


function addToWishlist(key) {
	//alert(key);
	  	if (window.XMLHttpRequest) {
	      	// code for IE7+, Firefox, Chrome, Opera, Safari
	  	    xmlhttp = new XMLHttpRequest();
	  	} else {
	      	// code for IE6, IE5
	      	xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
	  	}
	  	xmlhttp.onreadystatechange = function() {
	      	if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
			  	$("#fav_"+key+" i").addClass("fav-true");
			  	$("#fav_"+key).removeAttr("onClick");
			  	$("#fav_"+key).attr("onClick", "removeFromWishlist('"+ key +"')");
			  	$("#fav_"+key).attr("data-original-title", "Un-favorites it!");
			  
			  	//Featured Workaround
			  	$("#fav_"+key+"_FEAT"+" i").addClass("fav-true");
			  	$("#fav_"+key+"_FEAT").removeAttr("onClick");
			  	$("#fav_"+key+"_FEAT").attr("onClick", "removeFromWishlist('"+ key +"')");
			  	$("#fav_"+key+"_FEAT").attr("data-original-title", "Un-favorites it!");

			  	$("#favorite_num_badge").text(parseInt($("#favorite_num_badge").text()) + 1);

			  	console.log(xmlhttp.responseText);
	  		};
	  	}
	xmlhttp.open("GET","url/ajax.php?addtoFav="+key,true);
	xmlhttp.send();
}


function removeFromWishlist(key) {
  if (window.XMLHttpRequest) {
      // code for IE7+, Firefox, Chrome, Opera, Safari
      xmlhttp = new XMLHttpRequest();
  } else {
      // code for IE6, IE5
      xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
  }
  xmlhttp.onreadystatechange = function() {
      if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
          $("#fav_"+key+" i").removeClass("fav-true");
		  $("#fav_"+key).removeAttr("onClick");
		  $("#fav_"+key).attr("onClick", "addToWishlist('"+ key +"')");
		  $("#fav_"+key).attr("data-original-title", "Favorite it!");
		  
		  //Feature Workaround
          $("#fav_"+key+"_FEAT"+" i").removeClass("fav-true");
		  $("#fav_"+key+"_FEAT").removeAttr("onClick");
		  $("#fav_"+key+"_FEAT").attr("onClick", "addToWishlist('"+ key +"')");
		  $("#fav_"+key+"_FEAT").attr("data-original-title", "Favorite it!");

		  $("#favorite_num_badge").text(parseInt($("#favorite_num_badge").text()) - 1);
		  console.log(xmlhttp.responseText);
      }
  };
  xmlhttp.open("GET","url/ajax.php?removeFromFav="+key,true);
  xmlhttp.send();
}
</script>
<?php
pconsole($_SESSION);
pconsole($_POST);

?>