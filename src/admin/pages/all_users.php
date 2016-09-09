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

if ( isset($_POST['user']) ) {
	pconsole($_POST['user']);
	if ( isset($_POST['user']['activate']) ) {
		$activate = $pdo->prepare("UPDATE `accounts` SET `activated` = 1 WHERE `id` = :id");
		$activate->execute(array(":id" => $_POST['user']['activate']));
	} else if ( isset($_POST['user']['make_admin']) ) {
		$makeAdmin = $pdo->prepare("UPDATE `accounts` SET `type` = 1 WHERE `id` = :id");
		$makeAdmin->execute(array(":id" => $_POST['user']['make_admin']));
	} else if ( isset($_POST['user']['remove_admin']) ) {
		$makeAdmin = $pdo->prepare("UPDATE `accounts` SET `type` = 0 WHERE `id` = :id");
		$makeAdmin->execute(array(":id" => $_POST['user']['remove_admin']));
	} 
}
?>
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Users - Admin Panel</title>
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
        <h3>Users 
        	<div class="btn-group">
        		<button type="button" class="btn btn-custom dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        			Show <span class="fa fa-caret-down"></span>
        		</button>
        		<?php
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
	    		if ( isset($_GET['show']) ) {
	    			$show = " WHERE `type` = " . $_GET['show'];
	    		} else {
	    			$show = "";
	    		}
        		echo'
				  <ul class="dropdown-menu">
				    <li><a href="?filter='. $filter .'&order='. $currentOrder .'">All</a></li>
				    <li><a href="?filter='. $filter .'&order='. $currentOrder .'&show=0">Users</a></li>
				    <li><a href="?filter='. $filter .'&order='. $currentOrder .'&show=1">Admins</a></li>
				    <li><a href="?filter='. $filter .'&order='. $currentOrder .'&show=2">Super Admins</a></li>
				  </ul>
				  ';
				?>
			</div>
			<form method="get" style="float:right; width:200px;"><input type="text" style="background: transparent;" class="form-control" placeholder="Search..." name="search"></form>
		</h3>
        <table class="table table-condensed table-custom">
    		<?php
    		if ( isset($_GET['order']) && isset($_GET['filter']) ) {
        		echo '<small>Sorted: <span style="text-transform: capitalize;">'. str_replace("_", " ", $_GET['filter']) .' - '; 
        		echo ($_GET['order'] == "ASC") ? "Ascending" : "Descending";
        		echo '</span></small>';
        	}
    		echo '
        	<thead>
        		<th></th>
        		<th><a href="?filter=username&order='. $nextOrder .'">Username</a></th>
        		<th><a href="?filter=email&order='. $nextOrder .'">Email</a></th>
        		<th><a href="?filter=first_name&order='. $nextOrder .'">First Name</a></th>
        		<th><a href="?filter=last_name&order='. $nextOrder .'">Last Name</a></th>
        		<th><a href="?filter=mobileno&order='. $nextOrder .'">Phone Number</a></th>
        		<th><a href="?filter=address&order='. $nextOrder .'">Address</a></th>
        	</thead>
        	<tbody>';

        		if ( isset($_GET['search']) ) {
        			$getUsers = $pdo->prepare("SELECT * FROM `accounts` WHERE `username` LIKE :search");
        			$getUsers->execute(array(":search" => '%' . $_GET['search'] . '%'));
        		} else {
        			$getUsers = $pdo->prepare("SELECT * FROM `accounts` ". $show ." ORDER BY " . $filter . " " . $currentOrder);
        			$getUsers->execute();
        		}

        		if ( $getUsers->rowCount() > 0 ) {
        			foreach ( $getUsers->fetchAll() as $user ) {
        				if ( $user['type'] == 1 && $user['username'] !== $_SESSION['username'] ) {
        					$admin = '<button class="btn btn-danger" name="user[remove_admin]" value="'. $user['id'] .'" >Remove Admin</button>';
        				} else if ( $user['type'] == 2 ){
        					$admin = '<button class="btn btn-warning" data-toggle="tooltip" title="Can not remove a Super Admin" disabled>Super Admin</button>';
        				} else if ( $user['username'] == $_SESSION['username'] ) {
        					$admin = '<button class="btn btn-danger" name="user[remove_admin]" value="'. $user['id'] .'" disabled data-toggle="tooltip" title="Can not remove yourself">Remove Admin</button>';
        				} else {
        					$admin = '<button class="btn btn-info" name="user[make_admin]" value="'. $user['id'] .'">Make Admin</button>';
        				}
        				if ( $user['activated'] > 0 ) {
        					$activate = '<button class="btn btn-success btn-custom" disabled>Activated</button>';
        				} else {
        					$activate = '<button class="btn btn-success" name="user[activate]" value="'. $user['id'] .'">Activate User</button>';
        				}
        				echo '<tr>';
        				echo '<td><form method="post">'. $admin . $activate .'</form></td>';
        				echo '<td>'. $user['username'] .'</a></td>';
        				echo '<td>'. $user['email'] .'</a></td>';
        				echo '<td>'. $user['first_name'] .'</a></td>';
        				echo '<td>'. $user['last_name'] .'</a></td>';
        				echo '<td>'. $user['mobileno'] .'</a></td>';
        				echo '<td>'. $user['address'] .'</a></td>';
        				echo '</tr>';
        			}
        		} else {
        			echo "<tr><br>None Found</tr>";
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