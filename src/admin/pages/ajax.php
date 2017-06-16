<?php
include '../../conf/config.php';
ini_set('memory_limit', $__MAX_MEMORY_LIMIT__);
ini_set('max_execution_time', 600);
if ( session_status() == PHP_SESSION_NONE ) {
	session_start();
}
if ( !isset($_SESSION['modSession']) ) {
	header ("location: ../../index.php");	
	exit();
}

$updated = 0;
$duplicate = 0;

/** Include path **/
set_include_path(get_include_path() . PATH_SEPARATOR . '../PHPExcel/PHPExcel/');

/** PHPExcel_IOFactory */
include '../PHPExcel/PHPExcel/IOFactory.php';
if ( isset($_GET['importThis']) ) {
	
	if ( file_exists($_SESSION['tmp_file']) ) {

		$xlFile = $_SESSION['tmp_file'];

		include './chunk_reader.php';
		$objReader = PHPExcel_IOFactory::createReader(PHPExcel_IOFactory::identify($xlFile));
		$readFilter = new myReadFilter();
		$objReader->setReadFilter($readFilter);
		$readFilter->getRow($_GET['importThis']);

		$PHPExcel = $objReader->load($xlFile);

		//$xl = $PHPExcel->getActiveSheet()->toArray(null, true, true, true);

		$productSheet = $PHPExcel->getSheetByName('products');
		if ( is_null($productSheet) ) {
			echo "Sheet not found";
		} else {
			$products = $productSheet->toArray(null, true, true, true);
			//$toAdd = explode("_", $_GET['importThis']);

			$error = "";

			if ( strpos($xlFile, $_GET['timeToken']) !== false ) {
				
			} else {
				$error = "Invalid Session File / You either have another window open with the same task or the Session has expired <br> Please refresh or continue on the other window";
			}

			if ( sizeof($products[1]) !=3027 ) {
				echo '<h4><div class="alert alert-error">Invalid Excel Format</div></h4><p>Please download the defined Excel Format and use that to input entries.</p><br><br><br><br>
				<a class="btn btn-custom"onclick="downloadFormat()">Download Format</a>';
				return;
			}

			if ( !isset($products[1]['A']) || $products[1]['A'] !== "Company Id" ){
				$error .= "Invalid Column: <strong>" . $products[1]['A'] . "</strong><br>";
			}
			if ( !isset($products[1]['B']) || $products[1]['B'] !== "Category Id" ){
				$error .= "Invalid Column: <strong>" . $products[1]['B'] . "</strong><br>";
			}
			if ( !isset($products[1]['C']) || $products[1]['C'] !== "Internal Id" ){
				$error .= "Invalid Column: <strong>" . $products[1]['C'] . "</strong><br>";
			}
			if ( !isset($products[1]['D']) || $products[1]['D'] !== "Product Name"){
				$error .= "Invalid Column: <strong>" . $products[1]['D'] . "</strong><br>";
			}
			if ( !isset($products[1]['E']) || $products[1]['E'] !== "Amount" ){
				$error .= "Invalid Column: <strong>" . $products[1]['E'] . "</strong><br>";
			}
			if ( !isset($products[1]['F']) || $products[1]['F'] !== "Discount Percent" ){
				$error .= "Invalid Column: <strong>" . $products[1]['F'] . "</strong><br>";
			}
			if ( !isset($products[1]['G']) || $products[1]['G'] !== "Pieces in stock" ){
				$error .= "Invalid Column: <strong>" . $products[1]['G'] . "</strong><br>";
			}
			if ( !isset($products[1]['H']) || $products[1]['H'] !== "Days for shipment" ){
				$error .= "Invalid Column: <strong>" . $products[1]['H'] . "</strong><br>";
			}
			if ( !isset($products[1]['I']) || $products[1]['I'] !== "Total gold weight" ){
				$error .= "Invalid Column: <strong>" . $products[1]['I'] . "</strong><br>";
			}
			if ( !isset($products[1]['J']) || $products[1]['J'] !== "Total carat weight" ){
				$error .= "Invalid Column: <strong>" . $products[1]['J'] . "</strong><br>";
			}
			if ( !isset($products[1]['K']) || $products[1]['K'] !== "Color stone carat" ){
				$error .= "Invalid Column: <strong>" . $products[1]['K'] . "</strong><br>";
			}
			if ( !isset($products[1]['L']) || $products[1]['L'] !== "No. of stones" ){
				$error .= "Invalid Column: <strong>" . $products[1]['L'] . "</strong><br>";
			}
			if ( !isset($products[1]['M']) || $products[1]['M'] !== "No. of colour stone" ){
				$error .= "Invalid Column: <strong>" . $products[1]['M'] . "</strong><br>";
			}
			if ( !isset($products[1]['N']) || $products[1]['N'] !== "Diamond Shape" ){
				$error .= "Invalid Column: <strong>" . $products[1]['N'] . "</strong><br>";
			}
			if ( !isset($products[1]['O']) || $products[1]['O'] !== "Color stone shape" ){
				$error .= "Invalid Column: <strong>" . $products[1]['O'] . "</strong><br>";
			}
			if ( !isset($products[1]['P']) || $products[1]['P'] !== "Clarity" ){
				$error .= "Invalid Column: <strong>" . $products[1]['P'] . "</strong><br>";
			}
			if ( !isset($products[1]['Q']) || $products[1]['Q'] !== "Color" ){
				$error .= "Invalid Column: <strong>" . $products[1]['Q'] . "</strong><br>";
			}
			if ( !isset($products[1]['R']) || $products[1]['R'] !== "Material" ){
				$error .= "Invalid Column: <strong>" . $products[1]['R'] . "</strong><br>";
			}
			if ( !isset($products[1]['S']) || $products[1]['S'] !== "Gold Quality" ){
				$error .= "Invalid Column: <strong>" . $products[1]['S'] . "</strong><br>";
			}
			if ( !isset($products[1]['T']) || $products[1]['T'] !== "Color Stone Type" ){
				$error .= "Invalid Column: <strong>" . $products[1]['T'] . "</strong><br>";
			}
			if ( !isset($products[1]['U']) || $products[1]['U'] !== "Height" ){
				$error .= "Invalid Column: <strong>" . $products[1]['U'] . "</strong><br>";
			}
			if ( !isset($products[1]['V']) || $products[1]['V'] !== "Width" ){
				$error .= "Invalid Column: <strong>" . $products[1]['V'] . "</strong><br>";
			}
			if ( !isset($products[1]['W']) || $products[1]['W'] !== "Length" ){
				$error .= "Invalid Column: <strong>" . $products[1]['W'] . "</strong><br>";
			}
			if ( !isset($products[1]['X']) || $products[1]['X'] !== "Ring size" ){
				$error .= "Invalid Column: <strong>" . $products[1]['X'] . "</strong><br>";
			}
			if ( !isset($products[1]['Y']) || $products[1]['Y'] !== "Country Id" ){
				$error .= "Invalid Column: <strong>" . $products[1]['Y'] . "</strong><br>";
			}
			if ( !isset($products[1]['Z']) || $products[1]['Z'] !== "Subcategory" ){
				$error .= "Invalid Column: <strong>" . $products[1]['Z'] . "</strong><br>";
			}
			if ( !isset($products[1]['AA']) || $products[1]['AA'] !== "Lab Grown Diamond" ){
				$error .= "Invalid Column: <strong>" . $products[1]['AA'] . "</strong><br>";
			}
			if ( !isset($products[1]['AB']) || $products[1]['AB'] !== "Images (comma \",\" separated)" ){
				$error .= "Invalid Column: <strong>" . $products[1]['AB'] . "</strong><br>";
			}
			if ( !isset($products[1]['AC']) || $products[1]['AC'] !== "Description" ) {
				$error .= "Invalid Column: <strong>" . $products[1]['AC'] . "</strong><br>";
			}
			if ( !isset($products[1]['AD']) || $products[1]['AD'] !== "Description (French)" ) {
				$error .= "Invalid Column: <strong>" . $products[1]['AD'] . "</strong><br>";
			}
			if ( !isset($products[1]['AE']) || $products[1]['AE'] !== "Diamond Color" ) {
				$error .= "Invalid Column: <strong>" . $products[1]['AE'] ."</strong><br>";
			}
			if ( !isset($products[1]['AF']) || $products[1]['AF'] !== "Family" ) {
				$error .= "Invalid Column: <strong>" . $products[1]['AF'] ."</strong><br>";
			}

			if ( empty($error) ) {
				$result = "";
				$i = $_GET['importThis'];

				if ( empty($products[$i]['D']) ) {
					$result = [];
					array_push($result, "N/A");
					array_push($result, "Empty Data");
					array_push($result, $i);
					echo json_encode($result);
					return;
				}
				$acceptedCategories = array(1,2,3,4,5);
				if ( !in_array($products[$i]['B'], $acceptedCategories) ) {
					$result = [];
					array_push($result, $products[$i]['D']);
					array_push($result, "Invalid Category: " . $products[$i]['B']);
					array_push($result, $i);
					echo json_encode($result);
					return;
				}
				$acceptedClarity = array("FL", "IF", "VVS1", "VVS2", "VS1", "VS2", "SI1", "SI2", "SI3", "I1");
				if ( !in_array($products[$i]['P'], $acceptedClarity) ) {
					$result = [];
					array_push($result, $products[$i]['D']);
					array_push($result, "Invalid Clarity: " . $products[$i]['P']);
					array_push($result, $i);
					echo json_encode($result);
					return;
				}

				$checkCompany = $pdo->prepare("SELECT * FROM `company_id` WHERE `company_code` = :cc");
				$checkCompany->execute(array(":cc" => $products[$i]['A']));

				if ( $checkCompany->rowCount() == 0 ) {
					$result = [];
					array_push($result, $products[$i]['D']);
					array_push($result, "Invalid Company Code: " . $products[$i]['A']);
					array_push($result, $i);
					echo json_encode($result);
					return;
				}


				$internalID = $products[$i]['C'];
				switch( $products[$i]['B'] ) {
					case 1 : {
						$checkInternalID = $pdo->prepare("SELECT * FROM rings WHERE `internal_id` = :intID");
						$checkInternalID->execute(array(":intID" => $internalID));

						if ( $checkInternalID->rowCount() > 0 ) {
							$resultValues = $checkInternalID->fetch(PDO::FETCH_ASSOC);

							$getItemMainValues = $pdo->prepare("SELECT * FROM items WHERE `unique_key` = :unique_key");
							$getItemMainValues->execute(array(":unique_key" => $resultValues['unique_key']));

							if ( $getItemMainValues->rowCount() > 0 ) {
								$resultValues = array_merge($getItemMainValues->fetch(PDO::FETCH_ASSOC), $resultValues);
								$valuesDB = 
										getCompanyCode($resultValues['company_id'], $pdo) . 
										$resultValues['category'] . 
										$resultValues['internal_id'] . 
										$resultValues['product_name'] . 
										$resultValues['item_value'] . 
										$resultValues['discount'] . 
										$resultValues['pieces_in_stock'] . 
										$resultValues['days_for_shipment'] . 
										$resultValues['total_gold_weight'] . 
										$resultValues['total_carat_weight'] . 
										$resultValues['color_stone_carat'] . 
										$resultValues['no_of_stones'] . 
										$resultValues['no_of_color_stones'] . 
										$resultValues['diamond_shape'] . 
										$resultValues['color_stone_shape'] . 
										$resultValues['clarity'] . 
										$resultValues['color'] . 
										$resultValues['material'] .
										$resultValues['gold_quality'] .
										$resultValues['color_stone_type'] .
										$resultValues['height'] . 
										$resultValues['width'] . 
										$resultValues['length'] . 
										$resultValues['ring_size'] . 
										$resultValues['country_id'] . 
										$resultValues['ring_subcategory'] . 
										$resultValues['lab_grown'] . 
										$resultValues['images_delta'] . 
										$resultValues['description'] .
										$resultValues['description_french'] . 
										$resultValues['diamond_color'] .
										$resultValues['family'];
										

								$valuesSQL = 
										$products[$i]['A'] . 
										$products[$i]['B'] . 
										$internalID . 
										$products[$i]['D'] . 
										$products[$i]['E'] . 
										$products[$i]['F'] . 
										$products[$i]['G'] . 
										$products[$i]['H'] . 
										$products[$i]['I'] . 
										$products[$i]['J'] . 
										$products[$i]['K'] . 
										$products[$i]['L'] . 
										$products[$i]['M'] . 
										$products[$i]['N'] . 
										$products[$i]['O'] . 
										$products[$i]['P'] . 
										$products[$i]['Q'] . 
										$products[$i]['R'] . 
										$products[$i]['S'] . 
										$products[$i]['T'] . 
										$products[$i]['U'] . 
										$products[$i]['V'] . 
										$products[$i]['W'] . 
										$products[$i]['X'] . 
										$products[$i]['Y'] . 
										$products[$i]['Z'] . 
										$products[$i]['AA'] .
										$products[$i]['AB'] .
										$products[$i]['AC'] .
										$products[$i]['AD'] .
										$products[$i]['AE'] .
										$products[$i]['AF'];

								$hashDB = strtoupper(hash("md5", $valuesDB ));


								$hashSQL = strtoupper(hash("md5", $valuesSQL ));
								
								#for Rings (has column S T and U)
								#$hashSQL = strtoupper(hash("md5", $products[$i]['A'] . $products[$i]['B'] . $internalID . $products[$i]['D'] . $products[$i]['F'] . $products[$i]['G'] . $products[$i]['H'] . $products[$i]['I'] . $products[$i]['J'] . $products[$i]['K'] . $products[$i]['L'] . $products[$i]['M'] . $products[$i]['N'] . $products[$i]['O'] . $products[$i]['P'] . $products[$i]['Q'] . $products[$i]['R'] . $products[$i]['S'] . $products[$i]['T'] . $products[$i]['U'] . $products[$i]['V'] ));

								#$resultStatus = "DB: " . getCompanyCode($resultValues['company_id'], $pdo) . "<br>";
								#$resultStatus .= "SQL: " . $products[$i]['A'];
								if ( $hashDB == $hashSQL ) {
									$resultStatus = "Duplicate Entry - Skipping";
									#$resultStatus .= json_encode($valuesDB);
									#$resultStatus .= json_encode($valuesSQL);
								} else {
									$resultStatus = "Product Updated";
									#$resultStatus .= json_encode($valuesDB);
									#$resultStatus .= json_encode($valuesSQL);
									
									$resultStatus .= updateImportZipItem($pdo, $resultValues['unique_key'], $products[$i], 0, $_GET['timeToken'], $__MAINDOMAIN__, $__IMPORT_IMAGE_RES__);

								}
							} else {
								$resultStatus = "Invalid Item";
							}


							$result = [];
							array_push($result, $resultMessage);
							array_push($result, $products[$i]['D']);
							array_push($result, $resultStatus);
							array_push($result, $i);
							array_push($result, $updated);
							array_push($result, $duplicate);
							echo json_encode($result);

							return;
						}
						break;
					}
					case 2 : {
						$checkInternalID = $pdo->prepare("SELECT * FROM earrings WHERE `internal_id` = :intID");
						$checkInternalID->execute(array(":intID" => $internalID));

						if ( $checkInternalID->rowCount() > 0 ) {
							$resultValues = $checkInternalID->fetch(PDO::FETCH_ASSOC);

							$getItemMainValues = $pdo->prepare("SELECT * FROM items WHERE `unique_key` = :unique_key");
							$getItemMainValues->execute(array(":unique_key" => $resultValues['unique_key']));

							if ( $getItemMainValues->rowCount() > 0 ) {
								$resultValues = array_merge($getItemMainValues->fetch(PDO::FETCH_ASSOC), $resultValues);
								$valuesDB = 
										getCompanyCode($resultValues['company_id'], $pdo) . 
										$resultValues['category'] . 
										$resultValues['internal_id'] . 
										$resultValues['product_name'] . 
										$resultValues['item_value'] . 
										$resultValues['discount'] . 
										$resultValues['pieces_in_stock'] . 
										$resultValues['days_for_shipment'] . 
										$resultValues['total_gold_weight'] . 
										$resultValues['total_carat_weight'] . 
										$resultValues['color_stone_carat'] . 
										$resultValues['no_of_stones'] . 
										$resultValues['no_of_color_stones'] . 
										$resultValues['diamond_shape'] . 
										$resultValues['color_stone_shape'] . 
										$resultValues['clarity'] . 
										$resultValues['color'] . 
										$resultValues['material'] .
										$resultValues['gold_quality'] .
										$resultValues['color_stone_type'] .
										$resultValues['height'] . 
										$resultValues['width'] . 
										$resultValues['length'] . 
										$resultValues['ring_size'] . 
										$resultValues['country_id'] . 
										$resultValues['ring_subcategory'] . 
										$resultValues['lab_grown'] . 
										$resultValues['images_delta'] . 
										$resultValues['description'] .
										$resultValues['description_french'] . 
										$resultValues['diamond_color'] .
										$resultValues['family'];

								$valuesSQL = 
										$products[$i]['A'] . 
										$products[$i]['B'] . 
										$internalID . 
										$products[$i]['D'] . 
										$products[$i]['E'] . 
										$products[$i]['F'] . 
										$products[$i]['G'] . 
										$products[$i]['H'] . 
										$products[$i]['I'] . 
										$products[$i]['J'] . 
										$products[$i]['K'] . 
										$products[$i]['L'] . 
										$products[$i]['M'] . 
										$products[$i]['N'] . 
										$products[$i]['O'] . 
										$products[$i]['P'] . 
										$products[$i]['Q'] . 
										$products[$i]['R'] . 
										$products[$i]['S'] . 
										$products[$i]['T'] . 
										$products[$i]['U'] . 
										$products[$i]['V'] . 
										$products[$i]['W'] . 
										$products[$i]['X'] . 
										$products[$i]['Y'] . 
										$products[$i]['Z'] . 
										$products[$i]['AA'] .
										$products[$i]['AB'] .
										$products[$i]['AC'] .
										$products[$i]['AD'] .
										$products[$i]['AE'] .
										$products[$i]['AF'];

								$hashDB = strtoupper(hash("md5", $valuesDB ));


								$hashSQL = strtoupper(hash("md5", $valuesSQL ));
								
								#for Rings (has column S T and U)
								#$hashSQL = strtoupper(hash("md5", $products[$i]['A'] . $products[$i]['B'] . $internalID . $products[$i]['D'] . $products[$i]['F'] . $products[$i]['G'] . $products[$i]['H'] . $products[$i]['I'] . $products[$i]['J'] . $products[$i]['K'] . $products[$i]['L'] . $products[$i]['M'] . $products[$i]['N'] . $products[$i]['O'] . $products[$i]['P'] . $products[$i]['Q'] . $products[$i]['R'] . $products[$i]['S'] . $products[$i]['T'] . $products[$i]['U'] . $products[$i]['V'] ));

								#$resultStatus = "DB: " . getCompanyCode($resultValues['company_id'], $pdo) . "<br>";
								#$resultStatus .= "SQL: " . $products[$i]['A'];
								if ( $hashDB == $hashSQL ) {
									$resultStatus = "Duplicate Entry - Skipping";
									#$resultStatus .= json_encode($valuesDB);
									#$resultStatus .= json_encode($valuesSQL);
								} else {
									$resultStatus = "Product Updated";
									$resultStatus .= updateImportZipItem($pdo, $resultValues['unique_key'], $products[$i], 0, $_GET['timeToken'], $__MAINDOMAIN__, $__IMPORT_IMAGE_RES__);
									#$resultStatus .= json_encode($valuesDB);
									#$resultStatus .= json_encode($valuesSQL);
									
								}
							} else {
								$resultStatus = "Invalid Item";
							}


							$result = [];
							array_push($result, $resultMessage);
							array_push($result, $products[$i]['D']);
							array_push($result, $resultStatus);
							array_push($result, $i);
							array_push($result, $updated);
							array_push($result, $duplicate);
							echo json_encode($result);

							return;
						}
						break;
					}
					case 3 : {
						$checkInternalID = $pdo->prepare("SELECT * FROM pendants WHERE `internal_id` = :intID");
						$checkInternalID->execute(array(":intID" => $internalID));

						if ( $checkInternalID->rowCount() > 0 ) {
							$resultValues = $checkInternalID->fetch(PDO::FETCH_ASSOC);

							$getItemMainValues = $pdo->prepare("SELECT * FROM items WHERE `unique_key` = :unique_key");
							$getItemMainValues->execute(array(":unique_key" => $resultValues['unique_key']));

							if ( $getItemMainValues->rowCount() > 0 ) {
								$resultValues = array_merge($getItemMainValues->fetch(PDO::FETCH_ASSOC), $resultValues);
								$valuesDB = 
										getCompanyCode($resultValues['company_id'], $pdo) . 
										$resultValues['category'] . 
										$resultValues['internal_id'] . 
										$resultValues['product_name'] . 
										$resultValues['item_value'] . 
										$resultValues['discount'] . 
										$resultValues['pieces_in_stock'] . 
										$resultValues['days_for_shipment'] . 
										$resultValues['total_gold_weight'] . 
										$resultValues['total_carat_weight'] . 
										$resultValues['color_stone_carat'] . 
										$resultValues['no_of_stones'] . 
										$resultValues['no_of_color_stones'] . 
										$resultValues['diamond_shape'] . 
										$resultValues['color_stone_shape'] . 
										$resultValues['clarity'] . 
										$resultValues['color'] . 
										$resultValues['material'] .
										$resultValues['gold_quality'] .
										$resultValues['color_stone_type'] .
										$resultValues['height'] . 
										$resultValues['width'] . 
										$resultValues['length'] . 
										$resultValues['ring_size'] . 
										$resultValues['country_id'] . 
										$resultValues['ring_subcategory'] . 
										$resultValues['lab_grown'] . 
										$resultValues['images_delta'] . 
										$resultValues['description'] .
										$resultValues['description_french'] . 
										$resultValues['diamond_color'] .
										$resultValues['family'];

								$valuesSQL = 
										$products[$i]['A'] . 
										$products[$i]['B'] . 
										$internalID . 
										$products[$i]['D'] . 
										$products[$i]['E'] . 
										$products[$i]['F'] . 
										$products[$i]['G'] . 
										$products[$i]['H'] . 
										$products[$i]['I'] . 
										$products[$i]['J'] . 
										$products[$i]['K'] . 
										$products[$i]['L'] . 
										$products[$i]['M'] . 
										$products[$i]['N'] . 
										$products[$i]['O'] . 
										$products[$i]['P'] . 
										$products[$i]['Q'] . 
										$products[$i]['R'] . 
										$products[$i]['S'] . 
										$products[$i]['T'] . 
										$products[$i]['U'] . 
										$products[$i]['V'] . 
										$products[$i]['W'] . 
										$products[$i]['X'] . 
										$products[$i]['Y'] . 
										$products[$i]['Z'] . 
										$products[$i]['AA'] .
										$products[$i]['AB'] .
										$products[$i]['AC'] .
										$products[$i]['AD'] .
										$products[$i]['AE'] .
										$products[$i]['AF'];


								$hashDB = strtoupper(hash("md5", $valuesDB ));

								$hashSQL = strtoupper(hash("md5", $valuesSQL ));
								
								#for Rings (has column S T and U)
								#$hashSQL = strtoupper(hash("md5", $products[$i]['A'] . $products[$i]['B'] . $internalID . $products[$i]['D'] . $products[$i]['F'] . $products[$i]['G'] . $products[$i]['H'] . $products[$i]['I'] . $products[$i]['J'] . $products[$i]['K'] . $products[$i]['L'] . $products[$i]['M'] . $products[$i]['N'] . $products[$i]['O'] . $products[$i]['P'] . $products[$i]['Q'] . $products[$i]['R'] . $products[$i]['S'] . $products[$i]['T'] . $products[$i]['U'] . $products[$i]['V'] ));

								#$resultStatus = "DB: " . getCompanyCode($resultValues['company_id'], $pdo) . "<br>";
								#$resultStatus .= "SQL: " . $products[$i]['A'];
								if ( $hashDB == $hashSQL ) {
									$resultStatus = "Duplicate Entry - Skipping";
									#$resultStatus .= json_encode($valuesDB);
									#$resultStatus .= json_encode($valuesSQL);
								} else {
									$resultStatus = "Product Updated";
									#$resultStatus .= json_encode($valuesDB);
									#$resultStatus .= json_encode($valuesSQL);
									
									updateImportZipItem($pdo, $resultValues['unique_key'], $products[$i], 0, $_GET['timeToken'], $__MAINDOMAIN__, $__IMPORT_IMAGE_RES__);

								}
							} else {
								$resultStatus = "Invalid Item";
							}


							$result = [];
							array_push($result, $resultMessage);
							array_push($result, $products[$i]['D']);
							array_push($result, $resultStatus);
							array_push($result, $i);
							array_push($result, $updated);
							array_push($result, $duplicate);
							echo json_encode($result);

							return;
						}
						break;
					}
					case 4 : {
						$checkInternalID = $pdo->prepare("SELECT * FROM necklaces WHERE `internal_id` = :intID");
						$checkInternalID->execute(array(":intID" => $internalID));

						if ( $checkInternalID->rowCount() > 0 ) {
							$resultValues = $checkInternalID->fetch(PDO::FETCH_ASSOC);

							$getItemMainValues = $pdo->prepare("SELECT * FROM items WHERE `unique_key` = :unique_key");
							$getItemMainValues->execute(array(":unique_key" => $resultValues['unique_key']));

							if ( $getItemMainValues->rowCount() > 0 ) {
								$resultValues = array_merge($getItemMainValues->fetch(PDO::FETCH_ASSOC), $resultValues);
								$valuesDB = 
										getCompanyCode($resultValues['company_id'], $pdo) . 
										$resultValues['category'] . 
										$resultValues['internal_id'] . 
										$resultValues['product_name'] . 
										$resultValues['item_value'] . 
										$resultValues['discount'] . 
										$resultValues['pieces_in_stock'] . 
										$resultValues['days_for_shipment'] . 
										$resultValues['total_gold_weight'] . 
										$resultValues['total_carat_weight'] . 
										$resultValues['color_stone_carat'] . 
										$resultValues['no_of_stones'] . 
										$resultValues['no_of_color_stones'] . 
										$resultValues['diamond_shape'] . 
										$resultValues['color_stone_shape'] . 
										$resultValues['clarity'] . 
										$resultValues['color'] . 
										$resultValues['material'] .
										$resultValues['gold_quality'] .
										$resultValues['color_stone_type'] .
										$resultValues['height'] . 
										$resultValues['width'] . 
										$resultValues['length'] . 
										$resultValues['ring_size'] . 
										$resultValues['country_id'] . 
										$resultValues['ring_subcategory'] . 
										$resultValues['lab_grown'] . 
										$resultValues['images_delta'] . 
										$resultValues['description'] .
										$resultValues['description_french'] . 
										$resultValues['diamond_color'] .
										$resultValues['family'];

								$valuesSQL = 
										$products[$i]['A'] . 
										$products[$i]['B'] . 
										$internalID . 
										$products[$i]['D'] . 
										$products[$i]['E'] . 
										$products[$i]['F'] . 
										$products[$i]['G'] . 
										$products[$i]['H'] . 
										$products[$i]['I'] . 
										$products[$i]['J'] . 
										$products[$i]['K'] . 
										$products[$i]['L'] . 
										$products[$i]['M'] . 
										$products[$i]['N'] . 
										$products[$i]['O'] . 
										$products[$i]['P'] . 
										$products[$i]['Q'] . 
										$products[$i]['R'] . 
										$products[$i]['S'] . 
										$products[$i]['T'] . 
										$products[$i]['U'] . 
										$products[$i]['V'] . 
										$products[$i]['W'] . 
										$products[$i]['X'] . 
										$products[$i]['Y'] . 
										$products[$i]['Z'] . 
										$products[$i]['AA'] .
										$products[$i]['AB'] .
										$products[$i]['AC'] .
										$products[$i]['AD'] .
										$products[$i]['AE'] .
										$products[$i]['AF'];

								$hashDB = strtoupper(hash("md5", $valuesDB ));


								$hashSQL = strtoupper(hash("md5", $valuesSQL ));
								
								#for Rings (has column S T and U)
								#$hashSQL = strtoupper(hash("md5", $products[$i]['A'] . $products[$i]['B'] . $internalID . $products[$i]['D'] . $products[$i]['F'] . $products[$i]['G'] . $products[$i]['H'] . $products[$i]['I'] . $products[$i]['J'] . $products[$i]['K'] . $products[$i]['L'] . $products[$i]['M'] . $products[$i]['N'] . $products[$i]['O'] . $products[$i]['P'] . $products[$i]['Q'] . $products[$i]['R'] . $products[$i]['S'] . $products[$i]['T'] . $products[$i]['U'] . $products[$i]['V'] ));

								#$resultStatus = "DB: " . getCompanyCode($resultValues['company_id'], $pdo) . "<br>";
								#$resultStatus .= "SQL: " . $products[$i]['A'];
								if ( $hashDB == $hashSQL ) {
									$resultStatus = "Duplicate Entry - Skipping";
									#$resultStatus .= json_encode($valuesDB);
									#$resultStatus .= json_encode($valuesSQL);
								} else {
									$resultStatus = "Product Updated";
									#$resultStatus .= json_encode($valuesDB);
									#$resultStatus .= json_encode($valuesSQL);
									
									updateImportZipItem($pdo, $resultValues['unique_key'], $products[$i], 0, $_GET['timeToken'], $__MAINDOMAIN__, $__IMPORT_IMAGE_RES__);

								}
							} else {
								$resultStatus = "Invalid Item";
							}


							$result = [];
							array_push($result, $resultMessage);
							array_push($result, $products[$i]['D']);
							array_push($result, $resultStatus);
							array_push($result, $i);
							array_push($result, $updated);
							array_push($result, $duplicate);
							echo json_encode($result);

							return;
						}
						break;
					}
					case 5 : {
						$checkInternalID = $pdo->prepare("SELECT * FROM bracelets WHERE `internal_id` = :intID");
						$checkInternalID->execute(array(":intID" => $internalID));

						if ( $checkInternalID->rowCount() > 0 ) {
							$resultValues = $checkInternalID->fetch(PDO::FETCH_ASSOC);

							$getItemMainValues = $pdo->prepare("SELECT * FROM items WHERE `unique_key` = :unique_key");
							$getItemMainValues->execute(array(":unique_key" => $resultValues['unique_key']));

							if ( $getItemMainValues->rowCount() > 0 ) {
								$resultValues = array_merge($getItemMainValues->fetch(PDO::FETCH_ASSOC), $resultValues);
								$valuesDB = 
										getCompanyCode($resultValues['company_id'], $pdo) . 
										$resultValues['category'] . 
										$resultValues['internal_id'] . 
										$resultValues['product_name'] . 
										$resultValues['item_value'] . 
										$resultValues['discount'] . 
										$resultValues['pieces_in_stock'] . 
										$resultValues['days_for_shipment'] . 
										$resultValues['total_gold_weight'] . 
										$resultValues['total_carat_weight'] . 
										$resultValues['color_stone_carat'] . 
										$resultValues['no_of_stones'] . 
										$resultValues['no_of_color_stones'] . 
										$resultValues['diamond_shape'] . 
										$resultValues['color_stone_shape'] . 
										$resultValues['clarity'] . 
										$resultValues['color'] . 
										$resultValues['material'] .
										$resultValues['gold_quality'] .
										$resultValues['color_stone_type'] .
										$resultValues['height'] . 
										$resultValues['width'] . 
										$resultValues['length'] . 
										$resultValues['ring_size'] . 
										$resultValues['country_id'] . 
										$resultValues['ring_subcategory'] . 
										$resultValues['lab_grown'] . 
										$resultValues['images_delta'] . 
										$resultValues['description'] .
										$resultValues['description_french'] . 
										$resultValues['diamond_color'] .
										$resultValues['family'];

								$valuesSQL = 
										$products[$i]['A'] . 
										$products[$i]['B'] . 
										$internalID . 
										$products[$i]['D'] . 
										$products[$i]['E'] . 
										$products[$i]['F'] . 
										$products[$i]['G'] . 
										$products[$i]['H'] . 
										$products[$i]['I'] . 
										$products[$i]['J'] . 
										$products[$i]['K'] . 
										$products[$i]['L'] . 
										$products[$i]['M'] . 
										$products[$i]['N'] . 
										$products[$i]['O'] . 
										$products[$i]['P'] . 
										$products[$i]['Q'] . 
										$products[$i]['R'] . 
										$products[$i]['S'] . 
										$products[$i]['T'] . 
										$products[$i]['U'] . 
										$products[$i]['V'] . 
										$products[$i]['W'] . 
										$products[$i]['X'] . 
										$products[$i]['Y'] . 
										$products[$i]['Z'] . 
										$products[$i]['AA'] .
										$products[$i]['AB'] .
										$products[$i]['AC'] .
										$products[$i]['AD'] .
										$products[$i]['AE'] .
										$products[$i]['AF'];

								$hashDB = strtoupper(hash("md5", $valuesDB ));


								$hashSQL = strtoupper(hash("md5", $valuesSQL ));
								
								#for Rings (has column S T and U)
								#$hashSQL = strtoupper(hash("md5", $products[$i]['A'] . $products[$i]['B'] . $internalID . $products[$i]['D'] . $products[$i]['F'] . $products[$i]['G'] . $products[$i]['H'] . $products[$i]['I'] . $products[$i]['J'] . $products[$i]['K'] . $products[$i]['L'] . $products[$i]['M'] . $products[$i]['N'] . $products[$i]['O'] . $products[$i]['P'] . $products[$i]['Q'] . $products[$i]['R'] . $products[$i]['S'] . $products[$i]['T'] . $products[$i]['U'] . $products[$i]['V'] ));

								#$resultStatus = "DB: " . getCompanyCode($resultValues['company_id'], $pdo) . "<br>";
								#$resultStatus .= "SQL: " . $products[$i]['A'];
								if ( $hashDB == $hashSQL ) {
									$resultStatus = "Duplicate Entry - Skipping";
									#$resultStatus .= json_encode($valuesDB);
									#$resultStatus .= json_encode($valuesSQL);
								} else {
									$resultStatus = "Product Updated";
									#$resultStatus .= json_encode($valuesDB);
									#$resultStatus .= json_encode($valuesSQL);
									
									updateImportZipItem($pdo, $resultValues['unique_key'], $products[$i], 0, $_GET['timeToken'], $__MAINDOMAIN__, $__IMPORT_IMAGE_RES__);

								}
							} else {
								$resultStatus = "Invalid Item";
							}


							$result = [];
							array_push($result, $resultMessage);
							array_push($result, $products[$i]['D']);
							array_push($result, $resultStatus);
							array_push($result, $i);
							array_push($result, $updated);
							array_push($result, $duplicate);
							echo json_encode($result);

							return;
						}
						break;
					}
				}

					$company_id = "0";
					if ( isset($_SESSION['import_company_id']) ) {
						$company_id = $_SESSION['import_company_id'];
					}

					$company_id = getCompanyID($products[$i]['A'], $pdo);
					
					$uniqueKey = generateUniqueKey();
					
					while ( checkKey($uniqueKey, $pdo) ) {
						$uniqueKey = generateUniqueKey();
					}

					if ( empty($products[$i]['AA']) ) {
						$products[$i]['AA'] = "-";
					}

					$addItem = $pdo->prepare("INSERT INTO `items` (`unique_key`, `item_name`, `item_value`, `discount`, `category`, `featured`, images_delta, `date_added`) VALUES (:unique_key, :product_name, :product_price, :discount, :category, 0, :images_delta, NOW())");
						$addItem->execute(array(
							":unique_key" => $uniqueKey,
							":product_name" => $products[$i]['D'],
							":product_price" => $products[$i]['E'],
							":discount" => $products[$i]['F'],
							":category" => $products[$i]['B'],
							":images_delta" => $products[$i]['AB']
						));

					switch ($products[$i]['B']) {
						case 1: {
							$addInfo = $pdo->prepare("INSERT INTO `rings` 
								(`unique_key`, `company_id`, `internal_id`, `product_name`, `pieces_in_stock`, `days_for_shipment`, `total_carat_weight`, `no_of_stones`, `diamond_shape`, `clarity`, `color`, `diamond_color`, `material`, `height`, `width`, `length`, `country_id`, `images`, `description`, `description_french`, `total_gold_weight`, `color_stone_carat`, `no_of_color_stones`, `color_stone_shape`, `lab_grown`, `ring_subcategory`, `ring_size`, `gold_quality`, `color_stone_type`) 
								VALUES 
								(:unique_key, :company_id, :internal_id, :product_name, :pieces_in_stock, :days_for_shipment, :total_carat_weight, :no_of_stones, :diamond_shape, :clarity, :color, :diamond_color, :material, :height, :width, :length, :country_id, :images, :description, :description_french, :total_gold_weight, :color_stone_carat, :no_of_color_stones, :color_stone_shape, :lab_grown, :ring_subcategory, :ring_size, :gold_quality, :color_stone_type)");
							$addInfo->execute(array(
								":unique_key" => $uniqueKey,
								":company_id" => $company_id,
								":internal_id" => $products[$i]['C'],
								":product_name" => $products[$i]['D'],
								":pieces_in_stock" => $products[$i]['G'],
								":days_for_shipment" => $products[$i]['H'],
								":total_gold_weight" => $products[$i]['I'],
								":total_carat_weight" => $products[$i]['J'],
								":color_stone_carat" => $products[$i]['K'],
								":no_of_stones" => $products[$i]['L'],
								":no_of_color_stones" => $products[$i]['M'],
								":diamond_shape" => $products[$i]['N'],
								":color_stone_shape" => $products[$i]['O'],
								":clarity" => $products[$i]['P'],
								":color" => $products[$i]['Q'],
								":material" => $products[$i]['R'],
								":gold_quality" => $products[$i]['S'],
								":color_stone_type" => $products[$i]['T'],
								":height" => $products[$i]['U'],
								":width" => $products[$i]['V'],
								":length" => $products[$i]['W'],
								":ring_size" => $products[$i]['X'],
								":country_id" => $products[$i]['Y'],
								":ring_subcategory" => $products[$i]['Z'],
								":lab_grown" => $products[$i]['AA'],
								":images" => "",
								":description" => $products[$i]['AC'],
								":description_french" => $products[$i]['AD'],
								":diamond_color" => $products[$i]['AE']
							));


							$getitemID = $pdo->prepare("SELECT `id` FROM `rings` WHERE `unique_key` = :unique_key");
							$getitemID->execute(array(":unique_key" => $uniqueKey));
							$itemID = $getitemID->fetch(PDO::FETCH_ASSOC);
							$itemID = $itemID['id'];

							break;
						} case 2: {
							$addInfo = $pdo->prepare("INSERT INTO `earrings` 
								(`unique_key`, `company_id`, `internal_id`, `product_name`, `pieces_in_stock`, `days_for_shipment`, `total_carat_weight`, `no_of_stones`, `diamond_shape`, `clarity`, `color`, `diamond_color`, `material`, `height`, `width`, `length`, `country_id`, `images`, `description`, `description_french`, `total_gold_weight`, `color_stone_carat`, `no_of_color_stones`, `color_stone_shape`, `lab_grown`, `ring_subcategory`, `ring_size`, `gold_quality`, `color_stone_type`) 
								VALUES 
								(:unique_key, :company_id, :internal_id, :product_name, :pieces_in_stock, :days_for_shipment, :total_carat_weight, :no_of_stones, :diamond_shape, :clarity, :color, :diamond_color, :material, :height, :width, :length, :country_id, :images, :description, :description_french, :total_gold_weight, :color_stone_carat, :no_of_color_stones, :color_stone_shape, :lab_grown, :ring_subcategory, :ring_size, :gold_quality, :color_stone_type)");
							$addInfo->execute(array(
								":unique_key" => $uniqueKey,
								":company_id" => $company_id,
								":internal_id" => $products[$i]['C'],
								":product_name" => $products[$i]['D'],
								":pieces_in_stock" => $products[$i]['G'],
								":days_for_shipment" => $products[$i]['H'],
								":total_gold_weight" => $products[$i]['I'],
								":total_carat_weight" => $products[$i]['J'],
								":color_stone_carat" => $products[$i]['K'],
								":no_of_stones" => $products[$i]['L'],
								":no_of_color_stones" => $products[$i]['M'],
								":diamond_shape" => $products[$i]['N'],
								":color_stone_shape" => $products[$i]['O'],
								":clarity" => $products[$i]['P'],
								":color" => $products[$i]['Q'],
								":material" => $products[$i]['R'],
								":gold_quality" => $products[$i]['S'],
								":color_stone_type" => $products[$i]['T'],
								":height" => $products[$i]['U'],
								":width" => $products[$i]['V'],
								":length" => $products[$i]['W'],
								":ring_size" => $products[$i]['X'],
								":country_id" => $products[$i]['Y'],
								":ring_subcategory" => $products[$i]['Z'],
								":lab_grown" => $products[$i]['AA'],
								":images" => "",
								":description" => $products[$i]['AC'],
								":description_french" => $products[$i]['AD'],
								":diamond_color" => $products[$i]['AE']
							));

							
							$getitemID = $pdo->prepare("SELECT `id` FROM `earrings` WHERE `unique_key` = :unique_key");
							$getitemID->execute(array(":unique_key" => $uniqueKey));
							$itemID = $getitemID->fetch(PDO::FETCH_ASSOC);
							$itemID = $itemID['id'];

							break;
						} case 3: {
							$addInfo = $pdo->prepare("INSERT INTO `pendants` 
								(`unique_key`, `company_id`, `internal_id`, `product_name`, `pieces_in_stock`, `days_for_shipment`, `total_carat_weight`, `no_of_stones`, `diamond_shape`, `clarity`, `color`, `diamond_color`, `material`, `height`, `width`, `length`, `country_id`, `images`, `description`, `description_french`, `total_gold_weight`, `color_stone_carat`, `no_of_color_stones`, `color_stone_shape`, `lab_grown`, `ring_subcategory`, `ring_size`, `gold_quality`, `color_stone_type`) 
								VALUES 
								(:unique_key, :company_id, :internal_id, :product_name, :pieces_in_stock, :days_for_shipment, :total_carat_weight, :no_of_stones, :diamond_shape, :clarity, :color, :diamond_color, :material, :height, :width, :length, :country_id, :images, :description, :description_french, :total_gold_weight, :color_stone_carat, :no_of_color_stones, :color_stone_shape, :lab_grown, :ring_subcategory, :ring_size, :gold_quality, :color_stone_type)");
							$addInfo->execute(array(
								":unique_key" => $uniqueKey,
								":company_id" => $company_id,
								":internal_id" => $products[$i]['C'],
								":product_name" => $products[$i]['D'],
								":pieces_in_stock" => $products[$i]['G'],
								":days_for_shipment" => $products[$i]['H'],
								":total_gold_weight" => $products[$i]['I'],
								":total_carat_weight" => $products[$i]['J'],
								":color_stone_carat" => $products[$i]['K'],
								":no_of_stones" => $products[$i]['L'],
								":no_of_color_stones" => $products[$i]['M'],
								":diamond_shape" => $products[$i]['N'],
								":color_stone_shape" => $products[$i]['O'],
								":clarity" => $products[$i]['P'],
								":color" => $products[$i]['Q'],
								":material" => $products[$i]['R'],
								":gold_quality" => $products[$i]['S'],
								":color_stone_type" => $products[$i]['T'],
								":height" => $products[$i]['U'],
								":width" => $products[$i]['V'],
								":length" => $products[$i]['W'],
								":ring_size" => $products[$i]['X'],
								":country_id" => $products[$i]['Y'],
								":ring_subcategory" => $products[$i]['Z'],
								":lab_grown" => $products[$i]['AA'],
								":images" => "",
								":description" => $products[$i]['AC'],
								":description_french" => $products[$i]['AD'],
								":diamond_color" => $products[$i]['AE']
							));

							
							$getitemID = $pdo->prepare("SELECT `id` FROM `pendants` WHERE `unique_key` = :unique_key");
							$getitemID->execute(array(":unique_key" => $uniqueKey));
							$itemID = $getitemID->fetch(PDO::FETCH_ASSOC);
							$itemID = $itemID['id'];

							break;
						} case 4: {
							$addInfo = $pdo->prepare("INSERT INTO `necklaces` 
								(`unique_key`, `company_id`, `internal_id`, `product_name`, `pieces_in_stock`, `days_for_shipment`, `total_carat_weight`, `no_of_stones`, `diamond_shape`, `clarity`, `color`, `diamond_color`, `material`, `height`, `width`, `length`, `country_id`, `images`, `description`, `description_french`, `total_gold_weight`, `color_stone_carat`, `no_of_color_stones`, `color_stone_shape`, `lab_grown`, `ring_subcategory`, `ring_size`, `gold_quality`, `color_stone_type`) 
								VALUES 
								(:unique_key, :company_id, :internal_id, :product_name, :pieces_in_stock, :days_for_shipment, :total_carat_weight, :no_of_stones, :diamond_shape, :clarity, :color, :diamond_color, :material, :height, :width, :length, :country_id, :images, :description, :description_french, :total_gold_weight, :color_stone_carat, :no_of_color_stones, :color_stone_shape, :lab_grown, :ring_subcategory, :ring_size, :gold_quality, :color_stone_type)");
							$addInfo->execute(array(
								":unique_key" => $uniqueKey,
								":company_id" => $company_id,
								":internal_id" => $products[$i]['C'],
								":product_name" => $products[$i]['D'],
								":pieces_in_stock" => $products[$i]['G'],
								":days_for_shipment" => $products[$i]['H'],
								":total_gold_weight" => $products[$i]['I'],
								":total_carat_weight" => $products[$i]['J'],
								":color_stone_carat" => $products[$i]['K'],
								":no_of_stones" => $products[$i]['L'],
								":no_of_color_stones" => $products[$i]['M'],
								":diamond_shape" => $products[$i]['N'],
								":color_stone_shape" => $products[$i]['O'],
								":clarity" => $products[$i]['P'],
								":color" => $products[$i]['Q'],
								":material" => $products[$i]['R'],
								":gold_quality" => $products[$i]['S'],
								":color_stone_type" => $products[$i]['T'],
								":height" => $products[$i]['U'],
								":width" => $products[$i]['V'],
								":length" => $products[$i]['W'],
								":ring_size" => $products[$i]['X'],
								":country_id" => $products[$i]['Y'],
								":ring_subcategory" => $products[$i]['Z'],
								":lab_grown" => $products[$i]['AA'],
								":images" => "",
								":description" => $products[$i]['AC'],
								":description_french" => $products[$i]['AD'],
								":diamond_color" => $products[$i]['AE']
							));

							
							$getitemID = $pdo->prepare("SELECT `id` FROM `necklaces` WHERE `unique_key` = :unique_key");
							$getitemID->execute(array(":unique_key" => $uniqueKey));
							$itemID = $getitemID->fetch(PDO::FETCH_ASSOC);
							$itemID = $itemID['id'];

							break;
						} case 5: {
							$addInfo = $pdo->prepare("INSERT INTO `bracelets` 
								(`unique_key`, `company_id`, `internal_id`, `product_name`, `pieces_in_stock`, `days_for_shipment`, `total_carat_weight`, `no_of_stones`, `diamond_shape`, `clarity`, `color`, `diamond_color`, `material`, `height`, `width`, `length`, `country_id`, `images`, `description`, `description_french`, `total_gold_weight`, `color_stone_carat`, `no_of_color_stones`, `color_stone_shape`, `lab_grown`, `ring_subcategory`, `ring_size`, `gold_quality`, `color_stone_type`) 
								VALUES 
								(:unique_key, :company_id, :internal_id, :product_name, :pieces_in_stock, :days_for_shipment, :total_carat_weight, :no_of_stones, :diamond_shape, :clarity, :color, :diamond_color, :material, :height, :width, :length, :country_id, :images, :description, :description_french, :total_gold_weight, :color_stone_carat, :no_of_color_stones, :color_stone_shape, :lab_grown, :ring_subcategory, :ring_size, :gold_quality, :color_stone_type)");
							$addInfo->execute(array(
								":unique_key" => $uniqueKey,
								":company_id" => $company_id,
								":internal_id" => $products[$i]['C'],
								":product_name" => $products[$i]['D'],
								":pieces_in_stock" => $products[$i]['G'],
								":days_for_shipment" => $products[$i]['H'],
								":total_gold_weight" => $products[$i]['I'],
								":total_carat_weight" => $products[$i]['J'],
								":color_stone_carat" => $products[$i]['K'],
								":no_of_stones" => $products[$i]['L'],
								":no_of_color_stones" => $products[$i]['M'],
								":diamond_shape" => $products[$i]['N'],
								":color_stone_shape" => $products[$i]['O'],
								":clarity" => $products[$i]['P'],
								":color" => $products[$i]['Q'],
								":material" => $products[$i]['R'],
								":gold_quality" => $products[$i]['S'],
								":color_stone_type" => $products[$i]['T'],
								":height" => $products[$i]['U'],
								":width" => $products[$i]['V'],
								":length" => $products[$i]['W'],
								":ring_size" => $products[$i]['X'],
								":country_id" => $products[$i]['Y'],
								":ring_subcategory" => $products[$i]['Z'],
								":lab_grown" => $products[$i]['AA'],
								":images" => "",
								":description" => $products[$i]['AC'],
								":description_french" => $products[$i]['AD'],
								":diamond_color" => $products[$i]['AE']
							));

							
							$getitemID = $pdo->prepare("SELECT `id` FROM `bracelets` WHERE `unique_key` = :unique_key");
							$getitemID->execute(array(":unique_key" => $uniqueKey));
							$itemID = $getitemID->fetch(PDO::FETCH_ASSOC);
							$itemID = $itemID['id'];

							break;
						} 
					}

					switch ($products[$i]['B']) {
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
							$result = [];

							array_push($result, 'failure');
							array_push($result, $products[$i]['D']);
							array_push($result, "Invalid Entry");
							array_push($result, $i);
							echo json_encode($result);
							return;
						}
					}

					$intError = "";
					$images = "";
					$imageArray = explode(",", 	$products[$i]['AB']);

					if ( !empty($products[$i]['Z']) ) {
						for ( $j = 0; $j < sizeof($imageArray); $j++ ) {
							$url = trim($imageArray[$j]);

							$ext = explode(".", $url);
							$ext =  '.' . $ext[sizeof($ext)-1];
							$count = 0;
							$img = '../../images/images/'. $imgName . '_' . $itemID .'_' . $count . $ext;
							$img_md = '../../images/images_md/'. $imgName . '_' . $itemID .'_' . $count . $ext;
							$img_sm = '../../images/images_sm/'. $imgName . '_' . $itemID .'_' . $count . $ext;
							while ( file_exists($img) ) {
								$count++;
								$img = '../../images/images/'. $imgName . '_' . $itemID .'_' . $count . $ext;
								$img_md = '../../images/images_md/'. $imgName . '_' . $itemID .'_' . $count . $ext;
								$img_sm = '../../images/images_sm/'. $imgName . '_' . $itemID .'_' . $count . $ext;
							}

							$image_dir = "../../images/";

							if ( !is_dir($image_dir . 'images/') ) {
								mkdir($image_dir . 'images/');
							}
							if ( !is_dir($image_dir . 'images_md/') ) {
								mkdir($image_dir . 'images_md/');
							}
							if ( !is_dir($image_dir . 'images_sm/') ) {
								mkdir($image_dir . 'images_sm/');
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
									file_put_contents($img, $inputImg);
									create_thumb($img, $__IMPORT_IMAGE_RES__['LARGE'], $__IMPORT_IMAGE_RES__['LARGE'], $img);
									create_thumb($img, $__IMPORT_IMAGE_RES__['MED'], $__IMPORT_IMAGE_RES__['MED'], $img_md);
									create_thumb($img, $__IMPORT_IMAGE_RES__['SMALL'], $__IMPORT_IMAGE_RES__['SMALL'], $img_sm);
									$images .= basename($img) . ",";
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
						}
					} else {
						$intError .= "No Image Found";
					}

					switch ($products[$i]['B']) {
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
					//$result .= "<tr><td>Added New Entry: " . $products[$i]['D'] . "</td><td>" . $intError .  "</td></tr>";

					unset($PHPExcel);

					$result = [];
					$resultColor = 'success';
					if ( $intError !== 'None' ) {
						$resultColor = 'warning';
					}
					array_push($result, $resultColor);
					array_push($result, $products[$i]['D']);
					array_push($result, $intError);
					array_push($result, $i);
					echo json_encode($result);

			} else {
				echo '<h4>Import Failed</h4><br>'. $error . "<br>Please Fix The Errors and Try to Import Again <br><br><br> Alternatively, you can download the format here: <button class='btn btn-custom' onclick='downloadFormat()'> Download Format </button><br><br><button class='btn btn-danger' onclick='window.location = \"./import_excel.php\";'>Reloag Page</button>";
			}

		}

		unset($PHPExcel);

	} else {
		echo "Error: File ". $_SESSION['tmp_file'] ." Invalid";
	}

} else if ( isset($_GET['importZip']) ) {
	if ( file_exists('../../working/zip/import/'. $_GET['timeToken'] .'/products.xlsx') ) {

		$xlFile = '../../working/zip/import/'. $_GET['timeToken'] .'/products.xlsx';

		include './chunk_reader.php';
		$objReader = PHPExcel_IOFactory::createReader(PHPExcel_IOFactory::identify($xlFile));
		$readFilter = new myReadFilter();
		$objReader->setReadFilter($readFilter);
		$readFilter->getRow($_GET['importZip']);

		$PHPExcel = $objReader->load($xlFile);

		//$xl = $PHPExcel->getActiveSheet()->toArray(null, true, true, true);

		$productSheet = $PHPExcel->getSheetByName('products');
		if ( is_null($productSheet) ) {
			echo "Sheet not found";
		} else {
			$products = $productSheet->toArray(null, true, true, true);

			//$toAdd = explode("_", $_GET['importThis']);

			$error = "";

			if ( sizeof($products[1]) < 30 ) {
				echo '<h4><div class="alert alert-error">Invalid Zip Format</div></h4><p>Please download the defined Zip Format and use that to input entries.</p><br><br><br><br>
				<a class="btn btn-custom" href="./../assets/format.zip">Download Format</a>';
				return;
			}

			if ( !isset($products[1]['A']) || $products[1]['A'] !== "Company Id" ){
				$error .= "Invalid Column: <strong>" . $products[1]['A'] . "</strong><br>";
			}
			if ( !isset($products[1]['B']) || $products[1]['B'] !== "Category Id" ){
				$error .= "Invalid Column: <strong>" . $products[1]['B'] . "</strong><br>";
			}
			if ( !isset($products[1]['C']) || $products[1]['C'] !== "Internal Id" ){
				$error .= "Invalid Column: <strong>" . $products[1]['C'] . "</strong><br>";
			}
			if ( !isset($products[1]['D']) || $products[1]['D'] !== "Product Name"){
				$error .= "Invalid Column: <strong>" . $products[1]['D'] . "</strong><br>";
			}
			if ( !isset($products[1]['E']) || $products[1]['E'] !== "Amount" ){
				$error .= "Invalid Column: <strong>" . $products[1]['E'] . "</strong><br>";
			}
			if ( !isset($products[1]['F']) || $products[1]['F'] !== "Discount Percent" ){
				$error .= "Invalid Column: <strong>" . $products[1]['F'] . "</strong><br>";
			}
			if ( !isset($products[1]['G']) || $products[1]['G'] !== "Pieces in stock" ){
				$error .= "Invalid Column: <strong>" . $products[1]['G'] . "</strong><br>";
			}
			if ( !isset($products[1]['H']) || $products[1]['H'] !== "Days for shipment" ){
				$error .= "Invalid Column: <strong>" . $products[1]['H'] . "</strong><br>";
			}
			if ( !isset($products[1]['I']) || $products[1]['I'] !== "Total gold weight" ){
				$error .= "Invalid Column: <strong>" . $products[1]['I'] . "</strong><br>";
			}
			if ( !isset($products[1]['J']) || $products[1]['J'] !== "Total carat weight" ){
				$error .= "Invalid Column: <strong>" . $products[1]['J'] . "</strong><br>";
			}
			if ( !isset($products[1]['K']) || $products[1]['K'] !== "Color stone carat" ){
				$error .= "Invalid Column: <strong>" . $products[1]['K'] . "</strong><br>";
			}
			if ( !isset($products[1]['L']) || $products[1]['L'] !== "No. of stones" ){
				$error .= "Invalid Column: <strong>" . $products[1]['L'] . "</strong><br>";
			}
			if ( !isset($products[1]['M']) || $products[1]['M'] !== "No. of colour stone" ){
				$error .= "Invalid Column: <strong>" . $products[1]['M'] . "</strong><br>";
			}
			if ( !isset($products[1]['N']) || $products[1]['N'] !== "Diamond Shape" ){
				$error .= "Invalid Column: <strong>" . $products[1]['N'] . "</strong><br>";
			}
			if ( !isset($products[1]['O']) || $products[1]['O'] !== "Color stone shape" ){
				$error .= "Invalid Column: <strong>" . $products[1]['O'] . "</strong><br>";
			}
			if ( !isset($products[1]['P']) || $products[1]['P'] !== "Clarity" ){
				$error .= "Invalid Column: <strong>" . $products[1]['P'] . "</strong><br>";
			}
			if ( !isset($products[1]['Q']) || $products[1]['Q'] !== "Color" ){
				$error .= "Invalid Column: <strong>" . $products[1]['Q'] . "</strong><br>";
			}
			if ( !isset($products[1]['R']) || $products[1]['R'] !== "Material" ){
				$error .= "Invalid Column: <strong>" . $products[1]['R'] . "</strong><br>";
			}
			if ( !isset($products[1]['S']) || $products[1]['S'] !== "Gold Quality" ){
				$error .= "Invalid Column: <strong>" . $products[1]['S'] . "</strong><br>";
			}
			if ( !isset($products[1]['T']) || $products[1]['T'] !== "Color Stone Type" ){
				$error .= "Invalid Column: <strong>" . $products[1]['T'] . "</strong><br>";
			}
			if ( !isset($products[1]['U']) || $products[1]['U'] !== "Height" ){
				$error .= "Invalid Column: <strong>" . $products[1]['U'] . "</strong><br>";
			}
			if ( !isset($products[1]['V']) || $products[1]['V'] !== "Width" ){
				$error .= "Invalid Column: <strong>" . $products[1]['V'] . "</strong><br>";
			}
			if ( !isset($products[1]['W']) || $products[1]['W'] !== "Length" ){
				$error .= "Invalid Column: <strong>" . $products[1]['W'] . "</strong><br>";
			}
			if ( !isset($products[1]['X']) || $products[1]['X'] !== "Ring size" ){
				$error .= "Invalid Column: <strong>" . $products[1]['X'] . "</strong><br>";
			}
			if ( !isset($products[1]['Y']) || $products[1]['Y'] !== "Country Id" ){
				$error .= "Invalid Column: <strong>" . $products[1]['Y'] . "</strong><br>";
			}
			if ( !isset($products[1]['Z']) || $products[1]['Z'] !== "Subcategory" ){
				$error .= "Invalid Column: <strong>" . $products[1]['Z'] . "</strong><br>";
			}
			if ( !isset($products[1]['AA']) || $products[1]['AA'] !== "Lab Grown Diamond" ){
				$error .= "Invalid Column: <strong>" . $products[1]['AA'] . "</strong><br>";
			}
			if ( !isset($products[1]['AB']) || $products[1]['AB'] !== "Images (comma \",\" separated)" ){
				$error .= "Invalid Column: <strong>" . $products[1]['AB'] . "</strong><br>";
			}
			if ( !isset($products[1]['AC']) || $products[1]['AC'] !== "Description" ) {
				$error .= "Invalid Column: <strong>" . $products[1]['AC'] . "</strong><br>";
			}
			if ( !isset($products[1]['AD']) || $products[1]['AD'] !== "Description (French)" ) {
				$error .= "Invalid Column: <strong>" . $products[1]['AD'] . "</strong><br>";
			}
			if ( !isset($products[1]['AE']) || $products[1]['AE'] !== "Diamond Color" ) {
				$error .= "Invalid Column: <strong>" . $products[1]['AE'] ."</strong><br>";
			}

			if ( !isset($products[1]['AF']) || $products[1]['AF'] !== "Family" ) {
				$error .= "Invalid Column: <strong>" . $products[1]['AF'] ."</strong><br>";
			}
			if ( !isset($products[1]['AG']) || $products[1]['AG'] !== "Site ID (comma \",\" separated)" ) {
				$error .= "Invalid Column: <strong>" . $products[1]['AG'] ."</strong><br>";
			}

			if ( empty($error) ) {
				$result = "";
				$i = $_GET['importZip'];

				if ( empty($products[$i]['D']) ) {
					$result = [];
					array_push($result, 'failure');
					array_push($result, "N/A");
					array_push($result, "Empty Data");
					array_push($result, $i);
					echo json_encode($result);
					return;
				}
				$acceptedCategories = array(1,2,3,4,5);
				if ( !in_array($products[$i]['B'], $acceptedCategories) ) {
					$result = [];
					array_push($result, 'failure');
					array_push($result, $products[$i]['D']);
					array_push($result, "Invalid Category: " . $products[$i]['B']);
					array_push($result, $i);
					echo json_encode($result);
					return;
				}
				$acceptedClarity = array("FL", "IF", "VVS1", "VVS2", "VS1", "VS2", "SI1", "SI2", "SI3", "I1");
				if ( !in_array($products[$i]['P'], $acceptedClarity) ) {
					$result = [];
					array_push($result, 'failure');
					array_push($result, $products[$i]['D']);
					array_push($result, "Invalid Clarity: " . $products[$i]['P']);
					array_push($result, $i);
					echo json_encode($result);
					return;
				}

				$checkCompany = $pdo->prepare("SELECT * FROM `company_id` WHERE `company_code` = :cc");
				$checkCompany->execute(array(":cc" => $products[$i]['A']));

				if ( $checkCompany->rowCount() == 0 ) {
					$result = [];
					array_push($result, 'failure');
					array_push($result, $products[$i]['D']);
					array_push($result, "Invalid Company Code: " . $products[$i]['A']);
					array_push($result, $i);
					echo json_encode($result);
					return;
				}

				$internalID = $products[$i]['C'];


				switch( $products[$i]['B'] ) {
					case 1 : {
						$checkInternalID = $pdo->prepare("SELECT * FROM rings WHERE `internal_id` = :intID");
						$checkInternalID->execute(array(":intID" => $internalID));

						if ( $checkInternalID->rowCount() > 0 ) {
							$resultValues = $checkInternalID->fetch(PDO::FETCH_ASSOC);

							$getItemMainValues = $pdo->prepare("SELECT * FROM items WHERE `unique_key` = :unique_key");
							$getItemMainValues->execute(array(":unique_key" => $resultValues['unique_key']));

							if ( $getItemMainValues->rowCount() > 0 ) {
								$resultValues = array_merge($getItemMainValues->fetch(PDO::FETCH_ASSOC), $resultValues);
								$valuesDB = 
										getCompanyCode($resultValues['company_id'], $pdo) . 
										$resultValues['category'] . 
										$resultValues['internal_id'] . 
										$resultValues['product_name'] . 
										$resultValues['item_value'] . 
										$resultValues['discount'] . 
										$resultValues['pieces_in_stock'] . 
										$resultValues['days_for_shipment'] . 
										$resultValues['total_gold_weight'] . 
										$resultValues['total_carat_weight'] . 
										$resultValues['color_stone_carat'] . 
										$resultValues['no_of_stones'] . 
										$resultValues['no_of_color_stones'] . 
										$resultValues['diamond_shape'] . 
										$resultValues['color_stone_shape'] . 
										$resultValues['clarity'] . 
										$resultValues['color'] . 
										$resultValues['material'] .
										$resultValues['gold_quality'] .
										$resultValues['color_stone_type'] .
										$resultValues['height'] . 
										$resultValues['width'] . 
										$resultValues['length'] . 
										$resultValues['ring_size'] . 
										$resultValues['country_id'] . 
										$resultValues['ring_subcategory'] . 
										$resultValues['lab_grown'] . 
										$resultValues['images_delta'] . 
										$resultValues['description'] .
										$resultValues['description_french'] . 
										$resultValues['diamond_color'] .
										$resultValues['family'] .
										$resultValues['site_0'] .
										$resultValues['site_1'] .
										$resultValues['site_2'] .
										$resultValues['site_3'] .
										$resultValues['site_4'] .
										$resultValues['site_5'] .
										$resultValues['site_6'] .
										$resultValues['site_7'] ;

								$siteIdsArr = getSiteidsValue($products[$i]['AG']);

								$valuesSQL = 
										$products[$i]['A'] . 
										$products[$i]['B'] . 
										$internalID . 
										$products[$i]['D'] . 
										$products[$i]['E'] . 
										$products[$i]['F'] . 
										$products[$i]['G'] . 
										$products[$i]['H'] . 
										$products[$i]['I'] . 
										$products[$i]['J'] . 
										$products[$i]['K'] . 
										$products[$i]['L'] . 
										$products[$i]['M'] . 
										$products[$i]['N'] . 
										$products[$i]['O'] . 
										$products[$i]['P'] . 
										$products[$i]['Q'] . 
										$products[$i]['R'] . 
										$products[$i]['S'] . 
										$products[$i]['T'] . 
										$products[$i]['U'] . 
										$products[$i]['V'] . 
										$products[$i]['W'] . 
										$products[$i]['X'] . 
										$products[$i]['Y'] . 
										$products[$i]['Z'] . 
										$products[$i]['AA'] .
										$products[$i]['AB'] .
										$products[$i]['AC'] .
										$products[$i]['AD'] .
										$products[$i]['AE'] .
										$products[$i]['AF'] .
										$siteIdsArr[0] .
										$siteIdsArr[1] .
										$siteIdsArr[2] .
										$siteIdsArr[3] .
										$siteIdsArr[4] .
										$siteIdsArr[5] .
										$siteIdsArr[6] .
										$siteIdsArr[7] ;

								$hashDB = strtoupper(hash("md5", $valuesDB ));


								$hashSQL = strtoupper(hash("md5", $valuesSQL ));
								// error_log("\n ".$hashDB ." ------1479----".$hashSQL,3,'C:/laragon/www/git/diam_prince/diamantsecret/test.log');
								#for Rings (has column S T and U)
								#$hashSQL = strtoupper(hash("md5", $products[$i]['A'] . $products[$i]['B'] . $internalID . $products[$i]['D'] . $products[$i]['F'] . $products[$i]['G'] . $products[$i]['H'] . $products[$i]['I'] . $products[$i]['J'] . $products[$i]['K'] . $products[$i]['L'] . $products[$i]['M'] . $products[$i]['N'] . $products[$i]['O'] . $products[$i]['P'] . $products[$i]['Q'] . $products[$i]['R'] . $products[$i]['S'] . $products[$i]['T'] . $products[$i]['U'] . $products[$i]['V'] ));

								#$resultStatus = "DB: " . getCompanyCode($resultValues['company_id'], $pdo) . "<br>";
								#$resultStatus .= "SQL: " . $products[$i]['A'];
								if ( $hashDB == $hashSQL ) {
									$resultMessage = "neutral";
									$resultStatus = "Duplicate Entry - Skipping";
									$duplicate++;
									#$resultStatus .= json_encode($valuesDB);
									#$resultStatus .= json_encode($valuesSQL);
								} else {
									$resultMessage = "success";
									$resultStatus = "Product Updated";
									$updated++;
									#$resultStatus .= json_encode($valuesDB);
									#$resultStatus .= json_encode($valuesSQL);
									
									$returnMessage = updateImportZipItem($pdo, $resultValues['unique_key'], $products[$i], 1, $_GET['timeToken'], $__MAINDOMAIN__, $__IMPORT_IMAGE_RES__);
									updateImportSiteIds($pdo, $resultValues['unique_key'], $siteIdsArr);

									if ( $returnMessage !== " - No Errors" ) {
										$resultMessage = "warning";
									}

									$resultStatus .= $returnMessage;

								}
							} else {
								$resultMessage = "failure";
								$resultStatus = "Invalid Item";
							}


							$result = [];
							array_push($result, $resultMessage);
							array_push($result, $products[$i]['D']);
							array_push($result, $resultStatus);
							array_push($result, $i);
							array_push($result, $updated);
							array_push($result, $duplicate);
							echo json_encode($result);

							return;
						}
						break;
					}
					case 2 : {
						$checkInternalID = $pdo->prepare("SELECT * FROM earrings WHERE `internal_id` = :intID");
						$checkInternalID->execute(array(":intID" => $internalID));

						if ( $checkInternalID->rowCount() > 0 ) {
							$resultValues = $checkInternalID->fetch(PDO::FETCH_ASSOC);

							$getItemMainValues = $pdo->prepare("SELECT * FROM items WHERE `unique_key` = :unique_key");
							$getItemMainValues->execute(array(":unique_key" => $resultValues['unique_key']));

							if ( $getItemMainValues->rowCount() > 0 ) {

								
								$resultValues = array_merge($getItemMainValues->fetch(PDO::FETCH_ASSOC), $resultValues);


								$valuesDB = 
										getCompanyCode($resultValues['company_id'], $pdo) . 
										$resultValues['category'] . 
										$resultValues['internal_id'] . 
										$resultValues['product_name'] . 
										$resultValues['item_value'] . 
										$resultValues['discount'] . 
										$resultValues['pieces_in_stock'] . 
										$resultValues['days_for_shipment'] . 
										$resultValues['total_gold_weight'] . 
										$resultValues['total_carat_weight'] . 
										$resultValues['color_stone_carat'] . 
										$resultValues['no_of_stones'] . 
										$resultValues['no_of_color_stones'] . 
										$resultValues['diamond_shape'] . 
										$resultValues['color_stone_shape'] . 
										$resultValues['clarity'] . 
										$resultValues['color'] . 
										$resultValues['material'] .
										$resultValues['gold_quality'] .
										$resultValues['color_stone_type'] .
										$resultValues['height'] . 
										$resultValues['width'] . 
										$resultValues['length'] . 
										$resultValues['ring_size'] . 
										$resultValues['country_id'] . 
										$resultValues['ring_subcategory'] . 
										$resultValues['lab_grown'] . 
										$resultValues['images_delta'] . 
										$resultValues['description'] .
										$resultValues['description_french'] . 
										$resultValues['diamond_color'].
										$resultValues['family'] .
										$resultValues['site_0'] .
										$resultValues['site_1'] .
										$resultValues['site_2'] .
										$resultValues['site_3'] .
										$resultValues['site_4'] .
										$resultValues['site_5'] .
										$resultValues['site_6'] .
										$resultValues['site_7'] ;

								$siteIdsArr = getSiteidsValue($products[$i]['AG']);

								$valuesSQL = 
										$products[$i]['A'] . 
										$products[$i]['B'] . 
										$internalID . 
										$products[$i]['D'] . 
										$products[$i]['E'] . 
										$products[$i]['F'] . 
										$products[$i]['G'] . 
										$products[$i]['H'] . 
										$products[$i]['I'] . 
										$products[$i]['J'] . 
										$products[$i]['K'] . 
										$products[$i]['L'] . 
										$products[$i]['M'] . 
										$products[$i]['N'] . 
										$products[$i]['O'] . 
										$products[$i]['P'] . 
										$products[$i]['Q'] . 
										$products[$i]['R'] . 
										$products[$i]['S'] . 
										$products[$i]['T'] . 
										$products[$i]['U'] . 
										$products[$i]['V'] . 
										$products[$i]['W'] . 
										$products[$i]['X'] . 
										$products[$i]['Y'] . 
										$products[$i]['Z'] . 
										$products[$i]['AA'] .
										$products[$i]['AB'] .
										$products[$i]['AC'] .
										$products[$i]['AD'] .
										$products[$i]['AE'] .
										$products[$i]['AF'] .
										$siteIdsArr[0] .
										$siteIdsArr[1] .
										$siteIdsArr[2] .
										$siteIdsArr[3] .
										$siteIdsArr[4] .
										$siteIdsArr[5] .
										$siteIdsArr[6] .
										$siteIdsArr[7] ;

								$hashDB = strtoupper(hash("md5", $valuesDB ));


								$hashSQL = strtoupper(hash("md5", $valuesSQL ));
								// error_log("\n ".$hashDB ." ------1609----".$hashSQL.'-------'.$products[$i]['AF'].'------------------------'.$resultValues['family'],3,'C:/laragon/www/git/diam_prince/diamantsecret/test.log');

								#for Rings (has column S T and U)
								#$hashSQL = strtoupper(hash("md5", $products[$i]['A'] . $products[$i]['B'] . $internalID . $products[$i]['D'] . $products[$i]['F'] . $products[$i]['G'] . $products[$i]['H'] . $products[$i]['I'] . $products[$i]['J'] . $products[$i]['K'] . $products[$i]['L'] . $products[$i]['M'] . $products[$i]['N'] . $products[$i]['O'] . $products[$i]['P'] . $products[$i]['Q'] . $products[$i]['R'] . $products[$i]['S'] . $products[$i]['T'] . $products[$i]['U'] . $products[$i]['V'] ));

								#$resultStatus = "DB: " . getCompanyCode($resultValues['company_id'], $pdo) . "<br>";
								#$resultStatus .= "SQL: " . $products[$i]['A'];
								if ( $hashDB == $hashSQL ) {
									$resultMessage = "neutral";
									$resultStatus = "Duplicate Entry - Skipping";
									$duplicate++;
									#$resultStatus .= json_encode($valuesDB);
									#$resultStatus .= json_encode($valuesSQL);
								} else {
									$resultMessage = "success";
									$resultStatus = "Product Updated";
									$updated++;
									#$resultStatus .= json_encode($valuesDB);
									#$resultStatus .= json_encode($valuesSQL);
									
									$returnMessage = updateImportZipItem($pdo, $resultValues['unique_key'], $products[$i], 1, $_GET['timeToken'], $__MAINDOMAIN__, $__IMPORT_IMAGE_RES__);

									updateImportSiteIds($pdo, $resultValues['unique_key'], $siteIdsArr);

									if ( $returnMessage !== " - No Errors" ) {
										$resultMessage = "warning";
									}

									$resultStatus .= $returnMessage;

								}
							} else {
								$resultMessage = "failure";
								$resultStatus = "Invalid Item";
							}


							$result = [];
							array_push($result, $resultMessage);
							array_push($result, $products[$i]['D']);
							array_push($result, $resultStatus);
							array_push($result, $i);
							array_push($result, $updated);
							array_push($result, $duplicate);
							echo json_encode($result);

							return;
						}
						break;
					}
					case 3 : {
						$checkInternalID = $pdo->prepare("SELECT * FROM pendants WHERE `internal_id` = :intID");
						$checkInternalID->execute(array(":intID" => $internalID));

						if ( $checkInternalID->rowCount() > 0 ) {
							$resultValues = $checkInternalID->fetch(PDO::FETCH_ASSOC);

							$getItemMainValues = $pdo->prepare("SELECT * FROM items WHERE `unique_key` = :unique_key");
							$getItemMainValues->execute(array(":unique_key" => $resultValues['unique_key']));

							if ( $getItemMainValues->rowCount() > 0 ) {
								$resultValues = array_merge($getItemMainValues->fetch(PDO::FETCH_ASSOC), $resultValues);
								$valuesDB = 
										getCompanyCode($resultValues['company_id'], $pdo) . 
										$resultValues['category'] . 
										$resultValues['internal_id'] . 
										$resultValues['product_name'] . 
										$resultValues['item_value'] . 
										$resultValues['discount'] . 
										$resultValues['pieces_in_stock'] . 
										$resultValues['days_for_shipment'] . 
										$resultValues['total_gold_weight'] . 
										$resultValues['total_carat_weight'] . 
										$resultValues['color_stone_carat'] . 
										$resultValues['no_of_stones'] . 
										$resultValues['no_of_color_stones'] . 
										$resultValues['diamond_shape'] . 
										$resultValues['color_stone_shape'] . 
										$resultValues['clarity'] . 
										$resultValues['color'] . 
										$resultValues['material'] .
										$resultValues['gold_quality'] .
										$resultValues['color_stone_type'] .
										$resultValues['height'] . 
										$resultValues['width'] . 
										$resultValues['length'] . 
										$resultValues['ring_size'] . 
										$resultValues['country_id'] . 
										$resultValues['ring_subcategory'] . 
										$resultValues['lab_grown'] . 
										$resultValues['images_delta'] . 
										$resultValues['description'] .
										$resultValues['description_french'] . 
										$resultValues['diamond_color'] .
										$resultValues['family'] .
										$resultValues['site_0'] .
										$resultValues['site_1'] .
										$resultValues['site_2'] .
										$resultValues['site_3'] .
										$resultValues['site_4'] .
										$resultValues['site_5'] .
										$resultValues['site_6'] .
										$resultValues['site_7'] ;

								$siteIdsArr = getSiteidsValue($products[$i]['AG']);

								$valuesSQL = 
										$products[$i]['A'] . 
										$products[$i]['B'] . 
										$internalID . 
										$products[$i]['D'] . 
										$products[$i]['E'] . 
										$products[$i]['F'] . 
										$products[$i]['G'] . 
										$products[$i]['H'] . 
										$products[$i]['I'] . 
										$products[$i]['J'] . 
										$products[$i]['K'] . 
										$products[$i]['L'] . 
										$products[$i]['M'] . 
										$products[$i]['N'] . 
										$products[$i]['O'] . 
										$products[$i]['P'] . 
										$products[$i]['Q'] . 
										$products[$i]['R'] . 
										$products[$i]['S'] . 
										$products[$i]['T'] . 
										$products[$i]['U'] . 
										$products[$i]['V'] . 
										$products[$i]['W'] . 
										$products[$i]['X'] . 
										$products[$i]['Y'] . 
										$products[$i]['Z'] . 
										$products[$i]['AA'] .
										$products[$i]['AB'] .
										$products[$i]['AC'] .
										$products[$i]['AD'] .
										$products[$i]['AE'] .
										$products[$i]['AF'] .
										$siteIdsArr[0] .
										$siteIdsArr[1] .
										$siteIdsArr[2] .
										$siteIdsArr[3] .
										$siteIdsArr[4] .
										$siteIdsArr[5] .
										$siteIdsArr[6] .
										$siteIdsArr[7] ;

								$hashDB = strtoupper(hash("md5", $valuesDB ));


								$hashSQL = strtoupper(hash("md5", $valuesSQL ));
								#for Rings (has column S T and U)
								#$hashSQL = strtoupper(hash("md5", $products[$i]['A'] . $products[$i]['B'] . $internalID . $products[$i]['D'] . $products[$i]['F'] . $products[$i]['G'] . $products[$i]['H'] . $products[$i]['I'] . $products[$i]['J'] . $products[$i]['K'] . $products[$i]['L'] . $products[$i]['M'] . $products[$i]['N'] . $products[$i]['O'] . $products[$i]['P'] . $products[$i]['Q'] . $products[$i]['R'] . $products[$i]['S'] . $products[$i]['T'] . $products[$i]['U'] . $products[$i]['V'] ));

								#$resultStatus = "DB: " . getCompanyCode($resultValues['company_id'], $pdo) . "<br>";
								#$resultStatus .= "SQL: " . $products[$i]['A'];
								if ( $hashDB == $hashSQL ) {
									$resultMessage = "neutral";
									$resultStatus = "Duplicate Entry - Skipping";
									$duplicate++;
									#$resultStatus .= json_encode($valuesDB);
									#$resultStatus .= json_encode($valuesSQL);
								} else {
									$resultMessage = "success";
									$resultStatus = "Product Updated";
									$updated++;
									#$resultStatus .= json_encode($valuesDB);
									#$resultStatus .= json_encode($valuesSQL);
									
									$returnMessage = updateImportZipItem($pdo, $resultValues['unique_key'], $products[$i], 1, $_GET['timeToken'], $__MAINDOMAIN__, $__IMPORT_IMAGE_RES__);
									updateImportSiteIds($pdo, $resultValues['unique_key'], $siteIdsArr);
									if ( $returnMessage !== " - No Errors" ) {
										$resultMessage = "warning";
									}

									$resultStatus .= $returnMessage;

								}
							} else {
								$resultMessage = "failure";
								$resultStatus = "Invalid Item";
							}


							$result = [];
							array_push($result, $resultMessage);
							array_push($result, $products[$i]['D']);
							array_push($result, $resultStatus);
							array_push($result, $i);
							array_push($result, $updated);
							array_push($result, $duplicate);
							echo json_encode($result);

							return;
						}
						break;
					}
					case 4 : {
						$checkInternalID = $pdo->prepare("SELECT * FROM necklaces WHERE `internal_id` = :intID");
						$checkInternalID->execute(array(":intID" => $internalID));

						if ( $checkInternalID->rowCount() > 0 ) {
							$resultValues = $checkInternalID->fetch(PDO::FETCH_ASSOC);

							$getItemMainValues = $pdo->prepare("SELECT * FROM items WHERE `unique_key` = :unique_key");
							$getItemMainValues->execute(array(":unique_key" => $resultValues['unique_key']));

							if ( $getItemMainValues->rowCount() > 0 ) {
								$resultValues = array_merge($getItemMainValues->fetch(PDO::FETCH_ASSOC), $resultValues);
								$valuesDB = 
										getCompanyCode($resultValues['company_id'], $pdo) . 
										$resultValues['category'] . 
										$resultValues['internal_id'] . 
										$resultValues['product_name'] . 
										$resultValues['item_value'] . 
										$resultValues['discount'] . 
										$resultValues['pieces_in_stock'] . 
										$resultValues['days_for_shipment'] . 
										$resultValues['total_gold_weight'] . 
										$resultValues['total_carat_weight'] . 
										$resultValues['color_stone_carat'] . 
										$resultValues['no_of_stones'] . 
										$resultValues['no_of_color_stones'] . 
										$resultValues['diamond_shape'] . 
										$resultValues['color_stone_shape'] . 
										$resultValues['clarity'] . 
										$resultValues['color'] . 
										$resultValues['material'] .
										$resultValues['gold_quality'] .
										$resultValues['color_stone_type'] .
										$resultValues['height'] . 
										$resultValues['width'] . 
										$resultValues['length'] . 
										$resultValues['ring_size'] . 
										$resultValues['country_id'] . 
										$resultValues['ring_subcategory'] . 
										$resultValues['lab_grown'] . 
										$resultValues['images_delta'] . 
										$resultValues['description'] .
										$resultValues['description_french'] . 
										$resultValues['diamond_color'] .
										$resultValues['family'] .
										$resultValues['site_0'] .
										$resultValues['site_1'] .
										$resultValues['site_2'] .
										$resultValues['site_3'] .
										$resultValues['site_4'] .
										$resultValues['site_5'] .
										$resultValues['site_6'] .
										$resultValues['site_7'] ;
								$siteIdsArr = getSiteidsValue($products[$i]['AG']);
								$valuesSQL = 
										$products[$i]['A'] . 
										$products[$i]['B'] . 
										$internalID . 
										$products[$i]['D'] . 
										$products[$i]['E'] . 
										$products[$i]['F'] . 
										$products[$i]['G'] . 
										$products[$i]['H'] . 
										$products[$i]['I'] . 
										$products[$i]['J'] . 
										$products[$i]['K'] . 
										$products[$i]['L'] . 
										$products[$i]['M'] . 
										$products[$i]['N'] . 
										$products[$i]['O'] . 
										$products[$i]['P'] . 
										$products[$i]['Q'] . 
										$products[$i]['R'] . 
										$products[$i]['S'] . 
										$products[$i]['T'] . 
										$products[$i]['U'] . 
										$products[$i]['V'] . 
										$products[$i]['W'] . 
										$products[$i]['X'] . 
										$products[$i]['Y'] . 
										$products[$i]['Z'] . 
										$products[$i]['AA'] .
										$products[$i]['AB'] .
										$products[$i]['AC'] .
										$products[$i]['AD'] .
										$products[$i]['AE'] .
										$products[$i]['AF'] .
										$siteIdsArr[0] .
										$siteIdsArr[1] .
										$siteIdsArr[2] .
										$siteIdsArr[3] .
										$siteIdsArr[4] .
										$siteIdsArr[5] .
										$siteIdsArr[6] .
										$siteIdsArr[7] ;

								$hashDB = strtoupper(hash("md5", $valuesDB ));


								$hashSQL = strtoupper(hash("md5", $valuesSQL ));
								#for Rings (has column S T and U)
								#$hashSQL = strtoupper(hash("md5", $products[$i]['A'] . $products[$i]['B'] . $internalID . $products[$i]['D'] . $products[$i]['F'] . $products[$i]['G'] . $products[$i]['H'] . $products[$i]['I'] . $products[$i]['J'] . $products[$i]['K'] . $products[$i]['L'] . $products[$i]['M'] . $products[$i]['N'] . $products[$i]['O'] . $products[$i]['P'] . $products[$i]['Q'] . $products[$i]['R'] . $products[$i]['S'] . $products[$i]['T'] . $products[$i]['U'] . $products[$i]['V'] ));

								#$resultStatus = "DB: " . getCompanyCode($resultValues['company_id'], $pdo) . "<br>";
								#$resultStatus .= "SQL: " . $products[$i]['A'];
								if ( $hashDB == $hashSQL ) {
									$resultMessage = "neutral";
									$resultStatus = "Duplicate Entry - Skipping";
									$duplicate++;
									#$resultStatus .= json_encode($valuesDB);
									#$resultStatus .= json_encode($valuesSQL);
								} else {
									$resultMessage = "success";
									$resultStatus = "Product Updated";
									$updated++;
									#$resultStatus .= json_encode($valuesDB);
									#$resultStatus .= json_encode($valuesSQL);
									
									$returnMessage = updateImportZipItem($pdo, $resultValues['unique_key'], $products[$i], 1, $_GET['timeToken'], $__MAINDOMAIN__, $__IMPORT_IMAGE_RES__);
									updateImportSiteIds($pdo, $resultValues['unique_key'], $siteIdsArr);

									if ( $returnMessage !== " - No Errors" ) {
										$resultMessage = "warning";
									}

									$resultStatus .= $returnMessage;

								}
							} else {
								$resultMessage = "failure";
								$resultStatus = "Invalid Item";
							}


							$result = [];
							array_push($result, $resultMessage);
							array_push($result, $products[$i]['D']);
							array_push($result, $resultStatus);
							array_push($result, $i);
							array_push($result, $updated);
							array_push($result, $duplicate);
							echo json_encode($result);

							return;
						}
						break;
					}
					case 5 : {
						$checkInternalID = $pdo->prepare("SELECT * FROM bracelets WHERE `internal_id` = :intID");
						$checkInternalID->execute(array(":intID" => $internalID));

						if ( $checkInternalID->rowCount() > 0 ) {
							$resultValues = $checkInternalID->fetch(PDO::FETCH_ASSOC);

							$getItemMainValues = $pdo->prepare("SELECT * FROM items WHERE `unique_key` = :unique_key");
							$getItemMainValues->execute(array(":unique_key" => $resultValues['unique_key']));

							if ( $getItemMainValues->rowCount() > 0 ) {
								$resultValues = array_merge($getItemMainValues->fetch(PDO::FETCH_ASSOC), $resultValues);
								$valuesDB = 
										getCompanyCode($resultValues['company_id'], $pdo) . 
										$resultValues['category'] . 
										$resultValues['internal_id'] . 
										$resultValues['product_name'] . 
										$resultValues['item_value'] . 
										$resultValues['discount'] . 
										$resultValues['pieces_in_stock'] . 
										$resultValues['days_for_shipment'] . 
										$resultValues['total_gold_weight'] . 
										$resultValues['total_carat_weight'] . 
										$resultValues['color_stone_carat'] . 
										$resultValues['no_of_stones'] . 
										$resultValues['no_of_color_stones'] . 
										$resultValues['diamond_shape'] . 
										$resultValues['color_stone_shape'] . 
										$resultValues['clarity'] . 
										$resultValues['color'] . 
										$resultValues['material'] .
										$resultValues['gold_quality'] .
										$resultValues['color_stone_type'] .
										$resultValues['height'] . 
										$resultValues['width'] . 
										$resultValues['length'] . 
										$resultValues['ring_size'] . 
										$resultValues['country_id'] . 
										$resultValues['ring_subcategory'] . 
										$resultValues['lab_grown'] . 
										$resultValues['images_delta'] . 
										$resultValues['description'] .
										$resultValues['description_french'] . 
										$resultValues['diamond_color'] .
										$resultValues['family'] .
										$resultValues['site_0'] .
										$resultValues['site_1'] .
										$resultValues['site_2'] .
										$resultValues['site_3'] .
										$resultValues['site_4'] .
										$resultValues['site_5'] .
										$resultValues['site_6'] .
										$resultValues['site_7'] ;

								$siteIdsArr = getSiteidsValue($products[$i]['AG']);

								$valuesSQL = 
										$products[$i]['A'] . 
										$products[$i]['B'] . 
										$internalID . 
										$products[$i]['D'] . 
										$products[$i]['E'] . 
										$products[$i]['F'] . 
										$products[$i]['G'] . 
										$products[$i]['H'] . 
										$products[$i]['I'] . 
										$products[$i]['J'] . 
										$products[$i]['K'] . 
										$products[$i]['L'] . 
										$products[$i]['M'] . 
										$products[$i]['N'] . 
										$products[$i]['O'] . 
										$products[$i]['P'] . 
										$products[$i]['Q'] . 
										$products[$i]['R'] . 
										$products[$i]['S'] . 
										$products[$i]['T'] . 
										$products[$i]['U'] . 
										$products[$i]['V'] . 
										$products[$i]['W'] . 
										$products[$i]['X'] . 
										$products[$i]['Y'] . 
										$products[$i]['Z'] . 
										$products[$i]['AA'] .
										$products[$i]['AB'] .
										$products[$i]['AC'] .
										$products[$i]['AD'] .
										$products[$i]['AE'] .
										$products[$i]['AF'] .
										$siteIdsArr[0] .
										$siteIdsArr[1] .
										$siteIdsArr[2] .
										$siteIdsArr[3] .
										$siteIdsArr[4] .
										$siteIdsArr[5] .
										$siteIdsArr[6] .
										$siteIdsArr[7] ;

								$hashDB = strtoupper(hash("md5", $valuesDB ));


								$hashSQL = strtoupper(hash("md5", $valuesSQL ));
								
								#for Rings (has column S T and U)
								#$hashSQL = strtoupper(hash("md5", $products[$i]['A'] . $products[$i]['B'] . $internalID . $products[$i]['D'] . $products[$i]['F'] . $products[$i]['G'] . $products[$i]['H'] . $products[$i]['I'] . $products[$i]['J'] . $products[$i]['K'] . $products[$i]['L'] . $products[$i]['M'] . $products[$i]['N'] . $products[$i]['O'] . $products[$i]['P'] . $products[$i]['Q'] . $products[$i]['R'] . $products[$i]['S'] . $products[$i]['T'] . $products[$i]['U'] . $products[$i]['V'] ));

								#$resultStatus = "DB: " . getCompanyCode($resultValues['company_id'], $pdo) . "<br>";
								#$resultStatus .= "SQL: " . $products[$i]['A'];
								if ( $hashDB == $hashSQL ) {
									$resultMessage = "neutral";
									$resultStatus = "Duplicate Entry - Skipping";
									$duplicate++;
									#$resultStatus .= json_encode($valuesDB);
									#$resultStatus .= json_encode($valuesSQL);
								} else {
									$resultMessage = "success";
									$resultStatus = "Product Updated";
									$updated++;
									#$resultStatus .= json_encode($valuesDB);
									#$resultStatus .= json_encode($valuesSQL);
									
									$returnMessage = updateImportZipItem($pdo, $resultValues['unique_key'], $products[$i], 1, $_GET['timeToken'], $__MAINDOMAIN__, $__IMPORT_IMAGE_RES__);
									updateImportSiteIds($pdo, $resultValues['unique_key'], $siteIdsArr);

									if ( $returnMessage !== " - No Errors" ) {
										$resultMessage = "warning";
									}

									$resultStatus .= $returnMessage;

								}
							} else {
								$resultMessage = "failure";
								$resultStatus = "Invalid Item";
							}


							$result = [];
							array_push($result, $resultMessage);
							array_push($result, $products[$i]['D']);
							array_push($result, $resultStatus);
							array_push($result, $i);
							array_push($result, $updated);
							array_push($result, $duplicate);
							echo json_encode($result);

							return;
						}
						break;
					}
				}
				
				// error_log("\n ".$products[$i]['AG']." 2052 ---skiping records---",3,'C:/laragon/www/git/diam_prince/diamantsecret/test.log');


					$company_id = "0";
					if ( isset($_SESSION['import_company_id_zip']) ) {
						$company_id = $_SESSION['import_company_id_zip'];
					}

					$company_id = getCompanyID($products[$i]['A'], $pdo);

					$uniqueKey = generateUniqueKey();
					
					while ( checkKey($uniqueKey, $pdo) ) {
						$uniqueKey = generateUniqueKey();
					}

					if ( empty($products[$i]['AA']) ) {
						$products[$i]['AA'] = "-";
					}

					/* VAR TYPE CHECK */
					if ( !is_integer($products[$i]['G']) ) {
						$products[$i]['G'] = intval($products[$i]['G']);
					}
					if ( !is_integer($products[$i]['H']) ) {
						$products[$i]['H'] = intval($products[$i]['H']);
					}
					if ( !is_integer($products[$i]['L']) ) {
						$products[$i]['L'] = intval($products[$i]['L']);
					}
					if ( !is_integer($products[$i]['M']) ) {
						$products[$i]['M'] = intval($products[$i]['M']);
					}
					if ( !is_integer($products[$i]['N']) ) {
						$products[$i]['N'] = intval($products[$i]['N']);
					}
					if ( !is_integer($products[$i]['O']) ) {
						$products[$i]['O'] = intval($products[$i]['O']);
					}
					if ( !is_integer($products[$i]['Q']) ) {
						$products[$i]['Q'] = intval($products[$i]['Q']);
					}
					if ( !is_integer($products[$i]['R']) ) {
						$products[$i]['R'] = intval($products[$i]['R']);
					}
					if ( !is_integer($products[$i]['W']) ) {
						$products[$i]['W'] = intval($products[$i]['W']);
					}
					/* if ( !is_integer($products[$i]['X']) ) {
						$products[$i]['X'] = intval($products[$i]['X']);
					} */
					if ( !is_integer($products[$i]['Y']) ) {
						$products[$i]['Y'] = intval($products[$i]['Y']);
					}
					if ( !is_integer($products[$i]['AE']) ) {
						$products[$i]['AE'] = intval($products[$i]['AE']);
					}
					if ( !is_integer($products[$i]['S']) ) {
						$products[$i]['S'] = intval($products[$i]['S']);
					}

					
						
						// $addItem = $pdo->prepare("INSERT INTO `items` (`unique_key`, `item_name`, `item_value`, `discount`, `category`, `featured`, family, images_delta, $col_name `date_added`) VALUES (:unique_key, :product_name, :product_price, :discount, :category, 0, :family, :images_delta, $col_alais NOW())");

						// $args = array(
						// 	":unique_key" => $uniqueKey,
						// 	":product_name" => $products[$i]['D'],
						// 	":product_price" => $products[$i]['E'],
						// 	":discount" => $products[$i]['F'],
						// 	":category" => $products[$i]['B'],
						// 	":family" => $products[$i]['AF'],
						// 	":images_delta" => $products[$i]['AB'],
						// );
						// $args = array_merge($col_val,$args);
						// $addItem->execute($args);

						$addItem = $pdo->prepare("INSERT INTO `items` (`unique_key`, `item_name`, `item_value`, `discount`, `category`, `featured`, family, images_delta, `date_added`) VALUES (:unique_key, :product_name, :product_price, :discount, :category, 0, :family, :images_delta, NOW())");

						$addItem->execute(array(
								":unique_key" => $uniqueKey,
								":product_name" => $products[$i]['D'],
								":product_price" => $products[$i]['E'],
								":discount" => $products[$i]['F'],
								":category" => $products[$i]['B'],
								":family" => $products[$i]['AF'],
								":images_delta" => $products[$i]['AB'],
							));

						// error_log("\n ".$products[$i]['AG']."skiping records---",3,'C:/laragon/www/git/diam_prince/diamantsecret/test.log');
						if(!empty($products[$i]['AG'])){

							$cols = explode(',', $products[$i]['AG']);
							$col_alais = $col_name ='';
							$col_val  = '';
							if(!empty($cols)){
								foreach ($cols as $col) {
									if($col!=""){
										$col_name .= "site_".$col.', '; 
										//$col_alais .= ":site_".$col.', ';
										$col_val .="site_".$col.'=1, ';
									}
								}
							}

							$update_item = $pdo->prepare('UPDATE items SET site_0 = 0, site_1 = 0, site_2 = 0, site_3 = 0, site_4 = 0, site_5 = 0, site_6 = 0, site_7 = 0 WHERE unique_key = "'.$uniqueKey.'"');
							$update_item->execute();
							//echo 'UPDATE items SET '.rtrim($col_val,',').'  WHERE unique_key = "'.$uniqueKey.'"';die;
							$update_item1 = $pdo->prepare('UPDATE items SET '.rtrim($col_val,', ').'  WHERE unique_key = "'.$uniqueKey.'"');

							$update_item1->execute();

						}
						// else{

						// 	$update_item = $pdo->prepare('UPDATE items SET site_0 = 1, site_1 = 1, site_2 = 1, site_3 = 1, site_4 = 1, site_5 = 1, site_6 = 1, site_7 = 1 WHERE unique_key = "'.$uniqueKey.'"');
						// 	$update_item->execute();
						// }
						
					
					switch ($products[$i]['B']) {
						case 1: {
							$addInfo = $pdo->prepare("INSERT INTO `rings` 
								(`unique_key`, `company_id`, `internal_id`, `product_name`, `pieces_in_stock`, `days_for_shipment`, `total_carat_weight`, `no_of_stones`, `diamond_shape`, `clarity`, `color`, `diamond_color`, `material`, `height`, `width`, `length`, `country_id`, `images`, `description`, `description_french`, `total_gold_weight`, `color_stone_carat`, `no_of_color_stones`, `color_stone_shape`, `lab_grown`, `ring_subcategory`, `ring_size`, `gold_quality`, `color_stone_type`) 
								VALUES 
								(:unique_key, :company_id, :internal_id, :product_name, :pieces_in_stock, :days_for_shipment, :total_carat_weight, :no_of_stones, :diamond_shape, :clarity, :color, :diamond_color, :material, :height, :width, :length, :country_id, :images, :description, :description_french, :total_gold_weight, :color_stone_carat, :no_of_color_stones, :color_stone_shape, :lab_grown, :ring_subcategory, :ring_size, :gold_quality, :color_stone_type)");
							$addInfo->execute(array(
								":unique_key" => $uniqueKey,
								":company_id" => $company_id,
								":internal_id" => $products[$i]['C'],
								":product_name" => $products[$i]['D'],
								":pieces_in_stock" => $products[$i]['G'],
								":days_for_shipment" => $products[$i]['H'],
								":total_gold_weight" => $products[$i]['I'],
								":total_carat_weight" => $products[$i]['J'],
								":color_stone_carat" => $products[$i]['K'],
								":no_of_stones" => $products[$i]['L'],
								":no_of_color_stones" => $products[$i]['M'],
								":diamond_shape" => $products[$i]['N'],
								":color_stone_shape" => $products[$i]['O'],
								":clarity" => $products[$i]['P'],
								":color" => $products[$i]['Q'],
								":material" => $products[$i]['R'],
								":gold_quality" => $products[$i]['S'],
								":color_stone_type" => $products[$i]['T'],
								":height" => $products[$i]['U'],
								":width" => $products[$i]['V'],
								":length" => $products[$i]['W'],
								":ring_size" => $products[$i]['X'],
								":country_id" => $products[$i]['Y'],
								":ring_subcategory" => $products[$i]['Z'],
								":lab_grown" => $products[$i]['AA'],
								":images" => "",
								":description" => $products[$i]['AC'],
								":description_french" => $products[$i]['AD'],
								":diamond_color" => $products[$i]['AE']
							));


							$getitemID = $pdo->prepare("SELECT `id` FROM `rings` WHERE `unique_key` = :unique_key");
							$getitemID->execute(array(":unique_key" => $uniqueKey));
							$itemID = $getitemID->fetch(PDO::FETCH_ASSOC);
							$itemID = $itemID['id'];

							break;
						} case 2: {
							$addInfo = $pdo->prepare("INSERT INTO `earrings` 
								(`unique_key`, `company_id`, `internal_id`, `product_name`, `pieces_in_stock`, `days_for_shipment`, `total_carat_weight`, `no_of_stones`, `diamond_shape`, `clarity`, `color`, `diamond_color`, `material`, `height`, `width`, `length`, `country_id`, `images`, `description`, `description_french`, `total_gold_weight`, `color_stone_carat`, `no_of_color_stones`, `color_stone_shape`, `lab_grown`, `ring_subcategory`, `ring_size`, `gold_quality`, `color_stone_type`) 
								VALUES 
								(:unique_key, :company_id, :internal_id, :product_name, :pieces_in_stock, :days_for_shipment, :total_carat_weight, :no_of_stones, :diamond_shape, :clarity, :color, :diamond_color, :material, :height, :width, :length, :country_id, :images, :description, :description_french, :total_gold_weight, :color_stone_carat, :no_of_color_stones, :color_stone_shape, :lab_grown, :ring_subcategory, :ring_size, :gold_quality, :color_stone_type)");
							$addInfo->execute(array(
								":unique_key" => $uniqueKey,
								":company_id" => $company_id,
								":internal_id" => $products[$i]['C'],
								":product_name" => $products[$i]['D'],
								":pieces_in_stock" => $products[$i]['G'],
								":days_for_shipment" => $products[$i]['H'],
								":total_gold_weight" => $products[$i]['I'],
								":total_carat_weight" => $products[$i]['J'],
								":color_stone_carat" => $products[$i]['K'],
								":no_of_stones" => $products[$i]['L'],
								":no_of_color_stones" => $products[$i]['M'],
								":diamond_shape" => $products[$i]['N'],
								":color_stone_shape" => $products[$i]['O'],
								":clarity" => $products[$i]['P'],
								":color" => $products[$i]['Q'],
								":material" => $products[$i]['R'],
								":gold_quality" => $products[$i]['S'],
								":color_stone_type" => $products[$i]['T'],
								":height" => $products[$i]['U'],
								":width" => $products[$i]['V'],
								":length" => $products[$i]['W'],
								":ring_size" => $products[$i]['X'],
								":country_id" => $products[$i]['Y'],
								":ring_subcategory" => $products[$i]['Z'],
								":lab_grown" => $products[$i]['AA'],
								":images" => "",
								":description" => $products[$i]['AC'],
								":description_french" => $products[$i]['AD'],
								":diamond_color" => $products[$i]['AE']
							));

							
							$getitemID = $pdo->prepare("SELECT `id` FROM `earrings` WHERE `unique_key` = :unique_key");
							$getitemID->execute(array(":unique_key" => $uniqueKey));
							$itemID = $getitemID->fetch(PDO::FETCH_ASSOC);
							$itemID = $itemID['id'];

							break;
						} case 3: {
							$addInfo = $pdo->prepare("INSERT INTO `pendants` 
								(`unique_key`, `company_id`, `internal_id`, `product_name`, `pieces_in_stock`, `days_for_shipment`, `total_carat_weight`, `no_of_stones`, `diamond_shape`, `clarity`, `color`, `diamond_color`, `material`, `height`, `width`, `length`, `country_id`, `images`, `description`, `description_french`, `total_gold_weight`, `color_stone_carat`, `no_of_color_stones`, `color_stone_shape`, `lab_grown`, `ring_subcategory`, `ring_size`, `gold_quality`, `color_stone_type`) 
								VALUES 
								(:unique_key, :company_id, :internal_id, :product_name, :pieces_in_stock, :days_for_shipment, :total_carat_weight, :no_of_stones, :diamond_shape, :clarity, :color, :diamond_color, :material, :height, :width, :length, :country_id, :images, :description, :description_french, :total_gold_weight, :color_stone_carat, :no_of_color_stones, :color_stone_shape, :lab_grown, :ring_subcategory, :ring_size, :gold_quality, :color_stone_type)");
							$addInfo->execute(array(
								":unique_key" => $uniqueKey,
								":company_id" => $company_id,
								":internal_id" => $products[$i]['C'],
								":product_name" => $products[$i]['D'],
								":pieces_in_stock" => $products[$i]['G'],
								":days_for_shipment" => $products[$i]['H'],
								":total_gold_weight" => $products[$i]['I'],
								":total_carat_weight" => $products[$i]['J'],
								":color_stone_carat" => $products[$i]['K'],
								":no_of_stones" => $products[$i]['L'],
								":no_of_color_stones" => $products[$i]['M'],
								":diamond_shape" => $products[$i]['N'],
								":color_stone_shape" => $products[$i]['O'],
								":clarity" => $products[$i]['P'],
								":color" => $products[$i]['Q'],
								":material" => $products[$i]['R'],
								":gold_quality" => $products[$i]['S'],
								":color_stone_type" => $products[$i]['T'],
								":height" => $products[$i]['U'],
								":width" => $products[$i]['V'],
								":length" => $products[$i]['W'],
								":ring_size" => $products[$i]['X'],
								":country_id" => $products[$i]['Y'],
								":ring_subcategory" => $products[$i]['Z'],
								":lab_grown" => $products[$i]['AA'],
								":images" => "",
								":description" => $products[$i]['AC'],
								":description_french" => $products[$i]['AD'],
								":diamond_color" => $products[$i]['AE']
							));

							
							$getitemID = $pdo->prepare("SELECT `id` FROM `pendants` WHERE `unique_key` = :unique_key");
							$getitemID->execute(array(":unique_key" => $uniqueKey));
							$itemID = $getitemID->fetch(PDO::FETCH_ASSOC);
							$itemID = $itemID['id'];

							break;
						} case 4: {
							$addInfo = $pdo->prepare("INSERT INTO `necklaces` 
								(`unique_key`, `company_id`, `internal_id`, `product_name`, `pieces_in_stock`, `days_for_shipment`, `total_carat_weight`, `no_of_stones`, `diamond_shape`, `clarity`, `color`, `diamond_color`, `material`, `height`, `width`, `length`, `country_id`, `images`, `description`, `description_french`, `total_gold_weight`, `color_stone_carat`, `no_of_color_stones`, `color_stone_shape`, `lab_grown`, `ring_subcategory`, `ring_size`, `gold_quality`, `color_stone_type`) 
								VALUES 
								(:unique_key, :company_id, :internal_id, :product_name, :pieces_in_stock, :days_for_shipment, :total_carat_weight, :no_of_stones, :diamond_shape, :clarity, :color, :diamond_color, :material, :height, :width, :length, :country_id, :images, :description, :description_french, :total_gold_weight, :color_stone_carat, :no_of_color_stones, :color_stone_shape, :lab_grown, :ring_subcategory, :ring_size, :gold_quality, :color_stone_type)");
							$addInfo->execute(array(
								":unique_key" => $uniqueKey,
								":company_id" => $company_id,
								":internal_id" => $products[$i]['C'],
								":product_name" => $products[$i]['D'],
								":pieces_in_stock" => $products[$i]['G'],
								":days_for_shipment" => $products[$i]['H'],
								":total_gold_weight" => $products[$i]['I'],
								":total_carat_weight" => $products[$i]['J'],
								":color_stone_carat" => $products[$i]['K'],
								":no_of_stones" => $products[$i]['L'],
								":no_of_color_stones" => $products[$i]['M'],
								":diamond_shape" => $products[$i]['N'],
								":color_stone_shape" => $products[$i]['O'],
								":clarity" => $products[$i]['P'],
								":color" => $products[$i]['Q'],
								":material" => $products[$i]['R'],
								":gold_quality" => $products[$i]['S'],
								":color_stone_type" => $products[$i]['T'],
								":height" => $products[$i]['U'],
								":width" => $products[$i]['V'],
								":length" => $products[$i]['W'],
								":ring_size" => $products[$i]['X'],
								":country_id" => $products[$i]['Y'],
								":ring_subcategory" => $products[$i]['Z'],
								":lab_grown" => $products[$i]['AA'],
								":images" => "",
								":description" => $products[$i]['AC'],
								":description_french" => $products[$i]['AD'],
								":diamond_color" => $products[$i]['AE']
							));

							
							$getitemID = $pdo->prepare("SELECT `id` FROM `necklaces` WHERE `unique_key` = :unique_key");
							$getitemID->execute(array(":unique_key" => $uniqueKey));
							$itemID = $getitemID->fetch(PDO::FETCH_ASSOC);
							$itemID = $itemID['id'];

							break;
						} case 5: {
							$addInfo = $pdo->prepare("INSERT INTO `bracelets` 
								(`unique_key`, `company_id`, `internal_id`, `product_name`, `pieces_in_stock`, `days_for_shipment`, `total_carat_weight`, `no_of_stones`, `diamond_shape`, `clarity`, `color`, `diamond_color`, `material`, `height`, `width`, `length`, `country_id`, `images`, `description`, `description_french`, `total_gold_weight`, `color_stone_carat`, `no_of_color_stones`, `color_stone_shape`, `lab_grown`, `ring_subcategory`, `ring_size`, `gold_quality`, `color_stone_type`) 
								VALUES 
								(:unique_key, :company_id, :internal_id, :product_name, :pieces_in_stock, :days_for_shipment, :total_carat_weight, :no_of_stones, :diamond_shape, :clarity, :color, :diamond_color, :material, :height, :width, :length, :country_id, :images, :description, :description_french, :total_gold_weight, :color_stone_carat, :no_of_color_stones, :color_stone_shape, :lab_grown, :ring_subcategory, :ring_size, :gold_quality, :color_stone_type)");
							$addInfo->execute(array(
								":unique_key" => $uniqueKey,
								":company_id" => $company_id,
								":internal_id" => $products[$i]['C'],
								":product_name" => $products[$i]['D'],
								":pieces_in_stock" => $products[$i]['G'],
								":days_for_shipment" => $products[$i]['H'],
								":total_gold_weight" => $products[$i]['I'],
								":total_carat_weight" => $products[$i]['J'],
								":color_stone_carat" => $products[$i]['K'],
								":no_of_stones" => $products[$i]['L'],
								":no_of_color_stones" => $products[$i]['M'],
								":diamond_shape" => $products[$i]['N'],
								":color_stone_shape" => $products[$i]['O'],
								":clarity" => $products[$i]['P'],
								":color" => $products[$i]['Q'],
								":material" => $products[$i]['R'],
								":gold_quality" => $products[$i]['S'],
								":color_stone_type" => $products[$i]['T'],
								":height" => $products[$i]['U'],
								":width" => $products[$i]['V'],
								":length" => $products[$i]['W'],
								":ring_size" => $products[$i]['X'],
								":country_id" => $products[$i]['Y'],
								":ring_subcategory" => $products[$i]['Z'],
								":lab_grown" => $products[$i]['AA'],
								":images" => "",
								":description" => $products[$i]['AC'],
								":description_french" => $products[$i]['AD'],
								":diamond_color" => $products[$i]['AE']
							));

							
							$getitemID = $pdo->prepare("SELECT `id` FROM `bracelets` WHERE `unique_key` = :unique_key");
							$getitemID->execute(array(":unique_key" => $uniqueKey));
							$itemID = $getitemID->fetch(PDO::FETCH_ASSOC);
							$itemID = $itemID['id'];

							break;
						} 
					}

					switch ($products[$i]['B']) {
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
							$result = [];
							$resultColor = 'success';
							if ( $intError !== 'None' ) {
								$resultColor = 'warning';
							}
							array_push($result, $resultColor);
							array_push($result, $products[$i]['D']);
							array_push($result, "Invalid Entry");
							array_push($result, $i);
							echo json_encode($result);
							return;
						}
					}

					$intError = "";
					$images = "";
					$imageArray = explode(",", 	trim($products[$i]['AB'], "\"") );

					if ( !empty($products[$i]['Z']) ) {
						for ( $j = 0; $j < sizeof($imageArray); $j++ ) {
							$url = $__MAINDOMAIN__ . 'working/zip/import/'. $_GET['timeToken'] .'/images/' . trim($imageArray[$j]);

							$ext = explode(".", $url);
							$ext =  '.' . $ext[sizeof($ext)-1];
							$count = 0;
							$img = '../../images/images/'. $imgName . '_' . $itemID .'_' . $count . $ext;
							$img_md = '../../images/images_md/'. $imgName . '_' . $itemID .'_' . $count . $ext;
							$img_sm = '../../images/images_sm/'. $imgName . '_' . $itemID .'_' . $count . $ext;
							while ( file_exists($img) ) {
								$count++;
								$img = '../../images/images/'. $imgName . '_' . $itemID .'_' . $count . $ext;
								$img_md = '../../images/images_md/'. $imgName . '_' . $itemID .'_' . $count . $ext;
								$img_sm = '../../images/images_sm/'. $imgName . '_' . $itemID .'_' . $count . $ext;
							}

							$image_dir = "../../images/";

							if ( !is_dir($image_dir . 'images/') ) {
								mkdir($image_dir . 'images/');
							}
							if ( !is_dir($image_dir . 'images_md/') ) {
								mkdir($image_dir . 'images_md/');
							}
							if ( !is_dir($image_dir . 'images_sm/') ) {
								mkdir($image_dir . 'images_sm/');
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
									$intError .= 'Invalid Image: ' . pathinfo($url, PATHINFO_BASENAME) . '<br>';
								} else {
									try {
										file_put_contents($img, $inputImg);
										create_thumb($img, $__IMPORT_IMAGE_RES__['LARGE'], $__IMPORT_IMAGE_RES__['LARGE'], $img);
										create_thumb($img, $__IMPORT_IMAGE_RES__['MED'], $__IMPORT_IMAGE_RES__['MED'], $img_md);
										create_thumb($img, $__IMPORT_IMAGE_RES__['SMALL'], $__IMPORT_IMAGE_RES__['SMALL'], $img_sm);
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
						}
					} else {
						$intError .= "No Image Found";
					}

					switch ($products[$i]['B']) {
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
					//$result .= "<tr><td>Added New Entry: " . $products[$i]['D'] . "</td><td>" . $intError .  "</td></tr>";

					unset($PHPExcel);

					$result = [];
					$resultColor = 'success';
					if ( $intError !== 'None' ) {
						$resultColor = 'warning';
					}
					array_push($result, $resultColor);
					array_push($result, $products[$i]['D']);
					array_push($result, $intError);
					array_push($result, $i);
					echo json_encode($result);

			} else {
				echo '<h4>Import Failed</h4><br>'. $error . "<br>Please Fix The Errors and Try to Import Again <br><br><br> Alternatively, you can download the format here: <button class='btn btn-custom' onclick='downloadFormat()'> Download Format </button><br><br><button class='btn btn-danger' onclick='window.location = \"./import_excel.php\";'>Reloag Page</button>";
			}
		

		}
		
		unset($PHPExcel);

	


	} else {
		echo "Error: File ". $_SESSION['tmp_file'] ." Invalid";
	}

} else if ( isset($_GET['exportSelected']) ) {

	$file = '../../working/excel/export/DiamantSecret '. date("d-M-y");
	$ext = '.xlsx';

	$count = 1;
	while ( file_exists($file . $ext) ) {
		$file = '../../working/excel/export/DiamantSecret '. date("d-M-y") . '_' . $count;
		$count++;
	}

	$outputExcel = new PHPExcel();

	$outputExcel->setActiveSheetIndex(0);
	$outputExcel->getActiveSheet()->setTitle('products');

	$outputExcel->getActiveSheet()->getStyle('A1:AE1')->getFont()->setBold(true);
	$outputExcel->getActiveSheet()->setCellValue('A1', "Company Id" );
	$outputExcel->getActiveSheet()->setCellValue('B1', "Category Id" );
	$outputExcel->getActiveSheet()->setCellValue('C1', "Internal Id" );
	$outputExcel->getActiveSheet()->setCellValue('D1', "Product Name");
	$outputExcel->getActiveSheet()->setCellValue('E1', "Amount" );
	$outputExcel->getActiveSheet()->setCellValue('F1', "Discount Percent" );
	$outputExcel->getActiveSheet()->setCellValue('G1', "Pieces in stock" );
	$outputExcel->getActiveSheet()->setCellValue('H1', "Days for shipment" );
	$outputExcel->getActiveSheet()->setCellValue('I1', "Total gold weight" );
	$outputExcel->getActiveSheet()->setCellValue('J1', "Total carat weight" );
	$outputExcel->getActiveSheet()->setCellValue('K1', "Color stone carat" );
	$outputExcel->getActiveSheet()->setCellValue('L1', "No. of stones" );
	$outputExcel->getActiveSheet()->setCellValue('M1', "No. of colour stone" );
	$outputExcel->getActiveSheet()->setCellValue('N1', "Diamond Shape" );
	$outputExcel->getActiveSheet()->setCellValue('O1', "Color stone shape" );
	$outputExcel->getActiveSheet()->setCellValue('P1', "Clarity" );
	$outputExcel->getActiveSheet()->setCellValue('Q1', "Color" );
	$outputExcel->getActiveSheet()->setCellValue('R1', "Material" );
	$outputExcel->getActiveSheet()->setCellValue('S1', "Gold Quality" );
	$outputExcel->getActiveSheet()->setCellValue('T1', "Color Stone Type" );
	$outputExcel->getActiveSheet()->setCellValue('U1', "Height" );
	$outputExcel->getActiveSheet()->setCellValue('V1', "Width" );
	$outputExcel->getActiveSheet()->setCellValue('W1', "Length" );
	$outputExcel->getActiveSheet()->setCellValue('X1', "Ring size" );
	$outputExcel->getActiveSheet()->setCellValue('Y1', "Country Id" );
	$outputExcel->getActiveSheet()->setCellValue('Z1', "Subcategory" );
	$outputExcel->getActiveSheet()->setCellValue('AA1', "Lab Grown Diamond" );
	$outputExcel->getActiveSheet()->setCellValue('AB1', "Images (comma \",\" separated)" );
	$outputExcel->getActiveSheet()->setCellValue('AC1', "Description" ) ;
	$outputExcel->getActiveSheet()->setCellValue('AD1', "Description (French)");
	$outputExcel->getActiveSheet()->setCellValue('AE1', "Diamond Color");

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
			} default: {
				echo '<div class="alert alert-error">Fatal Error: Invalid Category '. $item['category'].' for item <strong>'. $item['item_name'] .'</strong></div>';
				return;
			}
		}
		$itemInfo->execute(array(":uniqueKey" => $item['unique_key']));

		$itemInfo = $itemInfo->fetch(PDO::FETCH_ASSOC);

		/*if ( !isset($itemInfo['ring_subcategory']) ) {
			$itemInfo['ring_subcategory'] = $itemInfo['ring_size'] = "ITEM_NOT_RING";
		}*/

		$numImg = "";

		$imgArray = explode(",", $itemInfo['images']);

		foreach ( $imgArray as $img ) {
			if ( !empty($img) ) {
				$numImg .= $__MAINDOMAIN__ . "images/images/" . $img . ",";
			}
		}


		$outputExcel->getActiveSheet()->setCellValue('A' . $row, getCompanyCode($itemInfo['company_id'], $pdo) );
		$outputExcel->getActiveSheet()->setCellValue('B' . $row, $item['category'] );
		$outputExcel->getActiveSheet()->setCellValue('C' . $row, $itemInfo['internal_id'] );
		$outputExcel->getActiveSheet()->setCellValue('D' . $row, $itemInfo['product_name']);
		$outputExcel->getActiveSheet()->setCellValue('E' . $row, $item['item_value'] );
		$outputExcel->getActiveSheet()->setCellValue('F' . $row, $item['discount'] );
		$outputExcel->getActiveSheet()->setCellValue('G' . $row, $itemInfo['pieces_in_stock'] );
		$outputExcel->getActiveSheet()->setCellValue('H' . $row, $itemInfo['days_for_shipment'] );
		$outputExcel->getActiveSheet()->setCellValue('I' . $row, $itemInfo['total_gold_weight'] );
		$outputExcel->getActiveSheet()->setCellValue('J' . $row, $itemInfo['total_carat_weight'] );
		$outputExcel->getActiveSheet()->setCellValue('K' . $row, $itemInfo['color_stone_carat'] );
		$outputExcel->getActiveSheet()->setCellValue('L' . $row, $itemInfo['no_of_stones'] );
		$outputExcel->getActiveSheet()->setCellValue('M' . $row, $itemInfo['no_of_color_stones'] );
		$outputExcel->getActiveSheet()->setCellValue('N' . $row, $itemInfo['diamond_shape'] );
		$outputExcel->getActiveSheet()->setCellValue('O' . $row, $itemInfo['color_stone_shape'] );
		$outputExcel->getActiveSheet()->setCellValue('P' . $row, $itemInfo['clarity'] );
		$outputExcel->getActiveSheet()->setCellValue('Q' . $row, $itemInfo['color'] );
		$outputExcel->getActiveSheet()->setCellValue('R' . $row, $itemInfo['material'] );
		$outputExcel->getActiveSheet()->setCellValue('S' . $row, $itemInfo['gold_quality']);
		$outputExcel->getActiveSheet()->setCellValue('T' . $row, $itemInfo['color_stone_type']);
		$outputExcel->getActiveSheet()->setCellValue('U' . $row, $itemInfo['height'] );
		$outputExcel->getActiveSheet()->setCellValue('V' . $row, $itemInfo['width'] );
		$outputExcel->getActiveSheet()->setCellValue('W' . $row, $itemInfo['length'] );
		$outputExcel->getActiveSheet()->setCellValue('X' . $row, $itemInfo['ring_size'] );
		$outputExcel->getActiveSheet()->setCellValue('Y' . $row, $itemInfo['country_id'] );
		$outputExcel->getActiveSheet()->setCellValue('Z' . $row, $itemInfo['ring_subcategory'] );
		$outputExcel->getActiveSheet()->setCellValue('AA' . $row, $itemInfo['lab_grown'] );
		$outputExcel->getActiveSheet()->setCellValue('AB' . $row, $numImg );
		$outputExcel->getActiveSheet()->setCellValue('AC' . $row, $itemInfo['description'] ) ;
		$outputExcel->getActiveSheet()->setCellValue('AD' . $row, $itemInfo['description_french']);
		$outputExcel->getActiveSheet()->setCellValue('AE' . $row, $itemInfo['diamond_color']);


		$row++;
	} 


	#Setting Rest Sheets.
	addMiscSheets($outputExcel, $pdo);
	$outputExcel->setActiveSheetIndex(0);


	header('Content-Type: application/vnd.ms-excel'); 
	header('Content-Disposition: attachment;filename="results.xlsx"'); 
	header('Cache-Control: max-age=0'); 
	$outputExcel = PHPExcel_IOFactory::createWriter($outputExcel, 'Excel2007'); 
	$outputExcel->save($file . $ext);

	echo json_encode(array('<h4><div class="alert alert-success">Export Successful</div></h4><br><br><p>Backup Created: ' . basename($file . $ext) . '<br><br><a class="btn btn-custom" href="'. $file . $ext .'">Download</a>', $file.$ext));

} else if ( isset($_GET['exportSelectedZip']) ) {

	$file = '../../working/excel/export/DiamantSecret '. date("d-M-y");
	$ext = '.xlsx';

	$count = 1;
	while ( file_exists($file . $ext) ) {
		$file = '../../working/excel/export/DiamantSecret '. date("d-M-y") . '_' . $count;
		$count++;
	}

	$outputExcel = new PHPExcel();

	$outputExcel->setActiveSheetIndex(0);
	$outputExcel->getActiveSheet()->setTitle('products');

	$outputExcel->getActiveSheet()->getStyle('A1:AE1')->getFont()->setBold(true);
	$outputExcel->getActiveSheet()->setCellValue('A1', "Company Id" );
	$outputExcel->getActiveSheet()->setCellValue('B1', "Category Id" );
	$outputExcel->getActiveSheet()->setCellValue('C1', "Internal Id" );
	$outputExcel->getActiveSheet()->setCellValue('D1', "Product Name");
	$outputExcel->getActiveSheet()->setCellValue('E1', "Amount" );
	$outputExcel->getActiveSheet()->setCellValue('F1', "Discount Percent" );
	$outputExcel->getActiveSheet()->setCellValue('G1', "Pieces in stock" );
	$outputExcel->getActiveSheet()->setCellValue('H1', "Days for shipment" );
	$outputExcel->getActiveSheet()->setCellValue('I1', "Total gold weight" );
	$outputExcel->getActiveSheet()->setCellValue('J1', "Total carat weight" );
	$outputExcel->getActiveSheet()->setCellValue('K1', "Color stone carat" );
	$outputExcel->getActiveSheet()->setCellValue('L1', "No. of stones" );
	$outputExcel->getActiveSheet()->setCellValue('M1', "No. of colour stone" );
	$outputExcel->getActiveSheet()->setCellValue('N1', "Diamond Shape" );
	$outputExcel->getActiveSheet()->setCellValue('O1', "Color stone shape" );
	$outputExcel->getActiveSheet()->setCellValue('P1', "Clarity" );
	$outputExcel->getActiveSheet()->setCellValue('Q1', "Color" );
	$outputExcel->getActiveSheet()->setCellValue('R1', "Material" );
	$outputExcel->getActiveSheet()->setCellValue('S1', "Gold Quality" );
	$outputExcel->getActiveSheet()->setCellValue('T1', "Color Stone Type" );
	$outputExcel->getActiveSheet()->setCellValue('U1', "Height" );
	$outputExcel->getActiveSheet()->setCellValue('V1', "Width" );
	$outputExcel->getActiveSheet()->setCellValue('W1', "Length" );
	$outputExcel->getActiveSheet()->setCellValue('X1', "Ring size" );
	$outputExcel->getActiveSheet()->setCellValue('Y1', "Country Id" );
	$outputExcel->getActiveSheet()->setCellValue('Z1', "Subcategory" );
	$outputExcel->getActiveSheet()->setCellValue('AA1', "Lab Grown Diamond" );
	$outputExcel->getActiveSheet()->setCellValue('AB1', "Images (comma \",\" separated)" );
	$outputExcel->getActiveSheet()->setCellValue('AC1', "Description" ) ;
	$outputExcel->getActiveSheet()->setCellValue('AD1', "Description (French)");
	$outputExcel->getActiveSheet()->setCellValue('AE1', "Diamond Color");

	#$outputExcel->getActiveSheet()->getStyle('V1:V'.$outputExcel->getActiveSheet()->getHighestRow())->getAlignment()->setWrapText(true);
	#$outputExcel->getActiveSheet()->getStyle('U1:U'.$outputExcel->getActiveSheet()->getHighestRow())->getAlignment()->setWrapText(true);

	$getItems = $pdo->prepare("SELECT * FROM `items`");
	$getItems->execute();

	$allItems = $getItems->fetchAll();

	$array = [];

	if ( !empty($_GET['exportSelectedZip']) ) {
		foreach ( $allItems as $selected ) {
			if ( strpos($_GET['exportSelectedZip'], $selected['unique_key']) === false ) {
				
			} else {
				array_push($array, $selected);
			}
		}
	} else {
		$array = $allItems;
	}

	
	$zipPath = '../../working/zip/archives/export/DiamantSecret_' . date("d-M-y") .".zip";
	
	$count = 1;
	while ( file_exists($zipPath) ) {
		$zipPath = '../../working/zip/archives/export/DiamantSecret_' . date("d-M-y") . "_" . $count .".zip";
		$count++;
	}

	$zipExport = new ZipArchive();
	$zipExport->open($zipPath, ZipArchive::CREATE || ZipArchive::OVERWRITE);
	$zipExport->addEmptyDir('images');

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
			} default: {
				echo '<div class="alert alert-error">Fatal Error: Invalid Category '. $item['category'].' for item <strong>'. $item['item_name'] .'</strong></div>';
				return;
			}
		}
		$itemInfo->execute(array(":uniqueKey" => $item['unique_key']));

		if ( $itemInfo->rowCount() > 0 ) {

			$itemInfo = $itemInfo->fetch(PDO::FETCH_ASSOC);

			#Disabling ITEM_NOT_RING transform for better import export compatibility
			/*if ( !isset($itemInfo['ring_subcategory']) ) {
				$itemInfo['ring_subcategory'] = $itemInfo['ring_size'] = "ITEM_NOT_RING";
			}*/

			//echo $itemInfo['id'];

			$numImg = "";

			$imgArray = explode(",", $itemInfo['images']);

			foreach ( $imgArray as $img ) {
				if ( !empty($img) ) {
					$zipExport->addFile('../../images/images/' . $img , "images/" . $img);
				}
			}

			$outputExcel->getActiveSheet()->setCellValue('A' . $row, getCompanyCode($itemInfo['company_id'], $pdo) );
		$outputExcel->getActiveSheet()->setCellValue('B' . $row, $item['category'] );
		$outputExcel->getActiveSheet()->setCellValue('C' . $row, $itemInfo['internal_id'] );
		$outputExcel->getActiveSheet()->setCellValue('D' . $row, $itemInfo['product_name']);
		$outputExcel->getActiveSheet()->setCellValue('E' . $row, $item['item_value'] );
		$outputExcel->getActiveSheet()->setCellValue('F' . $row, $item['discount'] );
		$outputExcel->getActiveSheet()->setCellValue('G' . $row, $itemInfo['pieces_in_stock'] );
		$outputExcel->getActiveSheet()->setCellValue('H' . $row, $itemInfo['days_for_shipment'] );
		$outputExcel->getActiveSheet()->setCellValue('I' . $row, $itemInfo['total_gold_weight'] );
		$outputExcel->getActiveSheet()->setCellValue('J' . $row, $itemInfo['total_carat_weight'] );
		$outputExcel->getActiveSheet()->setCellValue('K' . $row, $itemInfo['color_stone_carat'] );
		$outputExcel->getActiveSheet()->setCellValue('L' . $row, $itemInfo['no_of_stones'] );
		$outputExcel->getActiveSheet()->setCellValue('M' . $row, $itemInfo['no_of_color_stones'] );
		$outputExcel->getActiveSheet()->setCellValue('N' . $row, $itemInfo['diamond_shape'] );
		$outputExcel->getActiveSheet()->setCellValue('O' . $row, $itemInfo['color_stone_shape'] );
		$outputExcel->getActiveSheet()->setCellValue('P' . $row, $itemInfo['clarity'] );
		$outputExcel->getActiveSheet()->setCellValue('Q' . $row, $itemInfo['color'] );
		$outputExcel->getActiveSheet()->setCellValue('R' . $row, $itemInfo['material'] );
		$outputExcel->getActiveSheet()->setCellValue('S' . $row, $itemInfo['gold_quality']);
		$outputExcel->getActiveSheet()->setCellValue('T' . $row, $itemInfo['color_stone_type']);
		$outputExcel->getActiveSheet()->setCellValue('U' . $row, $itemInfo['height'] );
		$outputExcel->getActiveSheet()->setCellValue('V' . $row, $itemInfo['width'] );
		$outputExcel->getActiveSheet()->setCellValue('W' . $row, $itemInfo['length'] );
		$outputExcel->getActiveSheet()->setCellValue('X' . $row, $itemInfo['ring_size'] );
		$outputExcel->getActiveSheet()->setCellValue('Y' . $row, $itemInfo['country_id'] );
		$outputExcel->getActiveSheet()->setCellValue('Z' . $row, $itemInfo['ring_subcategory'] );
		$outputExcel->getActiveSheet()->setCellValue('AA' . $row, $itemInfo['lab_grown'] );
		$outputExcel->getActiveSheet()->setCellValue('AB' . $row, trim($itemInfo['images'], ",") );
		$outputExcel->getActiveSheet()->setCellValue('AC' . $row, $itemInfo['description'] ) ;
		$outputExcel->getActiveSheet()->setCellValue('AD' . $row, $itemInfo['description_french']);
		$outputExcel->getActiveSheet()->setCellValue('AE' . $row, $itemInfo['diamond_color']);


			$row++;
		}
	} 


	#Setting Rest Sheets.
	addMiscSheets($outputExcel, $pdo);
	$outputExcel->setActiveSheetIndex(0);


	header('Content-Type: application/vnd.ms-excel'); 
	header('Content-Disposition: attachment;filename="results.xlsx"'); 
	header('Cache-Control: max-age=0'); 
	$outputExcel = PHPExcel_IOFactory::createWriter($outputExcel, 'Excel2007'); 
	$outputExcel->save($file . $ext);

	$zipExport->addFile($file . $ext, "products.xlsx");
	$zipExport->close();


	echo json_encode(array('<h4><div class="alert alert-success">Export Successful</div></h4><br><br><p>Backup Created: ' . basename($zipPath) . '<br><br><a class="btn btn-custom" href="'. $zipPath .'">Download</a>', $file.$ext));

} else if ( isset($_GET['exportAll']) ) {

	$file = '../../working/excel/export/DiamantSecret '. date("d-M-y");
	$ext = '.xlsx';

	$count = 1;
	while ( file_exists($file . $ext) ) {
		$file = '../../working/excel/export/DiamantSecret '. date("d-M-y") . '_' . $count;
		$count++;
	}

	$outputExcel = new PHPExcel();

	$outputExcel->setActiveSheetIndex(0);
	$outputExcel->getActiveSheet()->setTitle('products');

	$outputExcel->getActiveSheet()->getStyle('A1:AE1')->getFont()->setBold(true);
	$outputExcel->getActiveSheet()->setCellValue('A1', "Company Id" );
	$outputExcel->getActiveSheet()->setCellValue('B1', "Category Id" );
	$outputExcel->getActiveSheet()->setCellValue('C1', "Internal Id" );
	$outputExcel->getActiveSheet()->setCellValue('D1', "Product Name");
	$outputExcel->getActiveSheet()->setCellValue('E1', "Amount" );
	$outputExcel->getActiveSheet()->setCellValue('F1', "Discount Percent" );
	$outputExcel->getActiveSheet()->setCellValue('G1', "Pieces in stock" );
	$outputExcel->getActiveSheet()->setCellValue('H1', "Days for shipment" );
	$outputExcel->getActiveSheet()->setCellValue('I1', "Total gold weight" );
	$outputExcel->getActiveSheet()->setCellValue('J1', "Total carat weight" );
	$outputExcel->getActiveSheet()->setCellValue('K1', "Color stone carat" );
	$outputExcel->getActiveSheet()->setCellValue('L1', "No. of stones" );
	$outputExcel->getActiveSheet()->setCellValue('M1', "No. of colour stone" );
	$outputExcel->getActiveSheet()->setCellValue('N1', "Diamond Shape" );
	$outputExcel->getActiveSheet()->setCellValue('O1', "Color stone shape" );
	$outputExcel->getActiveSheet()->setCellValue('P1', "Clarity" );
	$outputExcel->getActiveSheet()->setCellValue('Q1', "Color" );
	$outputExcel->getActiveSheet()->setCellValue('R1', "Material" );
	$outputExcel->getActiveSheet()->setCellValue('S1', "Gold Quality" );
	$outputExcel->getActiveSheet()->setCellValue('T1', "Color Stone Type" );
	$outputExcel->getActiveSheet()->setCellValue('U1', "Height" );
	$outputExcel->getActiveSheet()->setCellValue('V1', "Width" );
	$outputExcel->getActiveSheet()->setCellValue('W1', "Length" );
	$outputExcel->getActiveSheet()->setCellValue('X1', "Ring size" );
	$outputExcel->getActiveSheet()->setCellValue('Y1', "Country Id" );
	$outputExcel->getActiveSheet()->setCellValue('Z1', "Subcategory" );
	$outputExcel->getActiveSheet()->setCellValue('AA1', "Lab Grown Diamond" );
	$outputExcel->getActiveSheet()->setCellValue('AB1', "Images (comma \",\" separated)" );
	$outputExcel->getActiveSheet()->setCellValue('AC1', "Description" ) ;
	$outputExcel->getActiveSheet()->setCellValue('AD1', "Description (French)");
	$outputExcel->getActiveSheet()->setCellValue('AE1', "Diamond Color");

	#$outputExcel->getActiveSheet()->getStyle('V1:V'.$outputExcel->getActiveSheet()->getHighestRow())->getAlignment()->setWrapText(true);
	#$outputExcel->getActiveSheet()->getStyle('U1:U'.$outputExcel->getActiveSheet()->getHighestRow())->getAlignment()->setWrapText(true);

	switch ($_GET['exportAll']) {
		case 0: {
			$category = "";
			break;
		} case 1: {
			$category = " WHERE `category` = ". $_GET['exportAll'];
			break;
		} case 2: {
			$category = " WHERE `category` = ". $_GET['exportAll'];
			break;
		} case 3: {
			$category = " WHERE `category` = ". $_GET['exportAll'];
			break;
		} case 4: {
			$category = " WHERE `category` = ". $_GET['exportAll'];
			break;
		} case 5: {
			$category = " WHERE `category` = ". $_GET['exportAll'];
			break;
		} default: {
			$category = "";
			break;
		} 
	}

	$getItems = $pdo->prepare("SELECT * FROM `items`". $category);
	$getItems->execute();

	$allItems = $getItems->fetchAll();

	$array = $allItems;

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

		/*if ( !isset($itemInfo['ring_subcategory']) ) {
			$itemInfo['ring_subcategory'] = $itemInfo['ring_size'] = "ITEM_NOT_RING";
		}*/

		$numImg = "";

		$imgArray = explode(",", $itemInfo['images']);

		foreach ( $imgArray as $img ) {
			if ( !empty($img) ) {
				$numImg .=  $__MAINDOMAIN__ . "images/images/" . $img . ",";
			}
		}


		$outputExcel->getActiveSheet()->setCellValue('A' . $row, getCompanyCode($itemInfo['company_id'], $pdo) );
		$outputExcel->getActiveSheet()->setCellValue('B' . $row, $item['category'] );
		$outputExcel->getActiveSheet()->setCellValue('C' . $row, $itemInfo['internal_id'] );
		$outputExcel->getActiveSheet()->setCellValue('D' . $row, $itemInfo['product_name']);
		$outputExcel->getActiveSheet()->setCellValue('E' . $row, $item['item_value'] );
		$outputExcel->getActiveSheet()->setCellValue('F' . $row, $item['discount'] );
		$outputExcel->getActiveSheet()->setCellValue('G' . $row, $itemInfo['pieces_in_stock'] );
		$outputExcel->getActiveSheet()->setCellValue('H' . $row, $itemInfo['days_for_shipment'] );
		$outputExcel->getActiveSheet()->setCellValue('I' . $row, $itemInfo['total_gold_weight'] );
		$outputExcel->getActiveSheet()->setCellValue('J' . $row, $itemInfo['total_carat_weight'] );
		$outputExcel->getActiveSheet()->setCellValue('K' . $row, $itemInfo['color_stone_carat'] );
		$outputExcel->getActiveSheet()->setCellValue('L' . $row, $itemInfo['no_of_stones'] );
		$outputExcel->getActiveSheet()->setCellValue('M' . $row, $itemInfo['no_of_color_stones'] );
		$outputExcel->getActiveSheet()->setCellValue('N' . $row, $itemInfo['diamond_shape'] );
		$outputExcel->getActiveSheet()->setCellValue('O' . $row, $itemInfo['color_stone_shape'] );
		$outputExcel->getActiveSheet()->setCellValue('P' . $row, $itemInfo['clarity'] );
		$outputExcel->getActiveSheet()->setCellValue('Q' . $row, $itemInfo['color'] );
		$outputExcel->getActiveSheet()->setCellValue('R' . $row, $itemInfo['material'] );
		$outputExcel->getActiveSheet()->setCellValue('S' . $row, $itemInfo['gold_quality']);
		$outputExcel->getActiveSheet()->setCellValue('T' . $row, $itemInfo['color_stone_type']);
		$outputExcel->getActiveSheet()->setCellValue('U' . $row, $itemInfo['height'] );
		$outputExcel->getActiveSheet()->setCellValue('V' . $row, $itemInfo['width'] );
		$outputExcel->getActiveSheet()->setCellValue('W' . $row, $itemInfo['length'] );
		$outputExcel->getActiveSheet()->setCellValue('X' . $row, $itemInfo['ring_size'] );
		$outputExcel->getActiveSheet()->setCellValue('Y' . $row, $itemInfo['country_id'] );
		$outputExcel->getActiveSheet()->setCellValue('Z' . $row, $itemInfo['ring_subcategory'] );
		$outputExcel->getActiveSheet()->setCellValue('AA' . $row, $itemInfo['lab_grown'] );
		$outputExcel->getActiveSheet()->setCellValue('AB' . $row, $numImg );
		$outputExcel->getActiveSheet()->setCellValue('AC' . $row, $itemInfo['description'] ) ;
		$outputExcel->getActiveSheet()->setCellValue('AD' . $row, $itemInfo['description_french']);
		$outputExcel->getActiveSheet()->setCellValue('AE' . $row, $itemInfo['diamond_color']);


		$row++;
	} 


	#Setting Rest Sheets.
	addMiscSheets($outputExcel, $pdo);
	$outputExcel->setActiveSheetIndex(0);


	header('Content-Type: application/vnd.ms-excel'); 
	header('Content-Disposition: attachment;filename="results.xlsx"'); 
	header('Cache-Control: max-age=0'); 
	$outputExcel = PHPExcel_IOFactory::createWriter($outputExcel, 'Excel2007'); 
	$outputExcel->save($file . $ext);

	echo json_encode(array('<h4><div class="alert alert-success">Export Successful</div></h4><br><br><p>Backup Created: ' . basename($file . $ext) . '<br><br><a class="btn btn-custom" href="'. $file . $ext .'">Download</a>', $file.$ext));

} else if ( isset($_GET['exportAllZip']) ) {

	$file = '../../working/excel/export/DiamantSecret '. date("d-M-y");
	$ext = '.xlsx';

	$count = 1;
	while ( file_exists($file . $ext) ) {
		$file = '../../working/excel/export/DiamantSecret '. date("d-M-y") . '_' . $count;
		$count++;
	}

	$outputExcel = new PHPExcel();

	$outputExcel->setActiveSheetIndex(0);
	$outputExcel->getActiveSheet()->setTitle('products');

	#Adding Columns
	$outputExcel->getActiveSheet()->getStyle('A1:AE1')->getFont()->setBold(true);
	$outputExcel->getActiveSheet()->setCellValue('A1', "Company Id" );
	$outputExcel->getActiveSheet()->setCellValue('B1', "Category Id" );
	$outputExcel->getActiveSheet()->setCellValue('C1', "Internal Id" );
	$outputExcel->getActiveSheet()->setCellValue('D1', "Product Name");
	$outputExcel->getActiveSheet()->setCellValue('E1', "Amount" );
	$outputExcel->getActiveSheet()->setCellValue('F1', "Discount Percent" );
	$outputExcel->getActiveSheet()->setCellValue('G1', "Pieces in stock" );
	$outputExcel->getActiveSheet()->setCellValue('H1', "Days for shipment" );
	$outputExcel->getActiveSheet()->setCellValue('I1', "Total gold weight" );
	$outputExcel->getActiveSheet()->setCellValue('J1', "Total carat weight" );
	$outputExcel->getActiveSheet()->setCellValue('K1', "Color stone carat" );
	$outputExcel->getActiveSheet()->setCellValue('L1', "No. of stones" );
	$outputExcel->getActiveSheet()->setCellValue('M1', "No. of colour stone" );
	$outputExcel->getActiveSheet()->setCellValue('N1', "Diamond Shape" );
	$outputExcel->getActiveSheet()->setCellValue('O1', "Color stone shape" );
	$outputExcel->getActiveSheet()->setCellValue('P1', "Clarity" );
	$outputExcel->getActiveSheet()->setCellValue('Q1', "Color" );
	$outputExcel->getActiveSheet()->setCellValue('R1', "Material" );
	$outputExcel->getActiveSheet()->setCellValue('S1', "Gold Quality" );
	$outputExcel->getActiveSheet()->setCellValue('T1', "Color Stone Type" );
	$outputExcel->getActiveSheet()->setCellValue('U1', "Height" );
	$outputExcel->getActiveSheet()->setCellValue('V1', "Width" );
	$outputExcel->getActiveSheet()->setCellValue('W1', "Length" );
	$outputExcel->getActiveSheet()->setCellValue('X1', "Ring size" );
	$outputExcel->getActiveSheet()->setCellValue('Y1', "Country Id" );
	$outputExcel->getActiveSheet()->setCellValue('Z1', "Subcategory" );
	$outputExcel->getActiveSheet()->setCellValue('AA1', "Lab Grown Diamond" );
	$outputExcel->getActiveSheet()->setCellValue('AB1', "Images (comma \",\" separated)" );
	$outputExcel->getActiveSheet()->setCellValue('AC1', "Description" ) ;
	$outputExcel->getActiveSheet()->setCellValue('AD1', "Description (French)");
	$outputExcel->getActiveSheet()->setCellValue('AE1', "Diamond Color");

	#$outputExcel->getActiveSheet()->getStyle('V1:V'.$outputExcel->getActiveSheet()->getHighestRow())->getAlignment()->setWrapText(true);
	#$outputExcel->getActiveSheet()->getStyle('U1:U'.$outputExcel->getActiveSheet()->getHighestRow())->getAlignment()->setWrapText(true);

	switch ($_GET['exportAllZip']) {
		case 0: {
			$category = "";
			break;
		} case 1: {
			$category = " WHERE `category` = ". $_GET['exportAllZip'];
			break;
		} case 2: {
			$category = " WHERE `category` = ". $_GET['exportAllZip'];
			break;
		} case 3: {
			$category = " WHERE `category` = ". $_GET['exportAllZip'];
			break;
		} case 4: {
			$category = " WHERE `category` = ". $_GET['exportAllZip'];
			break;
		} case 5: {
			$category = " WHERE `category` = ". $_GET['exportAllZip'];
			break;
		} default: {
			$category = "";
			break;
		} 
	}

	$getItems = $pdo->prepare("SELECT * FROM `items`". $category);
	$getItems->execute();

	$allItems = $getItems->fetchAll();

	$array = $allItems;

	$zipPath = '../../working/zip/archives/export/DiamantSecret_' . date("d-M-y") .".zip";
	
	$count = 1;
	while ( file_exists($zipPath) ) {
		$zipPath = '../../working/zip/archives/export/DiamantSecret_' . date("d-M-y") . "_" . $count .".zip";
		$count++;
	}


	$zipExport = new ZipArchive();
	$zipExport->open($zipPath, ZipArchive::CREATE || ZipArchive::OVERWRITE);
	$zipExport->addEmptyDir('images');


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
			} default: {
				echo '<div class="alert alert-error">Fatal Error: Invalid Category '. $item['category'].' for item <strong>'. $item['item_name'] .'</strong></div>';
				return;
			}
		}
		$itemInfo->execute(array(":uniqueKey" => $item['unique_key']));

		if ( $itemInfo->rowCount() > 0 ) {

			$itemInfo = $itemInfo->fetch(PDO::FETCH_ASSOC);

			/*if ( !isset($itemInfo['ring_subcategory']) ) {
				$itemInfo['ring_subcategory'] = $itemInfo['ring_size'] = "ITEM_NOT_RING";
			}*/

			//echo $itemInfo['id'];

			$numImg = "";

			$imgArray = explode(",", $itemInfo['images']);

			foreach ( $imgArray as $img ) {
				if ( !empty($img) ) {
					$zipExport->addFile('../../images/images/' . $img , "images/" . $img);
				}
			}


			$outputExcel->getActiveSheet()->setCellValue('A' . $row, getCompanyCode($itemInfo['company_id'], $pdo) );
		$outputExcel->getActiveSheet()->setCellValue('B' . $row, $item['category'] );
		$outputExcel->getActiveSheet()->setCellValue('C' . $row, $itemInfo['internal_id'] );
		$outputExcel->getActiveSheet()->setCellValue('D' . $row, $itemInfo['product_name']);
		$outputExcel->getActiveSheet()->setCellValue('E' . $row, $item['item_value'] );
		$outputExcel->getActiveSheet()->setCellValue('F' . $row, $item['discount'] );
		$outputExcel->getActiveSheet()->setCellValue('G' . $row, $itemInfo['pieces_in_stock'] );
		$outputExcel->getActiveSheet()->setCellValue('H' . $row, $itemInfo['days_for_shipment'] );
		$outputExcel->getActiveSheet()->setCellValue('I' . $row, $itemInfo['total_gold_weight'] );
		$outputExcel->getActiveSheet()->setCellValue('J' . $row, $itemInfo['total_carat_weight'] );
		$outputExcel->getActiveSheet()->setCellValue('K' . $row, $itemInfo['color_stone_carat'] );
		$outputExcel->getActiveSheet()->setCellValue('L' . $row, $itemInfo['no_of_stones'] );
		$outputExcel->getActiveSheet()->setCellValue('M' . $row, $itemInfo['no_of_color_stones'] );
		$outputExcel->getActiveSheet()->setCellValue('N' . $row, $itemInfo['diamond_shape'] );
		$outputExcel->getActiveSheet()->setCellValue('O' . $row, $itemInfo['color_stone_shape'] );
		$outputExcel->getActiveSheet()->setCellValue('P' . $row, $itemInfo['clarity'] );
		$outputExcel->getActiveSheet()->setCellValue('Q' . $row, $itemInfo['color'] );
		$outputExcel->getActiveSheet()->setCellValue('R' . $row, $itemInfo['material'] );
		$outputExcel->getActiveSheet()->setCellValue('S' . $row, $itemInfo['gold_quality']);
		$outputExcel->getActiveSheet()->setCellValue('T' . $row, $itemInfo['color_stone_type']);
		$outputExcel->getActiveSheet()->setCellValue('U' . $row, $itemInfo['height'] );
		$outputExcel->getActiveSheet()->setCellValue('V' . $row, $itemInfo['width'] );
		$outputExcel->getActiveSheet()->setCellValue('W' . $row, $itemInfo['length'] );
		$outputExcel->getActiveSheet()->setCellValue('X' . $row, $itemInfo['ring_size'] );
		$outputExcel->getActiveSheet()->setCellValue('Y' . $row, $itemInfo['country_id'] );
		$outputExcel->getActiveSheet()->setCellValue('Z' . $row, $itemInfo['ring_subcategory'] );
		$outputExcel->getActiveSheet()->setCellValue('AA' . $row, $itemInfo['lab_grown'] );
		$outputExcel->getActiveSheet()->setCellValue('AB' . $row, trim($itemInfo['images'], ",") );
		$outputExcel->getActiveSheet()->setCellValue('AC' . $row, $itemInfo['description'] ) ;
		$outputExcel->getActiveSheet()->setCellValue('AD' . $row, $itemInfo['description_french']);
		$outputExcel->getActiveSheet()->setCellValue('AE' . $row, $itemInfo['diamond_color']);


			$row++;
		}
	} 


	#Setting Rest Sheets.
	addMiscSheets($outputExcel, $pdo);
	$outputExcel->setActiveSheetIndex(0);


	header('Content-Type: application/vnd.ms-excel'); 
	header('Content-Disposition: attachment;filename="results.xlsx"'); 
	header('Cache-Control: max-age=0'); 
	$outputExcel = PHPExcel_IOFactory::createWriter($outputExcel, 'Excel2007'); 
	$outputExcel->save($file . $ext);


	$zipExport->addFile($file . $ext, "products.xlsx");
	$zipExport->close();

	echo json_encode(array('<h4><div class="alert alert-success">Export Successful</div></h4><br><br><p>Zip Created: ' . basename($zipPath) . '<br><br><a class="btn btn-custom" href="'. $zipPath .'">Download</a>', $file.$ext));

} else if ( isset($_GET['getInfo']) ) {
	$fetchItem = $pdo->prepare("SELECT * FROM `items` WHERE `unique_key` = :key");
	$fetchItem->execute(array(":key" => $_GET['getInfo']));
	if ( $fetchItem->rowCount() > 0 ) {
		$item = $fetchItem->fetch(PDO::FETCH_ASSOC);
		switch ($item['category']) {
			case 1: {
				$fetchInfo = $pdo->prepare("SELECT * FROM `rings` WHERE `unique_key` = :key");
				$fetchInfo->execute(array(":key" => $_GET['getInfo']));
				$info = $fetchInfo->fetch(PDO::FETCH_ASSOC);
				break;
			} case 2: {
				$fetchInfo = $pdo->prepare("SELECT * FROM `earrings` WHERE `unique_key` = :key");
				$fetchInfo->execute(array(":key" => $_GET['getInfo']));
				$info = $fetchInfo->fetch(PDO::FETCH_ASSOC);
				break;
			} case 3: {
				$fetchInfo = $pdo->prepare("SELECT * FROM `pendants` WHERE `unique_key` = :key");
				$fetchInfo->execute(array(":key" => $_GET['getInfo']));
				$info = $fetchInfo->fetch(PDO::FETCH_ASSOC);
				break;
			} case 4: {
				$fetchInfo = $pdo->prepare("SELECT * FROM `necklaces` WHERE `unique_key` = :key");
				$fetchInfo->execute(array(":key" => $_GET['getInfo']));
				$info = $fetchInfo->fetch(PDO::FETCH_ASSOC);
				break;
			} case 5: {
				$fetchInfo = $pdo->prepare("SELECT * FROM `bracelets` WHERE `unique_key` = :key");
				$fetchInfo->execute(array(":key" => $_GET['getInfo']));
				$info = $fetchInfo->fetch(PDO::FETCH_ASSOC);
				break;
			}
		}

		echo json_encode(array_merge($info, $item));
	} else {
		echo 'Item Not Found';
	}

} else if ( isset($_GET['getSubs']) ) {

	if ( is_numeric($_GET['getSubs']) ) {
		$filter = " WHERE site_id = 1";
	} else {
		$filter = "";
	}

	$getSubs = $pdo->prepare("SELECT * FROM `subscribers`". $filter );
	$getSubs->execute();

	$subs = [];

	foreach ( $getSubs->fetchAll() as $subscriber ) {
		array_push($subs, $subscriber['email']);
	}

	echo json_encode($subs);

} else if ( isset($_GET['sendNewsletter']) ) {
	require '../../url/PHPMailerAutoload.php';

	$getHash = $pdo->prepare("SELECT * FROM `subscribers` WHERE `email` = :email");
	$getHash->execute(array(":email" => $_POST['email']));

	if ( $getHash->rowCount() > 0 ) {
		$getMail = $getHash->fetch(PDO::FETCH_ASSOC);
		$email = filter_var(trim($getMail['email']), FILTER_SANITIZE_EMAIL);
		$mail = new PHPMailer;
		$mail->isSMTP();
		//$mail->SMTPDebug = 2;
		//$mail->Debugoutput = 'html';
		$mail->Host = $mailHost;
		$mail->Port = $mailPort;
		$mail->SMTPAuth = $mailSMTPAuth;
		$mail->Username = $mailUsername;
		$mail->Password = $mailPassword;
		$mail->setFrom('contact@diamantsecret.com', 'Diamant Secret');
		$mail->addAddress($email);
		$mail->isHTML(true);
		$mail->smtpConnect(
		    array(
		        "ssl" => array(
		            "verify_peer" => false,
		            "verify_peer_name" => false,
		            "allow_self_signed" => true
		        )
		    )
		);
		$mail->Subject = 'Newsletter';
		//$mail->Body = "Greetings, " . urldecode($_POST['content'] . "<hr /><div style='text-align:center;'>If you wish to unsubscribe to our Newsletter, please <a rel='noindex, nofollow' target='_blank' href='". $__MAINDOMAIN__. "login.php?unsub=".$getMail['hash']."'>click here</a></div>");
		$mail->Body = urldecode($_POST['content']);
		if ( !$mail->send() ) {
			echo 'Failed';
		} else {
			echo 'Sent';
		}
	}

} else if (isset($_GET['downloadFormat'])) {
	pconsole('SHIT');
	$outputExcel = new PHPExcel();

	$outputExcel->setActiveSheetIndex(0);
	$outputExcel->getActiveSheet()->setTitle('products');

	$outputExcel->getActiveSheet()->getStyle('A1:AE1')->getFont()->setBold(true);
	$outputExcel->getActiveSheet()->setCellValue('A1', "Company Id" );
	$outputExcel->getActiveSheet()->setCellValue('B1', "Category Id" );
	$outputExcel->getActiveSheet()->setCellValue('C1', "Internal Id" );
	$outputExcel->getActiveSheet()->setCellValue('D1', "Product Name");
	$outputExcel->getActiveSheet()->setCellValue('E1', "Amount" );
	$outputExcel->getActiveSheet()->setCellValue('F1', "Discount Percent" );
	$outputExcel->getActiveSheet()->setCellValue('G1', "Pieces in stock" );
	$outputExcel->getActiveSheet()->setCellValue('H1', "Days for shipment" );
	$outputExcel->getActiveSheet()->setCellValue('I1', "Total gold weight" );
	$outputExcel->getActiveSheet()->setCellValue('J1', "Total carat weight" );
	$outputExcel->getActiveSheet()->setCellValue('K1', "Color stone carat" );
	$outputExcel->getActiveSheet()->setCellValue('L1', "No. of stones" );
	$outputExcel->getActiveSheet()->setCellValue('M1', "No. of colour stone" );
	$outputExcel->getActiveSheet()->setCellValue('N1', "Diamond Shape" );
	$outputExcel->getActiveSheet()->setCellValue('O1', "Color stone shape" );
	$outputExcel->getActiveSheet()->setCellValue('P1', "Clarity" );
	$outputExcel->getActiveSheet()->setCellValue('Q1', "Color" );
	$outputExcel->getActiveSheet()->setCellValue('R1', "Material" );
	$outputExcel->getActiveSheet()->setCellValue('S1', "Gold Quality" );
	$outputExcel->getActiveSheet()->setCellValue('T1', "Color Stone Type" );
	$outputExcel->getActiveSheet()->setCellValue('U1', "Height" );
	$outputExcel->getActiveSheet()->setCellValue('V1', "Width" );
	$outputExcel->getActiveSheet()->setCellValue('W1', "Length" );
	$outputExcel->getActiveSheet()->setCellValue('X1', "Ring size" );
	$outputExcel->getActiveSheet()->setCellValue('Y1', "Country Id" );
	$outputExcel->getActiveSheet()->setCellValue('Z1', "Subcategory" );
	$outputExcel->getActiveSheet()->setCellValue('AA1', "Lab Grown Diamond" );
	$outputExcel->getActiveSheet()->setCellValue('AB1', "Images (comma \",\" separated)" );
	$outputExcel->getActiveSheet()->setCellValue('AC1', "Description" ) ;
	$outputExcel->getActiveSheet()->setCellValue('AD1', "Description (French)");
	$outputExcel->getActiveSheet()->setCellValue('AE1', "Diamond Color");

	#$outputExcel->getActiveSheet()->getStyle('V1:V'.$outputExcel->getActiveSheet()->getHighestRow())->getAlignment()->setWrapText(true);
	#$outputExcel->getActiveSheet()->getStyle('U1:U'.$outputExcel->getActiveSheet()->getHighestRow())->getAlignment()->setWrapText(true);

	#Setting Rest Sheets.
	addMiscSheets($outputExcel, $pdo);
	$outputExcel->setActiveSheetIndex(0);

	$outputExcel = PHPExcel_IOFactory::createWriter($outputExcel, 'Excel2007'); 
	$outputExcel->save('./../assets/format.xlsx');

} else if (isset($_GET['checkToken']) ) {
	if ( isset($_SESSION['tmp_file']) ) {
		if ( strpos($_SESSION['tmp_file'], $_GET['checkToken']) !== false ) {
			echo 1;
		} else {
			echo 0;
		}
	}

} else if ( isset($_GET['checkZipToken']) ) {
	if ( file_exists('./../../working/zip/import/'. $_GET['checkZipToken'] .'/token') ) {
		$token = json_decode(file_get_contents('./../../working/zip/import/'. $_GET['checkZipToken'] .'/token'));
		if ( $token->{'token'} == $_GET['checkZipToken'] ) {
			echo 1;
		} else {
			echo 0;
		}
	} else {
		echo 0;
	}

} else if ( isset($_GET['fetchImages']) ) {
	$uniqueKey = $_GET['fetchImages'];

	$getCategory = $pdo->prepare("SELECT * FROM `items` WHERE `unique_key` = :key");
	$getCategory->execute(array(":key" => $uniqueKey));

	if ( $getCategory->rowCount() > 0 ) {
		$itemInfo = $getCategory->fetch(PDO::FETCH_ASSOC);

		$fetchInfo2 = $pdo->prepare('SELECT * From '. getCategory($itemInfo['category'], $pdo) .' WHERE `unique_key` = :key');
		$fetchInfo2->execute(array(":key" => $uniqueKey));

		if ( $fetchInfo2->rowCount() > 0 ) {
			$itemInfo2 = $fetchInfo2->fetch(PDO::FETCH_ASSOC);

			$images = explode(",", $itemInfo2['images']);

			if ( $itemInfo2['images'] !== "" ) {
				$imageOutput = "";
				foreach ( $images as $image ) {
					if ( !empty($image) ) {	
						$imageOutput .= '
						<div class="col-md-3" style="padding: 5px;">
							<a href="javascript:void(0);" style="position: absolute; right: 10px; z-index: 2; font-size: 16px; color: #F44336;" onclick="$(\'#imageToDelete\').attr(\'src\', \'./../../images/images_md/'. $image .'\'); $(\'#imageToDeleteID\').val(\''. $image .'\'); $(\'#deleteImagekey\').val(\''. $itemInfo['unique_key'] .'\'); $(\'#promptDeleteImage\').modal(\'toggle\');" ><i class="fa fa-close" data-toggle="tooltip" title="Delete"></i></a>
							<a href="javascript:void(0);"><img class="custom-img-thumbnail" src="./../../images/images_sm/'. $image .'" style="width:100%; border: solid thin #ccc;" /></a>
						</div>';
					}
				}

				echo $imageOutput;
			}
		} else {
			echo "Invalid Item";
		}
	} else {
		echo "Invalid Item";
	}

} else if ( isset($_GET['getSupplierDetails']) ) {
	$getSupplier = $pdo->prepare("SELECT * FROM `company_id` WHERE `id` = :id");
	$getSupplier->execute(array(":id" => $_GET['getSupplierDetails']));

	if  ( $getSupplier->rowCount() > 0 ) {
		$supplier = $getSupplier->fetch(PDO::FETCH_ASSOC);
		
		echo json_encode($supplier);
	} else {
		echo "Supplier Not Found";
	}

} else if ( isset($_GET['getSupplierItems']) ) {
	$getSupplier = $pdo->prepare("SELECT * FROM `company_id` WHERE `id` = :id");
	$getSupplier->execute(array(":id" => $_GET['getSupplierItems']));

	if  ( $getSupplier->rowCount() > 0 ) {
		$supplier = $getSupplier->fetch(PDO::FETCH_ASSOC);
		$rings = $pdo->prepare("SELECT COUNT(id) AS supplierItems FROM `rings` WHERE `company_id` = :id");
		$rings->execute(array(":id" => $supplier['id']));
		$rings = $rings->fetch(PDO::FETCH_ASSOC);
		$rings = $rings['supplierItems'];

		$earrings = $pdo->prepare("SELECT COUNT(id) AS supplierItems FROM `earrings` WHERE `company_id` = :id");
		$earrings->execute(array(":id" => $supplier['id']));
		$earrings = $earrings->fetch(PDO::FETCH_ASSOC);
		$earrings = $earrings['supplierItems'];

		$pendants = $pdo->prepare("SELECT COUNT(id) AS supplierItems FROM `pendants` WHERE `company_id` = :id");
		$pendants->execute(array(":id" => $supplier['id']));
		$pendants = $pendants->fetch(PDO::FETCH_ASSOC);
		$pendants = $pendants['supplierItems'];

		$necklaces = $pdo->prepare("SELECT COUNT(id) AS supplierItems FROM `necklaces` WHERE `company_id` = :id");
		$necklaces->execute(array(":id" => $supplier['id']));
		$necklaces = $necklaces->fetch(PDO::FETCH_ASSOC);
		$necklaces = $necklaces['supplierItems'];

		$bracelets = $pdo->prepare("SELECT COUNT(id) AS supplierItems FROM `bracelets` WHERE `company_id` = :id");
		$bracelets->execute(array(":id" => $supplier['id']));
		$bracelets = $bracelets->fetch(PDO::FETCH_ASSOC);
		$bracelets = $bracelets['supplierItems'];

		$supplierItems = $rings + $earrings + $pendants + $necklaces + $bracelets;

		if ( $supplierItems > 0 ) {
			echo json_encode(array("result" => 1, "entries" => $supplierItems, "name" => $supplier['company_name']));
		} else {
			echo json_encode(array_merge(array("result" => 0), $supplier));
		}
	} else {
		echo "Supplier Not Found";
	}

} else if ( isset($_GET['getVatDetails']) ) {
	$getSupplier = $pdo->prepare("SELECT * FROM `country_vat` WHERE `id` = :id");
	$getSupplier->execute(array(":id" => $_GET['getVatDetails']));

	if  ( $getSupplier->rowCount() > 0 ) {
		echo json_encode($getSupplier->fetch(PDO::FETCH_ASSOC));
	} else {
		echo "Country Vat Not Found";
	}

} else if ( isset($_GET['clearImportFolder']) ) {
	try {
		$dir = "./../../working/zip/import/" . $_GET['clearImportFolder'] . "/";
		$files = scandir($dir);
		foreach ( $files as $file ) {
			if ( $file == ".." || $file == "." || $file == ".gitignore" ) {
				continue;
			} else {
				( is_file($dir . $file) ) ? unlink($dir . $file) : rrmdir($dir . $file);
			}
		}
		rmdir($dir);
		echo 1;
	} catch ( Exception $e ) {
		echo var_dump($e);
	}

} else if ( isset($_GET['finalizeExport']) ) {
	if ( isset($_GET['finalizeExport']) ) {
		if ( file_exists($_GET['finalizeExport']) ) {
			unlink($_GET['finalizeExport']);
		}
	}

} else if ( isset($_GET['finalizeImport']) ) {

	

	//=========addming families to min_max_values table===========
	$getFamily = $pdo->prepare("SELECT `family` FROM `items`");
	$data = $getFamily->execute();
	$getFamily = $getFamily->fetchAll();
	foreach ($getFamily as $key => $Family) {
		if(!empty($Family['family'])){
			$family_list[] = trim($Family['family']);
		}	
	}
	$json_family = json_encode(array_values(array_unique($family_list)));

	$checkFamily = $pdo->prepare("SELECT `keys_name` FROM `min_max_values` where keys_name = 'family'");
	
	$checkFamily->execute();//print_r($checkFamily);die;
	
	if($checkFamily->rowCount() > 0){
		$updateFamilies = $pdo->prepare("update `min_max_values` set keys_values='".$json_family."'
										where keys_name = 'family'")->execute();
	}
	else{
		$addFamilies = $pdo->prepare("INSERT INTO min_max_values (keys_name,keys_values) 
									value('family','".$json_family."')");
		$addFamilies->execute();
	}
	//=========ending families to min_max_values table===========
	
	if ( file_exists('./../../working/zip/import/'. $_GET['finalizeImport'] .'/token') ) {
		$token = json_decode(file_get_contents('./../../working/zip/import/'. $_GET['finalizeImport'] .'/token'));

		if ( $token->{'token'} == $_GET['finalizeImport'] ) {
			try {
				$dir = "./../../working/zip/import/". $_GET['finalizeImport'] . "/";
				$files = scandir($dir);
				foreach ( $files as $file ) {
					if ( $file == ".." || $file == "." || $file == ".gitignore" ) {
						continue;
					} else {
						( is_file($dir . $file) ) ? unlink($dir . $file) : rrmdir($dir . $file);
					}
				}
				rmdir($dir);
				echo json_encode(array("tokenMatch" => true));
			} catch ( Exception $e ) {
				echo var_dump($e);
			}	
		} else {
			echo json_encode(array("tokenMatch" => false));
		}
	}
	
} else if ( isset($_GET['verifyCompanyCode']) ) {
	$code = $_GET['verifyCompanyCode'];

	$q = $pdo->prepare("SELECT * FROM `company_id` WHERE `company_code` = :cc");
	$q->execute(array(":cc" => $code));

	if ( $q->rowCount() > 0 ) {
		echo 0;
	} else {
		echo 1;
	}
} else if ( isset($_GET['getSubcategories']) ) {
	$id = $_GET['getSubcategories'];
	$query = $pdo->prepare("SELECT * FROM `ring_subcategory` WHERE `category_id` = :id");
	$query->execute(array(":id" => $id));

	if ( $query->rowCount() > 0 ) {
			echo '<option value="">Ring Subcategory</option>';
		foreach ( $query->fetchAll() as $option ) {
			echo '<option value ="'. $option['id'] .'">'. $option['category'] .'</option>';
		}
	}
} else if ( isset($_GET['selectCategory']) ) {
	$query = $pdo->prepare("SELECT * FROM `ring_subcategory` WHERE `category_id` = :category");
    $query->execute(array(":category" => $_GET['selectCategory']));

    $returnValue = "";
    if ( $query->rowCount() > 0 ) {
        $returnValue .= '<option value="">Select</option>';
        $query = $query->fetchAll();
        foreach ( $query as $option ) {
            $returnValue .= '<option value="'. $option['id'] .'">'. $option['category'] .'</option>';
        }
    }
    echo $returnValue;
} else {	echo "GET not SET";		}




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
		//$src = imagecreatefromfile($file);
		$src = imagecreatefromstring(file_get_contents($file));
		$dst = imagecreatetruecolor($newwidth, $newheight);
		imagecopyresampled($dst, $src, 0, 0, 0, 0, $newwidth, $newheight, $width, $height);
		
		return imagejpeg($dst, $thumb_dir);
	}

	function imagecreatefromfile( $filename ) {
	    if (!file_exists($filename)) {
	        throw new InvalidArgumentException('File "'.$filename.'" not found.');
	    }
	    switch ( strtolower( pathinfo( $filename, PATHINFO_EXTENSION ))) {
	        case 'jpeg':
	        case 'jpg':
	            return imagecreatefromjpeg($filename);
	        break;

	        case 'png':
	            return imagecreatefrompng($filename);
	        break;

	        case 'gif':
	            return imagecreatefromgif($filename);
	        break;

	        default:
	            throw new InvalidArgumentException('File "'.$filename.'" is not valid jpg, png or gif image.');
	        break;
	    }
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

	function addMiscSheets($outputExcel, $pdo) {
		#$categorySheet = $outputExcel->createSheet();
		$outputExcel->createSheet(1);
		$outputExcel->setActiveSheetIndex(1);
		$outputExcel->getActiveSheet()->setTitle('category_map');
		$outputExcel->getActiveSheet()->getStyle('A1:B1')->getFont()->setBold(true);
		$outputExcel->getActiveSheet()->setCellValue('A1', 'id');
		$outputExcel->getActiveSheet()->setCellValue('B1', 'category_name');

		$getCategories = $pdo->prepare("SELECT * FROM `categories`");
		$getCategories->execute();

		if ( $getCategories->rowCount() > 0 ) {
			$categories = $getCategories->fetchAll();

			for($i = 0; $i < sizeof($categories); $i++ ) {
				$outputExcel->getActiveSheet()->setCellValue('A' . intval($i+2), $categories[$i]['id']);
				$outputExcel->getActiveSheet()->setCellValue('B' . intval($i+2), $categories[$i]['category']);
			}
		} else {
			#No Rows Found
		}

		#Material Sheet
		$outputExcel->createSheet(2);
		$outputExcel->setActiveSheetIndex(2);
		$outputExcel->getActiveSheet()->setTitle('material_map');
		$outputExcel->getActiveSheet()->getStyle('A1:B1')->getFont()->setBold(true);
		$outputExcel->getActiveSheet()->setCellValue('A1', 'id');
		$outputExcel->getActiveSheet()->setCellValue('B1', 'material');

		$getCategories = $pdo->prepare("SELECT * FROM `materials`");
		$getCategories->execute();

		if ( $getCategories->rowCount() > 0 ) {
			$categories = $getCategories->fetchAll();

			for($i = 0; $i < sizeof($categories); $i++ ) {
				$outputExcel->getActiveSheet()->setCellValue('A' . intval($i+2), $categories[$i]['id']);
				$outputExcel->getActiveSheet()->setCellValue('B' . intval($i+2), $categories[$i]['category']);
			}
		} else {
			#No Rows Found
		}

		#Diamond Shape
		$outputExcel->createSheet(3);
		$outputExcel->setActiveSheetIndex(3);
		$outputExcel->getActiveSheet()->setTitle('diamond_shape');
		$outputExcel->getActiveSheet()->getStyle('A1:B1')->getFont()->setBold(true);
		$outputExcel->getActiveSheet()->setCellValue('A1', 'id');
		$outputExcel->getActiveSheet()->setCellValue('B1', 'shape');

		$getCategories = $pdo->prepare("SELECT * FROM `diamond_shape`");
		$getCategories->execute();

		if ( $getCategories->rowCount() > 0 ) {
			$categories = $getCategories->fetchAll();

			for($i = 0; $i < sizeof($categories); $i++ ) {
				$outputExcel->getActiveSheet()->setCellValue('A' . intval($i+2), $categories[$i]['id']);
				$outputExcel->getActiveSheet()->setCellValue('B' . intval($i+2), $categories[$i]['category']);
			}
		} else {
			#No Rows Found
		}

		#Ring SubCat
		$outputExcel->createSheet(4);
		$outputExcel->setActiveSheetIndex(4);
		$outputExcel->getActiveSheet()->setTitle('subcategory');
		$outputExcel->getActiveSheet()->getStyle('A1:C1')->getFont()->setBold(true);
		$outputExcel->getActiveSheet()->setCellValue('A1', 'id');
		$outputExcel->getActiveSheet()->setCellValue('B1', 'category_id');
		$outputExcel->getActiveSheet()->setCellValue('C1', 'category');

		$getCategories = $pdo->prepare("SELECT * FROM `ring_subcategory`");
		$getCategories->execute();

		if ( $getCategories->rowCount() > 0 ) {
			$categories = $getCategories->fetchAll();

			for($i = 0; $i < sizeof($categories); $i++ ) {
				$outputExcel->getActiveSheet()->setCellValue('A' . intval($i+2), $categories[$i]['id']);
				$outputExcel->getActiveSheet()->setCellValue('B' . intval($i+2), $categories[$i]['category_id']);
				$outputExcel->getActiveSheet()->setCellValue('C' . intval($i+2), $categories[$i]['category']);
			}
		} else {
			#No Rows Found
		}

		#Country Sheet
		$outputExcel->createSheet(5);
		$outputExcel->setActiveSheetIndex(5);
		$outputExcel->getActiveSheet()->setTitle('country_vat');
		$outputExcel->getActiveSheet()->getStyle('A1:B1')->getFont()->setBold(true);
		$outputExcel->getActiveSheet()->setCellValue('A1', 'id');
		$outputExcel->getActiveSheet()->setCellValue('B1', 'country_name');

		$getCategories = $pdo->prepare("SELECT * FROM `country_vat`");
		$getCategories->execute();

		if ( $getCategories->rowCount() > 0 ) {
			$categories = $getCategories->fetchAll();

			for($i = 0; $i < sizeof($categories); $i++ ) {
				$outputExcel->getActiveSheet()->setCellValue('A' . intval($i+2), $categories[$i]['id']);
				$outputExcel->getActiveSheet()->setCellValue('B' . intval($i+2), $categories[$i]['country_name']);
			}
		} else {
			#No Rows Found
		}

		#Color Sheet
		$outputExcel->createSheet(6);
		$outputExcel->setActiveSheetIndex(6);
		$outputExcel->getActiveSheet()->setTitle('color');
		$outputExcel->getActiveSheet()->getStyle('A1:B1')->getFont()->setBold(true);
		$outputExcel->getActiveSheet()->setCellValue('A1', 'id');
		$outputExcel->getActiveSheet()->setCellValue('B1', 'color');

		$getCategories = $pdo->prepare("SELECT * FROM `color`");
		$getCategories->execute();

		if ( $getCategories->rowCount() > 0 ) {
			$categories = $getCategories->fetchAll();

			for($i = 0; $i < sizeof($categories); $i++ ) {
				$outputExcel->getActiveSheet()->setCellValue('A' . intval($i+2), $categories[$i]['id']);
				$outputExcel->getActiveSheet()->setCellValue('B' . intval($i+2), $categories[$i]['color']);
			}
		} else {
			#No Rows Found
		}

		#Diamond Color Sheet
		$outputExcel->createSheet(7);
		$outputExcel->setActiveSheetIndex(7);
		$outputExcel->getActiveSheet()->setTitle('diamond_color');
		$outputExcel->getActiveSheet()->getStyle('A1:B1')->getFont()->setBold(true);
		$outputExcel->getActiveSheet()->setCellValue('A1', 'id');
		$outputExcel->getActiveSheet()->setCellValue('B1', 'diamond color');

		$getCategories = $pdo->prepare("SELECT * FROM `diamond_color`");
		$getCategories->execute();

		if ( $getCategories->rowCount() > 0 ) {
			$categories = $getCategories->fetchAll();

			for($i = 0; $i < sizeof($categories); $i++ ) {
				$outputExcel->getActiveSheet()->setCellValue('A' . intval($i+2), $categories[$i]['id']);
				$outputExcel->getActiveSheet()->setCellValue('B' . intval($i+2), $categories[$i]['diamond_color']);
			}
		} else {
			#No Rows Found
		}

		#Gold Quality Sheet
		$outputExcel->createSheet(8);
		$outputExcel->setActiveSheetIndex(8);
		$outputExcel->getActiveSheet()->setTitle('gold_quality');
		$outputExcel->getActiveSheet()->getStyle('A1:B1')->getFont()->setBold(true);
		$outputExcel->getActiveSheet()->setCellValue('A1', 'id');
		$outputExcel->getActiveSheet()->setCellValue('B1', 'gold quality');

		$getCategories = $pdo->prepare("SELECT * FROM `gold_quality`");
		$getCategories->execute();

		if ( $getCategories->rowCount() > 0 ) {
			$categories = $getCategories->fetchAll();

			for($i = 0; $i < sizeof($categories); $i++ ) {
				$outputExcel->getActiveSheet()->setCellValue('A' . intval($i+2), $categories[$i]['id']);
				$outputExcel->getActiveSheet()->setCellValue('B' . intval($i+2), $categories[$i]['gold_quality']);
			}
		} else {
			#No Rows Found
		}

		#Gold Quality Sheet
		$outputExcel->createSheet(9);
		$outputExcel->setActiveSheetIndex(9);
		$outputExcel->getActiveSheet()->setTitle('clarity');
		$outputExcel->getActiveSheet()->getStyle('A1')->getFont()->setBold(true);
		$outputExcel->getActiveSheet()->setCellValue('A1', 'clarity');

		$getCategories = $pdo->prepare("SELECT * FROM `clarity`");
		$getCategories->execute();

		if ( $getCategories->rowCount() > 0 ) {
			$categories = $getCategories->fetchAll();

			for($i = 0; $i < sizeof($categories); $i++ ) {
				$outputExcel->getActiveSheet()->setCellValue('A' . intval($i+2), $categories[$i]['clarity']);
			}
		} else {
			#No Rows Found
		}

		#Other Sheet
		$outputExcel->createSheet(10);
		$outputExcel->setActiveSheetIndex(10);
		$outputExcel->getActiveSheet()->setTitle('Other options');
		$outputExcel->getActiveSheet()->setCellValue('A2', 'Possible options for other columns:');
		$outputExcel->getActiveSheet()->setCellValue('A4', 'Column Name');
		$outputExcel->getActiveSheet()->setCellValue('B4', 'Option-1');
		$outputExcel->getActiveSheet()->setCellValue('C4', 'Option-2');

		$outputExcel->getActiveSheet()->getStyle('A4:C4')->getFont()->setBold(true);

		$outputExcel->getActiveSheet()->getStyle('A4:C4')->applyFromArray(
		    array(
		        'fill' => array(
		            'type' => PHPExcel_Style_Fill::FILL_SOLID,
		            'color' => array('rgb' => 'DDDDDD')
		        )
		    )
		);

		$outputExcel->getActiveSheet()->setCellValue('A5', 'Lab Grown Diamond');
		$outputExcel->getActiveSheet()->setCellValue('B5', 'TRUE');
		$outputExcel->getActiveSheet()->setCellValue('C5', 'FALSE');

	}

function rrmdir($dir) { 
   if (is_dir($dir)) { 
     $objects = scandir($dir); 
     foreach ($objects as $object) { 
       if ($object != "." && $object != "..") { 
         if (filetype($dir."/".$object) == "dir") rrmdir($dir."/".$object); else unlink($dir."/".$object); 
       } 
     } 
     reset($objects); 
     rmdir($dir); 
   } 
 }
?>