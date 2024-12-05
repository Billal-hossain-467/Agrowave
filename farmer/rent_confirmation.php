<?php
// Include session handling and database connection
include('fsession.php');
include('../sql.php');

// Initialize variables
$message = '';

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['rent'])) {
    $item_id = $_POST['item_id'];
    $rental_days = $_POST['rental_days'];

    // Fetch tool's price per day
    $tool_sql = "SELECT item_name, price_per_day FROM rental_items WHERE id = $item_id";
    $tool_result = mysqli_query($conn, $tool_sql);
    $tool = mysqli_fetch_assoc($tool_result);
    $price_per_day = $tool['price_per_day'];
    $item_name = $tool['item_name'];

    // Calculate total price
    $total_price = $price_per_day * $rental_days;

    // Store the rental details in session
    $_SESSION['rental_details'] = [
        'item_name' => $item_name,
        'rental_days' => $rental_days,
        'total_price' => $total_price,
        'item_id' => $item_id
    ];

    // Display confirmation message
    $message = "You have selected '$item_name' for $rental_days days. Total price: Tk. " . number_format($total_price, 2);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rental Confirmation</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f4f7f6;
            margin: 0;
            padding: 20px;
        }

        h1 {
            color: #4CAF50;
            text-align: center;
            margin-bottom: 20px;
        }

        .container {
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            padding: 30px;
            max-width: 600px;
            margin: 0 auto;
        }

        .message {
            font-size: 1.2rem;
            margin-bottom: 20px;
            text-align: center;
            color: #333;
        }

        .btn-confirm {
            display: block;
            width: 100%;
            padding: 12px;
            background-color: #4CAF50;
            color: white;
            border: none;
            font-size: 1.2rem;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s ease;
            margin-top: 20px;
        }

        .btn-confirm:hover {
            background-color: #45a049;
        }

        .btn-back {
            display: block;
            width: 100%;
            padding: 12px;
            background-color: #888;
            color: white;
            border: none;
            font-size: 1.2rem;
            border-radius: 5px;
            text-align: center;
            margin-top: 10px;
            text-decoration: none;
        }

        .btn-back:hover {
            background-color: #777;
        }

    </style>
</head>
<body>

<div class="container">
    <h1>Rental Confirmation</h1>

    <!-- Display message if rental details are available -->
    <?php if ($message) : ?>
        <p class="message"><?= $message ?></p>
    <?php endif; ?>

    <!-- Confirm hire button to complete the rental -->
    <form action="delete_item.php" method="POST">
        <button type="submit" class="btn-confirm" name="confirm_rent">Confirm Hire</button>
    </form>

    <!-- Button to go back to available tools page -->
    <a href="fprofile.php" class="btn-back">Go back to available tools</a>
</div>

</body>
</html>
