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
        	<table class="table table-hover table-custom" style=" overflow:auto; white-space:nowrap; min-height: 80vh;" >
            	<thead>
                	<th>#</th>
                	<th>Sheet Name</th>
                	<th>Action</th>
                </thead>
                <tbody>
                <?php
                	$dir = '../excel_files/';

                	$files = scandir($dir, 1);

                	$int = 1;
                	foreach ( $files as $file ) {
                		if ( strpos($file, '.xlsx') && $file !== 'tmp_db.xlsx' && $file !== 'format.xlsx' ) {
                			echo '<tr><td style="width:20px;">'. $int .'</td><td>'. $file .'</td>
                			<td style="text-align:center;"><a class="fa fa-cloud-download" style="color:green;" href="'. $dir . $file .'"></a></td>
                			</tr>';
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