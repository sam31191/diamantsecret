<?php
if ( session_status() == PHP_SESSION_NONE ) {
  session_start();
}
if ( !isset($_SESSION['loggedIn']) || !$_SESSION['loggedIn'] ) {
  header("location: ./login.php");
  exit();
}
?><!doctype html>
<!--[if IE 8 ]>    <html lang="en" class="no-js ie8"> <![endif]-->
<!--[if (gt IE 9)|!(IE)]><!--> <html lang="en" class="no-js"> <!--<![endif]-->
<head>

  <meta charset="UTF-8">
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1" />
  <link rel="canonical" href="/" />
  <meta name="description" content="" />
  <title>Account Page</title>
  
    <link href="./assets/stylesheets/font.css" rel='stylesheet' type='text/css'>
  
  <link href="./assets/stylesheets/font-awesome.min.css" rel="stylesheet" type="text/css" media="all">  
  <link href="./assets/stylesheets/bootstrap.min.3x.css" rel="stylesheet" type="text/css" media="all">
  <link href="./assets/stylesheets/cs.bootstrap.3x.css" rel="stylesheet" type="text/css" media="all">
  <link href="./assets/stylesheets/cs.animate.css" rel="stylesheet" type="text/css" media="all">
  <link href="./assets/stylesheets/cs.global.css" rel="stylesheet" type="text/css" media="all">
  <link href="./assets/stylesheets/cs.style.css" rel="stylesheet" type="text/css" media="all">
  <link href="./assets/stylesheets/cs.media.3x.css" rel="stylesheet" type="text/css" media="all">
  <link href="./assets/stylesheets/site.css" rel="stylesheet" type="text/css" media="all">
  <link rel="icon" href="./images/gfx/favicon.png?v=1" type="image/png" sizes="16x16">
  
  <script src="./assets/javascripts/jquery-1.9.1.min.js" type="text/javascript"></script>
  <script src="./assets/javascripts/bootstrap.min.3x.js" type="text/javascript"></script>
</head>

<?php
include './conf/config.php';


#pre
$alert = "";

?>
<body itemscope="" itemtype="http://schema.org/WebPage" class="templateCustomersRegister notouch">
  
  <!-- Header -->
  <?php include './url/header.php'; ?>
  
  <div id="content-wrapper-parent">
    <div id="content-wrapper">  
      <!-- Content -->
      <div id="content" class="clearfix">        
        <div id="breadcrumb" class="breadcrumb">
          <div itemprop="breadcrumb" class="container">
            <div class="row">
              <div class="col-md-24">
                <a href="./index.php" class="homepage-link" title="Back to the frontpage">Home</a>
                <span>/</span>
                <span class="page-title">My Account</span>
              </div>
            </div>
          </div>
        </div>              
      <section class="content">
          <div class="container">
            <div class="row">
              <div id="page-header" class="col-md-24">
                <h1 id="page-title">My Orders</h1> 
              </div>
              <?php
                if ( !empty($alert) ) {
                  echo '
                    <div class="col-md-21 login-alert">
                      <div class="alert alert-danger">
                        <button type="button" class="close btooltip" data-toggle="tooltip" data-placement="top" title="" data-dismiss="alert" data-original-title="Close">×</button>
                        <div class="errors">
                          <ul>
                            <li>'. $alert .'</li>
                          </ul>
                        </div>
                      </div>
                    </div>';
                }
              ?>
              <div id="col-main" class="account-page col-sm-24 col-md-24 clearfix">
                <div id="customer_orders">
                  <span class="mini-line"></span>
                  <div class="row wrap-table">
                    <style type="text/css">
                    .note > .price {
                      font-size: 24px;
                      line-height: 24px;
                    }
                    </style>
                    <table class="table-hover">
                    <thead>
                    <tr>
                      <th class="order_number">
                        Amount
                      </th>
                      <th class="date">
                        Status
                      </th>
                      <th class="payment_status">
                        
                      </th>
                      <th class="total">
                        Time
                      </th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    $getPurchases = $pdo->prepare("SELECT * FROM `tb_paypal_payments` WHERE `user` = :user");
                    $getPurchases->execute(array(":user" => $_SESSION['user_id']));

                    if ( $getPurchases->rowCount() > 0 ) {
                      $purchases = $getPurchases->fetchAll();



                      foreach ( $purchases as $item ) {
                        if ( !empty($item) ) {
                          $price = '<span class="price">€ '. number_format($item['amount'], 2) .'<br/><span style="font-size: 14px;">Invoice: '. $item['invoice_number'] .'</span></span>';
                          $status = '<label class="label label-danger" style="font-size: 20px;" >Unknown</label>';

                          switch ( $item['state'] ) {
                            case 'approved': {
                              $status = '<label class="label label-success" style="font-size: 20px;" >Approved</label>';
                              break;
                            } case 'opened': {
                              $status = '<label class="label label-warning" style="font-size: 20px;" >Opening</label>';
                              break;
                            }
                          }
                          echo '
                          <tr class="odd ">
                            <td>
                              <span class="note">'. $price .'</span>
                            </td>
                            <td>
                              <span class="note">'. $status .'</span>
                            </td>
                            <td>
                              <span class="status_authorized"><a class="btn btn-custom" href="#" onclick="viewCartInfo(\''. $item['invoice_number'] .'\')">View</a></span>
                            </td>
                            <td>
                              <span class="note">'. $item['create_time'] .'</span>
                            </td>
                          </tr>';
                        }
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
        </section>        
      </div>
    </div>
  </div>

  <?php include './url/footer.php'; ?>
</body>


<div id="settingsModal" class="modal in" role="dialog" aria-hidden="false" tabindex="-1" data-width="800">
  <div class="modal-backdrop in" style="height: 742px;">
  </div>
  <div class="modal-dialog modal-lg rotateInDownLeft animated" style="width: 85vw;">
    <div class="modal-content" style="min-height: 0px;  overflow:auto; max-width: 95vw;">
      <div class="modal-header">
        <i class="close fa fa-times btooltip" data-toggle="tooltip" data-placement="bottom" title="" data-dismiss="modal" aria-hidden="true" data-original-title="Close"></i>
      </div>
      <div class="modal-body">
        <div class="quick-shop-modal-bg" style="display: none;">
        </div>
        <div class="row" id="modalContent">
          
        </div>
      </div>
    </div>
  </div>
</div>

<script>
  function viewCartInfo(invoice) {
    $.ajax({
      url: './url/ajax.php?paymentInfo='+ invoice,
      type: 'GET',
      beforeSend: function() {
        $("#modalContent").html('<div class="col-sm-8 col-sm-offset-8 text-center"><img src="./images/gfx/cube_lg.gif" /><br/><h5>Fetching Info</h5></div>');
        $("#settingsModal").modal("toggle");
      },
      success: function(result) {
        $("#modalContent").html(result);
      }
    });
  }
</script>

</html>