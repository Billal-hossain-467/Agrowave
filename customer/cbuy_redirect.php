<?php
session_start();
require('../sql.php'); // Includes SQL connection script

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Sanitize and validate inputs to prevent SQL injection
    $crop = mysqli_real_escape_string($conn, $_POST['crops']);
    $quantity = (int) $_POST['quantity'];
    $tradeID = (int) $_POST['tradeid'];
    $price = (float) $_POST['price'];

    // Validate required fields
    if (empty($crop) || $quantity <= 0 || $price <= 0 || $tradeID <= 0) {
        echo '<script>alert("Invalid input data! Please try again."); window.location.href="cbuy_crops.php";</script>';
        exit();
    }

    // Check if the crop already exists in the cart table
    $check_query = "SELECT * FROM `cart` WHERE `cropname` = '$crop'";
    $check_result = mysqli_query($conn, $check_query);

    if (mysqli_num_rows($check_result) > 0) {
        // Crop already exists, update quantity and price
        $update_query = "UPDATE `cart` 
                         SET `quantity` = `quantity` + $quantity, `price` = `price` + $price 
                         WHERE `cropname` = '$crop'";
        $update_result = mysqli_query($conn, $update_query);

        if (!$update_result) {
            echo '<script>alert("Failed to update the item in the database cart! Please try again."); window.location.href="cbuy_crops.php";</script>';
            exit();
        }
    } else {
        // Crop does not exist, insert as a new item
        $insert_query = "INSERT INTO `cart` (`cropname`, `quantity`, `price`) 
                         VALUES ('$crop', '$quantity', '$price')";
        $insert_result = mysqli_query($conn, $insert_query);

        if (!$insert_result) {
            echo '<script>alert("Failed to add the item to the database cart! Please try again."); window.location.href="cbuy_crops.php";</script>';
            exit();
        }
    }

    // Add item to the session cart
    if (isset($_SESSION["shopping_cart"])) {
        $item_array_id = array_column($_SESSION["shopping_cart"], "item_id");

        // Check if the item is already in the session cart
        if (!in_array($tradeID, $item_array_id)) {
            $item_array = array(
                'item_id'       => $tradeID,
                'item_name'     => $crop,
                'item_price'    => $price,
                'item_quantity' => $quantity
            );
            $_SESSION["shopping_cart"][] = $item_array; // Add the new item to the session cart
        } else {
            echo '<script>alert("Item Already Added to the session cart!"); window.location.href="cbuy_crops.php";</script>';
            exit();
        }
    } else {
        // Create the shopping cart session if it doesn't exist
        $item_array = array(
            'item_id'       => $tradeID,
            'item_name'     => $crop,
            'item_price'    => $price,
            'item_quantity' => $quantity
        );
        $_SESSION["shopping_cart"][0] = $item_array; // Add the first item to the session cart
    }

    // Redirect back to the crops page
    header("Location: cbuy_crops.php?action=add&id=$tradeID");
    exit();
} else {
    // If accessed without POST, redirect to the crops page
    header("Location: cbuy_crops.php");
    exit();
}
?>