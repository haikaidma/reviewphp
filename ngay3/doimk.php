
<?php
include 'connect.php';
if(isset($_GET['token'])&&isset($_GET['token']))
{
  $token = $_GET['token'];
}
$currentDate = date('U');

$sql = "SELECT * FROM resetpass Where m_token='$token'";
$result = mysqli_query($con, $sql);
// if (mysqli_num_rows($result) == 0) {
//       header("location: doimk.php?error=Lỗi.");
//       exit;   
//   }
  $row = mysqli_fetch_array($result);
  $email = $row['m_email'];
  $m_time = $row['m_time'];
  if($m_time >= $currentDate){
    if(isset($_POST['submit'])){
      $token1 = $_POST['token'];
      $email1 = $_POST['email'];
      $newpass = md5($_POST['passwordchange']);
      $query = "UPDATE users SET  password ='$newpass' WHERE email ='$email1' ";
      $result2 = mysqli_query($con,$query);
      if($result2){
        header("location: doimk.php?token={$token}&success=Đổi mật khẩu thành công");
      }
      else{
        echo "lỗi";
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
<form action="" method="post" style="width:600px;" class="border border-primary border-2 m-auto p-2" id="formreset">   
<h4 style="text-align: center;">Đổi mật khẩu</h4>
<?php
				if(isset($_GET['success'])){
				?> <p class="success" style="color:green;"><?php echo $_GET['success'];?></p>	
				<?php }
				?>
    <input type="hidden" name="token" value="<?php echo $token; ?>">
    <input type="hidden" name="email" value="<?php echo $email; ?>">
    <div class="form-group">
    <label for="password">Nhập Mật khẩu</label>
    <input type="password" class="form-control" id="password" name="passwordchange" placeholder="Enter password">
    <label for="repassword">Nhập lại Mật khẩu</label>
    <input type="password" class="form-control" id="repassword" name="repasswordchange" placeholder="Enter Repassword">
  </div>
    <button type="submit" name="submit" class="btn btn-primary">Gửi yêu cầu</button>
    <br>
    <br>
    <a href=" dangnhap.php?"class="btn btn-success" >Đăng nhập</a>
    </form>
</body>
</html>
<script type="text/javascript">
$(document).ready(function () {

//Khi bàn phím được nhấn và thả ra thì sẽ chạy phương thức này
$("#formreset").validate({
  rules: {
    passwordchange: {
      required: true,
      minlength: 6,
      maxlength: 15
    },
    repasswordchange: {
        equalTo: "#password",
        minlength: 6,
      maxlength: 15
    },
  },
  messages: {
    passwordchange: {
      required: "Vui lòng nhập mật khẩu!",
      minlength: "Độ dài tối thiểu 6 kí tự ",
      maxlength: "Độ tài tối đa 15 kí tự "
    },
    repasswordchange: {
	required: 'Vui lòng nhập mật khẩu<br>',
	equalTo: 'Mật khẩu không trùng<br>'
						},
  }
});
});
</script>