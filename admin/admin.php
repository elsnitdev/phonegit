<?php 
session_start();
require_once "../connect.php";
if (!isset($_SESSION['username']) || $_SESSION['username'] != 'admin') {
 
    header("Location: http://localhost/PHONE/phonegit/index.php");
    exit();
}

?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - Quản Lý Website Bán Hàng</title>
    <link rel="stylesheet" href="admins.css">
</head>
<body>
    <div class="admin-container">
     
        <?php include "nav.php"; ?>
        
        <div class="main-content">
            <header>
                <div class="header-left">
                    <h1>Trang Quản Trị</h1>
                </div>
                <div class="header-right">
                    <span>Chào, Admin</span>
                </div>
            </header>

            <div class="dashboard">
               
                <div class="box">
                    <h3>Tổng Doanh Thu</h3>
                    <?php 
        $sql = "SELECT SUM(TotalAmount) AS total FROM Orders";
        $statement = $conn->prepare($sql);
        $statement->execute();
        $total = $statement->fetch(PDO::FETCH_ASSOC);

        if ($total && isset($total['total'])) {
            $formattedRevenue = number_format($total['total'], 0, ',', '.');
            echo  $formattedRevenue. "đ";
        } else {
            echo "<p>Không có dữ liệu doanh thu.</p>";
        }
        ?>
                </div>

              
                <div class="box">
                    <h3>Đơn Hàng Mới</h3>
                    <?php 
        $sql = "SELECT COUNT(orderID) AS TotalOrder FROM Orders";
        $statement = $conn->prepare($sql);
        $statement->execute();
        $TotalOrder = $statement->fetch(PDO::FETCH_ASSOC);

        if ($TotalOrder && isset($TotalOrder['TotalOrder'])) {
            $TotalOrder =$TotalOrder['TotalOrder'];
            echo  $TotalOrder;
        } else {
            echo "<p>Không có dữ liệu doanh thu.</p>";
        }
        ?>
                </div>

             

              
                <div class="box">
                    <h3>Khách Hàng Mới</h3>
                    <?php 
        $sql = "SELECT COUNT(UserID) AS user FROM Users";
        $statement = $conn->prepare($sql);
        $statement->execute();
        $user = $statement->fetch(PDO::FETCH_ASSOC);

        if ($user && isset($user['user'])) {
            $user = $user['user'];
            echo  $user;
        } else {
            echo "<p>Không có dữ liệu doanh thu.</p>";
        }
        ?>
                </div>
            </div>

            <div class="section">
                <div class="product-management">
                    <h2>Quản Lý Sản Phẩm</h2>
                    <button class="btn"><a href="addProduct.php">Thêm Sản Phẩm</a></button>
                    
                </div>

                <div class="order-management">
                    <h2>Quản Lý Đơn Hàng</h2>
                    <button class="btn"><a href="Orders.php"> Danh Sách Đơn Hàng</a></button>
                  
                </div>

                <div class="customer-management">
                    <h2>Quản Lý Khách Hàng</h2>
                    <button class="btn"><a href="customer.php">Danh Sách Khách Hàng</a></button>
             
                </div>
            </div>
        </div>
    </div>
</body>
</html>
