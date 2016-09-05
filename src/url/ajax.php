<?php
if ( session_status() == PHP_SESSION_NONE ) {
	session_start();
}
if ( !$_SESSION['loggedIn'] ) {
	die();
}
include 'require.php';

if ( isset($_GET['addtoFav'])) {
	$getcurrentFavs = $pdo->prepare("SELECT `favorites` FROM `accounts` WHERE `username` = :username");
	$getcurrentFavs->execute(array(":username" => $_SESSION['username']));

	$result = $getcurrentFavs->fetch(PDO::FETCH_ASSOC);
	$currentFav = $result['favorites'];

	$currentFav .= "," . $_GET['addtoFav'];

	echo $currentFav;

	$updateFav = $pdo->prepare("UPDATE `accounts` SET `favorites` = :favs WHERE `username` = :username");
	$updateFav->execute ( array (":favs" => $currentFav, ":username" => $_SESSION['username']) );
}

if ( isset($_GET['removeFromFav'])) {
	$getcurrentFavs = $pdo->prepare("SELECT `favorites` FROM `accounts` WHERE `username` = :username");
	$getcurrentFavs->execute(array(":username" => $_SESSION['username']));

	$result = $getcurrentFavs->fetch(PDO::FETCH_ASSOC);
	$currentFav = $result['favorites'];

	$currentFav = str_replace(',' . $_GET['removeFromFav'], "", $currentFav);

	echo $currentFav;

	$updateFav = $pdo->prepare("UPDATE `accounts` SET `favorites` = :favs WHERE `username` = :username");
	$updateFav->execute ( array (":favs" => $currentFav, ":username" => $_SESSION['username']) );
}

if ( isset($_GET['sortBy']) ) {
	$getfavorites = $pdo->prepare("SELECT `favorites` FROM `accounts` WHERE `username` = :user");
	$getfavorites->execute(array(":user" => $_SESSION['username']));
	$favorites = $getfavorites->fetch(PDO::FETCH_ASSOC);
	$favorites = $favorites['favorites'];

	switch ($_GET['sortBy']) {
		case 'price-ascending':{
			$sort = $pdo->prepare("SELECT * FROM `items` ORDER BY `item_value` ASC");
			break;
		}
		case 'price-descending':{
			$sort = $pdo->prepare("SELECT * FROM `items` ORDER BY `item_value` DESC");
			break;
		}
		case 'title-ascending':{
			$sort = $pdo->prepare("SELECT * FROM `items` ORDER BY `item_name` ASC");
			break;
		}
		case 'title-descending':{
			$sort = $pdo->prepare("SELECT * FROM `items` ORDER BY `item_name` DESC");
			break;
		}
		case 'created-ascending':{
			$sort = $pdo->prepare("SELECT * FROM `items` ORDER BY `date_added` ASC");
			break;
		}
		case 'created-descending':{
			$sort = $pdo->prepare("SELECT * FROM `items` ORDER BY `date_added` DESC");
			break;
		}
		default : {
			$sort = $pdo->prepare("SELECT * FROM `items` ORDER BY `featured` DESC");
			break;
		}
	}

	$sort->execute();
	$allItems = $sort->fetchAll();
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
					<a href="./product.html" class="container_item">
					<img src="./images/'. $images[0] .'" class="img-responsive" alt="Curabitur cursus dignis">
					'. $sale .'
					</a>
					<div class="hbw">
						<span class="hoverBorderWrapper"></span>
					</div>
					</li>
					<li class="row-right parent-fly animMix">
					<div class="product-content-left">
						<a class="title-5" href="./product.html">'. $itemInfo['product_name'] .'</a>
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
}
if ( isset($_GET['sortCategoryBy']) ) {
	$getfavorites = $pdo->prepare("SELECT `favorites` FROM `accounts` WHERE `username` = :user");
	$getfavorites->execute(array(":user" => $_SESSION['username']));
	$favorites = $getfavorites->fetch(PDO::FETCH_ASSOC);
	$favorites = $favorites['favorites'];

	switch ($_GET['category'] ) {
		case 1: {
			$category = " WHERE `category` = 1";
			break;
		}
		case 2: {
			$category = " WHERE `category` = 2";
			break;
		}
		case 3: {
			$category = " WHERE `category` = 3";
			break;
		}
		case 4: {
			$category = " WHERE `category` = 4";
			break;
		}
		case 5: {
			$category = " WHERE `category` = 5";
			break;
		}
	}
	
	switch ($_GET['sortCategoryBy']) {
		case 'price-ascending':{
			$sort = $pdo->prepare("SELECT * FROM `items`". $category ." ORDER BY `item_value` ASC");
			break;
		}
		case 'price-descending':{
			$sort = $pdo->prepare("SELECT * FROM `items`". $category ." ORDER BY `item_value` DESC");
			break;
		}
		case 'title-ascending':{
			$sort = $pdo->prepare("SELECT * FROM `items`". $category ." ORDER BY `item_name` ASC");
			break;
		}
		case 'title-descending':{
			$sort = $pdo->prepare("SELECT * FROM `items`". $category ." ORDER BY `item_name` DESC");
			break;
		}
		case 'created-ascending':{
			$sort = $pdo->prepare("SELECT * FROM `items`". $category ." ORDER BY `date_added` ASC");
			break;
		}
		case 'created-descending':{
			$sort = $pdo->prepare("SELECT * FROM `items`". $category ." ORDER BY `date_added` DESC");
			break;
		}
		default : {
			$sort = $pdo->prepare("SELECT * FROM `items`". $category ." ORDER BY `featured` DESC");
			break;
		}
	}

	$sort->execute();
	$allItems = $sort->fetchAll();
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
					<a href="./product.html" class="container_item">
					<img src="./images/'. $images[0] .'" class="img-responsive" alt="Curabitur cursus dignis">
					'. $sale .'
					</a>
					<div class="hbw">
						<span class="hoverBorderWrapper"></span>
					</div>
					</li>
					<li class="row-right parent-fly animMix">
					<div class="product-content-left">
						<a class="title-5" href="./product.html">'. $itemInfo['product_name'] .'</a>
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
}
?>