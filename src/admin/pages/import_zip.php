<?php
include '../../conf/config.php';
ini_set('memory_limit',$__MAX_MEMORY_LIMIT__);
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
	    <title>Import Zip - Admin Panel</title>
	    <!-- Bootstrap -->
	    <link href="../../css/bootstrap.min.css" rel="stylesheet">
  	<link rel="icon" href="../../images/gfx/favicon.png?v=1" type="image/png" sizes="16x16">
	    <!-- Font Awesome -->
	    <!-- Custom Theme Style -->
	    <link href="../assets/custom.min.css" rel="stylesheet">
	    <link href="../assets/font-awesome.min.css" rel="stylesheet">
	    <link href="../assets/admin.css" rel="stylesheet">
	    <link rel="stylesheet" href="./file-upload/css/jquery.fileupload.css">


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
	        	<a href="javascript:void(0);" id="uploadDivCloseIcon" class="btn btn-danger" style="font-size: 20px; margin: 0px 16px; /* right: 0px; */ position: fixed; display: block; /* float: right; */ margin-left: 700px;" onclick="window.location = './import_zip.php';" data-toggle="tooltip" data-placement="bottom" title="Close">Close</a>
	        	</h4><table class='table table-condensed table-custom' style="table-layout: fixed; word-wrap: break-word;"><thead><th style="width: 50px;">#</th><th style="width: 60%;">Entry</th><th>Errors</th></thead><tbody id="resultTable"></tbody></table>
        	</div>
        </div>

        <!-- Loading Div -->
        <div style="    position: fixed; width: 100%; height: 100%; z-index: 10; text-align: center; font-size: 22px; font-weight: lighter; display: inline-block; vertical-align: middle; background: rgba(255, 255, 255, 0.85) none repeat scroll 0% 0%; padding: 10%; display:none;" id="loadingDiv">
        	<img src="./../../images/gfx/cube_lg.gif" height="100" width="100">
        	<span style="display:block">Loading, please wait..</span>
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
	        <h3>Import via Zip<small style="font-size: 12px; color: #aaa; margin-left: 10px;"></small></h3>
	        <?php
	        $checkCompanies = $pdo->prepare("SELECT * FROM `company_id`");
	        $checkCompanies->execute();

	        if ( $checkCompanies->rowCount() > 0 ) {
	        	echo '
	        	';
	        	echo '<form method="post" enctype="multipart/form-data">
	        			<input name="zip_file" value="" id="id_zip_file" hidden />
	        		<table>
	        			<tr>
	        				<td>
	        					<select class="select-style" name="company_id" title="Select the Client" hidden>
				        			<option value="">Select Company</option>';
			                        $getCompanies = $pdo->prepare("SELECT * FROM `company_id`");
			                        $getCompanies->execute();

			                        if ( $getCompanies->rowCount() > 0 ) {
			                        	foreach ( $getCompanies as $company ) {
			                        		echo '<option value="'. $company['id'] .'">'. $company['company_name'] .'</option>';
			                        	}
			                        } else {
			                        	echo '<option value="0">N/A</option>';
			                        }

				        		echo '</select>
	        				</td>
	        				<td>
				        		<div style="width:95px; display:inline-block;"><input id="fileupload" type="file" name="files[]" accept=".zip" style="border-bottom: transparent;"></div>
	        				</td>
	        				<td>
	        					<button class="btn btn-info" name="import" style="margin: 10px;" id="fileSelectUploadButton" disabled>Upload</button>
	        				</td>
	        				<td>
	        					<div id="files" class="files" style="display: inline-block; padding-top: 10px; margin: 5px;"></div>
	        				</td>
	        				<td style="padding-top: 5px;">
        						<div id="progressBar" class="progress" style="display: inline-block; width: 200px; margin: 0; box-shadow: none; -webkit-box-shadow: none; background-color: #ccc;">
							        <div class="progress-bar progress-bar-info"></div>
							    </div>
	        				</td>
	        			</tr>
	        		</table>
	        	</form>';
	        } else {
	        	echo '<div class="alert alert-info" style="display: inline-block;"> Please add a supplier prior to importing </div>';
	        }
	        ?>
	        	
	        	<div  style="border:solid thin #ccc; padding:5px; margin:5px;">
	        		<h4></h4>
	        		<div style="float: right; margin-top: -60px;">
	        		<a class="btn btn-custom" href="javascript:void(0);" style="" onclick="$('#guidelinesModal').modal('toggle');">Zip Guidelines</a><a style="display:none;"></a>
	        		<a class="btn btn-custom" href="./../assets/format.zip" style="" >Download Format</a><a style="display:none;"></a>
	        		</div>
	        		<?php
	        			//echo var_dump($_FILES);
	        			if ( isset($_POST['zip_file']) ) {
	        				pconsole($_FILES);
	        				pconsole($_POST);
	        				pconsole($_SESSION);

	        				$relativePath = '../../working/zip/archives/' . ($_POST['zip_file']);

	        				$url = $__MAINDOMAIN__ . 'working/zip/archives/' . rawurlencode($_POST['zip_file']);

	        				$ch=curl_init();
							$timeout=30;

							curl_setopt($ch, CURLOPT_URL, $url);
							curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
							curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, $timeout);
							curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);

							$inputImg=curl_exec($ch);
							$curlError = curl_error($ch);
							$contentType = curl_getinfo($ch, CURLINFO_CONTENT_TYPE);
							curl_close($ch);

							if ( empty($curlError) ) {
									pconsole($url);
									pconsole($contentType);
								if ( strpos($contentType, "/zip") ) {
								} else {
									pconsole("INVALID FORMAT SHIT");
								}
							} else {
								pconsole($curlError);
							}

	        				if ( empty($curlError) && strpos($contentType, "/zip") ) {
		        				$zip = new ZipArchive();
		        				$openZip = $zip->open($relativePath);
		        				$_SESSION['import_company_id_zip'] = $_POST['company_id'];
		                        $timeToken = time() . "_" . $_SESSION['username']; //Declared here as the folder needs to be set here
		        				$importDir = "./../../working/zip/import/" . $timeToken . "/";

		        				if ( $zip->getFromName("images/") !== false ) {
		        					pconsole( "Folder Found" );
		        					if ( $zip->getFromName("products.xlsx") !== false ) {
		        						pconsole( "Sheet Found" );
		        						#Extracting to ./working/zip/import
										mkdir($importDir);
		        						$checkImportFolder = scandir($importDir);
		        						if ( sizeof($checkImportFolder) > 2  ) {
		        							pconsole( "Import folder occupied / Give empty prompt" );
        									echo '<div class="alert alert-danger">Import folder seems to be already in use. <br>This could be due to it being used in another session or a different System. In order to continue, you would need to clear the import folder.<br><br><button class="btn btn-warning" onClick="$(\'#promptClearImportFolder\').modal(\'toggle\');">Clear Import</button></div>';
		        						} else {
		        							pconsole( "Import folder available / Extracting files now" );
											echo '<script>$("#loadingDiv").show();</script>';
		        							if ( $zip->extractTo($importDir) ) {
		        								pconsole( "Extract Successful" );
		        								$zip->close();
		        								if ( file_exists($relativePath) ) {
		        									unlink($relativePath);
		        								}
				                       			try {
				                       				$tokenContent = json_encode(array("token" => $timeToken, "timestamp" => date("Ymd")));
				                       				$tokenFile = fopen($importDir . 'token', 'w');
				                       				fwrite($tokenFile, $tokenContent);
				                       				fclose($tokenFile);
				                       				pconsole("Token Created");
				                       			} catch ( Exception $e ) {
				                       				pconsole($e);
				                       			} 
												$xlFile = $importDir . 'products.xlsx';

												$excelReader = PHPExcel_IOFactory::createReader(PHPExcel_IOFactory::identify($xlFile));
			        							$sheetData = $excelReader->listWorksheetInfo($xlFile);
												$productSheetExists = false;
						        				$productSheetSize = 0;

						        				foreach ($sheetData as $sheet ) {
						        					if ( $sheet['worksheetName'] == "products" ) {
						        						$productSheetExists = true;
						        						$productSheetSize = $sheet['totalRows'];
						        						pconsole($sheet);
						        					} 
						        				}

						        				if ( !$productSheetExists ) {
						        					pconsole("products sheet not found");
	        										echo '<div class="alert alert-danger">Products sheet not found</div>';
						        				} else {
						        					pconsole("Products sheet found / Continuing from here");
						        					if ( $productSheetSize <= '2001' ) {
														pconsole("Entered loading phase");
														$PHPExcel = PHPExcel_IOFactory::load($xlFile);
														$productSheet = $PHPExcel->getSheetByName('products');
														$products = $productSheet->toArray(null, true, true, true);
						                        		pconsole("TEST: ". $productSheet->getHighestRow());

						                        		$numRings = 0;
						                        		$numEarrings = 0;
						                        		$numNecklaces = 0;
						                        		$numPendants = 0;
						                        		$numBracelets = 0;
						                        		$numInvalid = 0;

						                        		for ( $i = 0; $i < sizeof($products) - 1; $i++ ) {
						                        			#pconsole("CATEGORY ". intval($i+2) . " = " . $productSheet->getCell('B'.intval($i+2))->getValue());
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

														if ( isset($_SESSION['import_company_id_zip']) ) {
						                        			echo '<div style="margin: 10px;"><label>Client: '. getCompany($_SESSION['import_company_id_zip'], $pdo) .'</label><br>
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
															$acceptedCategories = array(1, 2, 3, 4, 5);
															$rowColor = "";

															if ( !in_array($products[$i]['B'], $acceptedCategories) ) {
																$rowColor = "background-color: #ef9a9a";
															}
															echo '<tr style="'. $rowColor .'">';
																echo '<td><input class="select-checkbox" type="checkbox" form="bulkManage" id="row_'.$i.'" value="'. $i .'"></td>';
															for ( $j = 'A'; $j <= 'V'; $j++ ) {
																//pconsole($products[$i][$j]);
																if ( $j == 'U' ) {
																	$importRowImages = explode(",", $products[$i][$j]);
																	$listImages = "";
																	foreach ( $importRowImages as $image ) {
																		$listImages .= '<li><a href=\"'. $importDir . 'images/' . trim($image) .'\" target=\"_blank\">'. $image .'</a></li>';
																	}
																	$products[$i][$j] = "<button class='btn btn-custom btn-sm' onClick=' $(\"#imageModalBody\").html(\"". $listImages ."\"); $(\"#promptShowImages\").modal(\"toggle\");'>" . sizeof($importRowImages) . " image(s) </button>";
																}
																echo '<td>'. $products[$i][$j] .'</td>';
															}
															echo '</tr>';
														}

														echo '</tbody>';
														echo '</table>';
													} else {
						        						echo '<div class="alert alert-error" style="font-variant:small-caps;">Maximum entries per excel file exceeded. You have '. (intval($productSheetSize) - 1) .' entries. <br>Maximum allowed for performance reasons is 2000</div>';
						        						$zip->close();
						        						if ( file_exists($relativePath) ) {
				        									unlink($relativePath);
				        								}
													}
						        				}
		        							} else {
		        								pconsole( "Extract Failed" );
	        									echo '<div class="alert alert-danger">Extraction Failed</div>';
	        									$zip->close();
	        									if ( file_exists($relativePath) ) {
		        									unlink($relativePath);
		        								}
		        							}
											echo '<script>$("#loadingDiv").hide();</script>';
		        						}
		        					} else {
		        						pconsole( "Excel Sheet Missing" );
	        							echo '<div class="alert alert-danger">Archive does not contain the Excel sheet</div>';
	        							$zip->close();
	        							if ( file_exists($relativePath) ) {
        									unlink($relativePath);
        								}
		        					}
		        				} else {
		        					pconsole( "Images Folder Missing" );
	        						echo '<div class="alert alert-danger">Archive does not contain an image folder</div>';
									$zip->close();
	        						if ( file_exists($relativePath) ) {
    									unlink($relativePath);
    								}
		        				}
	        				} else {
	        					pconsole("Invalid File");
	        					echo '<div class="alert alert-danger">Invalid File. Read the guidelines if you are having trouble importing</div>';
	        					if ( file_exists($relativePath) ) {
									unlink($relativePath);
								}
	        				}

	        			} else {
	        				echo '<div class="alert alert-info">Select a Zip file</div>';
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
    	<script src="../assets/nprogress.js"></script>
		<script src="./file-upload/js/vendor/jquery.ui.widget.js"></script>
		<!-- The Iframe Transport is required for browsers without support for XHR file uploads -->
		<script src="./file-upload/js/jquery.iframe-transport.js"></script>
		<!-- The basic File Upload plugin -->
		<script src="./file-upload/js/jquery.fileupload.js"></script>
		<script src="../assets/custom.min.js"></script>
<script>
$(function () {
    'use strict';
    // Change this to the location of your server-side upload handler:
    var url = './file-upload/server/php/';
    $('#fileupload').fileupload({
        url: url,
        dataType: 'json',
        singleFileUploads: true,
        maxChunkSize: 1000000,
        done: function (e, data) {
        	//console.log(data);
        	var resultD = data.result['files'].length;
        	var fileName = '';

            $.each(data.result.files, function (index, file) {
                $("#files").html('<p>'+ (file.name) +'</p>');
                fileName = file.name;
            });
        	if ( resultD == 1 ) {
        		console.log(fileName);
        		$("#fileSelectUploadButton").prop("disabled", false);
        		$("#id_zip_file").val(fileName);
        	} else {
        		$("#fileSelectUploadButton").prop("disabled", true);
        	}
        },
        progressall: function (e, data) {
            var progress = parseInt(data.loaded / data.total * 100, 10);
            $('#progressBar .progress-bar').css(
                'width',
                progress + '%'
            );
        },
        always: function (e, data) {
        	console.log(data);
        }
    }).prop('disabled', !$.support.fileInput)
        .parent().addClass($.support.fileInput ? undefined : 'disabled');
});


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
var globalTimeToken = "";

var successCount = 0;
var failedCount = 0;
var warningCount = 0;
var skippedCount = 0;

function importThis(timeToken){
	globalTimeToken = timeToken;
	
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

	checkQ(timeToken);
}

function importAll(timeToken){
	globalTimeToken = timeToken;
	
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
	if ( ajaxQ.length > 0 ) {
		console.log("Running Query: " + currentAjax);
		$.ajax({
			url: './ajax.php?checkZipToken=' + timeToken,
			type: 'GET',
			success: function(result){
				console.log(result);
				if ( result == 1 ) {
					importAjax(ajaxQ.shift(), currentAjax, timeToken);
				} else {
					$('#resultDiv').html("<h4>Import Failure</h4><br><h5>File you tried to import from has been tampered with. You either have another window open with the same task or the Session has expired, please reload the page to continue.</h5><a href=\"javascript:void(0);\" id=\"uploadDivCloseIcon\" class=\"btn btn-danger\" style=\"font-size: 20px; margin: 0px 16px;\" onclick=\"finalizeImport(); window.location = './import_zip.php';\" data-toggle=\"tooltip\" data-placement=\"bottom\">Reload Page</a>");

	    			$('#uploadDiv').show();
	    			finalizeImport();
				}
			}
		});
	} else {
		console.log("Ending at: " + currentAjax);
	}
}

function importAjax (id, index, timeToken) {
	$.ajax({
		url: './ajax.php?importZip=' + id + '&timeToken=' + timeToken,
		type: 'GET',
	    beforeSend: function() {
	    	$('#uploadDiv').show();
	    	$('#uploadDivCloseIcon').hide();
	    	$('#resultTable').append('<tr id="row_'+ id +'"><td>'+ (index+1) +'</td><td id="row_'+ id +'_result">Loading</td><td id="row_'+ id +'_error"><img style="width:24px" src="../../images/gfx/cube.gif"></td></tr>');
    	
	    },
	    complete: function(result) {
			$('#importedItems').text(parseInt($('#importedItems').text()) + 1);
	    	if ( $('#totalItems').text() == $('#importedItems').text() ) {
		    	$('#uploadDivCloseIcon').show();
		    	$('#alertDiv').removeClass("alert-info");
		    	$('#alertDiv').addClass("alert-success");
		    	$('#alertDiv').html("Import Complete! <label class='label label-primary'>Success: "+ successCount + "</label> <label class='label label-danger'>Failed: "+ failedCount + "</label> <label class='label label-warning'>Warning: " + warningCount +"</label> <label class='label label-info'>Skipped: "+ skippedCount +"</label>");
		    	finalizeImport();
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
				var rc = "";
				if ( result[0] == 'success' ) {
					rc = "background: #A5D6A7;";
					successCount++;
				} else if ( result[0] == 'failure' ) {
					rc = "background: #EF9A9A;";
					failedCount++;
				} else if ( result[0] == 'neutral' ) {
					rc = "background: #90CAF9;";
					skippedCount++;
				} else if ( result[0] == 'warning' ) {
					rc = "background: #FFF59D;";
					warningCount++;
				}

				$("#row_"+ result[3]).prop("style", rc);
				$("#row_"+ result[3] +"_result").html(result[1]);
				$("#row_"+ result[3] +"_error").html(result[2]);
			} catch (e) {
				$('#resultDiv').html("<h4>Import Failure</h4><br><h5>File you tried to import from has been tampered with. You either have another window open with the same task or the Session has expired, please reload the page to continue.</h5><a href=\"javascript:void(0);\" id=\"uploadDivCloseIcon\" class=\"btn btn-danger\" style=\"font-size: 20px; margin: 0px 16px;\" onclick=\"finalizeImport(); window.location = './import_zip.php';\" data-toggle=\"tooltip\" data-placement=\"bottom\">Reload Page</a>");
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

function clearImportFolder() {
	$.ajax({
		url: './ajax.php?clearImportFolder=' + globalTimeToken,
		type: 'GET',
		beforeSend: function() {
			$("#modal_ClearImport_ClearButton").text("Clearing...");
			$("#modal_ClearImport_ClearButton").attr("disabled", true);
			$("#modal_ClearImport_CloseButton").attr("disabled", true);
		},
		success: function(result) {
			if ( result == 1 ) {
				window.location.reload();
			} else {
				console.log(result);
			}
		}
	});
}

function finalizeImport() {
	$.ajax({
		url: './ajax.php?finalizeImport=' + globalTimeToken,
		type: 'GET',
		success: function(result) {
			console.log(result);
			try {
				result = JSON.parse(result);
				if ( result['tokenMatch'] ) {
					console.log("token matched");
				} else {
					console.log("Token mismatch");
				}
			} catch (error) {
				console.log(error);
			}
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


	<div id="promptClearImportFolder" class="modal fade" role="dialog">
	  <div class="modal-dialog">

	    <!-- Modal content-->
	    <div class="modal-content"> <!-- Bulk Delete Modal -->
	      <div class="modal-header">
	         <!-- Bulk Delete Modal -->
	        <h4 class="modal-title">Caution</h4> <!-- Bulk Delete Modal -->
	      </div>
	      <input id="remove_category" name="category" hidden>
	      <div class="modal-body"> <!-- Bulk Delete Modal -->
	        <div class="container">
	            <h4>You are about to empty the Zip Import Folder</strong>
	            <br>Are you sure you want to perform this action?</h4> <!-- Bulk Delete Modal -->
	            <br>
	            <h5>Warning: This action would halt any other concurrently running sessions that are using Zip-Import function.</h5> <!-- Bulk Delete Modal -->
	        </div>
	      </div> <!-- Bulk Delete Modal -->
	      <div class="modal-footer">
	        <button  class="btn btn-custom" value="clear" id="modal_ClearImport_ClearButton" onclick="clearImportFolder()">Clear</button>
	        <button type="button" class="btn btn-custom" id="modal_ClearImport_CloseButton" data-dismiss="modal">Close</button>
	      </div>
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


	<div id="guidelinesModal" class="modal fade" role="dialog">
	  <div class="modal-dialog" style="width: 80%;">

	    <!-- Modal content-->
	    <div class="modal-content"> <!-- Bulk Delete Modal -->
	      <div class="modal-header">
	        <button type="button" class="close" data-dismiss="modal">&times;</button> <!-- Bulk Delete Modal -->
	        <h4 class="modal-title">Guide: Import via Zip</h4> <!-- Bulk Delete Modal -->
	      </div>
	      <input id="remove_category" name="category" hidden>
	      <div class="modal-body"> <!-- Bulk Delete Modal -->
	        <div class="container">
	            <h5>While importing your database through a zip file, there are a certain guidelines you need to follow for the system to recognize your Zip archive as valid.</h5>
	            <ul>
	            	<li>Excel Sheet
	            		<ul>
	            			<li>Currently, the supported Excel format is the Excel2007 and above (xlsx) Format.</li>
	            			<li>Your product sheet <strong>MUST</strong> be called <strong>products.xlsx</strong></li>
	            			<li>It must be located in the root of your Zip Archive (See Example below)</li>
	            		</ul>
	            	</li>
	            	<li>Images
	            		<ul>
	            			<li>Your images must be placed in the <strong>images</strong> folder, in the root of your Zip Archive</li>
	            			<li>The name of the images would be written in your Excel sheet's Image column, proof read the names. (Example shown below)</li>
	            		</ul>
	            	</li>
	            	<li style="padding-right: 40px;">Refer
	            		<div class="panel panel-info">
	            			<div class="panel-heading">Zip Archive Structure</div>
	            			<div class="panel-body"><img src="./../assets/file_structure.png" style="height: 100%;" /></div>
	            		</div>
	            		<div class="panel panel-success" >
	            			<div class="panel-heading">Excel Sheet Image Column</div>
	            			<div class="panel-body" style="min-height: auto; height: auto;"><img src="./../assets/image_format.jpg" style="max-width: 100%;" /></div>
	            		</div>
	            	</li>
	            </ul>
	        </div>
	      </div> <!-- Bulk Delete Modal -->
	      <div class="modal-footer">
	        <button type="button" class="btn btn-custom" data-dismiss="modal">Close</button>
	      </div>
	    </div>
	  </div>
	</div>


	