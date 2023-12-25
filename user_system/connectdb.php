<?php
$conn = mysqli_connect("localhost", "root", "", "CAR_RENTAL_SYSTEM");
if (!$conn) {
  echo "<script>alert('Connection failed.');</script>";
  die("Failed to connect!");
}
// else{
//   echo "connected successfuly";
// }
?>
