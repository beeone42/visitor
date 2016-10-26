<?php

echo "OK";

$to = $_REQUEST['visited_email']; 
$subject = $_REQUEST['visitor_name'].' is here and waiting for you'; 
$random_hash = md5(date('r', time())); 
$headers = "From: ".$_REQUEST['visitor_email']."\r\nReply-To: ".$_REQUEST['visitor_email']; 
$headers .= "\r\nContent-Type: multipart/mixed; boundary=\"PHP-mixed-".$random_hash."\""; 

$tmp = split(',', $_REQUEST['photo']);
$photo = chunk_split($tmp[1]);
$tmp = split(',', $_REQUEST['sig']);
$sig = chunk_split($tmp[1]); 

ob_start(); //Turn on output buffering 
?> 
--PHP-mixed-<?php echo $random_hash; ?>  
Content-Type: multipart/alternative; boundary="PHP-alt-<?php echo $random_hash; ?>" 

--PHP-alt-<?php echo $random_hash; ?>  
Content-Type: text/plain; charset="iso-8859-1" 
Content-Transfer-Encoding: 7bit

<?php echo $_REQUEST['visitor_name'] ?> is arrived and is waiting for you.

--PHP-alt-<?php echo $random_hash; ?>  
Content-Type: text/html; charset="iso-8859-1" 
Content-Transfer-Encoding: 7bit

<h3><?php echo $_REQUEST['visitor_name'] ?></h3> 
<p>is arrived and is waiting for you.</p> 
<img src="cid:photocid">
<img src="cid:sigcid">

--PHP-alt-<?php echo $random_hash; ?>-- 
--PHP-mixed-<?php echo $random_hash; ?>  
Content-Type: image/jpeg; name="photo.jpg"  
Content-Transfer-Encoding: base64  
Content-ID: <photocid>
Content-Disposition: inline, filename="photo.jpg"

<?php echo $photo; ?> 

--PHP-mixed-<?php echo $random_hash; ?>  
Content-Type: image/png; name="sig.png"  
Content-Transfer-Encoding: base64  
Content-ID: <sigcid>
Content-Disposition: inline, filename="sig.png"

<?php echo $sig; ?> 

--PHP-mixed-<?php echo $random_hash; ?>-- 

<?php 
//copy current buffer contents into $message variable and delete current output buffer 
$message = ob_get_clean(); 
//send the email 
$mail_sent = mail( $to, $subject, $message, $headers ); 
//if the message is sent successfully print "Mail sent". Otherwise print "Mail failed" 
echo $mail_sent ? "Mail sent" : "Mail failed"; 

?>