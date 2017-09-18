<?php
if ( session_status() == PHP_SESSION_NONE ) {
	session_start();
}

include 'conf/config.php';
include './url/pre.php';

?>
<!doctype html>
<!--[if IE 8 ]>    <html lang="en" class="no-js ie8"> <![endif]-->
<!--[if (gt IE 9)|!(IE)]><!--> <html lang="en" class="no-js"> <!--<![endif]-->
<head>
  <meta charset="UTF-8">
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1" />
  <link rel="canonical" href="/" />
  <meta name="description" content="" />
  <title>Home</title>
  
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
  	<link rel="icon" href="./images/gfx/favicon.png?v=1" type="image/png" sizes="16x16">
	
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

if ( isset($_POST['addToCart']) && $_SESSION['loggedIn']  ) {
    $checkCart = $pdo->prepare("SELECT * FROM tb_cart WHERE user_id = :uid AND product_id = :pid AND size = :size");
    $checkCart->execute(array(":uid" => $_SESSION['user_id'], ":pid" => $_POST['unique_key'], ":size" => $_POST['size']));

    if ( $checkCart->rowCount() > 0 ) {
        $updateCart = $pdo->prepare("UPDATE tb_cart SET quantity = quantity + :quantity WHERE user_id = :uid AND product_id = :pid AND size = :size");
        $updateCart->execute(array(":uid" => $_SESSION['user_id'], ":pid" => $_POST['unique_key'], ":size" => $_POST['size'], ":quantity" => intval($_POST['quantity'])));
    } else {
        $updateCart = $pdo->prepare("INSERT INTO tb_cart (quantity, user_id, product_id, size) VALUES (:quantity, :uid, :pid, :size)");
        $updateCart->execute(array(":uid" => $_SESSION['user_id'], ":pid" => $_POST['unique_key'], ":size" => $_POST['size'], ":quantity" => intval($_POST['quantity'])));
    }

} else if ( isset($_POST['removeFromCart']) && $_SESSION['loggedIn']  ) {
    $updateCart = $pdo->prepare("DELETE FROM tb_cart WHERE user_id = :uid AND product_id = :pid AND size = :size AND quantity = :quantity");
    $updateCart->execute(array(":uid" => $_SESSION['user_id'], ":pid" => $_POST['unique_key'], ":size" => $_POST['size'], ":quantity" => intval($_POST['quantity'])));

}
?>
  
	<!-- Header -->
	<?php include 'url/header.php'; ?>
  
    <div id="content-wrapper-parent">
        <div id="content-wrapper">  
			<!-- Main Slideshow -->
			<div class="home-slider-wrapper clearfix">
				<div class="camera_wrap" id="home-slider"  style="max-height: 650px;">
					<div data-src="./images/gfx/slide-image-1.jpg">
						<div class="camera_caption camera_title_1 fadeIn">
						  <a href="./collection.php" style="color:#010101;"><?php echo __("Live the moment"); ?></a>
						</div>
						<div class="camera_caption camera_caption_1 fadeIn" style="color: rgb(1, 1, 1);">
						</div>
						<div class="camera_caption camera_image-caption_1 moveFromLeft">
							<img src="./images/gfx/slide-image-caption-1.png" alt="image_caption">
						</div>
						<div class="camera_cta_1">
							<a href="./collection.php" class="btn"><?php echo __("See Collection"); ?></a>
						</div>
					</div>
					<div data-src="./images/gfx/slide-image-2.jpg">
						<div class="camera_caption camera_title_2 moveFromLeft">
						  <a href="./collection.php" style="color:#666666;"><?php echo __("Love’s embrace"); ?></a>
						</div>
						<div class="camera_caption camera_image-caption_2 moveFromLeft" style="visibility: hidden;">
							<img src="./images/gfx/slide-image-caption-2.png" alt="image_caption">
						</div>
						<div class="camera_cta_1">
							<a href="./collection.php" class="btn"><?php echo __("See Collection"); ?></a>
						</div>
					</div>
					<div data-src="./images/gfx/slide-image-3.jpg">
						<div class="camera_caption camera_image-caption_3 moveFromLeft">
							<!-- <img src="./images/gfx/slide-image-caption-3.png" alt="image_caption"> -->
							<p style="font-size: 45px; font-weight: normal; color: black; font-variant: small-caps;"><?php echo __("Have a Diamond in mind"); ?>?<br><small><?php echo __("Search for the perfect diamond for you"); ?>!</small></p>
						</div>
						<div class="camera_cta_1">
							<a href="./diamond_search.php" class="btn"><?php echo __("Search Now"); ?></a>
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
											<h6 class="general-title"><?php echo __("Popular Collections"); ?></h6>
											<div class="home_collections_wrapper">												
												<div id="home_collections">
																<div class="home_collections_item">
																	<div class="home_collections_item_inner">
																		<div class="collection-details">
																			<a href="./collection_rings.php" title="<?php echo __("Browse our Rings"); ?>">
																				<img src="./images/gfx/ring_270x270.png" alt="Rings">
																			</a>
																		</div>
																		<div class="hover-overlay">
																			<span class="col-name"><a href="./collection_rings.php"><?php echo __("Rings"); ?></a></span>
																			<div class="collection-action">
																				<a href="./collection_rings.php"><?php echo __("See the Collection"); ?></a>
																			</div>
																		</div>
																	</div>
																</div>
																<div class="home_collections_item">
																	<div class="home_collections_item_inner">
																		<div class="collection-details">
																			<a href="./collection_earrings.php" title="<?php echo __("Browse our Earrings"); ?>">
																			<img src="./images/gfx/earring_270x270.png" alt="Earrings">
																			</a>
																		</div>
																		<div class="hover-overlay">
																			<span class="col-name"><a href="./collection_earrings.php"><?php echo __("Earrings"); ?></a></span>
																			<div class="collection-action">
																				<a href="./collection_earrings.php"><?php echo __("See the Collection"); ?></a>
																			</div>
																		</div>
																	</div>
																</div>
																<div class="home_collections_item">
																	<div class="home_collections_item_inner">
																		<div class="collection-details">
																			<a href="./collection_pendants.php" title="<?php echo __("Browse our Pendants"); ?>">
																			<img src="./images/gfx/pendant_270x270.png" alt="Pendants">
																			</a>
																		</div>
																		<div class="hover-overlay">
																			<span class="col-name"><a href="./collection_pendants.php"><?php echo __("Pendants"); ?></a></span>
																			<div class="collection-action">
																				<a href="./collection_pendants.php"><?php echo __("See the Collection"); ?></a>
																			</div>
																		</div>
																	</div>
																</div>
																<div class="home_collections_item">
																	<div class="home_collections_item_inner">
																		<div class="collection-details">
																			<a href="./collection_necklaces.php" title="<?php echo __("Browse our Necklaces"); ?>">
																			<img src="./images/gfx/necklace_270x270.png" alt="Necklaces">
																			</a>
																		</div>
																		<div class="hover-overlay">
																			<span class="col-name"><a href="./collection_necklaces.php"><?php echo __("Necklaces"); ?></a></span>
																			<div class="collection-action">
																				<a href="./collection_necklaces.php"><?php echo __("See the Collection"); ?></a>
																			</div>
																		</div>
																	</div>
																</div>
																<div class="home_collections_item">
																	<div class="home_collections_item_inner">
																		<div class="collection-details">
																			<a href="./collection_bracelets.php" title="<?php echo __("Browse our Bracelets"); ?>">
																				<img src="./images/gfx/bracelet_270x270.png" alt="Bracelets">
																			</a>
																		</div>
																		<div class="hover-overlay">
																			<span class="col-name"><a href="./collection_bracelets.php"><?php echo __("Bracelets"); ?></a></span>
																			<div class="collection-action">
																				<a href="./collection_bracelets.php"><?php echo __("See the Collection"); ?></a>
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
											<h6 class="general-title"><?php echo __("New Products"); ?></h6>
											<div class="home_products_wrapper">
												<div id="home_products">
                                                <?php
												$fetchNew = $pdo->prepare("SELECT * FROM `items` WHERE site_0 = 1 AND disabled = 0 ORDER BY `date_added` DESC LIMIT 6");
												$fetchNew->execute();
												
												$newProducts = $fetchNew->fetchAll();
												$delay = 0;
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
														$sale = '<span class="sale_banner"><span class="sale_text">'.__("Sale").'</span></span>';
														$price = '<span class="price_sale">€'. round($value, 2) .'</span><del class="price_compare">€'. $product['item_value'] .'</del>';
													}

													if ( strstr($favorites, $product['unique_key']) ) {
														$wishlist = '<a class="wish-list" href="javascript:void(0);" id="fav_'. $product['unique_key'] .'" onClick="removeFromWishlist(\''. $product['unique_key'] .'\')"><i class="fa fa-heart fav-true"></i><span class="list-mode">'.__("Remove from Wishlist").'</span></a>';
													} else {
														$wishlist = '<a class="wish-list" href="javascript:void(0);" id="fav_'. $product['unique_key'] .'" onClick="addToWishlist(\''. $product['unique_key'] .'\')"><i class="fa fa-heart"></i><span class="list-mode">'.__("Add to Wishlist").'</span></a>';
													}

													if ( !isset($_SESSION['loggedIn']) || !$_SESSION['loggedIn'] ) {
														$wishlist = "";
													}

													if ( !is_file( './images/images_md/'. $images[0] ) ) {
														$images[0] = "0.png";
													}

													echo '
												<div class="element no_full_width bounceIn col-md-8 col-sm-8 not-animated" data-animate="fadeInUp" data-delay="'. $delay .'">
														<ul class="row-container list-unstyled clearfix">
															<li class="row-left">
															<a href="./product.php?view='. $product['unique_key'] .'" class="container_item"  style="max-height:375px !important;">
															<img src="./images/images_md/'. $images[0] .'?v='. time() .'" class="img-responsive" alt="">
															'. $sale .'
															</a>
															<div class="hbw">
																<span class="hoverBorderWrapper"></span>
															</div>
															</li>
															<li class="row-right parent-fly animMix">
															<div class="product-content-left">
																<a class="title-5" href="./product.php?view='. $product['unique_key'] .'">'. $product['item_name'] .'</a>
																<span class="spr-badge" id="spr_badge_12932382113" data-rating="0.0">
																<span class="spr-starrating spr-badge-starrating"><i class="spr-icon spr-icon-star-empty" style=""></i><i class="spr-icon spr-icon-star-empty" style=""></i><i class="spr-icon spr-icon-star-empty" style=""></i><i class="spr-icon spr-icon-star-empty" style=""></i><i class="spr-icon spr-icon-star-empty" style=""></i></span>
																<span class="spr-badge-caption">
																'.__("No reviews").' </span>
																</span>
															</div>
															<div class="product-content-right">
																<div class="product-price">
																	'. $price .'
																</div>
															</div>
															<div class="list-mode-description">
																 
															</div>
															<div class="hover-appear">
																<form action="./product.php?view='. $product['unique_key'] .'" method="post">
																	<div class="effect-ajax-cart">
																		<input type="hidden" name="quantity" value="1">
																		<button class="select-option" type="button" onclick="window.location.href=\'product.php?view='. $product['unique_key'] .'\'"><i class="fa fa-th-list" title="'.__("Select Options").'"></i><span class="list-mode">'.__("Select Option").'</span></button>
																	</div>
																</form>
																<div class="product-ajax-qs hidden-xs hidden-sm">
																	<div class="quick_shop" onclick="quickShop(\''. $product['unique_key'] .'\')">
																		<i class="fa fa-eye" title="'.__("Quick View").'"></i><span class="list-mode">'.__("Quick View").'</span>																		
																	</div>
																</div>
																'. $wishlist .'
															</div>
															</li>
														</ul>
													</div> 
													';

													$delay += 100;
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
									<img class="pulse img-banner-caption" src="./images/gfx/home_banner_image_text.png" alt="">
									<div class="home-banner-caption">
									<?php
									$quotes = array(
										
										"“".__('For me, Jewelry is a way to keep the memories alive.')."”",

 										"“".__("Diamonds are a girl's best friend.")."” ― Marilyn Monroe",
									);
									$quote = $quotes[rand(0, sizeof($quotes)-1)];
									echo '<p>'. $quote .'</p>';
									?>
									</div>
									<div class="home-banner-action">
										<a href="./collection.php"><?php echo __("Shop Now"); ?></a>
									</div>
								</div>
							</div>
						</div>

						<!-- Home Blog Removed Here -->


						<!-- <div class="container">
							<div class="col-md-24">
								<h6 class="general-title" style="margin-bottom: 15px;">Diamond Search</h6>
								<p style="text-align: center;">Have a Diamond in mind? Find the perfect Diamond for you through us!</p>

								<div class="camera_cta_1" style="    text-align: center; margin: 10px 0 25px;">
									<a href="./diamond_search.php" class="btn">Search Now</a>
								</div>
							</div>
						</div> -->

						<div class="diamond-search-dialog" style="text-align: center;">
							<i class="fa fa-times diamond-search-dialog-close" onclick="$('.diamond-search-dialog').hide();"></i>
							<span style=" text-align: center; font-variant: small-caps;"> 
								<i class="fa fa-diamond" style="font-size: 10px;color: #a07936;"></i> 
								<i class="fa fa-diamond" style="color: #a07936;"></i> 
								<i class="fa fa-diamond" style="font-size: 10px;color: #a07936;"></i> 

								<br><?php echo __("Find your perfect Diamond here"); ?></span><br/>

								<a href="./diamond_search.php" class="btn" style="margin-top: 10px;"><?php echo __("Search Now"); ?></a>
						</div>

						<div class="home-feature">
							<div class="container">
								<div class="group_featured_products row">
									<div class="col-md-24">
										<div class="home_fp">
											<h6 class="general-title"><?php echo __("Featured Products"); ?></h6>
											<div class="home_fp_wrapper">
												<div id="home_fp">
													<?php
													$fetchFeatured = $pdo->prepare("SELECT * FROM `items` WHERE `featured` = 1 AND site_0 = 1 AND disabled = 0 LIMIT 20");
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
															$sale = '<span class="sale_banner"><span class="sale_text">'.__("Sale").'</span></span>';
															$price = '<span class="price_sale">€'. round($value, 2) .'</span><del class="price_compare">€'. $product['item_value'] .'</del>';
														}


														if ( strstr($favorites, $product['unique_key']) ) {
															$wishlist = '<a class="wish-list" href="javascript:void(0);" id="fav_'. $product['unique_key'] .'_FEAT" onClick="removeFromWishlist(\''. $product['unique_key'] .'\')"><i class="fa fa-heart fav-true"></i><span class="list-mode">'.__("Remove from Wishlist").'</span></a>';
														} else {
															$wishlist = '<a class="wish-list" href="javascript:void(0);" id="fav_'. $product['unique_key'] .'_FEAT" onClick="addToWishlist(\''. $product['unique_key'] .'\')"><i class="fa fa-heart"></i><span class="list-mode">'.__("Add to Wishlist").'</span></a>';
														}
														
														if ( !isset($_SESSION['loggedIn']) || !$_SESSION['loggedIn'] ) {
															$wishlist = "";
														}

														if ( !is_file( './images/images_md/'. $images[0] ) ) {
															$images[0] = "0.png";
														}

														echo '   																						
													<div class="element no_full_width bounceIn not-animated" data-animate="fadeInUp" data-delay="'. $delay .'">
														<ul class="row-container list-unstyled clearfix">
															<li class="row-left">
															<a href="./product.php?view='. $product['unique_key'] .'" class="container_item" style="height:277px;">
															<img src="./images/images_md/'. $images[0] .'?v='. time() .'" class="img-responsive" alt="">
															'. $sale .'
															</a>
															<div class="hbw">
																<span class="hoverBorderWrapper"></span>
															</div>
															</li>
															<li class="row-right parent-fly animMix">
															<div class="product-content-left">
																<a class="title-5" href="./product.php?view='. $product['unique_key'] .'">'. $product['item_name'] .'</a>
																<span class="spr-badge" id="spr_badge_1293238211" data-rating="0.0">
																<span class="spr-starrating spr-badge-starrating"><i class="spr-icon spr-icon-star-empty" style=""></i><i class="spr-icon spr-icon-star-empty" style=""></i><i class="spr-icon spr-icon-star-empty" style=""></i><i class="spr-icon spr-icon-star-empty" style=""></i><i class="spr-icon spr-icon-star-empty" style=""></i></span>
																<span class="spr-badge-caption">
																'.__("No reviews").' </span>
																</span>
															</div>
															<div class="product-content-right">
															'. $price .'
															</div>
															<div class="list-mode-description">
																 
															</div>
															<div class="hover-appear">
																<form method="post">
																	<div class="effect-ajax-cart">
																		<input type="hidden" name="quantity" value="1">
																		<button class="select-option" type="button" onclick="window.location.href=\'product.php?view='. $product['unique_key'] .'\'"><i class="fa fa-th-list" title="'.__("Select Options").'"></i><span class="list-mode">'.__("Select Option").'</span></button>
																	</div>
																</form>
																<div class="product-ajax-qs hidden-xs hidden-sm">
																	<div class="quick_shop" onclick="quickShop(\''. $product['unique_key'] .'\')">
																		<i class="fa fa-eye" title="'.__("Quick View").'"></i><span class="list-mode">'.__("Quick View").'</span>																		
																	</div>
																</div>
																'. $wishlist .'
															</div>
															</li>
														</ul>
													</div>';

													$delay += 0;
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
	
	<!-- <div class="newsletter-popup" style="display: none;">
		<form method="post" name="mc-embedded-subscribe-form" id="mc-embedded-subscribe-form-popup">
			<h4>Special Offers</h4>
			<p class="tagline" style="">
				Subscribe to our Newsletter and get notified with exclusive offers
			</p>
			<div class="group_input">
				<input class="form-control" type="email" name="email" placeholder="YOUR EMAIL" id="email-input-popup">
				<button class="btn" type="submit" name="subscribe" id="button-popup"><i class="fa fa-paper-plane"></i></button><img id="subscribe-loading-img-popup" src="./images/gfx/cube.gif" style="margin: 0px 10px; width: 20px; display:none;" />
			</div>
		</form>
		<div id="popup-hide">
			<input type="checkbox" id="mc-popup-hide" value="1" checked="checked"><label for="mc-popup-hide">Never show this message again</label>
		</div>
	</div> -->

	<script src="assets/javascripts/cs.global.js" type="text/javascript"></script>
	
 	<div id="quick-shop-modal" class="modal in" role="dialog" aria-hidden="false" tabindex="-1" data-width="800">
		<div class="modal-backdrop in" style="height: 742px;">
		</div>
		<div class="modal-dialog rotateInDownLeft animated">
			<div class="modal-content" style="min-height: 0px;">
				<div class="modal-header">
					<i class="close fa fa-times btooltip" data-toggle="tooltip" data-placement="top" title="" data-dismiss="modal" aria-hidden="true" data-original-title="<?php echo __("Close"); ?>"></i>
				</div>
				<div class="modal-body">
					<div class="quick-shop-modal-bg" style="display: none;">
					</div>
					<div class="row">
						<div class="col-md-12 product-image">
							<div id="quick-shop-image" class="product-image-wrapper">
								<a class="main-image"><img class="img-zoom img-responsive image-fly" src="./images/gfx/cube_lg.gif" data-zoom-image="./images/gfx/cube_lg.gif" alt=""/></a>
								<div id="gallery_main_qs" class="product-image-thumb">
								</div>	
							</div>
						</div>
						<div class="col-md-12 product-information">
							<h1 id="quick-shop-title"><span> <a id="quick-shop-url"></a></span></h1>
							<div id="quick-shop-infomation" class="description">
								<div id="quick-shop-description" class="text-left">
									
								</div>
							</div>
							<div id="quick-shop-container">
								<div id="quick-shop-relative" class="relative text-left">
									<ul class="list-unstyled">
										<li class="control-group vendor">
										<span class="control-label">Home :</span><a href="#"> Home</a>
										</li>
										<li class="control-group type">
										<span class="control-label">Home :</span><a href="#"> Home</a>
										</li>
									</ul>
								</div>
								<form method="post" enctype="multipart/form-data">
									<div id="quick-shop-price-container" class="detail-price">
										
									</div>
									<div class="quantity-wrapper clearfix">
										<label class="wrapper-title"><?php echo __("Quantity"); ?></label>
										<div class="wrapper">
											<input type="text" id="qs-quantity" size="5" class="item-quantity" name="quantity" value="1">
											<span class="qty-group">
											<span class="qty-wrapper">
											<span class="qty-up" title="<?php echo __("Increase"); ?>" data-src="#qs-quantity">
											<i class="fa fa-plus"></i>
											</span>
											<span class="qty-down" title="<?php echo __("Decrease"); ?>" data-src="#qs-quantity">
											<i class="fa fa-minus"></i>
											</span>
											</span>
											</span>
										</div>
									</div>
                
                                    <label class="label-quick-shop"><?php echo __("Material"); ?> <span id="material-carat" style="font-size: 12px; color: #aaa; font-weight: bold;"></span></label>
                                    <input id="quick-shop-material-value" name="material" hidden />
                                    <div class="input-group" id="quick-shop-material">
                                    	<a class="btn material-badge" name="1"><?php echo __("Yellow Gold"); ?></a>
                                    	<a class="btn material-badge" name="2"><?php echo __("White Gold"); ?></a>
                                    	<a class="btn material-badge" name="3"><?php echo __("Pink Gold"); ?></a>
                                    	<a class="btn material-badge" name="4"><?php echo __("Silver"); ?></a>
                                    	<a class="btn material-badge" name="5"><?php echo __("Platinum"); ?></a>
                                    </div>
                                    <div id="quick-shop-size">
	                                    <label class="label-quick-shop"><?php echo __("Size"); ?> <span id="material-carat" style="font-size: 12px; color: #aaa; font-weight: bold;"></span></label> 
	                                    <input id="quick-shop-size-value" name="size" value="0" hidden />
	                                    <div class="input-group" id="quick-shop-size-container">
	                                    	<!-- Sizes go here -->
	                                    </div>
	                                </div>
                                    
                                    <input id="quick-shop-unique-key" name="unique_key" hidden />
                                    <?php
                                    if ( $_SESSION['loggedIn'] ) {
                                        echo '<div id="buttonDiv"></div>';
                                    } else {
                                    	echo '<div id="buttonDiv"></div>';
                                    	//echo '<a class="btn" href="./login.php" style="position: fixed; bottom: 15px; right: 15px; width: 200px;" id="loginToAccessCart">Login to Access Cart</a>';
                                    }
                                    ?>
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
				$("#quick-shop-image .main-image img").attr("src", "./images/images/" + images[0] + '?v=' + Date.now());
				
				//Remove old Thumbs if any
				var currentThumbs = $(".image-thumb").length;
				for (var i = 0; i < currentThumbs; i++ ) {
					//console.log("1 Item Removed");
					$('#gallery_main_qs').owlCarousel().data('owlCarousel').removeItem();
				}
				//Item Thumbnals
				for ( var i = 0; i < images.length-1; i++ ) {
					content = '<a class="image-thumb" onClick="quickDisplay(this)" value="./images/images/'+ images[i] +'?v='+ Date.now() +'" ><img src="./images/images_sm/'+ images[i] +'?v='+ Date.now() +'" alt=""/></a>';
					//console.log("1 Item Added");
					$('#gallery_main_qs').owlCarousel().data('owlCarousel').addItem(content);
					$('.owl-item').toggleClass('show-item');
				}
				//Item Name
				$("#quick-shop-title a").text(result['item_name']);
				$("#quick-shop-title a").attr("href", "./product.php?view=" + result['unique_key']);
				
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
					for ( var i = 0; i < sizes.length; i++ ) {
						
							if ( sizes[i].indexOf('-') > -1 ) {
								sizesRange = sizes[i].split('-');
								for ( var j = sizesRange[0]; j <= sizesRange[1]; j++ ) {
									sizehtml += '<a class="btn size-badge" name="'+ j +'" onClick="selectSize(this)">'+ j +'</a>';
								}
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

				if ( result['pieces_in_stock'] <= 0 ) {
					$("#buttonDiv").html('<button class="btn" name="addToCart" style="position: fixed; bottom: 15px; right: 15px; width: 200px;" disabled><?php echo __("Out of Stock"); ?></button>');
				} else {
					$("#buttonDiv").html('<button class="btn" type="submit" name="addToCart" style="position: fixed; bottom: 15px; right: 15px; width: 200px;"><?php echo __("Add to Cart"); ?></button>');
				}

				$("#quick-shop-unique-key").val(result['unique_key']);
				$("#quick-shop-modal").modal("toggle");
			}
		};
		xmlhttp.open("GET","./url/fetch_item_info.php?id="+id, true);
		$("#quick-shop-image .main-image img").attr("src", "./images/gfx/cube_lg.gif");
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



$("#mc-embedded-subscribe-form-popup").submit(function(event){
event.preventDefault();
email = $("#email-input-popup").val();
$.ajax({
	  url: './url/ajax.php?subscribe='+email,
	  type: 'GET',
	  beforeSend: function(){
	    $("#subscribe-loading-img-popup").show();
	  },
	  success: function(result) {
	    console.log(result);
	    $("#modal-text").text(result);
	    $("#notificationBox").html("<span>"+ result +"&nbsp;</span>");
	    if ( $("#notificationBox").is(":hidden") ) {
	      $("#notificationBox").toggle(500).delay(10000).toggle(500);  
	    }
	    $("#subscribe-loading-img-popup").hide();
	  }
	});

});


</script>
<?php
pconsole($_SESSION);
pconsole($_POST);

?>
