<?php
// Check if the form was submitted 
if (isset($_POST["submitted"]) && $_POST["submitted"]) {

  $email = trim($_POST["emailInput"]);
  $password = trim($_POST["pword"]);
  $firstname = trim($_POST["fname"]);
  $username = trim($_POST["usern"]);
  $cpassword = trim($_POST["cpword"]);
  $dob = trim($_POST["dob"]);
  $avatar = ($_FILES["fileToUpload"]["name"]);

  // Check they are not empty
  if (strlen($email) > 0 && strlen($password) > 0 && strlen($firstname) > 0 && strlen($username) > 0 && $cpassword == $password && strlen($dob) > 0 && strlen($avatar) > 0) {
    // Connect to the database 
    $db = new mysqli("localhost", "hjz261", "Wh@t16", "hjz261");
    // Check the connection 
    if ($db->connect_error) {
      die("Connection failed: " . $db->connect_error);
    }

    $username = trim($_POST["usern"]);
    $fname = trim($_POST["fname"]);
    $email = trim($_POST["emailInput"]);
    $password = trim($_POST["pword"]);
    $dob = trim($_POST["dob"]);
    $avatar = ($_FILES["fileToUpload"]["name"]);

    $sql = "INSERT INTO Users (username, fname, email, password, dob, avatar, isLoggedIn) VALUES ('$username', '$fname', '$email', '$password', '$dob', '$avatar', '0');";

    if ($db->query($sql) === TRUE) {
      // Redirect to the login page 

      if ($_SERVER["REQUEST_METHOD"] == "POST") {

        $image = $_POST['fileToUpload'];

        $target_dir = "pictureuploads/";
        $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
        $uploadOk = 1;
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

        $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
        if ($check !== false) {
          echo "File is an image - " . $check["mime"] . ".";
          $uploadOk = 1;
        } else {
          echo "File is not an image.";
          $uploadOk = 0;
        }

        // Check if file already exists
        if (file_exists($target_file)) {
          echo "Sorry, file already exists.";
          $uploadOk = 0;
        }

        // Check file size
        if ($_FILES["fileToUpload"]["size"] > 500000) {
          echo "Sorry, your file is too large.";
          $uploadOk = 0;
        }

        // Allow certain file formats
        if (
          $imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
          && $imageFileType != "gif"
        ) {
          echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
          $uploadOk = 0;
        }

        // Check if $uploadOk is set to 0 by an error
        if ($uploadOk == 0) {
          echo "Sorry, your file was not uploaded.";
          // if everything is ok, try to upload file
        } else {
          if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
            echo "The file " . htmlspecialchars(basename($_FILES["fileToUpload"]["name"])) . " has been uploaded.";
          } else {
            echo "Sorry, there was an error uploading your file.";
          }
        }
      }

      header("Location: index.php");
      $db->close();
    } else {
      echo "Error: " . $sql . "<br>" . $db->error;
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
  <title>Sign Up Page</title>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <script type="text/javascript" src="validate.js"></script>
  <link rel="stylesheet" href="css.css" />
</head>

<body>
  <header>
    <a href="index.php"> Back to sign in </a>
    <h1 class>Sign Up Page</h1>
  </header>
  <div class="container">
    <p class="error"><?= $error1 ?></p>
    <p class="error"><?= $error2 ?></p>
    <form id="SignUp" action="signup.php" method="POST" enctype="multipart/form-data">
      <input type="hidden" name="submitted" value="1" />
      <label for="emailInput">Email:</label><br />
      <input type="text" id="emailInput" name="emailInput" /><br />
      <label id="msg_email"> </label><br />

      <label for="usern">User Name:</label><br />
      <input type="text" id="usern" name="usern" /><br />
      <label id="msg_uname"> </label><br />

      <label for="fname">First Name:</label><br />
      <input type="text" id="fname" name="fname" /><br />
      <label id="msg_fname"> </label><br />

      <label for="pword">Password:</label><br />
      <input type="text" id="pword" name="pword" /><br />
      <label id="msg_pswd"> </label><br />

      <label for="cpword">Confirm Password:</label><br />
      <input type="text" id="cpword" name="cpword" /><br />
      <label id="msg_pswdr"> </label><br />

      <label for="dob">Date of birth (yyyymmdd):</label><br />
      <input type="text" id="dob" name="dob" /><br />
      <label id="msg_dob"> </label><br />

      <label for="avatarpicture">Avatar File Upload:</label><br />
      <input type="file" id="fileToUpload" name="fileToUpload" /><br />
      <label id="msg_avatarpicture"> </label><br />

      <input type="submit" value="Sign up" />
    </form>
  </div>
  <script type="text/javascript" src="headers.js"></script>
</body>

</html>