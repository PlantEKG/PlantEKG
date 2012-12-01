<?php

session_start();  

$user_id = $_SESSION['collection_user'];
$random = $_SESSION['random'];
$collection_plant_id = $_REQUEST['collection_plant_id'];

//Open connection to DB
 $my_connection = mysql_connect('plantekg.cyj1bgdmdvpz.us-east-1.rds.amazonaws.com', 'PlantEKG', 'plantsrpeople') or die('Could not connect: ' . mysql_error()); // THIS WILL NEED TO CHANGE

// // Open database "techview"
 $database_name = 'plantekg';
 mysql_select_db($database_name) or die(mysql_error()) ;

 $collection_table_name = 'collection';
 mysql_query("DELETE FROM " . $collection_table_name . " WHERE user_id='" . $user_id . "' and collection_plant_id ='" . $collection_plant_id . "'");

 header("Location: http://ec2-107-20-111-184.compute-1.amazonaws.com/brian/PlantEKG/index.php?random=" . $random . "",TRUE,303);

?>