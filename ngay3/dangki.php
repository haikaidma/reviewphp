<?php
include('connect.php');
require "PHPMailer-master/src/PHPMailer.php";  //nhúng thư viện vào để dùng, sửa lại đường dẫn cho đúng nếu bạn lưu vào chỗ khác
require "PHPMailer-master/src/SMTP.php"; //nhúng thư viện vào để dùng
require 'PHPMailer-master/src/Exception.php';
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
// require_once ("PHPMailer");
if(isset($_POST['submit'])){
  $name = htmlspecialchars($_POST['name']);
  $username = htmlspecialchars($_POST['email']);
  $password  = htmlspecialchars($_POST['password']);
  $repassword  = htmlspecialchars($_POST['repassword']);
  // $partten = "/^[A-Za-z0-9_.]{6,32}@([a-zA-Z0-9]{2,12})(.[a-zA-Z]{2,12})+$/";
  // if (!preg_match ($partten, $username)) 
  //   {
  //     header("location: dangki.php?error=Invalid address: (to): $username .");
  //     exit;
  //   }
  $number = preg_match('@[0-9]@', $password);
$uppercase = preg_match('@[A-Z]@', $password);
$lowercase = preg_match('@[a-z]@', $password);
$specialChars = preg_match('@[^\w]@', $password);
 
if(strlen($password) < 8 || !$number || !$uppercase || !$lowercase || !$specialChars) {
  header("location: dangki.php?error=Password type can fit numbers, strings, uppercase letters, special characters.");
  exit;
}

  if (mysqli_num_rows(mysqli_query($con,"SELECT email FROM users WHERE email='$username'")) > 0)
  {
    header("location: dangki.php?error=This email already has a user. Please choose another Email.");
    exit;
  }
  // if(!$uppercase || !$lowercase || !$number || strlen($password) < 15) {
  //   header("location: dangki.php?error=Password type can fit numbers, strings, uppercase letters, special characters.");
  //   exit;
  // }
  if($password != $repassword){
    header("location: dangki.php?error=Passwords do not match .");
    exit;
  }
  $password  = md5($_POST['password']);
  //gmail
  $sql = "INSERT INTO users (name,password,email) VALUES('$name','$password','$username')";

  $result = mysqli_query($con, $sql);
  if($result)
  header("location: dangki.php?success=Register success");
  else
  header("location: dangki.php?error=Register Fail");
  

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
  $PHPMailer->addAddress($username);

  $PHPMailer->isHTML(true);
  $PHPMailer->Subject = 'ĐĂng kí tài khoản';
  $PHPMailer->Body = "Bạn đã đăng ký thành công";
  $PHPMailer->send();
} catch (Exception $exception) {
  echo $PHPMailer->ErrorInfo;
}
}
?>
<!DOCTYPE html>
<html lang="en">  
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style2.css">
    <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
<script type="text/javascript" src="js/jquery.validate.min.js"></script>

</head>

<body>
    <form action="dangki.php"  method="post" id="formdangki">
        <div class="container">
          <h1>Form Register</h1>
          <hr>
          <?php
				if(isset($_GET['error'])){
				?> <p class="error" style="color:red;background:red;"><?php echo $_GET['error'];?></p>	
				<?php }
				?>
        <?php
        		if(isset($_GET['success'])){
				?> <p class="error" style="color:black;background:#2a8536;width:600px;"><?php echo $_GET['success'];?></p>	
				<?php }
				?>
          <hr>
          <label for="email"><b>Name</b></label>
          <input type="text" placeholder=" Name" name="name">
         <label for="email"><b>Email</b></label>  
          <input type="text" placeholder=" Email" name="email">
         <label for="password"><b>Password</b></label>
          <input type="password" placeholder="Password" name="password" id="password">
          <label for="psw"><b>Repassword</b></label>
          <input type="password" placeholder="Repassword" name="repassword">
         <div class="clearfix">
            <button type="submit" class="signupbtn" name="submit">Sign Up</button>
            <a href="dangnhap.php" class="btn btn-primary btn-lg btn-block" >Sign In</a>
          </div>
        </div>
      </form>
      
</body>
</html>
<script type="text/javascript">
$(document).ready(function () {

//Khi bàn phím được nhấn và thả ra thì sẽ chạy phương thức này
$("#formdangki").validate({
  rules: {
    name: "required",
    email: {
      required: true,
      email: true
    },
    password: {
      required: true,
      minlength: 6,
      maxlength: 15
    },
    repassword: {
      minlength: 6,
      maxlength: 15
    },
  },
  messages: {
    name: "Vui lòng nhập tên!<br>",
    email: {
      required: "Vui lòng nhập vào email<br>",
      email: "Nhập đúng định dạng email đê :D<br>"
    },
    password: {
      required: "Vui lòng nhập mật khẩu!<br>",
      minlength: "Độ dài tối thiểu 6 kí tự<br>",
      maxlength: "Độ tài tối đa 15 kí tự<br>"
    },
    repassword: {
			required: "Vui lòng nhập mật khẩu<br>",
		
		},
  }
});
});

</script>
