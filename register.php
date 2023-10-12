<?php
include 'connection.php';
$user_name = mysqli_real_escape_string($db, $_REQUEST['user_name']);
$pass_word = mysqli_real_escape_string($db, $_REQUEST['pass_word']);
$sql = "INSERT INTO users (username, password) VALUES('$user_name', '$pass_word')";


if(mysqli_query($db, $sql)) {
 echo "New Login added";
}
else {
 echo "Error: " . $sql . "<br>" . $db->error; 
}
?>