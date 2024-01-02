$(document).ready(function () {
  // Fetch car data using AJAX

  window.searchStatus = function () {
    var startDate = document.getElementById('startDate').value;

    // if (!startDate) {
    //   // Display an alert if either startDate or endDate is empty
    //   alert('Please enter both  date ');
    //   return;
    // }

    // Perform AJAX request to fetch reservations within the specified period
    $.ajax({
      type: 'POST',
      url: 'http://localhost/final_db_admin/backend/admin_dashboard_controller/cars_status.php',
      data: { start_date: startDate },
      dataType: 'json',
      success: function (data) {
        console.log(data);
        // Display the search results in a Bootstrap table
        var resultsContainer = $('.container.mt-4');
        resultsContainer.empty();
        resultsContainer.append('<p>Search results:</p>');

        // Create a Bootstrap table
        var table = $('<table class="table 1">');
        table.append('<thead><tr><th>plateID</th><th>carname</th><th>brand</th><th>carYear</th><th>carImageUrl</th><th>carRentValue</th><th>CarStatusOnSpecificDay</th></tr></thead>');

        // Create table body
        var tbody = $('<tbody>');
        $.each(data, function (index, result) {
          var row = $('<tr>');
          // Add each field to the table row
          row.append('<td>' + result.plateID + '</td>');
          row.append('<td>' + result.carname + '</td>');
          row.append('<td>' + result.brand + '</td>');
          row.append('<td>' + result.carYear + '</td>');
row.append(
  '<td><img src="' +
    result.carImageUrl +
    '" alt="Car Image" width="100" height="100"></td>'
);          row.append('<td>' + result.carRentValue + '</td>');
          row.append('<td>' + result.CarStatusOnSpecificDay+ '</td>');
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
