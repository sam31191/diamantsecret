<!doctype html>
<!--[if IE 8 ]>    <html lang="en" class="no-js ie8"> <![endif]-->
<!--[if (gt IE 9)|!(IE)]><!--> <html lang="en" class="no-js"> <!--<![endif]-->
<head>
  <meta charset="UTF-8">
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1" />
  <link rel="canonical" href="/" />
  <meta name="description" content="" />
  <title>Product </title>
  
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
	<link href="./assets/stylesheets/spr.css" rel="stylesheet" type="text/css" media="all">
	<link href="./assets/stylesheets/addthis.css" rel="stylesheet" type="text/css" media="all">
  	<link href="./assets/stylesheets/site.css" rel="stylesheet" type="text/css" media="all">
	
	<script src="./assets/javascripts/jquery-1.9.1.min.js" type="text/javascript"></script>
	<script src="./assets/javascripts/jquery.imagesloaded.min.js" type="text/javascript"></script>
	<script src="./assets/javascripts/bootstrap.min.3x.js" type="text/javascript"></script>
	<script src="./assets/javascripts/jquery.easing.1.3.js" type="text/javascript"></script>
	<script src="./assets/javascripts/jquery.camera.min.js" type="text/javascript"></script>
	<script src="./assets/javascripts/jquery.mobile.customized.min.js" type="text/javascript"></script>
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

<?php
if ( session_status() == PHP_SESSION_NONE ) {
	session_start();
}
if ( !isset($_GET['view']) || empty($_GET['view']) ) {
	header("Location: ./collection.php");
}
include 'url/require.php';
if ( isset($_POST['addToCart']) ) {
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

pconsole($_POST);
?>

<body style="height: 2671px;" itemscope="" itemtype="http://schema.org/WebPage" class="templateProduct notouch">
  
	<!-- Header -->
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
								<a href="./index.php" class="homepage-link" title="Back to the frontpage">Home</a>
								<span>/</span>
								<a href="./collection.php" title="">Collection</a>
								<span>/</span>
								<?php
									$_GET['view'];
									$getItem = $pdo->prepare("SELECT * FROM `items` WHERE `unique_key` = :unique_key");
									$getItem->execute(array(":unique_key" => $_GET['view']));
									$item = $getItem->fetch(PDO::FETCH_ASSOC);

									$getCategory = $pdo->prepare("SELECT * FROM `categories` WHERE `id` = :id");
									$getCategory->execute(array(":id" => $item['category']));
									$category = $getCategory->fetch(PDO::FETCH_ASSOC);
									$category = $category['category'];

									$table = '`'. $category .'`';

									$itemInfo = $pdo->prepare("SELECT * FROM ". $table ." WHERE `unique_key` = :unique_key");
									$itemInfo->execute(array(":unique_key" => $_GET['view']));

									$itemInfo = $itemInfo->fetch(PDO::FETCH_ASSOC);

									$images = explode(",", $itemInfo['images']);

									$sale = "";
									$price = '<span class="price">€'. $item['item_value'] .'</span>';
									if ( $item['discount'] > 0 ) {
										
										$value = $item['item_value'] -  (($item['discount'] / 100 ) * $item['item_value']);
										$sale = '<span class="sale_banner"><span class="sale_text">Sale</span></span>';
										$price = '<span class="price_sale">€'. number_format($value, 2, ".", "") .'</span>
													 <span class="dash">/</span> <del class="price_compare">€'. $item['item_value'] .'</del>';
									}

									if ( strstr($favorites, $item['unique_key']) ) {
										$wishlist = '<a class="wish-list" href="javascript:void(0);" id="fav_'. $item['unique_key'] .'" onClick="removeFromWishlist(\''. $item['unique_key'] .'\')"><i class="fa fa-heart fav-true"></i><span class="list-mode" style="text-transform:uppercase; font-weight: bold;">Remove from Wishlist</span></a>';
									} else {
										$wishlist = '<a class="wish-list" href="javascript:void(0);" id="fav_'. $item['unique_key'] .'" onClick="addToWishlist(\''. $item['unique_key'] .'\')"><i class="fa fa-heart"></i><span class="list-mode" style="text-transform:uppercase; font-weight: bold;">Add to Wishlist</span></a>';
									}
									
									pconsole($itemInfo);

									echo '<a href="./collection_'. $category .'.php" style="text-transform:capitalize;">'. $category .'</a>';
									echo '<span>/</span>';
									echo '<span>'. $item['item_name'] .'</span>'
								?>
							</div>
						</div>
					</div>
				</div>         
				<section class="content">
					<div class="container">
						<div class="row">              
							<div id="col-main" class="product-page col-xs-24 col-sm-24 ">
								<div itemscope="" itemtype="http://schema.org/Product">
									<meta itemprop="url" content="/products/donec-condime-fermentum">
									<div id="product" class="content clearfix">      
										<h1 id="page-title" class="text-center">
											<span itemprop="name"><?php echo $itemInfo['product_name']; ?></span>
										</h1>
										<div id="product-image" class="product-image row ">     
											<div id="detail-left-column" class="hidden-xs left-coloum col-sm-6 col-sm-6 fadeInRight not-animated" data-animate="fadeInRight">
												<div id="gallery_main" class="product-image-thumb thumbs full_width ">
													<ul class="slide-product-image">
														<?php
														foreach ( $images as $image ) {
															if ( !empty($image) ) {
																echo '													
																<li class="image">
																	<a href="./images/'. $image .'" class="cloud-zoom-gallery active">
																		<img src="./images/thumbnails/'. $image .'" alt="Donec condime fermentum">
																	</a>
																</li>	
																';
															}
														}
														?>
													</ul>
												</div>
											</div>      
											<div class="image featured col-smd-12 col-sm-12 fadeInUp not-animated" data-animate="fadeInUp"> 
												<?php echo '<img src="./images/'. $images[0] .'" alt="'. $itemInfo['product_name'] .'">' ?>
											</div>
											<div id="gallery_main_mobile" class="visible-xs product-image-thumb thumbs mobile_full_width ">
												<ul style="opacity: 0; display: block;" class="slide-product-image owl-carousel owl-theme">
													<?php 
													foreach ( $images as $image ) {
															if ( !empty($image) ) {
																echo '													
																<li class="image">
																	<a href="./images/'. $image .'" class="cloud-zoom-gallery">
																		<img src="./images/thumbnails/'. $image .'" alt="Donec condime fermentum">
																	</a>
																</li>	
																';
															}
														}
													?>
												</ul>
											</div>     
										</div>
										<div id="product-information" class="product-information row text-center ">        
											<div id="product-header" class="clearfix">
												<div id="product-info-left">
													<div class="description">
														<span>Product Descriptions</span>
														<p><?php
														echo $itemInfo['description'];
														?></p>
													</div>
													<div class="relative">
														<ul class="list-unstyled">
															<li class="tags">
															<span>Tags :</span>
															<?php
															$getMaterial = $pdo->prepare("SELECT * FROM `materials` WHERE `id` = :material");
															$getMaterial->execute(array(":material" => $itemInfo['material']));

															$material = $getMaterial->fetch(PDO::FETCH_ASSOC);
															$material = $material['category'];
															echo '
															<a href="./collection_'. $category .'.php?material='. $itemInfo['material'] .'">
															'. $material .'<span>,</span>
															</a>
															';

															$itemInfo['color'];
															switch ($itemInfo['color']) {
																case 1:{
																	$color = '<a href="./collection_'. $category .'.php?color='. $itemInfo['color'] .'">
																		White Stone<span>,</span>
																		</a>';
																	break;
																} case 2: {
																	$color = '<a href="./collection_'. $category .'.php?color='. $itemInfo['color'] .'">
																		Colored Stone<span>,</span>
																		</a>';
																	break;
																}
															}
															echo $color;

															echo '<a href="./collection_'. $category .'.php?clarity='. $itemInfo['clarity'] .'">
																		'. $itemInfo['clarity'] .'<span></span>
																		</a>';
															?>
															</li>
														</ul>
													</div>
												</div>          
												<div id="product-info-right">     
													<div itemprop="offers" itemscope="" itemtype="http://schema.org/Offer" class="col-sm-24 group-variants">
														<meta itemprop="priceCurrency" content="USD">              
														<link itemprop="availability" href="http://schema.org/InStock">
														<form method="post" class="variants" id="product-actions">
															<div id="product-actions-1293235843" class="options clearfix">
																<style scoped>
																  label[for="product-select-option-0"] { display: none; }
																  #product-select-option-0 { display: none; }
																  #product-select-option-0 + .custom-style-select-box { display: none !important; }
																</style>																
																<div class="swatch color clearfix" data-option-index="0">
																	<div class="header">
																		Color
																	</div>
																	<?php
																	echo '
																	<div data-value="blue" class="swatch-element color blue available">
																		<div class="tooltip">
																			'. $material .'
																		</div>
																		<a class="btn material-badge" name="'. $itemInfo['material'] .'">'. $material .'</a>
																		</label>
																	</div>';
																	?>																	
																</div>
																<?php
																echo '<input id="product-size-value" name="size" value="0" hidden />
																	<input name="unique_key" value="'. $item['unique_key'] .'" hidden/>';

																if ( $item['category'] == 1 ) {
																	echo '
																<div class="swatch clearfix" data-option-index="1">
																	<div class="header">
																		Size
																	</div>
																	
								                                    <div id="quick-shop-size">';
									                                    	$sizes = explode(",", $itemInfo['ring_size']);

									                                    echo'
									                                    <div class="input-group" id="quick-shop-size-container">';

									                                    	for ( $i = 0; $i < sizeof($sizes); $i++ ) {
									                                    		if ( $i == 0 ) {
									                                    			echo '<a class="btn size-badge tooptip" name="'. $sizes[$i] .'" onClick="selectSize(this)">'. $sizes[$i] .'</a>';
									                                    		} else {
									                                    			echo '<a class="btn size-badge" name="'. $sizes[$i] .'" onClick="selectSize(this)">'. $sizes[$i] .'</a>';
									                                    		}
									                                    	}
									                                    echo '</div>
									                                </div>
																</div>';
																}
																?>
																<div class="quantity-wrapper clearfix">
																	<label class="wrapper-title">Quantity</label>
																	<div class="wrapper">
																		<input id="quantity" name="quantity" value="1" maxlength="5" size="5" class="item-quantity" type="text">
																		<span class="qty-group">
																		<span class="qty-wrapper">
																		<span data-original-title="Increase" class="qty-up btooltip" data-toggle="tooltip" data-placement="top" title="" data-src="#quantity">
																		<i class="fa fa-caret-right"></i>
																		</span>
																		<span data-original-title="Decrease" class="qty-down btooltip" data-toggle="tooltip" data-placement="top" title="" data-src="#quantity">
																		<i class="fa fa-caret-left"></i>
																		</span>
																		</span>
																		</span>
																	</div>
																</div>
																<div id="purchase-1293235843">
																	<div class="detail-price" itemprop="price">
																		<span class="price"><?php echo $price; ?></span>
																	</div>
																</div>
																<?php
																if ( $itemInfo['pieces_in_stock'] > 0 ) {
																	$button = '<button id="add-to-cart" class="btn btn-1 add-to-cart" data-parent=".product-information" type="submit" name="addToCart">Add to Cart</button>';
																} else {
																	$button = '<button id="add-to-cart" class="btn btn-1 add-to-cart disabled" data-parent=".product-information" type="submit" name="add">Out of Stock</button>';
																}
																echo '
																<div class="others-bottom clearfix">
																	'. $button .'
																</div>';
																?>
															</div>
														</form>
														<div class="wls">
															<?php echo $wishlist; ?>
														</div>                                          
													</div>                        
													<ul id="tabs_detail" class="tabs-panel-detail hidden-xs hidden-sm">
														<li class="first">
															<h5><a href="#pop-one" class="fancybox">Measurements &amp; Specs</a></h5>
														</li>
														<li>
															<h5><a href="#pop-two" class="fancybox">Shipping &amp; Returns</a></h5>
														</li>
														<li>
															<h5><a href="#pop-three" class="fancybox">Size Charts</a></h5>
														</li>
													</ul>             
													<div id="pop-one" style="display: none;">
														<img src="./assets/images/demo_870x580.png" alt="">
													</div>
													<div id="pop-two" style="display: none;">
														<h5>Returns Policy</h5>
														<p>
															You may return most new, unopened items within 30 days of delivery for a full refund. We'll also pay the return shipping costs if the return is a result of our error (you received an incorrect or defective item, etc.).You should expect to receive your refund within four weeks of giving your package to the return shipper, however, in many cases you will receive a refund more quickly. This time period includes the transit time for us to receive your return from the shipper (5 to 10 business days), the time it takes us to process your return once we receive it (3 to 5 business days), and the time it takes your bank to process our refund request (5 to 10 business days).If you need to return an item, simply login to your account, view the order using the 'Complete Orders' link under the My Account menu and click the Return Item(s) button. We'll notify you via e-mail of your refund once we've received and processed the returned item.
														</p>
														<br>
														<h5>Shipping</h5>
														<p>
															We can ship to virtually any address in the world. Note that there are restrictions on some products, and some products cannot be shipped to international destinations.When you place an order, we will estimate shipping and delivery dates for you based on the availability of your items and the shipping options you choose. Depending on the shipping provider you choose, shipping date estimates may appear on the shipping quotes page.Please also note that the shipping rates for many items we sell are weight-based. The weight of any such item can be found on its detail page. To reflect the policies of the shipping companies we use, all weights will be rounded up to the next full pound.
														</p>
													</div>
													<div id="pop-three" style="display: none;">
														<img src="./assets/images/demo_870x580.png" alt="">
													</div>                
												</div>
											</div>
										</div>				
									</div>
								</div>         
								<!-- Related Products -->
								<section class="rel-container clearfix">  
									<h6 class="general-title text-left">You may also like the related products</h6>
									<div id="prod-related-wrapper">
										<div class="prod-related clearfix">
										
													<?php
													$fetchFeatured = $pdo->prepare("SELECT * FROM `items` WHERE `category` = :cat LIMIT 10");
													$fetchFeatured->execute(array(":cat" => $item['category']));

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
													<div class="element no_full_width bounceIn not-animated" data-animate="fadeInUp" data-delay="'. $delay .'">
														<ul class="row-container list-unstyled clearfix">
															<li class="row-left">
															<a href="./product.php?view='. $product['unique_key'] .'" class="container_item" style="height:277px;">
															<img src="./images/'. $images[0] .'" class="img-responsive" alt="Curabitur cursus dignis">
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
																		<button class="select-option" type="button" onclick="window.location.href=\'product.php?view='. $product['unique_key'] .'\'"><i class="fa fa-th-list" title="Select Options"></i><span class="list-mode">Select Option</span></button>
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
								</section>
							</div>
						</div>
					</div>
				</section>	
			</div>
	    </div>
	</div> 

	<?php include './url/footer.php'; ?>
</body>

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

<script>

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
			  	$("#fav_"+key+" span").text("Remove from Wishlist");
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
		  $("#fav_"+key+" span").text("Add to Wishlist");
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

function selectSize (e) {
	$('.size-badge').each(function(index, element) {
		//console.log($(element).attr('name'));
		if ( $(e).attr("name") == $(element).attr("name") ) {
			$(element).addClass('size-badge-active');
			$('#product-size-value').val($(element).attr('name'));
		} else {
			$(element).removeClass('size-badge-active');
		}
	});
}
</script>