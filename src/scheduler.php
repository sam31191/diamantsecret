<?php
include 'conf/config.php';
include 'includes/instadetails.php';
ini_set('memory_limit', $__MAX_MEMORY_LIMIT__);
ini_set('max_execution_time', 0);
$item=[];
$instaAccounts = unserialize(instaDetails);

require_once 'includes/instagram.php';

$pdo->exec("SET NAMES 'utf8';");
$getitemID = $pdo->prepare("SELECT product_name, images, description_french, item_value, itemId, site_0, site_1, site_2, site_3, site_4, site_5, site_6, site_7 FROM ((SELECT product_name, images, description_french, item_value, items.id as itemId, site_0, site_1, site_2, site_3, site_4, site_5, site_6, site_7 FROM rings INNER JOIN items ON items.unique_key = rings.unique_key WHERE items.insta_status = 0 order by items.id desc limit 2)
UNION
(SELECT product_name, images, description_french, item_value, items.id as itemId, site_0, site_1, site_2, site_3, site_4, site_5, site_6, site_7 FROM earrings INNER JOIN items ON items.unique_key = earrings.unique_key WHERE items.insta_status = 0 order by items.id desc limit 2)
UNION
(SELECT product_name, images, description_french, item_value, items.id as itemId, site_0, site_1, site_2, site_3, site_4, site_5, site_6, site_7 FROM pendants INNER JOIN items ON items.unique_key = pendants.unique_key WHERE items.insta_status = 0 order by items.id desc limit 2)
UNION
(SELECT product_name, images, description_french, item_value, items.id as itemId, site_0, site_1, site_2, site_3, site_4, site_5, site_6, site_7 FROM necklaces INNER JOIN items ON items.unique_key = necklaces.unique_key WHERE items.insta_status = 0 order by items.id desc limit 2)
UNION
(SELECT product_name, images, description_french, item_value, items.id as itemId, site_0, site_1, site_2, site_3, site_4, site_5, site_6, site_7 FROM bracelets INNER JOIN items ON items.unique_key = bracelets.unique_key WHERE items.insta_status = 0 order by items.id desc limit 2)) as resutl_table LIMIT 5");
	$getitemID->execute(array(":instaStatus" => 0));
    $item = $getitemID->fetchAll(PDO::FETCH_ASSOC);

if(!empty($item)) {
	$instaObj_1 = new instagramAPI($instaAccounts[1]);
	$instaObj_2 = new instagramAPI($instaAccounts[2]);
	$instaObj_3 = new instagramAPI($instaAccounts[3]);
	$instaObj_4 = new instagramAPI($instaAccounts[4]);
	$instaObj_5 = new instagramAPI($instaAccounts[5]);
	$instaObj_6 = new instagramAPI($instaAccounts[6]);
	$instaObj_7 = new instagramAPI($instaAccounts[7]);
	$instaObj_8 = new instagramAPI($instaAccounts[8]);
	foreach ($item as $key => $value) {
		$images = explode(",", $value['images']);
		$media = [];
		$rootPath = "images/images_md/";
		foreach ($images as $key1 => $value1) {
			if(!empty($value1)) {
				$media[$key1]['type']="photo";
	        	$media[$key1]['file']= $rootPath.$value1;
	        }
		}
		$captionText = $value['product_name'].' - '.$value['description_french'].PHP_EOL. 'Price: '.$value['item_value'].' EURO'.PHP_EOL."To place your order or for any information contact us through Whatsapp +33785535657";
		$status=[];
		$statusVal="";
		$statusValMsg="";
		if(!empty($value['site_0'])) {
			$uploadData1 = $instaObj_1->uploadAlbum($media, $captionText);
			$status['site_0']['status'] = $uploadData1['status'];
			$status['site_0']['message'] = $uploadData1['message'];
			$statusVal = $uploadData1['status'];
			$statusValMsg = $uploadData1['message'];
		}
		if(!empty($value['site_1'])) {
			$uploadData2 = $instaObj_2->uploadAlbum($media, $captionText);
			$status['site_1']['status'] = $uploadData2['status'];
			$status['site_1']['message'] = $uploadData2['message'];
			$statusVal = $uploadData1['status'];
			$statusValMsg = $uploadData1['message'];
		}
		if(!empty($value['site_2'])) {
			$uploadData3 = $instaObj_3->uploadAlbum($media, $captionText);
			$status['site_2']['status'] = $uploadData3['status'];
			$status['site_2']['message'] = $uploadData3['message'];
			$statusVal = $uploadData1['status'];
			$statusValMsg = $uploadData1['message'];
		}
		if(!empty($value['site_3'])) {
			$uploadData4 = $instaObj_4->uploadAlbum($media, $captionText);
			$status['site_3']['status'] = $uploadData4['status'];
			$status['site_3']['message'] = $uploadData4['message'];
			$statusVal = $uploadData1['status'];
			$statusValMsg = $uploadData1['message'];
		}
		if(!empty($value['site_4'])) {
			$uploadData5 = $instaObj_5->uploadAlbum($media, $captionText);
			$status['site_4']['status'] = $uploadData5['status'];
			$status['site_4']['message'] = $uploadData5['message'];
			$statusVal = $uploadData1['status'];
			$statusValMsg = $uploadData1['message'];
		}
		if(!empty($value['site_5'])) {
			$uploadData6 = $instaObj_6->uploadAlbum($media, $captionText);
			$status['site_5']['status'] = $uploadData6['status'];
			$status['site_5']['message'] = $uploadData6['message'];
			$statusVal = $uploadData1['status'];
			$statusValMsg = $uploadData1['message'];
		}
		if(!empty($value['site_6'])) {
			$uploadData7 = $instaObj_7->uploadAlbum($media, $captionText);
			$status['site_6']['status'] = $uploadData7['status'];
			$status['site_6']['message'] = $uploadData7['message'];
			$statusVal = $uploadData1['status'];
			$statusValMsg = $uploadData1['message'];
		}
		if(!empty($value['site_7'])) {
			$uploadData8 = $instaObj_8->uploadAlbum($media, $captionText);
			$status['site_7']['status'] = $uploadData8['status'];
			$status['site_7']['message'] = $uploadData8['message'];
			$statusVal = $uploadData1['status'];
			$statusValMsg = $uploadData1['message'];
		}
		if (!empty($statusVal) && ($statusVal=="success")) {
			$updateItem = $pdo->prepare("UPDATE items SET insta_status = :instaStatus, insta_info = :instaInfo WHERE id = :itemId");
	    	$updateItem->execute(array(":itemId" => $value['itemId'], ":instaStatus" => 1, ":instaInfo"=> $statusValMsg));
		} else {
			$updateItem = $pdo->prepare("UPDATE items SET insta_status = :instaStatus, insta_info = :instaInfo WHERE id = :itemId");
	    	$updateItem->execute(array(":itemId" => $value['itemId'], ":instaStatus" => 2, ":instaInfo"=> $statusValMsg));
		}
		
	}
	echo "Success";
} else {
	echo "No Record Found";
}
?>