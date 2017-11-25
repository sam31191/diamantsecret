<?php

//error_reporting(0);

	require_once("lib/streams.php");
	require_once("lib/gettext.php");

	$locle_lang = 'en';

	if(isset($_GET['lang'])){

		$locle_lang = $_GET['lang'];
	}

	if(basename($_SERVER['PHP_SELF']) == 'ajax.php' || basename($_SERVER['PHP_SELF']) == 'fetch_item_info.php' || basename($_SERVER['PHP_SELF']) == 'post.php'){
		$locale_file = new FileReader("../translation/locale/$locle_lang/LC_MESSAGES/diamantsecret_fr.mo");
	}else{
		$locale_file = new FileReader("translation/locale/$locle_lang/LC_MESSAGES/diamantsecret_fr.mo");
	}

	$locale_fetch = new gettext_reader($locale_file);

	function __($text){


		global $locale_fetch;

		return $locale_fetch->translate($text);

	}
?>