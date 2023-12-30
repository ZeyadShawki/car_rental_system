<?php
require('../my_db_cred.php');
$conn = MyConnection::getConnection();

// Include your database connection file

if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['brand'])) {
    // Validate and sanitize input
    $selectedBrand = mysqli_real_escape_string($conn, $_GET['brand']);

    // Fetch car names for the selected brand
    $query = "SELECT DISTINCT carName FROM `category` WHERE brand = '$selectedBrand'";
    $result = mysqli_query($conn, $query);

    if (!$result) {
        // Handle errors
        $errors = ['database' => 'Error: ' . mysqli_error($conn)];
        echo json_encode($errors);
        exit();
    }

    // Fetch data into an associative array
    $carNames = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $carNames[] = $row['carName'];
    }

    // Close database connection
    mysqli_close($conn);

    // Return JSON response
    echo json_encode($carNames);
} else {
    // Invalid request method or missing parameters
    http_response_code(400);
    echo json_encode(['error' => 'Invalid request']);
}
?>
