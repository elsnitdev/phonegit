
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="index.css">  <link
      href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css"
      rel="stylesheet"
    />
</head>
<body>
<header>
    <?php 
    include "header.php";
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