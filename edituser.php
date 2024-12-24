<?php
require_once "connect.php";

if (isset($_GET['UserID'])) {
    $userID = $_GET['UserID'];

    // lấy thông tin người dùng dựa trên UserID
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
     
        $email = $_POST['email'];
        $fullname = $_POST['fullname'];
        $address = $_POST['address'];
        $phone = $_POST['phone'];
        $sex = $_POST['sex'];

        // Cập nhật thông tin 
        $sql = "UPDATE users SET  Email = :email, Fullname = :fullname, Address = :address, Phone = :phone, Sex = :sex WHERE UserID = :userID";
        $statement = $conn->prepare($sql);
       
        $statement->bindParam(':email', $email);
        $statement->bindParam(':fullname', $fullname);
        $statement->bindParam(':address', $address);
        $statement->bindParam(':phone', $phone);
        $statement->bindParam(':sex', $sex);
        $statement->bindParam(':userID', $userID);

        if ($statement->execute()) {
           header("location:http://localhost/PHONE/phonegit/User.php");
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
      <label for=""><?php echo $user['Username']; ?></label><br><br>

        <label for="email">Email:</label>
        <input type="email" name="email" value="<?php echo $user['Email']; ?>"><br><br>

        <label for="fullname">Full Name:</label>
        <input type="text" name="fullname" value="<?php echo $user['Fullname']; ?>"><br><br>

        <label for="address">Address:</label>
        <input type="text" name="address" value="<?php echo $user['Address']; ?>"><br><br>

        <label for="phone">Phone:</label>
        <input type="text" name="phone" value="<?php echo $user['Phone']; ?>"><br><br>
        <div class="sex">
          <label class="sexMF" for=""
            ><input type="radio" checked name="sex" id="male" value="male"/> Male</label
          ><label for="" class="sexMF"
            ><input type="radio" name="sex" id="female" value="female" /> Female</label
          >
        </div>

        <button type="submit">Update</button>
    </form>
</body>

</html>