<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>car rent</title>
    <!-- css file-->
    <link rel="stylesheet" href="../../frontend/css/style.css">
    <link rel="stylesheet" href="../css/style.css">
    <!--include the php backend file-->
    <link rel="stylesheet" href="../../node_modules/bootstrap/dist/css/bootstrap.min.css">
    <script src="../../node_modules/jquery/dist/jquery.min.js"></script>
    <script src="../..node_modules/bootstrap/dist/js/bootstrap.min.js"></script>

    <!--include the php backend file-->

    <?php
    $filename = '../../backend/user_rent/user_rent.php';
    if (file_exists($filename)) {
        include $filename;
    } else {
        echo "Error: File $filename not found.";
    }
    ?>

    <!-- js file-->
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script type="text/javascript" src="./js/user_rent.js"></script>
</head>

<body>
    <div class="header">
        <div class="container">
            <div class="logo">LOGO IMAGE</div>

            <div class="header-btn">
                <!--el tre2ten sghlen-->
                <!-- <a href="javascript:history.go(-1)">Go Back</a> -->
                <a href="javascript:void(0);" onclick="history.back();">Go Back</a>
            </div>

            <div class="header-btn">
                <!-- <a href="logout.php" class="sign-in">Logout</a> -->
            </div>
        </div>
    </div>

    <div class="container">
        <p>Rent A Car</p>
        <p id='validation-messages'>
        </p>
        <?php
        $plateID = isset($_POST['plateID']) ? $_POST['plateID'] : null;
        if ($plateID !== null) {
            // echo "You selected Plate ID: " . $plateID;
            get_data($plateID);
        } else {
            echo "No Plate ID provided.";
        }
        ?>

        <label for='pickupDate'>Pickup Date:</label>
        <input type='date' id='pickupDate' name='pickupDate'>
        <br>
        <label for='returnDate'>Return Date:</label>
        <input type='date' id='returnDate' name='returnDate'>

        <form action="" method="post" id="rent-form">
            <!-- 3shan ab3t el plate id -->
            <input type="text" id="plateid" value="<?php echo $plateID; ?>" hidden>
            <button type="submit">Rent</button>

        </form>

        <div id="reciveddata"> <!--if cannot rent car in this period-->
        </div>


    </div>
</body>