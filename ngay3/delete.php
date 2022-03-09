<?php 
include_once 'connect.php';
$query = "DELETE FROM users WHERE ID='" . $_GET["ID"] . "'";
if($result = mysqli_query($con, $query)){
    // echo "Data Deleted Successfully.";
    header("location: listuser.php?alert=Data Deleted Successfully");
}
else{
    // echo "Error.";
    header("location: listuser.php?alert=ERROR");
}

?>