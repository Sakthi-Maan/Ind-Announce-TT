<?php
require_once 'inc/connection.inc.php';
$vehno=$_GET['vehno'];
	{
		$query = "SELECT * FROM `assign_veh` WHERE `vehno` LIKE '%$vehno%'";
	}
	//echo $query; 
	$query_run = mysqli_query($connection, $query);
	echo json_encode(mysqli_fetch_all($query_run,MYSQLI_ASSOC));
	
	?>