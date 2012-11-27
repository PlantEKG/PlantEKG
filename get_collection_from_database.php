<?php

// Open connection to DB

session_start();

$user_id = $_SESSION['collection_user'];

$my_connection = mysql_connect('plantekg.cyj1bgdmdvpz.us-east-1.rds.amazonaws.com', 'PlantEKG', 'plantsrpeople') or die('Could not connect: ' . mysql_error()); // THIS WILL NEED TO CHANGE

// Open database "techview"
$database_name = 'plantekg';
mysql_select_db($database_name) or die(mysql_error()) ;

$table_name='collection';

$collection_data_array = array();
$collection_data_query = mysql_query("SELECT * FROM collection join new_plants on new_plants.plant_id=collection.plant_id where collection.user_id='" . $user_id . "' order by next_water_date");
while($collection_data_hold = mysql_fetch_array($collection_data_query))
{
	array_push($collection_data_array, $collection_data_hold);
}

$collection_data_json = json_encode($collection_data_array);

echo $collection_data_json;
?>