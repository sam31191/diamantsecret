<?php
	include_once('conf/config.php');
	require_once("translation/lib/streams.php");
	require_once("translation/lib/gettext.php");
	
	$locle_lang = $_GET['lang'];
	$locale_file = new FileReader("translation/locale/$locle_lang/LC_MESSAGES/diamantsecret_fr.mo");
	$locale_fetch = new gettext_reader($locale_file);
	echo $img_alt =  makeProductDetailPageUrl($_REQUEST['subcat'],$_REQUEST['carat'],$_REQUEST['quality'],$_REQUEST['material'],$_REQUEST['p_name'],$_REQUEST['p_id']);
?>