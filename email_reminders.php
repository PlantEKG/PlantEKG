<?php

// Open connection to DB

session_start();

$user_id = $_SESSION['collection_user'];
$to =  $_REQUEST['email'];
$random = $_SESSION['random'];


 // echo "email this to ". $to;
 // echo "collection user is ". $user_id;

   // Open connection to DB
  $my_connection = mysql_connect('plantekg.cyj1bgdmdvpz.us-east-1.rds.amazonaws.com', 'PlantEKG', 'plantsrpeople') or die('Could not connect: ' . mysql_error()); // THIS WILL NEED TO CHANGE

  // Open database "plantekg"
  $database_name = 'plantekg';
  mysql_select_db($database_name) or die(mysql_error()) ;

  $table_name='collection';

  $collection_data_array = array();
  $collection_data_query = mysql_query("SELECT * FROM collection join new_plants on collection.plant_id=new_plants.plant_id where collection.user_id='" . $user_id . "' order by next_water_date");
  while($collection_data_hold = mysql_fetch_array($collection_data_query)) {
    array_push($collection_data_array, $collection_data_hold);
  }

  $numberOfPlants = count($collection_data_array);

  $waterDateInfo = "Below is the list of upcoming plant watering dates: \r\n ";
  $waterInfo = "";

  if($numberOfPlants > 0) 
  {
    for ($ii = 0; $ii < $numberOfPlants; $ii++ ) 
    {
        $waterInfo .= $collection_data_array[$ii][8] . " with description " . $collection_data_array[$ii][5] . " needs to be watered on " . $collection_data_array[$ii][3] ."\r\n ";
    }
  }

// echo $waterInfo;
// $message = "This is a reminder from PlantEKG for user " . $user_id . "\r\n " . $waterDateInfo . $waterInfo;
// echo $message;

  // Send mail only if there are plants that have to be watered today 
// if ($waterInfo != "")
// {
//   $headers .= "Reply-To: PlantEKG <plantekg@gmail.com>\r\n"; 
//   $headers .= "Return-Path: PlantEKG <plantekg@gmail.com>\r\n"; 
//   $headers .= "From: PlantEKG <plantekg@gmail.com>\r\n";
//   $headers .= "Organization: PlantEKG\r\n";
//   $headers .= "MIME-Version: 1.0\r\n";
//   $headers .= "Content-type: text/plain; charset=iso-8859-1\r\n";
//   $headers .= "X-Priority: 3\r\n";
//   $headers .= "X-Mailer: PHP". phpversion() ."\r\n";
//   $subject = "PlantEKG - Watering Reminders!";
//   $message = "This is a reminder from PlantEKG for user " . $user_id . "\r\n " . $waterDateInfo . $waterInfo;
//   mail($to, $subject, $message, $headers);
// }
// echo $random;
  header("Location: http://ec2-107-20-111-184.compute-1.amazonaws.com/allen/PlantEKG/index.php?random=" . $random . "",TRUE,303);
?>