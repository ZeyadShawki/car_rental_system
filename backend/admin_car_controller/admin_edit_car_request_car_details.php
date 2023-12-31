<?php
require('../my_db_cred.php');
$conn = MyConnection::getConnection();

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $carId = $_GET['carId'];

    // Use prepared statements to prevent SQL injection
    $carSql = "SELECT c.*, o.city, o.country FROM Cars c
               JOIN Offices o ON c.OfficeID  = o.OfficeID 
               JOIN category cs ON cs.carname= c.carname
               WHERE c.plateID = ?";
    $officeSql = 'SELECT  OfficeID, country, city FROM offices';
    $carNamesSql = 'SELECT DISTINCT carname FROM category';
    $brandNamesSql = 'SELECT DISTINCT brand FROM category';

    // Prepare the statements
    $carStmt = $conn->prepare($carSql);
    $officeStmt = $conn->prepare($officeSql);
    $carNamesStmt = $conn->prepare($carNamesSql);
    $brandNamesStmt = $conn->prepare($brandNamesSql);

    if ($carStmt && $officeStmt && $carNamesStmt && $brandNamesStmt) {
        // Bind the parameter for car statement
        $carStmt->bind_param('i', $carId);

        // Execute the car query
        $carStmt->execute();

        // Get the result for car
        $carResult = $carStmt->get_result();

        // Fetch the car data
        $carData = $carResult->fetch_assoc();

        // Execute the office query
        $officeStmt->execute();

        // Get the result for office
        $officeResult = $officeStmt->get_result();
        while ($row = $officeResult->fetch_assoc()) {
            $Allcountries[] = $row;
        }

        $selectedCountry = '';
        $selectedCities = '';

        foreach ($Allcountries as $cont) {
            if ($carData['country'] == $cont['country']) {
                $selectedCountry = $cont['country'];
            }
        }

        foreach ($Allcountries as $cont) {
            if ($carData['city'] == $cont['city']) {
                $selectedCities = $cont['OfficeID'];
            }
        }

        // Execute the car names query
        $carNamesStmt->execute();
        $carNamesResult = $carNamesStmt->get_result();
        $allCarNames = [];
        while ($row = $carNamesResult->fetch_assoc()) {
            $allCarNames[] = $row['carname'];
        }

        // Execute the brand names query
        $brandNamesStmt->execute();
        $brandNamesResult = $brandNamesStmt->get_result();
        $allBrandNames = [];
        while ($row = $brandNamesResult->fetch_assoc()) {
            $allBrandNames[] = $row['brand'];
        }

        // Return the data as JSON
        echo json_encode([
            'carData' => $carData,
            'countries' => $Allcountries,
            'selectedCountry' => $selectedCountry,
            'selectedCities' => $selectedCities,
            'allCarNames' => $allCarNames,
            'allBrandNames' => $allBrandNames,
        ]);

        // Close the statements
        $carStmt->close();
        $officeStmt->close();
        $carNamesStmt->close();
        $brandNamesStmt->close();
    } else {
        // Error in preparing the statements
        echo json_encode(['status' => 'error', 'message' => 'Error preparing statements']);
    }
} else {
    // If carId parameter is not set, return an error status
    echo json_encode(['status' => 'error', 'message' => 'Invalid request']);
}

// Close the database connection
$conn->close();
?>
