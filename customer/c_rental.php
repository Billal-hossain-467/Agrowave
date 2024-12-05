<?php
// Include session handling and database connection
include('csession.php');  // Handles session checking
include('../sql.php');  // Database connection

// Fetch customer details from the database based on the session email
$query4 = "SELECT * FROM custlogin WHERE email='$user_check'";
$ses_sq4 = mysqli_query($conn, $query4);
$row4 = mysqli_fetch_assoc($ses_sq4);
$para1 = $row4['cust_id'];  // Customer ID
$para2 = $row4['cust_name'];  // Customer Name

// Initialize message variable
$message = '';

// Check if the form has been submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get form data
    $item_name = $_POST['item_name'];
    $description = $_POST['description'];
    $price_per_day = $_POST['price_per_day'];

    // Insert rental item into the database without the image path
    $sql = "INSERT INTO rental_items (customer_id, item_name, description, price_per_day)
            VALUES ('$para1', '$item_name', '$description', '$price_per_day')";

    if (mysqli_query($conn, $sql)) {
        $message = "Item listed for rent successfully!";
    } else {
        $message = "Error: " . mysqli_error($conn);
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>List Item for Rent</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
    <style>
        /* General page styles */
        body {
            font-family: 'Poppins', sans-serif;
            background: url('../assets/img/h.jpg') no-repeat center center fixed;
            background-size: cover;
            color: #fff;
            margin: 0;
            padding: 0;
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

        /* Center the container on the page */
        .container {
            max-width: 700px;
            width: 100%;
            background: rgba(255, 255, 255, 0.9); /* Semi-transparent white */
            border-radius: 20px;
            padding: 40px;
            box-shadow: 0 12px 24px rgba(0, 0, 0, 0.1);
            color: #333;
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
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

        h1 {
            text-align: center;
            color: #2575fc;
            font-size: 2.4rem;
            margin-bottom: 25px;
            font-weight: 600;
            letter-spacing: 1px;
        }

        .form-group {
            margin-bottom: 20px;
        }

        label {
            font-size: 1.1rem;
            font-weight: 600;
            color: #333;
            margin-bottom: 10px;
            display: block;
        }

        input, textarea {
            width: 100%;
            padding: 12px;
            font-size: 1rem;
            border: 2px solid #ddd;
            border-radius: 8px;
            transition: all 0.3s ease;
            box-sizing: border-box;
        }

        input:focus, textarea:focus {
            border-color: #2575fc;
            outline: none;
        }

        textarea {
            resize: vertical;
            min-height: 120px;
        }

        .btn {
            background-color: #2575fc;
            color: white;
            padding: 14px 30px;
            border-radius: 50px;
            font-size: 1.1rem;
            font-weight: 600;
            text-decoration: none;
            display: inline-block;
            transition: 0.3s;
            cursor: pointer;
            width: 100%;
            text-align: center;
        }

        .btn:hover {
            background-color: #45a049;
            transform: translateY(-3px);
        }

        /* Success and Error Messages */
        .message {
            text-align: center;
            font-size: 1.1rem;
            font-weight: bold;
            margin-bottom: 20px;
        }

        .error {
            color: red;
        }

        .success {
            color: green;
        }

        /* Mobile Responsiveness */
        @media (max-width: 768px) {
            .container {
                padding: 20px;
            }

            h1 {
                font-size: 2rem;
            }

            input, textarea {
                font-size: 0.9rem;
                padding: 10px;
            }

            .btn {
                font-size: 1rem;
                padding: 12px 25px;
            }
        }
    </style>
</head>
<body>

<!-- Navbar -->
<?php include('cnav.php'); ?>

<!-- Container for content -->
<div class="container">
    <h1>List Item for Rent</h1>

    <!-- Success or Error Message -->
    <?php if ($message) : ?>
        <p class="message <?= (strpos($message, 'successfully') !== false) ? 'success' : 'error' ?>">
            <?= $message ?>
        </p>
    <?php endif; ?>

    <!-- Rental Item Submission Form -->
    <form action="" method="POST">
        <div class="form-group">
            <label for="item_name">Item Name:</label>
            <input type="text" id="item_name" name="item_name" required>
        </div>

        <div class="form-group">
            <label for="description">Description:</label>
            <textarea id="description" name="description"></textarea>
        </div>

        <div class="form-group">
            <label for="price_per_day">Price per Day (in Tk):</label>
            <input type="number" id="price_per_day" name="price_per_day" required>
        </div>

        <input type="submit" value="Submit" class="btn">
    </form>
</div>

<!-- Footer -->


</body>
</html>
