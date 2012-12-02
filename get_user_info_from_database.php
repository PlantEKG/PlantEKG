<?php

// Open connection to DB

session_start();

$user_id = $_SESSION['collection_user'];
$random = $_SESSION['random'];

$my_connection = mysql_connect('plantekg.cyj1bgdmdvpz.us-east-1.rds.amazonaws.com', 'PlantEKG', 'plantsrpeople') or die('Could not connect: ' . mysql_error()); // THIS WILL NEED TO CHANGE

// Open database "techview"
$database_name = 'plantekg';
mysql_select_db($database_name) or die(mysql_error()) ;

$table_name='users';

$user_data_array = array();
$user_data_query = mysql_query("SELECT * FROM users where random='" . $random  . "'");
while($user_data_hold = mysql_fetch_array($user_data_query))
{
	array_push($user_data_array, $user_data_hold);
}

$user_data_json = json_encode($user_data_array);

echo $user_data_json;
?>