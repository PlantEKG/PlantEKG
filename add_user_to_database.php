<?php

$name = $_REQUEST['name'];
$email = $_REQUEST['email'];
$phone = $_REQUEST['phone_number'];
$password = $_REQUEST['password'];
$hour = $_REQUEST['hour'];
$minute = $_REQUEST['min'];
$AMPM = $_REQUEST['AMPM'];

$newhour = $hour + 6;

if($AMPM == 'PM' && $hour != 12)
{
	$newhour = $newhour + 12;

	if($newhour >= 24)
	{
		$newhour = $newhour - 24; 
	}
}

$random = md5(sha1(time() + rand(0, time())));
  
// Open connection to DB
$my_connection = mysql_connect('plantekg.cyj1bgdmdvpz.us-east-1.rds.amazonaws.com', 'PlantEKG', 'plantsrpeople') or die('Could not connect: ' . mysql_error()); // THIS WILL NEED TO CHANGE

// Open database "techview"
$database_name = 'plantekg';
mysql_select_db($database_name) or die(mysql_error()) ;

// Column info for plants
$user_table_name = 'users';
$user_column1 = 'name';
	$user_column1_type = 'varchar(50)';
$user_column2 = 'email';
	$user_column2_type = 'varchar(60)';
$user_column3 = 'phone_number';
	$user_column3_type = 'varchar(30)';
$user_column4 = 'id';
	$user_column4_type = 'INT NOT NULL AUTO_INCREMENT, PRIMARY KEY (' . $user_column4 . ')';
$user_column5 = 'password';
	$user_column5_type = 'varchar(50)';
$user_column6 = 'random';
	$user_column6_type = 'varchar(8)';
$user_column7 = 'notification';
	$user_column7_type = 'varchar(10)';
$user_column8 = 'hour';
	$user_column8_type = 'varchar(10)';
$user_column9 = 'minute';
	$user_column9_type = 'varchar(10)';
$user_column10 = 'AMPM';
	$user_column10_type = 'varchar(10)';

$notification = 'Y';



mysql_query("INSERT INTO " . $user_table_name . " (" . $user_column1 . ", " . $user_column2 . ", " . $user_column3 . ", " . $user_column5 . ", " . $user_column6 . ", " . $user_column7 . ",  " . $user_column8 . ", " . $user_column9 . ", " . $user_column10 .") VALUES ('" . $name . "', '" . $email . "', '" . $phone . "', '" . $password . "', '" . $random . "', '" . $notification . "', '" . $hour . "', '" . $minute . "', '" . $AMPM . "')");

header("Location: http://ec2-107-20-111-184.compute-1.amazonaws.com/brian/PlantEKG/loginPage.php",TRUE,303);


?>