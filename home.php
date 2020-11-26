<?php
session_start();
// If the session is not set, then send the user back to the login page
if (!isset($_SESSION["uid"])) {
  header("Location: index.php");
  exit();
} else {
  $uid = $_SESSION["uid"];
  $fname = $_SESSION["fname"];

  // Start the connection
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

  // Default setting for loading the page 
  $setpage = "default";

  if (isset($_POST["catagory"]) && $_POST["catagory"] == "Action") {
    $type = "genre";
    $setpage = "Action";
  } else if ($_POST["catagory"] == "Adventure") {
    $type = "genre";
    $setpage = "Adventure";
  } else if ($_POST["catagory"] == "Biography") {
    $type = "genre";
    $setpage = "Biography";
  } else if ($_POST["catagory"] == "Comedy") {
    $type = "genre";
    $setpage = "Comedy";
  } else if ($_POST["catagory"] == "Crime") {
    $type = "genre";
    $setpage = "Crime";
  } else if ($_POST["catagory"] == "Drama") {
    $type = "genre";
    $setpage = "Drama";
  } else if ($_POST["catagory"] == "Family") {
    $type = "genre";
    $setpage = "Family";
  } else if ($_POST["catagory"] == "Fantasy") {
    $type = "genre";
    $setpage = "Fantasy";
  } else if ($_POST["catagory"] == "Horror") {
    $type = "genre";
    $setpage = "Horror";
  } else if ($_POST["catagory"] == "Musical") {
    $type = "genre";
    $setpage = "Musical";
  } else if ($_POST["catagory"] == "Mystery") {
    $type = "genre";
    $setpage = "Mystery";
  } else if ($_POST["catagory"] == "Patriotic") {
    $type = "genre";
    $setpage = "Patriotic";
  } else if ($_POST["catagory"] == "Romance") {
    $type = "genre";
    $setpage = "Romance";
  } else if ($_POST["catagory"] == "Sci-fi") {
    $type = "genre";
    $setpage = "Sci-fi";
  } else if ($_POST["catagory"] == "Social") {
    $type = "genre";
    $setpage = "Social";
  } else if ($_POST["catagory"] == "Sports") {
    $type = "genre";
    $setpage = "Sports";
  } else if ($_POST["catagory"] == "Spy") {
    $type = "genre";
    $setpage = "Spy";
  } else if ($_POST["catagory"] == "Suspense") {
    $type = "genre";
    $setpage = "Suspense";
  } else if ($_POST["catagory"] == "Thriller") {
    $type = "genre";
    $setpage = "Thriller";
  } else if ($_POST["catagory"] == "War") {
    $type = "genre";
    $setpage = "War";
  } else if ($_POST["catagory"] == "Western") {
    $type = "genre";
    $setpage = "Western";
  } else if ($_POST["catagory"] == "Wuxia") {
    $type = "genre";
    $setpage = "Wuxia";
  } else if ($_POST["catagory"] == "Zombie") {
    $type = "genre";
    $setpage = "Zombie";
  } else if ($_POST["catagory"] == "American") {
    $type = "origin";
    $setpage = "American";
  } else if ($_POST["catagory"] == "Australian") {
    $type = "origin";
    $setpage = "Australian";
  } else if ($_POST["catagory"] == "Bollywood") {
    $type = "origin";
    $setpage = "Bollywood";
  } else if ($_POST["catagory"] == "British") {
    $type = "origin";
    $setpage = "British";
  } else if ($_POST["catagory"] == "Canadian") {
    $type = "origin";
    $setpage = "Canadian";
  } else if ($_POST["catagory"] == "Chinese") {
    $type = "origin";
    $setpage = "Chinese";
  } else if ($_POST["catagory"] == "Japanese") {
    $type = "origin";
    $setpage = "Japanese";
  } else if ($_POST["catagory"] == "Punjabi") {
    $type = "origin";
    $setpage = "Punjabi";
  } else if ($_POST["catagory"] == "Russian") {
    $type = "origin";
    $setpage = "Russian";
  } else if ($_POST["catagory"] == "Rating") {
    $setpage = "default";
  } else if ($_POST["catagory"] == "Title") {
    $setpage = "Title";
  } else if ($_POST["catagory"] == "Year released") {
    $setpage = "Year released";
  } else if ($_POST["catagory"] == "Search") {
    $setpage = $_POST["search"];
  }
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
        <button class="Genres">Genres</button>
        <div class="dropdown-content">
          <form action="home.php" method="post">
            <input type="hidden" name="catagory" value="Action" />
            <input type="submit" id="button1" value="Action" />
          </form>
          <form action="home.php" method="post">
            <input type="hidden" name="catagory" value="Adventure" />
            <input type="submit" id="button1" value="Adventure" />
          </form>
          <form action="home.php" method="post">
            <input type="hidden" name="catagory" value="Biography" />
            <input type="submit" id="button1" value="Biography" />
          </form>
          <form action="home.php" method="post">
            <input type="hidden" name="catagory" value="Comedy" />
            <input type="submit" id="button1" value="Comedy" />
          </form>
          <form action="home.php" method="post">
            <input type="hidden" name="catagory" value="Crime" />
            <input type="submit" id="button1" value="Crime" />
          </form>
          <form action="home.php" method="post">
            <input type="hidden" name="catagory" value="Drama" />
            <input type="submit" id="button1" value="Drama" />
          </form>
          <form action="home.php" method="post">
            <input type="hidden" name="catagory" value="Family" />
            <input type="submit" id="button1" value="Family" />
          </form>
          <form action="home.php" method="post">
            <input type="hidden" name="catagory" value="Fantasy" />
            <input type="submit" id="button1" value="Fantasy" />
          </form>
          <form action="home.php" method="post">
            <input type="hidden" name="catagory" value="Horror" />
            <input type="submit" id="button1" value="Horror" />
          </form>
          <form action="home.php" method="post">
            <input type="hidden" name="catagory" value="Musical" />
            <input type="submit" id="button1" value="Musical" />
          </form>
          <form action="home.php" method="post">
            <input type="hidden" name="catagory" value="Mystery" />
            <input type="submit" id="button1" value="Mystery" />
          </form>
          <form action="home.php" method="post">
            <input type="hidden" name="catagory" value="Patriotic" />
            <input type="submit" id="button1" value="Patriotic" />
          </form>
          <form action="home.php" method="post">
            <input type="hidden" name="catagory" value="Romance" />
            <input type="submit" id="button1" value="Romance" />
          </form>
          <form action="home.php" method="post">
            <input type="hidden" name="catagory" value="Sci-fi" />
            <input type="submit" id="button1" value="Sci-fi" />
          </form>
          <form action="home.php" method="post">
            <input type="hidden" name="catagory" value="Social" />
            <input type="submit" id="button1" value="Social" />
          </form>
          <form action="home.php" method="post">
            <input type="hidden" name="catagory" value="Sports" />
            <input type="submit" id="button1" value="Sports" />
          </form>
          <form action="home.php" method="post">
            <input type="hidden" name="catagory" value="Spy" />
            <input type="submit" id="button1" value="Spy" />
          </form>
          <form action="home.php" method="post">
            <input type="hidden" name="catagory" value="Suspense" />
            <input type="submit" id="button1" value="Suspense" />
          </form>
          <form action="home.php" method="post">
            <input type="hidden" name="catagory" value="Thriller" />
            <input type="submit" id="button1" value="Thriller" />
          </form>
          <form action="home.php" method="post">
            <input type="hidden" name="catagory" value="War" />
            <input type="submit" id="button1" value="War" />
          </form>
          <form action="home.php" method="post">
            <input type="hidden" name="catagory" value="Western" />
            <input type="submit" id="button1" value="Western" />
          </form>
          <form action="home.php" method="post">
            <input type="hidden" name="catagory" value="Wuxia" />
            <input type="submit" id="button1" value="Wuxia" />
          </form>
          <form action="home.php" method="post">
            <input type="hidden" name="catagory" value="Zombie" />
            <input type="submit" id="button1" value="Zombie" />
          </form>
        </div>
      </div>
      <div class="dropdown">
        <button class="Origins">Origins</button>
        <div class="dropdown-content">
          <form action="home.php" method="post">
            <input type="hidden" name="catagory" value="American" />
            <input type="submit" id="button1" value="American" />
          </form>
          <form action="home.php" method="post">
            <input type="hidden" name="catagory" value="Australian" />
            <input type="submit" id="button1" value="Australian" />
          </form>
          <form action="home.php" method="post">
            <input type="hidden" name="catagory" value="Bollywood" />
            <input type="submit" id="button1" value="Bollywood" />
          </form>
          <form action="home.php" method="post">
            <input type="hidden" name="catagory" value="British" />
            <input type="submit" id="button1" value="British" />
          </form>
          <form action="home.php" method="post">
            <input type="hidden" name="catagory" value="Canadian" />
            <input type="submit" id="button1" value="Canadian" />
          </form>
          <form action="home.php" method="post">
            <input type="hidden" name="catagory" value="Chinese" />
            <input type="submit" id="button1" value="Chinese" />
          </form>
          <form action="home.php" method="post">
            <input type="hidden" name="catagory" value="Japanese" />
            <input type="submit" id="button1" value="Japanese" />
          </form>
          <form action="home.php" method="post">
            <input type="hidden" name="catagory" value="Punjabi" />
            <input type="submit" id="button1" value="Punjabi" />
          </form>
          <form action="home.php" method="post">
            <input type="hidden" name="catagory" value="Russian" />
            <input type="submit" id="button1" value="Russian" />
          </form>
        </div>
      </div>
      <div class="dropdown">
        <button class="Origins">Sort By</button>
        <div class="dropdown-content">
          <form action="home.php" method="post">
            <input type="hidden" name="catagory" value="Rating" />
            <input type="submit" id="button1" value="Rating" />
          </form>
          <form action="home.php" method="post">
            <input type="hidden" name="catagory" value="Title" />
            <input type="submit" id="button1" value="Title" />
          </form>
          <form action="home.php" method="post">
            <input type="hidden" name="catagory" value="Year released" />
            <input type="submit" id="button1" value="Year released" />
          </form>
        </div>
      </div>
      <div class="dropdown">
        <button class="Origins">Settings</button>
        <div class="dropdown-content">
          <img src="<?php echo "pictureuploads/$image" ?>" alt="" style="width: 150px; height: 150px" />
          <p><?= $fname ?></p>
          <form action="home.php" method="post">
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
      <div class="search">
        <form id="searchButton" action="home.php" method="post">
          <label id="msg_searchBar"> </label>
          <input type="hidden" name="catagory" value="Search" />
          <input type="text" placeholder="Search.." id="search" name="search" />
          <input type="submit" value="Search" />
        </form>
      </div>
    </div>
    <h1 class>Welcome to home</h1>
  </header>

  <div class="grid-container">
    <?php

    // Connecting to database
    $db = new mysqli("localhost", "hjz261", "Wh@t16", "hjz261");
    // Check the connection 
    if ($db->connect_error) {
      die("Connection failed: " . $db->connect_error);
    }

    // Sorts the page by rating
    if ($setpage == "default") {
      $q = "SELECT Movies.title, Movies.mid, Movies.poster, ROUND(AVG(Ratings.rating),2) AS AverageRating  
      FROM Movies LEFT JOIN Ratings ON Movies.mid = Ratings.mid GROUP BY mid
      ORDER BY ROUND(AVG(Ratings.rating),2) DESC LIMIT 15;";

      $result = $db->query($q);
    } // Sorts the page by title
    else if ($setpage == "Title") {
      $q = "SELECT Movies.title, Movies.mid, Movies.poster, ROUND(AVG(Ratings.rating),2) AS AverageRating  
      FROM Movies LEFT JOIN Ratings
      ON Movies.mid = Ratings.mid GROUP BY mid
      ORDER BY Movies.title ASC LIMIT 15;";

      $result = $db->query($q);
    } // Sorts the page by year
    else if ($setpage == "Year released") {
      $q = "SELECT Movies.title, Movies.mid, Movies.poster, ROUND(AVG(Ratings.rating),2) AS AverageRating 
      FROM Movies LEFT JOIN Ratings
      ON Movies.mid = Ratings.mid GROUP BY mid
      ORDER BY Movies.year DESC LIMIT 15;";

      $result = $db->query($q);
    } else if ($type == "genre") {
      $q = "SELECT Movies.title, Movies.mid, Movies.poster, ROUND(AVG(Ratings.rating),2) AS AverageRating  
      FROM Movies LEFT JOIN Ratings
      ON Movies.mid = Ratings.mid 
      WHERE Movies.genre = '$setpage' GROUP BY mid
      ORDER BY Ratings.rating DESC LIMIT 15;";

      $result = $db->query($q);
    } else if ($type == "origin") {
      $q = "SELECT Movies.title, Movies.mid, Movies.poster, ROUND(AVG(Ratings.rating),2) AS AverageRating  
      FROM Movies LEFT JOIN Ratings
      ON Movies.mid = Ratings.mid 
      WHERE Movies.origin = '$setpage' GROUP BY mid
      ORDER BY Ratings.rating DESC LIMIT 15;";

      $result = $db->query($q);
    } // User used search bar
    else {
      $q = "SELECT Movies.title, Movies.mid, Movies.poster, ROUND(AVG(Ratings.rating),2) AS AverageRating  
      FROM Movies LEFT JOIN Ratings
      ON Movies.mid = Ratings.mid 
      WHERE Movies.title LIKE '%$setpage%' GROUP BY mid
      ORDER BY Ratings.rating DESC LIMIT 15;";

      $result = $db->query($q);
    }

    $count = $result->num_rows;

    for ($i = 0; $i < $count; $i++) {

      $row = $result->fetch_assoc();
      $movieId = $row["mid"];
      $title = $row["title"];
      $poster = $row["poster"];
      $rating = $row["AverageRating"];

    ?>
      <div class="grid-item">
        <form action="details.php" method="post">
          <input type="hidden" name="movieId" value="<?php echo $movieId ?>" />
          <img src="<?php echo "$poster.jpg" ?>" alt="" style="width: 180px; height: 280px" />
          <input type="submit" id="button2" value="<?php echo "$title" ?>" />
          <p>Rating: <?php echo "$rating" ?></p>
        </form>
      </div>
    <?php
    }
    $db->close();
    ?>
  </div>
  <script type="text/javascript" src="headers.js"></script>
</body>
</html>