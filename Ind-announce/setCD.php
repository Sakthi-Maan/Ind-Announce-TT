<?php
require_once 'inc/connection.inc.php';

//$query = "SELECT * FROM `events` WHERE `show_text`=1 AND `Top`=1";
	//echo $query; 
	//mysqli_query($connection,"UPDATE `additional_params` SET `blink_speed`='".$_GET['bink_speed']."' WHERE 1"
	//SELECT * FROM `events` WHERE `show_text`=1 AND `Top`=1
	mysqli_query($connection, "UPDATE `additional_params` SET `ST`=0 WHERE 1");
	$query ="UPDATE `events` SET `show_text`='0' WHERE 1;";
	mysqli_query($connection, $query);
	//echo json_encode(mysqli_fetch_all($query_run,MYSQLI_ASSOC));
	
	?>