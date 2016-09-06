<!doctype html>
<!--[if IE 8 ]>    <html lang="en" class="no-js ie8"> <![endif]-->
<!--[if (gt IE 9)|!(IE)]><!--> <html lang="en" class="no-js"> <!--<![endif]-->
<head>
  <meta charset="UTF-8">
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1" />
  <link rel="canonical" href="/" />
  <meta name="description" content="" />
  <title>Collection</title>
  
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

<body itemscope="" itemtype="http://schema.org/WebPage" class="templateCollection notouch">
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
								<span class="page-title"><a href="./collection.php" title="View All">Collection</a></span>
							</div>
						</div>
					</div>
				</div>
                
				<section class="content">
					<div class="container">
						<div class="row"> 
							<div id="collection-content">
								<div id="page-header">
									<h1 id="page-title">Collection</h1>
								</div>
								<div class="collection-warper col-sm-24 clearfix"> 
									<div class="collection-panner">
										<img src="./images/collection_banner.jpg" class="img-responsive" alt="">
									</div>
								</div>
								<?php

								if ( isset($_GET['material']) ) {
									if ( !empty($_GET['material']) ) {
										$materialTag = '<label class="label label-info">'. $_GET['material'] .'</label>';
									} else {
										$materialTag = "";
									}
									if ( !empty($_GET['stone']) ) {
										$stoneTag = '<label class="label label-info">'. $_GET['stone'] .'</label>';
									} else {
										$stoneTag = "";
									}
									if ( !empty($_GET['clarity']) ) {
										$clarityTag = '<label class="label label-info">'. $_GET['clarity'] .'</label>';
									} else {
										$clarityTag = "";
									}
									echo '
										<div class="container col-sm-24" style="padding:20px; text-align:center">
											<label style="font-size:12px;">Filters </label> '. $materialTag . $stoneTag . $clarityTag .'
										</div>';
								}
								?>
								<div class="collection-main-content">
									<div id="prodcoll" class="col-sm-6 col-md-6 sidebar hidden-xs">
										<div class="group_sidebar">
											<div class="sb-wrapper">
												<!-- filter tags group -->
												<div class="filter-tag-group">
													<form id="filterForm" method="get">
														<input id="filterMaterial" name="material" hidden />
														<input id="filterStone" name="stone" hidden />
													</form>
													<h6 class="sb-title">Filter <a href="./collection.php" style="font-size:12px">clear</a><button class="btn" form="filterForm" type="submit" style="float:right;">Apply</button></h6>
													<!-- tags groupd 1 -->
													<div class="tag-group" id="coll-filter-1">
														<p class="title">
															Clarity
														</p>
														<select form="filterForm" name="clarity">
															<option value="">Clarity</option>
								                            <option value="FL">FL</option>
								                            <option value="IF">IF</option>
								                            <option value="VVS1">VVS1</option>
								                            <option value="VVS2">VVS2</option>
								                            <option value="VS1">VS1</option>
								                            <option value="VS2">VS2</option>
								                            <option value="SI1">SI1</option>
								                            <option value="SI2">SI2</option>
								                            <option value="SI3">SI3</option>
								                            <option value="I1">I1</option>
														</select>
													</div>
													<!-- tags groupd 2 -->
													<div class="tag-group" id="coll-filter-2">
														<p class="title">
															Material
														</p>
														<ul>
															<li><button class="material-tag btooltip" data-toggle="tooltip" data-placement="top" title="" data-original-title="Yellow Gold" value="1" onclick="filterMaterial(this.value)">YG</button></li>
															<li><button class="material-tag btooltip" data-toggle="tooltip" data-placement="top" title="" data-original-title="White Gold" value="2" onclick="filterMaterial(this.value)">WG</button></li>
															<li><button class="material-tag btooltip" data-toggle="tooltip" data-placement="top" title="" data-original-title="Pink Gold" value="3" onclick="filterMaterial(this.value)">PG</button></li>
															<li><button class="material-tag btooltip" data-toggle="tooltip" data-placement="top" title="" data-original-title="Silver" value="4" onclick="filterMaterial(this.value)">SI</button></li>
															<li><button class="material-tag btooltip" data-toggle="tooltip" data-placement="top" title="" data-original-title="Platinum" value="5" onclick="filterMaterial(this.value)">PL</button></li>
														</ul>
													</div>
													<!-- tags groupd 3 -->
													<div class="tag-group" id="coll-filter-2">
														<p class="title">
															Stone
														</p>
														<ul>
															<li><button class="stone-tag btooltip" data-toggle="tooltip" data-placement="top" title="" data-original-title="White Stone" value="1" onclick="filterStone(this.value)">White</button></li>
															<li><button class="stone-tag btooltip" data-toggle="tooltip" data-placement="top" title="" data-original-title="Colored Stone" value="2" onclick="filterStone(this.value)">Colored</button></li>
														</ul>
													</div>
													<!-- tags groupd 3 -->
												</div>
											</div>  
											<div class="home-collection-wrapper sb-wrapper clearfix">
												<h6 class="sb-title">Product Categories</h6>
												<ul class="list-unstyled sb-content list-styled">
													<li>
													<a href="./collection_rings.php"><span><i class="fa fa-circle"></i> Rings</span><span class="collection-count"></span></a>
													</li>
													<li>
													<a href="./collection_earrings.php"><span><i class="fa fa-circle"></i> Earrings</span><span class="collection-count"></span></a>
													</li>
													<li>
													<a href="./collection_pendants.php"><span><i class="fa fa-circle"></i> Pendants</span><span class="collection-count"></span></a>
													</li>
													<li>
													<a href="./collection_necklaces.php"><span><i class="fa fa-circle"></i> Necklaces</span><span class="collection-count"></span></a>
													</li>
													<li>
													<a href="./collection_bracelets.php"><span><i class="fa fa-circle"></i> Bracelets</span><span class="collection-count"></span></a>
													</li>
												</ul>
											</div>  
											<div class="deal-product-wrapper sb-wrapper clearfix">
												<div class="group_deal_products">
													<div class="">
														<div class="home_deal_fp">
															<h6 class="sb-title">Specials</h6>
															<div class="home_deal_fp_wrapper sb-content">
																<div id="home_deal_fp">
																<?php
																$getItem = $pdo->prepare("SELECT * FROM `items` WHERE `featured` = 1 ORDER BY `date_added` DESC LIMIT 5");
																$getItem->execute();
																$allItems = $getItem->fetchAll();
																foreach ( $allItems as $item) {
																	switch ($item['category']) {
																		case 1: {
																			$getItemInfo = $pdo->prepare("SELECT * FROM `rings` WHERE `unique_key` = :unique_key");
																			break;
																		} case 2: {
																			$getItemInfo = $pdo->prepare("SELECT * FROM `earrings` WHERE `unique_key` = :unique_key");
																			break;
																		} case 3: {
																			$getItemInfo = $pdo->prepare("SELECT * FROM `pendants` WHERE `unique_key` = :unique_key");
																			break;
																		} case 4: {
																			$getItemInfo = $pdo->prepare("SELECT * FROM `necklaces` WHERE `unique_key` = :unique_key");
																			break;
																		} case 5: {
																			$getItemInfo = $pdo->prepare("SELECT * FROM `bracelets` WHERE `unique_key` = :unique_key");
																			break;
																		} 
																		default:{
																			break;
																		}
																	}
																	$getItemInfo->execute(array(":unique_key" => $item['unique_key']));
																	$itemInfo = $getItemInfo->fetch(PDO::FETCH_ASSOC);

																	$images = explode(",", $itemInfo['images']);
																	if ( $images == "" ) {
																		$images[0] = "0.png";
																	}

																	$sale = "";
																	$price = '<span class="price">€'. $item['item_value'] .'</span>';
																	if ( $item['discount'] > 0 ) {
																		
																		$value = $item['item_value'] -  (($item['discount'] / 100 ) * $item['item_value']);
																		$sale = '<span class="sale_banner"><span class="sale_text">Sale</span></span>';
																		$price = '<span class="price_sale">€'. number_format($value, 2, ".", "") .'</span>
																					 <span class="dash">/</span> <del class="price_compare">€'. $item['item_value'] .'</del>';
																	}

																	if ( strstr($favorites, $item['unique_key']) ) {
																		$wishlist = '<a class="wish-list" href="javascript:void(0);" id="fav_'. $item['unique_key'] .'" onClick="removeFromWishlist(\''. $item['unique_key'] .'\')"><i class="fa fa-heart fav-true"></i><span class="list-mode">Remove from Wishlist</span></a>';
																	} else {
																		$wishlist = '<a class="wish-list" href="javascript:void(0);" id="fav_'. $item['unique_key'] .'" onClick="addToWishlist(\''. $item['unique_key'] .'\')"><i class="fa fa-heart"></i><span class="list-mode">Add to Wishlist</span></a>';
																	}
																	
																	echo '
																	<div class="element full_width fadeInUp animated" data-animate="fadeInUp" data-delay="0">
																		<form action="#" method="post">
																			<ul class="row-container list-unstyled clearfix">
																				<li class="row-left">
																				<a href="./product.php?view='. $item['unique_key'] .'" class="container_item">
																				<img src="./images/thumbnails/'. $images[0] .'" class="img-responsive" alt="'. $itemInfo['product_name'] .'">
																				</a>
																				</li>
																				<li class="row-right parent-fly animMix">
																				<a class="title-5" href="./product.php?view='. $item['unique_key'] .'">'. $itemInfo['product_name'] .'</a>
																				<div class="product-price">
																					'. $price .'
																				</div>
																				<div class="effect-ajax-cart">
																					<input name="quantity" value="1" type="hidden">
																					<button class="select-option" type="button" onclick="window.location.href=\'product.php?view='. $item['unique_key'] .'\'">View</button>
																				</div>
																				</li>
																			</ul>
																		</form>
																	</div>';
																}

																?>
																</div>
															</div>
														</div>
													</div>
												</div>
											</div>  
											<!--
											<div class="sb-wrapper left-sample-block">
												<h6 class="sb-title">Product Vendors</h6>
												<ul class="list-unstyled sb-content list-styled">
													<li>
													<i class="fa fa-circle"></i><a href="#" title="Vendor 1">Vendor 1</a>
													</li>
													<li>
													<i class="fa fa-circle"></i><a href="#" title="Vendor 2">Vendor 2</a>
													</li>
													<li>
													<i class="fa fa-circle"></i><a href="#" title="Vendor 3">Vendor 3</a>
													</li>
													<li>
													<i class="fa fa-circle"></i><a href="#" title="Vendor 4">Vendor 4</a>
													</li>
												</ul>
											</div>  
											<div class="sb-wrapper left-sample-block">
												<h6 class="sb-title">Product Types</h6>
												<ul class="list-unstyled sb-content list-styled">
													<li>
													<i class="fa fa-circle"></i><a href="#" title="Dressing">Dressing</a>
													</li>
													<li>
													<i class="fa fa-circle"></i><a href="#" title="Hoodies Wear">Hoodies Wear</a>
													</li>
													<li>
													<i class="fa fa-circle"></i><a href="#" title="Sweaters Wear">Sweaters Wear</a>
													</li>
												</ul>
											</div>
											<div class="sb-item slidebar-banner">
												<h6 class="sb-title">Promotion</h6>
												<div class="">
													<img src="./assets/images/demo_270x340.png" alt="">
												</div>
											</div> -->
											<!--End sb-item-->
										</div><!--end group_sidebar-->
									</div>
									<div id="col-main" class="collection collection-page col-sm-18 col-md-18 no_full_width have-left-slidebar">
										<div class="container-nav clearfix">
											<div id="options" class="container-nav clearfix">
												<ul class="list-inline text-right">
													<li class="grid_list">
													<ul class="list-inline option-set hidden-xs" data-option-key="layoutMode">
														<li data-original-title="Grid" data-option-value="fitRows" id="goGrid" class="goAction btooltip active" data-toggle="tooltip" data-placement="top" title="">
														<span></span>
														</li>
														<li data-original-title="List" data-option-value="straightDown" id="goList" class="goAction btooltip" data-toggle="tooltip" data-placement="top" title="">
														<span></span>
														</li>
													</ul>
													</li>
													<li class="sortBy">
													<div id="sortButtonWarper" class="dropdown-toggle" data-toggle="dropdown">
														<form method="post" id="sortForm">
															
														</form>
														<strong class="title-6">View as</strong>
														<select form="sortForm" class="list-unstyled option-set text-left list-styled" data-option-key="sortBy" onchange="orderView(this)" name="orderBy">
															<option class="sort" value="featured">Featured</option>
															<option class="sort" value="price-ascending" data-order="asc">Price: Low to High</option>
															<option class="sort" value="price-descending" data-order="desc">Price: High to Low</option>
															<option class="sort" value="title-ascending" data-order="asc">A-Z</option>
															<option class="sort" value="title-descending" data-order="desc">Z-A</option>
															<option class="sort" value="created-ascending" data-order="asc">Oldest to Newest</option>
															<option class="sort" value="created-descending" data-order="desc">Newest to Oldest</option>
														</select>
													</div>
													</li>
												</ul>
											</div>
										</div>
										<div id="sandBox-wrapper" class="group-product-item row collection-full">
											<ul id="sandBox" class="list-unstyled">
												<!-- <li class="element first no_full_width" data-alpha="Curabitur cursus dignis" data-price="25900">
													<ul class="row-container list-unstyled clearfix">
														<li class="row-left">
														<a href="./product.php?view='. $item['unique_key'] .'" class="container_item">
														<img src="./assets/images/demo_270x270.png" class="img-responsive" alt="Curabitur cursus dignis">
														<span class="sale_banner">
														<span class="sale_text">Sale</span>
														</span>
														</a>
														<div class="hbw">
															<span class="hoverBorderWrapper"></span>
														</div>
														</li>
														<li class="row-right parent-fly animMix">
														<div class="product-content-left">
															<a class="title-5" href="./product.php?view='. $item['unique_key'] .'">Curabitur cursus dignis</a>
															<span class="spr-badge" id="spr_badge_129323821155" data-rating="0.0">
															<span class="spr-starrating spr-badge-starrating"><i class="spr-icon spr-icon-star-empty" style=""></i><i class="spr-icon spr-icon-star-empty" style=""></i><i class="spr-icon spr-icon-star-empty" style=""></i><i class="spr-icon spr-icon-star-empty" style=""></i><i class="spr-icon spr-icon-star-empty" style=""></i></span>
															<span class="spr-badge-caption">
															No reviews </span>
															</span>
														</div>
														<div class="product-content-right">
															<div class="product-price">
																<span class="price_sale">$259.00</span>
																<del class="price_compare"> $300.00</del>
															</div>
														</div>
														<div class="list-mode-description">
															 Nam libero tempore, cum soluta nobis est eligendi optio cumque nihil impedit quo minus id quod maxime placeat facere possimus, omnis amet voluptas assumenda est, omnis dolor repellendus quis nostrum. Temporibus autem quibusdam et aut officiis debitis aut rerum dolorem necessitatibus saepe eveniet ut et neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit, sed...
														</div>
														<div class="hover-appear">
															<form action="#" method="post">
																<div class="effect-ajax-cart">
																	<input name="quantity" value="1" type="hidden">
																	<button class="select-option" type="button" onclick="window.location.href='product.php?view='. $item['unique_key'] .''"><i class="fa fa-th-list" title="Select Options"></i><span class="list-mode">Select Option</span></button>
																</div>
															</form>
															<div class="product-ajax-qs hidden-xs hidden-sm">
																<div data-handle="curabitur-cursus-dignis" data-target="#quick-shop-modal" class="quick_shop" data-toggle="modal">
																	<i class="fa fa-eye" title="Quick view"></i><span class="list-mode">Quick View</span>
																	
																</div>
															</div>
															<a class="wish-list" href="./account.html" title="wish list"><i class="fa fa-heart"></i><span class="list-mode">Add to Wishlist</span></a>
														</div>
														</li>
													</ul>
												</li> -->
												<?php
													$filter = "ORDER BY `featured` DESC, `date_added` DESC";
													$getAll = $pdo->prepare("SELECT * FROM `items`" . $filter);
													$getAll->execute();
													$allItems = $getAll->fetchAll();

													foreach ( $allItems as $item) {
														switch ($item['category']) {
															case 1: {
																$getItemInfo = $pdo->prepare("SELECT * FROM `rings` WHERE `unique_key` = :unique_key");
																break;
															} case 2: {
																$getItemInfo = $pdo->prepare("SELECT * FROM `earrings` WHERE `unique_key` = :unique_key");
																break;
															} case 3: {
																$getItemInfo = $pdo->prepare("SELECT * FROM `pendants` WHERE `unique_key` = :unique_key");
																break;
															} case 4: {
																$getItemInfo = $pdo->prepare("SELECT * FROM `necklaces` WHERE `unique_key` = :unique_key");
																break;
															} case 5: {
																$getItemInfo = $pdo->prepare("SELECT * FROM `bracelets` WHERE `unique_key` = :unique_key");
																break;
															} 
															default:{
																break;
															}
														}
														$getItemInfo->execute(array(":unique_key" => $item['unique_key']));
														$itemInfo = $getItemInfo->fetch(PDO::FETCH_ASSOC);

														$images = explode(",", $itemInfo['images']);
														if ( $images == "" || $itemInfo['images'] == "" ) {
															$images[0] = "0.png";
														}

														$sale = "";
														$price = '<span class="price">€'. $item['item_value'] .'</span>';
														if ( $item['discount'] > 0 ) {
															
															$value = $item['item_value'] -  (($item['discount'] / 100 ) * $item['item_value']);
															$sale = '<span class="sale_banner"><span class="sale_text">Sale</span></span>';
															$price = '<span class="price_sale">€'. number_format($value, 2, ".", "") .'</span><del class="price_compare">€'. $item['item_value'] .'</del>';
														}

														if ( strstr($favorites, $item['unique_key']) ) {
															$wishlist = '<a class="wish-list" href="javascript:void(0);" id="fav_'. $item['unique_key'] .'" onClick="removeFromWishlist(\''. $item['unique_key'] .'\')"><i class="fa fa-heart fav-true"></i><span class="list-mode">Remove from Wishlist</span></a>';
														} else {
															$wishlist = '<a class="wish-list" href="javascript:void(0);" id="fav_'. $item['unique_key'] .'" onClick="addToWishlist(\''. $item['unique_key'] .'\')"><i class="fa fa-heart"></i><span class="list-mode">Add to Wishlist</span></a>';
														}

														$element = '<li class="element no_full_width" data-alpha="Curabitur cursus dignis" data-price="20000">
																<ul class="row-container list-unstyled clearfix">
																	<li class="row-left">
																	<a href="./product.php?view='. $item['unique_key'] .'" class="container_item">
																	<img src="./images/'. $images[0] .'" class="img-responsive" alt="Curabitur cursus dignis">
																	'. $sale .'
																	</a>
																	<div class="hbw">
																		<span class="hoverBorderWrapper"></span>
																	</div>
																	</li>
																	<li class="row-right parent-fly animMix">
																	<div class="product-content-left">
																		<a class="title-5" href="./product.php?view='. $item['unique_key'] .'">'. $itemInfo['product_name'] .'</a>
																		<span class="spr-badge" id="spr_badge_129323961956" data-rating="0.0">
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
																		'. $itemInfo['description'] .'
																	</div>
																	<div class="hover-appear">
																		<a href="product.php?view='. $itemInfo['unique_key'] .'" style="margin:0px 20px; line-height:50px; font-size:13px; font-weight:700; text-transform:uppercase;"><i class="fa fa-bars" aria-hidden="true" style="padding-right:10px;"></i>View Product</a>
																		<div class="product-ajax-qs hidden-xs hidden-sm">
																			<div data-href="./ajax/_product-qs.html" class="quick_shop" onclick="quickShop(\''. $item['unique_key'] .'\')">
																				<i class="fa fa-eye" title="Quick view"></i><span class="list-mode">Quick View</span>																		
																			</div>
																		</div>
																		'. $wishlist .'
																	</div>
																	</li>
																</ul>
															</li>';

														if ( isset($_GET['material'])) {
															if ( empty($_GET['material'])) {
																$materialFilter = false;
															} else {
																$materialFilter = true;
															}
															if ( empty($_GET['stone'])) {
																$stoneFilter = false;
															} else {
																$stoneFilter = true;
															}
															if ( empty($_GET['clarity']) ) {
																$clarityFilter = false;
															} else {
																$clarityFilter = true;
															}

															if ( $materialFilter && $stoneFilter  && $clarityFilter ) {
																if ( $itemInfo['material'] == $_GET['material'] && $itemInfo['color'] == $_GET['stone'] && $itemInfo['clarity'] == $_GET['clarity'] ) {
																	echo $element;
																}
																#All Filters Set
															} else if ( $materialFilter && $stoneFilter  && !$clarityFilter ) {
																if ( $itemInfo['material'] == $_GET['material'] && $itemInfo['color'] == $_GET['stone'] ) {
																	echo $element;
																}
																#Material and Stone Set
															} else if ( $materialFilter && !$stoneFilter  && !$clarityFilter ) {
																if ( $itemInfo['material'] == $_GET['material'] ) {
																	echo $element;
																}
																#Material Set
															} else if ( !$materialFilter && $stoneFilter  && $clarityFilter ) {
																if ( $itemInfo['color'] == $_GET['stone'] && $itemInfo['clarity'] == $_GET['clarity'] ) {
																	echo $element;
																}
																#Stone and Clarity Set
															} else if ( !$materialFilter && $stoneFilter  && !$clarityFilter ) {
																if ( $itemInfo['color'] == $_GET['stone'] ) {
																	echo $element;
																}
																#Stone Set
															} else if ( $materialFilter && !$stoneFilter  && $clarityFilter ) {
																if ( $itemInfo['material'] == $_GET['material'] && $itemInfo['clarity'] == $_GET['clarity'] ) {
																	echo $element;
																}
																#Material and Clarity Set
															} else if ( !$materialFilter && !$stoneFilter  && $clarityFilter ) {
																if ( $itemInfo['clarity'] == $_GET['clarity'] ) {
																	echo $element;
																}
																#Clarity Set
															} else {
																echo $element;
																#None Set
															}
														} else {
															echo $element;
														}
													}

												?>
											</ul>
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

		xmlhttp.addEventListener( "progress" ,function(e) {
			if ( e.lengthComputable ) {
				setTimeout(3000);
				console.log(e.loaded);
			}
		}, false);

		xmlhttp.open("GET","./url/fetch_item_info.php?id="+id, false);
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

function filterMaterial(val) {
	$(".material-tag").each(function(index, element) {
        if ( $(element).val() == val ) {
			$(element).addClass("material-tag-active");
			$("#filterMaterial").val(val);
			
			console.log("Value: " + $("#filterMaterial").val());
		} else {
			$(element).removeClass("material-tag-active");
		}
    });
}
function filterStone(val) {
	$(".stone-tag").each(function(index, element) {
        if ( $(element).val() == val ) {
			$(element).addClass("stone-tag-active");
			$("#filterStone").val(val);
			
			console.log("Value: " + $("#filterStone").val());
		} else {
			$(element).removeClass("stone-tag-active");
		}
    });
}

function orderView(e) {
	$("#sandBox").html("");
	$.ajax({
		type: 'GET',
		url: './url/ajax.php?sortBy=' + $(e).val(),
		success: function (response) {
			console.log(response);
			$("#sandBox").html(response);
		}
	});
}
</script>
