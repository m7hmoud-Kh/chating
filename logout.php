<?php
session_start();
include "connect.php";
if($_SERVER["REQUEST_METHOD"] == 'POST')
{
    $stmt=$con->prepare("UPDATE user SET  `login` =  ? WHERE user_email = ?");
    $stmt->execute(array("offline" , $_SESSION["email"]));
    session_unset();
    session_destroy();
    header("location:login.php");
} 
?>