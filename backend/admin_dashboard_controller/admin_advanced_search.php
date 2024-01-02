<?php
// Include database connection code here

// Assuming you have a database connection
require('../my_db_cred.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $conn = MyConnection::getConnection();
    $searchTerm = $_POST["searchTerm"];

    $query = "SELECT * FROM Cars
    LEFT JOIN Reservations ON Cars.plateID = Reservations.plateID
    LEFT JOIN Customers ON Reservations.CustomerID = Customers.CustomerID
  left join category USING(carname)
    WHERE carname LIKE '%$searchTerm%'
       OR brand LIKE '%$searchTerm%'
       OR FirstName LIKE '%$searchTerm%'
       OR LastName LIKE '%$searchTerm%'
       OR ReservationDate LIKE '%$searchTerm%'
         OR carname LIKE '%$searchTerm%'
                 "
                
                 ;

    // Execute the query and fetch results
    // Assuming $conn is your database connection
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
