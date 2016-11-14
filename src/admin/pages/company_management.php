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

if ( isset($_POST['addItem']) ) {
  $addCompany = $pdo->prepare("INSERT INTO `company_id` (`company_name`, `company_code`, `email`, `mobileno`, `address`) VALUES (:cn, :cc, :mail, :pno, :add)");
  $addCompany->execute(array(":cn" => $_POST['company_name'], ":mail" => $_POST['company_mail'], ":pno" => $_POST['company_phone'], ":add" => $_POST['company_address'], ":cc" => $_POST['company_code']));
  header("Location: ./company_management.php");
} else if ( isset($_POST['removeItem']) ) {
  pconsole($_POST);
  $addCompany = $pdo->prepare("DELETE FROM `company_id` WHERE `id` = :id");
  $addCompany->execute(array(":id" => $_POST['removeItem']));
  header("Location: ./company_management.php");
} else if ( isset($_POST['editItem']) ) {
  pconsole($_POST);
  $addCompany = $pdo->prepare("UPDATE `company_id` SET `company_name` = :name, `email` = :mail, `mobileno` = :phone, `address` = :address WHERE `id` = :id");
  $addCompany->execute(array(
      ":name" => $_POST['company_name'], 
      ":id" => $_POST['editItem'],
      ":mail" => $_POST['company_mail'],
      ":phone" => $_POST['company_phone'],
      ":address" => $_POST['company_address']
  ));
  header("Location: ./company_management.php");
} 
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Suppliers - Admin Panel</title>
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
        <h3>Supplier Management <button class="btn btn-custom" onclick="$('#promptAddItem').modal('toggle');">Add</button>
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
                <table class="table" style="white-space: nowrap;">
            		<?php
            		if ( isset($_GET['order']) && isset($_GET['filter']) ) {
                		echo '<small>Sorted: <span style="text-transform: capitalize;">'. str_replace("_", " ", $_GET['filter']) .' - '; 
                		echo ($_GET['order'] == "ASC") ? "Ascending" : "Descending";
                		echo '</span></small>';
                	}
            		echo '
                	<thead>
                        <th>ID</th>
                        <th>Code</th>
                        <th>Action</th>
                        <th>Supplier Name</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>Address</th>
                	</thead>
                	<tbody>';

                		if ( isset($_GET['search']) ) {
                			$getUsers = $pdo->prepare("SELECT * FROM `company_id` WHERE `company_name` LIKE :search OR `company_code` LIKE :search");
                			$getUsers->execute(array(":search" => '%' . $_GET['search'] . '%'));
                		} else {
                			$getUsers = $pdo->prepare("SELECT * FROM `company_id` ". $show ." ORDER BY " . $filter . " " . $currentOrder);
                			$getUsers->execute();
                		}

                		if ( $getUsers->rowCount() > 0 ) {
                			foreach ( $getUsers->fetchAll() as $company ) {
                				echo '<tr>';
                                echo '<td>'. $company['id'] .'</td>';
                                echo '<td>'. $company['company_code'] .'</td>';
                        echo '<td>
                          <button class="btn btn-danger btn-sm" data-toggle="tooltip" title="Delete Client" onclick="deleteSupplier(\''. $company['id'] .'\')"><i class="fa fa-close"></i></button>
                          <button class="btn btn-info btn-sm" data-toggle="tooltip" title="Edit Client" onclick="editSupplier(\''. $company['id'] .'\')"><i class="fa fa-pencil"></i></button>
                          </td>';
                        echo '<td>'. $company['company_name'] .'</td>';
                        echo '<td>'. $company['email'] .'</td>';
                        echo '<td>'. $company['mobileno'] .'</td>';
                        echo '<td>'. $company['address'] .'</td>';
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
              <td class="table-item-label"><span class="table-item-label">Name</span></td>
              <td>
                <div class="table-item">
                  <input name="company_name" type="text" class="form-control" placeholder="Supplier Name (50 Characters)" required maxlength="50" pattern=".{0,50}" >
                </div>
              </td>
            </tr>

            <tr class="table-row">
              <td class="table-item-label"><span class="table-item-label">Unique Code</span></td>
              <td>
                <div class="table-item">
                  <input name="company_code" type="text" class="form-control" placeholder="Enter a Unique Code (Keep it short for ease of use)(min 3)" required maxlength="10" pattern=".{0,10}" onkeyup="validateCompanyCode(this)" >
                </div>
              </td>
            </tr>

            <tr class="table-row">
              <td class="table-item-label"><span class="table-item-label">Email</span></td>
              <td>
                <div class="table-item">
                  <input name="company_mail" type="text" class="form-control" placeholder="Supplier Email" required maxlength="50" pattern=".{0,50}" >
                </div>
              </td>
            </tr>

            <tr class="table-row">
              <td class="table-item-label"><span class="table-item-label">Phone</span></td>
              <td>
                <div class="table-item">
                  <input name="company_phone" type="text" class="form-control" placeholder="Supplier Phone Number" required maxlength="50" pattern=".{0,50}" >
                </div>
              </td>
            </tr>

            <tr class="table-row">
              <td class="table-item-label"><span class="table-item-label">Address</span></td>
              <td>
                <div class="table-item">
                  <textarea name="company_address" class="form-control" placeholder="Supplier Address (500 Characters)"></textarea>
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

<div id="promptRemoveErrorModal" class="modal fade" role="dialog">
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
            <h4>Unable to delete Client: <strong id="itemToRemoveError">This</strong>
            <br>
            <h5><div class="alert alert-warning">This client can not be deleted as they still have Products listed on the website, please delete them prior to removing the supplier</div></h5>
        </div>
      </div>
      <div class="modal-footer">
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
              <td class="table-item-label"><span class="table-item-label">Name</span></td>
              <td>
                <div class="table-item">
                  <input id="edit_product_name" name="company_name" type="text" class="form-control" placeholder="Supplier Name (50 Characters)" required maxlength="50" pattern=".{0,50}" >
                </div>
              </td>
            </tr>

            <tr class="table-row">
              <td class="table-item-label"><span class="table-item-label">Unique Code</span></td>
              <td>
                <div class="table-item">
                  <input id="edit_company_code" name="company_code" type="text" class="form-control" placeholder="Enter a Unique Code (Keep it short for ease of use)(min 3)" required maxlength="50" pattern=".{0,50}" disabled >
                </div>
              </td>
            </tr>

            <tr class="table-row">
              <td class="table-item-label"><span class="table-item-label">Email</span></td>
              <td>
                <div class="table-item">
                  <input id="edit_company_mail" name="company_mail" type="text" class="form-control" placeholder="Supplier Email" required maxlength="50" pattern=".{0,50}" >
                </div>
              </td>
            </tr>

            <tr class="table-row">
              <td class="table-item-label"><span class="table-item-label">Phone</span></td>
              <td>
                <div class="table-item">
                  <input id="edit_company_phone" name="company_phone" type="text" class="form-control" placeholder="Supplier Phone Number" required maxlength="50" pattern=".{0,50}" >
                </div>
              </td>
            </tr>

            <tr class="table-row">
              <td class="table-item-label"><span class="table-item-label">Address</span></td>
              <td>
                <div class="table-item">
                  <textarea id="edit_company_address" name="company_address" class="form-control" placeholder="Supplier Address (500 Characters)"></textarea>
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
        url: './ajax.php?getSupplierDetails=' + key,
        type: 'GET',
        success: function(result) {
          console.log(result);
          result = JSON.parse(result);
          $("#edit_product_name").val(result['company_name']); 
          $("#edit_company_code").val(result['company_code']); 
          $("#edit_company_mail").val(result['email']); 
          $("#edit_company_phone").val(result['mobileno']); 
          $("#edit_company_address").text(result['address']); 
          $("#editItem").val(key); 
          $("#promptEditItem").modal("toggle");
        }
      });
    }

    function deleteSupplier(key) {
      $.ajax({
        url: './ajax.php?getSupplierItems=' + key,
        type: 'GET',
        success: function(result) {
          console.log(result);
          try {
            result = JSON.parse(result);
            if ( result['result'] == 1 ) {
              $("#itemToRemoveError").text(result['name']);
              $("#promptRemoveErrorModal").modal("toggle");
            } else if ( result['result'] == 0 ) {
              $("#removeModalActionButton").val(result['id']);
              $("#itemToRemove").text(result['company_name']);
              $("#promptRemoveModal").modal("toggle");
            }
          } catch (e) {

          }
        }
      });
    }


    function validateCompanyCode(element) {
      code = $(element).val();
      if ( code.length >= 3 ) {
        $.ajax({
          url: './ajax.php?verifyCompanyCode=' + code,
          type: 'GET',
          beforeSend: function() {
            $(element)[0].setCustomValidity("Varifying");
          },
          success: function(result) {
            if (result == 1 ) {
              $(element)[0].setCustomValidity("");
              $(element).prop("style", "background: transparent;");
              
            } else {
              $(element)[0].setCustomValidity("Unique Code not available");
              $(element).prop("style", "background: #ffab91;;");
            }
          }
        });
      } else {
          $(element)[0].setCustomValidity("Unique Code not available");
          $(element).prop("style", "background: #ffab91;;");
      }
    }
  </script>