<?php
require_once 'inc/connection.inc.php';
$IP=$_GET['IP'];
$ID=$_GET['ID'];
$LEN=$_GET['LEN'];
$ME=$_GET['ME'];

$query ="UPDATE `setting_table` SET `servip`='".$IP."',`RegID`='".$ID."',`RegLen`='".$LEN."',`Modenable`='".$ME."' WHERE 1;";

	echo 'OK'; 
	$query_run = mysqli_query($connection, $query);
	
	?>