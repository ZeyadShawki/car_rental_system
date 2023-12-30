<?php
require('../my_db_cred.php');
$conn = MyConnection::getConnection();

// Include your database connection file

// Fetch car categories
$query = "SELECT * FROM `category`";
$result = mysqli_query($conn, $query);

if (!$result) {
    // Handle errors
    $errors = ['database' => 'Error: ' . mysqli_error($conn)];
    echo json_encode($errors);
    exit();
}

// Fetch data into an associative array
$categories = [];
while ($row = mysqli_fetch_assoc($result)) {
    $categories[] = $row;
}

// Close database connection
mysqli_close($conn);

// Return JSON response
echo json_encode($categories);


?>
