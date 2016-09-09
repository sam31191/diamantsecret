<!doctype html>
<!--[if IE 8 ]>    <html lang="en" class="no-js ie8"> <![endif]-->
<!--[if (gt IE 9)|!(IE)]><!--> <html lang="en" class="no-js"> <!--<![endif]-->
<head>
  <meta charset="UTF-8">
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1" />
  <link rel="canonical" href="/" />
  <meta name="description" content="" />
  <title>Register Page</title>
  
    <link href="./assets/stylesheets/font.css" rel='stylesheet' type='text/css'>
  
	<link href="./assets/stylesheets/font-awesome.min.css" rel="stylesheet" type="text/css" media="all"> 	
	<link href="./assets/stylesheets/bootstrap.min.3x.css" rel="stylesheet" type="text/css" media="all">
	<link href="./assets/stylesheets/cs.bootstrap.3x.css" rel="stylesheet" type="text/css" media="all">
	<link href="./assets/stylesheets/cs.animate.css" rel="stylesheet" type="text/css" media="all">
	<link href="./assets/stylesheets/cs.global.css" rel="stylesheet" type="text/css" media="all">
	<link href="./assets/stylesheets/cs.style.css" rel="stylesheet" type="text/css" media="all">
	<link href="./assets/stylesheets/cs.media.3x.css" rel="stylesheet" type="text/css" media="all">
	<link href="./assets/stylesheets/site.css" rel="stylesheet" type="text/css" media="all">
	
	<script src="./assets/javascripts/jquery-1.9.1.min.js" type="text/javascript"></script>
	<script src="./assets/javascripts/bootstrap.min.3x.js" type="text/javascript"></script>
</head>
<?php
if ( session_status() == PHP_SESSION_NONE ) {
	session_start();
}
include './url/require.php';

#pre
$alert = "";

if ( isset($_POST['register']) ) {
	pconsole($_POST);

	$checkUsername = $pdo->prepare("SELECT * FROM `accounts` WHERE `username` = :user");
	$checkUsername->execute(array(":user" => $_POST['customer']['username']));
	
	$checkEmail = $pdo->prepare("SELECT * FROM `accounts` WHERE `email` = :user");
	$checkEmail->execute(array(":user" => $_POST['customer']['email']));


	if ( $checkUsername->rowCount() > 0 ) {
		$checkUsername = $checkUsername->fetch(PDO::FETCH_ASSOC);

		if ( $checkUsername['activated'] == 0 ) {
			$alert = ' Email with the activation link has already been sent to your Inbox: '. $checkUsername['email'] .' ';
		} else {
			$alert = ' Username Already Exists ';
		}
	} else if ( $checkEmail->rowCount() > 0 ) {
		$checkEmail = $checkEmail->fetch(PDO::FETCH_ASSOC);

		if ( $checkEmail['activated'] == 0 ) {
			$alert = ' Email with the activation link has already been sent to your Inbox: '. $checkEmail['email'] .' ';
		} else {
			$alert = ' Email Already Registered. Please <a href="./login.php"  style="color: #607D8B;">Login</a> Instead ';
		}
		
	} else {
		require './url/PHPMailerAutoload.php';


		$email = filter_var(trim($_POST['customer']['email']), FILTER_SANITIZE_EMAIL);
		#$hashPass = strtoupper(hash("whirlpool", $_POST['customer']['password'] . $HASH));
		$hashPass = $_POST['customer']['password'];
		$verifyHash = hash("md5", $email . "VERIFICATIONH1337ASH");

		$mail = new PHPMailer;
		$mail->isSMTP();
		#$mail->SMTPDebug = 2;
		#$mail->Debugoutput = 'html';
		$mail->Host = $mailHost;
		$mail->Port = $mailPort;
		$mail->SMTPAuth = $mailSMTPAuth;
		$mail->Username = $mailUsername;
		$mail->Password = $mailPassword;
		$mail->setFrom('contact@diamantsecret.com', 'Diamant Secret');
		$mail->addAddress($email);
		$mail->isHTML(true);
		$mail->Subject = 'Activation Account';
		$mail->Body = "Greetings, " . $_POST['customer']['username'] . "
		To activate your account, please click on the following link and follow the instructions: http://www.diamantsecret.com/register.php?verify=" . $verifyHash;
		if ( !$mail->send() ) {

		} else {
			$alert = 'Registration Successful. Please follow the instructions in your Email to continue';
			$createUser = $pdo->prepare("INSERT INTO `accounts` (`username`, `email`, `password`, `first_name`, `last_name`, `mobileno`, `address`, `type`, `activated`, `verification_hash`) VALUES (:user, :email, :password, :first_name, :last_name, :phone_number, :address, 0, 0, :hash)");

			$createUser->execute(array(
				":user" => trim($_POST['customer']['username']),
				":email" => $email,
				":password" => $hashPass,
				":first_name" => trim($_POST['customer']['first_name']),
				":last_name" => trim($_POST['customer']['last_name']),
				":phone_number" => trim($_POST['customer']['phone_number']),
				":address" => trim($_POST['customer']['address']),
				":hash" => $verifyHash,
			));
		}
	}
}

if ( isset($_GET['verify']) ) {
	$verify = $pdo->prepare("SELECT * FROM `accounts` WHERE `verification_hash` = :verify");
	$verify->execute(array(":verify" => $_GET['verify']));

	if ( $verify->rowCount() > 0 ) {
		$accountToActivate = $verify->fetch(PDO::FETCH_ASSOC);

		$activate = $pdo->prepare("UPDATE `accounts` SET `activated` = 1, `verification_hash` = :emptyHash WHERE `email` = :email");
		$activate->execute(array(":emptyHash" => "", ":email" => $accountToActivate['email']));

		//echo var_dump($activate);

		$alert = 'Account Verified. Please <a href="./login.php" style="color: #607D8B;">Login</a>';
	} else {
		$alert = 'Verification link isn\'t valid anymore';
	}
}
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
								<a href="./index.html" class="homepage-link" title="Back to the frontpage">Home</a>
								<span>/</span>
								<span class="page-title">Create Account</span>
							</div>
						</div>
					</div>
				</div>              
				<section class="content">
					<div class="container">
						<div class="row">
							<div id="page-header" class="col-md-24">
								<h1 id="page-title">Register</h1> 
							</div>
							<div class="col-md-24" style="padding-right: 52%;">
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
							</div>
							<div id="col-main" class="col-md-12 register-page clearfix">
								<form method="post" id="create_customer" accept-charset="UTF-8">
									<input value="create_customer" name="form_type" type="hidden"><input name="utf8" value="✓" type="hidden">
									<ul id="" class="row list-unstyled">
										<li id="last_namef">
										<label class="control-label" for="username">Username <span class="req">*</span></label>
										<input name="customer[username]" pattern="[a-zA-Z0-9-+$_^!][a-zA-Z0-9\s-+$_^!]{2,32}"  id="username" class="form-control " type="text" required>
										</li>
										<li class="clearfix"></li>
										<li id="emailf" class="">
										<label class="control-label" for="email">Email <span class="req">*</span></label>
										<input name="customer[email]" id="email" class="form-control " type="email" required>
										</li>
										<li class="clearfix"></li>
										<li id="passwordf" class="">
										<label class="control-label" for="password">Password <span class="req">*</span></label>
										<input value="" name="customer[password]" id="password" pattern=".{6,}" title="Minimum 6 Characters" class="form-control password" type="password" required>
										</li>
										<li class="clearfix"></li>
										<li>
										<label class="control-label" for="first_name">First Name</label>
										<input name="customer[first_name]" id="first_name" class="form-control" type="text">
										</li>
										<li class="clearfix"></li>
										<li id="last_namef">
										<label class="control-label" for="last_name">Last Name</label>
										<input name="customer[last_name]" id="last_name" class="form-control " type="text">
										</li>
										<li class="clearfix"></li>
										<li id="passwordf" class="">
										<label class="control-label" for="password">Phone Number</label>
										<input value="" name="customer[phone_number]" id="phone_number" class="form-control" type="number">
										</li>
										<li class="clearfix"></li>
										<li id="passwordf" class="">
										<label class="control-label" for="password">Address</label>
										<input value="" name="customer[address]" id="address" class="form-control" type="text">
										</li>
										<li class="clearfix"></li>
										<li class="unpadding-top action-last">
										<button class="btn" type="submit" name="register">Create an Account</button>
										</li>
									</ul>
								</form>
							</div>   
						</div>
					</div>
				</section>        
			</div>
		</div>
	</div>

	<?php include './url/footer.php'; ?>
</body>