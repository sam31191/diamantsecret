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
  <title><?php echo __("Collection"); ?></title>
  
	<link href="<?php echo $__MAINDOMAIN__;?>assets/stylesheets/font.css" rel='stylesheet' type='text/css'>
    
	<link href="<?php echo $__MAINDOMAIN__;?>assets/stylesheets/font-awesome.min.css" rel="stylesheet" type="text/css" media="all"> 
	<link href="<?php echo $__MAINDOMAIN__;?>assets/stylesheets/jquery.camera.css" rel="stylesheet" type="text/css" media="all">
	<link href="<?php echo $__MAINDOMAIN__;?>assets/stylesheets/jquery.fancybox-buttons.css" rel="stylesheet" type="text/css" media="all">
	<link href="<?php echo $__MAINDOMAIN__;?>assets/stylesheets/cs.animate.css" rel="stylesheet" type="text/css" media="all">
	<link href="<?php echo $__MAINDOMAIN__;?>assets/stylesheets/application.css" rel="stylesheet" type="text/css" media="all">
	<link href="<?php echo $__MAINDOMAIN__;?>assets/stylesheets/swatch.css" rel="stylesheet" type="text/css" media="all">
	<link href="<?php echo $__MAINDOMAIN__;?>assets/stylesheets/jquery.owl.carousel.css" rel="stylesheet" type="text/css" media="all">
	<link href="<?php echo $__MAINDOMAIN__;?>assets/stylesheets/jquery.bxslider.css" rel="stylesheet" type="text/css" media="all">
	<link href="<?php echo $__MAINDOMAIN__;?>assets/stylesheets/bootstrap.min.3x.css" rel="stylesheet" type="text/css" media="all">
	<link href="<?php echo $__MAINDOMAIN__;?>assets/stylesheets/cs.bootstrap.3x.css" rel="stylesheet" type="text/css" media="all">
	<link href="<?php echo $__MAINDOMAIN__;?>assets/stylesheets/cs.global.css" rel="stylesheet" type="text/css" media="all">
	<link href="<?php echo $__MAINDOMAIN__;?>assets/stylesheets/cs.style.css" rel="stylesheet" type="text/css" media="all">
	<link href="<?php echo $__MAINDOMAIN__;?>assets/stylesheets/cs.media.3x.css" rel="stylesheet" type="text/css" media="all">
  	<link href="<?php echo $__MAINDOMAIN__;?>assets/stylesheets/site.css" rel="stylesheet" type="text/css" media="all">
  	<link rel="icon" href="<?php echo $__MAINDOMAIN__;?>images/gfx/favicon.png?v=1" type="image/png" sizes="16x16">
	
	<script src="<?php echo $__MAINDOMAIN__;?>assets/javascripts/jquery-1.9.1.min.js" type="text/javascript"></script>
	<script src="<?php echo $__MAINDOMAIN__;?>assets/javascripts/jquery.imagesloaded.min.js" type="text/javascript"></script>
	<script src="<?php echo $__MAINDOMAIN__;?>assets/javascripts/bootstrap.min.3x.js" type="text/javascript"></script>
	<script src="<?php echo $__MAINDOMAIN__;?>assets/javascripts/jquery.easing.1.3.js" type="text/javascript"></script>
	<script src="<?php echo $__MAINDOMAIN__;?>assets/javascripts/jquery.camera.min.js" type="text/javascript"></script>
	<script src="<?php echo $__MAINDOMAIN__;?>assets/javascripts/jquery.mobile.customized.min.js" type="text/javascript"></script>
	<script src="<?php echo $__MAINDOMAIN__;?>assets/javascripts/cookies.js" type="text/javascript"></script>
	<script src="<?php echo $__MAINDOMAIN__;?>assets/javascripts/modernizr.js" type="text/javascript"></script>  
	<script src="<?php echo $__MAINDOMAIN__;?>assets/javascripts/application.js" type="text/javascript"></script>
	<script src="<?php echo $__MAINDOMAIN__;?>assets/javascripts/jquery.owl.carousel.min.js" type="text/javascript"></script>
	<script src="<?php echo $__MAINDOMAIN__;?>assets/javascripts/jquery.bxslider.js" type="text/javascript"></script>
	<script src="<?php echo $__MAINDOMAIN__;?>assets/javascripts/skrollr.min.js" type="text/javascript"></script>
	<script src="<?php echo $__MAINDOMAIN__;?>assets/javascripts/jquery.fancybox-buttons.js" type="text/javascript"></script>
	<script src="<?php echo $__MAINDOMAIN__;?>assets/javascripts/jquery.zoom.js" type="text/javascript"></script>	
	<script src="<?php echo $__MAINDOMAIN__;?>assets/javascripts/cs.script.js" type="text/javascript"></script>
</head>

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
								<a href="<?php echo $__MAINDOMAIN__.$lang.'/'.__('home')?>" class="homepage-link" title="<?php echo __("Back to the frontpage"); ?>"><?php echo __("Home");?></a>
								<span>/</span>
								<span class="page-title"><a href="<?php echo $__MAINDOMAIN__.$lang.'/'.__('collection')?>" title="<?php echo __("View All"); ?>"><?php echo __("Collection"); ?></a></span>
							</div>
						</div>
					</div>
				</div>
                
				<section class="content">
					<div class="container">
						<div class="row"> 
							<div id="collection-content">
								<div id="page-header">
									<h1 id="page-title"><?php echo __("Collection"); ?></h1>
								</div>
								<!-- <div class="collection-warper col-sm-24 clearfix"> 
									<div class="collection-panner">
										<img src="./images/gfx/collection_banner.jpg" class="img-responsive" alt="">
									</div>
								</div>-->
								<?php

								
									if ( isset($_GET['material']) ) {
										$materialTag = $_GET['material'];

										#echo '<label class="label label-info">'. $_GET['material'] .'</label>';
									} else {
										$materialTag = "";
									}
									if ( isset($_GET['stone']) ) {
										$stoneTag = $_GET['stone'];
										#echo '<label class="label label-info">'. $_GET['stone'] .'</label>';
									} else {
										$stoneTag = "";
									}
									if ( isset($_GET['clarity']) ) {
										$clarityTag = $_GET['clarity'];
										#echo '<label class="label label-info">'. $_GET['clarity'] .'</label>';
									} else {
										$clarityTag = "";
									}
									if ( isset($_GET['filter']) ) {
										$filterTag = $_GET['filter'];
									} else {
										$filterTag = "item_value";
									} 
									if ( isset($_GET['order']) ) {
										$orderTag = $_GET['order'];
									} else {
										$orderTag = "ASC";
									}

									
									#echo '
									#	<div class="container col-sm-24" style="padding:20px; text-align:center">
									#		<label style="font-size:12px;">Filters </label> '. $materialTag . $stoneTag . $clarityTag . $ringTag .'
									#	</div>';
								?>
								<div class="collection-main-content">

								<div class="home-popular-collections" style="margin-bottom:0;">
									<div class="container">
										<div class="group_home_collections row">
											<div class="col-md-24">
												<div class="home_collections">
													<div class="home_collections_wrapper">												
														<div id="home_collections">
																		<div class="home_collections_item" style="width: 200px;">
																			<div class="home_collections_item_inner">
																				<div class="collection-details">
																					<a href="<?php echo $__MAINDOMAIN__.''.$lang.'/'?>rings" title="<?php echo __("Browse our Rings"); ?>">
																						<img src="<?php echo $__MAINDOMAIN__;?>images/gfx/ring_270x270.png" alt="Rings">
																					</a>
																				</div>
																				<div class="hover-overlay">
																					<span class="col-name"><a href="<?php echo $__MAINDOMAIN__.''.$lang.'/'.__('rings')?>"><?php echo __("Rings"); ?></a></span>
																					<div class="collection-action">
																						<a href="<?php echo $__MAINDOMAIN__.$lang.'/'.__('rings')?>"><?php echo __("See the Collection"); ?></a>
																					</div>
																				</div>
																			</div>
																		</div>
																		<div class="home_collections_item" style="width: 200px;">
																			<div class="home_collections_item_inner">
																				<div class="collection-details">
																					<a href="<?php echo $__MAINDOMAIN__.''.$lang.'/'.__('earrings')?>" title="<?php echo __("Browse our Earrings"); ?>">
																					<img src="<?php echo $__MAINDOMAIN__;?>images/gfx/earring_270x270.png" alt="Earrings">
																					</a>
																				</div>
																				<div class="hover-overlay">
																					<span class="col-name"><a href="<?php echo $__MAINDOMAIN__.''.$lang.'/'.__('earrings')?>"><?php echo __("Earrings"); ?></a></span>
																					<div class="collection-action">
																						<a href="<?php echo $__MAINDOMAIN__.''.$lang.'/'?>earrings"><?php echo __("See the Collection"); ?></a>
																					</div>
																				</div>
																			</div>
																		</div>
																		<div class="home_collections_item" style="width: 200px;">
																			<div class="home_collections_item_inner">
																				<div class="collection-details">
																					<a href="<?php echo $__MAINDOMAIN__.''.$lang.'/'.__('pendants')?>" title="<?php echo __("Browse our Pendants") ;?>">
																					<img src="<?php echo $__MAINDOMAIN__;?>images/gfx/pendant_270x270.png" alt="Pendants">
																					</a>
																				</div>
																				<div class="hover-overlay">
																					<span class="col-name"><a href="<?php echo $__MAINDOMAIN__.''.$lang.'/'.__('pendants')?>"><?php echo __("Pendants"); ?></a></span>
																					<div class="collection-action">
																						<a href="<?php echo $__MAINDOMAIN__.''.$lang.'/'.__('pendants')?>"><?php echo __("See the Collection"); ?></a>
																					</div>
																				</div>
																			</div>
																		</div>
																		<div class="home_collections_item" style="width: 200px;">
																			<div class="home_collections_item_inner">
																				<div class="collection-details">
																					<a href="<?php echo $__MAINDOMAIN__.''.$lang.'/'.__('necklaces')?>" title="<?php echo __("Browse our Necklaces"); ?>">
																					<img src="<?php echo $__MAINDOMAIN__;?>images/gfx/necklace_270x270.png" alt="Necklaces">
																					</a>
																				</div>
																				<div class="hover-overlay">
																					<span class="col-name"><a href="<?php echo $__MAINDOMAIN__.''.$lang.'/'.__('necklaces')?>"><?php echo __("Necklaces"); ?></a></span>
																					<div class="collection-action">
																						<a href="<?php echo $__MAINDOMAIN__.''.$lang.'/'.__('necklaces')?>"><?php echo __("See the Collection"); ?></a>
																					</div>
																				</div>
																			</div>
																		</div>
																		<div class="home_collections_item" style="width: 200px;">
																			<div class="home_collections_item_inner">
																				<div class="collection-details">
																					<a href="<?php echo $__MAINDOMAIN__.''.$lang.'/'.__('bracelets')?>" title="<?php echo __("Browse our Bracelets"); ?>">
																						<img src="<?php echo $__MAINDOMAIN__;?>images/gfx/bracelet_270x270.png" alt="Bracelets">
																					</a>
																				</div>
																				<div class="hover-overlay">
																					<span class="col-name"><a href="<?php echo $__MAINDOMAIN__.''.$lang.'/'.__('bracelets')?>"><?php echo __("Bracelets"); ?></a></span>
																					<div class="collection-action">
																						<a href="<?php echo $__MAINDOMAIN__.''.$lang.'/'.__('bracelets')?>"><?php echo __("See the Collection"); ?></a>
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
									
									<div id="col-main" class="collection collection-page col-xs-24 col-sm-24">
										<div class="container-nav clearfix">
											<div id="options" class="container-nav clearfix">
												<ul class="list-inline text-right">
													<li class="grid_list">
													<ul class="list-inline option-set hidden-xs" data-option-key="layoutMode">
														<li data-original-title="<?php echo __("grid"); ?>" data-option-value="fitRows" id="goGrid" class="goAction btooltip active" data-toggle="tooltip" data-placement="top" title="">
														<span></span>
														</li>
														<li data-original-title="<?php echo __("List"); ?>" data-option-value="straightDown" id="goList" class="goAction btooltip" data-toggle="tooltip" data-placement="top" title="">
														<span></span>
														</li>
													</ul>
													</li>
													<li class="sortBy">
													<div id="sortButtonWarper" class="dropdown-toggle" data-toggle="dropdown">
														<form method="post" id="sortForm">
															
														</form>
														<strong class="title-6"><?php echo __("View as"); ?></strong>
														<select form="sortForm" class="list-unstyled option-set text-left list-styled" data-option-key="sortBy"  name="orderBy" onchange="if (this.value) window.location.href=this.value">
															<?php
																switch ($filterTag . $orderTag) {
																	case 'item_valueDESC': {
																		$select2 = "selected";
																		break;
																	} case 'item_valueASC': {
																		$select3 = "selected";
																		break;
																	} case 'item_nameDESC': {
																		$select5 = "selected";
																		break;
																	} case 'item_nameASC': {
																		$select4 = "selected";
																		break;
																	} default : {
																		$select1 = "selected";
																	}
																}
																echo '<option value="?filter=featured&q='. $searchTag .'&order=DESC&color='. $stoneTag .'&material='. $materialTag .'&clarity='. $clarityTag .'" '. $select1 .'>'.__("Featured").'</option>';
																echo '<option value="?filter=item_value&q='. $searchTag .'&order=DESC&color='. $stoneTag .'&material='. $materialTag .'&clarity='. $clarityTag .'" '. $select2 .'>'.__("Price").': '.__("High to Low").'</option>';
																echo '<option value="?filter=item_value&q='. $searchTag .'&order=ASC&color='. $stoneTag .'&material='. $materialTag .'&clarity='. $clarityTag .'" '. $select3 .'>'.__("Price").': '.__("Low to High").'</option>';
																echo '<option value="?filter=item_name&q='. $searchTag .'&order=ASC&color='. $stoneTag .'&material='. $materialTag .'&clarity='. $clarityTag .'" '. $select4 .'>A - Z</option>';
																echo '<option value="?filter=item_name&q='. $searchTag .'&order=DESC&color='. $stoneTag .'&material='. $materialTag .'&clarity='. $clarityTag .'" '. $select5 .'>Z - A</option>';
															?>
														</select>
													</div>
													</li>
												</ul>
											</div>
										</div>
										<div id="sandBox-wrapper" class="group-product-item row collection-full">
											<ul id="sandBox" class="list-unstyled">
												<!-- <li class="element first no_full_width" data-alpha="" data-price="25900">
													<ul class="row-container list-unstyled clearfix">
														<li class="row-left">
														<a href="./product.php?view='. $item['unique_key'] .'" class="container_item">
														<img src="./assets/images/demo_270x270.png" class="img-responsive" alt="">
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
															<a class="title-5" href="./product.php?view='. $item['unique_key'] .'"></a>
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
													$count = $pdo->prepare("SELECT COUNT(*) AS totalRows FROM `items` WHERE site_0 = 1 AND disabled = 0". $searchFilter);
													$count->execute();
													$totalRows = $count->fetch(PDO::FETCH_ASSOC);
													$totalRows = $totalRows['totalRows'];
													pconsole($totalRows);
													$perPage = 20;
													$pages = $totalRows/$perPage;
													if ( $totalRows%$perPage == 0 ) {
														$pages -= 0.1;
													}
													if ( isset($_GET['page']) ) {
														$currentPage = $_GET['page'];
													} else {
														$currentPage = 0;
													}
													if ( isset($_GET['page']) ) {
														$offset = $_GET['page'] * $perPage;
													} else {
														$offset = 0;
													}

													$filter = $searchFilter ."ORDER BY ". $filterTag ." ". $orderTag .", `date_added` DESC LIMIT ". $offset . ", " . $perPage;
													$getAll = $pdo->prepare("SELECT * FROM `items` WHERE site_0 = 1 AND disabled = 0 " . $filter);
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
															$sale = '<span class="sale_banner"><span class="sale_text">'.__("Sale").'</span></span>';
															$price = '<span class="price_sale">€'. number_format($value, 2, ".", "") .'</span><del class="price_compare">€'. $item['item_value'] .'</del>';
														}

														if ( strstr($favorites, $item['unique_key']) ) {
															$wishlist = '<a class="wish-list" href="javascript:void(0);" id="fav_'. $item['unique_key'] .'" onClick="removeFromWishlist(\''. $item['unique_key'] .'\')"><i class="fa fa-heart fav-true"></i><span class="list-mode">'.__("Remove from Wishlist").'</span></a>';
														} else {
															$wishlist = '<a class="wish-list" href="javascript:void(0);" id="fav_'. $item['unique_key'] .'" onClick="addToWishlist(\''. $item['unique_key'] .'\')"><i class="fa fa-heart"></i><span class="list-mode">'.__("Add to Wishlist").'</span></a>';
														}

														
														if ( !isset($_SESSION['loggedIn']) || !$_SESSION['loggedIn'] ) {
															$wishlist = "";
														}

														if ( !is_file( './images/images_md/'. $images[0] ) ) {
															$images[0] = "0.png";
														}
														$urlSubcategory = '';
                                                         if ( isset($_GET['_sc']) && (int)$ringTag>0) {
                                                            $urlSubcategory = $ringTag;
                                                        } else if ( isset($_GET['_sc'])) {
                                                            $urlSubcategory = $_GET['_sc'];
                                                         } else {
                                                            $urlSubcategory = $itemInfo['ring_subcategory'];
                                                         }  
														$element = '<li class="element no_full_width" data-alpha="" data-price="20000">
																<ul class="row-container list-unstyled clearfix">
																	<li class="row-left">
																	<a href="'.makeProductDetailPageUrl($urlSubcategory,$itemInfo['total_carat_weight'],$itemInfo['gold_quality'],$itemInfo['material'],$itemInfo['product_name'],$itemInfo['unique_key']) .'" class="container_item">
																	<img src="'.$__MAINDOMAIN__.'images/images_md/'. $images[0] .'?v='. time() .'" class="img-responsive  img-custom-collection" alt="">
																	'. $sale .'
																	</a>
																	<div class="hbw">
																		<span class="hoverBorderWrapper"></span>
																	</div>
																	</li>
																	<li class="row-right parent-fly animMix">
																	<div class="product-content-left">
																		<a class="title-5" href="'.makeProductDetailPageUrl($urlSubcategory,$itemInfo['total_carat_weight'],$itemInfo['gold_quality'],$itemInfo['material'],$itemInfo['product_name'],$itemInfo['unique_key']) .'">'. $itemInfo['product_name'] .'</a>
																		<span class="spr-badge" id="spr_badge_129323961956" data-rating="0.0">
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
																		'. $itemInfo['description'] .'
																	</div>
																	<div class="hover-appear">
																		<a href="'.makeProductDetailPageUrl($urlSubcategory,$itemInfo['total_carat_weight'],$itemInfo['gold_quality'],$itemInfo['material'],$itemInfo['product_name'],$itemInfo['unique_key']) .'" style="margin:0px 20px; line-height:50px; font-size:13px; font-weight:700; text-transform:uppercase;"><i class="fa fa-bars" aria-hidden="true" style="padding-right:10px;"></i>'.__("View Product").'</a>
																		<div class="product-ajax-qs hidden-xs hidden-sm">
																			<div class="quick_shop" onclick="quickShop(\''. $item['unique_key'] .'\')">
																				<i class="fa fa-eye" title="'.__("Quick View").'"></i><span class="list-mode">'.__("Quick View").'</span>																		
																			</div>
																		</div>
																		'. $wishlist .'
																	</div>
																	</li>
																</ul>
															</li>';

														if ( isset($_GET['material']) || isset($_GET['ring_category'])) {
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
															if ( empty($_GET['ring_category']) ) {
																$ringFilter = false;
															} else {
																$ringFilter = true;
															}

															$filterCheck = 0;
															if ( $materialFilter ) {
																if ( $_GET['material'] == $itemInfo['material'] ) {
																	$filterCheck++;
																} else {

																}
															} else {
																$filterCheck++;
															}

															if ( $stoneFilter ) {
																if ( $_GET['stone'] == $itemInfo['color'] ) {
																	$filterCheck++;
																} else {

																}
															} else {
																$filterCheck++;
															}

															if ( $clarityFilter ) {
																if ( $_GET['clarity'] == $itemInfo['clarity'] ) {
																	$filterCheck++;
																} else {

																}
															} else {
																$filterCheck++;
															}
															
															pconsole($filterCheck);

															if ( $filterCheck == 3 ) {
																echo $element;
															}
														} else {
															echo $element;
														}
													}

												?>
											</ul>
											<nav aria-label="Page navigation" style="display: block; text-align: center; float: right;">
											  <ul class="pagination" style="margin-top:0px;">
											  <?php 
											  	for ( $i = 0; $i < $pages; $i++ ) {
											  		if ( $i == 0 ) {
											  			echo '<li><a href="?page='. $i .'&filter='. $filterTag .'&q='. $searchTag .'&order='. $orderTag .'&color='. $stoneTag .'&material='. $materialTag .'&clarity='. $clarityTag .'">'.__("first").'</a></li>';
											  		}

											  		if ( $i > $currentPage - 3 && $i < $currentPage + 3 ) {
											  			$class = "";
											  			if ( $i == $currentPage ) {
											  				$class = "active";
											  			}
											  			echo '<li class="'. $class .'"><a href="?page='. $i .'&filter='. $filterTag .'&q='. $searchTag .'&order='. $orderTag .'&color='. $stoneTag .'&material='. $materialTag .'&clarity='. $clarityTag .'">'. intval($i+1) .'</a></li>';
											  		}else if ( $i > $currentPage - 4 && $i < $currentPage + 4 ) {
											  			echo '<li><a href="javascript:void(0);">.</a></li>';
											  		}

											  		if ( $i == intval($pages) ){
											  			echo '<li><a href="?page='. $i .'&filter='. $filterTag .'&q='. $searchTag .'&order='. $orderTag .'&color='. $stoneTag .'&material='. $materialTag .'&clarity='. $clarityTag .'">'.__("last").'</a></li>';
											  		}
											  	}
											  ?>
											  </ul>
											</nav>
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
					<i class="close fa fa-times btooltip" data-toggle="tooltip" data-placement="top" title="" data-dismiss="modal" aria-hidden="true" data-original-title="<?php echo __("Close"); ?>"></i>
				</div>
				<div class="modal-body">
					<div class="quick-shop-modal-bg" style="display: none;">
					</div>
					<div class="row">
						<div class="col-md-12 product-image">
							<div id="quick-shop-image" class="product-image-wrapper">
								<a class="main-image"><img class="img-zoom img-responsive image-fly" src="" data-zoom-image="" alt=""/></a>
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
										<span class="control-label"></a>
										</li>
										<li class="control-group type">
										<span class="control-label"></a>
										</li>
									</ul>
								</div>
								<form method="post" enctype="multipart/form-data" action="<?php echo $__MAINDOMAIN__.$lang.'/'.__('collection')?>">
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

$(document).ready( function(){
	$("#home_collections").owlCarousel({
		items: 5
	});
});

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
				$("#quick-shop-image .main-image img").attr("src", "<?php echo $__MAINDOMAIN__;?>images/images_md/" + images[0]) + "?v=" + Date.now();
				
				//Remove old Thumbs if any
				var currentThumbs = $(".image-thumb").length;
				for (var i = 0; i < currentThumbs; i++ ) {
					//console.log("1 Item Removed");
					$('#gallery_main_qs').owlCarousel().data('owlCarousel').removeItem();
				}
				//Item Thumbnals
				for ( var i = 0; i < images.length-1; i++ ) {
					content = '<a class="image-thumb" onClick="quickDisplay(this)" value="./images/images_md/'+ images[i] +'?v='+ Date.now() +'" ><img src="<?php echo $__MAINDOMAIN__;?>images/images_sm/'+ images[i] +'?v='+ Date.now() +'" alt=""/></a>';
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

		xmlhttp.addEventListener( "progress" ,function(e) {
			if ( e.lengthComputable ) {
				setTimeout(3000);
				console.log(e.loaded);
			}
		}, false);

		xmlhttp.open("GET","<?php echo $__MAINDOMAIN__;?>url/fetch_item_info.php?id="+id, false);
		$("#quick-shop-image .main-image img").attr("src", "<?php echo $__MAINDOMAIN__;?>images/gfx/cube_lg.gif");
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
	xmlhttp.open("GET","<?php echo $__MAINDOMAIN__;?>url/ajax.php?addtoFav="+key,true);
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
  xmlhttp.open("GET","<?php echo $__MAINDOMAIN__;?>url/ajax.php?removeFromFav="+key,true);
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
		url: './url/ajax.php?sortCategoryBy=' + $(e).val() + '&category=1',
		success: function (response) {
			console.log(response);
			$("#sandBox").html(response);
		}
	});
}
</script>
