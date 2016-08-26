<!DOCTYPE html>
<html lang="en">
<head>
  <title>Bootstrap Example</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="css/bootstrap.min.css">
  <link rel="stylesheet" href="css/site.css">
  <link rel="stylesheet" href="css/owl.carousel.css">
  <link rel="stylesheet" href="css/owl.theme.css">
  <style>
    /* Remove the navbar's default rounded borders and increase the bottom margin */
    .navbar {
      margin-bottom: 50px;
      border-radius: 0;
    }
    
    /* Remove the jumbotron's default bottom margin */
     .jumbotron {
      margin-bottom: 0;
    }
   
    /* Add a gray background color and some padding to the footer */
    footer {
      background-color: #e9e9e9;
      padding: 25px;
    }
	.affix {
      top: 0;
      width: 100%;
  }

  .affix + #homeContainer {
      padding-top: 52px;
  }
  </style>
</head>
<?php 
if ( session_status() == PHP_SESSION_NONE ) {
	session_start();
	if ( !isset($_SESSION["loggedIn"]) ) {
		$_SESSION["loggedIn"] = false;
	}
	
	if ( isset($_POST['logout']) ) {
		unset($_SESSION);
		session_destroy();
	}
}
?>
<body>

<div class="jumbotron" style="background:none;">
  <div class="container text-center">
    <img src="http://www.arhaandiam.com/images/Arhaan_Small_logo.png">
  </div>
</div>

<nav class="navbar navbar-inverse" data-spy="affix" data-offset-top="147" style="z-index:2">
  <div class="container-fluid">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="#"></a>
    </div>
    <div class="collapse navbar-collapse" id="myNavbar">
      <ul class="nav navbar-nav">
        <li class="active"><a href="#">Home</a></li>
        <li><a href="#">Products</a></li>
        <li><a href="#">Deals</a></li>
        <li><a href="#">Stores</a></li>
        <li><a href="#">Contact</a></li>
      </ul>
      <ul class="nav navbar-nav navbar-right">
      	<?php 
		include 'url/require.php';
		
			if ( isset($_SESSION["loggedIn"]) && $_SESSION["loggedIn"] ) {
				echo '
				<li><a class="dropdown-hover" href="#">Hi, '. $_SESSION['Username'] .'</a>
					  <ul class="dropdown-content" aria-labelledby="dropdownMenu1" style="list-style-type:none; padding:0;">
						<li><a href="#">Account</a></li>
						<li><a href="#">Settings</a></li>
						<li><form method="post"><button class="btn-logout" type="submit" name="logout" value="logout">Logout</button></form></li>
					  </ul>
				</li>';
			}
			else {
				echo '<li><a href="url/login.php">Login</a></li>';
			}
			if ( isset($_SESSION["loggedIn"]) && $_SESSION["loggedIn"] ) {
				echo '<li><a href="#">Favorites</a></li>';
			}
			else {
				echo '<li><a href="url/login.php#signup">Sign up</a></li>';
			}
			
			if ( isset($_SESSION['Admin']) ) {
				if ( $_SESSION['Admin'] > 0 ) {
					echo '<li><a href="admin/login.php">Admin</a></li>';
				}
			}
		?>
      </ul>
    </div>
  </div>
</nav>
<!--
<div class="container" id="homeContainer">
<h3 style="padding-top:25px;">Featured Deals</h3>
  <div class="row" style="background:#f2f2f2">
    <div class="col-sm-3">
      <div class="panel panel-display">
        <div class="panel-heading">Jewel Title</div>
        <div class="panel-body"><img src="http://placehold.it/150x150?text=IMAGE" class="img-responsive" style="width:100%" alt="Image"></div>
        <div class="panel-footer">
        	<div class="sm-12" style="overflow:hidden;">
                <span>$99.99</span>
                <a class="btn btn-custom" style="float:right;">INFO</a>
            </div>
        </div>
</div><br>      </div>
    </div>

</div><br><br> -->

<div id="homeContainer">
<?php
$fetchFeatured = $pdo->prepare("SELECT * FROM `items` WHERE `featured` = :feat");
$fetchFeatured->execute(array(":feat" => 1));

$fetchPendants = $pdo->prepare("SELECT * FROM `items` WHERE `category` = :cat");
$fetchPendants->execute(array(":cat" => 1));

if ( $fetchFeatured->rowCount() > 0 ) {
	createSlider($fetchFeatured->fetchAll(), "Featured Deals");
}

function createSlider($sliderItems, $heading) { ?>
    <h3 style="padding-top:25px; padding-left:5vw;"><?php echo $heading; ?> 
        <div style="float:right; margin-right:25px;">
            <a class=" nav-buttons glyphicon glyphicon-arrow-left" aria-hidden="true" onClick="owl.prev()"></a>
            <a class=" nav-buttons glyphicon glyphicon-arrow-right" aria-hidden="true" onClick="owl.next()"></a>
        </div>
    </h3>
    <div id="owl-carousel" class="owl-carousel owl-theme" style="background:#e9e9e9; border-top: solid thin #ddd; border-bottom: solid thin #ddd;">
    <?php
	foreach ( $sliderItems as $item ) {
		if ( $item['discount'] > 0 ) {
			$value = $item['item_value'] -  (($item['discount'] / 100 ) * $item['item_value']);
			$price =  '<div style="float:left">
					  <span class="old-price">€'. $item['item_value'] .'</span><br>
					  <span class="discounted-price">€'. round($value, 2) .'</span>
				  </div><br>';
		} else {
			$price = '<div style="float:left">
					  <span class="discounted-price">€'. $item['item_value'] .'</span>
				  </div><br>';
		}
		$itemImages = explode("|", $item['image']);
		$thumb = $itemImages[0];
		echo '
		  <div class="item">
			<div class="">
			  <div class="panel panel-display">
				<div class="panel-heading">'. $item['item_name'] .'</div>
				<div class="panel-body" style="position:relative;"><img src="images/thumbnails/'. $thumb .'" class="img-responsive" alt="Image"></div>
				<div class="panel-footer">
					<div class="sm-12" style="overflow:hidden;">
						'. $price .'
						<a class="btn btn-custom" style="float:right;">INFO</a>
					</div>
				</div>
			  </div>
			</div>
		  </div>';
	}
?></div><?php 
}
?>
<br>
</div>

<div class="container well">
<h4>Debug</h4>
	<?php echo var_dump($_SESSION);
	 echo var_dump($_POST); 
	 ?>
</div>

<footer class="container-fluid text-center">
  <p>Online Store Copyright</p>
  <form class="form-inline">Get deals:
    <input type="email" class="form-control" size="50" placeholder="Email Address">
    <button type="button" class="btn btn-danger">Sign Up</button>
  </form>
</footer>

</body>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/owl.carousel.min.js"></script>
<script>
$(document).ready(function() {
 
  $(".owl-carousel").owlCarousel({
    itemsCustom : [
        [0, 3],
        [450, 3],
        [600, 4],
        [700, 5],
        [1000, 6],
        [1200, 6],
        [1400, 6],
        [1600, 6]
      ],
    lazyLoad : true,
	autoPlay : true,
	scrollPerPage : true,
	stopOnHover : true,
  }); 
 
});

$(".owl-carousel").owlCarousel()
var owl = $(".owl-carousel").data('owlCarousel');
	
function showRegForm() {
	$("#registerModal").modal("toggle");
}
</script>

</html>