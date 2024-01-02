<?php
session_start();
if ( isset( $_SESSION[ 'SESSION_EMAIL' ] ) ) {
    header( 'Location: ../../frontend/user_home/user_home_html.php' );
    // to test this case, make it if ( true )
} else if ( isset( $_SESSION[ 'SESSION_ADMIN' ] ) ) {
    header( 'Location: ../../frontend/admin_dashboard/admin_dashboard.html' );
    // zeyad
}


if ( isset( $_POST[ 'register' ] ) ) {
    require( '../my_db_cred.php' );
    $conn = MyConnection::getConnection();
    // Check connection
    if ( $conn->connect_error ) {
        die( 'Connection failed: ' . $conn->connect_error );
    }
    // Retrieve POST data
    $FirstName = $_POST[ 'FirstName' ];
    $LastName = $_POST[ 'LastName' ];
    $Email = $_POST[ 'Email' ];
    $ContactNumber = $_POST[ 'ContactNumber' ];
    $sex = $_POST[ 'sex' ];
    $inputDate = $_POST[ 'inputDate' ];
    $pass = md5($_POST[ 'pass' ]);

    // Hash the password for security
    $hashed_password = $pass;

    try {
        // Prepare and bind SQL statement
        $stmt = $conn->prepare( 'INSERT INTO Customers (FirstName, LastName, Email, PhoneNumber, user_password, sex, bdate) VALUES (?, ?, ?, ?, ?, ?, ?)' );
        $stmt->bind_param( 'sssssss', $FirstName, $LastName, $Email, $ContactNumber, $hashed_password, $sex, $inputDate );

        // Execute the statement
        if ( $stmt->execute() === TRUE ) {
            $_SESSION[ 'SESSION_EMAIL' ] = $Email;
            echo 'success';

        
        } else {
            echo 'sqlfailure';
        }

        $stmt->close();
    } catch ( mysqli_sql_exception $e ) {
        // Check if the exception is due to a duplicate entry
        if ( $e->getCode() == 1062 ) {
            echo 'email';
        } else {
            echo 'sqlfailure';
        }
    }

    $conn->close();
}
?>
