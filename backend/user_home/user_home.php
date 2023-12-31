<?php
session_start();
if ( !isset( $_SESSION[ 'SESSION_EMAIL' ] ) ) {
    header( 'Location: ../../frontend/guest/index.php' );  
} 

if ( isset( $_POST[ 'update_brand_name' ] ) ) {
    // hsl update f car f 3yzen n update el brand
    // awl hga nshof lw car el selected lw 3ndha brand b esm da
    $new_car_name = $_POST[ 'name_of_new_car' ];
    // new car
    $current_brand_name = $_POST[ 'current_brand' ];
    // current brand
    $arr = $_SESSION[ 'array' ];

    if ( $current_brand_name = 'Any' ) {
        $brand_name_for_car = findBrandForCar( $new_car_name, $arr );
        echo $brand_name_for_car;

    }
    // Check if the new car name belongs to the same brand
    //ana 3ndy el array 3bra 3n key brand w osado kza value
    else if ( in_array( $new_car_name, $arr[ $current_brand_name ] ) ) {
        echo 'nochange';
    } else {
        // Find the brand name for the given car name
        $brand_name_for_car = findBrandForCar( $new_car_name, $arr );
        echo $brand_name_for_car;
    }
}
// Function to find the brand name for a given car name

function findBrandForCar( $car_name, $arr ) {
    foreach ( $arr as $brand_name => $cars ) {
        if ( in_array( $car_name, $cars ) ) {
            return $brand_name;
        }
    }
    return 'Brand not found';
}

if ( isset( $_POST[ 'update_car_name' ] ) ) {
    $brand_name = $_POST[ 'name_of_new_brand' ];
    // session_start();
    $arr = $_SESSION[ 'array' ];
    // echo json_encode( $arr );
    // return;

    // Check if the brand exists in the array
    if ( isset( $arr[ $brand_name ] ) ) {
        $carNamesForBrand = $arr[ $brand_name ];
        echo json_encode( $carNamesForBrand );
    } else {
        echo json_encode( [ 'error' => 'Brand not found' ] );
    }
}

function retrive_all_data_required() {
    include 'connectdb.php';
    // Using database connection file here

    // join l2n 3ndi ofiices m3ndhash cars
    $result = mysqli_query( $conn, "SELECT DISTINCT o.country
                                    FROM offices AS o 
                                    JOIN cars AS c ON o.OfficeID = c.OfficeID;
    " );

    // Check for query execution errors
    if ( !$result ) {
        die( 'Query failed: ' . mysqli_error( $conn ) );
    }

    if ( mysqli_num_rows( $result ) > 0 ) {
        echo '<label  for="country">Select a Country:</label>';
        echo '<select class="form-control mb-2" id="country" name="country">';

        // Loop through the result set to generate options
        while ( $row = mysqli_fetch_assoc( $result ) ) {
            echo '<option value="' . $row[ 'country' ] . '">' . $row[ 'country' ] . '</option>';
        }

        echo '</select>';
    } else {
        echo '<p>No countries found.</p>';
    }
    mysqli_free_result( $result );

    // echo '<p>Speces</p>';
    $result = mysqli_query( $conn, "SELECT DISTINCT cs.brand, c.carname FROM cars AS c 
    JOIN category as cs ON c.carname=cs.carname
    WHERE c.carStatus = 'active';" );

    // Check for query execution success
    if ( !$result ) {
        die( 'Query failed: ' . mysqli_error( $conn ) );
    }



    $optionsBrand = "<option value='Any' selected>Any</option>";
    // slected 3shan bn5li l any hya awl hga selected
    $optionsCarName = "<option value='Any' selected>Any</option>";

    $uniqueBrands = array();
    $uniqueCarNames = array();

    while ( $row = mysqli_fetch_assoc( $result ) ) {
        $brand = $row[ 'brand' ];
        $carname = $row[ 'carname' ];

        // Check if brand is not already added
        if ( !isset( $arr[ $brand ] ) ) {
            $arr[ $brand ] = array();
            // Initialize the array for the brand
            $optionsBrand .= "<option value='{$brand}'>{$brand}</option>";
        }

        // Check if car name is not already added to the brand
        if ( !in_array( $carname, $arr[ $brand ] ) ) {
            $arr[ $brand ][] = $carname;
            $optionsCarName .= "<option value='{$carname}'>{$carname}</option>";
        }
    }

    $selectedBrand = 'Any';
    $selectedCarName = 'Any';

    echo 'Select Brand: ';
    echo "<select class='form-control ' id='brandSelect' name='brand' onchange='updateCarNames(this.value)'>";
    echo $optionsBrand;
    echo '</select>';
    echo '<br>';

    // Display the HTML select for carname
    echo 'Select Car Name: ';
    echo "<select class='form-control' id='carNamesSelect' name='carname' onchange='updateBrand(this.value)'>";
    echo $optionsCarName;
    echo '</select>';
    echo '<br>';

    // echo '<pre>';
    // print_r( $arr );
    // echo '</pre>';

    // Echo the selected values
    // echo 'Selected Brand: ' . htmlspecialchars( $selectedBrand ) . '<br>';
    // echo 'Selected Car Name: ' . htmlspecialchars( $selectedCarName ) . '<br>';

    // After building $arr
    $_SESSION[ 'array' ] = $arr;

    mysqli_free_result( $result );
    mysqli_close( $conn );
}

if ( isset( $_POST[ 'search' ] ) ) {
    include 'connectdb.php';

    $nbrand = $_POST[ 'brand_name' ];
    $ncar = $_POST[ 'car_name' ];
    $year_before = $_POST[ 'before_year' ];
    $year_after = $_POST[ 'after_year' ];
    $country = $_POST[ 'country' ];
    // Add the country parameter

    // Build the base query
    $baseQuery = "SELECT c.plateID, c.OfficeID, c.carname, cs.brand, c.Year, c.imageUrl, c.rentvalue
                  FROM cars AS c
                  JOIN offices AS o ON c.OfficeID = o.OfficeID
                  JOIN category as cs on cs.carname= c.carname
                  WHERE c.carStatus = 'active' AND ? < c.Year AND ? > c.Year";

    // // Check if brand is 'Any'
    if ( $nbrand == 'Any' ) {
        $query = "$baseQuery AND o.country = ?";
        $stmt = mysqli_prepare( $conn, $query );
        mysqli_stmt_bind_param( $stmt, 'iss', $year_after, $year_before, $country );

        if ( !$stmt ) {
            die( 'Query preparation failed: ' . mysqli_error( $conn ) );
        }

        // Execute the prepared statement
        mysqli_stmt_execute( $stmt );

        // Get the result set
        $result = mysqli_stmt_get_result( $stmt );
    } else  if ( $ncar == 'Any' ) {
        $query = "$baseQuery AND cs.brand=?  AND o.country = ?";
        $stmt = mysqli_prepare( $conn, $query );
        mysqli_stmt_bind_param( $stmt, 'isss', $year_after, $year_before,$nbrand ,$country );

        if ( !$stmt ) {
            die( 'Query preparation failed: ' . mysqli_error( $conn ) );
        }

        // Execute the prepared statement
        mysqli_stmt_execute( $stmt );

        // Get the result set
        $result = mysqli_stmt_get_result( $stmt );

    } else {
        // Brand is not 'Any'
        $query = "$baseQuery AND c.carname = ? AND cs.brand = ?";
        $stmt = mysqli_prepare( $conn, $query );
        mysqli_stmt_bind_param( $stmt, 'isss', $year_after, $year_before, $ncar, $nbrand );

        if ( !$stmt ) {
            die( 'Query preparation failed: ' . mysqli_error( $conn ) );
        }

        // Execute the prepared statement
        mysqli_stmt_execute( $stmt );

        // Get the result set
        $result = mysqli_stmt_get_result( $stmt );
    }
    // Check conditions for brand and car name
    //   ...

    // if ( $nbrand == 'Any' && $ncar == 'Any' ) {
    //     $query = "$baseQuery AND o.country = ?";
    //     $stmt = mysqli_prepare( $conn, $query );
    //     mysqli_stmt_bind_param( $stmt, 's', $country );
    // }

    // elseif ( $nbrand != 'Any' && $ncar == 'Any' ) {
    //     $query = "$baseQuery AND c.brand = ? AND o.country = ?";
    //     $stmt = mysqli_prepare( $conn, $query );
    //     mysqli_stmt_bind_param( $stmt, 'ss', $nbrand, $country );
    // }

    // elseif ( $nbrand == 'Any' && $ncar != 'Any' ) {
    //     $query = "$baseQuery AND c.carname = ? AND o.country = ?";
    //     $stmt = mysqli_prepare( $conn, $query );
    //     mysqli_stmt_bind_param( $stmt, 'ss', $ncar, $country );
    // }

    // elseif ( $nbrand != 'Any' && $ncar != 'Any' ) {
    //     $query = "$baseQuery AND c.carname = ? AND c.brand = ? AND o.country = ?";
    //     $stmt = mysqli_prepare( $conn, $query );
    //     mysqli_stmt_bind_param( $stmt, 'sss', $ncar, $nbrand, $country );
    // }

    // else {
    //     // Handle any other cases or add a default behavior if necessary
    // }

    // ...

    if ( !$result ) {
        die( 'Query failed: ' . mysqli_error( $conn ) );
    }
    // Check if there are any rows in the result set
    if ( mysqli_num_rows( $result ) > 0 ) {
        // Open a container for the table with Bootstrap classes
        echo "<div class='table-responsive'>";
        echo "<table class='table table-bordered'>";

        // Table header
        echo '<thead>';
        echo '<tr>';
        echo '<th>Plate ID</th>';
        echo '<th>Office ID</th>';
        echo '<th>Car Name</th>';
        echo '<th>Brand</th>';
        echo '<th>Year</th>';
        echo '<th>Image URL</th>';
        echo '<th>Rent Value</th>';
        echo '<th>Action</th>';
        echo '</tr>';
        echo '</thead>';

        // Table body
        echo '<tbody>';

        // Loop through each row and print the data in a table row
        while ( $row = mysqli_fetch_assoc( $result ) ) {
            echo '<tr>';
            echo '<td>' . $row[ 'plateID' ] . '</td>';
            echo '<td>' . $row[ 'OfficeID' ] . '</td>';
            echo '<td>' . $row[ 'carname' ] . '</td>';
            echo '<td>' . $row[ 'brand' ] . '</td>';
            echo '<td>' . $row[ 'Year' ] . '</td>';
            echo "<td><img src='" . $row[ 'imageUrl' ] . "' alt='Car Image' style='max-width: 100px; max-height: 100px;'></td>";
            echo '<td>' . $row[ 'rentvalue' ] . '</td>';

            // Add a submission button in the last column
            echo '<td>';
            echo "<form method='post' action='../../frontend/user_rent/user_rent_html.php'>";
            echo "<input type='hidden' name='plateID' value='" . $row[ 'plateID' ] . "'>";
            echo "<input type='submit' class='btn btn-primary' value='Rent Now'>";
            echo '</form>';
            echo '</td>';

            echo '</tr>';
        }

        // Close the table body and table container
        echo '</tbody>';
        echo '</table>';
        echo '</div>';
    } else {
        echo 'No results found.';
    }
    // Free the result set
    mysqli_free_result( $result );

    // Close the database connection
    mysqli_close( $conn );
}
?>
