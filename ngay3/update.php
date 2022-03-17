<?php 
include_once 'connect.php';
if(count($_POST)>0) {
	$name=htmlspecialchars(mysqli_real_escape_string($con,$_POST['name']));
	$query = "UPDATE users SET name='" . $name. "' WHERE ID='" . $_GET['ID'] . "'";
	if($result = mysqli_query($con,$query)){
		echo "Record Updated Successfully.";
	}
	else{
		echo "Error 500.";
	}
	
}
$id = isset($_GET['ID']) ? $_GET['ID'] : false;
$id = str_replace('/[^0-9]/', '', $id);
	$result = mysqli_query($con,"SELECT * FROM users WHERE id = '".htmlspecialchars($id)	."' limit 1");
	if ($result) {
		$row= mysqli_fetch_assoc($result);	
	}

?>
<html>
<head>
	<title>Update Users Data</title>
</head>
<style>
    .form{
        height: 100%;
        text-align: center;
        margin:0 auto;
    }
	.error{
		color:red;
	}
</style>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
<script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
<script type="text/javascript" src="js/jquery.validate.min.js"></script>
<body>
<form name="frmUser"class="form" method="post" action="" id= "formupdate">
<div><?php if(isset($message)) { echo $message; } ?>
</div>
<div style="padding-bottom:5px;">
<a href="listuser.php">USERS LIST</a>
</div>
	
	 Name: <br>
	<input type="text" name="name"  value="<?php echo ($row['name']); ?>">
	<br>
	Email :<br>
	<input type="email" name="email" readonly  value="<?php echo ($row['email']); ?>">
    <br>
	<br>
	<input type="submit" name="submit" class="btn btn-primary" value="Submit" class="buttom">
</form>
</body>
</html>
<script type="text/javascript">
$(document).ready(function () {
//Khi bàn phím được nhấn và thả ra thì sẽ chạy phương thức này
$("#formupdate").validate({
  rules: {
    name: {
      required: true,
    },
  },
  messages: {
    name: {
      required: "Vui lòng nhập vào name",
    },
  }
});
});
</script>
