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

    <!-- css file-->
    <link rel="stylesheet" href="../css/col_navbar.css">
    <!-- js file-->
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script type="text/javascript" src="./js/show_all_customer_reservation.js"></script>
    <script src="../footer/footer.js" defer></script>

    <title>Profile</title>
</head>

<body>

    <div class="flex-container">
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
                <div class="nav-button"><i class="fas fa-key"></i><span><a
                            href="../../frontend/change_customer_password/change_customer_password_html.php">Change
                            Password</a></span></div>
                <div class="nav-button"><i class="fas fa-car"></i><span><a href="#">My
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
                <div class="row">

                    <div class="col-sm-8">
                        <input type="text" id="searchTerm" class="form-control" placeholder="Enter search term">
                    </div>
                    <div class="col-sm-4">
                        <button class="btn btn-primary" onclick="search()">Search</button>
                    </div>

                </div>


                <h1 class="pt-5">All Reservation</h1>
                <div id="results"></div>
                <table class="table "></table>
                <div id="results_Resv"></div>
                <table class="table">
                </table>

                <!-- Pagination -->
                <div id="pagination" class="mt-3">
                    <nav aria-label="Page navigation">
                        <ul class="pagination">
                            <!-- pagination links -->
                        </ul>
                    </nav>
                </div>

            </div>
        </div>
    </div>
</body>

</html>