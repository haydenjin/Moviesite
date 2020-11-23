<?php
// Check if the form was submitted
if (isset($_POST["submittedlogin"]) && $_POST["submittedlogin"]) {

  // Get the username and password
  $email = trim($_POST["emailInput1"]);
  $password = trim($_POST["pword1"]);
  // Check they are not empty

  if (strlen($email) > 0 && strlen($password) > 0) {
    // Connect to the database 
    $db = new mysqli("localhost", "hjz261", "Wh@t16", "hjz261");
    // Check the connection 
    if ($db->connect_error) {
      die("Connection failed: " . $db->connect_error);
    }

    // Try to find the user in the database
    $q = "SELECT uid, fname FROM Users WHERE email = '$email' AND password = '$password';";

    $result = $db->query($q);

    if ($row = $result->fetch_assoc()) {
      // User has been logged in, start a session
      session_start();
      $_SESSION["uid"] = $row["uid"];
      $_SESSION["fname"] = $row["fname"];

      //Save the fact that the user logged in
      $sql = "UPDATE Users SET isLoggedIn = 1 WHERE email='$email';";

      $db->query($sql);

      // Redirect to the home page 
      header("Location: home.php");
      $db->close();
      exit();
    } else {
      // Couldn't find the user
      $error = ("Username/password doesn't match");
      $db->close();
    }
  } else {
    // The email or password is empty
    $error = ("The username or password is blank");
  }
} else {
  $error = "";
}
?>

<!DOCTYPE html>
<html>

<head>
  <title>Login Page</title>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <script type="text/javascript" src="validate.js"></script>
  <link rel="stylesheet" href="css.css" />
</head>

<body>
  <header>
    <h1 class>Login Page</h1>
  </header>
  <div class="container">
    <p class="error"><?= $error ?></p>
    <form id="Login" action="index.php" method="post">
      <input type="hidden" name="submittedlogin" value="1" />
      <label for="emailInput1">Email:</label><br />
      <input type="text" id="emailInput1" name="emailInput1" /><br />
      <label id="msg_email1"> </label><br />

      <label for="pword1">Password:</label><br />
      <input type="text" id="pword1" name="pword1" /><br />
      <label id="msg_pswd1"> </label><br />

      <input type="submit" id="submit" name="submit" value="Login" />
    </form>
  </div>
  <div class="container">
    <p>Not registered? <a href="signup.php"> Signup here </a></p>
    <p>Or <a href="home.php"> continue as guest </a></p>
  </div>
  <script type="text/javascript" src="headers.js"></script>
</body>

</html>