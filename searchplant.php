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
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script>

</head>
<body>
	 <div class="navbar navbar-inverse navbar-fixed-top">
      <div class="navbar-inner">
          <a class="brand" href="index.php" >PlantEKG</a>
      </div>
    </div>


    <div class="container">
	<?php
		session_start();
		$my_connection = mysql_connect('plantekg.cyj1bgdmdvpz.us-east-1.rds.amazonaws.com', 'PlantEKG', 'plantsrpeople') or die('Could not connect: ' . mysql_error()); // THIS WILL NEED TO CHANGE

	// Open database "techview"
	$database_name = 'plantekg';
	mysql_select_db($database_name) or die(mysql_error()) ;

	$table_name='new_plants';
	$lowercase_plant_name = strtolower($_GET['plant_name']);
	$plants_data_array = array();
	$plants_data_query = mysql_query("SELECT * FROM " . $table_name . " WHERE latin_name='" . $lowercase_plant_name . "'");
	
	while($plants_data_hold = mysql_fetch_array($plants_data_query)) {
		array_push($plants_data_array, $plants_data_hold);
	}
		echo "<br><br><br>";
		echo "<table align='center'>";
		echo "<tr><td> <img class='rounded-corners' src= ". $plants_data_array[0][13] . "> </td>";
		echo "<td>";
		echo "<h3> " . ucfirst($plants_data_array[0][0]) . "</h3>";
		echo "<dl class='dl-horizontal' style='float:right'>";
		//echo "<dt> Latin Name: </dt> <dd>" . $plants_data_array[0][1] . "</dd>";
		echo "<dt> Spacing: </dt> <dd>" . $plants_data_array[0][7] . "</dd>";
		echo "<dt> Feed: </dt> <dd>" . $plants_data_array[0][8] . "</dd>";
		echo "<dt> Water: </dt> <dd>"  . $plants_data_array[0][11] . "</dd>";
		echo "<dt> Preferred Light: </dt> <dd>" . $plants_data_array[0][12] . "</dd>";
		//echo "<dt> Height: </dt> <dd>" . $plants_data_array[0][6] . "</dd>";
		//echo "<dt> Hardiness: </dt> <dd>" . $plants_data_array[0][5] . "</dd>";
		//echo "<dt> Preferred Light: </dt> <dd>" . $plants_data_array[0][12] . "</dd>";
		echo "</dl>";
		echo "</td> </td>";
		echo "</table>";

		$_SESSION['collection_plant'] = $plants_data_array[0][15];
	?>
	</div>

	<br><br>
	<button class="btn btn-small" type="button" onclick="toggle('pot_sizes')">Add to Collection</button>
	<button class="btn btn-small" type="button" onclick="parent.location='index.php?id=<?php echo $_SESSION['collection_user']; ?>'">Go Back</button><br><br>

	<div id='pot_sizes' style="display: none;">
		<form method="POST" action="add_plant_to_collection.php">
                       Small Pot: <input type="radio" id='large pot' value='large' name='pot_size'><br>
                       Medium Pot: <input type="radio" id='medium pot' value='medium' name='pot_size'><br>
                       Large Pot: <input type="radio" id='small pot' value ='small' name='pot_size'><br>
                       Extra Info: <input type='textbox' name='other_info'>
                       <br><br>
                       <input type='submit' value='add'>
               </form>
	</div>

</body>
</html>