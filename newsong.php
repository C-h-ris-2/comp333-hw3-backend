<?php
include 'connection.php';

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
                <input type="text" name='rating' id='ra
                ting'>
            </p>
                <input type="submit" value="Submit" name="submit">
                <input type="submit" value="Cancel" name="cancel">

        </form>
        <?php
        
        if ($_SERVER["REQUEST_METHOD"]== "POST" && isset($_POST["submit"])){
            if (empty($_POST['artist'])) {
                echo "You need to enter an artist!<br>";
              }
              else {
                $artist =$_POST['artist'];
              }
              
              if(empty($_POST['song'])) {
                echo "You need to enter a song!<br>";
              }
              else {
                $song = trim($_POST['song']);
              }
            
              if (empty($_POST['rating'])){
                echo "You need to enter a rating!<br>";
              }
              else{
                $rating = trim($_POST['rating']);
              }
            $sql = "SELECT id FROM ratings WHERE username = ? AND artist = ? AND song = ?";
            $stmt = $db->prepare($sql);
            
            // $select2 = "SELECT * FROM ratings WHERE artist ='".$_POST['artist']."' AND song ='".$_POST['song']."'";
            // $result = mysqli_query($db, $select2);
            if ($stmt) {
                $stmt->bind_param("sss", $_SESSION['username'],$artist,$song);
                $stmt->execute();
                $result=$stmt->get_result();
                if($result->num_rows > 0){
                    echo "This artist and song are already in the system. Insert another song!";
                }
                else if($_POST['rating']>5 OR $_POST['rating']<1){
                    echo "Please chose a rating from 1 to 5!";
                }
                else{
                    $add = "INSERT INTO ratings (username, artist, song, rating)
                    VALUES ('".$_SESSION['username']."','$artist','$song','$rating')";
                    mysqli_query($db, $add);
                    header("Location:musicratings.php");
                }}}
        else if ($_SERVER["REQUEST_METHOD"]=="POST" && isset($_POST["cancel"])){
            header("Location: musicratings.php");
            exit();
        }
        
        mysqli_close($db);
        ?>
    </body>
</html>