<?php

// Open connection to DB

session_start();

$user_id = $_SESSION['collection_user'];

$my_connection = mysql_connect('plantekg.cyj1bgdmdvpz.us-east-1.rds.amazonaws.com', 'PlantEKG', 'plantsrpeople') or die('Could not connect: ' . mysql_error()); // THIS WILL NEED TO CHANGE

// Open database "techview"
$database_name = 'plantekg';
mysql_select_db($database_name) or die(mysql_error()) ;

$table_name='new_plants';

$plant_name_data_array = array();
$plant_name_data_query = mysql_query("SELECT common_name,latin_name,avg_days FROM new_plants order by common_name");
while($plant_name_data_hold = mysql_fetch_array($plant_name_data_query))
{
	array_push($plant_name_data_array, $plant_name_data_hold);
}

$plant_name_data_json = json_encode($plant_name_data_array);

echo $plant_name_data_json;

?>