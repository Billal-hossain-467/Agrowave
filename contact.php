<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>AgroWave - Contact</title>
  <link rel="icon" type="image/png" href="assets/img/logo.png">
  <!-- Font Awesome for icons -->
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">

  <style>
    /* General Styles */
    body {
      margin: 0;
      font-family: 'Arial', sans-serif;
      background: url('assets/img/con.jpeg') no-repeat center center fixed;
      background-size: cover;
      color: #333;
    }

    a {
      text-decoration: none;
      color: inherit;
    }

    a:hover {
      color: #007bff;
    }

    /* Navbar */
    nav {
      background-color: rgba(0, 128, 128, 0.9);
      display: flex;
      justify-content: space-between;
      align-items: center;
      padding: 15px 50px;
      position: sticky;
      top: 0;
      z-index: 1000;
      color: white;
      box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
    }

    nav .logo {
      font-size: 24px;
      font-weight: bold;
      color: white;
      text-transform: uppercase;
    }

    nav ul {
      list-style: none;
      display: flex;
      margin: 0;
      padding: 0;
    }

    nav ul li {
      margin-left: 20px;
      position: relative;
    }

    nav ul li a {
      font-size: 16px;
      color: white;
      padding: 5px 10px;
      text-transform: capitalize;
      transition: 0.3s;
      display: flex;
      align-items: center;
    }

    nav ul li a i {
      margin-right: 8px;
    }

    nav ul li a:hover {
      border-bottom: 2px solid white;
    }

    .dropdown-content {
      display: none;
      position: absolute;
      background-color: white;
      min-width: 150px;
      box-shadow: 0px 8px 16px rgba(0, 0, 0, 0.1);
      border-radius: 5px;
      overflow: hidden;
      top: 30px;
      z-index: 1000;
    }

    .dropdown-content a {
      color: #333;
      padding: 10px 15px;
      text-decoration: none;
      display: block;
      font-size: 14px;
    }

    .dropdown-content a:hover {
      background-color: #f4f4f4;
    }

    nav ul li:hover .dropdown-content {
      display: block;
    }

    /* Contact Section */
    .contact-section {
      background: rgba(0, 0, 0, 0.6);
      color: white;
      display: flex;
      justify-content: center;
      align-items: center;
      min-height: calc(100vh - 80px);
      padding: 20px;
    }

    .form-container {
      background: rgba(255, 255, 255, 0.3);
      border-radius: 15px;
      padding: 2rem;
      width: 100%;
      max-width: 600px;
      box-shadow: 0 4px 10px rgba(0, 0, 0, 0.3);
      text-align: center;
    }

    .form-container h2 {
      color: white;
      font-size: 2rem;
      margin-bottom: 20px;
    }

    input, textarea {
      width: 100%;
      padding: 10px;
      margin-bottom: 15px;
      border: 1px solid #ccc;
      border-radius: 5px;
      font-size: 1rem;
    }

    input:focus, textarea:focus {
      outline: none;
      border-color: #28a745;
      box-shadow: 0 0 5px rgba(40, 167, 69, 0.5);
    }

    button {
      background: #28a745;
      color: white;
      border: none;
      padding: 10px 20px;
      border-radius: 5px;
      font-size: 1rem;
      cursor: pointer;
      transition: 0.3s ease;
    }

    button:hover {
      background: #218838;
    }

    /* Footer */
    footer {
      background: #333;
      color: white;
      text-align: center;
      padding: 20px;
    }

    footer p {
      margin: 0;
      font-size: 14px;
    }
  </style>
</head>

<body>
<?php include('navbar.php'); ?>
  <!-- Contact Form Section -->
  <div class="contact-section">
    <form action="contact-script.php" method="post" class="form-container">
      <h2>Contact Us</h2>
      <input type="text" id="user_name" name="user_name" placeholder="Full Name" required>
      <input type="text" id="user_mobile" name="user_mobile" placeholder="Mobile Number" required>
      <input type="email" id="user_email" name="user_email" placeholder="Email ID" required>
      <input type="text" id="user_address" name="user_address" placeholder="Address (City / Pincode)" required>
      <textarea id="user_message" name="user_message" rows="5" placeholder="Your Message" required></textarea>
      <button type="submit" name="submit" >Send Message</button>
    </form>
  </div>

  <!-- Footer -->
  
</body>
</html>
