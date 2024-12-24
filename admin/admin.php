<?php 
require_once "../connect.php";
// if (isset($_SESSION['username']) && !empty($_SESSION['username'])) 
// {if($_SESSION['username']!='admin')
// {
//     header("location:http://localhost/PHONE/Phone/WEBPHONE/admin/admin.php");
//     exit();
// }
// else
// {
// header("location:http://localhost/PHONE/Phone/WEBPHONE/index.php");
// exit();
// }
// }
// else {
//     header("location:http://localhost/PHONE/Phone/WEBPHONE/loginform.php");
// exit();
// }


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
        <!-- Sidebar -->
        <nav class="sidebar">
            <div class="sidebar-header">
                <h2>Admin Dashboard</h2>
            </div>
            <ul class="sidebar-menu">
                <li><a href="admin.php">Dashboard</a></li>
                <li><a href="Product.php">Quản lý Sản phẩm</a></li>
                <li><a href="#">Quản lý Đơn hàng</a></li>
                <li><a href="customer.php">Quản lý Khách hàng</a></li>
                <li><a href="#">Báo cáo</a></li>
                <li><a href="#">Cài đặt</a></li>
            </ul>
        </nav>

        <!-- Main Content -->
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
                <!-- Doanh thu -->
                <div class="box">
                    <h3>Tổng Doanh Thu</h3>
                    <?php 
        $sql = "SELECT SUM(TotalAmount) AS TotalRevenue FROM Orders";
        $statement = $conn->prepare($sql);
        $statement->execute();
        $totalRevenue = $statement->fetch(PDO::FETCH_ASSOC);

        if ($totalRevenue && isset($totalRevenue['TotalRevenue'])) {
            $formattedRevenue = number_format($totalRevenue['TotalRevenue'], 0, ',', '.');
            echo  $formattedRevenue. "đ";
        } else {
            echo "<p>Không có dữ liệu doanh thu.</p>";
        }
        ?>
                </div>

                <!-- Đơn hàng mới -->
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

             

                <!-- Khách hàng mới -->
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
                    <button class="btn">Danh Sách Sản Phẩm</button>
                </div>

                <div class="order-management">
                    <h2>Quản Lý Đơn Hàng</h2>
                    <button class="btn"><a href="Orders.php"> Danh Sách Đơn Hàng</a></button>
                    <button class="btn">Đơn Hàng Đang Xử Lý</button>
                </div>

                <div class="customer-management">
                    <h2>Quản Lý Khách Hàng</h2>
                    <button class="btn">Danh Sách Khách Hàng</button>
                    <button class="btn">Khách Hàng Mới</button>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
