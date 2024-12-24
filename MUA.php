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
    
    $sqlTotal = "SELECT SUM(Price * Quantity) as total FROM Items WHERE UserID = :UserID";
    $statementTotal = $conn->prepare($sqlTotal);
    $statementTotal->bindParam(':UserID', $UserID);
    $statementTotal->execute();
    $sum = $statementTotal->fetch(PDO::FETCH_ASSOC);
    
    $totalAmount = $sum['total'] ?? 0; // Tổng giá trị từ Items
    
    $statement->bindParam(':TotalAmount', $totalAmount);
    $statement->execute();
    
    // Lấy OrderID vừa thêm vào
    $OrderID = $conn->lastInsertId();
    
    // Thêm dữ liệu vào bảng 'OrderDetails' cho từng sản phẩm trong giỏ hàng
    $sqlItems = "SELECT ProductID, Quantity, Price FROM Items WHERE UserID = :UserID";
    $statementItems = $conn->prepare($sqlItems);
    $statementItems->bindParam(':UserID', $UserID);
    $statementItems->execute();
    $items = $statementItems->fetchAll(PDO::FETCH_ASSOC);

    foreach ($items as $item) {
        $sqlOrderDetails = "INSERT INTO OrderDetails (OrderID, ProductID, Quantity, Price) VALUES (:OrderID, :ProductID, :Quantity, :Price)";
        $statementOrderDetails = $conn->prepare($sqlOrderDetails);
        $statementOrderDetails->bindParam(':OrderID', $OrderID);
        $statementOrderDetails->bindParam(':ProductID', $item['ProductID']);
        $statementOrderDetails->bindParam(':Quantity', $item['Quantity']);
        $statementOrderDetails->bindParam(':Price', $item['Price']);
        $statementOrderDetails->execute();
    }
    
    // Xóa các mục trong giỏ hàng sau khi mua
    $sqlDeleteItems = "DELETE FROM Items WHERE UserID = :UserID";
    $statementDeleteItems = $conn->prepare($sqlDeleteItems);
    $statementDeleteItems->bindParam(':UserID', $UserID);
    $statementDeleteItems->execute();
} else {
    // Xử lý khi không có UserID được truyền từ phương thức GET
    // Ví dụ: redirect hoặc thông báo lỗi
    echo "UserID không tồn tại hoặc không hợp lệ.";
}
?>