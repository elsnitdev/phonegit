<?php
function displayNavbar() {
    echo '<nav class="navbar">
        <div class="logo">
            <a href="index.php">Tphone</a>
        </div>
        
        <div class="nav-items">
            <div class="dropdown">
                <button class="dropbtn">Danh Mục</button>
                <div class="dropdown-content">
                    <a href="#">Apple</a>
                    <a href="#">Samsung</a>
                    <a href="#">Xiaomi</a>
                </div>
            </div>

            <div class="search-container">
                <input type="text" placeholder="Tìm kiếm..." class="search-input">
                <button class="search-btn">
                    <i class="bx bx-search"></i>
                </button>
            </div>
            
            <a href="index.php">Trang Chủ</a>';

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
        } else {
            echo "<a href='loginform.php'>Đăng nhập</a>";
        }
    } else {
        echo "<a href='loginform.php'>Đăng nhập</a>";
    }

    echo '<a href="giohang.php">Giỏ Hàng</a>
        </div>
    </nav>';
}


?>