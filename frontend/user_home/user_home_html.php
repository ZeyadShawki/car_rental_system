<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../frontend/css/nav_css.css">
    <link rel="stylesheet" href="../../node_modules/bootstrap/dist/css/bootstrap.min.css">
    <script src="../../node_modules/sweetalert2/dist/sweetalert2.all.min.js"></script>
    <script src="../../node_modules/jquery/dist/jquery.min.js"></script>
    <script src="../../node_modules/bootstrap/dist/js/bootstrap.min.js"></script>
    <script src="../../frontend/nav_jss/nav.js"></script>

    <link rel='stylesheet' href='../../node_modules/@fortawesome/fontawesome-free/css/all.min.css'>
    <link rel="stylesheet" href="../../frontend/nav_jss/navbar-pure-css/dist/style.css">
    <link rel="stylesheet" href="../css/col_navbar.css">

    <?php
    $filename = '../../backend/user_home/user_home.php';
    if (file_exists($filename)) {
        include $filename;
    } else {
        echo "Error: File $filename not found.";
    }
    ?>
    <!-- js file-->
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script type="text/javascript" src="./js/user_home.js"></script>

    <title>Home</title>
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
                            href="#">Home</a></span></div>
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

        <!--data of page starts from here -->
        <div class="content-of-page">
        <div class="container col-sm mt-5">
                <?php retrive_all_data_required() ?>

                <!-- Before Year Selection -->
                <label for="beforeYear">Before Year:</label>
                <select class="form-control mb-2" id="beforeYear" name="beforeYear">
                    <?php
                    for ($year = 2000; $year <= 2024; $year++) {
                        $selected = ($year == 2024) ? 'selected' : '';
                        echo '<option value="' . $year . '" ' . $selected . '>' . $year . '</option>';
                    }
                    ?>
                </select>

                <!-- After Year Selection -->
                <label for="afterYear">After Year:</label>
                <select class="form-control" id="afterYear" name="afterYear">
                    <?php
                    for ($year = 2000; $year <= 2024; $year++) {
                        echo '<option value="' . $year . '">' . $year . '</option>';
                    }
                    ?>
                </select>



                <form action="" method="post" id="search-form">
                    <button type="submit" class="btn btn-primary w-100 mt-2 p-3 mb-5">Search</button>
                </form>

                <div id="reciveddata">
                </div>

            </div>
        </div>
    </div>

</body>
<script src="../footer/footer.js" defer></script>

</html>