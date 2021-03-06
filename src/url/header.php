<?php


if ( $testSite && !isset($_SESSION['admin']) ) {
	echo "tester";
	echo '<script> window.location.href = "./under_construction/'.$_REQUEST['lang'].'index.php"; </script>';
	die();
} 
if ( isset($_POST['action']['logout']) ) {
	session_unset();
	session_destroy();

	echo '<script> window.location.href = "'.$__MAINDOMAIN__.$lang.'/"; </script>';
	die();
}
if ( !isset($_SESSION['loggedIn']) ) {
	$_SESSION['loggedIn'] = false;
}

$favorites = "";
if ( isset($_SESSION['loggedIn']) && $_SESSION['loggedIn'] ) {
	$getUserInfo = $pdo->prepare("SELECT * FROM `accounts` WHERE `username` = :user");
	$getUserInfo->execute(array(":user" => $_USERNAME));

	$info = $getUserInfo->fetch(PDO::FETCH_ASSOC);

	$favorites = $info['favorites'];
}

/*if ( isset($_POST['subscribe']) ) {
	$checkSubscriber = $pdo->prepare("SELECT * FROM `subscribers` WHERE `email` = :mail");
	$checkSubscriber->execute(array(":mail" => $_POST['email']));

	if ( $checkSubscriber->rowCount() == 0 ) {
		$hash = strtoupper((hash("MD5", $_POST['email'] . "RAND123HASH")));
		$subscribe = $pdo->prepare("INSERT INTO `subscribers` (`email`, `hash`) VALUES (:mail, :hash)");
		$subscribe->execute(array(":mail" => $_POST['email'], ":hash" => $hash));
		$notify = 'Subscribed Successfully';
	} else {
		$notify = 'Already subscribed';
	}

	echo '<script>$("#notificationBox").toggle(500).delay(2000).toggle(500);  $("#notificationBox").html("<span>'. $notify .'</span>");  </script>';

}*/

?>

<header id="top" class="clearfix" style="background: rgba(255,255,255,0.6);">
	<!--top-->
	<div class="container">
		<div class="top row">
			<div class="col-md-8 phone-shopping">
				<span><?php echo __("Phone"); ?>: +32 3 298 58 66</span>&nbsp;&nbsp;
				<span><a href="javascript:void(0);" onclick="urlclick('en','fr')"><img src="<?php echo $__MAINDOMAIN__;?>images/gfx/lang-france.png" style="height:14px; padding-bottom: 2px;">&nbsp;Français</a></span>&nbsp;&nbsp;
				<span><a href="javascript:void(0);" onclick="urlclick('fr','en')"><img src="<?php echo $__MAINDOMAIN__;?>images/gfx/lang-uk.png" style="height:14px; padding-bottom: 2px;">&nbsp;English</a></span>
			</div>
			<div class="col-md-16">
				<ul class="text-right">
				<li class="customer-links hidden-xs" style="width:100%;">
					<ul id="accounts" class="list-inline">
						<li class="my-account">
							<a href="<?php echo $__MAINDOMAIN__.''.$lang.'/'.__('account')?>"><?php echo __("My Account"); ?></a>
						</li> 

						<?php
						if ( isset($_SESSION['loggedIn']) && $_SESSION['loggedIn'] ) {
							if ( isset($_SESSION['loginAs']) ) {
								$ast = '<span class="req">*</span>';
							} else {
								$ast = "";
							}
							if(isset($lang) && $lang=='fr'){
								$orders = 'ordres';
							}else{
								$orders = 'orders';
							}
							echo'
							<li class="login">    
								<span id="loginButton" class="dropdown-toggle" data-toggle="dropdown">
									<a href="javascript:void(0);">'.__("Hi").', '. $_USERNAME . $ast . '</a>
									<i class="sub-dropdown1"></i>
									<i class="sub-dropdown"></i>
								</span>
								<!-- Customer Account Login -->
								<div id="loginBox" class="dropdown-menu text-left" style="padding:0;">
									<div id="bodyBox" style="text-align:right">
										<ul class="control-container customer-accounts list-unstyled" style="padding:0;">           
											<a href="'.$__MAINDOMAIN__.$lang.'/'.__('account').'" class="dropdown-item">'.__("Favorites").'<span id="favorite_num_badge" style="padding: 2px 6px; background: #F9A825; border-radius: 100px; margin: 0px 0px 0px 5px; font-size: 12px; color: white; font-weight: bold;">'. intval(count(explode(",", $favorites)) - 1) .'</span></a>
											<a href="'.$__MAINDOMAIN__.$lang.'/'.__('account').'?show=settings" class="dropdown-item">'.__("Settings").'</a>              
											<a href="'.$__MAINDOMAIN__.$lang.'/'.$orders.'" class="dropdown-item">'.__("Orders").'</a>              
											<form method="post">
											<button href="#" class="btn-logout" name="action[logout]" value="true">'.__("Logout").'</button>
											</form>
										</ul>
									</div>
								</form>
								</div>    
							</li>';
						} else {
							echo'
							<li class="login">    
								<span id="loginButton" class="dropdown-toggle" data-toggle="dropdown">
									<a href="'.$__MAINDOMAIN__.$lang.'/'.__('login').'">'.__("Login").'</a>
									<i class="sub-dropdown1"></i>
									<i class="sub-dropdown"></i>
								</span>
								<!-- Customer Account Login -->
								<div id="loginBox" class="dropdown-menu text-left">
								<form method="post" action="'.$__MAINDOMAIN__.$lang.'/'.__('login').'" id="customer_login" accept-charset="UTF-8"><input type="hidden" value="customer_login" name="form_type"><input type="hidden" name="utf8" value="✓">
									<div id="bodyBox">
										<ul class="control-container customer-accounts list-unstyled">
											<li class="clearfix">
												<label for="customer_email_box" class="control-label">'.__("Username").' <span class="req">*</span></label>
												<input type="text" value="" name="login[username]" id="customer_email_box" class="form-control" required>
											</li>            
											<li class="clearfix">
												<label for="customer_password_box" class="control-label">'.__("Password").' <span class="req">*</span></label>
												<input type="password" value="" name="login[password]" id="customer_password_box" class="form-control password" required>
											</li>             
											<li class="clearfix">
												<button class="action btn btn-1" type="submit">'.__("Login").'</button>
											</li>
											<!-- <li class="clearfix">
												<a class="action btn btn-1" href="'.$__MAINDOMAIN__.$lang.'/'.__('register').'">'.__("Create an account").'</a>
											</li> -->
										</ul>
									</div>
								</form>
								</div>    
							</li>
							<li>/</li>   
							<li class="register">
								<a href="'.$__MAINDOMAIN__.$lang.'/'.__('register').'" id="customer_register_link">'.__("Create an account").'</a>
							</li> ';
						}
						?>
					</ul>
				</li>        
				</ul>
			</div>
		</div>
	</div>
	<!--End top-->
	<div class="line"></div>
	<!-- Navigation -->
	<div class="container">
		<div class="top-navigation">
			<ul class="list-inline">
				<li class="top-logo">
					<a id="site-title" href="<?php echo $__MAINDOMAIN__.''.$lang.'/'; ?>" title="Diamant Secret">          
					<img class="img-responsive" src="<?php echo $__MAINDOMAIN__;?>images/gfx/logo.png" alt="Diamant Secret" style="max-width: 220px; margin:2px">
					</a>
				</li>
				<li class="navigation">     
					<nav class="navbar">
						<div class="clearfix">
							<div class="navbar-header">
								<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
								<span class="sr-only"><?php echo __("Toggle main navigation"); ?></span>
								<span class="icon-bar"></span>
								<span class="icon-bar"></span>
								<span class="icon-bar"></span>
								</button>
							</div>
							<div class="is-mobile visible-xs">
								<ul class="list-inline">
									<li class="is-mobile-menu">
									<div class="btn-navbar" data-toggle="collapse" data-target=".navbar-collapse">
										<span class="icon-bar-group">
										<span class="icon-bar"></span>
										<span class="icon-bar"></span>
										<span class="icon-bar"></span>
										</span>
									</div>
									</li>
									<li class="is-mobile-login">
									<div class="btn-group">
										<div class="dropdown-toggle" data-toggle="dropdown">
											<i class="fa fa-user"></i>
										</div>
										<ul class="customer dropdown-menu">
										<?php 
										if ( isset($_SESSION['loggedIn']) && $_SESSION['loggedIn'] ) {
											echo '
												<li>
												<a href="'.$__MAINDOMAIN__.$lang.'/'.__('account').'">'.__("Account").'</a> 
												</li>
												<li>
												<a href="'.$__MAINDOMAIN__.$lang.'/'.__('orders').'">'.__("Orders").'</a> 
												</li>
												<li class="account last">
												<form method="post">
												<button href="#" class="btn-logout" name="action[logout]" value="true" style="padding: 0px; text-align: left;">'.__("Logout").'</button>
												</form>
												</li>';
										} else {
											echo '
												<li class="logout">
												<a href="'.$__MAINDOMAIN__.$lang.'/'.__('login').'">'.__("Login").'</a>
												</li>
												<li class="account last">
												<a href="'.$__MAINDOMAIN__.$lang.'/'.__('register').'">'.__("Register").'</a>
												</li>';
										}
										?>
										</ul>
									</div>
									</li>
									<li class="is-mobile-wl">
									<a href="<?php echo $__MAINDOMAIN__.''.$lang.'/'.__('account')?>"><i class="fa fa-heart"></i></a>
									</li>
									<li class="is-mobile-cart">
									<a href="<?php echo $__MAINDOMAIN__.''.$lang.'/'.__('cart')?>"><i class="fa fa-shopping-cart"></i></a>
									</li>
								</ul>
							</div>
							<div class="collapse navbar-collapse">
								<ul class="nav navbar-nav hoverMenuWrapper">
									<li class="nav-item active">
									<a href="<?php echo $__MAINDOMAIN__.''.$lang.'/'?>">
									<span><?php echo ucfirst(__("home")); ?></span>
									</a>
									</li>
									<li class="dropdown mega-menu">
									<a href="<?php echo $__MAINDOMAIN__.''.$lang.'/'.strtolower(__('Collection')); ?>" class="dropdown-toggle dropdown-link" data-toggle="dropdown" onclick="window.location.href= '<?php echo $__MAINDOMAIN__.''.$lang.'/'?>collection'">
									<span><?php echo __("Collections"); ?></span>
									<i class="fa fa-caret-down"></i>
									<i class="sub-dropdown1 visible-sm visible-md visible-lg"></i>
									<i class="sub-dropdown visible-sm visible-md visible-lg"></i>
									</a>
									<div class="megamenu-container megamenu-container-1 dropdown-menu banner-bottom mega-col-4" style="">
										<ul class="sub-mega-menu">
											<div class="collection-link-list">
												<ul>
													<li><a class="collection-link-title" href="<?php echo $__MAINDOMAIN__.''.$lang.'/'.processUrlParameter(__('Rings'))?>"><?php echo __("Rings"); ?></a></li>
													<?php 
													$query = $pdo->prepare("SELECT * FROM `ring_subcategory` WHERE `category_id` = 1");
												$query->execute();
													
													if ( $query->rowCount() > 0 ) {
														$query = $query->fetchAll();

														foreach ( $query as $option ) {
															
															if(isset($_GET['lang'])){
																
																if($_GET['lang']=='fr'){
																	$tag = $option['category'];

																	$tag = strtolower(str_replace(" ","-",$tag));
																	$tag = str_replace("Bague ", " ", __($tag));
																}else{
																	$tag = $option['category'];
																	$tag = str_replace("Ring", " ", $tag);
																}
															}

															echo '<li><a class="collection-link" href="'.$__MAINDOMAIN__.$lang.'/'.makeOppositeUrlFromCurrentLang(__('Rings'),$option['category'],$lang,1).'">'. $tag .'</a></li>';
														}
													}
													?>
												</ul>
											</div>
											<div class="collection-link-list">
												<ul>
													<li><a class="collection-link-title" href="<?php echo $__MAINDOMAIN__.''.$lang.'/'.processUrlParameter(__('Earrings'))?>"><?php echo __("Earrings"); ?></a></li>
													<?php 
													$query = $pdo->prepare("SELECT * FROM `ring_subcategory` WHERE `category_id` = 2");
													$query->execute();
													if ( $query->rowCount() > 0 ) {
														$query = $query->fetchAll();
														foreach ( $query as $option ) {
															
															if(isset($_GET['lang'])){
																
																if($_GET['lang']=='fr'){
																	$tag = $option['category'];

																	$tag = strtolower(str_replace(" ","-",$tag));
																	$tag = str_replace("Boucles d'oreilles ", " ", __($tag));
																	$tag = str_replace("Boucle d'oreille ", " ", __($tag));
																}else{
																	$tag = $option['category'];
																	$tag = str_replace("Earrings", " ", $tag);
																	$tag = str_replace("Earring", " ", $tag);
																}
															}

															echo '<li><a class="collection-link" href="'.$__MAINDOMAIN__.$lang.'/'.makeOppositeUrlFromCurrentLang(processUrlParameter(__("Earrings")),$option['category'],$lang,1).'">'. $tag .'</a></li>';
														}
													}
													?>
												</ul>
											</div>
											<div class="collection-link-list">
												<ul>
													<li><a class="collection-link-title" href="<?php echo $__MAINDOMAIN__.''.$lang.'/'.processUrlParameter(__('Pendants'))?>"><?php echo __("Pendants"); ?></a></li>
													<?php 
													$query = $pdo->prepare("SELECT * FROM `ring_subcategory` WHERE `category_id` = 3");
													$query->execute();
													if ( $query->rowCount() > 0 ) {
														$query = $query->fetchAll();
														foreach ( $query as $option ) {
															
															if(isset($_GET['lang'])){
																
																if($_GET['lang']=='fr'){
																	$tag = $option['category'];

																	$tag = strtolower(str_replace(" ","-",$tag));
																	$tag = str_replace("Pendentif ", " ", __($tag));
																}else{
																	$tag = $option['category'];
																	$tag = str_replace("Pendant", " ", $tag);
																}
															}

															echo '<li><a class="collection-link" href="'.$__MAINDOMAIN__.$lang.'/'.makeOppositeUrlFromCurrentLang(__('Pendants'),$option['category'],$lang,1).'">'. $tag .'</a></li>';
														}
													}
													?>
												</ul>
											</div>
											<div class="collection-link-list">
												<ul>
													<li><a class="collection-link-title" href="<?php echo $__MAINDOMAIN__.''.$lang.'/'.processUrlParameter(__('Necklaces'))?>"><?php echo __("Necklaces"); ?></a></li>
													<?php 
													$query = $pdo->prepare("SELECT * FROM `ring_subcategory` WHERE `category_id` = 4");
													$query->execute();
													if ( $query->rowCount() > 0 ) {
														$query = $query->fetchAll();
														foreach ( $query as $option ) {
															
															if(isset($_GET['lang'])){
																
																if($_GET['lang']=='fr'){
																	$tag = $option['category'];

																	$tag = strtolower(str_replace(" ","-",$tag));
																	$tag = str_replace("Collier ", " ", __($tag));
																}else{
																	$tag = $option['category'];
																	$tag = str_replace("Necklace", " ", $tag);
																}
															}
															
															echo '<li><a class="collection-link" href="'.$__MAINDOMAIN__.$lang.'/'.makeOppositeUrlFromCurrentLang(__('Necklaces'),$option['category'],$lang,1).'">'. $tag .'</a></li>';
														}
													}
													?>
												</ul>
											</div>
											<div class="collection-link-list">
												<ul>
													<li><a class="collection-link-title" href="<?php echo $__MAINDOMAIN__.''.$lang.'/'.processUrlParameter(__('Bracelets'))?>"><?php echo __("Bracelets"); ?></a></li>
													<?php 
													$query = $pdo->prepare("SELECT * FROM `ring_subcategory` WHERE `category_id` = 5");
													$query->execute();
													if ( $query->rowCount() > 0 ) {
														$query = $query->fetchAll();
														foreach ( $query as $option ) {

															if(isset($_GET['lang'])){
																
																if($_GET['lang']=='fr'){
																	$tag = $option['category'];

																	$tag = strtolower(str_replace(" ","-",$tag));
																	$tag = str_replace("Bracelet ", " ", __($tag));
																}else{
																	$tag = $option['category'];
																	$tag = str_replace("Bracelet", " ", $tag);
																}
															}

															echo '<li><a class="collection-link" href="'.$__MAINDOMAIN__.$lang.'/'.makeOppositeUrlFromCurrentLang(__('Bracelets'),$option['category'],$lang,1).'">'. $tag .'</a></li>';
														}
													}
													?>
												</ul>
											</div>
										</ul>
									</div>
									</li>
									<li class="nav-item">
									<a href="<?php echo $__MAINDOMAIN__.''.$lang.'/'.__('contact')?>">
									<span><?php echo __("Contact"); ?></span>
									</a>
									</li>
									<li class="nav-item">
										<a href="<?php echo $__MAINDOMAIN__.''.$lang.'/'.__('diamond-search')?>">
										<span><?php echo __("Diamond Search"); ?></span>
										</a>
									</li>
									<?php 
										if ( isset($_SESSION['admin']) && $_SESSION['admin'] > 0 ) {
											echo '
												<li class="nav-item">
												<a href="'.$__MAINDOMAIN__.'admin/login.php">
												<span>'.__("Admin").'</span>
												</a>
												</li>';
										}
									?>
								</ul>
							</div>
						</div>
					</nav>
				</li>
				<?php 
				if ( isset($_GET['q']) ) {
					$searchTag = $_GET['q'];
					$searchFilter = " AND item_name LIKE '%".$_GET['q']."%' ";
				} else {
					$searchTag = "";
					$searchFilter = "";
				}
				?>
				<li class="top-search hidden-xs">
					<div class="header-search">
						<a href="#">
						<span data-toggle="dropdown">
						<i class="fa fa-search"></i>
						<i class="sub-dropdown1"></i>
						<i class="sub-dropdown"></i>
						</span>
						</a>
						<form id="header-search" class="search-form dropdown-menu" action="<?php echo $__MAINDOMAIN__.$lang.'/'.strtolower(__('collection'))?>" method="get">
							<input type="hidden" name="type" value="product">
							<input type="text" name="q" accesskey="4" autocomplete="off" placeholder="<?php echo __('Search Product'); ?>" value="<?php echo $searchTag; ?>">
							<button type="submit" class="btn"><?php echo __("Search"); ?></button>
						</form>
					</div>
				</li>
				<li class="mobile-search visible-xs">
					<form id="mobile-search" class="search-form" action="<?php echo $__MAINDOMAIN__.$lang.'/'.__('collection')?>" method="get">
						<input type="hidden" name="type" value="product">
						<input type="text" class="" name="q" accesskey="4" autocomplete="off" placeholder="<?php echo __('Search Product'); ?>" value="<?php echo $searchTag; ?>">
						<button type="submit" class="search-submit" title="<?php echo __('Search'); ?>"><i class="fa fa-search"></i></button>
					</form>
				</li> 
				<?php
				if ( $_SESSION['loggedIn'] ) { //<cart>

					$cartItems = array("");

					$userCart = $pdo->prepare("SELECT * FROM tb_cart WHERE user_id = :user");
					$userCart->execute(array(":user" => $_SESSION['user_id']));
					if ( $userCart->rowCount() > 0 ) {
						$tempEntry = "";
						foreach ( $userCart->fetchAll() as $item ) {
							$tempEntry .= $item['product_id'] . "|" . $item['size'] . "|" . $item['quantity'] . ",";
						}

						$cartItems = explode(",", $tempEntry);
					}
				} else {
					if ( isset($_COOKIE[COOKIE_CART]) ) {
						$cartItems = explode(",", $_COOKIE[COOKIE_CART]);
					} else {
						$cartItems = array("");
					}
				}

				pconsole($cartItems);
				?>    
				<li class="umbrella hidden-xs">
					<div id="umbrella" class="list-inline unmargin">
						<div class="cart-link">
							<a href="<?php echo $__MAINDOMAIN__.$lang.'/'.__('cart')?>" class="dropdown-toggle dropdown-link" data-toggle="dropdown" style="white-space: nowrap;">
								<i class="sub-dropdown1"></i>
								<i class="sub-dropdown"></i>
								<div class="num-items-in-cart">
									<span class="icon">
										<?php echo __("Cart"); ?>
										<?php
											echo '<span class="number">'. intval(count($cartItems) - 1) .'</span>';
										?>
									</span>
								</div>
							</a>
							<div id="cart-info" class="dropdown-menu" style="display: none; overflow: auto; max-height: 80vh;">
								<div id="cart-content">
									<?php
										$subtotal = 0.0;
										if ( count($cartItems) > 1 ) {
											for ($i = 0; $i < intval(count($cartItems) - 1); $i++ ) {
												$cartItem = explode("|", $cartItems[$i]);

												$getCartItemCategory = $pdo->prepare("SELECT * FROM `items` WHERE `unique_key` = :key");
												$getCartItemCategory->execute(array(":key" => $cartItem[0]));
												if ( $getCartItemCategory->rowCount() > 0 ) {
														$cartItemCategory = $getCartItemCategory->fetch(PDO::FETCH_ASSOC);

														switch ($cartItemCategory['category']) {
															case 1:
																$getCartItemInfo = $pdo->prepare("SELECT * FROM `rings` WHERE `unique_key` = :key");
																break;
															case 2:
																$getCartItemInfo = $pdo->prepare("SELECT * FROM `earrings` WHERE `unique_key` = :key");
																break;
															case 3:
																$getCartItemInfo = $pdo->prepare("SELECT * FROM `pendants` WHERE `unique_key` = :key");
																break;
															case 4:
																$getCartItemInfo = $pdo->prepare("SELECT * FROM `necklaces` WHERE `unique_key` = :key");
																break;
															case 5:
																$getCartItemInfo = $pdo->prepare("SELECT * FROM `bracelets` WHERE `unique_key` = :key");
																break;
															
															default:
																break;
														}

														$getCartItemInfo->execute(array(":key" => $cartItem[0]));

														$cartItemInfo = $getCartItemInfo->fetch(PDO::FETCH_ASSOC);

														$images = explode(",", $cartItemInfo['images']);

														if ( $images[0] == "" || !is_file($directory_path.'images/images_sm/'. $images[0])) {
															$images[0] = '0.png';
														}

														$urlSubcategory = '';
														// 	if ( isset($_GET['_sc']) && (int)$ringTag>0) {
														// 	$urlSubcategory = $ringTag;
														// } else if ( isset($_GET['_sc'])) {
														// 	$urlSubcategory = $_GET['_sc'];
														// 	} else {
														// 	$urlSubcategory = $cartItemInfo['ring_subcategory'];
														// 	} 
														$urlSubcategory = $cartItemInfo['ring_subcategory'];

														$img_alt = makeProductDetailPageUrl($urlSubcategory,$cartItemInfo['total_carat_weight'],$cartItemInfo['gold_quality'],$cartItemInfo['material'],$cartItemInfo['product_name'],$cartItemInfo['unique_key'],$alt_tag=1);
														
														echo '
															<div class="items control-container">
																<div class="row items-wrapper">
																	<form method="post" id="removeFromCart_'. $i .'">
																	<input name="unique_key" value="'. $cartItemInfo['unique_key'] .'" hidden />
																	<input name="size" value="'. $cartItem[1] .'" hidden />
																	<input name="quantity" value="'. $cartItem[2] .'" hidden />
																	<input name="offset" value="'. $i .'" hidden />
																	</form>
																	<button class="cart-close" title="'.__("Remove").'" href="javascript:void(0);" style="background:transparent;" form="removeFromCart_'. $i .'" type="submit" name="removeFromCart"><i class="fa fa-times"></i></button>
																	<div class="col-md-8 cart-left">
																		<a class="cart-image" href="'.makeProductDetailPageUrl($urlSubcategory,$cartItemInfo['total_carat_weight'],$cartItemInfo['gold_quality'],$cartItemInfo['material'],$cartItemInfo['product_name'],$cartItemInfo['unique_key']) .'"><img src="'. $__MAINDOMAIN__.'images/images_sm/'. $images[0] .'" alt="'.ucfirst($img_alt).'" title=""></a>
																	</div>
																	<div class="col-md-16 cart-right">
																		<div class="cart-title">
																			<a href="'.makeProductDetailPageUrl($urlSubcategory,$cartItemInfo['total_carat_weight'],$cartItemInfo['gold_quality'],$cartItemInfo['material'],$cartItemInfo['product_name'],$cartItemInfo['unique_key']) .'">'. $cartItemCategory['item_name'] .'<br><small>'.__("Size").': '. $cartItem[1] .'</small></a>
																		</div>
																		<div class="cart-price">
																			€ '. $cartItemCategory['item_value'] .'<span class="x"> x </span>'. $cartItem[2] .'
																		</div>
																	</div>
																</div>
															</div>';
															$subtotal += floatval($cartItemCategory['item_value']) * $cartItem[2];
													} else { 
															echo '
																<div class="items control-container">
																	<div class="row items-wrapper">
																		<form method="post" id="removeFromCart_'. $i .'">
																		<input name="unique_key" value="'. $cartItem[0] .'" hidden />
																		<input name="quantity" value="'. $cartItem[2] .'" hidden />
																		<input name="offset" value="'. $i .'" hidden />
																		<input name="size" value="'. $cartItem[1] .'" hidden />
																		</form>
																		<button class="cart-close" title="'.__("Remove").'" href="javascript:void(0);" style="background:transparent;" form="removeFromCart_'. $i .'" type="submit" name="removeFromCart"><i class="fa fa-times"></i></button>
																		<div class="col-md-8 cart-left">
																			<a class="cart-image"><img src="'.$__MAINDOMAIN__.'images/images_sm/0.png" alt="" title=""></a>
																		</div>
																		<div class="col-md-16 cart-right">
																			<div class="cart-title">
																				<a>'.__("Item Unavailable").' <i class="fa fa-question-circle" data-toggle="tooltip" data-placement="bottom" title="'.__("Item Deleted or Invalid").'"></i></small></a>
																			</div>
																			<div class="cart-price">
																				€ 0.0 <span class="x"> x </span>0
																			</div>
																		</div>
																	</div>
																</div>';
													}
											}
										} else {
											echo '<span style="display: block; text-align: center; margin: 20px 0px;">'.__("Your Cart Is Empty").'</span>';
										}
										echo '
											<div class="subtotal">
												<span>'.__("Subtotal").':</span><span class="cart-total-right"> €'. $subtotal .'</span>
											</div>';
									?>
									<div class="action">
										<a class="btn btn-1" href="<?php echo $__MAINDOMAIN__.''.$lang.'/'.__('cart')?>"><?php echo __("View Cart"); ?></a>
									</div>
								</div>
							</div>
						</div>
					</div>
				</li>   

			</ul>
		</div>
		<!--End Navigation-->
		<script>
			function addaffix(scr){
			if($(window).innerWidth() >= 1024){
				if(scr > $('#top').innerHeight()){
				if(!$('#top').hasClass('affix')){
					$('#top').addClass('affix').addClass('animated');
				}
				}
				else{
				if($('#top').hasClass('affix')){
					$('#top').prev().remove();
					$('#top').removeClass('affix').removeClass('animated');
				}
				}
			}
			else $('#top').removeClass('affix');
			}
			$(window).scroll(function() {
			var scrollTop = $(this).scrollTop();
			addaffix(scrollTop);
			});
			$( window ).resize(function() {
			var scrollTop = $(this).scrollTop();
			addaffix(scrollTop);
			});
		</script>
	</div>
	
</header>