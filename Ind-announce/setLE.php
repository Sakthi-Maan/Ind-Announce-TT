<?php
require_once 'inc/connection.inc.php';
$ID=$_GET['ID'];
$LE=$_GET['LE'];

mysqli_query($connection, "UPDATE `additional_params` SET `CD`=1, `ST`=0 WHERE 1");

	if ($ID == "A")
	{
		$query ="UPDATE `events` SET `show_text`='".$LE."' WHERE  1;";

		echo 'OK'; 
		$query_run = mysqli_query($connection, $query);
	}
	
	else 
	{
		$query ="UPDATE `events` SET `show_text`='".$LE."' WHERE  `id`='".$ID."';";

		echo 'OK'; 
		$query_run = mysqli_query($connection, $query);
	}
?>