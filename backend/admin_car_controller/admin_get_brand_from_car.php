<?php
require('../my_db_cred.php');
$conn = MyConnection::getConnection();

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $selectedBrand = $_GET['brand'];

    // Use prepared statements to prevent SQL injection
    $carNamesSql = "SELECT DISTINCT carname FROM category WHERE brand = ?";

    // Prepare the statement
    $carNamesStmt = $conn->prepare($carNamesSql);

    if ($carNamesStmt) {
        // Bind the parameter for car names statement
        $carNamesStmt->bind_param('s', $selectedBrand);

        // Execute the car names query
        $carNamesStmt->execute();

        // Get the result for car names
        $carNamesResult = $carNamesStmt->get_result();

        // Fetch the car names data
        $carNames = array();
        while ($row = $carNamesResult->fetch_assoc()) {
            $carNames[] = $row['carname'];
        }

        // Return the car names as JSON
        echo json_encode(['carNames' => $carNames]);

        // Close the statement
        $carNamesStmt->close();
    } else {
        // Error in preparing the car names statement
        echo json_encode(['status' => 'error', 'message' => 'Error preparing car names statement']);
    }
} else {
    // If the request method is not GET, return an error status
    echo json_encode(['status' => 'error', 'message' => 'Invalid request']);
}

// Close the database connection
$conn->close();
?>
