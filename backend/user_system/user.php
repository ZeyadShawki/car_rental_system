<?php 
session_start();
if (isset($_POST["update_brand_name"])) {// hsl update f car f 3yzen n update el brand 
                                          // awl hga nshof lw car el selected lw 3ndha brand b esm da
    $new_car_name = $_POST["name_of_new_car"];// new car
    $current_brand_name = $_POST["current_brand"];// current brand
    $arr = $_SESSION['array'];

    if($current_brand_name="Any"){
        $brand_name_for_car = findBrandForCar($new_car_name, $arr);
        echo $brand_name_for_car;   
    }
    // Check if the new car name belongs to the same brand
    //ana 3ndy el array 3bra 3n key brand w osado kza value
    else if (in_array($new_car_name, $arr[$current_brand_name])) {
        echo "nochange";
    } else {
        // Find the brand name for the given car name
        $brand_name_for_car = findBrandForCar($new_car_name, $arr);
        echo $brand_name_for_car;
    }
}
// Function to find the brand name for a given car name
function findBrandForCar($car_name, $arr) {
    foreach ($arr as $brand_name => $cars) {
        if (in_array($car_name, $cars)) {
            return $brand_name;
        }
    }
    return "Brand not found";
}


if(isset($_POST["update_car_name"])){
    $brand_name = $_POST["name_of_new_brand"];
    // session_start();
    $arr=$_SESSION["array"];
    //lw sghlt l echos dol l code hybozzz l en ecchoo hna aknha return
    // echo "<pre>";
    // print_r($arr);
    // print_r($brand_name);
    // echo "</pre>";
    $value=$arr[$brand_name][0];
    echo "$value";
}
function retrive_all_data_required(){
    include 'connectdb.php'; // Using database connection file here
    $email='john.doe@example.com';
    // join l2n 3ndi ofiices m3ndhash cars
    $result =mysqli_query($conn, "SELECT DISTINCT o.country
                                    FROM offices AS o 
                                    JOIN cars AS c ON o.OfficeID = c.OfficeID;
    ");
    
    // Check for query execution errors
    if (!$result) {
        die("Query failed: " . mysqli_error($conn));
    }

    if (mysqli_num_rows($result) > 0) {
        echo '<label for="country">Select a Country:</label>';
        echo '<select id="country" name="country">';
        
        // Loop through the result set to generate options
        while ($row = mysqli_fetch_assoc($result)) {
            echo '<option value="' . $row['country'] . '">' . $row['country'] . '</option>';
        }
        
        echo '</select>';
    } else {
        echo '<p>No countries found.</p>';
    }
    mysqli_free_result($result);

    
    echo '<p>Speces</p>';
    $result = mysqli_query($conn, "SELECT DISTINCT c.brand, c.carname FROM cars AS c WHERE c.carStatus = 'active';");

     // Check for query execution success
    if (!$result) {
         die("Query failed: " . mysqli_error($conn));
    }
     
     // Fetch options and create HTML select options
    // $optionsBrand = "<option value='Any'>Any</option>";
    // $optionsCarName = "<option value='Any'>Any</option>"; 
    
    $optionsBrand = "<option value='Any' selected>Any</option>"; // slected 3shan bn5li l any hya awl hga selected
    $optionsCarName = "<option value='Any' selected>Any</option>"; 
    $arr=array();
     
    while ($row = mysqli_fetch_assoc($result)) {
        $arr[$row['brand']][] = $row['carname'];
        $optionsBrand .= "<option value='{$row['brand']}'>{$row['brand']}</option>";
        $optionsCarName .= "<option value='{$row['carname']}'>{$row['carname']}</option>";
    }


    $selectedBrand ='Any';
    $selectedCarName ='Any';

    // Update selected attribute based on the retrieved values
    // $optionsBrand = str_replace("value='{$selectedBrand}'", "value='{$selectedBrand}' selected", $optionsBrand);
    // $optionsCarName = str_replace("value='{$selectedCarName}'", "value='{$selectedCarName}' selected", $optionsCarName);

    // // Display the HTML select for brand
    echo "Select Brand: ";
    echo "<select id='brandSelect' name='brand' onchange='updateCarNames(this.value)'>";
    echo $optionsBrand;
    echo "</select>";
    echo "<br>";


    // Display the HTML select for carname
    echo "Select Car Name: ";
    echo "<select id='carNamesSelect' name='carname' onchange='updateBrand(this.value)'>";
    echo $optionsCarName;
    echo "</select>";
    echo "<br>";
    
    // echo "<pre>";
    // print_r($arr);
    // echo "</pre>";

    // Echo the selected values
    echo "Selected Brand: " . htmlspecialchars($selectedBrand) . "<br>";
    echo "Selected Car Name: " . htmlspecialchars($selectedCarName) . "<br>";

    // After building $arr
    $_SESSION['array'] = $arr;

    mysqli_free_result($result);
    mysqli_close($conn);
}

if(isset($_POST["search"])){
    include 'connectdb.php';
    $email='john.doe@example.com';

    $nbrand = $_POST["brand_name"];
    $ncar = $_POST["car_name"];
    $year_before = $_POST["before_year"];
    $year_after = $_POST["after_year"];
//     SELECT c.plateID , c.OfficeID , c.carname , c.brand , c.Year, c.imageUrl , c.rentvalue
// FROM cars AS c 
// WHERE c.carname="SUV B" AND c.brand="Ford" AND c.carStatus="active" AND 2012<c.Year AND 2024>c.Year;

    if ($nbrand == "Any"){
    $result =mysqli_query($conn, "SELECT c.plateID , c.OfficeID , c.carname , c.brand , c.Year, c.imageUrl , c.rentvalue
                                    FROM cars AS c 
                                    WHERE c.carStatus = 'active' AND 
                                            $year_after < c.Year AND 
                                            $year_before > c.Year;
                                ");
    }else {
        $query = "SELECT c.plateID, c.OfficeID, c.carname, c.brand, c.Year, c.imageUrl, c.rentvalue
                  FROM cars AS c 
                  WHERE c.carname = ? AND
                        c.brand = ? AND 
                        c.carStatus = 'active' AND 
                        ? < c.Year AND 
                        ? > c.Year";
        $stmt = mysqli_prepare($conn, $query);
        mysqli_stmt_bind_param($stmt, "ssii", $ncar, $nbrand, $year_after, $year_before);

        if (!$stmt) {
            die("Query preparation failed: " . mysqli_error($conn));
        }
        
        // Execute the prepared statement
        mysqli_stmt_execute($stmt);
        
        // Get the result set
        $result = mysqli_stmt_get_result($stmt);
    
    }
    if (!$result) {
        die("Query failed: " . mysqli_error($conn));
    }
    
// Check if there are any rows in the result set
if (mysqli_num_rows($result) > 0) {
    // Open a container for the grid
    echo "<div style='display: grid; grid-template-columns: repeat(auto-fill, minmax(200px, 1fr)); gap: 15px;'>";

 // Loop through each row and print the data in a box
    while ($row = mysqli_fetch_assoc($result)) {
        echo "<div style='border: 1px solid #ccc; padding: 10px;'>";
        echo "Plate ID: " . $row['plateID'] . "<br>";
        echo "Office ID: " . $row['OfficeID'] . "<br>";
        echo "Car Name: " . $row['carname'] . "<br>";
        echo "Brand: " . $row['brand'] . "<br>";
        echo "Year: " . $row['Year'] . "<br>";
        echo "Image URL: " . $row['imageUrl'] . "<br>";
        echo "Rent Value: " . $row['rentvalue'] . "<br>";

        // Add a submission button
        echo "<form method='post' action='renthtml.php'>";
        echo "<input type='hidden' name='plateID' value='" . $row['plateID'] . "'>";
        echo "<input type='submit' value='Rent Now'>";
        echo "</form>";

        echo "</div>";
    }
        // Close the container for the grid
        echo "</div>";
    } else {
        echo "No results found.";
    }
    // Free the result set
    mysqli_free_result($result);
    
    // Close the database connection
    mysqli_close($conn);
}
?>
