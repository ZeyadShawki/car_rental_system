<?php
require('../my_db_cred.php');
$conn = MyConnection::getConnection();

// Check if the carId parameter is set
if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['carId'])) {
    $carId = $_POST['carId'];

    // Use prepared statements to avoid SQL injection
    $sql = "DELETE FROM cars WHERE plateID = ?";
    
    // Prepare the statement
    $stmt = $conn->prepare($sql);

    if ($stmt) {
        // Bind the parameter
        $stmt->bind_param("i", $carId);

        // Execute the query
        $result = $stmt->execute();

        if ($result) {
            // Successful deletion
            echo json_encode(['status' => 'success']);
        } else {
            // Error in execution
            echo json_encode(['status' => 'error', 'message' => 'Error executing query']);
        }

        // Close the statement
        $stmt->close();
    } else {
        // Error in preparing the statement
        echo json_encode(['status' => 'error', 'message' => 'Error preparing statement']);
    }
} else {
    // If carId parameter is not set, return an error status
    echo json_encode(['status' => 'error', 'message' => 'Invalid request']);
}

// Close the database connection
$conn->close();
?>
