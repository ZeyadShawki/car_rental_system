<?php
require('../my_db_cred.php');
$conn = MyConnection::getConnection();

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $officeID = $_POST["OfficeCity"]; // Assuming OfficeCity is the ID of the selected office
    $carName = $_POST["CarName"];
    // $brand = $_POST["Brand"];
    $year = $_POST["Year"];
    $rentValue = $_POST["rentValue"]; 
    $imageUrl = $_POST["ImageUrl"];
    $carStatus = $_POST["carStatus"];

    
     $query = "INSERT INTO cars (OfficeID, carname,  Year, imageUrl, carStatus,rentvalue) VALUES ('$officeID', '$carName',  '$year', '$imageUrl', '$carStatus','$rentValue')";


    // $query = "INSERT INTO cars (OfficeID, carname, brand, Year, imageUrl, carStatus,rentvalue) VALUES ('$officeID', '$carName', '$brand', '$year', '$imageUrl', '$carStatus','$rentValue')";

    if ($conn->query($query) === TRUE) {
        echo "Record inserted successfully";
    } else {
        echo "Error: " . $query . "<br>" . $conn->error;
    }
} else {
    echo "Invalid request method";
}

$conn->close();
?>
