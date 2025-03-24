<?php
	$id=$_GET['eventid'];
	date_default_timezone_set('Asia/Kolkata');
//echo date('d-m-Y H:i');
	$time=date('Y-m-d H:i:s');
	$type=$_GET['type'];
	include 'inc/connection.inc.php';
	if($type=="start")
	{
		$query_run = mysqli_query($connection, "INSERT INTO `timer` (`SNO`, `task_id`, `starttime`, `endtime`) VALUES (NULL, '$id', '$time', NULL);");
		echo "OK";
	}
	else if($type=="stop")
	{
		$query_run = mysqli_query($connection, "SELECT * FROM `timer` WHERE `task_id`='$id' and `endtime` IS NULL");
		$query_row = mysqli_fetch_assoc($query_run);
		//echo "UPDATE `timer` SET  `endtime`='$time' where `SNO`=".$query_row['SNO'].";";
		$query_run = mysqli_query($connection, "UPDATE `timer` SET  `endtime`='$time' where `SNO`=".$query_row['SNO'].";");
		echo "OK";
		
	
	}
?>
