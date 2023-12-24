
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
      table +=
        "<tr><td>" +
        data[i].carname +
        "</td><td>" +
        data[i].brand +
        "</td><td>" +
        data[i].ReservationDate +
        "</td><td>" +
        data[i].FirstName +
        " " +
        data[i].LastName +
        "</td></tr>";
    }
    table += "</tbody></table>";
    resultsDiv.innerHTML = table;
  } else {
    resultsDiv.innerHTML = "No results found.";
  }
}

