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
            <img src="pic4.jpeg" alt="" style="width: 150px; height: 150px" />
            <p>Freddy</p>
            <a href="index.php">Logout </a>
            <a href="index.php">Login </a>
            <a href="signup.php">Signup </a>
          </div>
        </div>
        <div class="search">
          <form id="searchButton">
            <label id="msg_searchBar"> </label>
            <input type="text" placeholder="Search.." id="search" />
            <input type="submit" value="Search" />
          </form>
        </div>
      </div>
      <h1 class>Watchlist details</h1>
    </header>
    <div class="grid-container">
      <div class="grid-item">
        <img src="pic1.jpg" alt="" style="width: 180px; height: 280px" />
        <p>Avengers Endgame</p>
        <p>Rating: 8.4</p>
        <a href="watchlistdetail.php"> Remove </a>
      </div>
      <div class="grid-item">
        <img src="pic3.jpg" alt="" style="width: 180px; height: 280px" />
        <p>Interstellar</p>
        <p>Rating: 9.9</p>
        <a href="watchlistdetail.php"> Remove </a>
      </div>
      <div class="grid-item">
        <img src="pic1.jpg" alt="" style="width: 180px; height: 280px" />
        <p>Avengers Endgame</p>
        <p>Rating: 8.4</p>
        <a href="watchlistdetail.php"> Remove </a>
      </div>
    </div>

    <div class="container">
      <a href="watchlist.php"> Back to watchlist </a>
    </div>
    <script type="text/javascript" src="headers.js"></script>
  </body>
</html>
