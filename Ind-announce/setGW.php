<?php
require_once 'inc/connection.inc.php';
$GW=$_GET['GW'];

$query ="UPDATE `setting_table` SET `gw`='".$GW."' WHERE 1;";

	echo 'OK'; 
	$query_run = mysqli_query($connection, $query);
	
	?>