<?php
if ( session_status() == PHP_SESSION_NONE ) {
    session_start();
}
/* if ( !isset($_SESSION['loggedIn']) || !$_SESSION['loggedIn'] ) {
    header("location: ./login.php");
    exit();
} */
include 'conf/config.php';
include './url/pre.php';
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

#pre
$subtotalMain = 0;
$youSave = 0;


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

} else if ( isset($_POST['checkout']) && $_SESSION['loggedIn'] ) {
    $getCart = $pdo->prepare("SELECT * FROM `accounts` WHERE `username` = :username");
    $getCart->execute(array(":username" => $_USERNAME));

    if ( $getCart->rowCount() > 0 ) {
        $cart = $getCart->fetch(PDO::FETCH_ASSOC);

        if ( !empty($cart['cart']) ) {
            $items = explode(",", $cart['cart']);
            $mailToAdmin = '<h3>'.__("Enquiry By").'</h3>'.__("Name").': '. $_USERNAME .'<br>'.__("Email").': '. $cart['email'] .'<br>'.__("Phone").': '. $cart['mobileno'] .'<hr />';
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
                                    echo __("Unknown");
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
            $mail2->smtpConnect(
                array(
                    "ssl" => array(
                        "verify_peer" => false,
                        "verify_peer_name" => false,
                        "allow_self_signed" => true
                    )
                )
            );
            $mail2->Subject = $testSiteSubject ." ". __("Enquiry Placed by") ." " . $_USERNAME;
            $mail2->Body = $mailToAdmin;
            if ( !$mail2->send() ) {
                $notify = __("An Error Occured: Please Try Again Later");
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
                $mail->smtpConnect(
                    array(
                        "ssl" => array(
                            "verify_peer" => false,
                            "verify_peer_name" => false,
                            "allow_self_signed" => true
                        )
                    )
                );
                $mail->Subject = $testSiteSubject . 'Enquiry Placed';
                $mail->Body = $mailToCustomer;
                if ( !$mail->send() ) {
                    $notify = __("An Error Occured: Please Try Again Later");
                } else {
                    $notify = __("Enquiry Placed");
                    echo '<script> $("#notificationBox").html("'. $notify .'"); $("#notificationBox").fadeToggle(500).delay(2000).fadeToggle(500); </script>';

                    $emptyCart = $pdo->prepare("UPDATE `accounts` SET `cart` = :emptyCart WHERE `username` = :user");
                    $emptyCart->execute(array(":emptyCart" => "", ":user" => $cart['username']));
                }
            }
        }
    }


}

if ( isset($_POST['removeItem']) && $_SESSION['loggedIn'] ) {

    $item = explode("|", trim($_POST['removeItem'], ",") );

    $_POST['unique_key'] = $item[0];
    $_POST['size'] = $item[1];
    $_POST['quantity'] = $item[2];

    $updateCart = $pdo->prepare("DELETE FROM tb_cart WHERE user_id = :uid AND product_id = :pid AND size = :size AND quantity = :quantity");
    $updateCart->execute(array(":uid" => $_SESSION['user_id'], ":pid" => $_POST['unique_key'], ":size" => $_POST['size'], ":quantity" => intval($_POST['quantity'])));


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
                                <a href="./index.php" class="homepage-link" title="<?php echo __("Back to the frontpage"); ?>"><?php echo __("Home"); ?></a>
                                <span>/</span>
                                <span class="page-title"><?php echo __("Cart"); ?></span>
                            </div>
                        </div>
                    </div>
                </div>        
                
                <section class="content">
                    <div class="container">
                        <div class="row">
                            <div id="page-header" class="col-md-24">
                                <ul class="nav nav-pills nav-justified nav-cart">
                                    <li name="1"><?php echo __("Cart"); ?></li>
                                    <li name="2"><?php echo __("Account"); ?><?php echo __("</li>"); ?>
                                    <li name="3"><?php echo __("Address"); ?><?php echo __("</li>"); ?>
                                    <li name="4"><?php echo __("Payment"); ?><?php echo __("</li>"); ?>
                                </ul>
                            </div>
                            <?php 
                            pconsole($_POST);
                            if ( !isset($_POST['CART']['STEP']) ) {
                            ?>
                            <script type="text/javascript">
                                $(".nav.nav-pills.nav-justified.nav-cart > li[name=\"1\"]").addClass("active");
                            </script>
                            <div class="col-sm-24">
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
                                                        <?php echo __("Items"); ?>
                                                    </th>
                                                    <th>
                                                        <?php echo __("Price"); ?>
                                                    </th>
                                                    <th>
                                                        <?php echo __("Discount"); ?>
                                                    </th>
                                                    <th>
                                                        <?php echo __("Qty"); ?>
                                                    </th>
                                                    <th>
                                                        <small><?php echo __("Total"); ?></small> <?php echo __("VAT"); ?> 
                                                    </th>
                                                    <th>
                                                        <?php echo __("Subtotal"); ?>
                                                    </th>
                                                    <th>
                                                        &nbsp;
                                                    </th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                <?php
                                                if ( isset($_SESSION['loggedIn']) && $_SESSION['loggedIn'] ) {
                                                                                            
                                                    $cartItems = array();

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
                                                                    $adjustedQuantity = "<i class='fa fa-info-circle' data-toggle='tooltip' data-placement='bottom' title='".__("Unfortunately, Item Quantity selected is more than our current Stock, adjusted to meet the highest available.")."'></i>";
                                                                } else {
                                                                    $adjustedQuantity = "";
                                                                }
                                                                $sale = "-";
                                                                $price = '<span class="">€'. $result['item_value'] .'</span>';
                                                                $value = $result['item_value'];
                                                                if ( $result['discount'] > 0 ) {
                                                                    
                                                                    $value = $result['item_value'] -  (($result['discount'] / 100 ) * $result['item_value']);
                                                                    $sale = '<span class="label label-success" style="font-size: 18px; font-weight: bold;">'. $result['discount'] .'% '.__("OFF").'</span>';
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
                                                                        <td class="title text-center">
                                                                            <ul class="list-inline">
                                                                                <li class="image">
                                                                                <a href="./product.php?view='. $result['unique_key'] .'">
                                                                                <img src="./images/images_sm/'. $images[0] .'?v='. time() .'" alt="'. $itemInfo['product_name'] .'" style="max-width: 200px;">
                                                                                </a><br />
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
                                                                            '. $price . '
                                                                        </td>
                                                                        <td>'. $sale .'</td>
                                                                        <td>
                                                                            <input class="form-control input-1 replace" maxlength="5" size="5" id="updates_3947646083" name="updates[]" value="'. $itemVal[2] .'" disabled> '. $adjustedQuantity .'
                                                                        </td>
                                                                        <td class="total title-1">
                                                                            <span data-toggle="tooltip" title="'. $vat['vat'] .'%">€'. number_format(($vatValue), 2, ".", "") .'</span>
                                                                        </td>
                                                                        <td class="total title-1">
                                                                            €'. number_format($vatAmount, 2, ".", "") .'
                                                                        </td>
                                                                        <td class="action"><button type="submit" form="removeItemForm" name="removeItem" value="'. $item .'"><i class="fa fa-times"></i>'.__("Remove").'</button>
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
                                                                            <small>'.__("Out of Stock").'</small>
                                                                        </td>
                                                                        <td class="action"><button type="submit" form="removeItemForm" name="removeItem" value="'. $item .'"><i class="fa fa-times"></i>'.__("Remove").'</button>
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
                                                        <?php echo '<span style="font-size:18px; color: grey;"><small style="font-size:12px;">'.__("You save").':</small> <br>€' . number_format($youSave, 2, ".", "") . '</span>'; ?>
                                                    </td>
                                                </tr>
                                                </tfoot>
                                                </table>
                                            </div>
                                        </div>
                                        <div class="clearfix">
                                        <?php
                                        if ( $subtotalMain > 0 ) {
                                            echo'
                                                <div id="checkout-proceed" class="last1 text-right">
                                                    <button class="btn" type="submit" id="checkout" name="CART[STEP]" value="2">'.__("Proceed to Checkout").'</button>
                                                </div>
                                                ';
                                        }
                                        ?>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            <?php 
                            } else {
                                switch ( $_POST['CART']['STEP'] ) {
                                    case 2: {
                                        ?>
                                        <!-- ACCOUNT -->
                                        <script type="text/javascript">
                                            $(".nav.nav-pills.nav-justified.nav-cart > li[name=\"2\"]").addClass("active");
                                        </script>
                                        <?php 
                                        if ( isset($_SESSION['loggedIn']) && $_SESSION['loggedIn'] ) {
                                            ?>
                                            <div class="col-md-24">
                                                <h3 class="text-center" style="background: #ebebeb; padding: 15px;"><small><?php echo __("Currently logged in as"); ?></small><br /> <strong><?php echo $_SESSION['username']; ?></strong><br />

                                                    
                                                </h3>
                                                <a href="./cart.php" class="btn btn-success"><i class="fa fa-caret-left"></i> <?php echo __("Cart"); ?></a>
                                                    <form style="float: right;" method="post"><button class="btn btn-success" name="CART[STEP]" value="3"><?php echo __("Checkout"); ?> <i class="fa fa-caret-right"></i> </button></form>
                                            </div>
                                            <?php
                                        } else {
                                            ?>
                                            <div class="col-md-24">
                                                <h4><?php echo __("Not Logged In"); ?></h4>
                                                <div class="col-md-12">
                                                    <form method="post" action="./login.php" id="customer_login" accept-charset="UTF-8"><input type="hidden" value="customer_login" name="form_type"><input type="hidden" name="utf8" value="✓">
                                                      <input type="hidden" name="redir" value="cart.php" />
                                                      <div id="bodyBox">
                                                        <ul class="control-container customer-accounts list-unstyled">
                                                          <li class="clearfix">
                                                            <label for="customer_email_box" class="control-label"><?php echo __("Username"); ?> <span class="req">*</span></label>
                                                            <input type="text" value="" name="login[username]" id="customer_email_box" class="form-control" required>
                                                          </li>            
                                                          <li class="clearfix">
                                                            <label for="customer_password_box" class="control-label"><?php echo __("Password"); ?> <span class="req">*</span></label>
                                                            <input type="password" value="" name="login[password]" id="customer_password_box" class="form-control password" required>
                                                          </li>             
                                                          <li class="clearfix">
                                                            <button class="action btn btn-1" type="submit"><?php echo __("Login"); ?></button>
                                                          </li>
                                                          <!-- <li class="clearfix">
                                                            <a class="action btn btn-1" href="./register.php">Create an account</a>
                                                          </li> -->
                                                        </ul>
                                                      </div>
                                                    </form>
                                                </div>
                                                <div class="col-md-12 text-center">
                                                    <h4><?php echo __("New User"); ?>?</h4><br/>
                                                    <a class="btn btn-success" href="./register.php"><?php echo __("Sign Up"); ?></a>
                                                </div>
                                            </div>
                                            <?php
                                        }
                                        ?>
                                        <?php
                                        break;
                                    } case 3: {
                                        ?>
                                        <!-- ADDRESS -->
                                        <script type="text/javascript">
                                            $(".nav.nav-pills.nav-justified.nav-cart > li[name=\"3\"]").addClass("active");
                                        </script>

                                        <div class="col-md-24 text-left">
                                            <form method="post">
                                                <div class="col-md-12">
                                                    <h4><?php echo __("Billing Address"); ?></h4>
                                                    <textarea class="form-control" placeholder="<?php echo __('Address Line'); ?>1&#013;&#010;<?php echo __('Address Line'); ?> 2&#013;&#010;<?php echo __('City'); ?>&#013;&#010;<?php echo __('State'); ?>&#013;&#010;<?php echo __('Zip Code'); ?>&#013;&#010;<?php echo __('Country'); ?>" style="min-height: 150px;" name="billing_address" required><?php 
                                                    $billingAddress = $pdo->prepare("SELECT address FROM accounts WHERE id = :id");
                                                    $billingAddress->execute(array(":id" => $_SESSION['user_id']));

                                                    if ( $billingAddress->rowCount() > 0 ) {
                                                        echo $billingAddress->fetch(PDO::FETCH_ASSOC)['address'];
                                                    }
                                                    ?></textarea>
                                                </div>
                                                <div class="col-md-12">
                                                    <h4><?php echo __("Shipping Address"); ?></h4>
                                                    <textarea class="form-control" placeholder="<?php echo __('Address Line'); ?> 1&#013;&#010;<?php echo __('Address Line'); ?> 2&#013;&#010;<?php echo __('City'); ?>&#013;&#010;<?php echo __('State'); ?>&#013;&#010;<?php echo __('Zip Code'); ?>&#013;&#010;<?php echo __('Country'); ?>" style="min-height: 150px;" name="shipping_address" required></textarea>
                                                </div>
                                                <button name="CART[STEP]" value="2" class="btn btn-success" style="float: left; margin: 10px 15px;"><i class="fa fa-caret-left"></i> <?php echo __("Back"); ?></button>
                                                <button name="CART[STEP]" value="4" class="btn btn-success" style="float: right; margin: 10px 15px;"><?php echo __("Checkout"); ?> <i class="fa fa-caret-right"></i></button>
                                            </form>
                                        </div>

                                        <?php
                                        break;
                                    } case 4: {
                                        ?>
                                        <!-- PAYMENT -->
                                        <script type="text/javascript">
                                            $(".nav.nav-pills.nav-justified.nav-cart > li[name=\"4\"]").addClass("active");
                                        </script>

                                        <h4 class="text-center"><?php echo __("You would now be redirected to the payment portal"); ?></h4>
                                        <?php
                                        echo '<form method="post" action="url/post.php" class="text-center">';
                                        if ( isset($_POST['billing_address']) && isset($_POST['shipping_address']) ) {
                                            echo '<input type="hidden" name="Paypal[BillingAddress]" value="'. $_POST['billing_address'] .'" />';
                                            echo '<input type="hidden" name="Paypal[ShippingAddress]" value="'. $_POST['shipping_address'] .'" />';
                                            echo '<button class="btn btn-info" type="submit" name="Paypal[Checkout]">'.__("Checkout").'</button>';
                                        }
                                        echo '</form>';
                                        break;
                                    }
                                }
                            }
                            ?>
                        </div>
                    </div>
                </section>        
            </div>
        </div>
    </div>

    <?php include './url/footer.php'; ?>
  </body>