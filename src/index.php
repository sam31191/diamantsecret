<!DOCTYPE html>
<html lang="en">
<head>
  <title>Home</title>
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
    header ("Location: index.php");
	}
}
?>
<body>

<div class="jumbotron" style="background:none;">
  <div class="container text-center">
    <img src="images/gfx/Arhaan_Small_logo.png">
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
				echo '<li><a href="url/favorites.php">Favorites</a></li>';
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

<div id="homeContainer">
<?php

$favs = "";
if ( isset($_SESSION['loggedIn']) && $_SESSION['loggedIn'] ) {
  $fetchFavorites = $pdo->prepare("SELECT `favorites` FROM `accounts` WHERE `username` = :username");
  $fetchFavorites->execute(array(":username" => $_SESSION['Username']));
  $favs = $fetchFavorites->fetch(PDO::FETCH_ASSOC);
  $favs = $favs['favorites'];
}

//echo var_dump($favs);

$fetchFeatured = $pdo->prepare("SELECT * FROM `items` WHERE `featured` = :feat");
$fetchFeatured->execute(array(":feat" => 1));
if ( $fetchFeatured->rowCount() > 0 ) {
	createSlider($fetchFeatured->fetchAll(), "Featured Deals", $favs, true);
}

$fetchPendants = $pdo->prepare("SELECT * FROM `items` WHERE `category` = :cat");
$fetchPendants->execute(array(":cat" => 2));
if ( $fetchPendants->rowCount() > 0 ) {
	createSlider($fetchPendants->fetchAll(), "Pendants", $favs);
}

$fetchRings = $pdo->prepare("SELECT * FROM `items` WHERE `category` = :cat");
$fetchRings->execute(array(":cat" => 4));
if ( $fetchRings->rowCount() > 0 ) {
	createSlider($fetchRings->fetchAll(), "Rings", $favs);
}

$fetchBracelets = $pdo->prepare("SELECT * FROM `items` WHERE `category` = :cat");
$fetchBracelets->execute(array(":cat" => 3));
if ( $fetchBracelets->rowCount() > 0 ) {
	createSlider($fetchBracelets->fetchAll(), "Bracelets", $favs);
}

function createSlider($sliderItems, $heading, $favs, $featured = false) { ?>
    <h3 style="padding-top:25px; padding-left:5vw;"><?php echo $heading; ?> 
        <div style="float:right; margin-right:25px;">
            <a class=" nav-buttons glyphicon glyphicon-arrow-left" aria-hidden="true" onClick="owl.prev()"></a>
            <a class=" nav-buttons glyphicon glyphicon-arrow-right" aria-hidden="true" onClick="owl.next()"></a>
        </div>
    </h3>
    <div id="owl-carousel" class="owl-carousel owl-theme" style="background:#e9e9e9; border-top: solid thin #ddd; border-bottom: solid thin #ddd;">
    <?php
	foreach ( $sliderItems as $item ) {
		
		$favKey = $item['unique_key'];
		if ( $featured ) {
			$favKey .= "_FEAT";
		}
		
		//echo var_dump($favKey);
		
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
		$itemImages = explode(",", $item['image']);
		$thumb = $itemImages[0];

    if ( $item['image'] == "" ) {
      $thumb = "0.png";
    }
	
	if ( !$_SESSION['loggedIn'] ) {
    $itemFav = '
      <a href="url/login.php"><span class="glyphicon glyphicon-heart fav fav-false" 
        data-toggle="tooltip" 
        title="Favorite it!" >
      </span></a>
    ';
  } else if ( strstr($favs, $item['unique_key']) ) {
		$itemFav = '
			<span id="fav_'. $favKey .'" 
				onClick="removeFromFav(\''. $item['unique_key'] .'\')" 
				class="glyphicon glyphicon-heart fav fav-true" 
				data-toggle="tooltip" 
				title="Un-favorite it!" >
			</span>
		';
	} else {
		$itemFav = '
			<span id="fav_'. $favKey .'" 
				onClick="addtoFav(\''. $item['unique_key'] .'\')" 
				class="glyphicon glyphicon-heart fav fav-false" 
				data-toggle="tooltip" 
				title="Favorite it!" >
			</span>
		';
	}
		echo '
		  <div class="item">
			<div class="">
			  <div class="panel panel-display">
				<div class="panel-heading">'. $item['item_name'] .'
				  <div style="float:right">
					<a href="javascript:void(0);">'. $itemFav .'</a>
				  </div>
				</div>
				<div class="panel-body" style="position:relative;"><img src="images/thumbnails/'. $thumb .'" class="img-responsive" alt="Image"></div>
				<div class="panel-footer">
					<div class="sm-12" style="overflow:hidden;">
						'. $price .'
						<button class="btn btn-custom" style="float:right;" onClick="showItem(\''. $item['unique_key'] .'\')">Info</button>
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

<!-- Modal -->
<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog modal-lg">
  </div>
</div>

<div class="container well">
<h4>Debug</h4>
	<?php echo var_dump($_SESSION);
	 echo var_dump($_POST); 
	 ?>
</div>

<footer class="container-fluid text-center">
  <p>Diamond Website Copyright</p>
  <form class="form-inline">Get deals:
    <input type="email" class="form-control" size="50" placeholder="Email Address">
    <button type="button" class="btn btn-danger">Sign Up</button>
  </form>
</footer>

</body>

<script src="js/jquery-1.12.0.js"></script>
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

function showItem(id) {
    if (id == "") {
        document.getElementById("myModal").innerHTML = "";
        return;
    } else { 
        if (window.XMLHttpRequest) {
            // code for IE7+, Firefox, Chrome, Opera, Safari
            xmlhttp = new XMLHttpRequest();
        } else {
            // code for IE6, IE5
            xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
        }
        xmlhttp.onreadystatechange = function() {
            if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                document.getElementById("myModal").innerHTML = xmlhttp.responseText;
            }
        };
        xmlhttp.open("GET","url/fetch_item_info.php?id="+id,true);
        xmlhttp.send();
    }
	
	
	$("#myModal").modal("toggle");
}

function addtoFav(key) {
  if (window.XMLHttpRequest) {
      // code for IE7+, Firefox, Chrome, Opera, Safari
      xmlhttp = new XMLHttpRequest();
  } else {
      // code for IE6, IE5
      xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
  }
  xmlhttp.onreadystatechange = function() {
      if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
          $("#fav_"+key).removeClass("fav-false");
		  $("#fav_"+key).addClass("fav-true");
		  $("#fav_"+key).removeAttr("onClick");
		  $("#fav_"+key).attr("onClick", "removeFromFav('"+ key +"')");
		  $("#fav_"+key).attr("data-original-title", "Un-favorites it!");
		  
		  //Featured Workaround
          $("#fav_"+key+"_FEAT").removeClass("fav-false");
		  $("#fav_"+key+"_FEAT").addClass("fav-true");
		  $("#fav_"+key+"_FEAT").removeAttr("onClick");
		  $("#fav_"+key+"_FEAT").attr("onClick", "removeFromFav('"+ key +"')");
		  $("#fav_"+key+"_FEAT").attr("data-original-title", "Un-favorites it!");

      }
  };
  xmlhttp.open("GET","url/ajax.php?addtoFav="+key,true);
  xmlhttp.send();
}

function removeFromFav(key) {
  if (window.XMLHttpRequest) {
      // code for IE7+, Firefox, Chrome, Opera, Safari
      xmlhttp = new XMLHttpRequest();
  } else {
      // code for IE6, IE5
      xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
  }
  xmlhttp.onreadystatechange = function() {
      if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
          $("#fav_"+key).removeClass("fav-true");
		  $("#fav_"+key).addClass("fav-false");
		  $("#fav_"+key).removeAttr("onClick");
		  $("#fav_"+key).attr("onClick", "addtoFav('"+ key +"')");
		  $("#fav_"+key).attr("data-original-title", "Favorite it!");
		  
		  //Feature Workaround
          $("#fav_"+key+"_FEAT").removeClass("fav-true");
		  $("#fav_"+key+"_FEAT").addClass("fav-false");
		  $("#fav_"+key+"_FEAT").removeAttr("onClick");
		  $("#fav_"+key+"_FEAT").attr("onClick", "addtoFav('"+ key +"')");
		  $("#fav_"+key+"_FEAT").attr("data-original-title", "Favorite it!");
      }
  };
  xmlhttp.open("GET","url/ajax.php?removeFromFav="+key,true);
  xmlhttp.send();
}

function setModalImage(img) {
	document.getElementById("img").src = "images/" +img;
}


  $(document).ready(function(){
    $('[data-toggle="tooltip"]').tooltip(); 
  });
</script>

</html>