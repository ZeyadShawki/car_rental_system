<?php
session_start();

if(isset($_POST["search"])){
    include 'connectdb.php';
    // require('../my_db_cred.php');
    // $conn = MyConnection::getConnection();
    
    $email = $_SESSION[ 'SESSION_EMAIL' ] ;


    $plateid = $_POST["plate_id"];
    $carbrand = $_POST["car_brand"];
    $pickdate = $_POST["pick_date"];

    $plateid_check=FALSE ;
    $carbrand_check=FALSE ;
    $pickdate_check=FALSE ;

 

    $result = mysqli_query($conn, "SELECT c.carname, c.brand, c.rentvalue, r.plateID, r.ReservationDate, r.PickupDate, r.ReturnDate 
    FROM reservations AS r
    JOIN cars AS c ON r.plateID = c.plateID
    JOIN customers AS cu ON cu.CustomerID = r.CustomerID
    WHERE cu.Email ='$email' AND  
    (
        (
            (r.plateID = '$plateid') AND (c.brand = '$carbrand') AND (r.PickupDate = '$pickdate')
        )
        OR ('$plateid' = 'nth' AND '$carbrand' = 'nth'AND '$pickdate' = 'nth') 
        OR (r.plateID = '$plateid' AND '$carbrand' = 'nth'AND '$pickdate' = 'nth')
        OR ('$plateid' = 'nth' AND c.brand = '$carbrand'AND '$pickdate' = 'nth')
        OR ('$plateid' = 'nth' AND '$carbrand' = 'nth'AND r.PickupDate = '$pickdate')
        OR (r.plateID = '$plateid' AND c.brand = '$carbrand'AND '$pickdate' = 'nth')
        OR (r.plateID = '$plateid' AND '$carbrand' = 'nth'AND r.PickupDate = '$pickdate')
        OR ('$plateid' = 'nth' AND c.brand = '$carbrand' AND r.PickupDate = '$pickdate')
    );
    ");
    if (!$result) {
        die("Query failed: " . mysqli_error($conn));
    }
    
    if (mysqli_num_rows($result) == 0) {
        // echo "failed";
        echo "<p>you have no reservations with this requrements.</p>";

    } else {
    
        while ($row = mysqli_fetch_assoc($result)) {
            echo "<div class='car-info'>";
            echo "<p>Car Name: " . $row['carname'] . "</p>";
            echo "<p>Brand: " . $row['brand'] . "</p>";
            echo "<p>Rent Value: " . $row['rentvalue'] . "</p>";
            echo "<p>Plate ID: " . $row['plateID'] . "</p>";
            echo "<p>Reservation Date: " . $row['ReservationDate'] . "</p>";
            echo "<p>Pickup Date: " . $row['PickupDate'] . "</p>";
            echo "<p>Return Date: " . $row['ReturnDate'] . "</p>";
            echo "<hr>";
            echo "</div>";
        }
    }

    // Free the result set
    mysqli_free_result($result);

    // Close the database connection
    mysqli_close($conn);

}


function get_items_to_select(){
    include 'connectdb.php'; // Using database connection file here
        // require('../my_db_cred.php');
    // $conn = MyConnection::getConnection();
    $email = $_SESSION[ 'SESSION_EMAIL' ] ;
    $result =mysqli_query($conn, "SELECT r.plateID , r.PickupDate , c.brand
                                FROM reservations AS r 
                                JOIN cars AS c ON c.plateID = r.plateID 
                                JOIN customers AS cu ON cu.CustomerID = r.CustomerID
                                WHERE cu.Email='$email';
    ");
    
    // Check for query execution errors
    if (!$result) {
        die("Query failed: " . mysqli_error($conn));
    }

    $plateIDs = array();
    $pickupDates = array();
    $brands = array();
    
    while ($row = mysqli_fetch_assoc($result)) {
        $plateIDs[] = $row['plateID'];
        $pickupDates[] = $row['PickupDate'];
        $brands[] = $row['brand'];
    }
    
    // html code 
    // hbtdy a3ml l options
    // Select for Plate IDs
    echo '<select name="plateID" id="plateIDSelect">';
    echo '<option value="nth">Select a Plate ID</option>'; //<!--nth dy l value el httb3t lel php-->
    foreach ($plateIDs as $plateID) {
        echo '<option value="' . $plateID . '">Plate ID ' . $plateID . '</option>';
    }
    echo '</select>';

    // Select for Pickup Dates
    echo '<select name="pickupDate" id="pickupDateSelect">';
    echo '<option value="nth">Select a Pickup Date</option>';
    foreach ($pickupDates as $pickupDate) {
        echo '<option value="' . $pickupDate . '">' . $pickupDate . '</option>';
    }
    echo '</select>';

    // Select for Brands
    echo '<select class="form-control" name="brand" id="brandSelect">';
    echo '<option  value="nth">Select a Brand</option>';
    foreach ($brands as $brand) {
        echo '<option value="' . $brand . '">' . $brand . '</option>';
    }
    echo '</select>';

    // echo '<select name="plateID">';
    // echo '<option value="nth">Select a Plate ID</option>'; //<!--nth dy l value el httb3t lel php-->
    // foreach ($plateIDs as $plateID) {
    //     echo '<option value="' . $plateID . '">Plate ID ' . $plateID . '</option>';
    // }
    // echo '</select>';

    // // Select for Pickup Dates
    // echo '<select name="pickupDate">';
    // echo '<option value="nth">Select a Pickup Date</option>'; //<!--nth dy l value el httb3t lel php-->
    // foreach ($pickupDates as $pickupDate) {
    //     echo '<option value="' . $pickupDate . '">' . $pickupDate . '</option>';
    // }
    // echo '</select>';

    // // Select for Brands
    // echo '<select name="brand">';
    // echo '<option value="nth">Select a Brand</option>'; //<!--nth dy l value el httb3t lel php-->
    // foreach ($brands as $brand) {
    //     echo '<option value="' . $brand . '">' . $brand . '</option>';
    // }
    // echo '</select>';

    // Free the result set
    mysqli_free_result($result);
    // Close the database connection
    mysqli_close($conn);
}


function user_info (){
    include 'connectdb.php'; // Using database connection file here
    // require('../my_db_cred.php');
    // $conn = MyConnection::getConnection();
    $email='alice.j@example.com';
    $result =mysqli_query($conn, "SELECT FirstName,LastName,PhoneNumber,bdate 
                            FROM `customers` 
                            WHERE Email='alice.j@example.com'");

    // Check for query execution errors
    if (!$result) {
        die("Query failed: " . mysqli_error($conn));
    }

    while ($row = mysqli_fetch_assoc($result)) {
        echo "First Name: " . $row['FirstName'] . "<br>";
        echo "Last Name: " . $row['LastName'] . "<br>";
        echo "Phone Number: " . $row['PhoneNumber'] . "<br>";
        echo "Birth Date: " . $row['bdate'] . "<br>";
    }

    // Free the result set
    mysqli_free_result($result);
    // Close the database connection
    mysqli_close($conn);
}
?>