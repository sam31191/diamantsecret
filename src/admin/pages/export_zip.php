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
?>
<!DOCTYPE html>
	<html lang="en">
	<?php
	include '../../conf/config.php';

	/** Include path **/
	set_include_path(get_include_path() . PATH_SEPARATOR . '../PHPExcel/PHPExcel/');

	/** PHPExcel_IOFactory */
	include '../PHPExcel/PHPExcel/IOFactory.php';
	?>
	  <head>
	    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	    <!-- Meta, title, CSS, favicons, etc. -->
	    <meta charset="utf-8">
	    <meta http-equiv="X-UA-Compatible" content="IE=edge">
	    <meta name="viewport" content="width=device-width, initial-scale=1">
	    <title>Export Zip - Admin Panel</title>
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

	  
        <div id="uploadDiv" style="background:rgba(0,0,0,0.75); height:100%; width:100%; position:fixed; z-index:100" hidden>
        	

        		
        	<div style="position: absolute; left: 50%; top: 50%; text-align: center; width: 800px; height: 300px; margin-left: -400px; margin-top: -150px; overflow: auto; font-variant:normal;background: rgb(238, 238, 238) none repeat scroll 0% 0%; color: black; border: none;">
        		<a href="javascript:void(0);" id="uploadDivCloseIcon" class="btn btn-danger" style="font-size: 20px; margin: 19px; position: absolute; display: block; z-index: 1; right: 0;" onclick="finalizeExport()" data-toggle="tooltip" data-placement="bottom" title="Close">Close</a>
        	</div>
        	
        	<div class="alert alert-info" id="resultDiv" style="position: absolute; left: 50%; top: 50%; text-align: center; width: 800px; height: 300px; margin-left: -400px; margin-top: -150px; overflow: auto; font-variant:normal;background: rgb(238, 238, 238) none repeat scroll 0% 0%; color: black; border: none;">
	        	<img src="../../images/gfx/cube_lg.gif">
	        	<h5 style="    position: absolute; top: 0; font-style: italic;">Importing ...</h5>
        	</div>
        </div>

	    <div class="container body" style="background-color:#607d8b;">
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
        
		        <h3>Export to Zip 
		        	<div class="btn-group">
		            <?php 
		                if ( isset($_GET['show']) ){
		                    switch($_GET['show']) {
		                        case 1: {
		                            $showTag = 'Rings';
		                            break;
		                        } case 2: {
		                            $showTag = 'Earrings';
		                            break;
		                        } case 3: {
		                            $showTag = 'Pendants';
		                            break;
		                        } case 4: {
		                            $showTag = 'Necklaces';
		                            break;
		                        } case 5: {
		                            $showTag = 'Bracelets';
		                            break;
		                        } default: {
		                            $showTag = "All";
			    					$currentShowing = "";
			    					$show = "";
		                            break;
		                        }
		                    }
		                } else {
		                    $showTag = 'All'; 
		                }
		        		echo '<button type="button" class="btn btn-custom dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
		        			'. $showTag .' <span class="fa fa-caret-down"></span>
		        		</button>';
			    		$filter = "id";
			    		$currentOrder = "ASC";
			    		if ( isset($_GET['filter']) && isset($_GET['order']) ) {
			    			$filter = $_GET['filter'];
			    			$currentOrder = $_GET['order'];
			    		}
			    		if ( $currentOrder == "ASC" ) {
			    			$nextOrder = "DESC";
			    		} else {
			    			$nextOrder = "ASC";
			    		}
			    		if ( isset($_GET['show']) && !empty($_GET['show']) ) {
			    			$show = " WHERE `category` = " . $_GET['show'];
			    			$currentShowing = $_GET['show'];
			    		} else {
			    			$show = "";
			    			$currentShowing = "";
			    		}
		        		echo'
						  <ul class="dropdown-menu">
						    <li><a href="?filter='. $filter .'&order='. $currentOrder .'">All</a></li>
						    <li><a href="?filter='. $filter .'&order='. $currentOrder .'&show=1">Rings</a></li>
						    <li><a href="?filter='. $filter .'&order='. $currentOrder .'&show=2">Earrings</a></li>
						    <li><a href="?filter='. $filter .'&order='. $currentOrder .'&show=3">Pendants</a></li>
						    <li><a href="?filter='. $filter .'&order='. $currentOrder .'&show=4">Necklaces</a></li>
						    <li><a href="?filter='. $filter .'&order='. $currentOrder .'&show=5">Bracelets</a></li>
						  </ul>
						  ';
					?>
					</div>
		        <?php

					$count = $pdo->prepare("SELECT COUNT(*) AS totalRows FROM `items`". $show. "");
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
		        		$filter = "date_added";
		        		$order = "ASC";
		        		$currentOrder = "DESC";
		        	}
					if ( isset($_GET['page']) ) {
						$offset = $_GET['page'] * $perPage;
					} else {
						$offset = 0;
					}

		        	$countAll = $pdo->prepare("SELECT `id` FROM `items`". $show);
		        	$countAll->execute();
		        		echo '<h3><small>' . $countAll->rowCount() . ' Items Found</small>
					        		<div id="bulkManage" style="float:right">
					                <button class="btn btn-success" name="bulkManage" onClick="exportAll('. $currentShowing .')">Export '. $showTag .'</button>
					                <button class="btn btn-info" name="bulkManage" onClick="exportSelected()">Export Selected (<span class="selected-num">0</span>)</button>
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
		            				$typeCaret = '<i class="fa fa-caret-down"></i>';
		            				break;
		            			} case 'category ASC': {
		            				$typeCaret = '<i class="fa fa-caret-up"></i>';
		            				break;
		            			} case 'id ASC': {
		            				$idCaret = '<i class="fa fa-caret-down"></i>';
		            				break;
		            			} case 'id DESC': {
		            				$idCaret = '<i class="fa fa-caret-up"></i>';
		            				break;
		            			} case 'featured ASC': {
		            				$featuredCaret = '<i class="fa fa-caret-down"></i>';
		            				break;
		            			} case 'featured DESC': {
		            				$featuredCaret = '<i class="fa fa-caret-up"></i>';
		            				break;
		            			} case 'internal_id ASC': {
		            				$internalIDCaret = '<i class="fa fa-caret-down"></i>';
		            				break;
		            			} case 'internal_id DESC': {
		            				$internalIDCaret = '<i class="fa fa-caret-up"></i>';
		            				break;
		            			} case 'company_id ASC': {
		            				$companyCaret = '<i class="fa fa-caret-down"></i>';
		            				break;
		            			} case 'company_id DESC': {
		            				$companyCaret = '<i class="fa fa-caret-up"></i>';
		            				break;
		            			} case 'item_name ASC': {
		            				$nameCaret = '<i class="fa fa-caret-down"></i>';
		            				break;
		            			} case 'item_name DESC': {
		            				$nameCaret = '<i class="fa fa-caret-up"></i>';
		            				break;
		            			} case 'item_value ASC': {
		            				$priceCaret = '<i class="fa fa-caret-down"></i>';
		            				break;
		            			} case 'item_value DESC': {
		            				$priceCaret = '<i class="fa fa-caret-up"></i>';
		            				break;
		            			} case 'discount ASC': {
		            				$discountCaret = '<i class="fa fa-caret-down"></i>';
		            				break;
		            			} case 'discount DESC': {
		            				$discountCaret = '<i class="fa fa-caret-up"></i>';
		            				break;
		            			} case 'pieces_in_stock ASC': {
		            				$stockCaret = '<i class="fa fa-caret-down"></i>';
		            				break;
		            			} case 'pieces_in_stock DESC': {
		            				$stockCaret = '<i class="fa fa-caret-up"></i>';
		            				break;
		            			} case 'days_for_shipment ASC': {
		            				$shipmentCaret = '<i class="fa fa-caret-down"></i>';
		            				break;
		            			} case 'days_for_shipment DESC': {
		            				$shipmentCaret = '<i class="fa fa-caret-up"></i>';
		            				break;
		            			} case 'total_carat_weight ASC': {
		            				$caratWeightCaret = '<i class="fa fa-caret-down"></i>';
		            				break;
		            			} case 'total_carat_weight DESC': {
		            				$caratWeightCaret = '<i class="fa fa-caret-up"></i>';
		            				break;
		            			} case 'no_of_stones ASC': {
		            				$numOfStonesCaret = '<i class="fa fa-caret-down"></i>';
		            				break;
		            			} case 'no_of_stones DESC': {
		            				$numOfStonesCaret = '<i class="fa fa-caret-up"></i>';
		            				break;
		            			} case 'diamond_shape ASC': {
		            				$diamondShapeCaret = '<i class="fa fa-caret-down"></i>';
		            				break;
		            			} case 'diamond_shape DESC': {
		            				$diamondShapeCaret = '<i class="fa fa-caret-up"></i>';
		            				break;
		            			} case 'clarity ASC': {
		            				$clarityCaret = '<i class="fa fa-caret-down"></i>';
		            				break;
		            			} case 'clarity DESC': {
		            				$clarityCaret = '<i class="fa fa-caret-up"></i>';
		            				break;
		            			} case 'color ASC': {
		            				$colorCaret = '<i class="fa fa-caret-down"></i>';
		            				break;
		            			} case 'color DESC': {
		            				$colorCaret = '<i class="fa fa-caret-up"></i>';
		            				break;
		            			} case 'material ASC': {
		            				$materialCaret = '<i class="fa fa-caret-down"></i>';
		            				break;
		            			} case 'material DESC': {
		            				$materialCaret = '<i class="fa fa-caret-up"></i>';
		            				break;
		            			} case 'height ASC': {
		            				$heightCaret = '<i class="fa fa-caret-down"></i>';
		            				break;
		            			} case 'height DESC': {
		            				$heightCaret = '<i class="fa fa-caret-up"></i>';
		            				break;
		            			} case 'width ASC': {
		            				$widthCaret = '<i class="fa fa-caret-down"></i>';
		            				break;
		            			} case 'width DESC': {
		            				$widthCaret = '<i class="fa fa-caret-up"></i>';
		            				break;
		            			} case 'length ASC': {
		            				$lengthCaret = '<i class="fa fa-caret-down"></i>';
		            				break;
		            			} case 'length DESC': {
		            				$lengthCaret = '<i class="fa fa-caret-up"></i>';
		            				break;
		            			} case 'country_id ASC': {
		            				$countryCaret = '<i class="fa fa-caret-down"></i>';
		            				break;
		            			} case 'country_id DESC': {
		            				$countryCaret = '<i class="fa fa-caret-up"></i>';
		            				break;
		            			} case 'ring_size ASC': {
		            				$ringSizeCaret = '<i class="fa fa-caret-down"></i>';
		            				break;
		            			} case 'ring_size DESC': {
		            				$ringSizeCaret = '<i class="fa fa-caret-up"></i>';
		            				break;
		            			} case 'ring_subcategory ASC': {
		            				$ringCategoryCaret = '<i class="fa fa-caret-down"></i>';
		            				break;
		            			} case 'ring_subcategory DESC': {
		            				$ringCategoryCaret = '<i class="fa fa-caret-up"></i>';
		            				break;
		            			} case 'date_added ASC': {
		            				$dateAddedCaret = '<i class="fa fa-caret-down"></i>';
		            				break;
		            			} case 'date_added DESC': {
		            				$dateAddedCaret = '<i class="fa fa-caret-up"></i>';
		            				break;
		            			} default: {

		            				break;
		            			}
		            		}

		            		?>
		                	<th><input id="masterCheckbox" type="checkbox" onClick="selectAll(this)"></th>
		                	<th><?php echo '<a href="?page='. $currentPage .'&filter=category&order='. $order .'&show='. $currentShowing .'">Type '. $typeCaret .'</a>'; ?></th>
		                	<th><?php echo '<a href="?page='. $currentPage .'&filter=id&order='. $order .'&show='. $currentShowing .'">ID '. $idCaret .'</a>'; ?></th>
		                	<th>Internal ID</th>
		                	<th>Company</th>
		                	<th><?php echo '<a href="?page='. $currentPage .'&filter=item_name&order='. $order .'&show='. $currentShowing .'">Name '. $nameCaret .'</a>'; ?></th>
		                	<th><?php echo '<a href="?page='. $currentPage .'&filter=item_value&order='. $order .'&show='. $currentShowing .'">Price '. $priceCaret .'</a>'; ?></th>
		                	<th><?php echo '<a href="?page='. $currentPage .'&filter=discount&order='. $order .'&show='. $currentShowing .'">Discount '. $discountCaret .'</a>'; ?></th>
		                	<th>Stock</th>
		                	<th>Shipment Days</th>
		                	<th>Carat Weight</th>
		                	<th># of Stones</th>
		                	<th>Diamond Shape</th>
		                	<th>Clarity</th>
		                	<th>Color</th>
		                	<th>Diamond Color</th>
		                	<th>Material</th>
		                	<th>Height</th>
		                	<th>Weight</th>
		                	<th>Length</th>
		                	<th>Country</th>
		                	<th>Images</th>
		                	<th style="max-width:150px;">Description</th>
		                	<th style="max-width:150px;">Description (French)</th>
		                </thead>
		                <tbody>
		                	<?php
							$query = $pdo->prepare("SELECT * FROM `items`". $show ." ORDER BY ". $filter . " " . $currentOrder . " LIMIT ". $offset .", ". $perPage ." ");
							$query->execute();
							pconsole($query);
							$result = $query->fetchAll();
							
							for ( $i = 0; $i < sizeof($result); $i++ ) {

								$entry = $result[$i];
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
									} default: {
										return;
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
									echo '<td><input class="select-checkbox" type="checkbox" form="bulkManage" id="row_'.$entry['unique_key'].'" value="'. $entry['unique_key'] .'"></td>';
									
									echo '<td>'. $entry['category'] .'</td>';
									echo '<td>'. $info['id'] .'</td>';
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
									echo '<td>'. $info['diamond_color'] .'</td>';
									echo '<td>'. $info['material'] .'</td>';
									echo '<td>'. $info['height'] .'</td>';
									echo '<td>'. $info['width'] .'</td>';
									echo '<td>'. $info['length'] .'</td>';
									echo '<td>'. $info['country_id'] .'</td>';
									echo '<td>'. intval(sizeof(explode(",", $info['images'])) - 1) .' image(s)</td>';
									$desc = $info['description'];
									echo '<td>'. $desc .'</td>';
									echo '<td>'. $info['description_french'] .'</td>';

								echo '</tr>';
							}
							?>
		                </tbody>
		            </table>
		            <nav aria-label="Page navigation" style="display: block; text-align: center;">
					  <ul class="pagination" style="margin-top:0px;">
					  <?php 

					  	for ( $i = 0; $i < $pages; $i++ ) {
					  		if ( $i == 0 ) {
					  			echo '<li><a href="?page='. $i .'&filter='. $filter .'&order='. $currentOrder .'&show='. $currentShowing .'">first</a></li>';
					  		}

					  		if ( $i > $currentPage - 3 && $i < $currentPage + 3 ) {
					  			$class = "";
					  			if ( $i == $currentPage ) {
					  				$class = "active";
					  			}
					  			echo '<li class="'. $class .'"><a href="?page='. $i .'&filter='. $filter .'&order='. $currentOrder .'&show='. $currentShowing .'">'. intval($i+1) .'</a></li>';
					  		}else if ( $i > $currentPage - 4 && $i < $currentPage + 4 ) {
					  			echo '<li><a href="#">.</a></li>';
					  		}

					  		if ( $i == intval($pages) ){
					  			echo '<li><a href="?page='. $i .'&filter='. $filter .'&order='. $currentOrder .'&show='. $currentShowing .'">last</a></li>';
					  		}
					  	}
					  ?>
					  </ul>
					</nav>
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

var exportFile = "";
function exportSelected() {
	//alert("Exporting Selected");

	var selected = "";
	$(".select-checkbox").each(function (index, element) {
		if ( $(element).is(":checked") ) {
			//console.log($(element).attr("id"));
			selected += $(element).val() + "_";
		}
	});

	console.log(selected);

	$.ajax({
		url: './ajax.php?exportSelectedZip=' + selected,
		type: 'GET',
		xhr: function() {
	        var xhr = new window.XMLHttpRequest();
	        xhr.upload.addEventListener("progress", function(evt) {
	            if (evt.lengthComputable) {
	                var percentComplete = evt.loaded / evt.total;
	                //console.log(percentComplete);
	            }
	       }, false);

	       xhr.addEventListener("progress", function(evt) {
	           if (evt.lengthComputable) {
	               var percentComplete = evt.loaded / evt.total;
	               //console.log(percentComplete);
	           }
	       }, false);

	       return xhr;
	    },
	    beforeSend: function() {
	    	$('#uploadDiv').show();
	    	$('#resultDiv').html('<img src="../../images/gfx/cube_lg.gif"><h5 style="position: absolute; top: 0; font-style: italic;">Exporting ...</h5>');
	    	$('#uploadDivCloseIcon').hide();
	    },
	    complete: function() {
	    	$('#uploadDivCloseIcon').show();
	    },
		success: function(result) {
			console.log("JSON RESULT");
			console.log(result);
			result = JSON.parse(result);
			$("#uploadDiv").show();
			$("#resultDiv").html(result[0]);
			exportFile = result[1];
		}
	});
}


function exportAll(category = 0) {
	//alert("Exporting All");
	$.ajax({
		url: './ajax.php?exportAllZip=' + category,
		type: 'GET',
		xhr: function() {
	        var xhr = new window.XMLHttpRequest();
	        xhr.upload.addEventListener("progress", function(evt) {
	            if (evt.lengthComputable) {
	                var percentComplete = evt.loaded / evt.total;
	                //console.log(percentComplete);
	            }
	       }, false);

	       xhr.addEventListener("progress", function(evt) {
	           if (evt.lengthComputable) {
	               var percentComplete = evt.loaded / evt.total;
	               //console.log(percentComplete);
	           }
	       }, false);

	       return xhr;
	    },
	    beforeSend: function() {
	    	$('#uploadDiv').show();
	    	$('#resultDiv').html('<img src="../../images/gfx/cube_lg.gif"><h5 style="position: absolute; top: 0; font-style: italic;">Exporting ...</h5>');
	    	$('#uploadDivCloseIcon').hide();
	    },
	    complete: function() {
	    	$('#uploadDivCloseIcon').show();
	    },
		success: function(result) {
			console.log("JSON RESULT");
			console.log(result);
			if ( JSON.parse(result) ) {	
				result = JSON.parse(result);
				$("#uploadDiv").show();
				$("#resultDiv").html(result[0]);
				exportFile = result[1];
			} else {
				$("#uploadDiv").show();
				$("#resultDiv").html("An error occured, please try again, if the error continues to persist, please try exporting in chunks");
			}
		}
	});
}

function finalizeExport() {
	$.ajax({
		url: './ajax.php?finalizeExport=' + exportFile,
		type: 'GET',
		complete: function() {
			window.location = "./export_zip.php";
		}
	});
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

	<?php pconsole($_SESSION); ?>