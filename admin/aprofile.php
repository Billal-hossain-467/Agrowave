<?php 
session_start(); // Starting Session
require('../sql.php'); // Includes Login Script

// Storing Session
$user = $_SESSION['admin_login_user'];

if (!isset($_SESSION['admin_login_user'])) {
    header("location: ../index.php");
} // Redirecting To Home Page

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
    <title>Admin Panel</title>
    <link rel="stylesheet" href="styles.css">
    <style>
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

        h4 {
            text-align: center;
            color: #2575fc;
            font-weight: bold;
            margin-bottom: 20px;
            font-size: 2rem;
        }

        .row {
            display: flex;
            justify-content: space-between;
            align-items: stretch;
        }

        .col-md-4, .col-md-8 {
            display: flex;
            flex-direction: column;
            justify-content: stretch;
            align-items: stretch;
            flex: 1;
        }

        /* Unique box styles */
        .card {
            border: none;
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 6px 15px rgba(0, 0, 0, 0.2);
            margin-bottom: 20px;
            transition: transform 0.3s ease-in-out, box-shadow 0.3s ease-in-out;
            height: 100%; /* Make sure both boxes have the same height */
            display: flex;
            flex-direction: column;
        }

        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.3);
        }

        .card-body {
            padding: 20px;
            background-color: #f8f9fa;
            position: relative;
            z-index: 1;
            flex-grow: 1;
        }

        /* Admin card styles */
        .bg-gradient-success {
            background: linear-gradient(135deg, #56ab2f, #a8e063); /* Green gradient */
            color: #fff;
        }

        .bg-gradient-success .card-body {
            color: blue;
            text-align: center;
        }

        .bg-gradient-success img {
            border: 5px solid #fff;
            border-radius: 50%;
        }

        /* Second box style */
        .bg-gradient-white {
            background: linear-gradient(135deg, #ffffff, #e0eafc); /* Soft white gradient */
            color: #333;
        }

        /* Add icon to list items */
        .list-group-item {
            font-size: 1rem;
            color: #555;
            border: none;
            padding-left: 30px;
            position: relative;
            background-color: transparent;
            margin-bottom: 10px;
        }

        .list-group-item::before {
            content: "\f058";
            font-family: "FontAwesome";
            position: absolute;
            left: 0;
            top: 50%;
            transform: translateY(-50%);
            font-size: 1.2rem;
            color: #2575fc;
        }

        .badge {
            display: inline-block;
            padding: 10px 20px;
            background-color: #ff3333;
            color: white;
            font-size: 16px;
            border-radius: 50px;
            margin-bottom: 10px;
        }

        footer {
            background-color: #343a40;
            color: white;
            text-align: center;
            padding: 10px 0;
            position: fixed;
            bottom: 0;
            left: 0;
            width: 100%;
            z-index: 1000;
        }

        footer a {
            color: #f8f9fa;
            text-decoration: none;
        }

        footer a:hover {
            text-decoration: underline;
        }

        .admin-title {
            text-align: center;
            font-size: 1.8rem;
            font-weight: bold;
            color: #2575fc;
            margin-bottom: 30px;
        }
    </style>

</head>
<?php require('aheader.php'); ?>

<body>
    <?php require('anav.php'); ?>
    <section class="section section-shaped">
        <div class="container">
            <div class="admin-title">
                Admin
            </div>

            <div class="row">
                <div class="col-md-4">
                    <div class="card bg-gradient-success">
                        <div class="card-body">
                            <div class="text-center">
                                <img src="../assets/img/admin.png" alt="admin" class="rounded-circle" width="158">
                                <div class="mt-3">
                                    <h4>Welcome <?php echo $para2 ?></h4>
                                    <p><b>Admin ID: </b><?php echo $para1 ?></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-8">
                    <div class="card bg-gradient-white">
                        <div class="card-body">
                            <ol class="list-group">
                                <li class="list-group-item">Admin has access to all the data in the Agriculture Portal.</li>
                                <li class="list-group-item">Admin can modify and view all the Customer's details when necessary.</li>
                                <li class="list-group-item">Admin can manage the farmer's details who provide supplies to the store.</li>
                                <li class="list-group-item">Admin also has access to the sales report and can sort them as required.</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

</body>
<script>
    function password_show_hide() {
        var x = document.getElementById("password");
        var show_eye = document.getElementById("show_eye");
        var hide_eye = document.getElementById("hide_eye");
        hide_eye.classList.remove("d-none");
        if (x.type === "password") {
            x.type = "text";
            show_eye.style.display = "none";
            hide_eye.style.display = "block";
        } else {
            x.type = "password";
            show_eye.style.display = "block";
            hide_eye.style.display = "none";
        }
    }
</script>

</html>