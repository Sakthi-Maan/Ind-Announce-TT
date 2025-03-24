<?php
require_once 'inc/connection.inc.php';
$SN=$_GET['SN'];

$query ="UPDATE `setting_table` SET `netmask`='".$SN."' WHERE 1;";

	echo 'OK'; 
	$query_run = mysqli_query($connection, $query);
	
	?>