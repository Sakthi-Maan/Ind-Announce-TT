<?php
require_once 'inc/connection.inc.php';
$IP=$_GET['IP'];
$ST=$_GET['ST'];

$query ="UPDATE `setting_table` SET `ip`='".$IP."',`staticip` = '".$ST."' WHERE 1;";

	echo 'OK'; 
	$query_run = mysqli_query($connection, $query);
	
	?>

