<?php
require('../my_db_cred.php');
$conn = MyConnection::getConnection();

// Include your database connection file

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validate and sanitize input
    $brand = mysqli_real_escape_string($conn, $_POST['brand']);
    $carName = mysqli_real_escape_string($conn, $_POST['carName']);

    // Check if the entry already exists
    $checkQuery = "SELECT * FROM `category` WHERE carname = '$carName'";
    $checkResult = mysqli_query($conn, $checkQuery);

    if (mysqli_num_rows($checkResult) > 0) {
        // Entry already exists, handle accordingly (e.g., return an error response)
        echo 'false';
    } else {
        // Perform the database query to insert the new entry
        $query = "INSERT INTO `category` (brand, carname) VALUES ('$brand', '$carName')";
        $result = mysqli_query($conn, $query);

        if ($result) {
            echo json_encode(['success' => 'Record inserted successfully']);
        } else {
            // Handle errors
            $errors = ['database' => 'Error: ' . mysqli_error($conn)];
            echo json_encode($errors);
        }
    }

    // Close database connection
    mysqli_close($conn);
} else {
    // Invalid request method
    http_response_code(400);
    echo json_encode(['error' => 'Invalid request method']);
}


?>
