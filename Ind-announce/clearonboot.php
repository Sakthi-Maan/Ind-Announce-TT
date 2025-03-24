<?php
	include './inc/connection.inc.php';
	
	$query4 = "SELECT * FROM `setting_table` WHERE 1";
	$query_run4 = mysqli_query($connection, $query4);
	$query_row4 = mysqli_fetch_assoc($query_run4);
	if($query_row4['clearonboot']==1)
	{
		mysqli_query($connection,"DELETE FROM `assign_veh` WHERE 1");
	}
	
	
	
	mysqli_close($connection); 

?>
