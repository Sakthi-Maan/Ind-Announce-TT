<?php
require_once 'inc/connection.inc.php';

$FS=$_GET['FS'];
$SS=$_GET['SS'];
$BR=$_GET['BR'];
$showlogo=$_GET['showlogo'];
$ST=$_GET['ST'];
$CD=$_GET['CD'];

$query ="UPDATE `additional_params` SET `blink_speed`='".$FS."',`scroll_speed`='".$SS."',`brightness`='".$BR."',`ST`='".$ST."',`showlogo`='".$showlogo."',`CD`='".$CD."' WHERE 1;";

	echo 'OK'; 
	echo $query; 
	$query_run = mysqli_query($connection, $query);
	
	?>