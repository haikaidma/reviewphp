<?php
include_once 'connect.php';
$result = mysqli_query($con,"SELECT * FROM users");
?>
<!DOCTYPE html>
<html>
<head>
</head>
<style>
table {
  font-family: arial, sans-serif;
  border-collapse: collapse;
  width: 100%;
}

td, th {
  border: 1px solid #dddddd;
  text-align: left;
  padding: 8px;
}

tr:nth-child(even) {
  background-color: #dddddd;
}
</style>
<body>
	<h4>LIST USER</h4>
<table>
	<tr>
		<td>Name</td>
		<td>Email</td>
		<td>Password</td>
	</tr>
	<?php
	$i=0;
	while($row=mysqli_fetch_assoc($result)) {
	?>
	<tr>
		<td><?php echo $row["name"]; ?></td>
		<td><?php echo $row["email"]; ?></td>
		<td><?php echo $row["password"]; ?></td>
	</tr>
	<?php
	$i++;
	}
	?>
</table>
<a href='dangnhap.php'>back</a>
</body>
</html>	