<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GioHang</title>
    <link rel="stylesheet" href="index.css">
</head>
<body>
    <header><nav class="navbar">
        <div class="logo">
            <a href="index.php">Tphone</a> <!-- Tên trang web -->
        </div>
        
        <div class="nav-items">
    <!-- Thanh chọn danh mục -->
    <div class="dropdown">
        <button class="dropbtn">Danh Mục</button>
        <div class="dropdown-content">
            <a href="#">Apple</a>
            <a href="#">Samsung</a>
            <a href="#">Xiaomi</a>
        </div>
    </div>

    <!-- Thanh tìm kiếm -->
    <div class="search-container">
        <input type="text" placeholder="Tìm kiếm..." class="search-input">
        <button class="search-btn">
            <i class='bx bx-search'></i> <!-- Icon tìm kiếm -->
        </button>
    </div>

    <!-- Các liên kết điều hướng -->
    <a href="index.php">Trang Chủ</a>

    <?php
 
 session_start();
 require_once "connect.php";
 if (isset($_SESSION['username']) && !empty($_SESSION['username'])) {
    $username = $_SESSION['username'];
    $query = "SELECT * FROM Users WHERE Username = :username";
    $statement = $conn->prepare($query);
    $statement->bindParam(':username', $username);
    $statement->execute();
    $user = $statement->fetch(PDO::FETCH_ASSOC);

    if ($user) {
        echo "<a href='User.php'>" . $user['Username'] . "</a>"; // Hiển thị tên người dùng
    } else {
        echo "<a href='loginform.php'>Đăng nhập</a>";
    }
} else {
    echo "<a href='loginform.php'>Đăng nhập</a>";
}

echo '<a href="giohang.php">Giỏ Hàng</a>';
 ?>
 
       
    </nav></header>
<?php 
    
   ?>
</body>
</html>