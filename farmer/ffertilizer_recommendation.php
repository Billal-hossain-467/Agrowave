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
    <title>Fertilizer Recommendation</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
    <style>
        /* General Styling */
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
    max-width: 1200px; /* Increased container width */
    margin: 50px auto;
    background: rgba(255, 255, 255, 0.9);
    color: #333;
    border-radius: 20px;
    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.3);
    padding: 40px;
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
    margin-bottom: 30px; /* Increased margin */
    font-size: 2.2rem; /* Larger font size */
}

table {
    width: 100%;
    border-collapse: collapse;
    margin-bottom: 30px; /* Increased space below the table */
}

table th,
table td {
    text-align: center;
    padding: 20px; /* Increased padding for a larger table */
    font-size: 18px; /* Increased font size for readability */
    border: 1px solid #ccc;
    vertical-align: middle; /* Center the input fields vertically */
}

table th {
    background: #6a11cb;
    color: #fff;
}

input[type="number"],
select {
    width: 100%;
    padding: 15px; /* Increased padding for input fields */
    font-size: 18px; /* Larger font size for inputs */
    border-radius: 5px;
    border: 1px solid #ccc;
    background: #f9f9f9;
    box-sizing: border-box; /* Include padding in width calculation */
    height: 50px; /* Set a fixed height for inputs */
}

button {
    width: 100%;
    padding: 15px; /* Increased padding for button */
    font-size: 18px; /* Larger font size */
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
    margin-top: 30px;
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
    font-size: 1.5rem; /* Increased font size for results */
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
        <h2><i class="fas fa-leaf"></i> Fertilizer Recommendation</h2>
        <form method="POST" action="#">
            <table>
                <thead>
                    <tr>
                        <th>Nitrogen</th>
                        <th>Phosphorous</th>
                        <th>Potassium</th>
                        <th>Temperature</th>
                        <th>Humidity</th>
                        <th>Soil Moisture</th>
                        <th>Soil Type</th>
                        <th>Crop</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td><input type="number" name="n" placeholder="Eg: 37" required></td>
                        <td><input type="number" name="p" placeholder="Eg: 0" required></td>
                        <td><input type="number" name="k" placeholder="Eg: 0" required></td>
                        <td><input type="number" name="t" placeholder="Eg: 26" required></td>
                        <td><input type="number" name="h" placeholder="Eg: 52" required></td>
                        <td><input type="number" name="soilMoisture" placeholder="Eg: 38" required></td>
                        <td>
                            <select name="soil" required>
                                <option value="">Select Soil Type</option>
                                <option value="Sandy">Sandy</option>
                                <option value="Loamy">Loamy</option>
                                <option value="Black">Black</option>
                                <option value="Red">Red</option>
                                <option value="Clayey">Clayey</option>
                            </select>
                        </td>
                        <td>
                            <select name="crop" required>
                                <option value="">Select Crop</option>
                                <option value="Maize">Maize</option>
                                <option value="Sugarcane">Sugarcane</option>
                                <option value="Cotton">Cotton</option>
                                <option value="Tobacco">Tobacco</option>
                                <option value="Paddy">Paddy</option>
                                <option value="Barley">Barley</option>
                                <option value="Wheat">Wheat</option>
                                <option value="Millets">Millets</option>
                                <option value="Oil seeds">Oil seeds</option>
                                <option value="Pulses">Pulses</option>
                                <option value="Ground Nuts">Ground Nuts</option>
                            </select>
                        </td>
                    </tr>
                </tbody>
            </table>
            <button type="submit" name="Fert_Recommend">Recommend Fertilizer</button>
        </form>
    </div>

    <div class="container result-container">
        <?php
        if (isset($_POST['Fert_Recommend'])) {
            $n = trim($_POST['n']);
            $p = trim($_POST['p']);
            $k = trim($_POST['k']);
            $t = trim($_POST['t']);
            $h = trim($_POST['h']);
            $sm = trim($_POST['soilMoisture']);
            $soil = trim($_POST['soil']);
            $crop = trim($_POST['crop']);

            echo "<h4>Recommended Fertilizer is: ";

            $Jsonn = json_encode($n);
            $Jsonp = json_encode($p);
            $Jsonk = json_encode($k);
            $Jsont = json_encode($t);
            $Jsonh = json_encode($h);
            $Jsonsm = json_encode($sm);
            $Jsonsoil = json_encode($soil);
            $Jsoncrop = json_encode($crop);

            $command = escapeshellcmd("python ML/fertilizer_recommendation/fertilizer_recommendation.py $Jsonn $Jsonp $Jsonk $Jsont $Jsonh $Jsonsm $Jsonsoil $Jsoncrop");
            $output = passthru($command);
            echo $output . "</h4>";
        }
        ?>
    </div>

    
</body>

</html>
