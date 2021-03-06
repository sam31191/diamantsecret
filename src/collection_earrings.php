<?php
if ( session_status() == PHP_SESSION_NONE ) {
	session_start();
}
/*print_r($_REQUEST);
die();*/
include 'conf/config.php';
include './url/pre.php';
?>
<!doctype html>
<!--[if IE 8 ]>    <html lang="en" class="no-js ie8"> <![endif]-->
<!--[if (gt IE 9)|!(IE)]><!--> <html lang="en" class="no-js"> <!--<![endif]-->
<head>
  <?php include_once("analyticstracking.php") ?>
  <meta charset="UTF-8">
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1" />  
  <link rel="canonical" href="https://diamantsecret.com/en/collection_earrings.php" />
  <meta name="description" content="If you want to buy best quality of diamond earrings and gemstone earrings online then Diamant Secret is the best source. Call us today +32 3 298 58 66" />
  <title><?php echo __("Buy Best Diamond Earrings online").'-'.__('Gemstone Earrings for Women'); ?></title>
  
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
	<link href="<?php echo $__MAINDOMAIN__;?>assets/stylesheets/ion.rangeSlider.skinFlat.css" rel="stylesheet" type="text/css" media="all">
	<link href="<?php echo $__MAINDOMAIN__;?>assets/stylesheets/ion.rangeSlider.css" rel="stylesheet" type="text/css" media="all">
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
	<script src="<?php echo $__MAINDOMAIN__;?>assets/javascripts/ion.rangeSlider.min.js" type="text/javascript"></script>
</head>

<?php

pconsole($_GET);
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
	<?php
	 $makeInLang = 'en';
	 $opposite_category = "earrings";
	 $makeOppositeSubcategory = '';
	 if(isset($_GET['lang']) && $_GET['lang']=='en'){ 
		$makeInLang = 'fr';
		$opposite_category = "boucles-doreilles";
	 }
	 if(isset($_REQUEST['_sc']) && trim($_REQUEST['_sc'])!='') {
		$makeOppositeSubcategory = trim($_REQUEST['_sc']);
	 }

	?>
	
	<!-- Header -->
	<?php include './url/header.php'; ?>

	<input type="hidden" name="changeURL" id="changeURL" value="<?php echo makeOppositeUrlFromCurrentLang($opposite_category,$makeOppositeSubcategory,$makeInLang,0);?>">  
	<div id="content-wrapper-parent">
		<div id="content-wrapper">  
			<!-- Content -->
			<div id="content" class="clearfix">                
				<div id="breadcrumb" class="breadcrumb">
					<div itemprop="breadcrumb" class="container">
						<div class="row">
							<div class="col-md-24">
								<a href="<?php echo $__MAINDOMAIN__.''.$lang.'/'; ?>" class="homepage-link" title="<?php echo __("Back to the frontpage"); ?>"><?php echo ucfirst(__('home')); ?></a>
								<span>/</span>
								<span class="page-title"><a href="<?php echo $__MAINDOMAIN__.''.$lang.'/'.strtolower(__('Collection')); ?>" title="<?php echo __("View All"); ?>"><?php echo __("Collection"); ?></a></span>
								<span>/</span>
								<span class="page-title"><a href="<?php echo $__MAINDOMAIN__.''.$lang.'/'.strtolower(str_replace(" ","-",str_replace("'","",__('earrings')))); ?>" title="<?php echo __("View All"); ?>"><?php echo __("Earrings"); ?></a></span>
							</div>
						</div>
					</div>
				</div>
				
				<section class="content">
					<div class="container">
						<div class="row"> 
							<div id="collection-content">
								<div id="page-header">
									<h1 id="page-title"><?php echo __("Earrings"); ?></h1>
								</div>
								<div class="collection-warper col-sm-24 clearfix"> 
									<div class="collection-panner">
										<img src="<?php echo $__MAINDOMAIN__;?>images/gfx/ring.jpg" class="img-responsive" alt="">
									</div>
								</div>
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
									if ( isset($_GET['quality']) ) {
										$qualityTag = $_GET['quality'];
										#echo '<label class="label label-info">'. $_GET['stone'] .'</label>';
									} else {
										$qualityTag = "";
									}
									if ( isset($_GET['clarity']) ) {
										$clarityTag = $_GET['clarity'];
										#echo '<label class="label label-info">'. $_GET['clarity'] .'</label>';
									} else {
										$clarityTag = "";
									}
									if ( isset($_GET['_sc']) && !empty($_GET['_sc']) ) {

										$ringTag = $_GET['_sc'];

										if($_GET['lang']){
											if(!empty($ringTag) && $_GET['lang']=='fr' && !isset($_REQUEST['filterForm'])){
												if(is_numeric($ringTag)) {
													$ringTag = $ringTag;
												} else {
													$ringTag = $fr_subcategory_arr[$ringTag];
												}
											}else if(!empty($ringTag) && $_GET['lang']=='en'){
												$ringTag = $_GET['_sc'];
											}
										}

									  $data=$pdo->prepare("select id from ring_subcategory WHERE category='".ucwords(strtolower(str_replace("-"," ", $ringTag)))." Earrings' and category_id = 2");
									  $data->execute();
									  $subCatQryAns = $data->fetch();

									  if(isset($subCatQryAns['id'])) {
										$ringTag = $subCatQryAns['id'];
									  }


									} else {
										$ringTag = "";
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
									if ( isset($_GET['price_range']) ) {
										$priceTag = $_GET['price_range'];
									} else {
										$priceTag = "";
									}
									#echo '
									#   <div class="container col-sm-24" style="padding:20px; text-align:center">
									#       <label style="font-size:12px;">Filters </label> '. $materialTag . $stoneTag . $clarityTag . $ringTag .'
									#   </div>';
								?>
								<div class="collection-main-content">
									<div id="prodcoll" class="col-sm-6 col-md-6 sidebar hidden-xs">
										<div class="group_sidebar">
											<div class="sb-wrapper">
												<!-- filter tags group -->
												<div class="filter-tag-group">
													<form id="filterForm" method="get">
														<input id="filterMaterial" name="material" hidden />
														<input id="filterQuality" name="quality" hidden />
														<input id="filterStone" name="stone" hidden />
														<input type="hidden" name="filterForm">
													</form>
													<h6 class="sb-title"><?php echo __("Filter"); ?> <a href="<?php echo $__MAINDOMAIN__.''.$lang.'/'.strtolower(str_replace(" ","-",str_replace("'","",__('earrings'))));?>" style="font-size:12px"><?php echo __("clear selection"); ?></a><button class="btn" form="filterForm" type="submit" style="float:right;"><?php echo __("Apply"); ?></button></h6>
													<!-- tags groupd 1 -->
													<div class="tag-group" id="coll-filter-1">
														<p class="title">
														   <?php echo __("Diamond Clarity"); ?>
														</p>
														<select form="filterForm" name="clarity" id="clarityFilter">
															<option value=""><?php echo __("Clarity"); ?></option>

															<?php 
															$fetchAvailableClarity = $pdo->prepare("SELECT * FROM `clarity`");
															$fetchAvailableClarity->execute();

															if ( $fetchAvailableClarity->rowCount() > 0 ) {
																foreach ( $fetchAvailableClarity->fetchAll() as $clarity ) {
																	$checkIfClarityExists = $pdo->prepare("SELECT COUNT(id) AS clarityCount FROM earrings WHERE clarity = :clarity");
																	$checkIfClarityExists->execute(array(":clarity" => $clarity['clarity']));

																	if ( $checkIfClarityExists->rowCount() > 0 ) {
																		$clarityCount = $checkIfClarityExists->fetch(PDO::FETCH_ASSOC)['clarityCount'];
																		if ( $clarityCount > 0 ) {
																			echo '<option value="'. $clarity['clarity'] .'">'. $clarity['clarity'] .'</option>';
																		}
																	}
																}
															}
															?>
														</select>
													</div>

													<?php

													if ( !empty($clarityTag) ) {
														echo "<script>$('#clarityFilter option[value=$clarityTag]').attr('selected', 'true');</script>";
													}

													?>
													<!-- tags groupd 2 -->
													<div class="tag-group" id="coll-filter-2">
														<p class="title">
															<?php echo __("Metal"); ?>
														</p>
														<ul>
															<?php 
															$fetchAvailableMaterials = $pdo->prepare("SELECT * FROM `materials`");
															$fetchAvailableMaterials->execute();

															if ( $fetchAvailableMaterials->rowCount() > 0 ) {
																foreach ( $fetchAvailableMaterials->fetchAll() as $materialOption ) {
																	$checkIfOptionExists = $pdo->prepare("SELECT COUNT(id) AS optionCount FROM earrings WHERE material = :material");
																	$checkIfOptionExists->execute(array(":material" => $materialOption['id']));

																	if ( $checkIfOptionExists->rowCount() > 0 ) {
																		$optionCount = $checkIfOptionExists->fetch(PDO::FETCH_ASSOC)['optionCount'];
																		if ( $optionCount > 0 ) {
																			echo '<li><button class="material-tag btooltip" data-toggle="tooltip" data-placement="top" title="" data-original-title="'. __($materialOption["category"]) .'" value="'. $materialOption["id"] .'" onclick="filterMaterial(this, this.value)">'. __($materialOption["category"]) .'</button></li>';
																		}
																	}
																}
															}
															?>
															
														</ul>
													</div>

													<?php

													if ( !empty($materialTag) ) {
														echo '<script>$("#filterMaterial").val("'. $materialTag .'");</script>';
														foreach ( explode(";", urldecode($materialTag)) as $selectedMaterial ) {
															echo '<script>$(".material-tag[value=\''. $selectedMaterial .'\']").addClass("material-tag-active");</script>';
														}
													}

													?>


													<!-- tags groupd 2 -->
													<div class="tag-group" id="coll-filter-2">
														<p class="title">
														   <?php echo __("Carat"); ?>
														</p>
														<ul>
															<?php 
															$fetchAvailableMaterials = $pdo->prepare("SELECT * FROM `gold_quality`");
															$fetchAvailableMaterials->execute();

															if ( $fetchAvailableMaterials->rowCount() > 0 ) {
																foreach ( $fetchAvailableMaterials->fetchAll() as $qualityOption ) {
																	$checkIfOptionExists = $pdo->prepare("SELECT COUNT(id) AS optionCount FROM earrings WHERE gold_quality = :gold_quality");
																	$checkIfOptionExists->execute(array(":gold_quality" => $qualityOption['id']));

																	if ( $checkIfOptionExists->rowCount() > 0 ) {
																		$optionCount = $checkIfOptionExists->fetch(PDO::FETCH_ASSOC)['optionCount'];
																		if ( $optionCount > 0 ) {
																			echo '<li><button class="quality-tag btooltip" data-toggle="tooltip" data-placement="top" title="" data-original-title="'. $qualityOption["gold_quality"] .'" value="'. $qualityOption["id"] .'" onclick="filterQuality(this, this.value)">'. $qualityOption["gold_quality"] .'</button></li>';
																		}
																	}
																}
															}
															?>
															
														</ul>
													</div>

													<?php

													if ( !empty($qualityTag) ) {
														echo '<script>$("#filterQuality").val("'. $qualityTag .'");</script>';
														foreach ( explode(";", urldecode($qualityTag)) as $selectedQuality ) {
															echo '<script>$(".quality-tag[value=\''. $selectedQuality .'\']").addClass("quality-tag-active");</script>';
														}
													}

													?>
													<!-- tags groupd 3 -->
													<div class="tag-group" id="coll-filter-2-color">
														<p class="title">
															<?php echo __("Type"); ?>
														</p>
														<ul>
															<?php 
															$fetchAvailableStoneTypes = $pdo->prepare("SELECT * FROM `color`");
															$fetchAvailableStoneTypes->execute();

															if ( $fetchAvailableStoneTypes->rowCount() > 0 ) {
																foreach ( $fetchAvailableStoneTypes->fetchAll() as $materialOption ) {
																	echo '<li><button class="stone-tag btooltip" data-toggle="tooltip" data-placement="top" title="" data-original-title="'. __($materialOption["color"]) .'" value="'. $materialOption["id"] .'" onclick="filterStone(this, this.value)">'. __($materialOption["color"]) .'</button></li>';
																}
															}
															?>
														</ul>
													</div>
													<?php

													if ( !empty($stoneTag) ) {
														echo '<script>$("#filterStone").val("'. $stoneTag .'");</script>';
														foreach ( explode(";", urldecode($stoneTag)) as $selectedMaterial ) {
															echo '<script>$(".stone-tag[value=\''. $selectedMaterial .'\']").addClass("stone-tag-active");</script>';
														}
													}

													?>
													<!-- tags groupd 4 -->
													<div class="tag-group" id="coll-filter-2-ring">
														<p class="title">
															<?php echo __("Subcategory"); ?>
														</p>
														<ul>
														<select form="filterForm" name="_sc">
															<option value=""><?php echo __("Select"); ?></option>
															<?php 
															$query = $pdo->prepare("SELECT * FROM `ring_subcategory` WHERE category_id = 2");
															$query->execute();
															if ( $query->rowCount() > 0 ) {
																$query = $query->fetchAll();
																foreach ( $query as $option ) {
																	$checkIfOptionExists = $pdo->prepare("SELECT COUNT(id) AS optionCount FROM earrings WHERE ring_subcategory = :ring_subcategory");
																	$checkIfOptionExists->execute(array(":ring_subcategory" => $option['id']));

																	if ( $checkIfOptionExists->rowCount() > 0 ) {
																		$optionCount = $checkIfOptionExists->fetch(PDO::FETCH_ASSOC)['optionCount'];
																		$subCat = strtolower($option['category']);
																		$subCat = strtolower(str_replace(" ","-",$subCat));
          																$subCat = strtolower(__($subCat));
          																if(empty($subCat)) $subCat = $option['category'];
																		if ( $optionCount > 0 ) {
																			echo '<option value="'. $option['id'] .'">'. ucwords(str_replace("-"," ",$subCat)) .'</option>';
																		}
																	}
																}
															}
															?>
														</select>
														</ul>
													</div>
													<?php

													if ( !empty($ringTag) ) {
														echo "<script>$('#coll-filter-2-ring ul select option[value=$ringTag]').attr('selected', 'true');</script>";
													}

													?>
													<!-- tags groupd 4 -->

													<div class="tag-group" id="price-tag-group">
														<p class="title">
															<?php echo __("Price Range"); ?>
														</p>
														<input id="rangeSliderPrice" name="price_range" type="text" form="filterForm" />
														<ul>
														</ul>

														<h6 class="sb-title"><?php echo __("Filter"); ?> <a href="<?php echo $__MAINDOMAIN__.''.$lang.'/'.strtolower(str_replace(" ","-",str_replace("'","",__('earrings'))));?>" style="font-size:12px"><?php echo __("clear selection"); ?></a><button class="btn" form="filterForm" type="submit" style="float:right;"><?php echo __("Apply"); ?></button></h6>
													</div>

													<?php

													if ( !empty($priceTag) ) {
														echo "<script>$('#price-tag-group ul select option[value=$priceTag]').attr('selected', 'true');</script>";
													}

													?>

												</div>
											</div>  
											<div class="home-collection-wrapper sb-wrapper clearfix">
												<h6 class="sb-title"><?php echo __("Product Categories"); ?></h6>
												<ul class="list-unstyled sb-content list-styled">
													<li>
													<a href="<?php echo $__MAINDOMAIN__.''.$lang.'/'.__('rings')?>"><span><i class="fa fa-circle"></i> <?php echo __("Rings"); ?></span><span class="collection-count"></span></a>
													</li>
													<li>
													<a href="<?php echo $__MAINDOMAIN__.''.$lang.'/'.processUrlParameter(__('earrings')); ?>"><span><i class="fa fa-circle"></i> <?php echo __("Earrings"); ?></span><span class="collection-count"></span></a>
													</li>
													<li>
													<a href="<?php echo $__MAINDOMAIN__.''.$lang.'/'.__('pendants')?>"><span><i class="fa fa-circle"></i> <?php echo __("Pendants"); ?></span><span class="collection-count"></span></a>
													</li>
													<li>
													<a href="<?php echo $__MAINDOMAIN__.''.$lang.'/'.__('necklaces')?>"><span><i class="fa fa-circle"></i> <?php echo __("Necklaces"); ?></span><span class="collection-count"></span></a>
													</li>
													<li>
													<a href="<?php echo $__MAINDOMAIN__.''.$lang.'/'.__('bracelets')?>"><span><i class="fa fa-circle"></i> <?php echo __("Bracelets"); ?></span><span class="collection-count"></span></a>
													</li>
												</ul>
											</div>  
											<div class="deal-product-wrapper sb-wrapper clearfix">
												<div class="group_deal_products">
													<div class="">
														<div class="home_deal_fp">
															<h6 class="sb-title"><?php echo __("Specials"); ?></h6>
															<div class="home_deal_fp_wrapper sb-content">
																<div id="home_deal_fp">
																<?php
																$getItem = $pdo->prepare("SELECT * FROM `items` WHERE `featured` = 1 AND `category` = 2 AND site_0 = 1 AND disabled = 0 ORDER BY `date_added` DESC LIMIT 5");
																$getItem->execute();
																$allItems = $getItem->fetchAll();

																$S_no = 0;

																foreach ( $allItems as $item) {

																	$S_no++;

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
																		$sale = '<span class="sale_banner"><span class="sale_text">'.__("Sale").'</span></span>';
																		$price = '<span class="price_sale">€'. number_format($value, 2, ".", "") .'</span>
																					 <span class="dash">/</span> <del class="price_compare">€'. $item['item_value'] .'</del>';
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
														} else if ( isset($_GET['_sc']) && !empty($_GET['_sc'])) {
															$urlSubcategory = $_GET['_sc'];
														 } else {
															$urlSubcategory = $itemInfo['ring_subcategory'];
														 }
																   $img_alt =  makeProductDetailPageUrl($urlSubcategory,$itemInfo['total_carat_weight'],$itemInfo['gold_quality'],$itemInfo['material'],$itemInfo['product_name'],$itemInfo['unique_key'],$alt_tag=1);

																	echo '
																	<div class="element full_width fadeInUp animated" data-animate="fadeInUp" data-delay="0">
																		<form action="'.$__MAINDOMAIN__.$lang.'/'.processUrlParameter(__('earrings')).'" method="post">
																			<ul class="row-container list-unstyled clearfix">
																				<li class="row-left">
																				<a href="'.makeProductDetailPageUrl($urlSubcategory,$itemInfo['total_carat_weight'],$itemInfo['gold_quality'],$itemInfo['material'],$itemInfo['product_name'],$itemInfo['unique_key']) .'" class="container_item"style="max-height:100px">
																				<img src="'.$__MAINDOMAIN__.'images/images_sm/'. $images[0] .'?v='. time() .'" class="img-responsive" alt="'. ucfirst($img_alt) .'">
																				</a>
																				</li>
																				<li class="row-right parent-fly animMix">
																				<a class="title-5" href="'.makeProductDetailPageUrl($urlSubcategory,$itemInfo['total_carat_weight'],$itemInfo['gold_quality'],$itemInfo['material'],$itemInfo['product_name'],$itemInfo['unique_key']) .'">'. ucfirst($itemInfo['product_name']) .'</a>
																				<div class="product-price">
																					'. $price .'
																				</div>
																				<div class="effect-ajax-cart">
																					<input name="quantity" value="1" type="hidden">
																					<button class="select-option" type="button" onclick="window.location.href=\''. makeProductDetailPageUrl($urlSubcategory,$itemInfo['total_carat_weight'],$itemInfo['gold_quality'],$itemInfo['material'],$itemInfo['product_name'],$itemInfo['unique_key']) .'\'">'.__("View").'</button>
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
																echo '<option value="?filter=featured&order=DESC&stone='. $stoneTag .'&material='. $materialTag .'&quality='. $qualityTag .'&clarity='. $clarityTag .'&_sc='. $ringTag .'&price_range='. $priceTag .'" '. $select1 .'>'.__("Featured").'</option>';
																echo '<option value="?filter=item_value&order=DESC&stone='. $stoneTag .'&material='. $materialTag .'&quality='. $qualityTag .'&clarity='. $clarityTag .'&_sc='. $ringTag .'&price_range='. $priceTag .'" '. $select2 .'>'.__("Price").': '.__("High to Low").'</option>';
																echo '<option value="?filter=item_value&order=ASC&stone='. $stoneTag .'&material='. $materialTag .'&quality='. $qualityTag .'&clarity='. $clarityTag .'&_sc='. $ringTag .'&price_range='. $priceTag .'" '. $select3 .'>'.__("Price").': '.__("Low to High").'</option>';
																echo '<option value="?filter=item_name&order=ASC&stone='. $stoneTag .'&material='. $materialTag .'&quality='. $qualityTag .'&clarity='. $clarityTag .'&_sc='. $ringTag .'&price_range='. $priceTag .'" '. $select4 .'>A - Z</option>';
																echo '<option value="?filter=item_name&order=DESC&stone='. $stoneTag .'&material='. $materialTag .'&quality='. $qualityTag .'&clarity='. $clarityTag .'&_sc='. $ringTag .'&price_range='. $priceTag .'" '. $select5 .'>Z - A</option>';
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
													$filterX = "";

													if ( !empty($materialTag) ) {
														$filterX .= " AND ( ";
														$materialSelections = explode(";", urldecode($materialTag));

														pconsole($materialSelections);
														
														for ( $i = 0; $i < sizeof($materialSelections); $i++ ) {
															if ( isset($materialSelections[$i]) && !empty($materialSelections[$i]) ) {
																if ( $i == 0 ) {
																	$filterX .= " `material` = ". $materialSelections[$i];
																} else {
																	$filterX .= " OR `material` = ". $materialSelections[$i];
																}
															}
														}

														$filterX .= " ) ";
													}

													if ( !empty($clarityTag) ) {
														$filterX .= " AND `clarity` = '" . $clarityTag . "' ";
													}

													if ( !empty($stoneTag) ) {
														//$filterX .= " AND `color` = '" . $stoneTag . "' ";

														$filterX .= " AND ( ";
														$stoneSelections = explode(";", urldecode($stoneTag));

														pconsole($stoneSelections);
														
														for ( $i = 0; $i < sizeof($stoneSelections); $i++ ) {
															if ( isset($stoneSelections[$i]) && !empty($stoneSelections[$i]) ) {
																if ( $i == 0 ) {
																	$filterX .= " `color` = ". $stoneSelections[$i];
																} else {
																	$filterX .= " OR `color` = ". $stoneSelections[$i];
																}
															}
														}

														$filterX .= " ) ";
													}

													if ( !empty($qualityTag) ) {
														//$filterX .= " AND `gold_quality` = '" . $qualityTag . "' ";
														$filterX .= " AND ( ";
														$materialSelections = explode(";", urldecode($qualityTag));

														pconsole($materialSelections);
														
														for ( $i = 0; $i < sizeof($materialSelections); $i++ ) {
															if ( isset($materialSelections[$i]) && !empty($materialSelections[$i]) ) {
																if ( $i == 0 ) {
																	$filterX .= " `gold_quality` = ". $materialSelections[$i];
																} else {
																	$filterX .= " OR `gold_quality` = ". $materialSelections[$i];
																}
															}
														}

														$filterX .= " ) ";
													}

													if ( !empty($ringTag) ) {
														$filterX .= " AND `ring_subcategory` = '" . $ringTag . "' ";
													}

													if ( !empty($priceTag) ) {
														//$priceRange = getPriceRange($priceTag);
														$priceRange = explode(";", urldecode($priceTag));
														$filterX .= " AND `item_value` >= ". $priceRange[0]. " AND `item_value` <= ". $priceRange[1] ." ";
													}


													$count = $pdo->prepare("SELECT COUNT(*) AS totalRows FROM `items` INNER JOIN `earrings` ON items.unique_key = earrings.unique_key WHERE `category` = 2 AND site_0 = 1 AND disabled = 0" . $filterX);
													$count->execute();
													$totalRows = $count->fetch(PDO::FETCH_ASSOC);
													$totalRows = $totalRows['totalRows'];
													pconsole("Total Rows - ". $totalRows);
													$perPage = 15;
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

													$filter = "ORDER BY ". $filterTag ." ". $orderTag .", `date_added` DESC LIMIT ". $offset . ", " . $perPage;
													$getAll = $pdo->prepare("SELECT * FROM `items` INNER JOIN `earrings` ON items.unique_key = earrings.unique_key WHERE `category` = 2 AND site_0 = 1 AND disabled = 0 " . $filterX . $filter );
													
													$getAll->execute();
													pconsole("Found:". $getAll->rowCount());
													$allItems = $getAll->fetchAll();

													foreach ( $allItems as $item) {

														$S_no++;

														$getItemInfo = $pdo->prepare("SELECT * FROM `earrings` WHERE `unique_key` = :unique_key"); 
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
														} else if ( isset($_GET['_sc']) && !empty($_GET['_sc']) ) {
															$urlSubcategory = $_GET['_sc'];
														 } else {
															$urlSubcategory = $item['ring_subcategory'];
														 }

														$img_alt =  makeProductDetailPageUrl($urlSubcategory,$itemInfo['total_carat_weight'],$itemInfo['gold_quality'],$itemInfo['material'],$itemInfo['product_name'],$itemInfo['unique_key'],$alt_tag=1); 

														$element = '<li class="element no_full_width" data-alpha="" data-price="20000">
																<ul class="row-container list-unstyled clearfix">
																	<li class="row-left">
																	<a href="'.makeProductDetailPageUrl($urlSubcategory,$item['total_carat_weight'],$item['gold_quality'],$item['material'],$item['item_name'],$item['unique_key']) .'" class="container_item">
																	<img src="'. $__MAINDOMAIN__.'images/images_md/'. $images[0] .'?v='. time() .'" class="img-responsive img-custom-collection" id="'.$S_no.'-getAltTag" alt="'.ucfirst($img_alt).'">
																	'. $sale .'
																	</a>
																	<div class="hbw">
																		<span class="hoverBorderWrapper"></span>
																	</div>
																	</li>
																	<li class="row-right parent-fly animMix">
																	<div class="product-content-left">
																		<a class="title-5" id="'.$item['unique_key'].'-remOldUrl" href="'.makeProductDetailPageUrl($urlSubcategory,$item['total_carat_weight'],$item['gold_quality'],$item['material'],$item['item_name'],$item['unique_key']) .'">'. ucfirst($itemInfo['product_name']) .'</a>
																		<span class="spr-badge" id="spr_badge_129323961956" data-rating="0.0">
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
																		'. $itemInfo['description'] .'
																	</div>
																	<div class="hover-appear">
																		<a href="'.makeProductDetailPageUrl($urlSubcategory,$item['total_carat_weight'],$item['gold_quality'],$item['material'],$item['item_name'],$item['unique_key']) .'" style="margin:0px 20px; line-height:50px; font-size:13px; font-weight:700; text-transform:uppercase;"><i class="fa fa-bars" aria-hidden="true" style="padding-right:10px;"></i>'.__("View Product").'</a>
																		<div class="product-ajax-qs hidden-xs hidden-sm">
																			<div class="quick_shop" onclick="quickShop(\''. $item['unique_key'] .'\')">
																				<i class="fa fa-eye" onclick="return getImgTag('.$S_no.');" title="'.__("Quick View").'"></i><span class="list-mode">'.__("Quick View").'</span>                                                                       
																			</div>
																		</div>
																		'. $wishlist .'
																	</div>
																	</li>
																</ul>
															</li>';

														echo $element;
													}

												?>
											</ul>
											<nav aria-label="Page navigation" style="display: block; text-align: center; float: right;">
											  <ul class="pagination" style="margin-top:0px;">
											  <?php 
												for ( $i = 0; $i < $pages; $i++ ) {
													if ( $i == 0 ) {
														echo '<li><a href="?page='. $i .'&filter='. $filterTag .'&order='. $orderTag .'&stone='. $stoneTag .'&material='. $materialTag .'&quality='. $qualityTag .'&clarity='. $clarityTag .'&_sc='. $ringTag .'&price_range='. $priceTag .'">'.__("first").'</a></li>';
													}

													if ( $i > $currentPage - 3 && $i < $currentPage + 3 ) {
														$class = "";
														if ( $i == $currentPage ) {
															$class = "active";
														}
														echo '<li class="'. $class .'"><a href="?page='. $i .'&filter='. $filterTag .'&order='. $orderTag .'&stone='. $stoneTag .'&material='. $materialTag .'&quality='. $qualityTag .'&clarity='. $clarityTag .'&_sc='. $ringTag .'&price_range='. $priceTag .'">'. intval($i+1) .'</a></li>';
													}else if ( $i > $currentPage - 4 && $i < $currentPage + 4 ) {
														echo '<li><a href="javascript:void(0);">.</a></li>';
													}

													if ( $i == intval($pages) ){
														echo '<li><a href="?page='. $i .'&filter='. $filterTag .'&order='. $orderTag .'&stone='. $stoneTag .'&material='. $materialTag .'&quality='. $qualityTag .'&clarity='. $clarityTag .'&_sc='. $ringTag .'&price_range='. $priceTag .'">'.__("last").'</a></li>';
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
								<a class="main-image"><img class="img-zoom img-responsive image-fly" src="" data-zoom-image="" id="newAlt" alt=""/></a>
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
								<form method="post" enctype="multipart/form-data" action="<?php echo $__MAINDOMAIN__.$lang.'/'.processUrlParameter(__('earrings')) ?>">
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
										<?php 
										$fetchAvailableMaterials = $pdo->prepare("SELECT * FROM `materials`");
										$fetchAvailableMaterials->execute();

										if ( $fetchAvailableMaterials->rowCount() > 0 ) {
											foreach ( $fetchAvailableMaterials->fetchAll() as $materialOption ) {
												echo '<a class="btn material-badge" name="'. $materialOption['id'] .'">'. __($materialOption['category']) .'</a>';
											}
										}
										?>
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

function filterMaterial(elem, val) {
	if ( $(elem).hasClass("material-tag-active") ) {
		/* DESELECT FILTER */
		var currentSelections = $("#filterMaterial").val().replace(val +";", "");
		$("#filterMaterial").val(currentSelections);
		$(elem).removeClass("material-tag-active");
	} else {
		/* SELECT FILTER */
		var currentSelections = $("#filterMaterial").val() + val + ";";
		$("#filterMaterial").val(currentSelections);
		$(elem).addClass("material-tag-active");
	}
	
	/*$(".material-tag").each(function(index, element) {
		if ( $(element).val() == val ) {
			$(element).addClass("material-tag-active");
			$("#filterMaterial").val(val + ";");
			
			console.log("Value: " + $("#filterMaterial").val());
		} else {
			$(element).removeClass("material-tag-active");
		}
	});*/
}

function filterQuality(elem, val) {
	if ( $(elem).hasClass("quality-tag-active") ) {
		/* DESELECT FILTER */
		var currentSelections = $("#filterQuality").val().replace(val +";", "");
		$("#filterQuality").val(currentSelections);
		$(elem).removeClass("quality-tag-active");
	} else {
		/* SELECT FILTER */
		var currentSelections = $("#filterQuality").val() + val + ";";
		$("#filterQuality").val(currentSelections);
		$(elem).addClass("quality-tag-active");
	}
	
}
function filterStone(elem, val) {
	if ( $(elem).hasClass("stone-tag-active") ) {
		/* DESELECT FILTER */
		var currentSelections = $("#filterMaterial").val().replace(val +";", "");
		$("#filterStone").val(currentSelections);
		$(elem).removeClass("stone-tag-active");
	} else {
		/* SELECT FILTER */
		var currentSelections = $("#filterStone").val() + val + ";";
		$("#filterStone").val(currentSelections);
		$(elem).addClass("stone-tag-active");
	}
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

$("#rangeSliderPrice").ionRangeSlider({
	type: "double",
	grid: true,
	min: 0,
	max: 10000,
	from: 0,
	to: 10000,
	prefix: "&euro;"
});

</script>

<?php 
if ( isset($priceTag) && !empty($priceTag) ) {
	echo '<script>
	var rangeSliderInstance = $("#rangeSliderPrice").data("ionRangeSlider");
	rangeSliderInstance.update({from: '. $priceRange[0] .', to: '. $priceRange[1] .'});

	</script>';
}
?>
