<?php
session_start();
    include "connection.php";
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

$user=$_SESSION['user'];
$characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $randomString = '';
 
    for ($i = 0; $i <11; $i++) {
        $index = rand(0, strlen($characters) - 1);
        $randomString .= $characters[$index];
    }    
$t_id=$randomString;
$price=$_SESSION['price'];
$stmt=$conn->prepare('select * from customers where Username=:username');
$stmt->bindParam(':username',$user);
$stmt->execute();
$row=$stmt->fetch(PDO::FETCH_ASSOC);
$stmt=$conn->prepare('INSERT into payments(transaction_id ,price,paid_date,user_id) values(:t_id,:price,CURRENT_DATE,:user)');
$stmt->bindParam('t_id',$t_id);
$stmt->bindParam('price',$price);
$stmt->bindParam('user',$user);
$stmt->execute();
$send="Your Payment submission is successful you will get conformation once admin proved";
$client->messages->create(
    // Where to send a text message (your cell phone?)
    '+91'.$row['Phone'],
    array(
        'from' => $twilio_number,
        'body' => $send,
    )
);
$send="From ".$user." I have paid RS ".$price;
$client->messages->create(
    // Where to send a text message (your cell phone?)
    '+919704645579',
    array(
        'from' => $twilio_number,
        'body' => $send,
    )
);
header('Location: user.php');
?>