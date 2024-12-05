<?php
include('csession.php');

// Check if the form is submitted
if (isset($_POST['submit_listing'])) {
    $item_name = mysqli_real_escape_string($conn, $_POST['item_name']);
    $item_description = mysqli_real_escape_string($conn, $_POST['item_description']);
    $rental_price = mysqli_real_escape_string($conn, $_POST['rental_price']);
    $rental_period = mysqli_real_escape_string($conn, $_POST['rental_period']);

    // Handle Image Upload
    if (isset($_FILES['item_image']) && $_FILES['item_image']['error'] == 0) {
        $image = $_FILES['item_image'];
        $image_name = $image['name'];
        $image_tmp = $image['tmp_name'];
        $image_size = $image['size'];
        $image_ext = pathinfo($image_name, PATHINFO_EXTENSION);

        // Validate image type
        $valid_extensions = ['jpg', 'jpeg', 'png', 'gif'];
        if (in_array(strtolower($image_ext), $valid_extensions)) {
            if ($image_size < 5000000) { // 5MB max
                $image_new_name = uniqid('item_', true) . '.' . $image_ext;
                $image_path = 'C:/xampp/htdocs/agriculture-portal-main/assets/img' . $image_new_name;

                // Move the uploaded image to the server
                if (move_uploaded_file($image_tmp, $image_path)) {
                    // Insert item listing into database
                    $query = "INSERT INTO rental_items (item_name, description, rental_price, rental_period, item_image) 
                              VALUES ('$item_name', '$description', '$rental_price', '$rental_period', '$image_new_name')";

                    if (mysqli_query($conn, $query)) {
                        echo "Item successfully listed for rent!";
                    } else {
                        echo "Error: " . mysqli_error($conn);
                    }
                } else {
                    echo "Failed to upload image.";
                }
            } else {
                echo "Image size exceeds 5MB limit.";
            }
        } else {
            echo "Invalid image type. Only JPG, PNG, and GIF are allowed.";
        }
    } else {
        echo "Please upload an image.";
    }
}
?>