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
	$__IMPORT_IMAGE_RES__ = array(
		"LARGE" => 1600,
		"MED" => 600,
		"SMALL" => 200
	);

	$__MAX_MEMORY_LIMIT__ = '1024M';
	$__CRONJOB_DELETE_DAYS__ = 10;

	try{
		$pdo = new PDO("mysql:host=$host; dbname=$dbname", $user, $pass);
		$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

		if ( isset($_SESSION['loggedIn']) && $_SESSION['loggedIn'] ) {
			if ( !isset($_SESSION['_ref']) || $_SESSION['_ref'] !== "diamant_secret" ) {
				unset($_SESSION);
				session_destroy();
			}	
		} 

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

	function getCompanyCode($dsID, $pdo) {
		$getMaterial = $pdo->prepare("SELECT * FROM `company_id` WHERE `id` = :id");
		$getMaterial->execute(array(":id" => $dsID));

		if ( $getMaterial->rowCount() > 0 ) {
			$material = $getMaterial->fetch(PDO::FETCH_ASSOC);
			return $material['company_code'];
			//echo $material['category'];
		} else {
			return "N/A";
		}
	}

	function getCompanyID($dsID, $pdo) {
		$getMaterial = $pdo->prepare("SELECT * FROM `company_id` WHERE `company_code` = :company_code");
		$getMaterial->execute(array(":company_code" => $dsID));

		if ( $getMaterial->rowCount() > 0 ) {
			$material = $getMaterial->fetch(PDO::FETCH_ASSOC);
			return $material['id'];
			//echo $material['category'];
		} else {
			return 0;
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

	function updateImportZipItem( $pdo, $uniqueKey, $values, $zip, $timeToken, $domain, $imgRes ) {
		//return json_encode($values);

		$company_id = getCompanyID($values['A'], $pdo);

		$updateItem = $pdo->prepare("UPDATE `items` SET `item_name` = :product_name, `item_value` = :product_price, `discount` = :discount, `category` = :category, images_delta = :images_delta WHERE `unique_key` = :unique_key");
		$updateItem->execute(array(
			":unique_key" => $uniqueKey,
			":product_name" => $values['D'],
			":product_price" => $values['E'],
			":discount" => $values['F'],
			":category" => $values['B'],
			":images_delta" => $values['U']
		));
		switch ($values['B']) {
			case 1: {
				$updateInfo = $pdo->prepare("UPDATE `rings` SET `company_id` = :company_id, `internal_id` = :internal_id, `product_name` = :product_name, `pieces_in_stock` = :pieces_in_stock, `days_for_shipment` = :days_for_shipment, `total_carat_weight` = :total_carat_weight, `no_of_stones` = :no_of_stones, `diamond_shape` = :diamond_shape, `clarity` = :clarity, `color` = :color, `material` = :material, `height` = :height, `width` = :width, `length` = :length, `country_id` = :country_id, `description` = :description, `ring_subcategory` = :ring_subcategory, `ring_size` = :ring_size WHERE `unique_key` = :unique_key");
				$updateInfo->execute(array(
					":unique_key" => $uniqueKey,
					":company_id" => $company_id,
					":internal_id" => $values['C'],
					":product_name" => $values['D'],
					":pieces_in_stock" => $values['G'],
					":days_for_shipment" => $values['H'],
					":total_carat_weight" => $values['I'],
					":no_of_stones" => $values['J'],
					":diamond_shape" => $values['K'],
					":clarity" => $values['L'],
					":color" => $values['M'],
					":material" => $values['N'],
					":height" => $values['O'],
					":width" => $values['P'],
					":length" => $values['Q'],
					":country_id" => $values['R'],
					":description" => $values['V'],
					":ring_subcategory" => $values['S'],
					":ring_size" => $values['T']
				));


				$getitemID = $pdo->prepare("SELECT `id`, `images` FROM `rings` WHERE `unique_key` = :unique_key");
				$getitemID->execute(array(":unique_key" => $uniqueKey));
				$item = $getitemID->fetch(PDO::FETCH_ASSOC);
				$itemID = $item['id'];
				$itemImages = $item['images'];

				break;
			} case 2: {
				$updateInfo = $pdo->prepare("UPDATE `earrings` SET `company_id` = :company_id, `internal_id` = :internal_id, `product_name` = :product_name, `pieces_in_stock` = :pieces_in_stock, `days_for_shipment` = :days_for_shipment, `total_carat_weight` = :total_carat_weight, `no_of_stones` = :no_of_stones, `diamond_shape` = :diamond_shape, `clarity` = :clarity, `color` = :color, `material` = :material, `height` = :height, `width` = :width, `length` = :length, `country_id` = :country_id, `description` = :description WHERE `unique_key` = :unique_key");
				$updateInfo->execute(array(
					":unique_key" => $uniqueKey,
					":company_id" => $company_id,
					":internal_id" => $values['C'],
					":product_name" => $values['D'],
					":pieces_in_stock" => $values['G'],
					":days_for_shipment" => $values['H'],
					":total_carat_weight" => $values['I'],
					":no_of_stones" => $values['J'],
					":diamond_shape" => $values['K'],
					":clarity" => $values['L'],
					":color" => $values['M'],
					":material" => $values['N'],
					":height" => $values['O'],
					":width" => $values['P'],
					":length" => $values['Q'],
					":country_id" => $values['R'],
					":description" => $values['V']
				));

				
				$getitemID = $pdo->prepare("SELECT `id`, `images` FROM `earrings` WHERE `unique_key` = :unique_key");
				$getitemID->execute(array(":unique_key" => $uniqueKey));
				$item = $getitemID->fetch(PDO::FETCH_ASSOC);
				$itemID = $item['id'];
				$itemImages = $item['images'];

				break;
			} case 3: {
				$updateInfo = $pdo->prepare("UPDATE `pendants` SET `company_id` = :company_id, `internal_id` = :internal_id, `product_name` = :product_name, `pieces_in_stock` = :pieces_in_stock, `days_for_shipment` = :days_for_shipment, `total_carat_weight` = :total_carat_weight, `no_of_stones` = :no_of_stones, `diamond_shape` = :diamond_shape, `clarity` = :clarity, `color` = :color, `material` = :material, `height` = :height, `width` = :width, `length` = :length, `country_id` = :country_id, `description` = :description WHERE `unique_key` = :unique_key");
				$updateInfo->execute(array(
					":unique_key" => $uniqueKey,
					":company_id" => $company_id,
					":internal_id" => $values['C'],
					":product_name" => $values['D'],
					":pieces_in_stock" => $values['G'],
					":days_for_shipment" => $values['H'],
					":total_carat_weight" => $values['I'],
					":no_of_stones" => $values['J'],
					":diamond_shape" => $values['K'],
					":clarity" => $values['L'],
					":color" => $values['M'],
					":material" => $values['N'],
					":height" => $values['O'],
					":width" => $values['P'],
					":length" => $values['Q'],
					":country_id" => $values['R'],
					":description" => $values['V']
				));

				
				$getitemID = $pdo->prepare("SELECT `id`, `images` FROM `pendants` WHERE `unique_key` = :unique_key");
				$getitemID->execute(array(":unique_key" => $uniqueKey));
				$item = $getitemID->fetch(PDO::FETCH_ASSOC);
				$itemID = $item['id'];
				$itemImages = $item['images'];

				break;
			} case 4: {
				$updateInfo = $pdo->prepare("UPDATE `necklaces` SET `company_id` = :company_id, `internal_id` = :internal_id, `product_name` = :product_name, `pieces_in_stock` = :pieces_in_stock, `days_for_shipment` = :days_for_shipment, `total_carat_weight` = :total_carat_weight, `no_of_stones` = :no_of_stones, `diamond_shape` = :diamond_shape, `clarity` = :clarity, `color` = :color, `material` = :material, `height` = :height, `width` = :width, `length` = :length, `country_id` = :country_id, `description` = :description WHERE `unique_key` = :unique_key");
				$updateInfo->execute(array(
					":unique_key" => $uniqueKey,
					":company_id" => $company_id,
					":internal_id" => $values['C'],
					":product_name" => $values['D'],
					":pieces_in_stock" => $values['G'],
					":days_for_shipment" => $values['H'],
					":total_carat_weight" => $values['I'],
					":no_of_stones" => $values['J'],
					":diamond_shape" => $values['K'],
					":clarity" => $values['L'],
					":color" => $values['M'],
					":material" => $values['N'],
					":height" => $values['O'],
					":width" => $values['P'],
					":length" => $values['Q'],
					":country_id" => $values['R'],
					":description" => $values['V']
				));

				
				$getitemID = $pdo->prepare("SELECT `id`, `images` FROM `necklaces` WHERE `unique_key` = :unique_key");
				$getitemID->execute(array(":unique_key" => $uniqueKey));
				$item = $getitemID->fetch(PDO::FETCH_ASSOC);
				$itemID = $item['id'];
				$itemImages = $item['images'];

				break;
			} case 5: {
				$updateInfo = $pdo->prepare("UPDATE `bracelets` SET `company_id` = :company_id, `internal_id` = :internal_id, `product_name` = :product_name, `pieces_in_stock` = :pieces_in_stock, `days_for_shipment` = :days_for_shipment, `total_carat_weight` = :total_carat_weight, `no_of_stones` = :no_of_stones, `diamond_shape` = :diamond_shape, `clarity` = :clarity, `color` = :color, `material` = :material, `height` = :height, `width` = :width, `length` = :length, `country_id` = :country_id, `description` = :description WHERE `unique_key` = :unique_key");
				$updateInfo->execute(array(
					":unique_key" => $uniqueKey,
					":company_id" => $company_id,
					":internal_id" => $values['C'],
					":product_name" => $values['D'],
					":pieces_in_stock" => $values['G'],
					":days_for_shipment" => $values['H'],
					":total_carat_weight" => $values['I'],
					":no_of_stones" => $values['J'],
					":diamond_shape" => $values['K'],
					":clarity" => $values['L'],
					":color" => $values['M'],
					":material" => $values['N'],
					":height" => $values['O'],
					":width" => $values['P'],
					":length" => $values['Q'],
					":country_id" => $values['R'],
					":description" => $values['V']
				));

				
				$getitemID = $pdo->prepare("SELECT `id`, `images` FROM `bracelets` WHERE `unique_key` = :unique_key");
				$getitemID->execute(array(":unique_key" => $uniqueKey));
				$item = $getitemID->fetch(PDO::FETCH_ASSOC);
				$itemID = $item['id'];
				$itemImages = $item['images'];

				break;
			} default : {
				return "Invalid Item";
			}
		} 

		$imageFolder = "../images/";

		if ( is_dir($imageFolder) ) {

		} else if ( is_dir("../" . $imageFolder) ) {
			$imageFolder = "../" . $imageFolder;
		} else if ( is_dir("../../" . $imageFolder) ) {
			$imageFolder = "../../" . $imageFolder;
		}  else if ( is_dir("../../../" . $imageFolder) ) {
			$imageFolder = "../../../" . $imageFolder;
		}  else if ( is_dir("../../../../" . $imageFolder) ) {
			$imageFolder = "../../../../" . $imageFolder;
		} 

		switch ($values['B']) {
			case 1: {
				$imgName = "ring";
				break;
			} case 2: {
				$imgName = "earring";
				break;
			} case 3: {
				$imgName = "pendant";
				break;
			} case 4: {
				$imgName = "necklace";
				break;
			} case 5: {
				$imgName = "bracelet";
				break;
			} default: {
				return "Invalid Item";
			}
		}

		$intError = "";
		$images = "";

		#Deleting Old
		foreach ( explode(",", $itemImages) as $image ) {
			if ( !empty($image) ) {
				if ( is_file($imageFolder . 'images/' . $image) ) {
					unlink($imageFolder . 'images/' . $image);
				}
				if ( is_file($imageFolder . 'images_md/' . $image) ) {
					unlink($imageFolder . 'images_md/' . $image);
				}
				if ( is_file($imageFolder . 'images_sm/' . $image) ) {
					unlink($imageFolder . 'images_sm/' . $image);
				}
			}
		}

		#Adding Images
		foreach ( explode(",", $values['U']) as $image ) {
			if ( !empty($image) ) {
					
				if ( $zip == 1 ) {
					$url = $domain . 'working/zip/import/'. $timeToken .'/images/' . trim($image);
				} else {
					$url = trim($image);
				}

				$ext = explode(".", $url);
				$ext =  '.' . $ext[sizeof($ext)-1];
				$count = 0;
				$img = $imageFolder . 'images/'. $imgName . '_' . $itemID .'_' . $count . $ext;
				$img_md = $imageFolder . 'images_md/'. $imgName . '_' . $itemID .'_' . $count . $ext;
				$img_sm = $imageFolder . 'images_sm/'. $imgName . '_' . $itemID .'_' . $count . $ext;
				while ( file_exists($img) ) {
					$count++;
					$img = $imageFolder . 'images/'. $imgName . '_' . $itemID .'_' . $count . $ext;
					$img_md = $imageFolder . 'images_md/'. $imgName . '_' . $itemID .'_' . $count . $ext;
					$img_sm = $imageFolder . 'images_sm/'. $imgName . '_' . $itemID .'_' . $count . $ext;
				}

				if ( !is_dir($imageFolder . 'images/') ) {
					mkdir($imageFolder . 'images/');
				}
				if ( !is_dir($imageFolder . 'images_md/') ) {
					mkdir($imageFolder . 'images_md/');
				}
				if ( !is_dir($imageFolder . 'images_sm/') ) {
					mkdir($imageFolder . 'images_sm/');
				}
				


				$ch=curl_init();
				$timeout=30;

				curl_setopt($ch, CURLOPT_URL, $url);
				curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
				curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, $timeout);
				curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);

				$inputImg=curl_exec($ch);
				$curlError = curl_error($ch);
				$contentType = curl_getinfo($ch, CURLINFO_CONTENT_TYPE);
				curl_close($ch);

				if ( empty($curlError) ) {
					if ( strpos($contentType, "image/") === false ) {
						$intError .= 'Invalid Image: ' . $url . '<br>';
					} else {
						try {
							file_put_contents($img, $inputImg);
							create_thumb($img, $imgRes['LARGE'], $imgRes['LARGE'], $img);
							create_thumb($img, $imgRes['MED'], $imgRes['MED'], $img_md);
							create_thumb($img, $imgRes['SMALL'], $imgRes['SMALL'], $img_sm);
							$images .= basename($img) . ",";
						} catch (Exception $e) {
							$intError .= $e;
						}
					}
				} else {
					if ( strstr($curlError, "Connection timed out") ) {
						$intError .= 'Image took too long to download: ' . $url . '<br>' ;
					} else if ( strstr($curlError, "malformed" ) ) {
						$intError .= "Invalid Image URL";
					} else {
						$intError .= $curlError . '<br>' ;
					}
				}
			} else {
				$intError .= "No Image Found";
			}
		}

		switch ($values['B']) {
			case 1: {
				$updateImages = $pdo->prepare("UPDATE `rings` SET `images` = :images WHERE `unique_key` = :key");
				break;
			}
			case 2:	{
				$updateImages = $pdo->prepare("UPDATE `earrings` SET `images` = :images WHERE `unique_key` = :key");
				break;
			}
			case 3: {
				$updateImages = $pdo->prepare("UPDATE `pendants` SET `images` = :images WHERE `unique_key` = :key");
				break;
			}
			case 4: {
				$updateImages = $pdo->prepare("UPDATE `necklaces` SET `images` = :images WHERE `unique_key` = :key");
				break;
			}
			case 5: {
				$updateImages = $pdo->prepare("UPDATE `bracelets` SET `images` = :images WHERE `unique_key` = :key");
				break;
			} default: {
				return "Invalid Item";
			}
		}
		$updateImages->execute(array(":images" => $images, ":key" => $uniqueKey));

		if ( empty($intError) ) {
			$intError = "No Errors";
		}

		return " - ". $intError;

	}

?>