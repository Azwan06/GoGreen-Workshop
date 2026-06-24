<?php

session_start();

if(
!isset($_SESSION['reset_email'])
||
!isset($_SESSION['otp_verified'])
){
    header("Location: forgotpass.php");
    exit();
}

?>

<!DOCTYPE html>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Reset Password | GoGreen</title>

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

    <h1>Reset Password</h1>

    <p>
        Create a new password for your GoGreen account.
    </p>

    <form
    action="../auth/reset_password_process.php"
    method="POST">

        <label class="input-label">
            New Password
        </label>

        <input
            type="password"
            name="password"
            class="input-box"
            placeholder="Enter new password"
            required
        >

        <label class="input-label">
            Confirm Password
        </label>

        <input
            type="password"
            name="confirm_password"
            class="input-box"
            placeholder="Confirm new password"
            required
        >

        <button type="submit" class="signin-btn">
            Reset Password
        </button>

    </form>

    <div class="bottom-text">
        Remember your password?
        <a href="login.php">
            Back to Login
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
