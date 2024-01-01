// Add this event listener to handle password toggle
$(document).on("click", ".toggle-password", function () {
  const targetId = $(this).data("target");
  const passwordInput = document.getElementById(targetId);
  const type = passwordInput.type === "password" ? "text" : "password";
  passwordInput.type = type;
  $(this).text(type === "password" ? "Show" : "Hide");
});

// 3shan lw rg3t lel page 2la2i l fields fadya
window.addEventListener("pageshow", function (event) {
  if (event.persisted) {
    // The page was loaded from cache, clear the form fields
    document.getElementById("register-form").reset();
  }
});

$(document).ready(function () {
  $("#register-form").submit(function (e) {
    e.preventDefault();
    validate();
  });
});

function validate() {
  const FirstName = document.getElementById("FirstName").value;
  const LastName = document.getElementById("LastName").value;
  const Email = document.getElementById("Email").value;
  const ContactNumber = document.getElementById("ContactNumber").value;
  const inputDate = document.getElementById("Date").value;
  const pass = document.getElementById("pass").value;
  const confirmpassword = document.getElementById("confirmpassword").value;
  const selectedSex = document.getElementById("sex").value;

  var inputs = document.getElementsByClassName("form-control");
  var error = document.getElementById("error");
  error.innerText = "";
  const errors = document.querySelectorAll(".error");
  errors.forEach((error) => error.remove());

  for (let i = 0; i < inputs.length; i++) {
    const input = inputs[i];

    // Check for First Name and Last Name
    if (input.id === "FirstName" || input.id === "LastName") {
      if (input.value.trim().length === 0) {
        showError(
          input,
          `${input.getAttribute("placeholder")} cannot be empty`
        );
        return;
      } else {
        removeError(input);
      }
    } else {
      // Check for other fields (excluding radio and checkbox inputs)
      if (input.type !== "radio" && input.type !== "checkbox") {
        if (input.value.trim().length === 0) {
          showError(
            input,
            `${input.getAttribute("placeholder")} cannot be empty`
          );
          return;
        } else {
          removeError(input);
        }
      }
    }
  }

  if (ContactNumber.length != 11 ) {
    showError(
      document.getElementById("ContactNumber"),
      "please enter 11 digit number"
    );
    return;
  } else {
    removeError(document.getElementById("ContactNumber"));
  }



  // Password and confirm password validation
  if (pass != confirmpassword) {
    showError(
      document.getElementById("confirmpassword"),
      "Password and confirm password don't match."
    );
    return;
  } else {
    removeError(document.getElementById("confirmpassword"));
  }
console.log("length")
console.log(confirmpassword.length);

  if (confirmpassword.length < 8 ) {
    showError(
      document.getElementById("confirmpassword"),
      "confirm password must be at least 8 char xxxxx ."
    );
    return;
  } else {
    removeError(document.getElementById("confirmpassword"));
  }



  console.log("test pass");
  if (pass.length < 8 ) {
    showError(
      document.getElementById("pass"),
      "password must be at least 8 char  ."
    );
    return;
  } else {
    removeError(document.getElementById("pass"));
  }



  // Email validation
  const emailRegex = /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/;
  if (!emailRegex.test(Email)) {
    showError(document.getElementById("Email"), "Invalid email format.");
    return;
  } else {
    removeError(document.getElementById("Email"));
  }

  // Date validation
  if (!inputDate) {
    showError(
      document.getElementById("Date"),
      "Invalid date: Date cannot be empty."
    );
    return;
  } else {
    const currentDate = new Date(); // Current date
    const enteredDate = new Date(inputDate); // Entered date
    if (enteredDate > currentDate) {
      showError(
        document.getElementById("Date"),
        "Birthdate cannot be in the future."
      );
      return;
    } else {
      removeError(document.getElementById("Date"));
    }
  }
  const errors2 = document.querySelectorAll(".error");
  if (errors2.length === 0) {
    // AJAX request
   $.ajax({
     type: "POST",
     url: "http://localhost/final_db_admin/backend/register/registerCode.php",
     data: {
       FirstName: FirstName,
       LastName: LastName,
       Email: Email,
       ContactNumber: ContactNumber,
       sex: selectedSex,
       inputDate: inputDate,
       pass: pass,
       register: true,
     },
     dataType: "text",
     success: function (response) {
       console.log(response);

       if (response === "success") {
            window.location.href =
              "http://localhost/final_db_admin/frontend/user_home/user_home_html.php";
       } else if (response === "email") {
         showError(document.getElementById("Email"), "Email Already Exists");
       } else if (response === "sqlfailure") {
         showError(document.getElementById("Email"), "Email Already Exists");
       } else {
         // Custom status code for email duplication error
         error.innerText = "Email duplication error. Status code: " + response;
       }
     },
   });

  }
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
