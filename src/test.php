<!DOCTYPE html>
<html>
 
<head>   
</head>
<body>
<form action="admin/pages/upload.php" method="post" enctype="multipart/form-data">
    Select image to upload:
    <input type="file" name="fileToUpload" id="fileToUpload">
    <br>
    <input type="text" name="name" >
    <input type="submit" value="Upload Image" name="submit">
</form>

<?php
include 'url/require.php';

$q = $pdo->prepare("SELECT * FROM `items` WHERE `item_name` = :id");
$q->execute(array(":id" => "New Item"));

$result = $q->fetch(PDO::FETCH_ASSOC);

$images = $result['image'];
$array = explode("|", $images);
echo var_dump($array[0]);
?>
</body>
</html>