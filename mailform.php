<?php

session_start();

  $user_id = $_SESSION['collection_user'];

  // $to = $_REQUEST['email'];
  $to = "brianambielli2007@u.northwestern.edu";
  $date = date('Y-m-d');

  // Open connection to DB
  $my_connection = mysql_connect('plantekg.cyj1bgdmdvpz.us-east-1.rds.amazonaws.com', 'PlantEKG', 'plantsrpeople') or die('Could not connect: ' . mysql_error()); // THIS WILL NEED TO CHANGE

  // Open database "plantekg"
  $database_name = 'plantekg';
  mysql_select_db($database_name) or die(mysql_error()) ;

  $table_name='collection';

  $collection_data_array = array();
  $collection_data_query = mysql_query("SELECT * FROM collection join new_plants on collection.plant_id=new_plants.plant_id where collection.user_id='" . $user_id . "'");
  while($collection_data_hold = mysql_fetch_array($collection_data_query)) {
    array_push($collection_data_array, $collection_data_hold);
  }

  // 11 is the index for the picture
  $numberOfPlants = count($collection_data_array);
  // $fakeDate = date('2012-11-22');

  $waterInfo = "You have to water the following plants TODAY (" . $date . "): \r\n ";
  if($numberOfPlants > 0) 
  {
    for ($ii = 0; $ii < $numberOfPlants; $ii++ ) 
    {
      // Name of plant 
      echo "<h3>" . $collection_data_array[$ii][7] . "</h3>";
      echo "<dt> Plant Information </dt>" . "<dd>" .$collection_data_array[$ii][5] . "</dd>";
      echo "<dt> Next Watering Date: </dt>" . "<dd>" . $collection_data_array[$ii][6] . "</dd>";
      if ($date == $collection_data_array[$ii][3])
      {
        $waterInfo .= $collection_data_array[$ii][7] . " with description " . $collection_data_array[$ii][5] . "\r\n ";
      } 
    }
  }

  // echo $waterInfo;
  // echo $date;
  // echo $fakeDate;


  $headers .= "Reply-To: PlantEKG <plantekg@gmail.com>\r\n"; 
  $headers .= "Return-Path: PlantEKG <plantekg@gmail.com>\r\n"; 
  $headers .= "From: PlantEKG <plantekg@gmail.com>\r\n";
  $headers .= "Organization: PlantEKG\r\n";
  $headers .= "MIME-Version: 1.0\r\n";
  $headers .= "Content-type: text/plain; charset=iso-8859-1\r\n";
  $headers .= "X-Priority: 3\r\n";
  $headers .= "X-Mailer: PHP". phpversion() ."\r\n";
  $subject = "Time to water your plants!";
  $message = "This is a reminder from PlantEKG for user " . $user_id . "\r\n " . $waterInfo;
  mail($to, $subject, $message, $headers);

  //echo $to;

  header("Location: http://ec2-107-20-111-184.compute-1.amazonaws.com/brian/PlantEKG/index.php?id=" . $user_id . "",TRUE,303);



?>