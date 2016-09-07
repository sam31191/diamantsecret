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
	    <title>Import Excel - Admin Panel</title>
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
	        <h3>Import via Excel</h3>
	        	<form method="post" enctype="multipart/form-data">
	        		<input type="file" name="excel">
	        		<button class="btn btn-custom" name="import" style="margin: 10px;">Select File</button>
	        	</form>
	        	<div  style="border:solid thin #ccc; padding:5px; margin:5px;">
	        		<h4></h4>
	        		<?php
	        			unset($_SESSION['tmp_file']);
	        			//echo var_dump($_FILES);
	        			if ( isset($_FILES['excel']) ) {
		        			if ( $_FILES['excel']['error'] == 0 && $_FILES['excel']['type'] == "application/vnd.openxmlformats-officedocument.spreadsheetml.sheet" ) {
		        				echo '
						        	<div style="float:right;">
						        		<button class="btn btn-info" onclick="importSelected()">Import Selected (<span class="selected-num">0</span>)</button>
						        	</div>';
						        	#<button class="btn btn-info" onclick="importAll()">Import All</button> 

		        				copy($_FILES['excel']['tmp_name'], "../excel_files/tmp_db" . "." . pathinfo($_FILES['excel']['name'], PATHINFO_EXTENSION));
		        				//echo var_dump($_FILES['excel']['type']);

		        				$_SESSION['tmp_file'] = $ext = "../excel_files/tmp_db" . "." . pathinfo($_FILES['excel']['name'], PATHINFO_EXTENSION);
			        			$xlFile = $_FILES['excel']['tmp_name'];
								$PHPExcel = PHPExcel_IOFactory::load($xlFile);

								//$xl = $PHPExcel->getActiveSheet()->toArray(null, true, true, true);

								$productSheet = $PHPExcel->getSheetByName('products');
								if ( is_null($productSheet) ) {
									echo "Sheet not found";
								} else {
									$products = $productSheet->toArray(null, true, true, true);

									echo '<table class="table table-hover table-custom" style="display:block; overflow:auto; white-space:nowrap;">';
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
										foreach ( $products[$i] as $rows ) {
											echo '<td>'. $rows .'</td>';
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

function importSelected() {
	alert("Importing Selected");

	var selected = "";
	$(".select-checkbox").each(function (index, element) {
		if ( $(element).is(":checked") ) {
			//console.log($(element).attr("id"));
			selected += $(element).val() + "_";
		}
	});

	console.log(selected);

	$.ajax({
		url: './ajax.php?addSelected=' + selected,
		type: 'GET',
		timeout: 3600000,
		xhr: function() {
	        var xhr = new window.XMLHttpRequest();
	        xhr.upload.addEventListener("progress", function(evt) {
	            if (evt.lengthComputable) {
	                var percentComplete = evt.loaded / evt.total;
	                alert(percentComplete);
	            }
	       }, false);

	       xhr.addEventListener("progress", function(evt) {
	           if (evt.lengthComputable) {
	               var percentComplete = evt.loaded / evt.total;
	               alert(percentComplete);
	           }
	       }, false);

	       return xhr;
	    },
	    beforeSend: function() {
	    	$('#uploadDiv').show();
	    	$('#resultDiv').html('<img src="../../images/cube.gif"><h5 style="position: absolute; top: 0; font-style: italic;">Importing ...</h5>');
	    	$('#uploadDivCloseIcon').hide();
	    },
	    complete: function(result) {
	    	$('#uploadDivCloseIcon').show();
			console.log("JSON Complete");
			console.log(result);
	    },
		success: function(result) {
			console.log("JSON Success");
			console.log(result);
			$("#uploadDiv").show();
			$("#resultDiv").html(result);
		},
		failure: function (error) {
			console.log("JSON Error");
			console.log(error);
		},
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