<?php
  if (!isset($_GET['id'])) {
    die();
  }

  if ( session_status() == PHP_SESSION_NONE ) {
    session_start();
  }

  include '../conf/config.php';

  $fetch = $pdo->prepare("SELECT * FROM `items` WHERE `unique_key` = :key");
  $fetch->execute(array(":key" => $_GET['id']));

  if ( $fetch->rowCount() > 0 ) {
    $item = $fetch->fetch(PDO::FETCH_ASSOC);
	
	switch($item['category']) {
		case 1: {
			$fetchInfo = $pdo->prepare("SELECT * FROM `rings` WHERE `unique_key` = :key");
			$fetchInfo->execute(array(
				":key" => $item['unique_key']
			));
			break;
		}
		case 2: {
			$fetchInfo = $pdo->prepare("SELECT * FROM `earrings` WHERE `unique_key` = :key");
			$fetchInfo->execute(array(
				":key" => $item['unique_key']
			));
			break;
		}
		case 3: {
			$fetchInfo = $pdo->prepare("SELECT * FROM `pendants` WHERE `unique_key` = :key");
			$fetchInfo->execute(array(
				":key" => $item['unique_key']
			));
			break;
		}
		case 4: {
			$fetchInfo = $pdo->prepare("SELECT * FROM `necklaces` WHERE `unique_key` = :key");
			$fetchInfo->execute(array(
				":key" => $item['unique_key']
			));
			break;
		}
		case 5: {
			$fetchInfo = $pdo->prepare("SELECT * FROM `bracelets` WHERE `unique_key` = :key");
			$fetchInfo->execute(array(
				":key" => $item['unique_key']
			));
			break;
		}
	}

	$itemInfo = $fetchInfo->fetch(PDO::FETCH_ASSOC);

	$array = array_merge($item, $itemInfo);
    echo json_encode($array);
  }
  else {
    echo var_dump("Nothing Found");
  }
?>