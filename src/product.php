<?php
ob_start();
session_start();
if ( session_status() == PHP_SESSION_NONE ) {
    
    session_start();
}
if ( !isset($_GET['view']) || empty($_GET['view']) ) {
    header("Location: ./collection.php");
    exit();
}
include 'conf/config.php';
include './url/pre.php';

$_GET['view'];
$getItem = $pdo->prepare("SELECT * FROM `items` WHERE `unique_key` = :unique_key AND site_0 = 1 AND disabled = 0");

$getItem->execute(array(":unique_key" => $_GET['view']));

if ( $getItem->rowCount() > 0 ) {
    $item = $getItem->fetch(PDO::FETCH_ASSOC);

    $getCategory = $pdo->prepare("SELECT * FROM `categories` WHERE `id` = :id");
    $getCategory->execute(array(":id" => $item['category']));
    $category = $getCategory->fetch(PDO::FETCH_ASSOC);
    
    $category = $category['category'];
  
    $table = '`'. $category .'`';

    $itemInfo = $pdo->prepare("SELECT * FROM ". $table ." WHERE `unique_key` = :unique_key");
    $itemInfo->execute(array(":unique_key" => $_GET['view']));

    $itemInfo = $itemInfo->fetch(PDO::FETCH_ASSOC);

    $images = explode(",", $itemInfo['images']);
} else {   
    $itemInfo['description'] = "";   
}

$urlSubcategory = '';
if ( isset($_GET['_sc']) && (int)$ringTag>0) {
    $urlSubcategory = $ringTag;
} else if ( isset($_GET['_sc']) && !empty($_GET['_sc'])) {
    $urlSubcategory = $_GET['_sc'];
} else {
    $urlSubcategory = $itemInfo['ring_subcategory'];
}

$img_alt =  makeProductDetailPageUrl($urlSubcategory,$itemInfo['total_carat_weight'],$itemInfo['gold_quality'],$itemInfo['material'],$itemInfo['product_name'],$itemInfo['unique_key'],$alt_tag=1);


//echo $new_rul =  makeProductDetailPageUrl($urlSubcategory,$itemInfo['total_carat_weight'],$itemInfo['gold_quality'],$itemInfo['material'],$itemInfo['product_name'],$itemInfo['unique_key']);


if ( !is_file( './images/images_md/'. $images[0] ) ) {
    $images[0] = "0.png";
}
?>
<!doctype html>
<!--[if IE 8 ]>    <html lang="en" class="no-js ie8"> <![endif]-->
<!--[if (gt IE 9)|!(IE)]><!--> <html lang="en" class="no-js"> <!--<![endif]-->
<head>
  <?php include_once("analyticstracking.php") ?>
  <meta charset="UTF-8">
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1" />
  <link rel="canonical" href="/" />
  <meta name="description" content="<?php echo $itemInfo['description']; ?>" /> 
  <title></title>
  <?php require 'metaTags.php'; ?>
  <link href="<?php echo $__MAINDOMAIN__;?>assets/stylesheets/font.css" rel='stylesheet' type='text/css'>
  
    <link href="<?php echo $__MAINDOMAIN__;?>assets/stylesheets/font-awesome.min.css" rel="stylesheet" type="text/css" media="all"> 
    <link href="<?php echo $__MAINDOMAIN__;?>assets/stylesheets/jquery.camera.css" rel="stylesheet" type="text/css" media="all">
    <link href="<?php echo $__MAINDOMAIN__;?>assets/stylesheets/jquery.fancybox-buttons.css" rel="stylesheet" type="text/css" media="all">
    <link href="<?php echo $__MAINDOMAIN__;?>assets/stylesheets/cs.animate.css" rel="stylesheet" type="text/css" media="all">
    <link href="<?php echo $__MAINDOMAIN__;?>assets/stylesheets/application.css" rel="stylesheet" type="text/css" media="all">
    <link href="<?php echo $__MAINDOMAIN__;?>assets/stylesheets/swatch.css" rel="stylesheet" type="text/css" media="all">
    <link href="<?php echo $__MAINDOMAIN__;?>assets/stylesheets/jquery.owl.carousel.css" rel="stylesheet" type="text/css" media="all">
    <link href="<?php echo $__MAINDOMAIN__;?>assets/stylesheets/jquery.bxslider.css" rel="stylesheet" type="text/css" media="all">
    <link href="<?php echo $__MAINDOMAIN__;?>assets/stylesheets/bootstrap.min.3x.css" rel="stylesheet" type="text/css" media="all">
    <link href="<?php echo $__MAINDOMAIN__;?>assets/stylesheets/cs.bootstrap.3x.css" rel="stylesheet" type="text/css" media="all">
    <link href="<?php echo $__MAINDOMAIN__;?>assets/stylesheets/cs.global.css" rel="stylesheet" type="text/css" media="all">
    <link href="<?php echo $__MAINDOMAIN__;?>assets/stylesheets/cs.style.css" rel="stylesheet" type="text/css" media="all">
    <link href="<?php echo $__MAINDOMAIN__;?>assets/stylesheets/cs.media.3x.css" rel="stylesheet" type="text/css" media="all">
    <link href="<?php echo $__MAINDOMAIN__;?>assets/stylesheets/spr.css" rel="stylesheet" type="text/css" media="all">
    <link href="<?php echo $__MAINDOMAIN__;?>assets/stylesheets/addthis.css" rel="stylesheet" type="text/css" media="all">
    <link href="<?php echo $__MAINDOMAIN__;?>assets/stylesheets/site.css" rel="stylesheet" type="text/css" media="all">
   <link rel="icon" href="<?php echo $__MAINDOMAIN__;?>images/gfx/favicon.png?v=1" type="image/png" sizes="16x16">
    
    <script src="<?php echo $__MAINDOMAIN__;?>assets/javascripts/jquery-1.9.1.min.js" type="text/javascript"></script>
    <script src="<?php echo $__MAINDOMAIN__;?>assets/javascripts/jquery.imagesloaded.min.js" type="text/javascript"></script>
    <script src="<?php echo $__MAINDOMAIN__;?>assets/javascripts/bootstrap.min.3x.js" type="text/javascript"></script>
    <script src="<?php echo $__MAINDOMAIN__;?>assets/javascripts/jquery.easing.1.3.js" type="text/javascript"></script>
    <script src="<?php echo $__MAINDOMAIN__;?>assets/javascripts/jquery.camera.min.js" type="text/javascript"></script>
    <script src="<?php echo $__MAINDOMAIN__;?>assets/javascripts/jquery.mobile.customized.min.js" type="text/javascript"></script>
    <script src="<?php echo $__MAINDOMAIN__;?>assets/javascripts/cookies.js" type="text/javascript"></script>
    <script src="<?php echo $__MAINDOMAIN__;?>assets/javascripts/modernizr.js" type="text/javascript"></script>  
    <script src="<?php echo $__MAINDOMAIN__;?>assets/javascripts/application.js" type="text/javascript"></script>
    <script src="<?php echo $__MAINDOMAIN__;?>assets/javascripts/jquery.owl.carousel.min.js" type="text/javascript"></script>
    <script src="<?php echo $__MAINDOMAIN__;?>assets/javascripts/jquery.bxslider.js" type="text/javascript"></script>
    <script src="<?php echo $__MAINDOMAIN__;?>assets/javascripts/skrollr.min.js" type="text/javascript"></script>
    <script src="<?php echo $__MAINDOMAIN__;?>assets/javascripts/jquery.fancybox-buttons.js" type="text/javascript"></script>
    <script src="<?php echo $__MAINDOMAIN__;?>assets/javascripts/jquery.zoom.js" type="text/javascript"></script>  
    <script src="<?php echo $__MAINDOMAIN__;?>assets/javascripts/cs.script.js" type="text/javascript"></script>
    <script src="<?php echo $__MAINDOMAIN__;?>js/jquery.elevateZoom-3.0.8.min.js" type="text/javascript"></script>

    <style type="text/css">
    .header {
        width: 200px !important;
    }
    .swatch {
        border-bottom: solid thin #eaeaea;
    }
    </style>
</head>

<?php
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

}

//pconsole($_POST);
?>

<body onload="setPageTitle();" style="height: 2671px;" itemscope="" itemtype="http://schema.org/WebPage" class="templateProduct notouch">
  
  <input type="hidden" id="changeURL" value="<?php echo makeProductDetailPageUrl($urlSubcategory,$itemInfo['total_carat_weight'],$itemInfo['gold_quality'],$itemInfo['material'],$itemInfo['product_name'],$itemInfo['unique_key']); ?>">
    <!-- Header -->
    <!-- Header -->
    <?php include './url/header.php'; ?>
  
    <div id="content-wrapper-parent">
        <div id="content-wrapper">  
            <!-- Content -->
            <div id="content" class="clearfix">        
                <div id="breadcrumb" class="breadcrumb">
                    <div itemprop="breadcrumb" class="container">
                        <div class="row">
                            <div class="col-md-24">
                                <a href="<?php echo $__MAINDOMAIN__.''.$lang.'/'; ?>" class="homepage-link" title="<?php echo __("Back to the frontpage"); ?>"><?php echo ucfirst(__("home")); ?></a>
                                <span>/</span>
                                <a href="<?php echo $__MAINDOMAIN__.''.$lang.'/'.strtolower(__('Collection')); ?>" title="">Collection</a>
                                <span>/</span>
                                <?php
                                    $_GET['view'];
                                    $getItem = $pdo->prepare("SELECT * FROM `items` WHERE `unique_key` = :unique_key AND site_0 = 1 AND disabled = 0");

                                    $getItem->execute(array(":unique_key" => $_GET['view']));

                                    if ( $getItem->rowCount() > 0 ) {
                                        $item = $getItem->fetch(PDO::FETCH_ASSOC);

                                        $getCategory = $pdo->prepare("SELECT * FROM `categories` WHERE `id` = :id");
                                        $getCategory->execute(array(":id" => $item['category']));
                                        $category = $getCategory->fetch(PDO::FETCH_ASSOC);
                                        
                                        $category = $category['category'];
                                      
                                        $table = '`'. $category .'`';
                                    
                                        $itemInfo = $pdo->prepare("SELECT * FROM ". $table ." WHERE `unique_key` = :unique_key");
                                        $itemInfo->execute(array(":unique_key" => $_GET['view']));

                                        $itemInfo = $itemInfo->fetch(PDO::FETCH_ASSOC);
                                       
                                        $images = explode(",", $itemInfo['images']);

                                        $sale = "";
                                        $price = '<span class="price">€'. $item['item_value'] .'</span>';
                                        if ( $item['discount'] > 0 ) {
                                            
                                            $value = $item['item_value'] -  (($item['discount'] / 100 ) * $item['item_value']);
                                            $sale = '<span class="sale_banner"><span class="sale_text">'.__("Sale").'</span></span>';
                                            $price = '<span class="price_sale">€'. number_format($value, 2, ".", "") .'</span>
                                                         <span class="dash">/</span> <del class="price_compare">€'. $item['item_value'] .'</del>';
                                        }

                                        if ( strstr($favorites, $item['unique_key']) ) {
                                            $wishlist = '<a class="wish-list" href="javascript:void(0);" id="fav_'. $item['unique_key'] .'" onClick="removeFromWishlist(\''. $item['unique_key'] .'\')"><i class="fa fa-heart fav-true"></i><span class="list-mode" style="text-transform:uppercase; font-weight: bold;">'.__("Remove from Wishlist").'</span></a>';
                                        } else {
                                            $wishlist = '<a class="wish-list" href="javascript:void(0);" id="fav_'. $item['unique_key'] .'" onClick="addToWishlist(\''. $item['unique_key'] .'\')"><i class="fa fa-heart"></i><span class="list-mode" style="text-transform:uppercase; font-weight: bold;">'.__("Add to Wishlist").'</span></a>';
                                        }
                                        
                                        //pconsole($itemInfo);

                                    echo '<a href="'.$__MAINDOMAIN__.$lang.'/'.$category.'" style="text-transform:capitalize;">'.__("$category").'</a>';
                                        echo '<span>/</span>';
                                        echo '<span>'. $item['item_name'] .'</span>';
                                    } else {
                                        $itemInfo['product_name'] = __("Invalid Item");
                                        $images = array("0.png");
                                        $itemInfo['description'] = "";
                                        $itemInfo['material'] = "";
                                        $itemInfo['color'] = "";
                                        $color = "";
                                        $category = "";
                                        $itemInfo['clarity'] = "";
                                        $item['unique_key'] = "";
                                        $item['category'] = "";
                                        $itemInfo['length'] = "";
                                        $itemInfo['width'] = "";
                                        $itemInfo['height'] = "";
                                        $itemInfo['no_of_stones'] = "";
                                        $itemInfo['total_carat_weight'] = "";
                                        $itemInfo['diamond_shape'] = "";
                                        $itemInfo['gold_quality'] = "";
                                        $itemInfo['color_stone_type'] = "";
                                        $itemInfo['color_stone_shape'] = "";
                                        $itemInfo['no_of_color_stones'] = "";
                                        $itemInfo['color_stone_carat'] = "";
                                        $price = "";
                                        $itemInfo['pieces_in_stock'] = "";
                                        $wishlist = "";
                                        $itemInfo['lab_grown'] = "";
                                    }
                                ?>
                            </div>
                        </div>
                    </div>
                </div>         
                <section class="content">
                    <div class="container">
                        <div class="row">              
                            <div id="col-main" class="product-page col-xs-24 col-sm-24 ">
                                <div itemscope itemtype="http://schema.org/JewelryStore">
                                    <meta itemprop="url" content="<?php echo $_SERVER['HTTP_HOST'].''.$_SERVER['REQUEST_URI']; ?>">
                                    <div id="product" class="content clearfix">      
                                        <h1 id="page-title" class="text-center">
                                            <span itemprop="name"><?php echo $itemInfo['product_name']; ?></span>
                                        </h1>
                                        <?php $urlSubcategory = '';
                                                        if ( isset($_GET['_sc']) && (int)$ringTag>0) {
                                                            $urlSubcategory = $ringTag;
                                                        } else if ( isset($_GET['_sc']) && !empty($_GET['_sc'])) {
                                                            $urlSubcategory = $_GET['_sc'];
                                                         } else {
                                                            $urlSubcategory = $itemInfo['ring_subcategory'];
                                                         }
                                            $total_carat_weight =  $itemInfo['total_carat_weight'];
                                            $gold_quality =  $itemInfo['gold_quality'];
                                            $material =  $itemInfo['material'];
                                            $product_name =  $itemInfo['product_name'];
                                            $unique_key =  $itemInfo['unique_key'];


                                         ?>                                    
                                        <div id="product-image" class="product-image row ">  
                                            <div id="detail-left-column" class="hidden-xs left-coloum col-sm-6 col-sm-6 fadeInRight not-animated" data-animate="fadeInRight">
                                                <div id="gallery_main" class="product-image-thumb thumbs full_width ">
                                                    <ul class="slide-product-image">
                                                        <?php
                                                        $urlSubcategory = '';
                                                        $S_no = 0;
                                                        if ( isset($_GET['_sc']) && (int)$ringTag>0) {
                                                            $urlSubcategory = $ringTag;
                                                        } else if ( isset($_GET['_sc']) && !empty($_GET['_sc'])) {
                                                            $urlSubcategory = $_GET['_sc'];
                                                         } else {
                                                            $urlSubcategory = $itemInfo['ring_subcategory'];
                                                         }
                                                        $img_alt =  makeProductDetailPageUrl($urlSubcategory,$itemInfo['total_carat_weight'],$itemInfo['gold_quality'],$itemInfo['material'],$itemInfo['product_name'],$itemInfo['unique_key'],$alt_tag=1);

                                                        
                                                        $imageIndex = 0;
                                                        foreach ( $images as $image ) {
                                                            $S_no++;
                                                            if ( !empty($image) ) {
                                                                echo '                                                  
                                                                <li class="image">
                                                                    <a href="'. $__MAINDOMAIN__.'images/images_md/'. $image .'" class="cloud-zoom-gallery active">
                                                                        <img src="'. $__MAINDOMAIN__.'images/images_sm/'. $image .'" onClick="selectImage(\'./images/images/'. $image .'\')" alt="'.ucfirst($img_alt).' '.$S_no.'">
                                                                    </a>
                                                                </li>   
                                                                ';
                                                                $imageIndex++;
                                                            }
                                                        }
                                                        
                                                        if(!empty($product_images)){
                                                            foreach ($product_images as $image) {			if ( !empty($image) ) {
                                                                echo '                                                  
                                                                <li class="image">
                                                                    <a href="'. $__MAINDOMAIN__.'images/images_md/'. $image .'" class="cloud-zoom-gallery active">
                                                                        <img src="'. $__MAINDOMAIN__.'images/images_sm/'. $image .'" onClick="selectImage(\'./images/images/'. $image .'\')" alt="">
                                                                    </a>
                                                                </li>   
                                                                ';
                                                                $imageIndex++;
                                                            }
                                                         }  
                                                        }
                                                        
                                                        ?>
                                                    </ul>
                                                </div>
                                            </div>      
                                            <div class="image featured col-smd-12 col-sm-12 fadeInUp not-animated" data-animate="fadeInUp" style="max-height:570px; display: inline-block; text-align: center;" >
                                                <?php 

                                                if ( !is_file( './images/images_md/'. $images[0] ) ) {
                                                    $images[0] = "0.png";
                                                }
                                                echo '<img src="'. $__MAINDOMAIN__.'images/images_md/'. $images[0] .'" id="bigImg" alt="'.addslashes(ucfirst($img_alt)).'" data-zoom-image="'. $__MAINDOMAIN__.'images/images/'. $images[0] .'"  data-imageIndex="0" id="mainImage">' ?>
                                            </div>
                                            <div id="gallery_main_mobile" class="visible-xs product-image-thumb thumbs mobile_full_width ">
                                                <ul style="opacity: 0; display: block;" class="slide-product-image owl-carousel owl-theme">
                                                    <?php 
                                                    foreach ( $images as $image ) {
                                                            if ( !empty($image) ) {
                                                                echo '                                                  
                                                                <li class="image">
                                                                    <a href="'. $__MAINDOMAIN__.'images/images_md/'. $image .'" class="cloud-zoom-gallery">
                                                                        <img src="'. $__MAINDOMAIN__.'images/images_sm/'. $image .'" alt="'.$img_alt.'">
                                                                    </a>
                                                                </li>   
                                                                ';
                                                            }
                                                        }
                                                    ?>
                                                </ul>
                                            </div>     
                                        </div>
                                        <div id="product-information" class="product-information row text-center ">        
                                            <div id="product-header" class="clearfix">
                                                <div id="product-info-left">
                                                    <div class="description">
                                                        <fieldset>
                                                            <legend><?php echo __("Description"); ?></legend>
                                                            <p itemprop="description"><?php
                                                            echo $itemInfo['description'];
                                                            ?></p>
                                                        </fieldset>
                                                        <fieldset>
                                                            <legend>La description</legend>
                                                            <p itemprop="description"><?php
                                                            echo $itemInfo['description_french'];
                                                            ?></p>
                                                        </fieldset>
                                                        <?php 
                                                            if ( $item['category'] == 3 ) {
                                                                ?>
                                                                    <fieldset>
                                                                        <legend style="border-top: solid thin #ddd; padding-top: 15px; border-bottom: none; margin-bottom: 5px;"><?php echo __("Note"); ?></legend>
                                                                        <p><?php
                                                                        echo __("All Pendants will be shipped with a Silver Chain")." <br/> Tous les pendentifs sont livrés avec une chaine en argent";
                                                                        ?></p>
                                                                    </fieldset>
                                                                <?php
                                                            }
                                                        ?>
                                                    </div>
                                                    <div class="relative">
                                                        <ul class="list-unstyled">
                                                            <li class="tags">
                                                            <span><?php echo __("Tags"); ?> :</span>
                                                            <?php
                                                            $getMaterial = $pdo->prepare("SELECT * FROM `materials` WHERE `id` = :material");
                                                            $getMaterial->execute(array(":material" => $itemInfo['material']));

                                                            $material = $getMaterial->fetch(PDO::FETCH_ASSOC);
                                                            $material = $material['category'];
                                                            echo '
                                                            <a href="'.$__MAINDOMAIN__.''.$lang.'/'. processUrlParameter(__($category)) .'?material='. $itemInfo['material'] .'">
                                                            '. $material .'<span>,</span>
                                                            </a>
                                                            ';

                                                            $itemInfo['color'];
                                                            $getColor = $pdo->prepare("SELECT * FROM color WHERE id = :id");
                                                            $getColor->execute(array(":id" => $itemInfo["color"]));
                                                            $getColor = $getColor->fetch(PDO::FETCH_ASSOC);

                                                            $color = '<a href="'.$__MAINDOMAIN__.''.$lang.'/'. processUrlParameter(__($category)) .'?color='. $getColor['id'] .'">'. $getColor["color"] .'<span>,</span>
                                                                        </a>';
                                                            echo $color;

                                                            echo '<a href="'.$__MAINDOMAIN__.''.$lang.'/'. processUrlParameter(__($category)) .'?clarity='. $itemInfo['clarity'] .'">
                                                                        '. $itemInfo['clarity'] .'<span></span>
                                                                        </a>';
                                                            ?>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </div>          
                                                <div id="product-info-right">     
                                                    <div itemprop="offers" itemscope="" itemtype="http://schema.org/Offer" class="col-sm-24 group-variants">
                                                        <meta itemprop="priceCurrency" content="USD">              
                                                        <link itemprop="availability" href="http://schema.org/InStock">
                                                        <form method="post" class="variants" id="product-actions" action="<?php echo 'http://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI']; ?>">
                                                            <div id="product-actions-1293235843" class="options clearfix">
                                                                <style scoped>
                                                                  label[for="product-select-option-0"] { display: none; }
                                                                  #product-select-option-0 { display: none; }
                                                                  #product-select-option-0 + .custom-style-select-box { display: none !important; }
                                                                </style>                                                                
                                                                <div class="swatch color clearfix" data-option-index="0">
                                                                    <div class="header">
                                                                        <?php echo __("Stone"); ?>
                                                                    </div>
                                                                    <?php
                                                                    $getColorName = $pdo->prepare("SELECT * FROM color WHERE id = :id");
                                                                    $getColorName->execute(array(":id" => $itemInfo['color']));

                                                                    $colorName = $getColorName->fetch(PDO::FETCH_ASSOC);
                                                                    echo '
                                                                    <div data-value="blue" class="swatch-element color blue available">
                                                                        <div class="tooltip">
                                                                            '. $colorName["color"] .'
                                                                        </div>
                                                                        <a class="btn material-badge" name="'. $colorName["color"] .'">'. $colorName["color"] .'</a>
                                                                        </label>
                                                                    </div>';
                                                                    ?>                                                                  
                                                                </div>
                                                                <?php

                                                                if ( ($itemInfo['color'] == 1 || $itemInfo['color'] == 3) && isset($itemInfo['diamond_color']) && !empty($itemInfo['diamond_color']) ) {
                                                                    ?>
                                                                    <div class="swatch color clearfix" data-option-index="0">
                                                                        <div class="header">
                                                                            <?php echo __("Diamond Color"); ?>
                                                                        </div>
                                                                        <?php
                                                                        $getColorName = $pdo->prepare("SELECT * FROM diamond_color WHERE id = :id");
                                                                        $getColorName->execute(array(":id" => $itemInfo['diamond_color']));

                                                                        $colorName = $getColorName->fetch(PDO::FETCH_ASSOC);
                                                                        echo '
                                                                        <div data-value="blue" class="swatch-element color blue available">
                                                                            <div class="tooltip">
                                                                                '. $colorName["diamond_color"] .'
                                                                            </div>
                                                                            <a class="btn material-badge" name="'. $colorName["diamond_color"] .'">'. $colorName["diamond_color"] .'</a>
                                                                            </label>
                                                                        </div>';
                                                                        ?>                                                                  
                                                                    </div>
                                                                    <?php
                                                                }

                                                                echo '<input id="product-size-value" name="size" value="0" hidden />
                                                                    <input name="unique_key" value="'. $item['unique_key'] .'" hidden/>';

                                                                if ( $item['category'] == 1 ) {
                                                                    echo '
                                                                <div class="swatch clearfix" data-option-index="1">
                                                                    <div class="header">
                                                                        '.__("Size").'
                                                                    </div>
                                                                    
                                                                    <div id="quick-shop-size">';
                                                                        echo'
                                                                        <div class="input-group">';

                                                                        if ( strpos($itemInfo['ring_size'], ",") !== false ) {
                                                                            #Item has more than one values, divided by a comma
                                                                            $sizeArray = explode(",", $itemInfo['ring_size']);

                                                                            foreach ( $sizeArray as $sizeItem ) {
                                                                                if ( strpos($sizeItem, "-") !== false ) {
                                                                                    #this particular size item has a range.
                                                                                    $sizeRange = explode("-", $sizeItem);
                                                                                    for ( $i = $sizeRange[0]; $i <= $sizeRange[1]; $i++ ) {
                                                                                        echo '<a class="btn size-badge tooptip" name="'. $i .'" onClick="selectSize(this)">'. $i .'</a>'; 
                                                                                    }
                                                                                } else {
                                                                                    echo '<a class="btn size-badge tooptip" name="'. $sizeItem .'" onClick="selectSize(this)">'. $sizeItem .'</a>';
                                                                                }
                                                                            }
                                                                        } else if ( strpos($itemInfo['ring_size'], "-") !== false ) {
                                                                            #Here you only have one item given, but it's a range
                                                                            $sizeRange = explode("-", $itemInfo['ring_size']);
                                                                            for ( $i = $sizeRange[0]; $i <= $sizeRange[1]; $i++ ) {
                                                                                    echo '<a class="btn size-badge tooptip" name="'. $i .'" onClick="selectSize(this)">'. $i .'</a>'; 
                                                                                }
                                                                        } else {
                                                                            #There's just 1 item given and it's a singular size
                                                                            echo '<a class="btn size-badge tooptip" name="'. $itemInfo['ring_size'] .'" onClick="selectSize(this)">'. $itemInfo['ring_size'] .'</a>'; 
                                                                        }

                                                                            /*for ( $i = 0; $i < sizeof($sizes); $i++ ) {
                                                                                if ( $i == 0 ) {
                                                                                    echo '<a class="btn size-badge tooptip" name="'. $sizes[$i] .'" onClick="selectSize(this)">'. $sizes[$i] .'</a>';
                                                                                } else {
                                                                                    if ( strstr($sizes[$i], "-") !== false ) {
                                                                                        //pconsole($sizes[$i] . " is a range");
                                                                                        $sizesRange = explode("-", $sizes[$i]);

                                                                                        if ( intval(trim($sizesRange[0])) < intval(trim($sizesRange[1])) ) {
                                                                                            for ( $j = intval(trim($sizesRange[0])); $j <= intval(trim($sizesRange[1])); $j++ ) {
                                                                                                //pconsole($j);
                                                                                                echo '<a class="btn size-badge" name="'. $j .'" onClick="selectSize(this)">'. $j .'</a>';
                                                                                            }
                                                                                        }
                                                                                        #for ( $j = $sizesRange[0]; $j <= $sizesRange[1]; $j++ ) {  
                                                                                        #   echo '<a class="btn size-badge" name="'. $j .'" onClick="selectSize(this)">'. $j .'</a>';
                                                                                        #}
                                                                                    } else {
                                                                                        echo '<a class="btn size-badge" name="'. $sizes[$i] .'" onClick="selectSize(this)">'. $sizes[$i] .'</a>';
                                                                                    }
                                                                                }
                                                                            }*/
                                                                        echo '</div>
                                                                    </div>
                                                                </div>';
                                                                }
                                                                ?>

                                                                <?php 
                                                                if ( $item['category'] == 4 ) {
                                                                ?>
                                                                <div class="swatch color clearfix" data-option-index="0">
                                                                    <div class="header">
                                                                        <?php echo __("Length"); ?>
                                                                    </div>
                                                                    <?php
                                                                    if ( empty($itemInfo['height']) || $itemInfo['height'] == 0 || empty($itemInfo['width']) || $itemInfo['width'] == 0 || empty($itemInfo['length']) || $itemInfo['length'] == 0 ) {
                                                                        $measurement = "-";
                                                                    } else {
                                                                        $measurement = $itemInfo['height'] . " x ";
                                                                        $measurement .= $itemInfo['width'] . " x ";
                                                                        $measurement .= $itemInfo['length'] . " mm";
                                                                    }

                                                                    echo '<div class="header"><small>'. $itemInfo['length'] .' mm</small></div>';
                                                                    ?>                                                                  
                                                                </div>
                                                                <?php
                                                                } else {
                                                                ?>
                                                                <div class="swatch color clearfix" data-option-index="0">
                                                                    <div class="header">
                                                                        <?php echo __("Measurement"); ?>
                                                                    </div>
                                                                    <?php
                                                                    if ( empty($itemInfo['height']) || $itemInfo['height'] == 0 || empty($itemInfo['width']) || $itemInfo['width'] == 0 || empty($itemInfo['length']) || $itemInfo['length'] == 0 ) {
                                                                        $measurement = "-";
                                                                    } else {
                                                                        $measurement = $itemInfo['height'] . " x ";
                                                                        $measurement .= $itemInfo['width'] . " x ";
                                                                        $measurement .= $itemInfo['length'] . " mm";
                                                                    }

                                                                    echo '<div class="header"><small>'. $measurement .'</small></div>';
                                                                    ?>                                                                  
                                                                </div>
                                                                <?php
                                                                }
                                                                ?>
                                                                <div class="swatch color clearfix" data-option-index="0">
                                                                    <div class="header">
                                                                        <?php echo __("Metal"); ?>
                                                                    </div>
                                                                    <?php
                                                                    echo '<div class="header"><small>'. getMaterial($itemInfo['material'], $pdo) .'</small></div>';
                                                                    ?>                                                                  
                                                                </div>
                                                                <div class="swatch color clearfix" data-option-index="0">
                                                                    <div class="tooltip">
                                                                                asd
                                                                            </div>
                                                                    <div class="header">

                                                                        <?php echo __("Gold Quality"); ?>
                                                                    </div>
                                                                    <?php
                                                                    $goldQuality = $pdo->prepare("SELECT gold_quality FROM gold_quality WHERE id = :id");
                                                                    $goldQuality->execute(array(":id" => $itemInfo['gold_quality']));

                                                                    if ( $goldQuality->rowCount() > 0 ) {
                                                                        $goldQuality = $goldQuality->fetch(PDO::FETCH_ASSOC)['gold_quality'];
                                                                        //echo '<div class="header"><small>'. $goldQuality .' - '. $itemInfo['total_gold_weight'] .'gr</small></div>';

                                                                        echo '
                                                                        <div data-value="blue" class="swatch-element color blue available">
                                                                            <div class="tooltip" style="width: 250px; left: -100px;">
                                                                                '.__("Gold Quality").' - '.__("Gold Weight").'
                                                                            </div>
                                                                            <div class="header"><small>'. $goldQuality .' - '. $itemInfo['total_gold_weight'] .'gr <i class="fa fa-info-circle"></i></small></div>
                                                                            </label>
                                                                        </div>';
                                                                    }
                                                                    ?>                                                                  
                                                                </div>
                                                                <div class="swatch color clearfix" data-option-index="0">
                                                                    <div class="header">
                                                                        <?php echo __("Diamonds"); ?>
                                                                    </div>
                                                                    <?php
                                                                    //echo '<div class="header"><small>'. $itemInfo['no_of_stones'] .' - '. number_format($itemInfo['total_carat_weight'], 2) .'ct.</small></div>';

                                                                    echo '
                                                                        <div data-value="blue" class="swatch-element color blue available">
                                                                            <div class="tooltip" style="width: 250px; left: -100px;">
                                                                                '.__("No. of Diamonds").' - '.__("Diamond Weight").'
                                                                            </div>
                                                                            <div class="header"><small>'. $itemInfo['no_of_stones'] .' - '. number_format($itemInfo['total_carat_weight'], 2) .'ct. <i class="fa fa-info-circle"></i></small></div>
                                                                            </label>
                                                                        </div>';
                                                                    ?>                                                                  
                                                                </div>
                                                                <div class="swatch color clearfix" data-option-index="0">
                                                                    <div class="header">
                                                                        <?php echo __("Diamond Clarity"); ?>
                                                                    </div>
                                                                    <?php
                                                                    echo '<div class="header"><small>'. $itemInfo['clarity'] .'</small></div>';
                                                                    ?>                                                                  
                                                                </div>
                                                                <div class="swatch color clearfix" data-option-index="0">
                                                                    <div class="header">
                                                                        <?php echo __("Diamond Shape"); ?>
                                                                    </div>
                                                                    <?php
                                                                    echo '<div class="header"><small>'. getDiamondShape($itemInfo['diamond_shape'], $pdo) .'</small></div>';
                                                                    ?>                                                                  
                                                                </div>
                                                                <!--<div class="swatch color clearfix" data-option-index="0">
                                                                    <div class="header">
                                                                        Lab Grown Diamond
                                                                    </div>
                                                                    <?php
                                                                    $labGrown = "<i class='fa fa-times' style='color:crimson'></i>";
                                                                    if ( $itemInfo['lab_grown'] == 1 ) {
                                                                        $labGrown = "<i class='fa fa-check' style='color:green'></i>";
                                                                    } 
                                                                    echo '<div class="header"><small>'. $labGrown .'</small></div>';
                                                                    ?>                                                                  
                                                                </div> -->
                                                                <div class="swatch color clearfix" data-option-index="0">
                                                                    <div class="header">
                                                                        <?php echo __("Color Stones"); ?>
                                                                    </div>
                                                                    <?php
                                                                    $numColorStoneTag = "-";
                                                                    if ( isset($itemInfo['no_of_stones']) && !empty($itemInfo['no_of_color_stones']) ) {
                                                                        $numColorStoneTag = $itemInfo['no_of_color_stones'] .' - '. $itemInfo['color_stone_carat'] .'ct.';
                                                                    }
                                                                    //echo '<div class="header"><small>'. $numColorStoneTag .'</small></div>';

                                                                    echo '
                                                                        <div data-value="blue" class="swatch-element color blue available">
                                                                            <div class="tooltip" style="width: 250px; left: -100px;">
                                                                                '.__("No. of Color Stones").' - '.__("Color Stone Weight").'
                                                                            </div>
                                                                            <div class="header"><small>'. $numColorStoneTag .' <i class="fa fa-info-circle"></i></small></div>
                                                                            </label>
                                                                        </div>';
                                                                    ?>                                                                  
                                                                </div>
                                                                <div class="swatch color clearfix" data-option-index="0">
                                                                    <div class="header">
                                                                        <?php echo __("Color Stone Type"); ?>
                                                                    </div>
                                                                    <?php
                                                                    echo '<div class="header"><small>'. $itemInfo['color_stone_type'] .'</small></div>';
                                                                    ?>                                                                  
                                                                </div>
                                                                <div class="swatch color clearfix" data-option-index="0">
                                                                    <div class="header">
                                                                        <?php echo __("Color Stone Shape"); ?>
                                                                    </div>
                                                                    <?php
                                                                    echo '<div class="header"><small>'. getDiamondShape($itemInfo['color_stone_shape'], $pdo) .'</small></div>';
                                                                    ?>                                                                  
                                                                </div>
                                                                <div class="quantity-wrapper clearfix">
                                                                    <label class="wrapper-title"><?php echo __("Quantity"); ?></label>
                                                                    <div class="wrapper">
                                                                        <input id="quantity" name="quantity" value="1" maxlength="5" size="5" class="item-quantity" type="text">
                                                                        <span class="qty-group">
                                                                        <span class="qty-wrapper">
                                                                        <span data-original-title="<?php echo __("Increase"); ?>" class="qty-up btooltip" data-toggle="tooltip" data-placement="top" title="" data-src="#quantity">
                                                                        <i class="fa fa-caret-right"></i>
                                                                        </span>
                                                                        <span data-original-title="<?php echo __("Decrease"); ?>" class="qty-down btooltip" data-toggle="tooltip" data-placement="top" title="" data-src="#quantity">
                                                                        <i class="fa fa-caret-left"></i>
                                                                        </span>
                                                                        </span>
                                                                        </span>
                                                                    </div>
                                                                </div>
                                                                <div id="purchase-1293235843">
                                                                    <div class="detail-price" itemprop="price">
                                                                        <span class="price">
                                                                            <?php
																			$item["discount"]='';
                                                                                if ( $item["discount"] > 0 ) {
                                                                                    $sale = '<span style="font-size: 18px;" class="label label-success">'. $item['discount'] .'% '.__("OFF").'</span>'; 
                                                                                } else {
                                                                                    $sale = "";
                                                                                }
                                                                                echo $price . $sale; 
                                                                            ?></span>
                                                                    </div>
                                                                </div>
                                                                <?php
                                                                if ( $itemInfo['pieces_in_stock'] > 0 ) {
                                                                    $button = '<button id="add-to-cart" class="btn btn-1 add-to-cart" data-parent=".product-information" type="submit" name="addToCart">'.__("Add to Cart").'</button>';
                                                                } else {
                                                                    $button = '<button id="add-to-cart" class="btn btn-1 add-to-cart disabled" data-parent=".product-information" type="submit" name="add">'.__("Out of Stock").'</button>';
                                                                }

                                                                /* if ( !$_SESSION['loggedIn'] || !isset($_SESSION['loggedIn']) ) {
                                                                    $button = '<a class="btn btn-1 add-to-cart" data-parent=".product-information" href="./login.php" name="add">Login to access Cart</a>';
                                                                } */
                                                                echo '
                                                                <div class="others-bottom clearfix">
                                                                    '. $button .'
                                                                </div>';
                                                                ?>
                                                            </div>
                                                        </form>
                                                        <div class="wls">
                                                            <?php if ( $_SESSION['loggedIn'] || !isset($_SESSION['loggedIn']) ) echo $wishlist; ?>
                                                        </div>                                          
                                                    </div>              
                                                </div>
                                            </div>
                                        </div>              
                                    </div>
                                </div>         
                                <!-- Related Products -->
                                <section class="rel-container clearfix">  
                                    <h6 class="general-title text-left"><?php echo __("You may also like the related products"); ?></h6>
                                    <div id="prod-related-wrapper">
                                        <div class="prod-related clearfix">
                                        
                                                    <?php
                                                    $fetchFeatured = $pdo->prepare("SELECT * FROM `items` WHERE `category` = :cat AND site_0 = 1 AND disabled = 0 LIMIT 10");
                                                    $fetchFeatured->execute(array(":cat" => $item['category']));

                                                    $featuredItems = $fetchFeatured->fetchAll();
                                                   

                                                    $delay = 0;
                                                    foreach ( $featuredItems as $product ) {

                                                        $S_no++;

                                                        switch ($product['category']) {
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

                                                     $getInfo->execute(array(":unique_key" => $product['unique_key']));

                                                    $info = $getInfo->fetch(PDO::FETCH_ASSOC);
                                                    
                                                    $images = $info['images'];
                                                    $images = explode(",", $images);

                                                    if ( $images[0] == "" ) {
                                                        $images[0] = "0.png";
                                                    }

                                                        $sale = "";
                                                        $price = '<span class="price">€'. $product['item_value'] .'</span>';
                                                        if ( $product['discount'] > 0 ) {
                                                            
                                                            $value = $product['item_value'] -  (($product['discount'] / 100 ) * $product['item_value']);
                                                            $sale = '<span class="sale_banner"><span class="sale_text">'.__("Sale").'</span></span>';
                                                            $price = '<span class="price_sale">€'. round($value, 2) .'</span><del class="price_compare">€'. $product['item_value'] .'</del>';
                                                        }


                                                        if ( strstr($favorites, $product['unique_key']) ) {
                                                            $wishlist = '<a class="wish-list" href="javascript:void(0);" id="fav_'. $product['unique_key'] .'_FEAT" onClick="removeFromWishlist(\''. $product['unique_key'] .'\')"><i class="fa fa-heart fav-true"></i><span class="list-mode">'.__("Remove from Wishlist").'</span></a>';
                                                        } else {
                                                            $wishlist = '<a class="wish-list" href="javascript:void(0);" id="fav_'. $product['unique_key'] .'_FEAT" onClick="addToWishlist(\''. $product['unique_key'] .'\')"><i class="fa fa-heart"></i><span class="list-mode">'.__("Add to Wishlist").'</span></a>';
                                                        }
                                                            //$urlSubcategory = '';
                                                         if ( isset($_GET['_sc']) && (int)$ringTag>0) {
                                                            $urlSubcategory = $ringTag;
                                                        } else if ( isset($_GET['_sc']) && !empty($_GET['_sc'])) {
                                                            $urlSubcategory = $_GET['_sc'];
                                                         } else {
                                                            $urlSubcategory = $info['ring_subcategory'];
                                                         } 

                                                         $img_alt =  makeProductDetailPageUrl($urlSubcategory,$info['total_carat_weight'],$info['gold_quality'],$info['material'],$info['product_name'],$info['unique_key'],$alt_tag=1);

                                                        echo '                                                                                          
                                                    <div class="element no_full_width bounceIn not-animated" data-animate="fadeInUp" data-delay="'. $delay .'">
                                                        <ul class="row-container list-unstyled clearfix">
                                                            <li class="row-left">
                                                            <a href="'.makeProductDetailPageUrl($urlSubcategory,$info['total_carat_weight'],$info['gold_quality'],$info['material'],$info['product_name'],$info['unique_key']) .'" class="container_item" style="height:277px;">
                                                            <img src="'. $__MAINDOMAIN__.'images/images_md/'. $images[0] .'" class="img-responsive" id="'.$S_no.'-getAltTag" alt="'.ucfirst($img_alt).'" itemprop="photo">
                                                            '. $sale .'
                                                            </a>
                                                            <div class="hbw">
                                                                <span class="hoverBorderWrapper"></span>
                                                            </div>
                                                            </li>
                                                            <li class="row-right parent-fly animMix">
                                                            <div class="product-content-left">
                                                                <a class="title-5" href="'.makeProductDetailPageUrl($urlSubcategory,$info['total_carat_weight'],$info['gold_quality'],$info['material'],$info['product_name'],$info['unique_key']) .'">'. $product['item_name'] .'</a>
                                                                <span class="spr-badge" id="spr_badge_1293238211" data-rating="0.0">
                                                                <span class="spr-badge-caption">
                                                                '.__("No reviews").' </span>
                                                                </span>
                                                            </div>
                                                            <div class="product-content-right">
                                                            '. $price .'
                                                            </div>
                                                            <div class="list-mode-description">
                                                                 
                                                            </div>
                                                            <div class="hover-appear">
                                                                <form action="'.makeProductDetailPageUrl($urlSubcategory,$info['total_carat_weight'],$info['gold_quality'],$info['material'],$info['product_name'],$info['unique_key']) .'"  method="post">
                                                                    <div class="effect-ajax-cart">
                                                                        <input type="hidden" name="quantity" value="1">
                                                                        <button class="select-option" type="button" onclick="window.location.href='."'".makeProductDetailPageUrl($urlSubcategory,$info['total_carat_weight'],$info['gold_quality'],$info['material'],$info['product_name'],$info['unique_key']) ."'".'"><i class="fa fa-th-list" title="'.__("Select Options").'"></i><span class="list-mode">'.__("Select Option").'</span></button>
                                                                    </div>
                                                                </form>
                                                                <div class="product-ajax-qs hidden-xs hidden-sm">
                                                                    <div class="quick_shop" onclick="quickShop(\''. $product['unique_key'] .'\')">
                                                                        <i class="fa fa-eye" onclick="return getImgTag('.$S_no.');" title="'.__("Quick View").'"></i><span class="list-mode">'.__("Quick View").'</span>                                                                       
                                                                    </div>
                                                                </div>
                                                                '. $wishlist .'
                                                            </div>
                                                            </li>
                                                        </ul>
                                                    </div>';                                                   
                                                    $delay += 200;
                                                    }
                                                    ?>                        
                                        </div>  
                                    </div>                                      
                                </section>
                            </div>
                        </div>
                    </div>
                </section>  
            </div>
        </div>
    </div> 

    <?php include './url/footer.php'; ?>
    <script type="text/javascript">
        $(document).ready(function(){
            $('[data-toggle="tooltip"]').tooltip(); 
        });
    </script>
</body>


<div id="quick-shop-modal" class="modal in" role="dialog" aria-hidden="false" tabindex="-1" data-width="800">
        <div class="modal-backdrop in" style="height: 742px;">
        </div>
        <div class="modal-dialog rotateInDownLeft animated">
            <div class="modal-content" style="min-height: 0px;">
                <div class="modal-header">
                    <i class="close fa fa-times btooltip" data-toggle="tooltip" data-placement="top" title="" data-dismiss="modal" aria-hidden="true" data-original-title="<?php echo __("Close"); ?>"></i>
                </div>
                <div class="modal-body">
                    <div class="quick-shop-modal-bg" style="display: none;">
                    </div>
                    <div class="row">
                        <div class="col-md-12 product-image">
                            <div id="quick-shop-image" class="product-image-wrapper">
                                <a class="main-image" style="display: inline-block; max-height: 354px; overflow: hidden;"><img class="img-zoom img-responsive image-fly" src="<?php echo $__MAINDOMAIN__;?>assets/images/demo_354x354.png" data-zoom-image="<?php echo $__MAINDOMAIN__;?>assets/images/demo_354x354.png" id="newAlt" alt=""/></a>
                                <div id="gallery_main_qs" class="product-image-thumb">
                                </div>  
                            </div>
                        </div>
                        <div class="col-md-12 product-information">
                            <h1 id="quick-shop-title"><span> <a id="quick-shop-url"></a></span></h1>
                            <div id="quick-shop-infomation" class="description">
                                <div id="quick-shop-description" class="text-left">
                                    
                                </div>
                            </div>
                            <div id="quick-shop-container">
                                <div id="quick-shop-relative" class="relative text-left">
                                    <ul class="list-unstyled">
                                        <li class="control-group vendor">
                                        <span class="control-label"></a>
                                        </li>
                                        <li class="control-group type">
                                        <span class="control-label"></a>
                                        </li>
                                    </ul>
                                </div>
                                <form method="post" enctype="multipart/form-data" action="<?php echo 'http://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI']; ?>">
                                    <div id="quick-shop-price-container" class="detail-price">
                                        
                                    </div>
                                    <div class="quantity-wrapper clearfix">
                                        <label class="wrapper-title"><?php echo __("Quantity"); ?></label>
                                        <div class="wrapper">
                                            <input type="text" id="qs-quantity" size="5" class="item-quantity" name="quantity" value="1">
                                            <span class="qty-group">
                                            <span class="qty-wrapper">
                                            <span class="qty-up" title="<?php echo __("Increase"); ?>" data-src="#qs-quantity">
                                            <i class="fa fa-plus"></i>
                                            </span>
                                            <span class="qty-down" title="<?php echo __("Decrease"); ?>" data-src="#qs-quantity">
                                            <i class="fa fa-minus"></i>
                                            </span>
                                            </span>
                                            </span>
                                        </div>
                                    </div>
                
                                    <label class="label-quick-shop"><?php echo __("Material"); ?> <span id="material-carat" style="font-size: 12px; color: #aaa; font-weight: bold;"></span></label>
                                    <input id="quick-shop-material-value" name="material" hidden />
                                    <div class="input-group" id="quick-shop-material">
                                        <a class="btn material-badge" name="1"><?php echo __("Yellow Gold"); ?></a>
                                        <a class="btn material-badge" name="2"><?php echo __("White Gold"); ?></a>
                                        <a class="btn material-badge" name="3"><?php echo __("Pink Gold"); ?></a>
                                        <a class="btn material-badge" name="4"><?php echo __("Silver"); ?></a>
                                        <a class="btn material-badge" name="5"><?php echo __("Platinum"); ?>"</a>
                                    </div>
                                    <div id="quick-shop-size">
                                        <label class="label-quick-shop"><?php echo __("Size"); ?> <span id="material-carat" style="font-size: 12px; color: #aaa; font-weight: bold;"></span></label> 
                                        <input id="quick-shop-size-value" name="size" value="0" hidden />
                                        <div class="input-group" id="quick-shop-size-container">
                                            <!-- Sizes go here -->
                                        </div>
                                    </div>
                                    
                                    <input id="quick-shop-unique-key" name="unique_key" hidden />
                                    <div id="buttonDiv"></div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<script>


$("#mainImage").elevateZoom({
       responsive: true,
       zoomType: "window", 
       containLensZoom: true,
       zoomWindowWidth: 350,
        cursor: "crosshair"
    });  

function addToWishlist(key) {
    //alert(key);
        if (window.XMLHttpRequest) {
            // code for IE7+, Firefox, Chrome, Opera, Safari
            xmlhttp = new XMLHttpRequest();
        } else {
            // code for IE6, IE5
            xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
        }
        xmlhttp.onreadystatechange = function() {
            if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                $("#fav_"+key+" i").addClass("fav-true");
                $("#fav_"+key+" span").text("<?php echo __('Remove from Wishlist'); ?>");
                $("#fav_"+key).removeAttr("onClick");
                $("#fav_"+key).attr("onClick", "removeFromWishlist('"+ key +"')");
                $("#fav_"+key).attr("data-original-title", "Un-favorites it!");
              
                //Featured Workaround
                $("#fav_"+key+"_FEAT"+" i").addClass("fav-true");
                $("#fav_"+key+"_FEAT").removeAttr("onClick");
                $("#fav_"+key+"_FEAT").attr("onClick", "removeFromWishlist('"+ key +"')");
                $("#fav_"+key+"_FEAT").attr("data-original-title", "Un-favorites it!");

                $("#favorite_num_badge").text(parseInt($("#favorite_num_badge").text()) + 1);

                console.log(xmlhttp.responseText);
            };
        }
    xmlhttp.open("GET","<?php echo $__MAINDOMAIN__;?>url/ajax.php?addtoFav="+key,true);
    xmlhttp.send();
}
function quickShop(id) {
    if (id == "") {
        document.getElementById("quick-shop-modal").innerHTML = "";
        return;
    } else { 
        if (window.XMLHttpRequest) {
            // code for IE7+, Firefox, Chrome, Opera, Safari
            xmlhttp = new XMLHttpRequest();
        } else {
            // code for IE6, IE5
            xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
        }
        xmlhttp.onreadystatechange = function() {
            if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                var result = JSON.parse(xmlhttp.responseText);
                console.log(result);
                images = result['images'].split(",");
                //$("#quick-shop-modal").html(xmlhttp.responseText);
                //console.log(xmlhttp.responseText);
                //Item Image
                if ( result['images'] == "" ) {
                    images[0] = "0.png";
                }   
                $("#quick-shop-image .main-image img").attr("src", "./images/images_md/" + images[0]);
                
                //Remove old Thumbs if any
                var currentThumbs = $(".image-thumb").length;
                for (var i = 0; i < currentThumbs; i++ ) {
                    //console.log("1 Item Removed");
                    $('#gallery_main_qs').owlCarousel().data('owlCarousel').removeItem();
                }
                //Item Thumbnals
                for ( var i = 0; i < images.length-1; i++ ) {
                    content = '<a class="image-thumb" onClick="quickDisplay(this)" value="./images/images_md/'+ images[i] +'" ><img src="./images/images_sm/'+ images[i] +'" alt=""/></a>';
                    //console.log("1 Item Added");
                    $('#gallery_main_qs').owlCarousel().data('owlCarousel').addItem(content);
                    $('.owl-item').toggleClass('show-item');
                }
                //Item Name
                $("#quick-shop-title a").text(result['item_name']);
                $("#quick-shop-title a").attr("href", "./product.php?view=" + result['unique_key']);
                
                //Desc
                $("#quick-shop-description").html(result['description']);
                
                //Price
                if ( result['discount'] > 0 ) {
                    discount = result['item_value'] - ( (result['discount'] / 100 ) * result['item_value']);
                    price = '<span class="price_sale">€'+ discount.toFixed(2) +'</span><span class="dash">/</span><del class="price_compare">€'+ result['item_value'] +'</del>';
                } else {
                    price = '<span class="price">€'+ result['item_value'] +'</span><span class="dash">';
                }
                $("#quick-shop-price-container").html(price);

                //Quantity 
                $("#qs-quantity").attr("max", result['pieces_in_stock']);
                
                //Material
                $("#material-carat").text(result['total_carat_weight'] + " ct.");
                $("#quick-shop-material a").each(function(index, element) {
                    //alert ($(element).attr("name"));
                    if ( $(element).attr("name") !== result['material'] ) {
                        $(element).attr("disabled", true);
                    } else {
                        $(element).attr("disabled", false);
                    }
                });
                
                //Size
                if ( result['category'] == 1 ) {
                    sizehtml = "";
                    sizes = result['ring_size'].split(",");
                    for ( var i = 0; i < sizes.length; i++ ) {
                        
                        if ( sizes[i].indexOf('-') > -1 ) {
                            sizesRange = sizes[i].split('-');
                            for ( var j = sizesRange[0]; j <= sizesRange[1]; j++ ) {
                                sizehtml += '<a class="btn size-badge" name="'+ j +'" onClick="selectSize(this)">'+ j +'</a>';
                            }
                        } else {
                            sizehtml += '<a class="btn size-badge" name="'+ sizes[i] +'" onClick="selectSize(this)">'+ sizes[i] +'</a>';
                        }
                    }
                    //console.log(sizehtml);
                    $("#quick-shop-size-container").html(sizehtml);
                    $("#quick-shop-size").show();
                } else {
                    $("#quick-shop-size").hide();
                }

                if ( result['pieces_in_stock'] <= 0 ) {
                    $("#buttonDiv").html('<button class="btn" name="addToCart" style="position: fixed; bottom: 15px; right: 15px; width: 200px;" disabled><?php echo __("Out of Stock"); ?></button>');
                } else {
                    $("#buttonDiv").html('<button class="btn" type="submit" name="addToCart" style="position: fixed; bottom: 15px; right: 15px; width: 200px;"><?php echo __("Add to Cart"); ?></button>');
                }

                $("#quick-shop-unique-key").val(result['unique_key']);
                $("#quick-shop-modal").modal("toggle");
            }
        };

        xmlhttp.addEventListener( "progress" ,function(e) {
            if ( e.lengthComputable ) {
                setTimeout(3000);
                console.log(e.loaded);
            }
        }, false);

        xmlhttp.open("GET","<?php echo $__MAINDOMAIN__;?>url/fetch_item_info.php?id="+id, false);
        xmlhttp.send();

    }
}
function removeFromWishlist(key) {
  if (window.XMLHttpRequest) {
      // code for IE7+, Firefox, Chrome, Opera, Safari
      xmlhttp = new XMLHttpRequest();
  } else {
      // code for IE6, IE5
      xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
  }
  xmlhttp.onreadystatechange = function() {
      if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
          $("#fav_"+key+" i").removeClass("fav-true");
          $("#fav_"+key+" span").text("<?php echo __('Add to Wishlist'); ?>");
          $("#fav_"+key).removeAttr("onClick");
          $("#fav_"+key).attr("onClick", "addToWishlist('"+ key +"')");
          $("#fav_"+key).attr("data-original-title", "Favorite it!");
          
          //Feature Workaround
          $("#fav_"+key+"_FEAT"+" i").removeClass("fav-true");
          $("#fav_"+key+"_FEAT").removeAttr("onClick");
          $("#fav_"+key+"_FEAT").attr("onClick", "addToWishlist('"+ key +"')");
          $("#fav_"+key+"_FEAT").attr("data-original-title", "Favorite it!");

          $("#favorite_num_badge").text(parseInt($("#favorite_num_badge").text()) - 1);
          console.log(xmlhttp.responseText);
      }
  };
  xmlhttp.open("GET","<?php echo $__MAINDOMAIN__;?>url/ajax.php?removeFromFav="+key,true);
  xmlhttp.send();
}

function selectSize (e) {
    $('.size-badge').each(function(index, element) {
        //console.log($(element).attr('name'));
        if ( $(e).attr("name") == $(element).attr("name") ) {
            $(element).addClass('size-badge-active');
            $('#product-size-value').val($(element).attr('name'));
        } else {
            $(element).removeClass('size-badge-active');
        }
    });
}

function selectImage(image) {
    $(".zoomContainer").remove();
    $('#mainImage').data("zoom-image", image).elevateZoom({
       responsive: true,
       zoomType: "window", 
       containLensZoom: true,
       zoomWindowWidth: 350,
        cursor: "crosshair"
    }); 
}

function getImgTag(id){
    
    var setNewAlt = $('#'+id+'-getAltTag').attr('alt');
    
    document.getElementById('newAlt').setAttribute('alt',setNewAlt);

}

function quickDisplay(src) {
    //alert($(src).attr("value"));
    
    $("#quick-shop-image .main-image img").attr("src", $(src).attr("value"));
    //$('#quick-shop-img').attr("src", src);
}

function setPageTitle(){
    
    var bigImg = $("#bigImg").attr('alt');

    if(bigImg!=''){
        document.title = bigImg;
    }else{
        document.title = '<?php echo __("Product"); ?>';
    }
}
/*if(!isset($_SESSION['change_lang']) && empty($_SESSION['change_lang'])){
    echo "string";
    echo $_SESSION['change_lang']=1;*/ 

    
 
    
//}

?>
 
</script>
<!--<script type="text/javascript">alert(); window.location.href = "<?php echo $new_rul  ?>"</script> -->