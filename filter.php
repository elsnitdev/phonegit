
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="style.css">  <link
      href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css"
      rel="stylesheet"
    />
</head>
<body>
<header> <!-- Thanh điều hướng -->
    <nav class="navbar">
        <div class="logo">
            <a href="index.php">Tphone</a> <!-- Tên trang web -->
        </div>
        
        <div class="nav-items">
    <!-- Thanh chọn danh mục -->
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

    <!-- Thanh tìm kiếm -->
    <div class="search-container">
        <form action="">
        <input type="text" placeholder="Tìm kiếm..." class="search-input"></form>
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
             echo "<a href='giohang.php?UserID=" . $user['UserID'] . "'>Giỏ Hàng</a>"; 
     } else {
         echo "<a href='loginform.php'>Đăng nhập</a>"; echo "<a href='giohang.php'>Giỏ Hàng</a>"; 
     }
 } else {
     echo "<a href='loginform.php'>Đăng nhập</a>";
  echo "<a href='giohang.php'>Giỏ Hàng</a>"; 
 }

 ?></header>
    <main>
<div class="products-container">
    <?php 
    if(isset($_GET['Brand'])){
       
        $brand =$_GET['Brand'];
        $statement = $conn->prepare("SELECT * FROM products WHERE Brand =:brand "); $statement->bindParam(":brand",$brand);
$product=$statement->execute();

$products = $statement->fetchAll();
       
       
    foreach ($products as $product): ?>
         <div class='product-item' onclick="viewProduct(<?php echo $product['ProductID']; ?>)">
    <img src='./admin/uploads/<?php echo $product['Image']; ?>' alt='<?php echo $product['Name']; ?>'>
    <h3><?php echo $product['Name']; ?></h3>
    <p class='description'><?php echo $product['Description']; ?></p>
    <p class='price'><?php echo number_format($product['Price'], 0, ',', '.') . "₫"; ?></p>
    <label for="Quantity">Số lượng:</label>
   
  
    <form action='giohang.php?UserID=<?php echo $user['UserID']; ?>' method="POST"> 
        <input type="number" name="Quantity" id="Quantity" value="1" min="1"> 
         
        <input type="hidden" name="ProductID" value="<?php echo $product['ProductID']; ?>">
        <input type="hidden" name="Image" value="<?php echo $product['Image']; ?>">
        <input type="hidden" name="Name" value="<?php echo $product['Name']; ?>">
        <input type="hidden" name="Description" value="<?php echo $product['Description']; ?>">
        <input type="hidden" name="Price" value="<?php echo $product['Price']; ?>">
        <input class='add-to-cart' type="submit" name="addcart" value="Thêm vào giỏ hàng">
    </form><a href='products.php?ProductID=<?php echo $product['ProductID']; ?>' class='view-product'>Xem chi tiết</a>
</div>
    <?php endforeach; }?>
 </div></main> <!-- Footer -->
    <footer>
        <div class="footer-container">
            <div class="footer-info">
                <h4>Thông tin liên hệ</h4>
                <p><strong>Địa chỉ:</strong> 123 Đường ABC, Quận 1, TP.HCM</p>
                <p><strong>Email:</strong> contact@web.com</p>
                <p><strong>Số điện thoại:</strong> (028) 1234 5678</p>
            </div>
            <div class="footer-social">
                <h4>Theo dõi chúng tôi</h4>
                <a href="#">Facebook</a> | <a href="#">Instagram</a> | <a href="#">Twitter</a>
            </div>
        </div>
    </footer>
</body>
</html>