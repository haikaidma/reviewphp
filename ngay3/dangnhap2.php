<?php
//Khai báo sử dụng session
session_start();
include 'connect.php';
//remember me
if(empty($_SESSION['username'])){
 
    if(isset($cookie_name)){

        if(isset($_COOKIE[$cookie_name])){

            parse_str($_COOKIE[$cookie_name]);

            $sql2="select * from users where name='$username' and password='$hash'";

            $result2=mysqli_query($sql2,$con);

            if($result2){

                header('location:listuser.php');

                exit;

            }

        }

    }

}

else{

    header('location:infomation.php');//chuyển qua trang đăng nhập thành công

    exit;

}   


//--------
if(isset($_POST['submit'])){
	$username = $_POST['username'];
    $password = md5($_POST['Password']);
    $a_check=((isset($_POST['remember'])!=0)?1:"");
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
    $f_user=$row['username'];
 
    $f_pass=$row['password'];

    if($f_user==$username && $f_pass==$password){

        $_SESSION['username']=$f_user;

        $_SESSION['password']=$f_pass;

        if($a_check==1){

            setcookie ($cookie_name, 'username='.$f_user.'&hash='.$f_pass, time() + $cookie_time);

        }

}
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
	<script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
<script type="text/javascript" src="js/jquery.validate.min.js"></script>
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
			<form action="dangnhap2.php" method="post" id= "myForm" >
				<?php
				if(isset($_GET['error'])){
				?> <p class="error" style="color:red;"><?php echo $_GET['error'];?></p>	
				<?php }
				?>
				<div class="user-name">
					<input placeholder="Username" name="username" class="user" type="email" value="">
				</div>
				<br>
				<div class="pass-word">
					<input  placeholder="Password" name="Password" class="pass" type="password"  value="" >
				</div>
				<br>
				<div class="remember-me">
					<label for="remember-me" style="color:white;">Remember me</label>
					<input name="remember"  type="checkbox" value="1">
				</div>
				<br>
					<a class="reg" href="dangki.php" >Do not have an account?</a>
					<br>
				<div class="bnt-reg-sub">
					<div class="submit">
						<button class="btn-2" type="submit" name="submit">Sign In</button>
						<a class="reg" href="resetpass.php" >Forgot password</a>
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
      minlength: 6
    },
  },
  messages: {
    username: {
      required: "Vui lòng nhập vào email",
      email: "Nhập đúng định dạng email đê :D"
    },
    Password: {
      required: "Vui lòng nhập mật khẩu!",
      minlength: "Độ dài tối thiểu 6 kí tự"
    },
  }
});
});
</script>