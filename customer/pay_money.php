<?php
include('csession.php');
include('../sql.php');

// Ensure the user is logged in
if (!isset($_SESSION['customer_login_user'])) {
    header("location: ../index.php");
    exit();
}

// Retrieve total price from the previous page (passed via POST)
$total_price = $_POST['total_price'] ?? 0;

// Check if the user has added any items
if ($total_price <= 0) {
    echo "Invalid order.";
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment Methods</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@^2.0/dist/tailwind.min.css" rel="stylesheet">
    <style>
        /* Add your custom styling here */
    </style>
</head>
<body>
    <div class="container mx-auto p-6 bg-white shadow-lg rounded-lg max-w-4xl">
        <div class="bg-green-500 text-white text-center py-3 rounded-t-lg">
            <p>🌾 Welcome to the AgroWave Payment System!</p>
        </div>
        <h2 class="text-xl font-semibold text-gray-800 mt-6">Choose Your Payment Method</h2>
        <div class="space-y-6 mt-4">
            <!-- Payment Method Options -->
            <div class="payment-method" onclick="redirectToPayment('bkash')">
                <img src="../assets/img/bkash.jpg" alt="bKash Payment" class="w-12">
                <h3 class="font-medium text-gray-700">bKash</h3>
            </div>
            <div class="payment-method" onclick="redirectToPayment('nagad')">
                <img src="../assets/img/nogod.jpg" alt="Nagad Payment" class="w-12">
                <h3 class="font-medium text-gray-700">Nagad</h3>
            </div>
            <div class="payment-method" onclick="redirectToPayment('rocket')">
                <img src="../assets/img/rocket.jpeg" alt="Rocket Payment" class="w-12">
                <h3 class="font-medium text-gray-700">Rocket</h3>
            </div>
            <div class="payment-method" onclick="redirectToPayment('visa_card')">
                <img src="../assets/img/visa.jpeg" alt="Visa Card Payment" class="w-12">
                <h3 class="font-medium text-gray-700">Visa Card</h3>
            </div>
        </div>

        <form method="POST" action="process_payment.php">
            <input type="hidden" name="total_price" value="<?= $total_price ?>">

            <div style="text-align: center; margin-top: 20px;">
                <button type="submit" class="pay-button">Proceed to Payment</button>
                <a href="checkout.php" class="pay-button">Cancel</a>
            </div>
        </form>
    </div>

    <script>
        function redirectToPayment(method) {
            const productId = "12345"; // Example product ID
            const quantityToReduce = 1; // Quantity to reduce
            sessionStorage.setItem('productId', productId);
            sessionStorage.setItem('quantityToReduce', quantityToReduce);

            // Redirect based on method
            if (method === 'bkash') {
                location.href = 'pay_sucess.php';
            } else if (method === 'nagad') {
                location.href = 'pay_sucess.php';
            } else if (method === 'rocket') {
                location.href = 'pay_sucess.php';
            } else if (method === 'visa_card') {
                location.href = 'pay_sucess.php';
            }
        }
    </script>
</body>
</html>
