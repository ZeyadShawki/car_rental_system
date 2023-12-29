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

    $email=$_SESSION[ 'SESSION_EMAIL' ];
    $new_phone_number = $_POST[ 'newPhoneNumber' ];
    
    $result = mysqli_query( $conn, "UPDATE Customers
                                    SET PhoneNumber =  $new_phone_number
                                    WHERE Email = $email ;");
    
}

if(isset( $_GET[ 'get_user_data' ] ) ){

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
}

if (isset($_POST['edit_customer_profile'])) {
    $conn = MyConnection::getConnection();

    // Check connection
    if ($conn->connect_error) {
        die('Connection failed: ' . $conn->connect_error);
    }

    // Retrieve form data
    $email = $_SESSION['SESSION_EMAIL'];
    $firstName = mysqli_real_escape_string($conn, $_POST['firstName']);
    $lastName = mysqli_real_escape_string($conn, $_POST['lastName']);
    $phoneNumber = mysqli_real_escape_string($conn, $_POST['phoneNumber']);
    $bdate = mysqli_real_escape_string($conn, $_POST['bdate']);

    
    // Validate required fields
    if (empty($firstName) || empty($lastName) || empty($phoneNumber) || empty($bdate)) {
        echo json_encode(['success' => false, 'message' => 'All fields are required']);
        exit();
    }

    // Update customer profile
    $result = mysqli_query($conn, "UPDATE Customers
                                    SET FirstName = '$firstName',
                                        LastName = '$lastName',
                                        PhoneNumber = '$phoneNumber',
                                        bdate = '$bdate'
                                    WHERE Email = '$email'");

    if ($result) {
        echo json_encode(['success' => true, 'message' => 'Profile updated successfully']);
    } else {
        echo json_encode(['success' => false, 'message' => 'Error updating profile']);
    }
}
?>