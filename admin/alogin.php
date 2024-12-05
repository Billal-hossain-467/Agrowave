<?php
include('aloginScript.php'); // Includes Admin Login Script
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="icon" type="image/png" href="../assets/img/logo.png" />
  <title>Agriculture Portal - Admin Login</title>

  <!-- Custom CSS -->
  <style>
    /* Global Styles */
    body {
      font-family: 'Lato', sans-serif;
      margin: 0;
      padding: 0;
      color: #333;
      background-image: url('../assets/img/R.jpeg');      background-size: cover;
      background-position: center;
      background-attachment: fixed;
      height: 100vh;
      overflow: hidden;
      position: relative;
    }

    /* Blur effect for background */
    body::before {
      content: "";
      position: absolute;
      top: 0;
      left: 0;
      right: 0;
      bottom: 0;
      background: inherit;
      filter: blur(5px); /* Apply blur effect */
      z-index: -1;
    }

    header {
      background-color: rgba(0, 0, 0, 0); /* Fully transparent header */
      padding: 20px 50px;
      color: white;
      display: flex;
      align-items: center;
      justify-content: space-between;
    }

    header img {
      height: 50px;
    }

    nav ul {
      list-style: none;
      margin: 0;
      padding: 0;
      display: flex;
      gap: 15px;
    }

    nav ul li {
      display: inline-block;
    }

    nav ul li a {
      text-decoration: none;
      color: white;
      font-weight: bold;
      padding: 5px 10px;
    }

    nav ul li a:hover {
      background-color: rgba(0, 0, 0, 0.2);
      border-radius: 5px;
    }

    .container {
      max-width: 700px; /* Increased form size */
      margin: 100px auto;
      background: rgba(255, 255, 255, .2); /* Semi-transparent background */
      padding: 30px;
      border-radius: 12px;
      box-shadow: none ;
      text-align: center;
    }

    h1 {
      font-size: 2rem;
      color: #ffffff;
      margin-bottom: 25px;
      font-weight: 600;
    }

    label {
      font-weight: 500;
      margin-bottom: 8px;
      display: block;
      text-align: left;
      color: #ffffff;
      font-size: 20px;
    }

    input {
      width: 100%;
      padding: 12px;
      margin-bottom: 20px;
      border: 1px solid #ddd;
      border-radius: 8px;
      font-size: 18px;
      background-color: rgba(255, 255, 255, 0.3); /* Transparent input fields */
      color: white;
      transition: border-color 0.3s ease, box-shadow 0.3s ease;
    }

    input:focus {
      border-color: #1a5c3d;
      box-shadow: 0 0 8px rgba(26, 92, 61, 0.2);
      outline: none;
    }

    button {
      background-color: rgba(26, 92, 61, 0.8); /* Deep green with transparency */
      color: white;
      border: none;
      padding: 12px 20px;
      font-size: 16px;
      font-weight: 600;
      border-radius: 8px;
      cursor: pointer;
      width: 100%;
      transition: background-color 0.3s ease, transform 0.3s ease;
    }

    button:hover {
      background-color: rgba(26, 92, 61, 1); /* Solid color on hover */
      transform: translateY(-2px);
    }

    footer {
      text-align: center;
      background: rgba(0, 0, 0, 0); /* Fully transparent footer */
      color: white;
      padding: 15px 0;
      position: fixed;
      bottom: 0;
      width: 100%;
    }

    footer p {
      margin: 0;
    }

    .error {
      color: #e74c3c;
      font-size: 14px;
      margin-bottom: 20px;
      text-align: center;
      font-weight: 500;
    }

    /* Responsive Design */
    @media (max-width: 600px) {
      .container {
        padding: 20px;
        margin: 40px auto;
      }

      header {
        flex-direction: column;
        align-items: flex-start;
      }
    }
  </style>
</head>
<body>
<?php include('a_log_nav.php'); ?>

<div class="container">
  <h1>Admin Login</h1>
  <form method="POST" action="">
    <?php if (!empty($error)): ?>
      <div class="error"><?php echo $error; ?></div>
    <?php endif; ?>

    <label for="admin_name">Admin ID *</label>
    <input type="text" name="admin_name" placeholder="Enter Admin ID" required>

    <label for="admin_password">Password *</label>
    <input type="password" name="admin_password" id="password" placeholder="Enter Password" required>

    <button type="submit" name="adminlogin">Login</button>
  </form>
</div>


</body>
</html>
