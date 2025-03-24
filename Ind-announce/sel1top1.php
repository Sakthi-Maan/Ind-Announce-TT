<?php
require_once 'inc/connection.inc.php';

$query = "SELECT * FROM `events` WHERE `show_text`=1 AND `Top`=1";
	//echo $query; 
	$query_run = mysqli_query($connection, $query);
	echo json_encode(mysqli_fetch_all($query_run,MYSQLI_ASSOC),JSON_UNESCAPED_UNICODE|JSON_UNESCAPED_SLASHES);
	
	?>