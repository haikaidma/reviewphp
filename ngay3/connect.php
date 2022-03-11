<?php
$servername = "remotemysql.com";
$username = "Sv7bj9lfUZ";
$password = "b84oB8UbnH";
$database = "Sv7bj9lfUZ";

$con = new mysqli($servername, $username, $password, $database);
$cookie_name = 'siteAuth';
 
$cookie_time = (3600 * 24 * 30);

if ($con->connect_error) {
    die("Connection failed: " . $con->connect_error);
} else {
    echo "";
}
?>