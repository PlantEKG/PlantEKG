<!DOCTYPE HTML>
<html>
<head>
	<title>PlantEKG</title>

<!-- CSS FILE -->
<!-- <link type="text/css" rel="stylesheet" href="main.css"> -->
<link href="css/bootstrap.css" rel="stylesheet" media="screen">

<!-- JAVASCRIPT FILE -->
<script type="text/javascript" src="main.js"></script>
<!-- <script type="text/javascript" src="slider.js"></script> -->
<!-- JQuery for swipe -->
<!-- <script src="jquery_mobile/jquery.js"></script> -->
 <script src="js/bootstrap.js"></script>

</head>
<body>
 <div class="navbar navbar-inverse navbar-fixed-top">
      <div class="navbar-inner">
          <a class="brand" href="#" >PlantEKG</a>
      </div>
    </div>

    <div id="largestContainer">
    <div class="container">

      <!-- Main hero unit for a primary marketing message or call to action -->
      <div class="hero-unit">
        <h3>Plants in my Collection</h3>
      </div>

      <!-- Example row of columns -->
      <div class="row">
	<?php

	session_start();

	$_SESSION['collection_user'] = $_REQUEST['id'];
	$current_user = $_REQUEST['id'];
	//echo $current_user;

	// Open connection to DB
	$my_connection = mysql_connect('plantekg.cyj1bgdmdvpz.us-east-1.rds.amazonaws.com', 'PlantEKG', 'plantsrpeople') or die('Could not connect: ' . mysql_error()); // THIS WILL NEED TO CHANGE

	// Open database "techview"
	$database_name = 'plantekg';
	mysql_select_db($database_name) or die(mysql_error()) ;

	$table_name='collection';

	$collection_data_array = array();
	// $collection_data_query = mysql_query("SELECT * FROM " . $table_name . " WHERE user_id = '1'");
	$collection_data_query = mysql_query("SELECT * FROM collection,plants where plants.plant_id=collection.plant_id and collection.user_id='" . $current_user . "'");
	while($collection_data_hold = mysql_fetch_array($collection_data_query))
	{
		array_push($collection_data_array, $collection_data_hold);
	}
// 11 is the index for the picture
	$numberOfPlants = count($collection_data_array);
if($numberOfPlants > 0){
	for ($ii = 0; $ii < $numberOfPlants; $ii++ )
	{
		echo "<div class='span4'>";
		echo "<dl>";
		echo "<h3>" . $collection_data_array[$ii][7] . "</h3>";
		echo "<img src=". $collection_data_array[$ii][12] . " onclick='viewPlant(" . $collection_data_array[$ii][1] .")'>";
		echo "<dt> Plant Information </dt>" . "<dd>" .$collection_data_array[$ii][5] . "</dd>";
		echo "<dt> Next Watering Date: </dt>" . "<dd>" . $collection_data_array[$ii][3] . "</dd>";
		//echo "<dt> User ID: </dt>" . "<dd>" . $collection_data_array[$ii][0] . "</dd>";
		echo "</dl>";
		echo "</div>";
	}
}
else
{
	echo "You currently have no plants!";
}



	//echo $_SESSION['collection_user'];

	?>

    </div>

	<div class='search_plants'>
		<h3>Find More Plants to Add to your Collection</h3>
		<!-- <form action="add_plant.php" method="get"> -->
		<!-- <form action="viewplant.php" method="get"> -->
		<form action="searchplant.php" method="get">
		Search for a plant name <br><input type="text" name="plant_name" onclick="this.value='';" onfocus="this.select()" onblur="this.value=!this.value?'Enter name here...':this.value;" value="Enter name here..." size="40"/><br>
		<input type="submit" value="Submit">
		</form>
	<div>
	</div>
      <hr>

      <footer>
        <p>&copy; PlantEKG - EECS 394/405 2012</p>
      </footer>

    </div> <!-- /container -->
</body>
</html>