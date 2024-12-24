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
</body>
</html>