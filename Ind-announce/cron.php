<?php

$last_line = exec("ip -4 addr show eth0 | grep -oP '(?<=inet\s)\d+(\.\d+){3}'", $retval);
echo $retval[0];
	 
?>