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

	$my_connection = mysql_connect('techview.cx3h6ibh7nag.us-east-1.rds.amazonaws.com', 'eecs394techview', 'showmetech') or die('Could not connect: ' . mysql_error());

	// Create Database
	$database_name = 'plantekg';
	mysql_query('CREATE DATABASE ' . $database_name);

	// Open database "techview"
	mysql_select_db($database_name) or die(mysql_error());

	$collection_table_name='collection';
	$plant_table_name='plants';

	$plant_data_query = mysql_query("SELECT * FROM " . $collection_table_name . " join " . $plant_table_name . " WHERE user_id='" . $_GET['user_id'] . "'");
	$plant_data_query2 = mysql_query("SELECT * FROM " . $plant_table_name . "WHERE plant_id = '1'");
	$plant_data = mysql_fetch_array($plant_data_query);

	$plant_data_array = array();

	while($collection_data_hold = mysql_fetch_array($plant_data_search))
	{
		array_push($plant_data_array, $collection_data_hold);
	}


	// print_r($plant_data);

	// echo displayPlant($plant_data);

	// function displayPlant($plant_data_array)
	// {
		echo $plant_data_array[1][2];		
		// echo "Plant name: " . $plant_data_array['plant_name'];
		// echo "<br><img src='" . $plant_data_array['plant_url'] . "'>";
		// echo "<br>Spacing: " . $plant_data_array['spacing'] . "";
		// echo "<br>Water: " . $plant_data_array['water'] . "";
		// echo "<br>Preferred Light: " . $plant_data_array['preferred_light'] . "";
		// echo "<br><br>";
	// }

	?>

	</div>
	<div id='back'>Go back</div>
</body>
</html>