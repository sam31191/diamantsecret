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
	    <title>Export Excel - Admin Panel</title>
	    <!-- Bootstrap -->
	    <link href="../../css/bootstrap.min.css" rel="stylesheet">
	    <!-- Font Awesome -->
	    <!-- Custom Theme Style -->
	    <link href="../assets/custom.min.css" rel="stylesheet">
	    <link href="../assets/font-awesome.min.css" rel="stylesheet">
	    <link href="../assets/admin.css" rel="stylesheet">
	  </head>
	  <body class="nav-md">

	  
        <div id="uploadDiv" style="background:rgba(0,0,0,0.75); height:100%; width:100%; position:fixed; z-index:100" hidden>
        	<a href="javascript:void(0);"><span id="uploadDivCloseIcon" class="fa fa-close" style="font-size: 20px; margin: 20px; right: 0px; position: absolute; color: #F44336;" onclick="$('#uploadDiv').toggle();" data-toggle="tooltip" data-placement="bottom" title="Close"></span></a>

        		
        	<div class="alert alert-info" id="resultDiv" style="position: absolute; left: 50%; top: 50%; text-align: center; width: 800px; height: 300px; margin-left: -400px; margin-top: -150px; overflow: auto; font-variant:normal;background: rgb(238, 238, 238) none repeat scroll 0% 0%; color: black; border: none;">
	        	<img src="../../images/cube.gif">
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
        
		        <h3>Export to Excel <?php
		        	$countAll = $pdo->prepare("SELECT `id` FROM `items`");
		        	$countAll->execute();
		        		echo '<h3><small>' . $countAll->rowCount() . ' Items Found</small>
					        		<div id="bulkManage" style="float:right">
					                <button class="btn btn-success" name="bulkManage" onClick="exportAll()">Export All</button>
					                <button class="btn btn-info" name="bulkManage" onClick="exportSelected()">Export Selected (<span class="selected-num">0</span>)</button>
					            </form>
					        </h3>';
		        	?></h3>
		        	<table class="table table-hover table-custom" style="display:block; overflow:auto; white-space:nowrap; min-height: 80vh;" >
		            	<thead>
		                	<th><input id="masterCheckbox" type="checkbox" onClick="selectAll(this)"></th>
		                	<th>Type</th>
		                	<th>ID</th>
		                	<th>Internal ID</th>
		                	<th>Company ID</th>
		                	<th>Name</th>
		                	<th>Price</th>
		                	<th>Discount</th>
		                	<th>Stock</th>
		                	<th>Shipment Days</th>
		                	<th>Carat Weight</th>
		                	<th># of Stones</th>
		                	<th>Diamond Shape</th>
		                	<th>Clarity</th>
		                	<th>Color</th>
		                	<th>Material</th>
		                	<th>Height</th>
		                	<th>Weight</th>
		                	<th>Length</th>
		                	<th>Country</th>
		                	<th>Images</th>
		                	<th style="max-width:150px;">Description</th>
		                </thead>
		                <tbody>
		                	<?php
							$query = $pdo->prepare("SELECT * FROM `items`");
							$query->execute();
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
									echo '<td>'. $info['material'] .'</td>';
									echo '<td>'. $info['height'] .'</td>';
									echo '<td>'. $info['width'] .'</td>';
									echo '<td>'. $info['length'] .'</td>';
									echo '<td>'. $info['country_id'] .'</td>';
									echo '<td>'. intval(sizeof(explode(",", $info['images'])) - 1) .' image(s)</td>';
									$desc = $info['description'];
									echo '<td>'. $desc .'</td>';

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

function exportSelected() {
	alert("Exporting Selected");

	var selected = "";
	$(".select-checkbox").each(function (index, element) {
		if ( $(element).is(":checked") ) {
			//console.log($(element).attr("id"));
			selected += $(element).val() + "_";
		}
	});

	console.log(selected);

	$.ajax({
		url: './ajax.php?exportSelected=' + selected,
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
	    	$('#resultDiv').html('<img src="../../images/cube.gif"><h5 style="position: absolute; top: 0; font-style: italic;">Exporting ...</h5>');
	    	$('#uploadDivCloseIcon').hide();
	    },
	    complete: function() {
	    	$('#uploadDivCloseIcon').show();
	    },
		success: function(result) {
			console.log("JSON RESULT");
			console.log(result);
			$("#uploadDiv").show();
			$("#resultDiv").html(result);
		}
	});
}

function exportAll() {
	alert("Exporting All");
	$.ajax({
		url: './ajax.php?exportSelected=',
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
	    	$('#resultDiv').html('<img src="../../images/cube.gif"><h5 style="position: absolute; top: 0; font-style: italic;">Exporting ...</h5>');
	    	$('#uploadDivCloseIcon').hide();
	    },
	    complete: function() {
	    	$('#uploadDivCloseIcon').show();
	    },
		success: function(result) {
			console.log("JSON RESULT");
			console.log(result);
			$("#uploadDiv").show();
			$("#resultDiv").html(result);
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