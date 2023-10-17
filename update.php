<?php
include 'connection.php';
$id=$_GET['id'];
$_id = strval($id);
$sql = "SELECT * FROM ratings WHERE id = $_id";
$curr_rating = mysqli_query($db, $sql);
$rows=mysqli_fetch_assoc($curr_rating);
session_start();
?>

<html>
    <head>
        <title>Update</title>
    </head>
    <body>
        <?php
            echo "You are currently logged in as: " . $_SESSION["username"] . ".<br>";
        ?>
        <a href="logout.php">Log Out</a>
        <h1>Update your rating</h1>
        <form name="form" method="POST">
            <p>
                <label for="artist">Artist</label>
                <input type="text" value="<?php echo $rows['artist'];?>" name='ar_tist' id='artist'>
            </p>
            <p>
                <label for="song">Song</label>
                <input type="text" value="<?php echo $rows['song'];?>" name='so_ng' id='song'>
            </p>
            <p>
                <label for="rating">Rating</label>
                <input type="text" value="<?php echo $rows['rating'];?>" name='ra_ting' id='rating'>
            </p>
                <input type="submit" value="Submit" name="submit">
                <input type="submit" value="Cancel" name="cancel">

        </form>
        <?php
        if ($_SERVER["REQUEST_METHOD"]== "POST" && isset($_POST["submit"])){
            $sql1 = "UPDATE ratings SET artist='" . $_POST['ar_tist'] . "', song='" . $_POST['so_ng'] . "', rating='" . $_POST['ra_ting'] . "' WHERE id=" . $_id;
            if(mysqli_query($db, $sql1)){
                header("Location: musicratings.php");
            }
            else{
                echo "ERROR: Could not execute $sql";
            }
        }
        else if ($_SERVER["REQUEST_METHOD"]=="POST" && isset($_POST["cancel"])){
            header("Location: musicratings.php");
            exit();
        }
        mysqli_close($db);
        ?>
    </body>
</html>