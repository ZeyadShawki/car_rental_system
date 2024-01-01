// Constants
const baseUrl = "http://localhost/final_db_admin/backend/";
function search(page = 1) {
  console.log("Search function called for page:", page);

  var searchTerm = document.getElementById("searchTerm").value;

  // AJAX call to fetch content for the specific page
  $.ajax({
    type: "POST",
    url: `${baseUrl}/show_all_customer_reservation/show_all_customer_reservation.php`,
    data: { searchTerm: searchTerm, page: page },
    dataType: "json",
    success: function (response) {
      if (response && response.data && response.data.length > 0) {
        displayResults(response.data);
        displayPagination(response.totalPages, page);
      } else {
        console.log("No results found.");
        document.getElementById("results").innerHTML = `
          <div class="alert alert-warning mt-3" role="alert">
            No reservations found.
          </div>
        `;
      }
    },
    error: function (error) {
      console.log(error.responseText);
      console.error("Error in search:", error);
    },
  });
}

// // Function to perform the search  l function dy kant bt3ml refresh lel page
// function search(page = 1) {
//   console.log("Search function called for page:", page);  // Debugging line

//   var searchTerm = document.getElementById("searchTerm").value;
//   var resultsDiv = document.getElementById("results");
//   resultsDiv.innerHTML = "";

//   // Clear the existing table content
//   var tbodyElement = document.querySelector(".table tbody");
//   if (tbodyElement) {
//     tbodyElement.innerHTML = "";
//   }

//   $.ajax({
//     type: "POST",
//     url: `${baseUrl}/show_all_customer_reservation/show_all_customer_reservation.php`,
//     data: { searchTerm: searchTerm, page: page },
//     dataType: "json",
//     success: function (response) {
//       if (response && response.data && response.data.length > 0) {
//         displayResults(response.data);
//         displayPagination(response.totalPages, page);
//       } else {
//         console.log("No results found.");
//         resultsDiv.innerHTML = `
//           <div class="alert alert-warning mt-3" role="alert">
//             No reservations found.
//           </div>
//         `;
//       }
//     },
//     error: function (error) {
//       console.log(error.responseText);
//       console.error("Error in search:", error);
//     },
//   });
// }

function displayResults(data) {
  var resultsDiv = document.getElementById("results");
  resultsDiv.innerHTML = "";

  var table =
    '<table class="table table-bordered table-striped"><thead>' +
    "<tr><th>Car Name</th><th>Brand</th><th>Reservation Date</th><th>Pickup Date</th><th>Return Date</th></tr></thead><tbody>";

  for (var i = 0; i < data.length; i++) {
    let ReservationDate = data[i].ReservationDate ? data[i].ReservationDate : "Not Reserved";

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
}

// function displayPagination(totalPages, currentPage) {
//   const paginationDiv = document.getElementById("pagination");
//   let paginationHTML = "";

//   for (let i = 1; i <= totalPages; i++) {
//     paginationHTML += `
//       <li class="page-item ${i === currentPage ? 'active' : ''}">
//         <a class="page-link" href="#" data-page="${i}">${i}</a>
//       </li>`;
//   }

//   paginationDiv.innerHTML = `
//     <nav aria-label="Page navigation example">
//       <ul class="pagination">
//         ${paginationHTML}
//       </ul>
//     </nav>`;

//   // Attach event listener to pagination links
//   const paginationLinks = document.querySelectorAll('.page-link');
//   paginationLinks.forEach(link => {
//     link.addEventListener('click', function(event) {
//       event.preventDefault();
//       const page = this.getAttribute('data-page');
//       search(page);  // Call the search function with the page number
//     });
//   });
// }

function displayPagination(totalPages, currentPage) {
  const paginationDiv = document.getElementById("pagination");
  let paginationHTML = "";

  for (let i = 1; i <= totalPages; i++) {
    paginationHTML += `
      <li class="page-item ${i === currentPage ? 'active' : ''}">
        <a class="page-link" href="#" data-page="${i}">${i}</a>
      </li>`;
  }

  paginationDiv.innerHTML = `
    <nav aria-label="Page navigation example">
      <ul class="pagination">
        ${paginationHTML}
      </ul>
    </nav>`;

  // Add event listeners to the pagination links
  const paginationLinks = paginationDiv.querySelectorAll('.page-link');
  paginationLinks.forEach(link => {
    link.addEventListener('click', function(event) {
      event.preventDefault();  // Prevent default action
      const page = this.getAttribute('data-page');
      search(page);  // Call the search function with the page number
    });
  });
}
