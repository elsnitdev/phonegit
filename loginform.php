<?php 
   session_start();
   
require_once "connect.php";

$successMessage = "";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];
    if($username!='admin'||$password!='123'){
      $sql = "SELECT * FROM users WHERE username = :username AND password = :password";
    $statement->bindParam(':username', $username);
    $statement->bindParam(':password', $password);
    $statement = $conn->prepare($sql);
    $statement->execute();
    $user = $statement->fetch(PDO::FETCH_ASSOC);
   
  if($user)
  { 
      header("Location:http://localhost/PHONE/Phone/WEBPHONE/index.php ");
    exit();
    $successMessage="successful";
  }
  else{
    $successMessage="wrong user name or password";
  }
  }
  else
  {
      
      header("Location:http://localhost/PHONE/Phone/WEBPHONE/admin.php ");
      exit();

  }}


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="login.css">
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
                    <a href="#">Apple</a>
                    <a href="#">Samsung</a>
                    <a href="#">Xiaomi</a>
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
            <a href="#">Giỏ Hàng</a>
        </div>
       
    </nav></header>
<main> <div class="wrapper" style="background-color: #00246b;">
  
      <form     >
        <h1>Login</h1>
        <div class="input-box">
          <input type="text" placeholder="UserName" name="username" required />
          <i class="bx bxs-user"></i>
        </div>
        <div class="input-box">
          <input type="password" placeholder="Password" name="password"required />
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