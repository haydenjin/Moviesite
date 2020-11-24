<?php
session_start();
// If the session is not set, then send the user back to the login page
if (!isset($_SESSION["uid"])) {
  header("Location: index.php");
  exit();
} else {
  $uid = $_SESSION["uid"];
  $fname = $_SESSION["fname"];

  $db = new mysqli("localhost", "hjz261", "Wh@t16", "hjz261");
  // Check the connection 
  if ($db->connect_error) {
    die("Connection failed: " . $db->connect_error);
  }

  // Logs the user out and saves it in the database
  if (isset($_POST["logout"]) && $_POST["logout"] == "true") {
    $sql = "UPDATE Users SET isLoggedIn = 0 WHERE uid='$uid';";

    $db->query($sql);

    session_destroy();
    header("Location: index.php");
    exit();
  }

  // Try to find the user in the database
  $q = "SELECT avatar FROM Users WHERE uid = '$uid';";

  $result = $db->query($q);
  $row = $result->fetch_assoc();
  $image = $row["avatar"];

  // Check if the user is trying to make a new watchlist
  if (isset($_POST["nameCheck"]) && $_POST["nameCheck"] == "true") {
    $name = $_POST["name"];
    $sql = "INSERT INTO Watchlists (uid, name, dateCreated) VALUES ($uid, '$name', now());";
    $db->query($sql);
  }

  // Check if user added a movie to a watchlist
  if (isset($_POST["addEntry"]) && $_POST["addEntry"] == "true") {
    $wId = $_POST["watchlist"];
    $movieId = $_POST["movieId"];

    $sql = "INSERT INTO Entries (wid, mid, dateAdded) VALUES ($wId, $movieId, now());";
    $db->query($sql);
  }

  // Check if user wants to delete a watchlist
  if (isset($_POST["deleteWatchlist"]) && $_POST["deleteWatchlist"] == "true") {
    $wId = $_POST["watchlistId"];

    $sql = "DELETE FROM Watchlists WHERE wid = '$wId';";
    $db->query($sql);
  }

  $db->close();
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
    <div class="navbar">
      <a href="home.php">Home</a>
      <a href="watchlist.php">Watchlists</a>
      <div class="dropdown">
        <button class="Origins">Settings</button>
        <div class="dropdown-content">
          <img src="<?php echo "pictureuploads/$image" ?>" alt="" style="width: 150px; height: 150px" />
          <p><?= $fname ?></p>
          <form action="watchlist.php" method="post">
            <input type="hidden" name="logout" value="true" />
            <input type="submit" id="button1" value="Logout" />
          </form>
          <form action="index.php">
            <input type="submit" id="button1" value="Login" />
          </form>
          <form action="index.php">
            <input type="submit" id="button1" value="Signup" />
          </form>
        </div>
      </div>
    </div>
    <h1 class>My watchlists</h1>
  </header>
  <div class="container">
    <form id="watch" action="watchlist.php" method="POST">
      <input type="hidden" name="nameCheck" value="true" /><br />
      <label for="name">Name:</label><br />
      <input type="text" id="name" name="name" /><br />
      <label id="msg_watch"> </label><br />
      <input type="submit" value="Create New Watchlist" />
    </form>
  </div>
  <div class="container">
    <table style="width: 80%; margin-left: auto; margin-right: auto">
      <tr>
        <th>Watchlist Name</th>
        <th></th>
      </tr>

      <?php

      $db = new mysqli("localhost", "hjz261", "Wh@t16", "hjz261");
      // Check the connection 
      if ($db->connect_error) {
        die("Connection failed: " . $db->connect_error);
      }

      // Rendering all the watchlists
      $q = "SELECT wid, name FROM Watchlists WHERE uid = '$uid';";

      $result = $db->query($q);
      $count = $result->num_rows;

      for ($i = 0; $i < $count; $i++) {

        $row = $result->fetch_assoc();
        $watchlistId = $row["wid"];
        $name = $row["name"];

      ?>
        <tr>
          <form action="watchlistdetail.php" method="post">
            <input type="hidden" name="selectWatchlist" value="true" />
            <input type="hidden" name="watchlistId" value="<?php echo "$watchlistId" ?>" />
            <td><input type="submit" value="<?php echo $name ?>" /></td>
          </form>
          <form action="watchlist.php" method="post">
            <input type="hidden" name="deleteWatchlist" value="true" />
            <input type="hidden" name="watchlistId" value="<?php echo "$watchlistId" ?>" />
            <td><input type="submit" value="Delete" /></td>
          </form>
        </tr>
      <?php }
      $db->close(); ?>
    </table>
  </div>
  <div class="container">
    <a href="home.php"> Back to home </a>
  </div>
  <script type="text/javascript" src="headers.js"></script>
</body>

</html>