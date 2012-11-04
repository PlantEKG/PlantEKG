<?php


//$room_name = $_REQUEST['room_name'];
// $room_coord_x = $_REQUEST['room_coord_x'];
// $room_coord_y = $_REQUEST['room_coord_y'];
//$floor = $_REQUEST['floor'];

$plant_id = $_REQUEST['plant_id'];
$plant_name = $_REQUEST['plant_name'];
$spacing = $_REQUEST['spacing'];
$feed = $_REQUEST['feed'];
$water = $_REQUEST['water'];
$preferred_light = $_REQUEST['preferred_light'];
$other_info = $_REQUEST['other_info'];

$msg = "plant_id: " . $plant_id . "<br>plant_name: " . $plant_name . "<br>spacing: " . $spacing . "<br>feed: " . $feed ."<br>water: " . $water ."<br>preferred_light: " . $preferred_light ."<br>other_info: " . $other_info;    

// Open connection to DB
$my_connection = mysql_connect('techview.cx3h6ibh7nag.us-east-1.rds.amazonaws.com', 'eecs394techview', 'showmetech') or die('Could not connect: ' . mysql_error()); // THIS WILL NEED TO CHANGE

// Open database "techview"
$database_name = 'plantekg';
mysql_select_db($database_name) or die(mysql_error()) ;

// Column info for plants
$room_table_name = 'plants';
$plants_column1 = 'plant_id';
	$plants_column1_type = 'int(11)';
$plants_column2 = 'plant_name';
	$plants_column2_type = 'varchar(255)';
$plants_column3 = 'spacing';
	$plants_column3_type = 'varchar(255)';
$plants_column4 = 'feed';
	$plants_column4_type = 'varchar(255)';
$plants_column5 = 'water';
	$plants_column5_type = 'varchar(255)';
$plants_column6 = 'preferred_light';
	$plants_column6_type = 'varchar(255)';
$plants_column7 = 'other_info';
	$plants_column7_type = 'varchar(255)';


mysql_query("INSERT INTO " . $room_table_name . " (" . $plants_column1 . ", " . $plants_column2 . ", " . $plants_column3 . ", " . $plants_column4 . ", " . $plants_column5 . ", " . $plants_column6. ", " . $plants_column7 . ") VALUES ('" . $plant_id . "', '" . $plant_name . "', '" . $spacing . "', '" . $feed . "', '" . $water . "', '" . $preferred_light . "', '" . $other_info . "')");


?>

<script language="javascript" type="text/javascript">window.top.window.msg_from_ajax("<?php echo $msg; ?>");</script>   