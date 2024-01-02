<?php
require('../my_db_cred.php');
session_start();

if (!isset($_SESSION['SESSION_EMAIL'])) {
    header('Location: ../../frontend/guest/index.php');
}
$_SESSION['enterpage'] = true;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $conn = MyConnection::getConnection();
    $searchTerm = $_POST["searchTerm"];
    $email = $_SESSION['SESSION_EMAIL'];
   
    //pagination hyper parameter 
    $itemsPerPage = 6; // Number of items(rows) to display per page (offset)

    // Check if total pages is stored in session
    if (($_SESSION['enterpage']) == true ) {
        // Calculate total count for pagination
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
        $totalPages = ceil($totalItems / $itemsPerPage); // ceil 3shan lw a5r page fyha items 22l mn items ber page ana still mhtag sfha lyhom
        // Store total pages in session
        $_SESSION['TOTAL_PAGES'] = $totalPages;
        $_SESSION['enterpage'] = false;

    } else {
        // Retrieve total pages from session
        $totalPages = $_SESSION['TOTAL_PAGES'];
    }

    // Pagination parameters    
    // int val btrg3 integer value
    $page = isset($_POST['page']) ? intval($_POST['page']) : 1;
    $startRow = ($page - 1) * $itemsPerPage;  // -1 (because data in database is zero indexe)

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
    LIMIT $startRow, $itemsPerPage";

    $result = $conn->query($query);

    $data = [];
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $data[] = $row;
        }
    }

    echo json_encode([
        'data' => $data,
        'totalPages' => $totalPages
    ]);
}
?>
