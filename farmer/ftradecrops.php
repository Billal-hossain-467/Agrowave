<?php
include('fsession.php');

ini_set('memory_limit', '-1');

if (!isset($_SESSION['farmer_login_user'])) {
    header("location: ../index.php");  // Redirecting To Home Page
}
$query4 = "SELECT * from farmerlogin where email='$user_check'";
$ses_sq4 = mysqli_query($conn, $query4);
$row4 = mysqli_fetch_assoc($ses_sq4);
$para1 = $row4['farmer_id'];
$para2 = $row4['farmer_name'];
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Crop Stock</title>
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
            margin: 0 auto;
            padding: 40px 20px;
            position: relative;
            z-index: 1;
        }

        /* Form Card */
        .form-card {
            background: rgba(255, 255, 255, 0.9);
            border-radius: 15px;
            padding: 30px;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.15);
            backdrop-filter: blur(10px); /* Apply blur effect */
            transition: all 0.3s ease;
        }

        .form-card:hover {
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.2);
        }

        .form-card h2 {
            font-size: 28px;
            color: #333;
            margin-bottom: 20px;
            font-weight: 600;
            text-align: center;
        }

        /* Form Group */
        .form-group {
            margin-bottom: 20px;
        }

        .form-group label {
            font-size: 18px;
            font-weight: bold;
            color: #333;
            display: block;
            margin-bottom: 8px;
        }

        .form-group input,
        .form-group select {
            width: 100%;
            padding: 12px;
            font-size: 16px;
            border: 2px solid #ddd;
            border-radius: 10px;
            outline: none;
            background-color: #f9f9f9;
            transition: all 0.3s ease;
        }

        .form-group input:focus,
        .form-group select:focus {
            border-color: #8A2BE2;
            background-color: #fff;
        }

        /* Submit Button */
        .form-group button {
            width: 100%;
            padding: 15px;
            background-color: #8A2BE2;
            color: white;
            border: none;
            font-size: 18px;
            font-weight: bold;
            border-radius: 10px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .form-group button:hover {
            background-color: #6A5ACD;
        }

        /* Alerts */
        .alert {
            padding: 15px;
            margin: 20px 0;
            border-radius: 10px;
            font-size: 16px;
            text-align: center;
        }

        .alert-info {
            background-color: rgba(60, 179, 113, 0.9);
            color: white;
        }

        .alert-success {
            background-color: rgba(50, 205, 50, 0.9);
            color: white;
        }

        /* Table Styles */
        table {
            width: 100%;
            margin-top: 30px;
            border-collapse: collapse;
        }

        table th,
        table td {
            padding: 15px;
            text-align: center;
            border: 1px solid #ddd;
            font-size: 18px;
        }

        table th {
            background-color: #6A5ACD;
            color: white;
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
        <div class="form-card">
            <h2>Update Crop Stock</h2>

            <!-- Alert Popup -->
            <div class="alert alert-info" id="popup" style="display:none;">
                <strong>Current Market Avg Price for <span id="crop"></span> is: <span id="price"></span></strong>
            </div>

            <!-- Crop Details Form -->
            <form id="sellcrops" action="ftradecropsScript.php" method="POST">

                <div class="form-group">
                    <label for="crops">Crop Name</label>
                    <input type="text" name="crops" id="crops" placeholder="Enter Crop Name" required>
                </div>

                <div class="form-group">
                    <label for="trade_farmer_cropquantity">Quantity (in KG)</label>
                    <input type="number" name="trade_farmer_cropquantity" id="trade_farmer_cropquantity" placeholder="Enter Quantity" required>
                </div>

                <div class="form-group">
                    <label for="trade_farmer_cost">Cost per KG </label>
                    <input type="number" name="trade_farmer_cost" id="trade_farmer_cost" placeholder="Enter Cost per KG" required>
                </div>

                <div class="form-group">
                    <button type="submit" name="Crop_submit" value="Crop_submit">Submit Crop Details</button>
                </div>

            </form>
        </div>

        <!-- Confirmation -->
        <div class="alert alert-success" id="details" style="display:none;">
            <strong>Crop Details Added Successfully!</strong>
        </div>
    </div>

    <script>
        document.getElementById("crops").addEventListener("input", function () {
            var crops = document.getElementById('crops').value;
            document.getElementById("crop").innerText = crops;

            var xhr = new XMLHttpRequest();
            xhr.open('POST', 'fcheck_price.php', true);
            xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
            xhr.onload = function () {
                if (xhr.status == 200) {
                    document.getElementById('price').innerText = xhr.responseText;
                    document.getElementById("popup").style.display = 'block';
                }
            };
            xhr.send('crops=' + crops);
        });
    </script>

</body>

</html>
