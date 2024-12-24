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
            <a href="index.php">Tphone</a> 
        </div>
        
        <div class="nav-items">
  
    <div class="dropdown">
        <button class="dropbtn">Danh Mục</button>
        <div class="dropdown-content">
           
           
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

if (!isset($_SESSION['order'])) {
    $_SESSION['order'] = [];
}


if (isset($_POST['addcart']) && $_POST['addcart'] && isset($user['UserID'])) {
    $ProductID = $_POST['ProductID'];
    $UserID = $user['UserID'];
    $Quantity = $_POST['Quantity'];
$_SESSION['userID']=$user['UserID'];
    // Lấy ttt Products
    $sql = "SELECT Price FROM Products WHERE ProductID = :ProductID";
    $statement = $conn->prepare($sql);
    $statement->bindParam(':ProductID', $ProductID);
    $statement->execute();
    $productInfo = $statement->fetch();

    $Price = $productInfo['Price'];
    $TotalAmount = $Price * $Quantity;
    $OrderDate = date('Y-m-d H:i:s');

    // thêm vào  'Items'
    $sql = "INSERT INTO Items (UserID, ProductID, Quantity, Price) VALUES (:UserID, :ProductID, :Quantity, :Price)";
    $statement = $conn->prepare($sql);
    $statement->bindParam(':UserID', $UserID);
    $statement->bindParam(':ProductID', $ProductID);
    $statement->bindParam(':Quantity', $Quantity);
    $statement->bindParam(':Price', $Price);
    $success = $statement->execute();

    if ($success) {
        echo '<script>
            alert("Yêu cầu của bạn đã được xử lý thành công!");
            setTimeout(function() {
                window.location.href = "http://localhost/PHONE/phonegit/index.php";
            });
        </script>';
    }
}} else {
    header("location:http://localhost/PHONE/phonegit/loginform.php");
    exit();
}
?>

</header>
<main>
    <table class="user-table">
        <tr>
            <th>ProductID</th>
            <th>Product Name</th>
            <th>Quantity</th>
            <th>Price</th>
        </tr>
        <?php
        if (isset($user['UserID'])) {
            $ID = $user['UserID'];
            $sql = "SELECT Items.ProductID, Products.Name, Items.Quantity, Items.Price,Items.itemID
                    FROM Items
                    INNER JOIN Products ON Items.ProductID = Products.ProductID
                    WHERE Items.UserID = :UserID";
            $statement = $conn->prepare($sql);
            $statement->bindParam(':UserID', $ID);
            $statement->execute();
            $items = $statement->fetchAll(PDO::FETCH_ASSOC);

            foreach ($items as $item) :
        ?>
            <tr>
                <td><?php echo $item['ProductID']; ?></td>
                <td><?php echo $item['Name']; ?></td>
                <td><?php echo $item['Quantity']; ?></td>
                <td><?php echo number_format($item['Price'], 0, ',', '.') . "₫"; ?></td>
                <td><a href='deleteitem.php?itemID=<?php echo $item['itemID'];?>'>Xóa</a></td>
         
            </tr>
        <?php endforeach;
        }
        ?>
    </table>
    <form class="form" action="MUA.php?UserID=<?php echo $user['UserID']; ?>" method="POST">
    <?php
    $sql = "SELECT SUM(Price * Quantity) as total FROM Items WHERE UserID = :UserID";
    $statement = $conn->prepare($sql);
    $statement->bindParam(':UserID', $ID);
    $statement->execute();
    $sum = $statement->fetch(PDO::FETCH_ASSOC);

    if ($sum && isset($sum['total'])) {
        echo "<h3>Total: " . number_format($sum['total'], 0, ',', '.') . "₫</h3>";
        echo '<input type="submit" name="MUA" value="MUA">';
    } else {
        echo "<h3>Giỏ hàng trống </h3>";
    }
    ?>
    
    
</form>

<?php
echo '<h2>Đơn hàng đã mua</h2>';
$sql = "SELECT Orders.OrderID, OrderDetails.ProductID, Products.Name, OrderDetails.Quantity, OrderDetails.Price
        FROM Orders
        INNER JOIN OrderDetails ON Orders.OrderID = OrderDetails.OrderID
        INNER JOIN Products ON OrderDetails.ProductID = Products.ProductID
        WHERE Orders.UserID = :UserID";
$statement = $conn->prepare($sql);
$statement->bindParam(':UserID', $ID);
$statement->execute();
$Items = $statement->fetchAll(PDO::FETCH_ASSOC);

echo '<table class="purchased-items-table">
    <tr>
        <th>OrderID</th>
        <th>ProductID</th>
        <th>Product Name</th>
        <th>Quantity</th>
        <th>Price</th>
        <th>Total Price</th>
    </tr>';

foreach ($Items as $Item) {
    $totalPrice = $Item['Quantity'] * $Item['Price']; // Tính tổng tiền cho mỗi sản phẩm
    echo '<tr>
        <td>' . $Item['OrderID'] . '</td>
        <td>' . $Item['ProductID'] . '</td>
        <td>' . $Item['Name'] . '</td>
        <td>' . $Item['Quantity'] . '</td>
        <td>' . number_format($Item['Price'], 0, ',', '.') . '₫</td>
        <td>' . number_format($totalPrice, 0, ',', '.') . '₫</td>
          
    </tr>';
}

echo '</table>';
?>
</main>

        </body>
        </html>