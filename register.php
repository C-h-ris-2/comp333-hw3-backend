<?php
include 'connection.php';
$user_name = $_POST['user_name'];
$pass_word = $_POST['pass_word'];
$pass_word1 = $_POST['pass_word1'];
$select= mysqli_query($db, "SELECT * FROM users WHERE username = '".$_POST['user_name']."'");
?>


<html>
<body>
    <div id="form">
      <h1>New User</h1>
      <form name="form" action="register.php" method="POST">
        <p>
          <label for="username"> NEW USER NAME: </label>
          <input type="text" name="user_name" id="username">
        </p>
        <p>
          <label for="password"> NEW PASSWORD: </label>
          <input type="text" id="password" name="pass_word" >
        </p>
        <p>
          <label for="password">RE ENTER PASSWORD:</label>
          <input type="text" id="password1" name="pass_word1">
        </p>
        <p>
          <input type="submit" id="button" value="register" >
        </p>
      </form>
    </div>
    <?php
    if (mysqli_num_rows($select)) {
        echo "This username is taken";
    }
    else{
        if($pass_word != $pass_word1) {
            echo "Passwords do not match!";
        }
        else {
            $hashed_password = password_hash($pass_word, PASSWORD_DEFAULT);
            $sql = "INSERT INTO users (username, password) VALUES('$user_name', '$hashed_password')";
            if(mysqli_query($db, $sql)) {
            header("Location: form.html");
            }
            else {
            echo "Error: " . $sql . "<br>" . $db->error; 
            }
        }
    }
    ?>
  </body>
</html>

