<?php
$master=$_GET['master'];
$id=$_GET['id'];
$Top=$_GET['Top'];

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

//-------------------------------------TOP-------------------------------------------//

if ( $Top=="YE"||$Top=="NO")
{
	$contorl=$contorl+1;
}

else {echo "Top can only be YE or NO<br/>";}

//-----------------------------------------------------------------------------------//

if($contorl==3)
{
	exec('python Top.py '.$id." ".$Top, $retval);
	// echo'python Top.py '.$id." ".$Top."<br/>";	
	exec('python dbinit.py '.$reg, $retval);
	echo'done '."<br/>";
}

else {die("Fix above errors");}

?>  
