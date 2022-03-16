<?php
    session_start();
    ob_start();
    include 'connect.php';
    if(isset($_COOKIE['username']) && isset($_COOKIE['password'])){
        $ck_email = $_COOKIE['username'];
        $ck_password = $_COOKIE['password'];
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
			<form action="" method="post" id= "myForm" >
            <?php 
            if(isset($_POST['submit'])){
                $username = $_POST['username'];
                $password = $_POST['password'];
                $sql = "SELECT email,password FROM users Where email='$username'";
                $result = mysqli_query($con, $sql);
                // if (mysqli_num_rows($result) == 0) {
                //     header("location: dangnhap.php?error=This username does not exist. Please check again!");
                //     exit;
                // }    
                
                            if(mysqli_num_rows($result) > 0){
                                while($row = mysqli_fetch_array($result)){
                                    if(password_verify($password, $row['password'])){
                                      echo $password;
                                        $_SESSION['username'] = $username;
                                        if(isset($_POST['remember']) && ($_POST['remember'])){
                                            setcookie('username', $username, time() + (86400*30));
                                            setcookie('password', $password, time() + (86400*30));
                                        }
                                        header('location: listuser.php');
                                    }else{
                                        echo '<strong style="color:red">Email hoặc password nhập sai</strong>';
                                    }
                                }
                            }else{
                                echo '<strong style="color:red">Tài khoản không tồn tại, vui lòng đăng ký để tiếp tục đăng nhập</strong>';
                            }
                            
                        }
                    ?>
				<?php
				if(isset($_GET['error'])){
				?> <p class="error" style="color:red;"><?php echo $_GET['error'];?></p>	
				<?php }
				?>
				<div class="user-name">
					<input placeholder="Username" name="username" class="user" type="email" value="<?php if(isset($ck_email)) echo $ck_email;?>"  >
				</div>
				<br>
				<div class="pass-word">
					<input  placeholder="Password" name="password" class="pass" type="password"  value="<?php if(isset($ck_password)) echo $ck_password;?>" >
				</div>
				<br>
				<div class="remember-me">
					<label for="remember-me" style="color:white;">Remember me</label>
					<input name="remember"  type="checkbox">
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