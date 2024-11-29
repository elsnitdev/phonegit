    <?php
    session_start();
    require_once "../connect.php";
    if ($_SERVER["REQUEST_METHOD"] == "POST")  {
            $name = $_POST['name'];
            $description = $_POST['description'];
            $price = $_POST['price'];
            $brand = $_POST['brand'];
            $category = $_POST['category'];
            $image =basename( $_FILES['image']['name']);
            //upload file-w3school
            $target_dir = "uploads/";
            $target_file = $target_dir .  $image;
            if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
                $statement = $conn->prepare("INSERT INTO products (Name, Description, Price, Brand, Category, Image) VALUES (:name, :description, :price, :brand, :category, :image)");
                $statement->bindParam(':name', $name);
                $statement->bindParam(':description', $description);
                $statement->bindParam(':price', $price);
                $statement->bindParam(':brand', $brand);
                $statement->bindParam(':category', $category);
                $statement->bindParam(':image', $image);
            
                $exp = $statement->execute();
                if ($exp) {
                    echo "Product added successfully.";
                } else {
                    echo "Error adding product.";
                }
            } else {
                echo "Error uploading image.";
            }}
            else
            echo "<p style='color:red'>LOI</p>";
    
    ?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Add Product</title>
</head>
<body>
<h1>Add Product</h1>

<form action="addProduct.php" method="post" enctype="multipart/form-data">
    <label for="name">Name:</label>
    <input type="text" name="name" id="name" required><br><br>

    <label for="description">Description:</label>
    <textarea name="description" id="description" rows="4" required></textarea><br><br>

    <label for="price">Price:</label>
    <input type="number" name="price" id="price" step="0.01" required><br><br>

    <label for="brand">Brand:</label>
    <input type="text" name="brand" id="brand" required><br><br>

    <label for="category">Category:</label>
    <input type="number" name="category" id="category" required><br><br>

    <label for="image">Image URL:</label>
    <input type="file" name="image" id="image" required><br><br>

    <button type="submit">Add Product</button>
 
</form>
</body>
</html>