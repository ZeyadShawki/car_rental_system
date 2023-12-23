$(document).ready(function(){
    $("#search-form").submit(function(e){
        e.preventDefault();
        // Log a message to the console
        console.log('This message will be displayed in the browser console.');

        var plateId = document.getElementById('plateIDSelect').value;
        var brand = document.getElementById('brandSelect').value;
        var date = document.getElementById('pickupDateSelect').value;
        var reservationData = document.getElementById('reservationData');
        reservationData.innerHTML = "";
        console.log(date,brand,plateId)

        $.ajax({
          type: "POST",// hb3t
          url: "../../backend/user_profile/profile.php",// go to this php file
          data: {
            plate_id : plateId ,// el variables l hb3tha b POST
            car_brand : brand ,
            pick_date: date,
            search: true
          },
          dataType: "text",
          success: function(response){
            console.log(response);
              reservationData.innerHTML = response;
            // } else if(response === 'invalidPassword'){
            //   error.innerText = "Invalid Password";
            // } else if(response === 'invalidEmail'){
            //   error.innerText = "Invalid Email";
            // } else {
            //   error.innerText = "Error";
            // }
          }
      });
    });
});
