<?php
include('connect.php');
if(isset($_POST['submit'])){
  $name = $_POST['name'];
  $username = $_POST['email'];
  $password  = $_POST['password'];
  // $password = md5($password);
  if (mysqli_num_rows(mysqli_query($con,"SELECT email FROM users WHERE email='$username'")) > 0)
  {
      echo "This email already has a user. Please choose another Email <a href='javascript: history.go(-1)'>Trở lại</a>.";
      exit;
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
          <p>Please enter the form below to register.</p>
          <hr>
          <label for="email"><b>Name</b></label>
          <input type="text" placeholder=" Name" name="name" required>
         <label for="email"><b>Email</b></label>
          <input type="text" placeholder=" Email" name="email" required>
         <label for="psw"><b>Password</b></label>
          <input type="password" placeholder="Password" name="password" required>
         <div class="clearfix">
            <button type="submit" class="signupbtn" name="submit">Sign Up</button>
          </div>
        </div>
      </form>
</body>
</html>