<?php 
session_start();
require_once "connect.php";

try {
  $userID=  $_SESSION['UserID'];
    if (isset($_GET['itemID'])) {
        $itemID = $_GET['itemID'];

      
        $sql = "DELETE FROM Items WHERE itemID = :itemID";
        $statement = $conn->prepare($sql);
        
     
        $statement->bindParam(':itemID', $itemID);

      
        if ($statement->execute()) {
           header("location:http://localhost/PHONE/phonegit/giohang.php?UserID=".$userID);
        } else {
            echo "Lỗi khi xóa mục.";
        }
    }
} catch (PDOException $exp) {
   
    echo "Lỗi: " . $exp->getMessage();
}
?>
