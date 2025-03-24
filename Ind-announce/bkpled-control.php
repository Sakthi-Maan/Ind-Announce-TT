<?php

exec("python initmod.py");
require_once 'inc/connection.inc.php';
require_once 'inc/header.func.inc.php';
$last_line = exec("ip -4 addr show eth0 | grep -oP '(?<=inet\s)\d+(\.\d+){3}'", $retval);
$ip= $retval[0];
$complition_tick = array(
	"cross.png",
	"tick.png"
);

if(!loggedin())
	header('Location: login.php');
$error_messages = array(
	"Incorrect Date. Please Enter a Valid Date",
	"Could Not Perform The Specified Action. Please Try Again.",
	"Could Not Load your event list. Please Try Again.",
	"You Can Edit only one Task at a Time.",
	"Select Atleast one Task to perform This Task"
);

$months = array("January","February","March","April","May","June","July","August","September","October","November","December");
$edit_flag = 0;
$no_task_flag = 0;
$userID = $_SESSION['uid'];

include('inc/header.inc.php');
include('inc/navbar.inc.php');
?>
<style>
table {
}
table td {
  word-wrap: break-word;
  max-width: 50%;
}
#example td {
  white-space:inherit;
}
@media only screen and (max-width: 700px) {
body .modal-dialog {
    width: 600px;
    margin-top: -35px;
	margin-left: -138px;
  }
  table td {
  word-wrap: break-word;
  max-width: 10%;
}
}
</style>
<style>

@font-face {
  font-family: engnormal;
  src: url("./truetype/ttfrasp/arial-unicode-ms.ttf");
   max-width: 64ch;
}
@font-face {
  font-family: engbold;
  src: url("./truetype/ttfrasp/Arial-Unicode-Bold.ttf");
   max-width: 64ch;
}
@font-face {
  font-family: hinnormal;
  src: url("./truetype/ttfrasp/AVFHIN1N.TTF");
   max-width: 64ch;
}
@font-face {
  font-family: hinbold;
  src: url("./truetype/ttfrasp/AVFHIN1B.TTF");
   max-width: 64ch;
}
@font-face {
  font-family: tamilnormal;
  src: url("./truetype/ttfrasp/AVFTAM1N.TTF");
  max-width: 64ch;
}
@font-face {
  font-family: tamilbold;
  src: url("./truetype/ttfrasp/AVFTAM1B.TTF");
  max-width: 64ch;
}
@font-face {
  font-family: telnormal;
  src: url("./truetype/ttfrasp/AVFTEL1N.TTF");
  max-width: 64ch;
}
@font-face {
  font-family: telbold;
  src: url("./truetype/ttfrasp/AVFTEL1B.TTF");
  max-width: 64ch;
}
@font-face {
  font-family: bennormal;
  src: url("./truetype/ttfrasp/AVFBEN1N.TTF");
  max-width: 64ch;
}
@font-face {
  font-family: benbold;
  src: url("./truetype/ttfrasp/AVFBEN1B.TTF");
  max-width: 64ch;
}
@font-face {
  font-family: gujnormal;
  src: url("./truetype/ttfrasp/AVFGUJ1N.TTF");
  max-width: 64ch;
}
@font-face {
  font-family: gujbold;
  src: url("./truetype/ttfrasp/AVFGUJ1B.TTF");
  max-width: 64ch;
}
@font-face {
  font-family: kannormal;
  src: url("./truetype/ttfrasp/AVFKAN1N.TTF");
  max-width: 64ch;
}
@font-face {
  font-family: kanbold;
  src: url("./truetype/ttfrasp/AVFKAN1B.TTF");
  max-width: 64ch;
}
@font-face {
  font-family: malnormal;
  src: url("./truetype/ttfrasp/AVFMAL1N.TTF");
  max-width: 64ch;
}
@font-face {
  font-family: malbold;
  src: url("./truetype/ttfrasp/AVFMAL1B.TTF");
  max-width: 64ch;
}
@font-face {
  font-family: sinnormal;
  src: url("./truetype/ttfrasp/AVFSIN1N.TTF");
  max-width: 64ch;
}
@font-face {
  font-family: sinbold;
  src: url("./truetype/ttfrasp/AVFSIN1B.TTF");
  max-width: 64ch;
}



.font1 {
  font-family: engnormal;
  font-size:1.5em;
}
.font2 {
  font-family: hinnormal;
  font-size:1.5em;
}
.font3 {
  font-family: tamilnormal;
  font-size:1.5em;
}
.font4 {
  font-family: telnormal;
  font-size:1.5em;
}
.font5 {
  font-family: bennormal;
  font-size:1.5em;
}
.font6 {
  font-family: gujnormal;
  font-size:1.5em;
}
.font7 {
  font-family: kannormal;
  font-size:1.5em;
}
.font8 {
  font-family: malnormal;
  font-size:1.5em;
}
.font9 {
  font-family: sinnormal;
  font-size:1.5em;
}
.font11 {
  font-family: engbold;
  font-size:1.5em;
}
.font12 {
  font-family: hinbold;
  font-size:1.5em;
}
.font13 {
  font-family: tamilbold;
  font-size:1.5em;
}
.font14 {
  font-family: telbold;
  font-size:1.5em;
}
.font15 {
  font-family: benbold;
  font-size:1.5em;
}
.font16 {
  font-family: gujbold;
  font-size:1.5em;
}
.font17 {
  font-family: kanbold;
  font-size:1.5em;
}
.font18 {
  font-family: malbold;
  font-size:1.5em;
}
.font19 {
  font-family: sinbold;
  font-size:1.5em;
}



.switch {
  position: relative;
  display: inline-block;
  width: 30px;
  height: 17px;
}
.switch2 {
  position: relative;
  display: inline-block;
  width: 30px;
  height: 17px;
}

.switch input { 
  opacity: 0;
  width: 0;
  height: 0;
}
.switch2 input { 
  opacity: 0;
  width: 0;
  height: 0;
}

.slider {
  position: absolute;
  cursor: pointer;
  top: 0;
  left: 0;
  right: 0;
  bottom: 0;
  background-color: #ccc;
  -webkit-transition: .4s;
  transition: .4s;
}

.slider:before {
  position: absolute;
  content: "";
  height: 13px;
  width: 13px;
  left: 2px;
  bottom: 2px;
  background-color: white;
  -webkit-transition: .4s;
  transition: .4s;
}

input:checked + .slider {
  background-color: #5cb85c;
}

input:focus + .slider {
  box-shadow: 0 0 0.5px #5cb85c;
}

input:checked + .slider:before {
  -webkit-transform: translateX(13px);
  -ms-transform: translateX(13px);
  transform: translateX(13px);
}

/* Rounded sliders */
.slider.round {
  border-radius: 17px;
}

.slider.round:before {
  border-radius: 25%;
}





.slider2 {
  position: absolute;
  cursor: pointer;
  top: 0;
  left: 0;
  right: 0;
  bottom: 0;
  background-color: #ccc;
  -webkit-transition: .4s;
  transition: .4s;
}

.slider2:before {
  position: absolute;
  content: "";
  height: 13px;
  width: 13px;
  left: 2px;
  bottom: 2px;
  background-color: white;
  -webkit-transition: .4s;
  transition: .4s;
}

input:checked + .slider2 {
  background-color: #5cb85c;
}

input:focus + .slider2 {
  box-shadow: 0 0 0.5px #5cb85c;
}

input:checked + .slider2:before {
  -webkit-transform: translateX(13px);
  -ms-transform: translateX(13px);
  transform: translateX(13px);
}

/* Rounded sliders */
.slider2.round {
  border-radius: 17px;
}

.slider2.round:before {
  border-radius: 25%;
}







fieldset {
  overflow: hidden
}

.some-class {
  float: left;
  clear: none;
}

label {
  float: left;
  clear: none;
  display: block;
  padding: 1px 0.5em 0 0;
}

input[type=radio],
input.radio {
  float: left;
  clear: none;
  margin: -3px 0 0 2px;
}
</style>
<script>
var curr_pos="";
</script>

		<div style=" 
   
    position: absolute;
    top:5%;
    bottom: 0;
    left: 0;
    right: 0;

    margin: auto;">
<?php
$alerterror=0;
	if(isset($_POST['submit'])){ 
		$task = mysqli_real_escape_string($connection, htmlspecialchars(@$_POST['task']));
		$day_temp = $_POST['day'];
		$month_temp = $_POST['month'];
		$year_temp = $_POST['year'];
		$title = $_POST['title'];
		$dept = $_POST['dept'];
		$dept2 = $_POST['dept2'];
		$cron = $_POST['cron'];
		
		
			$timestamp = strtotime($day_temp.'-'.$month_temp.'-'.$year_temp);
			$query = "INSERT INTO `events` (`description`,`time`,`uid`,`priority`,`department`,title,cron) VALUES ('$task',now(),'$userID',$dept,$dept2,'$title','$cron')";
			//echo $query; 
			if(!mysqli_query($connection, $query))
				$error = 1;
			
		
	}
	
	if(isset($_POST['taskdonesubmit'])){
		if(isset($_POST['tablepos']))
			{
				?>
				<script>
				curr_pos="<?php echo $_POST['tablepos']; ?>";
				//alert(curr_pos);
				
				</script>
				<?php
			}
		

			$selectedtasks = $_POST['eid3'];
			$done = $_POST['done'];
			$stat="NO";
				if ($done==1)
				{
					$done=0;
					$stat="NO";
				}
				else
				{
					$done=1;
					$stat="YE";
			
				}
				////exec('python Zone.py '.$selectedtasks." ".$stat, $retval);
				//if($ip != "10.10.10.10")
		{
		
				$query = "UPDATE `events` SET `show_text`=".$done." WHERE `id`='$selectedtasks'";
		}
		/*else
		{
				$query = "UPDATE `events` SET `show_text`=".$done." WHERE `id`='".($selectedtasks+128)."'";
			
		}*/
			//	echo 'sudo python ./Zone.py '.$selectedtasks." ".$stat;
				if(!mysqli_query($connection, $query))
					$error = 1;

		
	}
	
	
	if(isset($_POST['taskdonesubmit2'])){

		if(isset($_POST['tablepos']))
			{
				?>
				<script>
				
				curr_pos="<?php echo $_POST['tablepos']; ?>";
				//alert(curr_pos);
				
				</script>
				<?php
			}
		
			$selectedtasks = $_POST['eid32'];
			$done = $_POST['done2'];
			$stat="NO";
				if ($done==1)
				{
					$done=0;
					$stat="NO";
				}
				else
				{
					$done=1;
					$stat="YE";
			
				}
				//exec('python Top.py '.$selectedtasks." ".$stat, $retval);
					//	if($ip != "10.10.10.10")
		$query = "SELECT * FROM `events` WHERE `Top`=1";
		//echo $query; 
		$query_run = mysqli_query($connection, $query);
		$topcnt=count(mysqli_fetch_all($query_run,MYSQLI_ASSOC));
		if(($topcnt<2)||($done!=1))
		{
			$query = "UPDATE `events` SET `Top`=".$done." WHERE `id`='$selectedtasks'";
		}
		else
		{
			$alerterror=1;
		}
		/*else
		{
				$query = "UPDATE `events` SET `Top`=".$done." WHERE `id`='".($selectedtasks+128)."'";
			
		}*/		//echo 'sudo python Top.py '.$selectedtasks." ".$stat;
				if(!mysqli_query($connection, $query))
					$error = 1;

			
	}
	
	
		if(isset($_POST['taskdonesubmit3'])){

	if(isset($_POST['tablepos']))
		{
			?>
			<script>
			curr_pos="<?php echo $_POST['tablepos']; ?>";
			//alert(curr_pos);
			
			</script>
			<?php
		}
	
		$selectedtasks = $_POST['eid33'];
		$done = $_POST['done3'];
		$stat="NO";
			if ($done==1)
			{
				$done=0;
				$stat="NO";
			}
			else
			{
				$done=1;
				$stat="YE";
		
			}
			//exec('python Flash.py '.$selectedtasks." ".$stat, $retval);
				//			if($ip != "10.10.10.10")
	{
	$query = "UPDATE `events` SET `blink`=".$done." WHERE `id`='$selectedtasks'";
	}
	/*else
	{
			$query = "UPDATE `events` SET `blink`=".$done." WHERE `id`='".($selectedtasks+128)."'";
		
	}*/		//echo $query ;
			//echo 'sudo python Top.py '.$selectedtasks." ".$stat;
			if(!mysqli_query($connection, $query))
				$error = 1;

		
	}
		if(isset($_POST['taskdonesubmit4'])){

	if(isset($_POST['tablepos']))
		{
			?>
			<script>
			curr_pos="<?php echo $_POST['tablepos']; ?>";
			//alert(curr_pos);
			
			</script>
			<?php
		}
	
		$selectedtasks = $_POST['eid34'];
		$done = $_POST['done4'];
		$stat="NO";
			if ($done==1)
			{
				$done=0;
				$stat="NO";
			}
			else
			{
				$done=1;
				$stat="YE";
		
			}
			//exec('python Scroll.py '.$selectedtasks." ".$stat, $retval);
				//					if($ip != "10.10.10.10")
	{$query = "UPDATE `events` SET `scroll`=".$done." WHERE `id`='$selectedtasks'";
	}
	/*else
	{
			$query = "UPDATE `events` SET `scroll`=".$done." WHERE `id`='".($selectedtasks+128)."'";
		
	}*/		//echo $query ;
			//echo 'sudo python Top.py '.$selectedtasks." ".$stat;
			if(!mysqli_query($connection, $query))
				$error = 1;

		
	}
	
	if(isset($_POST['deletetask-submit'])){
		$selectedtasks = $_POST['eid2'];
				
			$query = "DELETE FROM `users` WHERE `uid`='$selectedtasks'";
			//echo $query;
			if(!mysqli_query($connection, $query))
				$error = 1;
	}
	
	if(isset($_POST['updateuser'])){
		$uid = $_POST['uid'];
		$password =md5( $_POST['editpassword']);
				
			$query = "UPDATE `users` SET `password`='$password' WHERE `uid`='$uid'";
			//echo $query;
			if(!mysqli_query($connection, $query))
				$error = 1;
	}
	
	
	if(isset($_POST['edit-tasks'])){
		if(isset($_POST['tablepos']))
		{
			?>
			<script>
			curr_pos="<?php echo $_POST['tablepos']; ?>";
			//alert(curr_pos);
			
			</script>
			<?php
		}
			$selectedtext = $_POST['eid'];
		$pri = array("EN", "EB", "HN", "HB","RN","RB");
		$dept = array("RE","BL","GR","YE","MA","CY","WH");
		
		$text = mysqli_real_escape_string($connection, htmlspecialchars(@$_POST['edittext']));
		$font = $_POST['editfont'];
		$color = $_POST['editcolor'];
		$size = $_POST['editsize'];
		$fs	="NR";
		if ($font > 10)
		{
			$font=$font-10;
			$fs	="BD";
		}
		$size = str_pad($size, 2, "0", STR_PAD_LEFT);
		
		$text = str_pad($text, 64);                      // produces "Alien     "
		$text = substr($text, 0, 64);
			$timestamp = strtotime($day_temp.'-'.$month_temp.'-'.$year_temp);
			//if($ip!="10.10.10.10")
			{
			$query = "UPDATE `events` SET `Text`='".$text."',`Color`='".$color."' WHERE `id`=".$selectedtext;
			}
		/*	else
			{
				$selectedtext2=$selectedtext+128;
			$query = "UPDATE `events` SET `Text`='".$text."',`Font`='".$font."',`Color`='".$color."',`Text_Size`='".$size."' WHERE `id`=".$selectedtext2;
		//echo $query;
		
			}*/
			$text = str_replace(" ","_",$text);
			$text = str_replace("(","^^",$text);
			$text = str_replace(")","~~",$text);
			$text = str_replace("&","%26",$text);
		
		//exec('python Text.py '.$selectedtext." ".$text." ".$pri[$font-1]." ".$size." ".$dept[$color-1], $retval);
		
			//echo $query; 
			if(!mysqli_query($connection, $query))
				$error = 1;
		
	}
	//if($ip != "10.10.10.10")
	{
		$query = "SELECT * FROM `events` WHERE `id`<4 order by id asc";
	}
	/*else
	{
		$query = "SELECT * FROM `events` WHERE id > 128 order by id asc limit 128";
	}*/
	exec("python initmod.py&");
	
	$query2 = "SELECT * FROM `additional_params` WHERE 1";
	$query_run2 = mysqli_query($connection, $query2);
	$query_row2 = mysqli_fetch_assoc($query_run2);
	$query4 = "SELECT * FROM `setting_table` WHERE 1";
	$query_run4 = mysqli_query($connection, $query4);
	$query_row4 = mysqli_fetch_assoc($query_run4);
	
	//echo $query; 
	if($query_run = mysqli_query($connection, $query)){
		if(mysqli_num_rows($query_run) == 0){
			echo '<div class="task"><center>No Text</center></div>';
			$no_task_flag = 1;
		} else {
			echo "";
echo '<table  id="example2" class="display nowrap" style="width:100%;  display:none;">
	  <thead>
            <tr>
                <th>Model Number</th>
				<th>Host Name</th>
                <th>IP Address</th>
				<th>Subnet Mask</th>
				<th>Gateway</th>
				<th>Static IP</th>
				<th>Clear Data On Boot</th>
				<th></th>
				';
				
				$checked="";
				$style1="";
				$style2="";
				if($query_row4['staticip']==1)
				{
					$checked="checked";	
					$style1="style='display:none;'";
					$staticchk="";
				}
				else
				{
					$style2="style='display:none;'";
				}
				
				
				$checked2="";
				if($query_row4['clearonboot']==1)
				{
					$checked2="checked";	
				}
				$style3="";
				$style4="";
				
				if($query_row4['Modenable']==1)
				{
					$checkedmod="checked";
					$style3="style='display:none;'";
				}
				else
				{
					$style4="style='display:none;'";
				}
				
           echo '</tr>
			</thead>
			<tbody><tr><td>TND-LED-RGB-P67-96HV48</td><td>';
			if(($_SESSION['admin']==1)||($_SESSION['admin']==2))
			{
				if($_SESSION['admin']==1)
			{
				echo '<input type="text" name="devicename" id="devicename"  value="'.$query_row4['devicename'].'"/>';
			}
			else
			{
				echo '<input type="text" name="devicename" id="devicename" readonly="readonly"  value="'.$query_row4['devicename'].'"/>';
				
			}
			echo '</td><td> <p id="ipp" '.$style1.'>'.$query_row4['ip'].'</p><input '.$style2.' type="text" name="ipaddr" id="ipaddr"  value="'.$query_row4['ip'].'" '.$staticchk.' /></td>
				<td><p id="nmp" '.$style1.'>'.$query_row4['netmask'].'</p><input '.$style2.' type="text" name="netmask" id="netmask"  value="'.$query_row4['netmask'].'" '.$staticchk.' /></td>
				<td><p id="gwp" '.$style1.'>'.$query_row4['gw'].'</p><input '.$style2.' type="text" name="gw" id="gw"  value="'.$query_row4['gw'].'" '.$staticchk.' /></td>
				
				<td>';
			}
			else
			{	
				echo '<input type="text" name="devicename" id="devicename" readonly="readonly"  value="'.$query_row4['devicename'].'"/>';
				echo '</td><td> <p id="ipp" '.$style1.'>'.$query_row4['ip'].'</p><input '.$style2.' type="text" name="ipaddr" id="ipaddr" readonly="readonly" value="'.$query_row4['ip'].'"/></td>
				<td><p id="nmp" '.$style1.'>'.$query_row4['netmask'].'</p><input '.$style2.' type="text" name="netmask" id="netmask" readonly="readonly" value="'.$query_row4['netmask'].'"/></td>
				<td><p id="gwp" '.$style1.'>'.$query_row4['gw'].'</p><input '.$style2.' type="text" name="gw" id="gw" readonly="readonly" value="'.$query_row4['gw'].'"/></td>
				
				<td>';
			}
			echo '
		 <label class="switch">
					  <input type="checkbox" id="staticip"  '.$checked.'>
					  <span class="slider"></span>
					</label></td><td>
		 <label class="switch">
					  <input type="checkbox" id="clearonboot"  '.$checked2.'>
					  <span class="slider"></span>
					</label></td>';
					
		if($_SESSION['admin']!=0)
				{
					echo '<td>
						<button class="btn btn-success" onclick="update_setting()">Update</button></td>';
				}
		$disptext = "Enable";
		if($query_row2['CD']!=0)
		{
			$disptext = "Disable";
		}
		$slftext = "Disable";
		if($query_row2['ST']!=1)
		{
			$slftext = "Enable";
		}
	   echo '</tr>
	   </tbody>
	   </table>
	<table  id="example3" class="display nowrap" style="width:100%;  display:none; ">
	  <thead>
           <tr><th colspan="8"><center><b><u>Attributes</b></u></center></th></tr> <tr>
                <th>Scroll Speed</th>
				<th>Flash Speed</th>
                <th>Brightness</th>
				
				
            </tr>
			</thead>
			<tbody><tr><td>
    <input type="number" name="scroll" id="scroll_speed" min="1" max="10" value="'.$query_row2['scroll_speed'].'"> <button class = "btn btn-success" onclick="update_additional_params1()">SET</button></td>
	<td> <input type="number" name="fspeed" min="1" max="10" id="blink_speed" value="'.$query_row2['blink_speed'].'"> <button class = "btn btn-success" onclick="update_additional_params2()">SET</button></td><td>
		  <input type="number" name="brightness" min="1" max="10"  id="brightness" value="'.$query_row2['brightness'].'"> <button class = "btn btn-success" onclick="update_additional_params3()">SET</button>
		  </td>
		  
		  
	   </tr>
	   </tbody>
	   </table>
	   
	   <table  id="example22" class="display nowrap" style="width:100%;  display:none;">
	  <thead>
            <tr><th colspan="4"><center><b><u>Display Functions</b></u></center></th><th colspan="2"><center><b><u>Backup and Restore</b></u></center></th></tr><tr><th>Self Test</th>
				<th>'.$disptext.' Display</th>
				
	   ';
	   if($_SESSION['admin']!=0)
				{
				
					echo '<th>ShutDown</th><th>Reboot</th>';
				}
	   echo '<th>Backup</th>
				<th>Restore</th></tr></thead>
			<tbody><tr><td>
		  
	  <button id = "selftest-btn" class = "btn btn-success" onclick="update_additional_params4()">'.$slftext.'</button></td>
	  <td>
	  
	  <button id = "disp-btn" class = "btn btn-success" onclick="update_additional_params5()">'.$disptext.'</button></td>';
			if($_SESSION['admin']!=0)
				{
					
		
					echo '<td><button class="btn btn-success" onclick="shutdown()">ShutDown</button></td><td><button class="btn btn-success" onclick="reboot()">Reboot</button></td>';
				}
			echo '<td>
	  <button class = "btn btn-success" onclick="download_backup()">Download Backup</button></td>
	  <td>
	  <form action="./libfiles/uploader.php" method="post" enctype="multipart/form-data">  
    <input type="file" name="fileToUpload"/>  
    <button class = "btn btn-success" type="submit"  name="submit"> Restore Backup</button> 
</form> </td></tr></tbody>
	   </table>
	   
	  <table id="example" class="display nowrap" style="width:100%; display:none;">
        <thead>
            <tr>
                <th align="center" data-priority="1" > <center>Line Number </center></th>
				<th align="center" ><center>Edit</center></th>
				
				
				<th  align="center"><center>Blink </center></th>
				<th  align="center"><center>Scroll </center></th>
                <th align="center" data-priority="2"><center>Status</center></th>
				<!--<th align="center" data-priority="3"><center>Modbus line control register</center></th>-->
                <th align="center" datpriority="4" ><center>Line Text</center></th>
				<th align="center"><center>Font Color</center></th>
				<!--<th align="center" data-priority="5" ><center>Font Name </center></th>
				<th align="center"><center>Font Size</center></th>-->
				
            </tr>
        </thead>
        <tbody>';
		$text_id=1;
		 while($query_row = mysqli_fetch_assoc($query_run)){
				$id = $text_id++;
				$pri = array("English Normal", "Hindi Normal","Tamil Normal","Telgu Normal","Bengali Normal","Gujarati Normal","Kannada Normal","Malayalam Normal","Singhala Normal","","English Bold", "Hindi Bold","Tamil Bold","Telgu Bold","Bengali Bold","Gujarati Bold","Kannada Bold","Malayalam Bold","Singhala Bold");
				$dept = array("Red","Blue","Green","Yellow","Magenta","Cyan","White");
				$top = $query_row['Top'];
				if($top==1)
				{
					$top="checked";
				}
				else
				{
					$top="";
				}
				
				$blink1 = $query_row['blink'];
				if($blink1==1)
				{
					$blink1="checked";
				}
				else
				{
					$blink1="";
				}
				
				$scroll1 = $query_row['scroll'];
				if($scroll1==1)
				{
					$scroll1="checked";
				}
				else
				{
					$scroll1="";
				}
				if($dept[$query_row['Color']-1]=='White')
				{
					$color='black';
				}
				else
				{
					$color=$dept[$query_row['Color']-1];
				}
				
				
				$done_flag = $query_row['show_text'];
					if($done_flag==1)
				{
					$done_flag='SHOW';
								$event = trim($query_row['Text']);
					
					if ($query_row['FontStyle']=="BD")
					{
						$query_row['Font']=$query_row['Font'] + 10;
					}
					else
					{
						$query_row['Font']=$query_row['Font'] + 10;
					}
						
			echo '<tr>
			<td align="center"><center>'.$id.'</center></td>
			<td align="center"><center><a href="#" title="Edit"> <img src="images/pen_edit.png" name="0" onclick="'."Edittask('".str_replace (array("\r\n", "\n", "\r"), ' ', $event)."','".$query_row['Font']."','".$id."','".$query_row['Color']."','".$query_row['Text_Size']."')".'" ></a>
				</center>		
			</td >
				<!--<td align="center"><center><div><label class="switch">
					  <input type="checkbox" id="top-$id" onclick="completetask2('.$id.','.$query_row['Top'].')"  '.$top.'  />
					  <span class="slider"></span>
					</label></div></center></td>-->
					<td align="center"><center><label class="switch">
					  <input type="checkbox" id="blink-$id" onclick="completetask3('.$id.','.$query_row['blink'].')" '.$blink1 .' />
					  <span class="slider"></span>
					</label></center></td><td align="center"><center><label class="switch">
					  <input type="checkbox" id="scroll-$id" onclick="completetask4('.$id.','.$query_row['scroll'].')" '.$scroll1 .' />
					  <span class="slider"></span>
					</label></center></td>
					<td align="center"><center><div><label class="switch">
					  <input type="checkbox" id="checkbox-$id" onclick="completetask('.$id.','.$query_row['show_text'].')" checked />
					  <span class="slider"></span>
					</label></div></center></td>
					<!--<td>1x <input type="number" name="regid'.$id.'" min="1" max="10" id="regid'.$id.'" value="'.$query_row['regid'].'"> <button class="btn btn-success" onclick="update_regid('.$id.')">SET</button></td>-->
					<td align="center"><center><font color="'.$color.'">'.$event.'</font></center></td>
					<td align="center"><center>'.$dept[$query_row['Color']-1].'</center></td>
					<!--<td align="center"><center>'.$pri[$query_row['Font']-1].'</center></td>
					<td align="center"><center>'.$query_row['Text_Size'].'</center></td>-->
					
					
				</tr>';
	
			}
				else
				{
					
					$done_flag='HIDE';
								$event = trim($query_row['Text']);
			echo '<tr>
			<td align="center"><center>'.$id.'</center></td>
			<td align="center"><center><a href="#" title="Edit"> <img src="images/pen_edit.png" name="0" onclick="'."Edittask('".str_replace (array("\r\n", "\n", "\r"), ' ', $event)."','".$query_row['Font']."','".$id."','".$query_row['Color']."','".$query_row['Text_Size']."')".'" ></a>
		</center>				
		</td>
			<!--<td align="center"><center><label class="switch">
					  <input type="checkbox" id="top-$id" onclick="completetask2('.$id.','.$query_row['Top'].')" '.$top .' />
					  <span class="slider"></span>
					</label></center></td>-->
					<td align="center"><center><label class="switch">
					  <input type="checkbox" id="blink-$id" onclick="completetask3('.$id.','.$query_row['blink'].')" '.$blink1 .' />
					  <span class="slider"></span>
					</label></center></td><td align="center"><center><label class="switch">
					  <input type="checkbox" id="scroll-$id" onclick="completetask4('.$id.','.$query_row['scroll'].')" '.$scroll1 .' />
					  <span class="slider"></span>
					</label></center></td>
					<td align="center"><center><label class="switch">
					  <input type="checkbox" id="checkbox-$id" onclick="completetask('.$id.','.$query_row['show_text'].')" /> 
					  <span class="slider"></span>
					</label></center></td>
					<!--<td>1x <input type="number" name="regid'.$id.'" min="1" max="10" id="regid'.$id.'" value="'.$query_row['regid'].'"> <button class="btn btn-success" onclick="update_regid('.$id.')">SET</button></td>-->
					<td align="center"><center><font color="'.$color.'">'.$event.'</font></center></td>
					<!--<td align="center"><center>'.$pri[$query_row['Font']-1].'</center></td>
					<td align="center"><center>'.$query_row['Text_Size'].'</center></td>-->
					<td align="center"><center>'.$dept[$query_row['Color']-1].'</center></td>
					
	 				</tr>';
				}
			
			}
           echo ' </tbody>
		  
        
    </table>
	
  ';			
			
		}
		
	} else {
		$error = 2;
	}
?>
  
	</div>
		</div>
		
		
	<script>
	var table4="";
	
	function changefont()
	{
		//alert("hi");
		
	}
	
	var ttf = ["LiberationSerif-Regular.ttf","LiberationMono-Bold.ttf",  "AVFHIN1N.TTF", "AVFHIN1B.TTF","AVFTEL1N.TTF","AVFTEL1B.TTF"];
	var colcount=0;
	$(document).ready(function() {
		  $("#staticip").click(function (e) {    
			if (document.getElementById("staticip").checked) {
			  $("#ipaddr").show();
			  $("#ipp").hide();
			   $("#netmask").show();
			  $("#nmp").hide();
			   $("#gw").show();
			  $("#gwp").hide();
			}
			else  {
			  $("#ipaddr").hide();
			  $("#ipp").show();
			   $("#netmask").hide();
			  $("#nmp").show();
			   $("#gw").hide();
			  $("#gwp").show();
			}
		  });
		
		$("#modbus").click(function (e) {    
			if (document.getElementById("modbus").checked) {
			  $("#slaveipaddr").show();
			  $("#sipp").hide();
			   $("#slaveipaddr1").show();
			  $("#sipp1").hide();
			   $("#slaveipaddr2").show();
			  $("#sipp2").hide();
			}
			else  {
			  $("#slaveipaddr").hide();
			  $("#sipp").show();
			   $("#slaveipaddr1").hide();
			  $("#sipp1").show();
			   $("#slaveipaddr2").hide();
			  $("#sipp2").show();
			}
		  });
		
		<?php
			if($alerterror==1)
			{
			?>
			alert("Operation not permited!! Cannot set more than 2 top.");
			
			<?php
			}
			?>
		$('select[name=editfont]').change(function(){
   // alert('font'+$(this).val());
	
			 $('#edittext').attr('class', 'form-control not-round font'+$(this).val());
			
});
		
		$('#myModal').on('hidden.bs.modal', function (e) {
  $(this) 
    .find("input,textarea,select")
       .val('')
       .end()
    .find("input[type=checkbox], input[type=radio]")
       .prop("checked", "")
       .end();
});
		
		 
		 if ( window.history.replaceState ) {
        window.history.replaceState( null, null, window.location.href );
    }
		
		
	 $('#example').show();
	 $('#example2').show();
	 
	 $('#example3').show();
	 $('#example22').show();
	 var table1 = jqtabels('#example2').DataTable({
		dom: '<"top"<"dt_title">>rCt<"footer"><"bottom"><"clear">'
	 });
	 var table12 = jqtabels('#example22').DataTable({
		dom: '<"top"<"dt_title22">>rCt<"footer"><"bottom"><"clear">'
	 });
	  var table2 = jqtabels('#example3').DataTable({
		dom: '<"top"<"dt_title2">>rCt<"footer"><"bottom"><"clear">'
	 });
	 var table3 = jqtabels('#example4').DataTable({
		dom: '<"top">rCt<"footer"><"bottom"><"clear">'
	 });
	  $("div.dt_title").html('<h3><b><center><u>VDU Information</u></center></b></h3>');  

      
	  $("div.dt_title2").html('<h3><b><center><u>VDU Setting</u></center></b></h3>'); 
 $("div.dt_title22").html('<h3><b><center><u>Additional Commands</u></center></b></h3>'); 	  

      
		
	 
	 
    	table4 = jqtabels('#example').DataTable({
		dom: '<"top"<"dt_title3">>rCt<"footer"><"bottom"lp><"clear">',
       
		
        responsive: true,
		deferRender:    true,
        scrollY:        "45vh",
        scrollCollapse: true,
        scroller:       true,
	 columnDefs: [
      { "width": "3%", "targets": 0 },
      { "width": "3%", "targets": 1 },
      { "width": "3%", "targets": 2 },
      { "width": "3%", "targets": 3 },
      { "width": "3%", "targets": 4 },
      { "width": "75%", "targets": 5 },
	  { "width": "10%", "targets": 6 }

    ]
	 });
	 $("div.dt_title3").html('<h3><b><center><u>VDU Contents</u></center></b></h3>');
if(curr_pos!="")
{	
var res = curr_pos.split(",");
$(table4.settings()[0].nScrollBody).scrollTop( res[0] );
$(table4.settings()[0].nScrollBody).scrollLeft( res[1] );
}	 
} );

function radio_onchange(radioval)
{
	if(radioval==1) { 
	document.getElementById("dynamic").checked=false;
	document.getElementById("ipdiv").style.display="block";
	}
	else  
	{
		document.getElementById("static").checked=false;
		document.getElementById("ipdiv").style.display="none";
	}
	
}

function update_setting()
        {
			var ipaddr=document.getElementById("ipaddr").value;
			var devicename=document.getElementById("devicename").value;
			var netmask=document.getElementById("netmask").value;
			var gw=document.getElementById("gw").value;
			var dbname=document.getElementById("staticip").checked;
			var cob=document.getElementById("clearonboot").checked;
			if(dbname)
			{
				dbname=1;
			}
			else
			{
				dbname=0;
			}
			if(cob)
			{
				cob=1;
			}
			else
			{
				cob=0;
			}
			$.ajax({
						url : "update_setting.php",
						type: "POST",
						data :"ipaddr="+ipaddr+"&dbname="+dbname+"&cob="+cob+"&netmask="+netmask+"&gw="+gw+"&devicename="+devicename,
						success: function(data,status,xhr)
								{
									alert("Setting Updated Successfully...");
									location.reload();
								}
					});
        }
		 String.prototype.trimRight=function(){return this.replace(/\s+$/,'');}

function shutdown()
        {
			$.ajax({
						url : "shutdown.php",
						type: "POST",
						data :"",
						success: function(data,status,xhr)
								{
									alert("Display shutting down...");
									location.reload();
								}
					});
        }
		function reboot()
        {
			$.ajax({
						url : "reboot.php",
						type: "POST",
						data :"",
						success: function(data,status,xhr)
								{
									alert("Display Rebooting...");
									location.reload();
								}
					});
        }

function update_additional_params2()
        {
			var brightness=document.getElementById("brightness").value;
			var scroll_speed=document.getElementById("scroll_speed").value;
			var bink_speed=document.getElementById("blink_speed").value;
			var blink=1;
			$.ajax({
						url : "update_setting.php?"+"bink_speed="+bink_speed+"&blink="+blink,
						type: "POST",
						data :"bink_speed="+bink_speed+"&blink="+blink,
						success: function(data,status,xhr)
								{
									alert("Params Updated Successfully...");
									location.reload();
								}
					});
        }
		
function update_regid(id)
        {
			var regid=document.getElementById("regid"+id).value;
			$.ajax({
						url : "update_regid.php?"+"id="+id+"&regid="+regid,
						type: "POST",
						data :"id="+id+"&regid="+regid,
						success: function(data,status,xhr)
								{
									alert("regid Updated Successfully...");
									location.reload();
								}
					});
        }
		
		
		function update_slave()
        {
			//var ctrlregid=document.getElementById("controlreg").value;
			var slaveipaddr=document.getElementById("slaveipaddr").value;
			var slaveipaddr1=document.getElementById("slaveipaddr1").value;
			var slaveipaddr2=document.getElementById("slaveipaddr2").value;
			var me=document.getElementById("modbus").checked;
			var modenable=0;
			if(document.getElementById("modbus").checked)
			{
				modenable=1;
			}
			$.ajax({
						url : "update_slave.php?"+"ctrlreg=1&servip="+slaveipaddr+"&RegID="+slaveipaddr1+"&RegLen="+slaveipaddr2+"&Modenable="+modenable,
						type: "POST",
						data :"ctrlreg=1&servip="+slaveipaddr+"&RegID="+slaveipaddr1+"&RegLen="+slaveipaddr2,
						success: function(data,status,xhr)
								{
									alert("regid Updated Successfully...");
									location.reload();
								}
					});
        }
		
		
		function update_additional_params4()
        {
			var dispbtn = $('#selftest-btn').text();
			// alert (dispbtn);
			if (dispbtn == "Disable")
			{
				$.ajax({
							url : "update_setting.php?"+"selftest=0",
							type: "POST",
							data :"",
							success: function(data,status,xhr)
									{
										alert("Self Test Disabled...");
										location.reload();
									}
						});
				$('#selftest-btn').text()="Enable";
			}
			else
			{
				$.ajax({
							url : "update_setting.php?"+"selftest=1",
							type: "POST",
							data :"",
							success: function(data,status,xhr)
									{
										alert("Self Test Enabled...");
										location.reload();
									}
						});
				$('#selftest-btn').text()="Disable";

			}
        }
		function update_additional_params5()
        {
			var dispbtn = $('#disp-btn').text();
			// alert (dispbtn);
			if (dispbtn == "Disable")
			{
				$.ajax({
							url : "update_setting.php?"+"clear=0",
							type: "POST",
							data :"",
							success: function(data,status,xhr)
									{
										alert("Display Disabled...");
										location.reload();
									}
						});
				$('#disp-btn').text()="Enable";
			}
			else
			{
				$.ajax({
							url : "update_setting.php?"+"clear=1",
							type: "POST",
							data :"",
							success: function(data,status,xhr)
									{
										alert("Display Enabled...");
										location.reload();
									}
						});
				$('#disp-btn').text()="Disable";

			}
			
        }
		function update_additional_params6()
        {
			
			$.ajax({
						url : "update_setting.php?"+"clear=1",
						type: "POST",
						data :"",
						success: function(data,status,xhr)
								{
									alert("Display Cleared...");
									location.reload();
								}
					});
			
        }
		function download_backup()
        {
			
			$.ajax({
						url : "./libfiles/backup.php?",
						type: "POST",
						data :"",
						success: function(data,status,xhr)
								{
									var textToSave = data;

									var hiddenElement = document.createElement('a');

									hiddenElement.href = 'data:attachment/text,' + encodeURI(textToSave);
									hiddenElement.target = '_blank';
									hiddenElement.download = 'led_backup.sql';
									hiddenElement.click();
								}
					});
        }
		
		//download_backup

function update_additional_params1()
        {
			var brightness=document.getElementById("brightness").value;
			var scroll_speed=document.getElementById("scroll_speed").value;
			var bink_speed=document.getElementById("blink_speed").value;
			var scroll=1;
			$.ajax({
						url : "update_setting.php?"+"scroll_speed="+scroll_speed+"&scroll="+scroll,
						type: "POST",
						data :"scroll_speed="+scroll_speed+"&scroll="+scroll,
						success: function(data,status,xhr)
								{
									alert("Params Updated Successfully...");
									location.reload();
								}
					});
        }
function update_additional_params3()
        {
			var brightness=document.getElementById("brightness").value;
			var scroll_speed=document.getElementById("scroll_speed").value;
			var bink_speed=document.getElementById("blink_speed").value;
			
			$.ajax({
						url : "update_setting.php?"+"brightness="+brightness,
						type: "POST",
						data :"brightness="+brightness,
						success: function(data,status,xhr)
								{
									alert("Params Updated Successfully...");
									location.reload();
								}
					});
        }

 function Edittask(Text,Font,id,Color,Size)
 {
	 $('#editModal').modal('show');
		Text=Text;
	  $('#edittext').val(Text);
			  $('#edittext').attr('class', 'form-control not-round font'+Font);
	   $("#edit-tasks-pro").val(Font);
	   $("#edit-tasks-pro2").val(Color);
	   $('#eid').val(id);
	   $('#size').val(Size);
 }


 function Edituser(username,password,uid)
 {
	 $('#usereditModal').modal('show');
	 $('#editusername').val(username);
	 $('#uid').val(uid);
	 
	
 }
 
 $("#editModal").on("hidden.bs.modal",function(){
      // alert('hello');
});
 
 
function deletetask(id,title)
 {
	 $('#deleteModal').modal('show');
	 $( "#deletep" ).html( "Are you sure you want to delete user named <br />("+title+") !!!" );
	   $('#eid2').val(id);
	   setTimeout(function(){ $('#delete_task').focus(); }, 600);
	   
 }
function completetask(id,show)
 {
	 var task="";
	 if(show==0)
	 {
		 task="Show";
	 }
	 else
	 {
		  task="Hide";
	 }		 
	 //$('#completeModal').modal('show');
	 $( "#completep" ).html( "Are you sure you want to "+task+" <br />Line number "+id+"!" );
	   $('#eid3').val(id);
	   $('#done').val(show);
	    document.getElementById("done_task").click();
		//document.completetaskform.submit(); 
 }
 
 
 function completetask2(id,show)
 {
	 var task="";
	 if(show==0)
	 {
		 task="Show";
	 }
	 else
	 {
		  task="Hide";
	 }		 
	// alert(id);
	 //$('#completeModal').modal('show');
	 $( "#completep2" ).html( "Are you sure you want to "+task+" <br />Line number "+id+"!" );
	   $('#eid32').val(id);
	   $('#done2').val(show);
	    document.getElementById("done_task2").click();
		// alert(show);
		//document.completetaskform.submit(); 
 }


function completetask3(id,show)
 {
	// alert('ss');
	 var task="";
	 if(show==0)
	 {
		 task="Show";
	 }
	 else
	 {
		  task="Hide";
	 }		 
	// alert(id);
	 //$('#completeModal').modal('show');
	 $( "#completep3" ).html( "Are you sure you want to "+task+" <br />Line number "+id+"!" );
	   $('#eid33').val(id);
	   $('#done3').val(show);
	  // alert('ss2');
	    document.getElementById("done_task3").click();
		// alert(show);
		//document.completetaskform.submit(); 
 }

function completetask4(id,show)
 {
	// alert('ss');
	 var task="";
	 if(show==0)
	 {
		 task="Show";
	 }
	 else
	 {
		  task="Hide";
	 }		 
	// alert(id);
	 //$('#completeModal').modal('show');
	 $( "#completep3" ).html( "Are you sure you want to "+task+" <br />Line number "+id+"!" );
	   $('#eid34').val(id);
	   $('#done4').val(show);
	  // alert('ss2');
	    document.getElementById("done_task4").click();
		// alert(show);
		//document.completetaskform.submit(); 
 }
 
  $(document).keydown(function(e){
      if( e.which === 78 && e.altKey ){
		  $("#add_task_btn").click();
      }
             
}); 
 
 
	</script>
      
	
	
		

	
 
  <!-- Modal -->
  <div class="modal fade" id="myModal" role="dialog" >
    <div class="modal-dialog" style="width=100%">
    
      <!-- Modal content-->
      <div class="modal-content" >
	  <form method="POST" id="addtaskform" style="width=30vw">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Users Table</h4>
        </div>
        <div class="modal-body">
 
<?php 
	if(isset($error)){
		echo '<div class="alert alert-danger alert-dismissible" style="margin:10px;" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>'.@$error_messages[$error].'</div>';
	}
?>
			
			
				<table id="example4"style="width:100%">
				<thead>
				
  <tr>
    <th>UserName</th>
    <th>UserId</th>
	<th>Edit/Delete</th>
  </tr>
  </thead>
  <tbody>
  <?php
  if($_SESSION['admin']==1)
  {
		$query3 = "SELECT * FROM `users` where admin != 1";
	  
  }
  else
  {
				
  	$query3 = "SELECT * FROM `users` where admin != 1";
  }
  $query_run3 = mysqli_query($connection, $query3);
		 while($query_row3 = mysqli_fetch_assoc($query_run3)){
  ?>
  <tr>
    <td><?php echo $query_row3['name'];  ?></td>
    <td ><?php echo $query_row3['username'];  ?></td>
	<td align="center"><a href="#" title="Edit" onclick="Edituser('<?php echo $query_row3['username'];  ?>','<?php echo $query_row3['password'];  ?>','<?php echo $query_row3['uid'];  ?>');"> <img src="images/pen_edit.png" name="0" ></a>
				<?php if ($query_row3['admin']!="2") { ?>
				<a href="#" title="delete" onclick="deletetask('<?php echo $query_row3['uid'];  ?>','<?php echo $query_row3['username'];  ?>');"> <img src="images/trash.png" name="0" ></a>
				<?php } ?>
			</td >
  </tr>
  <?php
		 }
  ?>
 
  </tbody>
</table>
			
		</div>

   
		</form>
      </div>
      
    </div>
  </div>
 






  <!-- Modal -->
  <div class="modal fade" id="usereditModal" role="dialog" >
    <div class="modal-dialog" style="width=100%">
    
      <!-- Modal content-->
      <div class="modal-content" >
	  <form method="POST" id="usereditform" style="width=30vw">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Edit User</h4>
        </div>
        <div class="modal-body">

			
		
				<div class="row2">				
					<div class="width30">
					<label style="font-size:14px">User ID</label> 
					</div><div class="width70">
						<input class="form-control not-round" rows="1" type="text" maxlength="64" required id="editusername" name="editusername" placeholder="Enter User Name here" disabled></input>
						<input class="form-control not-round" type="hidden" required name="uid" id='uid' placeholder="Enter Text here"></input>
				
					</div>
					
				</div>
					<div class="row2">
					<div class="width30">
					<label style="font-size:14px">Password</label>
					</div><div class="width70">
						<input class="form-control not-round" type="text" min="10" max="30" name="editpassword" id='editpassword' placeholder="Enter Password here"></input>
					</div>
					
				</div>	
			
		</div>

        <div class="modal-footer">
		<button form="usereditform" type="submit" class="btn btn-lg btn-block btn-primary not-round" name="updateuser">Update</button>
        </div>
   
		</form>
      </div>
      
    </div>
  </div>
 

	
	
 
  <!-- Modal -->
  <div class="modal fade" id="editModal" role="dialog">
    <div class="modal-dialog" style="width=100%">
    
      <!-- Modal content-->
      <div class="modal-content" style="height: auto; width:75%;  " >
	  <form method="POST" id="edittaskform">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Edit Text</h4>
        </div>
        <div class="modal-body" >
 
<?php 
	if(isset($error)){
		echo '<div class="alert alert-danger alert-dismissible" style="margin:10px;" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>'.@$error_messages[$error].'</div>';
	}
?>
			
			
		
				<div class="row2">				
					<div class="width30">
					<label style="font-size:14px">Text</label> 
					</div><div class="width70">
						<input class="form-control not-round" rows="1" type="text" maxlength="64" required id="edittext" name="edittext" placeholder="Enter Text here"></input>
						<input class="form-control not-round" type="hidden" required name="eid" id='eid' placeholder="Enter Text here"></input>
						<input class="form-control not-round" type="hidden" required name="tablepos" id='tablepos' placeholder="Enter Text here"></input>
				
					</div>
					
				</div>
					<div class="row2">
					<!--<div class="width30">
					<label style="font-size:14px">Font Size</label>
					</div><div class="width70">
						<input class="form-control not-round" type="number" min="10" max="30" name="editsize" id='size' placeholder="Enter Font size here"></input>
					</div>-->
					
				</div>	
				<div class="row2">				
					<!--<div class="width30">
					<label style="font-size:14px">Font Style</label> 
					</div><div class="width70">
						<select class="form-control not-round" id="edit-tasks-pro" required onChange="return changefont()" name="editfont" >
							<option value="0"  disabled selected>Select Font</option>
							<option value="1">English Normal</option>
							<option value="2">Hindi Normal</option>
							<option value="3">Tamil Normal</option>
							<option value="4">Telgu Normal</option>
							<option value="5">Bengali Normal</option>
							<option value="6">Gujarati Normal</option>
							<option value="7">Kannada Normal</option>
							<option value="8">Malayalam Normal</option>
							<option value="9">Singhala Normal</option>
							
							<option value="11">English Bold</option>
							<option value="12">Hindi Bold</option>
							<option value="13">Tamil Bold</option>
							<option value="14">Telgu Bold</option>
							<option value="15">Bengali Bold</option>
							<option value="16">Gujarati Bold</option>
							<option value="17">Kannada Bold</option>
							<option value="18">Malayalam Bold</option>
							<option value="19">Singhala Bold</option>
						</select>
						</select>
					</div>-->
					
				</div><div class="row2">				
					<div class="width30">
					<label style="font-size:14px">Font Color</label> 
					</div><div class="width70">
				<select class="form-control not-round" required id="edit-tasks-pro2" name="editcolor" >
						<option value="0"  disabled selected>Select Color</option>
						<option value="1">Red</option>
						  <option value="2">Blue</option>
						  <option value="3">Green</option>
						  <option value="4">Yellow</option>
						  <option value="5">Magenta</option>
						  <option value="6">Cyan</option>
						  <option value="7">White</option>
						</select>
					</div>
					
				</div>
				<div class="row submit-button-row" style="margin-top:20px;">
					<div class="col-md-10 col-md-offset-1">
						
					</div>
				</div>
			
		</div>

        <div class="modal-footer">
		<button form="edittaskform" type="submit" class="btn btn-lg btn-block btn-primary not-round" name="edit-tasks" onClick="validate()">Save</button>
        </div>
		</form>
      </div>
      
    </div>
  </div>
   </div>

	
<script type="text/javascript">
function escapeRegExp(str) {
    return str.replace(/([.*+?^=!:${}()|\[\]\/\\])/g, "\\$1");
}
function replaceAll(str, find, replace) {
    return str.replace(new RegExp(escapeRegExp(find), 'g'), replace);
}

 function validate(){

var curr_pos2 = {
            'top': $(table4.settings()[0].nScrollBody).scrollTop(),
            'left': $(table4.settings()[0].nScrollBody).scrollLeft()
        };
		document.getElementById("tablepos").value=curr_pos2.top+","+curr_pos2.left;
		console.log(curr_pos2);
		document.getElementById("edittext").value=replaceAll(document.getElementById("edittext").value, '&', ' and ');
		alert(document.getElementById("edittext").value);

}
 function validate1(){

var curr_pos2 = {
            'top': $(table4.settings()[0].nScrollBody).scrollTop(),
            'left': $(table4.settings()[0].nScrollBody).scrollLeft()
        };
		document.getElementById("tablepos1").value=curr_pos2.top+","+curr_pos2.left;
		console.log(curr_pos2);
		//alert(curr_pos);

} function validate2(){

var curr_pos2 = {
            'top': $(table4.settings()[0].nScrollBody).scrollTop(),
            'left': $(table4.settings()[0].nScrollBody).scrollLeft()
        };
		document.getElementById("tablepos2").value=curr_pos2.top+","+curr_pos2.left;
		console.log(curr_pos2);
		//alert(curr_pos);

} function validate3(){

var curr_pos2 = {
            'top': $(table4.settings()[0].nScrollBody).scrollTop(),
            'left': $(table4.settings()[0].nScrollBody).scrollLeft()
        };
		document.getElementById("tablepos3").value=curr_pos2.top+","+curr_pos2.left;
		console.log(curr_pos2);
		//alert(curr_pos);

} function validate4(){

var curr_pos2 = {
            'top': $(table4.settings()[0].nScrollBody).scrollTop(),
            'left': $(table4.settings()[0].nScrollBody).scrollLeft()
        };
		document.getElementById("tablepos4").value=curr_pos2.top+","+curr_pos2.left;
		console.log(curr_pos2);
		//alert(curr_pos);

}
</script>



  <!-- Modal -->
  <div class="modal fade" id="deleteModal" role="dialog">
    <div class="modal-dialog" style="width=100%">
    
      <!-- Modal content-->
      <div class="modal-content" >
	  <form method="POST" id="deletetaskform">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Delete User</h4>
        </div>
        <div class="modal-body">
 
<?php 
	if(isset($error)){
		echo '<div class="alert alert-danger alert-dismissible" style="margin:10px;" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>'.@$error_messages[$error].'</div>';
	}
?>
<p id="deletep">
    <br data-mce-bogus="1">
  </p>
			
					<input class="form-control not-round" type="hidden" required name="eid2" id='eid2' placeholder="Enter task title here" "></input>
				
				
			
		</div>

        <div class="modal-footer">
		<button form="deletetaskform" type="submit" class="btn btn-lg btn-block btn-primary not-round" name="deletetask-submit" id="delete_task"  >Delete</button>
        </div>
		</form>
      </div>
      
    </div>
  </div>
   </div>	
	


  <!-- Modal -->
  <div class="modal fade" id="completeModal" role="dialog">
    <div class="modal-dialog" style="width=100%">
    
      <!-- Modal content-->
      <div class="modal-content" >
	  <form method="POST" id="completetaskform">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
         
		 <h4 class="modal-title">Show/Hide</h4>
        </div>
        <div class="modal-body">
 
<?php 
	if(isset($error)){
		echo '<div class="alert alert-danger alert-dismissible" style="margin:10px;" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>'.@$error_messages[$error].'</div>';
	}
?>
<p id="completep" >
    <br data-mce-bogus="1">
  </p>
			
			
					<input class="form-control not-round" type="hidden" required name="eid3" id='eid3' placeholder="Enter id" ></input>
					<input class="form-control not-round" type="hidden" required name="tablepos" id='tablepos1' placeholder="Enter Text here"></input>
				
					<input class="form-control not-round" type="hidden" required name="done" id='done' placeholder="Enter task" ></input>
				
				
			
		</div>

        <div class="modal-footer">
		<button form="completetaskform" type="submit" class="btn btn-lg btn-block btn-primary not-round" id="done_task" onClick="validate1()"  name="taskdonesubmit">Confirm</button>
        </div>
		</form>
      </div>
      
    </div>
  </div>
  
    <!-- Modal -->
  <div class="modal fade" id="completeModal2" role="dialog">
    <div class="modal-dialog" style="width=100%">
    
      <!-- Modal content-->
      <div class="modal-content" >
	  <form method="POST" id="completetaskform2">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
         
		 <h4 class="modal-title">Show/Hide</h4>
        </div>
        <div class="modal-body">
 
<?php 
	if(isset($error)){
		echo '<div class="alert alert-danger alert-dismissible" style="margin:10px;" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>'.@$error_messages[$error].'</div>';
	}
?>
<p id="completep2" >
    <br data-mce-bogus="1">
  </p>
			
			
					<input class="form-control not-round" type="hidden" required name="eid32" id='eid32' placeholder="Enter id" ></input>
							<input class="form-control not-round" type="hidden" required name="tablepos" id='tablepos2' placeholder="Enter Text here"></input>
				
					<input class="form-control not-round" type="hidden" required name="done2" id='done2' placeholder="Enter task" ></input>
				
				
			
		</div>

        <div class="modal-footer">
		<button form="completetaskform2" type="submit" class="btn btn-lg btn-block btn-primary not-round" id="done_task2" onClick="validate2()"  name="taskdonesubmit2">Confirm</button>
        </div>
		</form>
      </div>
      
    </div>
  </div>
  
  
      <!-- Modal -->
  <div class="modal fade" id="completeModal3" role="dialog">
    <div class="modal-dialog" style="width=100%">
    
      <!-- Modal content-->
      <div class="modal-content" >
	  <form method="POST" id="completetaskform3">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
         
		 <h4 class="modal-title">Show/Hide</h4>
        </div>
        <div class="modal-body">
 
<?php 
	if(isset($error)){
		echo '<div class="alert alert-danger alert-dismissible" style="margin:10px;" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>'.@$error_messages[$error].'</div>';
	}
?>
<p id="completep3" >
    <br data-mce-bogus="1">
  </p>
			
			
					<input class="form-control not-round" type="hidden" required name="eid33" id='eid33' placeholder="Enter id" ></input>
							<input class="form-control not-round" type="hidden" required name="tablepos" id='tablepos3' placeholder="Enter Text here"></input>
				
					<input class="form-control not-round" type="hidden" required name="done3" id='done3' placeholder="Enter task" ></input>
				
				
			
		</div>

        <div class="modal-footer">
		<button form="completetaskform3" type="submit" class="btn btn-lg btn-block btn-primary not-round" id="done_task3" onClick="validate3()"  name="taskdonesubmit3">Confirm</button>
        </div>
		</form>
      </div>
      
    </div>
  </div>
  
  
        <!-- Modal -->
  <div class="modal fade" id="completeModal4" role="dialog">
    <div class="modal-dialog" style="width=100%">
    
      <!-- Modal content-->
      <div class="modal-content" >
	  <form method="POST" id="completetaskform4">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
         
		 <h4 class="modal-title">Show/Hide</h4>
        </div>
        <div class="modal-body">
 
<?php 
	if(isset($error)){
		echo '<div class="alert alert-danger alert-dismissible" style="margin:10px;" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>'.@$error_messages[$error].'</div>';
	}
?>
<p id="completep3" >
    <br data-mce-bogus="1">
  </p>
			
			
					<input class="form-control not-round" type="hidden" required name="eid34" id='eid34' placeholder="Enter id" ></input>
						<input class="form-control not-round" type="hidden" required name="tablepos" id='tablepos4' placeholder="Enter Text here"></input>
				
					<input class="form-control not-round" type="hidden" required name="done4" id='done4' placeholder="Enter task" ></input>
				
				
			
		</div>

        <div class="modal-footer">
		<button form="completetaskform4" type="submit" class="btn btn-lg btn-block btn-primary not-round" id="done_task4" onClick="validate4()"  name="taskdonesubmit4">Confirm</button>
        </div>
		</form>
      </div>
      
    </div>
  </div>
  
  
  
  
  
   </div>


	
<?php include('inc/footer.php');?>