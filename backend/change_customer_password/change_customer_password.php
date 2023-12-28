<?php
header('Access-Control-Allow-Origin: *');
session_start(); // Start the session (if not already started)

if (!isset($_SESSION['SESSION_EMAIL'])) {
    header('Location: ../../frontend/guest/index.php');
    // Redirect to the login page if the user is not logged in
}

require(__DIR__ . '/../my_db_cred.php');


$query = "SELECT CustomerID, user_password FROM Customers WHERE Email = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param('s', $_SESSION['SESSION_EMAIL']);
$stmt->execute();
$stmt->bind_result($customerId, $user_password);
$stmt->fetch();

// Check if the provided old password matches the one stored in the database
if ($_POST['oldPassword'] === $user_password) {
    // Old password is correct, update the new password

    // Hash the new password before storing it in the database
    $hashedNewPassword = password_hash($_POST['newPassword'], PASSWORD_DEFAULT);

    // Update the new password in the database
    $updateQuery = "UPDATE Customers SET user_password = ? WHERE CustomerID = ?";
    $updateStmt = $conn->prepare($updateQuery);
    $updateStmt->bind_param('si', $hashedNewPassword, $customerId);
    $updateStmt->execute();

    echo "success";
} else {
    echo "error";
}

// Close the statements and connection
$stmt->close();
$updateStmt->close();
$conn->close();
?>
