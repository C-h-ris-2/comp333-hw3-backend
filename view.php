<?php
include 'connection.php';
$id=$_GET['id'];
$_id = strval($id);
$sql = "SELECT * FROM ratings WHERE id = $_id";
$curr_rating = mysqli_query($db, $sql);
mysqli_close($db);
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Music Rating Page</title>
</head>
    <body>
    <?php
        echo "You are currently logged in as: " . $_SESSION["username"] . ".<br>";
    ?>
    <a href="logout.php">Log Out</a>
    <br>
        <?php
            if (mysqli_num_rows($curr_rating) > 0) {
                // output data of each row
                while($row = mysqli_fetch_assoc($curr_rating)) {
                  echo "id: " . $row['id']. " - Artist: " . $row['artist']. " - Song: " . $row['song']. " - Rating: " . $row['rating']. "<br>";
                }
              } else {
                echo "0 results";
              }
        ?>
    </body>
</html>
