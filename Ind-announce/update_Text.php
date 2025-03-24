<?php
require_once 'inc/connection.inc.php';
$id=$_GET['line_no'];

$last_line = exec("ip -4 addr show eth0 | grep -oP '(?<=inet\s)\d+(\.\d+){3}'", $retval);
$ip= $retval[0];

if($ip=="10.10.10.10")
	{
		$id=$id+128;
	}
		

$pri = array("EN", "EB", "HN", "HB","RN","RB");
$dept = array("RE","BL","GR","YE","MA","CY","WH");
$text=str_replace("_"," ",$_GET['text']);
$show_text=$_GET['show_text'];
if($show_text=='YE')
{
	$show_text=1;
}
else
{
	$show_text=0;
}
$Top=$_GET['top'];
if($Top=='YE')
{
	$Top=1;
}
else
{
	$Top=0;
}
$blink=$_GET['blink'];
if($blink=='YE')
{
	$blink=1;
}
else
{
	$blink=0;
}
$scroll=$_GET['scroll'];
if($scroll=='YE')
{
	$scroll=1;
}
else
{
	$scroll=0;
}
$Font=array_search($_GET['font'],$pri);
$Color=array_search($_GET['color'],$dept);
$Text_Size=$_GET['text_size'];
$query = "UPDATE `events` SET `Text`='".$text."',`show_text`='".$show_text."',`Font`='".($Font+1)."',`Color`='".($Color+1)."',`Text_Size`='".$Text_Size."',`Top`='".$Top."',`blink`='".$blink."',`scroll`='".$scroll."' WHERE `id`=".$id;
	echo $query."---"; 
	$query_run = mysqli_query($connection, $query);
	
	?>