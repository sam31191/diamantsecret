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
    //echo var_dump($_POST);
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
                        //echo var_dump($image);
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
?>