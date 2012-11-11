<?php


//$room_name = $_REQUEST['room_name'];
// $room_coord_x = $_REQUEST['room_coord_x'];
// $room_coord_y = $_REQUEST['room_coord_y'];
//$floor = $_REQUEST['floor'];

//$plant_id = $_REQUEST['plant_id'];
$user_id = $_REQUEST['user_id'];
$plant_id = $_REQUEST['plant_id'];
$pot_size = $_REQUEST['pot_size'];
//$other_info = $_REQUEST['other_info'];
$last_water_date = date_create('11/11/2012');
$next_water_date = $last_water_date->modify("+7 day");
$last_water_date->format("Y-m-d");
$next_water_date->format("Y-m-d");

// $msg = "plant_id: " . $plant_id . "<br>plant_name: " . $plant_name . "<br>spacing: " . $spacing . "<br>feed: " . $feed ."<br>water: " . $water ."<br>preferred_light: " . $preferred_light . "<br>plant_url: " . $picture_url ."<br>other_info: " . $other_info;    

// Open connection to DB
$my_connection = mysql_connect('plantekg.cyj1bgdmdvpz.us-east-1.rds.amazonaws.com', 'PlantEKG', 'plantsrpeople') or die('Could not connect: ' . mysql_error()); // THIS WILL NEED TO CHANGE

// Open database "techview"
$database_name = 'plantekg';
mysql_select_db($database_name) or die(mysql_error()) ;

// Column info for plants
$collection_table_name = 'collection';
$collection_column1 = 'user_id';
	$collection_column1_type = 'int references users(id)';
$collection_column2 = 'plant_id';
	$collection_column2_type = 'int references plants(plant_id)';
$collection_column3 = 'last_water_date';
	$collection_column3_type = 'date';
$collection_column4 = 'next_water_date';
	$collection_column4_type = 'date';
$collection_column5 = 'pot_size';
	$collection_column5_type = 'varchar(50)';
$collection_column6 = 'other_info';
	$collection_column6_type = 'varchar(255)';


mysql_query("INSERT INTO " . $collection_table_name . " (" . $collection_column1 . ", " . $collection_column2 . ", " . $collection_column3 . ", " . $collection_column4 . ", " . $collection_column5. ", " . $collection_column6 . ") VALUES ('" . $user_id . "', '" . $plant_id . "', '" . $last_water_date . "', '" . $next_water_date . "', '" . $pot_size . "')");

// <script language="javascript" type="text/javascript">window.top.window.msg_from_ajax("<?php echo $msg;   
?>