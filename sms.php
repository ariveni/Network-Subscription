<?php
include "connection.php";
$phone=$_POST['phone'];
$from=$_POST['cust'];
$msg=$_POST['msg'];
$send='Message from '.$from.' '.$msg;
print_r($phone);
require 'vendor/autoload.php';
use Twilio\Rest\Client;

// Your Account SID and Auth Token from twilio.com/console
// To set up environmental variables, see http://twil.io/secure
$account_sid = 'AC60df12d0cc71a3ea9f4e01fa0a666a47';
$auth_token = '79a98e2d2270acaf1b3f0aa58a2d3d74';
// In production, these should be environment variables. E.g.:
// $auth_token = $_ENV["TWILIO_AUTH_TOKEN"]

// A Twilio number you own with SMS capabilities
$twilio_number = "+1 475 255 2697";

$client = new Client($account_sid, $auth_token);

$client->messages->create(
    // Where to send a text message (your cell phone?)
    '+91'.$phone,
    array(
        'from' => $twilio_number,
        'body' => $send,
    )
);
$cust=$_POST['cust'];
$speed=$_POST['speed'];
      $issue=$_POST['issue'];
      $stmt=$conn->prepare('INSERT into complaints(user_id,speed,issue,issue_date,reply,admin_id) values(:user,:speed,:issue,CURRENT_DATE,NULL,NULL)');
      $stmt->bindParam(':user',$cust);
      $stmt->bindParam(':speed',$speed);
      $stmt->bindParam(':issue',$issue);
      $stmt->execute();
      
      $stmt=$conn->prepare('select * from dailyamount where today_date=CURRENT_DATE');
      $stmt->execute();
      if($stmt->rowCount()>0)
      {
          $stmt=$conn->prepare('update dailyamount set complaints =complaints+1 where today_date=CURRENT_DATE');
          $stmt->execute();
      }
      else{
          $stmt=$conn->prepare('insert into dailyamount(today_date,amount,complaints) values(CURRENT_DATE,0,1)');
          $stmt->execute();
      }
      header('Location: usercomp.php');
?>