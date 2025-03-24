<?php
	include 'inc/connection.inc.php';
	echo $_GET['brightness'];
	echo 'sudo sh change_hostname.sh ';
	if(isset($_POST['ipaddr']))
	{
		$ipaddr=$_POST['ipaddr'];
		$netmask=$_POST['netmask'];
		$gw=$_POST['gw'];
		$dbname=$_POST['dbname'];
		
		$cob=$_POST['cob'];
		if(isset($_POST['devicename']))
		{
			$query = "SELECT * FROM `setting_table`";
				//echo $query; 
				$query_run = mysqli_query($connection, $query);
				$ogdev=(mysqli_fetch_all($query_run,MYSQLI_ASSOC));
				
			$devicename=$_POST['devicename'];
			if ($ogdev[0]['devicename']==$devicename)
			{
				mysqli_query($connection,"UPDATE `setting_table` SET `ip`='$ipaddr',`devicename`='$devicename', `netmask`='$netmask', `gw`='$gw',`staticip`='$dbname', `clearonboot` = '$cob' WHERE 1");
				// echo system('sudo sh change_hostname.sh '.$_GET['devicename']);
				echo 'sudo sh change_hostname.sh '.$_GET['devicename'];
			}
			else
			{
				mysqli_query($connection,"UPDATE `setting_table` SET `ip`='$ipaddr',`devicename`='$devicename', `netmask`='$netmask', `gw`='$gw',`staticip`='$dbname', `clearonboot` = '$cob', `bob` = 1 WHERE 1");
				// echo system('sudo sh change_hostname.sh '.$_GET['devicename']);
				echo 'sudo sh change_hostname.sh '.$_GET['devicename'];
			}
		} 
		else 
		{
			mysqli_query($connection,"UPDATE `setting_table` SET `ip`='$ipaddr', `netmask`='$netmask', `gw`='$gw',`staticip`='$dbname', `clearonboot` = '$cob' WHERE 1");
		}
	}
	if(isset($_GET['brightness']))
	{
	//system('python Params.py BR '.str_pad($_GET['brightness'], 2, '0', STR_PAD_LEFT));
	mysqli_query($connection,"UPDATE `additional_params` SET `brightness`='".$_GET['brightness']."' WHERE 1");
	
	}
	if(isset($_GET['scroll_speed']))
	{
	//system('python Params.py SR '.str_pad($_GET['scroll_speed'], 2, '0', STR_PAD_LEFT));	
		mysqli_query($connection,"UPDATE `additional_params` SET `scroll_speed`='".$_GET['scroll_speed']."' WHERE 1");

	}
	if(isset($_GET['showlogo']))
	{
	//system('python Params.py showlogo 00');	
		mysqli_query($connection,"UPDATE `additional_params` SET `showlogo`='".$_GET['showlogo']."' WHERE 1");

	}
	if(isset($_GET['selftest']))
	{
	//system('python Params.py ST 00');	
		mysqli_query($connection,"UPDATE `additional_params` SET `ST`='".$_GET['selftest']."' WHERE 1");

	}
	if(isset($_GET['clear']))
	{
	//system('python Params.py CL 00');	
		mysqli_query($connection,"UPDATE `additional_params` SET `CD`='".$_GET['clear']."' WHERE 1");
	}
	if(isset($_GET['bink_speed']))
	{
	//system('python Params.py FL '.str_pad($_GET['bink_speed'], 2, '0', STR_PAD_LEFT));
		mysqli_query($connection,"UPDATE `additional_params` SET `blink_speed`='".$_GET['bink_speed']."' WHERE 1");

echo 'python Params.py FL '.str_pad($_GET['bink_speed'], 2, '0', STR_PAD_LEFT);	
	}
	mysqli_close($connection);

?>