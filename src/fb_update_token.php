<?php
include 'conf/config.php';
include 'includes/fb_config.php';
ini_set('memory_limit', $__MAX_MEMORY_LIMIT__);
ini_set('max_execution_time', 0);
require_once 'includes/facebook.php';
$facebookObj = new facebookApi();

$getitemID = $pdo->prepare("SELECT * from fb_access_tokens");
$getitemID->execute();
$getitemData = $getitemID->fetch();

$site0_Token = $facebookObj->exchangedAccessToken($getitemData['site_0']);
if(!empty($site0_Token)) {
	$updateSite0 = $pdo->prepare("UPDATE fb_access_tokens SET site_0 = :site_0  WHERE id = :itemId");
        $updateSite0->execute(array(":site_0" => $site0_Token, ":itemId" => 1));
        echo "success";
}

$site1_Token = $facebookObj->exchangedAccessToken($getitemData['site_1']);
if(!empty($site1_Token)) {
	$updateSite1 = $pdo->prepare("UPDATE fb_access_tokens SET site_1 = :site_1  WHERE id = :itemId");
        $updateSite1->execute(array(":site_1" => $site1_Token, ":itemId" => 1));
        echo "success";
}
$site2_Token = $facebookObj->exchangedAccessToken($getitemData['site_2']);
if(!empty($site2_Token)) {
	$updateSite2 = $pdo->prepare("UPDATE fb_access_tokens SET site_2 = :site_2  WHERE id = :itemId");
        $updateSite2->execute(array(":site_2" => $site2_Token, ":itemId" => 1));
        echo "success";
}
$site3_Token = $facebookObj->exchangedAccessToken($getitemData['site_3']);
if(!empty($site3_Token)) {
	$updateSite3 = $pdo->prepare("UPDATE fb_access_tokens SET site_3 = :site_3  WHERE id = :itemId");
        $updateSite3->execute(array(":site_3" => $site3_Token, ":itemId" => 1));
        echo "success";
}
$site4_Token = $facebookObj->exchangedAccessToken($getitemData['site_4']);
if(!empty($site4_Token)) {
	$updateSite4 = $pdo->prepare("UPDATE fb_access_tokens SET site_4 = :site_4  WHERE id = :itemId");
        $updateSite4->execute(array(":site_4" => $site4_Token, ":itemId" => 1));
        echo "success";
}
$site5_Token = $facebookObj->exchangedAccessToken($getitemData['site_5']);
if(!empty($site5_Token)) {
	$updateSite5 = $pdo->prepare("UPDATE fb_access_tokens SET site_5 = :site_5  WHERE id = :itemId");
        $updateSite5->execute(array(":site_5" => $site5_Token, ":itemId" => 1));
        echo "success";
}
$site6_Token = $facebookObj->exchangedAccessToken($getitemData['site_6']);
if(!empty($site6_Token)) {
	$updateSite6 = $pdo->prepare("UPDATE fb_access_tokens SET site_6 = :site_6  WHERE id = :itemId");
        $updateSite6->execute(array(":site_6" => $site6_Token, ":itemId" => 1));
        echo "success";
}
$site7_Token = $facebookObj->exchangedAccessToken($getitemData['site_7']);
if(!empty($site7_Token)) {
	$updateSite7 = $pdo->prepare("UPDATE fb_access_tokens SET site_7 = :site_7  WHERE id = :itemId");
        $updateSite7->execute(array(":site_7" => $site7_Token, ":itemId" => 1));
        echo "success";
}
?>