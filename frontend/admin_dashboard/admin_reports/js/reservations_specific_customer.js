$(document).ready(function () {
  window.searchResCus = function () {
      var customerId = document.getElementById('customerId').value;

      if (!customerId) {
          // Display an alert if the customer ID is empty
          alert('Please enter a Customer ID');
          return;
      }

      $.ajax({
          type: 'POST',
          url: 'http://localhost/final_db_admin/backend/admin_dashboard_controller/reservations_specific_customer.php',
          data: { customer_id: customerId },
          dataType: 'json',
          success: function (data) {
        console.log(data);
        // Display the search results in a Bootstrap table
        var resultsContainer = $('.container.mt-4');
        resultsContainer.empty();
        resultsContainer.append('<p>Search results:</p>');

        // Create a Bootstrap table
        var table = $('<table class="table 1">');
        table.append('<thead><tr><th>ReservationID</th><th>CustomerID</th><th>CustomerFirstName</th><th>CustomerLastName</th><th>CustomerEmail</th><th>CustomerPhoneNumber</th><th>CustomerPassword</th><th>CustomerSex</th><th>CustomerBirthDate</th><th>CustomerAmount</th><th>plateID</th><th>carname</th><th>brand</th><th>carYear</th><th>carImageUrl</th><th>carRentValue</th><th>ReservationDate</th><th>PickupDate</th><th>ReturnDate</th></tr></thead>');

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
          row.append('<td>' + result.CustomerPassword+ '</td>');
          row.append('<td>' + result.CustomerSex+ '</td>');
          row.append('<td>' + result.CustomerBirthDate+ '</td>');
          row.append('<td>' + result.CustomerAmount+ '</td>');
          row.append('<td>' + result.plateID+ '</td>');
          row.append('<td>' + result.carname+ '</td>');
          row.append('<td>' + result.brand+ '</td>');
          row.append('<td>' + result.carYear+ '</td>');
row.append(
  '<td><img src="' +
    result.carImageUrl +
    '" alt="Car Image" width="100" height="100"></td>'
);
          row.append('<td>' + result.carRentValue+ '</td>');
          row.append('<td>' + result.ReservationDate+ '</td>');
          row.append('<td>' + result.PickupDate+ '</td>');
          row.append('<td>' + result.PickupDate+ '</td>');

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
