<?php


$next_water_date = $_REQUEST['next_water_date'];
$delta = $_REQUEST['delta_id']; //delta 1 == +1 to water date ; delta 0 == -1 to water date; 
$collection_plant_id = $_REQUEST['collection_plant_id'];

$my_connection = mysql_connect('plantekg.cyj1bgdmdvpz.us-east-1.rds.amazonaws.com', 'PlantEKG', 'plantsrpeople') or die('Could not connect: ' . mysql_error()); // THIS WILL NEED TO CHANGE

$database_name = 'plantekg';
mysql_select_db($database_name) or die(mysql_error());

$query = mysql_query("SELECT * from collection where collection_plant_id='" . $collection_plant_id ."'");
$query_row = mysql_fetch_array($query);
$avg_days = ($query_row['avg_days']);
$user_id = ($query_row['user_id']);


if($delta)
{
	$new_water_date = date('Y-m-d', strtotime($next_water_date . '+1 days'));
	$new_days = $avg_days + 1;


	mysql_query("UPDATE collection set next_water_date='" . $new_water_date . "' where collection_plant_id='" . $collection_plant_id ."'");
	mysql_query("UPDATE collection set avg_days='" . $new_days . "' where collection_plant_id='" . $collection_plant_id ."'");
}
else
{	

	if($avg_days > 1)
	{


		$new_water_date = date('Y-m-d', strtotime($next_water_date . '-1 days'));
		$new_days = $avg_days - 1;


		mysql_query("UPDATE collection set next_water_date='" . $new_water_date . "' where collection_plant_id='" . $collection_plant_id ."'");
		mysql_query("UPDATE collection set avg_days='" . $new_days . "' where collection_plant_id='" . $collection_plant_id ."'");
	}
}

$query = mysql_query("SELECT random from users where id='" . $user_id ."'");
$query_row = mysql_fetch_array($query);
$random = ($query_row['random']);

header("Location: http://ec2-107-20-111-184.compute-1.amazonaws.com/PlantEKG/index.php?random=" . $random . "",TRUE,303);


?>