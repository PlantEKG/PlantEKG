<?php

session_start();

//Open connection to DB
$my_connection = mysql_connect('plantekg.cyj1bgdmdvpz.us-east-1.rds.amazonaws.com', 'PlantEKG', 'plantsrpeople') or die('Could not connect: ' . mysql_error()); // THIS WILL NEED TO CHANGE

// Open database "techview"
$database_name = 'plantekg';
mysql_select_db($database_name) or die(mysql_error()) ;

$random = $_SESSION['random'];
$user_id = $_SESSION['collection_user'];
$collection_plant_id = $_REQUEST['collection_plant_id'];
// $query = mysql_query("SELECT collection_plant_id FROM collection where user_id='" . $user_id . "'");
// $array = mysql_fetch_array($query);
// $user_plant_id = $array['collection_plant_id'];
$other_info = $_REQUEST['other_info'];
mysql_query("UPDATE collection set other_info='" . $other_info . "' where collection_plant_id='" . $collection_plant_id ."'");
// echo "<br>";

header("Location: http://ec2-107-20-111-184.compute-1.amazonaws.com/tommy/PlantEKG/index.php?random=" . $random . "",TRUE,303);
//header( 'Location: http://ec2-107-20-111-184.compute-1.amazonaws.com/brian/PlantEKG/index.php' )
//<script language="javascript" type="text/javascript">window.top.window.msg_from_ajax("<?php echo $msg;   
?>