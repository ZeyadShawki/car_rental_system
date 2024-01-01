<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
    <meta charset="utf-8">
    <title>Login</title>
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../css/button_scroll.css">

    <link rel="stylesheet" href="../../node_modules/bootstrap/dist/css/bootstrap.min.css">
    <script src="../../node_modules/jquery/dist/jquery.min.js"></script>
    <script src="../../node_modules/bootstrap/dist/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="./js/login.js"></script>
    <?php
    $filename = '../../backend/login_controller/login_controller.php';
    if (file_exists($filename)) {
        include $filename;
    } else {
        echo "Error: File $filename not found.";
    }
    ?>
</head>

<body>
    <div class="header">
        <a href="#" class="logo"><img src="../images/logo.jpeg" alt="website logo"></a>
        <div class="header-btn">
            <a href="../guest/index.php" class="sign-in" style="text-decoration: none;">return to home page</a>
        </div>
    </div>
    <div class="container">
        <div class="pt-3"></div>
        <h1>Login</h1>
        <div id="error-container"></div> <!-- This is where the error message will be displayed -->

        <form action="" method="post" id="login-form" required>
            <div class="inputField">
                <label for="email" class="labelInput pt-2">Email</label>
                <input type="text" class="form-control" name="email" id="email" placeholder="Enter Your Email">
            </div>
            <div class="inputField">
                <label for="password" class="labelInput pt-2">Password</label>
                <input type="password" class="form-control" name="password" id="password"
                    placeholder="Enter Your Password">
            </div>
            <hr>
            <button name="login" class="btn btn-primary w-100 p-3 mb-5" type="submit">Login</button>
        </form>
        <p>Do not have an account? <a href="../register_customer/register_html.php">Sign up</a>.</p>

    </div>
</body>

</html>