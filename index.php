<?php
session_start();

if ($_REQUEST['random'] == "")
{
	header("Location: http://ec2-107-20-111-184.compute-1.amazonaws.com/tommy/PlantEKG/loginPage.php",TRUE,303);
}
else
{
echo "<!DOCTYPE HTML>
<html>
<head>
	<title>PlantEKG</title>

<!-- CSS FILE -->
<!-- <link type='text/css' rel='stylesheet' href='main.css'> -->
<link href='css/bootstrap.css' rel='stylesheet' media='screen'>

<!-- JAVASCRIPT FILE -->
<script type='text/javascript' src='main.js'></script>
<!-- <script type='text/javascript' src='slider.js'></script> -->
<!-- JQuery for swipe -->
<!-- <script src='jquery_mobile/jquery.js'></script> -->
 <script src='js/bootstrap.js'></script>
 <script src='//ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js'></script>

</head>
<body>
 <div class='navbar navbar-inverse navbar-fixed-top'>
      <div class='navbar-inner'>
          <a class='brand' href='index.php' >PlantEKG</a>
      </div>
</div>

<div id='largestContainer'>
    <div class='container'>

    <!-- Text above the pictures of plants in the collection -->
    <br><br><br>
    <h3>My Plant Collection</h3>

      <!-- Generates the row of plants in the user's collection -->
     <div class='row' id='plantRow'>";


		$my_connection = mysql_connect('plantekg.cyj1bgdmdvpz.us-east-1.rds.amazonaws.com', 'PlantEKG', 'plantsrpeople') or die('Could not connect: ' . mysql_error()); // THIS WILL NEED TO CHANGE

		// Open database "plantekg"
		$database_name = 'plantekg';
		mysql_select_db($database_name) or die(mysql_error()) ;

		// session_start();
		$table_name2 = 'users';
		$random = $_REQUEST['random'];
		$_SESSION['random'] = $random;

		$query = mysql_query("SELECT id FROM " . $table_name2 . " WHERE random='" . $random . "'");
		$array = mysql_fetch_array($query);
		$user_id = $array['id'];
		$_SESSION['collection_user'] = $user_id;
		$current_user = $user_id;

		// Open connection to DB

		$table_name='collection';

		$collection_data_array = array();
		$collection_data_query = mysql_query("SELECT * FROM collection join new_plants on collection.plant_id=new_plants.plant_id where collection.user_id='" . $current_user . "'");
		while($collection_data_hold = mysql_fetch_array($collection_data_query)) {
			array_push($collection_data_array, $collection_data_hold);
		}
		// 11 is the index for the picture
		$numberOfPlants = count($collection_data_array);
		if($numberOfPlants > 0) 
		{
			for ($ii = 0; $ii < $numberOfPlants; $ii++ ) 
			{
				echo "<div class='span4'>";
				echo "<dl>";
				echo "<h3>" . $collection_data_array[$ii][7] . "</h3>";
				echo "<img src=". $collection_data_array[$ii][21] . " onclick='viewPlant(" . $collection_data_array[$ii][1] .")'>";
				echo "<dt> Plant Information </dt>" . "<dd>" .$collection_data_array[$ii][5] . "</dd>";
				echo "<dt> Next Watering Date: </dt>" . "<dd>" . $collection_data_array[$ii][3] . "</dd>";
				//echo "<dt> User ID: </dt>" . "<dd>" . $collection_data_array[$ii][0] . "</dd>";
				echo "<button class='btn btn-small' type='button' onclick='editPlant(" . $collection_data_array[$ii][1] .")'>Edit</button>";
				// echo "<form action='delete_plant.php' method='post'>";
				// echo "<button class='btn btn-small' type='submit' name='collection_plant_id' value='". $collection_data_array[$ii][6] ."'>Delete</button>";	
				// echo "</form>";
				echo "</dl>";
				echo "</div>";

				// echo $collection_data_array;

				//echo $collection_data_array[0][$ii] . "<br>";
			}
		}

		else {
			echo "<br><br>";
			echo "You currently have no plants! <br><br><br>";
		}
		echo "</div>";
		//echo $_SESSION['collection_user'];
		$plant_name_data_array = array();
		$plant_name_data_query = mysql_query("SELECT common_name,latin_name FROM new_plants order by common_name");
		while($plant_name_data_hold = mysql_fetch_array($plant_name_data_query)) {
			array_push($plant_name_data_array, $plant_name_data_hold);
		}
		$numberOfPlantNames = count($plant_name_data_array);

		echo "<div id='search_plants'>";
		echo "<h3>Find More Plants to Add to your Collection</h3>";
		echo "<form id='searchPlant' action='searchplant.php' method='get'>";

		echo "<select name='plant_name' onchange='this.form.submit();'>";
		echo "<option value='initial'>Find your Plant Here</option>";

		for ($ii = 0; $ii < $numberOfPlantNames; $ii++) 
		{ 
			echo "<option value='" . $plant_name_data_array[$ii][1] . "''>" . $plant_name_data_array[$ii][0] . " - " . $plant_name_data_array[$ii][1] . "</option>";
		}
		echo "</select>";
		echo "</form>";
		echo "</div>";

		echo "<div id='reminder'>
		<h3> View Watering Reminders </h3>		
			<button class='btn btn-small' onclick='showReminders()' type='button'>Click to View</button>
	</div>
		<br><br><br><br><br><br>
		<form action='loginPage.php'>
		<input type='submit' value='Logout' class='btn btn-small'>
		</form>
  </div>
      
      <footer>
      	<hr>
        <p>&copy; PlantEKG - EECS 394/405 2012</p>
      </footer>
    </div> <!-- /largestcontainer
</body>
</html>";
}
		?>