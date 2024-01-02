$(document).ready(function () {
  // Fetch car data using AJAX

  window.searchReservations = function () {
    var startDate = document.getElementById('startDate').value;
    var endDate = document.getElementById('endDate').value;

    if (!startDate || !endDate) {
      // Display an alert if either startDate or endDate is empty
      alert('Please enter both start date and end date.');
      return;
    }

    // Parse the date strings into Date objects for comparison
    var parsedStartDate = new Date(startDate);
    var parsedEndDate = new Date(endDate);

    // Check if startDate is before endDate
    if (parsedStartDate >= parsedEndDate) {
      // Display an alert if startDate is not before endDate
      alert('Start date must be before end date.');
      return;
    }

    // Perform AJAX request to fetch reservations within the specified period
    $.ajax({
      type: 'POST',
      url: 'http://localhost/final_db_admin/backend/admin_dashboard_controller/search_reservations.php',
      data: { start_date: startDate, end_date: endDate },
      dataType: 'json',
      success: function (data) {
        console.log(data);
        // Display the search results in a Bootstrap table
        var resultsContainer = $('.container.mt-4');
        resultsContainer.empty();
        resultsContainer.append('<p>Search results:</p>');

        // Create a Bootstrap table
        var table = $('<table class="table 1">');
        table.append('<thead><tr><th>Reservation ID</th><th>Customer ID</th><th>Customer First Name</th><th>Customer Last Name</th><th>Email</th><th>Phone Number</th><th>Plate ID</th><th>Car Name</th><th>Brand</th><th>Year</th><th>Image URL</th><th>Rent Value</th><th>Reservation Date</th><th>Pickup Date</th><th>Return Date</th></tr></thead>');

        // Create table body
        var tbody = $('<tbody>');
        $.each(data, function (index, result) {
          var row = $('<tr>');
          // Add each field to the table row
          row.append('<td>' + result.ReservationID + '</td>');
          row.append('<td>' + result.CustomerID + '</td>');
          row.append('<td>' + result.CustomerFirstName + '</td>');
          row.append('<td>' + result.CustomerLastName + '</td>');
          row.append('<td>' + result.CustomerEmail + '</td>');
          row.append('<td>' + result.CustomerPhoneNumber + '</td>');
          row.append('<td>' + result.plateID + '</td>');
          row.append('<td>' + result.carname + '</td>');
          row.append('<td>' + result.brand + '</td>');
          row.append('<td>' + result.carYear + '</td>');
          row.append(
            '<td><img src="' +
              result.carImageUrl +
              '" alt="Car Image" width="100" height="100"></td>'
          );          row.append('<td>' + result.carRentValue + '</td>');
          row.append('<td>' + result.ReservationDate + '</td>');
          row.append('<td>' + result.PickupDate + '</td>');
          row.append('<td>' + result.ReturnDate + '</td>');
          tbody.append(row);
        });

        table.append(tbody);
        resultsContainer.append(table);
      },
      error: function (xhr, status, error) {
        console.error(xhr.responseText);
        // alert('Error searching reservations: ' + xhr.responseText);
      },
    });
  };

  // Initial fetch when the page loads
});
