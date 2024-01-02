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
    <link rel="stylesheet" href="../css/carbox.css">

    <link rel="stylesheet" href="./customer_css/customer_css.css">

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
                    <label for="nav-footer-toggle"><i class="fas fa-caret-up"></i></label>
                </div>

            </div>
        </div>

        <!--data of page starts from here -->
        <div class="content-of-page">
            <div class="container col-sm mt-5">

                <div class="card">
                    <div class="row d-flex align-items-center">
                        <div class="col-md-4">
                            <img style="
                width: 100%; /* Make the image fill the entire width of the column */
                height: auto; /* Maintain the aspect ratio */
                display: block;
                margin: 0 auto; /* Center the image horizontally */
                " id="userImage"
                                src="https://res.cloudinary.com/alexandracaulea/image/upload/v1582179610/user_fckc9f.jpg"
                                alt="User image" class="card__image" />
                        </div>
                        <div class="col-md-8">
                            <div class="card__text pt-5">
                                <h2 id="customerName">Alexandra Caulea</h2>
                                <p style="
        font-size= 30px;
        color:Black
        " id="customerEmail">I enjoy drinking a cup of coffee every day</p>
                                <p id="customerPhone">I enjoy drinking a cup of coffee every day</p>

                            </div>
                        </div>
                    </div>
                </div>


                <div class="pt-5"></div>


                <style>
                    .seven h1 {
                        text-align: center;
                        font-size: 30px;
                        font-weight: 300;
                        color: #222;
                        letter-spacing: 1px;
                        text-transform: uppercase;
                        display: grid;
                        grid-template-columns: 1fr max-content 1fr;
                        grid-template-rows: 27px 0;
                        grid-gap: 20px;
                        align-items: center;
                        position: relative;
                    }

                    .seven h1:after,
                    .seven h1:before {
                        content: " ";
                        display: block;
                        border-bottom: 1px solid #c50000;
                        border-top: 1px solid #c50000;
                        height: 5px;
                        background-color: #f8f8f8;
                    }
                </style>

                <div class="seven">
                    <h1>Rent a car</h1>
                </div>
                <div class="border2">
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
                    <select class="form-control mb-2" id="afterYear" name="afterYear">
                        <?php
                        for ($year = 2000; $year <= 2024; $year++) {
                            echo '<option value="' . $year . '">' . $year . '</option>';
                        }
                        ?>
                    </select>
                    <form action="" method="post" id="search-form">
                        <button type="submit" class="btn btn-primary w-100 mt-4 p-3">Search</button>
                    </form>
                </div>
                <div id="reciveddata">
                </div>
            </div>
        </div>
    </div>
</body>
<script src="../footer/footer.js" defer></script>

</html>