<?php

session_start();

  $user_id = $_SESSION['collection_user'];

  $to = $_REQUEST['email'];
  $from = "plantekg@gmail.com";
  $subject = "Time to water your plants!";
  $message = "This is a reminder from PlantEKG for user " . $user_id . "";
  mail($to, $subject,
  $message, "From:" . $from);

  //echo $to;

  header("Location: http://ec2-107-20-111-184.compute-1.amazonaws.com/brian/PlantEKG/index.php?id=" . $user_id . "",TRUE,303);
?>