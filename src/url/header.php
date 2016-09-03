<?php
if ( session_status() == PHP_SESSION_NONE ) {
  session_start();
}

if ( !isset($_SESSION['loggedIn']) ) {
  $_SESSION['loggedIn'] = false;
}
if ( isset($_POST['action']['logout']) ) {
  session_unset();
  session_destroy();

  header("Location: index.php");
}

$favorites = "";
if ( isset($_SESSION['loggedIn']) && $_SESSION['loggedIn'] ) {
  $getUserInfo = $pdo->prepare("SELECT * FROM `accounts` WHERE `username` = :user");
  $getUserInfo->execute(array(":user" => $_SESSION['username']));

  $info = $getUserInfo->fetch(PDO::FETCH_ASSOC);

  $favorites = $info['favorites'];
}
?>

  <header id="top" class="clearfix">
    <!--top-->
    <div class="container">
      <div class="top row">
      <div class="col-md-6 phone-shopping">
        <span>PHONE SHOPING (01) 123 456 UJ</span>
      </div>
      <div class="col-md-18">
        <ul class="text-right">
        <li class="customer-links hidden-xs">
          <ul id="accounts" class="list-inline">
            <li class="my-account">
              <a href="./account.html">My Account</a>
            </li> 

            <?php
            if ( isset($_SESSION['loggedIn']) && $_SESSION['loggedIn'] ) {
              echo'
              <li class="login">    
                <span id="loginButton" class="dropdown-toggle" data-toggle="dropdown">
                  <a href="javascript:void(0);">Hi, '. $_SESSION['username'] .'</a>
                  <i class="sub-dropdown1"></i>
                  <i class="sub-dropdown"></i>
                </span>
                <!-- Customer Account Login -->
                <div id="loginBox" class="dropdown-menu text-left" style="padding:0;">
                  <div id="bodyBox" style="text-align:right">
                    <ul class="control-container customer-accounts list-unstyled" style="padding:0;">
                      <a href="#" class="dropdown-item">Account</a>            
                      <a href="#" class="dropdown-item">Favorites<span id="favorite_num_badge" style="padding: 2px 6px; background: #F9A825; border-radius: 100px; margin: 0px 0px 0px 5px; font-size: 12px; color: white; font-weight: bold;">'. intval(count(explode(",", $favorites)) - 1) .'</span></a>
                      <a href="#" class="dropdown-item">Settings</a>              
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
                  <a href="./login.html">Login</a>
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
                        <a class="action btn btn-1" href="./register.html">Create an account</a>
                      </li> -->
                    </ul>
                  </div>
                </form>
                </div>    
              </li>
              <li>/</li>   
              <li class="register">
                <a href="./register.html" id="customer_register_link">Create an account</a>
              </li> ';
            }
            ?>
          </ul>
        </li>      
        <li id="widget-social">
          <ul class="list-inline">            
          <li><a target="_blank" href="#" class="btooltip swing" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Facebook"><i class="fa fa-facebook"></i></a></li>
          <li><a target="_blank" href="#" class="btooltip swing" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Twitter"><i class="fa fa-twitter"></i></a></li>                        
          <li><a target="_blank" href="#" class="btooltip swing" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Pinterest"><i class="fa fa-pinterest"></i></a></li>           
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
            <a id="site-title" href="./index.php" title="Jewelry - HTML Template theme">          
            <img class="img-responsive" src="assets/images/logo.png" alt="Jewelry - HTML Template theme">          
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
                        <li class="logout">
                        <a href="#">Login</a>
                        </li>
                        <li class="account last">
                        <a href="register.html">Register</a>
                        </li>
                      </ul>
                    </div>
                    </li>
                    <li class="is-mobile-wl">
                    <a href="#"><i class="fa fa-heart"></i></a>
                    </li>
                    <li class="is-mobile-cart">
                    <a href="#"><i class="fa fa-shopping-cart"></i></a>
                    </li>
                  </ul>
                </div>
                <div class="collapse navbar-collapse">
                  <ul class="nav navbar-nav hoverMenuWrapper">
                    <li class="nav-item active">
                    <a href="#">
                    <span>Home</span>
                    </a>
                    </li>
                    <li class="dropdown mega-menu">
                    <a href="./collection.html" class="dropdown-toggle dropdown-link" data-toggle="dropdown">
                    <span>Collections</span>
                    <i class="fa fa-caret-down"></i>
                    <i class="sub-dropdown1 visible-sm visible-md visible-lg"></i>
                    <i class="sub-dropdown visible-sm visible-md visible-lg"></i>
                    </a>
                    <div class="megamenu-container megamenu-container-1 dropdown-menu banner-bottom mega-col-4" style="">
                      <ul class="sub-mega-menu">
                        <li>
                        <ul>
                          <li class="list-title">Collection Links</li>
                          <li class="list-unstyled li-sub-mega">
                          <a href="#">Dolorem Sed </a>
                          </li>
                          <li class="list-unstyled li-sub-mega">
                          <a href="#">Proident Nulla </a>
                          </li>
                          <li class="list-unstyled li-sub-mega">
                          <a href="#">Phasellus Leo <span class="megamenu-label hot-label">Hot</span>
                          </a>
                          </li>
                          <li class="list-unstyled li-sub-mega">
                          <a href="#">Tristique Amet <span class="megamenu-label feature-label">Featured</span>
                          </a>
                          </li>
                        </ul>
                        </li>
                        <li>
                        <ul>
                          <li class="list-title">Collection Links</li>
                          <li class="list-unstyled li-sub-mega">
                          <a href="#">Dolorem Sed </a>
                          </li>
                          <li class="list-unstyled li-sub-mega">
                          <a href="#">Proident Nulla <span class="megamenu-label new-label">New</span>
                          </a>
                          </li>
                          <li class="list-unstyled li-sub-mega">
                          <a href="#">Phasellus Leo </a>
                          </li>
                          <li class="list-unstyled li-sub-mega">
                          <a href="#">Tristique Amet </a>
                          </li>
                        </ul>
                        </li>
                        <li>
                        <ul>
                          <li class="list-title">Collection Links</li>
                          <li class="list-unstyled li-sub-mega">
                          <a href="#">Dolorem Sed </a>
                          </li>
                          <li class="list-unstyled li-sub-mega">
                          <a href="#">Proident Nulla </a>
                          </li>
                          <li class="list-unstyled li-sub-mega">
                          <a href="#">Phasellus Leo <span class="megamenu-label sale-label">Sale</span>
                          </a>
                          </li>
                          <li class="list-unstyled li-sub-mega">
                          <a href="#">Tristique Amet </a>
                          </li>
                        </ul>
                        </li>
                        <li>
                        <ul>
                          <li class="list-title">Collection Links</li>
                          <li class="list-unstyled li-sub-mega">
                          <a href="#">Dolorem Sed <span class="megamenu-label new-label">New</span>
                          </a>
                          </li>
                          <li class="list-unstyled li-sub-mega">
                          <a href="#">Proident Nulla </a>
                          </li>
                          <li class="list-unstyled li-sub-mega">
                          <a href="./product.html">Phasellus Leo </a>
                          </li>
                          <li class="list-unstyled li-sub-mega last">
                          <a href="./product.html">Tristique Amet <span class="megamenu-label hot-label">Hot</span>
                          </a>
                          </li>
                        </ul>
                        </li>
                      </ul>
                    </div>
                    </li>
                    <li class="nav-item">
                    <a href="./contact.html">
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
                <div id="cart-info" class="dropdown-menu" style="display: none;">
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
                                      <a class="cart-image" href="./product.html"><img src="./images/thumbnails/'. $images[0] .'" alt="" title=""></a>
                                    </div>
                                    <div class="col-md-16 cart-right">
                                      <div class="cart-title">
                                        <a href="./product.html">'. $cartItemCategory['item_name'] .'<br><small>Size: '. $cartItem[1] .'</small></a>
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
                                      </form>
                                      <button class="cart-close" title="Remove" href="javascript:void(0);" style="background:transparent;" form="removeFromCart_'. $i .'" type="submit" name="removeFromCart"><i class="fa fa-times"></i></button>
                                      <div class="col-md-8 cart-left">
                                        <a class="cart-image" href="./product.html"><img src="./images/thumbnails/0.png" alt="" title=""></a>
                                      </div>
                                      <div class="col-md-16 cart-right">
                                        <div class="cart-title">
                                          <a href="./product.html">Item Unavailable</small></a>
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
                    <span class="icon">
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