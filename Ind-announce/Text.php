<?php
$master=$_GET['master'];
$id=$_GET['id'];
$reg=100+(($id*40)-39);
$Text=$_GET['Text'];
$Font=$_GET['Font'];
$Size=$_GET['Size'];
$Colour=$_GET['Colour'];

$contorl=0;

//------------------------------------MASTER-------------------------------------------//

if ( $master=="magdynpwd2015")
{
	$contorl=$contorl+1;
}

else {echo "Master password incorrect. <br/>";}

//-----------------------------------LINE-ID-----------------------------------------//

if ( filter_var($id, FILTER_VALIDATE_INT) === false )
{
	echo "Line ID must be an integer<br/>";
}

else
{
	if ($id>=1&&$id<=128)
	{
	    $contorl=$contorl+1;
	    $reg=100+(($id*40)-39);
	}
	else {echo "Line ID must be between 1 and 128<br/>";}
}

//-----------------------------------TEXT--------------------------------------------//

if (strlen($Text)<=64)
{
	$txt= str_pad($Text, 64, "_", STR_PAD_RIGHT);
	$strr=str_replace(" ", "_", $txt);
	$contorl=$contorl+1;
}

else{echo "Invalid Text<br/>";}

//-----------------------------------FONT--------------------------------------------//

if ($Font=="EN"||$Font=="EB"||$Font=="HN"||$Font=="HB"||$Font=="RN"||$Font=="RB")
{
	$contorl=$contorl+1;
}

else{echo "Invalid Font<br/>";}

//-----------------------------------COLOUR-----------------------------------------//

if ($Colour=="RE"||$Colour=="GR"||$Colour=="BL"
	||$Colour=="YE"||$Colour=="MA"||$Colour=="CY"||$Colour=="WH")
{
	$contorl=$contorl+1;
}

else{echo "Invalid Colour<br/>";}

//-----------------------------------SIZE--------------------------------------------//

if ( filter_var($Size, FILTER_VALIDATE_INT) === false )
{
	echo "Font size must be an integer<br/>";
}

else
{
	if ($Size>=10&&$Size<=30){$contorl=$contorl+1;}
	else {echo "Font size must be between 10 and 30<br/>";}
}

//-----------------------------------------------------------------------------------//

if ($contorl==6)
{
	exec('python Text.py '.$id." ".$strr." ".$Font." ".$Size." ".$Colour, $retval);
	// echo'python Text.py '.$id." ".$strr." ".$Font." ".$Size." ".$Colour."<br/>";	
	exec('python dbinit.py '.$reg, $retval);
	echo'done '."<br/>";
}

else {die("Fix above errors");}

?>  
