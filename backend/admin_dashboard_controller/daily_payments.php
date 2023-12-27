<?php
//require('../my_db_cred.php');

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

// Modify the SQL query based on your database structure
$sql="SELECT DATE(PaymentDate) AS PaymentDay, SUM(Amount) AS TotalDailyPayment FROM Payments WHERE PaymentDate BETWEEN ? AND ? GROUP BY(PaymentDate)";





try {
    $startDate = $_POST['start_date'];
    $endDate = $_POST['end_date'];

    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ss", $startDate, $endDate);
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
