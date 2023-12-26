<?php
//require('../my_db_cred.php');


$servername = 'localhost';
$username = 'root';
$password = '';
$dbname = 'car_rental_system';
$conn = new mysqli( $servername, $username, $password, $dbname );
        
    
    // Create connection


// Modify the SQL query based on your database structure
$sql = "SELECT
            r.ReservationID,
            c.CustomerID,
            c.FirstName AS CustomerFirstName,
            c.LastName AS CustomerLastName,
            c.Email AS CustomerEmail,
            c.PhoneNumber AS CustomerPhoneNumber,
            ca.plateID,
            ca.carname,
            ca.brand,
            ca.Year AS carYear,
            ca.imageUrl AS carImageUrl,
            ca.rentvalue AS carRentValue,
            r.ReservationDate,
            r.PickupDate,
            r.ReturnDate
        FROM
            Reservations r
            INNER JOIN Customers c ON r.CustomerID = c.CustomerID
            INNER JOIN Cars ca ON r.plateID = ca.plateID
        WHERE
            r.PickupDate >= :start_date AND r.ReturnDate <= :end_date";

try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    // $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':start_date', $_GET['start_date']);
    $stmt->bindParam(':end_date', $_GET['end_date']);
    $stmt->execute();

    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Return the results as JSON
    echo json_encode($result);
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}

$conn = null;
?>
