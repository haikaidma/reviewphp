<?php 

include('connect.php');

$error='';

if(isset($_POST['id_user'])){
    $id_user = $_POST['id_user'];

    $sql = "DELETE FROM users WHERE ID='".$id_user."'";
    if(mysqli_query($con, $sql)){
        echo 'delete user id='.$id_user.'success';
    }else{
        echo 'fail';
    }
    
}
?>
?>