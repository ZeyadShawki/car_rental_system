<?php
// get_cities.php
require('../my_db_cred.php');
$conn = MyConnection::getConnection();

$selectedCountry = $_GET['country'];

$query = "SELECT DISTINCT city, OfficeID FROM offices WHERE country = '$selectedCountry'";
$result = $conn->query($query);

$cities = array();
while ($row = $result->fetch_assoc()) {
    
    $cities[] = array('id' => $row['OfficeID'], 'name' => $row['city']);
}

echo json_encode($cities);
?>
