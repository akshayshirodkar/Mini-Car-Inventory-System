

<?php
//including the database connection file
include_once("classes/Database.php");

$database = new Database();
	$name = $_POST['name'];
	$copy_count_val = $_POST['copy_count_val'];
	if($copy_count_val>1)
	{
		$copy_count_val=$copy_count_val-1;
			$result = $database->execute("UPDATE model SET total_count=".$copy_count_val." WHERE car_id = $name");
	}
	else
	{
		$result = $database->execute("DELETE FROM model WHERE car_id = $name");
	}
	echo "Operation Succefull";
?>