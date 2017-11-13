<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);
include 'conf/config.php';
include 'includes/fb_config.php';
ini_set('memory_limit', $__MAX_MEMORY_LIMIT__);
ini_set('max_execution_time', 0);
$item = [];

require_once 'includes/autoload.php';
use Facebook\FacebookSession;
use Facebook\FacebookRedirectLoginHelper;
use Facebook\FacebookRequest;
use Facebook\FacebookResponse;
use Facebook\FacebookSDKException;
use Facebook\FacebookRequestException;
use Facebook\FacebookAuthorizationException;
use Facebook\GraphObject;
use Facebook\GraphUser;

$getTokenSelect = $pdo->prepare("SELECT * from fb_access_tokens");
$getTokenSelect->execute();
$getTokenData = $getTokenSelect->fetch();

FacebookSession::enableAppSecretProof(false);
FacebookSession::setDefaultApplication(FB_APP_ID, FB_APP_SECRET);
$session1 = new FacebookSession($getTokenData['site_0']);
$session2 = new FacebookSession($getTokenData['site_1']);
$session3 = new FacebookSession($getTokenData['site_2']);
$session4 = new FacebookSession($getTokenData['site_3']);
$session5 = new FacebookSession($getTokenData['site_4']);
$session6 = new FacebookSession($getTokenData['site_5']);
$session7 = new FacebookSession($getTokenData['site_6']);
$session8 = new FacebookSession($getTokenData['site_7']);
$pdo->exec("SET NAMES 'utf8';");
$getitemID = $pdo->prepare("SELECT product_name, images, description_french, item_value, itemId, site_0, site_1, site_2, site_3, site_4, site_5, site_6, site_7 FROM ((SELECT product_name, images, description_french, item_value, items.id as itemId, site_0, site_1, site_2, site_3, site_4, site_5, site_6, site_7 FROM rings INNER JOIN items ON items.unique_key = rings.unique_key WHERE items.fb_status = 0 order by items.id desc limit 2)
UNION
(SELECT product_name, images, description_french, item_value, items.id as itemId, site_0, site_1, site_2, site_3, site_4, site_5, site_6, site_7 FROM earrings INNER JOIN items ON items.unique_key = earrings.unique_key WHERE items.fb_status = 0 order by items.id desc limit 2)
UNION
(SELECT product_name, images, description_french, item_value, items.id as itemId, site_0, site_1, site_2, site_3, site_4, site_5, site_6, site_7 FROM pendants INNER JOIN items ON items.unique_key = pendants.unique_key WHERE items.fb_status = 0 order by items.id desc limit 2)
UNION
(SELECT product_name, images, description_french, item_value, items.id as itemId, site_0, site_1, site_2, site_3, site_4, site_5, site_6, site_7 FROM necklaces INNER JOIN items ON items.unique_key = necklaces.unique_key WHERE items.fb_status = 0 order by items.id desc limit 2)
UNION
(SELECT product_name, images, description_french, item_value, items.id as itemId, site_0, site_1, site_2, site_3, site_4, site_5, site_6, site_7 FROM bracelets INNER JOIN items ON items.unique_key = bracelets.unique_key WHERE items.fb_status = 0 order by items.id desc limit 2)) as resutl_table LIMIT 5");
$getitemID->execute(array(":fb_status" => 0));
$item = $getitemID->fetchAll(PDO::FETCH_ASSOC);
if (!empty($item)) {
    //$facebookObj = new facebookApi();
    foreach ($item as $key => $value) {
        $images = explode(",", $value['images']);
        $rootPath = "http://testsite.diamantsecret.com/images/images_md/";
        $captionText = $value['product_name'] . ' - ' . $value['description_french'] . PHP_EOL . 'Price: ' . $value['item_value'] . ' EURO' . PHP_EOL . "To place your order or for any information contact us through Whatsapp +33785535657";
        $status = [];
        $statusVal = "";
        $statusValMsg = "";
        if (!empty($value['site_0'])) {
            /*foreach ($images as $key1 => $value1) {
                if (!empty($value1)) {
                    $image = $rootPath . $value1;
                    if (is_file($image)) {
                        $imgData = $facebookObj->uploadPhoto($accessToken, $image);
                        $mediaPost['attached_media[' . $key1 . ']'] = '{"media_fbid":"' . $imgData . '"}';
                        $fileCheck=1;
                    }
                }
            }*/
            $url = $rootPath.$images[0];
            $array = array(
            'link' => $url,
            'message' =>$captionText,
            'picture' =>$url
            );
            if($session1) {
                try {
                    $response = (new FacebookRequest(
                        $session1, 'POST', '/1761158134184444/feed',$array))->execute()->getGraphObject();
                    //echo "Posted with id: " . $response->getProperty('id');
                    $updateItem = $pdo->prepare("UPDATE items SET fb_status = :fbStatus, site_0_post_id = :statusInfo WHERE id = :itemId");
                    $updateItem->execute(array(":itemId" => $value['itemId'], ":fbStatus" => 1, ":statusInfo" => $response->getProperty('id')));
                } catch(FacebookRequestException $e) {
                    $updateItem = $pdo->prepare("UPDATE items SET fb_status = :fbStatus, site_0_post_id = :statusInfo WHERE id = :itemId");
                    $updateItem->execute(array(":itemId" => $value['itemId'], ":fbStatus" => 2, ":statusInfo" => '0'));
                }
            }
        }
        if (!empty($value['site_1'])) {
            $url = $rootPath.$images[0];
            $array = array(
            'link' => $url,
            'message' =>$captionText,
            'picture' =>$url
            );
            if($session2) {
                try {
                    $response = (new FacebookRequest(
                        $session2, 'POST', '/1761158134184444/feed',$array))->execute()->getGraphObject();
                    //echo "Posted with id: " . $response->getProperty('id');
                    $updateItem = $pdo->prepare("UPDATE items SET fb_status = :fbStatus, site_1_post_id = :statusInfo WHERE id = :itemId");
                    $updateItem->execute(array(":itemId" => $value['itemId'], ":fbStatus" => 1, ":statusInfo" => $response->getProperty('id')));
                } catch(FacebookRequestException $e) {
                    $updateItem = $pdo->prepare("UPDATE items SET fb_status = :fbStatus, site_1_post_id = :statusInfo WHERE id = :itemId");
                    $updateItem->execute(array(":itemId" => $value['itemId'], ":fbStatus" => 2, ":statusInfo" => '0'));
                }
            }
        }
        if (!empty($value['site_2'])) {
            $url = $rootPath.$images[0];
            $array = array(
            'link' => $url,
            'message' =>$captionText,
            'picture' =>$url
            );
            if($session3) {
                try {
                    $response = (new FacebookRequest(
                        $session3, 'POST', '/1761158134184444/feed',$array))->execute()->getGraphObject();
                    //echo "Posted with id: " . $response->getProperty('id');
                    $updateItem = $pdo->prepare("UPDATE items SET fb_status = :fbStatus, site_2_post_id = :statusInfo WHERE id = :itemId");
                    $updateItem->execute(array(":itemId" => $value['itemId'], ":fbStatus" => 1, ":statusInfo" => $response->getProperty('id')));
                } catch(FacebookRequestException $e) {
                    $updateItem = $pdo->prepare("UPDATE items SET fb_status = :fbStatus, site_2_post_id = :statusInfo WHERE id = :itemId");
                    $updateItem->execute(array(":itemId" => $value['itemId'], ":fbStatus" => 2, ":statusInfo" => '0'));
                }
            }
        }
        if (!empty($value['site_3'])) {
            $url = $rootPath.$images[0];
            $array = array(
            'link' => $url,
            'message' =>$captionText,
            'picture' =>$url
            );
            if($session4) {
                try {
                    $response = (new FacebookRequest(
                        $session4, 'POST', '/1761158134184444/feed',$array))->execute()->getGraphObject();
                    //echo "Posted with id: " . $response->getProperty('id');
                    $updateItem = $pdo->prepare("UPDATE items SET fb_status = :fbStatus, site_3_post_id = :statusInfo WHERE id = :itemId");
                    $updateItem->execute(array(":itemId" => $value['itemId'], ":fbStatus" => 1, ":statusInfo" => $response->getProperty('id')));
                } catch(FacebookRequestException $e) {
                    $updateItem = $pdo->prepare("UPDATE items SET fb_status = :fbStatus, site_3_post_id = :statusInfo WHERE id = :itemId");
                    $updateItem->execute(array(":itemId" => $value['itemId'], ":fbStatus" => 2, ":statusInfo" => '0'));
                }
            }
        }
        if (!empty($value['site_4'])) {
            $url = $rootPath.$images[0];
            $array = array(
            'link' => $url,
            'message' =>$captionText,
            'picture' =>$url
            );
            if($session5) {
                try {
                    $response = (new FacebookRequest(
                        $session5, 'POST', '/1761158134184444/feed',$array))->execute()->getGraphObject();
                    //echo "Posted with id: " . $response->getProperty('id');
                    $updateItem = $pdo->prepare("UPDATE items SET fb_status = :fbStatus, site_4_post_id = :statusInfo WHERE id = :itemId");
                    $updateItem->execute(array(":itemId" => $value['itemId'], ":fbStatus" => 1, ":statusInfo" => $response->getProperty('id')));
                } catch(FacebookRequestException $e) {
                    $updateItem = $pdo->prepare("UPDATE items SET fb_status = :fbStatus, site_4_post_id = :statusInfo WHERE id = :itemId");
                    $updateItem->execute(array(":itemId" => $value['itemId'], ":fbStatus" => 2, ":statusInfo" => '0'));
                }
            }
        }
        if (!empty($value['site_5'])) {
            $url = $rootPath.$images[0];
            $array = array(
            'link' => $url,
            'message' =>$captionText,
            'picture' =>$url
            );
            if($session6) {
                try {
                    $response = (new FacebookRequest(
                        $session6, 'POST', '/1761158134184444/feed',$array))->execute()->getGraphObject();
                    //echo "Posted with id: " . $response->getProperty('id');
                    $updateItem = $pdo->prepare("UPDATE items SET fb_status = :fbStatus, site_5_post_id = :statusInfo WHERE id = :itemId");
                    $updateItem->execute(array(":itemId" => $value['itemId'], ":fbStatus" => 1, ":statusInfo" => $response->getProperty('id')));
                } catch(FacebookRequestException $e) {
                    $updateItem = $pdo->prepare("UPDATE items SET fb_status = :fbStatus, site_5_post_id = :statusInfo WHERE id = :itemId");
                    $updateItem->execute(array(":itemId" => $value['itemId'], ":fbStatus" => 2, ":statusInfo" => '0'));
                }
            }
        }
        if (!empty($value['site_6'])) {
            $url = $rootPath.$images[0];
            $array = array(
            'link' => $url,
            'message' =>$captionText,
            'picture' =>$url
            );
            if($session7) {
                try {
                    $response = (new FacebookRequest(
                        $session7, 'POST', '/1761158134184444/feed',$array))->execute()->getGraphObject();
                    //echo "Posted with id: " . $response->getProperty('id');
                    $updateItem = $pdo->prepare("UPDATE items SET fb_status = :fbStatus, site_6_post_id = :statusInfo WHERE id = :itemId");
                    $updateItem->execute(array(":itemId" => $value['itemId'], ":fbStatus" => 1, ":statusInfo" => $response->getProperty('id')));
                } catch(FacebookRequestException $e) {
                    $updateItem = $pdo->prepare("UPDATE items SET fb_status = :fbStatus, site_6_post_id = :statusInfo WHERE id = :itemId");
                    $updateItem->execute(array(":itemId" => $value['itemId'], ":fbStatus" => 2, ":statusInfo" => '0'));
                }
            }
        }
        if (!empty($value['site_7'])) {
            $url = $rootPath.$images[0];
            $array = array(
            'link' => $url,
            'message' =>$captionText,
            'picture' =>$url
            );
            if($session8) {
                try {
                    $response = (new FacebookRequest(
                        $session8, 'POST', '/1761158134184444/feed',$array))->execute()->getGraphObject();
                    //echo "Posted with id: " . $response->getProperty('id');
                    $updateItem = $pdo->prepare("UPDATE items SET fb_status = :fbStatus, site_7_post_id = :statusInfo WHERE id = :itemId");
                    $updateItem->execute(array(":itemId" => $value['itemId'], ":fbStatus" => 1, ":statusInfo" => $response->getProperty('id')));
                } catch(FacebookRequestException $e) {
                    $updateItem = $pdo->prepare("UPDATE items SET fb_status = :fbStatus, site_7_post_id = :statusInfo WHERE id = :itemId");
                    $updateItem->execute(array(":itemId" => $value['itemId'], ":fbStatus" => 2, ":statusInfo" => '0'));
                }
            }
        }
    }
    echo "Success";
} else {
    echo "No Record Found";
}
?>