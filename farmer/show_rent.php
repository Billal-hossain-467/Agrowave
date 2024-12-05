<?php

include('fsession.php'); // Include session management and database connection

// Check if the user is logged in
if (!isset($_SESSION['farmer_login_user'])) {
  header("location: ../index.php");  // Redirect to login page if not logged in
  exit();
}

// Fetch farmer's ID from session
$query4 = "SELECT farmer_id, farmer_name FROM farmerlogin WHERE email='$user_check'";
$ses_sq4 = mysqli_query($conn, $query4);
$row4 = mysqli_fetch_assoc($ses_sq4);
$farmer_fkid = $row4['farmer_id']; // Farmer's ID
$para2 = $row4['farmer_name'];

// Fetch all rental items along with customer details (name)
$sql = "SELECT ri.id, ri.item_name, ri.description, ri.price_per_day, ri.image_path, cl.cust_name
        FROM rental_items ri
        JOIN custlogin cl ON ri.customer_id = cl.cust_id";
        
$result = mysqli_query($conn, $sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Available Tools for Rent</title>
    <style>
        /* Navbar Styling */
        nav {
            position: fixed;
            top: 0;
            width: 100%;
            background-color: #4CAF50;
            color: white;
            padding: 10px 0;
            z-index: 1000;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }

        nav a {
            color: white;
            text-decoration: none;
            padding: 10px 15px;
            margin: 0 10px;
            font-size: 1.1rem;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: #f4f7f6;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            flex-direction: column;
            background-image: url('../assets/img/t.jpeg');
        }

        .container {
            background: #fff;
            color: #333;
            max-width: 1000px;
            width: 100%;
            padding: 40px;
            border-radius: 15px;
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.1);
            margin-top: 20px;
        }

        h1 {
            text-align: center;
            font-size: 2.5rem;
            color: #4CAF50;
            margin-bottom: 20px;
        }

        .card {
            display: flex;
            justify-content: space-between;
            align-items: center;
            border: 1px solid #ddd;
            border-radius: 8px;
            padding: 20px;
            margin-bottom: 15px;
            transition: all 0.3s ease;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .card:hover {
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
        }

        .card .details {
            max-width: 60%;
        }

        .card .details h3 {
            font-size: 1.5rem;
            color: #333;
        }

        .card .details p {
            font-size: 1rem;
            color: #555;
        }

        .card .customer-name {
            font-size: 1rem;
            color: #4CAF50;
            font-weight: bold;
        }

        .card .price {
            font-size: 1.2rem;
            font-weight: bold;
            color: #4CAF50;
        }

        .card img {
            max-width: 100px;
            max-height: 100px;
            border-radius: 8px;
        }

        .form-group {
            margin-top: 10px;
        }

        .form-group input {
            width: 60px;
            padding: 5px;
            font-size: 1rem;
        }

        .form-group button {
            padding: 10px 20px;
            background-color: #4CAF50;
            color: white;
            border: none;
            cursor: pointer;
            border-radius: 5px;
        }

        .form-group button:hover {
            background-color: #45a049;
        }

    </style>

</head>
<body>
<?php include('fnav.php'); ?>
<div class="container">
    <h1>Available Tools for Rent</h1>

    <!-- Loop through rental items and display them -->
    <?php if (mysqli_num_rows($result) > 0) : ?>
        <?php while ($row = mysqli_fetch_assoc($result)) : ?>
            <div class="card">
                <div class="details">
                    <h3><?= $row['item_name'] ?></h3>
                    <p><?= $row['description'] ?></p>
                    <p class="customer-name">Posted by: <?= $row['cust_name'] ?></p>
                </div>
                <div class="price">
                    Tk. <?= number_format($row['price_per_day'], 2) ?> / Day
                    <br>
                    <!-- Rent form with input for number of days -->
                    <form action="rent_confirmation.php" method="POST" class="form-group">
                        <input type="number" name="rental_days" min="1" required placeholder="Days">
                        <input type="hidden" name="item_id" value="<?= $row['id'] ?>">
                        <button type="submit" name="rent">Rent Now</button>
                    </form>
                </div>
                <?php if ($row['image_path']) : ?>
                    <div class="image">
                        <img src="../assets/img/<?= basename($row['image_path']) ?>" alt="<?= $row['item_name'] ?>">
                    </div>
                <?php endif; ?>
            </div>
        <?php endwhile; ?>
    <?php else: ?>
        <h3>No items available for rent.</h3>
    <?php endif; ?>
</div>

</body>
</html>
