<?php
require_once 'inc/connection.inc.php';

$query = "UPDATE `additional_params` SET `logostat`= CASE WHEN logostat = 0 THEN 1 ELSE 0 END WHERE 1";
	//echo $query; 
	//mysqli_query($connection,"UPDATE `additional_params` SET `blink_speed`='".$_GET['bink_speed']."' WHERE 1" 
	$query_run = mysqli_query($connection, $query);
	echo json_encode(mysqli_fetch_all($query_run,MYSQLI_ASSOC));
	 
	?>