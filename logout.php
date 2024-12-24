<?php 
session_start();
require_once "connect.php";
$sql="UPDATE users SET active=0 ";

$statement=$conn->prepare($sql);
$statement->execute();
unset($_SESSION['Username']);session_destroy();
header("location:http://localhost/PHONE/phonegit/index.php");
exit();

?>