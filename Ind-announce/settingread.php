<?php
require_once 'inc/connection.inc.php';

$query = "SELECT * FROM `setting_table` WHERE 1";
	//echo $query; 
	//mysqli_query($connection,"UPDATE `additional_params` SET `blink_speed`='".$_GET['bink_speed']."' WHERE 1" 
	$query_run = mysqli_query($connection, $query);
	echo json_encode(mysqli_fetch_all($query_run,MYSQLI_ASSOC));
	
	?>