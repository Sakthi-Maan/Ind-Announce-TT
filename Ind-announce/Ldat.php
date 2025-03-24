<?php
require_once 'inc/connection.inc.php';
$ID=$_GET['ID'];
$LE=$_GET['LE'];
$TX=$_GET['TX'];
$FT=$_GET['FT'];
$CL=$_GET['CL'];
$SZ=$_GET['SZ'];
$TP=$_GET['TP'];
$SC=$_GET['SC'];
$FL=$_GET['FL'];
$FS=$_GET['FS'];

$query ="UPDATE `events` SET `Text`='".$TX."',`show_text`='".$LE."',`Font`='".$FT."',`Color`='".$CL."',`Text_Size`='".$SZ."',`Top`='".$TP."',`scroll`='".$SC."',`blink`='".$FL."',`FontStyle`='".$FS."' WHERE `id`='".$ID."';";


	echo $query; 
	$query_run = mysqli_query($connection, $query);
	
	$query ="UPDATE `events` SET `show_text`='1' WHERE `id`<'4';";


	echo $query; 
	$query_run = mysqli_query($connection, $query);
	
	
	
	?>