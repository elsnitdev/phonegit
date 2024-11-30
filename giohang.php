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
        if(!isset($_SESSION['order']))
        $_SESSION['order']=[];
        //lay du lieu
        if(isset($_POST['addcart'])&&$_POST['addcart'])
        {$ProductID = $_POST['ProductID'];
            $Name = $_POST['Name'];
            $Description = $_POST['Description'];
            $Price = $_POST['Price'];
            $Image = $_POST['Image'];
            $UserID = $_POST['UserID'];
            $OrderDate = date('Y-m-d H:i:s');
            
            // Thêm dữ liệu vào bảng 'orders'
            $sql = "INSERT INTO orders (UserID, OrderDate, TotalAmount  ) VALUES (:UserID, :OrderDate, :TotalAmount)";
            $statement = $conn->prepare($sql);
            $statement->bindParam(':UserID', $UserID);
            $statement->bindParam(':OrderDate', $OrderDate);
            $statement->bindParam(':TotalAmount', $Price);
            $statement->execute();
            
            // Lấy OrderID vừa thêm vào
            $sql = "SELECT OrderID FROM orders WHERE UserID = :UserID ORDER BY OrderID DESC LIMIT 1";
            $statement = $conn->prepare($sql);
            $statement->bindParam(':UserID', $UserID);
            $statement->execute();
            $result = $statement->fetch();
            $OrderID = $result['OrderID'];
            
            // Thêm dữ liệu vào bảng 'orderdetails'
            $sql = "INSERT INTO orderdetails (OrderID, ProductID, Quantity, Price) VALUES (:OrderID, :ProductID, 1, :Price)";
            $statement = $conn->prepare($sql);
            $statement->bindParam(':OrderID', $OrderID);
            $statement->bindParam(':ProductID', $ProductID);
            $statement->bindParam(':Price', $Price);
            $success=$statement->execute();
            if($success){
            
                echo '<script>
                alert("Yêu cầu của bạn đã được xử lý thành công!");
                setTimeout(function() {
                    window.location.href = "http://localhost/PHONE/Phone/WEBPHONE/index.php"; // Đường dẫn tới trang cần chuyển hướng
                }); // Thời gian chờ trước khi chuyển hướng (đơn vị: mili giây)
              </script>';
            
            
            }}
        ?>


        </nav></header>
        <main>
        <table class="user-table">
        <tr >
        <th>OrderID</th>
            <th>ProductID</th>
            <th>Quantity</th>
            <th>Price</th>
            <th>OrderDate</th>
          
        </tr>
        <?php 
$sql = "SELECT orderdetails.OrderID, orderdetails.ProductID, orderdetails.Quantity, orderdetails.Price , orders.OrderDate 
FROM orderdetails
INNER JOIN orders ON orderdetails.OrderID = orders.OrderID
WHERE orders.UserID = :UserID";
$statement = $conn->prepare($sql);
$statement->bindParam(':UserID', $UserID);
$statement->execute();
$orders = $statement->fetchAll(PDO::FETCH_ASSOC);

foreach ($orders as $order) : 
?>
<tr>
<td><?php echo $order['OrderID']; ?></td>
<td><?php echo $order['ProductID']; ?></td>
<td><?php echo $order['Quantity']; ?></td>
<td><?php echo number_format($order['Price'], 0, ',', '.') . "₫"; ?></td>
<td><?php echo $order['OrderDate']; ?></td>
</tr>
<?php endforeach; ?> </table></main>
        </body>
        </html>