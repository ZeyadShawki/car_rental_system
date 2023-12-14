<?php
require('../my_db_cred.php');
// Create connection
$conn =  MyConnection::getConnection();

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if the request method is POST
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Get country and city from the POST request
    $country = $_POST["Country"];
    $city = $_POST["City"];

    // Prepare and execute the SQL statement to insert data into the "office" table
    $sql = "INSERT INTO offices (country, city) VALUES ('$country', '$city')";

    if ($conn->query($sql) === TRUE) {
        echo "Record inserted successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
} else {
    echo "Invalid request method";
}

// Close the database connection
$conn->close();
?>
