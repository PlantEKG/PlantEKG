<?php
//define the receiver of the email
  session_start();

  $user_id = $_REQUEST['id'];
  $to =  $_REQUEST['email'];
  $random = $_SESSION['random'];
  $imgsrc;

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

  // 11 is the index for the picture
  $numberOfPlants = count($collection_data_array);

//define the subject of the email
$subject = 'PlantEKG - Upcoming Plant Watering Dates'; 

$waterDateInfo = "Below is the list upcoming watering dates: \r\n ";
  $waterInfo;

  if($numberOfPlants > 0) 
  {
    for ($ii = 0; $ii < $numberOfPlants; $ii++ ) 
    {
      $imgsrc[$ii] = $collection_data_array[$ii][21];
      $commonName[$ii] = $collection_data_array[$ii][8];
      $description[$ii] = $collection_data_array[$ii][5];       
      $date[$ii] = $collection_data_array[$ii][3];
    } 
  }
 
 $return_page = "http://ec2-107-20-111-184.compute-1.amazonaws.com/allen/PlantEKG/index.php?random=" . $random;

//create a boundary string. It must be unique 
//so we use the MD5 algorithm to generate a random hash
$random_hash = md5(date('r', time())); 

$numberOfImg = count($imgsrc);
//define the headers we want passed. Note that they are separated with \r\n
$headers = "From: plantEKG@plantEKG.com\r\nReply-To: plantEKG@plantEKG.com";

  // $headers .= "Reply-To: PlantEKG <plantekg@gmail.com>\r\n"; 
  // $headers .= "Return-Path: PlantEKG <plantekg@gmail.com>\r\n"; 
  // $headers .= "From: PlantEKG <plantekg@gmail.com>\r\n";
  // $headers .= "Organization: PlantEKG\r\n";
  // $headers .= "MIME-Version: 1.0\r\n";
  // $headers .= "Content-type: text/plain; charset=iso-8859-1\r\n";
  // $headers .= "X-Priority: 3\r\n";
  // $headers .= "X-Mailer: PHP". phpversion() ."\r\n";
//add boundary string and mime type specification
$headers .= "\r\nContent-Type: multipart/alternative; boundary=\"PHP-alt-".$random_hash."\""; 
//define the body of the message.
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
for ($ii = 0; $ii < $numberOfImg; $ii++ ) 
{
      ?> <h3><?php echo $commonName[$ii]; ?></h3><img src=<?php echo $imgsrc[$ii] ?>><br><?php echo "Plant Description: " . $description[$ii];?><br><br><?php } ?>

<a href=<?php echo $return_page ?>>click here to see your plants</a>

--PHP-alt-<?php echo $random_hash; ?>--
<?php
//copy current buffer contents into $message variable and delete current output buffer
$message = ob_get_clean();
//send the email
$mail_sent = @mail( $to, $subject, $message, $headers);
//if the message is sent successfully print "Mail sent". Otherwise print "Mail failed" 
echo $mail_sent ? "Mail sent" : "Mail failed";
?>