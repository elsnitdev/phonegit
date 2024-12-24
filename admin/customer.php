<?php session_start();
require_once "../connect.php";
if(!isset($_SESSION['username'])||($_SESSION['username']!='admin'))
{
    header("location:http://localhost/PHONE/phonegit/index.php");
    exit();
}
$sql = "select * from Users";

$statement = $conn->query("SELECT * FROM Users");
$users = $statement->fetchAll(PDO::FETCH_ASSOC);
?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thông tin Người dùng</title>
    <link rel="stylesheet" href="show.css">
</head>
<body>
 
<div class="admin-container">
     
        <?php include "nav.php"; ?>
</div>
<h1>Thông tin Người dùng</h1>
    <table class="user-table">
        <tr >
        <th>UserID</th>
            <th>Username</th>
            <th>Email</th>
            <th>Fullname</th>
            <th>Address</th>
            <th>Phone</th>
            <th>Sex</th>
        </tr>
        <?php foreach ($users as $user) : ?>
            <tr>
            <td><?php echo $user['UserID']; ?></td>
                <td><?php echo $user['Username']; ?></td>
                <td><?php echo $user['Email']; ?></td>
                <td><?php echo $user['Fullname']; ?></td>
                <td><?php echo $user['Address']; ?></td>
                <td><?php echo $user['Phone']; ?></td>
                <td><?php echo $user['Sex']; ?></td>
                <td>
            <a href="update.php?UserID=<?php echo $user['UserID']; ?>">Edit</a>
            <a href="delete.php?UserID=<?php echo $user['UserID']; ?>">Delete</a>
        </td>
            </tr>
        <?php endforeach; ?>
    </table>
   
    <div>
    <h3>Tim kiem nguoi dung </h3>
   
    <form action="" method="post">
        <input type="number" placeholder="ID" name="userID">
        <input type="submit">
    </form> <?php 
    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['userID'])) {
        $userID = $_POST['userID'];
    
        $sql = "SELECT * FROM Users WHERE userID = :userID";
        $statement = $conn->prepare($sql);
        $statement->bindParam(':userID', $userID, PDO::PARAM_INT);
        $statement->execute();
        $user = $statement->fetch(PDO::FETCH_ASSOC);
    }
    if ($user&& isset($_POST['userID'])): ?>
 
    <table class="user-table">
        <tr>
            <th>UserID</th>
            <th>Username</th>
            <th>Email</th>
            <th>Fullname</th>
            <th>Address</th>
            <th>Phone</th>
            <th>Sex</th>
            <th>Actions</th>
        </tr>
        <tr>
            <td><?php echo ($user['UserID']); ?></td>
            <td><?php echo ($user['Username']); ?></td>
            <td><?php echo ($user['Email']); ?></td>
            <td><?php echo ($user['Fullname']); ?></td>
            <td><?php echo ($user['Address']); ?></td>
            <td><?php echo ($user['Phone']); ?></td>
            <td><?php echo ($user['Sex']); ?></td>
            <td>
                <a href="update.php?UserID=<?php echo ($user['UserID']); ?>">Edit</a>
                <a href="delete.php?UserID=<?php echo ($user['UserID']); ?>">Delete</a>
            </td>
        </tr>
    </table>
<?php elseif ($_SERVER['REQUEST_METHOD'] == 'POST'): ?>
    <p>Không tìm thấy người dùng với ID đã cho.</p>
<?php endif; ?></div>
</body>
</html>