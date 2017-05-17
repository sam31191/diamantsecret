<?php 
if ( isset($_POST['addToCart']) && !$_SESSION['loggedIn'] ) {
  $cartElement = $_POST['unique_key'] . '|' . $_POST['size'] . '|';

  if ( isset($_COOKIE[COOKIE_CART]) ) {
    $currentCart = $_COOKIE[COOKIE_CART];
  } else {
    $currentCart = "";
  }
  
  if ( strstr($currentCart, $cartElement) ) { //Cart alrady has this item + size
    $cartArray = explode(",", $currentCart);

    $currentCart = "";
    foreach ( $cartArray as $cartItem ) {
      if ( $cartItem !== "" ) {
        if ( strstr($cartItem, $cartElement) ) { // Match Found
          $currentQuantity = str_replace($cartElement, "", $cartItem);
          $newQ = $currentQuantity + $_POST['quantity'];

          $cartItem = $_POST['unique_key'] . '|' . $_POST['size'] . '|' . $newQ;
        }
        $currentCart .= $cartItem . ",";
      }
    }
  } else { //Cart doesn't have this, adding new
    $currentCart .= $cartElement . $_POST['quantity'] . ",";
  }

  setcookie(COOKIE_CART, $currentCart, time() + (86400 * 30), "/");

  header("Location: ". $_SERVER['HTTP_REFERER']);
} else if ( isset($_POST['removeFromCart']) && !$_SESSION['loggedIn'] ) {
	$cart = "";
	if ( isset($_COOKIE[COOKIE_CART]) ) {
		$cart = $_COOKIE[COOKIE_CART];
	}
		
	$cart = str_replace($_POST['unique_key'] . '|' . $_POST['size'] . '|' . $_POST['quantity'] . ',', "", $cart);
	
	
  	setcookie(COOKIE_CART, $cart, time() + (86400 * 30), "/");

  	header("Location: ". $_SERVER['HTTP_REFERER']);
}
?>