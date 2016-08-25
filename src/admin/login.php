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
    <link rel='stylesheet prefetch' href='http://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css'>
    <!-- Custom Theme Style -->
    <link href="admin-assets/custom.min.css" rel="stylesheet">
    <link href="admin-assets/admin.css" rel="stylesheet">
    <link href="../css/site.css" rel="stylesheet">
    <!-- Animate.css -->
    <link href="https://colorlib.com/polygon/gentelella/css/animate.min.css" rel="stylesheet">

  </head>
<?php
if ( session_status() == PHP_SESSION_NONE ) {
	session_start();
}
?>
  <body class="login">
    <div>
      <a class="hiddenanchor" id="signup"></a>
      <a class="hiddenanchor" id="signin"></a>
      
      
<div class="alert-custom notification" id="notification">USERNAME INVALID</div>

      <?php 
	  include '../url/require.php';
	  if ( isset($_POST['Username']) && isset($_POST['Password']) ) {
		  $authenticate = $pdo->prepare("SELECT * FROM `accounts` WHERE `username` = :username AND `password` = :pass");
		  $authenticate->execute(array(":username" => $_POST['Username'], ":pass" => $_POST['Password']));
		  
		  if ( $authenticate->rowCount() > 0 ) {
		  	$result = $authenticate->fetch(PDO::FETCH_ASSOC);
			if ( $result['type'] == 1 ) {
				$_SESSION['modSession'] = true;
				$log = $pdo->prepare("INSERT INTO `moderator_login` (`username`, `last_login`, `login_ip`) VALUES (:username, NOW(), :ip)");
				$log->execute(array(":username" => $_SESSION['Username'], ":ip" => get_client_ip())); 
				header("Location: home.php");
			}
			else {
				notify ("Invalid Admin Rank");
			}
		  }
		  else {
		  	notify ("Invalid Login");
		  }
	  }
	  
	  function notify( $message ) {
	?>
		<script> 
            document.getElementById("notification").innerHTML = "<?php echo $message; ?>";
            document.getElementById("notification").style.display = "block"; 
        </script>';
    <?php
	}
	  ?>

      <div class="login_wrapper">
        <div class="animate form login_form">
          <section class="login_content">
            <form method="post">
              <h1>Administrator Login</h1>
              <div>
                <input type="text" class="form-control" placeholder="Username" required="" name="Username" />
              </div>
              <div>
                <input type="password" class="form-control" placeholder="Password" required="" name="Password" />
              </div>
              <div>
                <button class="btn btn-custom submit" href="index.html">Log in</button>
              </div>

              <div class="clearfix"></div>

              <div class="separator">
                <div class="clearfix"></div>
                <br />

                <div>
                  <h1><img src="http://www.arhaandiam.com/images/Arhaan_Small_logo.png"></h1>
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