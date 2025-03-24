<?php
require_once 'inc/connection.inc.php';
$ID=$_GET['ID'];

//$query ="UPDATE `events` SET `Text`='                                                                ',`Font`='2',`Color`='1',`Text_Size`='15',`Top`='0',`scroll`='1',`blink`='0' WHERE 1;";
$query ="SELECT * FROM `events` WHERE `id` = ".$ID.";";


	//echo $query; 
	$query_run = mysqli_query($connection, $query);
	echo json_encode(mysqli_fetch_all($query_run,MYSQLI_ASSOC));
	
	?>