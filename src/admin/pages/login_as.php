<?php
if ( session_status() == PHP_SESSION_NONE ) {
	session_start();
}
if ( isset($_POST['loginAs']) ) {
	$_SESSION['loginAs'] = $_POST['loginAs'];
	header("Location: ../../index.php");
	exit();
} else {
	#404
}
?>