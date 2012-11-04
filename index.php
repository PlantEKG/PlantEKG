<!DOCTYPE HTML>
<html>
<head>
	<title>PlantEKG</title>

<!-- CSS FILE -->
<link type="text/css" rel="stylesheet" href="main.css">
<!-- JAVASCRIPT FILE -->
<!-- <script type="text/javascript" src="main.js"></script> -->
<!-- <script type="text/javascript" src="slider.js"></script> -->
<!-- JQuery for swipe -->
<!-- <script src="jquery_mobile/jquery.js"></script> -->

<!-- JQuery Mobile -->
<!-- <link rel="stylesheet" href="jquery_mobile/jquery.mobile-1.2.0.css" /> -->
<!-- <script src="http://code.jquery.com/jquery-1.8.2.min.js"></script> -->
<!-- <script src="jquery_mobile/jquery.mobile-1.2.0.js"></script> -->

</head>


<body id='body_div'>

	<!-- HEADER -->
	<div id='title'>PlantEKG</div>

	<div id='test'></div>

	<!-- Displays all plants belonging to the collection of the user -> Pulls information from the collection table-->
	<div id='My Plants'>Will display plants below <br><br>

	<!-- Queries the collections table from plantEKG database for all plants belonging to the current user  -->
	<?php

	// Open connection to DB
	$my_connection = mysql_connect('techview.cx3h6ibh7nag.us-east-1.rds.amazonaws.com', 'eecs394techview', 'showmetech') or die('Could not connect: ' . mysql_error()); // THIS WILL NEED TO CHANGE

	// Open database "techview"
	$database_name = 'plantekg';
	mysql_select_db($database_name) or die(mysql_error()) ;

	$table_name='collection';

	$collection_data_array = array();
	$collection_data_query = mysql_query("SELECT * FROM " . $table_name . " WHERE user_id = '1'");
	while($collection_data_hold = mysql_fetch_array($collection_data_query))
	{
		array_push($collection_data_array, $collection_data_hold);
	}

	$numberOfPlants = count($collection_data_array);

	for ($ii = 0; $ii <= $numberOfPlants; $ii++ )
	{
		for ($jj = 0; $jj < 6; $jj++)
		{
			echo $collection_data_array[$ii][$jj] . " ";
		}
		echo "<br><br>";
	}

	?>
	</div>

	<div class='add_plant_button'>
	<a href="addplant.php">Add New Plant to My Collection</a>
	<div>


</body>
</html>