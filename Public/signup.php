<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GoGreen - Sign Up</title>

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

        <form action="../auth/signup_process.php" method="POST">

            <h1>Join GoGreen</h1>
            <p>Create an account to start tracking</p>

            <!-- FULL NAME -->

            <label class="input-label">
                Enter Your Full Name
            </label>

            <input
                type="text"
                name="fullname"
                placeholder="Full Name"
                class="input-box"
                required
            >

            <!-- USERNAME -->

            <label class="input-label">
                Enter Your Username
            </label>

            <input
                type="text"
                name="username"
                placeholder="Username"
                class="input-box"
                required
            >

            <!-- EMAIL -->

            <label class="input-label">
                Enter Your Email
            </label>

            <input
                type="email"
                name="email"
                placeholder="youid@student.utem.edu.my"
                class="input-box"
                required
            >

            <!-- MATRIC ID -->

            <label class="input-label">
                Enter Your Matric ID
            </label>

            <input
                type="text"
                name="matric_id"
                placeholder="B012345"
                class="input-box"
                required
            >

            <!-- PASSWORD -->

            <label class="input-label">
                Enter Your Password
            </label>

            <input
                type="password"
                name="password"
                placeholder="Password"
                class="input-box"
                required
            >

            <!-- BUTTON -->

            <button type="submit" class="signin-btn">
                Sign Up
            </button>

        </form>

        <!-- DEMO BUTTON -->

        <div class="demo-buttons">

            <button class="demo-btn" type="button"
                onclick="window.location.href='../User/home.php'">

                User Demo

            </button>

            <button class="demo-btn" type="button"
                onclick="window.location.href='../Worker/dashboard.php'">

                Worker Demo

            </button>

            <button class="demo-btn" type="button"
                onclick="window.location.href='../Admin/dashboard.php'">

                Admin Demo

            </button>

        </div>

        <!-- LOGIN LINK -->

        <div class="bottom-text">

            Already have an account?

            <a href="login.php" class="signup">
                Sign In
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

