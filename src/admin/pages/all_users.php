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
include './../../conf/config.php';

pconsole($_SESSION);
if ( isset($_POST['user']) ) {
    pconsole($_POST['user']);
    if ( isset($_POST['user']['activate']) ) {
        $activate = $pdo->prepare("UPDATE `accounts` SET `activated` = 1 WHERE `id` = :id");
        $activate->execute(array(":id" => $_POST['user']['activate']));
    } else if ( isset($_POST['user']['make_admin']) ) {
    pconsole("TESTTETS");
        $makeAdmin = $pdo->prepare("UPDATE `accounts` SET `type` = 1 WHERE `id` = :id");
        $makeAdmin->execute(array(":id" => $_POST['user']['make_admin']));
    } else if ( isset($_POST['user']['remove_admin']) ) {
        $makeAdmin = $pdo->prepare("UPDATE `accounts` SET `type` = 0 WHERE `id` = :id");
        $makeAdmin->execute(array(":id" => $_POST['user']['remove_admin']));
    } else if ( isset($_POST['user']['delete']) ) {
        $makeAdmin = $pdo->prepare("DELETE FROM `accounts` WHERE `username` = :id");
        $makeAdmin->execute(array(":id" => $_POST['user']['delete']));
    } else if ( isset($_POST['user']['loginAs']) ) {
        pconsole($_POST);
        $_SESSION['loginAs'] = $_POST['user']['loginAs'];
        pconsole($_SESSION);
        echo '<script>
            var a = document.createElement("a");
            a.style.display = "none";
            a.href = "../../index.php";

            a.click();
        </script>';
    } else if ( isset($_POST['user']['logoutAs']) ) {
        pconsole($_POST);
        unset($_SESSION['loginAs']);
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
    <!-- Datatables -->
    <link href="../assets/datatables/javascripts/datatables.net-bs/css/dataTables.bootstrap.min.css" rel="stylesheet">
    <link href="../assets/datatables/javascripts/datatables.net-buttons-bs/css/buttons.bootstrap.min.css" rel="stylesheet">
    <link href="../assets/datatables/javascripts/datatables.net-fixedheader-bs/css/fixedHeader.bootstrap.min.css" rel="stylesheet">
    <link href="../assets/datatables/javascripts/datatables.net-responsive-bs/css/responsive.bootstrap.min.css" rel="stylesheet">
    <link href="../assets/datatables/javascripts/datatables.net-scroller-bs/css/scroller.bootstrap.min.css" rel="stylesheet">
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
        <h3>Users
            
            <div class="btn-group">
            <?php 
            /* PREREQ FILTER VARIABLES */
            $selectedSiteFilter = "";
            $selectedSiteHref = "all";


            /* FIRST FILTER (Domains) */
            $fetchAllSites = $pdo->prepare("SELECT * FROM tb_websites");
            $fetchAllSites->execute();

            $allSites = "";

            if ( $fetchAllSites->rowCount() > 0 ) {

                $allSiteOptions = $fetchAllSites->fetchAll();

                foreach ( $allSiteOptions as $siteOption ) {
                    $allSites .= '<li><a href="?site='. $siteOption['name'] .'">'. $siteOption['label'] .'</a></li>';
                }

                if ( isset($_GET['site']) ) {
                    $checkSiteOption = $pdo->prepare("SELECT * FROM tb_websites WHERE name = :name");
                    $checkSiteOption->execute(array(":name" => $_GET['site']));

                    if ( $checkSiteOption->rowCount() > 0 ) {
                        $selectedSiteOption = $checkSiteOption->fetch(PDO::FETCH_ASSOC);
                        $selectedSiteLabel = $selectedSiteOption['label'];
                        $selectedSiteFilter = " WHERE site_id = ". $selectedSiteOption['id'];
                        $selectedSiteHref = $selectedSiteOption['name'];
                    } else {
                        $selectedSiteLabel = "All Sites";
                    }
                } else {
                    $selectedSiteLabel = "All Sites";
                }
            }
            /* FIRST FILTER END */
            
            echo '<button type="button" class="btn btn-custom dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                '. $selectedSiteLabel .' <span class="fa fa-caret-down"></span>
            </button>';
            echo'
              <ul class="dropdown-menu">
                <li><a href="?site=all">All</a></li>
                '. $allSites .'
              </ul>
              ';
            ?>
            </div>
            <form method="post" target="_blank" action="./login_as.php" id="loginAsForm"></form>
        </h3>
            <div class="container" style="overflow:auto">
                <table id="itemsTable" class="table table-striped table-bordered bulk_action table-custom table-custom-items">
                    <thead>
                        <th>Admin</th>
                        <th></th>
                        <th>Website</th>
                        <th>Username</th>
                        <th>Email</th>
                        <th><span style="width: 100px !important;">Password &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span></th>
                        <th>First Name</th>
                        <th>Last Name</th>
                        <th>Phone Number</th>
                        <th>Address</th>
                    </thead>
                    <tbody>
                        <?php 

                        $getUsers = $pdo->prepare("SELECT * FROM accounts". $selectedSiteFilter);
                        $getUsers->execute();

                        if ( $getUsers->rowCount() > 0 ) {
                            foreach ( $getUsers->fetchAll() as $user ) {
                                if ( $user['type'] == 1 && $user['username'] !== $_SESSION['username'] ) {
                                    $admin = '<button class="btn btn-sm btn-danger" name="user[remove_admin]" onclick="$(\'#adminToRemove\').text(\''. $user['username'] .'\'); $(\'#removeAdminUsername\').val(\''. $user['id'] .'\'); $(\'#promptRemoveAdminModal\').modal(\'toggle\');" value="'. $user['id'] .'" data-toggle="tooltip" title="Remove Admin"><i class="fa fa-check" aria-hidden="true"></i></button>';
                                } else if ( $user['type'] == 2 ){
                                    $admin = '<button class="btn btn-sm btn-warning" data-toggle="tooltip" title="Can not remove a Super Admin" disabled><i class="fa fa-check" aria-hidden="true"></i></button>';
                                } else if ( $user['username'] == $_SESSION['username'] ) {
                                    $admin = '<button class="btn btn-sm btn-danger" value="'. $user['id'] .'" disabled data-toggle="tooltip" title="Can not remove yourself"><i class="fa fa-check" aria-hidden="true"></i></button>';
                                } else {
                                    $admin = '<button class="btn btn-sm btn-custom" name="user[make_admin]" onclick="$(\'#adminToMake\').text(\''. $user['username'] .'\'); $(\'#makeAdminUsername\').val(\''. $user['id'] .'\'); $(\'#promptMakeAdminModal\').modal(\'toggle\');" value="'. $user['id'] .'" data-toggle="tooltip" title="Make Admin"><i class="fa fa-check" aria-hidden="true" ></i></button>';
                                }
                                if ( $user['activated'] > 0 ) {
                                    $activate = '<button class="btn btn-sm btn-success btn-custom" disabled>Activated</button>';
                                } else {
                                    $activate = '<button class="btn btn-sm btn-success" name="user[activate]" value="'. $user['id'] .'">Activate</button>';
                                }
                                if ( isset($_SESSION['loginAs']) && $_SESSION['loginAs'] == $user['username'] ) {
                                    $loginAs = '<button class="btn btn-sm btn-danger" name="user[logoutAs]" value="'. $user['username'] .'" data-toggle="tooltip" title="Logout from '. $user['username'] .'">Logout</button>';
                                } else {
                                    $loginAs = '<button class="btn btn-sm btn-info" name="loginAs" value="'. $user['username'] .'" data-toggle="tooltip" title="Login As '. $user['username'] .'" form="loginAsForm">Login</button>';
                                }

                                if ( $_SESSION['username'] !== $user['username'] ) {
                                    $deleteUser = '<a class="btn btn-sm btn-danger" name="user[delete]" onclick="$(\'#removeModalUserValue\').val(\''. $user['username'] .'\'); $(\'#userToRemove\').text(\''. $user['username'] .'\'); $(\'#promptRemoveUserModal\').modal(\'toggle\');" value="User" data-toggle="tooltip" title="" data-original-title="Delete User"><i class="fa fa-close"></i></a>';
                                } else {
                                    $deleteUser = '';
                                }

                                $pass = '<div class="input-group">
                                  <input id="password_'. $user['id'] .'" type="password" class="form-control" value="'. $user['password'] .'" aria-describedby="basic-addon" disabled>
                                  <span class="input-group-addon" id="basic-addon" style="border-radius: 0px; border: solid thin #ddd; border-left: none;"><a href="javascript:void(0);" onmousedown="$(\'#password_'. $user['id'] .'\').attr(\'type\', \'text\');" onmouseup="$(\'#password_'. $user['id'] .'\').attr(\'type\', \'password\');"><i class="fa fa-eye"></i></a></span>
                                </div>';

                                $websiteName = $pdo->prepare("SELECT label FROM tb_websites WHERE id = :id");
                                $websiteName->execute(array(":id" => $user['site_id']));

                                if ( $websiteName->rowCount() > 0 ) {
                                    $websiteName = $websiteName->fetch(PDO::FETCH_ASSOC)['label'];
                                } else {
                                    $websiteName = "Invalid";
                                }

                                echo '<tr>';
                                echo '<td>'. $admin .'</td>';
                                echo '<td><form method="post" id="userManage" style="text-align:left">'. $activate . $loginAs . $deleteUser .'</form></td>';
                                echo '<td>'. $websiteName .'</a></td>';
                                echo '<td>'. $user['username'] .'</a></td>';
                                echo '<td>'. $user['email'] .'</a></td>';
                                echo '<td>'. $pass .'</td>';
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
    <!-- Datatables -->
    <script src="../assets/datatables/javascripts/datatables.net/js/jquery.dataTables.min.js"></script>
    <script src="../assets/datatables/javascripts/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
    <script src="../assets/datatables/javascripts/datatables.net-buttons/js/dataTables.buttons.min.js"></script>
    <script src="../assets/datatables/javascripts/datatables.net-buttons-bs/js/buttons.bootstrap.min.js"></script>
    <script src="../assets/datatables/javascripts/datatables.net-buttons/js/buttons.flash.min.js"></script>
    <script src="../assets/datatables/javascripts/datatables.net-buttons/js/buttons.html5.min.js"></script>
    <script src="../assets/datatables/javascripts/datatables.net-buttons/js/buttons.print.min.js"></script>
    <script src="../assets/datatables/javascripts/datatables.net-fixedheader/js/dataTables.fixedHeader.min.js"></script>
    <script src="../assets/datatables/javascripts/datatables.net-keytable/js/dataTables.keyTable.min.js"></script>
    <script src="../assets/datatables/javascripts/datatables.net-responsive/js/dataTables.responsive.min.js"></script>
    <script src="../assets/datatables/javascripts/datatables.net-responsive-bs/js/responsive.bootstrap.js"></script>
    <script src="../assets/datatables/javascripts/datatables.net-scroller/js/datatables.scroller.min.js"></script>
    <script>
    $(document).ready(function(){
        $('[data-toggle="tooltip"]').tooltip(); 
    });

    var $datatable = $('#itemsTable');

    $datatable.dataTable({
      'order': [[ 3, 'desc' ]],
      'columnDefs': [
        { orderable: false, targets: [0] }
      ]
    });
    </script>
  </body>
</html>


<div id="promptRemoveUserModal" class="modal fade" role="dialog">
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
            <h4>You are about to permanently remove account:  <strong id="userToRemove">This</strong>
            <br>Are you sure you want to perform this action?</h4> <!-- Bulk Delete Modal -->
            <br>
            <h5>Note: This action can not be undone.</h5> <!-- Bulk Delete Modal -->
        </div>
      </div> <!-- Bulk Delete Modal -->
      <div class="modal-footer">
        <button id="removeModalUserValue" type="submit" class="btn btn-custom" name="user[delete]" value="" form="userManage" >Delete</button>
        <button type="button" class="btn btn-custom" data-dismiss="modal">Close</button>
      </div>
      </form>
    </div>
  </div>
</div>

<div id="promptMakeAdminModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content"> <!-- Bulk Delete Modal -->
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button> <!-- Bulk Delete Modal -->
        <h4 class="modal-title">Attention</h4> <!-- Bulk Delete Modal -->
      </div>
      <input id="remove_category" name="category" hidden>
      <div class="modal-body"> <!-- Bulk Delete Modal -->
        <div class="container">
            <h4>You are about to make <strong id="adminToMake">This</strong> an Admin
            <br>Are you sure you want to perform this action?</h4> <!-- Bulk Delete Modal -->
            <br> <!-- Bulk Delete Modal -->
        </div>
      </div> <!-- Bulk Delete Modal -->
      <div class="modal-footer">
        <button id="makeAdminUsername" type="submit" class="btn btn-custom" name="user[make_admin]" form="userManage" value="" >Make Admin</button>
        <button type="button" class="btn btn-custom" data-dismiss="modal">Close</button>
      </div>
      </form>
    </div>
  </div>
</div>

<div id="promptRemoveAdminModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content"> <!-- Bulk Delete Modal -->
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button> <!-- Bulk Delete Modal -->
        <h4 class="modal-title">Attention</h4> <!-- Bulk Delete Modal -->
      </div>
      <input id="remove_category" name="category" hidden>
      <div class="modal-body"> <!-- Bulk Delete Modal -->
        <div class="container">
            <h4>You are about to remove admin rights from <strong id="adminToRemove">This</strong>
            <br>Are you sure you want to perform this action?</h4> <!-- Bulk Delete Modal -->
            <br> <!-- Bulk Delete Modal -->
        </div>
      </div> <!-- Bulk Delete Modal -->
      <div class="modal-footer">
        <button id="removeAdminUsername" type="submit" class="btn btn-custom" name="user[remove_admin]" form="userManage" value="" >Remove Admin</button>
        <button type="button" class="btn btn-custom" data-dismiss="modal">Close</button>
      </div>
      </form>
    </div>
  </div>
</div>


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