<?php

$my_connection = mysql_connect('plantekg.cyj1bgdmdvpz.us-east-1.rds.amazonaws.com', 'PlantEKG', 'plantsrpeople') or die('Could not connect: ' . mysql_error());

// Create Database
$database_name = 'plantekg';
mysql_query('CREATE DATABASE IF NOT EXISTS ' . $database_name);

// Open database "techview"
mysql_select_db($database_name) or die(mysql_error());

// Column info for users
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
$user_column6 = 'notification_type';
	$user_column6_type = 'varchar(50)';
$user_column7 = 'random';
	$user_column7_type = 'varchar(255)';


// Column info for collection
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


// Column info for plants
$plant_table_name = 'plants';
$plants_column1 = 'plant_id';
	$plants_column1_type = 'INT NOT NULL AUTO_INCREMENT, PRIMARY KEY (' . $plants_column1 . ')';
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
$plants_column7 = 'plant_url';
	$plants_column7_type = 'varchar(255)';
$plants_column8 = 'other_info';
	$plants_column8_type = 'varchar(255)';


// new plants
$nplant_table_name = 'new_plants';
$nplant_column1 = 'common_name';
	$nplant_column1_type = 'varchar(255)';
$nplant_column2 = 'latin_name';
	$nplant_column2_type = 'varchar(255)';
$nplant_column3 = 'features';
	$nplant_column3_type = 'varchar(255)';
$nplant_column4 = 'bloom_color';
	$nplant_column4_type = 'varchar(255)';
$nplant_column5 = 'blooms';
	$nplant_column5_type = 'varchar(255)';
$nplant_column6 = 'hardiness';
	$nplant_column6_type = 'varchar(255)';
$nplant_column7 = 'height';
	$nplant_column7_type = 'varchar(255)';
$nplant_column8 = 'spacing';
	$nplant_column8_type = 'varchar(255)';
$nplant_column9 = 'feed';
	$nplant_column9_type = 'varchar(255)';
$nplant_column10 = 'tips';
	$nplant_column10_type = 'varchar(255)';
$nplant_column11 = 'habit';
	$nplant_column11_type = 'varchar(255)';
$nplant_column12 = 'water';
	$nplant_column12_type = 'varchar(255)';
$nplant_column13 = 'preferred_light';
	$nplant_column13_type = 'varchar(255)';
$nplant_column14 = 'image';
	$nplant_column14_type = 'varchar(255)';
$nplant_column15 = 'avg_days';
	$nplant_column15_type = 'varchar(255)';
$nplant_column16 = 'plant_id';
	$nplant_column16_type = 'INT NOT NULL AUTO_INCREMENT, PRIMARY KEY (' . $nplant_column16 . ')';

// Create the user table
mysql_query('CREATE TABLE IF NOT EXISTS ' . $user_table_name . '(
' . $user_column1 . ' ' . $user_column1_type . ', 
' . $user_column2 . ' ' . $user_column2_type . ', 
' . $user_column3 . ' ' . $user_column3_type . ', 
' . $user_column4 . ' ' . $user_column4_type . ',
' . $user_column5 . ' ' . $user_column5_type . ',
' . $user_column6 . ' ' . $user_column6_type . ',
' . $user_column7 . ' ' . $user_column7_type . ')');

// Create the user table
mysql_query('CREATE TABLE IF NOT EXISTS ' . $collection_table_name . '(
' . $collection_column1 . ' ' . $collection_column1_type . ', 
' . $collection_column2 . ' ' . $collection_column2_type . ', 
' . $collection_column3 . ' ' . $collection_column3_type . ', 
' . $collection_column4 . ' ' . $collection_column4_type . ',
' . $collection_column5 . ' ' . $collection_column5_type . ',
' . $collection_column6 . ' ' . $collection_column6_type . ')');

// Create the plants table
mysql_query('CREATE TABLE IF NOT EXISTS ' . $plant_table_name . '(
' . $plants_column1 . ' ' . $plants_column1_type . ', 
' . $plants_column2 . ' ' . $plants_column2_type . ', 
' . $plants_column3 . ' ' . $plants_column3_type . ', 
' . $plants_column4 . ' ' . $plants_column4_type . ',
' . $plants_column5 . ' ' . $plants_column5_type . ',
' . $plants_column6 . ' ' . $plants_column6_type . ',
' . $plants_column7 . ' ' . $plants_column7_type . ',
' . $plants_column8 . ' ' . $plants_column8_type . ')');

// Create new plants table
mysql_query('CREATE TABLE IF NOT EXISTS ' . $nplant_table_name . '(
' . $nplant_column1 . ' ' . $nplant_column1_type . ', 
' . $nplant_column2 . ' ' . $nplant_column2_type . ', 
' . $nplant_column3 . ' ' . $nplant_column3_type . ', 
' . $nplant_column4 . ' ' . $nplant_column4_type . ',
' . $nplant_column5 . ' ' . $nplant_column5_type . ',
' . $nplant_column6 . ' ' . $nplant_column6_type . ',
' . $nplant_column7 . ' ' . $nplant_column7_type . ',
' . $nplant_column8 . ' ' . $nplant_column8_type . ',
' . $nplant_column9 . ' ' . $nplant_column9_type . ', 
' . $nplant_column10 . ' ' . $nplant_column10_type . ', 
' . $nplant_column11 . ' ' . $nplant_column11_type . ', 
' . $nplant_column12 . ' ' . $nplant_column12_type . ',
' . $nplant_column13 . ' ' . $nplant_column13_type . ',
' . $nplant_column14 . ' ' . $nplant_column14_type . ',
' . $nplant_column15 . ' ' . $nplant_column15_type . ',
' . $nplant_column16 . ' ' . $nplant_column16_type . ')');

?>