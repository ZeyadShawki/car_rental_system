<?php
require('../my_db_cred.php');
$conn = MyConnection::getConnection();

$query = "SELECT c.plateID, c.carname, ct.brand, c.Year, c.imageUrl, c.carStatus
FROM cars c
JOIN category ct ON c.carname = ct.carname";

$result = $conn->query($query);

$cars = array();
while ($row = $result->fetch_assoc()) {
    $cars[] = array(
        'id' => $row['plateID'],
        'carname' => $row['carname'],
         'brand' => $row['brand'],
        'year' => $row['Year'],
        'imageUrl' => $row['imageUrl'],
        'carStatus' => $row['carStatus']
    );
}

echo json_encode($cars);
?>
