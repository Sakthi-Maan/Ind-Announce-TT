<?php
require_once 'inc/connection.inc.php';
$len=$_GET['len'];

$query = "UPDATE `events` SET `show_text`=0 WHERE `id`>".$len." AND `Text`='                                                                '";
	echo $query; 
	//echo $len; 
	$query_run = mysqli_query($connection, $query);
	echo json_encode(mysqli_fetch_all($query_run,MYSQLI_ASSOC));
	
	?>