<?php 
if ( session_status() == PHP_SESSION_NONE ) {
	session_start();
}
echo var_dump($_SESSION);
if ( $_SESSION['modSession'] ) {
	include '../url/require.php';
	
	echo var_dump($_POST);
	
	echo '<h3>Featured Deals <button class="btn btn-custom" data-toggle="modal" data-target="#myModal">Add Item</button></h3>';
	
	$query = $pdo->prepare("SELECT * FROM `sliders` WHERE `Category` = :category");
	$query->execute(array(":category" => $_GET['show'] ));
	$result = $query->fetchAll();
	
	foreach ( $result as $entry ) {
		echo '
			<div class="item">
			  <div class="col-sm-3">
				<div class="panel panel-display">
				  <div class="panel-heading">'. $entry['Item Name'] .'</div>
				  <div class="panel-body" style="position:relative;"><img src="'. $entry['Image'] .'" class="img-responsive" alt="Image"></div>
				  <div class="panel-footer">
					  <div class="sm-12" style="overflow:hidden;">
						  <div style="float:left">';
							  if ( $entry['Discount'] > 0 ) {
								echo '<span class="old-price">$99.99</span><br>
								  <span class="discounted-price">$79.99</span>';
							  } else {
								echo '<span class="discounted-price">$ '. $entry['Item Value'] .'</span><br>
								  <span class="info-text">Discount: '. $entry['Discount'] .'%</span>';
							  }
							echo'  
						  </div><br>
						  <a class="btn btn-custom" style="float:right;">INFO</a>
					  </div>
				  </div>
				</div>
			  </div>
			</div>';	
	}
}
else {
	//Not Mod Session
}
?>
<!-- Modal -->
<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Add New Item</h4>
      </div>
      <form method="post" action="home.php?show=featured">
      <div class="modal-body">
        <div class="container">
        	<div class="col-sm-6">
            	<div class="form-group">
                  <label for="usr">Item Name</label>
                  <input type="text" class="form-control" id="usr" autofocus placeholder="Item Name" name="itemName" required>
                </div>
            </div>
        	<div class="col-sm-6">
            	<div class="form-group">
                  <div class="col-sm-12"><label for="usr">Item Value</label></div>
                  <div class="col-sm-4"><input type="number" class="form-control" id="usr" autofocus placeholder="00" min="00" name="itemValueX" required></div>
                  <div class="col-sm-4"><input type="number" class="form-control" id="usr" autofocus placeholder="00" min="00" max="99" name="itemValueY" required></div>
                </div>
            </div>
        	<div class="col-sm-12">
            	<div class="form-group">
                  <label for="usr">Item Image</label>
                  <input type="url" class="form-control" id="usr" autofocus placeholder="Image url" name="itemImage" required>
                </div>
            </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="submit" class="btn btn-custom" >Submit</button>
        <button type="button" class="btn btn-custom" data-dismiss="modal">Close</button>
      </div>
      </form>
    </div>
  </div>
</div>