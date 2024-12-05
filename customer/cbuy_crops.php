<?php
include('csession.php');
include('../sql.php');

if (!isset($_SESSION['customer_login_user'])) {
    header("location: ../index.php");
}

// Fetching the customer details
$query4 = "SELECT * from custlogin where email='$user_check'";
$ses_sq4 = mysqli_query($conn, $query4);
$row4 = mysqli_fetch_assoc($ses_sq4);
$para1 = $row4['cust_id'];
$para2 = $row4['cust_name'];

// Fetching available crops with quantity greater than zero
$sql = "SELECT fct.trade_id, fct.Trade_crop, fct.Crop_quantity, fct.costperkg, fl.farmer_name 
        FROM farmer_crops_trade fct
        JOIN farmerlogin fl ON fct.farmer_fkid = fl.farmer_id
        WHERE fct.Crop_quantity > 0";  // Added this condition to fetch only available crops

$result = mysqli_query($conn, $sql);

// Handling the add to cart functionality
if (isset($_POST['add_to_cart'])) {
    $item_id = $_POST['item_id'];
    $quantity = $_POST['quantity'];
    $price = $_POST['price'];

    // Check if quantity is available
    $check_stock_query = "SELECT Crop_quantity FROM farmer_crops_trade WHERE trade_id = '$item_id'";
    $check_stock_result = mysqli_query($conn, $check_stock_query);
    $stock_row = mysqli_fetch_assoc($check_stock_result);

    if ($stock_row['Crop_quantity'] >= $quantity) {
        // Add to cart_items table
        $insert_cart_query = "INSERT INTO cart_items (customer_id, item_id, quantity, price) 
                              VALUES ('$para1', '$item_id', '$quantity', '$price')";
        if (mysqli_query($conn, $insert_cart_query)) {
            $message = "Item added to cart successfully!";
        } else {
            $message = "Error adding item to cart. Please try again.";
        }
    } else {
        $message = "Not enough stock available!";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Buy Crops</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
    <style>
    /* General Styling */
    body {
        font-family: 'Arial', sans-serif;
        margin: 0;
        padding: 0;
        background: url('../assets/img/h.jpg') no-repeat center center fixed;
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
        background: rgba(0, 0, 0, 0.5); /* Dark overlay */
        backdrop-filter: blur(2px); /* Apply blur to background */
        z-index: -1;
    }

    .container {
        max-width: 900px;
        margin: 50px auto;
        background: rgba(255, 255, 255, 0.8); /* Semi-transparent white */
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

    h1 {
        text-align: center;
        font-size: 2.5rem;
        color: #2575fc;
        margin-bottom: 30px;
    }

    .message {
        background-color: #d4edda;
        color: #155724;
        padding: 10px;
        margin-bottom: 20px;
        border: 1px solid #c3e6cb;
        border-radius: 5px;
    }

    /* Table Styling */
    table {
        width: 100%;
        border-collapse: collapse;
        margin-top: 20px;
    }

    table th, table td {
        padding: 12px;
        text-align: center;
        border-bottom: 1px solid #ddd;
    }

    /* Updated Table Header Color */
    table th {
        background-color: #2575fc; /* Buy Crops color */
        color: white;
    }

    table td {
        background-color: #f9f9f9;
    }

    table tr:nth-child(even) {
        background-color: #f1f1f1;
    }

    table tr:hover {
        background-color: #f2f2f2;
    }

    table input[type="number"] {
        width: 70px;
        padding: 6px;
        border: 1px solid #ddd;
        border-radius: 4px;
        font-size: 1rem;
    }

    /* Updated Add to Cart Button Color */
    table button {
        padding: 8px 16px;
        background-color: #2575fc; /* Buy Crops color */
        color: white;
        border: none;
        border-radius: 4px;
        cursor: pointer;
        font-size: 1rem;
        transition: all 0.3s ease-in-out;
    }

    table button:hover {
        background-color: #45a049; /* Slightly darker shade for hover effect */
        transform: translateY(-2px);
    }

    table input[type="number"]:focus {
        outline: none;
        border-color: #4CAF50; /* Matching focus color */
    }

    .no-items {
        text-align: center;
        font-size: 1.2rem;
        color: #888;
    }

    .btn {
        background-color: #4CAF50; /* Buy Crops color */
        color: white;
        padding: 10px 20px;
        border-radius: 5px;
        font-size: 1rem;
        cursor: pointer;
        border: none;
        transition: background-color 0.3s ease;
    }

    .btn:hover {
        background-color: #45a049;
    }

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
<?php include('cnav.php'); ?>

<div class="container">
    <h1><i class="fas fa-leaf"></i> Buy Crops</h1>

    <!-- Displaying success or error message -->
    <?php if (isset($message)) { ?>
        <div class="message"><?= $message ?></div>
    <?php } ?>

    <!-- Available crops table -->
    <table>
        <thead>
        <tr>
            <th>Crop Name</th>
            <th>Farmer Name</th>
            <th>Price (per KG)</th>
            <th>Available Quantity</th>
            <th>Quantity to Buy</th>
            <th>Action</th>
        </tr>
        </thead>
        <tbody>
        <?php
        // Loop through the available crops
        while ($row = mysqli_fetch_assoc($result)) {
            ?>
            <tr>
                <form method="POST" action="cbuy_crops.php">
                    <td><?= $row['Trade_crop'] ?></td>
                    <td><?= $row['farmer_name'] ?></td>
                    <td>Tk. <?= $row['costperkg'] ?></td>
                    <td><?= $row['Crop_quantity'] ?> KG</td>
                    <td>
                        <input type="number" name="quantity" min="1" max="<?= $row['Crop_quantity'] ?>" required>
                    </td>
                    <td>
                        <input type="hidden" name="item_id" value="<?= $row['trade_id'] ?>">
                        <input type="hidden" name="price" value="<?= $row['costperkg'] ?>">
                        <button type="submit" name="add_to_cart" class="btn">Add to Cart</button>
                    </td>
                </form>
            </tr>
        <?php } ?>
        </tbody>
    </table>

    <!-- If no crops available, show a message -->
    <?php if (mysqli_num_rows($result) == 0) { ?>
        <p class="no-items">No crops available at the moment.</p>
    <?php } ?>
</div>

</body>
</html>
