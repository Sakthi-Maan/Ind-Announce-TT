<?php
ini_set('max_execution_time', 60);
require_once 'inc/connection.inc.php';

$dname=$_POST['dname'];

$vehno=$_POST['vehno'];
$a_contents="";

$query = "SELECT * FROM `audio` WHERE `d_name` LIKE '".$dname."'";
	//echo $query; 
	$query_run = mysqli_query($connection, $query);
	$ac=mysqli_fetch_all($query_run,MYSQLI_ASSOC);
$audio_contents['audio_content']="";
$from="";
//echo $query ."<br>";
//echo json_encode($ac);
$ac[0]['audio_content']="";
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

			// curl_exec() executes the started curl session
			// $output contains the output string
			$a_contents = curl_exec($curl);

			// close curl resource to free up system resources
			// (deletes the variable made by curl_init)
			curl_close($curl);
			if($a_contents==""){
			sleep(2);
			}
			}


			$audio_contents=json_decode($a_contents,true);
			if(!isset($audio_contents['audio_content'])){
			$audio_contents['audio_content']=$audio_contents['audioContent'];
			}
}
//echo $a_contents;
if($audio_contents['audio_content']!=""){
	
	$str1="INSERT INTO `assign_veh`(`vehno`, `dname`, `audio_content`) VALUES ('$vehno','$dname','".$audio_contents['audio_content']."') ";
  //  echo $str1;
	$query_run =  mysqli_query($connection, $str1);
		$str1="INSERT INTO `audio`( `d_name`, `audio_content`) VALUES ('$dname','".$audio_contents['audio_content']."') ";
  //  echo $str1;
	$query_run =  mysqli_query($connection, $str1);

	$previous = "javascript:history.go(-1)";
//echo $_SERVER['HTTP_REFERER'];
if(isset($_SERVER['HTTP_REFERER'])) 
{
	//header("refresh:5;url= " . $_SERVER["HTTP_REFERER"]);
	
}
echo "<script>alert('Driver name added successfully(".$from.")');history.go(-1);</script>";
}
else
{
echo "<script>alert('Audio generation failed');history.go(-1);</script>";
}

	//echo json_encode(mysqli_fetch_all($query_run,MYSQLI_ASSOC));

	
	?>