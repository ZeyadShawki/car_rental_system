<?php
session_start(); 
if ( !isset( $_SESSION[ 'SESSION_EMAIL' ] ) ) {
    header( 'Location: ../../frontend/guest/index.php' );  
} 

require(__DIR__ . '/../my_db_cred.php');

$conn = MyConnection::getConnection();
$query = "SELECT CustomerID, user_password FROM Customers WHERE Email = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param('s', $_SESSION['SESSION_EMAIL']);
$stmt->execute();
$stmt->bind_result($customerId, $user_password);
$stmt->fetch();

// Close the SELECT statement
$stmt->close();

// Check if the provided old password matches the one stored in the database
if (md5($_POST['oldPassword'])===$user_password) {
   
    // Old password is correct, update the new password

    // Hash the new password before storing it in the database
    $hashedNewPassword = md5($_POST['newPassword']);

    // Update the new password in the database
    $updateQuery = "UPDATE Customers SET user_password = ? WHERE CustomerID = ?";
    $updateStmt = $conn->prepare($updateQuery);
    $updateStmt->bind_param('si', $hashedNewPassword, $customerId);
    $updateStmt->execute();

    echo "success";
    // Close the UPDATE statement
    $updateStmt->close();
} else {
    echo "error";
}

// Close the connection
$conn->close();
?>
