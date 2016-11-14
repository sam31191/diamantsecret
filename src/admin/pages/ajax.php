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

			if ( sizeof($products[1]) !== 22 ) {
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
			if ( !isset($products[1]['I']) || $products[1]['I'] !== "Total carat weight" ){
				$error .= "Invalid Column: <strong>" . $products[1]['I'] . "</strong><br>";
			}
			if ( !isset($products[1]['J']) || $products[1]['J'] !== "No. of stones" ){
				$error .= "Invalid Column: <strong>" . $products[1]['J'] . "</strong><br>";
			}
			if ( !isset($products[1]['K']) || $products[1]['K'] !== "Diamond Shape" ){
				$error .= "Invalid Column: <strong>" . $products[1]['K'] . "</strong><br>";
			}
			if ( !isset($products[1]['L']) || $products[1]['L'] !== "Clarity" ){
				$error .= "Invalid Column: <strong>" . $products[1]['L'] . "</strong><br>";
			}
			if ( !isset($products[1]['M']) || $products[1]['M'] !== "Color" ){
				$error .= "Invalid Column: <strong>" . $products[1]['M'] . "</strong><br>";
			}
			if ( !isset($products[1]['N']) || $products[1]['N'] !== "Material" ){
				$error .= "Invalid Column: <strong>" . $products[1]['N'] . "</strong><br>";
			}
			if ( !isset($products[1]['O']) || $products[1]['O'] !== "Height" ){
				$error .= "Invalid Column: <strong>" . $products[1]['O'] . "</strong><br>";
			}
			if ( !isset($products[1]['P']) || $products[1]['P'] !== "Width" ){
				$error .= "Invalid Column: <strong>" . $products[1]['P'] . "</strong><br>";
			}
			if ( !isset($products[1]['Q']) || $products[1]['Q'] !== "Length" ){
				$error .= "Invalid Column: <strong>" . $products[1]['Q'] . "</strong><br>";
			}
			if ( !isset($products[1]['R']) || $products[1]['R'] !== "Country Id" ){
				$error .= "Invalid Column: <strong>" . $products[1]['R'] . "</strong><br>";
			}
			if ( !isset($products[1]['S']) || $products[1]['S'] !== "Ring subcategory" ){
				$error .= "Invalid Column: <strong>" . $products[1]['S'] . "</strong><br>";
			}
			if ( !isset($products[1]['T']) || $products[1]['T'] !== "Ring size" ){
				$error .= "Invalid Column: <strong>" . $products[1]['T'] . "</strong><br>";
			}
			if ( !isset($products[1]['U']) || $products[1]['U'] !== "Images (comma \",\" separated)" ){
				$error .= "Invalid Column: <strong>" . $products[1]['U'] . "</strong><br>";
			}
			if ( !isset($products[1]['V']) || $products[1]['V'] !== "Description" ) {
				$error .= "Invalid Column: <strong>" . $products[1]['V'] . "</strong><br>";
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
				if ( !in_array($products[$i]['L'], $acceptedClarity) ) {
					$result = [];
					array_push($result, $products[$i]['D']);
					array_push($result, "Invalid Clarity: " . $products[$i]['J']);
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
								$valuesDB = getCompanyCode($resultValues['company_id'], $pdo) . $resultValues['category'] . $resultValues['internal_id'] . $resultValues['product_name'] . $resultValues['item_value'] . $resultValues['discount'] . $resultValues['pieces_in_stock'] . $resultValues['days_for_shipment'] . $resultValues['total_carat_weight'] . $resultValues['no_of_stones'] . $resultValues['diamond_shape'] . $resultValues['clarity'] . $resultValues['color'] . $resultValues['material'] . $resultValues['height'] . $resultValues['width'] . $resultValues['length'] . $resultValues['country_id'] . $resultValues['images_delta'] . $resultValues['description'] . $resultValues['ring_size'] . $resultValues['ring_subcategory'];

								$valuesSQL = $products[$i]['A'] . $products[$i]['B'] . $internalID . $products[$i]['D'] . $products[$i]['E'] . $products[$i]['F'] . $products[$i]['G'] . $products[$i]['H'] . $products[$i]['I'] . $products[$i]['J'] . $products[$i]['K'] . $products[$i]['L'] . $products[$i]['M'] . $products[$i]['N'] . $products[$i]['O'] . $products[$i]['P'] . $products[$i]['Q'] . $products[$i]['R'] . $products[$i]['U'] . $products[$i]['V'] . $products[$i]['T'] . $products[$i]['S'];

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
								$valuesDB = getCompanyCode($resultValues['company_id'], $pdo) . $resultValues['category'] . $resultValues['internal_id'] . $resultValues['product_name'] . $resultValues['item_value'] . $resultValues['discount'] . $resultValues['pieces_in_stock'] . $resultValues['days_for_shipment'] . $resultValues['total_carat_weight'] . $resultValues['no_of_stones'] . $resultValues['diamond_shape'] . $resultValues['clarity'] . $resultValues['color'] . $resultValues['material'] . $resultValues['height'] . $resultValues['width'] . $resultValues['length'] . $resultValues['country_id'] . $resultValues['images_delta'] . $resultValues['description'];

								$valuesSQL = $products[$i]['A'] . $products[$i]['B'] . $internalID . $products[$i]['D'] . $products[$i]['E'] . $products[$i]['F'] . $products[$i]['G'] . $products[$i]['H'] . $products[$i]['I'] . $products[$i]['J'] . $products[$i]['K'] . $products[$i]['L'] . $products[$i]['M'] . $products[$i]['N'] . $products[$i]['O'] . $products[$i]['P'] . $products[$i]['Q'] . $products[$i]['R'] . $products[$i]['U'] . $products[$i]['V'];

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
								$valuesDB = getCompanyCode($resultValues['company_id'], $pdo) . $resultValues['category'] . $resultValues['internal_id'] . $resultValues['product_name'] . $resultValues['item_value'] . $resultValues['discount'] . $resultValues['pieces_in_stock'] . $resultValues['days_for_shipment'] . $resultValues['total_carat_weight'] . $resultValues['no_of_stones'] . $resultValues['diamond_shape'] . $resultValues['clarity'] . $resultValues['color'] . $resultValues['material'] . $resultValues['height'] . $resultValues['width'] . $resultValues['length'] . $resultValues['country_id'] . $resultValues['images_delta'] . $resultValues['description'];

								$valuesSQL = $products[$i]['A'] . $products[$i]['B'] . $internalID . $products[$i]['D'] . $products[$i]['E'] . $products[$i]['F'] . $products[$i]['G'] . $products[$i]['H'] . $products[$i]['I'] . $products[$i]['J'] . $products[$i]['K'] . $products[$i]['L'] . $products[$i]['M'] . $products[$i]['N'] . $products[$i]['O'] . $products[$i]['P'] . $products[$i]['Q'] . $products[$i]['R'] . $products[$i]['U'] . $products[$i]['V'];

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
								$valuesDB = getCompanyCode($resultValues['company_id'], $pdo) . $resultValues['category'] . $resultValues['internal_id'] . $resultValues['product_name'] . $resultValues['item_value'] . $resultValues['discount'] . $resultValues['pieces_in_stock'] . $resultValues['days_for_shipment'] . $resultValues['total_carat_weight'] . $resultValues['no_of_stones'] . $resultValues['diamond_shape'] . $resultValues['clarity'] . $resultValues['color'] . $resultValues['material'] . $resultValues['height'] . $resultValues['width'] . $resultValues['length'] . $resultValues['country_id'] . $resultValues['images_delta'] . $resultValues['description'];

								$valuesSQL = $products[$i]['A'] . $products[$i]['B'] . $internalID . $products[$i]['D'] . $products[$i]['E'] . $products[$i]['F'] . $products[$i]['G'] . $products[$i]['H'] . $products[$i]['I'] . $products[$i]['J'] . $products[$i]['K'] . $products[$i]['L'] . $products[$i]['M'] . $products[$i]['N'] . $products[$i]['O'] . $products[$i]['P'] . $products[$i]['Q'] . $products[$i]['R'] . $products[$i]['U'] . $products[$i]['V'];

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
								$valuesDB = getCompanyCode($resultValues['company_id'], $pdo) . $resultValues['category'] . $resultValues['internal_id'] . $resultValues['product_name'] . $resultValues['item_value'] . $resultValues['discount'] . $resultValues['pieces_in_stock'] . $resultValues['days_for_shipment'] . $resultValues['total_carat_weight'] . $resultValues['no_of_stones'] . $resultValues['diamond_shape'] . $resultValues['clarity'] . $resultValues['color'] . $resultValues['material'] . $resultValues['height'] . $resultValues['width'] . $resultValues['length'] . $resultValues['country_id'] . $resultValues['images_delta'] . $resultValues['description'];

								$valuesSQL = $products[$i]['A'] . $products[$i]['B'] . $internalID . $products[$i]['D'] . $products[$i]['E'] . $products[$i]['F'] . $products[$i]['G'] . $products[$i]['H'] . $products[$i]['I'] . $products[$i]['J'] . $products[$i]['K'] . $products[$i]['L'] . $products[$i]['M'] . $products[$i]['N'] . $products[$i]['O'] . $products[$i]['P'] . $products[$i]['Q'] . $products[$i]['R'] . $products[$i]['U'] . $products[$i]['V'];

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

					if ( empty($products[$i]['V']) ) {
						$products[$i]['V'] = "-";
					}

					$addItem = $pdo->prepare("INSERT INTO `items` (`unique_key`, `item_name`, `item_value`, `discount`, `category`, `featured`, images_delta, `date_added`) VALUES (:unique_key, :product_name, :product_price, :discount, :category, 0, :images_delta, NOW())");
						$addItem->execute(array(
							":unique_key" => $uniqueKey,
							":product_name" => $products[$i]['D'],
							":product_price" => $products[$i]['E'],
							":discount" => $products[$i]['F'],
							":category" => $products[$i]['B'],
							":images_delta" => $products[$i]['U']
						));

					switch ($products[$i]['B']) {
						case 1: {
							$addInfo = $pdo->prepare("INSERT INTO `rings` 
								(`unique_key`, `company_id`, `internal_id`, `product_name`, `pieces_in_stock`, `days_for_shipment`, `total_carat_weight`, `no_of_stones`, `diamond_shape`, `clarity`, `color`, `material`, `height`, `width`, `length`, `country_id`, `images`, `description`, `ring_subcategory`, `ring_size`) 
								VALUES 
								(:unique_key, :company_id, :internal_id, :product_name, :pieces_in_stock, :days_for_shipment, :total_carat_weight, :no_of_stones, :diamond_shape, :clarity, :color, :material, :height, :width, :length, :country_id, :images, :description, :ring_subcategory, :ring_size)");
							$addInfo->execute(array(
								":unique_key" => $uniqueKey,
								":company_id" => $company_id,
								":internal_id" => $products[$i]['C'],
								":product_name" => $products[$i]['D'],
								":pieces_in_stock" => $products[$i]['G'],
								":days_for_shipment" => $products[$i]['H'],
								":total_carat_weight" => $products[$i]['I'],
								":no_of_stones" => $products[$i]['J'],
								":diamond_shape" => $products[$i]['K'],
								":clarity" => $products[$i]['L'],
								":color" => $products[$i]['M'],
								":material" => $products[$i]['N'],
								":height" => $products[$i]['O'],
								":width" => $products[$i]['P'],
								":length" => $products[$i]['Q'],
								":country_id" => $products[$i]['R'],
								":images" => "",
								":description" => $products[$i]['V'],
								":ring_subcategory" => $products[$i]['S'],
								":ring_size" => $products[$i]['T']
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
								":company_id" => $company_id,
								":internal_id" => $products[$i]['C'],
								":product_name" => $products[$i]['D'],
								":pieces_in_stock" => $products[$i]['G'],
								":days_for_shipment" => $products[$i]['H'],
								":total_carat_weight" => $products[$i]['I'],
								":no_of_stones" => $products[$i]['J'],
								":diamond_shape" => $products[$i]['K'],
								":clarity" => $products[$i]['L'],
								":color" => $products[$i]['M'],
								":material" => $products[$i]['N'],
								":height" => $products[$i]['O'],
								":width" => $products[$i]['P'],
								":length" => $products[$i]['Q'],
								":country_id" => $products[$i]['R'],
								":images" => "",
								":description" => $products[$i]['V']
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
								":company_id" => $company_id,
								":internal_id" => $products[$i]['C'],
								":product_name" => $products[$i]['D'],
								":pieces_in_stock" => $products[$i]['G'],
								":days_for_shipment" => $products[$i]['H'],
								":total_carat_weight" => $products[$i]['I'],
								":no_of_stones" => $products[$i]['J'],
								":diamond_shape" => $products[$i]['K'],
								":clarity" => $products[$i]['L'],
								":color" => $products[$i]['M'],
								":material" => $products[$i]['N'],
								":height" => $products[$i]['O'],
								":width" => $products[$i]['P'],
								":length" => $products[$i]['Q'],
								":country_id" => $products[$i]['R'],
								":images" => "",
								":description" => $products[$i]['V']
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
								":company_id" => $company_id,
								":internal_id" => $products[$i]['C'],
								":product_name" => $products[$i]['D'],
								":pieces_in_stock" => $products[$i]['G'],
								":days_for_shipment" => $products[$i]['H'],
								":total_carat_weight" => $products[$i]['I'],
								":no_of_stones" => $products[$i]['J'],
								":diamond_shape" => $products[$i]['K'],
								":clarity" => $products[$i]['L'],
								":color" => $products[$i]['M'],
								":material" => $products[$i]['N'],
								":height" => $products[$i]['O'],
								":width" => $products[$i]['P'],
								":length" => $products[$i]['Q'],
								":country_id" => $products[$i]['R'],
								":images" => "",
								":description" => $products[$i]['V']
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
								":company_id" => $company_id,
								":internal_id" => $products[$i]['C'],
								":product_name" => $products[$i]['D'],
								":pieces_in_stock" => $products[$i]['G'],
								":days_for_shipment" => $products[$i]['H'],
								":total_carat_weight" => $products[$i]['I'],
								":no_of_stones" => $products[$i]['J'],
								":diamond_shape" => $products[$i]['K'],
								":clarity" => $products[$i]['L'],
								":color" => $products[$i]['M'],
								":material" => $products[$i]['N'],
								":height" => $products[$i]['O'],
								":width" => $products[$i]['P'],
								":length" => $products[$i]['Q'],
								":country_id" => $products[$i]['R'],
								":images" => "",
								":description" => $products[$i]['V']
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
					$imageArray = explode(",", 	$products[$i]['U']);

					if ( !empty($products[$i]['U']) ) {
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

			if ( sizeof($products[1]) !== 22 ) {
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
			if ( !isset($products[1]['I']) || $products[1]['I'] !== "Total carat weight" ){
				$error .= "Invalid Column: <strong>" . $products[1]['I'] . "</strong><br>";
			}
			if ( !isset($products[1]['J']) || $products[1]['J'] !== "No. of stones" ){
				$error .= "Invalid Column: <strong>" . $products[1]['J'] . "</strong><br>";
			}
			if ( !isset($products[1]['K']) || $products[1]['K'] !== "Diamond Shape" ){
				$error .= "Invalid Column: <strong>" . $products[1]['K'] . "</strong><br>";
			}
			if ( !isset($products[1]['L']) || $products[1]['L'] !== "Clarity" ){
				$error .= "Invalid Column: <strong>" . $products[1]['L'] . "</strong><br>";
			}
			if ( !isset($products[1]['M']) || $products[1]['M'] !== "Color" ){
				$error .= "Invalid Column: <strong>" . $products[1]['M'] . "</strong><br>";
			}
			if ( !isset($products[1]['N']) || $products[1]['N'] !== "Material" ){
				$error .= "Invalid Column: <strong>" . $products[1]['N'] . "</strong><br>";
			}
			if ( !isset($products[1]['O']) || $products[1]['O'] !== "Height" ){
				$error .= "Invalid Column: <strong>" . $products[1]['O'] . "</strong><br>";
			}
			if ( !isset($products[1]['P']) || $products[1]['P'] !== "Width" ){
				$error .= "Invalid Column: <strong>" . $products[1]['P'] . "</strong><br>";
			}
			if ( !isset($products[1]['Q']) || $products[1]['Q'] !== "Length" ){
				$error .= "Invalid Column: <strong>" . $products[1]['Q'] . "</strong><br>";
			}
			if ( !isset($products[1]['R']) || $products[1]['R'] !== "Country Id" ){
				$error .= "Invalid Column: <strong>" . $products[1]['R'] . "</strong><br>";
			}
			if ( !isset($products[1]['S']) || $products[1]['S'] !== "Ring subcategory" ){
				$error .= "Invalid Column: <strong>" . $products[1]['S'] . "</strong><br>";
			}
			if ( !isset($products[1]['T']) || $products[1]['T'] !== "Ring size" ){
				$error .= "Invalid Column: <strong>" . $products[1]['T'] . "</strong><br>";
			}
			if ( !isset($products[1]['U']) || $products[1]['U'] !== "Images (comma \",\" separated)" ){
				$error .= "Invalid Column: <strong>" . $products[1]['U'] . "</strong><br>";
			}
			if ( !isset($products[1]['V']) || $products[1]['V'] !== "Description" ) {
				$error .= "Invalid Column: <strong>" . $products[1]['V'] . "</strong><br>";
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
				if ( !in_array($products[$i]['L'], $acceptedClarity) ) {
					$result = [];
					array_push($result, 'failure');
					array_push($result, $products[$i]['D']);
					array_push($result, "Invalid Clarity: " . $products[$i]['J']);
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
								$valuesDB = getCompanyCode($resultValues['company_id'], $pdo) . $resultValues['category'] . $resultValues['internal_id'] . $resultValues['product_name'] . $resultValues['item_value'] . $resultValues['discount'] . $resultValues['pieces_in_stock'] . $resultValues['days_for_shipment'] . $resultValues['total_carat_weight'] . $resultValues['no_of_stones'] . $resultValues['diamond_shape'] . $resultValues['clarity'] . $resultValues['color'] . $resultValues['material'] . $resultValues['height'] . $resultValues['width'] . $resultValues['length'] . $resultValues['country_id'] . $resultValues['images_delta'] . $resultValues['description'] . $resultValues['ring_size'] . $resultValues['ring_subcategory'];

								$valuesSQL = $products[$i]['A'] . $products[$i]['B'] . $internalID . $products[$i]['D'] . $products[$i]['E'] . $products[$i]['F'] . $products[$i]['G'] . $products[$i]['H'] . $products[$i]['I'] . $products[$i]['J'] . $products[$i]['K'] . $products[$i]['L'] . $products[$i]['M'] . $products[$i]['N'] . $products[$i]['O'] . $products[$i]['P'] . $products[$i]['Q'] . $products[$i]['R'] . $products[$i]['U'] . $products[$i]['V'] . $products[$i]['T'] . $products[$i]['S'];

								$hashDB = strtoupper(hash("md5", $valuesDB ));


								$hashSQL = strtoupper(hash("md5", $valuesSQL ));
								
								#for Rings (has column S T and U)
								#$hashSQL = strtoupper(hash("md5", $products[$i]['A'] . $products[$i]['B'] . $internalID . $products[$i]['D'] . $products[$i]['F'] . $products[$i]['G'] . $products[$i]['H'] . $products[$i]['I'] . $products[$i]['J'] . $products[$i]['K'] . $products[$i]['L'] . $products[$i]['M'] . $products[$i]['N'] . $products[$i]['O'] . $products[$i]['P'] . $products[$i]['Q'] . $products[$i]['R'] . $products[$i]['S'] . $products[$i]['T'] . $products[$i]['U'] . $products[$i]['V'] ));

								#$resultStatus = "DB: " . getCompanyCode($resultValues['company_id'], $pdo) . "<br>";
								#$resultStatus .= "SQL: " . $products[$i]['A'];
								if ( $hashDB == $hashSQL ) {
									$resultMessage = "neutral";
									$resultStatus = "Duplicate Entry - Skipping";
									#$resultStatus .= json_encode($valuesDB);
									#$resultStatus .= json_encode($valuesSQL);
								} else {
									$resultMessage = "success";
									$resultStatus = "Product Updated";
									#$resultStatus .= json_encode($valuesDB);
									#$resultStatus .= json_encode($valuesSQL);
									
									$returnMessage = updateImportZipItem($pdo, $resultValues['unique_key'], $products[$i], 1, $_GET['timeToken'], $__MAINDOMAIN__, $__IMPORT_IMAGE_RES__);

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
								$valuesDB = getCompanyCode($resultValues['company_id'], $pdo) . $resultValues['category'] . $resultValues['internal_id'] . $resultValues['product_name'] . $resultValues['item_value'] . $resultValues['discount'] . $resultValues['pieces_in_stock'] . $resultValues['days_for_shipment'] . $resultValues['total_carat_weight'] . $resultValues['no_of_stones'] . $resultValues['diamond_shape'] . $resultValues['clarity'] . $resultValues['color'] . $resultValues['material'] . $resultValues['height'] . $resultValues['width'] . $resultValues['length'] . $resultValues['country_id'] . $resultValues['images_delta'] . $resultValues['description'];

								$valuesSQL = $products[$i]['A'] . $products[$i]['B'] . $internalID . $products[$i]['D'] . $products[$i]['E'] . $products[$i]['F'] . $products[$i]['G'] . $products[$i]['H'] . $products[$i]['I'] . $products[$i]['J'] . $products[$i]['K'] . $products[$i]['L'] . $products[$i]['M'] . $products[$i]['N'] . $products[$i]['O'] . $products[$i]['P'] . $products[$i]['Q'] . $products[$i]['R'] . $products[$i]['U'] . $products[$i]['V'];

								$hashDB = strtoupper(hash("md5", $valuesDB ));


								$hashSQL = strtoupper(hash("md5", $valuesSQL ));
								
								#for Rings (has column S T and U)
								#$hashSQL = strtoupper(hash("md5", $products[$i]['A'] . $products[$i]['B'] . $internalID . $products[$i]['D'] . $products[$i]['F'] . $products[$i]['G'] . $products[$i]['H'] . $products[$i]['I'] . $products[$i]['J'] . $products[$i]['K'] . $products[$i]['L'] . $products[$i]['M'] . $products[$i]['N'] . $products[$i]['O'] . $products[$i]['P'] . $products[$i]['Q'] . $products[$i]['R'] . $products[$i]['S'] . $products[$i]['T'] . $products[$i]['U'] . $products[$i]['V'] ));

								#$resultStatus = "DB: " . getCompanyCode($resultValues['company_id'], $pdo) . "<br>";
								#$resultStatus .= "SQL: " . $products[$i]['A'];
								if ( $hashDB == $hashSQL ) {
									$resultMessage = "neutral";
									$resultStatus = "Duplicate Entry - Skipping";
									#$resultStatus .= json_encode($valuesDB);
									#$resultStatus .= json_encode($valuesSQL);
								} else {
									$resultMessage = "success";
									$resultStatus = "Product Updated";
									#$resultStatus .= json_encode($valuesDB);
									#$resultStatus .= json_encode($valuesSQL);
									
									$returnMessage = updateImportZipItem($pdo, $resultValues['unique_key'], $products[$i], 1, $_GET['timeToken'], $__MAINDOMAIN__, $__IMPORT_IMAGE_RES__);

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
								$valuesDB = getCompanyCode($resultValues['company_id'], $pdo) . $resultValues['category'] . $resultValues['internal_id'] . $resultValues['product_name'] . $resultValues['item_value'] . $resultValues['discount'] . $resultValues['pieces_in_stock'] . $resultValues['days_for_shipment'] . $resultValues['total_carat_weight'] . $resultValues['no_of_stones'] . $resultValues['diamond_shape'] . $resultValues['clarity'] . $resultValues['color'] . $resultValues['material'] . $resultValues['height'] . $resultValues['width'] . $resultValues['length'] . $resultValues['country_id'] . $resultValues['images_delta'] . $resultValues['description'];

								$valuesSQL = $products[$i]['A'] . $products[$i]['B'] . $internalID . $products[$i]['D'] . $products[$i]['E'] . $products[$i]['F'] . $products[$i]['G'] . $products[$i]['H'] . $products[$i]['I'] . $products[$i]['J'] . $products[$i]['K'] . $products[$i]['L'] . $products[$i]['M'] . $products[$i]['N'] . $products[$i]['O'] . $products[$i]['P'] . $products[$i]['Q'] . $products[$i]['R'] . $products[$i]['U'] . $products[$i]['V'];

								$hashDB = strtoupper(hash("md5", $valuesDB ));


								$hashSQL = strtoupper(hash("md5", $valuesSQL ));
								
								#for Rings (has column S T and U)
								#$hashSQL = strtoupper(hash("md5", $products[$i]['A'] . $products[$i]['B'] . $internalID . $products[$i]['D'] . $products[$i]['F'] . $products[$i]['G'] . $products[$i]['H'] . $products[$i]['I'] . $products[$i]['J'] . $products[$i]['K'] . $products[$i]['L'] . $products[$i]['M'] . $products[$i]['N'] . $products[$i]['O'] . $products[$i]['P'] . $products[$i]['Q'] . $products[$i]['R'] . $products[$i]['S'] . $products[$i]['T'] . $products[$i]['U'] . $products[$i]['V'] ));

								#$resultStatus = "DB: " . getCompanyCode($resultValues['company_id'], $pdo) . "<br>";
								#$resultStatus .= "SQL: " . $products[$i]['A'];
								if ( $hashDB == $hashSQL ) {
									$resultMessage = "neutral";
									$resultStatus = "Duplicate Entry - Skipping";
									#$resultStatus .= json_encode($valuesDB);
									#$resultStatus .= json_encode($valuesSQL);
								} else {
									$resultMessage = "success";
									$resultStatus = "Product Updated";
									#$resultStatus .= json_encode($valuesDB);
									#$resultStatus .= json_encode($valuesSQL);
									
									$returnMessage = updateImportZipItem($pdo, $resultValues['unique_key'], $products[$i], 1, $_GET['timeToken'], $__MAINDOMAIN__, $__IMPORT_IMAGE_RES__);

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
								$valuesDB = getCompanyCode($resultValues['company_id'], $pdo) . $resultValues['category'] . $resultValues['internal_id'] . $resultValues['product_name'] . $resultValues['item_value'] . $resultValues['discount'] . $resultValues['pieces_in_stock'] . $resultValues['days_for_shipment'] . $resultValues['total_carat_weight'] . $resultValues['no_of_stones'] . $resultValues['diamond_shape'] . $resultValues['clarity'] . $resultValues['color'] . $resultValues['material'] . $resultValues['height'] . $resultValues['width'] . $resultValues['length'] . $resultValues['country_id'] . $resultValues['images_delta'] . $resultValues['description'];

								$valuesSQL = $products[$i]['A'] . $products[$i]['B'] . $internalID . $products[$i]['D'] . $products[$i]['E'] . $products[$i]['F'] . $products[$i]['G'] . $products[$i]['H'] . $products[$i]['I'] . $products[$i]['J'] . $products[$i]['K'] . $products[$i]['L'] . $products[$i]['M'] . $products[$i]['N'] . $products[$i]['O'] . $products[$i]['P'] . $products[$i]['Q'] . $products[$i]['R'] . $products[$i]['U'] . $products[$i]['V'];

								$hashDB = strtoupper(hash("md5", $valuesDB ));


								$hashSQL = strtoupper(hash("md5", $valuesSQL ));
								
								#for Rings (has column S T and U)
								#$hashSQL = strtoupper(hash("md5", $products[$i]['A'] . $products[$i]['B'] . $internalID . $products[$i]['D'] . $products[$i]['F'] . $products[$i]['G'] . $products[$i]['H'] . $products[$i]['I'] . $products[$i]['J'] . $products[$i]['K'] . $products[$i]['L'] . $products[$i]['M'] . $products[$i]['N'] . $products[$i]['O'] . $products[$i]['P'] . $products[$i]['Q'] . $products[$i]['R'] . $products[$i]['S'] . $products[$i]['T'] . $products[$i]['U'] . $products[$i]['V'] ));

								#$resultStatus = "DB: " . getCompanyCode($resultValues['company_id'], $pdo) . "<br>";
								#$resultStatus .= "SQL: " . $products[$i]['A'];
								if ( $hashDB == $hashSQL ) {
									$resultMessage = "neutral";
									$resultStatus = "Duplicate Entry - Skipping";
									#$resultStatus .= json_encode($valuesDB);
									#$resultStatus .= json_encode($valuesSQL);
								} else {
									$resultMessage = "success";
									$resultStatus = "Product Updated";
									#$resultStatus .= json_encode($valuesDB);
									#$resultStatus .= json_encode($valuesSQL);
									
									$returnMessage = updateImportZipItem($pdo, $resultValues['unique_key'], $products[$i], 1, $_GET['timeToken'], $__MAINDOMAIN__, $__IMPORT_IMAGE_RES__);

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
								$valuesDB = getCompanyCode($resultValues['company_id'], $pdo) . $resultValues['category'] . $resultValues['internal_id'] . $resultValues['product_name'] . $resultValues['item_value'] . $resultValues['discount'] . $resultValues['pieces_in_stock'] . $resultValues['days_for_shipment'] . $resultValues['total_carat_weight'] . $resultValues['no_of_stones'] . $resultValues['diamond_shape'] . $resultValues['clarity'] . $resultValues['color'] . $resultValues['material'] . $resultValues['height'] . $resultValues['width'] . $resultValues['length'] . $resultValues['country_id'] . $resultValues['images_delta'] . $resultValues['description'];

								$valuesSQL = $products[$i]['A'] . $products[$i]['B'] . $internalID . $products[$i]['D'] . $products[$i]['E'] . $products[$i]['F'] . $products[$i]['G'] . $products[$i]['H'] . $products[$i]['I'] . $products[$i]['J'] . $products[$i]['K'] . $products[$i]['L'] . $products[$i]['M'] . $products[$i]['N'] . $products[$i]['O'] . $products[$i]['P'] . $products[$i]['Q'] . $products[$i]['R'] . $products[$i]['U'] . $products[$i]['V'];

								$hashDB = strtoupper(hash("md5", $valuesDB ));


								$hashSQL = strtoupper(hash("md5", $valuesSQL ));
								
								#for Rings (has column S T and U)
								#$hashSQL = strtoupper(hash("md5", $products[$i]['A'] . $products[$i]['B'] . $internalID . $products[$i]['D'] . $products[$i]['F'] . $products[$i]['G'] . $products[$i]['H'] . $products[$i]['I'] . $products[$i]['J'] . $products[$i]['K'] . $products[$i]['L'] . $products[$i]['M'] . $products[$i]['N'] . $products[$i]['O'] . $products[$i]['P'] . $products[$i]['Q'] . $products[$i]['R'] . $products[$i]['S'] . $products[$i]['T'] . $products[$i]['U'] . $products[$i]['V'] ));

								#$resultStatus = "DB: " . getCompanyCode($resultValues['company_id'], $pdo) . "<br>";
								#$resultStatus .= "SQL: " . $products[$i]['A'];
								if ( $hashDB == $hashSQL ) {
									$resultMessage = "neutral";
									$resultStatus = "Duplicate Entry - Skipping";
									#$resultStatus .= json_encode($valuesDB);
									#$resultStatus .= json_encode($valuesSQL);
								} else {
									$resultMessage = "success";
									$resultStatus = "Product Updated";
									#$resultStatus .= json_encode($valuesDB);
									#$resultStatus .= json_encode($valuesSQL);
									
									$returnMessage = updateImportZipItem($pdo, $resultValues['unique_key'], $products[$i], 1, $_GET['timeToken'], $__MAINDOMAIN__, $__IMPORT_IMAGE_RES__);

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
							echo json_encode($result);

							return;
						}
						break;
					}
				}
				

					$company_id = "0";
					if ( isset($_SESSION['import_company_id_zip']) ) {
						$company_id = $_SESSION['import_company_id_zip'];
					}

					$company_id = getCompanyID($products[$i]['A'], $pdo);

					$uniqueKey = generateUniqueKey();
					
					while ( checkKey($uniqueKey, $pdo) ) {
						$uniqueKey = generateUniqueKey();
					}

					if ( empty($products[$i]['V']) ) {
						$products[$i]['V'] = "-";
					}


					$addItem = $pdo->prepare("INSERT INTO `items` (`unique_key`, `item_name`, `item_value`, `discount`, `category`, `featured`, images_delta, `date_added`) VALUES (:unique_key, :product_name, :product_price, :discount, :category, 0, :images_delta, NOW())");
						$addItem->execute(array(
							":unique_key" => $uniqueKey,
							":product_name" => $products[$i]['D'],
							":product_price" => $products[$i]['E'],
							":discount" => $products[$i]['F'],
							":category" => $products[$i]['B'],
							":images_delta" => $products[$i]['U']
						));

					switch ($products[$i]['B']) {
						case 1: {
							$addInfo = $pdo->prepare("INSERT INTO `rings` 
								(`unique_key`, `company_id`, `internal_id`, `product_name`, `pieces_in_stock`, `days_for_shipment`, `total_carat_weight`, `no_of_stones`, `diamond_shape`, `clarity`, `color`, `material`, `height`, `width`, `length`, `country_id`, `images`, `description`, `ring_subcategory`, `ring_size`) 
								VALUES 
								(:unique_key, :company_id, :internal_id, :product_name, :pieces_in_stock, :days_for_shipment, :total_carat_weight, :no_of_stones, :diamond_shape, :clarity, :color, :material, :height, :width, :length, :country_id, :images, :description, :ring_subcategory, :ring_size)");
							$addInfo->execute(array(
								":unique_key" => $uniqueKey,
								":company_id" => $company_id,
								":internal_id" => $products[$i]['C'],
								":product_name" => $products[$i]['D'],
								":pieces_in_stock" => $products[$i]['G'],
								":days_for_shipment" => $products[$i]['H'],
								":total_carat_weight" => $products[$i]['I'],
								":no_of_stones" => $products[$i]['J'],
								":diamond_shape" => $products[$i]['K'],
								":clarity" => $products[$i]['L'],
								":color" => $products[$i]['M'],
								":material" => $products[$i]['N'],
								":height" => $products[$i]['O'],
								":width" => $products[$i]['P'],
								":length" => $products[$i]['Q'],
								":country_id" => $products[$i]['R'],
								":images" => "",
								":description" => $products[$i]['V'],
								":ring_subcategory" => $products[$i]['S'],
								":ring_size" => $products[$i]['T']
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
								":company_id" => $company_id,
								":internal_id" => $products[$i]['C'],
								":product_name" => $products[$i]['D'],
								":pieces_in_stock" => $products[$i]['G'],
								":days_for_shipment" => $products[$i]['H'],
								":total_carat_weight" => $products[$i]['I'],
								":no_of_stones" => $products[$i]['J'],
								":diamond_shape" => $products[$i]['K'],
								":clarity" => $products[$i]['L'],
								":color" => $products[$i]['M'],
								":material" => $products[$i]['N'],
								":height" => $products[$i]['O'],
								":width" => $products[$i]['P'],
								":length" => $products[$i]['Q'],
								":country_id" => $products[$i]['R'],
								":images" => "",
								":description" => $products[$i]['V']
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
								":company_id" => $company_id,
								":internal_id" => $products[$i]['C'],
								":product_name" => $products[$i]['D'],
								":pieces_in_stock" => $products[$i]['G'],
								":days_for_shipment" => $products[$i]['H'],
								":total_carat_weight" => $products[$i]['I'],
								":no_of_stones" => $products[$i]['J'],
								":diamond_shape" => $products[$i]['K'],
								":clarity" => $products[$i]['L'],
								":color" => $products[$i]['M'],
								":material" => $products[$i]['N'],
								":height" => $products[$i]['O'],
								":width" => $products[$i]['P'],
								":length" => $products[$i]['Q'],
								":country_id" => $products[$i]['R'],
								":images" => "",
								":description" => $products[$i]['V']
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
								":company_id" => $company_id,
								":internal_id" => $products[$i]['C'],
								":product_name" => $products[$i]['D'],
								":pieces_in_stock" => $products[$i]['G'],
								":days_for_shipment" => $products[$i]['H'],
								":total_carat_weight" => $products[$i]['I'],
								":no_of_stones" => $products[$i]['J'],
								":diamond_shape" => $products[$i]['K'],
								":clarity" => $products[$i]['L'],
								":color" => $products[$i]['M'],
								":material" => $products[$i]['N'],
								":height" => $products[$i]['O'],
								":width" => $products[$i]['P'],
								":length" => $products[$i]['Q'],
								":country_id" => $products[$i]['R'],
								":images" => "",
								":description" => $products[$i]['V']
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
								":company_id" => $company_id,
								":internal_id" => $products[$i]['C'],
								":product_name" => $products[$i]['D'],
								":pieces_in_stock" => $products[$i]['G'],
								":days_for_shipment" => $products[$i]['H'],
								":total_carat_weight" => $products[$i]['I'],
								":no_of_stones" => $products[$i]['J'],
								":diamond_shape" => $products[$i]['K'],
								":clarity" => $products[$i]['L'],
								":color" => $products[$i]['M'],
								":material" => $products[$i]['N'],
								":height" => $products[$i]['O'],
								":width" => $products[$i]['P'],
								":length" => $products[$i]['Q'],
								":country_id" => $products[$i]['R'],
								":images" => "",
								":description" => $products[$i]['V']
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
					$imageArray = explode(",", 	$products[$i]['U']);

					if ( !empty($products[$i]['U']) ) {
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

	#Adding Columns
	$outputExcel->getActiveSheet()->getStyle('A1:V1')->getFont()->setBold(true);
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
			} default: {
				echo '<div class="alert alert-error">Fatal Error: Invalid Category '. $item['category'].' for item <strong>'. $item['item_name'] .'</strong></div>';
				return;
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
				$numImg .= $__MAINDOMAIN__ . "images/images/" . $img . ",";
			}
		}


		$outputExcel->getActiveSheet()->setCellValue('A' . $row , getCompanyCode($itemInfo['company_id'], $pdo));
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
		$outputExcel->getActiveSheet()->setCellValue('U' . $row , trim($numImg, ","));
		$outputExcel->getActiveSheet()->setCellValue('V' . $row , $itemInfo['description']);


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

	#Adding Columns
	$outputExcel->getActiveSheet()->getStyle('A1:V1')->getFont()->setBold(true);
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

			if ( !isset($itemInfo['ring_subcategory']) ) {
				$itemInfo['ring_subcategory'] = $itemInfo['ring_size'] = "ITEM_NOT_RING";
			}

			//echo $itemInfo['id'];

			$numImg = "";

			$imgArray = explode(",", $itemInfo['images']);

			foreach ( $imgArray as $img ) {
				if ( !empty($img) ) {
					$zipExport->addFile('../../images/images/' . $img , "images/" . $img);
				}
			}


			$outputExcel->getActiveSheet()->setCellValue('A' . $row , getCompanyCode($itemInfo['company_id'], $pdo));
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
			$outputExcel->getActiveSheet()->setCellValue('U' . $row , trim($itemInfo['images'], ","));
			$outputExcel->getActiveSheet()->setCellValue('V' . $row , $itemInfo['description']);


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

	#Adding Columns
	$outputExcel->getActiveSheet()->getStyle('A1:V1')->getFont()->setBold(true);
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

		if ( !isset($itemInfo['ring_subcategory']) ) {
			$itemInfo['ring_subcategory'] = $itemInfo['ring_size'] = "ITEM_NOT_RING";
		}

		$numImg = "";

		$imgArray = explode(",", $itemInfo['images']);

		foreach ( $imgArray as $img ) {
			if ( !empty($img) ) {
				$numImg .=  $__MAINDOMAIN__ . "images/images/" . $img . ",";
			}
		}


		$outputExcel->getActiveSheet()->setCellValue('A' . $row , getCompanyCode($itemInfo['company_id'], $pdo));
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
		$outputExcel->getActiveSheet()->setCellValue('U' . $row , trim($numImg,","));
		$outputExcel->getActiveSheet()->setCellValue('V' . $row , $itemInfo['description']);


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
	$outputExcel->getActiveSheet()->getStyle('A1:V1')->getFont()->setBold(true);
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

			if ( !isset($itemInfo['ring_subcategory']) ) {
				$itemInfo['ring_subcategory'] = $itemInfo['ring_size'] = "ITEM_NOT_RING";
			}

			//echo $itemInfo['id'];

			$numImg = "";

			$imgArray = explode(",", $itemInfo['images']);

			foreach ( $imgArray as $img ) {
				if ( !empty($img) ) {
					$zipExport->addFile('../../images/images/' . $img , "images/" . $img);
				}
			}


			$outputExcel->getActiveSheet()->setCellValue('A' . $row , getCompanyCode($itemInfo['company_id'], $pdo));
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
			$outputExcel->getActiveSheet()->setCellValue('U' . $row , trim($itemInfo['images'], ","));
			$outputExcel->getActiveSheet()->setCellValue('V' . $row , $itemInfo['description']);


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
	$getSubs = $pdo->prepare("SELECT * FROM `subscribers`");
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
		$mail->Body = file_get_contents('./newsletter/sample.html');
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

	#Adding Columns
	$outputExcel->getActiveSheet()->getStyle('A1:V1')->getFont()->setBold(true);
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
		echo json_encode($getSupplier->fetch(PDO::FETCH_ASSOC));
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
		$outputExcel->getActiveSheet()->setTitle('ring_subcategory');
		$outputExcel->getActiveSheet()->getStyle('A1:B1')->getFont()->setBold(true);
		$outputExcel->getActiveSheet()->setCellValue('A1', 'id');
		$outputExcel->getActiveSheet()->setCellValue('B1', 'category');

		$getCategories = $pdo->prepare("SELECT * FROM `ring_subcategory`");
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

		$getCategories = $pdo->prepare("SELECT * FROM `country_vat`");
		$getCategories->execute();
		
		$outputExcel->getActiveSheet()->setCellValue('A2', "1");
		$outputExcel->getActiveSheet()->setCellValue('B2', "White Stone");
		
		$outputExcel->getActiveSheet()->setCellValue('A3', "2");
		$outputExcel->getActiveSheet()->setCellValue('B3', "Colored Stone");

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