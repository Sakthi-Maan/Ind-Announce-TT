<div class="top-info-bar">
				
	<img src="./logo.png" width="60" height="33" alt="magdyn" />			 
	Magdyn-Led-Control
<?php
if(loggedin())
{	
echo '<a href="logout.php"><button class="pull-right btn btn-danger">Logout</button></a>';
if($_SESSION['admin']!=0)
{
echo '<button id="add_task_btn" form="taskslist" type="button" class=" pull-left btn btn-info" data-toggle="modal" data-target="#myModal">User Settings</button>';
}
}
?>
	<!--<button class="pull-right btn btn-danger" data-toggle="modal" data-target="#moreInfoModal">More Info</button>-->
</div>

<div class="modal fade" id="moreInfoModal" tabindex="-1" role="dialog" aria-labelledby="moreInfoModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="moreInfoModalLabel">Magdyn-Led-Control</h4>
      </div>
      <div class="modal-body">
        ...
      </div>
    </div>
  </div>
</div>