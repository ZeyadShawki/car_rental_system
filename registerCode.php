<?php
  session_start();
  if (isset($_SESSION["SESSION_EMAIL"])) {
      header("Location: homepage.php");
  }
  if(isset($_POST["register"])){
    include 'connectdb.php';
    


// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Retrieve POST data
  $FirstName = $_POST['FirstName'];
  $LastName = $_POST['LastName'];
  $Email = $_POST['Email'];
  $ContactNumber = $_POST['ContactNumber'];
  $sex = $_POST['sex'];
  $inputDate = $_POST['inputDate'];
  $pass = $_POST['pass'];

  // Hash the password for security
  $hashed_password = password_hash($pass, PASSWORD_DEFAULT);

  // Prepare and bind SQL statement
  $stmt = $conn->prepare("INSERT INTO Customers (FirstName, LastName, Email, PhoneNumber, user_password, sex, bdate) VALUES (?, ?, ?, ?, ?, ?, ?)");
  $stmt->bind_param("sssssss", $FirstName, $LastName, $Email, $ContactNumber, $hashed_password, $sex, $inputDate);

  // Execute the statement
  if ($stmt->execute() === TRUE) {
      echo "success";
  } else {
      // Check if email already exists
      if (strpos($stmt->error, 'Duplicate entry') !== false) {
          echo "email";
      } else {
          echo "sqlfailure";
      }
  }

  $stmt->close();
  $conn->close();
  

  }
?>