<?php
include('fsession.php');
ini_set('memory_limit', '-1');

if (!isset($_SESSION['farmer_login_user'])) {
    header("location: ../index.php");
}

$query4 = "SELECT * FROM farmerlogin WHERE email='$user_check'";
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
    <title>Rainfall Prediction</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
        /* General Styling */
        body {
            font-family: Arial, sans-serif;
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
            backdrop-filter: blur(8px); /* Subtle blur */
            z-index: -1;
        }

        .container {
            max-width: 800px;
            margin: 50px auto;
            background: rgba(255, 255, 255, 0.95);
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

        .result-container {
            margin-top: 20px;
            padding: 20px;
            background: #f0f4ff;
            border-left: 6px solid #2575fc;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            text-align: center;
        }

        .result-container h4 {
            color: #2575fc;
            font-weight: bold;
            font-size: 1.2rem;
        }

        .result-container .error {
            color: #d9534f;
        }
    </style>
</head>
<body>
    <?php include('fnav.php'); ?>

    <div class="container">
        <h2><i class="fas fa-cloud-rain"></i> Rainfall Data</h2>
        <form method="POST" action="">
            <label for="region">Select Region</label>
            <select id="region" name="region" required>
                <option value="">-- Select Region --</option>
                <?php
                $regions_query = "SELECT DISTINCT region FROM rainfall_data";
                $regions_result = mysqli_query($conn, $regions_query);
                while ($row = mysqli_fetch_assoc($regions_result)) {
                    $selected = (isset($_POST['region']) && $_POST['region'] == $row['region']) ? "selected" : "";
                    echo "<option value='" . htmlspecialchars($row['region']) . "' $selected>" . htmlspecialchars($row['region']) . "</option>";
                }
                ?>
            </select>

            <label for="month">Select Month</label>
            <select id="month" name="month" required>
                <option value="">-- Select Month --</option>
                <?php
                for ($i = 1; $i <= 12; $i++) {
                    $selected = (isset($_POST['month']) && $_POST['month'] == $i) ? "selected" : "";
                    echo "<option value='$i' $selected>" . date("F", mktime(0, 0, 0, $i, 10)) . "</option>";
                }
                ?>
            </select>

            <button type="submit" name="Rainfall_Predict"><i class="fas fa-search"></i> Predict Rainfall</button>
        </form>
    </div>

    <div class="container result-container">
        <?php
        if (isset($_POST['Rainfall_Predict'])) {
            $region = trim($_POST['region']);
            $month = trim($_POST['month']);

            $rainfall_query = "SELECT month, rainfall_quantity FROM rainfall_data WHERE region = ? ORDER BY month";
            $stmt = $conn->prepare($rainfall_query);
            $stmt->bind_param("s", $region);
            $stmt->execute();
            $result = $stmt->get_result();

            $months = [];
            $rainfall_data = [];
            $selected_month_rainfall = null;

            while ($row = $result->fetch_assoc()) {
                $months[] = date("F", mktime(0, 0, 0, $row['month'], 10));
                $rainfall_data[] = $row['rainfall_quantity'];
                if ($row['month'] == $month) {
                    $selected_month_rainfall = $row['rainfall_quantity'];
                }
            }
            $stmt->close();

            if ($selected_month_rainfall !== null) {
                echo "<h4>Predicted Rainfall for <strong>$region</strong> in <strong>" . date("F", mktime(0, 0, 0, $month, 10)) . "</strong> is: <strong>$selected_month_rainfall mm</strong></h4>";
            } else {
                echo "<h4 class='error'>No prediction available for the selected region and month.</h4>";
            }
        }
        ?>
        <canvas id="rainfallChart"></canvas>
    </div>

    <script>
        <?php if (isset($months) && isset($rainfall_data)): ?>
            var ctx = document.getElementById('rainfallChart').getContext('2d');
            var rainfallChart = new Chart(ctx, {
                type: 'line',
                data: {
                    labels: <?php echo json_encode($months); ?>,
                    datasets: [{
                        label: 'Rainfall (mm)',
                        data: <?php echo json_encode($rainfall_data); ?>,
                        borderColor: '#2575fc',
                        backgroundColor: 'rgba(37, 117, 252, 0.2)',
                        fill: true,
                        tension: 0.4
                    }]
                },
                options: {
                    responsive: true,
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });
        <?php endif; ?>
    </script>
</body>
</html>
