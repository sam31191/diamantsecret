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
<div class="alert" style="position: fixed; top: 0px; background: rgba(0, 165, 255, 0.5) none repeat scroll 0% 0%; margin: 25px; width: 250px; text-align: center; display: none; width: 60%; margin: 5% 20%; z-index: 1000; color: white; border: thin solid rgba(191, 191, 191, 0.48); font-size: 18px; font-variant: small-caps; font-weight: bold;" id="notificationBox"> </div>
<?php
if ( session_status() == PHP_SESSION_NONE ) {
	session_start();
}
include 'url/require.php';
pconsole($_POST);

#pre
$subtotalMain = 0;

if ( !isset($_SESSION['loggedIn']) || !$_SESSION['loggedIn'] ) {
	header("location: ./login.php");
}

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
} else if ( isset($_POST['checkout']) ) {
	$getCart = $pdo->prepare("SELECT * FROM `accounts` WHERE `username` = :username");
	$getCart->execute(array(":username" => $_SESSION['username']));

	if ( $getCart->rowCount() > 0 ) {
		$cart = $getCart->fetch(PDO::FETCH_ASSOC);

		if ( !empty($cart['cart']) ) {
			$items = explode(",", $cart['cart']);
			$mailToAdmin = '<h3>Enquiry By</h3>Name: '. $_SESSION['username'] .'<br>Email: '. $cart['email'] .'<br>Phone: '. $cart['mobileno'] .'<hr />';
			$inquiredItems = "";
			$subtotal = 0;
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
							echo "Invalid VAT ID";
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
						$mailToAdmin .= '<strong><a href="diamantsecret.com/product.php?view='. $item[0] .'">'. $itemInfo['item_name'] .'</a></strong><br>Value: €'. number_format($price, 2, ".", "") .'<br>Size: '. $size .'<br>Discount: '. $itemInfo['discount'] .'%<br>VAT: '. $vat['vat'] .'%<br>Quantity: '. $item[2] .'<br>Total: €'. number_format($total, 2 ,".", "") . "<hr />";
						$inquiredItems .=  '<li><a href="diamantsecret.com/product.php?view='. $item[0] .'">'. $itemInfo['item_name'] .'</a></li>';
						$subtotal += $total;
					}
				}
			}
			$mailToAdmin .= '<h2>SubTotal: €'. number_format($subtotal, 2, ".", "") .'</h2>';
			$mailToCustomer = '<h4>Your Inquiery has been posted</h4><ul>'. $inquiredItems .'</ul><p>We will get back to you as soon as possible.</p>';
			pconsole($mailToAdmin );
			pconsole($mailToCustomer);


			#Sending Mails
			require './url/PHPMailerAutoload.php';
			$mail = new PHPMailer;
			$mail->isSMTP();
			#$mail->SMTPDebug = 2;
			#$mail->Debugoutput = 'html';
			$mail->Host = $mailHost;
			$mail->Port = $mailPort;
			$mail->SMTPAuth = $mailSMTPAuth;
			$mail->Username = $mailUsername;
			$mail->Password = $mailPassword;
			$mail->setFrom('contact@diamantsecret.com', 'Diamant Secret');
			$mail->addAddress($cart['email']);
			$mail->isHTML(true);
			$mail->Subject = 'Enquiry Placed';
			$mail->Body = "Greetings, " . $_SESSION['username'] . $mailToCustomer;
			if ( !$mail->send() ) {
				$notify = "An Error Occured; Please Try Again Later";
			} else {
				$notify = "Enquiry Placed";
				echo '<script> $("#notificationBox").html("'. $notify .'"); $("#notificationBox").toggle(2000).delay(2000).toggle(2000); </script>';
			}

			$mail2 = new PHPMailer;
			$mail2->isSMTP();
			#$mail->SMTPDebug = 2;
			#$mail->Debugoutput = 'html';
			$mail2->Host = $mailHost;
			$mail2->Port = $mailPort;
			$mail2->SMTPAuth = $mailSMTPAuth;
			$mail2->Username = $mailUsername;
			$mail2->Password = $mailPassword;
			$mail2->setFrom('contact@diamantsecret.com', 'Diamant Secret');
			$mail2->addAddress($adminEmail);
			$mail2->isHTML(true);
			$mail2->Subject = 'Enquiry Placed by ' . $_SESSION['username'];
			$mail2->Body = $mailToAdmin . '<h4>Note: '. $_POST['note'] .'</h4>';
			if ( !$mail2->send() ) {
				$notify = "An Error Occured; Please Try Again Later";
			} else {
				$notify = "Enquiry Placed";
				echo '<script> $("#notificationBox").html("'. $notify .'"); $("#notificationBox").toggle(2000).delay(2000).toggle(2000); </script>';
			}



		}
	}


}

if ( isset($_POST['removeItem']) ) {
	echo var_dump($_POST);
	$getCart = $pdo->prepare("SELECT `cart` FROM `accounts` WHERE `username` = :user");
	$getCart->execute(array(
		":user" => $_SESSION['username']
	));
	$inputCart = $getCart->fetch(PDO::FETCH_ASSOC);
	$cart = $inputCart['cart'];
		
	$cart = str_replace($_POST['removeItem'] . ',', "", $cart);
	
	$addToCart = $pdo->prepare("UPDATE `accounts` SET `cart` = :cart WHERE `username` = :user");
	$addToCart->execute(array(
		":cart" => $cart,
		":user" => $_SESSION['username']
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
														} else {
															$vat = "VAT Unknown";
														}

														$vatAmount = $value * $itemVal[2];
														$vatAmount += (($vat['vat'] / 100) * $vatAmount);
														pconsole("SUB: " . $subtotalMain . " ITEM: " . $itemVal[0] . "VATAMOUNT: " . $vatAmount);
														$subtotalMain += $vatAmount;

														echo '
															<tr class="item donec-condime-fermentum">
																<td class="title text-left">
																	<ul class="list-inline">
																		<li class="image">
																		<a href="./product.php?view='. $result['unique_key'] .'">
																		<img src="./images/thumbnails/'. $images[0] .'" alt="'. $itemInfo['product_name'] .'">
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
																	<input class="form-control input-1 replace" maxlength="5" size="5" id="updates_3947646083" name="updates[]" value="'. $itemVal[2] .'" disabled>
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
												<td class="subtotal title-1">
													<?php echo '€' . number_format($subtotalMain, 2, ".", ""); ?>
												</td>
												<td>
													&nbsp;
												</td>
											</tr>
											</tfoot>
											</table>
										</div>
									</div>
									<div class="clearfix">
									<?php
									if ( $subtotal > 0 ) {
										echo'
											<div id="checkout-proceed" class="last1 text-right">
												<button class="btn" type="submit" id="checkout" name="checkout">Buy Request</button>
											</div>
											';
									}
									?>
									</div>
									<div class="row">
										<div id="checkout-addnote" class="col-md-24">
											<div class="wrapper-title">
												<span class="title-5">Add a note for the seller</span>
											</div>
											<textarea id="note" rows="8" class="form-control" name="note"></textarea>
										</div>
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