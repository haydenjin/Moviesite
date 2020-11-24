<?php
session_start();
// If the session is not set, then send the user back to the login page
if (!isset($_SESSION["uid"])) {
  header("Location: index.php");
  exit();
} else {
  $uid = $_SESSION["uid"];
  $fname = $_SESSION["fname"];

  $movieId = $_POST["movieId"];

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

  // Try to find the movie
  $q = "SELECT * FROM Movies LEFT JOIN Ratings ON Movies.mid = Ratings.mid WHERE Movies.mid = '$movieId';";

  $result = $db->query($q);
  $row = $result->fetch_assoc();

  $title = $row["title"];
  $year = $row["year"];
  $poster = $row["poster"];
  $rating = $row["rating"];
  $origin = $row["origin"];
  $genre = $row["genre"];
  $director = $row["director"];
  $wiki = $row["wikiLink"];
  $cast = $row["cast"];

  // Save the fact the user viewed the movie
  $sql = "INSERT INTO Views (uid, mid, timeViewed) VALUES ($uid, $movieId, now());";
  $db->query($sql);

  // If user gave a valid rating store it in the database
  if (isset($_POST["hiddenrating"]) && $_POST["hiddenrating"] == "true") {
    $currrating = $_POST["currentrating"];
    $movieId = $_POST["movieId"];

    if ($rating == "") {
      $sql = "INSERT INTO Ratings (uid, mid, rating, dateRated) VALUES ($uid, $movieId, $currrating, now());";
      $db->query($sql);
    } else {
      $sql = "UPDATE Ratings SET rating = $currrating WHERE mid = $movieId;";
      $db->query($sql);
    }

    header("Location: home.php");
    exit();
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
          <form action="details.php" method="post">
            <input type="hidden" name="logout" value="true" />
            <input type="submit" id="button1" value="Logout" />
          </form>
          <form action="index.php" >
            <input type="submit" id="button1" value="Login" />
          </form>
          <form action="index.php" >
            <input type="submit" id="button1" value="Signup" />
          </form>
        </div>
      </div>
    </div>
    <h1 class><?php echo $title ?></h1>
  </header>
  <section>
    <img src="<?php echo "$poster.jpg" ?>" alt="" style="width: 180px; height: 280px" />
    <form action="details.php" method="post">
      <label for="rating">Rating (1-5):</label>
      <input type="hidden" name="hiddenrating" value="true" />
      <input type="hidden" name="movieId" value="<?php echo "$movieId" ?>" />
      <input type="number" id="rating" name="currentrating" min="1" max="5" />
      <input type="submit" value="Rate" />
    </form>
  </section>
  <aside>
    <p>Year Released: <?php echo $year ?></p>
    <p>Rating: <?php echo $rating ?></p>
    <p>
      Cast: <?php echo $cast ?>
    </p>
    <p>Genre: <?php echo $genre ?></p>
    <p>Origin: <?php echo $origin ?></p>
    <p>Directors: <?php echo $director ?></p>
    <p>
      Wiki Link:
      <a href="<?php echo $wiki ?>"><?php echo $title ?></a>
    </p>
  </aside>
  <div class="container">
    <form action="watchlist.php" method="post">
      <input type="hidden" name="addEntry" value="true" />
      <input type="hidden" name="movieId" value="<?php echo "$movieId" ?>" />
      <label for="watchlists">Add to a Watchlist:</label>
      <select name="watchlist">

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
          
          <option value="<?php echo "$watchlistId" ?>"><?php echo $name ?></option>
          
        <?php }
        $db->close(); ?>
      </select>
      <input type="submit" value="Add" >
    </form>
  </div>
  <script type="text/javascript" src="headers.js"></script>
</body>

</html>