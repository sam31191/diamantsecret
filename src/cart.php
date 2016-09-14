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
  	<link rel="icon" href="./images/gfx/favicon.png?v=1" type="image/png" sizes="16x16">
	
	<script src="./assets/javascripts/jquery-1.9.1.min.js" type="text/javascript"></script>
	<script src="./assets/javascripts/bootstrap.min.3x.js" type="text/javascript"></script>
</head>
<div class="alert alert-danger" style="position: fixed; top: 0px; right: 0; margin: 25px; width: 250px; min-height: 40px; text-align: center; display: none; z-index: 1000; font-size: 18px;" id="notificationBox"> </div>
<?php
if ( session_status() == PHP_SESSION_NONE ) {
	session_start();
}
include 'url/require.php';
include './assets/mail_format/admin_mail.php';
pconsole($_POST);

#pre
$subtotalMain = 0;

if ( !isset($_SESSION['loggedIn']) || !$_SESSION['loggedIn'] ) {
	header("location: ./login.php");
}

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
						$itemInfo2 = $getItemInfo2->fetch(PDO::FETCH_ASSOC);
						$getVat = $pdo->prepare("SELECT * FROM `country_vat` WHERE `id` = :id");
						$getVat->execute(array(":id" => $itemInfo2['country_id']));
						if ( $getVat->rowCount() > 0 ){
							$vat = $getVat->fetch(PDO::FETCH_ASSOC);	
						} else{
							echo "Unknown";
						}
						if ( $itemInfo['discount'] > 0 ) {
							$price = ($itemInfo['item_value'] - (($itemInfo['discount']/100) * $itemInfo['item_value']) );
						} else {
							$price = $itemInfo['item_value'];
						}
						if ( $itemInfo['category'] == 1 ) {
							$size = $item[1];
						} else {
							$size = "N/A";
						}
						$total = ($price + ( ($vat['vat'] / 100) * $price ) ) * $item[2];
						$orderedItemsAdmin .= '<tr>
									<td style="border: none;font-variant: small-caps;padding: 3px;text-align:center;">'.$itemInfo['unique_key'].'</td>
									<td style="border: none;font-variant: small-caps;padding: 3px;text-align:center;">'.trim(getCategory($itemInfo['category'],$pdo), "s").'</td>
									<td style="border: none;font-variant: small-caps;padding: 3px;text-align:center;"><a href="http://www.diamantsecret.com/product.php?view='. $itemInfo['unique_key'] .'">'.$itemInfo['item_name'].'</a></td>
									<td style="border: none;font-variant: small-caps;padding: 3px;text-align:center;"> &#0128;'.number_format($itemInfo['item_value'], 2, ".", "").'</td>
									<td style="border: none;font-variant: small-caps;padding: 3px;text-align:center;">'.$itemInfo['discount'].'%</td>
									<td style="border: none;font-variant: small-caps;padding: 3px;text-align:center;">'.$vat['vat'].'%</td>
									<td style="border: none;font-variant: small-caps;padding: 3px;text-align:center;">'.$item[2].'</td>
									<td style="border: none;font-variant: small-caps;padding: 3px;text-align:center;"> &#0128;'.number_format($total, 2, ".", "").'</td>
									<td style="border: none;font-variant: small-caps;padding: 3px;text-align:center;">'.getDiamondShape($itemInfo2['diamond_shape'],$pdo).'</td>
									<td style="border: none;font-variant: small-caps;padding: 3px;text-align:center;">'.getMaterial($itemInfo2['material'],$pdo).'</td>
									<td style="border: none;font-variant: small-caps;padding: 3px;text-align:center;">'.$itemInfo2['clarity'].'</td>
									<td style="border: none;font-variant: small-caps;padding: 3px;text-align:center;">'.getCompany($itemInfo2['company_id'],$pdo).'</td>
									<td style="border: none;font-variant: small-caps;padding: 3px;text-align:center;">'.getCountry($itemInfo2['country_id'],$pdo).'</td>
								</tr>';
						$orderedItems .= '<tr>
									<td style="border: none;font-variant: small-caps;padding: 3px;text-align:center;">'.trim(getCategory($itemInfo['category'],$pdo), "s").'</td>
									<td style="border: none;font-variant: small-caps;padding: 3px;text-align:center;"><a href="http://www.diamantsecret.com/product.php?view='. $itemInfo['unique_key'] .'">'.$itemInfo['item_name'].'</a></td>
									<td style="border: none;font-variant: small-caps;padding: 3px;text-align:center;"> &#0128;'.number_format($itemInfo['item_value'], 2, ".", "").'</td>
									<td style="border: none;font-variant: small-caps;padding: 3px;text-align:center;">'.$itemInfo['discount'].'%</td>
									<td style="border: none;font-variant: small-caps;padding: 3px;text-align:center;">'.$vat['vat'].'%</td>
									<td style="border: none;font-variant: small-caps;padding: 3px;text-align:center;">'.$item[2].'</td>
									<td style="border: none;font-variant: small-caps;padding: 3px;text-align:center;"> &#0128;'.number_format($total, 2, ".", "").'</td>
									<td style="border: none;font-variant: small-caps;padding: 3px;text-align:center;">'.getDiamondShape($itemInfo2['diamond_shape'],$pdo).'</td>
									<td style="border: none;font-variant: small-caps;padding: 3px;text-align:center;">'.getMaterial($itemInfo2['material'],$pdo).'</td>
									<td style="border: none;font-variant: small-caps;padding: 3px;text-align:center;">'.$itemInfo2['clarity'].'</td>
								</tr>';
						$subtotal += $total;
					}
				}
			}
			#$mailToAdmin .= '<h2>SubTotal: €'. number_format($subtotal, 2, ".", "") .'</h2>';

			#$mailToAdmin = mailToAdmin($_SESSION['username'], $orderedItemsAdmin, $subtotal, $_POST['note']);
			$mailToAdmin = file_get_contents('./conf/mail_formats/purchase_request_admin.html');
			$mailToAdmin = str_replace("__CLIENT__", $_SESSION['username'], $mailToAdmin);
			$mailToAdmin = str_replace("__ADMIN__", $__ADMIN__, $mailToAdmin);
			$mailToAdmin = str_replace("__ITEMS__", $orderedItemsAdmin, $mailToAdmin);
			$mailToAdmin = str_replace("__NOTE__", $_POST['note'], $mailToAdmin);
			$mailToAdmin = str_replace("__TOTAL__", number_format($subtotal, 2, ".", ""), $mailToAdmin);
			$mailToAdmin = str_replace("__CLIENTMAIL__", $cart['email'], $mailToAdmin);

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
			$mailToCustomer = str_replace("__TOTAL__", number_format($subtotal, 2, ".", ""), $mailToCustomer);
			//echo $mailToAdmin;
			#pconsole($mailToCustomer);


			#Sending Mails
			require './url/PHPMailerAutoload.php';
			$mail2 = new PHPMailer;
			$mail2->isSMTP();
			$mail2->SMTPDebug = 2;
			$mail2->Debugoutput = 'html';
			$mail2->Host = $mailHost;
			$mail2->Port = $mailPort;
			$mail2->SMTPAuth = $mailSMTPAuth;
			$mail2->Username = $mailUsername;
			$mail2->Password = $mailPassword;
			$mail2->setFrom('contact@diamantsecret.com', 'Diamant Secret');
			$mail2->addAddress($__ADMINMAIL__);
			$mail2->isHTML(true);
			$mail2->Subject = 'Enquiry Placed by ' . $_USERNAME;
			$mail2->Body = $mailToAdmin;
			if ( !$mail2->send() ) {
				$notify = "An Error Occured; Please Try Again Later";
			} else {
				$mail = new PHPMailer;
				$mail->isSMTP();
				$mail->SMTPDebug = 2;
				$mail->Debugoutput = 'html';
				$mail->Host = $mailHost;
				$mail->Port = $mailPort;
				$mail->SMTPAuth = $mailSMTPAuth;
				$mail->Username = $mailUsername;
				$mail->Password = $mailPassword;
				$mail->setFrom('contact@diamantsecret.com', 'Diamant Secret');
				$mail->addAddress($cart['email']);
				$mail->isHTML(true);
				$mail->Subject = 'Enquiry Placed';
				$mail->Body = $mailToCustomer;
				if ( !$mail->send() ) {
					$notify = "An Error Occured; Please Try Again Later";
				} else {
					$notify = "Enquiry Placed";
					echo '<script> $("#notificationBox").html("'. $notify .'"); $("#notificationBox").fadeToggle(500).delay(2000).fadeToggle(500); </script>';
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

	header("Location: ./cart.php");
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
													VAT
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
																			<a href="./product.html">
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
																		<a data-toggle="tooltip" title="'. $vat['country_name'] .'">'. $vat['vat'] .'%</a>
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
																			<a href="./product.html">
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