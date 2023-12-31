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

  if (customerData.imageLink) {

    $("#avatarImage").attr("src", customerData.imageLink);
  } else {
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
  // console.log(phoneNumber.length);
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
    return;
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
  // console.log('upadte imagee');
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
        alert('changed succefulyyy')
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
      // console.log('2222222222');
      console.log(response.imageLink);
      console.log(response);
    },
    error: function (error) {
      console.error("Error uploading image:", error);
    },
  });
  // console.log('3333333333');
  // console.log(myimageLink);
  return myimageLink;
}
