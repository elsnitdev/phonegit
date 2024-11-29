<?php session_start();
require_once "../connect.php";

    $statement = $conn->query("SELECT * FROM Products");
    $products = $statement->fetchAll(PDO::FETCH_ASSOC);

    if ($products) {
        foreach ($products as $product) {
            echo "Product ID: " . $product['ProductID'] . "<br>";
            echo "Name: " . $product['Name'] . "<br>";
            echo "Description: " . $product['Description'] . "<br>";
            echo "Price: $" . $product['Price'] . "<br>";
            echo "Brand: " . $product['Brand'] . "<br>";
            echo "Category: " . $product['Category'] . "<br>";
            echo "Image: <img src='" . $product['Image'] . "' alt='Product Image'><br><br>";
        }
    } else {
        echo "No products found.";
    }

?>