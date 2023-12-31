<?php
session_start();

if (!isset($_SESSION['SESSION_EMAIL'])) {
    header('Location: ../../frontend/guest/index.php');
}

require(__DIR__ . '/../my_db_cred.php');

if (isset($_FILES['image']) && isset($_POST['plateID'])) {
    $uploadDir = '../../uploaded_images/'; // Adjust the directory path accordingly
    $uploadFile = $uploadDir . basename($_FILES['image']['name']);

    // Move the uploaded file to the desired directory
    if (move_uploaded_file($_FILES['image']['tmp_name'], $uploadFile)) {
        $imageLink = 'http://localhost/final_db_admin/backend/uploaded_images/' . basename($_FILES['image']['name']);

        // Update ImageLink in the Cars table for the specified plateID
        $plateID = $_POST['plateID'];
        updateCarImageLink($plateID, $imageLink);

        echo json_encode(['success' => true, 'imageLink' => $imageLink]);
    } else {
        echo json_encode(['success' => false, 'message' => 'Error moving the file']);
    }
} else {
    echo json_encode(['success' => false, 'message' => 'No file uploaded']);
}

function updateCarImageLink($plateID, $imageLink)
{
    $conn = MyConnection::getConnection();

    if ($conn->connect_error) {
        die('Connection failed: ' . $conn->connect_error);
    }

    // Use prepared statement to prevent SQL injection
    $stmt = $conn->prepare("UPDATE Cars SET imageUrl = ? WHERE plateID = ?");
    $stmt->bind_param("si", $imageLink, $plateID);
    $stmt->execute();
    $stmt->close();

    $conn->close();
}
?>
