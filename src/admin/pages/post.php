<?php
if ( session_status() == PHP_SESSION_NONE ) {
  session_start();
}
if ( !isset($_SESSION['modSession']) ) {
     header ('Location: ../../index.php');
     die();
}
if ( isset($_SESSION['modSession']) ) {
    if ( !$_SESSION['modSession'] || $_SESSION['admin'] <= 0 ) {
        header ('Location: ../../index.php');
        die();
    }
}

include '../../conf/config.php';


if ( isset($_POST['manageSiteAccess']) ) {

    $disableAllForNow = $pdo->prepare("UPDATE items SET site_0 = 0, site_1 = 0, site_2 = 0, site_3 = 0, site_4 = 0, site_5 = 0, site_6 = 0, site_7 = 0 WHERE unique_key = :unique_key");
    $disableAllForNow->execute(array(":unique_key" => $_POST['unique_key']));

    foreach( $_POST as $key => $value ) {
        if ( $value == "on" ) {
            $updateAccess = $pdo->prepare("UPDATE items SET `". $key ."` = 1 WHERE `unique_key` = :unique_key");
            $updateAccess->execute(array(":unique_key" => $_POST['unique_key']));
        }
    }

    header("Location: ". $_SERVER['HTTP_REFERER']);
}

if ( isset($_POST['disableItem']) ) {
    $updateDisableStatus = $pdo->prepare("UPDATE items SET `disabled` = 1 WHERE `unique_key` = :unique_key");
    $updateDisableStatus->execute(array(":unique_key" => $_POST['disableItem']));
    header("Location: ". $_SERVER['HTTP_REFERER']);
}

if ( isset($_POST['enableItem']) ) {
    $updateDisableStatus = $pdo->prepare("UPDATE items SET `disabled` = 0 WHERE `unique_key` = :unique_key");
    $updateDisableStatus->execute(array(":unique_key" => $_POST['enableItem']));
    header("Location: ". $_SERVER['HTTP_REFERER']);
}

if ( isset($_POST['bulkManage']) ) {
    if ($_POST['bulkManage'] == "feature") {
        while ($checkbox = current($_POST)) {
            if ($checkbox == 'on') {
                $setBulkFeatured = $pdo->prepare("UPDATE `items` SET `featured` = 1 WHERE `unique_key` = :key");
                $setBulkFeatured->execute(array(":key" => key($_POST)));
            }
            next($_POST);
        }
    } else if ($_POST['bulkManage'] == "unfeature") {
        while ($checkbox = current($_POST)) {
            if ($checkbox == 'on') {
                $setBulkFeatured = $pdo->prepare("UPDATE `items` SET `featured` = 0 WHERE `unique_key` = :key");
                $setBulkFeatured->execute(array(":key" => key($_POST)));
            }
            next($_POST);
        }
    } else if ( $_POST['bulkManage'] == "delete") {
        while ( $checkbox = current($_POST)) {
            if ( $checkbox == "on" ) {
                $getItem = $pdo->prepare("SELECT * FROM `items` WHERE `unique_key` = :key");
                $getItem->execute(array(":key" => key($_POST)));

                $result = $getItem->fetch(PDO::FETCH_ASSOC);

                switch ($result['category']) {
                     case 1:{
                        $getImageVar = $pdo->prepare("SELECT * FROM `rings` WHERE `unique_key` = :key");
                        break;
                    } case 2:{
                        $getImageVar = $pdo->prepare("SELECT * FROM `earrings` WHERE `unique_key` = :key");
                        break;
                    } case 3:{
                        $getImageVar = $pdo->prepare("SELECT * FROM `pendants` WHERE `unique_key` = :key");
                        break;
                    } case 4:{
                        $getImageVar = $pdo->prepare("SELECT * FROM `necklaces` WHERE `unique_key` = :key");
                        break;
                    } case 5:{
                        $getImageVar = $pdo->prepare("SELECT * FROM `bracelets` WHERE `unique_key` = :key");
                        break;
                    }
                }

                $getImageVar->execute(array(":key" => key($_POST)));

                $imageVar = $getImageVar->fetch(PDO::FETCH_ASSOC);

                $images = $imageVar['images'];
                $images = explode(",", $images);

                foreach ( $images as $image ) {
                    if ( $image !== "") {
                        $imageFile = "../../images/" . $image;
                        $thumb = "../../images/thumbnails/" . $image;
                        if ( file_exists($imageFile) ) {
                            unlink($imageFile);
                        }
                        if ( file_exists($thumb) ) {
                            unlink($thumb);
                        }
                    }
                }
                switch ($result['category']) {
                    case 1: {
                        $deleteFromTable = $pdo->prepare("DELETE FROM `rings` WHERE `unique_key` = :key");
                        break;
                    }
                    case 2: {
                        $deleteFromTable = $pdo->prepare("DELETE FROM `earrings` WHERE `unique_key` = :key");
                        break;
                    }
                    case 3: {
                        $deleteFromTable = $pdo->prepare("DELETE FROM `pendants` WHERE `unique_key` = :key");
                        break;
                    }
                    case 4: {
                        $deleteFromTable = $pdo->prepare("DELETE FROM `necklaces` WHERE `unique_key` = :key");
                        break;
                    }
                    case 5: {
                        $deleteFromTable = $pdo->prepare("DELETE FROM `bracelets` WHERE `unique_key` = :key");
                        break;
                    }
                }

                $deleteFromTable->execute(array(":key" => key($_POST)));

                $deleteItem = $pdo->prepare("DELETE FROM `items` WHERE `unique_key` = :key");
                $deleteItem->execute(array(":key" => key($_POST)));

            }
            next($_POST);
        }
    } else if ( $_POST['bulkManage'] == "disable" ) {
        while ($checkbox = current($_POST)) {
            if ($checkbox == 'on') {
                $setBulkFeatured = $pdo->prepare("UPDATE `items` SET `disabled` = 1 WHERE `unique_key` = :key");
                $setBulkFeatured->execute(array(":key" => key($_POST)));
            }
            next($_POST);
        }
    } else if ( $_POST['bulkManage'] == "enable" ) {
        while ($checkbox = current($_POST)) {
            if ($checkbox == 'on') {
                $setBulkFeatured = $pdo->prepare("UPDATE `items` SET `disabled` = 0 WHERE `unique_key` = :key");
                $setBulkFeatured->execute(array(":key" => key($_POST)));
            }
            next($_POST);
        }
    } else if ( $_POST['bulkManage'] == "access" ) {

        $allSites = $pdo->prepare("SELECT * FROM tb_websites");
        $allSites->execute();

        $allSites = $allSites->fetchAll();

        foreach ( $_POST as $key => $value ) {
            if ( $value == "on" ) {

                foreach( $allSites as $siteToDisable ) {
                    $disableForNow = $pdo->prepare("UPDATE `items` SET `". $siteToDisable['token'] ."` = 0 WHERE `unique_key` = :key");
                    $disableForNow->execute(array(":key" => $key));
                }

                
                foreach ( $_POST['site'] as $site => $siteValue ) {
                    $query = $pdo->prepare("UPDATE `items` SET `". $site ."` = 1 WHERE `unique_key` = :unique_key");
                    $query->execute(array(":unique_key" => $key));
                }
            }

        }
    }

    header("Location: ". $_SERVER['HTTP_REFERER']);
}

if ( isset($_POST['addItem']) ) {

    switch ($_POST['category']) {
        case 1: {
            $table = "rings";
            $imageName = "ring";
            break;
        } case 2: {
            $table = "earrings";
            $imageName = "earring";
            break;
        } case 3: {
            $table = "pendants";
            $imageName = "pendant";
            break;
        } case 4: {
            $table = "necklaces";
            $imageName = "necklace";
            break;
        } case 5: {
            $table = "bracelets";
            $imageName = "bracelet";
            break;
        } default: {
            $table = "na";
            $imageName = "na";
            break;
        }
    }

    if ( $_POST['discount'] > 0 ) {
        $discount = $_POST['discount'];
    } else {
        $discount = 0;
    }

    $_POST['product_price'] = str_replace(",",  ".",    $_POST['product_price']);

    /* Filtering Variables */
    $_POST['pieces_in_stock'] = intval($_POST['pieces_in_stock']);
    $_POST['days_for_shipment'] = intval($_POST['days_for_shipment']);
    $_POST['no_of_stones'] = intval($_POST['no_of_stones']);
    $_POST['no_of_color_stones'] = intval($_POST['no_of_color_stones']);
    $_POST['diamond_shape'] = intval($_POST['diamond_shape']);
    $_POST['color_stone_shape'] = intval($_POST['color_stone_shape']);
    $_POST['color'] = intval($_POST['color']);
    $_POST['material'] = intval($_POST['material']);
    $_POST['country_id'] = intval($_POST['country_id']);
    $_POST['ring_subcategory'] = intval($_POST['ring_subcategory']);
    $_POST['lab_grown'] = intval($_POST['lab_grown']);
    $_POST['diamond_color'] = intval($_POST['diamond_color']);

    $_POST['total_carat_weight'] = floatval($_POST['total_carat_weight']);
    $_POST['color_stone_carat'] = floatval($_POST['color_stone_carat']);
    
    
    $uniqueKey = generateUniqueKey();
    
    while ( checkKey($uniqueKey, $pdo) ) {
        $uniqueKey = generateUniqueKey();
    }


    $checkInternalID = $pdo->prepare("SELECT * FROM `". $table ."` WHERE `internal_id` = :intID");
    $checkInternalID->execute(array(":intID" => $_POST['internal_id']));

    if ( $checkInternalID->rowCount() == 0 ) {

        $addInfo = $pdo->prepare("INSERT INTO `". $table ."` 
            (`unique_key`, `company_id`, `internal_id`, `product_name`, `pieces_in_stock`, `days_for_shipment`, `total_gold_weight`, `total_carat_weight`, `color_stone_carat`, `no_of_stones`, `no_of_color_stones`, `diamond_shape`, `color_stone_shape`, `clarity`, `color`, `diamond_color`, `material`, `height`, `width`, `length`, `country_id`, `lab_grown`, `images`, `description`, `description_french`, `ring_subcategory`, `ring_size`, gold_quality, color_stone_type) 
            VALUES 
            (:unique_key, :company_id, :internal_id, :product_name, :pieces_in_stock, :days_for_shipment, :total_gold_weight, :total_carat_weight, :color_stone_carat, :no_of_stones, :no_of_color_stones, :diamond_shape, :color_stone_shape, :clarity, :color, :diamond_color, :material, :height, :width, :length, :country_id, :lab_grown, :images, :description, :description_french, :ring_subcategory, :ring_size, :gold_quality, :color_stone_type)");
        $addInfo->execute(array(
            ":unique_key" => $uniqueKey,
            ":company_id" => $_POST['company_id'],
            ":internal_id" => $_POST['internal_id'],
            ":product_name" => $_POST['product_name'],
            ":pieces_in_stock" => $_POST['pieces_in_stock'],
            ":days_for_shipment" => $_POST['days_for_shipment'],
            ":total_carat_weight" => $_POST['total_carat_weight'],
            ":no_of_stones" => $_POST['no_of_stones'],
            ":diamond_shape" => $_POST['diamond_shape'],
            ":clarity" => $_POST['clarity'],
            ":color" => $_POST['color'], ":diamond_color" => $_POST['diamond_color'],
            ":material" => $_POST['material'],
            ":height" => $_POST['height'],
            ":width" => $_POST['width'],
            ":length" => $_POST['length'],
            ":country_id" => $_POST['country_id'],
            ":images" => "",
            ":description" => $_POST['description'], ":description_french" => $_POST["description_french"],
            ":ring_subcategory" => $_POST['ring_subcategory'],
            ":ring_size" => $_POST['ring_size'],
            ":total_gold_weight" => $_POST['total_gold_weight'], 
            ":color_stone_carat" => floatval($_POST['color_stone_carat']), 
            ":no_of_color_stones" => $_POST['no_of_color_stones'], 
            ":color_stone_shape" => intval($_POST['color_stone_shape']), 
            ":gold_quality" => $_POST['gold_quality'],
            ":color_stone_type" => $_POST['color_stone_type'],
            ":lab_grown" => $_POST['lab_grown']
        ));

        $images = "";


        $getitemID = $pdo->prepare("SELECT `id` FROM `". $table ."` WHERE `unique_key` = :unique_key");
        $getitemID->execute(array(":unique_key" => $uniqueKey));
        $itemID = $getitemID->fetch(PDO::FETCH_ASSOC);
        $itemID = $itemID['id'];
        
        $numOfImages = sizeof($_FILES['itemImage']['name']);
        for ( $count = 0; $count < $numOfImages; $count++ ) {
            if ( $_FILES['itemImage']['error'][$count] == 0 ) {
                    $image_dir = "../../images/";
                    $image_ext = pathinfo($image_dir . basename($_FILES['itemImage']['name'][$count]), PATHINFO_EXTENSION);
                    $image_file = $image_dir . "images/". $imageName ."_" . $itemID;
                    $image_md_file = $image_dir . "images_md/". $imageName ."_" . $itemID;
                    $image_sm_file = $image_dir . "images_sm/". $imageName ."_" . $itemID;

                    if ( !is_dir($image_dir . 'images/') ) {
                        mkdir($image_dir . 'images/');
                    }
                    if ( !is_dir($image_dir . 'images_md/') ) {
                        mkdir($image_dir . 'images_md/');
                    }
                    if ( !is_dir($image_dir . 'images_sm/') ) {
                        mkdir($image_dir . 'images_sm/');
                    }
                    
                    $check = getimagesize($_FILES['itemImage']['tmp_name'][$count]);
                    if ( $check ) {
                        if ( file_exists($image_file . "." . $image_ext) ) {
                            $i = 1;
                            while ( file_exists($image_file . "_" . $i . "." . $image_ext) ) {
                                $i++;
                            }
                            $image_file .= "_" . $i;
                            $image_md_file .= "_" . $i; 
                            $image_sm_file .= "_" . $i; 
                        }
                        if ( move_uploaded_file($_FILES['itemImage']['tmp_name'][$count], $image_file . "." . $image_ext) ) {
                            create_thumb($image_file . "." . $image_ext, $__IMPORT_IMAGE_RES__['LARGE'], $__IMPORT_IMAGE_RES__['LARGE'], $image_file . '.' . $image_ext);
                            create_thumb($image_file . "." . $image_ext, $__IMPORT_IMAGE_RES__['MED'], $__IMPORT_IMAGE_RES__['MED'], $image_md_file . '.' . $image_ext);
                            create_thumb($image_file . "." . $image_ext, $__IMPORT_IMAGE_RES__['SMALL'], $__IMPORT_IMAGE_RES__['SMALL'], $image_sm_file . '.' . $image_ext);
                        }
                    } else {
                        /* Not Image */
                    }
                    
                    $images .= basename($image_file) . "." . $image_ext . ",";
                }
        }

        $updateItemImages = $pdo->prepare("UPDATE `". $table ."` SET `images` = :images WHERE `unique_key` = :unique_key");
        $updateItemImages->execute(array(":images" => $images, ":unique_key" => $uniqueKey));

        $addItem = $pdo->prepare("INSERT INTO `items` (`unique_key`, `item_name`, `item_value`, `discount`, `category`, `featured`, `date_added`, site_0, site_1, site_2, site_3, site_4, site_5, site_6, site_7) VALUES (:unique_key, :product_name, :product_price, :discount, :category, 0, NOW(), 1, 1, 1, 1, 1, 1, 1, 1)");
        $addItem->execute(array(
            ":unique_key" => $uniqueKey,
            ":product_name" => $_POST['product_name'],
            ":product_price" => $_POST['product_price'],
            ":discount" => $discount,
            ":category" => $_POST['category']
        ));
    }


    header("Location: ". $_SERVER['HTTP_REFERER']);
    
}

/* COMMON FUNCTIONS */

function create_thumb($file, $w, $h,  $thumb_dir, $crop=FALSE) {
    list($width, $height) = getimagesize($file);
    $r = $width / $height;
    if ($crop) {
        if ($width > $height) {
            $width = ceil($width-($width*abs($r-$w/$h)));
        } else {
            $height = ceil($height-($height*abs($r-$w/$h)));
        }
        $newwidth = $w;
        $newheight = $h;
    } else {
        if ($w/$h > $r) {
            $newwidth = $h*$r;
            $newheight = $h;
        } else {
            $newheight = $w/$r;
            $newwidth = $w;
        }
    }
    $src = imagecreatefromjpeg($file);
    $dst = imagecreatetruecolor($newwidth, $newheight);
    imagecopyresampled($dst, $src, 0, 0, 0, 0, $newwidth, $newheight, $width, $height);
    
    return imagejpeg($dst, $thumb_dir);
}
    
function generateUniqueKey($length = 10) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}

function checkKey($key, $pdo) {
    $checkKey = $pdo->prepare("SELECT * FROM `items` WHERE `unique_key` = :key");
    $checkKey->execute(array(":key" => $key));
    if ( $checkKey->rowCount() > 0 ) {
        return true; // Key exists
    } else {
        return false;
    }
}
?>