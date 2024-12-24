<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="stylesheet" href="index.css">
    <title>Document</title>
</head>
<body>
   
<style>
    .product-container {
        display: flex;
        align-items: flex-start;
        gap: 20px; 
    }
    .product-image img {
        max-width: 70%;
        height: auto;
    }
    .product-details {
        max-width: 600px; 
    font-size: large;
    }

</style>
<header>  <nav class="navbar">
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
        
             echo "<a href='User.php'>" . $user['Username'] . "</a>"; 
             echo "<a href='giohang.php?UserID=" . $user['UserID'] . "'>Giỏ Hàng</a>"; 
     } else {
         echo "<a href='loginform.php'>Đăng nhập</a>"; echo "<a href='giohang.php'>Giỏ Hàng</a>"; 
     }
 } else {
     echo "<a href='loginform.php'>Đăng nhập</a>";
  echo "<a href='giohang.php'>Giỏ Hàng</a>"; 
 }

 ?>
 
       
    </nav> </header>
   <view>
   <?php 

if (isset($_GET['ProductID'])) {
    $productID = $_GET['ProductID'];

    // lấy tt sản phẩmphẩm
    $query = "SELECT * FROM Products WHERE ProductID = :productID";
    $statement = $conn->prepare($query);
    $statement->bindParam(':productID', $productID);
    $statement->execute();
    $product = $statement->fetch();

    if ($product) {
        // show rara
        echo "<div class='product-container'>";
        echo "<div class='product-image'>";
        echo "<img src='./admin/uploads/" . $product['Image'] . "' alt='" . $product['Name'] . "'>";
        echo "</div>";
        echo "<div class='product-details'>";
        echo "<h1>" . $product['Name'] . "</h1>";
        echo "<p>" . $product['Description'] . "</p>";
        echo "<p>Price: $" . $product['Price'] . "</p>";
        echo "<p>Brand: " . $product['Brand'] . "</p>";
        if(isset($user['UserID'])){ echo "<form action='giohang.php?UserID=" . $user['UserID'] . "' method='POST'>";}
        else{
            echo "<form action='giohang.php' method='POST'>";
        }
       
        echo "<input type='number' name='Quantity' id='Quantity' value='1' min='1'>";
        echo "<input type='hidden' name='ProductID' value='" . $product['ProductID'] . "'>";
        echo "<input class='add-to-cart' type='submit' name='addcart' value='Thêm vào giỏ hàng'>";
        echo "</form>";
        echo "</div>";
        echo "</div>";
    } else {
        echo "Không tìm thấy sản phẩm.";
    }
}
?></view>
</body>
</html>