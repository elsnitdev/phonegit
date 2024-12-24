<!DOCTYPE html>
        <html lang="en">
        <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>GioHang</title>
        <link rel="stylesheet" href="index.css">
        <link
      href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css"
      rel="stylesheet"
    />
        
        </head>
        <body  style=" background-color: #cadcfc">
        <header><nav class="navbar" style=" background-color: #00246b">
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
if(isset($_GET['UserID'])){
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
        if(!isset($_SESSION['order']))
        $_SESSION['order']=[];
        //lay du lieu
        if(isset($_POST['addcart'])&&$_POST['addcart']&&isset($_GET['UserID']))
        {$ProductID = $_POST['ProductID'];
            $Name = $_POST['Name'];
            $Description = $_POST['Description'];
            $Price = $_POST['Price'];
            $Image = $_POST['Image'];
            $UserID = $user['UserID'];
            $OrderDate = date('Y-m-d H:i:s');
            $Quantity=$_POST['Quantity'];
            $TotalAmount=$Price*  $Quantity;
            // Thêm dữ liệu vào bảng 'orders'
            $sql = "INSERT INTO orders (UserID, OrderDate, TotalAmount  ) VALUES (:UserID, :OrderDate, :TotalAmount)";
            $statement = $conn->prepare($sql);
            $statement->bindParam(':UserID', $UserID);
            $statement->bindParam(':OrderDate', $OrderDate);
            $statement->bindParam(':TotalAmount', $TotalAmount);
            $statement->execute();
            
            // Lấy OrderID vừa thêm vào
            $sql = "SELECT OrderID FROM orders WHERE UserID = :UserID ORDER BY OrderID DESC LIMIT 1";
            $statement = $conn->prepare($sql);
            $statement->bindParam(':UserID', $UserID);
            $statement->execute();
            $result = $statement->fetch();
            $OrderID = $result['OrderID'];
            
            // Thêm dữ liệu vào bảng 'orderdetails'
            $sql = "INSERT INTO orderdetails (OrderID, ProductID, Quantity, Price) VALUES (:OrderID, :ProductID, :Quantity, :Price)";
            $statement = $conn->prepare($sql);
            $statement->bindParam(':OrderID', $OrderID);
            $statement->bindParam(':ProductID', $ProductID);
            $statement->bindParam(':Price', $Price);
            $statement->bindParam(':Quantity', $Quantity);
            $success = $statement->execute();
       
            if($success){
            
                echo '<script>
                alert("Yêu cầu của bạn đã được xử lý thành công!");
                setTimeout(function() {
                    window.location.href = "http://localhost/PHONE/phonegit/index.php"; // Đường dẫn tới trang cần chuyển hướng
                }); // Thời gian chờ trước khi chuyển hướng (đơn vị: mili giây)
              </script>';
            
            
            }}}
            else {
header("location:http://localhost/PHONE/phonegit/loginform.php");
exit();
            }
        ?>


        </nav></header>
        <main >
        <table class="user-table">
        <tr >
        <th>OrderID</th>
            <th>ProductID</th>
            <th>Quantity</th>
            <th>Price</th>
            <th>OrderDate</th>
        </tr>
        <?php 
        if (isset($user['UserID'])){
            $ID=$user['UserID'];
$sql = "SELECT orderdetails.OrderID, orderdetails.ProductID, orderdetails.Quantity, orderdetails.Price , orders.OrderDate 
FROM orderdetails
INNER JOIN orders ON orderdetails.OrderID = orders.OrderID
WHERE orders.UserID = :UserID";
$statement = $conn->prepare($sql);
$statement->bindParam(':UserID', $ID);
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
<?php endforeach; }

?> </table><form class="form" action="" method="POST"><?php $sql = "SELECT SUM(TotalAmount) as total FROM ORDERS WHERE UserID = :UserID"; // Sử dụng tham số để tránh SQL injection
$statement = $conn->prepare($sql);
$statement->bindParam(':UserID', $ID); // Bind giá trị của UserID vào câu truy vấn
$statement->execute();
$sum = $statement->fetch(PDO::FETCH_ASSOC);

if ($sum && isset($sum['total'])) {
    echo "<h3>" . $sum['total'] . "</h3>"; // Hiển thị giá trị total
} else {
  
    echo "<h3>No data found</h3>"; // Hiển thị thông báo nếu không tìm thấy dữ liệu
}?>
<input type="submit" value="MUA"></form>
</main>
        </body>
        </html>