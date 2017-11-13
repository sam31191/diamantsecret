<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);
include 'conf/config.php';
include 'includes/fb_config.php';
include 'includes/facebook.php';
ini_set('memory_limit', $__MAX_MEMORY_LIMIT__);
ini_set('max_execution_time', 0);
$item = [];

$getTokenSelect = $pdo->prepare("SELECT * from fb_access_tokens");
$getTokenSelect->execute();
$getTokenData = $getTokenSelect->fetch();

$pdo->exec("SET NAMES 'utf8';");
$getitemID = $pdo->prepare("SELECT product_name, images, description_french, item_value, itemId, site_0_post_id, site_1_post_id, site_2_post_id, site_3_post_id, site_4_post_id, site_5_post_id, site_6_post_id, site_7_post_id FROM ((SELECT product_name, images, description_french, item_value, items.id as itemId, site_0_post_id, site_1_post_id, site_2_post_id, site_3_post_id, site_4_post_id, site_5_post_id, site_6_post_id, site_7_post_id FROM rings INNER JOIN items ON items.unique_key = rings.unique_key WHERE items.fb_status = 3 order by items.id desc limit 2)
UNION
(SELECT product_name, images, description_french, item_value, items.id as itemId, site_0_post_id, site_1_post_id, site_2_post_id, site_3_post_id, site_4_post_id, site_5_post_id, site_6_post_id, site_7_post_id FROM earrings INNER JOIN items ON items.unique_key = earrings.unique_key WHERE items.fb_status = 3 order by items.id desc limit 2)
UNION
(SELECT product_name, images, description_french, item_value, items.id as itemId, site_0_post_id, site_1_post_id, site_2_post_id, site_3_post_id, site_4_post_id, site_5_post_id, site_6_post_id, site_7_post_id FROM pendants INNER JOIN items ON items.unique_key = pendants.unique_key WHERE items.fb_status = 3 order by items.id desc limit 2)
UNION
(SELECT product_name, images, description_french, item_value, items.id as itemId, site_0_post_id, site_1_post_id, site_2_post_id, site_3_post_id, site_4_post_id, site_5_post_id, site_6_post_id, site_7_post_id FROM necklaces INNER JOIN items ON items.unique_key = necklaces.unique_key WHERE items.fb_status = 3 order by items.id desc limit 2)
UNION
(SELECT product_name, images, description_french, item_value, items.id as itemId, site_0_post_id, site_1_post_id, site_2_post_id, site_3_post_id, site_4_post_id, site_5_post_id, site_6_post_id, site_7_post_id FROM bracelets INNER JOIN items ON items.unique_key = bracelets.unique_key WHERE items.fb_status = 3 order by items.id desc limit 2)) as resutl_table LIMIT 5");
$getitemID->execute(array(":fb_status" => 3));
$item = $getitemID->fetchAll(PDO::FETCH_ASSOC);

if (!empty($item)) {
    $facebookObj = new facebookApi();
    foreach ($item as $key => $value) {
        $postData = $facebookObj->getPost($getTokenData['site_0'], $value['site_0_post_id']);
        //$getTokenData['site_0']
        $captionText = $value['product_name'] . ' - ' . $value['description_french'] . PHP_EOL . 'Price: ' . $value['item_value'] . ' EURO' . PHP_EOL . "To place your order or for any information contact us through Whatsapp +33785535657";
        $status = [];
        $statusVal = 0;
        $statusValMsg = "";
        if (!empty($value['site_0_post_id'])) {
            $updateData0 = $facebookObj->updatePost($getTokenData['site_0'], $value['site_0_post_id'], $captionText);
            if(!empty($updateData0)) {
                $statusVal=1;
            } else {
               $statusVal=0;
            }
        }
        if (!empty($value['site_1_post_id'])) {
            $updateData1 = $facebookObj->updatePost($getTokenData['site_1'], $value['site_1_post_id'], $captionText);
            if(!empty($updateData1)) {
                $statusVal=1;
            } else {
               $statusVal=0;
            }
        }
        if (!empty($value['site_2_post_id'])) {
            $updateData2 = $facebookObj->updatePost($getTokenData['site_2'], $value['site_2_post_id'], $captionText);
            if(!empty($updateData2)) {
                $statusVal=1;
            } else {
               $statusVal=0;
            }
        }
        if (!empty($value['site_3_post_id'])) {
            $updateData3 = $facebookObj->updatePost($getTokenData['site_3'], $value['site_3_post_id'], $captionText);
            if(!empty($updateData3)) {
                $statusVal=1;
            } else {
               $statusVal=0;
            }
        }
        if (!empty($value['site_4_post_id'])) {
            $updateData4 = $facebookObj->updatePost($getTokenData['site_4'], $value['site_4_post_id'], $captionText);
            if(!empty($updateData4)) {
                $statusVal=1;
            } else {
               $statusVal=0;
            }
        }
        if (!empty($value['site_5_post_id'])) {
            $updateData5 = $facebookObj->updatePost($getTokenData['site_5'], $value['site_5_post_id'], $captionText);
            if(!empty($updateData5)) {
                $statusVal=1;
            } else {
               $statusVal=0;
            }
        }
        if (!empty($value['site_6_post_id'])) {
            $updateData6 = $facebookObj->updatePost($getTokenData['site_6'], $value['site_6_post_id'], $captionText);
            if(!empty($updateData6)) {
                $statusVal=1;
            } else {
               $statusVal=0;
            }
        }
        if (!empty($value['site_7_post_id'])) {
            $updateData7 = $facebookObj->updatePost($getTokenData['site_7'], $value['site_7_post_id'], $captionText);
            if(!empty($updateData7)) {
                $statusVal=1;
            } else {
               $statusVal=0;
            }
        }

        if(!empty($statusVal)) {
            $updateItem = $pdo->prepare("UPDATE items SET fb_status = :fbStatus WHERE id = :itemId");
                $updateItem->execute(array(":itemId" => $value['itemId'], ":fbStatus" => 1));
        } else {
            $updateItem = $pdo->prepare("UPDATE items SET fb_status = :fbStatus WHERE id = :itemId");
                $updateItem->execute(array(":itemId" => $value['itemId'], ":fbStatus" => 2));
        }
    }
    echo "Success";
} else {
    echo "No Record Found";
}
?>