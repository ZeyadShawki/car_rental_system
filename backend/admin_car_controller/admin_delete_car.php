<?php
require('../my_db_cred.php');
$conn = MyConnection::getConnection();

// Check if the carId parameter is set
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['carId'])) {
    $carId = $_POST['carId'];

    // Use prepared statements to avoid SQL injection
    $deleteReservationsSql = 'DELETE FROM Reservations WHERE plateID = ?';
    $deleteReservationsStmt = $conn->prepare($deleteReservationsSql);

    // Check if there are reservations for the car
    if ($deleteReservationsStmt) {
        $deleteReservationsStmt->bind_param('i', $carId);
        $deleteReservationsResult = $deleteReservationsStmt->execute();

        // Close the statement
        $deleteReservationsStmt->close();

        if (!$deleteReservationsResult) {
            // Error in deleting reservations
            echo json_encode(['status' => 'error', 'message' => 'Error deleting reservations']);
            exit;
        }
    } else {
        // Error in preparing the delete reservations statement
        echo json_encode(['status' => 'error', 'message' => 'Error preparing delete reservations statement']);
        exit;
    }

    // Use prepared statements to avoid SQL injection
    $deleteCarSql = 'DELETE FROM Cars WHERE plateID = ?';
    $deleteCarStmt = $conn->prepare($deleteCarSql);

    // Check if there are customer reservations for the car
    if ($deleteCarStmt) {
        $deleteCarStmt->bind_param('i', $carId);
        $deleteCarResult = $deleteCarStmt->execute();

        // Close the statement
        $deleteCarStmt->close();

        if ($deleteCarResult) {
            // Successful deletion
            echo json_encode(['status' => 'success']);
        } else {
            // Error in deleting the car
            echo json_encode(['status' => 'error', 'message' => 'Error deleting the car']);
        }
    } else {
        // Error in preparing the delete car statement
        echo json_encode(['status' => 'error', 'message' => 'Error preparing delete car statement']);
    }

} else {
    // If carId parameter is not set, return an error status
    echo json_encode(['status' => 'error', 'message' => 'Invalid request']);
}

// Close the database connection
$conn->close();
?>
