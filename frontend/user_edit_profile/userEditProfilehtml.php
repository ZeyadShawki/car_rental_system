
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
    <script src="./js/search_logic.js"></script>
    <script src="./js/get_all_car_logic.js"></script>
    <link rel='stylesheet' href='../../node_modules/@fortawesome/fontawesome-free/css/all.min.css'>
    <link rel="stylesheet" href="../../frontend/nav_jss/navbar-pure-css/dist/style.css">
    <!--Google Font-->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@200;300;400;500;600;700&display=swap" rel="stylesheet">
  
  
    <!-- php file-->
           <?php
            $filename = '../../backend/userEditProfile/userEditProfile.php';
            if (file_exists($filename)) {
                include $filename;
            } else {
                echo "Error: File $filename not found.";
            }
    ?>

    <!-- css file-->
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../css/col_navbar.css">
    <link rel="stylesheet" href="../css/user_profile.css">


    <!-- js file-->
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script type="text/javascript" src="./js/userEditProfile.js"></script>
    

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
            <div class="nav-button"><i class="fas fa-home"></i><span><a  href="../admin_dashboard/admin_dashboard.html">Home</a></span></div>
            <div class="nav-button"><i class="fas fa-car"></i><span><a href="../admin_car_front_end/add_new_car.html">Edit profile</a></span></div>
            <div class="nav-button"><i class="fas fa-thumbtack"></i><span><a href="../../backend/logout/logout.php"> log out</a></span></div>
            <hr />
 
            <div id="nav-content-highlight"></div>        </div>
        <input id="nav-footer-toggle" type="checkbox" />
        <div id="nav-footer">
            <div id="nav-footer-heading">
                <div id="nav-footer-avatar"><img src="https://gravatar.com/avatar/4474ca42d303761c2901fa819c4f2547" /></div>
                <div id="nav-footer-titlebox"><a id="nav-footer-title" href="https://codepen.io/uahnbu/pens/public"
                        target="_blank">uahnbu</a><span id="nav-footer-subtitle">Admin</span></div>
                <label for="nav-footer-toggle"><i class="fas fa-caret-up"></i></label>
            </div>
            <div id="nav-footer-content">
                <Lorem>ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et
                    dolore magna aliqua.</Lorem>
            </div>        </div>
    </div>

    <!-- OSSMA PUT YOU DATA  INSIDE container col-->
    <div class="content-of-page">
        <div class="container col-sm mt-5" >
            
            <!-- Displaying the user info -->
            <p>First Name: Alice</p>
            <p>Last Name: Johnson</p>
            <p>Birth Date: 1995-06-20</p>


            <!-- Display the phone number with the edit button -->
            <div id="phoneNumberDisplayDiv">
                Phone Number
                <span id="phoneNumberDisplay">111-222-3333</span>
                <button onclick="editPhoneNumber()" id="editButton">Edit</button>
            </div>


            <!-- Input field for editing the phone number (hidden initially) -->
            <!-- Input field for editing the phone number -->
            <div id="phoneNumberEdit" style="display:none;">
                New Phone Number: 
                <input type="text" id="newPhoneNumber" value="111-222-3333">
                <span id="phoneNumberError" style="color:red; display:none;">Invalid phone number format!</span> <!-- Error span -->
                <form action="" method="post" id="changePhoneNumber" required>
                    <button onclick="savePhoneNumber()">Save</button>
                </form>
                <button onclick="cancelEdit()">Cancel</button>
            </div>



            <!-- Change Password section -->
            <div id="changePasswordSection">
                <button id="buttonOfPassword" onclick="showChangePasswordFields()">Change Password</button>

                <!-- Fields for changing password (initially hidden) -->
                <div id="passwordFields" style="display:none;">
                    old password :
                    <input type="password" id="oldPassword" placeholder="Old Password"><br><br>
                    new password :
                    <input type="password" id="newPassword" placeholder="New Password"><br><br>
                    confirm new password :
                    <input type="password" id="confirmNewPassword" placeholder="Confirm New Password"><br><br>
                    <button onclick="saveNewPassword()">Save Password</button>
                    <button onclick="cancelPasswordChange()">Cancel</button>
                </div>
            </div>






        </div>
    </div>
</div>

</body>

</html>