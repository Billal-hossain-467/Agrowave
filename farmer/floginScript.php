<?php
session_start(); // Starting Session
require('../sql.php'); // Includes Login Script

if (isset($_POST['farmerlogin'])) {
  $farmer_email = $_POST['farmer_email'];
  $farmer_password = $_POST['farmer_password'];

  // Query to validate farmer login credentials
  $farmerquery = "SELECT * FROM farmerlogin WHERE email='" . mysqli_real_escape_string($conn, $farmer_email) . "' AND password='" . mysqli_real_escape_string($conn, $farmer_password) . "' ";
  $result = mysqli_query($conn, $farmerquery);
  $rowcount = mysqli_num_rows($result);

  if ($rowcount > 0) {
    $_SESSION['farmer_login_user'] = $farmer_email; // Initializing Session
    header("location: fprofile.php"); // Redirecting To Farmer Profile Page
    exit();
  } else {
    // Set the error message in session if credentials are incorrect
    $_SESSION['login_error'] = "Email or Password is invalid";
    header("location: flogin.php"); // Redirect to login page with error
    exit();
  }

  mysqli_close($conn); // Closing Connection
}


?>
