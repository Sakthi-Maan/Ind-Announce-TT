<?php
	include './inc/connection.inc.php';
	
	$query4 = "SELECT * FROM `setting_table` WHERE 1";
	$query_run4 = mysqli_query($connection, $query4);
	$query_row4 = mysqli_fetch_assoc($query_run4);
	
	mysqli_query($connection,"UPDATE `events` SET `show_text`='0' WHERE 1");
	mysqli_query($connection, "UPDATE `additional_params` SET `CD`=1, `ST`=0, `ser`=1 WHERE 1");
   
	mysqli_query($connection,"UPDATE `events` SET `Text`='                                                                ',`show_text`='0',`Font`='1',`Color`='7',`Text_Size`='15',`Top`='0',`scroll`='1',`blink`='0' WHERE 1");
	
	
	
	mysqli_close($connection); 

?>
