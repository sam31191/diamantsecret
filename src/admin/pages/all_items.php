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
?>
<!DOCTYPE html>
<html lang="en">
<?php
include '../../conf/config.php';

if ( isset($_POST['featuredAdd']) ) {
    $addFeatured = $pdo->prepare("UPDATE `items` SET `featured` = 1 WHERE `unique_key` = :id");
    $addFeatured->execute(array(":id" => $_POST['featuredAdd']));
    
} else if ( isset ($_POST['featuredRemove']) ) {
    $removeFeatured = $pdo->prepare("UPDATE `items` SET `featured` = 0 WHERE `unique_key` = :id");
    $removeFeatured->execute(array(":id" => $_POST['featuredRemove']));
} else if ( isset($_POST['removeItem']) ) {
    //echo var_dump($_POST);

    $fetchInfo = $pdo->prepare("SELECT * FROM `items` WHERE `unique_key` = :id");
    $fetchInfo->execute(array(":id" => $_POST['removeItem']));
    $result = $fetchInfo->fetch(PDO::FETCH_ASSOC);

    $removeItem = $pdo->prepare("DELETE FROM `items` WHERE `unique_key` = :id");
    $removeItem->execute(array(":id" => $_POST['removeItem']));

    switch ($result['category']) {
        case 1: {
            $fetchImages = $pdo->prepare("SELECT * FROM `rings` WHERE `unique_key` = :id");
            $fetchImages->execute(array(":id" => $_POST['removeItem']));
            $images = $fetchImages->fetch(PDO::FETCH_ASSOC);
            $images = explode(",", $images['images']);
            $removeItem2 = $pdo->prepare("DELETE FROM `rings` WHERE `unique_key` = :id");
            $removeItem2->execute(array(":id" => $_POST['removeItem']));
            break;
        }
        case 2: {
            $fetchImages = $pdo->prepare("SELECT * FROM `earrings` WHERE `unique_key` = :id");
            $fetchImages->execute(array(":id" => $_POST['removeItem']));
            $images = $fetchImages->fetch(PDO::FETCH_ASSOC);
            $images = explode(",", $images['images']);
            $removeItem2 = $pdo->prepare("DELETE FROM `earrings` WHERE `unique_key` = :id");
            $removeItem2->execute(array(":id" => $_POST['removeItem']));
            break;
        }
        case 3: {
            $fetchImages = $pdo->prepare("SELECT * FROM `pendants` WHERE `unique_key` = :id");
            $fetchImages->execute(array(":id" => $_POST['removeItem']));
            $images = $fetchImages->fetch(PDO::FETCH_ASSOC);
            $images = explode(",", $images['images']);
            $removeItem2 = $pdo->prepare("DELETE FROM `pendants` WHERE `unique_key` = :id");
            $removeItem2->execute(array(":id" => $_POST['removeItem']));
            break;
        }
        case 4: {
            $fetchImages = $pdo->prepare("SELECT * FROM `necklaces` WHERE `unique_key` = :id");
            $fetchImages->execute(array(":id" => $_POST['removeItem']));
            $images = $fetchImages->fetch(PDO::FETCH_ASSOC);
            $images = explode(",", $images['images']);
            $removeItem2 = $pdo->prepare("DELETE FROM `necklaces` WHERE `unique_key` = :id");
            $removeItem2->execute(array(":id" => $_POST['removeItem']));
            break;
        }
        case 5: {
            $fetchImages = $pdo->prepare("SELECT * FROM `bracelets` WHERE `unique_key` = :id");
            $fetchImages->execute(array(":id" => $_POST['removeItem']));
            $images = $fetchImages->fetch(PDO::FETCH_ASSOC);
            $images = explode(",", $images['images']);
            $removeItem2 = $pdo->prepare("DELETE FROM `bracelets` WHERE `unique_key` = :id");
            $removeItem2->execute(array(":id" => $_POST['removeItem']));
            break;
        }
    }
    foreach ( $images as $image ) {
        if ( $image !== "") {
            //echo var_dump($image);
            $imageFile = "../../images/images/" . $image;
            $imageMDFile = "../../images/images_md/" . $image;
            $imageSMFile = "../../images/images_sm/" . $image;
            if ( file_exists($imageFile) ) {
                unlink($imageFile);
            }
            if ( file_exists($imageMDFile) ) {
                unlink($imageMDFile);
            }
            if ( file_exists($imageSMFile) ) {
                unlink($imageSMFile);
            }
        }
    } 

} else if ( isset($_POST['editItem']) ) {

    //echo var_dump($_POST);
    if ( $_POST['discount'] > 0 ) {
        $discount = $_POST['discount'];
    } else {
        $discount = 0;
    }
    
    //echo var_dump($_POST);
    //echo var_dump($uniqueKey);

    $_POST['product_price'] = str_replace(",",  ".", $_POST['product_price']);
    $addItem = $pdo->prepare("UPDATE `items` SET `item_name` = :name, `item_value` = :value, `discount` = :discount, `category` = :category WHERE `unique_key` = :key");
    $addItem->execute(array(
        ":key" => $_POST['unique_key'],
        ":name" => $_POST['product_name'],
        ":value" => $_POST['product_price'],
        ":discount" => floatval($_POST['discount']),
        ":category" => $_POST['category']
    ));

    switch ($_POST['category']) {
        case 1: {
            $checkInfo = $pdo->prepare("SELECT * FROM `rings` WHERE `unique_key` = :key");
            break;
        }
        case 2: {
            $checkInfo = $pdo->prepare("SELECT * FROM `earrings` WHERE `unique_key` = :key");
            break;
        }
        case 3: {
            $checkInfo = $pdo->prepare("SELECT * FROM `pendants` WHERE `unique_key` = :key");
            break;
        }
        case 4: {
            $checkInfo = $pdo->prepare("SELECT * FROM `necklaces` WHERE `unique_key` = :key");
            break;
        }
        case 5: {
            $checkInfo = $pdo->prepare("SELECT * FROM `bracelets` WHERE `unique_key` = :key");
            break;
        }
    }
    $checkInfo->execute(array(":key" => $_POST['unique_key']));
    if ( $checkInfo->rowCount() > 0 ) {
        switch ($_POST['category']) {
            case 1: {
                $addInfo = $pdo->prepare("UPDATE `rings` SET `company_id` = :company_id, `internal_id` = :internal_id, `product_name` = :product_name, `pieces_in_stock` = :pieces_in_stock, `days_for_shipment` = :days_for_shipment, `total_carat_weight` = :total_carat_weight, `no_of_stones` = :no_of_stones, `diamond_shape` = :diamond_shape, `clarity` = :clarity, `color` = :color, `material` = :material, `height` = :height, `width` = :width, `length` = :length, `country_id` = :country_id, `description` = :description, `description_french` = :description_french, `gold_quality` = :gold_quality, `color_stone_type` = :color_stone_type, `lab_grown` = :lab_grown, `ring_subcategory` = :ring_subcategory, `ring_size` = :ring_size WHERE `unique_key` = :unique_key");
                $addInfo->execute(array(
                    ":unique_key" => $_POST['unique_key'],
                    ":company_id" => $_POST['company_id'],
                    ":internal_id" => $_POST['internal_id'],
                    ":product_name" => $_POST['product_name'],
                    ":pieces_in_stock" => $_POST['pieces_in_stock'],
                    ":days_for_shipment" => $_POST['days_for_shipment'],
                    ":total_carat_weight" => $_POST['total_carat_weight'],
                    ":no_of_stones" => $_POST['no_of_stones'],
                    ":diamond_shape" => $_POST['diamond_shape'],
                    ":clarity" => $_POST['clarity'],
                    ":color" => $_POST['color'],
                    ":material" => $_POST['material'],
                    ":height" => $_POST['height'],
                    ":width" => $_POST['width'],
                    ":length" => $_POST['length'],
                    ":country_id" => $_POST['country_id'],
                    ":description" => $_POST['description'],
                    ":description_french" => $_POST["description_french"],
                    ":gold_quality" => $_POST['gold_quality'],
                    ":color_stone_type" => $_POST['color_stone_type'],
                    ":lab_grown" => $_POST["lab_grown"],
                    ":ring_subcategory" => $_POST['ring_subcategory'],
                    ":ring_size" => $_POST['ring_size']));
                
                break;
            }
            case 2: {
                $addInfo = $pdo->prepare("UPDATE `earrings` SET `company_id` = :company_id, `internal_id` = :internal_id, `product_name` = :product_name, `pieces_in_stock` = :pieces_in_stock, `days_for_shipment` = :days_for_shipment, `total_carat_weight` = :total_carat_weight, `no_of_stones` = :no_of_stones, `diamond_shape` = :diamond_shape, `clarity` = :clarity, `color` = :color, `material` = :material, `height` = :height, `width` = :width, `length` = :length, `country_id` = :country_id, `description` = :description, `description_french` = :description_french, `gold_quality` = :gold_quality, `color_stone_type` = :color_stone_type, `lab_grown` = :lab_grown, `ring_subcategory` = :ring_subcategory WHERE `unique_key` = :unique_key");
                $addInfo->execute(array(
                    ":unique_key" => $_POST['unique_key'],
                    ":company_id" => $_POST['company_id'],
                    ":internal_id" => $_POST['internal_id'],
                    ":product_name" => $_POST['product_name'],
                    ":pieces_in_stock" => $_POST['pieces_in_stock'],
                    ":days_for_shipment" => $_POST['days_for_shipment'],
                    ":total_carat_weight" => $_POST['total_carat_weight'],
                    ":no_of_stones" => $_POST['no_of_stones'],
                    ":diamond_shape" => $_POST['diamond_shape'],
                    ":clarity" => $_POST['clarity'],
                    ":color" => $_POST['color'],
                    ":material" => $_POST['material'],
                    ":height" => $_POST['height'],
                    ":width" => $_POST['width'],
                    ":length" => $_POST['length'],
                    ":country_id" => $_POST['country_id'],
                    ":description" => $_POST['description'],
                    ":description_french" => $_POST["description_french"],
                    ":gold_quality" => $_POST['gold_quality'],
                    ":color_stone_type" => $_POST['color_stone_type'],
                    ":lab_grown" => $_POST["lab_grown"],
                    ":ring_subcategory" => $_POST['ring_subcategory']));
                break;
            }
            case 3: {
                $addInfo = $pdo->prepare("UPDATE `pendants` SET `company_id` = :company_id, `internal_id` = :internal_id, `product_name` = :product_name, `pieces_in_stock` = :pieces_in_stock, `days_for_shipment` = :days_for_shipment, `total_carat_weight` = :total_carat_weight, `no_of_stones` = :no_of_stones, `diamond_shape` = :diamond_shape, `clarity` = :clarity, `color` = :color, `material` = :material, `height` = :height, `width` = :width, `length` = :length, `country_id` = :country_id, `description` = :description, `description_french` = :description_french, `gold_quality` = :gold_quality, `color_stone_type` = :color_stone_type, `lab_grown` = :lab_grown, `ring_subcategory` = :ring_subcategory WHERE `unique_key` = :unique_key");
                $addInfo->execute(array(
                    ":unique_key" => $_POST['unique_key'],
                    ":company_id" => $_POST['company_id'],
                    ":internal_id" => $_POST['internal_id'],
                    ":product_name" => $_POST['product_name'],
                    ":pieces_in_stock" => $_POST['pieces_in_stock'],
                    ":days_for_shipment" => $_POST['days_for_shipment'],
                    ":total_carat_weight" => $_POST['total_carat_weight'],
                    ":no_of_stones" => $_POST['no_of_stones'],
                    ":diamond_shape" => $_POST['diamond_shape'],
                    ":clarity" => $_POST['clarity'],
                    ":color" => $_POST['color'],
                    ":material" => $_POST['material'],
                    ":height" => $_POST['height'],
                    ":width" => $_POST['width'],
                    ":length" => $_POST['length'],
                    ":country_id" => $_POST['country_id'],
                    ":description" => $_POST['description'],
                    ":description_french" => $_POST["description_french"],
                    ":gold_quality" => $_POST['gold_quality'],
                    ":color_stone_type" => $_POST['color_stone_type'],
                    ":lab_grown" => $_POST["lab_grown"],
                    ":ring_subcategory" => $_POST['ring_subcategory']));
                break;
            }
            case 4: {
                $addInfo = $pdo->prepare("UPDATE `necklaces` SET `company_id` = :company_id, `internal_id` = :internal_id, `product_name` = :product_name, `pieces_in_stock` = :pieces_in_stock, `days_for_shipment` = :days_for_shipment, `total_carat_weight` = :total_carat_weight, `no_of_stones` = :no_of_stones, `diamond_shape` = :diamond_shape, `clarity` = :clarity, `color` = :color, `material` = :material, `height` = :height, `width` = :width, `length` = :length, `country_id` = :country_id, `description` = :description, `description_french` = :description_french, `gold_quality` = :gold_quality, `color_stone_type` = :color_stone_type, `lab_grown` = :lab_grown, `ring_subcategory` = :ring_subcategory WHERE `unique_key` = :unique_key");
                $addInfo->execute(array(
                    ":unique_key" => $_POST['unique_key'],
                    ":company_id" => $_POST['company_id'],
                    ":internal_id" => $_POST['internal_id'],
                    ":product_name" => $_POST['product_name'],
                    ":pieces_in_stock" => $_POST['pieces_in_stock'],
                    ":days_for_shipment" => $_POST['days_for_shipment'],
                    ":total_carat_weight" => $_POST['total_carat_weight'],
                    ":no_of_stones" => $_POST['no_of_stones'],
                    ":diamond_shape" => $_POST['diamond_shape'],
                    ":clarity" => $_POST['clarity'],
                    ":color" => $_POST['color'],
                    ":material" => $_POST['material'],
                    ":height" => $_POST['height'],
                    ":width" => $_POST['width'],
                    ":length" => $_POST['length'],
                    ":country_id" => $_POST['country_id'],
                    ":description" => $_POST['description'],
                    ":description_french" => $_POST["description_french"],
                    ":gold_quality" => $_POST['gold_quality'],
                    ":color_stone_type" => $_POST['color_stone_type'],
                    ":lab_grown" => $_POST["lab_grown"],
                    ":ring_subcategory" => $_POST['ring_subcategory']));
                break;
            }
            case 5: {
                $addInfo = $pdo->prepare("UPDATE `bracelets` SET `company_id` = :company_id, `internal_id` = :internal_id, `product_name` = :product_name, `pieces_in_stock` = :pieces_in_stock, `days_for_shipment` = :days_for_shipment, `total_carat_weight` = :total_carat_weight, `no_of_stones` = :no_of_stones, `diamond_shape` = :diamond_shape, `clarity` = :clarity, `color` = :color, `material` = :material, `height` = :height, `width` = :width, `length` = :length, `country_id` = :country_id, `description` = :description, `description_french` = :description_french, `gold_quality` = :gold_quality, `color_stone_type` = :color_stone_type, `lab_grown` = :lab_grown, `ring_subcategory` = :ring_subcategory WHERE `unique_key` = :unique_key");
                $addInfo->execute(array(
                    ":unique_key" => $_POST['unique_key'],
                    ":company_id" => $_POST['company_id'],
                    ":internal_id" => $_POST['internal_id'],
                    ":product_name" => $_POST['product_name'],
                    ":pieces_in_stock" => $_POST['pieces_in_stock'],
                    ":days_for_shipment" => $_POST['days_for_shipment'],
                    ":total_carat_weight" => $_POST['total_carat_weight'],
                    ":no_of_stones" => $_POST['no_of_stones'],
                    ":diamond_shape" => $_POST['diamond_shape'],
                    ":clarity" => $_POST['clarity'],
                    ":color" => $_POST['color'],
                    ":material" => $_POST['material'],
                    ":height" => $_POST['height'],
                    ":width" => $_POST['width'],
                    ":length" => $_POST['length'],
                    ":country_id" => $_POST['country_id'],
                    ":description" => $_POST['description'],
                    ":description_french" => $_POST["description_french"],
                    ":gold_quality" => $_POST['gold_quality'],
                    ":color_stone_type" => $_POST['color_stone_type'],
                    ":lab_grown" => $_POST["lab_grown"],
                    ":ring_subcategory" => $_POST['ring_subcategory']));
                break;
            }
        }
    } else {
    }
} else if ( isset($_POST['removeAll'])) {
    pconsole($_POST['removeAll']);


    $imagePath = '../../images/images/';
    $imageMDPath = '../../images/images_md/';
    $imageSMPath = '../../images/images_sm/';

    $scr = scandir($imagePath);
    $scrMD = scandir($imageMDPath);
    $scrSM = scandir($imageSMPath);

    switch ($_POST['removeAll']) {
        case 'all':{
            $truncateTable = $pdo->prepare("TRUNCATE TABLE `items`");
            $truncateTable1 = $pdo->prepare("TRUNCATE TABLE `rings`");
            $truncateTable2 = $pdo->prepare("TRUNCATE TABLE `earrings`");
            $truncateTable3 = $pdo->prepare("TRUNCATE TABLE `pendants`");
            $truncateTable4 = $pdo->prepare("TRUNCATE TABLE `necklaces`");
            $truncateTable5 = $pdo->prepare("TRUNCATE TABLE `bracelets`");
            $truncateTable->execute();
            $truncateTable1->execute();
            $truncateTable2->execute();
            $truncateTable3->execute();
            $truncateTable4->execute();
            $truncateTable5->execute();
            foreach ( $scr as $file ) {
                if ( strstr($file, "ring_") || strstr($file, "earring_") || strstr($file, "pendant_") || strstr($file, "necklace_") || strstr($file, "bracelet_")  ) {
                    unlink($imagePath . $file);
                }
            }
            foreach ( $scrMD as $file ) {
                if ( strstr($file, "ring_") || strstr($file, "earring_") || strstr($file, "pendant_") || strstr($file, "necklace_") || strstr($file, "bracelet_")  ) {
                    unlink($imageMDPath . $file);
                }
            }
            foreach ( $scrSM as $file ) {
                if ( strstr($file, "ring_") || strstr($file, "earring_") || strstr($file, "pendant_") || strstr($file, "necklace_") || strstr($file, "bracelet_")  ) {
                    unlink($imageSMPath . $file);
                }
            }
            break;
        } case 'rings':{
            $truncateTable = $pdo->prepare("TRUNCATE TABLE `rings`");
            $truncateTable->execute();
            $removeAll = $pdo->prepare("DELETE FROM `items` WHERE `category` = 1");
            $removeAll->execute();

            foreach ( $scr as $file ) {
                if ( strstr($file, "ring_") && !strstr($file, "earring_") ) {
                    unlink($imagePath . $file);
                }
            }
            foreach ( $scrMD as $file ) {
                if ( strstr($file, "ring_") && !strstr($file, "earring_") ) {
                    unlink($imageMDPath . $file);
                }
            }
            foreach ( $scrSM as $file ) {
                if ( strstr($file, "ring_") && !strstr($file, "earring_") ) {
                    unlink($imageSMPath . $file);
                }
            }

            break;
        } case 'earrings':{
            $truncateTable = $pdo->prepare("TRUNCATE TABLE `earrings`");
            $removeAll = $pdo->prepare("DELETE FROM `items` WHERE `category` = 2");
            $removeAll->execute();

            foreach ( $scr as $file ) {
                if ( strstr($file, "earring_") ) {
                    unlink($imagePath . $file);
                }
            }
            foreach ( $scrMD as $file ) {
                if ( strstr($file, "earring_") ) {
                    unlink($imageMDPath . $file);
                }
            }
            foreach ( $scrSM as $file ) {
                if ( strstr($file, "earring_") ) {
                    unlink($imageSMPath . $file);
                }
            }

            break;
        } case 'pendants':{
            $truncateTable = $pdo->prepare("TRUNCATE TABLE `pendants`");
            $removeAll = $pdo->prepare("DELETE FROM `items` WHERE `category` = 3");
            $removeAll->execute();

            foreach ( $scr as $file ) {
                if ( strstr($file, "pendant_") ) {
                    unlink($imagePath . $file);
                }
            }
            foreach ( $scrMD as $file ) {
                if ( strstr($file, "pendant_") ) {
                    unlink($imageMDPath . $file);
                }
            }
            foreach ( $scrSM as $file ) {
                if ( strstr($file, "pendant_") ) {
                    unlink($imageSMPath . $file);
                }
            }

            break;
        } case 'necklaces':{
            $truncateTable = $pdo->prepare("TRUNCATE TABLE `necklaces`");
            $removeAll = $pdo->prepare("DELETE FROM `items` WHERE `category` = 4");
            $removeAll->execute();

            foreach ( $scr as $file ) {
                if ( strstr($file, "necklace_") ) {
                    unlink($imagePath . $file);
                }
            }
            foreach ( $scrMD as $file ) {
                if ( strstr($file, "necklace_") ) {
                    unlink($imageMDPath . $file);
                }
            }
            foreach ( $scrSM as $file ) {
                if ( strstr($file, "necklace_") ) {
                    unlink($imageSMPath . $file);
                }
            }

            break;
        } case 'bracelets':{
            $truncateTable = $pdo->prepare("TRUNCATE TABLE `bracelets`");
            $removeAll = $pdo->prepare("DELETE FROM `items` WHERE `category` = 5");
            $removeAll->execute();

            foreach ( $scr as $file ) {
                if ( strstr($file, "bracelet_") ) {
                    unlink($imagePath . $file);
                }
            }
            foreach ( $scrMD as $file ) {
                if ( strstr($file, "bracelet_") ) {
                    unlink($imageMDPath . $file);
                }
            }
            foreach ( $scrSM as $file ) {
                if ( strstr($file, "bracelet_") ) {
                    unlink($imageSMPath . $file);
                }
            }

            break;
        } 
    }
} else if ( isset($_POST['deleteImage']) ) {
    pconsole($_POST);

    $getCategory = $pdo->prepare("SELECT * FROM `items` WHERE `unique_key` = :key");
    $getCategory->execute(array(":key" => $_POST['unique_key']));

    if ( $getCategory->rowCount() > 0 ) {
        $itemInfo = $getCategory->fetch(PDO::FETCH_ASSOC);
        $getImages = $pdo->prepare("SELECT * FROM ". getCategory($itemInfo['category'], $pdo) ." WHERE `unique_key` = :key");
        $getImages->execute(array(":key" => $_POST['unique_key']));

        if ( $getImages->rowCount() > 0 ) {
            $itemInfo2 = $getImages->fetch(PDO::FETCH_ASSOC);

            $imagesUpdated = str_replace($_POST['deleteImage'] . ",", "", $itemInfo2['images']);

            $updateImages = $pdo->prepare("UPDATE ". getCategory($itemInfo['category'], $pdo) ." SET `images` = :newIMG WHERE `unique_key` = :key");
            $updateImages->execute(array(":newIMG" => $imagesUpdated, ":key" => $_POST['unique_key']));

            if ( file_exists("./../../images/images/" . $_POST['deleteImage']) ) {
                unlink("./../../images/images/" . $_POST['deleteImage']);
            }
            if ( file_exists("./../../images/images_md/" . $_POST['deleteImage']) ) {
                unlink("./../../images/images_md/" . $_POST['deleteImage']);
            }
            if ( file_exists("./../../images/images_sm/" . $_POST['deleteImage']) ) {
                unlink("./../../images/images_sm/" . $_POST['deleteImage']);
            }
        }
    }
} else if ( isset($_POST['addNewImages']) ) {
    pconsole($_POST);
    pconsole($_FILES);

}

?>
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>All Items - Admin Panel</title>
    <!-- Bootstrap -->
    <link href="../../css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <!-- Datatables -->
    <link href="../assets/datatables/javascripts/datatables.net-bs/css/dataTables.bootstrap.min.css" rel="stylesheet">
    <link href="../assets/datatables/javascripts/datatables.net-buttons-bs/css/buttons.bootstrap.min.css" rel="stylesheet">
    <link href="../assets/datatables/javascripts/datatables.net-fixedheader-bs/css/fixedHeader.bootstrap.min.css" rel="stylesheet">
    <link href="../assets/datatables/javascripts/datatables.net-responsive-bs/css/responsive.bootstrap.min.css" rel="stylesheet">
    <link href="../assets/datatables/javascripts/datatables.net-scroller-bs/css/scroller.bootstrap.min.css" rel="stylesheet">
    <!-- Custom Theme Style -->
    <link href="../assets/custom.min.css" rel="stylesheet">
    <link href="../assets/font-awesome.min.css" rel="stylesheet">
    <link href="../assets/admin.css" rel="stylesheet">
    <link rel="icon" href="../../images/gfx/favicon.png?v=1" type="image/png" sizes="16x16">
  </head>

<body class="nav-md">
    <div class="container body">
      <div class="main_container" style="background: #607d8b;">
        <!-- sidebar -->
        <div class="col-md-3 left_col">
          <?php include 'sidebar.php'; ?>
        </div>
        <!-- /sidebar -->
        <!-- top navigation -->
        <div class="top_nav">
          <?php include 'navbar.php'; ?>
        </div>
        <!-- /top navigation -->

        <!-- page content -->
        <div class="right_col" role="main">
        <div>
        
        <h3>
        <?php

            $fetchAllSites = $pdo->prepare("SELECT * FROM tb_websites");
            $fetchAllSites->execute();

            $allSites = "";

            if ( $fetchAllSites->rowCount() > 0 ) {

                foreach ( $fetchAllSites->fetchAll() as $siteOption ) {
                    $allSites = "";
                }
            }

            echo '<div class="btn-group">
                  <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    All Products <span class="caret"></span>
                  </button>
                  <ul class="dropdown-menu">
                    <li><a href="./all_items.php">All Products</a></li>
                    <li role="separator" class="divider"></li>
                    <li><a href="./rings.php">Rings</a></li>
                    <li><a href="./earrings.php">Earrings</a></li>
                    <li><a href="./pendants.php">Pendants</a></li>
                    <li><a href="./necklaces.php">Necklaces</a></li>
                    <li><a href="./bracelets.php">Braclets</a></li>
                  </ul>
                </div> <span style="font-size: 11px;">for</span> 
                <div class="btn-group">
                  <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    All Sites <span class="caret"></span>
                  </button>
                  <ul class="dropdown-menu">
                    <li><a href="?site=all">All Sites</a></li>
                    
                  </ul>
                </div>';

            $count = $pdo->prepare("SELECT COUNT(*) AS totalRows FROM `items`");
            $count->execute();
            $totalRows = $count->fetch(PDO::FETCH_ASSOC);
            $totalRows = $totalRows['totalRows'];
            pconsole($totalRows);
            $perPage = 25;
            $pages = $totalRows/$perPage;
            if ( isset($_GET['page']) ) {
                $currentPage = $_GET['page'];
            } else {
                $currentPage = 0;
            }

            if ( isset($_GET['filter']) && isset($_GET['order']) ) {
                $filter = $_GET['filter'];
                $currentOrder = $_GET['order'];
                if ( $_GET['order'] == "DESC" ) {
                    $order = "ASC";
                } else {
                    $order = "DESC";
                }

            } else {
                $filter = "id";
                $order = "ASC";
                $currentOrder = "DESC";
            }
            if ( isset($_GET['page']) ) {
                $offset = $_GET['page'] * $perPage;
            } else {
                $offset = 0;
            }

            pconsole($offset);

            $allowedFeatured = 20;


            $countFeatured = $pdo->prepare("SELECT COUNT(`featured`) AS featuredItems FROM `items` WHERE `featured` = 1");
            $countFeatured->execute();

            if ( $countFeatured->rowCount() > 0 ){
                $countFeatured = $countFeatured->fetch(PDO::FETCH_ASSOC);
                if ( $countFeatured['featuredItems'] > $allowedFeatured ) {
                    echo '<div class="alert alert-error" style="font-size: 15px; color: white; text-align: center; position: absolute; top: 5px; margin-left: 200px;">Note: Only the Latest '. $allowedFeatured .' Items are displayed in the Featured Panel, Sorted by Date.<br><br> You have '. $countFeatured['featuredItems'] .' Items Selected as Featured</div>';
                }
            }


            echo '<h3><small>' . $totalRows . ' Items Found</small>
                        <form method="post" id="bulkManage" style="float:right; padding: 0 10px;" action="post.php">
                        <a class="btn btn-danger" style="font-size: 11px;" onClick="bulkDisable()" >Disable (<span class="selected-num">0</span>)</a>
                        <a class="btn btn-success" style="font-size: 11px;" onClick="bulkEnable()" >Enable (<span class="selected-num">0</span>)</a>
                        <a class="btn btn-info" style="font-size: 11px;" onClick="bulkAccessManagement()" >Manage Access (<span class="selected-num">0</span>)</a>
                        <button class="btn btn-warning" name="bulkManage" value="feature" style="font-size: 11px;">Add to Featured (<span class="selected-num">0</span>)</button>
                        <button class="btn btn-default" name="bulkManage" value="unfeature" style="font-size: 11px;">Remove from Featured (<span class="selected-num">0</span>)</button>
                        <a class="btn btn-danger" onclick="bulkRemoveItems()" style="font-size: 11px;">Delete Selected (<span class="selected-num">0</span>)</a>
                        <div class="btn-group" style="display: block; vertical-align: middle; float: right;">
                          <button type="button" class="btn btn-danger dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="font-size: 11px;">
                            Delete <span class="caret"></span>
                          </button>
                          <ul class="dropdown-menu" style="left: -84px;">
                            <li><a href="javascript:void(0);" onClick="removeAll(this)" name="all">All</a></li>
                            <li role="separator" class="divider"></li>
                            <li><a href="javascript:void(0);" onClick="removeAll(this)" name="rings">Rings</a></li>
                            <li><a href="javascript:void(0);" onClick="removeAll(this)" name="earrings">Earrings</a></li>
                            <li><a href="javascript:void(0);" onClick="removeAll(this)" name="pendants">Pendants</a></li>
                            <li><a href="javascript:void(0);" onClick="removeAll(this)" name="necklaces">Necklaces</a></li>
                            <li><a href="javascript:void(0);" onClick="removeAll(this)" name="bracelets">Bracelets</a></li>
                          </ul>
                        </div>
                    </form>
                </h3>';
            ?></h3>

            <div>

            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x-panel">
                    <table id="itemsTable" class="table table-striped table-bordered bulk_action table-custom table-custom-items">
                        <thead>
                            <th><input id="masterCheckbox" type="checkbox" onClick="selectAll(this)"></th>
                            <th>Type</th>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Images</th>
                            <th>Disabled <i class="fa fa-info-circle" data-toggle="tooltip" title="Disabled Items do not appear on the front end in any website"></i></th>
                            <th>Site Access <i class="fa fa-info-circle" data-toggle="tooltip" title="Manage websites who can access this product"></i></th>
                            <th>Featured</th>
                            <th>Action</th>
                            <th>Internal ID</th>
                            <th>Supplier</th>
                            <th>Price</th>
                            <th>Discount</th>
                            <th>Stock</th>
                            <th>Shipment Days</th>
                            <th>Gold Weight</th>
                            <th>Carat Weight</th>
                            <th>Color Stone Weight</th>
                            <th># of Stones</th>
                            <th># of Color Stones</th>
                            <th>Diamond Shape</th>
                            <th>Color Stone Shape</th>
                            <th>Clarity</th>
                            <th>Color</th>
                            <th>Material</th>
                            <th>Gold Quality</th>
                            <th>Color Stone Type</th>
                            <th>Height</th>
                            <th>Weight</th>
                            <th>Length</th>
                            <th>Country</th>
                            <th>Ring Size</th>
                            <th>Ring Subcategory</th>
                            <th>Lab Grown</th>
                            <th>Description</th>
                            <th>Added On</th>
                        </thead>
                        <tbody>
                            <?php 
                                $query = $pdo->prepare("SELECT * FROM `items` ORDER BY ". $filter . " " . $currentOrder);
                                $query->execute(array(":first" => 10));

                                if ( $query->rowCount() > 0 ) {
                                    foreach( $query->fetchAll() as $entry ) {

                                        switch ($entry['category']) {
                                            case 1: {
                                                $getInfo = $pdo->prepare("SELECT * FROM `rings` WHERE `unique_key` = :key");
                                                break;
                                            }
                                            case 2: {
                                                $getInfo = $pdo->prepare("SELECT * FROM `earrings` WHERE `unique_key` = :key");
                                                break;
                                            }
                                            case 3: {
                                                $getInfo = $pdo->prepare("SELECT * FROM `pendants` WHERE `unique_key` = :key");
                                                break;
                                            }
                                            case 4: {
                                                $getInfo = $pdo->prepare("SELECT * FROM `necklaces` WHERE `unique_key` = :key");
                                                break;
                                            }
                                            case 5: {
                                                $getInfo = $pdo->prepare("SELECT * FROM `bracelets` WHERE `unique_key` = :key");
                                                break;
                                            }
                                        }
                                        $getInfo->execute(array(":key" => $entry['unique_key']));
                                        $info = $getInfo->fetch(PDO::FETCH_ASSOC);

                                        $price = '€'.$entry['item_value'];

                                        if ( $entry['discount'] > 0 ) {
                                            $discounted = $entry['item_value'] - (( $entry['discount'] / 100) * $entry['item_value']);
                                            $price = '<div style="display:block" ><small class="old-price">€' . $entry['item_value'] . '</small> <span class="glyphicon glyphicon-chevron-right"></span> €' . round($discounted, 2) .'</div>';
                                        }

                                        $color = ($info['color'] == 1 ) ? "White Stone" : "Colored Stone";
                                        echo '<tr>';
                                            echo '<td><input class="select-checkbox" type="checkbox" form="bulkManage" name="'. $entry['unique_key'] .'" onclick="selectItem(this)"></td>';
                                            
                                            echo '<td style="text-transform:capitalize">'. trim(getCategory($entry['category'], $pdo), "s") .'</td>';
                                            echo '<td>'. $entry['id'] .'</td>';
                                            echo '<td>'. $info['product_name'] .'</td>';

                                            $firstImage = $__MAINDOMAIN__ .'images/images_sm/'. explode(",", $info['images'])[0];
                                            if ( empty($info['images']) ) {
                                                $firstImage = $__MAINDOMAIN__ . 'images/images_sm/0.png';
                                            }
                                            echo '<td><img style="max-width: 150px; cursor: pointer; border: solid thin #ddd;" onClick="manageImages(\''. $info['unique_key'] .'\')" src="'. $firstImage .'" /></td>';

                                            if ( $entry['disabled'] == 1 ) {
                                                $disabled = "<form action='post.php' method='post'><button name='enableItem' value='". $entry['unique_key'] ."' class='btn btn-success btn-sm' data-toggle='tooltip' title='Enable Product Display in FrontEnd'>Enable</button></form>";
                                            } else {
                                                $disabled = "<form action='post.php' method='post'><button name='disableItem' value='". $entry['unique_key'] ."' class='btn btn-danger btn-sm' data-toggle='tooltip' title='Disable Product Display in FrontEnd'>Disable</button></form>";
                                            }

                                            echo '<td>'. $disabled .'</td>';

                                            echo '<td><button class="btn btn-info btn-sm" onclick="manageSiteAccess(\''. $entry['unique_key'] .'\')">Manage</button></td>';

                                            if ( $entry['featured'] == 1 ) {
                                                $featured = '<form method="post"><button class="glyphicon glyphicon-star glyphicon-custom" name="featuredRemove" value="'. $entry['unique_key'] .'" data-toggle="tooltip" title="Remove from Featured"></button></form>';
                                            } else {
                                                $featured = '<form method="post"><button class="glyphicon glyphicon-star-empty glyphicon-custom" name="featuredAdd" value="'. $entry['unique_key'] .'" data-toggle="tooltip" title="Add to Featured"></button></form>';
                                            }

                                            echo '<td style="text-align:center;">'. $featured .'</td>';

                                            $editModal = '<button class="fa fa-pencil glyphicon-custom" style="color:#607d8b" title="Edit Item" data-toggle="tooltip"
                                            onClick="editItem(\''. $entry['unique_key'] .'\')"></button>';

                                            $removeModal = '<button class="fa fa-trash glyphicon-custom" style="color:#607d8b" title="Remove Item" data-toggle="tooltip" onclick="removeItem(\''. $entry['unique_key'] .'\', \''. $entry['item_name'] .'\')"></button>';
                                            echo '<td>' . $editModal . $removeModal . '</td>';

                                            echo '<td>'. $info['internal_id'] .'</td>';
                                            echo '<td>'. getCompany($info['company_id'], $pdo) .'</td>';
                                            echo '<td>'. $price .'</td>';
                                            echo '<td>'. $entry['discount'] .'%</td>';
                                            echo '<td>'. $info['pieces_in_stock'] .'</td>';
                                            echo '<td>'. $info['days_for_shipment'] .'</td>';
                                            echo '<td>'. $info['total_gold_weight'] .'</td>';
                                            echo '<td>'. $info['total_carat_weight'] .'</td>';
                                            echo '<td>'. $info['color_stone_carat'] .'</td>';
                                            echo '<td>'. $info['no_of_stones'] .'</td>';
                                            echo '<td>'. $info['no_of_color_stones'] .'</td>';
                                            echo '<td>'. getDiamondShape($info['diamond_shape'], $pdo) .'</td>';
                                            echo '<td>'. getDiamondShape($info['color_stone_shape'], $pdo) .'</td>';
                                            echo '<td>'. $info['clarity'] .'</td>';
                                            echo '<td>'. $color .'</td>';
                                            echo '<td>'. getMaterial($info['material'], $pdo) .'</td>';
                                            echo '<td>'. $info['gold_quality'] .'</td>';
                                            echo '<td>'. $info['color_stone_type'] .'</td>';
                                            echo '<td>'. $info['height'] .'</td>';
                                            echo '<td>'. $info['width'] .'</td>';
                                            echo '<td>'. $info['length'] .'</td>';
                                            echo '<td>'. getCountry($info['country_id'], $pdo) .'</td>';
                                            echo '<td>'. $info['ring_size'] .'</td>';
                                            echo '<td>'. getRingCategory($info['ring_subcategory'], $pdo) .'</td>';
                                            $labGrown = "<i class='fa fa-times' style='color:crimson'></i>";
                                            if ( $info['lab_grown'] == 1 ) {
                                                $labGrown = "<i class='fa fa-check' style='color:green'></i>";
                                            } 
                                            echo '<td>'. $labGrown .'</td>';

                                            //echo '<td><button class="btn btn-custom btn-sm" onClick="manageImages(\''. $info['unique_key'] .'\')">'. intval(sizeof(explode(",", $info['images'])) - 1) .' image(s)</button></td>';
                                            echo '<td>'. $info['description'] .'</td>';
                                            echo '<td>'. $entry['date_added'] .'</td>';


                                        echo '</tr>';
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
        <!-- /page content -->

        <!-- footer content -->
        <footer style="margin-top:-20px;">
          <?php include 'footer.php'; ?>
        </footer>
        <!-- /footer content -->

<style type="text/css">
    .form-label {
        text-align: right;
        font-size: 14px;
        font-variant: small-caps;
    }
    .table-item-label {
        width: 20%;
    }
    .table-item {
        margin: 5px 10px 15px;
    }
    .table-row {
        margin: 10px;
    }
    .form-control:invalid {
        background-color: #FFCDD2;
    }
    .form-control:valid {
        background-color: #DCEDC8;
    }
    </style>


        <!-- Modal -->
        <div id="promptManageImages" class="modal fade" role="dialog">
          <div class="modal-dialog">
        
            <!-- Modal content-->
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Manage Images</h4>
              </div>
              <div class="modal-body">
                <div id="manageImageDiv" class="container">
                    
                </div>
                <!--<div class="container">
                    <fieldset>
                        <legend>Add New Images</legend>
                        <form method="post" enctype="multipart/form-data">
                            <input type="file" name="addImageTo">
                            <input type="text" class="form-control" name="addURLTo" style="margin:5px;" placeholder="Place image URL here (Seperate with comma (,) )">
                            <button class="btn btn-custom" style="float:right;" id="addNewImagesID" name="addNewImages" >Add Image</button>
                        </form>
                    </fieldset>
                </div>-->
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-custom" data-dismiss="modal">Close</button>
              </div>
            </div>
          </div>
        </div>


        <!-- Modal -->
        <div id="promptDeleteImage" class="modal fade" role="dialog">
          <div class="modal-dialog">
        
            <!-- Modal content-->
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Caution</h4>
              </div>
              <form method="post" enctype="multipart/form-data">
              <input id="deleteImagekey" name="unique_key" hidden>
              <div class="modal-body">
                <div class="container" style="text-align:center;">
                    <img id="imageToDelete" src="" style="max-height:35vh;" />
                    <h4>You are about to permanently delete this image
                    <br>Are you sure you want to perform this action?</h4>
                    <br>
                    <h5><div class="alert alert-error">Warning: This action can not be undone.</div></h5>
                </div>
              </div>
              <div class="modal-footer">
                <button id="imageToDeleteID" type="submit" class="btn btn-custom" name="deleteImage" value="">Delete</button>
                <button type="button" class="btn btn-custom" data-dismiss="modal">Close</button>
              </div>
              </form>
            </div>
          </div>
        </div>

        <!-- Modal -->
        <div id="promptRemoveModal" class="modal fade" role="dialog">
          <div class="modal-dialog">
        
            <!-- Modal content-->
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Caution</h4>
              </div>
              <form method="post" enctype="multipart/form-data">
              <input id="remove_category" name="category" hidden>
              <div class="modal-body">
                <div class="container">
                    <h4>You are about to permanently delete <strong id="itemToRemove">This</strong>
                    <br>Are you sure you want to perform this action?</h4>
                    <br>
                    <h5><div class="alert alert-error">Warning: This action can not be undone.</div></h5>
                </div>
              </div>
              <div class="modal-footer">
                <button id="removeModalActionButton" type="submit" class="btn btn-custom" name="removeItem" value="">Remove</button>
                <button type="button" class="btn btn-custom" data-dismiss="modal">Close</button>
              </div>
              </form>
            </div>
          </div>
        </div>

        <div id="promptBulkRemoveModal" class="modal fade" role="dialog">
          <div class="modal-dialog">
        
            <!-- Modal content-->
            <div class="modal-content"> <!-- Bulk Delete Modal -->
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button> <!-- Bulk Delete Modal -->
                <h4 class="modal-title">Caution</h4> <!-- Bulk Delete Modal -->
              </div>
              <input id="remove_category" name="category" hidden>
              <div class="modal-body"> <!-- Bulk Delete Modal -->
                <div class="container">
                    <h4>You are about to permanently delete <strong id="itemsToRemove">This</strong>
                    <br>Are you sure you want to perform this action?</h4> <!-- Bulk Delete Modal -->
                    <br>
                    <h5><div class="alert alert-error">Warning: This action can not be undone.</div></h5> <!-- Bulk Delete Modal -->
                </div>
              </div> <!-- Bulk Delete Modal -->
              <div class="modal-footer">
                <input id="removeModalActionButton" type="submit" class="btn btn-custom" name="bulkManage" value="delete" form="bulkManage" />
                <button type="button" class="btn btn-custom" data-dismiss="modal">Close</button>
              </div>
            </div>
          </div>
        </div>


        <div id="promptRemoveAll" class="modal fade" role="dialog">
          <div class="modal-dialog">
        
            <!-- Modal content-->
            <div class="modal-content"> <!-- Bulk Delete Modal -->
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button> <!-- Bulk Delete Modal -->
                <h4 class="modal-title">Caution</h4> <!-- Bulk Delete Modal -->
              </div>
              <input id="remove_category" name="category" hidden>
              <div class="modal-body"> <!-- Bulk Delete Modal -->
                <div class="container">
                    <h4>You are about to permanently delete <strong id="categoryToRemove" style="text-transform:capitalize;">This</strong>
                    <br>Are you sure you want to perform this action?</h4> <!-- Bulk Delete Modal -->
                    <br>
                    <h5><div class="alert alert-error">Warning: This action can not be undone.</div></h5> <!-- Bulk Delete Modal -->
                </div>
              </div> <!-- Bulk Delete Modal -->
              <form method="post">
              <div class="modal-footer">
                <input id="removeAll" name="removeAll" value="" hidden="" />
                <input type="submit" class="btn btn-custom"  />
                <button type="button" class="btn btn-custom" data-dismiss="modal">Close</button>
              </div>
              </form>
            </div>
          </div>
        </div>


        <div id="promptEditItem" class="modal fade" role="dialog">
          <div class="modal-dialog modal-lg">

            <!-- Modal content-->
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title"><span id="item_to_edit">Edit</span></h4>
              </div>
              <form method="post">
              <div class="modal-body">
                <div class="container">
                    <div class="col-sm-12">
                        <tbody>

                            <tr>
                                <td><span class="table-item-label" style="display:none;">Category</span></td>
                                <td>
                                    <div class="table-item">
                                        <select id="edit_category" name="category" class="select-style" hidden>
                                            <option value="">Category</option>
                                            <option value="1">Ring</option>
                                            <option value="2">Earring</option>
                                            <option value="3">Pendant</option>
                                            <option value="4">Necklace</option>
                                            <option value="5">Bracelet</option>
                                        </select>
                                    </div>
                                </td>
                            </tr>
                            <tr class="table-row">
                                <td class="table-item-label"><span class="table-item-label">Name</span></td>
                                <td>
                                    <div class="table-item">
                                        <input id="edit_product_name" name="product_name" type="text" class="form-control" placeholder="Product Name (50 Characters)" required maxlength="50" pattern=".{0,50}" >
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td><span class="table-item-label">Price</span></td>
                                <td>
                                    <div class="table-item">
                                        <input id="edit_product_price" name="product_price" type="text" class="form-control" placeholder="Product Price € (Decimal Number)" required pattern="[0-9]{1,}[.,]{1}[0-9]{2,2}" title="Format: 100.00">
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td><span class="table-item-label">Discount</span></td>
                                <td>
                                    <div class="table-item">
                                        <input id="edit_discount" name="discount" type="text" class="form-control" placeholder="Discount % (Number)" pattern="[0-9]{1,2}" title="0 - 99%">
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td><span class="table-item-label">Pieces in Stock</span></td>
                                <td>
                                    <div class="table-item">
                                        <input id="edit_pieces_in_stock" name="pieces_in_stock" type="text" class="form-control" placeholder="Stock (Number)" required>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td><span class="table-item-label">Days for Shipment</span></td>
                                <td>
                                    <div class="table-item">
                                        <input id="edit_days_for_shipment" name="days_for_shipment" type="text" class="form-control" placeholder="Shipment (Number)" required>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td><span class="table-item-label">Total Carat Weight</span></td>
                                <td>
                                    <div class="table-item">
                                        <input id="edit_total_carat_weight" name="total_carat_weight" type="text" class="form-control" placeholder="Total Carat (Decimal Number)">
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td><span class="table-item-label">Number of Stones</span></td>
                                <td>
                                    <div class="table-item">
                                        <input id="edit_no_of_stones" name="no_of_stones" type="text" class="form-control" placeholder="Stones (Number)">
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td><span class="table-item-label">Diamond Shape</span></td>
                                <td>
                                    <div class="table-item">
                                        <select id="edit_diamond_shape" name="diamond_shape" class="select-style" required>
                                            <option value="">Select</option>
                                            <option value="1">Round</option>
                                            <option value="2">Marquise</option>
                                            <option value="3">Princess</option>
                                            <option value="4">Pear</option>
                                            <option value="5">Emerald</option>
                                            <option value="6">Heart</option>
                                            <option value="7">Oval</option>
                                            <option value="8">Cushion</option>
                                            <option value="9">Radiant</option>
                                            <option value="10">Cus. Brilliant</option>
                                            <option value="11">LRadiant</option>
                                            <option value="12">SQEmerald</option>
                                        </select>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td><span class="table-item-label">Clarity</span></td>
                                <td>
                                    <div class="table-item">
                                        <select id="edit_clarity" name="clarity" class="select-style" required>
                                            <option value="">Select</option>
                                            <option value="FL">FL</option>
                                            <option value="IF">IF</option>
                                            <option value="VVS1">VVS1</option>
                                            <option value="VVS2">VVS2</option>
                                            <option value="VS1">VS1</option>
                                            <option value="VS2">VS2</option>
                                            <option value="SI1">SI1</option>
                                            <option value="SI2">SI2</option>
                                            <option value="SI3">SI3</option>
                                            <option value="I1">I1</option>
                                        </select>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td><span class="table-item-label">Color</span></td>
                                <td>
                                    <div class="table-item">
                                        <select id="edit_color" name="color" class="select-style" required>
                                            <option value="">Select</option>
                                            <?php 
                                            $fetchAvailableColors = $pdo->prepare("SELECT * FROM color");
                                            $fetchAvailableColors->execute();
                                            if ( $fetchAvailableColors->rowCount() > 0) {
                                                foreach ( $fetchAvailableColors->fetchAll() as $availableColors ) {
                                                    echo '<option value="'. $availableColors["id"] .'">'. $availableColors["color"] .'</option>';
                                                }
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td><span class="table-item-label">Material</span></td>
                                <td>
                                    <div class="table-item">
                                        <select id="edit_material" name="material" class="select-style" required>
                                            <option value="">Select</option>..
                                            <option value="1">Yellow Gold</option>
                                            <option value="2">White Gold</option>
                                            <option value="3">Pink Gold</option>
                                            <option value="4">Silver</option>
                                            <option value="5">Platinum</option>
                                        </select>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td><span class="table-item-label">Gold Quality</span></td>
                                <td>
                                    <div class="table-item">
                                        <input id="edit_gold_quality" name="gold_quality" type="text" class="form-control" placeholder="Gold Quality">
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td><span class="table-item-label">Color Stone Type</span></td>
                                <td>
                                    <div class="table-item">
                                        <input id="edit_color_stone_type" name="color_stone_type" type="text" class="form-control" placeholder="Color Stone Type">
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td><span class="table-item-label">Height</span></td>
                                <td>
                                    <div class="table-item">
                                        <input id="edit_height" name="height" type="text" class="form-control" placeholder="Height (Number)">
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td><span class="table-item-label">Width</span></td>
                                <td>
                                    <div class="table-item">
                                        <input id="edit_width" name="width" type="text" class="form-control" placeholder="Width (Number)">
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td> <span class="table-item-label">Length</span></td>
                                <td>
                                    <div class="table-item">
                                        <input id="edit_length" name="length" type="text" class="form-control" placeholder="Length (Number)">
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td> <span class="table-item-label">Country</span></td>
                                <td>
                                    <div class="table-item">
                                        <select id="edit_country_id" name="country_id" class="select-style" required>
                                            <option value="">Select</option>
                                            <option value="1">Austria</option>
                                            <option value="2">Belgium</option>
                                            <option value="3">Bulgaria</option>
                                            <option value="4">Croatia</option>
                                            <option value="5">Cyprus</option>
                                            <option value="6">Czech Republic</option>
                                            <option value="7">Denmark</option>
                                            <option value="8">Estonia</option>
                                            <option value="9">Finland</option>
                                            <option value="10">France</option>
                                            <option value="11">Germany</option>
                                            <option value="12">Greece</option>
                                            <option value="13">Hungary</option>
                                            <option value="14">Ireland</option>
                                            <option value="15">Italy</option>
                                            <option value="16">Latvia</option>
                                            <option value="17">Lithuania</option>
                                            <option value="18">Luxembourg</option>
                                            <option value="19">Malta</option>
                                            <option value="20">Netherlands</option>
                                            <option value="21">Poland</option>
                                            <option value="22">Portugal</option>
                                            <option value="23">Romania</option>
                                            <option value="24">Slovakia</option>
                                            <option value="25">Slovenia</option>
                                            <option value="26">Spain</option>
                                            <option value="27">Sweden</option>
                                            <option value="28">UK</option>
                                        </select>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                Company
                                <td>
                                    <div class="table-item">
                                        <select id="edit_company_id" name="company_id" class="select-style" required>
                                            <option value="">Select</option>
                                            <?php 
                                            $getCompanies = $pdo->prepare("SELECT * FROM `company_id`");
                                            $getCompanies->execute();

                                            if ( $getCompanies->rowCount() > 0 ) {
                                                foreach ( $getCompanies as $company ) {
                                                    echo '<option value="'. $company['id'] .'" >'. $company['company_name'] .'</option>';
                                                }
                                            } else {
                                                echo '<option value="0">N/A</option>';
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td> <span class="table-item-label">Internal ID</span></td>
                                <td>
                                    <div class="table-item">
                                        <input id="edit_internal_id" name="internal_id" type="text" class="form-control" placeholder="Internal ID (Mixed Characters)" required>
                                    </div>
                                </td>
                            </tr>
                            <div id="ringExclusiveEditDiv">
                            <tr>
                                <td> <span class="table-item-label">Ring Size</span></td>
                                <td>
                                    <div class="table-item">
                                        <input id="edit_ring_size" name="ring_size" type="text" class="form-control" placeholder="Ring Size (Number)">
                                    </div>
                                </td>
                            </tr>
                            </div>
                            <tr>
                                <td> <span class="table-item-label">Ring Subcategory</span> </td>
                                <td>
                                    <div class="table-item">
                                        
                                        <select id="edit_ring_subcategory" name="ring_subcategory" class="select-style">
                                        </select>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td> <span class="table-item-label">Lab Grown Diamond</span> </td>
                                <td>
                                    <div class="table-item">
                                        <input type="radio" name="lab_grown" required id="edit_lab_grown" value="1">Yes<br>
                                        <input type="radio" name="lab_grown" required id="edit_lab_grown" value="0">No
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <span class="table-item-label">Description</span>
                                </td>
                                <td>
                                    <div class="table-item">
                                        <textarea id="edit_description" name="description" class="form-control" style="width:100%" placeholder="Description Goes Here (250 Characters)"  maxlength="250"></textarea>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <span class="table-item-label">Description (French)</span>
                                </td>
                                <td>
                                    <div class="table-item">
                                        <textarea id="edit_description_french" name="description_french" class="form-control" style="width:100%" placeholder="Description Goes Here (250 Characters)"  maxlength="250"></textarea>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </div>  
                </div>
              </div>
              <div class="modal-footer">
                <input id="unique_key" name="unique_key" hidden/>
                <button type="submit" class="btn btn-custom" name="editItem" id="editItem" >Submit</button>
                <button type="button" class="btn btn-custom" data-dismiss="modal">Close</button>
              </div>
              </form>
            </div>
          </div>
        </div>

        <div id="promptSiteManagement" class="modal fade" role="dialog">
          <div class="modal-dialog">
        
            <!-- Modal content-->
            <div class="modal-content"> <!-- Bulk Delete Modal -->
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button> <!-- Bulk Delete Modal -->
                <h4 class="modal-title">Manage Access</h4> <!-- Bulk Delete Modal -->
              </div>
              <input id="remove_category" name="category" hidden>
              <div class="modal-body"> <!-- Bulk Delete Modal -->
                <div class="container">
                    <h4 style="border-bottom: solid thin #ddd; padding-bottom: 10px; margin: 10px 5%;"><span id="manageAccessItem"></span> </h4>
                    <form id="manageAccessForm" action="post.php" method="post">
                        <input name="unique_key" value="" hidden />
                        <table class="table table-condensed table-custom">
                            <thead>
                                <th>Domain Name</th>
                                <th>Access</th>
                            </thead>
                            <tbody>
                                <?php 
                                $getSites = $pdo->prepare("SELECT * FROM tb_websites");
                                $getSites->execute();

                                if ( $getSites->rowCount() > 0 ) {
                                    foreach ( $getSites->fetchAll() as $website ) {
                                        echo '<tr><td>'. $website['label'] .'</td><td><input id="'. $website['token'] .'" name="'. $website['token'] .'" type="checkbox" /></td></tr>';
                                    } 
                                }
                                ?>
                            </tbody>
                        </table>
                    </form>
                </div>
              </div> <!-- Bulk Delete Modal -->
              <div class="modal-footer">
                <input type="submit" class="btn btn-custom" name="manageSiteAccess" form="manageAccessForm" />
                <button type="button" class="btn btn-custom" data-dismiss="modal">Close</button>
              </div>
            </div>
          </div>
        </div>


        <div id="promptBulkDisable" class="modal fade" role="dialog">
          <div class="modal-dialog">
        
            <!-- Modal content-->
            <div class="modal-content"> <!-- Bulk Delete Modal -->
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button> <!-- Bulk Delete Modal -->
                <h4 class="modal-title">Caution</h4> <!-- Bulk Delete Modal -->
              </div>
              <input id="remove_category" name="category" hidden>
              <div class="modal-body"> <!-- Bulk Delete Modal -->
                <div class="container">
                    <h4>You are about to disable <strong id="itemsToDisable">This</strong>
                    <br>Note: Disabled items do not appear in the front-end of <strong>any</strong> site, are you sure you want to perform this action?</h4> <!-- Bulk Delete Modal -->
                </div>
              </div> <!-- Bulk Delete Modal -->
              <div class="modal-footer">
                <input type="submit" class="btn btn-custom" name="bulkManage" value="disable" form="bulkManage" />
                <button type="button" class="btn btn-custom" data-dismiss="modal">Close</button>
              </div>
            </div>
          </div>
        </div>


        <div id="promptBulkEnable" class="modal fade" role="dialog">
          <div class="modal-dialog">
        
            <!-- Modal content-->
            <div class="modal-content"> <!-- Bulk Delete Modal -->
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button> <!-- Bulk Delete Modal -->
                <h4 class="modal-title">Caution</h4> <!-- Bulk Delete Modal -->
              </div>
              <input id="remove_category" name="category" hidden>
              <div class="modal-body"> <!-- Bulk Delete Modal -->
                <div class="container">
                    <h4>You are about to disable <strong id="itemsToEnable">This</strong>
                    <br>Note: Enabled items would appear in the front-end of <strong>any</strong> site they are allowed in, are you sure you want to perform this action?</h4> <!-- Bulk Delete Modal -->
                </div>
              </div> <!-- Bulk Delete Modal -->
              <div class="modal-footer">
                <input type="submit" class="btn btn-custom" name="bulkManage" value="enable" form="bulkManage" />
                <button type="button" class="btn btn-custom" data-dismiss="modal">Close</button>
              </div>
            </div>
          </div>
        </div>


        <div id="promptBulkAccessManagement" class="modal fade" role="dialog">
          <div class="modal-dialog">
        
            <!-- Modal content-->
            <div class="modal-content"> <!-- Bulk Delete Modal -->
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button> <!-- Bulk Delete Modal -->
                <h4 class="modal-title">Note: This changes access for every items selected</h4> <!-- Bulk Delete Modal -->
              </div>
              <input id="remove_category" name="category" hidden>
              <div class="modal-body"> <!-- Bulk Delete Modal -->
                <div class="container">
                    <h4 style="border-bottom: solid thin #ddd; padding-bottom: 10px; margin: 10px 5%;"><span id="bulkManageAccessItem"></span> </h4>
                    <table class="table table-condensed table-custom">
                        <thead>
                            <th>Domain Name</th>
                            <th>Access</th>
                        </thead>
                        <tbody>
                            <?php 
                            $getSites = $pdo->prepare("SELECT * FROM tb_websites");
                            $getSites->execute();

                            if ( $getSites->rowCount() > 0 ) {
                                foreach ( $getSites->fetchAll() as $website ) {
                                    echo '<tr><td>'. $website['label'] .'</td><td><input form="bulkManage" id="'. $website['token'] .'" name="site['. $website['token'] .']" type="checkbox" /></td></tr>';
                                } 
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
              </div> <!-- Bulk Delete Modal -->
              <div class="modal-footer">
                <input type="submit" class="btn btn-custom" name="bulkManage" value="access" form="bulkManage" />
                <button type="button" class="btn btn-custom" data-dismiss="modal">Close</button>
              </div>
            </div>
          </div>
        </div>

      </div>
    </div>

    

    <!-- jQuery -->
    
    <script src="../../js/jquery-1.12.0.js"></script>
    <script src="../../js/bootstrap.min.js"></script>
    <script src="../assets/custom.min.js"></script>
    <!-- Datatables -->
    <script src="../assets/datatables/javascripts/datatables.net/js/jquery.dataTables.min.js"></script>
    <script src="../assets/datatables/javascripts/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
    <script src="../assets/datatables/javascripts/datatables.net-buttons/js/dataTables.buttons.min.js"></script>
    <script src="../assets/datatables/javascripts/datatables.net-buttons-bs/js/buttons.bootstrap.min.js"></script>
    <script src="../assets/datatables/javascripts/datatables.net-buttons/js/buttons.flash.min.js"></script>
    <script src="../assets/datatables/javascripts/datatables.net-buttons/js/buttons.html5.min.js"></script>
    <script src="../assets/datatables/javascripts/datatables.net-buttons/js/buttons.print.min.js"></script>
    <script src="../assets/datatables/javascripts/datatables.net-fixedheader/js/dataTables.fixedHeader.min.js"></script>
    <script src="../assets/datatables/javascripts/datatables.net-keytable/js/dataTables.keyTable.min.js"></script>
    <script src="../assets/datatables/javascripts/datatables.net-responsive/js/dataTables.responsive.min.js"></script>
    <script src="../assets/datatables/javascripts/datatables.net-responsive-bs/js/responsive.bootstrap.js"></script>
    <script src="../assets/datatables/javascripts/datatables.net-scroller/js/datatables.scroller.min.js"></script>
    <script>
    $(document).ready(function(){
        $('[data-toggle="tooltip"]').tooltip(); 
    });

    function removeItem(key, name) {
        $("#itemToRemove").html(name);
        $("#removeModalActionButton").val(key);

        $("#promptRemoveModal").modal("toggle");
    }

    function editItem(key) {

        $.ajax({
            url: './ajax.php?getInfo=' + key,
            type: 'GET',
            success: function(result) {
                try {
                    result = JSON.parse(result);
                    console.log(result);

                    $("#item_to_edit").html(result['product_name']);
                    $("#unique_key").val(result['unique_key']);
                    $("#edit_product_name").val(result['product_name']);
                    $("#edit_product_price").val(parseFloat(result['item_value']).toFixed(2));
                    $("#edit_discount").val(result['discount']);
                    $("#edit_color").val(result['color']);
                    $("#edit_total_carat_weight").val(result['total_carat_weight']);
                    $("#edit_no_of_stones").val(result['no_of_stones']);
                    $("#edit_height").val(result['height']);
                    $("#edit_length").val(result['length']);
                    $("#edit_pieces_in_stock").val(result['pieces_in_stock']);
                    $("#edit_days_for_shipment").val(result['days_for_shipment']);
                    $("#edit_width").val(result['width']);
                    $("#edit_internal_id").val(result['internal_id']);
                    $("#edit_ring_size").val(result['ring_size']);
                    $("#edit_description").val(result['description']);
                    $("#edit_description_french").val(result['description_french']);


                    $("#edit_material option[value='"+ result['material'] +"'").attr("selected", true);
                    $("#edit_category option[value='"+ result['category'] +"'").attr("selected", true);
                    $("#edit_clarity option[value='"+ result['clarity'] +"'").attr("selected", true);
                    //$("#edit_ring_subcategory option[value='"+ result['ring_subcategory'] +"'").attr("selected", true);
                    $("#edit_country_id option[value='"+ result['country_id'] +"'").attr("selected", true);
                    $("#edit_company_id option[value='"+ result['company_id'] +"'").attr("selected", true);
                    $("#edit_diamond_shape option[value='"+ result['diamond_shape'] +"'").attr("selected", true);

                    if ( result['category'] !== "1" ) {
                        $("#ringExclusiveEditDiv").hide();
                    } else {
                        $("#ringExclusiveEditDiv").show();
                    }

                    $.ajax({
                        url : "./ajax.php?getSubcategories=" + result['category'],
                        type : "GET",
                        success: function(result) {
                            $("#edit_ring_subcategory").html(result);
                        },
                        complete : function () {
                            $("#edit_ring_subcategory option[value='"+ result['ring_subcategory'] +"'").attr("selected", true);
                        }
                    });
                    
                    $("#edit_ring_subcategory option[value='"+ result['ring_subcategory'] +"'").attr("selected", true);
                    $("#edit_lab_grown[value='"+ result['lab_grown'] +"'").attr("checked", true);
                    $("#promptEditItem").modal("toggle");
                } catch ( e ) {
                    console.log(result);
                }
            },
            failure: function(error) {

            }
        });

    }

    function editThis(key, internal_id, company_id, name, price, discount, pieces_in_stock, days_for_shipment, total_carat_weight, no_of_stones, diamond_shape, clarity, color, material, height, weight, length, country_id, description) {
        
        $("#itemToEdit").html(name);
        $("#editModalActionButton").val(key);
        $("#unique_key").val(key);
        $("#edit_category").val(category);
        $("#name").val(name);
        $("#price").val(price);
        $("#discount").val(discount);
        $("#stone").val(stone);
        $("#stone_weight").val(stone_weight);
        $("#num_of_stones").val(num_of_stones);
        $("#material option[value='"+ material +"'").attr("selected", true);
        $("#material_weight").val(material_weight);
        $("#height").val(height);
        $("#length").val(length);
        
        $("#promptEditModal").modal("toggle");
    }
    
    function selectAll(e) {
        if ( $(e).is(":checked") ) {
            checkboxes = document.getElementsByClassName("select-checkbox");
            for(var i=0, n=checkboxes.length;i<n;i++) {
                checkboxes[i].checked = true;
            }
            $(".selected-num").each(function(index, element) {
                $(element).text(checkboxes.length);
            });
        } else {
            checkboxes = document.getElementsByClassName("select-checkbox");
            for(var i=0, n=checkboxes.length;i<n;i++) {
                checkboxes[i].checked = false;
            }
            $(".selected-num").each(function(index, element) {
                $(element).text(0);
            });
        }
    }
    
    $(".select-checkbox").each(function(index, element) {
        $(element).change(function() { 
            if ( $(element).is(":checked") ) {
            //alert("this");
                selectedNum = $(".selected-num").each(function(index, element) {
                    $(element).text(parseInt($(element).text()) + 1);
                });;
                
                
            } else {
                selectedNum = $(".selected-num").each(function(index, element) {
                    $(element).text(parseInt($(element).text()) - 1);
                });;
            }
            
        });
    });

    function bulkRemoveItems() {
        $("#itemsToRemove").text($(".selected-num").first().text() + " Item(s)");
        $("#promptBulkRemoveModal").modal("toggle");
    }

    function removeAll(e) {
        switch($(e).attr("name")) {
            case 'all': {
                message = "Every Item";
                break;
            } case 'rings': {
                message = "All Rings";
                break;
            } case 'earrings': {
                message = "All Earrings";
                break;
            } case 'pendants': {
                message = "All Pendants";
                break;
            } case 'necklaces': {
                message = "All Necklaces";
                break;
            } case 'bracelets': {
                message = "All Bracelets";
                break;
            } 
        }
        $("#categoryToRemove").text(message);
        $("#removeAll").val($(e).attr("name"));
        $("#promptRemoveAll").modal("toggle");
    }

    function manageImages(key) {
        $.ajax({
            url: "ajax.php?fetchImages="+key,
            type: "GET",
            beforeSend: function() {
                $("#promptManageImages").modal("toggle");
                $("#manageImageDiv").html("<div style='text-align:center;'><img src='./../../images/gfx/cube_lg.gif'></div>");
                $("#addNewImagesID").val(key);
            },
            success: function(result){
                $("#manageImageDiv").html(result);
                console.log(result);
            }
        });
    }

    function manageSiteAccess(itemID) {
        $.ajax({
            url: "./ajax.php?getInfo="+ itemID,
            type: "GET",
            beforeSend: function() {
                $("#promptSiteManagement table.table-custom").hide();
            }, success: function(result) {
                try {
                    console.log(result);
                    result = JSON.parse(result);

                    $("#manageAccessItem").text(result['item_name']);
                    $("#promptSiteManagement form input[name='unique_key']").val(result['unique_key']);

                    $("#promptSiteManagement table tbody tr td input[type='checkbox']").each(function(index, element) {
                        var token = $(element).prop("id");

                        if ( result[token] == 1 ) {
                            $(element).prop("checked", true);
                        } else {
                            $(element).prop("checked", false);
                        }
                    });
                    $("#promptSiteManagement table.table-custom").show();
                } catch(e) {
                    console.log(e);
                }
            }
        });
        $("#promptSiteManagement").modal("toggle");
    }

    var $datatable = $('#itemsTable');

    $datatable.dataTable({
      'order': [[ 2, 'desc' ]],
      'columnDefs': [
        { orderable: false, targets: [0, 7, 8] }
      ]
    });

    function bulkDisable() {
        $("#itemsToDisable").text($(".selected-num").first().text() + " Item(s)");
        $("#promptBulkDisable").modal("toggle");
    }

    function bulkEnable() {
        $("#itemsToEnable").text($(".selected-num").first().text() + " Item(s)");
        $("#promptBulkEnable").modal("toggle");
    }

    function bulkAccessManagement() {
        $("#bulkManageAccessItem").text($(".selected-num").first().text() + " Item(s)");
        $("#promptBulkAccessManagement").modal("toggle");
    }
    
    </script>
  </body>
</html>
