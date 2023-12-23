// 3shan lw rg3t lel page 2la2i l fields fadya
window.addEventListener('pageshow', function(event) {
  if (event.persisted) {
      // The page was loaded from cache, clear the form fields
      document.getElementById('register-form').reset();
  }
});

$(document).ready(function(){
    $("#register-form").submit(function(e){
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


  var inputs = document.getElementsByClassName('input');
  var error = document.getElementById('error');
  error.innerText = "";
  


  for (let i = 0; i < inputs.length; i++) {
    if(inputs[i].value.trim().length == 0){
      error.innerText = "INVALID!! " + inputs[i].getAttribute('placeholder');
      return;
    }
  }




  //  password and confirm password validation
    if(pass != confirmpassword){
      error.innerText = "Password and confirm password don't match.";
      return;
    }
    //email validation
    const emailRegex = /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/;
    if(!emailRegex.test(Email.value)){
      console.log("invalid email");
      error.innerText = "INVALID email format.";
      return;
    }

    if (!inputDate) {
      error.innerText = "Invalid date: Date cannot be empty.";
        console.log("Invalid date: Date cannot be empty.");
        return;
    } else {
        const currentDate = new Date(); // Current date
        const enteredDate = new Date(inputDate); // Entered date
        
        if (enteredDate > currentDate) {
          error.innerText = "Birthdate cannot be in the future.";
          // console.log("Birthdate cannot be in the future.");
          return;
    }
  }

    $.ajax({
      type: "POST",
      url: "registerCode.php",
      data: {
        FirstName: FirstName,
        LastName: LastName,
        Email: Email,
        ContactNumber: ContactNumber,
        sex: selectedSex,
        inputDate:inputDate,
        pass: pass,
        register : true
      },
      dataType: "text",
      success: function(response){
        console.log(response);
        if(response === 'success'){
          window.location.href = "login.html";
        } else if(response === 'email'){
          error.innerText = "Email Already Exists";
        } else if(response === 'sqlfailure'){
          error.innerText = "Error sql query failure";
        } else {
          error.innerText = "Error";
        }
      }
  });
}