<?php
require('../my_db_cred.php');
$conn = MyConnection::getConnection();

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $officeID = $_POST["OfficeCity"]; // Assuming OfficeCity is the ID of the selected office
    $carName = $_POST["carName"];
    $year = $_POST["Year"];
    $rentValue = $_POST["rentValue"];
    $carStatus = $_POST["carStatus"];

    // Handle image file upload
    $uploadDir = '../../backend/uploaded_images/';
    $uploadFile = $uploadDir . basename($_FILES['image']['name']);


    if (move_uploaded_file($_FILES['image']['tmp_name'], $uploadFile)) {
        $imageUrl = 'http://localhost/final_db_admin/backend/uploaded_images/' . basename($_FILES['image']['name']);

        $query = "INSERT INTO cars (OfficeID, carname, Year, imageUrl, carStatus, rentvalue) VALUES ('$officeID', '$carName', '$year', '$imageUrl', '$carStatus', '$rentValue')";

        if ($conn->query($query) === TRUE) {
            echo "Record inserted successfully";
        } else {
            echo "Error: " . $query . "<br>" . $conn->error;
        }
    } else {
        echo "Error moving the file";
    }
} else {
    echo "Invalid request method";
}

$conn->close();
?>
