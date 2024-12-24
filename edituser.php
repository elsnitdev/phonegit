<?php
require_once "connect.php";

if (isset($_GET['UserID'])) {
    $userID = $_GET['UserID'];

    // Truy vấn cơ sở dữ liệu để lấy thông tin người dùng dựa trên UserID
    $sql = "SELECT * FROM users WHERE UserID = :userID";
    $statement = $conn->prepare($sql);
    $statement->bindParam(':userID', $userID);
    $statement->execute();
    $user = $statement->fetch(PDO::FETCH_ASSOC);

    if (!$user) {
        echo "Người dùng không tồn tại.";
        exit;
    }

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $username = $_POST['username'];
        $email = $_POST['email'];
        $fullname = $_POST['fullname'];
        $address = $_POST['address'];
        $phone = $_POST['phone'];
        $sex = $_POST['sex'];

        // Cập nhật thông tin người dùng trong cơ sở dữ liệu
        $updateSql = "UPDATE users SET Username = :username, Email = :email, Fullname = :fullname, Address = :address, Phone = :phone, Sex = :sex WHERE UserID = :userID";
        $updateStatement = $conn->prepare($updateSql);
        $updateStatement->bindParam(':username', $username);
        $updateStatement->bindParam(':email', $email);
        $updateStatement->bindParam(':fullname', $fullname);
        $updateStatement->bindParam(':address', $address);
        $updateStatement->bindParam(':phone', $phone);
        $updateStatement->bindParam(':sex', $sex);
        $updateStatement->bindParam(':userID', $userID);

        if ($updateStatement->execute()) {
            echo "Thông tin người dùng đã được cập nhật thành công.";
        } else {
            echo "Có lỗi xảy ra khi cập nhật thông tin người dùng.";
        }
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
    <h1>Edit User</h1>
    <form method="POST">
        <label for="username">Username:</label>
        <input type="text" name="username" value="<?php echo $user['Username']; ?>"><br><br>

        <label for="email">Email:</label>
        <input type="email" name="email" value="<?php echo $user['Email']; ?>"><br><br>

        <label for="fullname">Full Name:</label>
        <input type="text" name="fullname" value="<?php echo $user['Fullname']; ?>"><br><br>

        <label for="address">Address:</label>
        <input type="text" name="address" value="<?php echo $user['Address']; ?>"><br><br>

        <label for="phone">Phone:</label>
        <input type="text" name="phone" value="<?php echo $user['Phone']; ?>"><br><br>

        <label for="sex">Sex:</label>
        <input type="text" name="sex" value="<?php echo $user['Sex']; ?>"><br><br>

        <button type="submit">Update</button>
    </form>
</body>

</html>