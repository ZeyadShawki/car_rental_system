<?php
$servername = 'localhost';
$username = 'root';
$password = '';
$dbname = 'car_rental_system';
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

header("Access-Control-Allow-Origin: *");

$sql="SELECT
c.plateID,
c.carname,
cs.brand,
c.Year AS carYear,
c.imageUrl AS carImageUrl,
c.rentvalue AS carRentValue,
CASE WHEN 
    r.PickupDate <= ? AND r.ReturnDate >= ? THEN 'rented'
ELSE c.carStatus
END AS CarStatusOnSpecificDay
FROM
Cars c
LEFT JOIN Reservations r ON c.plateID = r.plateID AND ? BETWEEN r.PickupDate AND r.ReturnDate
LEFT JOIN category cs ON c.carname = cs.carname";



try {
    $startDate = $_POST['start_date'];

    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sss", $startDate, $startDate, $startDate);
    $stmt->execute();

    $result = $stmt->get_result();

    // Fetch the results as an associative array
    $data = array();
    while ($row = $result->fetch_assoc()) {
        $data[] = $row;
    }

    // Return the results as JSON
    echo json_encode($data);
} catch (Exception $e) {
    echo "Error: " . $e->getMessage();
}

$conn->close();
?>
