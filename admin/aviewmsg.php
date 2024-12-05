<?php
session_start(); // Starting Session
require('../sql.php'); // Includes Login Script

// Storing Session
$user = $_SESSION['admin_login_user'];

if (!isset($_SESSION['admin_login_user'])) {
    header("location: ../index.php"); // Redirecting To Home Page
}

$query4 = "SELECT * from admin where admin_name ='$user'";
$ses_sq4 = mysqli_query($conn, $query4);
$row4 = mysqli_fetch_assoc($ses_sq4);
$para1 = $row4['admin_id'];
$para2 = $row4['admin_name'];
$para3 = $row4['admin_password'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Queries - AgroWave</title>
    <link rel="icon" type="image/png" href="../assets/img/logo.png">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">

    <!-- DataTables CSS -->
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css">

    <style>
        /* General Body Styling */
body {
    font-family: 'Arial', sans-serif;
    margin: 0;
    padding: 0;
    background: url('../assets/img/admin.jpg') no-repeat center center fixed;
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
    background: rgba(0, 0, 0, 0.5);
    backdrop-filter: blur(4px);
    z-index: -1;
}

/* Container Styling */
.container {
    max-width: 1000px;
    margin: 50px auto;
    background: rgba(255, 255, 255, 0.9);
    color: #333;
    border-radius: 20px;
    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.3);
    overflow: hidden;
    padding: 30px;
    position: relative;
    animation: fadeIn 1s ease-out;
}

/* Top Gradient Bar */
.container::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 8px;
    background: linear-gradient(to right, #6a11cb, #2575fc);
}

/* Fade-in Animation */
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

/* Heading Styling */
h2 {
    text-align: center;
    color: #2575fc;
    font-weight: bold;
    margin-bottom: 20px;
    font-size: 2rem;
}

/* Table Styling */
table {
    width: 100%;
    border-collapse: collapse;
    margin-top: 20px;
}

th, td {
    padding: 15px;
    text-align: center;
    border: 1px solid #ddd;
}

th {
    background-color: #ff6666;
    color: white;
}

tr:hover {
    background-color: #f1f1f1;
}

/* Button Styling */
button {
    background-color: #ff3333;
    color: white;
    padding: 10px 15px;
    border: none;
    border-radius: 5px;
    cursor: pointer;
}

button:hover {
    background-color: #cc0000;
}

a {
    text-decoration: none;
    color: white;
}

a:hover {
    text-decoration: underline;
}

/* Badge Styling */
.badge {
    display: inline-block;
    padding: 10px 20px;
    background-color: #ff3333;
    color: white;
    font-size: 16px;
    border-radius: 50px;
}

/* Footer Styling */
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

    <!-- Navigation -->
    <?php include('anav.php'); ?>

    <!-- Main Content -->
    <div class="container">
        <h2><i class="fas fa-question-circle"></i> Admin Queries</h2>

        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Mobile No.</th>
                    <th>Email</th>
                    <th>Address</th>
                    <th>Message</th>
                    <th>Delete</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $q = "SELECT * FROM contactus";
                $query = mysqli_query($conn, $q);
                while ($res = mysqli_fetch_array($query)) {
                ?>
                    <tr class="text-center">
                        <td><?php echo $res['c_id']; ?></td>
                        <td><?php echo $res['c_name']; ?></td>
                        <td><?php echo $res['c_mobile']; ?></td>
                        <td><?php echo $res['c_email']; ?></td>
                        <td><?php echo $res['c_address']; ?></td>
                        <td><?php echo $res['c_message']; ?></td>
                        <td>
                            <button>
                                <a href="amsgdelete.php?id=<?php echo $res['c_id']; ?>">Delete</a>
                            </button>
                        </td>
                    </tr>
                <?php
                }
                ?>
            </tbody>
        </table>
    </div>

</body>
</html>