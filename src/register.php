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
  	<link rel="icon" href="./images/gfx/favicon.png?v=1" type="image/png" sizes="16x16">
	
	<script src="./assets/javascripts/jquery-1.9.1.min.js" type="text/javascript"></script>
	<script src="./assets/javascripts/bootstrap.min.3x.js" type="text/javascript"></script>
</head>
<?php
if ( session_status() == PHP_SESSION_NONE ) {
	session_start();
}

if ( isset($_SESSION['loggedIn']) && $_SESSION['loggedIn'] ) {
	session_destroy();
	$_SESSION['loggedIn'] = false;
}

include './conf/config.php';

pconsole($_POST);
#pre
$alert = "";

if ( isset($_POST['register']) ) {
	pconsole($_POST);
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
		$alert = 'Verification link has expired';
	}
}

if ( isset($_GET['verifyLogin']) ) {


	$incomingPassword = ( isset($_POST['customer']['password']) ) ? $_POST['customer']['password'] : "";
	$incomingUsername = ( isset($_POST['customer']['username']) ) ? $_POST['customer']['username'] : "";
	$hash = $_GET['verifyLogin'];

	$checkHash = $pdo->prepare("SELECT * FROM `accounts` WHERE `verification_hash` = :hash");
	$checkHash->execute(array(":hash" => $hash));

	if ( $checkHash->rowCount() > 0 ) {
		$accountToActivate = $checkHash->fetch(PDO::FETCH_ASSOC);
		$checkPass = $pdo->prepare("SELECT * FROM `accounts` WHERE `verification_hash` = :hash AND `password` = :pass");
		$checkPass->execute(array(":hash" => $hash, ":pass" => $incomingPassword));

		if ( $checkPass->rowCount() > 0 ) {
			$activate = $pdo->prepare("UPDATE `accounts` SET `activated` = 1, `verification_hash` = :emptyHash WHERE `email` = :email");
			$activate->execute(array(":emptyHash" => "", ":email" => $accountToActivate['email']));

			$_SESSION['username'] = $accountToActivate['username'];
			$_SESSION['email'] = $accountToActivate['email'];
			$_SESSION['loggedIn'] = true;

			header("Location: ./index.php");
		} else {
			$activate = $pdo->prepare("UPDATE `accounts` SET `activated` = 1, `verification_hash` = :emptyHash WHERE `email` = :email");
			$activate->execute(array(":emptyHash" => "", ":email" => $accountToActivate['email']));
			$alert = "Account has been verified";
			$alert2 = "Invalid Login Credentials </li></li> Click here to <a style='color:#607D8B' href='./login.php'>Login</a>";
		}

	} else {
		$checkAuth = $pdo->prepare("SELECT * FROM `accounts` WHERE `username` = :user AND `password` = :pass AND `activated` = 1");
		$checkAuth->execute(array(":user" => $incomingUsername, ":pass" => $incomingPassword));

		if ( $checkAuth->rowCount() > 0 ) {
			$creds = $checkAuth->fetch(PDO::FETCH_ASSOC);

			$_SESSION['username'] = $creds['username'];
			$_SESSION['email'] = $creds['email'];
			$_SESSION['loggedIn'] = true;

			if ( $creds['type'] > 0 ) {
				$_SESSION['admin'] = $creds['type'];
			}

			header("Location: ./index.php");
		} else {
			$alert = "Verification Link has expired";
		}
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
								<a href="./index.php" class="homepage-link" title="Back to the frontpage">Home</a>
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
							if ( !empty($alert2) ) {
								echo '
									<div class="col-md-21 login-alert">
										<div class="alert alert-danger">
											<button type="button" class="close btooltip" data-toggle="tooltip" data-placement="top" title="" data-dismiss="alert" data-original-title="Close">×</button>
											<div class="errors">
												<ul>
													<li>'. $alert2 .'</li>
												</ul>
											</div>
										</div>
									</div>';
							}
							?>
							</div>
							<div id="col-main" class="col-md-12 register-page clearfix">
								<form id="create_customer" accept-charset="UTF-8" method="post">
									<input value="create_customer" name="form_type" type="hidden"><input name="utf8" value="✓" type="hidden">
									<ul id="" class="row list-unstyled">
										<li id="last_namef">
										<label class="control-label" for="username">Username <span class="req">*</span></label>
											<div class="input-group">
												<input name="customer[username]" pattern="[a-zA-Z0-9-+$_^!]{2,32}"  id="username" class="form-control invalid" type="text" style="border-right: none;" required>
												<span class="input-group-addon" id="username_span" style="background: #ffffff; border: solid thin #dedede; border-left: none;"><i id="username_fa" class="fa"></i></span>
											</div>
										</li>
										<li class="clearfix"></li>
										<li id="emailf" class="">
										<label class="control-label" for="email">Email <span class="req">*</span></label>
											<div class="input-group">
												<input name="customer[email]" id="email" class="form-control invalid" type="email" style="border-right: none;"  required>
												<span class="input-group-addon" id="email_span" style="background: #ffffff; border: solid thin #dedede; border-left: none;"><i id="email_fa" class="fa"></i></span>
											</div>
										</li>
										<li class="clearfix"></li>
										<li id="passwordf" class="">
											<label class="control-label" for="password">Password <span class="req">*</span></label>
											<div class="input-group">
												<input value="" name="customer[password]" id="password" pattern=".{6,}" title="Minimum 6 Characters" class="form-control password" type="password" style="border-right: none;" required>
												<span class="input-group-addon" id="password_span" style="background: #ffffff; border: solid thin #dedede; border-left: none;"><i id="password_fa" class="fa"></i></span>
											</div>
										</li>
										<li id="passwordf" class="">
											<label class="control-label" for="password">Confirm Password <span class="req">*</span></label>
											<div class="input-group">
												<input value="" name="customer[confirm_password]" id="password_confirm" pattern=".{6,}" title="Minimum 6 Characters" class="form-control password" type="password" style="border-right: none;" required>
												<span class="input-group-addon" id="password_confirm_span" style="background: #ffffff; border: solid thin #dedede; border-left: none;"><i id="password_confirm_fa" class="fa"></i></span>
											</div>
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
										<input value="" name="customer[phone_number]" id="phone_number" class="form-control" type="text" pattern="[0-9+ ]{0,20}">
										</li>
										<li class="clearfix"></li>
										<li id="passwordf" class="">
										<label class="control-label" for="password">Address</label>
										<input value="" name="customer[address]" id="address" class="form-control" type="text">
										</li>
										<li class="clearfix"></li>
										<li class="unpadding-top action-last">
										<button class="btn" type="submit" name="register" id="submitButton"><span>Create an Account</span><img src="./images/gfx/cube.gif" style="height: 100%; padding: 6px; margin-top: -5px; display:none;" tabindex="1"></button>
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
<script type="text/javascript">

$("#username").keyup(function(event){
	$("#username").focusout();
});

$("#username").focusout(function(event){
	$.ajax({
		url: './url/ajax.php?verifyUsername='+ $("#username").val(),
		type: 'GET',
		success: function(result){
			if ( result == 1 && $("#username").val().length > 1 ) {
				$("#username").removeClass("invalid");
				$("#username").addClass("valid");
				$("#username_fa").removeClass("fa-close");
				$("#username_fa").addClass("fa-check");
				$("#username_span").attr("style", "background: #DCEDC8");
			} else {
				$("#username").addClass("invalid");
				$("#username").removeClass("valid");
				$("#username_fa").removeClass("fa-check");
				$("#username_fa").addClass("fa-close");
				$("#username_span").attr("style", "background: #FFCDD2");
			}
		}
	});
});

$("#email").keyup(function(event){
	$("#email").focusout();
});

$("#email").focusout(function(event){
	$.ajax({
		url: './url/ajax.php?verifyEmail='+ $("#email").val(),
		type: 'GET',
		success: function(result){
			if ( result == 1 
			     && $("#email").val().indexOf("@") > 0 
				 && $("#email").val().indexOf("@") !== ($("#email").val().length - 1)
				 && $("#email").val().lastIndexOf(".") < $("#email").val().length - 1
				 && $("#email").val().lastIndexOf(".") > $("#email").val().indexOf("@")
				 ) {
				$("#email").removeClass("invalid");
				$("#email").addClass("valid");
				$("#email_fa").removeClass("fa-close");
				$("#email_fa").addClass("fa-check");
				$("#email_span").attr("style", "background: #DCEDC8");
			} else {
				$("#email").addClass("invalid");
				$("#email").removeClass("valid");
				$("#email_fa").removeClass("fa-check");
				$("#email_fa").addClass("fa-close");
				$("#email_span").attr("style", "background: #FFCDD2");
			}
		}
	});
});

$("#password").focusout(function(event){
	$("#password").keyup();
});

$("#password").keyup(function(event){
	if ( $("#password").val().length >= 6 ) {
		$("#password").removeClass("invalid");
		$("#password").addClass("valid");
		$("#password_fa").removeClass("fa-close");
		$("#password_fa").addClass("fa-check");
		$("#password_span").attr("style", "background: #DCEDC8");
	} else {
		$("#password").removeClass("valid");
		$("#password").addClass("invalid");
		$("#password_fa").removeClass("fa-check");
		$("#password_fa").addClass("fa-close");
		$("#password_span").attr("style", "background: #FFCDD2");
	}

	$("#password_confirm").keyup();
});

$("#password_confirm").focusout(function(event){
	$("#password").keyup();
});

$("#password_confirm").keyup(function(event){
	if ( $("#password_confirm").val() == $("#password").val() && $("#password_confirm").val().length > 5 ) {
		$("#password_confirm").removeClass("invalid");
		$("#password_confirm").addClass("valid");
		$("#password_confirm_fa").removeClass("fa-close");
		$("#password_confirm_fa").addClass("fa-check");
		$("#password_confirm_span").attr("style", "background: #DCEDC8");
	} else {
		$("#password_confirm").removeClass("valid");
		$("#password_confirm").addClass("invalid");
		$("#password_confirm_fa").removeClass("fa-check");
		$("#password_confirm_fa").addClass("fa-close");
		$("#password_confirm_span").attr("style", "background: #FFCDD2");
	}

});

$("#create_customer").submit(function(event){
	event.preventDefault();

	if ( $("#username").hasClass("valid") ) {
		if ( $("#email").hasClass("valid") ) {
			if ( $("#password").hasClass("valid") ) {
				if ( $("#password").val() == $("#password_confirm").val() ) {
					$.ajax({
						url: './url/ajax.php?register=' + $("#username").val(),
						type: 'POST',
						data: $("#create_customer").serialize(),
						beforeSend: function(){
							$("#submitButton img").show();
							$("#submitButton img").focus();
							$("#submitButton span").text("Registering..");
						},
						success: function(result) {
							console.log(result);
							$("#submitButton img").hide();
							$("#submitButton span").text("Registered");
							$("#notificationBox").html("<span>"+ result +"</span>");
		        			if ( $("#notificationBox").is(":hidden") ) {
					          $("#notificationBox").toggle(500).delay(10000).toggle(500);
					      	}
						}
					});
				} else { 
					$("#notificationBox").html("<span>Please check your passwords</span>");
		        	if ( $("#notificationBox").is(":hidden") ) {
			          $("#notificationBox").toggle(500).delay(10000).toggle(500); 
			      	}
				}

			} else {
		        $("#notificationBox").html("<span>Please check your passwords</span>");
		        if ( $("#notificationBox").is(":hidden") ) {
		          $("#notificationBox").toggle(500).delay(10000).toggle(500); 
		      	}
		      	$("#password").focus();
			}
		} else {
	        $("#notificationBox").html("<span>Invalid Email</span>");
	        if ( $("#notificationBox").is(":hidden") ) {
	          $("#notificationBox").toggle(500).delay(10000).toggle(500); 
	      	}
	      	$("#email").focus();
			// Invalid Email
		}
	} else {
        $("#notificationBox").html("<span>Username not available</span>");
        if ( $("#notificationBox").is(":hidden") ) {
          $("#notificationBox").toggle(500).delay(10000).toggle(500); 
      	}
      	$("#username").focus();
		//Invalid Username
	}

});
</script>