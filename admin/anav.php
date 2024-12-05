<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Admin Navbar</title>
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
  <style>
    /* General Navbar Styling */
    nav {
      background-color: #004d4d;
      display: flex;
      justify-content: space-between;
      align-items: center;
      padding: 10px 20px;
      position: sticky;
      top: 0;
      z-index: 1000;
      box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    }

    nav .navbar-brand {
      display: flex;
      align-items: center;
      text-decoration: none;
      color: white;
      font-size: 24px;
      font-weight: bold;
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
      padding: 5px 10px;
      transition: all 0.3s ease;
      display: flex;
      align-items: center;
    }

    nav ul li a i {
      margin-right: 8px;
    }

    nav ul li a:hover {
      background-color: #006666;
      border-radius: 5px;
      color: #ffc107;
    }

    /* Dropdown Menu Styling */
    .dropdown-content {
      display: none;
      position: absolute;
      top: 100%;
      left: 0;
      background-color: #004d4d;
      border-radius: 5px;
      box-shadow: 0 4px 6px rgba(0, 0, 0, 0.2);
      z-index: 1000;
      padding: 0;
      min-width: 180px;
    }

    .dropdown-content a {
      display: block;
      text-decoration: none;
      color: white;
      padding: 10px;
      font-size: 14px;
      transition: all 0.3s ease;
    }

    .dropdown-content a:hover {
      background-color: #006666;
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
      <!-- Farmers Dropdown -->
      <li>
      <a href="afarmers.php">Farmers</a>
      </li>

      <!-- Customers Dropdown -->
      <li>
        <a href="acustomers.php">Customers</a>
      </li>

      <!-- Crop Stock Dropdown -->
      <li>
        <a href="aproducedcrop.php">Crop Stock</a>
      </li>

      <!-- Queries Dropdown -->
      <li>
        <a href="aviewmsg.php">Queries</a>
      </li>

      <!-- Profile -->
      <li>
        <a href="aprofile.php"><i class="fas fa-user"></i> <?php echo $para2; ?></a>
      </li>

      <!-- Logout -->
      <li>
        <a href="alogout.php" class="text-danger"><i class="fas fa-power-off"></i> Logout</a>
      </li>
    </ul>
  </nav>
</body>
</html>
