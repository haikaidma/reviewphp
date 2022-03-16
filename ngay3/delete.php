<?php 
include_once 'connect.php';
$id=$_GET['ID'];
$sql = "DELETE FROM users WHERE ID=$id";
if (mysqli_query($con, $sql)) {

    echo "Data Deleted Successfully.";
  header("location: listuser.php?alert=Data Deleted Successfully");
} 
else {
    echo json_encode(array("statusCode"=>201));
}
mysqli_close($con);
// if($result = mysqli_query($con, $query)){
//     
// }
// else{
//     // echo "Error.";
//     header("location: listuser.php?alert=ERROR");
// }

?>