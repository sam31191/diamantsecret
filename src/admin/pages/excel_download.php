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


    pconsole($_POST);
if ( isset($_POST['file']['delete']) ) {
    if ( file_exists($_POST['file']['delete']) ) {
        unlink($_POST['file']['delete']);
    }
}
?>
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Excel Sheets - Admin Panel</title>
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
        <h3>Sheets</h3>
            <form id="deleteFileForm" method="post"><input name="file[delete]" id="deleteFile" hidden /></form>
            <div class="alert alert-info">NOTE: Files older than 30 days are automatically deleted</div>
        	<table class="table table-hover table-custom" style=" overflow:auto; white-space:nowrap; max-height: 80vh;" >
            	<thead>
                	<th>#</th>
                	<th>Sheet Name</th>
                	<th>Action</th>
                </thead>
                <tbody>
                <?php
                	$dir = '../../working/excel/import/';

                  $files = scandir($dir, 1);

                  $int = 1;
                  foreach ( $files as $file ) {
                    if ( strpos($file, '.xlsx') && $file !== 'tmp_db.xlsx' && $file !== 'format.xlsx' ) {
                      echo '<tr><td style="width:20px;">'. $int .'</td><td>'. $file .'</td>
                          <td style="text-align:center;">
                                    <a class="fa fa-cloud-download" style="color:green;" data-link="'. $dir . $file .'" data-toggle="tooltip" onclick="downloadThis(\''. $dir . $file .'\')" title="Download"></a> 
                                    <a href="javascript:void(0);" class="fa fa-close" data-toggle="tooltip" title="Delete" onclick="$(\'#removeModalActionButton\').val(\''. $dir . $file .'\'); $(\'#itemToRemove\').text(\''. $file .'\'); $(\'#promptRemoveModal\').modal(\'toggle\');"></a>
                                </td>
                      </tr>';

                            echo '';
                      $int++;
                    }
                  }

                  $dir = '../../working/excel/export/';

                  $files = scandir($dir, 1);
                  foreach ( $files as $file ) {
                    if ( strpos($file, '.xlsx') && $file !== 'tmp_db.xlsx' && $file !== 'format.xlsx' ) {
                      echo '<tr><td style="width:20px;">'. $int .'</td><td>'. $file .'</td>
                          <td style="text-align:center;">
                                    <a class="fa fa-cloud-download" style="color:green;" data-link="'. $dir . $file .'" data-toggle="tooltip" onclick="downloadThis(\''. $dir . $file .'\')" title="Download"></a> 
                                    <a href="javascript:void(0);" class="fa fa-close" data-toggle="tooltip" title="Delete" onclick="$(\'#removeModalActionButton\').val(\''. $dir . $file .'\'); $(\'#itemToRemove\').text(\''. $file .'\'); $(\'#promptRemoveModal\').modal(\'toggle\');"></a>
                                </td>
                      </tr>';

                            echo '';
                      $int++;
                    }
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

    function downloadThis(link) {
        $.ajax({
            url: link,
            type: 'HEAD',
            error: function(){
                $("#invalidFileModal").modal('toggle');
            },
            success: function() {
                window.location.href = link;
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
        <button id="removeModalActionButton" type="submit" class="btn btn-custom" name="file[delete]" value="">Delete</button>
        <button type="button" class="btn btn-custom" data-dismiss="modal">Close</button>
      </div>
      </form>
    </div>
  </div>
</div>



        <!-- Modal -->
<div id="invalidFileModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Error</h4>
      </div>
      <form method="post" enctype="multipart/form-data">
      <input id="remove_category" name="category" hidden>
      <div class="modal-body">
        <div class="container">
            <h4>File Does Not Exist</h4>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-custom" onclick="location.reload();">Close</button>
      </div>
      </form>
    </div>
  </div>
</div>

