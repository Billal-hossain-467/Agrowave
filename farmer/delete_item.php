<?php
// Include session handling and database connection
include('fsession.php');
include('../sql.php');

// Check if rental details exist in session
if (isset($_SESSION['rental_details'])) {
    $rental_details = $_SESSION['rental_details'];

    // Retrieve rental details
    $item_id = $rental_details['item_id'];
    $item_name = $rental_details['item_name'];
    $rental_days = $rental_details['rental_days'];
    $total_price = $rental_details['total_price'];

    // Process the rental (e.g., store in rental history, etc.)
    // For now, you can just display the confirmation.

    // Delete the item from the available rental list (optional)
    $delete_sql = "DELETE FROM rental_items WHERE id = $item_id";
    if (mysqli_query($conn, $delete_sql)) {
        // Rental confirmed and item removed from the list
        $message = "You have successfully rented '$item_name' for $rental_days days. Total price: Tk. " . number_format($total_price, 2);
    } else {
        $message = "Failed to complete the rental process. Please try again.";
    }

    // Clear rental details from session after processing
    unset($_SESSION['rental_details']);
} else {
    $message = "No rental details found.";
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
    <h1>Rental Completed</h1>

    <!-- Display the confirmation message -->
    <?php if (isset($message)) : ?>
        <p class="message"><?= $message ?></p>
    <?php endif; ?>

    <!-- Button to go back to available tools page -->
    <a href="show_rent.php" class="btn-back">Go back to available tools</a>
</div>

</body>
</html>
