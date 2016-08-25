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
    <link href="../css/custom.min.css" rel="stylesheet">
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
			$_SESSION['loggedIn'] = true;
			$_SESSION['Username'] = $result['username'];
			
			if ( $result['type'] > 0 ) {
				$_SESSION['Admin'] = $result['type'];
			}
			
			notify ("Login Successful");
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
              
                <p class="change_link">New to site?
                  <a href="#signup" class="to_register"> Create Account </a>
                </p>
                <div class="clearfix"></div>
                <br />

                <div>
                  <h1><a href="../index.php"><img src="http://www.arhaandiam.com/images/Arhaan_Small_logo.png"></a></h1>
                  <p>©2016 All Rights Reserved. Privacy and Terms</p>
                </div>
              </div>
            </form>
          </section>
        </div>
        
        
        <div id="register" class="animate form registration_form">
          <section class="login_content">
            <form>
              <h1>Create Account</h1>
              <div>
                <input type="text" class="form-control" placeholder="Username" required="" />
              </div>
              <div>
                <input type="email" class="form-control" placeholder="Email" required="" />
              </div>
              <div>
                <input type="password" class="form-control" placeholder="Password" required="" />
              </div>
              <div>
                <a class="btn btn-custom submit" href="index.html">Submit</a>
              </div>

              <div class="clearfix"></div>

              <div class="separator">
                <p class="change_link">Already a member ?
                  <a href="#signin" class="to_register"> Log in </a>
                </p>

                <div class="clearfix"></div>
                <br />

                <div>
                  <h1><a href="../index.php"><img src="http://www.arhaandiam.com/images/Arhaan_Small_logo.png"></a></h1>
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