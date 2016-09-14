<?php
if ( session_status() == PHP_SESSION_NONE ) {
	session_start();
}
if ( !$_SESSION['loggedIn'] ) {
	die();
}
include 'require.php';

if ( isset($_GET['addtoFav'])) {
	$getcurrentFavs = $pdo->prepare("SELECT `favorites` FROM `accounts` WHERE `username` = :username");
	$getcurrentFavs->execute(array(":username" => $_USERNAME));

	$result = $getcurrentFavs->fetch(PDO::FETCH_ASSOC);
	$currentFav = $result['favorites'];

	$currentFav .= "," . $_GET['addtoFav'];

	echo $currentFav;

	$updateFav = $pdo->prepare("UPDATE `accounts` SET `favorites` = :favs WHERE `username` = :username");
	$updateFav->execute ( array (":favs" => $currentFav, ":username" => $_USERNAME) );
}

if ( isset($_GET['removeFromFav'])) {
	$getcurrentFavs = $pdo->prepare("SELECT `favorites` FROM `accounts` WHERE `username` = :username");
	$getcurrentFavs->execute(array(":username" => $_USERNAME));

	$result = $getcurrentFavs->fetch(PDO::FETCH_ASSOC);
	$currentFav = $result['favorites'];

	$currentFav = str_replace(',' . $_GET['removeFromFav'], "", $currentFav);

	echo $currentFav;

	$updateFav = $pdo->prepare("UPDATE `accounts` SET `favorites` = :favs WHERE `username` = :username");
	$updateFav->execute ( array (":favs" => $currentFav, ":username" => $_USERNAME) );
}

?>