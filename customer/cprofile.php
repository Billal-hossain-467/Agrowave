<?php
include('csession.php');
ini_set('memory_limit', '-1');

// Check if the user is logged in
if (!isset($_SESSION['customer_login_user'])) {
    header("location: ../index.php");
    exit;
}

// Get the logged-in user's email
$user_check = $_SESSION['customer_login_user'];

// Fetch user details from the database
$query4 = "SELECT * FROM custlogin WHERE email='$user_check'";
$ses_sq4 = mysqli_query($conn, $query4);

if (!$ses_sq4) {
    die("Error in query: " . mysqli_error($conn));
}

$row4 = mysqli_fetch_assoc($ses_sq4);
if (!$row4) {
    die("No data found for the user.");
}

// Initialize variables with fallback values
$para1 = isset($row4['cust_id']) ? $row4['cust_id'] : "N/A";
$para2 = isset($row4['cust_name']) ? $row4['cust_name'] : "N/A";
$para3 = isset($row4['password']) ? $row4['password'] : "N/A";
$para5 = isset($row4['email']) ? $row4['email'] : "N/A";
$para6 = isset($row4['phone_no']) ? $row4['phone_no'] : "N/A";
$para7 = isset($row4['state']) ? $row4['state'] : "N/A";
$para8 = isset($row4['city']) ? $row4['city'] : "N/A";
$para9 = isset($row4['address']) ? $row4['address'] : "N/A";
$para10 = isset($row4['pincode']) ? $row4['pincode'] : "N/A";
echo $para7;
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Customer Profile - Seasons Cafe</title>
  <link rel="icon" type="image/png" href="../assets/img/logo.png">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
  <style>
    /* General Body Styling */
    body {
      margin: 0;
      font-family: Arial, sans-serif;
      background: url('../assets/img/g.jpg') no-repeat center center fixed;
      color: #333;
    }

    /* Navbar Styling */
    nav {
      background-color: #333;
      color: white;
      display: flex;
      justify-content: space-between;
      align-items: center;
      padding: 15px 30px;
      position: sticky;
      top: 0;
      z-index: 1000;
      box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    }

    nav .logo {
      font-size: 24px;
      font-weight: bold;
      color: #ffcc00;
    }

    nav .logo a {
      text-decoration: none;
      color: inherit;
    }

    nav ul {
      display: flex;
      list-style: none;
      margin: 0;
      padding: 0;
    }

    nav ul li {
      margin-right: 25px;
    }

    nav ul li a {
      color: white;
      text-decoration: none;
      font-size: 18px;
    }

    nav ul li a:hover {
      color: #ffcc00;
    }

    nav .menu-toggle {
      display: none;
      cursor: pointer;
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
    }

    .profile-details .row:last-child {
      border-bottom: none;
    }

    .profile-details .row h5 {
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
      nav ul {
        display: none;
        width: 100%;
        flex-direction: column;
        align-items: center;
      }

      nav ul li {
        margin-bottom: 15px;
      }

      nav .menu-toggle {
        display: block;
        color: white;
        font-size: 24px;
        cursor: pointer;
      }

      nav ul.show {
        display: flex;
      }

      .profile-section {
        padding: 10px;
        font-size: 20px;
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
  <?php include('cnav.php'); ?>

  <!-- Profile Section -->
  <section class="profile-section">
    <div class="profile-header">
      <h3>Welcome to Agrowave</h3>
    </div>
    <div class="profile-card">
      <img src="../assets/img/agri.png" alt="Profile Picture">
      <h4>Hello, <?php echo htmlspecialchars($para2); ?>!</h4>
    </div>
    <div class="profile-details">
      <div class="row">
        <h5>Customer ID:</h5>
        <div><?php echo htmlspecialchars($para1); ?></div>
      </div>
      <div class="row">
        <h5>Name:</h5>
        <div><?php echo htmlspecialchars($para2); ?></div>
      </div>
      <div class="row">
        <h5>Email:</h5>
        <div><?php echo htmlspecialchars($para5); ?></div>
      </div>
      <div class="row">
        <h5>Phone:</h5>
        <div><?php echo htmlspecialchars($para6); ?></div>
      </div>
      <div class="row">
        <h5>District:</h5>
        <div><?php echo htmlspecialchars($para7); ?></div>
      </div>
      <div class="row">
        <h5>Upazila:</h5>
        <div><?php echo htmlspecialchars($para8); ?></div>
      </div>
      <div class="row">
        <h5>Address:</h5>
        <div><?php echo htmlspecialchars($para9); ?></div>
      </div>

    </div>
  </section>

  <!-- Footer -->
  
  <script>
    function toggleMenu() {
      const menu = document.querySelector('nav ul');
      menu.classList.toggle('show');
    }
  </script>
</body>
</html>
