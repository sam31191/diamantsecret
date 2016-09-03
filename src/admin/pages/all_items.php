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

if ( isset($_POST['featuredAdd']) ) {
	$addFeatured = $pdo->prepare("UPDATE `items` SET `featured` = 1 WHERE `id` = :id");
	$addFeatured->execute(array(":id" => $_POST['featuredAdd']));
	
} else if ( isset ($_POST['featuredRemove']) ) {
	$removeFeatured = $pdo->prepare("UPDATE `items` SET `featured` = 0 WHERE `id` = :id");
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

	switch ($_POST['category']) {
		case 1: {
			$removeItem2 = $pdo->prepare("DELETE FROM `rings` WHERE `unique_key` = :id");
			break;
		}
		case 2:	{
			$removeItem2 = $pdo->prepare("DELETE FROM `earrings` WHERE `unique_key` = :id");
			break;
		}
		case 3: {
			$removeItem2 = $pdo->prepare("DELETE FROM `pendants` WHERE `unique_key` = :id");
			break;
		}
		case 4: {
			$removeItem2 = $pdo->prepare("DELETE FROM `necklaces` WHERE `unique_key` = :id");
			break;
		}
		case 5: {
			$removeItem2 = $pdo->prepare("DELETE FROM `bracelets` WHERE `unique_key` = :id");
			break;
		}
	}
	$removeItem2->execute(array(":id" => $_POST['removeItem']));

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
				$updateInfo = $pdo->prepare("UPDATE `rings` SET `stone` = :stone, `stone_carat` = :stoneWeight, `num_of_stones` = :numStones, `material` = :material, `material_carat` = :materialWeight, `height` = :height, `length` = :length WHERE `unique_key` = :key");
				break;
			}
			case 2:	{
				$updateInfo = $pdo->prepare("UPDATE `earrings` SET `stone` = :stone, `stone_carat` = :stoneWeight, `num_of_stones` = :numStones, `material` = :material, `material_carat` = :materialWeight, `height` = :height, `length` = :length WHERE `unique_key` = :key");
				break;
			}
			case 3: {
				$updateInfo = $pdo->prepare("UPDATE `pendants` SET `stone` = :stone, `stone_carat` = :stoneWeight, `num_of_stones` = :numStones, `material` = :material, `material_carat` = :materialWeight, `height` = :height, `length` = :length WHERE `unique_key` = :key");
				break;
			}
			case 4: {
				$updateInfo = $pdo->prepare("UPDATE `necklaces` SET `stone` = :stone, `stone_carat` = :stoneWeight, `num_of_stones` = :numStones, `material` = :material, `material_carat` = :materialWeight, `height` = :height, `length` = :length WHERE `unique_key` = :key");
				break;
			}
			case 5: {
				$updateInfo = $pdo->prepare("UPDATE `bracelets` SET `stone` = :stone, `stone_carat` = :stoneWeight, `num_of_stones` = :numStones, `material` = :material, `material_carat` = :materialWeight, `height` = :height, `length` = :length WHERE `unique_key` = :key");
				break;
			}
		}
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
		switch ($_POST['category']) {
			case 1: {
				$addInfo = $pdo->prepare("INSERT INTO `rings` (`unique_key`, `stone`, `stone_carat`, `num_of_stones`, `material`, `material_carat`, `height`, `length`) VALUES 
				(:key, :stone, :stoneWeight, :numStones, :material, :materialWeight, :height, :length)");
				break;
			}
			case 2: {
				$addInfo = $pdo->prepare("INSERT INTO `earrings` (`unique_key`, `stone`, `stone_carat`, `num_of_stones`, `material`, `material_carat`, `height`, `length`) VALUES 
				(:key, :stone, :stoneWeight, :numStones, :material, :materialWeight, :height, :length)");
				break;
			}
			case 3:	{
				$addInfo = $pdo->prepare("INSERT INTO `pendants` (`unique_key`, `stone`, `stone_carat`, `num_of_stones`, `material`, `material_carat`, `height`, `length`) VALUES 
				(:key, :stone, :stoneWeight, :numStones, :material, :materialWeight, :height, :length)");
				break;
			}
			case 4: {
				$addInfo = $pdo->prepare("INSERT INTO `necklaces` (`unique_key`, `stone`, `stone_carat`, `num_of_stones`, `material`, `material_carat`, `height`, `length`) VALUES 
				(:key, :stone, :stoneWeight, :numStones, :material, :materialWeight, :height, :length)");
				break;
			}
			case 5: {
				$addInfo = $pdo->prepare("INSERT INTO `bracelets` (`unique_key`, `stone`, `stone_carat`, `num_of_stones`, `material`, `material_carat`, `height`, `length`) VALUES 
				(:key, :stone, :stoneWeight, :numStones, :material, :materialWeight, :height, :length)");
				break;
			}
		}
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
	} else if ( $_POST['bulkManage'] == "delete") {
		while ( $checkbox = current($_POST)) {
			if ( $checkbox == "on" ) {
				$getItem = $pdo->prepare("SELECT * FROM `items` WHERE `unique_key` = :key");
				$getItem->execute(array(":key" => key($_POST)));

				$result = $getItem->fetch(PDO::FETCH_ASSOC);
				
				$images = $result['image'];
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
}
?>
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>All Items - Admin Panel</title>
    <!-- Bootstrap -->
    <link href="../../css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <!-- Custom Theme Style -->
    <link href="../assets/custom.min.css" rel="stylesheet">
    <link href="../assets/font-awesome.min.css" rel="stylesheet">
    <link href="../assets/admin.css" rel="stylesheet">
  </head>

  <body class="nav-md">
    <div class="container body">
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
        
        <h3>All <?php
        	$countAll = $pdo->prepare("SELECT `id` FROM `items`");
        	$countAll->execute();
        		echo '<h3><small>' . $countAll->rowCount() . ' Items Found</small>
			        		<form method="post" id="bulkManage" style="float:right">
			                <button class="btn btn-warning" name="bulkManage" value="feature">Add to Featured (<span class="selected-num">0</span>)</button>
			                <button class="btn btn-default" name="bulkManage" value="unfeature">Remove from Featured (<span class="selected-num">0</span>)</button>
			                <a class="btn btn-danger" onclick="bulkRemoveItems()">Delete Selected (<span class="selected-num">0</span>)</a>
			                <button class="btn btn-success" name="bulkManage">Move Selected (<span class="selected-num">0</span>)</button>
			                <button class="btn btn-info" name="bulkManage">Copy Selected (<span class="selected-num">0</span>)</button>
			            </form>
			        </h3>';
        	?></h3>
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
					$query->execute(array(":cat" => 1 ));
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
							echo '<td>'. $info['ring_subcategory'] .'</td>';
							echo '<td>'. $info['ring_size'] .'</td>';
							echo '<td>'. $info['images'] .'</td>';
							echo '<td>'. $info['description'] .'</td>';

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
        <footer style="margin-top:-20px;">
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
              <input id="remove_category" name="category" hidden>
              <div class="modal-body">
                <div class="container">
                    <h4>You are about to permanently delete <strong id="itemToRemove">This</strong>
                    <br>Are you sure you want to perform this action?</h4>
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
					<input id="edit_category" name="category" hidden>
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
    <script src="../assets/custom.min.js"></script>
    <script>
	$(document).ready(function(){
		$('[data-toggle="tooltip"]').tooltip(); 
	});

	function showItemRemoveModal(key, name, category) {
		$("#itemToRemove").html(name);
		$("#removeModalActionButton").val(key);
		$("#remove_category").val(category);

		$("#promptRemoveModal").modal("toggle");
	}
	function editItemModal(key, name, price, discount, stone, stone_weight, num_of_stones, material, material_weight, length, height, category) {
		
		$("#itemToEdit").html(name);
		$("#editModalActionButton").val(key);
		$("#unique_key").val(key);
		$("#edit_category").val(category);
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

    function bulkRemoveItems() {
    	$("#itemsToRemove").text($(".selected-num").first().text() + " Item(s)");
    	$("#promptBulkRemoveModal").modal("toggle");
    }
	
	</script>
  </body>
</html>
