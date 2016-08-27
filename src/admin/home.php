<!DOCTYPE html>
<html lang="en">
<?php
if ( session_status() == PHP_SESSION_NONE ) {
  session_start();
}
if ( !isset($_SESSION['modSession']) ) {
   header ('Location: ../index.php');
   die();
}
if ( isset($_SESSION['modSession']) ) {
  if ( !$_SESSION['modSession'] || $_SESSION['Admin'] <= 0 ) {
    header ('Location: ../index.php');
    die();
  }
}
?>
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin Panel</title>
    <!-- Bootstrap -->
    <link href="../css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel='stylesheet prefetch' href='http://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css'>
    <!-- Custom Theme Style -->
    <link href="admin-assets/custom.min.css" rel="stylesheet">
    <link href="../css/site.css" rel="stylesheet">
  </head>

  <body class="nav-md">
    <div class="container body" style="background-color:#911116">
      <div class="main_container">
        <!-- sidebar -->
        <div class="col-md-3 left_col">
          <?php include 'pages/sidebar.php'; ?>
        </div>
    <!-- /sidebar -->
        <!-- top navigation -->
        <div class="top_nav">
          <?php include 'pages/navbar.php'; ?>
        </div>
        <!-- /top navigation -->

        <!-- page content -->
        <div class="right_col" role="main">
            <?php echo var_dump($_POST); ?>
        </div>
        <!-- /page content -->

        <!-- footer content -->
        <footer style="margin-top:-10px;">
          <?php include 'footer.php'; ?>
        </footer>
        <!-- /footer content -->
      </div>
    </div>

    <!-- jQuery -->
    
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="../js/bootstrap.min.js"></script>
    <script src="admin-assets/custom.min.js"></script>
  </body>
</html>
