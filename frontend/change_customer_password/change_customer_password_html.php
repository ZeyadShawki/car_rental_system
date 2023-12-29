<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../node_modules/bootstrap/dist/css/bootstrap.min.css">
    <script src="../../node_modules/sweetalert2/dist/sweetalert2.all.min.js"></script>
    <script src="../../node_modules/jquery/dist/jquery.min.js"></script>
    <script src="../../node_modules/bootstrap/dist/js/bootstrap.min.js"></script>
    <script src="../../frontend/nav_jss/nav.js"></script>

    <link rel='stylesheet' href='../../node_modules/@fortawesome/fontawesome-free/css/all.min.css'>
    <link rel="stylesheet" href="../../frontend/nav_jss/navbar-pure-css/dist/style.css">
    <!--Google Font-->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@200;300;400;500;600;700&display=swap"
        rel="stylesheet">


    <!-- php file-->


    <!-- css file-->
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../css/col_navbar.css">
    <link rel="stylesheet" href="../css/user_profile.css">


    <!-- js file-->
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script type="text/javascript" src="./js/change_customer_password.js"></script>


    <title>Profile</title>
</head>

<body>

    <div class="flex-container">
        <!-- Your nav-bar code remains unchanged -->
        <div id="nav-bar">
            <input id="nav-toggle" type="checkbox" />
            <div id="nav-header"><a id="nav-title" target="_blank"><i></i>Profile</a>
                <label for="nav-toggle"><span id="nav-toggle-burger"></span></label>
                <hr />
            </div>
            <div id="nav-content">
                <div class="nav-button"><i class="fas fa-home"></i><span><a
                            href="../user_home/user_home_html.php">Home</a></span></div>
                <div class="nav-button"><i class="fas fa-user"></i><span><a
                            href="../user_edit_profile/userEditProfilehtml.php">Edit profile</a></span></div>
                <div class="nav-button"><i class="fas fa-thumbtack"></i><span><a href="../../backend/logout/logout.php">
                            log out</a></span></div>
                <hr />

                <div class="nav-button"><i class="fas fa-key"></i><span><a
                            href="../../frontend/change_customer_password/change_customer_password_html.php">Change
                            Password</a></span></div>
                <div class="nav-button"><i class="fas fa-car"></i><span><a
                            href="../../frontend/show_all_customer_reservation/show_all_customer_reservation.php">My
                            reservation</a></span></div>



                <div id="nav-content-highlight"></div>
            </div>
            <input id="nav-footer-toggle" type="checkbox" />
            <div id="nav-footer">
                <div id="nav-footer-heading">
                    <div id="nav-footer-avatar"><img
                            src="https://gravatar.com/avatar/4474ca42d303761c2901fa819c4f2547" /></div>
                    <div id="nav-footer-titlebox"><a id="nav-footer-title" href="https://codepen.io/uahnbu/pens/public"
                            target="_blank">uahnbu</a><span id="nav-footer-subtitle">Admin</span></div>
                    <label for="nav-footer-toggle"><i class="fas fa-caret-up"></i></label>
                </div>
                <div id="nav-footer-content">
                    <Lorem>ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore
                        et
                        dolore magna aliqua.</Lorem>
                </div>
            </div>
        </div>

        <!-- OSSMA PUT YOU DATA  INSIDE container col-->
        <div class="content-of-page">


            <div class="container col-sm mt-5">

            <div class="text-start">

          <h1>Change user password</h1>
</div>
<br>
                <!-- Change Password section -->
                
             <!-- Your HTML and other scripts remain unchanged -->

<div class="text-start">
    <label for="oldPassword">Old password</label>
    <input class="form-control" type="password" id="oldPassword" placeholder="Old Password"><br>
    <div id="oldPassword-error" class="invalid-feedback"></div> <!-- Error message container for Old password -->
</div>

<div class="text-start">
    <label for="newPassword">New password</label>
    <input class="form-control" type="password" id="newPassword" placeholder="New Password"><br>
    <div id="newPassword-error" class="invalid-feedback"></div> <!-- Error message container for New password -->
</div>

<div class="text-start">
    <label for="confirmNewPassword">Confirm new password</label>
    <input class="form-control" type="password" id="confirmNewPassword" placeholder="Confirm New Password"><br>
    <div id="confirmNewPassword-error" class="invalid-feedback"></div> <!-- Error message container for Confirm new password -->
</div>

<button class="btn btn-primary w-100 p-3 mb-5" onclick="saveNewPassword()">confirm</button>


</body>


<script>

    // Function to fetch all customer data using AJAX



</script>

</html>