<?php
if ( session_status() == PHP_SESSION_NONE ) {
  session_start();
}
if ( !isset($_SESSION['modSession']) ) {
	 header ('Location: ../../index.php');
	 exit();
}
if ( isset($_SESSION['modSession']) ) {
	if ( !$_SESSION['modSession'] || $_SESSION['admin'] <= 0 ) {
		header ('Location: ../../index.php');
		exit();
	}
}
?>
<!DOCTYPE html>
<html lang="en">
<?php
include '../../conf/config.php';


if ( isset($_POST['featuredAdd']) ) {
	$addFeatured = $pdo->prepare("UPDATE `items` SET `featured` = 1 WHERE `unique_key` = :unique_key");
	$addFeatured->execute(array(":unique_key" => $_POST['featuredAdd']));
} else if ( isset ($_POST['featuredRemove']) ) {
	$removeFeatured = $pdo->prepare("UPDATE `items` SET `featured` = 0 WHERE `unique_key` = :unique_key");
	$removeFeatured->execute(array(":unique_key" => $_POST['featuredRemove']));
} else if ( isset($_POST['removeItem']) ) {
	//echo var_dump($_POST);

	$fetchInfo = $pdo->prepare("SELECT * FROM `items` WHERE `unique_key` = :id");
	$fetchInfo->execute(array(":id" => $_POST['removeItem']));
	$result = $fetchInfo->fetch(PDO::FETCH_ASSOC);

	$removeItem = $pdo->prepare("DELETE FROM `items` WHERE `unique_key` = :id");
	$removeItem->execute(array(":id" => $_POST['removeItem']));

	switch ($result['category']) {
		case 1: {
			$fetchImages = $pdo->prepare("SELECT * FROM `rings` WHERE `unique_key` = :id");
			$fetchImages->execute(array(":id" => $_POST['removeItem']));
			$images = $fetchImages->fetch(PDO::FETCH_ASSOC);
			$images = explode(",", $images['images']);
			$removeItem2 = $pdo->prepare("DELETE FROM `rings` WHERE `unique_key` = :id");
			$removeItem2->execute(array(":id" => $_POST['removeItem']));
			break;
		}
		case 2:	{
			$fetchImages = $pdo->prepare("SELECT * FROM `earrings` WHERE `unique_key` = :id");
			$fetchImages->execute(array(":id" => $_POST['removeItem']));
			$images = $fetchImages->fetch(PDO::FETCH_ASSOC);
			$images = explode(",", $images['images']);
			$removeItem2 = $pdo->prepare("DELETE FROM `earrings` WHERE `unique_key` = :id");
			$removeItem2->execute(array(":id" => $_POST['removeItem']));
			break;
		}
		case 3: {
			$fetchImages = $pdo->prepare("SELECT * FROM `pendants` WHERE `unique_key` = :id");
			$fetchImages->execute(array(":id" => $_POST['removeItem']));
			$images = $fetchImages->fetch(PDO::FETCH_ASSOC);
			$images = explode(",", $images['images']);
			$removeItem2 = $pdo->prepare("DELETE FROM `pendants` WHERE `unique_key` = :id");
			$removeItem2->execute(array(":id" => $_POST['removeItem']));
			break;
		}
		case 4: {
			$fetchImages = $pdo->prepare("SELECT * FROM `necklaces` WHERE `unique_key` = :id");
			$fetchImages->execute(array(":id" => $_POST['removeItem']));
			$images = $fetchImages->fetch(PDO::FETCH_ASSOC);
			$images = explode(",", $images['images']);
			$removeItem2 = $pdo->prepare("DELETE FROM `necklaces` WHERE `unique_key` = :id");
			$removeItem2->execute(array(":id" => $_POST['removeItem']));
			break;
		}
		case 5: {
			$fetchImages = $pdo->prepare("SELECT * FROM `bracelets` WHERE `unique_key` = :id");
			$fetchImages->execute(array(":id" => $_POST['removeItem']));
			$images = $fetchImages->fetch(PDO::FETCH_ASSOC);
			$images = explode(",", $images['images']);
			$removeItem2 = $pdo->prepare("DELETE FROM `bracelets` WHERE `unique_key` = :id");
			$removeItem2->execute(array(":id" => $_POST['removeItem']));
			break;
		}
	}
	foreach ( $images as $image ) {
		if ( $image !== "") {
			//echo var_dump($image);
			$imageFile = "../../images/images/" . $image;
			$imageMDFile = "../../images/images_md/" . $image;
			$imageSMFile = "../../images/images_sm/" . $image;
			if ( file_exists($imageFile) ) {
				unlink($imageFile);
			}
			if ( file_exists($imageMDFile) ) {
				unlink($imageMDFile);
			}
			if ( file_exists($imageSMFile) ) {
				unlink($imageSMFile);
			}
		}
	} 
} else if ( isset($_POST['editItem']) ) {

	//echo var_dump($_POST);
	if ( $_POST['discount'] > 0 ) {
		$discount = $_POST['discount'];
	} else {
		$discount = 0;
	}
	
	//echo var_dump($_POST);
	//echo var_dump($uniqueKey);

	$_POST['product_price'] = str_replace(",", 	".", $_POST['product_price']);
	$editItem = $pdo->prepare("UPDATE `items` SET `item_name` = :name, `item_value` = :value, `discount` = :discount, `category` = :category WHERE `unique_key` = :key");
	$editItem->execute(array(
		":key" => $_POST['unique_key'],
		":name" => $_POST['product_name'],
		":value" => $_POST['product_price'],
		":discount" => floatval($_POST['discount']),
		":category" => $_POST['category']
	));

	switch ($_POST['category']) {
		case 1: {
			$checkInfo = $pdo->prepare("SELECT * FROM `rings` WHERE `unique_key` = :key");
			break;
		}
		case 2:	{
			$checkInfo = $pdo->prepare("SELECT * FROM `earrings` WHERE `unique_key` = :key");
			break;
		}
		case 3: {
			$checkInfo = $pdo->prepare("SELECT * FROM `pendants` WHERE `unique_key` = :key");
			break;
		}
		case 4: {
			$checkInfo = $pdo->prepare("SELECT * FROM `necklaces` WHERE `unique_key` = :key");
			break;
		}
		case 5: {
			$checkInfo = $pdo->prepare("SELECT * FROM `bracelets` WHERE `unique_key` = :key");
			break;
		}
	}
	$checkInfo->execute(array(":key" => $_POST['unique_key']));
	if ( $checkInfo->rowCount() > 0 ) {
		switch ($_POST['category']) {
			case 1: {
				$addInfo = $pdo->prepare("UPDATE `rings` SET `company_id` = :company_id, `internal_id` = :internal_id, `product_name` = :product_name, `pieces_in_stock` = :pieces_in_stock, `days_for_shipment` = :days_for_shipment, `total_carat_weight` = :total_carat_weight, `no_of_stones` = :no_of_stones, `diamond_shape` = :diamond_shape, `clarity` = :clarity, `color` = :color, `material` = :material, `height` = :height, `width` = :width, `length` = :length, `country_id` = :country_id, `description` = :description, `description_french` = :description_french, `ring_subcategory` = :ring_subcategory, `ring_size` = :ring_size, `total_gold_weight` = :total_gold_weight, `color_stone_carat` = :color_stone_carat, `no_of_color_stones` = :no_of_color_stones, `color_stone_shape` = :color_stone_shape, `lab_grown` = :lab_grown, `diamond_color` = :diamond_color WHERE `unique_key` = :unique_key");
				$addInfo->execute(array(
					":unique_key" => $_POST['unique_key'],
					":company_id" => $_POST['company_id'],
					":internal_id" => $_POST['internal_id'],
					":product_name" => $_POST['product_name'],
					":pieces_in_stock" => $_POST['pieces_in_stock'],
					":days_for_shipment" => $_POST['days_for_shipment'],
					":total_carat_weight" => $_POST['total_carat_weight'],
					":no_of_stones" => $_POST['no_of_stones'],
					":diamond_shape" => $_POST['diamond_shape'],
					":clarity" => $_POST['clarity'],
					":color" => $_POST['color'], ":diamond_color" => $_POST['diamond_color'],
					":material" => $_POST['material'],
					":height" => $_POST['height'],
					":width" => $_POST['width'],
					":length" => $_POST['length'],
					":country_id" => $_POST['country_id'],
					":total_gold_weight" => $_POST['total_gold_weight'],
					":color_stone_carat" => floatval($_POST['color_stone_carat']),
					":no_of_color_stones" => $_POST['no_of_color_stones'],
					":color_stone_shape" => intval($_POST['color_stone_shape']),
					":lab_grown" => $_POST['lab_grown'],
					":description" => $_POST['description'], ":description_french" => $_POST["description_french"],
					":ring_subcategory" => $_POST['ring_subcategory'],
					":ring_size" => $_POST['ring_size']));
				
				break;
			}
			case 2:	{
				$addInfo = $pdo->prepare("UPDATE `earrings` SET `company_id` = :company_id, `internal_id` = :internal_id, `product_name` = :product_name, `pieces_in_stock` = :pieces_in_stock, `days_for_shipment` = :days_for_shipment, `total_carat_weight` = :total_carat_weight, `no_of_stones` = :no_of_stones, `diamond_shape` = :diamond_shape, `clarity` = :clarity, `color` = :color, `material` = :material, `height` = :height, `width` = :width, `length` = :length, `country_id` = :country_id, `description` = :description, `description_french` = :description_french, `total_gold_weight` = :total_gold_weight, `color_stone_carat` = :color_stone_carat, `no_of_color_stones` = :no_of_color_stones, `color_stone_shape` = :color_stone_shape, `lab_grown` = :lab_grown, `diamond_color` = :diamond_color WHERE `unique_key` = :unique_key");
				$addInfo->execute(array(
					":unique_key" => $_POST['unique_key'],
					":company_id" => $_POST['company_id'],
					":internal_id" => $_POST['internal_id'],
					":product_name" => $_POST['product_name'],
					":pieces_in_stock" => $_POST['pieces_in_stock'],
					":days_for_shipment" => $_POST['days_for_shipment'],
					":total_carat_weight" => $_POST['total_carat_weight'],
					":no_of_stones" => $_POST['no_of_stones'],
					":diamond_shape" => $_POST['diamond_shape'],
					":clarity" => $_POST['clarity'],
					":color" => $_POST['color'], ":diamond_color" => $_POST['diamond_color'],
					":material" => $_POST['material'],
					":height" => $_POST['height'],
					":width" => $_POST['width'],
					":length" => $_POST['length'],
					":country_id" => $_POST['country_id'],
					":total_gold_weight" => $_POST['total_gold_weight'],
					":color_stone_carat" => floatval($_POST['color_stone_carat']),
					":no_of_color_stones" => $_POST['no_of_color_stones'],
					":color_stone_shape" => intval($_POST['color_stone_shape']),
					":lab_grown" => $_POST['lab_grown'],
					":description" => $_POST['description'], ":description_french" => $_POST["description_french"]));
				break;
			}
			case 3: {
				$addInfo = $pdo->prepare("UPDATE `pendants` SET `company_id` = :company_id, `internal_id` = :internal_id, `product_name` = :product_name, `pieces_in_stock` = :pieces_in_stock, `days_for_shipment` = :days_for_shipment, `total_carat_weight` = :total_carat_weight, `no_of_stones` = :no_of_stones, `diamond_shape` = :diamond_shape, `clarity` = :clarity, `color` = :color, `material` = :material, `height` = :height, `width` = :width, `length` = :length, `country_id` = :country_id, `description` = :description, `description_french` = :description_french, `total_gold_weight` = :total_gold_weight, `color_stone_carat` = :color_stone_carat, `no_of_color_stones` = :no_of_color_stones, `color_stone_shape` = :color_stone_shape, `lab_grown` = :lab_grown, `diamond_color` = :diamond_color WHERE `unique_key` = :unique_key");
				$addInfo->execute(array(
					":unique_key" => $_POST['unique_key'],
					":company_id" => $_POST['company_id'],
					":internal_id" => $_POST['internal_id'],
					":product_name" => $_POST['product_name'],
					":pieces_in_stock" => $_POST['pieces_in_stock'],
					":days_for_shipment" => $_POST['days_for_shipment'],
					":total_carat_weight" => $_POST['total_carat_weight'],
					":no_of_stones" => $_POST['no_of_stones'],
					":diamond_shape" => $_POST['diamond_shape'],
					":clarity" => $_POST['clarity'],
					":color" => $_POST['color'], ":diamond_color" => $_POST['diamond_color'],
					":material" => $_POST['material'],
					":height" => $_POST['height'],
					":width" => $_POST['width'],
					":length" => $_POST['length'],
					":country_id" => $_POST['country_id'],
					":total_gold_weight" => $_POST['total_gold_weight'],
					":color_stone_carat" => floatval($_POST['color_stone_carat']),
					":no_of_color_stones" => $_POST['no_of_color_stones'],
					":color_stone_shape" => intval($_POST['color_stone_shape']),
					":lab_grown" => $_POST['lab_grown'],
					":description" => $_POST['description'], ":description_french" => $_POST["description_french"]));
				break;
			}
			case 4: {
				$addInfo = $pdo->prepare("UPDATE `necklaces` SET `company_id` = :company_id, `internal_id` = :internal_id, `product_name` = :product_name, `pieces_in_stock` = :pieces_in_stock, `days_for_shipment` = :days_for_shipment, `total_carat_weight` = :total_carat_weight, `no_of_stones` = :no_of_stones, `diamond_shape` = :diamond_shape, `clarity` = :clarity, `color` = :color, `material` = :material, `height` = :height, `width` = :width, `length` = :length, `country_id` = :country_id, `description` = :description, `description_french` = :description_french, `total_gold_weight` = :total_gold_weight, `color_stone_carat` = :color_stone_carat, `no_of_color_stones` = :no_of_color_stones, `color_stone_shape` = :color_stone_shape, `lab_grown` = :lab_grown, `diamond_color` = :diamond_color WHERE `unique_key` = :unique_key");
				$addInfo->execute(array(
					":unique_key" => $_POST['unique_key'],
					":company_id" => $_POST['company_id'],
					":internal_id" => $_POST['internal_id'],
					":product_name" => $_POST['product_name'],
					":pieces_in_stock" => $_POST['pieces_in_stock'],
					":days_for_shipment" => $_POST['days_for_shipment'],
					":total_carat_weight" => $_POST['total_carat_weight'],
					":no_of_stones" => $_POST['no_of_stones'],
					":diamond_shape" => $_POST['diamond_shape'],
					":clarity" => $_POST['clarity'],
					":color" => $_POST['color'], ":diamond_color" => $_POST['diamond_color'],
					":material" => $_POST['material'],
					":height" => $_POST['height'],
					":width" => $_POST['width'],
					":length" => $_POST['length'],
					":country_id" => $_POST['country_id'],
					":total_gold_weight" => $_POST['total_gold_weight'],
					":color_stone_carat" => floatval($_POST['color_stone_carat']),
					":no_of_color_stones" => $_POST['no_of_color_stones'],
					":color_stone_shape" => intval($_POST['color_stone_shape']),
					":lab_grown" => $_POST['lab_grown'],
					":description" => $_POST['description'], ":description_french" => $_POST["description_french"]));
				break;
			}
			case 5: {
				$addInfo = $pdo->prepare("UPDATE `bracelets` SET `company_id` = :company_id, `internal_id` = :internal_id, `product_name` = :product_name, `pieces_in_stock` = :pieces_in_stock, `days_for_shipment` = :days_for_shipment, `total_carat_weight` = :total_carat_weight, `no_of_stones` = :no_of_stones, `diamond_shape` = :diamond_shape, `clarity` = :clarity, `color` = :color, `material` = :material, `height` = :height, `width` = :width, `length` = :length, `country_id` = :country_id, `description` = :description, `description_french` = :description_french, `total_gold_weight` = :total_gold_weight, `color_stone_carat` = :color_stone_carat, `no_of_color_stones` = :no_of_color_stones, `color_stone_shape` = :color_stone_shape, `lab_grown` = :lab_grown, `diamond_color` = :diamond_color, `ring_subcategory` = :ring_subcategory WHERE `unique_key` = :unique_key");
				$addInfo->execute(array(
					":unique_key" => $_POST['unique_key'],
					":company_id" => $_POST['company_id'],
					":internal_id" => $_POST['internal_id'],
					":product_name" => $_POST['product_name'],
					":pieces_in_stock" => $_POST['pieces_in_stock'],
					":days_for_shipment" => $_POST['days_for_shipment'],
					":total_carat_weight" => $_POST['total_carat_weight'],
					":no_of_stones" => $_POST['no_of_stones'],
					":diamond_shape" => $_POST['diamond_shape'],
					":clarity" => $_POST['clarity'],
					":color" => $_POST['color'], ":diamond_color" => $_POST['diamond_color'],
					":material" => $_POST['material'],
					":height" => $_POST['height'],
					":width" => $_POST['width'],
					":length" => $_POST['length'],
					":country_id" => $_POST['country_id'],
					":total_gold_weight" => $_POST['total_gold_weight'],
					":color_stone_carat" => floatval($_POST['color_stone_carat']),
					":no_of_color_stones" => $_POST['no_of_color_stones'],
					":color_stone_shape" => intval($_POST['color_stone_shape']),
					":lab_grown" => $_POST['lab_grown'],
					":description" => $_POST['description'], ":description_french" => $_POST["description_french"],
					":ring_subcategory" => $_POST['ring_subcategory']));
				break;
			}
		}
	} else {
	}
} else if ( isset($_POST['bulkManage']) ) {
	//echo var_dump($_POST);
	if ($_POST['bulkManage'] == "feature") {
		while ($checkbox = current($_POST)) {
			if ($checkbox == 'on') {
				$setBulkFeatured = $pdo->prepare("UPDATE `items` SET `featured` = 1 WHERE `unique_key` = :key");
				$setBulkFeatured->execute(array(":key" => key($_POST)));
			}
			next($_POST);
		}
	} else if ($_POST['bulkManage'] == "unfeature") {
		while ($checkbox = current($_POST)) {
			if ($checkbox == 'on') {
				$setBulkFeatured = $pdo->prepare("UPDATE `items` SET `featured` = 0 WHERE `unique_key` = :key");
				$setBulkFeatured->execute(array(":key" => key($_POST)));
			}
			next($_POST);
		}
	} else if ( $_POST['bulkManage'] == "delete") {
		while ( $checkbox = current($_POST)) {
			if ( $checkbox == "on" ) {
				$getItem = $pdo->prepare("SELECT * FROM `items` WHERE `unique_key` = :key");
				$getItem->execute(array(":key" => key($_POST)));

				$result = $getItem->fetch(PDO::FETCH_ASSOC);

				switch ($result['category']) {
					 case 1:{
						$getImageVar = $pdo->prepare("SELECT * FROM `rings` WHERE `unique_key` = :key");
						break;
					} case 2:{
						$getImageVar = $pdo->prepare("SELECT * FROM `earrings` WHERE `unique_key` = :key");
						break;
					} case 3:{
						$getImageVar = $pdo->prepare("SELECT * FROM `pendants` WHERE `unique_key` = :key");
						break;
					} case 4:{
						$getImageVar = $pdo->prepare("SELECT * FROM `necklaces` WHERE `unique_key` = :key");
						break;
					} case 5:{
						$getImageVar = $pdo->prepare("SELECT * FROM `bracelets` WHERE `unique_key` = :key");
						break;
					}
				}

				$getImageVar->execute(array(":key" => key($_POST)));

				$imageVar = $getImageVar->fetch(PDO::FETCH_ASSOC);

				$images = $imageVar['images'];
				$images = explode(",", $images);

				foreach ( $images as $image ) {
					if ( $image !== "") {
						//echo var_dump($image);
						$imageFile = "../../images/images/" . $image;
						$imageMDFile = "../../images/images_md/" . $image;
						$imageSMFile = "../../images/images_sm/" . $image;
						if ( file_exists($imageFile) ) {
							unlink($imageFile);
						}
						if ( file_exists($imageMDFile) ) {
							unlink($imageMDFile);
						}
						if ( file_exists($imageSMFile) ) {
							unlink($imageSMFile);
						}
					}
				}
				switch ($result['category']) {
					case 1: {
						$deleteFromTable = $pdo->prepare("DELETE FROM `rings` WHERE `unique_key` = :key");
						break;
					}
					case 2: {
						$deleteFromTable = $pdo->prepare("DELETE FROM `earrings` WHERE `unique_key` = :key");
						break;
					}
					case 3: {
						$deleteFromTable = $pdo->prepare("DELETE FROM `pendants` WHERE `unique_key` = :key");
						break;
					}
					case 4: {
						$deleteFromTable = $pdo->prepare("DELETE FROM `necklaces` WHERE `unique_key` = :key");
						break;
					}
					case 5: {
						$deleteFromTable = $pdo->prepare("DELETE FROM `bracelets` WHERE `unique_key` = :key");
						break;
					}
				}

				$deleteFromTable->execute(array(":key" => key($_POST)));

				$deleteItem = $pdo->prepare("DELETE FROM `items` WHERE `unique_key` = :key");
				$deleteItem->execute(array(":key" => key($_POST)));

			}
			next($_POST);
		}
	}
} else if ( isset($_POST['removeAll'])) {
	pconsole($_POST['removeAll']);


	$imagePath = '../../images/images/';
	$imageMDPath = '../../images/images_md/';
	$imageSMPath = '../../images/images_sm/';

	$scr = scandir($imagePath);
	$scrMD = scandir($imageMDPath);
	$scrSM = scandir($imageSMPath);

	switch ($_POST['removeAll']) {
		case 'all':{
			$truncateTable = $pdo->prepare("TRUNCATE TABLE `items`");
			$truncateTable1 = $pdo->prepare("TRUNCATE TABLE `rings`");
			$truncateTable2 = $pdo->prepare("TRUNCATE TABLE `earrings`");
			$truncateTable3 = $pdo->prepare("TRUNCATE TABLE `pendants`");
			$truncateTable4 = $pdo->prepare("TRUNCATE TABLE `necklaces`");
			$truncateTable5 = $pdo->prepare("TRUNCATE TABLE `bracelets`");
			$truncateTable->execute();
			$truncateTable1->execute();
			$truncateTable2->execute();
			$truncateTable3->execute();
			$truncateTable4->execute();
			$truncateTable5->execute();
			foreach ( $scr as $file ) {
				if ( strstr($file, "ring_") || strstr($file, "earring_") || strstr($file, "pendant_") || strstr($file, "necklace_") || strstr($file, "bracelet_")  ) {
					unlink($imagePath . $file);
				}
			}
			foreach ( $scrMD as $file ) {
				if ( strstr($file, "ring_") || strstr($file, "earring_") || strstr($file, "pendant_") || strstr($file, "necklace_") || strstr($file, "bracelet_")  ) {
					unlink($imageMDPath . $file);
				}
			}
			foreach ( $scrSM as $file ) {
				if ( strstr($file, "ring_") || strstr($file, "earring_") || strstr($file, "pendant_") || strstr($file, "necklace_") || strstr($file, "bracelet_")  ) {
					unlink($imageSMPath . $file);
				}
			}
			break;
		} case 'rings':{
			$truncateTable = $pdo->prepare("TRUNCATE TABLE `rings`");
			$truncateTable->execute();
			$removeAll = $pdo->prepare("DELETE FROM `items` WHERE `category` = 1");
			$removeAll->execute();

			foreach ( $scr as $file ) {
				if ( strstr($file, "ring_") && !strstr($file, "earring_") ) {
					unlink($imagePath . $file);
				}
			}
			foreach ( $scrMD as $file ) {
				if ( strstr($file, "ring_") && !strstr($file, "earring_") ) {
					unlink($imageMDPath . $file);
				}
			}
			foreach ( $scrSM as $file ) {
				if ( strstr($file, "ring_") && !strstr($file, "earring_") ) {
					unlink($imageSMPath . $file);
				}
			}

			break;
		} case 'earrings':{
			$truncateTable = $pdo->prepare("TRUNCATE TABLE `earrings`");
			$removeAll = $pdo->prepare("DELETE FROM `items` WHERE `category` = 2");
			$removeAll->execute();

			foreach ( $scr as $file ) {
				if ( strstr($file, "earring_") ) {
					unlink($imagePath . $file);
				}
			}
			foreach ( $scrMD as $file ) {
				if ( strstr($file, "earring_") ) {
					unlink($imageMDPath . $file);
				}
			}
			foreach ( $scrSM as $file ) {
				if ( strstr($file, "earring_") ) {
					unlink($imageSMPath . $file);
				}
			}

			break;
		} case 'pendants':{
			$truncateTable = $pdo->prepare("TRUNCATE TABLE `pendants`");
			$removeAll = $pdo->prepare("DELETE FROM `items` WHERE `category` = 3");
			$removeAll->execute();

			foreach ( $scr as $file ) {
				if ( strstr($file, "pendant_") ) {
					unlink($imagePath . $file);
				}
			}
			foreach ( $scrMD as $file ) {
				if ( strstr($file, "pendant_") ) {
					unlink($imageMDPath . $file);
				}
			}
			foreach ( $scrSM as $file ) {
				if ( strstr($file, "pendant_") ) {
					unlink($imageSMPath . $file);
				}
			}

			break;
		} case 'necklaces':{
			$truncateTable = $pdo->prepare("TRUNCATE TABLE `necklaces`");
			$removeAll = $pdo->prepare("DELETE FROM `items` WHERE `category` = 4");
			$removeAll->execute();

			foreach ( $scr as $file ) {
				if ( strstr($file, "necklace_") ) {
					unlink($imagePath . $file);
				}
			}
			foreach ( $scrMD as $file ) {
				if ( strstr($file, "necklace_") ) {
					unlink($imageMDPath . $file);
				}
			}
			foreach ( $scrSM as $file ) {
				if ( strstr($file, "necklace_") ) {
					unlink($imageSMPath . $file);
				}
			}

			break;
		} case 'bracelets':{
			$truncateTable = $pdo->prepare("TRUNCATE TABLE `bracelets`");
			$removeAll = $pdo->prepare("DELETE FROM `items` WHERE `category` = 5");
			$removeAll->execute();

			foreach ( $scr as $file ) {
				if ( strstr($file, "bracelet_") ) {
					unlink($imagePath . $file);
				}
			}
			foreach ( $scrMD as $file ) {
				if ( strstr($file, "bracelet_") ) {
					unlink($imageMDPath . $file);
				}
			}
			foreach ( $scrSM as $file ) {
				if ( strstr($file, "bracelet_") ) {
					unlink($imageSMPath . $file);
				}
			}

			break;
		} 
	}
} else if ( isset($_POST['addItem']) ) {
	pconsole($_FILES);
	pconsole($_POST);
	
	if ( $_POST['discount'] > 0 ) {
		$discount = $_POST['discount'];
	} else {
		$discount = 0;
	}

	$_POST['product_price'] = str_replace(",", 	".", 	$_POST['product_price']);
	
	
	$uniqueKey = generateUniqueKey();
	
	while ( checkKey($uniqueKey, $pdo) ) {
		$uniqueKey = generateUniqueKey();
	}

	pconsole($uniqueKey);

	$checkInternalID = $pdo->prepare("SELECT * FROM `necklaces` WHERE `internal_id` = :intID");
	$checkInternalID->execute(array(":intID" => $_POST['internal_id']));

	if ( $checkInternalID->rowCount() == 0 ) {
		$addInfo = $pdo->prepare("INSERT INTO `necklaces` 
			(`unique_key`, `company_id`, `internal_id`, `product_name`, `pieces_in_stock`, `days_for_shipment`, `total_gold_weight`, `total_carat_weight`, `color_stone_carat`, `no_of_stones`, `no_of_color_stones`, `diamond_shape`, `color_stone_shape`, `clarity`, `color`, `diamond_color`, `material`, `height`, `width`, `length`, `country_id`, `lab_grown`, `images`, `description`, `description_french`, `ring_subcategory`, `gold_quality`, `color_stone_type`) 
			VALUES 
			(:unique_key, :company_id, :internal_id, :product_name, :pieces_in_stock, :days_for_shipment, :total_gold_weight, :total_carat_weight, :color_stone_carat, :no_of_stones, :no_of_color_stones, :diamond_shape, :color_stone_shape, :clarity, :color, :diamond_color, :material, :height, :width, :length, :country_id, :lab_grown, :images, :description, :description_french, :ring_subcategory, :gold_quality, :color_stone_type)");
		$addInfo->execute(array(
			":unique_key" => $uniqueKey,
			":company_id" => $_POST['company_id'],
			":internal_id" => $_POST['internal_id'],
			":product_name" => $_POST['product_name'],
			":pieces_in_stock" => $_POST['pieces_in_stock'],
			":days_for_shipment" => $_POST['days_for_shipment'],
			":total_carat_weight" => $_POST['total_carat_weight'],
			":no_of_stones" => $_POST['no_of_stones'],
			":diamond_shape" => $_POST['diamond_shape'],
			":clarity" => $_POST['clarity'],
			":color" => $_POST['color'], ":diamond_color" => $_POST['diamond_color'],
			":material" => $_POST['material'],
			":height" => $_POST['height'],
			":width" => $_POST['width'],
			":length" => $_POST['length'],
			":country_id" => $_POST['country_id'],
			":images" => "",
			":description" => $_POST['description'], ":description_french" => $_POST["description_french"],
			":total_gold_weight" => $_POST['total_gold_weight'], 
			":color_stone_carat" => floatval($_POST['color_stone_carat']), 
			":no_of_color_stones" => $_POST['no_of_color_stones'], 
			":color_stone_shape" => intval($_POST['color_stone_shape']), 
			":lab_grown" => $_POST['lab_grown'],
			":gold_quality" => $_POST['gold_quality'],
			":color_stone_type" => $_POST['color_stone_type'],
			":ring_subcategory" => $_POST['ring_subcategory']
		));

		$images = "";


		$getitemID = $pdo->prepare("SELECT `id` FROM `necklaces` WHERE `unique_key` = :unique_key");
		$getitemID->execute(array(":unique_key" => $uniqueKey));
		$itemID = $getitemID->fetch(PDO::FETCH_ASSOC);
		$itemID = $itemID['id'];
		
		$numOfImages = sizeof($_FILES['itemImage']['name']);
		for ( $count = 0; $count < $numOfImages; $count++ ) {
			if ( $_FILES['itemImage']['error'][$count] == 0 ) {
					$image_dir = "../../images/";
					$image_ext = pathinfo($image_dir . basename($_FILES['itemImage']['name'][$count]), PATHINFO_EXTENSION);
					$image_file = $image_dir . 'images/necklace_' . $itemID;
					$image_md_file = $image_dir . "images_md/necklace_" . $itemID;
					$image_sm_file = $image_dir . "images_sm/necklace_" . $itemID;

					if ( !is_dir($image_dir . 'images/') ) {
						mkdir($image_dir . 'images/');
					}
					if ( !is_dir($image_dir . 'images_md/') ) {
						mkdir($image_dir . 'images_md/');
					}
					if ( !is_dir($image_dir . 'images_sm/') ) {
						mkdir($image_dir . 'images_sm/');
					}
					
					$check = getimagesize($_FILES['itemImage']['tmp_name'][$count]);
					if ( $check ) {
						if ( file_exists($image_file . "." . $image_ext) ) {
							$i = 1;
							while ( file_exists($image_file . "_" . $i . "." . $image_ext) ) {
								$i++;
							}
							$image_file .= "_" . $i;
							$image_md_file .= "_" . $i; 
							$image_sm_file .= "_" . $i; 
						}
						if ( move_uploaded_file($_FILES['itemImage']['tmp_name'][$count], $image_file . "." . $image_ext) ) {
							create_thumb($image_file . "." . $image_ext, $__IMPORT_IMAGE_RES__['LARGE'], $__IMPORT_IMAGE_RES__['LARGE'], $image_file . '.' . $image_ext);
							create_thumb($image_file . "." . $image_ext, $__IMPORT_IMAGE_RES__['MED'], $__IMPORT_IMAGE_RES__['MED'], $image_md_file . '.' . $image_ext);
							create_thumb($image_file . "." . $image_ext, $__IMPORT_IMAGE_RES__['SMALL'], $__IMPORT_IMAGE_RES__['SMALL'], $image_sm_file . '.' . $image_ext);
						}
					} else {
						echo var_dump("Not Image");
					}
					
					$images .= basename($image_file) . "." . $image_ext . ",";
				}
		}

		pconsole($images);
		$updateItemImages = $pdo->prepare("UPDATE `necklaces` SET `images` = :images WHERE `unique_key` = :unique_key");
		$updateItemImages->execute(array(":images" => $images, ":unique_key" => $uniqueKey));

		$addItem = $pdo->prepare("INSERT INTO `items` (`unique_key`, `item_name`, `item_value`, `discount`, `category`, `featured`, `date_added`) VALUES (:unique_key, :product_name, :product_price, :discount, :category, 0, NOW())");
		$addItem->execute(array(
			":unique_key" => $uniqueKey,
			":product_name" => $_POST['product_name'],
			":product_price" => $_POST['product_price'],
			":discount" => $discount,
			":category" => 4
		));
	}
	
	
	//echo var_dump($uniqueKey);
} else if ( isset($_POST['deleteImage']) ) {
	pconsole($_POST);

	$getCategory = $pdo->prepare("SELECT * FROM `items` WHERE `unique_key` = :key");
	$getCategory->execute(array(":key" => $_POST['unique_key']));

	if ( $getCategory->rowCount() > 0 ) {
		$itemInfo = $getCategory->fetch(PDO::FETCH_ASSOC);
		$getImages = $pdo->prepare("SELECT * FROM ". getCategory($itemInfo['category'], $pdo) ." WHERE `unique_key` = :key");
		$getImages->execute(array(":key" => $_POST['unique_key']));

		if ( $getImages->rowCount() > 0 ) {
			$itemInfo2 = $getImages->fetch(PDO::FETCH_ASSOC);

			$imagesUpdated = str_replace($_POST['deleteImage'] . ",", "", $itemInfo2['images']);

			$updateImages = $pdo->prepare("UPDATE ". getCategory($itemInfo['category'], $pdo) ." SET `images` = :newIMG WHERE `unique_key` = :key");
			$updateImages->execute(array(":newIMG" => $imagesUpdated, ":key" => $_POST['unique_key']));

			if ( file_exists("./../../images/images/" . $_POST['deleteImage']) ) {
				unlink("./../../images/images/" . $_POST['deleteImage']);
			}
			if ( file_exists("./../../images/images_md/" . $_POST['deleteImage']) ) {
				unlink("./../../images/images_md/" . $_POST['deleteImage']);
			}
			if ( file_exists("./../../images/images_sm/" . $_POST['deleteImage']) ) {
				unlink("./../../images/images_sm/" . $_POST['deleteImage']);
			}
		}
	}
} else if ( isset($_POST['filterBy']) ) {
	pconsole($_POST);
	if ( isset($_POST[$_POST['filterBy']]) ) {
		pconsole($_POST[$_POST['filterBy']]);
		$_SESSION[$_POST['filterBy']] = $_POST[$_POST['filterBy']];
	} else {
		if ( isset($_SESSION[$_POST['filterBy']]) ) {
			unset($_SESSION[$_POST['filterBy']]);
		}
	}
} else if ( isset($_POST['clearFilters']) ) {
	if ( isset($_SESSION['diamond_shape']) ) {
		unset($_SESSION['diamond_shape']);
	}
	if ( isset($_SESSION['material']) ) {
		unset($_SESSION['material']);
	}
	if ( isset($_SESSION['color']) ) {
		unset($_SESSION['color']);
	}
	if ( isset($_SESSION['clarity']) ) {
		unset($_SESSION['clarity']);
	}
}
		pconsole($_SESSION);

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
?>
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Necklaces - Admin Panel</title>
    <!-- Bootstrap -->
    <link href="../../css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <!-- Custom Theme Style -->
    <link href="../assets/custom.min.css" rel="stylesheet">
    <link href="../assets/font-awesome.min.css" rel="stylesheet">
    <link href="../assets/admin.css" rel="stylesheet">
  	<link rel="icon" href="../../images/gfx/favicon.png?v=1" type="image/png" sizes="16x16">
  </head>

  <body class="nav-md">
    <div class="container body">
      <div class="main_container" style="background: #607d8b;">
      	<!-- sidebar -->
        <div class="col-md-3 left_col">
          <?php include 'sidebar.php'; ?>
        </div>
		<!-- /sidebar -->
        <!-- top navigation -->
        <div class="top_nav">
          <?php include 'navbar.php'; ?>
        </div>
        <!-- /top navigation -->

        <!-- page content -->
        <div class="right_col" role="main">
        <div>
        <h3><?php

        	echo '<div class="btn-group">
				  <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
				    Necklaces <span class="caret"></span>
				  </button><button class="btn btn-custom" data-toggle="modal" data-target="#promptAddItem">Add</button>
				  <ul class="dropdown-menu">
				    <li><a href="./all_items.php">All</a></li>
				    <li role="separator" class="divider"></li>
				    <li><a href="./rings.php">Rings</a></li>
				    <li><a href="./earrings.php">Earrings</a></li>
				    <li><a href="./pendants.php">Pendants</a></li>
				    <li><a href="./necklaces.php">Necklaces</a></li>
				    <li><a href="./bracelets.php">Bracelets</a></li>
				  </ul>
				</div>';
        	/*if ( isset($_GET['order']) && isset($_GET['filter']) ) {
        		echo '<small>Sorted: <span style="text-transform: capitalize;">'. str_replace("_", " ", $_GET['filter']) .' - '; 
        		echo ($_GET['order'] == "ASC") ? "Ascending" : "Descending";
        		echo '</span></small>';
        	}*/
        	echo '<span style="font-size: 14px; margin: 10px;" id="filtersApplied"></span>';

			$count = $pdo->prepare("SELECT COUNT(*) AS totalRows FROM `items` WHERE `category` = 4");
			$count->execute();
			$totalRows = $count->fetch(PDO::FETCH_ASSOC);
			$totalRows = $totalRows['totalRows'];
			pconsole($totalRows);
			$perPage = 25;
			$pages = $totalRows/$perPage;
			if ( isset($_GET['page']) ) {
				$currentPage = $_GET['page'];
			} else {
				$currentPage = 0;
			}

        	if ( isset($_GET['filter']) && isset($_GET['order']) ) {
        		$filter = $_GET['filter'];
        		$currentOrder = $_GET['order'];
				if ( $_GET['order'] == "DESC" ) {
					$order = "ASC";
				} else {
					$order = "DESC";
				}

        	} else {
        		$filter = "items.id";
        		$order = "ASC";
        		$currentOrder = "DESC";
        	}
			if ( isset($_GET['page']) ) {
				$offset = $_GET['page'] * $perPage;
			} else {
				$offset = 0;
			}

			pconsole($offset);

			$allowedFeatured = 20;


			$countFeatured = $pdo->prepare("SELECT COUNT(`featured`) AS featuredItems FROM `items` WHERE `featured` = 1");
			$countFeatured->execute();

			if ( $countFeatured->rowCount() > 0 ){
				$countFeatured = $countFeatured->fetch(PDO::FETCH_ASSOC);
				if ( $countFeatured['featuredItems'] > $allowedFeatured ) {
        			echo '<div class="alert alert-error" style="font-size: 15px; color: white; text-align: center; position: absolute; top: 5px; margin-left: 200px;">Note: Only the Latest '. $allowedFeatured .' Items are displayed in the Featured Panel, Sorted by Date.<br><br> You have '. $countFeatured['featuredItems'] .' Items Selected as Featured</div>';
				}
			}


    		echo '<h3><small><span id="total_items">' . $totalRows . '</span> Items Found</small>
		        		<form method="post" id="bulkManage" style="float:right">
		                <button class="btn btn-warning" name="bulkManage" value="feature">Add to Featured (<span class="selected-num">0</span>)</button>
		                <button class="btn btn-default" name="bulkManage" value="unfeature">Remove from Featured (<span class="selected-num">0</span>)</button>
		                <a class="btn btn-danger" onclick="bulkRemoveItems()">Delete Selected (<span class="selected-num">0</span>)</a>
		                <a href="javascript:void(0);" class="btn btn-danger" onclick="removeAll(this)" name="necklaces">Delete All</a>
		            </form>
		        </h3>';
        	?></h3>

        	<table class="table table-hover table-custom table-custom-items" >
            	<thead>
            		<?php
            		$typeCaret = "";
            		$idCaret = "";
            		$featuredCaret = "";
            		$internalIDCaret = "";
            		$companyCaret = "";
            		$nameCaret = "";
            		$priceCaret = "";
            		$discountCaret = "";
            		$stockCaret = "";
            		$shipmentCaret = "";
            		$caratWeightCaret = "";
            		$numOfStonesCaret = "";
            		$diamondShapeCaret = "";
            		$clarityCaret = "";
            		$colorCaret = "";
            		$materialCaret = "";
            		$heightCaret = "";
            		$widthCaret = "";
            		$lengthCaret = "";
            		$countryCaret = "";
            		$ringSizeCaret = "";
            		$ringCategoryCaret = "";
            		$dateAddedCaret = "";

            		switch ($filter . " " . $currentOrder) {
            			case 'category DESC': {
            				$typeCaret = '<i class="fa fa-sort-amount-asc"></i>';
            				break;
            			} case 'category ASC': {
            				$typeCaret = '<i class="fa fa-sort-amount-desc"></i>';
            				break;
            			} case 'items.id ASC': {
            				$idCaret = '<i class="fa fa-sort-amount-asc"></i>';
            				break;
            			} case 'items.id DESC': {
            				$idCaret = '<i class="fa fa-sort-amount-desc"></i>';
            				break;
            			} case 'featured ASC': {
            				$featuredCaret = '<i class="fa fa-sort-amount-asc"></i>';
            				break;
            			} case 'featured DESC': {
            				$featuredCaret = '<i class="fa fa-sort-amount-desc"></i>';
            				break;
            			} case 'internal_id ASC': {
            				$internalIDCaret = '<i class="fa fa-sort-amount-asc"></i>';
            				break;
            			} case 'internal_id DESC': {
            				$internalIDCaret = '<i class="fa fa-sort-amount-desc"></i>';
            				break;
            			} case 'company_id ASC': {
            				$companyCaret = '<i class="fa fa-sort-amount-asc"></i>';
            				break;
            			} case 'company_id DESC': {
            				$companyCaret = '<i class="fa fa-sort-amount-desc"></i>';
            				break;
            			} case 'item_name ASC': {
            				$nameCaret = '<i class="fa fa-sort-amount-asc"></i>';
            				break;
            			} case 'item_name DESC': {
            				$nameCaret = '<i class="fa fa-sort-amount-desc"></i>';
            				break;
            			} case 'item_value ASC': {
            				$priceCaret = '<i class="fa fa-sort-amount-asc"></i>';
            				break;
            			} case 'item_value DESC': {
            				$priceCaret = '<i class="fa fa-sort-amount-desc"></i>';
            				break;
            			} case 'discount ASC': {
            				$discountCaret = '<i class="fa fa-sort-amount-asc"></i>';
            				break;
            			} case 'discount DESC': {
            				$discountCaret = '<i class="fa fa-sort-amount-desc"></i>';
            				break;
            			} case 'pieces_in_stock ASC': {
            				$stockCaret = '<i class="fa fa-sort-amount-asc"></i>';
            				break;
            			} case 'pieces_in_stock DESC': {
            				$stockCaret = '<i class="fa fa-sort-amount-desc"></i>';
            				break;
            			} case 'days_for_shipment ASC': {
            				$shipmentCaret = '<i class="fa fa-sort-amount-asc"></i>';
            				break;
            			} case 'days_for_shipment DESC': {
            				$shipmentCaret = '<i class="fa fa-sort-amount-desc"></i>';
            				break;
            			} case 'total_carat_weight ASC': {
            				$caratWeightCaret = '<i class="fa fa-sort-amount-asc"></i>';
            				break;
            			} case 'total_carat_weight DESC': {
            				$caratWeightCaret = '<i class="fa fa-sort-amount-desc"></i>';
            				break;
            			} case 'no_of_stones ASC': {
            				$numOfStonesCaret = '<i class="fa fa-sort-amount-asc"></i>';
            				break;
            			} case 'no_of_stones DESC': {
            				$numOfStonesCaret = '<i class="fa fa-sort-amount-desc"></i>';
            				break;
            			} case 'diamond_shape ASC': {
            				$diamondShapeCaret = '<i class="fa fa-sort-amount-asc"></i>';
            				break;
            			} case 'diamond_shape DESC': {
            				$diamondShapeCaret = '<i class="fa fa-sort-amount-desc"></i>';
            				break;
            			} case 'clarity ASC': {
            				$clarityCaret = '<i class="fa fa-sort-amount-asc"></i>';
            				break;
            			} case 'clarity DESC': {
            				$clarityCaret = '<i class="fa fa-sort-amount-desc"></i>';
            				break;
            			} case 'color ASC': {
            				$colorCaret = '<i class="fa fa-sort-amount-asc"></i>';
            				break;
            			} case 'color DESC': {
            				$colorCaret = '<i class="fa fa-sort-amount-desc"></i>';
            				break;
            			} case 'material ASC': {
            				$materialCaret = '<i class="fa fa-sort-amount-asc"></i>';
            				break;
            			} case 'material DESC': {
            				$materialCaret = '<i class="fa fa-sort-amount-desc"></i>';
            				break;
            			} case 'height ASC': {
            				$heightCaret = '<i class="fa fa-sort-amount-asc"></i>';
            				break;
            			} case 'height DESC': {
            				$heightCaret = '<i class="fa fa-sort-amount-desc"></i>';
            				break;
            			} case 'width ASC': {
            				$widthCaret = '<i class="fa fa-sort-amount-asc"></i>';
            				break;
            			} case 'width DESC': {
            				$widthCaret = '<i class="fa fa-sort-amount-desc"></i>';
            				break;
            			} case 'length ASC': {
            				$lengthCaret = '<i class="fa fa-sort-amount-asc"></i>';
            				break;
            			} case 'length DESC': {
            				$lengthCaret = '<i class="fa fa-sort-amount-desc"></i>';
            				break;
            			} case 'country_id ASC': {
            				$countryCaret = '<i class="fa fa-sort-amount-asc"></i>';
            				break;
            			} case 'country_id DESC': {
            				$countryCaret = '<i class="fa fa-sort-amount-desc"></i>';
            				break;
            			} case 'ring_size ASC': {
            				$ringSizeCaret = '<i class="fa fa-sort-amount-asc"></i>';
            				break;
            			} case 'ring_size DESC': {
            				$ringSizeCaret = '<i class="fa fa-sort-amount-desc"></i>';
            				break;
            			} case 'ring_subcategory ASC': {
            				$ringCategoryCaret = '<i class="fa fa-sort-amount-asc"></i>';
            				break;
            			} case 'ring_subcategory DESC': {
            				$ringCategoryCaret = '<i class="fa fa-sort-amount-desc"></i>';
            				break;
            			} case 'date_added ASC': {
            				$dateAddedCaret = '<i class="fa fa-sort-amount-asc"></i>';
            				break;
            			} case 'date_added DESC': {
            				$dateAddedCaret = '<i class="fa fa-sort-amount-desc"></i>';
            				break;
            			} case 'total_gold_weight ASC': {
            				$dateAddedCaret = '<i class="fa fa-sort-amount-asc"></i>';
            				break;
            			} case 'total_gold_weight DESC': {
            				$dateAddedCaret = '<i class="fa fa-sort-amount-desc"></i>';
            				break;
            			} case 'color_stone_carat ASC': {
            				$dateAddedCaret = '<i class="fa fa-sort-amount-asc"></i>';
            				break;
            			} case 'color_stone_carat DESC': {
            				$dateAddedCaret = '<i class="fa fa-sort-amount-desc"></i>';
            				break;
            			} case 'no_of_color_stones ASC': {
            				$dateAddedCaret = '<i class="fa fa-sort-amount-asc"></i>';
            				break;
            			} case 'no_of_color_stones DESC': {
            				$dateAddedCaret = '<i class="fa fa-sort-amount-desc"></i>';
            				break;
            			} case 'color_stone_shape ASC': {
            				$dateAddedCaret = '<i class="fa fa-sort-amount-asc"></i>';
            				break;
            			} case 'color_stone_shape DESC': {
            				$dateAddedCaret = '<i class="fa fa-sort-amount-desc"></i>';
            				break;
            			} case 'lab_grown ASC': {
            				$dateAddedCaret = '<i class="fa fa-sort-amount-asc"></i>';
            				break;
            			} case 'lab_grown DESC': {
            				$dateAddedCaret = '<i class="fa fa-sort-amount-desc"></i>';
            				break;
            			} default: {

            				break;
            			}
            		}

            		?>
                	<th><input id="masterCheckbox" type="checkbox" onClick="selectAll(this)"></th>
                	<th><?php echo '<a href="?page='. $currentPage .'&filter=category&order='. $order .'">Type '. $typeCaret .'</a>'; ?></th>
                	<th><?php echo '<a href="?page='. $currentPage .'&filter=items.id&order='. $order .'">ID '. $idCaret .'</a>'; ?></th>
                	<th><?php echo '<a href="?page='. $currentPage .'&filter=featured&order='. $order .'">Featured '. $featuredCaret .'</a>'; ?></th>
                	<th>Action</th>
                	<th><?php echo '<a href="?page='. $currentPage .'&filter=internal_id&order='. $order .'">Internal ID '. $internalIDCaret .'</a>'; ?></th>
                	<th><?php echo '<a href="?page='. $currentPage .'&filter=company_id&order='. $order .'">Supplier '. $companyCaret .'</a>'; ?></th>
                	<th><?php echo '<a href="?page='. $currentPage .'&filter=item_name&order='. $order .'">Name '. $nameCaret .'</a>'; ?></th>
                	<th><?php echo '<a href="?page='. $currentPage .'&filter=item_value&order='. $order .'">Price '. $priceCaret .'</a>'; ?></th>
                	<th><?php echo '<a href="?page='. $currentPage .'&filter=discount&order='. $order .'">Discount'. $discountCaret .'</a>'; ?></th>
                	<th><?php echo '<a href="?page='. $currentPage .'&filter=pieces_in_stock&order='. $order .'">Stock'. $stockCaret .'</a>'; ?></th>
                	<th><?php echo '<a href="?page='. $currentPage .'&filter=days_for_shipment&order='. $order .'">Shipment Days'. $shipmentCaret .'</a>'; ?></th>
                	<th><?php echo '<a href="?page='. $currentPage .'&filter=total_gold_weight&order='. $order .'">Gold Weight'. $shipmentCaret .'</a>'; ?></th>
                	<th><?php echo '<a href="?page='. $currentPage .'&filter=total_carat_weight&order='. $order .'">Carat Weight'. $caratWeightCaret .'</a>'; ?></th>
                	<th><?php echo '<a href="?page='. $currentPage .'&filter=color_stone_carat&order='. $order .'">Color Stone Carat'. $caratWeightCaret .'</a>'; ?></th>
                	<th><?php echo '<a href="?page='. $currentPage .'&filter=no_of_stones&order='. $order .'"># of Stones'. $numOfStonesCaret .'</a>'; ?></th>
                	<th><?php echo '<a href="?page='. $currentPage .'&filter=no_of_color_stones&order='. $order .'"># of Colored Stones'. $numOfStonesCaret .'</a>'; ?></th>
                	<th><?php 
                		echo '<a href="?page='. $currentPage .'&filter=diamond_shape&order='. $order .'">Diamond Shape'. $diamondShapeCaret .'</a>';
                		$fetchDiamondShapes = $pdo->prepare("SELECT * FROM `diamond_shape`");
                		$fetchDiamondShapes->execute();

                		if ( $fetchDiamondShapes->rowCount() > 0 ) {

	                		echo '<div class="btn-group">
							  <button type="button" class="btn btn-info btn-sm dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="padding: 0px 5px; border-radius: 10px; margin-left: 5px;">
							    <span class="caret"></span>
							    <span class="sr-only">Toggle Dropdown</span>
							  </button>
							  <ul class="dropdown-menu" style="margin-left: -140px; padding:5px">
							  	<form method="post">';
							    foreach ( $fetchDiamondShapes->fetchAll() as $item ) {
							    	$checkedX = "";
							    	if ( isset($_SESSION['diamond_shape']) ) {
							    		foreach ( $_SESSION['diamond_shape'] as $entry ) {
							    			if ( $entry == $item['id'] ) {
							    				$checkedX = "checked";
							    			} 
							    		}
							    	}
							    	echo '<li style=""><input type="checkbox" name="diamond_shape['. $item['category'] .']" value="'. $item['id'] .'" '. $checkedX .' ><span style="margin: 5px;">'. $item['category'] .'</span></li>';
							    }
							  echo'
							  	<input name="filterBy" value="diamond_shape" hidden />
							  	<button class="btn btn-info btn-block">Filter</button>
							  	</form>
							  </ul>
							</div>'; 
                		}
						?>
					</th>
                	<th><?php echo '<a href="?page='. $currentPage .'&filter=color_stone_shape&order='. $order .'">Colored Stone Shape'. $numOfStonesCaret .'</a>'; ?></th>
                	<th><?php echo '<a href="?page='. $currentPage .'&filter=clarity&order='. $order .'">Clarity'. $clarityCaret .'</a>'; 
                		echo '<div class="btn-group">
							  <button type="button" class="btn btn-danger btn-sm dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="padding: 0px 5px; border-radius: 10px; margin-left: 5px;">
							    <span class="caret"></span>
							    <span class="sr-only">Toggle Dropdown</span>
							  </button>
							  <ul class="dropdown-menu" style="margin-left: -70px; padding: 5px; min-width: 90px;"> <form method="post">';
							  		$clarityArray = array("FL", "IF", "VVS1", "VVS2", "VS1", "VS2", "SI1", "SI2", "SI3", "I1");

							  		foreach ( $clarityArray as $item ) {
						  				$checkedX = "";
							  			if ( isset($_SESSION['clarity']) ) {
								    		foreach ( $_SESSION['clarity'] as $entry ) {
								    			pconsole("Entry: " . $entry . " = Item: " . $item);
								    			if ( $entry == $item ) {
								    				$checkedX = "checked";
								    			} 
								    		}
								    	}
							  			echo '<li><input type="checkbox" name="clarity['. $item .']" value="'. $item .'" '. $checkedX .'><span style="margin: 5px;">'. $item .'</span></li>';
							  		}
							  echo'
							  	<input name="filterBy" value="clarity" hidden />
							  	<button class="btn btn-danger btn-block">Filter</button>
							  	</form>
							  </ul>
							</div>';
                	?></th>
                	<th><?php echo '<a href="?page='. $currentPage .'&filter=color&order='. $order .'">Color '. $colorCaret .'</a>'; 
                			echo '<div class="btn-group">
							  <button type="button" class="btn btn-success btn-sm dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="padding: 0px 5px; border-radius: 10px; margin-left: 5px;">
							    <span class="caret"></span>
							    <span class="sr-only">Toggle Dropdown</span>
							  </button>
							  <ul class="dropdown-menu" style="margin-left: -140px; padding:5px">
							  	<form method="post">';
							  		$colorArray = array("White Stone" => 1, "Colored Stone" => 2);
							  		foreach ( $colorArray as $item => $id ) {
						  				$checkedX = "";
							  			if ( isset($_SESSION['color']) ) {
								    		foreach ( $_SESSION['color'] as $entry ) {
								    			pconsole("Entry: " . $entry . " = Item: " . $item);
								    			if ( $entry == $id ) {
								    				$checkedX = "checked";
								    			} 
								    		}
								    	}
							  			echo '<li><input type="checkbox" name="color['. $item .']" value="'. $id .'" '. $checkedX .'><span style="margin: 5px;">'. $item .'</span></li>';
							  		}
							  echo'
							  	<input name="filterBy" value="color" hidden />
							  	<button class="btn btn-success btn-block">Filter</button>
							  	</form>
							  </ul>
							</div>'; 
                	?></th>
                	<th><?php echo '<a href="?page='. $currentPage .'&filter=material&order='. $order .'">Material '. $materialCaret .'</a>'; 
                	$fetchDiamondShapes = $pdo->prepare("SELECT * FROM `materials`");
                		$fetchDiamondShapes->execute();

                		if ( $fetchDiamondShapes->rowCount() > 0 ) {

	                		echo '<div class="btn-group">
							  <button type="button" class="btn btn-warning btn-sm dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="padding: 0px 5px; border-radius: 10px; margin-left: 5px;">
							    <span class="caret"></span>
							    <span class="sr-only">Toggle Dropdown</span>
							  </button>
							  <ul class="dropdown-menu" style="margin-left: -140px; padding:5px">
							  	<form method="post">';
							    foreach ( $fetchDiamondShapes->fetchAll() as $item ) {
							    	$checkedX = "";
							    	if ( isset($_SESSION['material']) ) {
							    		foreach ( $_SESSION['material'] as $entry ) {
							    			if ( $entry == $item['id'] ) {
							    				$checkedX = "checked";
							    			} 
							    		}
							    	}
							    	echo '<li style=""><input type="checkbox" name="material['. $item['category'] .']" value="'. $item['id'] .'" '. $checkedX .'><span style="margin: 5px;">'. $item['category'] .'</span></li>';
							    }
							  echo'
							  	<input name="filterBy" value="material" hidden />
							  	<button class="btn btn-warning btn-block">Filter</button>
							  	</form>
							  </ul>
							</div>'; 
                		}
                	?></th>
                	<th><?php echo '<a href="?page='. $currentPage .'&filter=gold_quality&order='. $order .'">Gold Quality</a>'; ?></th>
                	<th><?php echo '<a href="?page='. $currentPage .'&filter=color_stone_type&order='. $order .'">Color Stone Type</a>'; ?></th>
                	<th><?php echo '<a href="?page='. $currentPage .'&filter=height&order='. $order .'">Height '. $heightCaret .'</a>'; ?></th>
                	<th><?php echo '<a href="?page='. $currentPage .'&filter=width&order='. $order .'">Width '. $widthCaret .'</a>'; ?></th>
                	<th><?php echo '<a href="?page='. $currentPage .'&filter=length&order='. $order .'">Length '. $lengthCaret .'</a>'; ?></th>
                	<th><?php echo '<a href="?page='. $currentPage .'&filter=country_id&order='. $order .'">Country '. $countryCaret .'</a>'; ?></th>
                	<th><?php echo '<a href="?page='. $currentPage .'&filter=lab_grown&order='. $order .'">Lab Grown '. $ringCategoryCaret .'</a>'; ?></th>
                	<th>Images</th>
                	<th>Description</th>
                	<th><?php echo '<a href="?page='. $currentPage .'&filter=date_added&order='. $order .'">Added On '. $dateAddedCaret .'</a>'; ?></th>
                </thead>
                <tbody>
                	<?php

                	$filterDiamondShape = "";
                	$filterMaterial = "";
                	$filterColor = "";
                	$filterClarity = "";

                	$filtersApplied = "";

            		if ( isset($_SESSION['diamond_shape']) && !is_null($_SESSION['diamond_shape']) && !empty($_SESSION['diamond_shape']) ) {
            			$count = 0;
            			$filterDiamondShape = " AND (";
            			foreach ( $_SESSION['diamond_shape'] as $clause ) {
            				if ( $count == 0 ) {
            					$filterDiamondShape .= " `diamond_shape` = $clause ";
            					$filtersApplied .= "<span class='label label-info'>". getDiamondShape($clause, $pdo) ."</span> ";
            				} else {
            					$filterDiamondShape .= " OR `diamond_shape` = $clause ";
            					$filtersApplied .= "<span class='label label-info'>". getDiamondShape($clause, $pdo) ."</span> ";
            				}
            				$count++;
            			}
            			$filterDiamondShape .= " )";
            		}

            		if ( isset($_SESSION['material']) && !is_null($_SESSION['material']) && !empty($_SESSION['material']) ) {
            			$count = 0;
            			$filterMaterial = " AND (";
            			foreach ( $_SESSION['material'] as $clause ) {
            				if ( $count == 0 ) {
            					$filterMaterial .= " `material` = $clause ";
            					$filtersApplied .= "<span class='label label-warning'>". getMaterial($clause, $pdo) ."</span> ";
            				} else {
            					$filterMaterial .= " OR `material` = $clause ";
            					$filtersApplied .= "<span class='label label-warning'>". getMaterial($clause, $pdo) ."</span> ";
            				}
            				$count++;
            			}
            			$filterMaterial .= " )";
            		}

            		if ( isset($_SESSION['color']) && !is_null($_SESSION['color']) && !empty($_SESSION['color']) ) {
            			$count = 0;
            			$filterColor = " AND (";
            			foreach ( $_SESSION['color'] as $clause ) {
            				$cX = ( $clause == 1 ) ? "White Stone" : "Colored Stone";
            				if ( $count == 0 ) {
            					$filterColor .= " `color` = $clause ";
            					$filtersApplied .= "<span class='label label-success'>". $cX ."</span> ";
            				} else {
            					$filterColor .= " OR `color` = $clause ";
            					$filtersApplied .= "<span class='label label-success'>". $cX ."</span> ";
            				}
            				$count++;
            			}
            			$filterColor .= " )";
            		}

            		if ( isset($_SESSION['clarity']) && !is_null($_SESSION['clarity']) && !empty($_SESSION['clarity']) ) {
            			$count = 0;
            			$filterClarity = " AND (";
            			foreach ( $_SESSION['clarity'] as $clause ) {
            				if ( $count == 0 ) {
            					$filterClarity .= " `clarity` = \"$clause\" ";
            					$filtersApplied .= "<span class='label label-danger'>". $clause ."</span> ";
            				} else {
            					$filterClarity .= " OR `clarity` = \"$clause\" ";
            					$filtersApplied .= "<span class='label label-danger'>". $clause ."</span> ";
            				}
            				$count++;
            			}
            			$filterClarity .= " )";
            		}

            		if ( !empty($filtersApplied) ) {
            			$filtersApplied .= "<form style='display: inline;' method='post'><button name='clearFilters' class='label btn btn-custom'>CLEAR</button></form>";
            		}

					echo '<script>document.getElementById("filtersApplied").innerHTML = "'. $filtersApplied .'";</script>';

		        	$query = $pdo->prepare("SELECT * FROM `items` INNER JOIN `necklaces` ON items.unique_key = necklaces.unique_key WHERE `category` = 4 ". $filterDiamondShape . $filterMaterial . $filterColor . $filterClarity ." ORDER BY ". $filter . " " . $currentOrder . " LIMIT ". $offset .", ". $perPage ." ");
		        	$queryCount = $pdo->prepare("SELECT COUNT(items.id) AS itemCount FROM `items` INNER JOIN `necklaces` ON items.unique_key = necklaces.unique_key WHERE `category` = 1 ". $filterDiamondShape . $filterMaterial . $filterColor . $filterClarity ." ORDER BY ". $filter . " " . $currentOrder . " LIMIT ". $offset .", ". $perPage ." ");
		        	pconsole($query);
					$query->execute(array(":first" => 10));
					$queryCount->execute(array(":first" => 10));
					if ( $query->rowCount() > 0 ) {
						$resultCount = $queryCount->fetch(PDO::FETCH_ASSOC);
						echo '<script>document.getElementById("total_items").innerHTML = "'. $resultCount['itemCount'] .'";</script>';
						$result = $query->fetchAll();
						foreach ( $result as $entry ) {

							switch ($entry['category']) {
								case 1: {
									$getInfo = $pdo->prepare("SELECT * FROM `rings` WHERE `unique_key` = :key");
									break;
								}
								case 2:	{
									$getInfo = $pdo->prepare("SELECT * FROM `earrings` WHERE `unique_key` = :key");
									break;
								}
								case 3: {
									$getInfo = $pdo->prepare("SELECT * FROM `pendants` WHERE `unique_key` = :key");
									break;
								}
								case 4: {
									$getInfo = $pdo->prepare("SELECT * FROM `necklaces` WHERE `unique_key` = :key");
									break;
								}
								case 5: {
									$getInfo = $pdo->prepare("SELECT * FROM `bracelets` WHERE `unique_key` = :key");
									break;
								}
							}
							$getInfo->execute(array(":key" => $entry['unique_key']));
							$info = $getInfo->fetch(PDO::FETCH_ASSOC);

							$price = '€'.$entry['item_value'];

							if ( $entry['discount'] > 0 ) {
								$discounted = $entry['item_value'] - (( $entry['discount'] / 100) * $entry['item_value']);
								$price = '<div style="display:block" ><small class="old-price">€' . $entry['item_value'] . '</small> <span class="glyphicon glyphicon-chevron-right"></span> €' . round($discounted, 2) .'</div>';
							}
							
							$color = ($info['color'] == 1 ) ? "White Stone" : "Colored Stone";
							echo '<tr>';
								echo '<td><input class="select-checkbox" type="checkbox" form="bulkManage" name="'. $entry['unique_key'] .'" onclick="selectItem(this)"></td>';
								
								echo '<td style="text-transform:capitalize">'. trim(getCategory($entry['category'], $pdo), "s") .'</td>';
								echo '<td>'. $entry['id'] .'</td>';

								if ( $entry['featured'] == 1 ) {
									$featured = '<form method="post"><button class="glyphicon glyphicon-star glyphicon-custom" name="featuredRemove" value="'. $entry['unique_key'] .'" data-toggle="tooltip" title="Remove from Featured"></button></form>';
								} else {
									$featured = '<form method="post"><button class="glyphicon glyphicon-star-empty glyphicon-custom" name="featuredAdd" value="'. $entry['unique_key'] .'" data-toggle="tooltip" title="Add to Featured"></button></form>';
								}
								echo '<td style="text-align:center;">'. $featured .'</td>';

								$editModal = '<button class="fa fa-pencil glyphicon-custom" style="color:#607d8b" title="Edit Item" data-toggle="tooltip"
								onClick="editItem(\''. $entry['unique_key'] .'\')"></button>';

								$removeModal = '<button class="fa fa-trash glyphicon-custom" style="color:#607d8b" title="Remove Item" data-toggle="tooltip" onclick="removeItem(\''. $entry['unique_key'] .'\', \''. $entry['item_name'] .'\')"></button>';
								echo '<td>' . $editModal . $removeModal . '</td>';

								echo '<td>'. $info['internal_id'] .'</td>';
								echo '<td>'. getCompany($info['company_id'], $pdo) .'</td>';
								echo '<td>'. $info['product_name'] .'</td>';
								echo '<td>'. $price .'</td>';
								echo '<td>'. $entry['discount'] .'%</td>';
								echo '<td>'. $info['pieces_in_stock'] .'</td>';
								echo '<td>'. $info['days_for_shipment'] .'</td>';
								echo '<td>'. $info['total_gold_weight'] .'</td>';
								echo '<td>'. $info['total_carat_weight'] .'</td>';
								echo '<td>'. $info['color_stone_carat'] .'</td>';
								echo '<td>'. $info['no_of_stones'] .'</td>';
								echo '<td>'. $info['no_of_color_stones'] .'</td>';
								echo '<td>'. getDiamondShape($info['diamond_shape'], $pdo) .'</td>';
								echo '<td>'. getDiamondShape($info['color_stone_shape'], $pdo) .'</td>';
								echo '<td>'. $info['clarity'] .'</td>';
								echo '<td>'. $color .'</td>';
								echo '<td>'. getMaterial($info['material'], $pdo) .'</td>';
								echo '<td>'. $info['gold_quality'] .'</td>';
								echo '<td>'. $info['color_stone_type'] .'</td>';
								echo '<td>'. $info['height'] .'</td>';
								echo '<td>'. $info['width'] .'</td>';
								echo '<td>'. $info['length'] .'</td>';
								echo '<td>'. getCountry($info['country_id'], $pdo) .'</td>';
								$labGrown = "<i class='fa fa-times' style='color:crimson'></i>";
								if ( $info['lab_grown'] == 1 ) {
									$labGrown = "<i class='fa fa-check' style='color:green'></i>";
								} 
								echo '<td>'. $labGrown .'</td>';
								echo '<td><button class="btn btn-custom btn-sm" onClick="manageImages(\''. $info['unique_key'] .'\')">'. intval(sizeof(explode(",", $info['images'])) - 1) .' image(s)</button></td>';
								echo '<td>'. $info['description'] .'</td>';
								echo '<td>'. $entry['date_added'] .'</td>';


							echo '</tr>';
						}
					} else {
						echo 'No entries found';
					}
					?>
                </tbody>
            </table>
            <nav aria-label="Page navigation" style="display: block; text-align: center;">
			  <ul class="pagination" style="margin-top:0px;">
			  <?php 

			  	for ( $i = 0; $i < $pages; $i++ ) {
			  		if ( $i == 0 ) {
			  			echo '<li><a href="?page='. $i .'&filter='. $filter .'&order='. $currentOrder .'">first</a></li>';
			  		}

			  		if ( $i > $currentPage - 3 && $i < $currentPage + 3 ) {
			  			$class = "";
			  			if ( $i == $currentPage ) {
			  				$class = "active";
			  			}
			  			echo '<li class="'. $class .'"><a href="?page='. $i .'&filter='. $filter .'&order='. $currentOrder .'">'. intval($i+1) .'</a></li>';
			  		}else if ( $i > $currentPage - 4 && $i < $currentPage + 4 ) {
			  			echo '<li><a href="#">.</a></li>';
			  		}

			  		if ( $i == intval($pages) ){
			  			echo '<li><a href="?page='. $i .'&filter='. $filter .'&order='. $currentOrder .'">last</a></li>';
			  		}
			  	}
			  ?>
			  </ul>
			</nav>
        </div>
        
        <?php include 'add_item.php'; ?>
        
        </div>
        <!-- /page content -->

        <!-- footer content -->
        <footer style="margin-top:-20px;">
          <?php include 'footer.php'; ?>
        </footer>
        <!-- /footer content -->

<style type="text/css">
	.form-label {
	    text-align: right;
	    font-size: 14px;
	    font-variant: small-caps;
	}
	.table-item-label {
		width: 20%;
	}
	.table-item {
		margin: 5px 10px 15px;
	}
	.table-row {
		margin: 10px;
	}
	.form-control:invalid {
		background-color: #FFCDD2;
	}
	.form-control:valid {
		background-color: #DCEDC8;
	}
	</style>

        <!-- Modal -->
        <div id="promptManageImages" class="modal fade" role="dialog">
          <div class="modal-dialog">
        
            <!-- Modal content-->
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Manage Images</h4>
              </div>
              <div class="modal-body">
                <div id="manageImageDiv" class="container">
                    
                </div>
                <!--<div class="container">
                	<fieldset>
                		<legend>Add New Images</legend>
	                	<form method="post" enctype="multipart/form-data">
	                		<input type="file" name="addImageTo">
	                		<input type="text" class="form-control" name="addURLTo" style="margin:5px;" placeholder="Place image URL here (Seperate with comma (,) )">
	                		<button class="btn btn-custom" style="float:right;" id="addNewImagesID" name="addNewImages" >Add Image</button>
	                	</form>
                	</fieldset>
                </div>-->
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-custom" data-dismiss="modal">Close</button>
              </div>
            </div>
          </div>
        </div>


        <!-- Modal -->
        <div id="promptDeleteImage" class="modal fade" role="dialog">
          <div class="modal-dialog">
        
            <!-- Modal content-->
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Caution</h4>
              </div>
              <form method="post" enctype="multipart/form-data">
              <input id="deleteImagekey" name="unique_key" hidden>
              <div class="modal-body">
                <div class="container" style="text-align:center;">
                	<img id="imageToDelete" src="" style="max-height:35vh;" />
                    <h4>You are about to permanently delete this image
                    <br>Are you sure you want to perform this action?</h4>
                    <br>
                    <h5><div class="alert alert-error">Warning: This action can not be undone.</div></h5>
                </div>
              </div>
              <div class="modal-footer">
                <button id="imageToDeleteID" type="submit" class="btn btn-custom" name="deleteImage" value="">Delete</button>
                <button type="button" class="btn btn-custom" data-dismiss="modal">Close</button>
              </div>
              </form>
            </div>
          </div>
        </div>

        <!-- Modal -->
        <div id="promptRemoveModal" class="modal fade" role="dialog">
          <div class="modal-dialog">
        
            <!-- Modal content-->
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Caution</h4>
              </div>
              <form method="post" enctype="multipart/form-data">
              <input id="remove_category" name="category" hidden>
              <div class="modal-body">
                <div class="container">
                    <h4>You are about to permanently delete <strong id="itemToRemove">This</strong>
                    <br>Are you sure you want to perform this action?</h4>
                    <br>
                    <h5><div class="alert alert-error">Warning: This action can not be undone.</div></h5>
                </div>
              </div>
              <div class="modal-footer">
                <button id="removeModalActionButton" type="submit" class="btn btn-custom" name="removeItem" value="">Remove</button>
                <button type="button" class="btn btn-custom" data-dismiss="modal">Close</button>
              </div>
              </form>
            </div>
          </div>
        </div>

        <div id="promptBulkRemoveModal" class="modal fade" role="dialog">
          <div class="modal-dialog">
        
            <!-- Modal content-->
            <div class="modal-content"> <!-- Bulk Delete Modal -->
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button> <!-- Bulk Delete Modal -->
                <h4 class="modal-title">Caution</h4> <!-- Bulk Delete Modal -->
              </div>
              <input id="remove_category" name="category" hidden>
              <div class="modal-body"> <!-- Bulk Delete Modal -->
                <div class="container">
                    <h4>You are about to permanently delete <strong id="itemsToRemove">This</strong>
                    <br>Are you sure you want to perform this action?</h4> <!-- Bulk Delete Modal -->
                    <br>
                    <h5><div class="alert alert-error">Warning: This action can not be undone.</div></h5> <!-- Bulk Delete Modal -->
                </div>
              </div> <!-- Bulk Delete Modal -->
              <div class="modal-footer">
                <input id="removeModalActionButton" type="submit" class="btn btn-custom" name="bulkManage" value="delete" form="bulkManage" />
                <button type="button" class="btn btn-custom" data-dismiss="modal">Close</button>
              </div>
            </div>
          </div>
        </div>


        <div id="promptRemoveAll" class="modal fade" role="dialog">
          <div class="modal-dialog">
        
            <!-- Modal content-->
            <div class="modal-content"> <!-- Bulk Delete Modal -->
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button> <!-- Bulk Delete Modal -->
                <h4 class="modal-title">Caution</h4> <!-- Bulk Delete Modal -->
              </div>
              <input id="remove_category" name="category" hidden>
              <div class="modal-body"> <!-- Bulk Delete Modal -->
                <div class="container">
                    <h4>You are about to permanently delete <strong id="categoryToRemove" style="text-transform:capitalize;">This</strong>
                    <br>Are you sure you want to perform this action?</h4> <!-- Bulk Delete Modal -->
                    <br>
                    <h5><div class="alert alert-error">Warning: This action can not be undone.</div></h5> <!-- Bulk Delete Modal -->
                </div>
              </div> <!-- Bulk Delete Modal -->
              <form method="post">
              <div class="modal-footer">
              	<input id="removeAll" name="removeAll" value="" hidden="" />
                <input type="submit" class="btn btn-custom"  />
                <button type="button" class="btn btn-custom" data-dismiss="modal">Close</button>
              </div>
              </form>
            </div>
          </div>
        </div>

        <div id="promptEditItem" class="modal fade" role="dialog">
		  <div class="modal-dialog modal-lg">

		    <!-- Modal content-->
		    <div class="modal-content">
		      <div class="modal-header">
		        <button type="button" class="close" data-dismiss="modal">&times;</button>
		        <h4 class="modal-title"><span id="item_to_edit">Edit</span></h4>
		      </div>
		      <form method="post">
		      <div class="modal-body">
		        <div class="container">
		            <div class="col-sm-12">
						<tbody>

							<tr>
								<td><span class="table-item-label" style="display:none;">Category</span></td>
								<td>
									<div class="table-item">
										<select id="edit_category" name="category" class="select-style" hidden>
				                            <option value="">Category</option>
				                            <option value="1">Ring</option>
				                            <option value="2">Earring</option>
				                            <option value="3">Pendant</option>
				                            <option value="4">Necklace</option>
				                            <option value="5">Bracelet</option>
				                        </select>
									</div>
								</td>
							</tr>
							<tr class="table-row">
								<td class="table-item-label"><span class="table-item-label">Name</span></td>
								<td>
									<div class="table-item">
										<input id="edit_product_name" name="product_name" type="text" class="form-control" placeholder="Product Name (50 Characters)" required maxlength="50" pattern=".{0,50}" >
									</div>
								</td>
							</tr>
							<tr>
								<td><span class="table-item-label">Price</span></td>
								<td>
									<div class="table-item">
										<input id="edit_product_price" name="product_price" type="text" class="form-control" placeholder="Product Price € (Decimal Number)" required pattern="[0-9]{1,}[.,]{1}[0-9]{2,2}" title="Format: 100.00">
									</div>
								</td>
							</tr>
							<tr>
								<td><span class="table-item-label">Discount</span></td>
								<td>
									<div class="table-item">
										<input id="edit_discount" name="discount" type="text" class="form-control" placeholder="Discount % (Number)" pattern="[0-9]{1,2}" title="0 - 99%">
									</div>
								</td>
							</tr>
							<tr>
								<td><span class="table-item-label">Pieces in Stock</span></td>
								<td>
									<div class="table-item">
										<input id="edit_pieces_in_stock" name="pieces_in_stock" type="text" class="form-control" placeholder="Stock (Number)" required>
									</div>
								</td>
							</tr>
							<tr>
								<td><span class="table-item-label">Days for Shipment</span></td>
								<td>
									<div class="table-item">
										<input id="edit_days_for_shipment" name="days_for_shipment" type="text" class="form-control" placeholder="Shipment (Number)" required>
									</div>
								</td>
							</tr>
							<tr>
								<td><span class="table-item-label">Total Gold Weight</span></td>
								<td>
									<div class="table-item">
										<input id="edit_total_gold_weight" name="total_gold_weight" type="text" class="form-control" placeholder="Total Gold Weight (Decimal Number)">
									</div>
								</td>
							</tr>
							<tr>
								<td><span class="table-item-label">Total Carat Weight</span></td>
								<td>
									<div class="table-item">
										<input id="edit_total_carat_weight" name="total_carat_weight" type="text" class="form-control" placeholder="Total Carat (Decimal Number)">
									</div>
								</td>
							</tr>
							<tr>
								<td><span class="table-item-label">Color Stone Carat Weight</span></td>
								<td>
									<div class="table-item">
										<input id="edit_color_stone_carat" name="color_stone_carat" type="text" class="form-control" placeholder="Color Stone Carat (Decimal Number)">
									</div>
								</td>
							</tr>
							<tr>
								<td><span class="table-item-label">Number of Stones</span></td>
								<td>
									<div class="table-item">
										<input id="edit_no_of_stones" name="no_of_stones" type="text" class="form-control" placeholder="Stones (Number)">
									</div>
								</td>
							</tr>
							<tr>
								<td><span class="table-item-label">Number of Colored Stones</span></td>
								<td>
									<div class="table-item">
										<input id="edit_no_of_color_stones" name="no_of_color_stones" type="text" class="form-control" placeholder="Color Stones (Number)">
									</div>
								</td>
							</tr>
							<tr>
								<td><span class="table-item-label">Diamond Shape</span></td>
								<td>
									<div class="table-item">
										<select id="edit_diamond_shape" name="diamond_shape" class="select-style" required>
				                            <option value="">Select</option>
				                            <?php 
				                            $diamShapes = $pdo->prepare("SELECT * FROM `diamond_shape`");
				                            $diamShapes->execute();
				                            if ( $diamShapes->rowCount() > 0 ) {
				                            	foreach ( $diamShapes->fetchAll() as $option ) {
				                            		echo '<option value="'. $option['id'] .'">'. $option['category'] .'</option>';
				                            	}
				                            }
				                            ?>
				                        </select>
									</div>
								</td>
							</tr>
							<tr>
								<td><span class="table-item-label">Color Stone Shape</span></td>
								<td>
									<div class="table-item">
										<select id="edit_color_stone_shape" name="color_stone_shape" class="select-style" required>
				                            <option value="">Select</option>
				                            <?php 
				                            $diamShapes = $pdo->prepare("SELECT * FROM `diamond_shape`");
				                            $diamShapes->execute();
				                            if ( $diamShapes->rowCount() > 0 ) {
				                            	foreach ( $diamShapes->fetchAll() as $option ) {
				                            		echo '<option value="'. $option['id'] .'">'. $option['category'] .'</option>';
				                            	}
				                            }
				                            ?>
				                        </select>
									</div>
								</td>
							</tr>
							<tr>
								<td><span class="table-item-label">Clarity</span></td>
								<td>
									<div class="table-item">
										<select id="edit_clarity" name="clarity" class="select-style" required>
				                            <option value="">Select</option>
				                            <option value="FL">FL</option>
				                            <option value="IF">IF</option>
				                            <option value="VVS1">VVS1</option>
				                            <option value="VVS2">VVS2</option>
				                            <option value="VS1">VS1</option>
				                            <option value="VS2">VS2</option>
				                            <option value="SI1">SI1</option>
				                            <option value="SI2">SI2</option>
				                            <option value="SI3">SI3</option>
				                            <option value="I1">I1</option>
				                        </select>
									</div>
								</td>
							</tr>
							<tr>
								<td><span class="table-item-label">Color</span></td>
								<td>
									<div class="table-item">
										<select id="edit_color" name="color" class="select-style" required>
				                            <option value="">Select</option>
				                            <?php 
				                            $fetchAvailableColors = $pdo->prepare("SELECT * FROM color");
				                            $fetchAvailableColors->execute();
				                            if ( $fetchAvailableColors->rowCount() > 0) {
				                            	foreach ( $fetchAvailableColors->fetchAll() as $availableColors ) {
				                            		echo '<option value="'. $availableColors["id"] .'">'. $availableColors["color"] .'</option>';
				                            	}
				                            }
				                            ?>
				                        </select>
									</div>
								</td>
							</tr>
							<tr>
								<td><span class="table-item-label">Diamond Color</span></td>
								<td>
									<div class="table-item">
										<select id="edit_diamond_color" name="diamond_color" class="select-style" required>
				                            <option value="">Select</option>
				                            <?php 
				                            $fetchAvailableColors = $pdo->prepare("SELECT * FROM diamond_color");
				                            $fetchAvailableColors->execute();
				                            if ( $fetchAvailableColors->rowCount() > 0) {
				                            	foreach ( $fetchAvailableColors->fetchAll() as $availableColors ) {
				                            		echo '<option value="'. $availableColors["id"] .'">'. $availableColors["diamond_color"] .'</option>';
				                            	}
				                            }
				                            ?>
				                        </select>
									</div>
								</td>
							</tr>
							<tr>
								<td><span class="table-item-label">Material</span></td>
								<td>
									<div class="table-item">
										<select id="edit_material" name="material" class="select-style" required>
				                            <option value="">Select</option>..
				                            <?php 
				                            $query = $pdo->prepare("SELECT * FROM `materials`");
				                            $query->execute();
				                            if ( $query->rowCount() > 0 ) {
				                            	$query = $query->fetchAll();
				                            	foreach ( $query as $entry ) {
				                            		echo '<option value="'. $entry['id'] .'">'. $entry['category'] .'</option>';
				                            	}
				                            }
				                            ?>
				                        </select>
									</div>
								</td>
							</tr>
							<tr>
								<td><span class="table-item-label">Gold Quality</span></td>
								<td>
									<div class="table-item">
										<input id="edit_gold_quality" name="gold_quality" type="text" class="form-control" placeholder="Gold Quality">
									</div>
								</td>
							</tr>
							<tr>
								<td><span class="table-item-label">Color Stone Type</span></td>
								<td>
									<div class="table-item">
										<input id="edit_color_stone_type" name="color_stone_type" type="text" class="form-control" placeholder="Color Stone Type">
									</div>
								</td>
							</tr>
							<tr>
								<td><span class="table-item-label">Height</span></td>
								<td>
									<div class="table-item">
										<input id="edit_height" name="height" type="text" class="form-control" placeholder="Height (Number)">
									</div>
								</td>
							</tr>
							<tr>
								<td><span class="table-item-label">Width</span></td>
								<td>
									<div class="table-item">
										<input id="edit_width" name="width" type="text" class="form-control" placeholder="Width (Number)">
									</div>
								</td>
							</tr>
							<tr>
								<td> <span class="table-item-label">Length</span></td>
								<td>
									<div class="table-item">
										<input id="edit_length" name="length" type="text" class="form-control" placeholder="Length (Number)">
									</div>
								</td>
							</tr>
							<tr>
								<td> <span class="table-item-label">Country</span></td>
								<td>
									<div class="table-item">
										<select id="edit_country_id" name="country_id" class="select-style" required>
				                            <option value="">Select</option>
											<option value="1">Austria</option>
											<option value="2">Belgium</option>
											<option value="3">Bulgaria</option>
											<option value="4">Croatia</option>
											<option value="5">Cyprus</option>
											<option value="6">Czech Republic</option>
											<option value="7">Denmark</option>
											<option value="8">Estonia</option>
											<option value="9">Finland</option>
											<option value="10">France</option>
											<option value="11">Germany</option>
											<option value="12">Greece</option>
											<option value="13">Hungary</option>
											<option value="14">Ireland</option>
											<option value="15">Italy</option>
											<option value="16">Latvia</option>
											<option value="17">Lithuania</option>
											<option value="18">Luxembourg</option>
											<option value="19">Malta</option>
											<option value="20">Netherlands</option>
											<option value="21">Poland</option>
											<option value="22">Portugal</option>
											<option value="23">Romania</option>
											<option value="24">Slovakia</option>
											<option value="25">Slovenia</option>
											<option value="26">Spain</option>
											<option value="27">Sweden</option>
											<option value="28">UK</option>
				                        </select>
									</div>
								</td>
							</tr>
							<tr>
								Company
								<td>
									<div class="table-item">
										<select id="edit_company_id" name="company_id" class="select-style" required>
				                            <option value="">Select</option>
											<?php 
				                            $getCompanies = $pdo->prepare("SELECT * FROM `company_id`");
				                            $getCompanies->execute();

				                            if ( $getCompanies->rowCount() > 0 ) {
				                            	foreach ( $getCompanies as $company ) {
				                            		echo '<option value="'. $company['id'] .'" >'. $company['company_name'] .'</option>';
				                            	}
				                            } else {
				                            	echo '<option value="0">N/A</option>';
				                            }
				                            ?>
				                        </select>
									</div>
								</td>
							</tr>
							<tr>
								<td> <span class="table-item-label">Internal ID</span></td>
								<td>
									<div class="table-item">
										<input id="edit_internal_id" name="internal_id" type="text" class="form-control" placeholder="Internal ID (Mixed Characters)" required>
									</div>
								</td>
							</tr>
							<tr>
								<td> <span class="table-item-label">Subcategory</span> </td>
								<td>
									<div class="table-item">
										
										<select id="ring_subcategory" name="ring_subcategory" class="select-style" required>
				                            <option value="">Select</option>
											<?php 
											$query = $pdo->prepare("SELECT * FROM `ring_subcategory` WHERE `category_id` = 4");
											$query->execute();
											if ( $query->rowCount() > 0 ) {
												$query = $query->fetchAll();
												foreach ( $query as $option ) {
													echo '<option value="'. $option['id'] .'">'. $option['category'] .'</option>';
												}
											}
											?>
				                        </select>
									</div>
								</td>
							</tr>
							<tr>
								<td> <span class="table-item-label">Lab Grown Diamond</span> </td>
								<td>
									<div class="table-item">
										<input type="radio" name="lab_grown" required id="edit_lab_grown" value="1">Yes<br>
										<input type="radio" name="lab_grown" required id="edit_lab_grown" value="0">No
									</div>
								</td>
							</tr>
							<tr>
								<td>
									<span class="table-item-label">Description</span>
								</td>
								<td>
									<div class="table-item">
										<textarea id="edit_description" name="description" class="form-control" style="width:100%" placeholder="Description Goes Here (250 Characters)"  maxlength="250"></textarea>
									</div>
								</td>
							</tr>
							<tr>
								<td>
									<span class="table-item-label">Description (French)</span>
								</td>
								<td>
									<div class="table-item">
										<textarea id="edit_description_french" name="description_french" class="form-control" style="width:100%" placeholder="Description Goes Here (250 Characters)"  maxlength="250"></textarea>
									</div>
								</td>
							</tr>
						</tbody>
		            </div>  
		        </div>
		      </div>
		      <div class="modal-footer">
		      	<input id="unique_key" name="unique_key" hidden/>
		        <button type="submit" class="btn btn-custom" name="editItem" id="editItem" >Submit</button>
		        <button type="button" class="btn btn-custom" data-dismiss="modal">Close</button>
		      </div>
		      </form>
		    </div>
		  </div>
		</div>


        <div id="promptAddItem" class="modal fade" role="dialog">
		  <div class="modal-dialog modal-lg">

		    <!-- Modal content-->
		    <div class="modal-content">
		      <div class="modal-header">
		        <button type="button" class="close" data-dismiss="modal">&times;</button>
		        <h4 class="modal-title">Add New</span></h4>
		      </div>
		      <form method="post" enctype="multipart/form-data" id="addItemForm">
		      <div class="modal-body">
		        <div class="container">
		            <div class="col-sm-12">
						<tbody>

							<tr>
								<td><span class="table-item-label" style="display:none;">Category</span></td>
								<td>
									<div class="table-item">
										<select id="category" name="category" class="select-style" hidden>
				                            <option value="">Category</option>
				                            <option value="1">Ring</option>
				                            <option value="2">Earring</option>
				                            <option value="3">Pendant</option>
				                            <option value="4">Necklace</option>
				                            <option value="5">Bracelet</option>
				                        </select>
									</div>
								</td>
							</tr>
							<tr class="table-row">
								<td class="table-item-label"><span class="table-item-label">Name</span></td>
								<td>
									<div class="table-item">
										<input id="product_name" name="product_name" type="text" class="form-control" placeholder="Product Name (50 Characters)" required maxlength="50" pattern=".{0,50}" >
									</div>
								</td>
							</tr>
							<tr>
								<td><span class="table-item-label">Price</span></td>
								<td>
									<div class="table-item">
										<input id="product_price" name="product_price" type="text" class="form-control" placeholder="Product Price € (Decimal Number)" required pattern="[0-9]{1,}[.,]{1}[0-9]{2,2}" title="Format: 100.00">
									</div>
								</td>
							</tr>
							<tr>
								<td><span class="table-item-label">Discount</span></td>
								<td>
									<div class="table-item">
										<input id="discount" name="discount" type="text" class="form-control" placeholder="Discount % (Number)" pattern="[0-9]{1,2}" title="0 - 99%">
									</div>
								</td>
							</tr>
							<tr>
								<td><span class="table-item-label">Pieces in Stock</span></td>
								<td>
									<div class="table-item">
										<input id="pieces_in_stock" name="pieces_in_stock" type="text" class="form-control" placeholder="Stock (Number)" required>
									</div>
								</td>
							</tr>
							<tr>
								<td><span class="table-item-label">Days for Shipment</span></td>
								<td>
									<div class="table-item">
										<input id="days_for_shipment" name="days_for_shipment" type="text" class="form-control" placeholder="Shipment (Number)" required>
									</div>
								</td>
							</tr>
							<tr>
								<td><span class="table-item-label">Total Gold Weight</span></td>
								<td>
									<div class="table-item">
										<input id="total_gold_weight" name="total_gold_weight" type="text" class="form-control" placeholder="Total Gold Weight (Decimal Number)">
									</div>
								</td>
							</tr>
							<tr>
								<td><span class="table-item-label">Total Carat Weight</span></td>
								<td>
									<div class="table-item">
										<input id="total_carat_weight" name="total_carat_weight" type="text" class="form-control" placeholder="Total Carat (Decimal Number)">
									</div>
								</td>
							</tr>
							<tr>
								<td><span class="table-item-label">Color Stone Carat Weight</span></td>
								<td>
									<div class="table-item">
										<input id="color_stone_carat" name="color_stone_carat" type="text" class="form-control" placeholder="Color Stone Carat (Decimal Number)">
									</div>
								</td>
							</tr>
							<tr>
								<td><span class="table-item-label">Number of Stones</span></td>
								<td>
									<div class="table-item">
										<input id="no_of_stones" name="no_of_stones" type="text" class="form-control" placeholder="Stones (Number)">
									</div>
								</td>
							</tr>
							<tr>
								<td><span class="table-item-label">Number of Colored Stones</span></td>
								<td>
									<div class="table-item">
										<input id="no_of_stones" name="no_of_color_stones" type="text" class="form-control" placeholder="Color Stones (Number)">
									</div>
								</td>
							</tr>
							<tr>
								<td><span class="table-item-label">Diamond Shape</span></td>
								<td>
									<div class="table-item">
										<select id="diamond_shape" name="diamond_shape" class="select-style" required>
				                            <option value="">Select</option>
				                            <?php 
				                            $diamShapes = $pdo->prepare("SELECT * FROM `diamond_shape`");
				                            $diamShapes->execute();
				                            if ( $diamShapes->rowCount() > 0 ) {
				                            	foreach ( $diamShapes->fetchAll() as $option ) {
				                            		echo '<option value="'. $option['id'] .'">'. $option['category'] .'</option>';
				                            	}
				                            }
				                            ?>
				                        </select>
									</div>
								</td>
							</tr>
							<tr>
								<td><span class="table-item-label">Color Stone Shape</span></td>
								<td>
									<div class="table-item">
										<select id="color_stone_shape" name="color_stone_shape" class="select-style" required>
				                            <option value="">Select</option>
				                            <?php 
				                            $diamShapes = $pdo->prepare("SELECT * FROM `diamond_shape`");
				                            $diamShapes->execute();
				                            if ( $diamShapes->rowCount() > 0 ) {
				                            	foreach ( $diamShapes->fetchAll() as $option ) {
				                            		echo '<option value="'. $option['id'] .'">'. $option['category'] .'</option>';
				                            	}
				                            }
				                            ?>
				                        </select>
									</div>
								</td>
							</tr>
							<tr>
								<td><span class="table-item-label">Clarity</span></td>
								<td>
									<div class="table-item">
										<select id="clarity" name="clarity" class="select-style" required>
				                            <option value="">Select</option>
				                            <option value="FL">FL</option>
				                            <option value="IF">IF</option>
				                            <option value="VVS1">VVS1</option>
				                            <option value="VVS2">VVS2</option>
				                            <option value="VS1">VS1</option>
				                            <option value="VS2">VS2</option>
				                            <option value="SI1">SI1</option>
				                            <option value="SI2">SI2</option>
				                            <option value="SI3">SI3</option>
				                            <option value="I1">I1</option>
				                        </select>
									</div>
								</td>
							</tr>
							<tr>
								<td><span class="table-item-label">Color</span></td>
								<td>
									<div class="table-item">
										<select id="color" name="color" class="select-style" required>
				                            <option value="">Select</option>
				                            <?php 
				                            $fetchAvailableColors = $pdo->prepare("SELECT * FROM color");
				                            $fetchAvailableColors->execute();
				                            if ( $fetchAvailableColors->rowCount() > 0) {
				                            	foreach ( $fetchAvailableColors->fetchAll() as $availableColors ) {
				                            		echo '<option value="'. $availableColors["id"] .'">'. $availableColors["color"] .'</option>';
				                            	}
				                            }
				                            ?>
				                        </select>
									</div>
								</td>
							</tr>
							<tr>
								<td><span class="table-item-label">Diamond Color</span></td>
								<td>
									<div class="table-item">
										<select id="diamond_color" name="diamond_color" class="select-style" required>
				                            <option value="">Select</option>
				                            <?php 
				                            $fetchAvailableColors = $pdo->prepare("SELECT * FROM diamond_color");
				                            $fetchAvailableColors->execute();
				                            if ( $fetchAvailableColors->rowCount() > 0) {
				                            	foreach ( $fetchAvailableColors->fetchAll() as $availableColors ) {
				                            		echo '<option value="'. $availableColors["id"] .'">'. $availableColors["diamond_color"] .'</option>';
				                            	}
				                            }
				                            ?>
				                        </select>
									</div>
								</td>
							</tr>
							<tr>
								<td><span class="table-item-label">Material</span></td>
								<td>
									<div class="table-item">
										<select id="material" name="material" class="select-style" required>
				                            <option value="">Select</option>..
				                            <?php 
				                            $query = $pdo->prepare("SELECT * FROM `materials`");
				                            $query->execute();
				                            if ( $query->rowCount() > 0 ) {
				                            	$query = $query->fetchAll();
				                            	foreach ( $query as $entry ) {
				                            		echo '<option value="'. $entry['id'] .'">'. $entry['category'] .'</option>';
				                            	}
				                            }
				                            ?>
				                        </select>
									</div>
								</td>
							</tr>
							<tr>
								<td><span class="table-item-label">Gold Quality</span></td>
								<td>
									<div class="table-item">
										<input id="gold_quality" name="gold_quality" type="text" class="form-control" placeholder="Gold Quality">
									</div>
								</td>
							</tr>
							<tr>
								<td><span class="table-item-label">Color Stone Type</span></td>
								<td>
									<div class="table-item">
										<input id="color_stone_type" name="color_stone_type" type="text" class="form-control" placeholder="Color Stone Type">
									</div>
								</td>
							</tr>
							<tr>
								<td><span class="table-item-label">Height</span></td>
								<td>
									<div class="table-item">
										<input id="height" name="height" type="text" class="form-control" placeholder="Height (Number)">
									</div>
								</td>
							</tr>
							<tr>
								<td><span class="table-item-label">Width</span></td>
								<td>
									<div class="table-item">
										<input id="width" name="width" type="text" class="form-control" placeholder="Width (Number)">
									</div>
								</td>
							</tr>
							<tr>
								<td> <span class="table-item-label">Length</span></td>
								<td>
									<div class="table-item">
										<input id="length" name="length" type="text" class="form-control" placeholder="Length (Number)">
									</div>
								</td>
							</tr>
							<tr>
								<td> <span class="table-item-label">Country</span></td>
								<td>
									<div class="table-item">
										<select id="country_id" name="country_id" class="select-style" required>
				                            <option value="">Select</option>
											<option value="1">Austria</option>
											<option value="2">Belgium</option>
											<option value="3">Bulgaria</option>
											<option value="4">Croatia</option>
											<option value="5">Cyprus</option>
											<option value="6">Czech Republic</option>
											<option value="7">Denmark</option>
											<option value="8">Estonia</option>
											<option value="9">Finland</option>
											<option value="10">France</option>
											<option value="11">Germany</option>
											<option value="12">Greece</option>
											<option value="13">Hungary</option>
											<option value="14">Ireland</option>
											<option value="15">Italy</option>
											<option value="16">Latvia</option>
											<option value="17">Lithuania</option>
											<option value="18">Luxembourg</option>
											<option value="19">Malta</option>
											<option value="20">Netherlands</option>
											<option value="21">Poland</option>
											<option value="22">Portugal</option>
											<option value="23">Romania</option>
											<option value="24">Slovakia</option>
											<option value="25">Slovenia</option>
											<option value="26">Spain</option>
											<option value="27">Sweden</option>
											<option value="28">UK</option>
				                        </select>
									</div>
								</td>
							</tr>
							<tr>
								Company
								<td>
									<div class="table-item">
										<select id="company_id" name="company_id" class="select-style" required>
				                            <option value="">Select</option>
											<?php 
				                            $getCompanies = $pdo->prepare("SELECT * FROM `company_id`");
				                            $getCompanies->execute();

				                            if ( $getCompanies->rowCount() > 0 ) {
				                            	foreach ( $getCompanies as $company ) {
				                            		echo '<option value="'. $company['id'] .'" >'. $company['company_name'] .'</option>';
				                            	}
				                            } else {
				                            	echo '<option value="0">N/A</option>';
				                            }
				                            ?>
				                        </select>
									</div>
								</td>
							</tr>
							<tr>
								<td> <span class="table-item-label">Internal ID</span></td>
								<td>
									<div class="table-item">
										<input id="internal_id" name="internal_id" type="text" class="form-control" placeholder="Internal ID (Mixed Characters)" required>
									</div>
								</td>
							</tr>
							<tr>
								<td> <span class="table-item-label">Subcategory</span> </td>
								<td>
									<div class="table-item">
										
										<select id="ring_subcategory" name="ring_subcategory" class="select-style" required>
				                            <option value="">Select</option>
											<?php 
											$query = $pdo->prepare("SELECT * FROM `ring_subcategory` WHERE `category_id` = 4");
											$query->execute();
											if ( $query->rowCount() > 0 ) {
												$query = $query->fetchAll();
												foreach ( $query as $option ) {
													echo '<option value="'. $option['id'] .'">'. $option['category'] .'</option>';
												}
											}
											?>
				                        </select>
									</div>
								</td>
							</tr>
							<tr>
								<td> <span class="table-item-label">Lab Grown Diamond</span> </td>
								<td>
									<div class="table-item">
										<input type="radio" name="lab_grown" required id="lab_grown" value="1">Yes<br>
										<input type="radio" name="lab_grown" required id="lab_grown" value="0">No
									</div>
								</td>
							</tr>
							<tr>
								<td><span class="table-item-label">Images</span></td>
								<td>
									<div class="table-item">
										<input type="file" class="" id="usr" name="itemImage[]" multiple required>
									</div>
								</td>
							</tr>
							<tr>
								<td>
									<span class="table-item-label">Description</span>
								</td>
								<td>
									<div class="table-item">
										<textarea id="description" name="description" class="form-control" style="width:100%" placeholder="Description Goes Here (250 Characters)"  maxlength="250"></textarea>
									</div>
								</td>
							</tr>
							<tr>
								<td>
									<span class="table-item-label">Description (French)</span>
								</td>
								<td>
									<div class="table-item">
										<textarea id="description_french" name="description_french" class="form-control" style="width:100%" placeholder="Description Goes Here (250 Characters)"  maxlength="250"></textarea>
									</div>
								</td>
							</tr>
						</tbody>
		            </div>  
		        </div>
		      </div>
		      <div class="modal-footer">
		      	<input id="unique_key" name="unique_key" hidden/>
		        <button type="submit" class="btn btn-custom" name="addItem" id="addItem" >Submit</button>
		        <button type="button" class="btn btn-custom" data-dismiss="modal">Close</button>
		      </div>
		      </form>
		    </div>
		  </div>
		</div>


      </div>
    </div>

    <!-- jQuery -->
    
	<script src="../../js/jquery-1.12.0.js"></script>
    <script src="../../js/bootstrap.min.js"></script>
    <script src="../assets/custom.min.js"></script>
    <script>
	$(document).ready(function(){
		$('[data-toggle="tooltip"]').tooltip(); 
	});

	function removeItem(key, name) {
		$("#itemToRemove").html(name);
		$("#removeModalActionButton").val(key);

		$("#promptRemoveModal").modal("toggle");
	}

	function editItem(key) {

		$.ajax({
			url: './ajax.php?getInfo=' + key,
			type: 'GET',
			success: function(result) {
				try {
					result = JSON.parse(result);
					console.log(result);

					$("#item_to_edit").html(result['product_name']);
					$("#unique_key").val(result['unique_key']);
					$("#edit_product_name").val(result['product_name']);
					$("#edit_product_price").val(parseFloat(result['item_value']).toFixed(2));
					$("#edit_discount").val(result['discount']);
					$("#edit_color").val(result['color']);
					$("#edit_diamond_color").val(result['diamond_color']);
					$("#edit_total_carat_weight").val(result['total_carat_weight']);
					$("#edit_no_of_stones").val(result['no_of_stones']);
					$("#edit_height").val(result['height']);
					$("#edit_length").val(result['length']);
					$("#edit_pieces_in_stock").val(result['pieces_in_stock']);
					$("#edit_days_for_shipment").val(result['days_for_shipment']);
					$("#edit_width").val(result['width']);
					$("#edit_internal_id").val(result['internal_id']);
					$("#edit_description").val(result['description']);
					$("#edit_description_french").val(result['description_french']);
					$("#edit_color_stone_carat").val(result['color_stone_carat']);
					$("#edit_total_gold_weight").val(result['total_gold_weight']);
					$("#edit_no_of_color_stones").val(result['no_of_color_stones']);
					$("#edit_gold_quality").val(result['gold_quality']);
					$("#edit_color_stone_type").val(result['color_stone_type']);


					$("#edit_material option[value='"+ result['material'] +"'").attr("selected", true);
					$("#edit_category option[value='"+ result['category'] +"'").attr("selected", true);
					$("#edit_clarity option[value='"+ result['clarity'] +"'").attr("selected", true);
					$("#edit_country_id option[value='"+ result['country_id'] +"'").attr("selected", true);
					$("#edit_company_id option[value='"+ result['company_id'] +"'").attr("selected", true);
					$("#edit_diamond_shape option[value='"+ result['diamond_shape'] +"'").attr("selected", true);
					$("#edit_color_stone_shape option[value='"+ result['color_stone_shape'] +"'").attr("selected", true);
					$("#edit_ring_subcategory option[value='"+ result['ring_subcategory'] +"'").attr("selected", true);

					$("#edit_lab_grown[value='"+ result['lab_grown'] +"'").attr("checked", true);
					
					$("#promptEditItem").modal("toggle");
				} catch ( e ) {
					console.log(e);
				}
			},
			failure: function(error) {

			}
		});

	}

	function selectAll(e) {
		if ( $(e).is(":checked") ) {
			checkboxes = document.getElementsByClassName("select-checkbox");
			for(var i=0, n=checkboxes.length;i<n;i++) {
				checkboxes[i].checked = true;
			}
			$(".selected-num").each(function(index, element) {
                $(element).text(checkboxes.length);
            });
		} else {
			checkboxes = document.getElementsByClassName("select-checkbox");
			for(var i=0, n=checkboxes.length;i<n;i++) {
				checkboxes[i].checked = false;
			}
			$(".selected-num").each(function(index, element) {
                $(element).text(0);
            });
		}
	}
	
	$(".select-checkbox").each(function(index, element) {
        $(element).change(function() { 
			if ( $(element).is(":checked") ) {
			//alert("this");
				selectedNum = $(".selected-num").each(function(index, element) {
					$(element).text(parseInt($(element).text()) + 1);
				});;
				
				
			} else {
				selectedNum = $(".selected-num").each(function(index, element) {
					$(element).text(parseInt($(element).text()) - 1);
				});;
			}
			
		});
    });

    function bulkRemoveItems() {
    	$("#itemsToRemove").text($(".selected-num").first().text() + " Item(s)");
    	$("#promptBulkRemoveModal").modal("toggle");
    }

    function removeAll(e) {
    	switch($(e).attr("name")) {
    		case 'all': {
    			message = "Every Item";
    			break;
    		} case 'rings': {
    			message = "All Rings";
    			break;
    		} case 'earrings': {
    			message = "All Earrings";
    			break;
    		} case 'pendants': {
    			message = "All Pendants";
    			break;
    		} case 'necklaces': {
    			message = "All Necklaces";
    			break;
    		} case 'bracelets': {
    			message = "All Bracelets";
    			break;
    		} 
    	}
    	$("#categoryToRemove").text(message);
    	$("#removeAll").val($(e).attr("name"));
    	$("#promptRemoveAll").modal("toggle");
    }
	
    function manageImages(key) {
    	$.ajax({
    		url: "ajax.php?fetchImages="+key,
    		type: "GET",
    		beforeSend: function() {
    			$("#promptManageImages").modal("toggle");
    			$("#manageImageDiv").html("<div style='text-align:center;'><img src='./../../images/gfx/cube_lg.gif'></div>");
    			$("#addNewImagesID").val(key);
    		},
    		success: function(result){
    			$("#manageImageDiv").html(result);
    			console.log(result);
    		}
    	});
    }
	</script>
  </body>
</html>
