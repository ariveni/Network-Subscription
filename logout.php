<?php

session_start();
$user=$_GET['user'];
if($user==1)
{
    $_SESSION['user']="";
}
else{
    $_SESSION['username']="";
}
header('Location: index.php');

?>