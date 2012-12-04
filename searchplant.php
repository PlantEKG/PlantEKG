	<?php
			session_start();

	$random = $_SESSION['random'];
	echo "<!DOCTYPE HTML>
<html>
<head>
<title>Plant EKG</title>

<!-- CSS FILE -->
<link type='text/css' rel='stylesheet' href='main.css'>
<link href='css/bootstrap.css' rel='stylesheet' media='screen'>

<!-- JAVASCRIPT FILE -->
<script type='text/javascript' src='main.js'></script>
<script src='js/bootstrap.js'></script>
<script src='//ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js'></script>

</head>
<body>";

    	$link = "index.php?random=" . $random;
      	$onclick = "onclick=\"parent.location='" . $link . "'\"";

echo "<div id='header-custom'>

 <a href=''" . $onclick . "><img id='logo-cust' src='img/logo.png'></a>
</div>


    <div class='container'>";

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

	$_SESSION['collection_plant'] = $plants_data_array[0][15];

		echo "<br><br><br><br><br><br><br><br><br>";
		echo "<table align='center'>";
		echo "<tr><td> <img class='img-rounded' src= ". $plants_data_array[0][13] . "> </td>";
		echo "<td>";
		echo "<dl class='dl-horizontal' style='float:right'>";
		//echo "<dt> Latin Name: </dt> <dd>" . $plants_data_array[0][1] . "</dd>";
		echo "<dt> Spacing: </dt> <dd>" . $plants_data_array[0][7] . "</dd>";
		echo "<dt> Feed: </dt> <dd>" . $plants_data_array[0][8] . "</dd>";
		echo "<dt> Water: </dt> <dd>"  . $plants_data_array[0][11] . "</dd>";
		echo "<dt> Preferred Light: </dt> <dd>" . $plants_data_array[0][12] . "</dd>";
		//echo "<dt> Height: </dt> <dd>" . $plants_data_array[0][6] . "</dd>";
		//echo "<dt> Hardiness: </dt> <dd>" . $plants_data_array[0][5] . "</dd>";
		//echo "<dt> Preferred Light: </dt> <dd>" . $plants_data_array[0][12] . "</dd>";
		echo "</dl></td>";
		echo "<tr><td><h4>" . ucfirst($plants_data_array[0][0]). "</h4></td>";
		//toggle('pot_sizes')
		echo "<tr><td><button class='btn btn-small' type='button' onclick=\"toggle('pot_sizes')\">Add to Collection</button>
	<button class='btn btn-small' type='button'" . $onclick. ">Go Back</button><br><br></td>
		<td><div id='pot_sizes' style='display: none;'><form method='POST' name='addPlant' onsubmit='return validateForm()' action='add_plant_to_collection.php'>
					<dl>
					Size of plant pot<br>
                	Small: <input type='radio' id='large pot' value='large' name='pot_size'><br>
                    Medium: <input type='radio' id='medium pot' value='medium' name='pot_size'><br>
                    Large: <input type='radio' id='small pot' value ='small' name='pot_size'><br>
                    Extra Info (Required) : <input type='textbox' name='other_info'>
                    </dl>
                    <br><br>
                    <input class='btn btn-small' type='submit' value='Add to my Collection'>
               </form>
	</div></td>
	</body>
	</html>";
	?>