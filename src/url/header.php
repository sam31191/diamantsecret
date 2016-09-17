
<div class="container" style="
    position: fixed;
    /* top: 0px; */
    /* right: 0; */
    /* margin: 25px; */
    /* min-width: 250px; */
    /* min-height: 40px; */
    text-align: center;
    display: none;
    font-size: 18px;
    background: #f2e4cc;
    margin: 20px 15%;
    width: 70%;
    top: 0px;
    z-index: 2000;
    padding: 5px;
    font-variant: small-caps;" id="notificationBox"></div>
<?php
if ( session_status() == PHP_SESSION_NONE ) {
  session_start();
}

if ( $testSite && !isset($_SESSION['admin']) ) {
   header("Location: ./under_construction/index.php");
   die();
} else if ( isset($_POST['action']['logout']) ) {
  session_unset();
  session_destroy();

  echo '<script> window.location.href = "./index.php"; </script>';
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
  <header id="top" class="clearfix" style="    background: rgba(255,255,255,0.6);">
    <!--top-->
    <div class="container">
      <div class="top row">
      <div class="col-md-6 phone-shopping">
        <span>Phone: +32 3 298 58 66</span>
      </div>
      <div class="col-md-18">
        <ul class="text-right">
        <li class="customer-links hidden-xs" style="width:100%;">
          <ul id="accounts" class="list-inline">
            <li class="my-account">
              <a href="./account.php">My Account</a>
            </li> 

            <?php
            if ( isset($_SESSION['loggedIn']) && $_SESSION['loggedIn'] ) {
              if ( isset($_SESSION['loginAs']) ) {
                $ast = '<span class="req">*</span>';
              } else {
                $ast = "";
              }
              echo'
              <li class="login">    
                <span id="loginButton" class="dropdown-toggle" data-toggle="dropdown">
                  <a href="javascript:void(0);">Hi, '. $_USERNAME . $ast . '</a>
                  <i class="sub-dropdown1"></i>
                  <i class="sub-dropdown"></i>
                </span>
                <!-- Customer Account Login -->
                <div id="loginBox" class="dropdown-menu text-left" style="padding:0;">
                  <div id="bodyBox" style="text-align:right">
                    <ul class="control-container customer-accounts list-unstyled" style="padding:0;">           
                      <a href="./account.php" class="dropdown-item">Favorites<span id="favorite_num_badge" style="padding: 2px 6px; background: #F9A825; border-radius: 100px; margin: 0px 0px 0px 5px; font-size: 12px; color: white; font-weight: bold;">'. intval(count(explode(",", $favorites)) - 1) .'</span></a>
                      <a href="./account.php?show=settings" class="dropdown-item">Settings</a>              
                      <form method="post">
                      <button href="#" class="btn-logout" name="action[logout]" value="true">Logout</button>
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
                  <a href="./login.php">Login</a>
                  <i class="sub-dropdown1"></i>
                  <i class="sub-dropdown"></i>
                </span>
                <!-- Customer Account Login -->
                <div id="loginBox" class="dropdown-menu text-left">
                <form method="post" action="login.php" id="customer_login" accept-charset="UTF-8"><input type="hidden" value="customer_login" name="form_type"><input type="hidden" name="utf8" value="✓">
                  <div id="bodyBox">
                    <ul class="control-container customer-accounts list-unstyled">
                      <li class="clearfix">
                        <label for="customer_email_box" class="control-label">Username <span class="req">*</span></label>
                        <input type="text" value="" name="login[username]" id="customer_email_box" class="form-control" required>
                      </li>            
                      <li class="clearfix">
                        <label for="customer_password_box" class="control-label">Password <span class="req">*</span></label>
                        <input type="password" value="" name="login[password]" id="customer_password_box" class="form-control password" required>
                      </li>             
                      <li class="clearfix">
                        <button class="action btn btn-1" type="submit">Login</button>
                      </li>
                      <!-- <li class="clearfix">
                        <a class="action btn btn-1" href="./register.php">Create an account</a>
                      </li> -->
                    </ul>
                  </div>
                </form>
                </div>    
              </li>
              <li>/</li>   
              <li class="register">
                <a href="./register.php" id="customer_register_link">Create an account</a>
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
            <a id="site-title" href="./index.php" title="Diamant Secret">          
            <img class="img-responsive" src="./images/gfx/logo.png" alt="Diamant Secret">          
            </a>
          </li>
          <li class="navigation">     
            <nav class="navbar">
              <div class="clearfix">
                <div class="navbar-header">
                  <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                  <span class="sr-only">Toggle main navigation</span>
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
                          <a href="./account.php">Account</a> 
                          </li>
                          <li class="account last">
                          <form method="post">
                          <button href="#" class="btn-logout" name="action[logout]" value="true" style="padding: 0px; text-align: left;">Logout</button>
                          </form>
                          </li>';
                      } else {
                        echo '
                          <li class="logout">
                          <a href="login.php">Login</a>
                          </li>
                          <li class="account last">
                          <a href="register.php">Register</a>
                          </li>';
                      }
                      ?>
                      </ul>
                    </div>
                    </li>
                    <li class="is-mobile-wl">
                    <a href="./account.php"><i class="fa fa-heart"></i></a>
                    </li>
                    <li class="is-mobile-cart">
                    <a href="./cart.php"><i class="fa fa-shopping-cart"></i></a>
                    </li>
                  </ul>
                </div>
                <div class="collapse navbar-collapse">
                  <ul class="nav navbar-nav hoverMenuWrapper">
                    <li class="nav-item active">
                    <a href="./index.php">
                    <span>Home</span>
                    </a>
                    </li>
                    <li class="dropdown mega-menu">
                    <a href="./collection.php" class="dropdown-toggle dropdown-link" data-toggle="dropdown">
                    <span>Collections</span>
                    <i class="fa fa-caret-down"></i>
                    <i class="sub-dropdown1 visible-sm visible-md visible-lg"></i>
                    <i class="sub-dropdown visible-sm visible-md visible-lg"></i>
                    </a>
                    <div class="megamenu-container megamenu-container-1 dropdown-menu banner-bottom mega-col-4" style="">
                      <ul class="sub-mega-menu">
                        <div class="collection-link-list">
                          <ul>
                            <li><a class="collection-link-title" href="./collection_rings.php">Rings</a></li>
                            <li><a class="collection-link" href="./collection_rings.php?ring_category=1">Diamond</a></li>
                            <li><a class="collection-link" href="./collection_rings.php?ring_category=2">Half Eternity Diamond</a></li>
                            <li><a class="collection-link" href="./collection_rings.php?ring_category=3">Full Eternity Diamond</a></li>
                            <li><a class="collection-link" href="./collection_rings.php?ring_category=4">Solitaire Diamond</a></li>
                            <li><a class="collection-link" href="./collection_rings.php?ring_category=5">Gems</a></li>
                            <li><a class="collection-link" href="./collection_rings.php?ring_category=6">Pearls</a></li>
                          </ul>
                        </div>
                        <div class="collection-link-list">
                          <ul>
                            <li><a class="collection-link-title" href="./collection_earrings.php">Earrings</a></li>
                            <li><a class="collection-link" href="./collection_earrings.php?material=1">Yellow Gold</a></li>
                            <li><a class="collection-link" href="./collection_earrings.php?material=2">White Gold</a></li>
                            <li><a class="collection-link" href="./collection_earrings.php?material=3">Pink Gold</a></li>
                            <li><a class="collection-link" href="./collection_earrings.php?material=4">Silver</a></li>
                            <li><a class="collection-link" href="./collection_earrings.php?material=5">Platinum</a></li>
                          </ul>
                        </div>
                        <div class="collection-link-list">
                          <ul>
                            <li><a class="collection-link-title" href="./collection_pendants.php">Pendants</a></li>
                            <li><a class="collection-link" href="./collection_pendants.php?material=1">Yellow Gold</a></li>
                            <li><a class="collection-link" href="./collection_pendants.php?material=2">White Gold</a></li>
                            <li><a class="collection-link" href="./collection_pendants.php?material=3">Pink Gold</a></li>
                            <li><a class="collection-link" href="./collection_pendants.php?material=4">Silver</a></li>
                            <li><a class="collection-link" href="./collection_pendants.php?material=5">Platinum</a></li>
                          </ul>
                        </div>
                        <div class="collection-link-list">
                          <ul>
                            <li><a class="collection-link-title" href="./collection_necklaces.php">Necklaces</a></li>
                            <li><a class="collection-link" href="./collection_necklaces.php?material=1">Yellow Gold</a></li>
                            <li><a class="collection-link" href="./collection_necklaces.php?material=2">White Gold</a></li>
                            <li><a class="collection-link" href="./collection_necklaces.php?material=3">Pink Gold</a></li>
                            <li><a class="collection-link" href="./collection_necklaces.php?material=4">Silver</a></li>
                            <li><a class="collection-link" href="./collection_necklaces.php?material=5">Platinum</a></li>
                          </ul>
                        </div>
                        <div class="collection-link-list">
                          <ul>
                            <li><a class="collection-link-title" href="./collection_bracelets.php">Bracelets</a></li>
                            <li><a class="collection-link" href="./collection_bracelets.php?material=1">Yellow Gold</a></li>
                            <li><a class="collection-link" href="./collection_bracelets.php?material=2">White Gold</a></li>
                            <li><a class="collection-link" href="./collection_bracelets.php?material=3">Pink Gold</a></li>
                            <li><a class="collection-link" href="./collection_bracelets.php?material=4">Silver</a></li>
                            <li><a class="collection-link" href="./collection_bracelets.php?material=5">Platinum</a></li>
                          </ul>
                        </div>
                      </ul>
                    </div>
                    </li>
                    <li class="nav-item">
                    <a href="./contact.php">
                    <span>Contact</span>
                    </a>
                    </li>
                    </li>
                    <?php 
                      if ( isset($_SESSION['admin']) && $_SESSION['admin'] > 0 ) {
                        echo '
                          <li class="nav-item">
                          <a href="./admin/login.php">
                          <span>Admin</span>
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
          if ( $_SESSION['loggedIn'] ) { //<cart>
            $cartItems = explode(",", $info['cart']);
          ?>    
          <li class="umbrella hidden-xs">
            <div id="umbrella" class="list-inline unmargin">
              <div class="cart-link">
                <a href="./cart.php" class="dropdown-toggle dropdown-link" data-toggle="dropdown">
                  <i class="sub-dropdown1"></i>
                  <i class="sub-dropdown"></i>
                  <div class="num-items-in-cart">
                    <span class="icon">
                      Cart
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
                              if ( $images[0] == "" ) {
                                $images[0] = '0.png';
                              }
                              echo '
                                <div class="items control-container">
                                  <div class="row items-wrapper">
                                    <form method="post" id="removeFromCart_'. $i .'">
                                    <input name="unique_key" value="'. $cartItemInfo['unique_key'] .'" hidden />
                                    <input name="size" value="'. $cartItem[1] .'" hidden />
                                    <input name="quantity" value="'. $cartItem[2] .'" hidden />
                                    <input name="offset" value="'. $i .'" hidden />
                                    </form>
                                    <button class="cart-close" title="Remove" href="javascript:void(0);" style="background:transparent;" form="removeFromCart_'. $i .'" type="submit" name="removeFromCart"><i class="fa fa-times"></i></button>
                                    <div class="col-md-8 cart-left">
                                      <a class="cart-image" href="./product.php?view='. $cartItemInfo['unique_key'] .'"><img src="./images/images_sm/'. $images[0] .'" alt="" title=""></a>
                                    </div>
                                    <div class="col-md-16 cart-right">
                                      <div class="cart-title">
                                        <a href="./product.php?view='. $cartItemInfo['unique_key'] .'">'. $cartItemCategory['item_name'] .'<br><small>Size: '. $cartItem[1] .'</small></a>
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
                                      <button class="cart-close" title="Remove" href="javascript:void(0);" style="background:transparent;" form="removeFromCart_'. $i .'" type="submit" name="removeFromCart"><i class="fa fa-times"></i></button>
                                      <div class="col-md-8 cart-left">
                                        <a class="cart-image"><img src="./images/images_sm/0.png" alt="" title=""></a>
                                      </div>
                                      <div class="col-md-16 cart-right">
                                        <div class="cart-title">
                                          <a>Item Unavailable <i class="fa fa-question-circle" data-toggle="tooltip" data-placement="bottom" title="Item Deleted or Invalid"></i></small></a>
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
                        echo '<span style="display: block; text-align: center; margin: 20px 0px;">Your Cart Is Empty</span>';
                      }
                      echo '
                        <div class="subtotal">
                          <span>Subtotal:</span><span class="cart-total-right"> €'. $subtotal .'</span>
                        </div>';
                    ?>
                    <div class="action">
                      <a class="btn btn-1" href="./cart.php">View Cart</a>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </li> 
          <?php
          } else { // cart if not logged
          ?>    
          <li class="umbrella hidden-xs">
            <div id="umbrella" class="list-inline unmargin">
              <div class="cart-link">
                <a href="./login.php" class="dropdown-toggle dropdown-link" data-toggle="dropdown">
                  <i class="sub-dropdown1"></i>
                  <i class="sub-dropdown"></i>
                  <div class="num-items-in-cart">
                    <span class="icon" style="padding-right: 40px;">
                      Cart
                    </span>
                  </div>
                </a>
                <div id="cart-info" class="dropdown-menu" style="display: none;">
                  <div id="cart-content">
                    <span style="display: block; text-align: center; margin: 20px 0px;">Please Login to Access your Cart</span>
                    <div class="action">
                      <a class="btn btn-1" href="./login.php">Login</a>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </li> 
          <?php
          } //</cart>
          ?>     
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