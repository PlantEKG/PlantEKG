<?php

// Open connection to DB
$my_connection = mysql_connect('techview.cx3h6ibh7nag.us-east-1.rds.amazonaws.com', 'eecs394techview', 'showmetech') or die('Could not connect: ' . mysql_error()); // THIS WILL NEED TO CHANGE

// Open database "techview"
$database_name = 'plantekg';
mysql_select_db($database_name) or die(mysql_error()) ;

$table_name='collection';

$collection_data_array = array();
$collection_data_query = mysql_query("SELECT * FROM collection,plants where plants.plant_id=collection.plant_id and collection.user_id='1'");
while($collection_data_hold = mysql_fetch_array($collection_data_query))
{
	array_push($collection_data_array, $collection_data_hold);
}

$collection_data_json = json_encode($collection_data_array);

echo $collection_data_json;

?>