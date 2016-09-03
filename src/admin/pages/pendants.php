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
	if ( !$_SESSION['modSession'] || $_SESSION['admin'] <= 0 ) {
		header ('Location: ../../index.php');
		die();
	}
}
include '../../url/require.php';

	
if ( isset($_POST['addItem']) ) {
	pconsole($_FILES);
	pconsole($_POST);
	
	if ( $_POST['discount'] > 0 ) {
		$discount = $_POST['discount'];
	} else {
		$discount = 0;
	}
	
	
	$uniqueKey = generateUniqueKey();
	
	while ( checkKey($uniqueKey, $pdo) ) {
		$uniqueKey = generateUniqueKey();
	}

	pconsole($uniqueKey);
	pconsole($_POST);

	$addInfo = $pdo->prepare("INSERT INTO `pendants` 
			(`unique_key`, `company_id`, `internal_id`, `product_name`, `pieces_in_stock`, `days_for_shipment`, `total_carat_weight`, `no_of_stones`, `diamond_shape`, `clarity`, `color`, `material`, `height`, `width`, `length`, `country_id`, `images`, `description`) 
			VALUES 
			(:unique_key, :company_id, :internal_id, :product_name, :pieces_in_stock, :days_for_shipment, :total_carat_weight, :no_of_stones, :diamond_shape, :clarity, :color, :material, :height, :width, :length, :country_id, :images, :description)");
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
			":color" => $_POST['color'],
			":material" => $_POST['material'],
			":height" => $_POST['height'],
			":width" => $_POST['width'],
			":length" => $_POST['length'],
			":country_id" => $_POST['country_id'],
			":images" => "",
			":description" => $_POST['description']
		));

	$images = "";


	$getitemID = $pdo->prepare("SELECT `id` FROM `pendants` WHERE `unique_key` = :unique_key");
	$getitemID->execute(array(":unique_key" => $uniqueKey));
	$itemID = $getitemID->fetch(PDO::FETCH_ASSOC);
	$itemID = $itemID['id'];
	
	$numOfImages = sizeof($_FILES['itemImage']['name']);
	for ( $count = 0; $count < $numOfImages; $count++ ) {
		if ( $_FILES['itemImage']['error'][$count] == 0 ) {
				$image_dir = "../../images/";
				$image_ext = pathinfo($image_dir . basename($_FILES['itemImage']['name'][$count]), PATHINFO_EXTENSION);
				$image_file = $image_dir . 'pendant_' . $itemID;
				$thumb_file = $image_dir . "thumbnails/pendant_" . $itemID;
				
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
				
				$images .= basename($image_file) . "." . $image_ext . ",";
			}
	}

	pconsole($images);
	$updateItemImages = $pdo->prepare("UPDATE `pendants` SET `images` = :images WHERE `unique_key` = :unique_key");
	$updateItemImages->execute(array(":images" => $images, ":unique_key" => $uniqueKey));

	$addItem = $pdo->prepare("INSERT INTO `items` (`unique_key`, `item_name`, `item_value`, `discount`, `category`, `featured`, `date_added`) VALUES (:unique_key, :product_name, :product_price, :discount, :category, 0, NOW())");
	$addItem->execute(array(
		":unique_key" => $uniqueKey,
		":product_name" => $_POST['product_name'],
		":product_price" => $_POST['product_price'],
		":discount" => $discount,
		":category" => 3
	));
	
	
	//echo var_dump($uniqueKey);

} else if ( isset($_POST['featuredAdd']) ) {
	$addFeatured = $pdo->prepare("UPDATE `items` SET `featured` = 1 WHERE `id` = :id");
	$addFeatured->execute(array(":id" => $_POST['featuredAdd']));
	
} else if ( isset ($_POST['featuredRemove']) ) {
	$removeFeatured = $pdo->prepare("UPDATE `items` SET `featured` = 0 WHERE `id` = :id");
	$removeFeatured->execute(array(":id" => $_POST['featuredRemove']));
} else if ( isset($_POST['bulkManage']) ) {
	pconsole($_POST);
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
				$getItem = $pdo->prepare("SELECT * FROM `pendants` WHERE `unique_key` = :key");
				$getItem->execute(array(":key" => key($_POST)));

				$result = $getItem->fetch(PDO::FETCH_ASSOC);
				
				$images = $result['images'];
				$images = explode(",", $images);

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

				$deleteFromTable = $pdo->prepare("DELETE FROM `pendants` WHERE `unique_key` = :key");
				$deleteFromTable->execute(array(":key" => key($_POST)));

				$deleteItem = $pdo->prepare("DELETE FROM `items` WHERE `unique_key` = :key");
				$deleteItem->execute(array(":key" => key($_POST)));

			}
			next($_POST);
		}
	}
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
    <title>pendants - Admin Panel</title>
    <!-- Bootstrap -->
    <link href="../../css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <!-- Custom Theme Style -->
    <link href="../assets/custom.min.css" rel="stylesheet">
    <link href="../assets/font-awesome.min.css" rel="stylesheet">
    <link href="../assets/admin.css" rel="stylesheet">
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
        <h3>pendants <button class="btn btn-custom" data-toggle="modal" data-target="#myModal">Add</button>
            <form method="post" id="bulkManage" style="float:right">
                <button class="btn btn-warning" name="bulkManage" value="feature">Add to Featured (<span class="selected-num">0</span>)</button>
                <button class="btn btn-default" name="bulkManage" value="unfeature">Remove from Featured (<span class="selected-num">0</span>)</button>
                <a class="btn btn-danger" onclick="bulkRemoveItems()">Delete Selected (<span class="selected-num">0</span>)</a>
                <button class="btn btn-success" name="bulkManage">Move Selected (<span class="selected-num">0</span>)</button>
                <button class="btn btn-info" name="bulkManage">Copy Selected (<span class="selected-num">0</span>)</button>
            </form></h3>
        	<table class="table table-hover table-custom" style="display:block; overflow:auto; white-space:nowrap; min-height: 80vh;" >
            	<thead>
                	<th><input id="masterCheckbox" type="checkbox" onClick="selectAll(this)"></th>
                	<th>ID</th>
                	<th>Featured</th>
                	<th>Action</th>
                	<th>Internal ID</th>
                	<th>Company ID</th>
                	<th>Name</th>
                	<th>Price</th>
                	<th>Discount</th>
                	<th>Stock</th>
                	<th>Shipment Days</th>
                	<th>Carat Weigt</th>
                	<th># of Stones</th>
                	<th>Diamond Shape</th>
                	<th>Clarity</th>
                	<th>Color</th>
                	<th>Material</th>
                	<th>Height</th>
                	<th>Weight</th>
                	<th>Length</th>
                	<th>Country</th>
                	<th>Sub Category</th>
                	<th>Size</th>
                	<th>Images</th>
                	<th>Description</th>
                </thead>
                <tbody>
                	<?php
					$query = $pdo->prepare("SELECT * FROM `items` WHERE `category` = :cat");
					$query->execute(array(":cat" => 3 ));
					$result = $query->fetchAll();
					
					foreach ( $result as $entry ) {

						$getInfo = $pdo->prepare("SELECT * FROM `pendants` WHERE `unique_key` = :unique_key");
						$getInfo->execute(array(":unique_key" => $entry['unique_key']));
						$info = $getInfo->fetch(PDO::FETCH_ASSOC);

						$price = '€'.$entry['item_value'];

						if ( $entry['discount'] > 0 ) {
							$discounted = $entry['item_value'] - (( $entry['discount'] / 100) * $entry['item_value']);
							$price = '<div style="display:block" ><small class="old-price">€' . $entry['item_value'] . '</small> <span class="glyphicon glyphicon-chevron-right"></span> €' . round($discounted, 2) .'</div>';
						}
						echo '<tr>';
							echo '<td><input class="select-checkbox" type="checkbox" form="bulkManage" name="'. $entry['unique_key'] .'" onclick="selectItem(this)"></td>';
							
							echo '<td>'. $info['id'] .'</td>';

							if ( $entry['featured'] == 1 ) {
								$featured = '<form method="post"><button class="glyphicon glyphicon-star glyphicon-custom" name="featuredRemove" value="'. $entry['id'] .'" data-toggle="tooltip" title="Remove from Featured"></button></form>';
							} else {
								$featured = '<form method="post"><button class="glyphicon glyphicon-star-empty glyphicon-custom" name="featuredAdd" value="'. $entry['id'] .'" data-toggle="tooltip" title="Add to Featured"></button></form>';
							}
							echo '<td style="text-align:center;">'. $featured .'</td>';

							$editModal = '<button class="fa fa-pencil glyphicon-custom" style="color:#607d8b" title="Edit Item" data-toggle="tooltip"></button>';

							$removeModal = '<button class="fa fa-trash glyphicon-custom" style="color:#607d8b" title="Remove Item" data-toggle="tooltip"></button>';
							echo '<td>' . $editModal . $removeModal . '</td>';

							echo '<td>'. $info['internal_id'] .'</td>';
							echo '<td>'. $info['company_id'] .'</td>';
							echo '<td>'. $info['product_name'] .'</td>';
							echo '<td>'. $price .'</td>';
							echo '<td>'. $entry['discount'] .'%</td>';
							echo '<td>'. $info['pieces_in_stock'] .'</td>';
							echo '<td>'. $info['days_for_shipment'] .'</td>';
							echo '<td>'. $info['total_carat_weight'] .'</td>';
							echo '<td>'. $info['no_of_stones'] .'</td>';
							echo '<td>'. $info['diamond_shape'] .'</td>';
							echo '<td>'. $info['clarity'] .'</td>';
							echo '<td>'. $info['color'] .'</td>';
							echo '<td>'. $info['material'] .'</td>';
							echo '<td>'. $info['height'] .'</td>';
							echo '<td>'. $info['width'] .'</td>';
							echo '<td>'. $info['length'] .'</td>';
							echo '<td>'. $info['country_id'] .'</td>';
							echo '<td>'. $info['images'] .'</td>';
							echo '<td>'. $info['description'] .'</td>';

						echo '</tr>';
					}
					?>
                </tbody>
            </table>
        </div>
        </div>
        <!-- /page content -->

        <!-- footer content -->
        <footer style="margin-top:-20px;">
          <?php include 'footer.php'; ?>
        </footer>
        <!-- /footer content -->
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

	function editItem(e) {
		console.log($(e).text());
		currentVal = $(e).text();
		$(e).html("<input class='form-control' id='temp-edit-input'>");
		$("#temp-edit-input").focus();
		$("#temp-edit-input").val(currentVal);
		$(e).removeAttr("onclick");
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
	</script>
  </body>
</html>

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
            <h5>Note: This action can not be undone.</h5> <!-- Bulk Delete Modal -->
        </div>
      </div> <!-- Bulk Delete Modal -->
      <div class="modal-footer">
        <input id="removeModalActionButton" type="submit" class="btn btn-custom" name="bulkManage" value="delete" form="bulkManage" />
        <button type="button" class="btn btn-custom" data-dismiss="modal">Close</button>
      </div>
      </form>
    </div>
  </div>
</div>


<div id="myModal" class="modal fade" role="dialog">
	  <div class="modal-dialog modal-lg">

	    <!-- Modal content-->
	    <div class="modal-content">
	      <div class="modal-header">
	        <button type="button" class="close" data-dismiss="modal">&times;</button>
	        <h4 class="modal-title">Add New</h4>
	      </div>
	      <form method="post" enctype="multipart/form-data" id="addItemForm">
	      <div class="modal-body">
	        <div class="container">
	            <div class="col-sm-12">
					<tbody>
						<tr class="table-row">
							<td class="table-item-label"><span class="table-item-label">Name</span></td>
							<td>
								<div class="table-item">
									<input name="product_name" type="text" class="form-control" placeholder="Product Name (50 Characters)" required maxlength="50" pattern="{0,50}" title="N">
								</div>
							</td>
						</tr>
						<tr>
							<td><span class="table-item-label">Price</span></td>
							<td>
								<div class="table-item">
									<input name="product_price" type="text" class="form-control" placeholder="Product Price € (Decimal Number)" required pattern="[0-9]{1,}[.]{1}[0-9]{2,2}" title="Format: 100.00">
								</div>
							</td>
						</tr>
						<tr>
							<td><span class="table-item-label">Discount</span></td>
							<td>
								<div class="table-item">
									<input name="discount" type="text" class="form-control" placeholder="Discount % (Number)" pattern="[0-9]{1,2}" title="0 - 99%">
								</div>
							</td>
						</tr>
						<tr>
							<td><span class="table-item-label">Pieces in Stock</span></td>
							<td>
								<div class="table-item">
									<input name="pieces_in_stock" type="text" class="form-control" placeholder="Stock (Number)" required>
								</div>
							</td>
						</tr>
						<tr>
							<td><span class="table-item-label">Days for Shipment</span></td>
							<td>
								<div class="table-item">
									<input name="days_for_shipment" type="text" class="form-control" placeholder="Shipment (Number)" required>
								</div>
							</td>
						</tr>
						<tr>
							<td><span class="table-item-label">Total Carat Weight</span></td>
							<td>
								<div class="table-item">
									<input name="total_carat_weight" type="text" class="form-control" placeholder="Total Carat (Decimel Number)">
								</div>
							</td>
						</tr>
						<tr>
							<td><span class="table-item-label">Number of Stones</span></td>
							<td>
								<div class="table-item">
									<input name="no_of_stones" type="text" class="form-control" placeholder="Stones (Number)">
								</div>
							</td>
						</tr>
						<tr>
							<td><span class="table-item-label">Diamond Shape</span></td>
							<td>
								<div class="table-item">
									<select name="diamond_shape" class="select-style" required>
			                            <option value="">Diamond Shape</option>
			                            <option value="1">Round</option>
			                            <option value="2">Marquise</option>
			                            <option value="3">Princess</option>
			                            <option value="4">Pear</option>
			                            <option value="5">Emerald</option>
			                            <option value="6">Heart</option>
			                            <option value="7">Oval</option>
			                            <option value="8">Cushion</option>
			                            <option value="9">Radiant</option>
			                            <option value="10">Cus. Brilliant</option>
			                            <option value="11">LRadiant</option>
			                            <option value="12">SQEmerald</option>
			                        </select>
								</div>
							</td>
						</tr>
						<tr>
							<td><span class="table-item-label">Clarity</span></td>
							<td>
								<div class="table-item">
									<select name="clarity" class="select-style" required>
			                            <option value="">Clarity</option>
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
									<select name="color" class="select-style" required>
			                            <option value="">Color</option>
			                            <option value="1">White Stone</option>
			                            <option value="2">Colored Stone</option>
			                        </select>
								</div>
							</td>
						</tr>
						<tr>
							<td><span class="table-item-label">Material</span></td>
							<td>
								<div class="table-item">
									<select name="material" class="select-style" required>
			                            <option value="">Material</option>
			                            <option value="1">Yellow Gold</option>
			                            <option value="2">White Gold</option>
			                            <option value="3">Pink Gold</option>
			                        </select>
								</div>
							</td>
						</tr>
						<tr>
							<td><span class="table-item-label">Height</span></td>
							<td>
								<div class="table-item">
									<input name="height" type="text" class="form-control" placeholder="Height (Number)">
								</div>
							</td>
						</tr>
						<tr>
							<td><span class="table-item-label">Width</span></td>
							<td>
								<div class="table-item">
									<input name="width" type="text" class="form-control" placeholder="Width (Number)">
								</div>
							</td>
						</tr>
						<tr>
							<td> <span class="table-item-label">Length</span></td>
							<td>
								<div class="table-item">
									<input name="length" type="text" class="form-control" placeholder="Length (Number)">
								</div>
							</td>
						</tr>
						<tr>
							<td> <span class="table-item-label">Country ID</span></td>
							<td>
								<div class="table-item">
									<select name="country_id" class="select-style" required>
			                            <option value="">Country ID</option>
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
							<td> <span class="table-item-label">Company ID</span></td>
							<td>
								<div class="table-item">
									<input name="company_id" type="text" class="form-control" placeholder="Company ID (Number)" required>
								</div>
							</td>
						</tr>
						<tr>
							<td> <span class="table-item-label">Internal ID</span></td>
							<td>
								<div class="table-item">
									<input name="internal_id" type="text" class="form-control" placeholder="Internal ID (Mixed Characters)" required>
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
									<textarea form="addItemForm" class="form-control" style="width:100%" placeholder="Description Goes Here (500 Characters)" name="description"></textarea>
								</div>
							</td>
						</tr>
					</tbody>
	            </div>  
	        </div>
	      </div>
	      <div class="modal-footer">
	        <button type="submit" class="btn btn-custom" name="addItem" >Submit</button>
	        <button type="button" class="btn btn-custom" data-dismiss="modal">Close</button>
	      </div>
	      </form>
	    </div>
	  </div>
	</div>
