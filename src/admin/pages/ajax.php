<?php
if ( session_status() == PHP_SESSION_NONE ) {
	session_start();
}

if ( !isset($_SESSION['modSession']) ) {
	header ("location: ../../index.php");	
}


include '../../url/require.php';

/** Include path **/
set_include_path(get_include_path() . PATH_SEPARATOR . '../PHPExcel/PHPExcel/');

/** PHPExcel_IOFactory */
include '../PHPExcel/PHPExcel/IOFactory.php';

if ( isset($_GET['addSelected']) ) {
	if ( file_exists($_SESSION['tmp_file']) ) {
		$xlFile = $_SESSION['tmp_file'];
		$PHPExcel = PHPExcel_IOFactory::load($xlFile);

		//$xl = $PHPExcel->getActiveSheet()->toArray(null, true, true, true);

		$productSheet = $PHPExcel->getSheetByName('products');
		if ( is_null($productSheet) ) {
			echo "Sheet not found";
		} else {
			$products = $productSheet->toArray(null, true, true, true);
			$toAdd = explode("_", $_GET['addSelected']);

			$array = [];

			array_push($array, $products[1]);

			for ( $i = 1; $i <= sizeof($products); $i++ ) {
				if ( in_array($i, $toAdd) ) {
					array_push($array, $products[$i]);

					/*foreach ($worksheet->getRowIterator() as $row) {
				        $cellIterator = $row->getCellIterator();
				        $cellIterator->setIterateOnlyExistingCells(true);
				        foreach ($cellIterator as $cell) {
				            if ($cell->getValue() == $searchValue) {
				                $foundInCells[] = $ws . '!' . $cell->getCoordinate();
				            }
				        }
				    }*/

				}
			}

			$error = "";

			if ( sizeof($array[0]) !== 22 ) {
				echo '<h4><div class="alert alert-error">Invalid Excel Format</div></h4><p>Please download the defined Excel Format and use that to input entries.</p><br><br><br><br>
				<a class="btn btn-custom" href="../excel_files/format.xlsx">Download Format</a>';
				return;
			}

			if ( !isset($array[0]['A']) || $array[0]['A'] !== "Company Id" ){
				$error .= "Invalid Column: <strong>" . $array[0]['A'] . "</strong><br>";
			}
			if ( !isset($array[0]['B']) || $array[0]['B'] !== "Category Id" ){
				$error .= "Invalid Column: <strong>" . $array[0]['B'] . "</strong><br>";
			}
			if ( !isset($array[0]['C']) || $array[0]['C'] !== "Internal Id" ){
				$error .= "Invalid Column: <strong>" . $array[0]['C'] . "</strong><br>";
			}
			if ( !isset($array[0]['D']) || $array[0]['D'] !== "Product Name"){
				$error .= "Invalid Column: <strong>" . $array[0]['D'] . "</strong><br>";
			}
			if ( !isset($array[0]['E']) || $array[0]['E'] !== "Amount" ){
				$error .= "Invalid Column: <strong>" . $array[0]['E'] . "</strong><br>";
			}
			if ( !isset($array[0]['F']) || $array[0]['F'] !== "Discount Percent" ){
				$error .= "Invalid Column: <strong>" . $array[0]['F'] . "</strong><br>";
			}
			if ( !isset($array[0]['G']) || $array[0]['G'] !== "Pieces in stock" ){
				$error .= "Invalid Column: <strong>" . $array[0]['G'] . "</strong><br>";
			}
			if ( !isset($array[0]['H']) || $array[0]['H'] !== "Days for shipment" ){
				$error .= "Invalid Column: <strong>" . $array[0]['H'] . "</strong><br>";
			}
			if ( !isset($array[0]['I']) || $array[0]['I'] !== "Total carat weight" ){
				$error .= "Invalid Column: <strong>" . $array[0]['I'] . "</strong><br>";
			}
			if ( !isset($array[0]['J']) || $array[0]['J'] !== "No. of stones" ){
				$error .= "Invalid Column: <strong>" . $array[0]['J'] . "</strong><br>";
			}
			if ( !isset($array[0]['K']) || $array[0]['K'] !== "Diamond Shape" ){
				$error .= "Invalid Column: <strong>" . $array[0]['K'] . "</strong><br>";
			}
			if ( !isset($array[0]['L']) || $array[0]['L'] !== "Clarity" ){
				$error .= "Invalid Column: <strong>" . $array[0]['L'] . "</strong><br>";
			}
			if ( !isset($array[0]['M']) || $array[0]['M'] !== "Color" ){
				$error .= "Invalid Column: <strong>" . $array[0]['M'] . "</strong><br>";
			}
			if ( !isset($array[0]['N']) || $array[0]['N'] !== "Material" ){
				$error .= "Invalid Column: <strong>" . $array[0]['N'] . "</strong><br>";
			}
			if ( !isset($array[0]['O']) || $array[0]['O'] !== "Height" ){
				$error .= "Invalid Column: <strong>" . $array[0]['O'] . "</strong><br>";
			}
			if ( !isset($array[0]['P']) || $array[0]['P'] !== "Width" ){
				$error .= "Invalid Column: <strong>" . $array[0]['P'] . "</strong><br>";
			}
			if ( !isset($array[0]['Q']) || $array[0]['Q'] !== "Length" ){
				$error .= "Invalid Column: <strong>" . $array[0]['Q'] . "</strong><br>";
			}
			if ( !isset($array[0]['R']) || $array[0]['R'] !== "Country Id" ){
				$error .= "Invalid Column: <strong>" . $array[0]['R'] . "</strong><br>";
			}
			if ( !isset($array[0]['S']) || $array[0]['S'] !== "Ring subcategory" ){
				$error .= "Invalid Column: <strong>" . $array[0]['S'] . "</strong><br>";
			}
			if ( !isset($array[0]['T']) || $array[0]['T'] !== "Ring size" ){
				$error .= "Invalid Column: <strong>" . $array[0]['T'] . "</strong><br>";
			}
			if ( !isset($array[0]['U']) || $array[0]['U'] !== "Images (comma \",\" separated)" ){
				$error .= "Invalid Column: <strong>" . $array[0]['U'] . "</strong><br>";
			}
			if ( !isset($array[0]['V']) || $array[0]['V'] !== "Description" ) {
				$error .= "Invalid Column: <strong>" . $array[0]['V'] . "</strong><br>";
			}

			if ( empty($error) ) {
				$result = "";
				for ( $i = 1; $i < sizeof($array); $i++ ) {
					$uniqueKey = generateUniqueKey();
					
					while ( checkKey($uniqueKey, $pdo) ) {
						$uniqueKey = generateUniqueKey();
					}

					$addItem = $pdo->prepare("INSERT INTO `items` (`unique_key`, `item_name`, `item_value`, `discount`, `category`, `featured`, `date_added`) VALUES (:unique_key, :product_name, :product_price, :discount, :category, 0, NOW())");
						$addItem->execute(array(
							":unique_key" => $uniqueKey,
							":product_name" => $array[$i]['D'],
							":product_price" => $array[$i]['E'],
							":discount" => $array[$i]['F'],
							":category" => $array[$i]['B']
						));

					switch ($array[$i]['B']) {
						case 1: {
							$addInfo = $pdo->prepare("INSERT INTO `rings` 
								(`unique_key`, `company_id`, `internal_id`, `product_name`, `pieces_in_stock`, `days_for_shipment`, `total_carat_weight`, `no_of_stones`, `diamond_shape`, `clarity`, `color`, `material`, `height`, `width`, `length`, `country_id`, `images`, `description`, `ring_subcategory`, `ring_size`) 
								VALUES 
								(:unique_key, :company_id, :internal_id, :product_name, :pieces_in_stock, :days_for_shipment, :total_carat_weight, :no_of_stones, :diamond_shape, :clarity, :color, :material, :height, :width, :length, :country_id, :images, :description, :ring_subcategory, :ring_size)");
							$addInfo->execute(array(
								":unique_key" => $uniqueKey,
								":company_id" => $array[$i]['A'],
								":internal_id" => $array[$i]['C'],
								":product_name" => $array[$i]['D'],
								":pieces_in_stock" => $array[$i]['G'],
								":days_for_shipment" => $array[$i]['H'],
								":total_carat_weight" => $array[$i]['I'],
								":no_of_stones" => $array[$i]['J'],
								":diamond_shape" => $array[$i]['K'],
								":clarity" => $array[$i]['L'],
								":color" => $array[$i]['M'],
								":material" => $array[$i]['N'],
								":height" => $array[$i]['O'],
								":width" => $array[$i]['P'],
								":length" => $array[$i]['Q'],
								":country_id" => $array[$i]['R'],
								":images" => "",
								":description" => $array[$i]['V'],
								":ring_subcategory" => $array[$i]['S'],
								":ring_size" => $array[$i]['T']
							));


							$getitemID = $pdo->prepare("SELECT `id` FROM `rings` WHERE `unique_key` = :unique_key");
							$getitemID->execute(array(":unique_key" => $uniqueKey));
							$itemID = $getitemID->fetch(PDO::FETCH_ASSOC);
							$itemID = $itemID['id'];

							break;
						} case 2: {
							$addInfo = $pdo->prepare("INSERT INTO `earrings` 
								(`unique_key`, `company_id`, `internal_id`, `product_name`, `pieces_in_stock`, `days_for_shipment`, `total_carat_weight`, `no_of_stones`, `diamond_shape`, `clarity`, `color`, `material`, `height`, `width`, `length`, `country_id`, `images`, `description`) 
								VALUES 
								(:unique_key, :company_id, :internal_id, :product_name, :pieces_in_stock, :days_for_shipment, :total_carat_weight, :no_of_stones, :diamond_shape, :clarity, :color, :material, :height, :width, :length, :country_id, :images, :description)");
							$addInfo->execute(array(
								":unique_key" => $uniqueKey,
								":company_id" => $array[$i]['A'],
								":internal_id" => $array[$i]['C'],
								":product_name" => $array[$i]['D'],
								":pieces_in_stock" => $array[$i]['G'],
								":days_for_shipment" => $array[$i]['H'],
								":total_carat_weight" => $array[$i]['I'],
								":no_of_stones" => $array[$i]['J'],
								":diamond_shape" => $array[$i]['K'],
								":clarity" => $array[$i]['L'],
								":color" => $array[$i]['M'],
								":material" => $array[$i]['N'],
								":height" => $array[$i]['O'],
								":width" => $array[$i]['P'],
								":length" => $array[$i]['Q'],
								":country_id" => $array[$i]['R'],
								":images" => "",
								":description" => $array[$i]['V']
							));

							
							$getitemID = $pdo->prepare("SELECT `id` FROM `earrings` WHERE `unique_key` = :unique_key");
							$getitemID->execute(array(":unique_key" => $uniqueKey));
							$itemID = $getitemID->fetch(PDO::FETCH_ASSOC);
							$itemID = $itemID['id'];

							break;
						} case 3: {
							$addInfo = $pdo->prepare("INSERT INTO `pendants` 
								(`unique_key`, `company_id`, `internal_id`, `product_name`, `pieces_in_stock`, `days_for_shipment`, `total_carat_weight`, `no_of_stones`, `diamond_shape`, `clarity`, `color`, `material`, `height`, `width`, `length`, `country_id`, `images`, `description`) 
								VALUES 
								(:unique_key, :company_id, :internal_id, :product_name, :pieces_in_stock, :days_for_shipment, :total_carat_weight, :no_of_stones, :diamond_shape, :clarity, :color, :material, :height, :width, :length, :country_id, :images, :description)");
							$addInfo->execute(array(
								":unique_key" => $uniqueKey,
								":company_id" => $array[$i]['A'],
								":internal_id" => $array[$i]['C'],
								":product_name" => $array[$i]['D'],
								":pieces_in_stock" => $array[$i]['G'],
								":days_for_shipment" => $array[$i]['H'],
								":total_carat_weight" => $array[$i]['I'],
								":no_of_stones" => $array[$i]['J'],
								":diamond_shape" => $array[$i]['K'],
								":clarity" => $array[$i]['L'],
								":color" => $array[$i]['M'],
								":material" => $array[$i]['N'],
								":height" => $array[$i]['O'],
								":width" => $array[$i]['P'],
								":length" => $array[$i]['Q'],
								":country_id" => $array[$i]['R'],
								":images" => "",
								":description" => $array[$i]['V']
							));

							
							$getitemID = $pdo->prepare("SELECT `id` FROM `pendants` WHERE `unique_key` = :unique_key");
							$getitemID->execute(array(":unique_key" => $uniqueKey));
							$itemID = $getitemID->fetch(PDO::FETCH_ASSOC);
							$itemID = $itemID['id'];

							break;
						} case 4: {
							$addInfo = $pdo->prepare("INSERT INTO `necklaces` 
								(`unique_key`, `company_id`, `internal_id`, `product_name`, `pieces_in_stock`, `days_for_shipment`, `total_carat_weight`, `no_of_stones`, `diamond_shape`, `clarity`, `color`, `material`, `height`, `width`, `length`, `country_id`, `images`, `description`) 
								VALUES 
								(:unique_key, :company_id, :internal_id, :product_name, :pieces_in_stock, :days_for_shipment, :total_carat_weight, :no_of_stones, :diamond_shape, :clarity, :color, :material, :height, :width, :length, :country_id, :images, :description)");
							$addInfo->execute(array(
								":unique_key" => $uniqueKey,
								":company_id" => $array[$i]['A'],
								":internal_id" => $array[$i]['C'],
								":product_name" => $array[$i]['D'],
								":pieces_in_stock" => $array[$i]['G'],
								":days_for_shipment" => $array[$i]['H'],
								":total_carat_weight" => $array[$i]['I'],
								":no_of_stones" => $array[$i]['J'],
								":diamond_shape" => $array[$i]['K'],
								":clarity" => $array[$i]['L'],
								":color" => $array[$i]['M'],
								":material" => $array[$i]['N'],
								":height" => $array[$i]['O'],
								":width" => $array[$i]['P'],
								":length" => $array[$i]['Q'],
								":country_id" => $array[$i]['R'],
								":images" => "",
								":description" => $array[$i]['V']
							));

							
							$getitemID = $pdo->prepare("SELECT `id` FROM `necklaces` WHERE `unique_key` = :unique_key");
							$getitemID->execute(array(":unique_key" => $uniqueKey));
							$itemID = $getitemID->fetch(PDO::FETCH_ASSOC);
							$itemID = $itemID['id'];

							break;
						} case 5: {
							$addInfo = $pdo->prepare("INSERT INTO `bracelets` 
								(`unique_key`, `company_id`, `internal_id`, `product_name`, `pieces_in_stock`, `days_for_shipment`, `total_carat_weight`, `no_of_stones`, `diamond_shape`, `clarity`, `color`, `material`, `height`, `width`, `length`, `country_id`, `images`, `description`) 
								VALUES 
								(:unique_key, :company_id, :internal_id, :product_name, :pieces_in_stock, :days_for_shipment, :total_carat_weight, :no_of_stones, :diamond_shape, :clarity, :color, :material, :height, :width, :length, :country_id, :images, :description)");
							$addInfo->execute(array(
								":unique_key" => $uniqueKey,
								":company_id" => $array[$i]['A'],
								":internal_id" => $array[$i]['C'],
								":product_name" => $array[$i]['D'],
								":pieces_in_stock" => $array[$i]['G'],
								":days_for_shipment" => $array[$i]['H'],
								":total_carat_weight" => $array[$i]['I'],
								":no_of_stones" => $array[$i]['J'],
								":diamond_shape" => $array[$i]['K'],
								":clarity" => $array[$i]['L'],
								":color" => $array[$i]['M'],
								":material" => $array[$i]['N'],
								":height" => $array[$i]['O'],
								":width" => $array[$i]['P'],
								":length" => $array[$i]['Q'],
								":country_id" => $array[$i]['R'],
								":images" => "",
								":description" => $array[$i]['V']
							));

							
							$getitemID = $pdo->prepare("SELECT `id` FROM `bracelets` WHERE `unique_key` = :unique_key");
							$getitemID->execute(array(":unique_key" => $uniqueKey));
							$itemID = $getitemID->fetch(PDO::FETCH_ASSOC);
							$itemID = $itemID['id'];

							break;
						} 
					}

					switch ($array[$i]['B']) {
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
						}
					}

					$intError = "";
					$images = "";
					$imageArray = explode(",", 	$array[$i]['U']);

					for ( $j = 0; $j < sizeof($imageArray); $j++ ) {
						$url = trim($imageArray[$j]);

						$ext = explode(".", $url);
						$ext =  '.' . $ext[sizeof($ext)-1];
						$count = 0;
						$img = '../../images/'. $imgName . '_' . $itemID .'_' . $count . $ext;
						$thumb = '../../images/thumbnails/'. $imgName . '_' . $itemID .'_' . $count . $ext;
						while ( file_exists($img) ) {
							$count++;
							$img = '../../images/'. $imgName . '_' . $itemID .'_' . $count . $ext;
							$thumb = '../../images/thumbnails/'. $imgName . '_' . $itemID .'_' . $count . $ext;
						}


						$ch=curl_init();
						$timeout=5;

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
								file_put_contents($img, $inputImg);
								create_thumb($img, 200, 200, $thumb);
								$images .= basename($img) . ",";
							}
						} else {
							if ( strrpos($curlError, "Connection timed out") === false ) {
								$intError .= $curlError . '<br>' ;
							} else {
								$intError .= 'Image took too long to download: ' . $url . '<br>' ;
							}
						}


					}

					switch ($array[$i]['B']) {
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
					}
				}
				$updateImages->execute(array(":images" => $images, ":key" => $uniqueKey));


					if ( empty($intError) ) {
						$intError = "None";
					}
					$result .= "<tr><td>Added New Entry: " . $array[$i]['D'] . "</td><td>" . $intError .  "</td></tr>";
				}

				echo "<h4><div class='alert alert-success'>Success</div></h4><table class='table table-condensed table-custom'><thead><th>Entry</th><th>Errors</th></thead><tbody>" . $result . "</tbody></table>" . (sizeof($array) - 1) . " New Entries";

			} else {
				echo '<h4>Import Failed</h4><br>'. $error . "<br>Please Fix The Errors and Try to Import Again";
			}

		}

	} else {
		echo "Error: File Invalid";
	}
} else if ( isset($_GET['exportSelected']) ) {
	echo $_GET['exportSelected'];

	$file = '../excel_files/'. date("d-F-Y");
	$ext = '.xlsx';

	$count = 1;
	while ( file_exists($file . $ext) ) {
		$file = '../excel_files/'. date("d-F-Y") . '_' . $count;
		$count++;
	}

	$outputExcel = new PHPExcel();

	$outputExcel->setActiveSheetIndex(0);
	$outputExcel->getActiveSheet()->setTitle('products');

	#Adding Columns
	$outputExcel->getActiveSheet()->getStyle('A1:T1')->getFont()->setBold(true);
	$outputExcel->getActiveSheet()->setCellValue('A1', "Company Id" );
	$outputExcel->getActiveSheet()->setCellValue('B1', "Category Id" );
	$outputExcel->getActiveSheet()->setCellValue('C1', "Internal Id" );
	$outputExcel->getActiveSheet()->setCellValue('D1', "Product Name");
	$outputExcel->getActiveSheet()->setCellValue('E1', "Amount" );
	$outputExcel->getActiveSheet()->setCellValue('F1', "Discount Percent" );
	$outputExcel->getActiveSheet()->setCellValue('G1', "Pieces in stock" );
	$outputExcel->getActiveSheet()->setCellValue('H1', "Days for shipment" );
	$outputExcel->getActiveSheet()->setCellValue('I1', "Total carat weight" );
	$outputExcel->getActiveSheet()->setCellValue('J1', "No. of stones" );
	$outputExcel->getActiveSheet()->setCellValue('K1', "Diamond Shape" );
	$outputExcel->getActiveSheet()->setCellValue('L1', "Clarity" );
	$outputExcel->getActiveSheet()->setCellValue('M1', "Color" );
	$outputExcel->getActiveSheet()->setCellValue('N1', "Material" );
	$outputExcel->getActiveSheet()->setCellValue('O1', "Height" );
	$outputExcel->getActiveSheet()->setCellValue('P1', "Width" );
	$outputExcel->getActiveSheet()->setCellValue('Q1', "Length" );
	$outputExcel->getActiveSheet()->setCellValue('R1', "Country Id" );
	$outputExcel->getActiveSheet()->setCellValue('S1', "Ring subcategory" );
	$outputExcel->getActiveSheet()->setCellValue('T1', "Ring size" );
	$outputExcel->getActiveSheet()->setCellValue('U1', "Images (comma \",\" separated)" );
	$outputExcel->getActiveSheet()->setCellValue('V1', "Description" ) ;

	#$outputExcel->getActiveSheet()->getStyle('V1:V'.$outputExcel->getActiveSheet()->getHighestRow())->getAlignment()->setWrapText(true);
	#$outputExcel->getActiveSheet()->getStyle('U1:U'.$outputExcel->getActiveSheet()->getHighestRow())->getAlignment()->setWrapText(true);

	$getItems = $pdo->prepare("SELECT * FROM `items`");
	$getItems->execute();

	$allItems = $getItems->fetchAll();

	$array = [];

	if ( !empty($_GET['exportSelected']) ) {
		foreach ( $allItems as $selected ) {
			if ( strpos($_GET['exportSelected'], $selected['unique_key']) === false ) {
				
			} else {
				array_push($array, $selected);
			}
		}
	} else {
		$array = $allItems;
	}

	$row = 2;
	foreach ( $array as $item ) {
		switch ($item['category']) {
			case 1: {
				$itemInfo = $pdo->prepare("SELECT * FROM `rings` WHERE `unique_key` = :uniqueKey");
				break;
			} case 2: {
				$itemInfo = $pdo->prepare("SELECT * FROM `earrings` WHERE `unique_key` = :uniqueKey");
				break;
			} case 3: {
				$itemInfo = $pdo->prepare("SELECT * FROM `pendants` WHERE `unique_key` = :uniqueKey");
				break;
			} case 4: {
				$itemInfo = $pdo->prepare("SELECT * FROM `necklaces` WHERE `unique_key` = :uniqueKey");
				break;
			} case 5: {
				$itemInfo = $pdo->prepare("SELECT * FROM `bracelets` WHERE `unique_key` = :uniqueKey");
				break;
			} 
		}
		$itemInfo->execute(array(":uniqueKey" => $item['unique_key']));

		$itemInfo = $itemInfo->fetch(PDO::FETCH_ASSOC);

		if ( !isset($itemInfo['ring_subcategory']) ) {
			$itemInfo['ring_subcategory'] = $itemInfo['ring_size'] = "ITEM_NOT_RING";
		}

		$numImg = "";

		$imgArray = explode(",", $itemInfo['images']);

		foreach ( $imgArray as $img ) {
			if ( !empty($img) ) {
				$numImg .= "http://diamantsecret.com/images/" . $img . ",";
			}
		}

		$outputExcel->getActiveSheet()->setCellValue('A' . $row , $itemInfo['company_id']);
		$outputExcel->getActiveSheet()->setCellValue('B' . $row , $item['category']);
		$outputExcel->getActiveSheet()->setCellValue('C' . $row , $itemInfo['internal_id']);
		$outputExcel->getActiveSheet()->setCellValue('D' . $row , $itemInfo['product_name']);
		$outputExcel->getActiveSheet()->setCellValue('E' . $row , $item['item_value']);
		$outputExcel->getActiveSheet()->setCellValue('F' . $row , $item['discount']);
		$outputExcel->getActiveSheet()->setCellValue('G' . $row , $itemInfo['pieces_in_stock']);
		$outputExcel->getActiveSheet()->setCellValue('H' . $row , $itemInfo['days_for_shipment']);
		$outputExcel->getActiveSheet()->setCellValue('I' . $row , $itemInfo['total_carat_weight']);
		$outputExcel->getActiveSheet()->setCellValue('J' . $row , $itemInfo['no_of_stones']);
		$outputExcel->getActiveSheet()->setCellValue('K' . $row , $itemInfo['diamond_shape']);
		$outputExcel->getActiveSheet()->setCellValue('L' . $row , $itemInfo['clarity']);
		$outputExcel->getActiveSheet()->setCellValue('M' . $row , $itemInfo['color']);
		$outputExcel->getActiveSheet()->setCellValue('N' . $row , $itemInfo['material']);
		$outputExcel->getActiveSheet()->setCellValue('O' . $row , $itemInfo['height']);
		$outputExcel->getActiveSheet()->setCellValue('P' . $row , $itemInfo['width']);
		$outputExcel->getActiveSheet()->setCellValue('Q' . $row , $itemInfo['length']);
		$outputExcel->getActiveSheet()->setCellValue('R' . $row , $itemInfo['country_id']);
		$outputExcel->getActiveSheet()->setCellValue('S' . $row , $itemInfo['ring_subcategory']);
		$outputExcel->getActiveSheet()->setCellValue('T' . $row , $itemInfo['ring_size']);
		$outputExcel->getActiveSheet()->setCellValue('U' . $row , $numImg);
		$outputExcel->getActiveSheet()->setCellValue('V' . $row , $itemInfo['description']);


		$row++;
	} 


	header('Content-Type: application/vnd.ms-excel'); 
	header('Content-Disposition: attachment;filename="results.xlsx"'); 
	header('Cache-Control: max-age=0'); 
	$outputExcel = PHPExcel_IOFactory::createWriter($outputExcel, 'Excel2007'); 
	$outputExcel->save($file . $ext);

	echo '<h4><div class="alert alert-success">Export Successful</div></h4><br><br><p>Backup Created: ' . basename($file . $ext) . '<br><br><a class="btn btn-custom" href="../excel_files/'. $file . $ext .'">Download</a>';

} else {
	echo "GET not SET";
}




	function create_thumb($file, $w, $h,  $thumb_dir, $crop=FALSE) {
		list($width, $height) = getimagesize($file);
		$r = $width / $height;
		if ($crop) {
			if ($width > $height) {
				$width = ceil($width-($width*abs($r-$w/$h)));
			} else {
				$height = ceil($height-($height*abs($r-$w/$h)));
			}
			$newwidth = $w;
			$newheight = $h;
		} else {
			if ($w/$h > $r) {
				$newwidth = $h*$r;
				$newheight = $h;
			} else {
				$newheight = $w/$r;
				$newwidth = $w;
			}
		}
		$src = imagecreatefromjpeg($file);
		$dst = imagecreatetruecolor($newwidth, $newheight);
		imagecopyresampled($dst, $src, 0, 0, 0, 0, $newwidth, $newheight, $width, $height);
		
		return imagejpeg($dst, $thumb_dir);
	}
		
	function generateUniqueKey($length = 10) {
		$characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
		$charactersLength = strlen($characters);
		$randomString = '';
		for ($i = 0; $i < $length; $i++) {
			$randomString .= $characters[rand(0, $charactersLength - 1)];
		}
		return $randomString;
	}

	function checkKey($key, $pdo) {
		$checkKey = $pdo->prepare("SELECT * FROM `items` WHERE `unique_key` = :key");
		$checkKey->execute(array(":key" => $key));
		if ( $checkKey->rowCount() > 0 ) {
			return true; // Key exists
		} else {
			return false;
		}
	}


	function grab_image($url,$saveto){
	    $ch = curl_init ($url);
	    curl_setopt($ch, CURLOPT_HEADER, 0);
	    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	    curl_setopt($ch, CURLOPT_BINARYTRANSFER,1);
	    curl_setopt($ch,CURLOPT_USERAGENT,'Mozilla/5.0 (Windows; U; Windows NT 5.1; en-US; rv:1.8.1.13) Gecko/20080311 Firefox/2.0.0.13');
	    $raw=curl_exec($ch);
	    curl_close ($ch);
	    if(file_exists($saveto)){
	        unlink($saveto);
	    }
	    $fp = fopen($saveto,'x');
	    fwrite($fp, $raw);
	    fclose($fp);
	}
?>