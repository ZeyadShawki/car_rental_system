<?php

function updateCarStatus()
{
    require(__DIR__ . '/../my_db_cred.php');
    $conn = MyConnection::getConnection();
    $currentDate = date('Y-m-d');

    $sql = "UPDATE Cars 
            JOIN Reservations ON Cars.plateID = Reservations.plateID 
            SET Cars.carStatus = 'rented' 
            WHERE Reservations.PickupDate = ? AND Cars.carStatus != 'out of service'";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $currentDate);
    $stmt->execute();

    $sql = "UPDATE Cars 
            JOIN Reservations ON Cars.plateID = Reservations.plateID 
            SET Cars.carStatus = 'active' 
            WHERE Reservations.ReturnDate = ? AND Cars.carStatus != 'out of service'";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $currentDate);
    $stmt->execute();
}
// Call the function to update car status
updateCarStatus();
echo "Car statuses updated successfully.";
// Close connection
$conn->close();
?>