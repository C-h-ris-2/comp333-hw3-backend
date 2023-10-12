<?php
include 'connection.php';
$userid = $_POST['userid'];
$password = $_POST['password'];
$sql = "SELECT * FROM users WHERE username = '$userid' AND password = '$password'";
$result = mysqli_query($db, $sql) or die(mysqli_error($db));
$num = mysqli_fetch_array($result);

if($num > 0) {
 echo "Login Success";
}
else {
 echo "Wrong User id or password";
}
?>