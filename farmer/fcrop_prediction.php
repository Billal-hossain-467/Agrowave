<?php
include('fsession.php');
ini_set('memory_limit', '-1');

// Check if user is logged in
if (!isset($_SESSION['farmer_login_user'])) {
    header("location: ../index.php"); // Redirecting to login page
}

// Get farmer details
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
    <title>Crop Prediction</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
    <style>
        /* General Styling */
        body {
            font-family: 'Arial', sans-serif;
            margin: 0;
            padding: 0;
            background: url('../assets/img/h.jpg') no-repeat center center fixed;
            background-size: cover;
            color: #fff;
            overflow-x: hidden;
        }

        body::before {
            content: '';
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.5); /* Dark overlay */
            backdrop-filter: blur(2px); /* Apply blur to background */
            z-index: -1;
        }

        .container {
            max-width: 800px;
            margin: 50px auto;
            background: rgba(255, 255, 255, 0.9); /* Semi-transparent white */
            color: #333;
            border-radius: 20px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.3);
            overflow: hidden;
            padding: 30px;
            position: relative;
            animation: fadeIn 1s ease-out;
        }

        .container::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 8px;
            background: linear-gradient(to right, #6a11cb, #2575fc);
        }

        @keyframes fadeIn {
            0% {
                opacity: 0;
                transform: translateY(20px);
            }
            100% {
                opacity: 1;
                transform: translateY(0);
            }
        }

        h2 {
            text-align: center;
            color: #2575fc;
            font-weight: bold;
            margin-bottom: 20px;
            font-size: 2rem;
        }

        form {
            margin: 0 auto;
            padding: 20px;
        }

        form label {
            font-weight: bold;
            margin-bottom: 5px;
            display: block;
            font-size: 1.1rem;
            color: #333;
        }

        form select,
        form button {
            width: 100%;
            padding: 12px 15px;
            margin-bottom: 15px;
            border: none;
            border-radius: 8px;
            font-size: 16px;
            transition: all 0.3s ease-in-out;
        }

        form select {
            background: #f5f5f5;
            box-shadow: inset 0 3px 6px rgba(0, 0, 0, 0.1);
        }

        form button {
            background: linear-gradient(to right, #6a11cb, #2575fc);
            color: #fff;
            font-weight: bold;
            cursor: pointer;
            border: none;
            transition: transform 0.3s ease-in-out, box-shadow 0.3s ease-in-out;
        }

        form button:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.2);
        }

        .result {
            margin-top: 20px;
            padding: 20px;
            background: #f0f4ff;
            border-left: 6px solid #2575fc;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }

        .result h4 {
            color: #2575fc;
            font-weight: bold;
            font-size: 1.2rem;
        }

        footer {
            text-align: center;
            padding: 20px;
            background: #222;
            color: #aaa;
            margin-top: 30px;
            font-size: 14px;
        }

        footer p {
            margin: 0;
        }
    </style>
</head>

<body>
    <!-- Navigation Bar -->
    <?php include('fnav.php'); ?>

    <!-- Main Content -->
    <div class="container">
        <h2><i class="fas fa-seedling"></i> Crop Mapping</h2>
<form method="POST" action="">
    <label for="district">District Name:</label>
    <select id="district" name="district" onchange="loadUpazillas(this.value)" required>
        <option value="">Select District</option>
        <?php
        $query = "SELECT DISTINCT District_name FROM crop_recommendation";
        $result = $conn->query($query);
        while ($row = $result->fetch_assoc()) {
            $selected = isset($_POST['district']) && $_POST['district'] == $row['District_name'] ? 'selected' : '';
            echo "<option value='{$row['District_name']}' $selected>{$row['District_name']}</option>";
        }
        ?>
    </select>

    <label for="upazilla">Upazilla Name:</label>
    <select id="upazilla" name="upazilla" required>
        <option value="">Select Upazilla</option>
        <?php
        // Populate upazillas dynamically based on selected district
        if (isset($_POST['district'])) {
            $district = $_POST['district'];
            $query = "SELECT DISTINCT Upazilla_name FROM crop_recommendation WHERE District_name = '$district'";
            $result = $conn->query($query);
            while ($row = $result->fetch_assoc()) {
                $selected = isset($_POST['upazilla']) && $_POST['upazilla'] == $row['Upazilla_name'] ? 'selected' : '';
                echo "<option value='{$row['Upazilla_name']}' $selected>{$row['Upazilla_name']}</option>";
            }
        }
        ?>
    </select>

    <label for="season">Season:</label>
    <select id="season" name="season">
        <option value="">Select Season (optional)</option>
        <option value="Kharif" <?php echo isset($_POST['season']) && $_POST['season'] == 'Kharif' ? 'selected' : ''; ?>>Kharif</option>
        <option value="Rabi" <?php echo isset($_POST['season']) && $_POST['season'] == 'Rabi' ? 'selected' : ''; ?>>Rabi</option>
        <option value="Whole Year" <?php echo isset($_POST['season']) && $_POST['season'] == 'Whole Year' ? 'selected' : ''; ?>>Whole Year</option>
        <option value="Summer" <?php echo isset($_POST['season']) && $_POST['season'] == 'Summer' ? 'selected' : ''; ?>>Summer</option>
        <option value="Winter" <?php echo isset($_POST['season']) && $_POST['season'] == 'Winter' ? 'selected' : ''; ?>>Winter</option>
    </select>

    <button type="submit" name="Crop_Predict"><i class="fas fa-search"></i> Predict</button>
</form>


        <div class="result">
            <h4>
                <?php
                if (isset($_POST['Crop_Predict'])) {
                    $district = $_POST['district'];
                    $upazilla = $_POST['upazilla'];
                    $season = $_POST['season'];

                    // Build the SQL query based on user inputs
                    $query = "SELECT Predicted_Crops FROM crop_recommendation WHERE District_name = '$district' AND Upazilla_name = '$upazilla'";

                    if (!empty($season)) {
                        $query .= " AND Season = '$season'";
                    }

                    // Execute the query
                    $result = mysqli_query($conn, $query);

                    // Display the predicted crops
                    if (mysqli_num_rows($result) > 0) {
                        echo "Crops grown in $district ($upazilla) during the $season season are: <br>";
                        while ($row = mysqli_fetch_assoc($result)) {
                            echo "- " . $row['Predicted_Crops'] . "<br>";
                        }
                    } else {
                        echo "No data available for the selected criteria.";
                    }
                }
                ?>
            </h4>
        </div>
    </div>

   

    <script>
        function loadUpazillas(district) {
            const upazillaDropdown = document.getElementById('upazilla');
            upazillaDropdown.innerHTML = '<option value="">Select Upazilla</option>'; // Clear previous options

            if (district) {
                // Fetch upazillas based on the selected district
                fetch(`get_upazilla.php?district=${district}`)
                    .then(response => response.json())
                    .then(data => {
                        data.forEach(upazilla => {
                            const option = document.createElement('option');
                            option.value = upazilla;
                            option.textContent = upazilla;
                            upazillaDropdown.appendChild(option);
                        });
                    })
                    .catch(error => console.error('Error fetching Upazillas:', error));
            }
        }
    </script>
</body>

</html>
