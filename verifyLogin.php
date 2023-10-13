<?php
include 'connection.php';
if (empty($_POST['userid'])) {
  echo "You need to enter your username<br>";
}
else {
  $userid = mysqli_real_escape_string($db, trim($_POST['userid']));
}

if(empty($_POST['password'])) {
  echo "You need to input your password<br>";
}
else {
  $password = mysqli_real_escape_string($db, trim($_POST['password']));
}
// Use placeholders ? for username and password values for the time being.
$sql = "SELECT * FROM users WHERE username = ? AND password = ?";
// Construct a prepared statement.
$stmt = mysqli_prepare($db, $sql);
// Bind the values for username and password that the user entered to the
// statement AS STRINGS (that is what "ss" means). In other words, the
// user input is strictly interpreted by the server as data and not as
// porgram code part of the SQL statement.
mysqli_stmt_bind_param($stmt, "ss", $userid, $password);
// Run the prepared statement.
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);
$num = mysqli_num_rows($result);
?>

<html>
  <head>
    <title>Login Page</title>
    <link rel="stylesheet" type="text/css" href="style.css" />
  </head>

  <body>
    <div id="form">
      <h1>Welcome to RevMixer</h1>
      <form name="form" action="verifyLogin.php" method="POST">
        <p>
          <label> USER NAME: </label>
          <input type="text" id="user" name="userid" />
        </p>
        <p>
          <label> PASSWORD: </label>
          <input type="text" id="pass" name="password" />
        </p>

        <p>
          <input type="submit" id="button" value="Login" />
        </p>
      </form>
      <a href="register.html">Not Registered? Click here!</a>
    </div>
    <?php
    if($num > 0) {
      echo "Login Success";
     }
     else {
      echo "Wrong User id or password";
     
     }
     ?>
  </body>
</html>

