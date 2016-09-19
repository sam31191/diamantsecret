<?php
if ( session_status() == PHP_SESSION_NONE ) {
	session_start();
}
if ( !isset($_SESSION['loggedIn']) || !$_SESSION['loggedIn'] ) {
	header("location: ./login.php");
}
?><!doctype html>
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
  	<link rel="icon" href="./images/gfx/favicon.png?v=1" type="image/png" sizes="16x16">
	
	<script src="./assets/javascripts/jquery-1.9.1.min.js" type="text/javascript"></script>
	<script src="./assets/javascripts/bootstrap.min.3x.js" type="text/javascript"></script>
</head>
<div class="alert alert-danger" style="position: fixed; top: 0px; right: 0; margin: 25px; min-width: 250px; min-height: 40px; text-align: center; display: none; z-index: 1000; font-size: 18px;" id="notificationBox"> </div>
<?php
include 'conf/config.php';
include './assets/mail_format/admin_mail.php';
pconsole($_POST);

#pre
$subtotalMain = 0;
$youSave = 0;


if ( isset($_POST['addToCart']) ) {
	$cartElement = $_POST['unique_key'] . '|' . $_POST['size'] . '|';
	$fetchCurrentCart = $pdo->prepare("SELECT `cart` FROM `accounts` WHERE `username` = :user");
	$fetchCurrentCart->execute(array(":user" => $_USERNAME));

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
	$updateCart->execute(array(":cart" => $currentCart, ":user" => $_USERNAME));
} else if ( isset($_POST['removeFromCart']) ) {
	$getCart = $pdo->prepare("SELECT `cart` FROM `accounts` WHERE `username` = :user");
	$getCart->execute(array(
		":user" => $_USERNAME
	));
	$inputCart = $getCart->fetch(PDO::FETCH_ASSOC);
	$cart = $inputCart['cart'];
		
	$cart = str_replace($_POST['unique_key'] . '|' . $_POST['size'] . '|' . $_POST['quantity'] . ',', "", $cart);
	
	$addToCart = $pdo->prepare("UPDATE `accounts` SET `cart` = :cart WHERE `username` = :user");
	$addToCart->execute(array(
		":cart" => $cart,
		":user" => $_USERNAME
	));
} else if ( isset($_POST['checkout']) ) {
	$getCart = $pdo->prepare("SELECT * FROM `accounts` WHERE `username` = :username");
	$getCart->execute(array(":username" => $_USERNAME));

	if ( $getCart->rowCount() > 0 ) {
		$cart = $getCart->fetch(PDO::FETCH_ASSOC);

		if ( !empty($cart['cart']) ) {
			$items = explode(",", $cart['cart']);
			$mailToAdmin = '<h3>Enquiry By</h3>Name: '. $_USERNAME .'<br>Email: '. $cart['email'] .'<br>Phone: '. $cart['mobileno'] .'<hr />';
			$subtotal = 0;
			$orderedItemsAdmin = "";
			$orderedItems = "";
			$savings = 0;
			$suppliersArray = [];
			foreach ( $items as $item ) {
				pconsole("ITEM:" . $item);
				if ( !empty($item) ) {
					$item = explode("|", $item);
					$getItemInfo = $pdo->prepare("SELECT * FROM `items` WHERE `unique_key` = :key");
					$getItemInfo->execute(array(":key" => $item[0]));
					if( $getItemInfo->rowCount() > 0 ) {
						$itemInfo = $getItemInfo->fetch(PDO::FETCH_ASSOC);
						switch ($itemInfo['category']) {
							case 1: {
								$getItemInfo2 = $pdo->prepare("SELECT * FROM `rings` WHERE `unique_key` = :key");
								$getItemInfo2->execute(array(":key" => $item[0]));
								break;
							} case 2: {
								$getItemInfo2 = $pdo->prepare("SELECT * FROM `earrings` WHERE `unique_key` = :key");
								$getItemInfo2->execute(array(":key" => $item[0]));
								break;
							} case 3: {
								$getItemInfo2 = $pdo->prepare("SELECT * FROM `pendants` WHERE `unique_key` = :key");
								$getItemInfo2->execute(array(":key" => $item[0]));
								break;
							} case 4: {
								$getItemInfo2 = $pdo->prepare("SELECT * FROM `necklaces` WHERE `unique_key` = :key");
								$getItemInfo2->execute(array(":key" => $item[0]));
								break;
							} case 5: {
								$getItemInfo2 = $pdo->prepare("SELECT * FROM `bracelets` WHERE `unique_key` = :key");
								$getItemInfo2->execute(array(":key" => $item[0]));
								break;
							}
						}

						if ( $getItemInfo2->rowCount() > 0 ) {
							$itemInfo2 = $getItemInfo2->fetch(PDO::FETCH_ASSOC);

							if ( $itemInfo2['pieces_in_stock'] > 0 ) {
								$itemQuantity = $item[2];

								if ( $item[2] > $itemInfo2['pieces_in_stock'] ) {
									$itemQuantity = $itemInfo2['pieces_in_stock'];
								}
								
								$getVat = $pdo->prepare("SELECT * FROM `country_vat` WHERE `id` = :id");
								$getVat->execute(array(":id" => $itemInfo2['country_id']));
								if ( $getVat->rowCount() > 0 ){
									$vat = $getVat->fetch(PDO::FETCH_ASSOC);	
								} else{
									echo "Unknown";
								}
								if ( $itemInfo['discount'] > 0 ) {
									$price = ($itemInfo['item_value'] - (($itemInfo['discount']/100) * $itemInfo['item_value']) );
									$priceCustomer = '<small style="text-decoration: line-through; color: #9e9e9e; font-size:smaller;">€'. number_format($itemInfo['item_value'], 2, ".", "") .'</small> » ' . '<span style="font-weight:bold;">€' . number_format(($itemInfo['item_value'] - (($itemInfo['discount']/100) * $itemInfo['item_value']) ), 2, ".", "") . '</span>';

									$savings += (($itemInfo['discount']/100) * $itemInfo['item_value']) * $itemQuantity;
								} else {
									$price = $itemInfo['item_value'];
									$priceCustomer = number_format($itemInfo['item_value'], 2, ".", "");
								}
								if ( $itemInfo['category'] == 1 ) {
									if ( $item[1] !== "0" ) {
										$size = $item[1];
									} else {
										$size = "-";
									}
								} else {
									$size = "-";
								}
								$total = ($price + ( ($vat['vat'] / 100) * $price ) ) * $itemQuantity;
								$orderedItemsAdmin .= '<tr>
											<td style="border: none;font-variant: small-caps;padding: 3px;text-align:center;">'.trim(getCategory($itemInfo['category'],$pdo), "s").'</td>
											<td style="border: none;font-variant: small-caps;padding: 3px;text-align:center;"><a href="'. $__MAINDOMAIN__ .'product.php?view='. $itemInfo['unique_key'] .'">'.$itemInfo['item_name'].'</a></td>
											<td style="border: none;font-variant: small-caps;padding: 3px;text-align:center;">'. $size .'</td>
											<td style="border: none;font-variant: small-caps;padding: 3px;text-align:center;">'.getDiamondShape($itemInfo2['diamond_shape'],$pdo).'</td>
											<td style="border: none;font-variant: small-caps;padding: 3px;text-align:center;">'.getMaterial($itemInfo2['material'],$pdo).'</td>
											<td style="border: none;font-variant: small-caps;padding: 3px;text-align:center;">'.$itemInfo2['clarity'].'</td>
											<td style="border: none;font-variant: small-caps;padding: 3px;text-align:center;"> €'. number_format($price, 2, ".", "") .'</td>
											<td style="border: none;font-variant: small-caps;padding: 3px;text-align:center;">'.$itemInfo['discount'].'%</td>
											<td style="border: none;font-variant: small-caps;padding: 3px;text-align:center;"> €'.number_format((($vat['vat'] / 100) * $price), 2, ".", "") .'</td>
											<td style="border: none;font-variant: small-caps;padding: 3px;text-align:center;">'.$itemQuantity.'</td>
											<td style="border: none;font-variant: small-caps;padding: 3px;text-align:center;"> €'.number_format($total, 2, ".", "").'</td>
											<td style="border: none;font-variant: small-caps;padding: 3px;text-align:center;">'.getCompany($itemInfo2['company_id'],$pdo).'</td>
											<td style="border: none;font-variant: small-caps;padding: 3px;text-align:center;">'.getCountry($itemInfo2['country_id'],$pdo).'</td>
										</tr>';
								$orderedItems .= '<tr>
											<td style="border: none;font-variant: small-caps;padding: 3px;text-align:center;">'.trim(getCategory($itemInfo['category'],$pdo), "s").'</td>
											<td style="border: none;font-variant: small-caps;padding: 3px;text-align:center;"><a href="'. $__MAINDOMAIN__ .'product.php?view='. $itemInfo['unique_key'] .'">'.$itemInfo['item_name'].'</a></td>
											<td style="border: none;font-variant: small-caps;padding: 3px;text-align:center;">'. $size .'</td>
											<td style="border: none;font-variant: small-caps;padding: 3px;text-align:center;">'.getMaterial($itemInfo2['material'], $pdo).'</td>
											<td style="border: none;font-variant: small-caps;padding: 3px;text-align:center;">'.getDiamondShape($itemInfo2['diamond_shape'], $pdo).'</td>
											<td style="border: none;font-variant: small-caps;padding: 3px;text-align:center;">'.$itemInfo2['clarity'].'</td>
											<td style="border: none;font-variant: small-caps;padding: 3px;text-align:center;">'.$priceCustomer.'</td>
											<td style="border: none;font-variant: small-caps;padding: 3px;text-align:center;">'.$itemInfo['discount'].'%</td>
											<td style="border: none;font-variant: small-caps;padding: 3px;text-align:center;"> €'.number_format((($vat['vat'] / 100) * $price ), 2, ".", "") .'</td>
											<td style="border: none;font-variant: small-caps;padding: 3px;text-align:center;">'.$itemQuantity.'</td>
											<td style="border: none;font-variant: small-caps;padding: 3px;text-align:center;"> €'.number_format($total, 2, ".", "").'</td>
										</tr>';


								$supplierRow = "";
								$getSupplierInfo = $pdo->prepare("SELECT * FROM `company_id` WHERE `id` = :id");
								$getSupplierInfo->execute(array(":id" => $itemInfo2['company_id']));


								if ( $getSupplierInfo->rowCount() > 0 ) {
									$supplierInfo = $getSupplierInfo->fetch(PDO::FETCH_ASSOC);
									$supplierRow = '<tr>
										<td style="border: none;font-variant: small-caps;padding: 3px;text-align:center;">'.$supplierInfo['company_name'].'</td>
										<td style="border: none;font-variant: small-caps;padding: 3px;text-align:center;">'.$supplierInfo['email'].'</td>
										<td style="border: none;font-variant: small-caps;padding: 3px;text-align:center;">'.$supplierInfo['mobileno'].'</td>
										<td style="border: none;font-variant: small-caps;padding: 3px;text-align:center;">'.$supplierInfo['address'].'</td>
									</tr>';
								} else {
									$supplierRow = '<tr>
										<td style="border: none;font-variant: small-caps;padding: 3px;text-align:center;">N/A</td>
										<td style="border: none;font-variant: small-caps;padding: 3px;text-align:center;">N/A</td>
										<td style="border: none;font-variant: small-caps;padding: 3px;text-align:center;">N/A</td>
										<td style="border: none;font-variant: small-caps;padding: 3px;text-align:center;">N/A</td>
									</tr>';
								}

								if ( !in_array($supplierRow, $suppliersArray) ) {
									array_push($suppliersArray, $supplierRow);
								}
								$subtotal += $total;
							}
						} else {
							#Item Not Found
						}
						
					}
				}
			}

			$suppliers = "";

			foreach ( $suppliersArray as $entry ) {
				$suppliers .= $entry;
			}
			#$mailToAdmin .= '<h2>SubTotal: €'. number_format($subtotal, 2, ".", "") .'</h2>';

			#$mailToAdmin = mailToAdmin($_SESSION['username'], $orderedItemsAdmin, $subtotal, $_POST['note']);
			$mailToAdmin = file_get_contents('./conf/mail_formats/purchase_request_admin.html');
			$mailToAdmin = str_replace("__CLIENT__", $_SESSION['username'], $mailToAdmin);
			$mailToAdmin = str_replace("__ADMIN__", $__ADMINNAME__, $mailToAdmin);
			$mailToAdmin = str_replace("__ITEMS__", $orderedItemsAdmin, $mailToAdmin);
			$mailToAdmin = str_replace("__NOTE__", $_POST['note'], $mailToAdmin);
			$mailToAdmin = str_replace("__TOTAL__", "€".number_format($subtotal, 2, ".", ""), $mailToAdmin);
			$mailToAdmin = str_replace("__CLIENTMAIL__", $cart['email'], $mailToAdmin);
			$mailToAdmin = str_replace("__SUPPLIERS__", $suppliers, $mailToAdmin);
			$mailToAdmin = str_replace("__MAINDOMAIN__", $__MAINDOMAIN__, $mailToAdmin);

			if ( !empty($cart['mobileno']) ) {
				$mailToAdmin = str_replace("__CLIENTPHONE__", $cart['mobileno'], $mailToAdmin);
			} else {
				$mailToAdmin = str_replace("__CLIENTPHONE__", "Unknown", $mailToAdmin);
			}

			if ( !empty($cart['first_name'] . $cart['last_name']) ) {
				$mailToAdmin = str_replace("__CLIENTNAME__", $cart['first_name'] . " " . $cart['last_name'], $mailToAdmin);
			} else {
				$mailToAdmin = str_replace("__CLIENTNAME__", $cart['username'], $mailToAdmin);
			}

			#$mailToCustomer = mailToCustomer($_SESSION['username'], $orderedItems, $subtotal);
			$mailToCustomer = file_get_contents('./conf/mail_formats/purchase_request_client.html');
			$mailToCustomer = str_replace("__CLIENT__", $_SESSION['username'], $mailToCustomer);
			$mailToCustomer = str_replace("__ITEMS__", $orderedItems, $mailToCustomer);
			$mailToCustomer = str_replace("__USERNAME__", $_SESSION['username'], $mailToCustomer);
			$mailToCustomer = str_replace("__TOTAL__", "€". number_format($subtotal, 2, ".", ""), $mailToCustomer);
			$mailToCustomer = str_replace("__SAVINGS__", "€". number_format($savings, 2, ".", ""), $mailToCustomer);
			$mailToCustomer = str_replace("__MAINDOMAIN__", $__MAINDOMAIN__, $mailToCustomer);
			//echo $mailToAdmin;
			#pconsole($mailToCustomer);


			$testSiteSubject = ( $testSite ) ? $__TESTSITEPREFIX__ : "";


			pconsole($testSiteSubject);
			#Sending Mails
			require './url/PHPMailerAutoload.php';
			$mail2 = new PHPMailer;
			$mail2->isSMTP();
			#$mail2->SMTPDebug = 2;
			#$mail2->Debugoutput = 'html';
			$mail2->Host = $mailHost;
			$mail2->Port = $mailPort;
			$mail2->SMTPAuth = $mailSMTPAuth;
			$mail2->Username = $mailUsername;
			$mail2->Password = $mailPassword;
			$mail2->CharSet = "UTF-8"; 
			$mail2->setFrom($mailSenderEmail, $mailSenderName);
			$mail2->addAddress($__ADMINMAIL__);
			$mail2->isHTML(true);
			$mail2->Subject = $testSiteSubject . 'Enquiry Placed by ' . $_USERNAME;
			$mail2->Body = $mailToAdmin;
			if ( !$mail2->send() ) {
				$notify = "An Error Occured; Please Try Again Later";
			} else {
				$mail = new PHPMailer;
				$mail->isSMTP();
				#$mail->SMTPDebug = 2;
				#$mail->Debugoutput = 'html';
				$mail->Host = $mailHost;
				$mail->Port = $mailPort;
				$mail->SMTPAuth = $mailSMTPAuth;
				$mail->Username = $mailUsername;
				$mail->Password = $mailPassword;
				$mail->CharSet = "UTF-8"; 
				$mail->setFrom($mailSenderEmail, $mailSenderName);
				$mail->addAddress($cart['email']);
				$mail->isHTML(true);
				$mail->Subject = $testSiteSubject . 'Enquiry Placed';
				$mail->Body = $mailToCustomer;
				if ( !$mail->send() ) {
					$notify = "An Error Occured; Please Try Again Later";
				} else {
					$notify = "Enquiry Placed";
					echo '<script> $("#notificationBox").html("'. $notify .'"); $("#notificationBox").fadeToggle(500).delay(2000).fadeToggle(500); </script>';

					$emptyCart = $pdo->prepare("UPDATE `accounts` SET `cart` = :emptyCart WHERE `username` = :user");
					$emptyCart->execute(array(":emptyCart" => "", ":user" => $cart['username']));
				}
			}
		}
	}


}

if ( isset($_POST['removeItem']) ) {
	echo var_dump($_POST);
	$getCart = $pdo->prepare("SELECT `cart` FROM `accounts` WHERE `username` = :user");
	$getCart->execute(array(
		":user" => $_USERNAME
	));
	$inputCart = $getCart->fetch(PDO::FETCH_ASSOC);
	$cart = $inputCart['cart'];
		
	$cart = str_replace($_POST['removeItem'] . ',', "", $cart);
	
	$addToCart = $pdo->prepare("UPDATE `accounts` SET `cart` = :cart WHERE `username` = :user");
	$addToCart->execute(array(
		":cart" => $cart,
		":user" => $_USERNAME
	));
} 
?>
<body itemscope="" itemtype="http://schema.org/WebPage" class="templateCart notouch">
  
	<!-- Header -->
	<?php 
	include './url/header.php'; 
	?>
  
	<div id="content-wrapper-parent">
		<div id="content-wrapper">  
			<!-- Content -->
			<div id="content" class="clearfix">                
				<div id="breadcrumb" class="breadcrumb">
					<div itemprop="breadcrumb" class="container">
						<div class="row">
							<div class="col-md-24">
								<a href="./index.php" class="homepage-link" title="Back to the Frontpage">Home</a>
								<span>/</span>
								<span class="page-title">Cart</span>
							</div>
						</div>
					</div>
				</div>        
                
				<section class="content">
					<div class="container">
						<div class="row">
							<div id="page-header" class="col-md-24">
								<h1 id="page-title">Shopping Cart</h1>
							</div>
							<div id="col-main" class="col-md-24 cart-page content">
								<form method="post" id="removeItemForm"></form>
								<form method="post" id="cartform" class="clearfix">
									<div class="row table-cart">
										<div class="wrap-table">
											<table class="cart-items haft-border">
											<colgroup>
											<col class="checkout-image">
											<col class="checkout-info">
											<col class="checkout-price">
											<col class="checkout-quantity">
											<col class="checkout-totals">
											</colgroup>
											<thead>
											<tr class="top-labels">
												<th>
													Items
												</th>
												<th>
													Price
												</th>
												<th>
													Qty
												</th>
												<th>
													Stock
												</th>
												<th>
													<small>Total</small> VAT 
												</th>
												<th>
													SubTotal
												</th>
												<th>
													&nbsp;
												</th>
											</tr>
											</thead>
											<tbody>
											<?php
											$cartItems = explode(",", $info['cart']);

											pconsole($cartItems);
											foreach ( $cartItems as $item ) {
												$itemVal = explode("|", $item);
												if ( $item !== "" ) {
													$itemCategory = $pdo->prepare("SELECT * FROM `items` WHERE `unique_key` = :key");
													$itemCategory->execute(array(":key" => $itemVal[0]));

													if ( $itemCategory->rowCount() > 0 ) {
														$result = $itemCategory->fetch(PDO::FETCH_ASSOC);

														pconsole($result['category']);
														switch ($result['category']) {
															case 1: {
																$getItemInfo = $pdo->prepare("SELECT * FROM `rings` WHERE `unique_key` = :key");
																break;
															} case 2: {
																$getItemInfo = $pdo->prepare("SELECT * FROM `earrings` WHERE `unique_key` = :key");
																break;
															} case 3: {
																$getItemInfo = $pdo->prepare("SELECT * FROM `pendants` WHERE `unique_key` = :key");
																break;
															} case 4: {
																$getItemInfo = $pdo->prepare("SELECT * FROM `necklaces` WHERE `unique_key` = :key");
																break;
															} case 5: {
																$getItemInfo = $pdo->prepare("SELECT * FROM `bracelets` WHERE `unique_key` = :key");
																break;
															} default: {
																break;
															}
														}
														$getItemInfo->execute(array(":key" => $itemVal[0]));

														$itemInfo = $getItemInfo->fetch(PDO::FETCH_ASSOC);

														$images = explode(",", $itemInfo['images']);

														if ( $images == "" || $itemInfo['images'] == "") {
															$images[0] = "0.png";
														}

														if ( $itemInfo['pieces_in_stock'] > 0 ) {

															if ( $itemVal[2] > $itemInfo['pieces_in_stock'] ) {
																$itemVal[2] = $itemInfo['pieces_in_stock'];
																$adjustedQuantity = "<i class='fa fa-info-circle' data-toggle='tooltip' data-placement='bottom' title='Unfortunately, Item Quantity selected is more than our current Stock, adjusted to meet the highest available.'></i>";
															} else {
																$adjustedQuantity = "";
															}
															$sale = "";
															$price = '<span class="">€'. $result['item_value'] .'</span>';
															$value = $result['item_value'];
															if ( $result['discount'] > 0 ) {
																
																$value = $result['item_value'] -  (($result['discount'] / 100 ) * $result['item_value']);
																$sale = '<span class="label label-success">'. $result['discount'] .'% OFF</span>';
																$price = '<span>€'. number_format($value, 2, ".", "") .'</span> <del style="font-size:14px;">€'. $result['item_value'] .'</del>';
																$youSave += ($result['item_value'] - $value) * $itemVal[2];
															}


															$getMaterial = $pdo->prepare("SELECT * FROM `materials` WHERE `id` = :id");
															$getMaterial->execute(array(":id" => $itemInfo['material']));

															if ( $getMaterial->rowCount() > 0 ) {
																$itemMaterial = $getMaterial->fetch(PDO::FETCH_ASSOC);
																$itemMaterial = $itemMaterial['category'];

															} else {
																$itemMaterial = "Unknown";
															}

															#VAT
															$vat = $pdo->prepare("SELECT * FROM `country_vat` WHERE `id` = :id");
															$vat->execute(array(":id" => $itemInfo['country_id']));

															if ( $vat->rowCount() > 0 ) {
																$vat = $vat->fetch(PDO::FETCH_ASSOC);
																$vatAmount = $value * $itemVal[2];
																$vatAmount += (($vat['vat'] / 100) * $vatAmount);
																pconsole("SUB: " . $subtotalMain . " ITEM: " . $itemVal[0] . "VATAMOUNT: " . $vatAmount);
																$subtotalMain += $vatAmount;


																$vatValue = (($vat['vat'] / 100) * ($value * $itemVal[2]));
															} else {
																$vat = $vat->fetch(PDO::FETCH_ASSOC);
																$vat['country_name'] = "Unknown";
																$vat['vat'] = "N/A";
																$vatAmount = 0;
															}
															echo '
																<tr class="item donec-condime-fermentum">
																	<td class="title text-left">
																		<ul class="list-inline">
																			<li class="image">
																			<a href="./product.php?view='. $result['unique_key'] .'">
																			<img src="./images/images_sm/'. $images[0] .'" alt="'. $itemInfo['product_name'] .'">
																			</a>
																			</li>
																			<li class="link">
																			<a href="./product.php?view='. $result['unique_key'] .'">
																			<span class="title-5">'. $itemInfo['product_name'] .'</span>
																			</a>
																			<br>
																			<span class="variant_title"> '. $itemMaterial.'</span>
																			<br>
																			</li>
																		</ul>
																	</td>
																	<td class="title-1">
																		'. $price . '<br>' . $sale .'
																	</td>
																	<td>
																		<input class="form-control input-1 replace" maxlength="5" size="5" id="updates_3947646083" name="updates[]" value="'. $itemVal[2] .'" disabled> '. $adjustedQuantity .'
																	</td>
																	<td>
																		<input class="form-control input-1 replace" maxlength="5" size="5" id="updates_3947646083" name="updates[]" value="'. $itemInfo['pieces_in_stock'] .'" disabled>
																	</td>
																	<td class="total title-1">
																		<span data-toggle="tooltip" title="'. $vat['vat'] .'%">€'. number_format(($vatValue), 2, ".", "") .'</span>
																	</td>
																	<td class="total title-1">
																		€'. number_format($vatAmount, 2, ".", "") .'
																	</td>
																	<td class="action"><button type="submit" form="removeItemForm" name="removeItem" value="'. $item .'"><i class="fa fa-times"></i>Remove</button>
																	</td>
																</tr>';
														} else {
															echo '
																<tr class="item donec-condime-fermentum">
																	<td class="title text-left" style="opacity:0.25;">
																		<ul class="list-inline">
																			<li class="image">
																			<a href="./product.php?view='. $result['unique_key'] .'">
																			<img src="./images/images_sm/'. $images[0] .'" alt="'. $itemInfo['product_name'] .'">
																			</a>
																			</li>
																			<li class="link">
																			<a href="./product.php?view='. $result['unique_key'] .'">
																			<span class="title-5">'. $itemInfo['product_name'] .'</span>
																			</a>
																			<br>
																			<span class="variant_title"> '. $itemMaterial.'</span>
																			<br>
																			</li>
																		</ul>
																	</td>
																	<td class="title-1" style="opacity:0.25;">
																		'. $price . '<br>' . $sale .'
																	</td>
																	<td style="opacity:0.25;">
																		<input class="form-control input-1 replace" maxlength="5" size="5" id="updates_3947646083" name="updates[]" value="'. $itemVal[2] .'" disabled>
																	</td>
																	<td>
																		<input class="form-control input-1 replace" maxlength="5" size="5" id="updates_3947646083" name="updates[]" value="'. $itemInfo['pieces_in_stock'] .'" disabled>
																	</td>
																	<td class="total title-1" style="opacity:0.25;">
																		<a data-toggle="tooltip" >-</a>
																	</td>
																	<td class="total title-1">
																		<small>Out of Stock</small>
																	</td>
																	<td class="action"><button type="submit" form="removeItemForm" name="removeItem" value="'. $item .'"><i class="fa fa-times"></i>Remove</button>
																	</td>
																</tr>';
														}
													}

													
												}
											}
											?>
											</tbody>
											<tfoot>
											<tr class="bottom-summary">
												<td>
													&nbsp;
												</td>
												<td>
													&nbsp;
												</td>
												<td>
													&nbsp;
												</td>
												<td>
													&nbsp;
												</td>
												<td>
													&nbsp;
												</td>
												<td class="subtotal title-1" style="text-align: left;">
													<?php echo '<small style="font-size:14px;">Total:</small> <br>€' . number_format($subtotalMain, 2, ".", ""); ?>
												</td>
												<td class="subtotal title-1" style="text-align: left;">
													<?php echo '<span style="font-size:18px; color: grey;"><small style="font-size:12px;">You save:</small> <br>€' . number_format($youSave, 2, ".", "") . '</span>'; ?>
												</td>
											</tr>
											</tfoot>
											</table>
										</div>
									</div>
									<div class="row">
										<div id="checkout-addnote" class="col-md-24">
											<div class="wrapper-title">
												<span class="title-5">Add a note for the seller</span>
											</div>
											<textarea id="note" rows="8" class="form-control" name="note"></textarea>
										</div>
									</div>
									<div class="clearfix">
									<?php
									if ( $subtotalMain > 0 ) {
										echo'
											<div id="checkout-proceed" class="last1 text-right">
												<button class="btn" type="submit" id="checkout" name="checkout">Buy Request</button>
											</div>
											';
									}
									?>
									</div>
								</form>
							</div>
						</div>
					</div>
				</section>        
			</div>
		</div>
	</div>

	<?php include './url/footer.php'; ?>
  </body>