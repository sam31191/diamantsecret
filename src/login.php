<!doctype html>
<!--[if IE 8 ]>    <html lang="en" class="no-js ie8"> <![endif]-->
<!--[if (gt IE 9)|!(IE)]><!--> <html lang="en" class="no-js"> <!--<![endif]-->
<head>
  <meta charset="UTF-8">
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1" />
  <link rel="canonical" href="/" />
  <meta name="description" content="" />
  <title>Login Page</title>
  
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

<body itemscope="" itemtype="http://schema.org/WebPage" class="templateCustomersRegister notouch">
  
<?php

if ( session_status() == PHP_SESSION_NONE ) {
	session_start();
}
include 'conf/config.php';
include './assets/mail_format/admin_mail.php';

pconsole($_POST);


if ( isset($_SESSION['loggedIn']) && $_SESSION['loggedIn'] ) {
	session_destroy();
	$_SESSION['loggedIn'] = false;
}

if ( isset($_GET['unsub']) ) {
	//echo var_dump($_GET);

	$checkSub = $pdo->prepare("SELECT * FROM `subscribers` WHERE `hash` = :hash");
	$checkSub->execute(array(":hash" => $_GET['unsub']));
	if ( $checkSub->rowCount() > 0 ) {
		$unsub = $pdo->prepare("DELETE FROM `subscribers` WHERE `hash` = :hash");
		$unsub->execute(array(":hash" => $_GET['unsub']));

		$error = "You have unsubscribed from our newsletter";
	}
}

if ( isset($_POST['login']['username']) ) {
	$checkUser = $pdo->prepare("SELECT `username` FROM `accounts` WHERE `username` = :user");
	$checkUser->execute(array(":user" => $_POST['login']['username']));

	if ( $checkUser->rowCount() > 0 ) {
		$authenticate = $pdo->prepare("SELECT * FROM `accounts` WHERE `username` = :user AND BINARY `password` = :pass");
		$authenticate->execute (
			array(
				":user" => $_POST['login']['username'],
				":pass" => $_POST['login']['password']
			));

		if ( $authenticate->rowCount() > 0 ) {
			$result = $authenticate->fetch(PDO::FETCH_ASSOC);

			$_SESSION['username'] = $result['username'];
			$_SESSION['email'] = $result['email'];
			$_SESSION['loggedIn'] = true;

			if ( $result['type'] > 0 ) {
				$_SESSION['admin'] = $result['type'];
			}

			header("Location: index.php");
		} else {
			$error = "Authentication Failed / Check your credentials";
		}
	} else {
		$error = "No User Found";
	}
} else if ( isset($_POST['form_type']) ) {
	$checkUser = $pdo->prepare("SELECT `username` FROM `accounts` WHERE `username` = :user");
	$checkUser->execute(array(":user" => $_POST['customer']['username']));

	if ( $checkUser->rowCount() > 0 ) {
		//echo var_dump("User Exist");
		$authenticate = $pdo->prepare("SELECT * FROM `accounts` WHERE `username` = :user AND BINARY `password` = :pass");
		$authenticate->execute (
			array(
				":user" => $_POST['customer']['username'],
				":pass" => $_POST['customer']['password']
			));

		if ( $authenticate->rowCount() > 0 ) {
			$result = $authenticate->fetch(PDO::FETCH_ASSOC);

			$_SESSION['username'] = $result['username'];
			$_SESSION['email'] = $result['email'];
			$_SESSION['loggedIn'] = true;

			if ( $result['type'] > 0 ) {
				$_SESSION['admin'] = $result['type'];
			}

			header("Location: index.php");
		} else {
			$error = "Authentication Failed / Check your credentials";
		}
	} else {
		$error = "No User Found";
	}
} else if ( isset($_POST['recover']) ) {
	$checkUser = $pdo->prepare("SELECT * FROM `accounts` WHERE `email` = :email");
	$checkUser->execute(array(":email" => trim($_POST['recover']['email'])));

	if ( $checkUser->rowCount() > 0 ) {
		$userInfo = $checkUser->fetch(PDO::FETCH_ASSOC);
		require './url/PHPMailerAutoload.php';

		$recoverHash = strtoupper(hash("md5", $_POST['recover']['email'] . 'RECOVER!@#HASH' . generatePass(10)));

		$recoveryMail = file_get_contents('./conf/mail_formats/password_recovery_request.html');
		$recoveryMail = str_replace("__CLIENT__", $userInfo['username'], $recoveryMail);
		$recoveryMail = str_replace("__RECOVERURL__", $__MAINDOMAIN__ . 'login.php?recoverHash='. $recoverHash, $recoveryMail);


		$testSiteSubject = ( $testSite ) ? $__TESTSITEPREFIX__ : "";

		$mail = new PHPMailer;
		$mail->isSMTP();
		#$mail->SMTPDebug = 2;
		#$mail->Debugoutput = 'html';
		$mail->Host = $mailHost;
		$mail->Port = $mailPort;
		$mail->SMTPAuth = $mailSMTPAuth;
		$mail->Username = $mailUsername;
		$mail->Password = $mailPassword;
		$mail->setFrom($mailSenderEmail, $mailSenderName);
		$mail->addAddress($userInfo['email']);
		$mail->isHTML(true);
		$mail->Subject = $testSiteSubject . 'Password Recovery';
		$mail->Body = $recoveryMail;
		if ( !$mail->send() ) {
			$error = 'Invalid Email Address';

		} else {
			$createHash = $pdo->prepare("UPDATE `accounts` SET `recover_hash` = :pass WHERE `email` = :email");

			$createHash->execute(array(
				":pass" => $recoverHash,
				":email" => $userInfo['email']
			));
			$error = 'An email with the instruction to reset your password has been sent to your Inbox';
			
		}
	} else {
		$error = "Invalid Email";
	}
}

if ( isset($_GET['recoverHash']) && !empty($_GET['recoverHash']) ) {
	$checkHash = $pdo->prepare("SELECT * FROM `accounts` WHERE `recover_hash` = :hash");
	$checkHash->execute(array(":hash" => $_GET['recoverHash']));

	if ( $checkHash->rowCount() > 0 ) {
		$userInfo = $checkHash->fetch(PDO::FETCH_ASSOC);
		$newPass = generatePass(6);

		require './url/PHPMailerAutoload.php';
		$recoveryMail2 = file_get_contents('./conf/mail_formats/password_recovery.html');
		$recoveryMail2 = str_replace("__CLIENT__", $userInfo['username'], $recoveryMail2);
		$recoveryMail2 = str_replace("__NEWPASS__", $newPass, $recoveryMail2);


		$testSiteSubject = ( $testSite ) ? $__TESTSITEPREFIX__ : "";

		$mail = new PHPMailer;
		$mail->isSMTP();
		#$mail->SMTPDebug = 2;
		#$mail->Debugoutput = 'html';
		$mail->Host = $mailHost;
		$mail->Port = $mailPort;
		$mail->SMTPAuth = $mailSMTPAuth;
		$mail->Username = $mailUsername;
		$mail->Password = $mailPassword;
		$mail->setFrom($mailSenderEmail, $mailSenderName);
		$mail->addAddress($userInfo['email']);
		$mail->isHTML(true);
		$mail->Subject = $testSiteSubject . 'Password Recovery';
		$mail->Body = $recoveryMail2;
		if ( !$mail->send() ) {
			$error = 'Invalid Email Address';
		} else {
			$createHash = $pdo->prepare("UPDATE `accounts` SET `password` = :pass, `recover_hash` = :emptyHash WHERE `email` = :email");

			$createHash->execute(array(
				":pass" => $newPass,
				":emptyHash" => "",
				":email" => $userInfo['email']
			));

			pconsole($newPass);
			$error = 'An email with your new password has been sent to your Inbox';
		}
	} else {
		$error = "Invalid Token";
	}
}

function generatePass($length = 10) {
	$characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
	$charactersLength = strlen($characters);
	$randomString = '';
	for ($i = 0; $i < $length; $i++) {
		$randomString .= $characters[rand(0, $charactersLength - 1)];
	}
	return $randomString;
}
?>
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
								<span class="page-title">Login</span>
							</div>
						</div>
					</div>
				</div>              
				<section class="content">
					<div class="container">
						<div class="row">
							<div id="page-header" class="col-md-24">
								<h1 id="page-title">Login</h1> 
							</div>
							<div id="col-main" class="col-md-24 register-page clearfix">
								<div class="row checkout-form">
									<div class="col-md-12 row-left">
										<!-- Customer Account Login -->
										<div id="customer-login">
											<div class="checkout-title">
												<span class="general-title">Customer Login</span>
											</div>
											<form method="post" id="customer_login" accept-charset="UTF-8">
												<input type="hidden" value="customer_login" name="form_type"><input type="hidden" name="utf8" value="✓">
												<?php if ( !empty($error) ) {
													echo '
														<div class="col-md-21 login-alert">
															<div class="alert alert-danger">
																<button type="button" class="close btooltip" data-toggle="tooltip" data-placement="top" title="" data-dismiss="alert" data-original-title="Close">×</button>
																<div class="errors">
																	<ul>
																		<li style="font-size:15px;">'. $error .'</li>
																	</ul>
																</div>
															</div>
														</div>';
												}
												?>
												<ul id="login-form" class="list-unstyled">
													<li class="clearfix"></li>
													<li id="login_email" class="col-md-21">
													<label class="control-label" for="customer_email">Username <span class="req">*</span></label>
													<input type="text" value="" name="customer[username]" id="customer_email" class="form-control">
													</li>
													<li class="clearfix"></li>
													<li id="login_password" class="col-md-21">
													<label class="control-label" for="customer_password">Password <span class="req">*</span></label>
													<input type="password" value="" name="customer[password]" id="customer_password" class="form-control password">
													</li>
													<li class="col-md-21 unpadding-top">
													<ul class="login-wrapper list-unstyled">
														<li>
														<button class="btn" type="submit">Login</button>
														</li>
														<li>
														<a class="action" href="javascript:;" onclick="$('#recoverMail').modal('toggle');">Forgot your password?</a>
														</li>
														<li>
														or <a class="return" href="./index.php">Return to store</a>
														</li>
													</ul>
													</li>
												</ul>
											</form>
										</div>
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


<div id="recoverMail" class="modal fade" role="dialog" >
  <div class="modal-dialog" >

    <!-- Modal content-->
    <div class="modal-content" style="height: auto;">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Recover Account</h4>
      </div>
      <div class="modal-body">
        <div class="container-fluid">
        <form method="post">
            <ul id="login-form">
				<li class="clearfix"></li>
				<li id="login_email" class="col-md-24">
				<label class="control-label" for="customer_email">Email <span class="req">*</span></label>
				<input type="email" value="" name="recover[email]" id="customer_email" class="form-control">
				</li>
				<li class="clearfix"></li>
				<li style="margin-left: 580px;">
				<button class="btn" type="submit">Recover</button>
				</li>
			</ul>
		</form>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-custom" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>