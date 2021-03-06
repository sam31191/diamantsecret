<?php
ob_start();
if ( session_status() == PHP_SESSION_NONE ) {
    session_start();
}
include 'conf/config.php';
if ( isset($_POST['login']['username']) ) {
    $checkUser = $pdo->prepare("SELECT `username`, `activated` FROM `accounts` WHERE `username` = :user AND `site_id` = 1");
    $checkUser->execute(array(":user" => $_POST['login']['username']));

    if ( $checkUser->rowCount() > 0 ) {
        //echo var_dump("User Exist");
        $userData = $checkUser->fetch(PDO::FETCH_ASSOC);
        if ( $userData['activated'] == 1 ) {
            $authenticate = $pdo->prepare("SELECT * FROM `accounts` WHERE `username` = :user AND BINARY `password` = :pass AND `site_id` = 1");
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
                $_SESSION['_ref'] = 'diamant_secret';
                $_SESSION['user_id'] = $result['id'];

                if ( $result['type'] > 0 ) {
                    $_SESSION['admin'] = $result['type'];
                }


                /* Merging Cookie Cart with current */
                if ( isset($_COOKIE[COOKIE_CART]) ) {
                    $cartItems = explode(",", $_COOKIE[COOKIE_CART]);

                    foreach ( $cartItems as $item ) {
                        $itemInfo = parseCartItem($item);

                        if ( $itemInfo ) {
                            addToCart($pdo, $itemInfo['ID'], $itemInfo['SIZE'], $itemInfo['QUANTITY']);
                        }
                    }

                    setcookie(COOKIE_CART, "", time() - 3600, "/");
                }

                if ( isset($_POST['redir']) ) {
                    
                    header("Location: ". $_POST['redir']); 
                } else {
                    header("Location: $__MAINDOMAIN__$lang");
                }

                exit();
            } else {
                $error = __("Authentication Failed") ." / ". __("Check your credentials");
            }
        } else {
            $error = __("Account is not activated. Please check your Email to activation instructions.");
        }
    } else {
        $error = __("No User Found");
    }
} else if ( isset($_POST['form_type']) ) {
    $checkUser = $pdo->prepare("SELECT `username`, `activated` FROM `accounts` WHERE `username` = :user AND `site_id` = 1");
    $checkUser->execute(array(":user" => $_POST['customer']['username']));

    if ( $checkUser->rowCount() > 0 ) {
        //echo var_dump("User Exist");
        $userData = $checkUser->fetch(PDO::FETCH_ASSOC);
        if ( $userData['activated'] == 1 ) {
            $authenticate = $pdo->prepare("SELECT * FROM `accounts` WHERE `username` = :user AND BINARY `password` = :pass AND `site_id` = 1");
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
                $_SESSION['_ref'] = 'diamant_secret';
                $_SESSION['user_id'] = $result['id'];
                if ( $result['type'] > 0 ) {
                    $_SESSION['admin'] = $result['type'];
                }

                header("Location:$__MAINDOMAIN__$lang");
                exit();
            } else {
                $error = __("Authentication Failed") ." / ". __("Check your credentials");
            }
        } else {
            $error = __("Account is not activated. Please check your Email to activation instructions.");
        }
    } else {
        $error = __("No User Found");
    }
}
?>
<!doctype html>
<!--[if IE 8 ]>    <html lang="en" class="no-js ie8"> <![endif]-->
<!--[if (gt IE 9)|!(IE)]><!--> <html lang="en" class="no-js"> <!--<![endif]-->
<head>
  <meta charset="UTF-8">
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1" />
  <link rel="canonical" href="/" />
  <meta name="description" content="" />
  <title><?php echo __("Login Page"); ?></title>
  
    <link href="<?php echo $__MAINDOMAIN__;?>assets/stylesheets/font.css" rel='stylesheet' type='text/css'>
  
    <link href="<?php echo $__MAINDOMAIN__;?>assets/stylesheets/font-awesome.min.css" rel="stylesheet" type="text/css" media="all">    
    <link href="<?php echo $__MAINDOMAIN__;?>assets/stylesheets/bootstrap.min.3x.css" rel="stylesheet" type="text/css" media="all">
    <link href="<?php echo $__MAINDOMAIN__;?>assets/stylesheets/cs.bootstrap.3x.css" rel="stylesheet" type="text/css" media="all">
    <link href="<?php echo $__MAINDOMAIN__;?>assets/stylesheets/cs.animate.css" rel="stylesheet" type="text/css" media="all">
    <link href="<?php echo $__MAINDOMAIN__;?>assets/stylesheets/cs.global.css" rel="stylesheet" type="text/css" media="all">
    <link href="<?php echo $__MAINDOMAIN__;?>assets/stylesheets/cs.style.css" rel="stylesheet" type="text/css" media="all">
    <link href="<?php echo $__MAINDOMAIN__;?>assets/stylesheets/cs.media.3x.css" rel="stylesheet" type="text/css" media="all">
    <link href="<?php echo $__MAINDOMAIN__;?>assets/stylesheets/site.css" rel="stylesheet" type="text/css" media="all">
    <link rel="icon" href="<?php echo $__MAINDOMAIN__;?>images/gfx/favicon.png?v=1" type="image/png" sizes="16x16">
    
    <script src="<?php echo $__MAINDOMAIN__;?>assets/javascripts/jquery-1.9.1.min.js" type="text/javascript"></script>
    <script src="<?php echo $__MAINDOMAIN__;?>assets/javascripts/bootstrap.min.3x.js" type="text/javascript"></script>
</head>

<body itemscope="" itemtype="http://schema.org/WebPage" class="templateCustomersRegister notouch">
  
<?php
if ( isset($_SESSION['loggedIn']) && $_SESSION['loggedIn'] ) {
    session_destroy();
    $_SESSION['loggedIn'] = false;
}

if ( isset($_GET['unsub']) ) {
    //echo var_dump($_GET);

    $checkSub = $pdo->prepare("SELECT * FROM `subscribers` WHERE `hash` = :hash AND `site_id` = 1");
    $checkSub->execute(array(":hash" => $_GET['unsub']));
    if ( $checkSub->rowCount() > 0 ) {
        $unsub = $pdo->prepare("DELETE FROM `subscribers` WHERE `hash` = :hash AND `site_id` = 1");
        $unsub->execute(array(":hash" => $_GET['unsub']));

        $error = __("You have unsubscribed from our newsletter");
    }
}

if ( isset($_POST['recover']) ) {
    $checkUser = $pdo->prepare("SELECT * FROM `accounts` WHERE `email` = :email AND `site_id` = 1");
    $checkUser->execute(array(":email" => trim($_POST['recover']['email'])));

    if ( $checkUser->rowCount() > 0 ) {
        $userInfo = $checkUser->fetch(PDO::FETCH_ASSOC);
        require './url/PHPMailerAutoload.php';

        $recoverHash = strtoupper(hash("md5", $_POST['recover']['email'] . 'RECOVER!@#HASH' . generatePass(10)));

        $recoveryMail = file_get_contents('./conf/mail_formats/password_recovery_request.html');
        $recoveryMail = str_replace("Greetings", __("Greetings"), $recoveryMail);        
        $recoveryMail = str_replace("Password Reset", __("Password Reset"), $recoveryMail);
        $recoveryMail = str_replace("Click the following link to reset your password", __("Click the following link to reset your password"), $recoveryMail);
        $recoveryMail = str_replace("Reset my password", __("Reset my password"), $recoveryMail);
        $recoveryMail = str_replace("Thanks for choosing Diamant Secret", __("Thanks for choosing Diamant Secret"), $recoveryMail);
        $newStr2 = __("Copyright [copyrightLogo] [Y] Diamant Secret. All Rights Reserved.");
        $recoveryMail = str_replace("Copyright &copy; 2016 Diamant Secret. All Rights Reserved.", $newStr2, $recoveryMail);
        $recoveryMail = str_replace("[copyrightLogo]", "&copy;", $recoveryMail);
        $year = date('Y');
        $recoveryMail = str_replace("[Y]", $year, $recoveryMail); 
        $recoveryMail = str_replace("__CLIENT__", $userInfo['username'], $recoveryMail);
        $recoveryMail = str_replace("__RECOVERURL__", $__MAINDOMAIN__ .$_REQUEST['lang'].'/login?recoverHash='. $recoverHash, $recoveryMail);
        $recoveryMail = str_replace("__MAINDOMAIN__", $__MAINDOMAIN__, $recoveryMail);


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
        $mail->smtpConnect(
            array(
                "ssl" => array(
                    "verify_peer" => false,
                    "verify_peer_name" => false,
                    "allow_self_signed" => true
                )
            )
        );
        $mail->Subject = $testSiteSubject . __('Password Recovery');
        $mail->Body = $recoveryMail;
        if ( !$mail->send() ) {
            $error = __('Invalid Email Address');

        } else {
            $createHash = $pdo->prepare("UPDATE `accounts` SET `recover_hash` = :pass WHERE `email` = :email AND `site_id` = 1");

            $createHash->execute(array(
                ":pass" => $recoverHash,
                ":email" => $userInfo['email']
            ));
            $error = __('An email with the instruction to reset your password has been sent to your Inbox');
            
        }
    } else {
        $error = __("Invalid Email");
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
        $recoveryMail2 = str_replace("Greetings", __("Greetings"), $recoveryMail2);
        $recoveryMail2 = str_replace("Your password has been reset", __("Your password has been reset"), $recoveryMail2);
        $recoveryMail2 = str_replace("As you requested, we have reset your password.", __("As you requested, we have reset your password."), $recoveryMail2);
        $recoveryMail2 = str_replace("Your new Password", __("Your new Password"), $recoveryMail2);
        $recoveryMail2 = str_replace("Login Now", __("Login Now"), $recoveryMail2);
        $recoveryMail2 = str_replace("We recommend you change your password as soon as possible", __("We recommend you change your password as soon as possible"), $recoveryMail2);
        $recoveryMail2 = str_replace("Thanks for choosing Diamant Secret", __("Thanks for choosing Diamant Secret"), $recoveryMail2);
        $newStr2 = __("Copyright [copyrightLogo] [Y] Diamant Secret. All Rights Reserved.");
        $recoveryMail2 = str_replace("Copyright &copy; 2016 Diamant Secret. All Rights Reserved.", $newStr2, $recoveryMail2);
        $recoveryMail2 = str_replace("[copyrightLogo]", "&copy;", $recoveryMail2);
        $year = date('Y');
        $recoveryMail2 = str_replace("[Y]", $year, $recoveryMail2);
        $recoveryMail2 = str_replace("__CLIENT__", $userInfo['username'], $recoveryMail2);
        $recoveryMail2 = str_replace("__NEWPASS__", $newPass, $recoveryMail2);
        $recoveryMail2 = str_replace("__MAINDOMAIN__", $__MAINDOMAIN__, $recoveryMail2);

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
        $mail->smtpConnect(
            array(
                "ssl" => array(
                    "verify_peer" => false,
                    "verify_peer_name" => false,
                    "allow_self_signed" => true
                )
            )
        );
        $mail->Subject = $testSiteSubject . __('Password Recovery');
        $mail->Body = $recoveryMail2;
        if ( !$mail->send() ) {
            $error = __('Invalid Email Address');
        } else {
            $createHash = $pdo->prepare("UPDATE `accounts` SET `password` = :pass, `recover_hash` = :emptyHash WHERE `email` = :email AND `site_id` = 1");

            $createHash->execute(array(
                ":pass" => $newPass,
                ":emptyHash" => "",
                ":email" => $userInfo['email']
            ));

            pconsole($newPass);
            $error = __('An email with your new password has been sent to your Inbox');
        }
    } else {
        $error = __("Invalid Token");
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
<?php 
    include './url/header.php'; 
    
    $link = '';
    if(isset($_GET['lang'])){
        if($_GET['lang']=='fr'){
            $link = 'login';
        }else{
            $link = 'se-connecter';
        }
    }
?>
    <input type="hidden" name="changeURL" id="changeURL" value="<?php echo $link; ?>"> 
    <div id="content-wrapper-parent">
        <div id="content-wrapper">  
            <!-- Content -->
            <div id="content" class="clearfix">        
                <div id="breadcrumb" class="breadcrumb">
                    <div itemprop="breadcrumb" class="container">
                        <div class="row">
                            <div class="col-md-24">
                                <a href="<?php echo $__MAINDOMAIN__.$lang.'/'; ?>" class="homepage-link" title="<?php echo __("Back to the frontpage"); ?>"><?php echo ucfirst(__("home")); ?></a>
                                <span>/</span>
                                <span class="page-title"><?php echo __("Login"); ?></span>
                            </div>
                        </div>
                    </div>
                </div>              
                <section class="content">
                    <div class="container">
                        <div class="row">
                            <div id="page-header" class="col-md-24">
                                <h1 id="page-title"><?php echo __("Login"); ?></h1> 
                            </div>
                            <div id="col-main" class="col-md-24 register-page clearfix">
                                <div class="row checkout-form">
                                    <div class="col-md-12 row-left">
                                        <!-- Customer Account Login -->
                                        <div id="customer-login">
                                            <div class="checkout-title">
                                                <span class="general-title"><?php echo __("Customer Login"); ?></span>
                                            </div>
                                            <form action="<?php echo $__MAINDOMAIN__.$lang.'/'.__('login')?>" method="post" id="customer_login" accept-charset="UTF-8">
                                                <input type="hidden" value="customer_login" name="form_type"><input type="hidden" name="utf8" value="✓">
                                                <?php if ( !empty($error) ) {
                                                    echo '
                                                        <div class="col-md-21 login-alert">
                                                            <div class="alert alert-danger">
                                                                <button type="button" class="close btooltip" data-toggle="tooltip" data-placement="top" title="" data-dismiss="alert" data-original-title="'.__("Close").'">×</button>
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
                                                    <label class="control-label" for="customer_email"><?php echo __("Username"); ?> <span class="req">*</span></label>
                                                    <input type="text" value="" name="customer[username]" id="customer_email" class="form-control">
                                                    </li>
                                                    <li class="clearfix"></li>
                                                    <li id="login_password" class="col-md-21">
                                                    <label class="control-label" for="customer_password"><?php echo __("Password"); ?> <span class="req">*</span></label>
                                                    <input type="password" value="" name="customer[password]" id="customer_password" class="form-control password">
                                                    </li>
                                                    <li class="col-md-21 unpadding-top">
                                                    <ul class="login-wrapper list-unstyled">
                                                        <li>
                                                        <button class="btn" type="submit"><?php echo __("Login"); ?></button>
                                                        </li>
                                                        <li>
                                                        <a class="action" href="javascript:;" onclick="$('#recoverMail').modal('toggle');"><?php echo __("Forgot your password"); ?>?</a>
                                                        </li>
                                                        <li>
                                                        <?php echo __("or"); ?> <a class="return" href="<?php echo $__MAINDOMAIN__.$lang.'/'?>"><?php echo __("Return to store"); ?></a>
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
        <h4 class="modal-title"><?php echo __("Recover Account"); ?></h4>
      </div>
      <div class="modal-body">
        <div class="container-fluid">
        <form method="post" action="<?php echo $__MAINDOMAIN__.$lang.'/'.__('login') ?>">
            <ul id="login-form">
                <li class="clearfix"></li>
                <li id="login_email" class="col-md-24">
                <label class="control-label" for="customer_email"><?php echo __("Email"); ?> <span class="req">*</span></label>
                <input type="email" value="" name="recover[email]" id="customer_email" class="form-control">
                </li>
                <li class="clearfix"></li>
                <li style="margin-left: 580px;">
                <button class="btn" type="submit"><?php echo __("Recover"); ?></button>
                </li>
            </ul>
        </form>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-custom" data-dismiss="modal"><?php echo __("Close"); ?></button>
      </div>
    </div>
  </div>
</div>
