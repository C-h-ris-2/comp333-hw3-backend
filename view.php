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
    <?php echo "You are currently logged in as: " . $_SESSION["username"] . ".<br>"; ?>
    <a href="logout.php">Log Out</a>
    <h1>View</h1>
        <?php
            if (mysqli_num_rows($curr_rating) > 0) {
              while($row = mysqli_fetch_assoc($curr_rating)) {
                ?>
                <h3> Username:</h3>
                <?php echo $row['username'];?>
                <h3> Artist:</h3>
                <?php echo $row['artist'];?>
                <h3> Song:</h3>
                <?php echo $row['song'];?>
                <h3> Rating:</h3>
                <?php echo $row['rating'];
                }
            } else {
              echo "0 results";
            }
        ?>
        <a href="musicratings.php"></br></br>Back</a>
    </body>
</html>