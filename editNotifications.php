<?php

session_start();
$submitType = $_REQUEST['submitType'];
$random = $_SESSION['random'];

// //Open connection to DB
$my_connection = mysql_connect('plantekg.cyj1bgdmdvpz.us-east-1.rds.amazonaws.com', 'PlantEKG', 'plantsrpeople') or die('Could not connect: ' . mysql_error()); // THIS WILL NEED TO CHANGE

// // Open database "techview"
$database_name = 'plantekg';
mysql_select_db($database_name) or die(mysql_error()) ;


if ($submitType == "Update Time")
{
	$hour = $_REQUEST['hour'];
	$minute = $_REQUEST['min'];
	$AMPM = $_REQUEST['AMPM'];

	// $newhour = $hour + 6;

	// if($AMPM == 'PM' && $hour != 12)
	// {
	// 	$newhour = $newhour + 12;

	// 	if($newhour >= 24)
	// 	{
	// 		$newhour = $newhour - 24; 
	// 	}
	// }
	mysql_query("UPDATE users set hour='" . $hour . "' where random='" . $random ."'");
	mysql_query("UPDATE users set minute='" . $minute . "' where random='" . $random ."'");
	mysql_query("UPDATE users set AMPM='" . $AMPM . "' where random='" . $random ."'");

	header("Location: http://ec2-107-20-111-184.compute-1.amazonaws.com/PlantEKG/index.php?random=" . $random . "",TRUE,303); 
}
else 
{
	$newSetting = $_REQUEST['notificationSetting'];
	// echo $newSetting;

	mysql_query("UPDATE users set notification='" . $newSetting . "' where random='" . $random ."'");
	header("Location: http://ec2-107-20-111-184.compute-1.amazonaws.com/PlantEKG/index.php?random=" . $random . "",TRUE,303); 

}

?>