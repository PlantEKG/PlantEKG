<?php

		$my_connection = mysql_connect('plantekg.cyj1bgdmdvpz.us-east-1.rds.amazonaws.com', 'PlantEKG', 'plantsrpeople') or die('Could not connect: ' . mysql_error()); // THIS WILL NEED TO CHANGE

		// Open database "plantekg"
		$database_name = 'plantekg';
		mysql_select_db($database_name) or die(mysql_error());

		$table_name = 'users';
		$user_data_array = array();
		$query = mysql_query("SELECT * FROM " . $table_name . "");

			while($user_data_hold = mysql_fetch_array($query)) {
			array_push($user_data_array, $user_data_hold);
		}

		$numberOfUsers = count($user_data_array);

		for ($ii = 0; $ii < $numberOfUsers; $ii++ ) 
			{
				// echo "<div class='span4'>";
				// echo "<dl>";
				// echo "<h3>" . $collection_data_array[$ii][7] . "</h3>";
				// echo "<img src=". $collection_data_array[$ii][20] . " onclick='viewPlant(" . $collection_data_array[$ii][1] .")'>";
				// echo "<dt> Plant Information </dt>" . "<dd>" .$collection_data_array[$ii][5] . "</dd>";
				// echo "<dt> Next Watering Date: </dt>" . "<dd>" . $collection_data_array[$ii][3] . "</dd>";
				// //echo "<dt> User ID: </dt>" . "<dd>" . $collection_data_array[$ii][0] . "</dd>";
				// echo "<form action='delete_plant.php' method='post'>";
				// echo "<button type='submit' name='collection_plant_id' value='". $collection_data_array[$ii][6] ."'>Delete</button>";	
				// echo "</form>";
				// echo "</dl>";
				// echo "</div>";

				echo $user_data_array[$ii][0];
				echo $user_data_array[$ii][1];
				echo $user_data_array[$ii][2];
				echo $user_data_array[$ii][3];
				echo $user_data_array[$ii][4];
				echo $user_data_array[$ii][5];
				echo $user_data_array[$ii][6];
				echo $user_data_array[$ii][7];
				echo $user_data_array[$ii][8];
				echo $user_data_array[$ii][9];
				// echo $collection_data_array;

				//echo $collection_data_array[0][$ii] . "<br>";
			}




?>