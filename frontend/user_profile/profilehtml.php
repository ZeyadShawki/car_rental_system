<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>car rent</title>
        <!-- php file-->
        <?php
            $filename = '../../backend/user_profile/profile.php';
            if (file_exists($filename)) {
                include $filename;
            } else {
                echo "Error: File $filename not found.";
            }
    ?>

    <!-- css file-->
    <link rel="stylesheet" href="../../frontend/css/style.css">
    <!-- js file-->
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script type="text/javascript" src="./js/profile.js"></script>


</head>
<body>
    <!--header section-->
    <div class="header">

        <div class="container">

            <div class="logo">LOGO IMAGE</div>

            <div class="links">
                <ul class="navbar">
                    <li><a href="homepage.html" >Home</a></li> <!--3alaa-->
                    <li><a href="#">Profile</a></li>
                  </ul>
            </div>

            <div class="header-btn">
                <a href="logout.php" class="sign-in">Logout</a>
            </div>

        </div>

    </div>



        
    <!--home section-->
    <div class="home">
        <div class="container">   
            <?php user_info(); ?>
        </div>
    </div>

    <!--search section-->
    <div class="search">
        <div class="container">
                <?php get_items_to_select() ?>
        </div>
    </div>
    
    <form action="" method="post" id="search-form" >
        <button type="submit">Submit</button>
    </form>

    <div id="reservationData">

    </div>
</body>

</html>