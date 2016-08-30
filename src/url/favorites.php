<!DOCTYPE html>
<html lang="en">
<head>
  <title>Favorites</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="../css/bootstrap.min.css">
  <link rel="stylesheet" href="../css/site.css">
  <link rel="stylesheet" href="../css/owl.carousel.css">
  <link rel="stylesheet" href="../css/owl.theme.css">
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

if ( !$_SESSION['loggedIn'] ) {
	header("Location: ../index.php");
}
include 'require.php';
if ( isset ($_POST['removeFromFavorites']) ) {
	//echo var_dump($_POST);	
	$getcurrentFavs = $pdo->prepare("SELECT `favorites` FROM `accounts` WHERE `username` = :username");
	$getcurrentFavs->execute(array(":username" => $_SESSION['Username']));

	$result = $getcurrentFavs->fetch(PDO::FETCH_ASSOC);
	$currentFav = $result['favorites'];

	$currentFav = str_replace(',' . $_POST['removeFromFavorites'], "", $currentFav);

	//echo $currentFav;

	$updateFav = $pdo->prepare("UPDATE `accounts` SET `favorites` = :favs WHERE `username` = :username");
	$updateFav->execute ( array (":favs" => $currentFav, ":username" => $_SESSION['Username']) );
} 
?>
<body>

<div class="jumbotron" style="background:none;">
  <div class="container text-center">
    <img src="../images/gfx/Arhaan_Small_logo.png">
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
        <li><a href="../index.php">Home</a></li>
        <li><a href="#">Products</a></li>
        <li><a href="#">Deals</a></li>
        <li><a href="#">Stores</a></li>
        <li><a href="#">Contact</a></li>
      </ul>
      <ul class="nav navbar-nav navbar-right">
      	<?php 
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
				echo '<li><a href="login.php">Login</a></li>';
			}
			if ( isset($_SESSION["loggedIn"]) && $_SESSION["loggedIn"] ) {
				echo '<li  class="active"><a href="#">Favorites</a></li>';
			}
			else {
				echo '<li><a href="login.php#signup">Sign up</a></li>';
			}
			
			if ( isset($_SESSION['Admin']) ) {
				if ( $_SESSION['Admin'] > 0 ) {
					echo '<li><a href="../admin/login.php">Admin</a></li>';
				}
			}
		?>
      </ul>
    </div>
  </div>
</nav>

<div id="homeContainer">
  <div class="container" style="margin:52px auto;">
    <table class="table table-bordered table-custom">
      <thead>
        <th></th>
        <th>Item</th>
        <th>Price</th>
        <th></th>
      </thead>
      <tbody>
        <?php
          $fetchFavs = $pdo->prepare("SELECT `favorites` FROM `accounts` WHERE `username` = :user");
          $fetchFavs->execute(array(":user" => $_SESSION['Username']));

          $favs = $fetchFavs->fetch(PDO::FETCH_ASSOC);

          $favs = explode(",", $favs['favorites']);
		  
		  //echo var_dump($favs);
		  
		  foreach ( $favs as $fav ) {
		  	if ( $fav !== "" ) {
				$fetchInfo = $pdo->prepare("SELECT * FROM `items` WHERE `unique_key` = :key");
				$fetchInfo->execute(array(":key" => $fav));
				
				$prodInfo = $fetchInfo->fetch(PDO::FETCH_ASSOC);
				echo '
				<tr>
					<td style="width:150px"><img src="../images/thumbnails/'. $fav .'.jpg"></td>
					<td>'. $prodInfo['item_name'] .'</td>
					<td style="text-align: center;vertical-align: middle; font-size: 18px; width:200px">€'. $prodInfo['item_value'] .'</td>
					<td  style="text-align: center;vertical-align: middle; font-size: 18px; width:50px"><form method="post">
								<button class="glyphicon glyphicon-remove glyphicon-custom" name="removeFromFavorites" value="'. $prodInfo['unique_key'] .'" data-toggle="tooltip" title="Unfavorite it!"></button>
								</form></td>
				</tr>';
			}
		  }
        ?>
      </tbody>
    </table>
  </div>
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
  <p>Online Store Copyright</p>
  <form class="form-inline">Get deals:
    <input type="email" class="form-control" size="50" placeholder="Email Address">
    <button type="button" class="btn btn-danger">Sign Up</button>
  </form>
</footer>

</body>

<script src="../js/jquery-1.12.0.js"></script>
<script src="../js/bootstrap.min.js"></script>
<script src="../js/owl.carousel.min.js"></script>
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