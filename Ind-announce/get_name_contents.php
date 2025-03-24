<?php
require_once 'inc/connection.inc.php';
$vehno=$_GET['dname'];
	{
		$query = "SELECT * FROM `audio` WHERE `d_name` LIKE '%$vehno%'";
	}
	//echo $query; 
	$query_run = mysqli_query($connection, $query);
	echo json_encode(mysqli_fetch_all($query_run,MYSQLI_ASSOC));
	
	?>