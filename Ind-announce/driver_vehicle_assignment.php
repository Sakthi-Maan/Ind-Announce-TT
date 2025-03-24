<?php
ini_set('max_execution_time', 60);
require_once 'inc/connection.inc.php';

$dname=$_POST['dname'];

$vehno=$_POST['vehno'];

$skey=$_POST['skey'];
$data=array();
//echo $skey.'ssss ';
if($skey!="Magdyn@1234")
{
	$data['status']="failed";
	$data['download_status']= "Wrong Key!!!";
	echo json_encode($data);
	die();
}
$a_contents="";

$query = "SELECT * FROM `audio` WHERE `d_name` LIKE '".$dname."'";
	//echo $query; 
	$query_run = mysqli_query($connection, $query);
	$ac=mysqli_fetch_all($query_run,MYSQLI_ASSOC);
$audio_contents['audio_content']="";
$from="";
//echo $query ."<br>";
//echo json_encode($ac);
if($ac[0]['audio_content']!="")
{
	$audio_contents['audio_content']=$ac[0]['audio_content'];
	$from="Local";
}	
else
{
	$from="Web";
	//while($a_contents=="")
	{
		// create & initialize a curl session
	$curl = curl_init();

	// set our url with curl_setopt()
	curl_setopt($curl, CURLOPT_URL, "https://magdyn.in/IANC/get_anc_data.php?name=".urlencode($dname));

	// return the transfer as a string, also with setopt()
	curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 0); 
	curl_setopt($ch, CURLOPT_TIMEOUT, 400);

	// curl_exec() executes the started curl session
	// $output contains the output string
	$a_contents = curl_exec($curl);
	if($a_contents=="")
	{
		sleep(3);
	}
	//echo $a_contents;

	}
	$audio_contents=json_decode($a_contents,true);
	if(!isset($audio_contents['audio_content'])){
	$audio_contents['audio_content']=$audio_contents['audioContent'];
	}
}

//echo $a_contents;
if($audio_contents['audio_content']!=""){
	$query = "SELECT * FROM `assign_veh` WHERE `vehno` LIKE '".$vehno."'";
	//echo $query; 
	$query_run = mysqli_query($connection, $query);
	$rowcount=mysqli_num_rows($query_run);
	
	if($rowcount==0)
	{
	$str1="INSERT INTO `assign_veh`(`vehno`, `dname`, `audio_content`) VALUES ('$vehno','$dname','".$audio_contents['audio_content']."') ";
  //  echo $str1;
	$query_run =  mysqli_query($connection, $str1);
		
	}
	else
	{
	$str1="UPDATE `assign_veh` SET `dname`='$dname',`audio_content`='".$audio_contents['audio_content']."' WHERE `vehno` like '$vehno' ";
  //  echo $str1;
	$query_run =  mysqli_query($connection, $str1);
		
	}
	
	//$str1="INSERT INTO `audio`( `d_name`, `audio_content`) VALUES ('$dname','".$audio_contents['audio_content']."') ";
  //  echo $str1;
	//$query_run =  mysqli_query($connection, $str1);
	$previous = "javascript:history.go(-1)";
//echo $_SERVER['HTTP_REFERER'];
if(isset($_SERVER['HTTP_REFERER'])) 
{
	//header("refresh:5;url= " . $_SERVER["HTTP_REFERER"]);
	
}
 

$data['status']="success";
	$data['download_status']= "Driver name added successfully(".$from.")";
	echo json_encode($data);
	
}
else
{

$data['status']="failed";
	$data['download_status']= "Audio generation failed";
	echo json_encode($data);
}


// close curl resource to free up system resources
// (deletes the variable made by curl_init)
curl_close($curl);
	//echo json_encode(mysqli_fetch_all($query_run,MYSQLI_ASSOC));

	
	?>