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
  $waterAmount;

  if($numberOfPlants > 0) 
  {
    $jj=0;
    for ($ii = 0; $ii < $numberOfPlants; $ii++ ) 
    {
        switch ($collection_data_array[$ii][4]) 
        {
            case "small":
                $waterAmount[$jj] = "1 cup of water";
                break;
            case "medium":
                $waterAmount[$jj] = "2 cups of water";
                break;
            case "large":
               $waterAmount[$jj] = "3 cups of water";
                break;
        }
        $imgsrc[$jj] = $collection_data_array[$ii][21];
        $commonName[$jj] = $collection_data_array[$ii][8];
        $description[$jj] = $collection_data_array[$ii][5];
        $dates[$jj] = $collection_data_array[$ii][3];
        $waterInfo .= $collection_data_array[$ii][8] . " with description " . $collection_data_array[$ii][5] . " needs to be watered on " . $collection_data_array[$ii][3] ."\r\n ";
        $jj++;
    }
  }

// echo $waterInfo;
// $message = "This is a reminder from PlantEKG for user " . $user_id . "\r\n " . $waterDateInfo . $waterInfo;
// echo $message;

  //create a boundary string. It must be unique 
  //so we use the MD5 algorithm to generate a random hash
  $random_hash = md5(date('r', time())); 

  $numberOfImg = count($imgsrc);
  //define the headers we want passed. Note that they are separated with \r\n
  $headers = "From: plantEKG@plantEKG.com\r\nReply-To: plantEKG@plantEKG.com";
$headers .= "\r\nContent-Type: multipart/alternative; boundary=\"PHP-alt-".$random_hash."\""; 
//define the body of the message.

 $return_page = "http://ec2-107-20-111-184.compute-1.amazonaws.com/allen/PlantEKG/index.php?random=" . $random;

ob_start(); //Turn on output buffering
?>

--PHP-alt-<?php echo $random_hash;?>  
Content-Type: text/html; charset="iso-8859-1" 
Content-Transfer-Encoding: 7bit

<img src="http://ec2-107-20-111-184.compute-1.amazonaws.com/allen/PlantEKG/img/logo.png" height="125" width="290"><br>

<?php 
echo $waterDateInfo;
?>
<br>
<?php
for ($ii = 0; $ii < $numberOfImg; $ii++) 
{
      ?> <h3><?php echo $commonName[$ii]; ?></h3><img src=<?php echo $imgsrc[$ii] ?>><br><?php echo "Plant Description: " . $description[$ii]?><br><?php echo "Next Water Date: " . $dates[$ii]?><br><?php echo "Estimated Watering Amount: " . $waterAmount[$ii]?><br><?php } ?>

<a href=<?php echo $return_page ?>>click here to see your plants</a>

--PHP-alt-<?php echo $random_hash; ?>--
<?php
//copy current buffer contents into $message variable and delete current output buffer
$message = ob_get_clean();
//send the email
$mail_sent = @mail( $to, $subject, $message, $headers);

header("Location: http://ec2-107-20-111-184.compute-1.amazonaws.com/PlantEKG/index.php?random=" . $random . "",TRUE,303);
?>

