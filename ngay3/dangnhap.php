<?php
//Khai báo sử dụng session
session_start();
include 'connect.php';
if(isset($_POST['submit'])){
	$username = $_POST['username'];
    $password = $_POST['Password'];
	// $password = md5($password);
	$sql = "SELECT email,password FROM users Where email='$username'";
	$result = mysqli_query($con, $sql);
	if (mysqli_num_rows($result) == 0) {
        echo "This username does not exist. Please check again! <a href='dangnhap.php'>Back Home</a>";
        exit;
    }
	$row = mysqli_fetch_array($result);
	if ($password != $row['password']) {
        echo "Incorrect password. Please re-enter!. <a href='dangnhap.php'>Back Home</a>";
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
			<form action="dangnhap.php" method="post">
				<div class="user-name">
					<input placeholder="Username" name="username" class="user" type="email" require  >
				</div>
				<br>
				<div class="pass-word">
					<input  placeholder="Password" name="Password" class="pass" type="password" require >
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