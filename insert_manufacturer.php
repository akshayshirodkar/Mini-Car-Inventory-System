



<?php
//including the database connection file
include_once("classes/Database.php");

$database = new Database();
	$name = $_POST['name'];
	$result = $database->execute("INSERT INTO `manufacturer` (`manufacturer_name`) VALUES ('$name')");
	echo "Inserted Succefully ";
?>