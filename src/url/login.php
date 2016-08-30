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
    <!-- Custom Theme Style -->
    <link href="../css/custom.min.css" rel="stylesheet">
    <link href="admin-assets/admin.css" rel="stylesheet">
    <link href="../css/site.css" rel="stylesheet">
    <!-- Animate.css -->
    <link href="../css/animate.min.css" rel="stylesheet">

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
      
      
<div class="alert-custom notification" id="notification">Notification</div>

      <?php 
	  include '../url/require.php';
	  if ( isset($_POST['Username']) && isset($_POST['Password']) ) {
		  $checkUser = $pdo->prepare("SELECT `username` FROM `accounts` WHERE `username` = :username");
		  $checkUser->execute(array(":username" => $_POST['Username']));
		  
		  if ( $checkUser->rowCount() > 0 ) {
			  $authenticate = $pdo->prepare("SELECT * FROM `accounts` WHERE `username` = :username AND `password` = :password");
			  $authenticate->execute(array(":username" => $_POST['Username'], ":password" => $_POST['Password']));
			  if ( $authenticate->rowCount() > 0 ) {
				  $result = $authenticate->fetch(PDO::FETCH_ASSOC);
				  $_SESSION['loggedIn'] = true;
				  $_SESSION['Username'] = $result['username'];
				  $_SESSION['Email'] = $result['email'];
				  
				  if ( $result['type'] > 0 ) {
				  	$_SESSION['Admin'] = $result['type'];
				  }
				  
				  header("Location: ../index.php");
			  } else {
			  	notify ( "Incorrect Password" );
			  }
			  
		  } else {
		  	notify (  "Invalid Username" );
		  }
		  
	  } else if ( isset($_POST['register']) ) {
	  	//echo var_dump($_POST);
		
		$checkMail = $pdo->prepare("SELECT `username` FROM `accounts` WHERE `email` = :username");
		$checkMail->execute(array(":username" => $_POST['email']));
		
		$checkUser = $pdo->prepare("SELECT `username` FROM `accounts` WHERE `username` = :username");
		$checkUser->execute(array(":username" => $_POST['username']));
		
		if ( !$checkUser->rowCount() > 0 && !$checkMail->rowCount() > 0 ) {
			$register = $pdo->prepare("INSERT INTO `accounts` (`username`, `email`, `password`, `first_name`, `last_name`, `address`, `mobileno`)
			VALUES (:user, :email, :pass, :firstname, :lastname, :address, :mobileno)");
			$register->execute(array(
				":user" => $_POST['username'],
				":pass" => $_POST['password'],
				":email" => $_POST['email'],
				":firstname" => $_POST['firstName'],
				":lastname" => $_POST['lastName'],
				":address" => $_POST['address'],
				":mobileno" => $_POST['phoneNumber']
			));
			notify("User created");
		} else if ( $checkMail->rowCount() > 0 ) {
			notify("Email already registered");
		} else {
			notify("User already exists");
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
              <h1>Login</h1>
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
                  <h1><a href="../index.php"><img src="../images/gfx/Arhaan_Small_logo.png"></a></h1>
                  <p>©2016 All Rights Reserved. Privacy and Terms</p>
                </div>
              </div>
            </form>
          </section>
        </div>
        
        
        <div id="register" class="animate form registration_form">
          <section class="login_content">
            <form method="post">
              <h1>Create Account</h1>
              <div>
                <input type="text" class="form-control" placeholder="Username" required="" name="username" />
              </div>
              <div>
                <input type="email" class="form-control" placeholder="Email" required="" name="email" />
              </div>
              <div>
                <input type="password" class="form-control" placeholder="Password" required="" name="password"/>
              </div>
              <div class="col-sm-6">
                <input type="text" class="form-control" placeholder="First Name" name="firstName"/>
              </div>
              <div class="col-sm-6">
                <input type="text" class="form-control" placeholder="Last Name"  name="lastName"/>
              </div>
              <div>
                <input type="text" class="form-control" placeholder="Address"  name="address"/>
              </div>
              <div>
                <input class="form-control" placeholder="Phone Number"  name="phoneNumber" pattern="[0-9]{10,}" />
              </div>
              
              <div>
                <button type="submit" class="btn btn-custom" name="register">Submit</button>
              </div>

              <div class="clearfix"></div>

              <div class="separator">
                <p class="change_link">Already a member ?
                  <a href="#signin" class="to_register"> Log in </a>
                </p>

                <div class="clearfix"></div>
                <br />

                <div>
                  <h1><a href="../index.php"><img src="../images/gfx/Arhaan_Small_logo.png"></a></h1>
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