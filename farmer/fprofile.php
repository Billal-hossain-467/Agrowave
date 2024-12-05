<?php
include('fsession.php');
ini_set('memory_limit', '-1');

// Check if the user is logged in
if (!isset($_SESSION['farmer_login_user'])) {
    header("location: ../index.php");
    exit;
}

// Get the logged-in user's email
$user_check = $_SESSION['farmer_login_user'];

// Fetch user details from the database
$query4 = "SELECT * FROM farmerlogin WHERE email='$user_check'";
$ses_sq4 = mysqli_query($conn, $query4);

if (!$ses_sq4) {
    die("Error in query: " . mysqli_error($conn));
}

$row4 = mysqli_fetch_assoc($ses_sq4);
if (!$row4) {
    die("No data found for the user.");
}

// Initialize variables with fallback values
$para1 = isset($row4['farmer_id']) ? $row4['farmer_id'] : "N/A";
$para2 = isset($row4['farmer_name']) ? $row4['farmer_name'] : "N/A";
$para3 = isset($row4['password']) ? $row4['password'] : "N/A";
$para5 = isset($row4['email']) ? $row4['email'] : "N/A";
$para6 = isset($row4['phone_no']) ? $row4['phone_no'] : "N/A";
$para7 = isset($row4['F_gender']) ? $row4['F_gender'] : "N/A";
$para8 = isset($row4['F_birthday']) ? $row4['F_birthday'] : "N/A";
$para9 = isset($row4['F_State']) ? $row4['F_State'] : "N/A";
$para10 = isset($row4['F_District']) ? $row4['F_District'] : "N/A";
$para11 = isset($row4['F_Location']) ? $row4['F_Location'] : "N/A";
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Farmer Profile - AgroWave</title>
  <link rel="icon" type="image/png" href="../assets/img/logo.png">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
  <style>
    /* General Body Styling */
    body {
      margin: 0;
      font-family: Arial, sans-serif;
      background: url('../assets/img/j.jpg') no-repeat center center fixed;
      color: #333;
    }

    /* Navigation Bar */
    nav {
      background-color: #004d4d;
      color: white;
      display: flex;
      justify-content: space-between;
      align-items: center;
      padding: 10px 20px;
      position: sticky;
      top: 0;
      z-index: 1000;
      box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    }

    nav a {
      color: white;
      text-decoration: none;
      margin-right: 15px;
      font-size: 18px;
    }

    nav a:hover {
      color: #ffcc00;
    }

    /* Profile Section */
    .profile-section {
      background: white;
      max-width: 900px;
      margin: 50px auto;
      border-radius: 15px;
      box-shadow: 0 8px 20px rgba(0, 0, 0, 0.2);
      overflow: hidden;
      animation: fadeIn 1s ease-in-out;
    }

    @keyframes fadeIn {
      from {
        opacity: 0;
        transform: translateY(20px);
      }
      to {
        opacity: 1;
        transform: translateY(0);
      }
    }

    .profile-header {
      background: linear-gradient(to right, #008080, #00cccc);
      color: white;
      padding: 30px;
      text-align: center;
    }

    .profile-header h3 {
      font-size: 2.5rem;
      margin: 0;
    }

    .profile-card {
      display: flex;
      align-items: center;
      flex-direction: column;
      padding: 30px 20px;
    }

    .profile-card img {
      border-radius: 50%;
      width: 150px;
      border: 5px solid #00cccc;
      margin-bottom: 15px;
    }

    .profile-card h4 {
      font-size: 1.5rem;
      color: #333;
      margin: 0;
    }

    /* Profile Details */
    .profile-details {
      padding: 20px;
    }

    .profile-details .row {
      display: flex;
      justify-content: space-between;
      align-items: center;
      padding: 10px 0;
      border-bottom: 1px solid #e0e0e0;
      font-size: 18px;
    }

    .profile-details .row:last-child {
      border-bottom: none;
    }

    .profile-details .row h3 {
      font-weight: bold;
      margin: 0;
      color: #555;
    }

    .profile-details .row div {
      text-align: right;
      color: #666;
    }

    .profile-details .row:hover {
      background: #f9f9f9;
      border-radius: 5px;
      transition: background 0.3s ease-in-out;
    }

    /* Footer */
    footer {
      text-align: center;
      padding: 20px;
      margin-top: 50px;
      background: #004d4d;
      color: white;
    }

    footer a {
      color: #ffcc00;
      text-decoration: none;
    }

    footer a:hover {
      text-decoration: underline;
    }

    /* Responsive Design */
    @media (max-width: 768px) {
      .profile-section {
        padding: 10px;
      }

      .profile-details .row {
        flex-direction: column;
        align-items: flex-start;
      }

      .profile-details .row div {
        text-align: left;
        margin-top: 5px;
      }
    }
  </style>
</head>
<body>
  <!-- Navigation -->
  <?php include('fnav.php'); ?>
  <!-- Profile Section -->
  <section class="profile-section">
    <div class="profile-header">
      <h3>Welcome to AgroWave</h3>
    </div>
    <div class="profile-card">
      <img src="../assets/img/agri.png" alt="Profile Picture">
      <h4>Hello, <?php echo htmlspecialchars($para2); ?></h4>
    </div>
    <div class="profile-details">
      <div class="row">
        <h3>Farmer ID:</h3>
        <div><?php echo htmlspecialchars($para1); ?></div>
      </div>
      <div class="row">
        <h3>Name:</h3>
        <div><?php echo htmlspecialchars($para2); ?></div>
      </div>
      <div class="row">
        <h3>Email:</h3>
        <div><?php echo htmlspecialchars($para5); ?></div>
      </div>
      <div class="row">
        <h3>Phone:</h3>
        <div><?php echo htmlspecialchars($para6); ?></div>
      </div>
      <div class="row">
        <h3>Gender:</h3>
        <div><?php echo htmlspecialchars($para7); ?></div>
      </div>
      <div class="row">
        <h3>Date of Birth:</h3>
        <div><?php echo htmlspecialchars($para8); ?></div>
      </div>
      
      <div class="row">
        <h3>District:</h3>
        <div><?php echo htmlspecialchars($para10); ?></div>
      </div>
      <div class="row">
        <h3>Upazila:</h3>
        <div><?php echo htmlspecialchars($para11); ?></div>
      </div>
    </div>
  </section>

  <!-- Footer -->
  
</body>
</html>
