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

if ( isset($_POST['addItem']) ) {
	$addCompany = $pdo->prepare("INSERT INTO `country_vat` (`country_name`, `vat`) VALUES (:cn, :vat)");
	$addCompany->execute(array(":cn" => $_POST['country_name'], ":mail" => $_POST['country_vat']));
} else if ( isset($_POST['editItem']) ) {
	pconsole($_POST);
	$addCompany = $pdo->prepare("UPDATE `country_vat` SET `country_name` = :name, `vat` = :vat WHERE `id` = :id");
	$addCompany->execute(array(
      ":name" => $_POST['country_name'], 
      ":id" => $_POST['editItem'],
      ":vat" => $_POST['country_vat']
  ));
} 
?>
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>VAT - Admin Panel</title>
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
        <h3>VAT Management <button class="btn btn-custom" onclick="$('#promptAddItem').modal('toggle');">Add</button>
        	<div class="btn-group">
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
				?>
			</div>
			<form method="get" style="float:right; width:200px;"><input type="text" style="background: transparent;" class="form-control" placeholder="Search..." name="search"></form>
		</h3>
            <div class="container" style="overflow:auto">
                <table class="table table-custom table-custom-items" style="white-space: nowrap; display:block">
            		<?php
            		if ( isset($_GET['order']) && isset($_GET['filter']) ) {
                		echo '<small>Sorted: <span style="text-transform: capitalize;">'. str_replace("_", " ", $_GET['filter']) .' - '; 
                		echo ($_GET['order'] == "ASC") ? "Ascending" : "Descending";
                		echo '</span></small>';
                	}
            		echo '
                	<thead>
                        <th>ID</th>
                        <th>Action</th>
                        <th>Country</th>
                        <th>VAT</th>
                	</thead>
                	<tbody>';

                		if ( isset($_GET['search']) ) {
                			$getUsers = $pdo->prepare("SELECT * FROM `country_vat` WHERE `country_name` LIKE :search");
                			$getUsers->execute(array(":search" => '%' . $_GET['search'] . '%'));
                		} else {
                			$getUsers = $pdo->prepare("SELECT * FROM `country_vat` ". $show ." ORDER BY " . $filter . " " . $currentOrder);
                			$getUsers->execute();
                		}

                		if ( $getUsers->rowCount() > 0 ) {
                			foreach ( $getUsers->fetchAll() as $company ) {
                				echo '<tr>';
                                echo '<td>'. $company['id'] .'</td>';
                        echo '<td>
                          <button class="btn btn-info btn-sm" data-toggle="tooltip" title="Edit Client" onclick="editSupplier(\''. $company['id'] .'\')"><i class="fa fa-pencil"></i></button>
                          </td>';
                        echo '<td>'. $company['country_name'] .'</td>';
                        echo '<td>'. $company['vat'] .'</td>';
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

<div id="promptAddItem" class="modal fade" role="dialog">
  <div class="modal-dialog modal-lg">

    <!-- Modal content-->
    <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title"><span id="item_to_edit">Add</span></h4>
        </div>
        <form method="post">
        <div class="modal-body">
          <div class="container">
              <div class="col-sm-12">
          <tbody>
            <tr class="table-row">
              <td class="table-item-label"><span class="table-item-label">Country</span></td>
              <td>
                <div class="table-item">
                  <input id="" name="country_name" type="text" class="form-control" placeholder="Country Name" required maxlength="100" pattern=".{0,100}" >
                </div>
              </td>
            </tr>

            <tr class="table-row">
              <td class="table-item-label"><span class="table-item-label">VAT (%)</span></td>
              <td>
                <div class="table-item">
                  <input id="" name="country_vat" type="number" class="form-control" placeholder="VAT in percent" required min="0" max="99" pattern=".{0,2}" >
                </div>
              </td>
            </tr>
          </tbody>
              </div>  
          </div>
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-custom" name="addItem" value="" >Submit</button>
          <button type="button" class="btn btn-custom" data-dismiss="modal">Close</button>
        </div>
        </form>
      </div>
  </div>
</div>


<div id="promptRemoveModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Caution</h4>
      </div>
      <form method="post">
      <div class="modal-body">
        <div class="container">
            <h4>You are about to permanently delete Client: <strong id="itemToRemove">This</strong>
            <br>Are you sure you want to perform this action?</h4>
            <br>
            <h5><div class="alert alert-error">Warning: It is advised to remove this Supplier's items before deleting it, otherwise it may cause instability. <br> This action can not be undone.</div></h5>
        </div>
      </div>
      <div class="modal-footer">
        <button id="removeModalActionButton" type="submit" class="btn btn-custom" name="removeItem" value="">Remove</button>
        <button type="button" class="btn btn-custom" data-dismiss="modal">Close</button>
      </div>
      </form>
    </div>
  </div>
</div>

<div id="promptEditItem" class="modal fade" role="dialog">
	  <div class="modal-dialog modal-lg">

	    <!-- Modal content-->
	    <div class="modal-content">
	      <div class="modal-header">
	        <button type="button" class="close" data-dismiss="modal">&times;</button>
	        <h4 class="modal-title"><span id="item_to_edit">Edit</span></h4>
	      </div>
	      <form method="post">
	      <div class="modal-body">
	        <div class="container">
	            <div class="col-sm-12">
					<tbody>
            <tr class="table-row">
              <td class="table-item-label"><span class="table-item-label">Country</span></td>
              <td>
                <div class="table-item">
                  <input id="edit_country_name" name="country_name" type="text" class="form-control" placeholder="Country Name" required maxlength="100" pattern=".{0,100}" >
                </div>
              </td>
            </tr>

            <tr class="table-row">
              <td class="table-item-label"><span class="table-item-label">VAT (%)</span></td>
              <td>
                <div class="table-item">
                  <input id="edit_country_vat" name="country_vat" type="number" class="form-control" placeholder="VAT in percent" required min="0" max="99" pattern=".{0,2}" >
                </div>
              </td>
            </tr>
					</tbody>
	            </div>  
	        </div>
	      </div>
	      <div class="modal-footer">
	        <button type="submit" class="btn btn-custom" name="editItem" id="editItem" value="" >Submit</button>
	        <button type="button" class="btn btn-custom" data-dismiss="modal">Close</button>
	      </div>
	      </form>
	    </div>
	  </div>
	</div>

  <script type="text/javascript">
    function editSupplier(key) {

      $.ajax({
        url: './ajax.php?getVatDetails=' + key,
        type: 'GET',
        success: function(result) {
          result = JSON.parse(result);
          console.log(result);
          $("#edit_country_name").val(result['country_name']); 
          $("#edit_country_vat").val(result['vat']);
          $("#editItem").val(key); 
          $("#promptEditItem").modal("toggle");
        }
      });
    }
  </script>