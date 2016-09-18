<?php
if ( session_status() == PHP_SESSION_NONE ) {
	session_start();
}
include './../conf/config.php';

if ( isset($_GET['addtoFav'])) {
	if ( !$_SESSION['loggedIn'] ) {
		die();
	}
	$getcurrentFavs = $pdo->prepare("SELECT `favorites` FROM `accounts` WHERE `username` = :username");
	$getcurrentFavs->execute(array(":username" => $_USERNAME));

	$result = $getcurrentFavs->fetch(PDO::FETCH_ASSOC);
	$currentFav = $result['favorites'];

	$currentFav .= "," . $_GET['addtoFav'];

	echo $currentFav;

	$updateFav = $pdo->prepare("UPDATE `accounts` SET `favorites` = :favs WHERE `username` = :username");
	$updateFav->execute ( array (":favs" => $currentFav, ":username" => $_USERNAME) );
}

if ( isset($_GET['removeFromFav'])) {
	if ( !$_SESSION['loggedIn'] ) {
		die();
	}
	$getcurrentFavs = $pdo->prepare("SELECT `favorites` FROM `accounts` WHERE `username` = :username");
	$getcurrentFavs->execute(array(":username" => $_USERNAME));

	$result = $getcurrentFavs->fetch(PDO::FETCH_ASSOC);
	$currentFav = $result['favorites'];

	$currentFav = str_replace(',' . $_GET['removeFromFav'], "", $currentFav);

	echo $currentFav;

	$updateFav = $pdo->prepare("UPDATE `accounts` SET `favorites` = :favs WHERE `username` = :username");
	$updateFav->execute ( array (":favs" => $currentFav, ":username" => $_USERNAME) );
}

if ( isset($_GET['subscribe']) ) {
	$email = trim($_GET['subscribe']);

	$checkSub = $pdo->prepare("SELECT * FROM `subscribers` WHERE `email` = :email");
	$checkSub->execute(array(":email" => $email));

	if ( $checkSub->rowCount() > 0 ) {
		echo "You are already subscribed";
	} else {
    	$hash = strtoupper((hash("MD5", $email . "RAND123HASH")));
		$addSub = $pdo->prepare("INSERT INTO `subscribers` (`email`, `hash`) VALUES (:email, :hash)");
		$addSub->execute(array(":email" => $email, ":hash" => $hash));

		require './PHPMailerAutoload.php';

		$mailBody = file_get_contents('./../conf/mail_formats/subscription_email.html');
		$mailBody = str_replace("__UNSUBURL__", $__MAINDOMAIN__ . 'login.php?unsub=' . $hash, $mailBody);
		$mailBody = str_replace("__MAINDOMAIN__", $__MAINDOMAIN__, $mailBody);

		if ( $testSite ) {
			$testSiteSubject = $__TESTSITEPREFIX__;
		} else {
			$testSiteSubject = "";
		}

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
		$mail->addAddress($email);
		$mail->isHTML(true);
		$mail->Subject = $testSiteSubject . 'Subscription';
		$mail->Body = $mailBody;
		if ( !$mail->send() ) {
			echo 'Invalid Email Address';

		} else {
			echo "Thank you for subscribing to Diamant Secret";
		}
	}
}

if ( isset($_GET['verifyUsername']) ) {
	$verifyUsername = $pdo->prepare("SELECT * FROM `accounts` WHERE `username` = :user");
	$verifyUsername->execute(array(":user" => $_GET['verifyUsername']));

	if ( $verifyUsername->rowCount() > 0 ) {
		echo 0;
	} else {
		echo 1;
	}
}

if ( isset($_GET['verifyEmail']) ) {
	$verifyUsername = $pdo->prepare("SELECT * FROM `accounts` WHERE `email` = :user");
	$verifyUsername->execute(array(":user" => $_GET['verifyEmail']));

	if ( $verifyUsername->rowCount() > 0 ) {
		echo 0;
	} else {
		echo 1;
	}
}

if ( isset($_GET['register']) ) {

	//echo json_encode($_POST);
	$alert = "";

	$checkUsername = $pdo->prepare("SELECT * FROM `accounts` WHERE `username` = :user");
	$checkUsername->execute(array(":user" => $_POST['customer']['username']));
	
	$checkEmail = $pdo->prepare("SELECT * FROM `accounts` WHERE `email` = :user");
	$checkEmail->execute(array(":user" => $_POST['customer']['email']));


	if ( $checkUsername->rowCount() > 0 ) {
		$checkUsername = $checkUsername->fetch(PDO::FETCH_ASSOC);

		if ( $checkUsername['activated'] == 0 ) {
			$alert = ' Email with the activation link has already been sent to your Inbox';
		} else {
			$alert = ' Username Already Exists ';
		}
	} else if ( $checkEmail->rowCount() > 0 ) {
		$checkEmail = $checkEmail->fetch(PDO::FETCH_ASSOC);

		if ( $checkEmail['activated'] == 0 ) {
			$alert = ' Email with the activation link has already been sent to your Inbox';
		} else {
			$alert = ' Email Already Registered. Please <a href="./login.php"  style="color: #607D8B;">Login</a> Instead ';
		}
		
	} else {
		require './PHPMailerAutoload.php';


		$email = filter_var(trim($_POST['customer']['email']), FILTER_SANITIZE_EMAIL);
		#$hashPass = strtoupper(hash("whirlpool", $_POST['customer']['password'] . $HASH));
		$hashPass = $_POST['customer']['password'];
		$verifyHash = hash("md5", $email . "VERIFICATIONH1337ASH");

		$mailBody = file_get_contents("./../conf/mail_formats/registration_verification.html");
		$mailBody = str_replace("__CLIENT__", $_POST['customer']['username'], $mailBody);
		$mailBody = str_replace("__VERIFICATIONHASH__", $verifyHash, $mailBody);
		$mailBody = str_replace("__USERNAME__", $_POST['customer']['username'], $mailBody);
		$mailBody = str_replace("__MAINDOMAIN__", $__MAINDOMAIN__, $mailBody);

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
		$mail->addAddress($email);
		$mail->isHTML(true);
		$mail->Subject = $testSiteSubject . 'Activation Account';

		#$mailBody = mailVerify($_POST['customer']['username'], "http://www.diamantsecret.com/register.php?verify=".$verifyHash);
		$mail->Body = $mailBody;
		if ( !$mail->send() ) {
			$alert = "Invalid Email";
		} else {
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
			$alert = 'Registration Successful. Please follow the instructions in your Email to continue';
		}
	}

	echo $alert;
}
?>