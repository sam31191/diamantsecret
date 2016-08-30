<?php
  if (!isset($_GET['id'])) {
    die();
  }

  if ( session_status() == PHP_SESSION_NONE ) {
    session_start();
  }

  include 'require.php';

  $fetch = $pdo->prepare("SELECT * FROM `items` WHERE `unique_key` = :key");
  $fetch->execute(array(":key" => $_GET['id']));

  if ( $fetch->rowCount() > 0 ) {
    $item = $fetch->fetch(PDO::FETCH_ASSOC);
	
	switch($item['category']) {
		case 2: {
			$fetchInfo = $pdo->prepare("SELECT * FROM `pendants` WHERE `unique_key` = :key");
			$fetchInfo->execute(array(
				":key" => $item['unique_key']
			));
			break;
		}
		case 3: {
			$fetchInfo = $pdo->prepare("SELECT * FROM `bracelets` WHERE `unique_key` = :key");
			$fetchInfo->execute(array(
				":key" => $item['unique_key']
			));
			break;
		}
		case 4: {
			$fetchInfo = $pdo->prepare("SELECT * FROM `rings` WHERE `unique_key` = :key");
			$fetchInfo->execute(array(
				":key" => $item['unique_key']
			));
			break;
		}
	}

	$itemInfo = $fetchInfo->fetch(PDO::FETCH_ASSOC);

	$images = explode(",",$item['image']);

	if ( $item['image'] == "" ) {
		$images[0] = "0.png";
	}
	
	$imageList = "";
	foreach ( $images as $image ) {
		if ( $image !== "" ) {
			$imageList .= '<a href="javascript:void(0);" onClick="setModalImage(\''. $image .'\')"><img id="thumb" src="images/thumbnails/'.$image.'"></a>';
		}
	}
	
	if ( $item['discount'] > 0 ) {
		$value = $item['item_value'] -  (($item['discount'] / 100 ) * $item['item_value']);
		$price =  '<label class="label label-info label-custom">'.$item['discount'].'% Off</label><br>
		<h3 style="margin-top:10px;">€'. round($value, 2) .' <small><strike>€'. $item['item_value'] .'</strike></small></h3>';
	} else {
		$price = '<h3>€'. $item['item_value'] .'</h3>';
	}
	
    echo '
	<style>
	#img-holder {
		border: solid thin #bbb;
		padding: 15px;
	}
	#img {
		transition: 0.2s all ease;
	}
	#img:hover {
		transform: scale(1.1);
	}
	#thumb {
		width: 75px;
		padding: 5px;
		border: solid thin #bbb;
		margin: 5px;
		transition: 0.2s all ease;
	}
	#thumb:hover {
		transform: scale(1.1);
	}
	.label-custom {
		font-size: 14px;
		padding: 2px 20px;
		border-radius: 15px;
	}
	</style>
    <div class="modal-dialog modal-lg">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-body">
        <div class="right_col col-sm-12" role="main">
          <div class="col-sm-6">
            <div class="col-sm-12">
				<div id="img-holder"><img id="img" src="images/'. $images[0] .'" style="width:100%"></div>
			</div>
			<div class="col-sm-12" style="text-align:center;">
				'.$imageList.'
			</div>
          </div>
          <div class="col-sm-6">
		  	<div class="col-sm-12">
				'. $price .'<br>
				<h4>'. $item['item_name'] .'</h4>
				<h5 class="item_info"><strong>Stone:</strong> '. $itemInfo['stone'] .' <small>'. $itemInfo['stone_carat'] .'ct.</small></h5>
				<h5 class="item_info"><strong>No. of Stones:</strong> '. $itemInfo['num_of_stones'] .'</h5>
				<h5 class="item_info"><strong>Material:</strong> '. $itemInfo['material'] .' <small>'. $itemInfo['material_carat'] .'ct.</small></h5>
				<h5 class="item_info"><strong>Product Height:</strong> '. $itemInfo['height'] .' <small>cm</small></h5>
				<h5 class="item_info"><strong>Product Length:</strong> '. $itemInfo['length'] .' <small>cm</small></h5>
			</div>
		  </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-custom" data-dismiss="modal">Close</button>
      </div>
      </form>
    </div>
  </div> 
  ';
  }
  else {
    echo var_dump("Nothing Found");
  }
?>