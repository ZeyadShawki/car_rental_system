<?php
require( '../my_db_cred.php' );
$conn = MyConnection::getConnection();

if ( $_SERVER[ 'REQUEST_METHOD' ] === 'POST' ) {
    // Get carId and new OfficeID from the POST data
    $carId = $_POST[ 'carId' ];
    $newOfficeID = $_POST[ 'OfficeCity' ];

    // Validate and sanitize other form data
    $brand = $_POST[ 'brand' ];
    $carName = $_POST[ 'CarName' ];
    $year = $_POST[ 'Year' ];
    $rentValue = $_POST[ 'rentValue' ];
    $carStatus = $_POST[ 'carStatus' ];

    // Handle image upload
    $imageUrl = '';
    // Initialize imageUrl variable
    if ( !empty( $_FILES[ 'image' ][ 'name' ] ) ) {
        if ( $_FILES[ 'image' ][ 'error' ] === UPLOAD_ERR_OK ) {
            // File uploaded successfully
            $uploadDir = '../uploaded_images/';
            // Change this to your desired folder
            $uploadFile = $uploadDir . basename( $_FILES[ 'image' ][ 'name' ] );
            $imageUrl = 'http://localhost/final_db_admin/backend/uploaded_images/' . basename( $_FILES[ 'image' ][ 'name' ] );
            // Set imageUrl to the path of the uploaded file

            if ( move_uploaded_file( $_FILES[ 'image' ][ 'tmp_name' ], $uploadFile ) ) {
                // File moved successfully
            } else {
                // Failed to move file
                echo json_encode( [ 'status' => 'error', 'message' => 'Failed to move uploaded image' ] );
                exit;
            }
        } else {
            // Error in file upload
            echo json_encode( [ 'status' => 'error', 'message' => 'Error in file upload' ] );
            exit;
        }
    } else {
        // No file selected for upload, handle accordingly

        $selectSql = 'SELECT imageUrl FROM Cars WHERE plateID=?';
        $selectStmt = $conn->prepare( $selectSql );

        $selectStmt->bind_param( 'i', $carId );
        $selectStmt->execute();
        $selectStmt->bind_result( $existingImageUrl );
        $selectStmt->fetch();
 $selectStmt->close();
        // Check if the existing image URL is available
        $imageUrl = $existingImageUrl;

    }

    // Update the car in the database
    $updateSql = 'UPDATE Cars SET OfficeID=?, carname=?, Year=?, rentvalue=?, imageUrl=?, carStatus=? WHERE plateID=?';
    $updateStmt = $conn->prepare( $updateSql );

    if ( $updateStmt ) {

        $updateStmt->bind_param( 'isidssi', $newOfficeID, $carName, $year, $rentValue, $imageUrl, $carStatus, $carId );
        $updateStmt->execute();

        // Check if the update was successful
        if ( $updateStmt->affected_rows > 0 ) {
            echo json_encode( [ 'status' => 'success', 'message' => 'Car updated successfully' ] );
        } else {
            echo json_encode( [ 'status' => 'error', 'message' => 'Failed to update car' ] );
        }

        $updateStmt->close();
    } else {
        echo json_encode( [ 'status' => 'error', 'message' => 'Error preparing update statement' ] );
    }
} else {
    // If the request method is not POST, return an error status
    echo json_encode( [ 'status' => 'error', 'message' => 'Invalid request' ] );
}

// Close the database connection
$conn->close();
?>
