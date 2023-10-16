<?php
include 'connection.php';
$sql = "SELECT * FROM ratings";
$ratings = mysqli_query($db, "SELECT * FROM ratings");
mysqli_close($db);
session_start();
$id2=$_GET['id'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Music Rating Page</title>
</head>
    <body>
        <?php
            echo "You are currently logged in as: " . $_SESSION["username"] . ".<br>";
            echo "ID: " . $id2. ".<br>";
        ?>
        <a href="logout.php">Log Out</a>
    </body>
</html>
