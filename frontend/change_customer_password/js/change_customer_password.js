// Function to check old password and update new password
function saveNewPassword() {
  // Get input values
  var oldPassword = document.getElementById("oldPassword").value;
  var newPassword = document.getElementById("newPassword").value;
  var confirmNewPassword = document.getElementById("confirmNewPassword").value;

  // AJAX request to check old password
  if (newPassword === confirmNewPassword) {
    console.log("jjjj");
  $.ajax({
    
    type: "POST",
    url: "http://localhost/final_db_admin/backend/change_customer_password/change_customer_password.php", // Adjust the path accordingly
    data: {
      oldPassword: oldPassword,
      newPassword: newPassword
    },
    success: function (response) {
      if (response === "success") {
        // Old password is correct, check new password
          // AJAX request to update the new password

          // if (response === "success") {
            alert("Password updated successfully!");
          //   // You can perform additional actions here if needed
          // } else {
          //   alert("Error updating password. Please try again.");
          // }

        }
       else {
        alert("Old password is incorrect.");
      }
    }
 
});
  }else{
    alert("password doesn't match Please try again.");
  }
}
