p<?php
require_once 'inc/connection.inc.php';
$ID=$_GET['ID'];
$TX=$_GET['TX'];
$FT=$_GET['FT'];
$CL=$_GET['CL'];
$SZ=$_GET['SZ'];
$TP=$_GET['TP'];
$SC=$_GET['SC'];
$FL=$_GET['FL'];
$FS=$_GET['FS'];

mysqli_query($connection, "UPDATE `additional_params` SET `CD`=1, `ST`=0 WHERE 1");
	$TX = str_replace( "'", "\'" , $TX);
	$query ="UPDATE `events` SET `Text`='".$TX."',`Font`='".$FT."',`FontStyle`='".$FS."',`Color`='".$CL."',`Text_Size`='".$SZ."',`Top`='".$TP."',`scroll`='".$SC."',`blink`='".$FL."' WHERE `id`='".$ID."';";


	echo $query; 
	$query_run = mysqli_query($connection, $query);
	
	?>