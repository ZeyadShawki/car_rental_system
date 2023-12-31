// Constants
const baseUrl = "http://localhost/final_db_admin/backend/";

// Function to perform the search
function search() {
  var searchTerm = document.getElementById("searchTerm").value;
  var resultsDiv = document.getElementById("results");
  resultsDiv.innerHTML = "";

  // Clear the existing table content
  var tbodyElement = document.querySelector(".table tbody");
  if (tbodyElement) {
    tbodyElement.innerHTML = "";
  }

  $.ajax({
    type: "POST",
    url: `${baseUrl}/show_all_customer_reservation/show_all_customer_reservation.php`,
    data: { searchTerm: searchTerm },
    dataType: "json",
    success: function (data) {
      if (data && data.length > 0) {
        displayResults(data);
      } else {
        console.log("No results found.");
      }
    },
    error: function (error) {
      console.log(error.responseText);
      console.error("Error in search:", error);
    },
  });
}
function displayResults(data) {
  var resultsDiv = document.getElementById("results");
  resultsDiv.innerHTML = "";


  if (data.length > 0) {
    var table =
      '<table class="table table-bordered table-striped"><thead>' +
      "<tr><th>Car Name</th><th>Brand</th><th>Reservation Date</th><th>Pickup Date</th><th>Return Date</th></tr></thead><tbody>";

    for (var i = 0; i < data.length; i++) {
      let ReservationDate = "Not Reserved";
      
      if (data[i].ReservationDate) {
        ReservationDate = data[i].ReservationDate;
      }
      
      table +=
        "<tr><td>" +
        data[i].carname +
        "</td><td>" +
        data[i].brand +
        "</td><td>" +
        ReservationDate +
        "</td> <td>" +
        data[i].PickupDate +
        "</td> <td>" +
        data[i].ReturnDate +
        "</td> </tr>";
    }

    table += "</tbody></table>";
    resultsDiv.innerHTML = table;
  } else {
    // Display a Bootstrap alert if no reservations are found
    resultsDiv.innerHTML = `
      <div class="alert alert-warning mt-3" role="alert">
        No reservations found.
      </div>
    `;
  }
}
