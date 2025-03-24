<?php
 header("refresh: 60;");
 $department=$_GET['dept'];
include 'inc/connection.inc.php';
$query_run = mysqli_query($connection, "SELECT * FROM `events` WHERE department=$department AND done=0 ORDER BY priority DESC, `time` ASC");


?>
<html><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">

<title>Sticky notes using CSS3 and Google Fonts (Step 5)</title>
<link href="./css/global.css" rel="stylesheet" type="text/css" />
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.6.4/jquery.min.js"></script>
<link href='http://fonts.googleapis.com/css?family=IM+Fell+DW+Pica+SC' rel='stylesheet' type='text/css'>

<link href="./css/css.css" rel="stylesheet" type="text/css"> 
<style type="text/css">


.alert-danger {
  padding: 20px;
  background-color: #f44336;
  color: white;
}
.alert-success {
  padding: 20px;
  background-color: #4CAF50;
  color: white;
}
.alert-warning {
  padding: 20px;
  background-color: #ff9800;
  color: white;
}
.alert-info {
  padding: 20px;
  background-color: #2196F3;
  color: white;
}


body{
  font-family:arial,sans-serif;
  margin:3em;
  background:#666;
  color:#fff;
}
h2,p{
  font-weight:normal;
  word-wrap: break-word;
}
ul,li{
  list-style:none;
}
ul{
  overflow:hidden;
  padding:3em;
}
ul li a{
  text-decoration:none;
  color:#000;
  background:#ffc;
  display:block;
  height:18vh;
  width:20vw;
  padding:1em;
  -moz-box-shadow:5px 5px 7px rgba(33,33,33,1);
  -webkit-box-shadow: 5px 5px 7px rgba(33,33,33,.7);
  box-shadow: 5px 5px 7px rgba(33,33,33,.7);
  -moz-transition:-moz-transform .15s linear;
  -o-transition:-o-transform .15s linear;
  -webkit-transition:-webkit-transform .15s linear;
}
ul li{
  margin:1em;
  float:left;
}
ul li h2{
  font-size:3vh;
  line-height: .2vh;
  padding-bottom:5vh;
}
ul li p{
 line-height: 2.2vh;
 font-size:2vh;
}

ol{text-align:center;}
ol li{display:inline;padding-right:1em;}
ol li a{color:#fff;}
</style>
</head>
<body>
  <ul id="ticker_02" class="ticker">
  <?php
  $count=0;
while($query_row = mysqli_fetch_assoc($query_run)){
	$class="";
	$count++;
	if($query_row['priority']==1)
	{
		$class="alert-info";
	}
	if($query_row['priority']==2)
	{
		$class="alert-success";
	}if($query_row['priority']==3)
	{
		$class="alert-warning";
	}if($query_row['priority']==4)
	{
		$class="alert-danger";
	}
?>
    <li >
	 <a class="<?php echo $class;?>" >
        <h2>#<?php echo $query_row['title'];?></h2>
        <p><?php echo $query_row['description'];?></p>
      </a>
    </li>
		<?php
}
	?>
    </ul>
</body>
</html>