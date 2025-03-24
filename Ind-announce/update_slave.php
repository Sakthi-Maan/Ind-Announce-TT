<?php
require_once 'inc/connection.inc.php';
$id=$_GET['servip'];
$val=$_GET['ctrlreg'];
$regid=$_GET['RegID'];
$reglen=$_GET['RegLen'];
$Modenable=$_GET['Modenable'];
	
$query = "UPDATE setting_table SET servip='".$id."',RegID=".$regid.",RegLen=".$reglen.",Modenable=".$Modenable." WHERE 1";

//$query = "UPDATE `events` SET `regid` = ".$val." WHERE `events`.`id` = ".$id.";";
//$query = "UPDATE `events` SET `show_text` = '".$val."' WHERE `events`.`id` = ".$id.";";
	echo $query; 
	//mysqli_query($connection,"UPDATE `additional_params` SET `blink_speed`='".$_GET['bink_speed']."' WHERE 1" 
	$query_run = mysqli_query($connection, $query);
	echo json_encode(mysqli_fetch_all($query_run,MYSQLI_ASSOC));
	
	?>