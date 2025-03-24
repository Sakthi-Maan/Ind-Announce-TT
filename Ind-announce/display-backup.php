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
		  display: inline-grid;
		  grid-template-columns: auto auto auto auto;
		  grid-gap: 10px;
		  background-color: #2196F3;
		  padding: 10px;
		   margin-bottom:12px;
		}
		.grid-item {
		  
		  padding: 20px;
		  font-size: 20px;
		  text-align: center;
		   
		
		 
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
		.button{
display: inline-grid;
background-color:red; 
width:100px;
border: 2px solid red;
border-radius: 8px;
 position: relative;
 margin-bottom:-12px;
  
  
  
		}
	</style>
	</head>
	<body>
		<div id="ticker_02" class="grid-container">
		<?php
		while($query_row = mysqli_fetch_assoc($query_run)){
		?>

		<div class="grid-item colour<?php echo $query_row['priority'];?>">
			
			<?php echo $query_row['description'];?><br>
			
			<button type="button" class="button" onClick="reply_click(this.id)" value="start" id="start<?php echo $query_row['id'];?>">start</button>

			<?php $query_runer = mysqli_query("SELECT * FROM `timer` WHERE task_id<=1000 AND starttime=timestamp(start_date, start_time) <= timestamp(currdate, currtime) AND timestamp(end_date, end_time) >= timestamp(currdate, currtime) AND endtime=NULL" );?>
  
     


<script type="text/javascript">
			
function reply_click(clicked_id)
{
	
	var res = clicked_id.replace("start", "");
       res = res.replace("stop", "");
	   
	   
	   
	var fired_button = $("#"+clicked_id).html(); 
	if(fired_button=="start"){
	$("#"+clicked_id).html('stop');	
	$("#"+clicked_id).prop('id', 'stop'+res);
	$("#"+clicked_id).prop('value', 'stop');
	}
	else{
		$("#"+clicked_id).html('start');
		$("#"+clicked_id).prop('id', 'start'+res);
		$("#"+clicked_id).prop('value', 'start');
	}
	
	var ser="";
	var n = clicked_id.includes("start");                            
	if(n==true){
	ser=('start');
	
	}
	else{
		ser=('stop');
	}
	 
	var res = clicked_id.replace("start", "");
       res = res.replace("stop", "");
    
	fetch("http://10.0.0.201/todo/timer.php?type="+ser+"&eventid="+res)
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