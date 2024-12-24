<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>

    <?php 
    require_once "connect.php";
    if (isset($_GET['ProductID'])) {
    $productID = $_GET['ProductID'];

    // Truy vấn để lấy thông tin sản phẩm từ cơ sở dữ liệu
    $query = "SELECT * FROM Products WHERE ProductID = :productID";
    $statement = $conn->prepare($query);
    $statement->bindParam(':productID', $productID);
    $statement->execute();
    $product = $statement->fetch();

    if ($product) {
        // Hiển thị thông tin sản phẩm và hình ảnh
        echo "<img src='./admin/uploads/" . $product['Image'] . "' alt='" . $product['Name'] . "'>";
        echo "<h1>" . $product['Name'] . "</h1>";
        echo "<p>" . $product['Description'] . "</p>";
        echo "<p>Price: $" . $product['Price'] . "</p>";
        echo "<p>Brand: " . $product['Brand'] . "</p>";
       
    } else {
        echo "Không tìm thấy sản phẩm.";
    }
}?>
</body>
</html>