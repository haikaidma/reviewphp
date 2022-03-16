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
    <form action=""  method="post" id="formdangki">
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
          <input type="text" placeholder=" Name" name="name">
         <label for="email"><b>Email</b></label>  
          <input type="text" placeholder=" Email" name="email">
         <label for="password"><b>Password</b></label>
          <input type="password" placeholder="Password" name="password">
          <label for="psw"><b>Repassword</b></label>
          <input type="password" placeholder="Repassword" name="repassword">
         <div class="clearfix">
            <button type="submit" class="signupbtn" name="submit">Sign Up</button>
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