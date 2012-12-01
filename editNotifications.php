<?php

session_start();
$submitType = $_REQUEST['submitType'];
$random = $_SESSION['random'];
echo $submitType;
echo $random;

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

	// mysql_query("UPDATE users set hour='" . $hour . "', min='" . $min . "', AMPM='". $AMPM ."' where random='" . $random ."'");
	
	echo "UPDATE users set hour='" . $hour . "', min='" . $minute . "', AMPM='". $AMPM ."' where random='" . $random ."'";
}
else 
{
	$newSetting = $_REQUEST['notificationSetting'];
	// echo $newSetting;

	mysql_query("UPDATE users set notification='" . $newSetting . "' where random='" . $random ."'");
}

// $user_id = $_SESSION['collection_user'];
// $collection_plant_id = $_REQUEST['collection_plant_id'];
// // $query = mysql_query("SELECT collection_plant_id FROM collection where user_id='" . $user_id . "'");
// // $array = mysql_fetch_array($query);
// // $user_plant_id = $array['collection_plant_id'];
// $other_info = $_REQUEST['other_info'];

// mysql_query("UPDATE users set other_info='" . $other_info . "' where collection_plant_id='" . $collection_plant_id ."'");
// // echo "<br>";

// header("Location: http://ec2-107-20-111-184.compute-1.amazonaws.com/tommy/PlantEKG/index.php?random=" . $random . "",TRUE,303);
//header( 'Location: http://ec2-107-20-111-184.compute-1.amazonaws.com/brian/PlantEKG/index.php' )
//<script language="javascript" type="text/javascript">window.top.window.msg_from_ajax("<?php echo $msg;   
?>