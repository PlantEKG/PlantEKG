<!DOCTYPE HTML>
<html>
<head>
	<title>PlantEKG</title>

<!-- CSS FILE -->
<!-- <link type="text/css" rel="stylesheet" href="main.css"> -->
<link href="css/bootstrap.css" rel="stylesheet" media="screen">

<!-- JAVASCRIPT FILE -->
<!-- <script type="text/javascript" src="main.js"></script> -->
<!-- <script type="text/javascript" src="slider.js"></script> -->
<!-- JQuery for swipe -->
<!-- <script src="jquery_mobile/jquery.js"></script> -->
 <script src="js/bootstrap.js"></script>


<!-- JQuery Mobile -->
<!-- <link rel="stylesheet" href="jquery_mobile/jquery.mobile-1.2.0.css" /> -->
<!-- <script src="http://code.jquery.com/jquery-1.8.2.min.js"></script> -->
<!-- <script src="jquery_mobile/jquery.mobile-1.2.0.js"></script> -->

</head>
<body>
 <div class="navbar navbar-inverse navbar-fixed-top">
      <div class="navbar-inner">
          <a class="brand" href="#" >PlantEKG</a>
      </div>
    </div>

    <div class="container">

      <!-- Main hero unit for a primary marketing message or call to action -->
      <div class="hero-unit">
        <h3>Plants in my Collection</h3>
      </div>

      <!-- Example row of columns -->
      <div class="row">
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

	for ($ii = 0; $ii < $numberOfPlants; $ii++ )
	{
		echo "<div class='span4'>";
		echo "<dl>";
		echo "<h3> Plant " . $collection_data_array[$ii][1] . "</h3>";
		echo "<dt> Plant Information </dt>" . "<dd>" .$collection_data_array[$ii][5] . "</dd>";
		echo "<dt> Next Watering Date: </dt>" . "<dd>" . $collection_data_array[$ii][3] . "</dd>";
		echo "</dl>";
		echo "</div>";

	}

	?>

      </div>

	<div class='search_plants'>
		<h3>Find More Plants to Add to your Collection</h3>
		<form action="addplant.php" method="get">
		Search for a plant name <br><input type="text" name="plant_name" onclick="this.value='';" onfocus="this.select()" onblur="this.value=!this.value?'Enter name here...':this.value;" value="Enter name here..." size="40"/><br>
		<input type="submit" value="Submit">
		</form>
	<div>
      <hr>

      <footer>
        <p>&copy; PlantEKG - EECS 394/405 2012</p>
      </footer>

    </div> <!-- /container -->
</body>
</html>