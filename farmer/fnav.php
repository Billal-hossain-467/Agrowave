<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>AgroWave Navbar</title>
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
  <style>
    /* General Navbar Styling */
    nav {
      background: linear-gradient(135deg, #004d4d, #002626);
      display: flex;
      justify-content: space-between;
      align-items: center;
      padding: 10px 20px;
      position: sticky;
      top: 0;
      z-index: 1000;
      box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
    }

    nav .navbar-brand {
      display: flex;
      align-items: center;
      text-decoration: none;
      color: white;
      font-size: 26px;
      font-weight: bold;
      letter-spacing: 1px;
    }

    nav .navbar-brand img {
      height: 40px;
      margin-right: 10px;
    }

    nav ul {
      list-style: none;
      display: flex;
      margin: 0;
      padding: 0;
    }

    nav ul li {
      margin: 0 15px;
      position: relative;
    }

    nav ul li a {
      text-decoration: none;
      color: white;
      font-size: 16px;
      font-weight: 500;
      padding: 5px 15px;
      transition: all 0.3s ease;
      display: flex;
      align-items: center;
      border-radius: 30px;
    }

    nav ul li a i {
      margin-right: 8px;
    }

    nav ul li a:hover {
      background-color: rgba(0, 153, 153, 0.8);
      color: #ffc107;
      box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
    }

    /* Dropdown Menu Styling */
    .dropdown-content {
      display: none;
      position: absolute;
      top: 100%;
      left: 0;
      background: #003333;
      border-radius: 8px;
      box-shadow: 0 4px 10px rgba(0, 0, 0, 0.3);
      z-index: 1000;
      padding: 0;
      min-width: 200px;
      overflow: hidden;
    }

    .dropdown-content a {
      display: block;
      text-decoration: none;
      color: white;
      padding: 10px 20px;
      font-size: 14px;
      font-weight: 500;
      transition: all 0.3s ease;
    }

    .dropdown-content a:hover {
      background-color: rgba(0, 153, 153, 0.8);
      color: #ffc107;
    }

    nav ul li:hover .dropdown-content {
      display: block;
    }

    /* Responsive Menu */
    @media (max-width: 768px) {
      nav {
        flex-direction: column;
        align-items: flex-start;
      }

      nav ul {
        flex-direction: column;
        width: 100%;
      }

      nav ul li {
        margin: 10px 0;
      }

      .dropdown-content {
        position: static;
        box-shadow: none;
      }
    }
  </style>
</head>

<body>
  <nav>
    <a href="../index.php" class="navbar-brand">
      AgroWave
    </a>
    <ul>
      <!-- Prediction Dropdown -->
      <li>


        <a class="fas fa-magic" href="fcrop_prediction.php">Crop Mapping</a>


      </li>
      <li>
        <a class="fas fa-magic" href="frainfall_prediction.php">Rainfall Data</a>

      </li>

      <!-- Recommendation Dropdown -->
      <li>
        <a href="#"><i class="fas fa-gavel"></i> Recommendation</a>
        <div class="dropdown-content">
          <a href="fcrop_recommendation.php">Crop Recommendation</a>
          <a href="ffertilizer_recommendation.php">Fertilizer Recommendation</a>
        </div>
      </li>

      <!-- Trade Dropdown -->
      <li>
        <a href="#"><i class="fas fa-shopping-cart"></i> Trade</a>
        <div class="dropdown-content">
          <a href="ftradecrops.php">Trade Crops</a>
          <a href="fstock_crop.php">Crop Stocks</a>

        </div>
      </li>
      <li>
        <a class="fas fa-magic" href="show_rent.php"> Rent Machinary</a>
      </li>
      <!-- Tools Dropdown -->
      <li>
        <a href="#"><i class="fas fa-tools"></i> Tools</a>
        <div class="dropdown-content">
          <a href="fweather.php"><i class="fas fa-cloud"></i> Weather Forecast</a>
          <a href="fnewsfeed.php"><i class="fas fa-newspaper"></i> News Feed</a>
        </div>
      </li>

      <!-- Profile -->
      <li>
        <a href="fprofile.php"><i class="fas fa-user"></i> <?php echo $para2; ?></a>
      </li>

      <!-- Logout -->
      <li>
        <a href="flogout.php" class="text-danger"><i class="fas fa-power-off"></i> Logout</a>
      </li>
    </ul>
  </nav>
</body>

</html>