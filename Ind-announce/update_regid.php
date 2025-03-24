<?php
require_once 'inc/connection.inc.php';
$id=$_GET['id'];
	
$query = "UPDATE `additional_params` SET `ST` = '1' WHERE `additional_params`.`id` = 1;";
//$query = "UPDATE `events` SET `show_text` = '".$val."' WHERE `events`.`id` = ".$id.";";
	//echo $query; 
	//mysqli_query($connection,"UPDATE `additional_params` SET `blink_speed`='".$_GET['bink_speed']."' WHERE 1" 
	$query_run = mysqli_query($connection, $query);
	echo json_encode(mysqli_fetch_all($query_run,MYSQLI_ASSOC));
	
	?>