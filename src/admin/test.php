<?php

error_reporting(E_ALL);
set_time_limit(0);

date_default_timezone_set('Europe/London');

?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />

<title>PHPExcel Reader Example #01</title>

</head>
<body>

<h1>PHPExcel Reader Example #01</h1>
<h2>Simple File Reader using PHPExcel_IOFactory::load()</h2>
<?php

var_dump($_POST);
var_dump($_FILES);

/** Include path **/
set_include_path(get_include_path() . PATH_SEPARATOR . './PHPExcel/');

/** PHPExcel_IOFactory */
include 'PHPExcel/IOFactory.php';

$url='https://images.baunat.com/en/82414_CL-GW-R3-0030S_1_722x722/0-30-carat-solitaire-diamond-engagement-ring-in-white-gold';
$ch=curl_init();
$timeout=5;

curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, $timeout);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);

$result=curl_exec($ch);
$curlError = curl_error($ch);
$contentType = curl_getinfo($ch, CURLINFO_CONTENT_TYPE);
curl_close($ch);

if ( empty($curlError) ) {
	if ( strpos($contentType, "image/") === false ) {
		echo 'Invalid Image';
	} else {
		$ext = explode("/", $contentType);
		file_put_contents("../images/test_" . "." . $ext[sizeof($ext) - 1], $result);
	}
} else {
	echo $curlError;
}



/*
if ( isset($_FILES['excel_sheet']) ) {
	$xlFile = $_FILES['excel_sheet']['tmp_name'];
	echo 'Loading file ',pathinfo($xlFile,PATHINFO_BASENAME),' using IOFactory to identify the format<br />';
	$PHPExcel = PHPExcel_IOFactory::load($xlFile);

	//$xl = $PHPExcel->getActiveSheet()->toArray(null, true, true, true);

	$productSheet = $PHPExcel->getSheetByName('products');
	if ( is_null($productSheet) ) {
		echo "Sheet not found";
	} else {
		echo var_dump($productSheet->toArray(null, true, true, true));
	}


	//$sheets = $xl->getSheetCount();


	/*echo "Size:", sizeof($sheet);

	echo var_dump($sheet);

	echo '<table><thead>';
	$columns = $sheet[1];
	foreach ( $columns as $column ) {
		echo '<th>'. $column .'</th>';
	}
	echo '</thead>';
	echo '<tbody>';
	for ( $i = 2; $i <= sizeof($sheet); $i++ ) {
		$vals = $sheet[$i];
		echo '<tr>';
		foreach ( $vals as $val ) {
			echo '<td>'. $val .'</td>';
		}
		echo '</tr>';
	}
	echo '</tbody>';
	echo '</table>';
}
/*
$inputFileName = './test.xlsx';
echo 'Loading file ',pathinfo($inputFileName,PATHINFO_BASENAME),' using IOFactory to identify the format<br />';
$objPHPExcel = PHPExcel_IOFactory::load($inputFileName);


echo '<hr />';

$sheetData = $objPHPExcel->getActiveSheet()->toArray(null,true,true,true);
//var_dump($sheetData);
*/
?>
<form method="post" enctype="multipart/form-data">
<input type="file" title="Select Excel File" name="excel_sheet" />
<input type="submit" name="submit">
</form>
</body>
</html>