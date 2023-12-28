<?php
session_start();
if ( isset( $_SESSION[ 'SESSION_EMAIL' ] ) ) {
    header( 'Location: ../../frontend/user_home/user_home_html.php' );
    // to test this case, make it if ( true )
} else if ( isset( $_SESSION[ 'SESSION_ADMIN' ] ) ) {
    header( 'Location: ../../frontend/admin_dashboard/admin_dashboard.html' );
    // zeyad
}
include "connectdb.php"; // Using database connection file here
$records = mysqli_query($conn,"SELECT c.plateID, c.OfficeID, c.carname, c.brand, c.Year, c.imageUrl, c.rentvalue
                                FROM cars AS c
                                WHERE c.carStatus = 'active'
                                LIMIT 3;"); // fetch data from database
mysqli_close( $conn );
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>car rent</title>
    <!-- css file-->
    <link rel="stylesheet" href="../../frontend/css/style.css">
    <!-- js file-->
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script type="text/javascript" src="./js/profile.js"></script>

      <!--Google Font-->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@200;300;400;500;600;700&display=swap" rel="stylesheet">
</head>


  <body>
    <!--Header-->
    <div class="header">
      <div class="container"></div>
        <a href="#"><img src="logo.png" alt="website logo"></a> <!--3yzen nhot el logo-->

        <ul class="navbar">
          <li><a href="#home">Home</a></li>
          <li><a href="#services">Services</a></li>
          <li><a href="#about">About Us</a></li>
        </ul>
        <div class="header-btn">
          <a href="../register_customer/register_html.php" class="sign-up">Sign Up</a>
          <a href="../login_customer/login_html.php" class="sign-in">Sign In</a>
      </div>
    </div>
    </div>
    <!--Home-->
    <div class="container">
    <section class="home" id="home">
        <h1><span>Looking</span> to <br>rent a car</h1>
        <p>High Quality Cars with Booking from everywhere in the world!</p>
    </section>
    </div>

    <!--Services-->

    <section class="services" id="services">
      <div class="container">
        <span>Best Services</span>
        <h1>Explore Our Car options!</h1>
      
      <div class="services-container">
      <?php
			while($data = mysqli_fetch_array($records))
			{
			?>
        <div class="box">
          <div class="box-img">
					<img src="<?php echo $data['imageUrl']; ?>" alt="">
          </div>
		  <h2><?php echo $data['brand']; ?></h2>
          <h3><?php echo $data['carname']; ?></h3>
          <a href="../login_customer/login_html.php" class="btn">Rent Now</a>
        </div>
		<?php
		}
		?>
	  </div>
    </div>
    </section>



    <div class="container">
    <section class="about" id="about">
      <div class="heading">
        <span>About Us</span>
        <h1>Best Customer Experience</h1>
      </div>
      <div class="about-container">
        <div class="about-img">
          <img src="images/aboutus.png" alt="">
        </div>
        <div class="about-text">
          <span>About Us</span>
          <p>Rental Car Services website for providing <br> Comfortable, Affordable, and Cheapest Rental Cars!</p>
        </div>
      </div>
    </section>
    </div>

  </body>
</html>
