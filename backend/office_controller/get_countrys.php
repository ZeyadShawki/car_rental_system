<?php
// get_countries.php
require('../my_db_cred.php');
$conn = MyConnection::getConnection();

$query = "SELECT DISTINCT country FROM offices";
$result = $conn->query($query);

$countries = array();
while ($row = $result->fetch_assoc()) {
    $countries[] = $row['country'];
}

echo json_encode($countries);
?>
