<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>car rent</title>
    <!-- css file-->
    <link rel="stylesheet" href="../css/style.css">
     <!--include the php backend file-->
     <link rel="stylesheet" href="../../node_modules/bootstrap/dist/css/bootstrap.min.css">
    <script src="../../node_modules/jquery/dist/jquery.min.js"></script>
    <script src="../..node_modules/bootstrap/dist/js/bootstrap.min.js"></script>
 
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
    <script type="text/javascript"  src="./js/user_home.js"></script>
</head>
<body>
    <div class="header">
    <div class="container">
        <div class="logo">LOGO ssssssssssIMAGE</div>

        <div class="links">
            <ul class="navbar">
                <li><a href="homepage.html" >Home</a></li> <!--3alaa-->
                <li><a href="../user_profile/profilehtml.php">Profile</a></li>
            </ul>
        </div>
        <div class="header-btn">
            <a href="logout.php" class="sign-in">Logout</a>
        </div>
    </div>
    </div>

  

    <!--do all select-->
    <div class="container mt-4"> 
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
    <select  class="form-control" id="afterYear" name="afterYear">
        <?php
        for ($year = 2000; $year <= 2024; $year++) {
            echo '<option value="' . $year . '">' . $year . '</option>';
        }
        ?>
    </select>


    
    <form action="" method="post" id="search-form" >
        <button type="submit" class="btn btn-primary w-100 mt-2 p-3 mb-5">Search</button>
    </form>


    <div id="reciveddata">
    </div>


    </div>
</body>
