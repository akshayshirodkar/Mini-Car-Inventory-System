



<?php
//including the database connection file
include_once("classes/Database.php");

$database = new Database();
	$name = $_POST['name'];
	$car_model = $_POST['car_name'];
	$result = $database->execute_insert_update("SELECT * FROM model WHERE manufacturer_id = '".$car_model."' and model_name= '".$name."'","INSERT INTO model (manufacturer_id, model_name,total_count) VALUES ('".$car_model."','".$name."',1)");
	echo " Inserted Succefully ";
?>