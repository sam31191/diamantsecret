<!DOCTYPE html>
<html lang="en">
<?php
if ( session_status() == PHP_SESSION_NONE ) {
	session_start();
}
if ( !isset($_SESSION['modSession']) ) {
	 header ('Location: ../../index.php');
	 die();
}
if ( isset($_SESSION['modSession']) ) {
	if ( !$_SESSION['modSession'] || $_SESSION['Admin'] <= 0 ) {
		header ('Location: ../../index.php');
		die();
	}
}
include '../../url/require.php';

	
if ( isset($_POST['addItem']) ) {
	//echo var_dump($_FILES);
	//echo var_dump($_POST);
	if ( $_POST['discount'] > 0 ) {
		$discount = $_POST['discount'];
	} else {
		$discount = 0;
	}
	
	
	$uniqueKey = generateUniqueKey();
	
	while ( checkKey($uniqueKey, $pdo) ) {
		$uniqueKey = generateUniqueKey();
	}
	
	$images = "";
	
	$numOfImages = sizeof($_FILES['itemImage']['name']);
	for ( $count = 0; $count < $numOfImages; $count++ ) {
		if ( $_FILES['itemImage']['error'][$count] == 0 ) {
				$image_dir = "../../images/";
				$image_ext = pathinfo($image_dir . basename($_FILES['itemImage']['name'][$count]), PATHINFO_EXTENSION);
				$image_file = $image_dir . $uniqueKey;
				$thumb_file = $image_dir . "thumbnails/" . $uniqueKey;
				
				$check = getimagesize($_FILES['itemImage']['tmp_name'][$count]);
				if ( $check ) {
					if ( file_exists($image_file . "." . $image_ext) ) {
						$i = 1;
						while ( file_exists($image_file . "_" . $i . "." . $image_ext) ) {
							$i++;
						}
						$image_file .= "_" . $i;
						$thumb_file .= "_" . $i; 
					}
					if ( move_uploaded_file($_FILES['itemImage']['tmp_name'][$count], $image_file . "." . $image_ext) ) {
						create_thumb($image_file . "." . $image_ext, 200, 200, $thumb_file . '.' . $image_ext);
					}
				} else {
					echo var_dump("Not Image");
				}
				
				$images .= basename($image_file) . "." . $image_ext . "|";
			}
	}
	
	//echo var_dump($uniqueKey);
	$addItem = $pdo->prepare("INSERT INTO `items` (`unique_key`, `item_name`, `item_value`, `discount`, `image`, `category`) VALUES (:key, :name, :value, :discount, :image, :category)");
	$addItem->execute(array(
		":key" => $uniqueKey,
		":name" => $_POST['name'],
		":value" => $_POST['price'],
		":discount" => $discount,
		":image" => $images,
		":category" => 4
	));

	$addInfo = $pdo->prepare("INSERT INTO `rings` (`unique_key`, `stone`, `stone_carat`, `num_of_stones`, `material`, `material_carat`, `height`, `length`) VALUES 
		(:key, :stone, :stoneWeight, :numStones, :material, :materialWeight, :height, :length)");
	$addInfo->execute(array(
		":key" => $uniqueKey,
		":stone" => $_POST['stone'],
		"stoneWeight" => $_POST['stone_weight'],
		"numStones" => $_POST['num_of_stones'],
		"material" => $_POST['material'],
		"materialWeight" => $_POST['material_weight'],
		"height" => $_POST['height'],
		"length" => $_POST['length'],
	));

} else if ( isset($_POST['featuredAdd']) ) {
	$addFeatured = $pdo->prepare("UPDATE `items` SET `featured` = 1 WHERE `id` = :id");
	$addFeatured->execute(array(":id" => $_POST['featuredAdd']));
	
} else if ( isset ($_POST['featuredRemove']) ) {
	$removeFeatured = $pdo->prepare("UPDATE `items` SET `featured` = 0 WHERE `id` = :id");
	$removeFeatured->execute(array(":id" => $_POST['featuredRemove']));
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
?>
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Rings - Admin Panel</title>
    <!-- Bootstrap -->
    <link href="../../css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel='stylesheet prefetch' href='http://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css'>
    <!-- Custom Theme Style -->
    <link href="../admin-assets/custom.min.css" rel="stylesheet">
    <link href="../../css/site.css" rel="stylesheet">
  </head>

  <body class="nav-md">
    <div class="container body" style="background-color:#911116">
      <div class="main_container">
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
        <h3>Rings <button class="btn btn-custom" data-toggle="modal" data-target="#myModal">Add</button></h3>
        	<table class="table table-hover" >
            	<thead>
                	<th>Name</th>
                	<th>Value</th>
                	<th>Discount (%)</th>
                	<th>Images</th>
                	<th style="text-align:center;">Featured</th>
                </thead>
                <tbody>
                	<?php
					$query = $pdo->prepare("SELECT * FROM `items` WHERE `category` = :cat");
					$query->execute(array(":cat" => 4 ));
					$result = $query->fetchAll();
					
					foreach ( $result as $entry ) {
						$price = '€'.$entry['item_value'];
						
						$images = explode ("|", $entry['image']);
						$listImage = "";
						foreach ( $images as $image ) {
							if ( !is_null($image) ) {
								$listImage .= $image . "   ";
							}
						}
						if ( $entry['discount'] > 0 ) {
							$discounted = $entry['item_value'] - (( $entry['discount'] / 100) * $entry['item_value']);
							$price = '<small class="old-price">€' . $entry['item_value'] . '</small> <span class="glyphicon glyphicon-chevron-right"></span> €' . round($discounted, 2);
						}
						echo '<tr>';
							echo '<td>'. $entry['item_name'] .'</td>';
							echo '<td>'. $price .'</td>';
							echo '<td>'. $entry['discount'] .'</td>';
							echo '<td>'. $listImage .'</td>';
							if ( $entry['featured'] == 1 ) {
								$featured = '<form method="post"><button class="glyphicon glyphicon-star glyphicon-custom" name="featuredRemove" value="'. $entry['id'] .'" data-toggle="tooltip" title="Remove from Featured"></button></form>';
							} else {
								$featured = '<form method="post"><button class="glyphicon glyphicon-star-empty glyphicon-custom" name="featuredAdd" value="'. $entry['id'] .'" data-toggle="tooltip" title="Add to Featured"></button></form>';
							}
							echo '<td style="text-align:center;">'. $featured .'</td>';
						echo '</tr>';
					}
					?>
                </tbody>
            </table>
        </div>
        
        <?php include 'add_item.php'; ?>
        
        </div>
        <!-- /page content -->

        <!-- footer content -->
        <footer style="margin-top:-10px;">
          <?php include 'footer.php'; ?>
        </footer>
        <!-- /footer content -->
      </div>
    </div>

    <!-- jQuery -->
    
	<script src="../../js/jquery-1.12.0.js"></script>
    <script src="../../js/bootstrap.min.js"></script>
    <script src="../admin-assets/custom.min.js"></script>
    <script>
	$(document).ready(function(){
		$('[data-toggle="tooltip"]').tooltip(); 
	});
	</script>
  </body>
</html>
