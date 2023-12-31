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
      validationMessages.innerHTML += '<p>You must choose both pickup and return dates.</p>';
      return;
    } else {
        if (pickupDate >= returnDate) {
            validationMessages.innerHTML += '<p>Return date must be after the pickup date.</p>';
            return;
        }
    
        if (pickupDate < currentDate) {
            validationMessages.innerHTML += '<p>Pickup date must be in the future.</p>';
            return;
        }
    }

    // Format the date as 'YYYY-MM-DD' 3shan a3rf akrno bel f databases
    var formattedNewPickupDate = pickupDate.toISOString().split('T')[0];
    var formattedNewReturnupDate = returnDate.toISOString().split('T')[0];


    var plateid = document.getElementById("plateid").value;
    console.log(plateid); 

    $.ajax({
      type: "POST",// hb3t
      url: "../../backend/user_rent/user_rent.php",// go to this php file
      data: {
        pickup_date : formattedNewPickupDate,
        return_date : formattedNewReturnupDate,
        plate_id : plateid,
        rent_submit: true
      },
      dataType: "text",
      success: function(response){
      console.log("FROM AJAX")
      console.log(response);
      reciveddata.innerHTML = response;      
      }
  });
  });
});



document.addEventListener('DOMContentLoaded', function() {
  // Get the rent value per day from PHP (assuming it's stored in a JavaScript variable)
  var rentValuePerDay = this.getElementById("priceperday").value;
  console.log("hiii");
  // Add event listeners to both date input fields
  document.getElementById('pickupDate').addEventListener('change', updateTotalPrice);
  document.getElementById('returnDate').addEventListener('change', updateTotalPrice);

  function updateTotalPrice() {
      var pickupDate = new Date(document.getElementById('pickupDate').value);
      var returnDate = new Date(document.getElementById('returnDate').value);

      // Calculate the difference in days
      var timeDifference = returnDate.getTime() - pickupDate.getTime();
      var daysDifference = timeDifference / (1000 * 3600 * 24);

      // Calculate total price
      var totalPrice = daysDifference * rentValuePerDay;

      // Update the text content of the element with id "totalprice"
      document.getElementById('totalprice').textContent = 'Total Price: ' + totalPrice.toFixed(2) + ' (for ' + daysDifference + ' days)';
  }
});
