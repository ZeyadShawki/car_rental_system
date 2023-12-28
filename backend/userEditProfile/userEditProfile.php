<?php 
session_start();
if ( !isset( $_SESSION[ 'SESSION_EMAIL' ] ) ) {
    header( 'Location: ../../frontend/guest/index.php' );  
} 
require( __DIR__ . '/../my_db_cred.php' );

if ( isset( $_POST[ 'changePhoneNumber' ] ) ) {
    $conn = MyConnection::getConnection();

    // Check connection
    if ( $conn->connect_error ) {
        die( 'Connection failed: ' . $conn->connect_error );
    }
    echo 'hiiii';

    $email=$_SESSION[ 'SESSION_EMAIL' ];
    $new_phone_number = $_POST[ 'newPhoneNumber' ];
    
    $result = mysqli_query( $conn, "UPDATE Customers
                                    SET PhoneNumber =  $new_phone_number
                                    WHERE Email = $email ;");
    
}

$conn = MyConnection::getConnection();

// Check connection
if ($conn->connect_error) {
    die('Connection failed: ' . $conn->connect_error);
}

// Get the session email
$email = $_SESSION['SESSION_EMAIL'];

// Query to get customer data based on session email
$query = "SELECT * FROM Customers WHERE Email = '$email'";
$result = mysqli_query($conn, $query);

// Fetch the data and return as JSON
$customerData = mysqli_fetch_assoc($result);

echo json_encode($customerData);

?>