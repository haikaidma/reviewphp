<?php
include 'connect.php';
require "PHPMailer-master/src/PHPMailer.php";  //nhúng thư viện vào để dùng, sửa lại đường dẫn cho đúng nếu bạn lưu vào chỗ khác
require "PHPMailer-master/src/SMTP.php"; //nhúng thư viện vào để dùng
require 'PHPMailer-master/src/Exception.php';
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
if(isset($_POST['submit'])==TRUE)
{
    $email = $_POST['email'];
    $sql = "SELECT email,password FROM users Where email='$email'";
	$result = mysqli_query($con, $sql);
	if (mysqli_num_rows($result) == 0) {
        header("location: resetpass.php?error=Email này chưa được đăng ký.");
        exit;
    }
    else
    {
        base64_encode($email);
         $mkmoi=substr(md5(rand(0,999999)),0,8);
         $time=time();
        $sql2="INSERT INTO resetpass (m_email, m_time, m_numbercheck,m_token)
        VALUES ('$email',  $time,0, '$mkmoi');";
        $kq= mysqli_query($con, $sql2);
        
        if($kq==true)
        header("location: resetpass.php?success= Chúng tôi đã gửi thông tin đặt lại mật khẩu vào email của bạn, vui lòng kiểm tra email và làm theo hướng dẫn");
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
        $PHPMailer->addAddress($email );
    
        $PHPMailer->isHTML(true);
        $PHPMailer->Subject = 'Reset Password';
        $PHPMailer->Body = "Nhấn vào để đổi mk. https://nineplus-intern.herokuapp.com/ngay3/doimk.php?email={email}&key={key}";
        $PHPMailer->send();
    } catch (Exception $exception) {
        echo $PHPMailer->ErrorInfo;
    }
    }

}
?>
<a href="https://nineplus-intern.herokuapp.com/ngay3/doimk.php?email={email}&key={key}">Nhấn vào đây để tiến hành đặt lại mật khẩu </a>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
    <script type="text/javascript" src="js/jquery.validate.min.js"></script>
</head>
<style>
    .error {
        color:red;
        }
</style>
<body>
    <form action="" method="post" style="width:600px;" class="border border-primary border-2 m-auto p-2" id="formreset">
    <h4 style="text-align: center;">Quên mật khẩu</h4>
    <?php
				if(isset($_GET['error'])){
				?> <p class="error" style="color:red;"><?php echo $_GET['error'];?></p>	
				<?php }
				?>
     <?php
				if(isset($_GET['success'])){
				?> <p class="success" style="color:green;"><?php echo $_GET['success'];?></p>	
				<?php }
				?>
    <div class="form-group">
    <label for="email">Nhập Email</label>
    <input type="email" class="form-control" id="email" name="email" placeholder="Enter email">
  </div>
    <button type="submit" name="submit" class="btn btn-primary">Gửi yêu cầu</button>
    </form>
</body>
</html>
<script type="text/javascript">
$(document).ready(function () {

//Khi bàn phím được nhấn và thả ra thì sẽ chạy phương thức này
$("#formreset").validate({
  rules: {
    email: {
      required: true,
      email: true
    },
  },
  messages: {
    email: {
      required: "Vui lòng nhập vào email",
      email: "Nhập đúng định dạng email đê :D"
    },
  }
});
});
</script>
