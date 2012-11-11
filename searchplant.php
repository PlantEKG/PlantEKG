<!DOCTYPE HTML>
<html>
<head>
<title>Plant EKG</title>

<!-- CSS FILE -->
<link type="text/css" rel="stylesheet" href="main.css">

<!-- JAVASCRIPT FILE -->
<script type="text/javascript" src="main.js"></script>

<script type="text/javascript">
	
</script>

</head>
<body>
	<div id='title'>Plant EKG</div>
	<div id='content'><br><br>

	<?php
		$my_connection = mysql_connect('plantekg.cyj1bgdmdvpz.us-east-1.rds.amazonaws.com', 'PlantEKG', 'plantsrpeople') or die('Could not connect: ' . mysql_error()); // THIS WILL NEED TO CHANGE

	// Open database "techview"
	$database_name = 'plantekg';
	mysql_select_db($database_name) or die(mysql_error()) ;

	$table_name='plants';

	$plants_data_array = array();
	$plants_data_query = mysql_query("SELECT * FROM " . $table_name . " WHERE plant_name='" . $_GET['plant_name'] . "'");
	
	while($plants_data_hold = mysql_fetch_array($plants_data_query))
	{
		array_push($plants_data_array, $plants_data_hold);
	}

		echo "<div class='span3'>";
		echo "<dl>";
		echo "<h3> Plant Name: " . $plants_data_array[0][1] . "</h3>";
		echo "<img src= ". $plants_data_array[0][6] . ">";
		echo "<p> Spacing: " . $plants_data_array[0][2] . "</p>";
		echo "<p> Feed: " . $plants_data_array[0][3] . "</p>";
		echo "<p> Water: "  . $plants_data_array[0][4] . "</p>";
		echo "<p> Preferred Light: " . $plants_data_array[0][5] . "</p>";
		echo "</dl>";
		echo "</div>";
	?>

	</div>
	<div id='back'>Go back</div>
</body>
</html>