 <?php
session_start();

if ($_REQUEST['random'] == "")
{
	header("Location: http://ec2-107-20-111-184.compute-1.amazonaws.com/allen/PlantEKG/loginPage.php",TRUE,303);
}
else
{
	$random = $_REQUEST['random'];
	$_SESSION['random'] = $random;
	$my_connection = mysql_connect('plantekg.cyj1bgdmdvpz.us-east-1.rds.amazonaws.com', 'PlantEKG', 'plantsrpeople') or die('Could not connect: ' . mysql_error()); // THIS WILL NEED TO CHANGE

		// Open database "plantekg"
		$database_name = 'plantekg';
		mysql_select_db($database_name) or die(mysql_error()) ;

		$plant_name_data_array = array();
		$plant_name_data_query = mysql_query("SELECT common_name,latin_name FROM new_plants order by common_name");
		while($plant_name_data_hold = mysql_fetch_array($plant_name_data_query)) {
			array_push($plant_name_data_array, $plant_name_data_hold);
		}
		$numberOfPlantNames = count($plant_name_data_array);
echo "<!DOCTYPE HTML>
<html>
<head>
	<title>PlantEKG</title>

<!-- CSS FILE -->
<link type='text/css' rel='stylesheet' href='main.css'>
<link href='css/bootstrap.css' rel='stylesheet' media='screen'>

<!-- JAVASCRIPT FILE -->
<script type='text/javascript' src='main.js'></script>
<!-- <script type='text/javascript' src='slider.js'></script> -->
<!-- JQuery for swipe -->
<!-- <script src='jquery_mobile/jquery.js'></script> -->
 <script src='js/bootstrap.js'></script>
 <script src='//ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js'></script>

</head>
<body>";

    	$link = "index.php?random=" . $random;
      	$onclick = "onclick=\"parent.location='" . $link . "'\"";

echo "<div id='header-custom'>
</div>

<div id='largestContainer'>
    <div class='container'>

    <!-- Text above the pictures of plants in the collection -->
    <br><br><br><br><br>

      <!-- Generates the row of plants in the user's collection -->
     <div class='row' id='plantRow'>

  <div class='row' id='menuRow'>

   	<div class='span4'>
  <div id='myplants'>
			<b>My Plants:</b>
		</div><br>
  </div>
  	<div class='span4'>
   		<div id='search_plants'>
		<form id='searchPlant' action='searchplant.php' method='get'>
		<select name='plant_name' onchange='this.form.submit();'>
		<option value='initial'>Find your Plant Here</option>";

		for ($ii = 0; $ii < $numberOfPlantNames; $ii++) 
		{ 
			echo "<option value='" . $plant_name_data_array[$ii][1] . "''>" . $plant_name_data_array[$ii][0] . " - " . $plant_name_data_array[$ii][1] . "</option>";
		}
		echo "</select>
		</form>
		</div>
	</div>

  <div class='span4'>
  <div id='reminder'>
			<button class='btn btn-large' onclick='showReminders()' type='button'>View Watering Reminders</button>
		</div><br>
  </div>
  </div>
  <br><br> <br><br>

        <!-- Generates the row of plants in the user's collection -->
     <div class='row' id='plantRow'>";
		
		$table_name2 = 'users';

		$query = mysql_query("SELECT id FROM " . $table_name2 . " WHERE random='" . $random . "'");
		$array = mysql_fetch_array($query);
		$user_id = $array['id'];
		$_SESSION['collection_user'] = $user_id;
		$current_user = $user_id;

		// Open connection to DB

		$table_name='collection';

		$collection_data_array = array();
		$collection_data_query = mysql_query("SELECT * FROM collection join new_plants on collection.plant_id=new_plants.plant_id where collection.user_id='" . $current_user . "' order by common_name, latin_name, other_info");
		while($collection_data_hold = mysql_fetch_array($collection_data_query)) {
			array_push($collection_data_array, $collection_data_hold);
		}
		$avg_days_data_array = array();
		$avg_days_data_query = mysql_query("SELECT * FROM collection");
		while($avg_days_data_hold = mysql_fetch_array($avg_days_data_query)) {
			array_push($avg_days_data_array, $avg_days_data_hold);
		}

		// 11 is the index for the picture
		$numberOfPlants = count($collection_data_array);
		$collection_avg_days = 0;
		$numberOfAllPlants = count($avg_days_data_array);
		$avgDays;

		for ($jj =0; $jj < $numberOfAllPlants; $jj++)
		{
			for ($ii = 0; $ii < $numberOfPlants; $ii++)
			{
				if($collection_data_array[$ii][6] == $avg_days_data_array[$jj][6])
				{
					// $avgDays[$ii] = $avg_days_data_array[$jj][7];
					$avgDays[$ii] = $avg_days_data_array[$jj][7];
				}
			}
		}

		if($numberOfPlants > 0) 
		{
			for ($ii = 0; $ii < $numberOfPlants; $ii++ ) 
			{
				// Matches up the collection_plant_ids and then saves the avg_days from the collection query 
				// if ($collection_data_array[$ii][6] == $avg_days_data_array[$ii][6])
				// {
				// 	$collection_avg_days = $avg_days_data_array[$ii][6];
				// }
				$origDate = $collection_data_array[$ii][3];
				$formattedDate = date("m/d", strtotime($origDate));
				echo "<div class='span45'>";
				echo "<dl>";
				// echo "<h3>" . $collection_data_array[$ii][8] . "</h3>";
				echo "<img class='img-rounded' src=". $collection_data_array[$ii][21] . " onclick='viewPlant(" . $collection_data_array[$ii][1] .")'>";
				echo "<dt>" . $collection_data_array[$ii][8] . "</dt>" . "<dd>" .$collection_data_array[$ii][5] . "</dd>";
				echo "<dt id='water-color'> Next Watering : " . $formattedDate . "</dt>";
				//echo "<dt> User ID: </dt>" . "<dd>" . $collection_data_array[$ii][0] . "</dd>";
				echo "<button class='btn btn-large' type='button' onclick='editPlant(" . $collection_data_array[$ii][1] .", " . $avgDays[$ii] . ")'>Edit</button>";
				echo "</dl>";
				echo "</div>";
			}
		}

		else {
			echo "<br><br>";
			echo "You currently have no plants! <br><br><br>";
		}
		echo "</div>";
		//echo $_SESSION['collection_user'];

		echo "
		<br>
		<button class='btn btn-large' onclick='editNotifications()' type='button'>Edit Notification Settings</button>
		<br><br>
		<form action='loginPage.php'>
		<input type='submit' value='Logout' onclick=\"return confirm('Are you sure you want to logout?');\" class='btn btn-large'>
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