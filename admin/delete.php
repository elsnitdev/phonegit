<?php
require_once "../connect.php";

if (isset($_GET['UserID'])) {
    $userID = $_GET['UserID'];

    // Xác định và lấy OrderID của tất cả các đơn hàng của người dùng
    $getOrderIDsSql = "SELECT OrderID FROM Orders WHERE UserID = :userID";
    $getOrderIDsStatement = $conn->prepare($getOrderIDsSql);
    $getOrderIDsStatement->bindParam(':userID', $userID);
    $getOrderIDsStatement->execute();
    $orderIDs = $getOrderIDsStatement->fetchAll(PDO::FETCH_COLUMN);

    // Xóa tất cả chi tiết đơn hàng liên quan đến các OrderID
    foreach ($orderIDs as $orderID) {
        $deleteOrderDetailsSql = "DELETE FROM OrderDetails WHERE OrderID = :orderID";
        $deleteOrderDetailsStatement = $conn->prepare($deleteOrderDetailsSql);
        $deleteOrderDetailsStatement->bindParam(':orderID', $orderID);
        $deleteOrderDetailsStatement->execute();
    }

    // Xóa tất cả các đơn hàng của người dùng
    $deleteOrdersSql = "DELETE FROM Orders WHERE UserID = :userID";
    $deleteOrdersStatement = $conn->prepare($deleteOrdersSql);
    $deleteOrdersStatement->bindParam(':userID', $userID);
    $deleteOrdersStatement->execute();

    // Xóa người dùng
    $deleteUserSql = "DELETE FROM Users WHERE UserID = :userID";
    $deleteUserStatement = $conn->prepare($deleteUserSql);
    $deleteUserStatement->bindParam(':userID', $userID);

    if ($deleteUserStatement->execute()) {
        echo "Người dùng và các dữ liệu liên quan đã được xóa thành công.";
    } else {
        echo "Có lỗi xảy ra khi xóa người dùng.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit User</title>
</head>

<body>
    <h1>Delete User</h1>
    <form method="POST">
        <label for="username">Username:</label>
        <input type="text" name="username" value="<?php echo $user['Username']; ?>"><br><br>

        <!-- Các trường thông tin khác để chỉnh sửa -->

        <button type="submit">Update</button>
        <button type="submit" name="delete" onclick="return confirm('Bạn có chắc chắn muốn xóa người dùng này?')">Delete</button>
    </form>
</body>

</html>