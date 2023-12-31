<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
  <meta charset="utf-8">
  <title>Register</title>
  <!--css code-->
  <link rel="stylesheet" href="../css/style.css">
  <link rel="stylesheet" href="../css/button_scroll.css">

  <!--php file to check if is set session email-->
  <?php
  $filename = '../../backend/register/registerCode.php';
  if (file_exists($filename)) {
    include $filename;
  } else {
    echo "Error: File $filename not found.";
  }
  ?>
</head>
<link rel="stylesheet" href="../../node_modules/bootstrap/dist/css/bootstrap.min.css">
<script src="../../node_modules/jquery/dist/jquery.min.js"></script>
<script src="../../node_modules/bootstrap/dist/js/bootstrap.min.js"></script>
<script type="text/javascript" src="./js/registerValidation.js"></script>

<body>
  <!--header section-->
  <div class="header">
    <a href="#" class="logo"><img src="../images/logo.jpeg" alt="website logo"></a>
    <div class="header-btn">
      <a href="../guest/index.php" class="sign-in" style="text-decoration: none;">return to home page</a>
    </div>
  </div>
  <div class="container">
    <div class="pt-3"></div>
    <h1>Register</h1>
    <span id="error" style="color:red; font-size: 18px; font-weight: bold;"></span>

    <form action="" method="post" id="register-form" required>
      <div class="inputField">
        <label for="Fname" class="labelInput  pt-2">First Name</label>
        <input type="text" class="form-control" name="Fname" id="FirstName" placeholder="Enter Your First Name"
          class="input">
      </div>
      <div class="inputField">
        <label for="Lname" class="labelInput  pt-2">Last Name</label>
        <input type="text" class="form-control" name="Lname" id="LastName" placeholder="Enter Your Last Name"
          class="input">
      </div>
      <div class="inputField">
        <label for="email" class="labelInput  pt-2">Email</label>
        <input type="text" class="form-control" name="email" id="Email" placeholder="Enter Your Email" class="input">
      </div>
      <div class="inputField">
        <label for="contactNo" class="labelInput  pt-2">Contact Number</label>
        <input type="text" class="form-control" name="contactNo" id="ContactNumber"
          placeholder="Enter Your Contact Number" class="input">
      </div>

      <div class="inputField">


        <label for="sex" class="form-label pt-2">sex</label>


        <select class="form-select" id="sex" name="sex">
          <option value="male">Male</option>
          <option value="Female">Female</option>
        </select>
      </div>
      <div class="inputField">
        <label for="dob" class="labelInput  pt-2">Date Of Birth</label>
        <input type="date" class="form-control" name="dob" id="Date" placeholder="Enter Your Date Of Birth"
          class="input">
      </div>

      <!-- Add these buttons next to password fields -->
      <label for="password" class="col-sm-12 col-md-2 pt-2">Password</label>
      <div class="inputField row">
        <div class="col-sm-12 col-md-10 password-container">
          <input type="password" class="form-control " name="password" id="pass" placeholder="Enter Your Password">

          <button type="button" class="toggle-password btn btn-outline-secondary" data-target="pass">Show</button>
        </div>
      </div>

      <label for="conpassword" class="col  pt-2">Confirm Password</label>
      <div class="inputField row">
        <div class="col-sm-12 col-md-10 password-container">
          <input type="password" class="form-control" name="conpassword" id="confirmpassword"
            placeholder="Enter Your Confirm Password">
          <button type="button" class="toggle-password btn btn-outline-secondary"
            data-target="confirmpassword">Show</button>
        </div>
      </div>


      <hr>
      <button name="register" class="btn btn-primary w-100 p-3 mb-5 xy" type="submit">Sign Up</button>
    </form>
    <p>Have an account? <a href="../login_customer/login_html.php">Sign In</a>.</p>
  </div>
</body>

</html>