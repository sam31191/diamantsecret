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

	//echo var_dump($_POST);
	//echo var_dump($_FILES['itemImage']['error'][0]);
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
						create_thumb($image_file . "." . $image_ext, 200, 200, $thumb_file . '.' . $image_ext, $image_ext);
					}
				} else {
					echo var_dump("Not Image");
				}
				
				$images .= basename($image_file) . "." . $image_ext . ",";
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
		":category" => 2
	));


	$addInfo = $pdo->prepare("INSERT INTO `pendants` (`unique_key`, `stone`, `stone_carat`, `num_of_stones`, `material`, `material_carat`, `height`, `length`) VALUES 
		(:key, :stone, :stoneWeight, :numStones, :material, :materialWeight, :height, :length)");
	$addInfo->execute(array(
		":key" => $uniqueKey,
		":stone" => $_POST['stone'],
		":stoneWeight" => $_POST['stone_weight'],
		":numStones" => $_POST['num_of_stones'],
		":material" => $_POST['material'],
		":materialWeight" => $_POST['material_weight'],
		":height" => $_POST['height'],
		":length" => $_POST['length'],
	));

} else if ( isset($_POST['featuredAdd']) ) {
	$addFeatured = $pdo->prepare("UPDATE `items` SET `featured` = 1 WHERE `unique_key` = :id");
	$addFeatured->execute(array(":id" => $_POST['featuredAdd']));
	
} else if ( isset ($_POST['featuredRemove']) ) {
	$removeFeatured = $pdo->prepare("UPDATE `items` SET `featured` = 0 WHERE `unique_key` = :id");
	$removeFeatured->execute(array(":id" => $_POST['featuredRemove']));
} else if ( isset($_POST['removeItem']) ) {
	//echo var_dump($_POST);

	$fetchInfo = $pdo->prepare("SELECT * FROM `items` WHERE `unique_key` = :id");
	$fetchInfo->execute(array(":id" => $_POST['removeItem']));

	$images = $fetchInfo->fetch(PDO::FETCH_ASSOC);
	$images = explode(",", $images['image']);

	foreach ( $images as $image ) {
		if ( $image !== "") {
			//echo var_dump($image);
			$imageFile = "../../images/" . $image;
			$thumb = "../../images/thumbnails/" . $image;
			if ( file_exists($imageFile) ) {
				unlink($imageFile);
			}
			if ( file_exists($thumb) ) {
				unlink($thumb);
			}
		}
	} 
	$removeItem = $pdo->prepare("DELETE FROM `items` WHERE `unique_key` = :id");
	$removeItem->execute(array(":id" => $_POST['removeItem']));

	$removePendant = $pdo->prepare("DELETE FROM `pendants` WHERE `unique_key` = :id");
	$removePendant->execute(array(":id" => $_POST['removeItem']));

} else if ( isset($_POST['editItem']) ) {
	if ( $_POST['discount'] > 0 ) {
		$discount = $_POST['discount'];
	} else {
		$discount = 0;
	}
	
	//echo var_dump($_POST);
	//echo var_dump($uniqueKey);
	$addItem = $pdo->prepare("UPDATE `items` SET `item_name` = :name, `item_value` = :value, `discount` = :discount, `category` = :category WHERE `unique_key` = :key");
	$addItem->execute(array(
		":key" => $_POST['unique_key'],
		":name" => $_POST['name'],
		":value" => $_POST['price'],
		":discount" => $_POST['discount'],
		":category" => 2
	));

	$checkInfo = $pdo->prepare("SELECT * FROM `pendants` WHERE `unique_key` = :key");
	$checkInfo->execute(array(":key" => $_POST['unique_key']));
	if ( $checkInfo->rowCount() > 0 ) {
		$updateInfo = $pdo->prepare("UPDATE `pendants` SET `stone` = :stone, `stone_carat` = :stoneWeight, `num_of_stones` = :numStones, `material` = :material, `material_carat` = :materialWeight, `height` = :height, `length` = :length WHERE `unique_key` = :key");
		$updateInfo->execute(array(
			":key" => $_POST['unique_key'],
			":stone" => $_POST['stone'],
			":stoneWeight" => $_POST['stone_weight'],
			":numStones" => $_POST['num_of_stones'],
			":material" => $_POST['material'],
			":materialWeight" => $_POST['material_weight'],
			":height" => $_POST['height'],
			":length" => $_POST['length'],
		));
	} else {
		$addInfo = $pdo->prepare("INSERT INTO `pendants` (`unique_key`, `stone`, `stone_carat`, `num_of_stones`, `material`, `material_carat`, `height`, `length`) VALUES 
			(:key, :stone, :stoneWeight, :numStones, :material, :materialWeight, :height, :length)");
		$addInfo->execute(array(
			":key" => $_POST['unique_key'],
			":stone" => $_POST['stone'],
			":stoneWeight" => $_POST['stone_weight'],
			":numStones" => $_POST['num_of_stones'],
			":material" => $_POST['material'],
			":materialWeight" => $_POST['material_weight'],
			":height" => $_POST['height'],
			":length" => $_POST['length'],
		));
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
	}
}

function create_thumb($file, $w, $h,  $thumb_dir, $ext, $crop=FALSE) {
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
	if ( $ext == "jpg" || $ext == "jpeg") {
		$src = imagecreatefromjpeg($file);
	} else if ( $ext == "png" ) {
		$src = imagecreatefrompng($file);
	}	
	$dst = imagecreatetruecolor($newwidth, $newheight);
	$white = imagecolorallocatealpha($dst, 255, 255, 255, 0);
	imagefill($dst, 0, 0, $white);

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
    <title>Pendants - Admin Panel</title>
    <!-- Bootstrap -->
    <link href="../../css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
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
        <h3>Pendants <button class="btn btn-custom" data-toggle="modal" data-target="#myModal">Add</button></h3>
        	<table class="table table-hover table-condensed" >
            	<thead>
                	<th><input id="masterCheckbox" type="checkbox" onClick="selectAll(this)"></th>
                	<th>Name</th>
                	<th>Value</th>
                	<th>Discount (%)</th>
                	<th>Images</th>
                	<th>Featured</th>
                	<th>Action</th>
                </thead>
                <tbody>
                	<?php
					$query = $pdo->prepare("SELECT * FROM `items` WHERE `category` = :cat");
					$query->execute(array(":cat" => 2 ));
					$result = $query->fetchAll();
					foreach ( $result as $entry ) {
						$price = '€'.$entry['item_value'];
						
						$fetchInfo = $pdo->prepare("SELECT * FROM `pendants` WHERE `unique_key` = :key");
						$fetchInfo->execute(array(":key" => $entry['unique_key']));
						
						$info = $fetchInfo->fetch(PDO::FETCH_ASSOC);
						
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
							echo '<td><input class="select-checkbox" type="checkbox" form="bulkManage" name="'. $entry['unique_key'] .'" onclick="selectItem(this)"></td>';
							echo '<td>'. $entry['item_name'] .'</td>';
							echo '<td>'. $price .'</td>';
							echo '<td>'. $entry['discount'] .'</td>';
							echo '<td>'. $listImage .'</td>';

							$editModal = '<button class="glyphicon glyphicon-pencil glyphicon-custom" title="Edit Item" data-toggle="tooltip" onclick="editItemModal(\''. $entry['unique_key'] .'\', \''. $entry['item_name'] .'\', \''. $entry['item_value'] .'\', \''. $entry['discount'] .'\', \''. $info['stone'] .'\', \''. $info['stone_carat'] .'\', \''. $info['num_of_stones'] .'\', \''. $info['material'] .'\', \''. $info['material_carat'] .'\', \''. $info['height'] .'\', \''. $info['length'] .'\')"></button>';

							$removeModal = '<button class="glyphicon glyphicon-remove glyphicon-custom" title="Remove Item" data-toggle="tooltip" onclick="showItemRemoveModal(\''. $entry['unique_key'] .'\', \''. $entry['item_name'] .'\')"></button>';
							
							if ( $entry['featured'] == 1 ) {
								$featured = '<form method="post">
								<button class="glyphicon glyphicon-star glyphicon-custom" name="featuredRemove" value="'. $entry['unique_key'] .'" data-toggle="tooltip" title="Remove from Featured"></button>
								</form>';
							} else {
								$featured = '<form method="post">
								<button class="glyphicon glyphicon-star-empty glyphicon-custom" name="featuredAdd" value="'. $entry['unique_key'] .'" data-toggle="tooltip" title="Add to Featured"></button>
								</form>';
							}

							echo '<td style="text-align:center;">'. $featured .'</td>';
							echo '<td>'. $removeModal . $editModal .'</td>';
						echo '</tr>';
					}
					
					?>
                </tbody>
            </table>
            <form method="post" id="bulkManage" style="float:right">
                <button class="btn btn-warning" name="bulkManage" value="feature">Add to Featured (<span class="selected-num">0</span>)</button>
                <button class="btn btn-default" name="bulkManage" value="unfeature">Remove from Featured (<span class="selected-num">0</span>)</button>
                <button class="btn btn-danger" name="bulkManage">Delete Selected (<span class="selected-num">0</span>)</button>
                <button class="btn btn-success" name="bulkManage">Move Selected (<span class="selected-num">0</span>)</button>
                <button class="btn btn-info" name="bulkManage">Copy Selected (<span class="selected-num">0</span>)</button>
            </form>
        </div>
        
        <?php include 'add_item.php'; ?>
        
        </div>
        <!-- /page content -->

        <!-- footer content -->
        <footer style="margin-top:-10px;">
          <?php include 'footer.php'; ?>
        </footer>
        <!-- /footer content -->


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
              <div class="modal-body">
                <div class="container">
                    <h4>You are about to remove <strong id="itemToRemove">This</strong>
                    <br>Are you sure you want to remove it?</h4>
                    <br>
                    <h5>Note: This action can not be undone.</h5>
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

        <div id="promptEditModal" class="modal fade" role="dialog">
          <div class="modal-dialog modal-lg">
        
            <!-- Modal content-->
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h5 class="modal-title">Editing: <strong id="itemToEdit">This</strong></h5>
              </div>
              <form method="post" enctype="multipart/form-data">
              <div class="modal-body">
                <div class="container">
					<input id="unique_key" name="unique_key" hidden>
                    <div class="col-sm-12">
                      <div class="input-group">
                        <span class="input-group-addon"> Name </span>
                        <input id="name" name="name" type="text" class="form-control" placeholder="Item Name" required>
                      </div>
                    </div>

                    <div class="col-sm-7">
                      <div class="input-group">
                        <span class="input-group-addon"> Price </span>
                        <input id="price" name="price" type="text" class="form-control" placeholder="Hint: 999.99" pattern="[0-9]{1,9}[.][0-9]{2}" title="(9.99)(499.99)" required>
                      </div>
                    </div>

                    <div class="col-sm-5">
                      <div class="input-group">
                        <span class="input-group-addon"> Discount </span>
                        <input id="discount" name="discount" type="text" class="form-control" placeholder="Hint: 10" pattern="[0-9]{1,2}" title="1 - 99">
                      </div>
                    </div>

                    <div class="col-sm-4">
                      <div class="input-group">
                        <span class="input-group-addon"> Stone </span>
                        <input id="stone" name="stone" type="text" class="form-control" placeholder="Diamond / Emerald etc">
                      </div>
                    </div>

                    <div class="col-sm-4">
                      <div class="input-group">
                        <span class="input-group-addon"> Stone Weight</span>
                        <input id="stone_weight" name ="stone_weight" type="text" class="form-control" placeholder="Carat (Hint: 1.0)" pattern="[0-9]{1,5}.[0-9]{1,2}">
                      </div>
                    </div>
                    
                    <div class="col-sm-4">
                      <div class="input-group">
                        <span class="input-group-addon"> No. of Stones </span>
                        <input id="num_of_stones" name="num_of_stones" type="text" class="form-control" placeholder="No. of Stones" pattern="[0-9]{1,3}" title="1 - 999">
                      </div>
                    </div>

                    <div class="col-sm-6">
                        <div class="input-group">
                          <span class="input-group-addon">Material</span>
                          <select id="material" name="material" class="select-style" required>
                            <option value="">Material</option>
                            <option value="Gold">Gold</option>
                            <option value="White Gold">White Gold</option>
                            <option value="Pink Gold">Pink Gold</option>
                          </select>
                        </div>
                    </div>

                    <div class="col-sm-6">
                      <div class="input-group">
                        <span class="input-group-addon"> Material Weight</span>
                        <input id="material_weight" name ="material_weight" type="text" class="form-control" placeholder="Carat (Hint: 24)" pattern="[0-9]{1,5}">
                      </div>
                    </div>
                    
                    <div class="col-sm-6">
                      <div class="input-group">
                        <span class="input-group-addon"> Prod. Height </span>
                        <input id="height" name="height" type="text" class="form-control" placeholder="Height (Hint: 1.5)" pattern="[0-9]{1,5}.[0-9]{1,2}">
                      </div>
                    </div>

                    <div class="col-sm-6">
                      <div class="input-group">
                        <span class="input-group-addon"> Prod. Length</span>
                        <input id="length" name ="length" type="text" class="form-control" placeholder="Length (Hint: 1.5)" pattern="[0-9]{1,5}.[0-9]{1,2}">
                      </div>
                    </div>
                       
                </div>
              </div>
              <div class="modal-footer">
                <button type="submit" class="btn btn-custom" name="editItem" >Submit</button>
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
    <script src="../admin-assets/custom.min.js"></script>
    <script>
	$(document).ready(function(){
		$('[data-toggle="tooltip"]').tooltip(); 
	});

	function showItemRemoveModal(key, name) {
		$("#itemToRemove").html(name);
		$("#removeModalActionButton").val(key);

		$("#promptRemoveModal").modal("toggle");
	}
	function editItemModal(key, name, price, discount, stone, stone_weight, num_of_stones, material, material_weight, length, height) {
		
		$("#itemToEdit").html(name);
		$("#editModalActionButton").val(key);
		$("#unique_key").val(key);
		$("#name").val(name);
		$("#price").val(price);
		$("#discount").val(discount);
		$("#stone").val(stone);
		$("#stone_weight").val(stone_weight);
		$("#num_of_stones").val(num_of_stones);
		$("#material option[value='"+ material +"'").attr("selected", true);
		$("#material_weight").val(material_weight);
		$("#height").val(height);
		$("#length").val(length);
		
		$("#promptEditModal").modal("toggle");
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
	
	</script>
  </body>
</html>
