<?php
if ( session_status() == PHP_SESSION_NONE ) {
	session_start();
}

include './../conf/config.php';
require("./../lib/PayPal/vendor/autoload.php");
use PayPal\Api\Payment;

if ( isset($_GET['addtoFav'])) {
	if ( !$_SESSION['loggedIn'] ) {
		die();
	}
	$getcurrentFavs = $pdo->prepare("SELECT `favorites` FROM `accounts` WHERE `username` = :username AND `site_id` = 1");
	$getcurrentFavs->execute(array(":username" => $_USERNAME));

	$result = $getcurrentFavs->fetch(PDO::FETCH_ASSOC);
	$currentFav = $result['favorites'];

	$currentFav .= "," . $_GET['addtoFav'];

	echo $currentFav;

	$updateFav = $pdo->prepare("UPDATE `accounts` SET `favorites` = :favs WHERE `username` = :username AND `site_id` = 1");
	$updateFav->execute ( array (":favs" => $currentFav, ":username" => $_USERNAME) );
}

if ( isset($_GET['removeFromFav'])) {
	if ( !$_SESSION['loggedIn'] ) {
		die();
	}
	$getcurrentFavs = $pdo->prepare("SELECT `favorites` FROM `accounts` WHERE `username` = :username AND `site_id` = 1");
	$getcurrentFavs->execute(array(":username" => $_USERNAME));

	$result = $getcurrentFavs->fetch(PDO::FETCH_ASSOC);
	$currentFav = $result['favorites'];

	$currentFav = str_replace(',' . $_GET['removeFromFav'], "", $currentFav);

	$updateFav = $pdo->prepare("UPDATE `accounts` SET `favorites` = :favs WHERE `username` = :username AND `site_id` = 1");
	$updateFav->execute ( array (":favs" => $currentFav, ":username" => $_USERNAME) );
}

if ( isset($_GET['subscribe']) ) {

	$email = trim($_GET['subscribe']);

	$checkSub = $pdo->prepare("SELECT * FROM `subscribers` WHERE `email` = :email AND `site_id` = 1");
	$checkSub->execute(array(":email" => $email));

	if ( $checkSub->rowCount() > 0 ) {
		echo __("You are already subscribed");
	} else {
    	$hash = strtoupper((hash("MD5", $email . "RAND123HASH")));
		$addSub = $pdo->prepare("INSERT INTO `subscribers` (`email`, `hash`, `site_id`) VALUES (:email, :hash, 1)");
		$addSub->execute(array(":email" => $email, ":hash" => $hash));

		require './PHPMailerAutoload.php';

		$mailBody = file_get_contents('./../conf/mail_formats/subscription_email.html');
		$mailBody = str_replace("Greetings", __("Greetings"), $mailBody);
		$mailBody = str_replace("Thank you for subscribing", __("Thank you for subscribing"), $mailBody);
		$mailBody = str_replace("You have succesfully subscribed to our newsletter", __("You have succesfully subscribed to our newsletter"), $mailBody);
		$mailBody = str_replace("We make sure to only send relevant stuff", __("We make sure to only send relevant stuff"), $mailBody);
		
		$newStr = __("If this was not you, please [linkTagStart]Click Here[linkTagEnd] to unsubscribe to the newsletter");

		$mailBody = str_replace('If this was not you, please <a href="__UNSUBURL__">Click Here</a> to unsubscribe to the newsletter',$newStr, $mailBody);


		$mailBody = str_replace('[linkTagStart]', '<a href="__UNSUBURL__">', $mailBody);
		$mailBody = str_replace('[linkTagEnd]', '</a>', $mailBody);
		
		$mailBody = str_replace("Thanks for choosing Diamant Secret", __("Thanks for choosing Diamant Secret"), $mailBody);
		
		$newStr2 = __("Copyright [copyrightLogo] [Y] Diamant Secret. All Rights Reserved.");
		
		$mailBody = str_replace("Copyright &copy; 2016 Diamant Secret. All Rights Reserved.", $newStr2, $mailBody);
		$mailBody = str_replace("[copyrightLogo]", "&copy;", $mailBody);
		$year = date('Y');
		$mailBody = str_replace("[Y]", $year, $mailBody);
		
		$mailBody = str_replace("__UNSUBURL__", $__MAINDOMAIN__ .$lang.'/'.__("login").'/'. $hash, $mailBody);
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
		$mail->smtpConnect(
		    array(
		        "ssl" => array(
		            "verify_peer" => false,
		            "verify_peer_name" => false,
		            "allow_self_signed" => true
		        )
		    )
		);
		$mail->Subject = $testSiteSubject . ' '.__('Subscription');
		$mail->Body = $mailBody;
		if ( !$mail->send() ) {
			echo __('Invalid Email Address');

		} else {
			echo __("Thank you for subscribing to Diamant Secret");
		}
	}
}

if ( isset($_GET['verifyUsername']) ) {
	$verifyUsername = $pdo->prepare("SELECT * FROM `accounts` WHERE `username` = :user AND `site_id` = 1");
	$verifyUsername->execute(array(":user" => $_GET['verifyUsername']));

	if ( $verifyUsername->rowCount() > 0 ) {
		echo 0;
	} else {
		echo 1;
	}
}

if ( isset($_GET['verifyEmail']) ) {
	$verifyUsername = $pdo->prepare("SELECT * FROM `accounts` WHERE `email` = :user AND `site_id` = 1");
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

	$checkUsername = $pdo->prepare("SELECT * FROM `accounts` WHERE `username` = :user AND `site_id` = 1");
	$checkUsername->execute(array(":user" => $_POST['customer']['username']));
	
	$checkEmail = $pdo->prepare("SELECT * FROM `accounts` WHERE `email` = :user AND `site_id` = 1");
	$checkEmail->execute(array(":user" => $_POST['customer']['email']));


	if ( $checkUsername->rowCount() > 0 ) {
		$checkUsername = $checkUsername->fetch(PDO::FETCH_ASSOC);

		if ( $checkUsername['activated'] == 0 ) {
			$alert = ' '.__('Email with the activation link has already been sent to your Inbox');
		} else {
			$alert = ' '.__('Username Already Exists').' ';
		}
	} else if ( $checkEmail->rowCount() > 0 ) {
		$checkEmail = $checkEmail->fetch(PDO::FETCH_ASSOC);

		if ( $checkEmail['activated'] == 0 ) {
			$alert = ' '.__('Email with the activation link has already been sent to your Inbox');
		} else {

			$alert = __("Email Already Registered. Please [v6] Login [v7] Instead");
			
			$alert = str_replace("[v6]", "<a href='".$__MAINDOMAIN__.$lang."/login.php'  style='color: #607D8B;'>", $alert);
			$alert = str_replace("[v7]", "</a>", $alert);
		}
		
	} else {
		require './PHPMailerAutoload.php';


		$email = filter_var(trim($_POST['customer']['email']), FILTER_SANITIZE_EMAIL);
		#$hashPass = strtoupper(hash("whirlpool", $_POST['customer']['password'] . $HASH));
		$hashPass = $_POST['customer']['password'];
		$verifyHash = hash("md5", $email . "VERIFICATIONH1337ASH");

		$mailBody = file_get_contents("./../conf/mail_formats/registration_verification.html");
		$mailBody = str_replace("Greetings", __("Greetings"), $mailBody);		
		$mailBody = str_replace("Thank you for registering to Diamant Secret", __("Thank you for registering to Diamant Secret"), $mailBody);
		$mailBody = str_replace("To verify your account, click the link below<", __("To verify your account, click the link below<"), $mailBody);
		$mailBody = str_replace("Verify Me", __("Verify Me"), $mailBody);
		$mailBody = str_replace("Alternatively, you can simply login from here.", __("Alternatively, you can simply login from here."), $mailBody);
		$mailBody = str_replace("Password", __("Password"), $mailBody);
		$mailBody = str_replace("Submit", __("Submit"), $mailBody);
		$mailBody = str_replace("Thanks for choosing Diamant Secret", __("Thanks for choosing Diamant Secret"), $mailBody);
		$newStr2 = __("Copyright [copyrightLogo] [Y] Diamant Secret. All Rights Reserved.");
		
		$mailBody = str_replace("Copyright &copy; 2016 Diamant Secret. All Rights Reserved.", $newStr2, $mailBody);
		$mailBody = str_replace("[copyrightLogo]", "&copy;", $mailBody);
		$year = date('Y');
		$mailBody = str_replace("[Y]", $year, $mailBody);

		$mailBody = str_replace("__CLIENT__", $_POST['customer']['username'], $mailBody);
		$mailBody = str_replace("__VERIFICATIONHASH__", $verifyHash, $mailBody);
		$mailBody = str_replace("__USERNAME__", $_POST['customer']['username'], $mailBody);
		$mailBody = str_replace("__MAINDOMAIN__", $__MAINDOMAIN__, $mailBody);

		if(isset($continent) && $continent=='EU'){
			$mailBody = str_replace("__LANG__", 'fr/', $mailBody);
		} else if(isset($continent) && $continent!=''){
			$mailBody = str_replace("__LANG__", 'en/', $mailBody);
		} else {
			$mailBody = str_replace("__LANG__", $lang.'/', $mailBody);	
		}
		

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
		$mail->smtpConnect(
		    array(
		        "ssl" => array(
		            "verify_peer" => false,
		            "verify_peer_name" => false,
		            "allow_self_signed" => true
		        )
		    )
		);
		$mail->Subject = $testSiteSubject . ' '.__('Activation Account');

		#$mailBody = mailVerify($_POST['customer']['username'], "http://www.diamantsecret.com/register.php?verify=".$verifyHash);
		$mail->Body = $mailBody;
		if ( !$mail->send() ) {
			$alert = __("Invalid Email");
		} else {
			$createUser = $pdo->prepare("INSERT INTO `accounts` (`username`, `email`, `password`, `first_name`, `last_name`, `mobileno`, `address`, `type`, `activated`, `verification_hash`, `site_id`) VALUES (:user, :email, :password, :first_name, :last_name, :phone_number, :address, 0, 0, :hash, 1)");

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
			$alert = __("Registration Successful. Please follow the instructions in your Email to continue");
		}
	}

	echo $alert;
}

if ( isset($_GET['paymentInfo']) ) {

    $paymentInfo = $pdo->prepare("SELECT * FROM tb_paypal_payments WHERE `invoice_number` = :invoice");
    $paymentInfo->execute(array(":invoice" => $_GET['paymentInfo']));

    if ( $paymentInfo->rowCount() > 0 ) {
        $paymentInfo = $paymentInfo->fetch(PDO::FETCH_ASSOC);

		$paymentId = $paymentInfo['id'];
        try {
            $apiContext = new \PayPal\Rest\ApiContext(
              new \PayPal\Auth\OAuthTokenCredential(
                PAYPAL_CLIENT_ID,
                PAYPAL_CLIENT_SECRET
              )
			);
			$payment = Payment::get($paymentId, $apiContext);

            $status = '<label class="label label-danger" style="font-size: 14px;" >'.__("Unknown").'</label>';

              switch ( $paymentInfo['state'] ) {
                case 'approved': {
                  $status = '<label class="label label-success" style="font-size: 14px;" >'.__("Approved").'</label>';
                  break;
                } case 'opened': {
                  $status = '<label class="label label-warning" style="font-size: 14px;" >'.__("Opening").'</label>';
                  break;
                }
              }

            $result = '<div class="row wrap-table">';
            $result .= '<h5>'.__("Order Info").'</h5>';
            $result .= '<table class="col-sm-24" style="margin-bottom: 15px;">';
            $result .= '<thead>';
            $result .= '<th>'.__("Amount").'</th>';
            $result .= '<th>'.__("State").'</th>';
            $result .= '<th>'.__("Invoice").'</th>';
            $result .= '<th>'.__("Created On").'</th>';
            $result .= '<th>'.__("Updated On").'</th>';
            $result .= '<th>'.__("Address").'</th>';
            $result .= '</thead>';
            $result .= '<tbody>';
            $result .= '<tr>';
            $result .= '<td>&euro; '. number_format($paymentInfo['amount'], 2) .'</td>';
            $result .= '<td>'. $status .'</td>';
            $result .= '<td>'. $paymentInfo['invoice_number'] .'</td>';
            $result .= '<td>'. date(DATETIME_FORMAT, strtotime($paymentInfo['create_time'])) .'</td>';
            if ( strtotime($paymentInfo['update_time']) == 0 ) {
                $result .= '<td>-</td>';
            } else {
                $result .= '<td>'. date(DATETIME_FORMAT, strtotime($paymentInfo['update_time'])) .'</td>';
            }
            $result .= '<td class="text-left"><small>'.__("Billing").'</small></br>'. $paymentInfo['billing_address'] .'<br/><small>'.__("Shipping").'</small></br>'. $paymentInfo['shipping_address'] .'</td>';
            $result .= '</tr>';
            $result .= '</tbody>';
            $result .= '</table>';
            $result .= '<br />';
            $result .= '<h5>'.__("Cart").'</h5>';
            $result .= '<table class="table-hover">';
            $result .= '<thead>';
            $result .= '<th>'.__("Name").'</th>';
            $result .= '<th>'.__("Price").'</th>';
            $result .= '<th>'.__("Quantity").'</th>';
            $result .= '<th></th>';
            $result .= '</thead>';
            $result .= '<tbody>';

            foreach ( $payment->transactions[0]->item_list->items as $cartItem ) {
            	$p_unique_key = $cartItem->sku;
            	$itemInfo = $pdo->prepare("SELECT category FROM items WHERE `unique_key` = :unique_key");
    			$itemInfo->execute(array(":unique_key" => $p_unique_key));
    			 $result .= '<tr>';
	             $result .= '<td>'. $cartItem->name .'</td>';
	             $result .= '<td>&euro; '. number_format($cartItem->price, 2) .'</td>';
	             $result .= '<td>'. $cartItem->quantity .'</td>';

	             $p_url = '';
    			if ( $itemInfo->rowCount() > 0 ) {
    				
        			$itemInfo = $itemInfo->fetch(PDO::FETCH_ASSOC);
        			if(isset($itemInfo['category']) && (int)$itemInfo['category'] >0 ){
        				$urlSubcategory = 0;
        				$total_carat_weight = 0;
        				$p_gold_quality = 0;
        				$p_material = '';
        				$p_product_name = '';

        				if((int)$itemInfo['category'] == 1) {
        					
        					$ringPro = $pdo->prepare("SELECT ring_subcategory,total_carat_weight,gold_quality,material,product_name FROM rings WHERE `unique_key` = :unique_key");
    						$ringPro->execute(array(":unique_key" => $p_unique_key));
        					
        				} else if((int)$itemInfo['category'] == 2) {
        					
        					$ringPro = $pdo->prepare("SELECT ring_subcategory,total_carat_weight,gold_quality,material,product_name FROM earrings WHERE `unique_key` = :unique_key");
    						$ringPro->execute(array(":unique_key" => $p_unique_key));

    						
        				
        					
        				} else if((int)$itemInfo['category'] == 3) {
        					
        					$ringPro = $pdo->prepare("SELECT ring_subcategory,total_carat_weight,gold_quality,material,product_name FROM pendants WHERE `unique_key` = :unique_key");
    						$ringPro->execute(array(":unique_key" => $p_unique_key));

    					} else if((int)$itemInfo['category'] == 4) {
        					
        					$ringPro = $pdo->prepare("SELECT ring_subcategory,total_carat_weight,gold_quality,material,product_name FROM necklaces WHERE `unique_key` = :unique_key");
    						$ringPro->execute(array(":unique_key" => $p_unique_key));   						
        				} else if((int)$itemInfo['category'] == 5) {
        					
        					$ringPro = $pdo->prepare("SELECT ring_subcategory,total_carat_weight,gold_quality,material,product_name FROM bracelets WHERE `unique_key` = :unique_key");
    						$ringPro->execute(array(":unique_key" => $p_unique_key));
        					
        				}

        				if ($ringPro->rowCount() > 0 ) {
    							
			        			$ringPro = $ringPro->fetch(PDO::FETCH_ASSOC);

			        			if(isset($ringPro['ring_subcategory'])) {
			        				$urlSubcategory = $ringPro['ring_subcategory'];
			        			}
			        			if(isset($ringPro['total_carat_weight'])) {
			        				$total_carat_weight = $ringPro['total_carat_weight'];
			        			}
			        			if(isset($ringPro['gold_quality'])) {
			        				$p_gold_quality = $ringPro['gold_quality'];
			        			}
			        			if(isset($ringPro['material'])) {
			        				$p_material = $ringPro['material'];
			        			}
			        			if(isset($ringPro['product_name'])) {
			        				$p_product_name = $ringPro['product_name'];
			        			}
			        			
			        			 $result .= '<td><a class="btn btn-info" href="'.makeProductDetailPageUrl($urlSubcategory,$total_carat_weight,$p_gold_quality,$p_material,$p_product_name,$p_unique_key) .'" target="_blank">'.__("View").'</a></td>';
			        		} else {
			        			
			        			$result .= '<td>&nbsp;</td>';
			        		}

        			} else {
        				$result .= '<td>&nbsp;</td>';	
        			}
        				               
	               
            	} else {
            		$result .= '<td>&nbsp;</td>';
            	}
            	$result .= '</tr>';
            } 

            $result .= '</tbody>';
            $result .= '</table>';
            $result .= '</div>';

            echo $result;
        } catch (Exception $ex) {
            echo '<div class="alert alert-danger">'.__("An Error Occured").'</div>';
        }

    }

}
?>