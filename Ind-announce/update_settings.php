<?php
require_once 'inc/connection.inc.php';

$query = "UPDATE `additional_params` SET `blink_speed`='".$_GET['blink']."',`scroll_speed`='".$_GET['scroll']."',`brightness`='".$_GET['brightness']."' WHERE 1";
	echo $query."---"; 
	$query_run = mysqli_query($connection, $query);
	
	?>