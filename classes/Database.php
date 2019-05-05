<?php
include_once 'DbConfig.php';

class Database extends DbConfig
{
	public function __construct()
	{
		parent::__construct();
	}
	
	public function getData($query)
	{		
		$result = $this->connection->query($query);
		
		if ($result == false) {
			return false;
		} 
		
		$rows = array();
		
		while ($row = $result->fetch_assoc()) {
			$rows[] = $row;
		}
		
		return $rows;
	}
		
	public function execute($query) 
	{
		$result = $this->connection->query($query);
		
		if ($result == false) {
			echo 'Error: cannot execute the command';
			return false;
		} else {
			return true;
		}		
	}
	public function execute_insert_update($query,$query_2) 
	{
		$t_count;
		$t_car_id;
		$check=0;
		$result = $this->connection->query($query);
		$rows = array();
		if ($result->num_rows > 0) {
		while ($row = $result->fetch_assoc()) {
			$t_count=$row["total_count"];
			$t_count++;
			$t_car_id = $row["car_id"];
			$check=1;
		}
		}
		if ($check==0) {
		$result = $this->connection->query($query_2);
		} 
		else {
		$query="UPDATE model SET total_count= $t_count WHERE car_id = $t_car_id";
		$result = $this->connection->query($query);
		}		
	}
	
	
	public function escape_string($value)
	{
		return $this->connection->real_escape_string($value);
	}
}
?>
