<?php

$my_connection = mysql_connect('techview.cx3h6ibh7nag.us-east-1.rds.amazonaws.com', 'eecs394techview', 'showmetech') or die('Could not connect: ' . mysql_error());

// Create Database
$database_name = 'plantekg';
mysql_query('CREATE DATABASE ' . $database_name);

// Open database "techview"
mysql_select_db($database_name) or die(mysql_error()) ;

// Column info for users
$user_table_name = 'users';
$user_column1 = 'name';
	$user_column1_type = 'varchar(50)';
$user_column2 = 'email';
	$user_column2_type = 'int(11)';
$user_column3 = 'phone_number';
	$user_column3_type = 'int(11)';
$user_column4 = 'id';
	$user_column4_type = 'INT NOT NULL AUTO_INCREMENT, PRIMARY KEY (' . $user_column4 . ')';
$user_column5 = 'password';
	$user_column5_type = 'varchar(50)';
$user_column6 = 'notification_type';
	$user_column6_type = 'varchar(50)';
$user_column7 = 'other_info';
	$user_column7_type = 'varchar(255)';


// Column info for collection
$collection_table_name = 'collection';
$collection_column1 = 'user_id';
	$collection_column1_type = 'int(11)';
$collection_column2 = 'plant_id';
	$collection_column2_type = 'int(11)';
$collection_column3 = 'last_water_date';
	$collection_column3_type = 'date';
$collection_column4 = 'next_water_date';
	$collection_column4_type = 'date';
$collection_column5 = 'pot_size';
	$collection_column5_type = 'varchar(50)';
$collection_column6 = 'other_info';
	$collection_column6_type = 'varchar(255)';


// Create the user table
mysql_query('CREATE TABLE ' . $user_table_name . '(
' . $user_column1 . ' ' . $user_column1_type . ', 
' . $user_column2 . ' ' . $user_column2_type . ', 
' . $user_column3 . ' ' . $user_column3_type . ', 
' . $user_column4 . ' ' . $user_column4_type . ',
' . $user_column5 . ' ' . $user_column5_type . ',
' . $user_column6 . ' ' . $user_column6_type . ')');

// Create the user table
mysql_query('CREATE TABLE ' . $collection_table_name . '(
' . $collection_column1 . ' ' . $collection_column1_type . ', 
' . $collection_column2 . ' ' . $collection_column2_type . ', 
' . $collection_column3 . ' ' . $collection_column3_type . ', 
' . $collection_column4 . ' ' . $collection_column4_type . ',
' . $collection_column5 . ' ' . $collection_column5_type . ',
' . $collection_column6 . ' ' . $collection_column6_type . ')');


?>