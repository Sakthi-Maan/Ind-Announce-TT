<?php
require_once 'inc/connection.inc.php';
$ip=$_GET['ip'];
$query = "UPDATE `setting_table` SET `ip`='$ip',`bob` = 0 WHERE 1";
	echo 'OK'; 
	$query_run = mysqli_query($connection, $query);
	//echo json_encode(mysqli_fetch_all($query_run,MYSQLI_ASSOC));
	
	?>