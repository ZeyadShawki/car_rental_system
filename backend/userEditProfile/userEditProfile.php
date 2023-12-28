<?php 
session_start();
if ( !isset( $_SESSION[ 'SESSION_EMAIL' ] ) ) {
    header( 'Location: ../../frontend/guest/index.php' );  
} 

if ( isset( $_POST[ 'changePhoneNumber' ] ) ) {
    require( '../my_db_cred.php' );
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



?>