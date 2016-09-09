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


include '../url/require.php';
$array = [
[ 1,  'Austria', 		20],
[ 2,  'Belgium', 		21],
[ 3,  'Bulgaria', 		20],
[ 4,  'Croatia', 		25],
[ 5,  'Cyprus', 		19],
[ 6,  'Czech Republic', 21], 
[ 7,  'Denmark', 		25],
[ 8,  'Estonia', 		20],
[ 9,  'Finland', 		24],
[ 10,  'France', 		20],
[ 11,  'Germany', 		19],
[ 12,  'Greece', 		23],
[ 13,  'Hungary', 		27],
[ 14,  'Ireland', 		23],
[ 15,  'Italy', 		22],
[ 16,  'Latvia', 		21],
[ 17,  'Lithuania', 	21],
[ 18,  'Luxembourg', 	17],
[ 19,  'Malta', 		18],
[ 20,  'Netherlands', 	21],
[ 21,  'Poland', 		23],
[ 22,  'Portugal', 		23],
[ 23,  'Romania', 		20],
[ 24,  'Slovakia', 		20],
[ 25,  'Slovenia', 		22],
[ 26,  'Spain', 		21],
[ 27,  'Sweden', 		25],
[ 28,  'UK', 			20],
];

//echo var_dump($array);

foreach ( $array as $entry ) {
	$enterVat = $pdo->prepare("INSERT INTO `country_vat` (`id`, `country_name`, `vat`) VALUES (:1, :2, :3)");
	$enterVat->execute(array(":1" => $entry[0], ":2" => $entry[1], ":3" => $entry[2]));
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
	] else {
		echo var_dump($productSheet->toArray(null, true, true, true));
	]


	//$sheets = $xl->getSheetCount();


	/*echo "Size:", sizeof($sheet);

	echo var_dump($sheet);

	echo '<table><thead>';
	$columns = $sheet[1];
	foreach ( $columns as $column ) {
		echo '<th>'. $column .'</th>';
	]
	echo '</thead>';
	echo '<tbody>';
	for ( $i = 2; $i <= sizeof($sheet); $i++ ) {
		$vals = $sheet[$i];
		echo '<tr>';
		foreach ( $vals as $val ) {
			echo '<td>'. $val .'</td>';
		]
		echo '</tr>';
	]
	echo '</tbody>';
	echo '</table>';
]
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



<script src="../js/jquery-1.12.0.js"></script>
<script>

$(document).ready(
	function() {
		for ( i = 0; i < 10; i++) {
			setTimeout(function(){
				console.log(i);
			], 1000);
		]
	]
);

function doShit(i){
	console.log(i);
]

</script>