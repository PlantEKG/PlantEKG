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

		$hour = date('H');
		$minute = date('i');



		for ($ii = 0; $ii < $numberOfUsers; $ii++ ) 
			{

				$usrhour =  $user_data_array[$ii][7];
				$AMPM = $user_data_array[$ii][9];
				$usrminute = $user_data_array[$ii][8];
				$user_id = $user_data_array[$ii][3];
				$email = $user_data_array[$ii][1];
				$usernote = $user_data_array[$ii][6];

				$newhour = $usrhour + 6;


				if($AMPM == 'PM' && $usrhour != 12)
				{
						$newhour = $newhour + 12;

					if($newhour >= 24)
					{
						$newhour = $newhour - 24; 
					}
				}

				if($usernote == 'Y' && $hour == $newhour && $usrminute== $minute)
				{
					header("Location: http://ec2-107-20-111-184.compute-1.amazonaws.com/tommy/PlantEKG/test_mailform.php?id=" . $user_id . "&email=" . $email . "",TRUE,303);
				}

				// echo $newhour;
				// echo $email;
				// echo $usrminute;
				// echo $user_data_array[$ii][3]; //id
				// echo $user_data_array[$ii][5]; //random
				// echo $user_data_array[$ii][6]; //notification (Y or N) 
				// echo $user_data_array[$ii][7]; //hour
				// echo $user_data_array[$ii][8]; //minute
				// echo $user_data_array[$ii][9]; //AM/PM
				// echo $collection_data_array;

				//echo $collection_data_array[0][$ii] . "<br>";
			}

?>