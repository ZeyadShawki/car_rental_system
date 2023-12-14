<?php
require('../my_db_cred.php');
$conn = MyConnection::getConnection();

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Get carId and new OfficeID from the POST data
    $carId = $_POST['carId'];
    $newOfficeID = filter_var($_POST['OfficeCity'], FILTER_VALIDATE_INT);

    // Validate and sanitize other form data
    $brand = filter_var($_POST['Brand'], FILTER_SANITIZE_STRING);
    $carName = filter_var($_POST['CarName'], FILTER_SANITIZE_STRING);
    $year = filter_var($_POST['Year'], FILTER_VALIDATE_INT);
    $rentValue = filter_var($_POST['rentValue'], FILTER_VALIDATE_FLOAT);
    $imageUrl = filter_var($_POST['ImageUrl'], FILTER_SANITIZE_URL);
    $carStatus =$_POST['carStatus'];

// Update the car in the database
    $updateSql = "UPDATE Cars SET OfficeID=?, brand=?, carname=?, Year=?, rentvalue=?, imageUrl=?, carStatus=? WHERE plateID=?";
    $updateStmt = $conn->prepare($updateSql);

    if ($updateStmt) {
$updateStmt->bind_param('issidssi', $newOfficeID, $brand, $carName, $year, $rentValue, $imageUrl, $carStatus, $carId);
        $updateStmt->execute();

        // Check if the update was successful
        if ($updateStmt->affected_rows > 0) {
            echo json_encode(['status' => 'success', 'message' => 'Car updated successfully']);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Failed to update car']);
        }

        $updateStmt->close();
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Error preparing update statement']);
    }
} else {
    // If the request method is not POST, return an error status
    echo json_encode(['status' => 'error', 'message' => 'Invalid request']);
}

// Close the database connection
$conn->close();
?>
