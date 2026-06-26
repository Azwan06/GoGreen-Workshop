<?php
session_start();
include "../config/database.php";

$error_message = "";

mysqli_close($conn);
?>
<!DOCTYPE html>

<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>GoGreen Login</title>



    <link rel="preconnect" href="https://fonts.googleapis.com">

    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>



    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">



    <link rel="stylesheet" href="assets/css/login.css">

</head>



<body>



<header>



    <div class="logo">



        <img src="image/recycle_imag.png" alt="GoGreen Logo">



        GoGreen



    </div>



    <div class="header-right">



        <nav id="navMenu">



            <a href="index.php">Home</a>

            <a href="about.php">About</a>

            <a href="media.php">Media</a>

            <a href="map.php">Map</a>

            <a href="leaderboard.php">Leaderboard</a>

            <a href="contactus.php">Contact</a>



            <button class="sign-btn"

                onclick="window.location.href='login.php'">



                Sign In



            </button>



        </nav>



        <div class="menu-toggle" onclick="toggleMenu()">

            ☰

        </div>



    </div>



</header>



<section class="login-container">



    <div class="login-box">



        <div class="logosign">



            <img src="image/recycle_imag.png" alt="GoGreen Logo">



        </div>



        <!-- LOGIN FORM -->



        <form action="../auth/login_process.php" method="POST">



            <h1>Welcome Back</h1>



            <p>

                Sign in with your email and password

            </p>



            <!-- EMAIL -->



            <label class="input-label">



                Email



            </label>



            <input

                type="email"

                name="email"

                placeholder="Enter Email"

                class="input-box"

                required

            >



            <!-- PASSWORD -->



            <label class="input-label">



                Password



            </label>



            <input

                type="password"

                name="password"

                placeholder="Enter Password"

                class="input-box"

                required

            >



            <!-- FORGOT PASSWORD -->



            <div class="forgot-password">



                <a href="forgotpass.php">



                    Forgot Password?



                </a>



            </div>



            <!-- LOGIN BUTTON -->



            <button type="submit" class="signin-btn">



                Sign In



            </button>



        </form>



        <!-- SIGNUP -->



        <div class="bottom-text">



            Don't have an account?



            <a href="signup.php" class="signup">



                Sign Up



            </a>



        </div>



    </div>



</section>



<footer>



    <p class="left-footer">



        © GoGreen. All rights reserved.



    </p>



    <p class="right-footer">



        Contact us: Al-Khawarizmi UTeM, Melaka, Malaysia



    </p>



</footer>



<script>



    function toggleMenu() {



        document

            .getElementById("navMenu")

            .classList.toggle("active");



    }



    function toggleProfileMenu() {



        document

            .getElementById("profileMenu")

            .classList.toggle("show");



    }



    document.addEventListener("click", function(event) {



        const container = document.querySelector(".user-avatar-container");



        const menu = document.getElementById("profileMenu");



        if (container && !container.contains(event.target)) {



            menu.classList.remove("show");



        }



    });



</script>



</body>

</html>

<?php
session_start();
include "../config/database.php";

$error_message = "";

// mysqli_close($conn); // keep for runtime; $conn is defined in included DB file

?>
<!DOCTYPE html>

<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>GoGreen Login</title>



    <link rel="preconnect" href="https://fonts.googleapis.com">

    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>



    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">



    <link rel="stylesheet" href="assets/css/login.css">

</head>



<body>



<header>



    <div class="logo">



        <img src="image/recycle_imag.png" alt="GoGreen Logo">



        GoGreen



    </div>



    <div class="header-right">



        <nav id="navMenu">



            <a href="index.php">Home</a>

            <a href="about.php">About</a>

            <a href="media.php">Media</a>

            <a href="map.php">Map</a>

            <a href="leaderboard.php">Leaderboard</a>

            <a href="contactus.php">Contact</a>



            <button class="sign-btn"

                onclick="window.location.href='login.php'">



                Sign In



            </button>



        </nav>



        <div class="menu-toggle" onclick="toggleMenu()">

            ☰

        </div>



    </div>



</header>



<section class="login-container">



    <div class="login-box">



        <div class="logosign">



            <img src="image/recycle_imag.png" alt="GoGreen Logo">



        </div>



        <!-- LOGIN FORM -->



        <form action="../auth/login_process.php" method="POST">



            <h1>Welcome Back</h1>



            <p>

                Sign in with your email and password

            </p>



            <!-- EMAIL -->



            <label class="input-label">



                Email



            </label>



            <input

                type="email"

                name="email"

                placeholder="Enter Email"

                class="input-box"

                required

            >



            <!-- PASSWORD -->



            <label class="input-label">



                Password



            </label>



            <input

                type="password"

                name="password"

                placeholder="Enter Password"

                class="input-box"

                required

            >



            <!-- FORGOT PASSWORD -->



            <div class="forgot-password">



                <a href="forgotpass.php">



                    Forgot Password?



                </a>



            </div>



            <!-- LOGIN BUTTON -->



            <button type="submit" class="signin-btn">



                Sign In



            </button>



        </form>



        <!-- SIGNUP -->



        <div class="bottom-text">



            Don't have an account?



            <a href="signup.php" class="signup">



                Sign Up



            </a>



        </div>



    </div>



</section>



<footer>



    <p class="left-footer">



        © GoGreen. All rights reserved.



    </p>



    <p class="right-footer">



        Contact us: Al-Khawarizmi UTeM, Melaka, Malaysia



    </p>



</footer>



<script>



    function toggleMenu() {



        document

            .getElementById("navMenu")

            .classList.toggle("active");



    }



    function toggleProfileMenu() {



        document

            .getElementById("profileMenu")

            .classList.toggle("show");



    }



    document.addEventListener("click", function(event) {



        const container = document.querySelector(".user-avatar-container");



        const menu = document.getElementById("profileMenu");



        if (container && !container.contains(event.target)) {



            menu.classList.remove("show");



        }



    });



</script>



</body>

</html>

