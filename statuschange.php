<?php
include "connection.php";
session_start();
$user=$_SESSION['customer'];
$msg=$_GET['text'];
if($msg == 1)
{
    echo $chk;
    $stmt = $conn->prepare('UPDATE customers SET Status = "active" WHERE Username = :user');
    $stmt->bindParam(':user', $user);
    $stmt->execute();
    header('Location: userinfo.php?user=' . $user);
    exit();


}
else{
    $stmt = $conn->prepare('UPDATE customers SET Status = "suspended" WHERE Username = :user');
    $stmt->bindParam(':user', $user);
    $stmt->execute();
    header('Location: userinfo.php?user=' . $user);
    exit();

}

?>