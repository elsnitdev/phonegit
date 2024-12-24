<?php
session_start();
require_once "connect.php";

if (isset($_GET['UserID'])) {
    // Lấy giá trị UserID từ phương thức GET
    $UserID = $_GET['UserID'];
    
    // Thêm dữ liệu vào bảng 'Orders'
    $OrderDate = date('Y-m-d H:i:s');
    
    $sql = "INSERT INTO Orders (UserID, OrderDate, TotalAmount) VALUES (:UserID, :OrderDate, :TotalAmount)";
    $statement = $conn->prepare($sql);
    $statement->bindParam(':UserID', $UserID);
    $statement->bindParam(':OrderDate', $OrderDate);
    
    $sql = "SELECT SUM(Price * Quantity) as total FROM Items WHERE UserID = :UserID";
    $statement = $conn->prepare($sql);
    $statement->bindParam(':UserID', $UserID);
    $statement->execute();
    $sum = $statement->fetch(PDO::FETCH_ASSOC);
    
    $totalAmount = $sum['total'] ?? 0; // Tổng giá trị từ Items
    
    $statement->bindParam(':TotalAmount', $totalAmount);
    $statement->execute();
    
    // Lấy OrderID vừa thêm vào
    $OrderID = $conn->lastInsertId();
    
    // Thêm dữ liệu vào bảng 'OrderDetails' cho từng sản phẩm trong giỏ hàng
    $sql = "SELECT ProductID, Quantity, Price FROM Items WHERE UserID = :UserID";
    $statement = $conn->prepare($sql);
    $statement->bindParam(':UserID', $UserID);
    $statement->execute();
    $items = $statement->fetchAll(PDO::FETCH_ASSOC);

    foreach ($items as $item) {
        $sql = "INSERT INTO OrderDetails (OrderID, ProductID, Quantity, Price) VALUES (:OrderID, :ProductID, :Quantity, :Price)";
        $statement = $conn->prepare($sql);
        $statement->bindParam(':OrderID', $OrderID);
        $statement->bindParam(':ProductID', $item['ProductID']);
        $statement->bindParam(':Quantity', $item['Quantity']);
        $statement->bindParam(':Price', $item['Price']);
        $statement->execute();
    }
    
   
    $sqlDeleteItems = "DELETE FROM Items WHERE UserID = :UserID";
    $statementDeleteItems = $conn->prepare($sqlDeleteItems);
    $statementDeleteItems->bindParam(':UserID', $UserID);
    $statementDeleteItems->execute();
} else {
 
    echo "UserID không tồn tại ";
}
?>