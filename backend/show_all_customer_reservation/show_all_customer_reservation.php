<?php
require('../my_db_cred.php');
session_start();

if (!isset($_SESSION['SESSION_EMAIL'])) {
    header('Location: ../../frontend/guest/index.php');
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $conn = MyConnection::getConnection();
    $searchTerm = $_POST["searchTerm"];
    $email = $_SESSION['SESSION_EMAIL'];

    // Pagination parameters
    $page = isset($_POST['page']) ? intval($_POST['page']) : 1;
    $itemsPerPage = 4; // Number of items to display per page
    $offset = ($page - 1) * $itemsPerPage;

    // SQL query with pagination
    $query = "SELECT * FROM Reservations
    INNER JOIN Customers ON Reservations.CustomerID = Customers.CustomerID
    INNER JOIN Cars ON Reservations.plateID = Cars.plateID
    INNER JOIN category ON category.carname = cars.carname
    WHERE Customers.Email = '$email'
    AND (Cars.carname LIKE '%$searchTerm%'
    OR category.brand LIKE '%$searchTerm%'
    OR Reservations.ReservationDate LIKE '%$searchTerm%'
    OR Reservations.PickupDate LIKE '%$searchTerm%'
    OR Reservations.ReturnDate LIKE '%$searchTerm%')
    LIMIT $offset, $itemsPerPage";

    $result = $conn->query($query);

    $data = [];

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $data[] = $row;
        }
    }

    // Get total count for pagination
    $totalCountQuery = "SELECT COUNT(*) as total FROM Reservations
    INNER JOIN Customers ON Reservations.CustomerID = Customers.CustomerID
    INNER JOIN Cars ON Reservations.plateID = Cars.plateID
    INNER JOIN category ON category.carname = cars.carname
    WHERE Customers.Email = '$email'
    AND (Cars.carname LIKE '%$searchTerm%'
    OR category.brand LIKE '%$searchTerm%'
    OR Reservations.ReservationDate LIKE '%$searchTerm%'
    OR Reservations.PickupDate LIKE '%$searchTerm%'
    OR Reservations.ReturnDate LIKE '%$searchTerm%')";

    $totalCountResult = $conn->query($totalCountQuery);
    $totalCountData = $totalCountResult->fetch_assoc();
    $totalItems = $totalCountData['total'];
    $totalPages = ceil($totalItems / $itemsPerPage);

    echo json_encode([
        'data' => $data,
        'totalPages' => $totalPages
    ]);
}
?>
