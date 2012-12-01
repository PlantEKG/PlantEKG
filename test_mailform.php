<?php
//define the receiver of the email
$to = 'brianambielli2007@u.northwestern.edu';
//define the subject of the email
$subject = 'Time to water your plants!'; 
//create a boundary string. It must be unique 
//so we use the MD5 algorithm to generate a random hash
$random_hash = md5(date('r', time())); 
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
--PHP-alt-<?php echo $random_hash; ?>  
Content-Type: text/html; charset="iso-8859-1" 
Content-Transfer-Encoding: 7bit

<h2>Hello World!</h2>
<a href="http://ec2-107-20-111-184.compute-1.amazonaws.com/brian/PlantEKG/index.php?random=7a77cb98">click here </a>
<p>This is something with <b>HTML</b> formatting.</p> 

--PHP-alt-<?php echo $random_hash; ?>--
<?php
//copy current buffer contents into $message variable and delete current output buffer
$message = ob_get_clean();
//send the email
$mail_sent = @mail( $to, $subject, $message, $headers);
//if the message is sent successfully print "Mail sent". Otherwise print "Mail failed" 
echo $mail_sent ? "Mail sent" : "Mail failed";
?>