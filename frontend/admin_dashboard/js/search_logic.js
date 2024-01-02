// import {baseUrl} from "../../api_constants.js" ;
// console.log(baseUrl);

const baseUrl = "http://localhost/final_db_admin/backend/";
function search() {
  var searchTerm = document.getElementById("searchTerm").value;

  $.ajax({
    type: "POST",
    url: `${baseUrl}/admin_dashboard_controller/admin_advanced_search.php`,
    data: { searchTerm: searchTerm },
    dataType: "json",
    success: function (data) {
      displayResults(data);
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
      "<tr><th>Car Name</th><th>Brand</th><th>Reservation Date</th><th>Customer Name</th></tr></thead><tbody>";
    for (var i = 0; i < data.length; i++) {
      let ReservationDate = "Not Reserved";
      let FirstName = "No user Reserved This car";
            let LastName = "";

      if (data[i].ReservationDate) {
        ReservationDate = data[i].ReservationDate;
      }

      if (data[i].FirstName) {
        FirstName = data[i].FirstName;
      }
        if (data[i].LastName) {
          LastName = data[i].LastName;
        }

      table +=
        "<tr><td>" +
        data[i].carname +
        "</td><td>" +
        data[i].brand +
        "</td><td>" +
        ReservationDate +
        "</td><td>" +
       FirstName +
        " " +
       LastName +
        "</td></tr>";
    }
    table += "</tbody></table>";
    resultsDiv.innerHTML = table;
  } else {
    resultsDiv.innerHTML = "No results found.";
  }
}
// Define the clear function
function clearResaults() {
  var tableBody = document.getElementById("results");
  tableBody.innerHTML = "";
}
