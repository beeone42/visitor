<?php

include("config.php");
include("class.phpmailer.php");

if (isset($config) && ($config['slack_token'] != ""))
  {
    $url = "https://slack.com/api/chat.postMessage?token=".
      $config['slack_token'].
      "&channel=".$config['slack_channel'].
      "&as_user=false";

    $txt = $_REQUEST['visitor_name'].' is here and waiting for you';
    $tmp["fallback"] = preg_replace("/[^A-Za-z0-9.]/", '.', trim($txt));
    $tmp["text"] = $txt;
    $tmp["mrkdwn_in"] = Array("text");
    //$tmp["image_url"] = $_REQUEST['sig'];
    $url .= "&attachments=".urlencode(json_encode(Array($tmp)));
    echo $url;
    echo "\n";
    $res = file_get_contents($url);
    echo $res;
  }


$mail = new PHPMailer;


$mail->setFrom($_REQUEST['visitor_email'], $_REQUEST['visitor_name']);
$mail->addAddress($_REQUEST['visited_email']);
$mail->Subject = $_REQUEST['visitor_name'].' is here and waiting for you'; 
$mail->isHTML(true);
$mail->Body    = '<b>'.$_REQUEST['visitor_name'].'</b> is here !<br /><img src="cid:photocid">';
$mail->AltBody = $_REQUEST['visitor_name'].' is here !';
$mail->addStringEmbeddedImage(b64_to_bin($_REQUEST['photo']), "photocid", 'photo.jpg', 'base64', 'image/jpeg', 'inline');
$mail->addStringEmbeddedImage(b64_to_bin($_REQUEST['sig']),   "sigcid",   'sig.png',   'base64', 'image/png',  'inline');

if(!$mail->send()) {
  echo 'Message could not be sent.';
  echo 'Mailer Error: ' . $mail->ErrorInfo;
} else {
  echo 'Message has been sent';
}

function b64_to_bin($str)
{
  $tmp = split(',', $str);
  $res = base64_decode($tmp[1]);
  return ($res);
}

?>