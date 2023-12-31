function getAllCustomerData() {
  $.ajax({
    url: "http://localhost/final_db_admin/backend/userEditProfile/userEditProfile.php",
    method: "GET",
    data: {
      get_user_data: true,
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
  $("#email").text(customerData.Email); // Use .text() to set the label text
  $("#firstName").val(customerData.FirstName);
  $("#lastName").val(customerData.LastName);
  $("#phoneNumber").val(customerData.PhoneNumber);
  $("#bdate").val(customerData.bdate);

  if (customerData.imageLink){

    $("#avatarImage").attr("src", customerData.imageLink);
  }else{
        $("#avatarImage").attr(
          "src",
          "http://localhost/final_db_admin/backend/uploaded_images/Image_not_available (1).png"
        );

  }
}

// Call the function to fetch all customer data when the page loads
$(document).ready(function () {
  getAllCustomerData();
});


// Function to handle editing of customer profile
async function editCustomerProfile() {
  // Sample: Assume you have input fields with the ids 'firstName', 'lastName', 'phoneNumber', 'bdate'
  var firstName = $("#firstName").val();
  var lastName = $("#lastName").val();
  var phoneNumber = $("#phoneNumber").val();
  var bdate = $("#bdate").val();

  // Clear previous error messages and styles
  $(".error-message").remove();
  $(".form-control").removeClass("is-invalid");

  // Validate required fields
  if (!firstName) {
    $(
      "<span class='error-message text-danger'>First name cannot be empty</span>"
    ).insertAfter("#firstName");
    $("#firstName").addClass("is-invalid");
  }

  if (!lastName) {
    $(
      "<span class='error-message text-danger'>Last name cannot be empty</span>"
    ).insertAfter("#lastName");
    $("#lastName").addClass("is-invalid");
  }
  console.log(phoneNumber.length);
  if (!phoneNumber) {
    $(
      "<span class='error-message text-danger'>Phone number cannot be empty</span>"
    ).insertAfter("#phoneNumber");
    $("#phoneNumber").addClass("is-invalid");
  }

  if (phoneNumber.length != 11 || isNaN(phoneNumber)) {
    $(
      "<span class='error-message text-danger'>please enter 11 digits phone number</span>"
    ).insertAfter("#phoneNumber");
    $("#phoneNumber").addClass("is-invalid");
  }

  if (!bdate) {
    $(
      "<span class='error-message text-danger'>Birth Date cannot be empty</span>"
    ).insertAfter("#bdate");
    $("#bdate").addClass("is-invalid");
  }

  if (!firstName || !lastName || !phoneNumber || !bdate) {
    return;
  }

  console.log('upadte imagee');
  const imagelink = await uploadImage(); // Wait until the image link is populated

  console.log(imagelink);
  // AJAX request to edit customer profile
  $.ajax({
    url: "http://localhost/final_db_admin/backend/userEditProfile/userEditProfile.php", // Adjust the path accordingly
    method: "POST",
    dataType: "json",
    data: {
      edit_customer_profile: true,
      firstName: firstName,
      lastName: lastName,
      phoneNumber: phoneNumber,
      bdate: bdate,
      imagelink: imagelink,
    },
    success: function (response) {
      if (response.success) {
        console.log(response);
        alert('changed success fulyyy')
        // Reload the page after a successful update
        // location.reload();
        // alert('Changed successs fully')
      } else {
        alert(response.message);
      }
    },
    error: function (error) {
      console.log(error.responseText);
      console.error("Error updating customer profile:", error);
    },
  });
}

// Function to open the file input when the image is clicked
function openFileInput() {
  $("#fileInput").click();
}

// Function to display the selected image
function displaySelectedImage() {
  var input = document.getElementById("fileInput");

  // Check if a file is selected
  if (input.files && input.files[0]) {
    var reader = new FileReader();

    reader.onload = function (e) {


      // Update the image source with the selected image
      $("#avatarImage").attr("src", e.target.result);
    };

    // Read the selected image as a data URL
    reader.readAsDataURL(input.files[0]);
  }
}

// Variable to store the current image link

// Function to handle image upload
async function uploadImage() {
  var input = document.getElementById("fileInput");

  // Check if a file is selected
  if (input.files && input.files[0]) {
    var formData = new FormData();
    formData.append("image", input.files[0]);


    console.log(';form datata');
    console.log(input.files[0]);
    return await performImageUpload(formData);

    // AJAX request to check if the image link is different
    // $.ajax({
    //   url: "http://localhost/final_db_admin/backend/userEditProfile/userEditProfile.php", // Adjust the path accordingly
    //   method: "GET",
    //   dataType: "json",
    //   success: function (data) {
    //     // if (data && data.imageLink && data.imageLink !== currentImageLink) {
    //     //   // Image link is different, proceed with upload

    //     //   console.log('aaaaaaaaaaaa');
    //     //   performImageUpload(formData);
    //     // } else {
    //     //   // Image link is the same, no need to upload
    //     //   console.log("Image link is the same. No upload needed.");
    //     // }

    //               performImageUpload(formData);

    //   },
    //   error: function (error) {
    //     console.error("Error checking existing image link:", error);
    //   },
    // });
  }
}

// Function to perform the image upload
async function performImageUpload(formData) {
  // AJAX request to upload the image
  let myimageLink = 'sss';
  await $.ajax({
    url: "http://localhost/final_db_admin/backend/userEditProfile/upload_image.php",
    method: "POST",
    processData: false,
    contentType: false,
    data: formData,
    success: function (response) {
      // Update the image source with the uploaded image link
      $("#avatarImage").attr("src", response.imageLink);
      // Update the current image link
      myimageLink = response.imageLink;
      console.log('2222222222');
      console.log(response.imageLink);
      console.log(response);
    },
    error: function (error) {
      console.error("Error uploading image:", error);
    },
  });
  console.log('3333333333');
  console.log(myimageLink);
  return myimageLink;
}

//////////////////joirdi ////////////////////////

// let originalPhoneNumber = ""; // To store the original phone number before editing

// function editPhoneNumber() {
//   // Store the current phone number
//   originalPhoneNumber = document.getElementById("phoneNumberDisplay").innerText;
//   // Hide the "Edit" button
//   document.getElementById("editButton").style.display = "none";
//   // Show the edit input field
//   document.getElementById("phoneNumberEdit").style.display = "block";
//   // Set the current phone number in the input field
//   document.getElementById("newPhoneNumber").value = originalPhoneNumber;
//   // 3shan lw knt 3amel abl keda w gbli error mesgge hashelha
//   document.getElementById("phoneNumberError").innerText = "";
// }

// $(document).ready(function () {
//   $("#changePhoneNumber").submit(function (e) {
//     e.preventDefault();
//     savePhoneNumber();
//   });
// });

// function savePhoneNumber() {
//   // Get the new phone number from the input field
//   let newPhoneNumber = document.getElementById("newPhoneNumber").value;

//   // Check if the phone number is empty
//   if (newPhoneNumber.trim() === "") {
//     // Display the error message span for an empty field
//     document.getElementById("phoneNumberError").innerText =
//       "Phone number cannot be empty!";
//     document.getElementById("phoneNumberError").style.display = "inline-block";
//     return; // Exit the function without updating the displayed number
//   }

//   // Check if the entered phone number has exactly 12 digits
//   if (newPhoneNumber.length !== 12 || isNaN(newPhoneNumber)) {
//     // Display the error message span for an invalid format
//     document.getElementById("phoneNumberError").innerText =
//       "Please enter a 12-digit number!";
//     document.getElementById("phoneNumberError").style.display = "inline-block";
//     return; // Exit the function without updating the displayed number
//   }

//   // AJAX request
//   $.ajax({
//     type: "POST",
//     url: "../../backend/userEditProfile/userEditProfile.php",
//     data: {
//       newPhoneNumber: newPhoneNumber,
//       changePhoneNumber: true,
//     },
//     dataType: "text",
//     success: function (response) {
//       console.log(response);

//       //   if (response === "success") {
//       //        window.location.href =
//       //          "http://localhost/final_db_admin/frontend/user_home/user_home_html.php";
//       //   } else if (response === "email") {
//       //     showError(document.getElementById("Email"), "Email Already Exists");
//       //   } else if (response === "sqlfailure") {
//       //     error.innerText = "Error sql query failure";
//       //   } else {
//       //     // Custom status code for email duplication error
//       //     error.innerText = "Email duplication error. Status code: " + response;
//       //   }
//     },
//   });

//   //  If validation passes, hide the error message span
//   document.getElementById("phoneNumberError").style.display = "none";

//   // Update the displayed phone number
//   document.getElementById("phoneNumberDisplay").innerText = newPhoneNumber;

//   // Show the "Edit" button and hide the edit input field
//   document.getElementById("editButton").style.display = "inline-block";
//   document.getElementById("phoneNumberEdit").style.display = "none";
// }

// function cancelEdit() {
//   // Revert to the original phone number
//   document.getElementById("phoneNumberDisplay").innerText = originalPhoneNumber;

//   // Show the "Edit" button and hide the edit input field
//   document.getElementById("editButton").style.display = "inline-block";
//   document.getElementById("phoneNumberEdit").style.display = "none";
// }

// // Function to show password change fields
// function showChangePasswordFields() {
//   document.getElementById("buttonOfPassword").style.display = "none";
//   document.getElementById("passwordFields").style.display = "block";
// }

// // Function to save and validate new password
// function saveNewPassword() {
//   let oldPassword = document.getElementById("oldPassword").value;
//   let newPassword = document.getElementById("newPassword").value;
//   let confirmNewPassword = document.getElementById("confirmNewPassword").value;

//   // Simple validation: check if newPassword and confirmNewPassword match
//   if (newPassword !== confirmNewPassword) {
//     alert("New password and confirm password do not match!");
//     return;
//   }

//   // TODO: You can add further validation here like checking old password, password strength, etc.

//   // Once validated, you can send this data to the backend for further processing if required

//   // Reset fields and hide the password change fields
//   document.getElementById("oldPassword").value = "";
//   document.getElementById("newPassword").value = "";
//   document.getElementById("confirmNewPassword").value = "";
//   document.getElementById("passwordFields").style.display = "none";
//   document.getElementById("changePasswordSection").style.display = "block";
// }

// // Function to cancel password change
// function cancelPasswordChange() {
//   // Reset fields and hide the password change fields
//   document.getElementById("oldPassword").value = "";
//   document.getElementById("newPassword").value = "";
//   document.getElementById("confirmNewPassword").value = "";
//   document.getElementById("passwordFields").style.display = "none";
//   document.getElementById("buttonOfPassword").style.display = "inline-block";
// }
