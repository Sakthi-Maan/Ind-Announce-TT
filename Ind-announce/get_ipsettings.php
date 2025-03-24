<?php
require_once 'inc/connection.inc.php';

$query = "SELECT * FROM `setting_table`";
	//echo $query; 
	$query_run = mysqli_query($connection, $query);
	echo json_encode(mysqli_fetch_all($query_run,MYSQLI_ASSOC));
	
	?>