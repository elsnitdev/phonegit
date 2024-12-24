<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="show.css">
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
</div>
<h1>Danh Sách Sản Phẩm</h1>

<table>
    <tr>
        <th>ProductID</th>
        <th>Name</th>
        <th>Description</th>
        <th>Price</th>
        <th>Brand</th>
        <th>Category</th>
        <th>Image</th>
    </tr>
    <?php
    session_start(); 
    require_once "../connect.php";
    $sql = "select * from products";
    
    $statement = $conn->query("SELECT * FROM products");
    $products = $statement->fetchAll(PDO::FETCH_ASSOC); foreach ($products as $product) : ?>
        <tr>
            <td><?php echo $product['ProductID']; ?></td>
            <td><?php echo $product['Name']; ?></td>
            <td><?php echo $product['Description']; ?></td>
            <td><?php echo $product['Price']; ?></td>
            <td><?php echo $product['Brand']; ?></td>
            <td><?php echo $product['Category']; ?></td>
            <td><?php echo $product['Image']; ?></td>
            <td> <a  href="updateProduct.php?ProductID=<?php echo $product['ProductID']; ?>">Update Product</a></td> 
        </tr>
    <?php endforeach; ?>
</table>
</body>
</html>