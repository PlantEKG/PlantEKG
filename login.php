<?php
	
$username = $_REQUEST['username'];
$password = $_REQUEST['password'];
$database_name = 'plantekg';
$table_name = 'users';

$my_connection = mysql_connect('plantekg.cyj1bgdmdvpz.us-east-1.rds.amazonaws.com', 'PlantEKG', 'plantsrpeople') or die('Could not connect: ' . mysql_error());

mysql_select_db($database_name) or die(mysql_error()) ;

$query = mysql_query("SELECT random FROM " . $table_name . " WHERE email='" . $username . "' and password='" . $password . "'");
$array = mysql_fetch_array($query);
$random = $array['random'];

header("Location: http://ec2-107-20-111-184.compute-1.amazonaws.com/tommy/PlantEKG/index.php?random=" . $random . "",TRUE,303);

?>