<DOCTYPE html>
<html>
<head>
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css" type="text/css">
<script type="text/javascript" src="https://code.jquery.com/jquery-3.3.1.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>


</head>
<body>
<script type="text/javascript">
$(document).ready(function() {
    $('#example').DataTable();
} );
</script>

<table id="example" class="display" style="width:100%">
        <thead>
            <tr>
                <th>SNO</th>
                <th>task_id</th>
				<th>description</th>
                <th>starttime</th>
                <th>endtime</th>
              
            </tr>
        </thead>
        <tbody>
<?php
$connect_error = 'Could not connect';
	$mysql_host = 'localhost';
	$mysql_user = 'shyam';
	$mysql_pass = 'shyam7272';
	$mysql_data = 'todo';
	
	if(!@$connection = mysqli_connect($mysql_host , $mysql_user , $mysql_pass ,$mysql_data))
		die($connect_error);

$sql="SELECT  timer.SNO, timer.task_id, events.description, timer.starttime, timer.endtime
FROM timer INNER JOIN events ON timer.task_id = events.id ORDER BY timer.SNO";
$dis="SELECT DISTINCT task_id
FROM timer";
$result=$connection->query($sql);
/*$results=$connection->query($dis);*/
 if($result->num_rows > 0){
 
 while($row=$result->fetch_assoc())
	 
	 {
		 echo "<tr><td>".$row["SNO"]."</td>
		           <td>".$row["task_id"]."</td>
		           <td>".$row["description"]."</td>
		           <td>".$row["starttime"]."</td>
		           <td>".$row["endtime"]."</td>";
	 }
 }

 mysql_close($con)

?>
		
		</tbody>
       
    </table>
	</body>
	</html>