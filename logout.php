<?php 
session_start();
require_once "connect.php";
if(isset($_SESSION['username'])&&($_SESSION['username']!="")){
    $username=$_SESSION['username'];
    $sql="UPDATE users SET active=false WHERE username =:username";

$statement=$conn->prepare($sql);
$statement->bindParam(":username",$username);
$statement->execute();
unset($_SESSION['username']);session_destroy();
header("location:http://localhost/PHONE/phonegit/index.php");
exit();
}


?>