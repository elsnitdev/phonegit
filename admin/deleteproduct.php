<?php
session_start();
require_once "../connect.php";

if (!isset($_SESSION['username']) || ($_SESSION['username'] != 'admin')) {
    header("location: http://localhost/PHONE/phonegit/index.php");
    exit();
}

if (isset($_GET['ProductID'])) {
    $productID = $_GET['ProductID'];

    // Xóa dữ liệu liên quan từ bảng OrderDetails
    $sql = "DELETE FROM OrderDetails WHERE ProductID = :productID";
    $statement = $conn->prepare($sql);
    $statement->bindParam(':productID', $productID);
    $statement->execute();

    // Xóa dữ liệu liên quan từ bảng Items
    $sql = "DELETE FROM Items WHERE ProductID = :productID";
    $statement = $conn->prepare($sql);
    $statement->bindParam(':productID', $productID);
    $statement->execute();

    // Xóa sản phẩm từ bảng Products
    $sql = "DELETE FROM Products WHERE ProductID = :productID";
    $statement = $conn->prepare($sql);
    $statement->bindParam(':productID', $productID);

    if ($statement->execute()) {
        header("location: http://localhost/PHONE/phonegit/admin/Product.php");
    } else {
        echo "Có lỗi xảy ra khi xóa sản phẩm.";
    }
}
?>