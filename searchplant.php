<!DOCTYPE HTML>
<html>
<head>
<title>Plant EKG</title>

<!-- CSS FILE -->
<link type="text/css" rel="stylesheet" href="main.css">
<link href="css/bootstrap.css" rel="stylesheet" media="screen">

<!-- JAVASCRIPT FILE -->
<script type="text/javascript" src="main.js"></script>
<script src="js/bootstrap.js"></script>

<script language="javascript"> 
function toggle(showHideDiv){
	var ele = document.getElementById(showHideDiv);
	if(ele.style.display == "block") {
    		ele.style.display = "none";

  	}
	else {
		ele.style.display = "block";
	}
}

</script>

</head>
<body>
	 <div class="navbar navbar-inverse navbar-fixed-top">
      <div class="navbar-inner">
          <a class="brand" href="#" >PlantEKG</a>
      </div>
    </div>


    <div class="container">
	<?php
		$my_connection = mysql_connect('plantekg.cyj1bgdmdvpz.us-east-1.rds.amazonaws.com', 'PlantEKG', 'plantsrpeople') or die('Could not connect: ' . mysql_error()); // THIS WILL NEED TO CHANGE

	// Open database "techview"
	$database_name = 'plantekg';
	mysql_select_db($database_name) or die(mysql_error()) ;

	$table_name='plants';
	$lowercase_plant_name = strtolower($_GET['plant_name']);
	$plants_data_array = array();
	$plants_data_query = mysql_query("SELECT * FROM " . $table_name . " WHERE plant_name='" . $lowercase_plant_name . "'");
	
	while($plants_data_hold = mysql_fetch_array($plants_data_query))
	{
		array_push($plants_data_array, $plants_data_hold);
	}
		echo "<dl>";
		echo "<br><br>";
		echo "<h3> " . ucfirst($plants_data_array[0][1]) . "</h3>";
		echo "<img src= ". $plants_data_array[0][6] . ">";
		echo "<p><b> Spacing: </b>" . $plants_data_array[0][2] . "</p>";
		echo "<p><b> Feed: </b>" . $plants_data_array[0][3] . "</p>";
		echo "<p><b> Water: </b>"  . $plants_data_array[0][4] . "</p>";
		echo "<p><b> Preferred Light: </b>" . $plants_data_array[0][5] . "</p>";
		echo "</dl>";
	?>
	</div>
	<button class="btn btn-small" type="button"><a href=http://ec2-107-20-111-184.compute-1.amazonaws.com/tommy/PlantEKG/index.php>Go Back</a></button>
	<button class="btn btn-small" type="button"><a href="javascript:toggle('pot sizes')">add to collection</a></button><br><br>
	<div id='pot sizes' style="display: none;">
		<button type="button" id'large pot'><a href="javascript:toggle('add')">Large pot</a></button>
		<button type="button" id='medium pot'><a href="javascript:toggle('add')">Medium pot</a></button>
		<button type="button" id='small pot'><a href="javascript:toggle('add')">Small pot</a></button>
		<br><br>
		<div id='add' style="display: none;"><button class="btn btn-small" type="button">add</button><br><br></div>
	</div>
	




</body>
</html>