<?php
require_once 'inc/connection.inc.php';
$BR=$_GET['BR'];

mysqli_query($connection, "UPDATE `additional_params` SET `CD`=1, `ST`=0 WHERE 1");

$query = "UPDATE `additional_params` SET `brightness`='".$BR."' WHERE 1;";
	echo 'OK'; 
	$query_run = mysqli_query($connection, $query);
	
	?>