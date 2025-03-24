<?php
require_once '../inc/connection.inc.php';


	$query2 = "SELECT * FROM `additional_params` WHERE 1";
	$query_run2 = mysqli_query($connection, $query2);
	$query_row2 = mysqli_fetch_assoc($query_run2);
	$query4 = "SELECT * FROM `setting_table` WHERE 1";
	$query_run4 = mysqli_query($connection, $query4);
	$query_row4 = mysqli_fetch_assoc($query_run4);

	$query = "UPDATE `additional_params` SET `blink`='".$query_row2['blink']."',`blink_speed`='".$query_row2['blink_speed']."',`showlogo`='".$query_row2['showlogo']."',`scroll`='".$query_row2['scroll']."',`scroll_speed`='".$query_row2['scroll_speed']."',`brightness`='".$query_row2['brightness']."',`ST`='".$query_row2['ST']."',`CD`='".$query_row2['CD']."',`rotstat`='".$query_row2['rotstat']."' WHERE `id`=1;";
	echo $query.""; 
	
	$query = "UPDATE `setting_table` SET `clearonboot`='".$query_row4['clearonboot']."',`bob`='".$query_row4['bob']."',`servip`='".$query_row4['servip']."' WHERE `id`=1;";
	echo $query.""; 
	$query = "SELECT * FROM `events` WHERE 1 order by id asc";

	if($query_run = mysqli_query($connection, $query)){
		
		while($query_row = mysqli_fetch_assoc($query_run)){
			
			$query = "UPDATE `events` SET `Text`='".$query_row['Text']."',`show_text`='".$query_row['show_text']."',`Font`='".$query_row['Font']."',`Color`='".$query_row['Color']."',`Text_Size`='".$query_row['Text_Size']."',`Top`='".$query_row['Top']."',`scroll`='".$query_row['scroll']."',`blink`='".$query_row['blink']."',`regid`='".$query_row['regid']."' WHERE `id`='".$query_row['id']."';";
			echo $query.""; 
			
			
			
			
		}
	}


?>