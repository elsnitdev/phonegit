<?php
require_once "../connect.php";
$sql = "select * from Users";

$statement = $conn->query("SELECT * FROM Users");
$users = $statement->fetchAll(PDO::FETCH_ASSOC);
?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thông tin Người dùng</title>
    <link rel="stylesheet" href="customers.css">
</head>
<body>
<div class="admin-container">
        <!-- Sidebar -->
        <nav class="sidebar">
            <div class="sidebar-header">
                <h2>Admin Dashboard</h2>
            </div>
            <ul class="sidebar-menu">
                <li><a href="#">Dashboard</a></li>
                <li><a href="#">Quản lý Sản phẩm</a></li>
                <li><a href="#">Quản lý Đơn hàng</a></li>
                <li><a href="customer.php">Quản lý Khách hàng</a></li>
                <li><a href="#">Báo cáo</a></li>
                <li><a href="#">Cài đặt</a></li>
            </ul>
        </nav>
</div>
<h1>Thông tin Người dùng</h1>
    <table class="user-table">
        <tr >
        <th>UserID</th>
            <th>Username</th>
            <th>Email</th>
            <th>Fullname</th>
            <th>Address</th>
            <th>Phone</th>
            <th>Sex</th>
        </tr>
        <?php foreach ($users as $user) : ?>
            <tr>
            <td><?php echo $user['UserID']; ?></td>
                <td><?php echo $user['Username']; ?></td>
                <td><?php echo $user['Email']; ?></td>
                <td><?php echo $user['Fullname']; ?></td>
                <td><?php echo $user['Address']; ?></td>
                <td><?php echo $user['Phone']; ?></td>
                <td><?php echo $user['Sex']; ?></td>
            </tr>
        <?php endforeach; ?>
    </table>
</body>
</html>