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
    <!-- php file-->
    <?php
    $filename = '../../backend/user_rent/user_rent.php';
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
    <script type="text/javascript" src="./js/user_rent.js"></script>
    <title>Rent Car</title>
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
                <div class="nav-button"><i class="fas fa-home"></i><span><a href="#">Home</a></span></div>
                <div class="nav-button"><i class="fas fa-user"></i><span><a
                            href="../user_edit_profile/userEditProfilehtml.php">Edit profile</a></span></div>
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
                    
                    <!-- <div id="nav-footer-titlebox"><a id="nav-footer-title" href="https://codepen.io/uahnbu/pens/public"
                            target="_blank">uahnbu</a><span id="nav-footer-subtitle">Admin</span></div> -->
                    <label for="nav-footer-toggle"><i class="fas fa-caret-up"></i></label>
                </div>
                
            </div>
        </div>
        <!--data of page starts from here -->
        <div class="content-of-page">
            <div class="container col-sm mt-5">

                <?php
                $plateID = isset($_POST['plateID']) ? $_POST['plateID'] : null;
                if ($plateID !== null) {
                    // echo "You selected Plate ID: " . $plateID;
                    get_data($plateID);
                } else {
                    echo "No Plate ID provided.";
                }
                ?>

                
                <div class="col text-start" >
                <label for='pickupDate'>Pickup Date:</label>
                <input type='date'class="form-control" id='pickupDate' name='pickupDate'>
                </div>
                <br>

                <div class="col text-start" >
                <label for='returnDate'>Return Date:</label>
                <input type='date' class="form-control"  id='returnDate' name='returnDate'>
                </div>


                <form action="" method="post" id="rent-form">
                    <!-- 3shan ab3t el plate id -->
                    <input type="text" id="plateid" value="<?php echo $plateID; ?>" hidden>
                    <button class="btn btn-primary w-100 p-3 mb-5 mt-5" type="submit">Rent</button>
                </form>
                <div id="reciveddata"> <!--if cannot rent car in this period-->
                </div>
            </div>
        </div>
    </div>
</body>

<script src="../footer/footer.js" defer></script>

</html>