<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Forgot Password | GoGreen</title>

    <!-- GOOGLE FONT -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <!-- CSS -->
    <link rel="stylesheet" href="assets/css/forgotpass.css">
</head>

<body>

    <!-- HEADER -->
    <header>

        <!-- LOGO -->
        <div class="logo">
            <img src="image/recycle_imag.png" alt="GoGreen Logo">
            GoGreen
        </div>

        <!-- RIGHT SIDE -->
        <div class="header-right">

            <!-- NAVIGATION -->
            <nav id="navMenu">

                <a href="index.php">Home</a>
                <a href="about.php">About</a>
                <a href="media.php">Media</a>
                <a href="map.php">Map</a>
                <a href="leaderboard.php">Leaderboard</a>
                <a href="contactus.php">Contact</a>

                <button 
                    class="sign-btn"
                    onclick="window.location.href='login.php'">
                    Sign In
                </button>

            </nav>

            <!-- MOBILE MENU -->
            <div class="menu-toggle" onclick="toggleMenu()">
                ☰
            </div>

        </div>

    </header>

    <!-- FORGOT PASSWORD SECTION -->
    <section class="login-container">

        <div class="login-box">

            <!-- LOGO -->
            <div class="logosign">
                <img src="image/recycle_imag.png" alt="GoGreen Logo">
            </div>

            <!-- TITLE -->
            <h1>Forgot Password</h1>

            <p>
                Enter your email address and we'll send you a reset link.
            </p>

            <!-- FORM -->
            <form>

                <label class="input-label">
                    Email Address
                </label>

                <input
                    type="email"
                    class="input-box"
                    placeholder="Enter your email"
                    required
                >

                <button type="submit" class="signin-btn">
                    Send Reset Link
                </button>

            </form>

            <!-- BOTTOM TEXT -->
            <div class="bottom-text">
                Remember your password?
                <a href="login.php">
                    Back to Login
                </a>
            </div>

        </div>

    </section>

    <!-- FOOTER -->
    <footer>

        <p class="left-footer">
            © 2026 GoGreen. All Rights Reserved.
        </p>

        <p class="right-footer">
            Make the earth greener together.
        </p>

    </footer>

    <!-- SCRIPT -->
    <script>

        // MOBILE MENU
        function toggleMenu(){
            document
                .getElementById("navMenu")
                .classList
                .toggle("active");
        }

        // PROFILE MENU
        function toggleProfileMenu(){
            document
                .getElementById("profileMenu")
                .classList
                .toggle("show");
        }

        // CLOSE MENU WHEN CLICK OUTSIDE
        document.addEventListener("click", function(event){

            const container = document.querySelector(".user-avatar-container");
            const menu = document.getElementById("profileMenu");

            if(!container.contains(event.target)){
                menu.classList.remove("show");
            }

        });

    </script>

</body>
</html>
