<?php
include 'connection.php';
$id=$_GET['id'];
$_id = strval($id);
$sql = "SELECT * FROM ratings WHERE id = $_id";
$curr_rating = mysqli_query($db, $sql);
mysqli_close($db);
session_start();
?>

<html>
    <head>
        <title>Update</title>
    </head>
    <body>
        <form name="form">

        
        </form>
    </body>
</html>