<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<nav class="navbar">
        <div class="logo">
            <a href="index.php">Tphone</a> 
        </div>
        
        <div class="nav-items">
 
    <div class="dropdown">
        <button class="dropbtn">Danh Mục</button>
        <div class="dropdown-content">
           
            <!-- <a href="filter.php" >Apple</a>
            <a href="filter.php">Samsung</a>
            <a href="filter.php" >Xiaomi</a>-->
            <a href="filter.php?Brand=Apple">Apple</a>
            <a href="filter.php?Brand=SamSung">Samsung</a>
            <a href="filter.php?Brand=Xiaomi">Xiaomi</a>
        </div>
    </div>


    <div class="search-container">
        <form action="">
        <input type="text" placeholder="Tìm kiếm..." class="search-input"></form>
        <button class="search-btn">
            <i class='bx bx-search'></i>
        </button>
    </div>

 
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
             echo "<a href='giohang.php?UserID=" . $user['UserID'] . "'>Giỏ Hàng</a>"; 
     } else {
         echo "<a href='loginform.php'>Đăng nhập</a>"; echo "<a href='giohang.php'>Giỏ Hàng</a>"; 
     }
 } else {
     echo "<a href='loginform.php'>Đăng nhập</a>";
  echo "<a href='giohang.php'>Giỏ Hàng</a>"; 
 }

 ?>
 
       
    </nav>
</body>
</html>