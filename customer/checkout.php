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

// Fetch cart items
$sql = "SELECT ci.cart_item_id, ci.quantity, ci.price, fct.Trade_crop, fl.farmer_name 
        FROM cart_items ci
        JOIN farmer_crops_trade fct ON ci.item_id = fct.trade_id
        JOIN farmerlogin fl ON fct.farmer_fkid = fl.farmer_id
        WHERE ci.customer_id = '$customer_id'";
$result = mysqli_query($conn, $sql);

// Calculate total price
$total_price = 0;
while ($row = mysqli_fetch_assoc($result)) {
    $total_price += $row['quantity'] * $row['price'];
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkout</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
    <style>
        /* General Styles */
        body {
            font-family: 'Poppins', sans-serif;
            margin: 0;
            padding: 0;
            background-color: white;
            color: #333;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            overflow: hidden;
            position: relative;
            background-image: url('../assets/img/R.jpeg');
        }

        /* Container Styling */
        .container {
            width: 100%;
            max-width: 1200px;
            background: white;
            border-radius: 16px;
            box-shadow: 0 15px 40px rgba(0, 0, 0, 0.1);
            padding: 40px;
            text-align: center;
            margin-top: 50px;
            position: relative;
        }

        h1 {
            color: #22870c;
            font-size: 3rem;
            margin-bottom: 30px;
            text-transform: uppercase;
            font-weight: 600;
            letter-spacing: 2px;
        }

        .order-details {
            margin-bottom: 40px;
        }

        .order-details table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 30px;
        }

        .order-details th, .order-details td {
            padding: 14px;
            text-align: center;
            border-bottom: 2px solid #ddd;
            font-size: 1rem;
        }

        .order-details th {
            background-color: #22870c;
            color: white;
            font-weight: 600;
            text-transform: uppercase;
        }

        .order-details td {
            background-color: #f9f9f9;
            font-weight: 400;
        }

        .order-details tr:hover {
            background-color: #e9f5e1;
        }

        .total-row {
            font-size: 1.3rem;
            font-weight: 600;
            background-color: #ecf9f2;
            padding: 15px;
            border-radius: 8px;
            margin-top: 20px;
            text-align: right;
            color: #22870c;
        }

        .btn {
            background-color: #22870c;
            color: white;
            padding: 12px 40px;
            border-radius: 50px;
            font-size: 1.1rem;
            font-weight: 600;
            text-decoration: none;
            display: inline-block;
            box-shadow: 0 6px 15px rgba(0, 0, 0, 0.1);
            transition: 0.3s;
        }

        .btn:hover {
            background-color: #1c7c07;
            transform: translateY(-4px);
        }

        .no-items {
            font-size: 1.2rem;
            color: #777;
            font-weight: 400;
            margin-top: 30px;
        }

        /* Mobile Responsiveness */
        @media (max-width: 768px) {
            .container {
                padding: 20px;
                margin: 20px;
            }

            h1 {
                font-size: 2.2rem;
            }

            .order-details th, .order-details td {
                padding: 12px;
                font-size: 0.9rem;
            }

            .total-row {
                font-size: 1.1rem;
            }
        }
    </style>
</head>
<body>

<div class="container">
    <h1>Checkout</h1>

    <div class="order-details">
        <h3>Your Order</h3>
        <table>
            <thead>
                <tr>
                    <th>Crop Name</th>
                    <th>Farmer Name</th>
                    <th>Quantity</th>
                    <th>Price (per KG)</th>
                    <th>Total Price</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // Fetch cart items again for display
                mysqli_data_seek($result, 0); // Reset pointer
                while ($row = mysqli_fetch_assoc($result)) {
                    echo "<tr>
                            <td>" . $row['Trade_crop'] . "</td>
                            <td>" . $row['farmer_name'] . "</td>
                            <td>" . $row['quantity'] . " KG</td>
                            <td>Tk. " . number_format($row['price'], 2) . "</td>
                            <td>Tk. " . number_format($row['quantity'] * $row['price'], 2) . "</td>
                        </tr>";
                }
                ?>
            </tbody>
        </table>

        <div class="total-row">
            <span style="color:red">Total Price: Tk. <?= number_format($total_price, 2) ?></span>
        </div>
    </div>

    <form method="POST" action="pay_sucess.php">
        <input type="hidden" name="total_price" value="<?= $total_price ?>">

        <!-- Payment Form -->
        <div style="text-align: center; margin-top: 30px;">
            <button type="submit" class="btn">Proceed to Payment</button>
        </div>
    </form>
</div>

</body>
</html>
