<?php
	$host = "localhost";
	$dbname = "website";
	$user = "root";
	$pass = "";
	$testSite = false;

	$mailHost = 'mail.diamantsecret.com';
	$mailPort = 26;
	$mailSMTPAuth = true;
	$mailUsername = "contact@diamantsecret.com";
	$mailPassword = "contact@123";
	$adminEmail = "ryan.bhanwra@gmail.com";


	if ( session_status() == PHP_SESSION_NONE ) {
		session_start();
	}

	try{
		$pdo = new PDO("mysql:host=$host; dbname=$dbname", $user, $pass);
		$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	}
	catch (PDOException $e){
		echo '<strong>MySQL Error:</strong> ' . $e->getMessage();
		die();
	}
?>