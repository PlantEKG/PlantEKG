<?php

session_start();

//Open connection to DB
$my_connection = mysql_connect('plantekg.cyj1bgdmdvpz.us-east-1.rds.amazonaws.com', 'PlantEKG', 'plantsrpeople') or die('Could not connect: ' . mysql_error()); // THIS WILL NEED TO CHANGE

// Open database "techview"
$database_name = 'plantekg';
mysql_select_db($database_name) or die(mysql_error()) ;

$random = $_SESSION['random'];
$user_id = $_SESSION['collection_user'];
$plant_id = $_SESSION['collection_plant'];
$pot_size = $_REQUEST['pot_size'];
$other_info = $_REQUEST['other_info'];
$query = mysql_query("SELECT avg_days FROM new_plants WHERE plant_id= '" . $plant_id . "'");
$row =  mysql_fetch_array($query);
$water_frequency = intval($row['avg_days']);
$last_water_date = date('Y-m-d');
$next_water_date = date('Y-m-d', strtotime($last_water_date . ' + ' . $water_frequency . ' days'));

// echo $_SESSION['collection_user'];
// echo $_SESSION['collection_plant'];
// echo $_REQUEST['pot_size'];


// echo $last_water_date;
// echo $next_water_date;

// $msg = "plant_id: " . $plant_id . "<br>plant_name: " . $plant_name . "<br>spacing: " . $spacing . "<br>feed: " . $feed ."<br>water: " . $water ."<br>preferred_light: " . $preferred_light . "<br>plant_url: " . $picture_url ."<br>other_info: " . $other_info;    

// Column info for plants
$collection_table_name = 'collection';
$collection_column1 = 'user_id';
	$collection_column1_type = 'int references users(id)';
$collection_column2 = 'plant_id';
	$collection_column2_type = 'int references new_plants(plant_id)';
$collection_column3 = 'last_water_date';
	$collection_column3_type = 'date';
$collection_column4 = 'next_water_date';
	$collection_column4_type = 'date';
$collection_column5 = 'pot_size';
	$collection_column5_type = 'varchar(50)';
$collection_column6 = 'other_info';
	$collection_column6_type = 'varchar(255)';
$collection_column7 = 'collection_plant_id';

$collection_column8 = 'avg_days';
	$collection_column8_type = 'varchar(10)';


mysql_query("INSERT INTO " . $collection_table_name . " (" . $collection_column1 . ", " . $collection_column2 . ", " . $collection_column3 . ", " . $collection_column4 . ", " . $collection_column5. ", " . $collection_column6. ", " . $collection_column8 . ") VALUES ('" . $user_id . "', '" . $plant_id . "', '" . $last_water_date . "', '" . $next_water_date . "', '" . $pot_size . "', '" . $other_info . "', '" . $water_frequency . "')");


header("Location: http://ec2-107-20-111-184.compute-1.amazonaws.com/tommy/PlantEKG/index.php?random=" . $random . "",TRUE,303);
//header( 'Location: http://ec2-107-20-111-184.compute-1.amazonaws.com/brian/PlantEKG/index.php' )
//<script language="javascript" type="text/javascript">window.top.window.msg_from_ajax("<?php echo $msg;   
?>