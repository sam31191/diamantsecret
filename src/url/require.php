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
	
	function get_client_ip() {
		$ipaddress = '';
		if (getenv('HTTP_CLIENT_IP'))
			$ipaddress = getenv('HTTP_CLIENT_IP');
		else if(getenv('HTTP_X_FORWARDED_FOR'))
			$ipaddress = getenv('HTTP_X_FORWARDED_FOR');
		else if(getenv('HTTP_X_FORWARDED'))
			$ipaddress = getenv('HTTP_X_FORWARDED');
		else if(getenv('HTTP_FORWARDED_FOR'))
			$ipaddress = getenv('HTTP_FORWARDED_FOR');
		else if(getenv('HTTP_FORWARDED'))
		   $ipaddress = getenv('HTTP_FORWARDED');
		else if(getenv('REMOTE_ADDR'))
			$ipaddress = getenv('REMOTE_ADDR');
		else
			$ipaddress = 'UNKNOWN';
		return $ipaddress;
	}

	function pconsole($data) {
	    if(is_array($data) || is_object($data))
		{
			echo("<script>console.log('PHP: ".json_encode($data)."');</script>");
		} else {
			echo("<script>console.log('PHP: ".$data."');</script>");
		}
	}

	function getMaterial($mID) {
		$getMaterial = $pdo->prepare("SELECT * FROM `materials` WHERE `id` = :id");
		$getMaterial->execute(array(":id" => $mID));

		if ( $getMaterial->rowCount() > 0 ) {
			$material = $getMaterial->fetch(PDO::FETCH_ASSOC);
			return $material['category'];
			echo $material['category'];
		} else {
			return "N/A";
		}
	}


?>