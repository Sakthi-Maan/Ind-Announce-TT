<?php
$master=$_GET['master'];
$id=$_GET['id']; //
$reg=100+(($id*40)-39);
$scroll=$_GET['scroll'];

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

//------------------------------------SCROLL-----------------------------------------//

if ( $scroll=="YE"||$scroll=="NO")
{
	$contorl=$contorl+1;
}

else {echo "Scroll can only be YE or NO<br/>";}

//-----------------------------------------------------------------------------------//

if($contorl==3)
{
	exec('python Scroll.py '.$id." ".$scroll, $retval);
	// echo'python Scroll.py '.$id." ".$scroll."<br/>";	
	exec('python dbinit.py '.$reg, $retval);
	echo'done '."<br/>";
}

else {die("Fix above errors");}

?>