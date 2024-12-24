<?php
session_start();
require_once "../connect.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $productID = $_GET['ProductID']; // Lấy ID sản phẩm từ tham số URL

    $name = $_POST['name'];
    $description = $_POST['description'];
    $price = $_POST['price'];
    $brand = $_POST['brand'];
    $category = $_POST['category'];

    // Cập nhật thông tin sản phẩm trong cơ sở dữ liệu
    $statement = $conn->prepare("UPDATE products SET Name = :name, Description = :description, Price = :price, Brand = :brand, Category = :category WHERE ProductID = :productID");
    $statement->bindParam(':name', $name);
    $statement->bindParam(':description', $description);
    $statement->bindParam(':price', $price);
    $statement->bindParam(':brand', $brand);
    $statement->bindParam(':category', $category);
    $statement->bindParam(':productID', $productID);
    
    if ($statement->execute()) {
        // Nếu cập nhật thành công, thực hiện redirect
        header("Location: updateProduct.php?ProductID=".$productID);
       
        exit();
    } else {
        echo "Có lỗi xảy ra khi cập nhật sản phẩm.";
    }
}

// Hiển thị form chỉ khi không phải là request POST hoặc khi có lỗi xảy ra
// Lấy thông tin sản phẩm từ cơ sở dữ liệu
if (isset($_GET['ProductID'])) {
    $productID = $_GET['ProductID'];
    
    // Truy vấn thông tin sản phẩm từ cơ sở dữ liệu
    $statement = $conn->prepare("SELECT * FROM products WHERE ProductID = :productID");
    $statement->bindParam(':productID', $productID);
    $statement->execute();
    $product = $statement->fetch(PDO::FETCH_ASSOC);
}

?>

<!-- Phần HTML hiển thị form cập nhật thông tin sản phẩm -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Product</title>
</head>
<body>
    <h1>Edit Product</h1>

    <form action="updateProduct.php?ProductID=<?php echo $product['ProductID']; ?>" method="post" enctype="multipart/form-data">
        <label for="name">Name:</label>
        <input type="text" name="name" id="name" value="<?php echo $product['Name']; ?>" required><br><br>

        <label for="description">Description:</label>
        <textarea name="description" id="description" rows="4" required><?php echo $product['Description']; ?></textarea><br><br>

        <label for="price">Price:</label>
        <input type="number" name="price" id="price" step="0.01" value="<?php echo $product['Price']; ?>" required><br><br>

        <label for="brand">Brand:</label>
        <input type="text" name="brand" id="brand" value="<?php echo $product['Brand']; ?>" required><br><br>

        <label for="category">Category:</label>
        <input type="text" name="category" id="category" value="<?php echo $product['Category']; ?>" required><br><br>

        <label for="image">Image:</label>
        <input type="file" name="image" id="image" accept="image/*" ><br><br>

        <button type="submit">Update Product</button>
    </form>
</body>
</html>