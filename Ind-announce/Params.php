<?php
$master=$_GET['master'];
$reg=1;
$param=$_GET['param']; 
$val=$_GET['val'];

$contorl=0;

//------------------------------------MASTER-------------------------------------------//

if ( $master=="magdynpwd2015")
{
	$contorl=$contorl+1;
}

else {echo "Master password incorrect. <br/>";}

//-----------------------------------LINE-ID-----------------------------------------//

if ($param=="SR"||$param=="FL"||$param=="BR")
{
	if ( filter_var($val, FILTER_VALIDATE_INT) === false )
	{
		echo "Value must be an integer<br/>";
	}

	else
	{
		if ($val>=1&&$val<=10)
		{
			if (strlen($val)<2){$val=str_pad($val, 2, "0", STR_PAD_LEFT);}
			$contorl=$contorl+1;
		}
		else {echo "Value must be between 1 and 10<br/>";}
	}
	
	$contorl=$contorl+1;
}

else if ($param=="ST"||$param=="CL"){$contorl=$contorl+1;}

else {echo "Invalid parameter<br/>";}

//-----------------------------------------------------------------------------------//

if($contorl==3)
{
	exec('python Params.py '.$param." ".$val, $retval);
	// echo'python Params.py '.$param." ".$val."<br/>";	
	exec('python dbinit.py '.$reg, $retval);
	echo'python dbinit.py '.$reg."<br/>";
}

else if($contorl==2)
{
	exec('python Params.py '.$param." ".$param, $retval);
	// echo'python Params.py '.$param." ".$param."<br/>";	
	exec('python dbinit.py '.$reg, $retval);
	echo'done '."<br/>";
}

else {die("Fix above errors");}

?>