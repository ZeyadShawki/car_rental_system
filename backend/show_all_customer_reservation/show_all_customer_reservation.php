<?php
require('../my_db_cred.php');
session_start(); 
if (!isset($_SESSION['SESSION_EMAIL'])) {
    header('Location: ../../frontend/guest/index.php');  
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $conn = MyConnection::getConnection();
    $searchTerm = $_POST["searchTerm"];
    $email = $_SESSION['SESSION_EMAIL']; // Replace with the correct session variable

    $query = "SELECT * FROM Reservations
              INNER JOIN Customers ON Reservations.CustomerID = Customers.CustomerID
              INNER JOIN Cars ON Reservations.plateID = Cars.plateID
              INNER JOIN category ON category.carname = cars.carname

              WHERE Customers.Email = '$email'
                 AND (Cars.carname LIKE '%$searchTerm%'
                 OR category.brand LIKE '%$searchTerm%'
                 OR Customers.FirstName LIKE '%$searchTerm%'
                 OR Customers.LastName LIKE '%$searchTerm%'
                 OR Reservations.ReservationDate = '$searchTerm')
                 ";

    $result = $conn->query($query);

    $data = [];

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $data[] = $row;
        }
    }

    echo json_encode($data);
}
?>
