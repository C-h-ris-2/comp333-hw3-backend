<?php
include 'connection.php';
$sql = "SELECT * FROM ratings";
$ratings = mysqli_query($db, $sql);
$rowcount = mysqli_num_rows($ratings);

session_start();
?>

<html>
    <head>
        <title>Add new Song</title>
    </head>
    <body>
        <?php
            echo "You are currently logged in as: " . $_SESSION["username"] . ".<br>";
        ?>
        <a href="logout.php">Log Out</a>
        <h1>Add a New Song</h1>
        <form name="form" method="POST">
            <p>
                <label for="artist">Artist</label>
                <input type="text" name='artist' id='artist'>
            </p>
            <p>
                <label for="song">Song</label>
                <input type="text" name='song' id='song'>
            </p>
            <p>
                <label for="rating">Rating</label>
                <input type="text" name='rating' id='rating'>
            </p>
                <input type="submit" value="Submit" name="submit">
                <input type="submit" value="Cancel" name="cancel">

        </form>
        <?php
        if ($_SERVER["REQUEST_METHOD"]== "POST" && isset($_POST["submit"])){
            $select2 = mysqli_query($db, "SELECT * FROM ratings WHERE song = '".$_POST['song']."'");
            $stmt = mysqli_prepare($db, $sql);
            if (mysqli_stmt_execute($stmt)) {
                echo "This artist and song are already in the system. Insert another song!";
            }else if($_POST['rating']>5){
                echo "Please chose a rating from 1 to 5!";
            }
            else{
                $add = "INSERT INTO ratings (username, artist, song, rating)
                VALUES ('".$_SESSION['username']."',' " .$_POST['artist']. " ',' " .$_POST['song']. " ',' " .$_POST['rating']. " ')";
                mysqli_query($db, $add);
                header("Location:musicratings.php");
            }}
            else if ($_SERVER["REQUEST_METHOD"]=="POST" && isset($_POST["cancel"])){
                header("Location: musicratings.php");
                exit();
        }
        
        mysqli_close($db);
        ?>
    </body>
</html>