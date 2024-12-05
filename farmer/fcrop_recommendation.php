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
    <title>Crop Recommendation</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
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
    background: rgba(0, 0, 0, 0.6); /* Dark overlay */
    backdrop-filter: blur(8px); /* Subtle blur */
    z-index: -1;
}

.container {
    max-width: 1000px;
    margin: 50px auto;
    background: rgba(255, 255, 255, 0.9);
    color: #333;
    border-radius: 20px;
    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.3);
    padding: 50px;
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

table {
    width: 100%;
    border-collapse: collapse;
    margin-bottom: 20px;
    font-size: 16px; /* Increased font size for readability */
}

table th,
table td {
    text-align: center;
    padding: 16px; /* Increased padding for larger cells */
    border: 1px solid #ccc;
    font-size: 16px; /* Increased font size for table content */
    vertical-align: middle; /* Ensure vertical alignment for content */
}

table th {
    background: #6a11cb;
    color: #fff;
}

input[type="number"] {
    width: 100%;
    padding: 12px; /* Increased padding */
    font-size: 18px; /* Increased font size */
    border-radius: 5px;
    border: 1px solid #ccc;
    background: #f9f9f9;
    margin-top: 8px;
    box-sizing: border-box; /* Ensure padding doesn't overflow the input box */
    height: 48px; /* Set a fixed height to align inputs */
}

button {
    width: 100%;
    padding: 14px; /* Increased padding */
    font-size: 18px; /* Increased font size */
    font-weight: bold;
    color: #fff;
    background: linear-gradient(to right, #6a11cb, #2575fc);
    border: none;
    border-radius: 5px;
    cursor: pointer;
    transition: transform 0.3s ease-in-out, box-shadow 0.3s ease-in-out;
}

button:hover {
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

footer {
    text-align: center;
    padding: 20px;
    background: #222;
    color: #aaa;
    margin-top: 30px;
    font-size: 14px;
}

    </style>
</head>

<body>
    <?php include('fnav.php'); ?>

    <div class="container">
        <h2><i class="fas fa-seedling"></i> Crop Recommendation</h2>
        <form method="POST" action="#">
            <table>
                <thead>
                    <tr>
                        <th>Nitrogen</th>
                        <th>Phosphorous</th>
                        <th>Potassium</th>
                        <th>Temperature</th>
                        <th>Humidity</th>
                        <th>PH</th>
                        <th>Rainfall</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td><input type="number" name="n" placeholder="Eg: 90" required></td>
                        <td><input type="number" name="p" placeholder="Eg: 42" required></td>
                        <td><input type="number" name="k" placeholder="Eg: 43" required></td>
                        <td><input type="number" name="t" step="0.01" placeholder="Eg: 21" required></td>
                        <td><input type="number" name="h" step="0.01" placeholder="Eg: 82" required></td>
                        <td><input type="number" name="ph" step="0.01" placeholder="Eg: 6.5" required></td>
                        <td><input type="number" name="r" step="0.01" placeholder="Eg: 203" required></td>
                    </tr>
                </tbody>
            </table>
            <button type="submit" name="Crop_Recommend">Recommend Crop</button>
        </form>
    </div>

    <div class="container result-container">
        <?php
        if (isset($_POST['Crop_Recommend'])) {
            $n = trim($_POST['n']);
            $p = trim($_POST['p']);
            $k = trim($_POST['k']);
            $t = trim($_POST['t']);
            $h = trim($_POST['h']);
            $ph = trim($_POST['ph']);
            $r = trim($_POST['r']);

            echo "<h4>Recommended Crop is: ";

            $Jsonn = json_encode($n);
            $Jsonp = json_encode($p);
            $Jsonk = json_encode($k);
            $Jsont = json_encode($t);
            $Jsonh = json_encode($h);
            $Jsonph = json_encode($ph);
            $Jsonr = json_encode($r);

            $command = escapeshellcmd("python ML/crop_recommendation/recommend.py $Jsonn $Jsonp $Jsonk $Jsont $Jsonh $Jsonph $Jsonr");
            $output = passthru($command);
            echo $output . "</h4>";
        }
        ?>
    </div>

</body>

</html>
