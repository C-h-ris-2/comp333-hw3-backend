<?php
include 'connection.php';
$id=$_GET['id'];
$_id = strval($id);
session_start();

?>

<html>
    <head>
        <title>Delete page</title>
    </head>
    <body>

        <div id="form">
            <h1>Rating delete</h1>
            <form name="form" method="POST">
                <p>
                <label>Are you sure you want to delete this rating?</label>
                <br>
                <input type="submit" value="Confirm delete" name="confirm_delete">
                <input type="submit" value="Don't delete" name="dont_delete">
                </p>
            </form>
        </div>
        <?php
        if ($_SERVER["REQUEST_METHOD"]== "POST" && isset($_POST["confirm_delete"])){
            $sql = "DELETE FROM ratings WHERE id=$id";
            mysqli_query($db, $sql);
            header("Location:musicratings.php");
        }
        else if ($_SERVER["REQUEST_METHOD"]=="POST" && isset($_POST["dont_delete"])){
            header("Location: musicratings.php");
            exit();
        }
        mysqli_close($db);
        ?>
    </body>
</html>

