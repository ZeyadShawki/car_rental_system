function saveNewPassword() {
  // Reset error messages and classes
  resetValidation();

  // Get input values
  var oldPassword = document.getElementById("oldPassword").value;
  var newPassword = document.getElementById("newPassword").value;
  var confirmNewPassword = document.getElementById("confirmNewPassword").value;

  // Validate old password
  if (validateInput(oldPassword, "oldPassword")) {
    // Validate new password
    if (validateInput(newPassword, "newPassword")) {
      // Validate confirm new password
      if (validateInput(confirmNewPassword, "confirmNewPassword")) {
        // AJAX request to check old password
        $.ajax({
          type: "POST",
          url: "http://localhost/final_db_admin/backend/change_customer_password/change_customer_password.php",
          data: {
            oldPassword: oldPassword,
            newPassword: newPassword,
          },
          success: function (response) {
            console.log(response);

            if (response === "success") {
              // Old password is correct, check new password

              // AJAX request to update the new password
              // if (response === "success") {
              alert("Password updated successfully!");
              //   // You can perform additional actions here if needed
              // } else {
              //   alert("Error updating password. Please try again.");
              // }
                  window.location.href =
                    "http://localhost/final_db_admin/frontend/user_home/user_home_html.php";

            } else {
              alert("Old password is incorrect.");
            }
          },
        });
      }
    }
  }
}

function validateInput(value, inputName) {
  // Check if the input is not empty and has at least 8 characters
  if (value.length > 0 && value.length >= 8) {
    return true;
  } else {
    // Display error message and add Bootstrap error classes
    var errorMessageDiv = document.getElementById(inputName + "-error");
    errorMessageDiv.innerHTML =
      "Field must not be empty and must have at least 8 characters.";
    errorMessageDiv.style.color = "red";

    // Add Bootstrap error classes to the input field
    document.getElementById(inputName).classList.add("is-invalid");

    return false;
  }
}

function resetValidation() {
  // Reset error messages and classes for all inputs
  var inputs = ["oldPassword", "newPassword", "confirmNewPassword"];
  for (var i = 0; i < inputs.length; i++) {
    var inputName = inputs[i];
    var errorMessageDiv = document.getElementById(inputName + "-error");

    // Reset error message
    errorMessageDiv.innerHTML = "";

    // Remove Bootstrap error classes
    document.getElementById(inputName).classList.remove("is-invalid");
  }
}
