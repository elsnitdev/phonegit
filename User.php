
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>  <link
      href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css"
      rel="stylesheet"
    />
    <link rel="stylesheet" href="index.css">
    <style>
    main {
        display: flex;
        justify-content: center;
        align-items: center;
        height: 100vh;
    }

    .info {
        border: solid black 2px;
        padding: 30px;
        text-align: left; /* Để căn trái nội dung trong .info */
    }
    p{
        margin: 30px;
    }
    .edit{
        text-decoration: none;
        color:black;
        border: 1px solid black;
        
        
    }
</style>
</head>
<body>
 <!-- Thanh điều hướng --><header>   <?php include "header.php";?></header >
<main >
  
    <div class="info">
<?php 




if (isset($_SESSION['username'])) {
    $username = $_SESSION['username'];
    $statement = $conn->prepare("SELECT * FROM Users WHERE Username = :username");
    $statement->bindParam(':username', $username);
    $statement->execute();
    $user = $statement->fetch(PDO::FETCH_ASSOC);

    if ($user) {
        
            echo "<div class='user-info'>";
            echo "<h1>User Information</h1>";
            echo "<p><strong>Username:</strong> " . $user['Username'] . "</p>";         
            echo "<p><strong>Email:</strong> " . $user['Email'] . "</p>";
            echo "<p><strong>Full Name:</strong> " . $user['Fullname'] . "</p>";
            echo "<p><strong>Address:</strong> " . $user['Address'] . "</p>";
            echo "<p><strong>Phone:</strong> " . $user['Phone'] . "</p>";
            echo "<p><strong>Sex:</strong> " . $user['Sex'] . "</p>";
            echo "<a href='edituser.php?UserID=" . $user['UserID'] . "' class='edit'>Edit Profile</a>";
            echo "<a href='logout.php' class='edit'>Logout</a>";
            echo "</div>";
    
} else {
    echo "Please log in to view user information.";
}}
?></div></main>
</body>
</html>