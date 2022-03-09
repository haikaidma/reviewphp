<?php
//Khai báo sử dụng session
session_start();
include 'connect.php';
if(isset($_POST['submit'])){
	$username = $_POST['username'];
    $password = md5($_POST['Password']);
	$sql = "SELECT email,password FROM users Where email='$username'";
	$result = mysqli_query($con, $sql);
	if (mysqli_num_rows($result) == 0) {
        header("location: dangnhap.php?error=This username does not exist. Please check again!");
        exit;
    }
	$row = mysqli_fetch_array($result);
	if ($password != $row['password']) {
        header("location: dangnhap.php?error=Incorrect password. Please re-enter!. ");
        exit;
    }
	$_SESSION['username'] = $username;
	header("Location: listuser.php"); 
exit();
}

?>
<!DOCTYPE html>
<html lang="en">
<head>	
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="style.css">
	<script src="http://code.jquery.com/jquery-3.4.1.min.js" 
    integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
<script type="text/javascript"
    src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.1/dist/jquery.validate.js"></script>
	<!-- <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous"> -->
</head>
<body>
	<!-- main -->
<div class="center-container">
	<!--header-->
	<div class="header-top">
		<h1>Data Management</h1>
	</div>
	<!--//header-->
	<div class="main-content-agile">
		<div class="sub-main-w3">	
			<div class="wthree-pro">
				<h2>ADMIN</h2>
			</div>
			<form action="dangnhap.php" method="post" id= "myForm" >
				<?php
				if(isset($_GET['error'])){
				?> <p class="error" style="color:red;"><?php echo $_GET['error'];?></p>	
				<?php }
				?>
				<div class="user-name">
					<input placeholder="Username" name="username" class="user" type="email"   >
				</div>
				<br>
				<div class="pass-word">
					<input  placeholder="Password" name="Password" class="pass" type="password"  >
				</div>
				<br>
					<a class="reg" href="dangki.php" >Do not have an account?</a>
					<br>
				<div class="bnt-reg-sub">
					<div class="submit">
						<button class="btn-2" type="submit" name="submit">Sign In</button>
					</div>
				</div>
			</form>
		</div>
	</div>
	
	<!--//main-->
	<!--footer-->
	<div class="footer">
		<p>&copy; 2022 NINE PLUS SOLUTIONS | Design by <a href="https://www.facebook.com/haigd2000/">Haikadima</a></p>
	</div>
	<!--//footer-->
</div>
</body>
</html>
<script type="text/javascript">
$(document).ready(function () {

//Khi bàn phím được nhấn và thả ra thì sẽ chạy phương thức này
$("#myForm").validate({
  rules: {
    username: "required",
    email: {
      required: true,
      email: true
    },
    Password: {
      required: true,
      minlength: 6,
      maxlength: 15
    },
  },
  messages: {
    username: {
      required: "Vui lòng nhập vào email",
      email: "Nhập đúng định dạng email đê :D"
    },
    Password: {
      required: "Vui lòng nhập mật khẩu!",
      minlength: "Độ dài tối thiểu 6 kí tự",
      maxlength: "Độ tài tối đa 15 kí tự"
    },
  }
});
});
</script>