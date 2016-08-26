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
	echo var_dump($_POST);
	
	
	//echo var_dump($images);
	$addItem = $pdo->prepare("INSERT INTO `diamonds` 
		(`price`, `shape`, `carat`, `color`, `clarity`, `cut`, `polish`, `lab`, `fluorescence`, `details`) 
		VALUES 
		(:price, :shape, :carat, :color, :clarity, :cut, :polish, :lab, :fluorescence, :details)");
	$addItem->execute(array(
		":price" => $_POST['price'],
		":shape" => $_POST['shape'],
		":carat" => $_POST['carat'],
		":color" => $_POST['color'],
		":clarity" => $_POST['clarity'],
		":cut" => $_POST['cut'],
		":polish" => $_POST['polish'],
		":lab" => $_POST['lab'],
		":fluorescence" => $_POST['fluorescence'],
		":details" => $_POST['details'],
	));
}
?>
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Diamonds - Admin Panel</title>
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
        <h3>Diamonds <button class="btn btn-custom" data-toggle="modal" data-target="#myModal">Add</button></h3>
        	<table class="table table-hover" >
            	<thead>
                	<th>Price</th>
                	<th>Shape</th>
                	<th>Carat</th>
                	<th>Color</th>
                	<th>Clarity</th>
                	<th>Cut</th>
                	<th>Polish</th>
                	<th>Lab</th>
                	<th>Fluor</th>
                	<th>Detail</th>
                </thead>
                <tbody>
                	<?php
					$query = $pdo->prepare("SELECT * FROM `diamonds`");
					$query->execute();
					$result = $query->fetchAll();
					
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
                <h4 class="modal-title">Add New Diamond</h4>
              </div>
              <form method="post" enctype="multipart/form-data">
              <div class="modal-body">
                <div class="container">
                    <div class="col-sm-12">
	                    <div class="input-group">
						  <span class="input-group-addon"> <i class="fa fa-eur" aria-hidden="true"> </i> </span>
						  <input name="price" type="text" class="form-control" placeholder="Price (Hint: 999.99)" pattern="[0-9]{1,9}[.][0-9]{2}" title="(9.99)(499.99)" required>
						</div>
					</div>
                    
                    <div class="col-sm-12">
                        <div class="input-group">
						  <span class="input-group-addon"><i class="fa fa-diamond" aria-hidden="true"></i></span>
                          <select name="shape" required class="select-style">
                          	<option value="">Shape</option>
                          	<option value="Round">Round</option>
                          	<option value="Princess">Princess</option>
                          	<option value="Marquise">Marquise</option>
                          	<option value="Emerald">Emerald</option>
                          	<option value="Pear">Pear</option>
                          	<option value="Heart">Heart</option>
                          	<option value="Oval">Oval</option>
                          	<option value="Cushion">Cushion</option>
                          	<option value="Radiant">Radiant</option>
                          	<option value="Cus. Brilliant">Cus. Brilliant</option>
                          	<option value="Lradiant">Lradiant</option>
                          	<option value="SQEmerald">SQEmerald</option>
                          </select>
                        </div>
                    </div>
                    
                    <div class="col-sm-12">
	                    <div class="input-group">
						  <span class="input-group-addon"><i class="fa fa-spinner" aria-hidden="true"></i></span>
						  <input name ="carat" type="text" class="form-control" placeholder="Carat (Hint: 1.0)" pattern="[0-9]{1,5}.[0-9]{1,2}" required>
						</div>
					</div>
                    
                    <div class="col-sm-12">
                        <div class="input-group">
						  <span class="input-group-addon"><i class="fa fa-filter" aria-hidden="true"></i></span>
                          <select name="color" required class="select-style">
                          	<option value="">Color</option>
                          	<option value="D">D</option>
                          	<option value="E">E</option>
                          	<option value="F">F</option>
                          	<option value="G">G</option>
                          	<option value="H">H</option>
                          	<option value="I">I</option>
                          	<option value="J">J</option>
                          	<option value="K">K</option>
                          	<option value="L">L</option>
                          	<option value="M">M</option>
                          	<option value="N">N</option>
                          	<option value="O">O</option>
                          	<option value="P-Z">P-Z</option>
                          </select>
                        </div>
                    </div>
                    
                    <div class="col-sm-12">
                        <div class="input-group">
						  <span class="input-group-addon"><i class="fa fa-search" aria-hidden="true"></i></span>
                          <select name="clarity" required class="select-style">
                          	<option value="">Clarity</option>
                          	<option value="FL">FL</option>
                          	<option value="IF">IF</option>
                          	<option value="VVS1">VVS1</option>
                          	<option value="VVS2">VVS2</option>
                          	<option value="VS1">VS1</option>
                          	<option value="VS2">VS2</option>
                          	<option value="SI2">SI2</option>
                          	<option value="SI3">SI3</option>
                          	<option value="I3">I3</option>
                          </select>
                        </div>
                    </div>
                    
                    <div class="col-sm-12">
                        <div class="input-group">
						  <span class="input-group-addon"><i class="fa fa-sort-amount-desc" aria-hidden="true"></i></span>
                          <select name="cut" required class="select-style">
                          	<option value="">Cut</option>
                          	<option value="EX">EX</option>
                          	<option value="VG">VG</option>
                          	<option value="G">G</option>
                          	<option value="F">F</option>
                          </select>
                        </div>
                    </div>
                    
                    <div class="col-sm-12">
                        <div class="input-group">
						  <span class="input-group-addon"><i class="fa fa-sort-amount-desc" aria-hidden="true"></i></span>
                          <select name="polish" required class="select-style">
                          	<option value="">Polish</option>
                          	<option value="EX">EX</option>
                          	<option value="VG">VG</option>
                          	<option value="G">G</option>
                          	<option value="F">F</option>
                          </select>
                        </div>
                    </div>
                    
                    <div class="col-sm-12">
                        <div class="input-group">
						  <span class="input-group-addon"><i class="fa fa-certificate" aria-hidden="true"></i></span>
                          <select name="lab" required class="select-style">
                          	<option value="">Lab</option>
                          	<option value="GIA">GIA</option>
                          	<option value="HRD">HRD</option>
                          	<option value="IGI">IGI</option>
                          </select>
                        </div>
                    </div>

                    <div class="col-sm-12">
                        <div class="input-group">
						  <span class="input-group-addon"><i class="fa fa-certificate" aria-hidden="true"></i></span>
                          <select name="fluorescence" required class="select-style">
                          	<option value="">Fluorecence</option>
                          	<option value="FNT">FNT</option>
                          	<option value="MED">MED</option>
                          	<option value="STG">STG</option>
                          	<option value="VST">VST</option>
                          </select>
                        </div>
                    </div>

                    <div class="col-sm-12">
	                    <div class="input-group">
						  <span class="input-group-addon"><i class="fa fa-info" aria-hidden="true"></i></span>
						  <input name ="details" type="text" class="form-control" placeholder="Details (Optional)">
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
	$(document).ready(function(){
		$('[data-toggle="tooltip"]').tooltip(); 
	});
	</script>
  </body>
</html>
