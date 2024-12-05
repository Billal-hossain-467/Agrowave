<?php
include('fsession.php'); // Include session management and database connection

// Check if the user is logged in
if (!isset($_SESSION['farmer_login_user'])) {
  header("location: ../index.php");  // Redirect to login page if not logged in
  exit();
}

// Fetch farmer's ID from session
$query4 = "SELECT farmer_id, farmer_name FROM farmerlogin WHERE email='$user_check'";
$ses_sq4 = mysqli_query($conn, $query4);
$row4 = mysqli_fetch_assoc($ses_sq4);
$farmer_fkid = $row4['farmer_id']; // Farmer's ID
$para2 = $row4['farmer_name'];

// Fetch crops for the logged-in farmer from the farmer_crops_trade table
$query = "SELECT * FROM farmer_crops_trade WHERE farmer_fkid = '$farmer_fkid'";
$result = mysqli_query($conn, $query);
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Your Crop Stock</title>
  <style>
    /* Global Styles */
    body {
      font-family: 'Arial', sans-serif;
      margin: 0;
      padding: 0;
      color: #fff;
      background: url('../assets/img/trade.jpg') no-repeat center center fixed;
      background-size: cover;
      position: relative;
      min-height: 100vh;
    }

    /* Overlay for Background Blur Effect */
    .overlay {
      position: absolute;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      background: rgba(0, 0, 0, 0.5); /* Semi-transparent overlay */
    }

    /* Header and Footer */
    header, footer {
      text-align: center;
      padding: 20px 0;
      background: rgba(0, 0, 0, 0.6); /* Darker background for header/footer */
    }

    header h1, footer p {
      margin: 0;
      font-size: 2.2em;
      color: #fff;
      font-weight: 600;
    }

    /* Container */
    .container {
      width: 100%;
      max-width: 960px;
      margin: 50px auto;
      padding: 30px 20px;
      background: rgba(255, 255, 255, 0.9);
      border-radius: 15px;
      box-shadow: 0 10px 25px rgba(0, 0, 0, 0.15);
      backdrop-filter: blur(10px);
      z-index: 1;
    }

    h2 {
      text-align: center;
      color: #333;
      font-size: 30px;
      margin-bottom: 20px;
      font-weight: 600;
    }

    /* Table Styles */
    table {
      width: 100%;
      border-collapse: collapse;
      margin-top: 20px;
    }

    table th,
    table td {
      padding: 12px;
      text-align: center;
      border: 1px solid #ddd;
      color: black;
    }

    table th {
      background-color: #8A2BE2;
      color: black;
    }

    table tr:nth-child(even) {
      background-color: #f9f9f9;
    }

    table tr:hover {
      background-color: #f1f1f1;
    }

    /* Responsive Design */
    @media (max-width: 768px) {
      header h1, footer p {
        font-size: 1.5em;
      }

      .container {
        padding: 20px;
      }

      .form-card {
        padding: 20px;
      }
    }

    /* Keyframes for Gradient Animation */
    @keyframes gradientAnimation {
      0% {
        background-position: 0% 50%;
      }

      50% {
        background-position: 100% 50%;
      }

      100% {
        background-position: 0% 50%;
      }
    }
  </style>
</head>

<body>

  <?php include('fnav.php'); ?>

  <!-- Overlay for Background Blur Effect -->
  <div class="overlay"></div>

  <div class="container">
    <h2>Your Crop Stock</h2>

    <!-- Table to display crops -->
    <table>
      <thead>
        <tr>
          <th>Crop Name</th>
          <th>Quantity (in KG)</th>
          <th>Cost per KG</th>
        </tr>
      </thead>
      <tbody>
        <?php
        // Check if the query returned any results
        if (mysqli_num_rows($result) > 0) {
          // Loop through the results and display them in the table
          while ($row = mysqli_fetch_assoc($result)) {
            echo "<tr>
                            <td>" . htmlspecialchars($row['Trade_crop']) . "</td>
                            <td>" . htmlspecialchars($row['Crop_quantity']) . "</td>
                            <td>" . htmlspecialchars($row['costperkg']) . "</td>
                          </tr>";
          }
        } else {
          // If no crops are found, display a message
          echo "<tr><td colspan='3'>You have no crops in stock.</td></tr>";
        }
        ?>
      </tbody>
    </table>
  </div>

</body>

</html>
