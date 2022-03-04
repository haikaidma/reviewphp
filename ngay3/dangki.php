<?php
include('connect.php');
require "PHPMailer-master/src/PHPMailer.php";  //nhúng thư viện vào để dùng, sửa lại đường dẫn cho đúng nếu bạn lưu vào chỗ khác
require "PHPMailer-master/src/SMTP.php"; //nhúng thư viện vào để dùng
require 'PHPMailer-master/src/Exception.php';
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
// require_once ("PHPMailer");
if(isset($_POST['submit'])){
  $name = $_POST['name'];
  $username = $_POST['email'];
  $password  = $_POST['password'];
  $repassword  = $_POST['repassword'];
  $uppercase = preg_match('@[A-Z]@', $password);
  $lowercase = preg_match('@[a-z]@', $password);
  $number    = preg_match('@[0-9]@', $password);
  if (mysqli_num_rows(mysqli_query($con,"SELECT email FROM users WHERE email='$username'")) > 0)
  {
    header("location: dangki.php?error=This email already has a user. Please choose another Email.");
    exit;
  }
  if(!$uppercase || !$lowercase || !$number || strlen($password) < 8) {
    header("location: dangki.php?error=Password type can fit numbers, strings, uppercase letters, special characters.");
    exit;
  }
  if($password!=$repassword){
    header("location: dangki.php?error=Passwords do not match .");
    exit;
  }
  $password  = md5($_POST['password']);
  //gmail

//Khởi tạo đối tượng PHPMailer
$PHPMailer = new PHPMailer(true);

//Khai báo cấu hình và gửi mail
try {
    $PHPMailer->SMTPDebug = 0;
    $PHPMailer->isSMTP();
    $PHPMailer->Host = 'smtp.gmail.com';
    $PHPMailer->SMTPAuth = true;
    $PHPMailer->Username = 'nguyenvanhai140320@gmail.com';
    $PHPMailer->Password = '01652652535';
    $PHPMailer->SMTPSecure = 'ssl';
    $PHPMailer->Port = 465;
   
    $PHPMailer->setFrom('nguyenvanhai140320@gmail.com', 'Haikadima');
    $PHPMailer->addAddress($username ,$name);
   
    $PHPMailer->isHTML(true);
    $PHPMailer->Subject = 'Here is the subject';
    $PHPMailer->Body = 'Đăng ký thành công';
    $PHPMailer->send();
} catch (Exception $exception) {
    echo $PHPMailer->ErrorInfo;
}
  $sql = "INSERT INTO users (name,password,email) VALUES('$name','$password','$username')";

  $result = mysqli_query($con, $sql);
  if($result)
    echo  "Register success.<a href='dangnhap.php'>Back Home</a>";
  else
  echo"Register fail  <a href='dangki.php'>Try again</a>";
  
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style2.css">
</head>
<body>
    <form action="dangki.php"  method="post" >
        <div class="container">
          <h1>Form Register</h1>
          <hr>
          <?php
				if(isset($_GET['error'])){
				?> <p class="error" style="color:red;"><?php echo $_GET['error'];?></p>	
				<?php }
				?>
          <hr>
          <label for="email"><b>Name</b></label>
          <input type="text" placeholder=" Name" name="name" required>
         <label for="email"><b>Email</b></label>
          <input type="text" placeholder=" Email" name="email" required>
         <label for="psw"><b>Password</b></label>
          <input type="password" placeholder="Password" name="password" required>
          <label for="psw"><b>Repassword</b></label>
          <input type="password" placeholder="Repassword"   name="repassword" required>
         <div class="clearfix">
            <button type="submit" class="signupbtn" name="submit">Sign Up</button>
          </div>
        </div>
      </form>
</body>
</html>