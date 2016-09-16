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
	    <title>Import Excel - Admin Panel</title>
	    <!-- Bootstrap -->
	    <link href="../../css/bootstrap.min.css" rel="stylesheet">
  	<link rel="icon" href="../../images/gfx/favicon.png?v=1" type="image/png" sizes="16x16">
	    <!-- Font Awesome -->
	    <!-- Custom Theme Style -->
	    <link href="../assets/custom.min.css" rel="stylesheet">
	    <link href="../assets/font-awesome.min.css" rel="stylesheet">
	    <link href="../assets/admin.css" rel="stylesheet">
	  </head>
	  <body class="nav-md">

	  <style type="text/css">
	  	@media (max-height: 800px){
		  	.table-custom-items {
		  		height: 50vh;
		  	}
	  	}
	  </style>
	  
        <div id="uploadDiv" style="background:rgba(0,0,0,0.75); height:100%; width:100%; position:fixed; z-index:100" hidden>
        <div class="alert alert-info" id="resultDiv" style="position: absolute; left: 50%; top: 50%; text-align: center; width: 800px; height: 400px; margin-left: -400px; margin-top: -200px; overflow: auto; font-variant:normal;background: rgb(238, 238, 238) none repeat scroll 0% 0%; color: black; border: none;">
	        	<h4><div class='alert alert-info' style="position: fixed;" id="alertDiv">Importing <span id="importedItems">0</span>/<span id="totalItems">0</span></div>
	        	<a href="javascript:void(0);" id="uploadDivCloseIcon" class="btn btn-danger" style="font-size: 20px; margin: 0px 16px; /* right: 0px; */ position: fixed; display: block; /* float: right; */ margin-left: 700px;" onclick="window.location = './import_excel.php';" data-toggle="tooltip" data-placement="bottom" title="Close">Close</a>
	        	</h4><table class='table table-condensed table-custom' style="table-layout: fixed; word-wrap: break-word;"><thead><th style="width: 30px;">#</th><th style="width: 60%;">Entry</th><th>Errors</th></thead><tbody id="resultTable"></tbody></table>
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
	        <h3>Import via Excel</h3>
	        	<form method="post" enctype="multipart/form-data">
	        		<table>
	        			<tr>
	        				<td>
	        					<select class="select-style" name="company_id" title="Select the Client" required>
				        			<option value="">Select Company</option>
				        			<?php
			                        $getCompanies = $pdo->prepare("SELECT * FROM `company_id`");
			                        $getCompanies->execute();

			                        if ( $getCompanies->rowCount() > 0 ) {
			                        	foreach ( $getCompanies as $company ) {
			                        		echo '<option value="'. $company['id'] .'">'. $company['company_name'] .'</option>';
			                        	}
			                        } else {
			                        	echo '<option value="0">N/A</option>';
			                        }
				        			?>
				        		</select>
	        				</td>
	        				<td>
				        		<input type="file" name="excel" style="border-bottom: none;" required>
	        				</td>
	        				<td>
	        					<button class="btn btn-info" name="import" style="margin: 10px;">Upload</button>
	        				</td>
	        			</tr>
	        		</table>
	        	</form>
	        	<div  style="border:solid thin #ccc; padding:5px; margin:5px;">
	        		<h4></h4>
	        		<a class="btn btn-custom" href="javascript:void(0);" onclick="downloadFormat()" style="float: right; margin-top: -60px;">Download Excel Format</a><a style="display:none;" href="./../assets/format.xlsx" id="downloadFormatStub"></a>
	        		<?php
	        			//echo var_dump($_FILES);
	        			if ( isset($_FILES['excel']) ) {
		        			if ( $_FILES['excel']['error'] == 0 && $_FILES['excel']['type'] == "application/vnd.openxmlformats-officedocument.spreadsheetml.sheet" ) {
						        	#<button class="btn btn-info" onclick="importAll()">Import All</button> 



		        				if ( isset($_SESSION['tmp_file']) && file_exists($_SESSION['tmp_file']) ) {
		        					unlink($_SESSION['tmp_file']);
		        				}

		        				$timeToken = time();
						        $tmpFile = "./../../working/excel/import/" . strtolower($_SESSION['username']) . "_" . $timeToken . "." . pathinfo($_FILES['excel']['name'], PATHINFO_EXTENSION);
						        $_SESSION['tmp_file'] = $tmpFile;
						        $_SESSION['import_company_id'] = $_POST['company_id'];

		        				pconsole($_SESSION);
		        				pconsole("TEMP:" . $tmpFile);


			        			$xlFile = $_FILES['excel']['tmp_name'];

		        				if ( copy($xlFile, $tmpFile) ) {
		        					pconsole("FILE CREATED: " . $xlFile);
		        				} else {
		        					pconsole("Couldn\'t Create File");
		        				}
		        				//echo var_dump($_FILES['excel']['type']);


								$PHPExcel = PHPExcel_IOFactory::load($xlFile);

								//$xl = $PHPExcel->getActiveSheet()->toArray(null, true, true, true);

								$productSheet = $PHPExcel->getSheetByName('products');
								if ( is_null($productSheet) ) {
									echo "Sheet not found";
								} else {
									$products = $productSheet->toArray(null, true, true, true);

	                        		pconsole("TEST: ". sizeof($products));

	                        		$numRings = 0;
	                        		$numEarrings = 0;
	                        		$numNecklaces = 0;
	                        		$numPendants = 0;
	                        		$numBracelets = 0;
	                        		$numInvalid = 0;

	                        		for ( $i = 0; $i < sizeof($products) - 1; $i++ ) {
	                        			pconsole("CATEGORY ". intval($i+2) . " = " . $productSheet->getCell('B'.intval($i+2))->getValue());
	                        			switch ($productSheet->getCell('B'.intval($i+2))->getValue()) {
	                        				case 1: {
	                        					$numRings++;
	                        					break;
	                        				} case 2: {
	                        					$numEarrings++;
	                        					break;
	                        				} case 3: {
	                        					$numPendants++;
	                        					break;
	                        				} case 4: {
	                        					$numNecklaces++;
	                        					break;
	                        				} case 5: {
	                        					$numBracelets++;
	                        					break;
	                        				} default: {
	                        					$numInvalid++;
	                        					break;
	                        				}
	                        			}
	                        		}

	                        		echo '
						        	<div style="float:right;">
						        		<button class="btn btn-info" onclick="importAll(\''. $timeToken .'\')">Import All</button>
						        		<button class="btn btn-info" onclick="importThis(\''. $timeToken .'\')">Import Selected (<span class="selected-num">0</span>)</button>
						        	</div>';

									if ( isset($_SESSION['import_company_id']) ) {
	                        			echo '<div style="margin: 10px;"><label>Client: '. getCompany($_SESSION['import_company_id'], $pdo) .'</label><br>
	                        			<label class="label label-warning label-custom">Total: '. intval(sizeof($products)-1) .'</label>
	                        			<label class="label label-info label-custom">Rings: '. $numRings .'</label>
	                        			<label class="label label-info label-custom">Earrings: '. $numEarrings .'</label>
	                        			<label class="label label-info label-custom">Pendants: '. $numPendants .'</label>
	                        			<label class="label label-info label-custom">Necklaces: '. $numNecklaces .'</label>
	                        			<label class="label label-info label-custom">Bracelets: '. $numBracelets .'</label>
	                        			<label class="label label-danger label-custom">Invalid Entries: '. $numInvalid .'</label></div>';
	                        		} 

									echo '<table class="table table-hover table-custom table-custom-items">';
									echo '<thead>';
									echo '<th><input id="masterCheckbox" type="checkbox" onClick="selectAll(this)"></th>';
									foreach ( $products[1] as $column ) {
										echo '<th>'. $column .'</th>';
									}
									echo '</thead>';
									echo '<tbody>';
									for ( $i = 2; $i <= sizeof($products); $i++ ) {
										echo '<tr>';
											echo '<td><input class="select-checkbox" type="checkbox" form="bulkManage" id="row_'.$i.'" value="'. $i .'"></td>';
										for ( $j = 'A'; $j <= 'V'; $j++ ) {
											//pconsole($products[$i][$j]);
											if ( $j == 'U' ) {
												$importRowImages = explode(",", $products[$i][$j]);
												$listImages = "";
												foreach ( $importRowImages as $image ) {
													$listImages .= '<li><a href=\"'. trim($image) .'\" target=\"_blank\">'. $image .'</a></li>';
												}
												$products[$i][$j] = "<button class='btn btn-custom btn-sm' onClick=' $(\"#imageModalBody\").html(\"". $listImages ."\"); $(\"#promptShowImages\").modal(\"toggle\");'>" . sizeof($importRowImages) . " image(s) </button>";
											}
											echo '<td>'. $products[$i][$j] .'</td>';
										}
										echo '</tr>';
									}
									echo '</tbody>';
									echo '</table>';
								}
		        			} else {
		        				echo '<div class="alert alert-error" style="font-variant:small-caps;">Error: File not valid</div>';
		        			}

	        			} else {
	        				echo '<div class="alert alert-info">Select an Excel file</div>';
	        			}
	        		?>
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

var currentAjax = 0;
var ajaxQ = [];

function importThis(timeToken){
	
	count = 0;
	$('#resultTable').html("");
	$('#importedItems').text(0);
	$(".select-checkbox").each(function (index, elemCount) {
		if ( $(elemCount).is(":checked") ) {
			count++;
		}
	});
	$(".select-checkbox").each(function (index, elem) {
		$('#totalItems').html(count);
		if ( $(elem).is(":checked") ) {
			//console.log($(element).attr("id"));
			id = $(elem).val();
			ajaxQ.push(id);
		}
	});

	checkQ(currentAjax);
}

function importAll(timeToken){
	
	count = 0;
	$('#resultTable').html("");
	$('#importedItems').text(0);
	$(".select-checkbox").each(function (index, elemCount) {
			count++;
	});
	$(".select-checkbox").each(function (index, elem) {
		$('#totalItems').html(count);
			id = $(elem).val();
			ajaxQ.push(id);
	});

	checkQ(timeToken);
}


function checkQ(timeToken) {
	console.log("Total: " + ajaxQ.length);
	console.log("Current: " + currentAjax);
	if ( currentAjax < ajaxQ.length ) {
		console.log("Running Query: " + currentAjax);
		$.ajax({
			url: './ajax.php?checkToken=' + timeToken,
			type: 'GET',
			success: function(result){
				if ( result == 1 ) {
					importAjax(ajaxQ[currentAjax], currentAjax, timeToken);
				} else {
					$('#resultDiv').html("<h4>Import Failure</h4><br><h5>File you tried to import from has been tampered with. You either have another window open with the same task or the Session has expired, please reload the page to continue.</h5><a href=\"javascript:void(0);\" id=\"uploadDivCloseIcon\" class=\"btn btn-danger\" style=\"font-size: 20px; margin: 0px 16px;\" onclick=\"window.location = './import_excel.php';\" data-toggle=\"tooltip\" data-placement=\"bottom\">Reload Page</a>");

	    			$('#uploadDiv').show();
				}
			}
		});
	} else {
		console.log("Ending at: " + currentAjax);
	}
}

function importAjax (id, index, timeToken) {
	$.ajax({
		url: './ajax.php?importThis=' + id + '&timeToken=' + timeToken,
		type: 'GET',
	    beforeSend: function() {
	    	$('#uploadDiv').show();
	    	$('#uploadDivCloseIcon').hide();
	    	$('#resultTable').append('<tr><td>'+ index +'</td><td id="row_'+ id +'_result">Loading</td><td id="row_'+ id +'_error"><img style="width:24px" src="../../images/gfx/cube.gif"></td></tr>');
    	
	    },
	    complete: function(result) {
			$('#importedItems').text(parseInt($('#importedItems').text()) + 1);
	    	if ( $('#totalItems').text() == $('#importedItems').text() ) {
		    	$('#uploadDivCloseIcon').show();
		    	$('#alertDiv').removeClass("alert-info");
		    	$('#alertDiv').addClass("alert-success");
		    	$('#alertDiv').html("Import Complete!");
		    }
			console.log("Finished Query: " + index);

			currentAjax++;
			checkQ(timeToken);

	    },
		success: function(result) {

			console.log(result);
			/*if ( result === String ) {
				
			} else {
				
			}*/
			try {
				JSON.parse(result);
				result = JSON.parse(result);
				console.log(result);
				$("#uploadDiv").show();
				$("#row_"+ result[2] +"_result").html(result[0]);
				$("#row_"+ result[2] +"_error").html(result[1]);
			} catch (e) {
				$('#resultDiv').html(result);
			}
		},
		failure: function (error) {
			console.log("JSON Error");
			console.log(error);
		},
	});
}
function downloadFormat() {
	$.ajax({
		url: './ajax.php?downloadFormat=true',
		type: 'GET',
		success: function(result) {
			console.log(result);
			window.location.href = './../assets/format.xlsx';
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


	<div id="promptShowImages" class="modal fade" role="dialog">
	  <div class="modal-dialog">

	    <!-- Modal content-->
	    <div class="modal-content"> <!-- Bulk Delete Modal -->
	      <div class="modal-header">
	        <button type="button" class="close" data-dismiss="modal">&times;</button> <!-- Bulk Delete Modal -->
	        <h4 class="modal-title">Images</h4> <!-- Bulk Delete Modal -->
	      </div>
	      <input id="remove_category" name="category" hidden>
	      <div class="modal-body"> <!-- Bulk Delete Modal -->
	        <div class="container" id="imageModalBody">
	            
	        </div>
	      </div> <!-- Bulk Delete Modal -->
	      <div class="modal-footer">
	        <button type="button" class="btn btn-custom" data-dismiss="modal">Close</button>
	      </div>
	      </form>
	    </div>
	  </div>
	</div>

	<?php pconsole($_FILES); ?>