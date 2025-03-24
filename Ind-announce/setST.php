<?php
require_once 'inc/connection.inc.php';

	$query = "SELECT * FROM `additional_params` WHERE 1";


	$query_run2 = mysqli_query($connection, $query);
	$query_row2 = mysqli_fetch_assoc($query_run2);

	
		mysqli_query($connection, "UPDATE `additional_params` SET `ST`=0 WHERE 1");
	
	?>