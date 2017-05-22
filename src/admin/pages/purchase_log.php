<?php
if ( session_status() == PHP_SESSION_NONE ) {
  session_start();
}

include '../../conf/config.php';

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
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Purchase Logs - Admin Panel</title>
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
      <div class="main_container" style="background: #607d8b;">
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

            <div>

            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x-panel">
                    <table id="itemsTable" class="table table-striped table-bordered bulk_action" style="font-size: 12px;">
                        <thead>
                            <th>#</th>
                            <th>Payment ID</th>
                            <th>State</th>
                            <th>Cart</th>
                            <th>User</th>
                            <th>Billing</th>
                            <th>Shipping</th>
                            <th>Payer ID <i class="fa fa-info-circle" data-toggle="tooltip" title="Payer's Paypal ID"></i></th>
                            <th>Amount</th>
                            <th>Invoice #</th>
                            <th>Created On</th>
                            <th>Updated On</th>
                        </thead>
                        <tbody>
                            <?php 
                                $query = $pdo->prepare("SELECT * FROM `tb_paypal_payments`");
                                $query->execute();

                                if ( $query->rowCount() > 0 ) {
                                    foreach( $query->fetchAll() as $entry ) {

                                        switch($entry['state']) {
                                            case 'created': {
                                                $state = "<label class='label label-warning'>Created</label>";
                                                break;
                                            } case 'approved': {
                                                $state = "<label class='label label-success'>Approved</label>";
                                                break;
                                            } default: {
                                                $state = "<label class='label label-danger'>-</label>";
                                                break;
                                            }
                                        }

                                        $user = $pdo->prepare("SELECT username FROM accounts WHERE id = :id");
                                        $user->execute(array(":id" => $entry['user']));

                                        if ( $user->rowCount() > 0 ) {
                                            $user = $user->fetch(PDO::FETCH_ASSOC)['username'] ." (". $entry['user'] .")";
                                        } else {
                                            $user = "-";
                                        }

                                        echo '<tr>';
                                            echo '<td>'. $entry['#'] .'</td>';
                                            echo '<td>'. $entry['id'] .'</td>';
                                            echo '<td>'. $state .'</td>';
                                            echo '<td>'. $entry['cart'] .'</td>';
                                            echo '<td>'. $user .'</td>';
                                            echo '<td>'. $entry['billing_address'] .'</td>';
                                            echo '<td>'. $entry['shipping_address'] .'</td>';
                                            echo '<td>'. $entry['payer_id'] .'</td>';
                                            echo '<td>&euro; '. number_format($entry['amount'], 2) .'</td>';
                                            echo '<td>'. $entry['invoice_number'] .'</td>';
                                            echo '<td>'. $entry['create_time'] .'</td>';
                                            echo '<td>'. $entry['update_time'] .'</td>';
                                        echo '</tr>';
                                    }
                                }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>

            </div>
            
        </div>
        </div>
        <!-- /page content -->

        <!-- footer content -->
        <footer style="margin-top:-20px;">
          <?php include 'footer.php'; ?>
        </footer>
        <!-- /footer content -->

        <?php 
        include_once('common/modal.php');
        ?>

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
      'order': [[ 0, 'desc' ]],
      'columnDefs': [
        { orderable: false, targets: [] },
        { width: '250px', targets: [5, 6] }
      ],
      "lengthMenu": [[-1, 10, 25, 50, 100], ["All", 10, 25, 50, 100]]
    });

    </script>
  </body>
</html>
