<?php 
include_once 'connect.php';
if(count($_POST)>0) {
	
	$query = "UPDATE users SET ID='" . $_POST['ID'] . "', name='" . $_POST['name'] . "', password='" . md5($_POST['password']) . "',email='" . $_POST['email'] . "' WHERE ID='" . $_POST['ID'] . "'";
	if($result = mysqli_query($con,$query)){
		echo "Record Updated Successfully.";
	}
	else{
		echo "Error.";
	}
	
}
$result = mysqli_query($con,"SELECT * FROM users WHERE ID='" . $_GET['ID'] . "'");
$row= mysqli_fetch_assoc($result);
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
</style>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
<body>
<form name="frmUser"class="form" method="post" action="">
<div><?php if(isset($message)) { echo $message; } ?>
</div>
<div style="padding-bottom:5px;">
<a href="listuser.php">USERS LIST</a>
</div>
	ID: <br>
	<input type="hidden" name="ID" class="txtField" value="<?php echo $row['ID']; ?>">
	<input type="text" name="ID"  value="<?php echo $row['ID']; ?>">
	<br>
	 Name: <br>
	<input type="text" name="name"  value="<?php echo $row['name']; ?>">
	<br>
	Email :<br>
	<input type="email" name="email" readonly  value="<?php echo $row['email']; ?>">
	<br>
	Password:<br>
	<input type="password" name="password"   value="<?php echo $row['password']; ?>">
	<br>
	Repassword:<br>
	<input type="password" name="repassword"   value="<?php echo $row['password']; ?>">
	<br>
    <br>
	<input type="submit" name="submit" class="btn btn-primary" value="Submit" class="buttom">

</form>
</body>
</html>