<?php 
session_start();
require_once "connect.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];
if($username=='admin'&&$password=='123'){
 
   // $_SESSION['username'] = $username;
    header("Location: http://localhost/PHONE/phonegit/admin/admin.php");
    exit();
}
else   { $statement = $conn->prepare("SELECT * FROM Users WHERE Username = :username AND Password = :password");
    $statement->bindParam(':username', $username);
    $statement->bindParam(':password', $password);
    $statement->execute();
    $user = $statement->fetch(PDO::FETCH_ASSOC);
    if ($user) {
    
       if ($user['active'] == true) {
            $errorMessage = "Your account is currently inactive. Please contact support.";
        } else {
            // Cập nhật cột 'active' thành true
            $updateStatement = $conn->prepare("UPDATE Users SET active = true WHERE Username = :username");
            $updateStatement->bindParam(':username', $username);
            $updateStatement->execute();

            $_SESSION['username'] = $user['Username']; // Lưu tên người dùng vào session

            header("Location: http://localhost/PHONE/phonegit/index.php");
            exit();
        }
    } else {
        $errorMessage = "Invalid username or password";
    }
    }
                }




?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="login.css">  <link
      href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css"
      rel="stylesheet"
    />
    <title>Login</title>
</head>
<body>
<header> <!-- Thanh điều hướng -->
    <nav class="navbar">
        <div class="logo">
            <a href="index.php">Tphone</a> <!-- Tên trang web -->
        </div>
        
        <div class="nav-items">
            <!-- Thanh chọn danh mục -->
            <div class="dropdown">
                <button class="dropbtn">Danh Mục</button>
                <div class="dropdown-content">
                <a href="filter.php?Brand=Apple">Apple</a>
            <a href="filter.php?Brand=SamSung">Samsung</a>
            <a href="filter.php?Brand=Xiaomi">Xiaomi</a>
                </div>
            </div>

            <!-- Thanh tìm kiếm -->
            <div class="search-container">
                <input type="text" placeholder="Tìm kiếm..." class="search-input">
                <button class="search-btn">
                <i class='bx bx-search'></i> <!-- Icon tìm kiếm -->
                </button>
            </div>

            <!-- Các liên kết điều hướng -->
            <a href="index.php">Trang Chủ</a>
            <a href="loginform.php">Đăng Nhập</a>
            <a href="giohang.php">Giỏ Hàng</a>
        </div>
       
    </nav></header>
<main> <div class="wrapper" style="background-color: #00246b;">
  
      <form action="loginform.php"  method="POST">
        <h1>Login</h1>
        <div class="input-box">
        <input type="text" placeholder="UserName" name="username" id="username" required />
          <i class="bx bxs-user"></i>
        </div>
        <div class="input-box">
        <input type="password" placeholder="password"id="password"name="password" required />
          <i class="bx bxs-lock-alt"></i>
        </div>
        <div class="remember-forgot">
          <label for=""><input type="checkbox" />Remember Me</label>
          <a href="#">Forgot Password ?</a>
        </div>
        <button type="submit" class="btn">Login</button>
        <div class="register-link">
          <p>Don't have an account ?<a href="signup.php">Register</a></p>
          <p><a href="index.php">Back to web</a></p>
        </div>
      </form>
    </div></main><?php if (!empty($successMessage)): ?>
    <div id="successMessage" style="display: none;"><?php echo $successMessage; ?></div>
<?php endif; ?>
    <script>
    // thong bao dang nhap thanh cong!
    document.addEventListener('DOMContentLoaded', function() {
        var successMessage = document.getElementById('successMessage').textContent;
        if (successMessage) {
            alert(successMessage);
        }
    });
</script>
</body>
</html>