<?php
require_once 'inc/connection.inc.php';

$id = $_GET['id'];

$query = "DELETE FROM `assign_veh` WHERE `id`=".$id ;

$query_run = mysqli_query($connection, $query);

mysqli_close($connection);

echo "Deleted successfully!";

?>  