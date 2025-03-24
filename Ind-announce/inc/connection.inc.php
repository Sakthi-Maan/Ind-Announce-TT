<?php
	$connect_error = 'Could not connect';
	$mysql_host = 'localhost';
	$mysql_user = 'led';
	$mysql_pass = 'ledled';
	$mysql_data = 'led';
	
	if(!@$connection = mysqli_connect($mysql_host , $mysql_user , $mysql_pass ,$mysql_data))
		die($connect_error);
?>