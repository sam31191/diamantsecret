<!DOCTYPE html>
<html>
<?php
if ( session_status() == PHP_SESSION_NONE ) {
	session_start();
}
if ( isset($_SESSION['modSession']) ) {
	if ( $_SESSION['modSession'] && $_SESSION['Admin'] > 0 ) {
		?>	
<head>
<title>Admin Control Panel</title>
<link href="../css/bootstrap.min.css" rel="stylesheet" type="text/css">
<link href="../css/site.css" rel="stylesheet" type="text/css">
<link href="admin-assets/acp.css" rel="stylesheet" type="text/css">
</head>
<body>
<div class="container-fluid" style="position:fixed; width:20%; padding:0;">
	<div class="panel-group" id="accordion">
      <div class="panel panel-custom">
        <div class="panel-heading">
            <a data-toggle="collapse" href="#collapse1" data-parent="#accordion">Collapsible list group</a>
        </div>
        <div id="collapse1" class="panel-collapse">
          <ul class="list-group">
            <li class="list-item active"><a href="#">One</a></li>
            <li class="list-item"><a href="#">Two</a></li>
            <li class="list-item"><a href="#">Three</a></li>
          </ul>
        </div>
      </div>
      <div class="panel panel-default">
        <div class="panel-heading">
            <a data-toggle="collapse" href="#collapse2" data-parent="#accordion">Collapsible list group</a>
        </div>
        <div id="collapse2" class="panel-collapse collapse">
          <ul class="list-group">
            <li class="list-group-item">One</li>
            <li class="list-group-item">Two</li>
            <li class="list-group-item">Three</li>
          </ul>
          <div class="panel-footer">Footer</div>
        </div>
      </div>
</div>
</div>

</body>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script src="../assets/bootstrap.min.js"></script>
</html>
		<?php
	}
}
else {
	header ('Location: ../index.php');
}
?>