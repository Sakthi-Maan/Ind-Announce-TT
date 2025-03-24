<?php  
require_once '../inc/connection.inc.php';
$target_path = "./";  
$target_path = $target_path.basename( $_FILES['fileToUpload']['name']);   
  
if(move_uploaded_file($_FILES['fileToUpload']['tmp_name'], $target_path)) 
{  
   
		$commands = file_get_contents($target_path);
	//echo $commands	;
		// Execute multi query
	if (mysqli_multi_query($connection,$commands ))
	{
		// mysqli_close($connection);
		echo "Backup restored successfully! Page will be redirected autometically!"; 

		
	}
	else
	{
		echo "Backup restored failed! Page will be redirected autometically!"; 
	}
	
} else{  
    echo "Sorry, file not uploaded, please try again!  Page will be redirected autometically!";  
}  

mysqli_close($connection);
$previous = "javascript:history.go(-1)";
//echo $_SERVER['HTTP_REFERER'];
if(isset($_SERVER['HTTP_REFERER'])) {
	header("refresh:3;url= " . $_SERVER["HTTP_REFERER"]);
}

?>  