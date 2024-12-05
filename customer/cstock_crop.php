<?php
include('csession.php');
include('../sql.php');

if (!isset($_SESSION['customer_login_user'])) {
    header("location: ../index.php");
}

// Fetching the customer details
$query4 = "SELECT * FROM custlogin WHERE email='$user_check'";
$ses_sq4 = mysqli_query($conn, $query4);
$row4 = mysqli_fetch_assoc($ses_sq4);
$para1 = $row4['cust_id'];
$para2 = $row4['cust_name'];

// Fetching cart items for the logged-in customer
$sql = "SELECT ci.cart_item_id, ci.quantity, ci.price, fct.Trade_crop, fl.farmer_name 
        FROM cart_items ci
        JOIN farmer_crops_trade fct ON ci.item_id = fct.trade_id
        JOIN farmerlogin fl ON fct.farmer_fkid = fl.farmer_id
        WHERE ci.customer_id = '$para1'";
$result = mysqli_query($conn, $sql);

// Check if query executed successfully
if ($result === false) {
    echo "Error: " . mysqli_error($conn);  // Print error message
    exit;
}

// Calculate the total price
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
    <title>Your Cart</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <style>
        /* General page styles */
        body {
            font-family: 'Poppins', sans-serif;
            background: linear-gradient(135deg, #2c3e50, #3498db);
            margin: 0;
            padding: 0;
            color: #fff;
            background-image: url('../assets/img/R.jpeg');
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

        .container {
            width: 100%;
            max-width: 1200px;
            margin: 40px auto;
            padding: 40px;
            background-color: #fff;
            border-radius: 16px;
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1);
            color: #333;
            text-align: center;
        }

        h1 {
            color:#22870c;
            font-size: 2rem;
            font-weight: 600;
            margin-bottom: 20px;
          
            letter-spacing: 2px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 30px;
            border-radius: 10px;
            overflow: hidden;
        }

        table th, table td {
            padding: 18px;
            text-align: left;
            font-size: 1.2rem;
            color: #333;
            border-bottom: 2px solid #e1e1e1;
        }

        table th {
            background-color: #22870c;
            color: white;
         
            font-weight: bold;
        }

        table td {
            background-color: #f4f7f6;
            font-weight: 400;
        }

        table tr:hover {
            background-color: #eaf2f7;
            transform: scale(1.02);
            transition: all 0.3s ease;
        }

        .total-row {
            margin-top: 40px;
            background-color: #fff;
            padding: 25px;
            border-radius: 10px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            font-size: 1.5rem;
            font-weight: 600;
            box-shadow: 0 6px 12px rgba(0, 0, 0, 0.1);
        }

        .total-row span {
            color: red;
        }

        .btn {
            background-color: #22870c;
            color: white;
            padding: 15px 40px;
            border-radius: 50px;
            font-size: 1.2rem;
            font-weight: bold;
            text-decoration: none;
            display: inline-block;
            margin-top: 30px;
            transition: transform 0.3s ease, background-color 0.3s ease;
            box-shadow: 0 6px 15px rgba(0, 0, 0, 0.1);
        }

        .btn:hover {
            background-color: #2980b9;
            transform: translateY(-5px);
        }

        .no-items {
            font-size: 1.3rem;
            color: #777;
            font-weight: 400;
            margin-top: 30px;
        }

       
    </style>
</head>
<body>

    <?php include('cnav.php'); ?>

    <div class="container">
        <h1><i class="fas fa-cart-plus"></i> Your Cart</h1>

        <!-- Cart Items Table -->
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
                // Fetching the cart items for the customer
                mysqli_data_seek($result, 0); // Reset pointer to start over for displaying
                if (mysqli_num_rows($result) > 0) {
                    while ($row = mysqli_fetch_assoc($result)) {
                        echo "<tr>
                                <td>" . $row['Trade_crop'] . "</td>
                                <td>" . $row['farmer_name'] . "</td>
                                <td>" . $row['quantity'] . " KG</td>
                                <td>Tk. " . number_format($row['price'], 2) . "</td>
                                <td>Tk. " . number_format($row['quantity'] * $row['price'], 2) . "</td>
                            </tr>";
                    }
                } else {
                    echo "<tr><td colspan='5' class='no-items'>Your cart is empty.</td></tr>";
                }
                ?>
            </tbody>
        </table>

        <?php if (mysqli_num_rows($result) > 0) { ?>
            <div class="total-row">
                <span>Total Price: Tk. <?= number_format($total_price, 2) ?></span>
            </div>
            <a href="checkout.php" class="btn">Proceed to Checkout</a>
        <?php } ?>
    </div>


</body>
</html>
