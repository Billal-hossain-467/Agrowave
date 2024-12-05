<?php
include('fregisterScript.php'); // Includes Login Script
require_once("../sql.php");
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="icon" type="image/png" href="../assets/img/logo.png" />
  <title>Farmer Registration</title>

  <!-- Custom CSS -->
  <style>
    body {
  font-family: Arial, sans-serif;
  margin: 0;
  padding: 0;
  background: url('../assets/img/e.jpg') no-repeat center center fixed;
  background-size: cover;
}

body::before {
  content: "";
  position: fixed;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  background: rgba(0, 0, 0, 0.4);
  backdrop-filter: blur(5px); /* Adds blur effect */
  z-index: -1; /* Ensures it is behind the content */
}

header {
  background-color: rgba(0, 128, 128, 0.9);
  padding: 20px 50px;
  color: white;
  display: flex;
  align-items: center;
  justify-content: space-between;
}

header .logo img {
  height: 50px;
}

.container {
  max-width: 950px;
  margin: 80px auto;
  background: rgba(255, 255, 255, 0.6); /* Transparent white background */
  padding: 40px;
  border-radius: 10px;
  box-shadow: 0 6px 20px rgba(0, 0, 0, 0.2); /* Adds shadow for depth */
}

h1 {
  text-align: center;
  color: #007b5e;
  margin-bottom: 30px;
  font-size: 38px;
  font-weight: bold;
}

label {
  font-weight: bold;
  margin-bottom: 5px;
  display: block;
  color: #333;
  font-size: 20px;
}

input, select {
  width: 100%;
  padding: 12px;
  margin-bottom: 20px;
  border: 1px solid #ccc;
  border-radius: 5px;
  font-size: 18px;
}

button {
  background-color: #007b5e;
  color: white;
  border: none;
  padding: 15px;
  font-size: 18px;
  border-radius: 5px;
  cursor: pointer;
  display: block;
  margin: 30px auto 0;
  width: 50%;
  text-align: center;
}

button:hover {
  background-color: #005840;
}

footer {
  text-align: center;
  background: rgba(0, 128, 128, 0.9);
  color: white;
  padding: 10px 0;
  position: fixed;
  bottom: 0;
  width: 100%;
}

  </style>
</head>
<body>



<div class="container">
  <h1>Farmer Registration</h1>
  <form name="insert" action="" method="post">
    <div id="success"> <?php echo $error; ?> </div>

    <label for="name">Farmer Name *</label>
    <input type="text" name="name" required>

    <label for="email">Email Address *</label>
    <input type="email" name="email" required>

    <label for="mobile">Mobile No *</label>
    <input type="number" name="mobile" pattern="[6789][0-9]{9}" required>

    <label for="gender">Gender</label>
    <select name="gender">
      <option value="Male">Male</option>
      <option value="Female">Female</option>
    </select>

    <label for="dob">DOB</label>
    <input type="date" name="dob">

    <label for="district">District *</label>
    <input type="text" name="district" required>

    <label for="city">Upazila *</label>
    <input type="text" name="city" required>

    <label for="password">Password *</label>
    <input type="password" name="password" id="password"  required>

    <label for="confirmpassword">Confirm Password *</label>
    <input type="password" name="confirmpassword" id="confirmpassword"  required>

    <button name="farmerregister">Submit</button>
  </form>
</div>


<script>
function getdistrict(val) {
  const xhr = new XMLHttpRequest();
  xhr.open("POST", "fget_district.php", true);
  xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
  xhr.onload = function () {
    if (this.status === 200) {
      document.getElementById("district-list").innerHTML = this.responseText;
    }
  };
  xhr.send("state_id=" + val);
}
</script>

</body>
</html>