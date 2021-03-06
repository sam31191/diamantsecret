<?php
if ( session_status() == PHP_SESSION_NONE ) {
  session_start();
}
if ( isset($_SESSION['modSession']) && $_SESSION['modSession'] ) {
  header("Location: pages/all_items.php");
  exit();
}
if ( !isset($_SESSION['admin']) ) {
  header ("Location: ./../index.php");
  exit();
}
include '../conf/config.php';
$message = "";
if ( isset($_POST['Password']) ) {
  $authenticate = $pdo->prepare("SELECT * FROM `accounts` WHERE `username` = :username AND `password` = :pass AND `site_id` = 1");
  $authenticate->execute(array(":username" => $_SESSION['username'], ":pass" => $_POST['Password']));
  
  if ( $authenticate->rowCount() > 0 ) {
    $result = $authenticate->fetch(PDO::FETCH_ASSOC);
    if ( $result['type'] >= 1 ) {
      $_SESSION['modSession'] = true;
      $log = $pdo->prepare("INSERT INTO `moderator_login` (`username`, `last_login`, `login_ip`) VALUES (:username, NOW(), :ip)");
      $log->execute(array(":username" => $_SESSION['username'], ":ip" => get_client_ip())); 
      header("Location: pages/all_items.php");
    }
    else {
      $message = ("Invalid Admin Rank");
    }
  }
  else {
    $message = ("Invalid Login");
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
    <title>Admin Control Panel Login</title>
    <!-- Bootstrap -->
    <link href="../css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel='stylesheet prefetch' href='//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css'>
    <!-- Custom Theme Style -->
    <link href="./assets/custom.min.css" rel="stylesheet">
    <link href="./assets/admin.css" rel="stylesheet">
    <link rel="icon" href="../../images/gfx/favicon.png?v=1" type="image/png" sizes="16x16">
    <!-- Animate.css -->
    <link href="https://colorlib.com/polygon/gentelella/css/animate.min.css" rel="stylesheet">

  </head>
  <body class="login">
    <div>
      <a class="hiddenanchor" id="signup"></a>
      <a class="hiddenanchor" id="signin"></a>
      <?php
        if ( !empty($message) ) {
          echo '<div class="alert-custom notification" id="notification">'. $message .'</div>';  
        }
      ?>
      
      <div class="login_wrapper">
        <div class="animate form login_form">
          <section class="login_content">
            <form method="post">
              <h1>Administrator Login</h1>
              <div>
              </div>
              <div>
                <input type="password" class="form-control" placeholder="Password" required="" name="Password" />
              </div>
              <div>
                <button class="btn btn-custom submit">Log in</button>
              </div>

              <div class="clearfix"></div>

              <div class="separator">
                <div class="clearfix"></div>
                <br />

                <div>
                  <h1><a href="../index.php"><img src="../images/gfx/logo.png" style="width: 100%;"></a></h1>
                  <p>©2016 All Rights Reserved. Privacy and Terms</p>
                </div>
              </div>
            </form>
          </section>
        </div>
      </div>
    </div>
  </body>
</html>