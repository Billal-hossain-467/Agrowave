<?php
include('floginScript.php'); // Includes Farmer Login Script
require_once("../sql.php");
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="icon" type="image/png" href="../assets/img/logo.png" />
  <title>Agriculture Portal - Farmer Login</title>

  <!-- Custom CSS -->
  <style>
    /* Global Styles */
   /* Global Styles */
body {
  font-family: 'Lato', sans-serif;
  margin: 0;
  padding: 0;
  color: #333;
  background-image: url('../assets/img/R.jpeg');
  background-size: cover;
  background-position: center;
  background-attachment: fixed;
  position: relative;
  height: 100vh;
  overflow: hidden;
}

/* Blur effect */
body::before {
  content: "";
  position: absolute;
  top: 0;
  left: 0;
  right: 0;
  bottom: 0;
  background: inherit;
  filter: blur(5px);
  z-index: -1;
}

/* Login Container */
.container {
  max-width: 600px; /* Increased width */
  margin: 80px auto; /* Increased top margin */
  background: rgba(255, 255, 255, 0.1); /* Slightly more opaque background */
  padding: 50px; /* Increased padding */
  border-radius: 15px; /* More rounded corners */
  box-shadow: 0 4px 20px rgba(0, 0, 0, 0); /* Add some shadow for emphasis */
  text-align: center;
}

/* Form Header */
h1 {
  font-size: 2.5rem; /* Bigger title */
  color: #ffffff;
  margin-bottom: 30px; /* More space between title and form */
  font-weight: 700;
}

/* Labels */
label {
  font-weight: 500;
  margin-bottom: 12px;
  display: block;
  text-align: left;
  color: #ffffff;
  font-size: 20px; /* Slightly bigger font size */
}

/* Input Fields */
input {
  width: 100%;
  padding: 15px; /* Increased padding */
  margin-bottom: 25px; /* Increased space between fields */
  border: 1px solid #ddd;
  border-radius: 8px;
  font-size: 18px; /* Bigger font size */
  box-sizing: border-box;
  background-color: rgba(255, 255, 255, .9);
  color: BLACK;
  transition: border-color 0.3s ease, box-shadow 0.3s ease;
}

input:focus {
  border-color: #1a5c3d;
  box-shadow: 0 0 8px rgba(26, 92, 61, 1);
  outline: none;
}

/* Submit Button */
button {
  background-color: rgba(26, 92, 61, 2);
  color: white;
  border: none;
  padding: 15px 25px; /* Increased padding */
  font-size: 18px; /* Bigger font size */
  font-weight: 700;
  border-radius: 8px;
  cursor: pointer;
  width: 100%;
  transition: background-color 0.3s ease, transform 0.3s ease;
}

button:hover {
  background-color: rgba(26, 92, 61, 1);
  transform: translateY(-3px);
}

/* Error Message */
.error {
  color: #e74c3c;
  font-size: 16px;
  margin-bottom: 25px;
  text-align: center;
  font-weight: 500;
}

/* Footer */
footer {
  text-align: center;
  background: rgba(0, 0, 0, 0);
  color: white;
  padding: 20px 0;
  position: fixed;
  bottom: 0;
  width: 100%;
  font-size: 14px;
}

/* Responsive Design */
@media (max-width: 768px) {
  .container {
    padding: 30px; /* Adjust padding for smaller screens */
    margin: 50px auto;
  }

  h1 {
    font-size: 2rem; /* Slightly smaller title for smaller screens */
  }

  label {
    font-size: 14px; /* Smaller label font */
  }

  input {
    font-size: 14px; /* Smaller input font */
  }

  button {
    font-size: 16px; /* Adjust button font size */
  }
}

  </style>
</head>
<body>

  <?php include('f_log_nav.php'); ?>

  <div class="container">
    <h1>Farmer Login</h1>
    <form method="POST" action="">
      <?php if (!empty($_SESSION['login_error'])): ?>
        <div class="error"><?php echo $_SESSION['login_error']; unset($_SESSION['login_error']); ?></div>
      <?php endif; ?>

      <label for="email">Email Address *</label>
      <input type="email" name="farmer_email" placeholder="Enter your email" required>

      <label for="password">Password *</label>
      <input type="password" name="farmer_password" id="password" placeholder="Enter your password" required>

      <button type="submit" name="farmerlogin">Login</button>
    </form>
  </div>

 

</body>
</html>
