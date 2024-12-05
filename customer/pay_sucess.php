<?php
include('csession.php');
include('../sql.php');

if (!isset($_SESSION['customer_login_user'])) {
    header("location: ../index.php");
}

// Fetch customer ID
$query4 = "SELECT * FROM custlogin WHERE email='$user_check'";
$ses_sq4 = mysqli_query($conn, $query4);
$row4 = mysqli_fetch_assoc($ses_sq4);
$customer_id = $row4['cust_id'];

// Payment process (mock)
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $total_price = $_POST['total_price'];
    $payment_method = $_POST['payment_method'];

    // Assume the payment is successful
    $payment_status = "success"; // Mock success

    if ($payment_status == "success") {
        // Process each cart item and reduce the quantity in the farmer_crops_trade table
        $sql = "SELECT ci.cart_item_id, ci.quantity, fct.trade_id
                FROM cart_items ci
                JOIN farmer_crops_trade fct ON ci.item_id = fct.trade_id
                WHERE ci.customer_id = '$customer_id'";

        $result = mysqli_query($conn, $sql);

        while ($row = mysqli_fetch_assoc($result)) {
            // Get the trade ID and quantity from the cart
            $trade_id = $row['trade_id'];
            $quantity = $row['quantity'];

            // Update stock in farmer_crops_trade table
            $update_sql = "UPDATE farmer_crops_trade
                           SET Crop_quantity = Crop_quantity - $quantity
                           WHERE trade_id = '$trade_id'";
            mysqli_query($conn, $update_sql);
        }

        // Optionally, clear the cart items for the customer
        $delete_cart_sql = "DELETE FROM cart_items WHERE customer_id = '$customer_id'";
        mysqli_query($conn, $delete_cart_sql);

        echo "<script>alert('Payment successful! Your order has been placed.'); window.location.href='cbuy_crops.php';</script>";
    } else {
        echo "<script>alert('Payment failed. Please try again.'); window.location.href='checkout.php';</script>";
    }
}
?>
