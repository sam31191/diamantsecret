<!DOCTYPE html>
<html>
 
<head>   
</head>
<body>
<?php
include 'url/require.php';

$q = $pdo->prepare("SELECT * FROM `items`");
$q->execute();

$result = $q->fetchAll();

foreach ( $result as $item ) {
	echo var_dump ($item['image']);

	$update = $pdo->prepare("UPDATE `items` SET `image` = :newdelim WHERE `unique_key` = :key");
	$update->execute(array(":newdelim" => str_replace("|", ",", $item['image']), ":key" => $item['unique_key']));
}


$q = $pdo->prepare("SELECT * FROM `items`");
$q->execute();

foreach ( $result as $item ) {
	echo var_dump ($item['image']);
}
?>
</body>
</html>