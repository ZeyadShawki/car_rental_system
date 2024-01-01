$(document).ready(function () {
  $("#login-form").submit(function (e) {
    e.preventDefault();
    validate();
  });
});

function validate() {
  const email = document.getElementById("email").value;
  const password = document.getElementById("password").value;

  // Clear previous errors
  const errors = document.querySelectorAll(".error");
  errors.forEach((error) => error.remove());

  // Check if email and password are not empty
  if (!email.trim()) {
    showError(document.getElementById("email"), "Email cannot be empty");
    return;
  }

  if (!password.trim()) {
    showError(document.getElementById("password"), "Password cannot be empty");
    return;
  }
  console.log('sssssdsdsd');
  // AJAX request
  $.ajax({
    type: "POST",
    url: "http://localhost/final_db_admin/backend/login_controller/login_controller.php",
    data: {
      email: email,
      password: password,
      login: true,
    },
    dataType: "json", // Change the data type to JSON
    success: function (response) {
      console.log('aaassas');
      console.log(response.status);
      if (response.status === "success") {
        console.log('aaaa');
        if (response.isAdmin) {
          // Redirect to admin page
          window.location.href =
            "http://localhost/final_db_admin/frontend/admin_dashboard/admin_dashboard.html";
        } else {
          // Redirect to regular user page
          window.location.href =
            "http://localhost/final_db_admin/frontend/user_home/user_home_html.php";
        }
      } else if (response.status === "failure") {
        showError(
          document.getElementById("error-container"),
          "Invalid email or password"
        );
      } else {
        showError(document.getElementById("error-container"), "Error");
      }
    }, error: function (params) {
      console.log(params);
      showError(
        document.getElementById("error-container"),
        params.responseText
      );
    }
  });
}

function showError(input, errorMessage) {
  const errorElement = document.createElement("div");
  errorElement.className = "error alert alert-danger mt-2";
  errorElement.innerText = errorMessage;

  const parent = input.parentElement;
  parent.appendChild(errorElement);
}

function removeError(input) {
  const parent = input.parentElement;
  const errorElement = parent.querySelector(".error");
  if (errorElement) {
    parent.removeChild(errorElement);
  }
}
