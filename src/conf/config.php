<?php


    /*  MySQL Configuration */
	$host = "localhost";
	$dbname = "PROD_DIAMANTSECRET";
	$user = "diamants_prod";
	$pass = "_diamants";
	

	/* Mail Configuration */
	$mailHost = 'mail.diamantsecret.com';
	$mailPort = 26;
	$mailSMTPAuth = true;
	$mailUsername = "contact@diamantsecret.com";
	$mailPassword = "contact@123";
	$mailSenderEmail = "contact@diamantsecret.com";
	$mailSenderName = "Diamant Secret";
	$__ADMINMAIL__ = "contact@diamantsecret.com";
	$__ADMINNAME__ = "Admin";
	$__MAINDOMAIN__ = "http://www.diamantsecret.com/";
	
	
	/* Test site options */
	$testSite = false;
	$__TESTSITEPREFIX__ = "[Test Site] ";
	$__TESTSITEDOMAIN__ = "http://www.diamantsecret.com/testsite/";

	if ( $testSite ) {
		$__MAINDOMAIN__ = $__TESTSITEDOMAIN__;
	}

	
	/* Other changes */
	// - Update $rootPath in __php__.php file

	try{
		$pdo = new PDO("mysql:host=$host; dbname=$dbname", $user, $pass);
		$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

		$checkVersion = $pdo->prepare("SELECT * FROM `version` WHERE `id` = 1");
		$checkVersion->execute();

		if ( $checkVersion->rowCount() > 0 ) {
			$version = $checkVersion->fetch(PDO::FETCH_ASSOC);

			include ('version.php');

			if ( $version['sql_version'] == $__SQLVERSION__ ) {
				#continue
			} else {
				echo var_dump("INVALID DATABASE VERSION.", "Found: " . $version['sql_version'] , "Expected: $__SQLVERSION__");
				die();
			}
		}
	}
	catch (PDOException $e){
		echo '<strong>MySQL Error:</strong> ' . $e->getMessage();
		die();
	}

	#Public Panel Vars Only. Use $_SESSION in Admin
	if ( isset($_SESSION['username']) ) {
		$_USERNAME = $_SESSION['username'];
	}
	if ( isset($_SESSION['loginAs']) ) {
		$_USERNAME = $_SESSION['loginAs'];
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

	function getMaterial($mID, $pdo) {
		$getMaterial = $pdo->prepare("SELECT * FROM `materials` WHERE `id` = :id");
		$getMaterial->execute(array(":id" => $mID));

		if ( $getMaterial->rowCount() > 0 ) {
			$material = $getMaterial->fetch(PDO::FETCH_ASSOC);
			return $material['category'];
			//echo $material['category'];
		} else {
			return "N/A";
		}
	}
	function getDiamondShape($dsID, $pdo) {
		$getMaterial = $pdo->prepare("SELECT * FROM `diamond_shape` WHERE `id` = :id");
		$getMaterial->execute(array(":id" => $dsID));

		if ( $getMaterial->rowCount() > 0 ) {
			$material = $getMaterial->fetch(PDO::FETCH_ASSOC);
			return $material['category'];
			//echo $material['category'];
		} else {
			return "N/A";
		}
	}

	function getCountry($dsID, $pdo) {
		$getMaterial = $pdo->prepare("SELECT * FROM `country_vat` WHERE `id` = :id");
		$getMaterial->execute(array(":id" => $dsID));

		if ( $getMaterial->rowCount() > 0 ) {
			$material = $getMaterial->fetch(PDO::FETCH_ASSOC);
			return $material['country_name'];
			//echo $material['category'];
		} else {
			return "N/A";
		}
	}

	function getCompany($dsID, $pdo) {
		$getMaterial = $pdo->prepare("SELECT * FROM `company_id` WHERE `id` = :id");
		$getMaterial->execute(array(":id" => $dsID));

		if ( $getMaterial->rowCount() > 0 ) {
			$material = $getMaterial->fetch(PDO::FETCH_ASSOC);
			return $material['company_name'];
			//echo $material['category'];
		} else {
			return "N/A";
		}
	}

	function getCategory($dsID, $pdo) {
		$getMaterial = $pdo->prepare("SELECT * FROM `categories` WHERE `id` = :id");
		$getMaterial->execute(array(":id" => $dsID));

		if ( $getMaterial->rowCount() > 0 ) {
			$material = $getMaterial->fetch(PDO::FETCH_ASSOC);
			return $material['category'];
			//echo $material['category'];
		} else {
			return "N/A";
		}
	}
	function getRingCategory($dsID, $pdo) {
		$getMaterial = $pdo->prepare("SELECT * FROM `ring_subcategory` WHERE `id` = :id");
		$getMaterial->execute(array(":id" => $dsID));

		if ( $getMaterial->rowCount() > 0 ) {
			$material = $getMaterial->fetch(PDO::FETCH_ASSOC);
			return $material['category'];
			//echo $material['category'];
		} else {
			return "N/A";
		}
	}

?>