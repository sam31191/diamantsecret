<!DOCTYPE html>
<html >
<?php
if ( session_status() == PHP_SESSION_NONE ) {
	session_start();
}
?>
<head>
    <meta charset="UTF-8">
    <title>Login - WEBSITE</title>
	<link rel='stylesheet prefetch' href='//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css'>
	<link rel="stylesheet" href="../css/reset.css">
	<link rel="stylesheet" href="../css/style.css">
	<link href="../css/site.css" rel="stylesheet" type="text/css">
</head>
  <body>
<!-- Mixins-->
<!-- Pen Title-->
<div class="pen-title">
  <h1><a href="../index.php"><img src="//www.arhaandiam.com/images/Arhaan_Small_logo.png"></a></h1>
</div>
<div class="alert-custom notification" id="notification">USERNAME INVALID</div>

 
<?php
	include 'require.php';
	if ( isset($_POST["form"])) {
		if ( $_POST["form"] == "Login" ) {
			$q = $pdo->prepare("SELECT * FROM `accounts` WHERE `Username` = :username");
			$q->execute(array(":username" => $_POST['loginUsername']));
			
			if ( $q->rowCount() > 0 ) {
				notify("Login Successful");
				$creds = $q->fetch(PDO::FETCH_ASSOC);
				$_SESSION['loggedIn'] = true;
				$_SESSION['Username'] = $creds['Username'];
				
				if ( $creds['Admin'] > 0 ) {
					$_SESSION['Admin'] = $creds['Admin'];
				}
			} else {
				?>
				<script> 
					document.getElementById("notification").innerHTML = "Username not found";
					document.getElementById("notification").style.display = "block"; 
                </script>';
				<?php
			}
		}
		else if ( $_POST["form"] == "Register" ) {
			$username = $_POST['registerUsername'];
			$email = $_POST['registerEmail'];
			$password=  $_POST['registerPass'];
			
			if ( $password == $_POST['registerPass2'] ) {
				try {
					$register = $pdo->prepare("INSERT INTO `accounts` (Username, Email, Password) VALUES (:username, :email, :pass)");
					$register->execute(array(":username" => $username, ":email" => $email, ":pass" => $password));
					
					notify("Registration Successful");
				} catch ( PDOException $e ) {
					notify("Unknown Error:  Please contact the system administrator");
				}
			}
			else {
				notify("Password Mismatch");
			}
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

<div class="container">
  <div class="card"></div>
  <div class="card">
    <h1 class="title">Login</h1>
    <form method="post">
      <div class="input-container">
        <input type="text" id="Username" required="required" name="loginUsername"/>
        <label for="Username">Username</label>
        <div class="bar"></div>
      </div>
      <div class="input-container">
        <input type="password" id="Password" required="required" name="loginPassword"/>
        <label for="Password">Password</label>
        <div class="bar"></div>
      </div>
      <div class="button-container">
        <button type="submit" name="form" value="Login"><span>Go</span></button>
      </div>
      <div class="footer"><a href="#">Forgot your password?</a></div>
    </form>
  </div>
  <div class="card alt">
    <div class="toggle" title="Register"></div>
    <h1 class="title">Register
      <div class="close"></div>
    </h1>
    <form method="post">
      <div class="input-container">
        <input type="text" id="Username" required="required" name="registerUsername"/>
        <label for="Username">Username</label>
        <div class="bar"></div>
      </div>
      <div class="input-container">
        <input type="email" id="Email" required="required" name="registerEmail"/>
        <label for="Email">Email</label>
        <div class="bar"></div>
      </div>
      <div class="input-container">
        <input type="password" id="Password" required="required" name="registerPass"/>
        <label for="Password">Password</label>
        <div class="bar"></div>
      </div>
      <div class="input-container">
        <input type="password" id="Repeat Password" required="required" name="registerPass2"/>
        <label for="Repeat Password">Repeat Password</label>
        <div class="bar"></div>
      </div>
      <div class="button-container">
        <button type="submit" name="form" value="Register"><span>Next</span></button>
      </div>
    </form>
  </div>
</div>
<!-- CodePen--><a id="codepen" href="../index.php" title="Back to Homepage"><i class="fa fa-home"></i></a>
<script src='https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js'></script>
<script src="../js/index.js"></script>
   </body>
<?php
if ( isset($_SESSION['loggedIn']) ) {
	if ( $_SESSION['loggedIn'] ) {
		sleep(1);
		header ('Location: ../index.php');
	}
}
?>
</html>
