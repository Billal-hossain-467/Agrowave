<?php
include('fsession.php');
ini_set('memory_limit', '-1');

if (!isset($_SESSION['farmer_login_user'])) {
    header("location: ../index.php");
}
$query4 = "SELECT * from farmerlogin where email='$user_check'";
$ses_sq4 = mysqli_query($conn, $query4);
$row4 = mysqli_fetch_assoc($ses_sq4);
$para1 = $row4['farmer_id'];
$para2 = $row4['farmer_name'];

$display_district_name = "";
$display_district = "Select F_District from farmerlogin WHERE email='$user_check'";
$display_district_result = mysqli_query($conn, $display_district);
$display_district_name = mysqli_fetch_array($display_district_result);
$District_name_farmer = $display_district_name[0];

ini_set('memory_limit', '-1');
$url = 'static/citylist.json';
$data = file_get_contents($url);
$district = json_decode($data);

$district_weather_id = 0;
foreach ($district as $district) {
    if ($district->name == trim($District_name_farmer)) {
        $district_weather_id = $district->id;
    }
}
if ($district_weather_id <= 0) {
    $district_weather_id = 1253952; // Default to Udupi
}
$city_weather_id = strval($district_weather_id);

date_default_timezone_set("Asia/Kolkata");
$apiKey = "870887df4d2b01335921fe396c69a360";
$cityId = $city_weather_id;

$googleApiUrl = "https://api.openweathermap.org/data/2.5/forecast?id=" . $cityId . "&lang=en&units=metric&APPID=" . $apiKey;
$ch = curl_init();
curl_setopt($ch, CURLOPT_HEADER, 0);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_URL, $googleApiUrl);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
curl_setopt($ch, CURLOPT_VERBOSE, 0);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
$response = curl_exec($ch);
curl_close($ch);
$data = json_decode($response);
$forecast = $data->list;

// Prepare data for the chart
$dates = [];
$highTemps = [];
$lowTemps = [];
$averageTemps = [];

foreach ($forecast as $f) {
    $date = substr($f->dt_txt, 0, 10);
    $tempMax = $f->main->temp_max;
    $tempMin = $f->main->temp_min;
    $tempAvg = ($tempMax + $tempMin) / 2;

    if (!in_array($date, $dates)) {
        $dates[] = $date;
        $highTemps[] = $tempMax;
        $lowTemps[] = $tempMin;
        $averageTemps[] = $tempAvg;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Weather Forecast with Graph</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
        body {
            margin: 0;
            font-family: Arial, sans-serif;
            background: linear-gradient(120deg, #f0f9ff, #cbebff);
            color: #333;
            background: url('../assets/img/weather.jpg') no-repeat center center fixed;

        }

        h1 {
            text-align: center;
            margin: 20px 0;
        }

        .container {
            max-width: 1200px;
            margin: 20px auto;
            padding: 20px;
            background: #fff;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin: 20px 0;
            font-size: 16px;
        }

        th, td {
            text-align: center;
            padding: 10px;
            border: 1px solid #ddd;
        }

        th {
            background-color: #0078d7;
            color: #fff;
        }

        tr:nth-child(even) {
            background-color: #f9f9f9;
        }

        tr:hover {
            background-color: #f1f1f1;
        }

        .weather-icon {
            width: 50px;
            height: 50px;
        }

        canvas {
            margin: 20px auto;
            display: block;
        }
    </style>
</head>
<body>

<section class="container">
    <h1>Weather Forecast</h1>

    <canvas id="tempChart"></canvas>

    <table>
        <thead>
            <tr>
                <th>Date</th>
                <th>Time</th>
                <th>Temperature (Max / Min)</th>
                <th>Description</th>
                <th>Humidity</th>
                <th>Wind Speed</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($forecast as $f) {
                $date = substr($f->dt_txt, 0, 10);
                $time = substr($f->dt_txt, 11);
            ?>
            <tr>
                <td><?php echo $date; ?></td>
                <td><?php echo $time; ?></td>
                <td>
                    <img src="http://openweathermap.org/img/w/<?php echo $f->weather[0]->icon; ?>.png" class="weather-icon" />
                    <?php echo $f->main->temp_max; ?>&#8451; / <?php echo $f->main->temp_min; ?>&#8451;
                </td>
                <td><?php echo $f->weather[0]->main . ', ' . $f->weather[0]->description; ?></td>
                <td><?php echo $f->main->humidity; ?>%</td>
                <td><?php echo $f->wind->speed; ?> km/h</td>
            </tr>
            <?php } ?>
        </tbody>
    </table>
</section>

<script>
    const ctx = document.getElementById('tempChart').getContext('2d');
    const tempChart = new Chart(ctx, {
        type: 'line',
        data: {
            labels: <?php echo json_encode($dates); ?>,
            datasets: [
                {
                    label: 'High Temp (°C)',
                    data: <?php echo json_encode($highTemps); ?>,
                    borderColor: 'rgba(255, 99, 132, 1)',
                    backgroundColor: 'rgba(255, 99, 132, 0.2)',
                    borderWidth: 2
                },
                {
                    label: 'Low Temp (°C)',
                    data: <?php echo json_encode($lowTemps); ?>,
                    borderColor: 'rgba(54, 162, 235, 1)',
                    backgroundColor: 'rgba(54, 162, 235, 0.2)',
                    borderWidth: 2
                },
                {
                    label: 'Average Temp (°C)',
                    data: <?php echo json_encode($averageTemps); ?>,
                    borderColor: 'rgba(75, 192, 192, 1)',
                    backgroundColor: 'rgba(75, 192, 192, 0.2)',
                    borderWidth: 2
                }
            ]
        },
        options: {
            responsive: true,
            plugins: {
                legend: {
                    position: 'top'
                }
            },
            scales: {
                x: {
                    title: {
                        display: true,
                        text: 'Dates'
                    }
                },
                y: {
                    title: {
                        display: true,
                        text: 'Temperature (°C)'
                    }
                }
            }
        }
    });
</script>

</body>
</html>
