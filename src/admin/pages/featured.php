<!DOCTYPE html>
<html lang="en">
<?php
if ( session_status() == PHP_SESSION_NONE ) {
	session_start();
}
if ( !isset($_SESSION['modSession']) ) {
	 header ('Location: ../../index.php');
	 die();
}
if ( isset($_SESSION['modSession']) ) {
	if ( !$_SESSION['modSession'] || $_SESSION['admin'] <= 0 ) {
		header ('Location: ../../index.php');
		die();
	}
}
include '../../url/require.php';

	//echo var_dump($_POST);
/*if ( isset($_POST['addItem']) ) {
	//echo var_dump($_FILES);
	if ( $_POST['discount'] > 0 ) {
		$discount = $_POST['discount'];
	} else {
		$discount = 0;
	}
	
	$images = "";
	
	$numOfImages = sizeof($_FILES['itemImage']['name']);
	for ( $count = 0; $count < $numOfImages; $count++ ) {
		$image_dir = "../../images/";
		$image_ext = pathinfo($image_dir . basename($_FILES['itemImage']['name'][$count]), PATHINFO_EXTENSION);
		$image_file = $image_dir . str_replace(" ", "_", $_POST['itemName']);
		$thumb_file = $image_dir . "thumbnails/" . str_replace(" ", "_", $_POST['itemName']);
		
		$check = getimagesize($_FILES['itemImage']['tmp_name'][$count]);
		if ( $check ) {
			if ( file_exists($image_file . "." . $image_ext) ) {
				$i = 1;
				while ( file_exists($image_file . "_" . $i . "." . $image_ext) ) {
					$i++;
				}
				$image_file .= "_" . $i;
				$thumb_file .= "_" . $i; 
			}
			if ( move_uploaded_file($_FILES['itemImage']['tmp_name'][$count], $image_file . "." . $image_ext) ) {
				create_thumb($image_file . "." . $image_ext, 200, 200, $thumb_file . '.' . $image_ext);
			}
		} else {
			echo var_dump("Not Image");
		}
		
		$images .= basename($image_file) . "." . $image_ext . "|";
	}
	
	
	//echo var_dump($images);
	$addItem = $pdo->prepare("INSERT INTO `items` (`item_name`, `item_value`, `discount`, `image`, `category`) VALUES (:name, :value, :discount, :image, :category)");
	$addItem->execute(array(
		":name" => $_POST['itemName'],
		":value" => $_POST['itemValue'],
		":discount" => $discount,
		":image" => $images,
		":category" => "Featured"
	));
}*/

function create_thumb($file, $w, $h,  $thumb_dir, $crop=FALSE) {
		list($width, $height) = getimagesize($file);
		$r = $width / $height;
		if ($crop) {
			if ($width > $height) {
				$width = ceil($width-($width*abs($r-$w/$h)));
			} else {
				$height = ceil($height-($height*abs($r-$w/$h)));
			}
			$newwidth = $w;
			$newheight = $h;
		} else {
			if ($w/$h > $r) {
				$newwidth = $h*$r;
				$newheight = $h;
			} else {
				$newheight = $w/$r;
				$newwidth = $w;
			}
		}
		$src = imagecreatefromjpeg($file);
		$dst = imagecreatetruecolor($newwidth, $newheight);
		imagecopyresampled($dst, $src, 0, 0, 0, 0, $newwidth, $newheight, $width, $height);
		
		return imagejpeg($dst, $thumb_dir);
	}
?>
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin Control Panel</title>
    <!-- Bootstrap -->
    <link href="../../css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel='stylesheet prefetch' href='http://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css'>
    <!-- Custom Theme Style -->
    <link href="../admin-assets/custom.min.css" rel="stylesheet">
    <link href="../../css/site.css" rel="stylesheet">
  </head>

  <body class="nav-md">
    <div class="container body" style="background-color:#911116">
      <div class="main_container">
      	<!-- sidebar -->
        <div class="col-md-3 left_col">
          <?php include 'sidebar.php'; ?>
        </div>
		<!-- /sidebar -->
        <!-- top navigation -->
        <div class="top_nav">
          <?php include 'navbar.php'; ?>
        </div>
        <!-- /top navigation -->

        <!-- page content -->
        <div class="right_col" role="main">
        <div>
        <h3>Featured Deals </h3>
        	<table class="table table-hover" style="table-layout:fixed">
            	<thead>
                	<th>Name</th>
                	<th>Value</th>
                	<th>Discount (%)</th>
                	<th>Images</th>
                </thead>
                <tbody>
                	<?php
					$query = $pdo->prepare("SELECT * FROM `items` WHERE `featured` = :featured");
					$query->execute(array(":featured" => 1 ));
					$result = $query->fetchAll();
					
					foreach ( $result as $entry ) {
						$price = '€'.$entry['item_value'];
						
						$images = explode ("|", $entry['image']);
						$listImage = "";
						foreach ( $images as $image ) {
							if ( !is_null($image) ) {
								$listImage .= $image . "   ";
							}
						}
						if ( $entry['discount'] > 0 ) {
							$discounted = $entry['item_value'] - (( $entry['discount'] / 100) * $entry['item_value']);
							$price = '<small class="old-price">€' . $entry['item_value'] . '</small> <span class="glyphicon glyphicon-chevron-right"></span> €' . round($discounted, 2);
						}
						echo '<tr>';
							echo '<td>'. $entry['item_name'] .'</td>';
							echo '<td>'. $price .'</td>';
							echo '<td>'. $entry['discount'] .'</td>';
							echo '<td>'. $listImage .'</td>';
						echo '</tr>';
					}
					?>
                </tbody>
            </table>
        </div>
        <!-- Modal -->
        <div id="myModal" class="modal fade" role="dialog">
          <div class="modal-dialog">
        
            <!-- Modal content-->
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Add New Item</h4>
              </div>
              <form method="post" enctype="multipart/form-data">
              <div class="modal-body">
                <div class="container">
                    <div class="col-sm-6">
                        <div class="form-group">
                          <div class="col-sm-12"><label for="usr">Item Name</label></div>
                          <input type="text" class="form-control" id="usr" autofocus placeholder="Item Name" name="itemName" required>
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="form-group">
                          <div class="col-sm-12"><label for="usr">Item Value</label></div>
                          <div class="col-sm-12"><input class="form-control" id="usr" autofocus placeholder="Item Value" min="00" name="itemValue" required></div>
                        </div>
                    </div>
                    <div class="col-sm-2">
                        <div class="form-group">
                          <div class="col-sm-12"><label for="usr">Discount</label></div>
                          <div class="col-sm-12"><input type="number" class="form-control" id="usr" autofocus placeholder="0" min="00" max="99" name="discount"></div>
                        </div>
                    </div>
                    <div class="col-sm-12">
                        <div class="form-group">
                          <div class="col-sm-12"><label for="usr">Item Image</label></div>
                          <input type="file" class="form-control" id="usr" name="itemImage[]" multiple required>
                        </div>
                    </div>
                </div>
              </div>
              <div class="modal-footer">
                <button type="submit" class="btn btn-custom" name="addItem" >Submit</button>
                <button type="button" class="btn btn-custom" data-dismiss="modal">Close</button>
              </div>
              </form>
            </div>
          </div>
        </div>
        </div>
        <!-- /page content -->

        <!-- footer content -->
        <footer style="margin-top:-10px;">
          <?php include 'footer.php'; ?>
        </footer>
        <!-- /footer content -->
      </div>
    </div>

    <!-- jQuery -->
    
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="../../js/bootstrap.min.js"></script>
    <script src="../admin-assets/custom.min.js"></script>
    <script>
    	$("#itemValuePicker").WanSpinner(options = {
		maxValue: 1000,
		minValue: 1,
		step: 1,
		});
    </script>
  </body>
</html>
