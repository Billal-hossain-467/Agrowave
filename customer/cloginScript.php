<?php
// Check if the session is already active before starting a new session
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$error = ''; // Variable to store error messages

// Check if the form has been submitted
if (isset($_POST['customerlogin'])) {
    $customer_email = $_POST['cust_email'];
    $customer_password = $_POST['cust_password'];

    // Include the database connection
    require('../sql.php'); // Ensure this file includes the correct database connection

    // Query to check if the customer exists in the database
    $checkquery = "SELECT * FROM `custlogin` WHERE email='" . mysqli_real_escape_string($conn, $customer_email) . "' AND password='" . mysqli_real_escape_string($conn, $customer_password) . "'";
    $result = mysqli_query($conn, $checkquery);
    $rowcount = mysqli_num_rows($result);

    // If customer exists, start session and redirect
    if ($rowcount > 0) {
        $_SESSION['customer_login_user'] = $customer_email; // Initialize session
        header("Location: cprofile.php"); // Redirect to profile page
        exit(); // Always call exit after redirect
    } else {
        // If credentials are incorrect, set the error message
        $error = 'Email or Password is Invalid!';
    }

    // Close the database connection
    mysqli_close($conn);
}
?>
