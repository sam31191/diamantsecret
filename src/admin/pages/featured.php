<!DOCTYPE html>
<html lang="en">
<?php
if ( session_status() == PHP_SESSION_NONE ) {
	session_start();
}
if ( !isset($_SESSION['modSession']) ) {
	 header ('Location: ../index.php');
	 die();
}
if ( isset($_SESSION['modSession']) ) {
	if ( !$_SESSION['modSession'] || $_SESSION['Admin'] <= 0 ) {
		header ('Location: ../index.php');
		die();
	}
}
include '../../url/require.php';

	//echo var_dump($_POST);
if ( isset($_POST['addItem']) ) {
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
}

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
    <link href="../admin-assets/admin.css" rel="stylesheet">
    <link href="../../css/site.css" rel="stylesheet">
  </head>

  <body class="nav-md">
    <div class="container body" style="background-color:#911116">
      <div class="main_container">
        <div class="col-md-3 left_col">
          <div class="left_col scroll-view">
            <div class="navbar nav_title" style="border: 0;">
              <a href="../../index.php" class="site_title"><i class="fa fa-home"></i> <span>Website Home</span></a>
            </div>

            <div class="clearfix"></div>

            <!-- menu profile quick info -->
            <div class="profile">
              <div class="profile_info">
                <span>Welcome,</span>
                <h2><?php echo $_SESSION['Username']; ?></h2>
              </div>
            </div>
            <!-- /menu profile quick info -->

            <br />

            <!-- sidebar menu -->
            <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
              <div class="menu_section">
                <h3>General</h3>
                <ul class="nav side-menu">
                  <li><a><i class="fa fa-home"></i> Home <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="../index.html">Dashboard</a></li>
                      <li><a href="../index2.html">Dashboard2</a></li>
                      <li><a href="../index3.html">Dashboard3</a></li>
                    </ul>
                  </li>
                  <li><a><i class="fa fa-edit"></i> Sliders <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="featured.php">Featured</a></li>
                      <li><a href="pendants.php">Pendants</a></li>
                      <li><a href="../form_validation.html">Form Validation</a></li>
                      <li><a href="../form_wizards.html">Form Wizard</a></li>
                      <li><a href="../form_upload.html">Form Upload</a></li>
                      <li><a href="../form_buttons.html">Form Buttons</a></li>
                    </ul>
                  </li>
                  <li><a><i class="fa fa-desktop"></i> UI Elements <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="../general_elements.html">General Elements</a></li>
                      <li><a href="../media_gallery.html">Media Gallery</a></li>
                      <li><a href="../typography.html">Typography</a></li>
                      <li><a href="../icons.html">Icons</a></li>
                      <li><a href="../glyphicons.html">Glyphicons</a></li>
                      <li><a href="../widgets.html">Widgets</a></li>
                      <li><a href="../invoice.html">Invoice</a></li>
                      <li><a href="../inbox.html">Inbox</a></li>
                      <li><a href="../calendar.html">Calendar</a></li>
                    </ul>
                  </li>
                  <li><a><i class="fa fa-table"></i> Tables <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="../tables.html">Tables</a></li>
                      <li><a href="../tables_dynamic.html">Table Dynamic</a></li>
                    </ul>
                  </li>
                  <li><a><i class="fa fa-bar-chart-o"></i> Data Presentation <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="../chartjs.html">Chart JS</a></li>
                      <li><a href="../chartjs2.html">Chart JS2</a></li>
                      <li><a href="../morisjs.html">Moris JS</a></li>
                      <li><a href="../echarts.html">ECharts</a></li>
                      <li><a href="../other_charts.html">Other Charts</a></li>
                    </ul>
                  </li>
                  <li><a><i class="fa fa-clone"></i>Layouts <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="../fixed_sidebar.html">Fixed Sidebar</a></li>
                      <li><a href="../fixed_footer.html">Fixed Footer</a></li>
                    </ul>
                  </li>
                </ul>
              </div>
              <div class="menu_section">
                <h3>Live On</h3>
                <ul class="nav side-menu">
                  <li><a><i class="fa fa-bug"></i> Additional Pages <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="../e_commerce.html">E-commerce</a></li>
                      <li><a href="../projects.html">Projects</a></li>
                      <li><a href="../project_detail.html">Project Detail</a></li>
                      <li><a href="../contacts.html">Contacts</a></li>
                      <li><a href="../profile.html">Profile</a></li>
                    </ul>
                  </li>
                  <li><a><i class="fa fa-windows"></i> Extras <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="../page_403.html">403 Error</a></li>
                      <li><a href="../page_404.html">404 Error</a></li>
                      <li><a href="../page_500.html">500 Error</a></li>
                      <li><a href="../plain_page.html">Plain Page</a></li>
                      <li><a href="../login.html">Login Page</a></li>
                      <li><a href="../pricing_tables.html">Pricing Tables</a></li>
                    </ul>
                  </li>
                  <li><a><i class="fa fa-sitemap"></i> Multilevel Menu <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                        <li><a href="#level1_1">Level One</a>
                        <li><a>Level One<span class="fa fa-chevron-down"></span></a>
                          <ul class="nav child_menu">
                            <li class="sub_menu"><a href="../level2.html">Level Two</a>
                            </li>
                            <li><a href="#level2_1">Level Two</a>
                            </li>
                            <li><a href="#level2_2">Level Two</a>
                            </li>
                          </ul>
                        </li>
                        <li><a href="#level1_2">Level One</a>
                        </li>
                    </ul>
                  </li>                  
                  <li><a href="javascript:void(0)"><i class="fa fa-laptop"></i> Landing Page <span class="label label-success pull-right">Coming Soon</span></a></li>
                </ul>
              </div>

            </div>
            <!-- /sidebar menu -->

            <!-- /menu footer buttons -->
            <div class="sidebar-footer hidden-small">
              <a data-toggle="tooltip" data-placement="top" title="Settings">
                <span class="glyphicon glyphicon-cog" aria-hidden="true"></span>
              </a>
              <a data-toggle="tooltip" data-placement="top" title="FullScreen">
                <span class="glyphicon glyphicon-fullscreen" aria-hidden="true"></span>
              </a>
              <a data-toggle="tooltip" data-placement="top" title="Lock">
                <span class="glyphicon glyphicon-eye-close" aria-hidden="true"></span>
              </a>
              <a data-toggle="tooltip" data-placement="top" title="Logout">
                <span class="glyphicon glyphicon-off" aria-hidden="true"></span>
              </a>
            </div>
            <!-- /menu footer buttons -->
          </div>
        </div>

        <!-- top navigation -->
        <div class="top_nav">
          <div class="nav_menu">
            <nav>
              <div class="nav toggle">
                <a id="menu_toggle"><i class="fa fa-bars"></i></a>
              </div>

              <ul class="nav navbar-nav navbar-right">
                <li class="">
                  <a href="javascript:;" class="user-profile dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                    <img src="../images/img.jpg" alt=""><?php echo $_SESSION['Username']; ?>
                    <span class=" fa fa-angle-down"></span>
                  </a>
                  <ul class="dropdown-menu dropdown-usermenu pull-right">
                    <li><a href="javascript:;"> Profile</a></li>
                    <li>
                      <a href="javascript:;">
                        <span class="badge bg-red pull-right">50%</span>
                        <span>Settings</span>
                      </a>
                    </li>
                    <li><a href="javascript:;">Help</a></li>
                    <li><a href="../login.html"><i class="fa fa-sign-out pull-right"></i> Log Out</a></li>
                  </ul>
                </li>

                <li role="presentation" class="dropdown">
                  <a href="javascript:;" class="dropdown-toggle info-number" data-toggle="dropdown" aria-expanded="false">
                    <i class="fa fa-envelope-o"></i>
                    <span class="badge bg-green">6</span>
                  </a>
                  <ul id="menu1" class="dropdown-menu list-unstyled msg_list" role="menu">
                    <li>
                      <a>
                        <span class="image"><img src="../images/img.jpg" alt="Profile Image" /></span>
                        <span>
                          <span>John Smith</span>
                          <span class="time">3 mins ago</span>
                        </span>
                        <span class="message">
                          Film festivals used to be do-or-die moments for movie makers. They were where...
                        </span>
                      </a>
                    </li>
                    <li>
                      <a>
                        <span class="image"><img src="../images/img.jpg" alt="Profile Image" /></span>
                        <span>
                          <span>John Smith</span>
                          <span class="time">3 mins ago</span>
                        </span>
                        <span class="message">
                          Film festivals used to be do-or-die moments for movie makers. They were where...
                        </span>
                      </a>
                    </li>
                    <li>
                      <a>
                        <span class="image"><img src="../images/img.jpg" alt="Profile Image" /></span>
                        <span>
                          <span>John Smith</span>
                          <span class="time">3 mins ago</span>
                        </span>
                        <span class="message">
                          Film festivals used to be do-or-die moments for movie makers. They were where...
                        </span>
                      </a>
                    </li>
                    <li>
                      <a>
                        <span class="image"><img src="../images/img.jpg" alt="Profile Image" /></span>
                        <span>
                          <span>John Smith</span>
                          <span class="time">3 mins ago</span>
                        </span>
                        <span class="message">
                          Film festivals used to be do-or-die moments for movie makers. They were where...
                        </span>
                      </a>
                    </li>
                    <li>
                      <div class="text-center">
                        <a>
                          <strong>See All Alerts</strong>
                          <i class="fa fa-angle-right"></i>
                        </a>
                      </div>
                    </li>
                  </ul>
                </li>
              </ul>
            </nav>
          </div>
        </div>
        <!-- /top navigation -->

        <!-- page content -->
        <div class="right_col" role="main">
        <div>
        <h3>Featured Deals <button class="btn btn-custom" data-toggle="modal" data-target="#myModal">Add Item</button></h3>
        	<table class="table table-hover" style="table-layout:fixed">
            	<thead>
                	<th>Name</th>
                	<th>Value</th>
                	<th>Discount (%)</th>
                	<th>Images</th>
                </thead>
                <tbody>
                	<?php
					$query = $pdo->prepare("SELECT * FROM `items` WHERE `category` = :category");
					$query->execute(array(":category" => "Featured" ));
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
                          <input type="file" class="form-control" id="usr" name="itemImage[]" multiple="multiple" required>
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
          <div class="pull-right">
            Admin Control Panel</a>
          </div>
          <div class="clearfix"></div>
        </footer>
        <!-- /footer content -->
      </div>
    </div>

    <!-- jQuery -->
    
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="../../js/bootstrap.min.js"></script>
    <script src="../admin-assets/custom.min.js"></script>
    <script src="../admin-assets/wan-spinner.js"></script>
    <script>
    	$("#itemValuePicker").WanSpinner(options = {
		maxValue: 1000,
		minValue: 1,
		step: 1,
		});
    </script>
  </body>
</html>
