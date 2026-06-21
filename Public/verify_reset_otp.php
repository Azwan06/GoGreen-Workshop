<?php

session_start();

if(!isset($_SESSION['reset_email'])){
    header("Location: forgotpass.php");
    exit();
}

?>

<!DOCTYPE html>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Verify OTP | GoGreen</title>

<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

<link rel="stylesheet" href="assets/css/forgotpass.css">

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

        <button
            class="sign-btn"
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

    <h1>Verify OTP</h1>

    <p>
        Enter the 6-digit OTP sent to your email.
    </p>

    <form
    action="../auth/verify_reset_otp_process.php"
    method="POST">

        <label class="input-label">
            OTP Code
        </label>

        <input
            type="text"
            name="otp"
            class="input-box"
            placeholder="Enter OTP"
            maxlength="6"
            required
        >

        <button type="submit" class="signin-btn">
            Verify OTP
        </button>

    </form>

    <div class="bottom-text">
        Didn't receive the code?
        <a href="forgotpass.php">
            Resend OTP
        </a>
    </div>

</div>
</section>
<footer>


<p class="left-footer">
    © 2026 GoGreen. All Rights Reserved.
</p>
<p class="right-footer">
    Make the earth greener together.
</p>
</footer>
<script>

function toggleMenu(){
    document
        .getElementById("navMenu")
        .classList
        .toggle("active");
}

</script>
</body>
</html>
