<?php
include 'connect.php';
if(isset($_GET['token'])&&isset($_GET['token']))
{
  $key = $_GET['token'];
  $email=$_GET['email'];
    $sql = "SELECT * FROM resetpass Where m_email='$email'";
	$result = mysqli_query($con, $sql);
	if (mysqli_num_rows($result) == 0) {
        header("location: doimk.php?error=Lỗi.");
        exit;  
    }
  else{
    if(isset($_POST['submit'])){
      $email=$_POST['email'];
      var_dump($email);
      exit;
        $newpass = md5($_POST["passwordchange"]);
        $renewpass = md5($_POST["repasswordchange"]); 
      if($newpass==$renewpass){   
        $query = "UPDATE users SET  password='" . $newpass . "' WHERE email='" . $email . "'";
    $result2 = mysqli_query($con,$query);
    echo "Đổi thành công.";
    }
    }
  }
}
?>
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
<form action="doimk.php" method="post" style="width:600px;" class="border border-primary border-2 m-auto p-2" id="formreset">
    <h4 style="text-align: center;">Đổi mật khẩu</h4>
    <div class="form-group">
    <label for="password">Nhập Mật khẩu</label>
    <input type="password" class="form-control" id="password" name="passwordchange" placeholder="Enter password">
    <label for="repassword">Nhập lại Mật khẩu</label>
    <input type="password" class="form-control" id="repassword" name="repasswordchange" placeholder="Enter Repassword">
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
    password: {
      required: true,
      minlength: 6,
      maxlength: 15
    },
    repassword: {
        equalTo: "#password",
        minlength: 6,
      maxlength: 15
    },
  },
  messages: {
    password: {
      required: "Vui lòng nhập mật khẩu!",
      minlength: "Độ dài tối thiểu 6 kí tự ",
      maxlength: "Độ tài tối đa 15 kí tự "
    },
    repassword: {
	required: 'Vui lòng nhập mật khẩu<br>',
	equalTo: 'Mật khẩu không trùng<br>'
						},
  }
});
});
</script>