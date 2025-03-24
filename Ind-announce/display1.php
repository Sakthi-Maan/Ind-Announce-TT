<?php
	header("refresh: 60;");
	$department=$_GET['dept'];
	include 'inc/connection.inc.php';
	$query_run = mysqli_query($connection, "SELECT * FROM `events` WHERE department=$department AND done=0 ORDER BY priority DESC, `time` ASC");
	
?>
<html>
	<head>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
	<style>

		.grid-container {
		  display: grid;
		  grid-template-columns: auto auto auto auto;
		  grid-gap: 10px;
		  background-color: DodgerBlue;
		  padding: 10px;
		   margin-bottom:12px;
		   border-radius: 10px;
		  
		}
		.grid-item {
		  
		 padding: 15px 15px 20px 15px;
		  font-size: 30px;
		  text-align: center;
		  border-radius: 10px;
		   font-family: Times New Roman, serif;
		  
		
		 
		}
		.colour4 {
		  background-color:#d61212;
		}
		.colour3 {
		  background-color:#ff8100;
		}
		.colour2 {
		  background-color:#e4ff00;
		}
		.colour1 {
		  background-color:#00ff5a;
		}
		.button {
  position: relative;
  display: inline-block;
  width: 80px;
  height: 25px;
  margin-bottom:-15px;
  border-radius: 6px;
  
}

.button input {display:none;}

.slider {
  position: absolute;
  cursor: pointer;
  top: 0;
  left: 0;
  right: 0;
  bottom: 0;
  background-color: #ca2222;
  -webkit-transition: .4s;
  transition: .4s;
   border-radius: 10px;
}

.slider:before {
  position: absolute;
  content: "";
  height: 26px;
  width: 26px;
  left: 4px;
  Right: 4px
  background-color: white;
  -webkit-transition: .4s;
  transition: .4s;
  border-radius: 50%;
}

input:checked + .slider {
  background-color: #2ab934;
}

input:focus + .slider {
  box-shadow: 0 0 1px #2196F3;
}

input:checked + .slider:before {
  -webkit-transform: translateX(26px);
  -ms-transform: translateX(26px);
  transform: translateX(55px);
}

/*------ ADDED CSS ---------*/
.slider:after
{
 content:'stop';
 color: white;
 display: block;
 position: absolute;
 transform: translate(-50%,-50%);
 top: 50%;
 left: 49%;
 font-size: 12px;
 font-family: "Times New Roman", Times, serif;
 font-weight: bold;
}

input:checked + .slider:after
{  
  content:'start';
}

/*--------- END --------*/


  
		
	</style>
	</head>
	<body>
	
		<div id="ticker_02" class="grid-container">
		<?php
		while($query_row = mysqli_fetch_assoc($query_run)){
		?>
<?php
$query_rower= mysqli_query($connection,"select * from `timer` WHERE task_id=".$query_row['id']." AND endtime IS NULL");
$rowcount = mysqli_num_rows($query_rower);

?>

		<div class="grid-item colour<?php echo $query_row['priority'];?>">
			
			<?php echo $query_row['description'];?><br>
			<?php if($rowcount==0){?>
			
			<label class="button"><input type="checkbox" class="button" onClick="reply_click(this.id)" value="start" id="start<?php echo $query_row['id'];?>"><div class="slider round"></div></label>
     <?php
			}
			else{
				?>
           <label class="button"><input type="checkbox" class="button" onClick="reply_click(this.id)" value="stop" id="stop<?php echo $query_row['id'];?>"><div   class="slider round"></div></label>
			 <?php
			}
			?>
			
		
<script type="text/javascript">
function reply_click(checked_id)
{
	
	var res = checked_id.replace("start", "");
       res = res.replace("stop", "");
	   
	   
	   
	var fired_button = $("#"+checked_id).html(); 
	if(fired_button=="start"){
	$("#"+checked_id).html('stop');	
	$("#"+checked_id).prop('id', 'stop'+res);
	$("#"+checked_id).prop('value', 'stop');
	
	}
	else{
		$("#"+checked_id).html('start');
		$("#"+checked_id).prop('id', 'start'+res);
		$("#"+checked_id).prop('value', 'start');
	}
	
	var ser="";
	var n = checked_id.includes("start");                            
	if(n==true){
	ser=('start');
	
	}
	else{
		ser=('stop');
	}
	 
	var res = checked_id.replace("start", "");
       res = res.replace("stop", "");
    
	fetch("http://10.0.0.150/todo/timer.php?type="+ser+"&eventid="+res)
.then(alert(ser+"ed successfully"));
 
}



</script>
		
		</div>

		<?php
		}
		?>

 
		</div>
	</body>
</html>