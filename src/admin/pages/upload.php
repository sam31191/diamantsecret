<?php
$ds          = DIRECTORY_SEPARATOR;  //1
 
$storeFolder = '../../assets/item_img';   //2
 
if (!empty($_FILES)) {
     
    $tempFile = $_FILES['file']['tmp_name'];          //3             
      
    $targetPath = dirname( __FILE__ ) . $ds. $storeFolder . $ds;  //4
     
    $targetFile =  $targetPath. $_FILES['file']['name'];  //5
 	
	$fp = fopen($_SERVER['DOCUMENT_ROOT'] . "/myText.txt","wb");
	fwrite($fp, json_encode($_FILES));
	fclose($fp);
	
	while ( file_exists( $targetFile ) ) {
		$targetFile .= "0";
	}
    move_uploaded_file($tempFile,$targetFile); //6
     
}
?> 