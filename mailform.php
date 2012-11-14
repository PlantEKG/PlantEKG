<?php

session_start();

  $user_id = $_SESSION['collection_user'];

  $to = $_REQUEST['email'];
  $headers .= "Reply-To: PlantEKG <plantekg@ec2-107-20-111-184.compute-1.amazonaws.com>\r\n"; 
  $headers .= "Return-Path: PlantEKG <plantekg@ec2-107-20-111-184.compute-1.amazonaws.com>\r\n"; 
  $headers .= "From: PlantEKG <plantekg@ec2-107-20-111-184.compute-1.amazonaws.com>\r\n";
  $headers .= "Organization: PlantEKG\r\n";
  $headers .= "MIME-Version: 1.0\r\n";
  $headers .= "Content-type: text/plain; charset=iso-8859-1\r\n";
  $headers .= "X-Priority: 3\r\n";
  $headers .= "X-Mailer: PHP". phpversion() ."\r\n";
  $subject = "Time to water your plants!";
  $message = "This is a reminder from PlantEKG for user " . $user_id . "";
  mail($to, $subject, $message, $headers);

  //echo $to;

  header("Location: http://ec2-107-20-111-184.compute-1.amazonaws.com/brian/PlantEKG/index.php?id=" . $user_id . "",TRUE,303);
?>