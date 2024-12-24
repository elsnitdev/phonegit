<?php 
require_once "connect.php";
$sql = "INSERT INTO users (fullname, username, password, email, phone, address, sex) 
            VALUES (:fullname, :username, :password, :email, :phone, :address, :sex)";
                $statement = $conn->prepare($sql);
                $successMessage = "";
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $username = $_POST['username'];
    $password = $_POST['password'];
    $cpass = $_POST['cpass'];
    $fullname = $_POST['fullname'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $address = $_POST['address'];
    $sex = isset($_POST['sex']) ? $_POST['sex'] : '';
    $statement->bindParam(':fullname', $fullname);
    $statement->bindParam(':username', $username);
    $statement->bindParam(':password', $password);
    $statement->bindParam(':email', $email);
    $statement->bindParam(':phone', $phone);
    $statement->bindParam(':address', $address);
    $statement->bindParam(':sex', $sex);
    if($password==$cpass){
    $insertStatus = $statement->execute();
    if ($insertStatus) {
    $successMessage = "Đăng ký thành công!";
} else {
    $successMessage = "Có lỗi xảy ra khi đăng ký.";
 }}
 else{
  $successMessage ="Mật khẩu không trùng khớp"; 
 }

  
}?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Signup</title>
    <link rel="stylesheet" href="signup.css">  <link
      href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css"
      rel="stylesheet"
    />
</head>
<body>
<header> <!-- Thanh điều hướng -->
<?php include "header.php";?></header>
    <main><div class="wrapper"style="background-color: #00246b;">
      <form action="signup.php" method="POST">
        <h1>Sign Up</h1>
        <div class="input-box">
          <input type="text" placeholder="FullName" id="fullname" name="fullname" required />
        </div>

        <div class="input-box">
          <input type="text" placeholder="UserName" name="username" id="username" required />
        </div>
        <div class="input-box">
          <input type="password" placeholder="password"id="password"name="password" required />
        </div>
        <div class="input-box">
          <input type="password" placeholder="Confirm Password" name="cpass" required />
        </div>
        <div class="input-box">
          <input type="email" placeholder="Email" required id="email" name="email"/>
        </div>

        <div class="input-box">
          <input type="text" placeholder="Phone" required  id="phone" name="phone"/>
        </div>
        <div class="input-box">
          <input type="text" placeholder="Address" required id="address" name="address"/>
        </div>
        <div class="sex">
          <label class="sexMF" for=""
            ><input type="radio" checked name="sex" id="male" value="male"/> Male</label
          ><label for="" class="sexMF"
            ><input type="radio" name="sex" id="female" value="female" /> Female</label
          >
        </div>
        <div class="register-link">
          <p>Have an account ?<a href="loginform.php">Login here</a></p>
        </div>

        <button type="submit" class="btn">Sign Up</button>
      </form>
    </div></main>
    <?php if (!empty($successMessage)): ?>
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