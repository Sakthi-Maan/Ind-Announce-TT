<?php
require_once 'inc/connection.inc.php';
$SS=$_GET['SS'];

// mysqli_query($connection, "UPDATE `additional_params` SET `CD`=1, `ST`=0 WHERE 1");

$query = "UPDATE `additional_params` SET `ser` = '0' WHERE 1";
	echo 'OK'; 
	$query_run = mysqli_query($connection, $query);
	
	?>