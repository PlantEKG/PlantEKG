<?php

session_start();  

$user_id = $_SESSION['collection_user'];
$plant_id = $_REQUEST['plant_id'];

echo $_SESSION['collection_user'];
echo $plant_id = $_REQUEST['plant_id'];
// echo $_REQUEST['plant_id'];
// echo $_SESSION['collection_user'];

//Open connection to DB
 $my_connection = mysql_connect('plantekg.cyj1bgdmdvpz.us-east-1.rds.amazonaws.com', 'PlantEKG', 'plantsrpeople') or die('Could not connect: ' . mysql_error()); // THIS WILL NEED TO CHANGE

// // Open database "techview"
 $database_name = 'plantekg';
 mysql_select_db($database_name) or die(mysql_error()) ;

 $collection_table_name = 'collection';
 mysql_query("DELETE FROM " . $collection_table_name . " WHERE user_id='" . $user_id . "' and plant_id='" . $plant_id . "'");

 header("Location: http://ec2-107-20-111-184.compute-1.amazonaws.com/tommy/PlantEKG/index.php?id=" . $user_id . "",TRUE,303);

?>
