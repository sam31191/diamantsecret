<?php
if ( session_status() == PHP_SESSION_NONE ) {
	session_start();
}

include './conf/config.php';

if ( !isset($_SESSION['loggedIn']) || !$_SESSION['loggedIn'] ) {

	header("location: $__MAINDOMAIN__$lang/".__('login'));
	exit();
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
  <title><?php echo __("Account Page"); ?></title>
  
    <link href="<?php echo $__MAINDOMAIN__;?>assets/stylesheets/font.css" rel='stylesheet' type='text/css'>
  
	<link href="<?php echo $__MAINDOMAIN__;?>assets/stylesheets/font-awesome.min.css" rel="stylesheet" type="text/css" media="all"> 	
	<link href="<?php echo $__MAINDOMAIN__;?>assets/stylesheets/bootstrap.min.3x.css" rel="stylesheet" type="text/css" media="all">
	<link href="<?php echo $__MAINDOMAIN__;?>assets/stylesheets/cs.bootstrap.3x.css" rel="stylesheet" type="text/css" media="all">
	<link href="<?php echo $__MAINDOMAIN__;?>assets/stylesheets/cs.animate.css" rel="stylesheet" type="text/css" media="all">
	<link href="<?php echo $__MAINDOMAIN__;?>assets/stylesheets/cs.global.css" rel="stylesheet" type="text/css" media="all">
	<link href="<?php echo $__MAINDOMAIN__;?>assets/stylesheets/cs.style.css" rel="stylesheet" type="text/css" media="all">
	<link href="<?php echo $__MAINDOMAIN__;?>assets/stylesheets/cs.media.3x.css" rel="stylesheet" type="text/css" media="all">
	<link href="<?php echo $__MAINDOMAIN__;?>assets/stylesheets/site.css" rel="stylesheet" type="text/css" media="all">
	<link rel="icon" href="<?php echo $__MAINDOMAIN__;?>images/gfx/favicon.png?v=1" type="image/png" sizes="16x16">
	
	<script src="<?php echo $__MAINDOMAIN__;?>assets/javascripts/jquery-1.9.1.min.js" type="text/javascript"></script>
	<script src="<?php echo $__MAINDOMAIN__;?>assets/javascripts/bootstrap.min.3x.js" type="text/javascript"></script>
</head>

<?php
/*include './conf/config.php';*/


#pre
$alert = "";


if ( isset($_POST['removeFromFav'])) {
	pconsole($_POST['removeFromFav']);
	$getcurrentFavs = $pdo->prepare("SELECT `favorites` FROM `accounts` WHERE `username` = :username and site_id = :siteIdd");
	$getcurrentFavs->execute(array(":username" => $_USERNAME,":siteIdd" => $siteIdd));

	$result = $getcurrentFavs->fetch(PDO::FETCH_ASSOC);
	$currentFav = $result['favorites'];

	$currentFav = str_replace(',' . $_POST['removeFromFav'], "", $currentFav);

	$updateFav = $pdo->prepare("UPDATE `accounts` SET `favorites` = :favs WHERE `username` = :username");
	$updateFav->execute ( array (":favs" => $currentFav, ":username" => $_USERNAME) );
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
} else if ( isset($_POST['saveInfo']) ) {
	pconsole($_POST);

	if ( $_POST['new_pass'] !== $_POST['confirm_new_pass'] ) {
		$alert = __("New and Confirm Password Mismatch");
	} else {
		$authenticate = $pdo->prepare("SELECT * FROM `accounts` WHERE `username` = :user AND BINARY `password` = :pass");
		$authenticate->execute(array(":user" => $_USERNAME, ":pass" => $_POST['current_pass']));
		if ( $authenticate->rowCount() > 0 ) {
			$updateInfo = $pdo->prepare("UPDATE `accounts` SET `first_name` = :first_name, `last_name` = :last_name, `mobileno` = :mobileno, `address` = :address WHERE `username` = :username");
			$updateInfo->execute(array(
				":first_name" => $_POST['first_name'],
				":last_name" => $_POST['last_name'],
				":mobileno" => $_POST['mobileno'],
				":address" => $_POST['address'],
				":username" => $_USERNAME
			));

			if ( !empty($_POST['new_pass']) && !empty($_POST['confirm_new_pass']) ) {
				$updatePass = $pdo->prepare("UPDATE `accounts` SET `password` = :pass WHERE `username` = :user");
				$updatePass->execute(array(":pass" => $_POST['new_pass'], ":user" => $_USERNAME));
				$alert = __("Information") ." / ". __("Password Updated");
			} else {
				$alert = __("Information Updated");
			}
		} else {
			$alert = __("Authentication Failure")." / ".__("Please check your credentials");
		}
	}
}

?>
<body itemscope="" itemtype="http://schema.org/WebPage" class="templateCustomersRegister notouch">
<?php
  $link = '';
    if(isset($_GET['lang'])){
        if($_GET['lang']=='fr'){
            $link = 'account';
        }else{
            $link = 'compte';
        }
    }
?>
    
	<!-- Header -->
	<?php include './url/header.php'; ?>

  <input type="hidden" name="changeURL" id="changeURL" value="<?php echo $link; ?>"> 
	<div id="content-wrapper-parent">
		<div id="content-wrapper">  
			<!-- Content -->
			<div id="content" class="clearfix">        
				<div id="breadcrumb" class="breadcrumb">
					<div itemprop="breadcrumb" class="container">
						<div class="row">
							<div class="col-md-24">
								<a href="<?php echo $__MAINDOMAIN__.$lang.'/'; ?>" class="homepage-link" title="<?php echo __("Back to the frontpage"); ?>"><?php echo ucfirst(__('home')); ?></a>
								<span>/</span>
								<span class="page-title"><?php echo __("My Account"); ?></span>
							</div>
						</div>
					</div>
				</div>              
			<section class="content">
					<div class="container">
						<div class="row">
							<div id="page-header" class="col-md-24">
								<h1 id="page-title"><?php echo __("My Account"); ?></h1> 
							</div>
							<?php
								if ( !empty($alert) ) {
									echo '
										<div class="col-md-21 login-alert">
											<div class="alert alert-danger">
												<button type="button" class="close btooltip" data-toggle="tooltip" data-placement="top" title="" data-dismiss="alert" data-original-title="'.__("Close").'">×</button>
												<div class="errors">
													<ul>
														<li>'. $alert .'</li>
													</ul>
												</div>
											</div>
										</div>';
								}
							?>
							
							<div class="col-sm-6 col-md-6 sidebar">
								<div class="group_sidebar">
									<div class="row sb-wrapper unpadding-top">
										<h6 class="sb-title"><?php echo __("Account Details"); ?></h6>
										<span class="mini-line"></span>
										<?php
										$getUser = $pdo->prepare("SELECT * FROM `accounts` WHERE `username` = :user");
										$getUser->execute(array(":user" => $_USERNAME));

										if ( $getUser->rowCount() > 0 ) {
											$user = $getUser->fetch(PDO::FETCH_ASSOC);
											echo '
											<ul id="customer_detail" class="list-unstyled sb-content">
												<li>
												<address class="clearfix">
												<div class="info">
													<i class="fa fa-user"></i>
													<span class="address-group">
													<span class="author">'. $user['first_name'] . ' ' . $user['last_name'] .'</span>
													<span class="email">'. $user['email'] .'</span>
													</span>
												</div>
												<div class="address">
													<span class="address-group">
													<span class="address1">'. $user['address'] .'<span class="phone-number">'. $user['mobileno'] .'</span></span>
													</span>
												</div>
												</address>
												</li>
												<li>
												<button class="btn btn-1" id="view_address" onclick="$(\'#settingsModal\').modal(\'toggle\');">'.__("Settings").'<?php echo __("</button>
												</li>
											</ul>
											';
										} else {
											
										}
										?>
									</div>
								</div>
							</div>
							<div id="col-main" class="account-page col-sm-18 col-md-18 clearfix">
								<div id="customer_orders">
									<h6 class="sb-title"><?php echo __("Favorites"); ?></h6>
									<span class="mini-line"></span>
									<div class="row wrap-table">
										<table class="table-hover">
										<thead>
										<tr>
											<th class="order_number">
												<?php echo __("Item"); ?>
											</th>
											<th class="date">
												<?php echo __("Value"); ?>
											</th>
											<th class="payment_status">
												
											</th>
											<th class="total">
												
											</th>
										</tr>
										</thead>
										<tbody>
										<?php
										

										$getFavs = $pdo->prepare("SELECT * FROM `accounts` WHERE `username` = :user and site_id = :siteIdd");
										$getFavs->execute(array(":user" => $_USERNAME,":siteIdd" => $siteIdd));

										if ( $getFavs->rowCount() > 0 ) {
											$user = $getFavs->fetch(PDO::FETCH_ASSOC);
											
											$favorites = explode(",", $user['favorites']);

											

											foreach ( $favorites as $item ) {
												if ( !empty($item) ) {
													$getItemInfo = $pdo->prepare("SELECT * FROM `items` WHERE `unique_key` = :key");
													$getItemInfo->execute(array(":key" => $item));
													
													if ( $getItemInfo->rowCount() > 0 ) {
														$itemInfo = $getItemInfo->fetch(PDO::FETCH_ASSOC);
														
														////
														
														switch ($itemInfo['category']) {
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
													
													$getInfo->execute(array(":unique_key" => $itemInfo['unique_key']));
													$info = $getInfo->fetch(PDO::FETCH_ASSOC);
													//echo "<pre>";
													//print_r($info);
														/////
														
														$price = '<span class="price">€'. $itemInfo['item_value'] .'</span>';
														if ( $itemInfo['discount'] > 0 ) {
															
															$value = $itemInfo['item_value'] -  (($itemInfo['discount'] / 100 ) * $itemInfo['item_value']);
															$sale = '<span class="sale_banner"><span class="sale_text">'.__("Sale").'</span></span>';
															$price = '<span class="price_sale">€'. number_format($value, 2, ".", "") .'</span><del class="price_compare">€'. $itemInfo['item_value'] .'</del>';
														}
														$urlSubcategory = '';
													 if ( isset($_GET['_sc']) ) {
														$urlSubcategory = $_GET['_sc'];
													 } else {
														$urlSubcategory = $info['ring_subcategory'];
													 }
														echo '
														<tr class="odd ">
															<td>
																<a href="'.makeProductDetailPageUrl($urlSubcategory,$info['total_carat_weight'],$info['gold_quality'],$info['material'],$info['product_name'],$info['unique_key']) .'" title="">'. $itemInfo['item_name'] .'</a>
															</td>
															<td>
																<span class="note">'. $price .'</span>
															</td>
															<td>
																<span class="status_authorized"><a class="btn btn-custom" href="'.makeProductDetailPageUrl($urlSubcategory,$info['total_carat_weight'],$info['gold_quality'],$info['material'],$info['product_name'],$info['unique_key']) .'">'.__("View").'</a></span>
															</td>
															<td>
																<span class="total"><form method="post" action="'.$__MAINDOMAIN__.$lang.'/'.__('account').'"><button class="btn btn-custom" name="removeFromFav" value="'. $item .'">'.__("Remove").'</button></form></span>
															</td>
														</tr>';
													} else {
														echo '
														<tr class="odd ">
															<td>
																<a href="#" title="">'.__("Item Not Found").'</a>
															</td>
															<td>
																<span class="note">'.__("N/A").'</span>
															</td>
															<td>
																<span class="status_authorized">'.__("N/A").'</span>
															</td>
															<td>
																<span class="total"><form method="post" action="'.$__MAINDOMAIN__.$lang.'/'.__('account').'"><button class="btn btn-custom" name="removeFromFav" value="'. $item .'">'.__("Remove").'</button></form></span>
															</td>
														</tr>';
													}
												}
											}
										}
										?>
										</tbody>
										</table>
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
</body>


<div id="settingsModal" class="modal in" role="dialog" aria-hidden="false" tabindex="-1" data-width="800">
	<div class="modal-backdrop in" style="height: 742px;">
	</div>
	<div class="modal-dialog rotateInDownLeft animated">
		<div class="modal-content" style="min-height: 0px;  overflow:auto; height: 490px; max-width: 95vw;">
			<div class="modal-header">
				<i class="close fa fa-times btooltip" data-toggle="tooltip" data-placement="bottom" title="" data-dismiss="modal" aria-hidden="true" data-original-title="<?php echo __("Close"); ?>"></i>
			</div>
			<div class="modal-body">
				<div class="quick-shop-modal-bg" style="display: none;">
				</div>
				<div class="row">
				<form method="post" action="<?php echo $__MAINDOMAIN__.$lang.'/'.__('account')  ?>">
				<?php
				$fetchInfo = $pdo->prepare("SELECT * FROM `accounts` WHERE `username` = :user");
				$fetchInfo->execute(array(":user" => $_USERNAME));

				if ( $fetchInfo->rowCount() > 0 ) {
					$info = $fetchInfo->fetch(PDO::FETCH_ASSOC);
					
					echo '
					<div class="col-md-12">
						<label>'.__("Username").'</label>
						<input type="text" name="username" class="form-control" value="'. $info['username'] .'" disabled>
					</div>
					<div class="col-md-12">
						<label>'.__("Email").'</label>
						<input type="email" name="email" class="form-control" value="'. $info['email'] .'" disabled>
					</div>
					<div class="col-md-12">
						<label>'.__("First Name").'</label>
						<input type="text" name="first_name" value="'. $info['first_name'] .'" class="form-control">
					</div>
					<div class="col-md-12">
						<label>'.__("Last Name").'</label>
						<input type="text" name="last_name" value="'. $info['last_name'] .'" class="form-control">
					</div>
					<div class="col-md-12">
						<label>'.__("Phone Number").'</label>
						<input type="text" name="mobileno" value="'. $info['mobileno'] .'" pattern="[0-9+ ]{4,}" class="form-control">
					</div>
					<div class="col-md-12">
						<label>'.__("Address").'</label>
						<textarea type="text" name="address" class="form-control">'. $info['address'] .'</textarea>
					</div>
					<div class="col-md-12">
						<label>'.__("New Password").'</label>
						<input type="password" name="new_pass" class="form-control">
					</div>
					<div class="col-md-12">
						<label>'.__("Confirm New Password").'</label>
						<input type="password" name="confirm_new_pass" class="form-control">
					</div>
					<div class="col-md-24">
						<label>'.__("Current Password").' <span class="req">*</span></label>
						<input type="password" name="current_pass" class="form-control" required>
					</div>

					<div class="col-md-24" style="text-align:right;">
						<button type="submit" name="saveInfo" class="btn btn-custom" style="margin: 15px 20px; ">'.__("Save").'</button>
					</div>
					';
				}
				?>
				</form>
				</div>
			</div>
		</div>
	</div>
</div>

<?php

if ( isset($_GET['show']) ) {
	if ( $_GET['show'] == "settings" ) {
		echo '<script> $("#settingsModal").modal("toggle"); </script>';
	}
}
?>