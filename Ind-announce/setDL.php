<?php
require_once 'inc/connection.inc.php';
$ID=$_GET['ID'];

mysqli_query($connection, "UPDATE `additional_params` SET `CD`=1, `ST`=0 WHERE 1");

	if ($ID == "A")
	{
		$query ="UPDATE `events` SET `Text`='                                                                ',`Font`='1',`Color`='7',`Text_Size`='15',`Top`='0',`scroll`='1',`blink`='0' WHERE 1;";


		echo 'OK'; 
		$query_run = mysqli_query($connection, $query);
	}
	
	else
	{
		$query ="UPDATE `events` SET `Text`='                                                                ',`Font`='1',`Color`='7',`Text_Size`='15',`Top`='0',`scroll`='1',`blink`='0' WHERE `id`='".$ID."';";


		echo 'OK'; 
		$query_run = mysqli_query($connection, $query);
	}
	
	
	?>