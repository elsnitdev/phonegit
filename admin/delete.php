<?php session_start();
require_once "../connect.php";
if(!isset($_SESSION['username'])||($_SESSION['username']!='admin'))
{
    header("location:http://localhost/PHONE/phonegit/index.php");
    exit();
}
if (isset($_GET['UserID'])) {
    $userID = $_GET['UserID'];

    // lấy OrderID của tất cả các đơn hàng của người dùng
    $sql = "SELECT OrderID FROM Orders WHERE UserID = :userID";
    $statement = $conn->prepare($sql);
    $statement->bindParam(':userID', $userID);
    $statement->execute();
    $orderIDs = $statement->fetchAll(PDO::FETCH_COLUMN);

    // Xóa tất cả ctdh liên quan đến các OrderID
    foreach ($orderIDs as $orderID) {
        $sql = "DELETE FROM OrderDetails WHERE OrderID = :orderID";
        $statement = $conn->prepare($sql);
        $statement->bindParam(':orderID', $orderID);
        $statement->execute();
    }

    // Xóa tất cả các đơn hàng của người dùng
    $sql = "DELETE FROM Orders WHERE UserID = :userID";
    $statement = $conn->prepare($sql);
    $statement->bindParam(':userID', $userID);
    $statement->execute();

    // Xóa người dùng
    $sql = "DELETE FROM Users WHERE UserID = :userID";
    $statement = $conn->prepare($sql);
    $statement->bindParam(':userID', $userID);

    if ($statement->execute()) {
       header("location:http://localhost/PHONE/phonegit/admin/customer.php");
    } else {
        echo "Có lỗi xảy ra khi xóa người dùng.";
    }
}
?>
