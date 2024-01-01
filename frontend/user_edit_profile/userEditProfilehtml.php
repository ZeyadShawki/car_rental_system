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

    <link rel="stylesheet" src="../../frontend/css/style.css">

    <link rel='stylesheet' href='../../node_modules/@fortawesome/fontawesome-free/css/all.min.css'>
    <link rel="stylesheet" href="../../frontend/nav_jss/navbar-pure-css/dist/style.css">
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
    <link rel="stylesheet" href="../css/col_navbar.css">
    <!-- js file-->
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script type="text/javascript" src="./js/userEditProfile.js"></script>
    <script src="../footer/footer.js" defer></script>


    <title>Edit Profile</title>
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
                <div class="nav-button"><i class="fas fa-user"></i><span><a href="#">Edit profile</a></span></div>
                <div class="nav-button"><i class="fas fa-key"></i><span><a
                            href="../../frontend/change_customer_password/change_customer_password_html.php">Change
                            Password</a></span></div>
                <div class="nav-button"><i class="fas fa-car"></i><span><a
                            href="../../frontend/show_all_customer_reservation/show_all_customer_reservation.php">My
                            reservation</a></span></div>
                <div class="nav-button"><i class="fas fa-thumbtack"></i><span><a href="../../backend/logout/logout.php">
                            log out</a></span></div>
                <hr />
                <div id="nav-content-highlight"></div>
            </div>
            <input id="nav-footer-toggle" type="checkbox" />
            <div id="nav-footer">
                <div id="nav-footer-heading">
                    
                    <!-- <div id="nav-footer-titlebox"><a id="nav-footer-title"
                            target="_blank">uahnbu</a><span id="nav-footer-subtitle">Admin</span></div> -->
                    <label for="nav-footer-toggle"><i class="fas fa-caret-up"></i></label>
                </div>
                
            </div>
        </div>
        <!--data of page starts from here -->
        <div class="content-of-page">
            <div class="container col-sm mt-5">
                <div class="border2">
                    <!-- Display the current image -->

                    <img id="avatarImage" 
     alt="Avatar" 
     style="height:200px;
            vertical-align: middle;
            width: 330px;
            height: 300px;
            border-radius: 50%;
            border: 2px solid gray;
            cursor: pointer;" 
     class="avatar" 
     onclick="openFileInput()">
                    <button type="submit" onclick="openFileInput()" class="btn btn-primary w-50 p-3 m-5 mb-5">Change
                        Profile Image</button>
                    <!-- Hidden file input for selecting a new image -->
                    <input type="file" id="fileInput" style="display: none" accept="image/*"
                        onchange="displaySelectedImage()">
                    <div class="text-start">
                        <label style="margin-top: 5px; margin-bottom: 5px;">First name</label>
                        <input id="firstName" class="form-control" style="padding: 10px;"></input>
                    </div>
                    <div class="text-start">
                        <label style="margin-top: 5px; margin-bottom: 5px;">Last name</label>
                        <input id="lastName" class="form-control" style="padding: 10px;"></input>
                    </div>
                    <div class="text-start">
                        <label style="margin-top: 5px; margin-bottom: 5px;">Birth Date</label>
                        <input id="bdate" type="date" class="form-control" style="padding: 10px;"></input>
                    </div>
                    <div class="text-start">
                        <label style="margin-top: 5px; margin-bottom: 5px;">Email</label>
                        <label id="email" type="date" class="form-control"></label>
                    </div>
                    <div class="text-start">
                        <label style="margin-top: 5px; margin-bottom: 5px;">Phone number</label>
                        <input id="phoneNumber" class="form-control" style="padding: 10px;"></input>
                    </div>

                    <hr>
                    <button type="submit" onclick="editCustomerProfile()" class="btn btn-primary w-100 p-3">Edit
                        Profile</button>
                </div>
            </div>
        </div>
    </div>
</body>

</html>