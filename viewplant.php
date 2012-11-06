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

	// $my_connection = mysql_connect('techview.cx3h6ibh7nag.us-east-1.rds.amazonaws.com', 'eecs394techview', 'showmetech') or die('Could not connect: ' . mysql_error());

	// // Create Database
	// $database_name = 'plantekg';
	// mysql_query('CREATE DATABASE ' . $database_name);

	// // Open database "techview"
	// mysql_select_db($database_name) or die(mysql_error());

	// $collection_table_name='collection';
	// $plant_table_name='plants';

	// $plant_data_query = mysql_query("SELECT * FROM " . $collection_table_name . " join " . $plant_table_name . " WHERE user_id='" . $_GET['user_id'] . "'");
	// $plant_data_query2 = mysql_query("SELECT * FROM " . $plant_table_name . "WHERE plant_id = '1'");
	// $plant_data = mysql_fetch_array($plant_data_query);

	// $plant_data_array = array();

	// while($collection_data_hold = mysql_fetch_array($plant_data_search))
	// {
	// 	array_push($plant_data_array, $collection_data_hold);
	// }


	// // print_r($plant_data);

	// // echo displayPlant($plant_data);

	// // function displayPlant($plant_data_array)
	// // {
	// 	echo $plant_data_array[1][2];		
		// echo "Plant name: " . $plant_data_array['plant_name'];
		// echo "<br><img src='" . $plant_data_array['plant_url'] . "'>";
		// echo "<br>Spacing: " . $plant_data_array['spacing'] . "";
		// echo "<br>Water: " . $plant_data_array['water'] . "";
		// echo "<br>Preferred Light: " . $plant_data_array['preferred_light'] . "";
		// echo "<br><br>";
	// }

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

	// for($ii = 0; $ii <= 7; $ii++)
	// {
	// 	echo $plants_data_array[$ii] . "";
	// 	echo "<br><br>";
	// }

	// $plants_data_json = json_encode($plants_data_array);

	// echo $plants_data_json;

	?>

	</div>
	<div id='back'>Go back</div>
</body>
</html>