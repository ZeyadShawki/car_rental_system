<?php
$servername = 'localhost';
$username = 'root';
$password = '';
$dbname = 'car_rental_system';
$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
header("Access-Control-Allow-Origin: *");
$sql = "SELECT
            r.ReservationID,
            c.CustomerID,
            c.FirstName AS CustomerFirstName,
            c.LastName AS CustomerLastName,
            c.Email AS CustomerEmail,
            c.PhoneNumber AS CustomerPhoneNumber,
            c.user_password AS CustomerPassword,
            c.sex AS CustomerSex,
            c.bdate AS CustomerBirthDate,
            c.amount AS CustomerAmount,
            ca.plateID,
            ca.carname,
            cs.brand,
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
            inner join category cs on cs.carname=ca.carname
        WHERE
            c.CustomerID = ?";
try {
    $customerId = $_POST['customer_id'];

    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $customerId);
    $stmt->execute();


    $result = $stmt->get_result();

    $data = array();
    while ($row = $result->fetch_assoc()) {
        $data[] = $row;
    }

    echo json_encode($data);
} catch (Exception $e) {
    echo "Error: " . $e->getMessage();
}

$conn->close();
?>