<?php
$vehno=$_GET['vehno'];
$dname=$_GET['dname'];


//exec("export DISPLAY=:0.0; /usr/bin/python /home/pi/anc_nor_truck.py -t 'TN-19-P-1234' -d 'mani j'");
   $str_output = system("python test.py&");
   echo $str_output."ssss";


	
	?>