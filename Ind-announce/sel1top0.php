<?php
require_once 'inc/connection.inc.php';
$query = "SELECT * FROM `additional_params` WHERE 1" ;
	$query_run = mysqli_query($connection, $query);
	$addlparam=mysqli_fetch_all($query_run,MYSQLI_ASSOC);

$query = "SELECT * FROM `events` WHERE `show_text`=1 AND `Top`=0" ;
	//echo $query; 
	//mysqli_query($connection,"UPDATE `additional_params` SET `blink_speed`='".$_GET['bink_speed']."' WHERE 1"
	$query_run = mysqli_query($connection, $query);
	
	$jsonarr=mysqli_fetch_all($query_run,MYSQLI_ASSOC);
	
	$cnt=count($jsonarr);


if ($cnt>2)
{
	$query = "SELECT * FROM `events` WHERE `show_text`=1 AND `Top`=0 AND `id`>".$addlparam[0]['rotstat'] ;
		//echo $query; 
		//mysqli_query($connection,"UPDATE `additional_params` SET `blink_speed`='".$_GET['bink_speed']."' WHERE 1"
		$query_run = mysqli_query($connection, $query);


		$jsonarr=mysqli_fetch_all($query_run,MYSQLI_ASSOC);
		echo json_encode($jsonarr);
}
else
{
	$query = "SELECT * FROM `events` WHERE `show_text`=1 AND `Top`=0";
		//echo $query; 
		//mysqli_query($connection,"UPDATE `additional_params` SET `blink_speed`='".$_GET['bink_speed']."' WHERE 1"
		$query_run = mysqli_query($connection, $query);


		$jsonarr=mysqli_fetch_all($query_run,MYSQLI_ASSOC);
		//echo $jsonarr[0]['Text'];
		echo urldecode(json_encode($jsonarr,JSON_UNESCAPED_UNICODE|JSON_UNESCAPED_SLASHES));
}
	?>

