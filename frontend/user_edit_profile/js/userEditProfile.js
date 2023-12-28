
function getAllCustomerData() {
  $.ajax({
    url: "http://localhost/final_db_admin/backend/userEditProfile/userEditProfile.php",
    method: "GET",
    data: {
      get_user_data: true
    },
    dataType: "json",

    success: function (data) {
      // Update input values based on user interactions
      console.log(data);
      populateFields(data);
      
    },
    error: function (error) {
      console.error("Error fetching customer data:", error);
    },
  });
}

// Function to update input values based on user interactions
function populateFields(customerData) {
  // Sample: Assume you have input fields with the ids 'firstName', 'lastName', etc.
  $("#firstName").val(customerData.FirstName);
  $("#lastName").val(customerData.LastName);
  $("#phoneNumber").val(customerData.PhoneNumber);
  $("#bdate").val(customerData.bdate);
}

// Call the function to fetch all customer data when the page loads
$(document).ready(function () {
  getAllCustomerData();
});
//////////////////joirdi ////////////////////////

let originalPhoneNumber = ""; // To store the original phone number before editing

function editPhoneNumber() {
    // Store the current phone number
    originalPhoneNumber = document.getElementById('phoneNumberDisplay').innerText;
    // Hide the "Edit" button
    document.getElementById('editButton').style.display = 'none';
    // Show the edit input field
    document.getElementById('phoneNumberEdit').style.display = 'block';
    // Set the current phone number in the input field
    document.getElementById('newPhoneNumber').value = originalPhoneNumber;
    // 3shan lw knt 3amel abl keda w gbli error mesgge hashelha 
    document.getElementById('phoneNumberError').innerText = "";

}

$(document).ready(function () {
    $("#changePhoneNumber").submit(function (e) {
      e.preventDefault();
      savePhoneNumber();
    });
  });
  
function savePhoneNumber() {
    // Get the new phone number from the input field
    let newPhoneNumber = document.getElementById('newPhoneNumber').value;

    // Check if the phone number is empty
    if (newPhoneNumber.trim() === "") {
        // Display the error message span for an empty field
        document.getElementById('phoneNumberError').innerText = "Phone number cannot be empty!";
        document.getElementById('phoneNumberError').style.display = 'inline-block';
        return; // Exit the function without updating the displayed number
    } 

    // Check if the entered phone number has exactly 12 digits
    if (newPhoneNumber.length !== 12 || isNaN(newPhoneNumber)) {
        // Display the error message span for an invalid format
        document.getElementById('phoneNumberError').innerText = "Please enter a 12-digit number!";
        document.getElementById('phoneNumberError').style.display = 'inline-block';
        return; // Exit the function without updating the displayed number
    }

    
    // AJAX request
    $.ajax({
        type: "POST",
        url: '../../backend/userEditProfile/userEditProfile.php',
        data: {
          newPhoneNumber: newPhoneNumber,
          changePhoneNumber: true,
        },
        dataType: "text",
        success: function (response) {
          console.log(response);
   
        //   if (response === "success") {
        //        window.location.href =
        //          "http://localhost/final_db_admin/frontend/user_home/user_home_html.php";
        //   } else if (response === "email") {
        //     showError(document.getElementById("Email"), "Email Already Exists");
        //   } else if (response === "sqlfailure") {
        //     error.innerText = "Error sql query failure";
        //   } else {
        //     // Custom status code for email duplication error
        //     error.innerText = "Email duplication error. Status code: " + response;
        //   }


        },
      });
   

  //  If validation passes, hide the error message span
    document.getElementById('phoneNumberError').style.display = 'none';

    // Update the displayed phone number
    document.getElementById('phoneNumberDisplay').innerText = newPhoneNumber;

    // Show the "Edit" button and hide the edit input field
    document.getElementById('editButton').style.display = 'inline-block';
    document.getElementById('phoneNumberEdit').style.display = 'none';
}










function cancelEdit() {
    // Revert to the original phone number
    document.getElementById('phoneNumberDisplay').innerText = originalPhoneNumber;

    // Show the "Edit" button and hide the edit input field
    document.getElementById('editButton').style.display = 'inline-block';
    document.getElementById('phoneNumberEdit').style.display = 'none';
}




// Function to show password change fields
function showChangePasswordFields() {
    document.getElementById('buttonOfPassword').style.display = 'none';
    document.getElementById('passwordFields').style.display = 'block';
}

// Function to save and validate new password
function saveNewPassword() {
    let oldPassword = document.getElementById('oldPassword').value;
    let newPassword = document.getElementById('newPassword').value;
    let confirmNewPassword = document.getElementById('confirmNewPassword').value;

    // Simple validation: check if newPassword and confirmNewPassword match
    if (newPassword !== confirmNewPassword) {
        alert("New password and confirm password do not match!");
        return;
    }

    // TODO: You can add further validation here like checking old password, password strength, etc.

    // Once validated, you can send this data to the backend for further processing if required

    // Reset fields and hide the password change fields
    document.getElementById('oldPassword').value = "";
    document.getElementById('newPassword').value = "";
    document.getElementById('confirmNewPassword').value = "";
    document.getElementById('passwordFields').style.display = 'none';
    document.getElementById('changePasswordSection').style.display = 'block';
}

// Function to cancel password change
function cancelPasswordChange() {
    // Reset fields and hide the password change fields
    document.getElementById('oldPassword').value = "";
    document.getElementById('newPassword').value = "";
    document.getElementById('confirmNewPassword').value = "";
    document.getElementById('passwordFields').style.display = 'none';
    document.getElementById('buttonOfPassword').style.display = 'inline-block';
}
