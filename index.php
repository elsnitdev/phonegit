<?php 
session_start();
?>
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ELSNIT</title>
    <link rel="stylesheet" href="index.css">
    <link
      href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css"
      rel="stylesheet"
    />
</head>
<body>
    <head> <!-- Thanh điều hướng -->
    <nav class="navbar">
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
            <a href="loginform.php">Đăng Nhập</a>
            <a href="#">Giỏ Hàng</a>
        </div>
       
    </nav></head>
    <main>
    <div class="slideshow-container">
        <!-- Các slide -->
        <div class="mySlides fade">
            <img src="../img_phone/sliding1.jpg" style="width:100%">
        </div>

        <div class="mySlides fade">
            <img src="../img_phone/sliding2.jpg" style="width:100%">
        </div>

        <div class="mySlides fade">
            <img src="../img_phone/sliding3.jpg" style="width:100%">
        </div>
        <div class="mySlides fade">
            <img src="../img_phone/sliding4.jpg" style="width:100%">
        </div>
        <div class="mySlides fade">
            <img src="../img_phone/sliding5.jpg" style="width:100%">
        </div>

        <!-- Các nút điều khiển -->
        <a class="prev" onclick="plusSlides(-1)">&#10094;</a>
        <a class="next" onclick="plusSlides(1)">&#10095;</a>
    </div>  <h2 style="text-align: center; ">Điện thoại nổi bật </h2>
    <section class="products-container">
      
        <div class="product-item">
            <img src="../img_phone/iphone14.jpg" alt="Apple iPhone">
            <h3>Apple iPhone 14</h3>
            <p class="description">Màn hình 6.1 inch, Camera 12MP, Bộ nhớ 128GB</p>
            <p class="price">17.990.000₫</p>
            <button class="add-to-cart">Thêm vào giỏ hàng</button>
        </div>
        <div class="product-item">
            <img src="../img_phone/samsung.jpg" alt="Samsung Galaxy">
            <h3>Samsung Galaxy S23</h3>
            <p class="description">Màn hình 6.2 inch, Camera 50MP, Bộ nhớ 128GB</p>
            <p class="price">21.990.000₫</p>
            <button class="add-to-cart">Thêm vào giỏ hàng</button>
        </div>
        <div class="product-item">
            <img src="../img_phone/iphone14.jpg" alt="Apple iPhone">
            <h3>Apple iPhone 14</h3>
            <p class="description">Màn hình 6.1 inch, Camera 12MP, Bộ nhớ 128GB</p>
            <p class="price">17.990.000₫</p>
            <button class="add-to-cart">Thêm vào giỏ hàng</button>
        </div>
        <div class="product-item">
            <img src="../img_phone/samsung.jpg" alt="Samsung Galaxy">
            <h3>Samsung Galaxy S23</h3>
            <p class="description">Màn hình 6.2 inch, Camera 50MP, Bộ nhớ 128GB</p>
            <p class="price">21.990.000₫</p>
            <button class="add-to-cart">Thêm vào giỏ hàng</button>
        </div>
        <div class="product-item">
            <img src="../img_phone/iphone14.jpg" alt="Apple iPhone">
            <h3>Apple iPhone 14</h3>
            <p class="description">Màn hình 6.1 inch, Camera 12MP, Bộ nhớ 128GB</p>
            <p class="price">17.990.000₫</p>
            <button class="add-to-cart">Thêm vào giỏ hàng</button>
        </div>
        <div class="product-item">
            <img src="../img_phone/samsung.jpg" alt="Samsung Galaxy">
            <h3>Samsung Galaxy S23</h3>
            <p class="description">Màn hình 6.2 inch, Camera 50MP, Bộ nhớ 128GB</p>
            <p class="price">21.990.000₫</p>
            <button class="add-to-cart">Thêm vào giỏ hàng</button>
        </div>   <div class="product-item">
            <img src="../img_phone/iphone14.jpg" alt="Apple iPhone">
            <h3>Apple iPhone 14</h3>
            <p class="description">Màn hình 6.1 inch, Camera 12MP, Bộ nhớ 128GB</p>
            <p class="price">17.990.000₫</p>
            <button class="add-to-cart">Thêm vào giỏ hàng</button>
        </div>
        <div class="product-item">
            <img src="../img_phone/samsung.jpg" alt="Samsung Galaxy">
            <h3>Samsung Galaxy S23</h3>
            <p class="description">Màn hình 6.2 inch, Camera 50MP, Bộ nhớ 128GB</p>
            <p class="price">21.990.000₫</p>
            <button class="add-to-cart">Thêm vào giỏ hàng</button>
        </div>   <div class="product-item">
            <img src="../img_phone/iphone14.jpg" alt="Apple iPhone">
            <h3>Apple iPhone 14</h3>
            <p class="description">Màn hình 6.1 inch, Camera 12MP, Bộ nhớ 128GB</p>
            <p class="price">17.990.000₫</p>
            <button class="add-to-cart">Thêm vào giỏ hàng</button>
        </div>
        <div class="product-item">
            <img src="../img_phone/samsung.jpg" alt="Samsung Galaxy">
            <h3>Samsung Galaxy S23</h3>
            <p class="description">Màn hình 6.2 inch, Camera 50MP, Bộ nhớ 128GB</p>
            <p class="price">21.990.000₫</p>
            <button class="add-to-cart">Thêm vào giỏ hàng</button>
        </div>

    </section>
    <script src="scrip.js"></script>
    </main>

    <!-- Footer -->
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