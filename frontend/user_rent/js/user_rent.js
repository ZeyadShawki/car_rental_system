$(document).ready(function(){
  $("#rent-form").submit(function(e){
    e.preventDefault();
    var reciveddata = document.getElementById('reciveddata');
    var pickupDate = new Date(document.getElementById('pickupDate').value);
    var returnDate = new Date(document.getElementById('returnDate').value);
    var currentDate = new Date();
    var validationMessages = document.getElementById('validation-messages');
    validationMessages.innerHTML = ''; // Clear previous messages
  if (isNaN(pickupDate.getTime()) || isNaN(returnDate.getTime())) {
    validationMessages.innerHTML +=
      '<p class="text-danger">You must choose both pickup and return dates.</p>';
    return;
  } else {
    if (pickupDate >= returnDate) {
      validationMessages.innerHTML +=
        '<p class="text-danger">Return date must be after the pickup date.</p>';
      return;
    }

    if (pickupDate < currentDate) {
      validationMessages.innerHTML +=
        '<p class="text-danger">Pickup date must be in the future.</p>';
      return;
    }
  }
    var formattedNewPickupDate = pickupDate.toISOString().split('T')[0];
    var formattedNewReturnupDate = returnDate.toISOString().split('T')[0];
    var plateid = document.getElementById("plateid").value;
    console.log(plateid); 
    $.ajax({
      type: "POST", // hb3t
      url: "../../backend/user_rent/user_rent.php", // go to this php file
      data: {
        pickup_date: formattedNewPickupDate,
        return_date: formattedNewReturnupDate,
        plate_id: plateid,
        rent_submit: true,
      },
      dataType: "text",
      success: function (response) {
  
          console.log("FROM AJAX");
          console.log(response);

          reciveddata.innerHTML = response;
        alert('reserved successfully');
        window.location.href = "http://localhost/final_db_admin/frontend/user_home/user_home_html.php"; 
      },
      error: function (xhr, status, error) {
        console.error(xhr.responseText);
        if (xhr.status === 400) {
          // Handle specific error code (Bad Request)
          alert("Reservation failed: " + JSON.parse(xhr.responseText).message);
        } else {
          // Handle other error codes or generic errors
          alert("Reservation failed. Please try again later.");
        }
      },
    });
  });
});


document.addEventListener('DOMContentLoaded', function() {
  var rentValuePerDay = parseFloat(document.getElementById("priceperday").textContent);
  
  document.getElementById('pickupDate').addEventListener('change', updateTotalPrice);
  document.getElementById('returnDate').addEventListener('change', updateTotalPrice);

  function updateTotalPrice() {
    var pickupDateValue = document.getElementById('pickupDate').value;
    var returnDateValue = document.getElementById('returnDate').value;

    if (!pickupDateValue || !returnDateValue) {   
      return;
    }

    var pickupDate = new Date(pickupDateValue);
    var returnDate = new Date(returnDateValue);
    var currentDate = new Date(); // Current date

    // Clear previous validation messages
    var validationMessages = document.getElementById('validation-messages');
    validationMessages.innerHTML = '';

    // Validation: Check if pickupDate is in the future
    if (pickupDate <= currentDate) {
      validationMessages.innerHTML += '<p>Pickup date should be in the future.</p>';
      return;
    }

    // Validation: Check if returnDate is after pickupDate
    if (returnDate <= pickupDate) {
      validationMessages.innerHTML += '<p>Return date should be after the pickup date.</p>';
      return;
    }

    // Calculate the difference in days
    var timeDifference = returnDate.getTime() - pickupDate.getTime();
    var daysDifference = timeDifference / (1000 * 3600 * 24);

    // Calculate total price
    var totalPrice = daysDifference * rentValuePerDay;

    // Update the text content of the element with id "totalprice"
    document.getElementById("totalpriceId").textContent =
      totalPrice.toFixed(2) + " (for " + daysDifference + " days)";
  }
});

