<?php
include('fsession.php'); // Ensure this connects to the database

if (isset($_GET['district'])) {
    $district = $_GET['district'];

    // Log incoming district for debugging
    error_log("Selected District: " . $district);

    $query = "SELECT DISTINCT Upazilla_name FROM crop_recommendation WHERE District_name = ?";
    $stmt = $conn->prepare($query);
    if (!$stmt) {
        error_log("Query preparation failed: " . $conn->error);
        echo json_encode(["error" => "Failed to prepare query"]);
        exit;
    }

    $stmt->bind_param("s", $district);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result) {
        $upazillas = [];
        while ($row = $result->fetch_assoc()) {
            $upazillas[] = $row['Upazilla_name'];
        }
        echo json_encode($upazillas);
    } else {
        // Log any errors during query execution
        error_log("Query execution failed: " . $stmt->error);
        echo json_encode(["error" => "No upazillas found"]);
    }
} else {
    echo json_encode(["error" => "District not provided"]);
}
?>