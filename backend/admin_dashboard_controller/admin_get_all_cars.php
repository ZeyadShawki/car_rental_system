<?php
require('../my_db_cred.php');
$conn = MyConnection::getConnection();

$query = "SELECT * FROM cars";
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
