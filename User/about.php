<?php

session_start();

if (!isset($_SESSION['user_id'])) {

    header("Location: ../Public/login.php");
    exit();
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About Us</title>

      <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

  <link rel="stylesheet" href="assets/css/about.css">
</head>

  <!-- HEADER -->
  <header>

    <!-- avatar -->
    <div class="header-left">

        <div class="menu-toggle" onclick="toggleMenu()">
            ☰
        </div> 

        <div class="logo">
            <img src="image/recycle_imag.png" alt="GoGreen Logo">
            GoGreen
        </div>

    </div>

    <div class="header-right">
      
        <nav id="navMenu">

            <a href="home.php">Home</a>
            <a href="map.php">Map</a>
            <a href="media.php">Media</a>
            <a href="recycle.php">Recylce</a>
            <a href="redeem.php">Redeem</a>
            <a href="contact.php">Contact</a>

        </nav>  
        <div class="user-avatar-container">
            <div class="user-avatar" onclick="toggleProfileMenu()">
                <img src="image/avatar.png" alt="User Avatar">
            </div>

            <div class="profile-menu" id="profileMenu">

                <div class="profile-info">
                    <h4>
                        <?php echo $_SESSION['fullname']; ?>
                    </h4>

                    <p>
                        <?php echo $_SESSION['email']; ?>
                    </p>
                </div>

                <a href="profile.php">Profile</a>
                <a href="leaderboard.php">Leaderboard</a>
                <a href="notification.php">Notification</a>
                <a href="setting.php">Settings</a>
                <a href="../Public/login.php">Sign Out</a>
                
            </div>
        </div>
    </div>

  </header>

<body>
    
    <section class="hero">
        <div class="hero-content">
        <h1>About GoGreen</h1>
        <p>GoGreen is a platform dedicated to making recycling accessible,trackable, and rewarding.
             Our mission is to empower individuals to  take meaningful action for the environment.</p> 
        </div>
    </section>
<!-- FEATURES -->
  <section class="features">

    <div class="feature-card">

      <div class="icon">
        🌱
      </div>

      <h3>
        Sustainability
      </h3>

      <p>
        We believe every small action contributes
        to a larger movement for environmental change.
      </p>

    </div>

    <div class="feature-card">

      <div class="icon">
        🎯
      </div>

      <h3>
        Education
      </h3>

      <p>
        Knowledge is power. We aim to educate
        communities about the importance of recycling.
      </p>

    </div>

    <div class="feature-card">

      <div class="icon">
        💚
      </div>

      <h3>
        Community
      </h3>

      <p>
        Together we can create lasting change.
        GoGreen connects eco-conscious individuals worldwide.
      </p>

    </div>

  </section>

  <!-- STORY -->
  <section class="story">

    <h2>
      Our Story
    </h2>

    <p>
      Founded in 2024, GoGreen started as a simple idea:
      what if recycling could be as engaging as a game?
      We built a platform where every bottle, newspaper,
      and can you recycle earns you points — turning
      everyday actions into measurable impact.
    </p>

    <p>
      Today, our community of eco-warriors tracks thousands
      of kilograms of recycled materials every month,
      proving that collective small actions truly make
      a massive difference.
    </p>

  </section>

  <!-- FOOTER -->
  <footer>

  <p class="left-footer">
    © GoGreen. All rights reserved.
  </p>

  <p class="right-footer">
    Contact us: Al-Khawarizmi UTeM, Melaka, Malaysia
  </p>

</footer>

  <!-- SCRIPT -->
  <script>

    function toggleMenu(){

      document
      .getElementById("navMenu")
      .classList.toggle("active");

    }

    // toggle avatar
    function toggleProfileMenu(){
        document.getElementById("profileMenu").classList.toggle("show");
    }

    document.addEventListener("click",function(event){
        const container = document.querySelector(".user-avatar-container");
        const menu = document.getElementById("profileMenu");
        
        if(!container.contains(event.target)){
            menu.classList.remove("show");
        }
    });
    
  </script>

</body>
</html>