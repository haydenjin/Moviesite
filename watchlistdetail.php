<?php
session_start();
// If the session is not set, then send the user back to the login page
if (!isset($_SESSION["uid"])) {
  header("Location: index.php");
  exit();
} else {
  $uid = $_SESSION["uid"];
  $fname = $_SESSION["fname"];

  $watchlistId = $_POST["watchlistId"];

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

  // Check if user wants to delete an Entry 
  if (isset($_POST["delete"]) && $_POST["delete"] == "true") {
    $entryId = $_POST["deleteMovie"];
    $watchlistId = $_POST["watchlist"];

    $sql = "DELETE FROM Entries WHERE wid = '$watchlistId' AND mid = '$entryId';";
    $db->query($sql);
  }

  $db->close();
}

?>

<!DOCTYPE html>
<html>

<head>
  <title>Watchlist details</title>
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
          <form action="home.php" method="post">
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
    <h1 class>Watchlist details</h1>
  </header>

  <div class="grid-container">

    <?php
    // Connecting to database
    $db = new mysqli("localhost", "hjz261", "Wh@t16", "hjz261");
    // Check the connection 
    if ($db->connect_error) {
      die("Connection failed: " . $db->connect_error);
    }


    $q = "SELECT Movies.title, Movies.mid, Movies.poster, Ratings.rating 
    FROM Movies 
    LEFT JOIN Ratings ON Movies.mid = Ratings.mid
    INNER JOIN Entries ON Movies.mid = Entries.mid
    WHERE Entries.wid = '$watchlistId'
    ORDER BY Ratings.rating DESC;";

    $result = $db->query($q);

    $count = $result->num_rows;

    for ($i = 0; $i < $count; $i++) {

      $row = $result->fetch_assoc();
      $movieId = $row["mid"];
      $title = $row["title"];
      $poster = $row["poster"];
      $rating = $row["rating"];

    ?>

      <div class="grid-item">
        <img src="<?php echo "$poster.jpg" ?>" alt="" style="width: 180px; height: 280px" />
        <p><?php echo "$title" ?></p>
        <p>Rating: <?php echo "$rating" ?></p>
        <form action="watchlistdetail.php" method="post">
          <input type="hidden" name="delete" value="true" />
          <input type="hidden" name="watchlist" value="<?php echo "$watchlistId" ?>" />
          <input type="hidden" name="deleteMovie" value="<?php echo "$movieId" ?>" />
          <input type="submit" value="Remove" />
        </form>
      </div>
    <?php
    }
    $db->close();
    ?>
  </div>
  <div class="container">
    <a href="watchlist.php"> Back to watchlist </a>
  </div>
  <script type="text/javascript" src="headers.js"></script>
</body>

</html>