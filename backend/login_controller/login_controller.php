<?php
session_start();
if ( isset( $_SESSION[ 'SESSION_EMAIL' ] ) ) {
    header( 'Location: ../../frontend/user_home/user_home_html.php' );
    // to test this case, make it if ( true )
} else if ( isset( $_SESSION[ 'SESSION_ADMIN' ] ) ) {
    header( 'Location: ../../frontend/admin_dashboard/admin_dashboard.html' );
    // zeyad
}
require( __DIR__ . '/../my_db_cred.php' );
$conn = MyConnection::getConnection();

function authenticateUser( $email, $password ) {
    global $conn;

    // Sanitize user inputs
    $email = mysqli_real_escape_string( $conn, $email );
    // $password = mysqli_real_escape_string( $conn, $password );

    // Prepare and bind SQL statement for customers table
    $stmt = $conn->prepare( 'SELECT * FROM customers WHERE Email = ?' );
    $stmt->bind_param( 's', $email );
    $stmt->execute();

    // Get result
    $result = $stmt->get_result();

    // Check if user exists and password is correct
    if ( $result->num_rows > 0 ) {
        $row = $result->fetch_assoc();
        $hashedPasswordFromDB = $row[ 'user_password' ];

        // Verify password
        if ( md5($password) === $hashedPasswordFromDB ) {

            return array( 'is_admin' => false, 'user_data' => $row );
        } else {
            // echo 'Verification failed';
        }
    }

    // Prepare and bind SQL statement for Admin table
    $stmt = $conn->prepare( 'SELECT * FROM Admins WHERE Email = ?' );
    $stmt->bind_param( 's', $email );
    $stmt->execute();

    // Get result
    $result = $stmt->get_result();

    // Check if admin exists and password is correct
    if ( $result->num_rows > 0 ) {
        $row = $result->fetch_assoc();
        $hashedPasswordFromDB = $row[ 'user_password' ];

        // Verify password
        if ( $password === $hashedPasswordFromDB ) {
            return array( 'is_admin' => true, 'user_data' => $row );
        } else {
            // echo 'Verification failed for Admin';
        }
    }

    return false;
    // Authentication failed
}

if ( $_SERVER[ 'REQUEST_METHOD' ] === 'POST' ) {
    $email = $_POST[ 'email' ];
    $password = $_POST[ 'password' ];

    $authResult = authenticateUser( $email, $password );

    if ( $authResult ) {

        if ( $authResult[ 'is_admin' ] ) {

            $_SESSION[ 'SESSION_ADMIN' ] = $email;

            echo json_encode( array( 'status' => 'success', 'isAdmin' => true, 'userData' => $authResult[ 'user_data' ] ) );

        } else {
            $_SESSION[ 'SESSION_EMAIL' ] = $email;
            echo json_encode( array( 'status' => 'success', 'isAdmin' => false, 'userData' => $authResult[ 'user_data' ] ) );
        }

    } else {
        echo json_encode( array( 'status' => 'failure', 'message' => 'Invalid email or password' ) );
    }
}
?>
