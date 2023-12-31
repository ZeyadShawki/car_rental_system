<?php
session_start();
if (!isset($_SESSION['SESSION_EMAIL'])) {
    header('Location: ../../frontend/guest/index.php');
}
require(__DIR__ . '/../my_db_cred.php');
$email = $_SESSION['SESSION_EMAIL'];

function get_data($plate_id)
{
    $email = $_SESSION['SESSION_EMAIL'];

    $conn = MyConnection::getConnection();


  
    $result = mysqli_query($conn, "SELECT o.country, cs.brand, c.carname, c.plateID, c.rentvalue , c.imageUrl
                                  FROM cars AS c 
                                  JOIN offices AS o ON c.OfficeID = o.OfficeID
                                  JOIN category as cs on cs.carname=c.carname
                                  WHERE c.plateID=$plate_id;");

    // Check for query execution success
    if (!$result) {
        die('Query failed: ' . mysqli_error($conn));
    }
    // Check if there are any rows in the result set
    if (mysqli_num_rows($result) > 0) {
        // Loop through each row and print the data
        while ($row = mysqli_fetch_assoc($result)) {

            echo '<style>
            .seven h1 {
  text-align: center;
  font-size: 30px;
  font-weight: 300;
  color: #222;
  letter-spacing: 1px;
  text-transform: uppercase;
  display: grid;
  grid-template-columns: 1fr max-content 1fr;
  grid-template-rows: 27px 0;
  grid-gap: 20px;
  align-items: center;
  position: relative;
}

.seven h1:after,
.seven h1:before {
  content: " ";
  display: block;
  border-bottom: 1px solid #c50000;
  border-top: 1px solid #c50000;
  height: 5px;
  background-color: #f8f8f8;
}
            </style>';
echo '
<div class="seven">
  <h1>Rent a car</h1>
</div>
';
            // echo '<div class="form-control">';
echo '
<div class="two" style="text-align: center; position: relative;">
  <h1 style="text-transform: capitalize; position: relative;">
    '. $row['brand'] .'
    <span style="font-size: 13px; font-weight: 500; text-transform: uppercase; letter-spacing: 4px; line-height: 3em; padding-left: 0.25em; color: rgba(0, 0, 0, 0.4); padding-bottom: 10px; display: block;">
   '. $row['carname'] .'
    </span>
    <span style="position: absolute; left: 0; bottom: 0; width: 60px; height: 2px; content: ; background-color: #c50000;"></span>
  </h1>
</div>
';
// Content related to the car details
echo '<p>';
echo '<img src="' . $row['imageUrl'] . '" alt="Car Image" class="img-fluid">';
echo "<div class='text-start'>".'<strong >Car name</strong> '  . "<label class='form-control'>". $row['carname'] ."</label>"."</label>"."</div>". '<br>';

echo "<div class='text-start'>".'<strong >Country</strong> ' . "<label class='form-control'>".$row['country']."</label>"."</div>" . '<br>';
echo"<div class='text-start'>".'<strong >Plate Id</strong> '  . "<label class='form-control'>".  $row['plateID'] ."</label>"."</label>"."</div>". '<br>';
echo "<div class='text-start'>".'<strong >Rent per day</strong> '  ."<label class='form-control' id='priceperday'>" . $row['rentvalue']."</label>"."</div>".'<br>';

// Grid structure for Total Price and Image
echo '<div class="row">';
// Total Price column
echo "<div class='text-start'><strong >Total Price</strong> "."</div>"."</span><br>";
echo '<div class="text-start text-danger  " style="font-size: 80 px;"  id="totalpriceId">Select Dates To Calculate</div>';

// Image column
echo '<div class="col-md-12 mt-3">'; // Use the full width of the row for the image
echo '</div>';

echo '</div>'; // Close the row

// Validation messages
echo "<p id='validation-messages'></p>";

echo '</p>'; // Close the paragraph
// echo '</div>'; // Close the form-control div

            // echo '<div class="form-control">';
            // echo '<h2>' . $row['brand'] . '</h2>';
            // echo '<p>';
            // echo '<strong>Country:</strong> ' . $row['country'] . '<br>';
            // echo '<strong>Car Name:</strong> ' . $row['carname'] . '<br>';
            // echo '<strong>Plate ID:</strong> ' . $row['plateID'] . '<br>';
            // echo '<strong>Rent Value per day:</strong> <span id="priceperday">' . $row['rentvalue'] . '</span><br>';

            // echo '<div class="row">';
            // echo '<div class="col-md-6"><strong>Total Price:</strong></div>';
            // echo '<div class="col-md-6 text-danger" id="totalprice">Select Dates To Calculate</div>';
            // echo '</div>';
            // echo "<p id='validation-messages'></p>";
            // echo '</p>';
            // echo '</div>';
        }
    } else {
        echo 'No results found.';
    }



    $result1 = mysqli_query($conn, "SELECT c.FirstName, c.LastName, c.Email, c.PhoneNumber
  FROM customers AS c
  WHERE c.Email = '$email';");
      // Check for query execution success
    if (!$result1) {
        die('Query failed: ' . mysqli_error($conn));
    }
    // Check if there are any rows in the result set
    if (mysqli_num_rows($result1) > 0) {
        // Loop through each row and print the data
        while ($row = mysqli_fetch_assoc($result1)) {
            echo '<br>';
            // Name
            echo '<div class="col text-start">';
            echo '<label>Name</label>';
            echo "<label class='form-control'>" . $row['FirstName'] . ' ' . $row['LastName'] . '</label>';
            echo '</div>';
            echo '<br>';
            // Email
            echo '<div class="col text-start">';
            echo '<label>Email</label>';
            echo "<label class='form-control'>" . $row['Email'] . '</label>';
            echo '</div>';
            echo '<br>';
        }

    } else {
        echo 'No results found.';
    }


    // Free the result set
    mysqli_free_result($result);
    mysqli_close($conn);
}

if (isset($_POST['rent_submit'])) {
    $new_pickup_date = $_POST['pickup_date'];
    $new_return_date = $_POST['return_date'];
    $plateID = $_POST['plate_id'];

    include 'connectdb.php';
    // Using database connection file here

    // check if there intersection
    $result = mysqli_query($conn, "SELECT r.PickupDate , r.ReturnDate
                                FROM reservations AS r
                                WHERE plateID= $plateID;");
    // Check for query execution errors
    if (!$result) {
        die('Query failed: ' . mysqli_error($conn));
    }
    $intersectionFound = false;
    // Iterate through existing reservations dates
    while ($row = mysqli_fetch_assoc($result)) {
        // echo 'In while loop';
        $existing_pickup_date = DateTime::createFromFormat('Y-m-d', $row['PickupDate']);
        $existing_return_date = DateTime::createFromFormat('Y-m-d', $row['ReturnDate']);
        // Check if conversion was successful before proceeding
        if ($existing_pickup_date === false || $existing_return_date === false) {
            echo 'Error converting existing dates to DateTime objects.';
            break;
        }
        // Format existing dates as strings
        $existing_pickup_date_str = $existing_pickup_date->format('Y-m-d');
        $existing_return_date_str = $existing_return_date->format('Y-m-d');

        $newpickupDate = DateTime::createFromFormat('Y-m-d', $new_pickup_date);
        $newreturnupDate = DateTime::createFromFormat('Y-m-d', $new_return_date);

        // Format new dates as strings
        $newpickupDate_str = $newpickupDate->format('Y-m-d');
        $newreturnDate_str = $newreturnupDate->format('Y-m-d');

        // echo 'Existing Pickup Date: ' . $existing_pickup_date_str . '<br>';
        // echo 'Existing Return Date: ' . $existing_return_date_str . '<br>';
        // echo 'New Pickup Date: ' . $newpickupDate_str . '<br>';
        // echo 'New Return Date: ' . $newreturnDate_str . '<br>';

        // Check for intersection
        if (
        ($newpickupDate_str >= $existing_pickup_date_str && $newpickupDate_str < $existing_return_date_str) ||
        ($newreturnDate_str > $existing_pickup_date_str && $newreturnDate_str <= $existing_return_date_str) ||
        ($newpickupDate_str <= $existing_pickup_date_str && $newreturnDate_str >= $existing_return_date_str)
    ) {
        // Intersection found
        http_response_code(400); // Bad Request
        echo json_encode(['message' => 'The car is already reserved from ' . $existing_pickup_date_str . ' to ' . $existing_return_date_str . '.']);
        $intersectionFound = true;
        break;
    }

    }

    // if no intersection ( hhgezlo el 3rbya )
    if (!$intersectionFound) {

        echo ' NO intersection';
        // hhseb el amount awl hga
        $result_value_per_day = mysqli_query($conn, "SELECT c.rentvalue 
                                                  FROM cars AS c
                                                  WHERE c.plateID=$plateID;");
        // Convert string dates to DateTime objects
        $pickup_date = new DateTime($new_pickup_date);
        $return_date = new DateTime($new_return_date);
        // Calculate the difference in days
        $interval = $pickup_date->diff($return_date);
        $days_difference = $interval->days;

        if ($result_value_per_day) {
            // Fetch the value from the result set
            $row = mysqli_fetch_assoc($result_value_per_day);
            $rent_value_per_day = $row['rentvalue'];
            // Calculate the total cost
            $total_cost = $days_difference * $rent_value_per_day;

            // echo "The total cost is: $" . $total_cost;
        } else {
            // Handle query error
            echo 'Error fetching rent value from the database: ' . mysqli_error($conn);
            return;
        }

        $current_date = date('Y-m-d');

        // echo 'Current Date jordiii: ' . $current_date;
        // echo 'pick Date jordiii: ' . $new_pickup_date;
        // echo 'return Date jordiii: ' . $new_return_date;

        //Assuming you want to perform these actions within a single transaction for consistency, you can use SQL transactions.
        //Transactions ensure that either all the SQL statements within the transaction are executed, or none of them are.
        // Start a transaction
        mysqli_begin_transaction($conn);
        try {
            // Retrieve CustomerID based on the customer's email
            // $customerEmail = 'john.doe@email.com'; 
            $getCustomerIDQuery = "SELECT c.CustomerID FROM customers AS c WHERE c.Email='$email'";
            $result = mysqli_query($conn, $getCustomerIDQuery);

            // Check for query execution errors
            if (!$result) {
                throw new Exception("Error retrieving CustomerID: " . mysqli_error($conn));
            }

            // Fetch the CustomerID from the result set
            $row = mysqli_fetch_assoc($result);
            $customerID = $row['CustomerID'];

            // Insert record into Payments table
            $insertPaymentQuery = "INSERT INTO Payments (PaymentDate, Amount) VALUES ('$current_date', $total_cost)";
            mysqli_query($conn, $insertPaymentQuery);

            // Get the generated PaymentID
            $paymentID = mysqli_insert_id($conn);

            // Insert record into Reservations table with the new PaymentID and CustomerID
            $insertReservationQuery = "INSERT INTO Reservations (plateID, CustomerID, PaymentID, ReservationDate, PickupDate, ReturnDate)
                                VALUES ($plateID, $customerID, $paymentID, '$current_date', '$new_pickup_date', '$new_return_date' )";
            mysqli_query($conn, $insertReservationQuery);

            // Commit the transaction
            mysqli_commit($conn);

            // Echo success message or perform other actions
            echo "Transaction successful!";
        } catch (Exception $e) {
            // An error occurred, rollback the transaction (undo ay sql query et3mlt)
            mysqli_rollback($conn);

            // Echo or log the error message
            echo "Transaction failed: " . $e->getMessage();
        }
    }

    mysqli_free_result($result);
    mysqli_close($conn);
}
?>