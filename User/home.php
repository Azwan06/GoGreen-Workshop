<?php

session_start();
include "../config/database.php";

$user_id = $_SESSION['user_id'];

$userResult = mysqli_query(
    $conn,
    "SELECT * FROM users WHERE id='$user_id'"
);

$user = mysqli_fetch_assoc($userResult);

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <title>GoGreen</title>

  <!-- GOOGLE FONT -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

  <!-- CSS -->
  <link rel="stylesheet" href="assets/css/home.css">

</head>

<body>

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
            <a href="recycle.php">Recycle</a>
            <a href="redeem.php">Redeem</a>
            <a href="contact.php">Contact</a>
            <!-- <a href="about.php">About</a> -->

        </nav>  
                <div class="user-avatar-container">

            <div class="user-avatar"
            onclick="toggleProfileMenu()">

                <img
src="<?php echo !empty($user['profile_image'])
    ? '../uploads/profile/'.$user['profile_image']
    : '../uploads/profile/default.jpg'; ?>"
alt="Profile">

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
                <a href="../Public/login.php">Sign Out</a>
            </div>
        </div>
    </div>

  </header>
 
  <section class="hero">

    <div class="overlay"></div>

    <div class="hero-content">

      <h1>
        Small Actions,<br>
        Big Impact
      </h1>

      <p>
        Join the GoGreen movement. Track recycling, earn rewards,
        and help build a sustainable future for our community.
      </p>

      <div class="hero-buttons">

        <a href="recycle.php" class="primary-btn">
          Start Recycling Today →
        </a>

        <a href="media.php" class="secondary-btn">
          Learn More
        </a>

      </div>

    </div>

  </section>


  <section class="stats">

    <div class="stat-card">

      <div class="stat-icon">
        ♻️
      </div>

      <h2>8M+</h2>

      <p>
        Trees recycled globally
      </p>

    </div>

    <div class="stat-card">

      <div class="stat-icon">
        🌲
      </div>

      <h2>17</h2>

      <p>
        Trees saved per ton of paper
      </p>

    </div>

    <div class="stat-card">

      <div class="stat-icon">
        🔥
      </div>

      <h2>95%</h2>

      <p>
        Energy saved recycling aluminum
      </p>

    </div>

  </section>


  <section class="about">

    <h2>
      What is Recycling?
    </h2>

    <p>
      Recycling is the process of converting waste materials into new products.
      It prevents useful materials from being wasted, reduces energy consumption,
      and lowers greenhouse gas emissions.
    </p>

  </section>

  <section class="why">

    <h2>
      Why Recycle?
    </h2>

    <div class="why-container">

      <div class="why-card">

        <div class="why-icon">
          🌍
        </div>

        <h3>
          Reduce Pollution
        </h3>

        <p>
          Recycling reduces pollution and keeps
          our environment cleaner.
        </p>

      </div>

      <div class="why-card">

        <div class="why-icon">
          ♻️
        </div>

        <h3>
          Conserve Resources
        </h3>

        <p>
          Save natural resources like trees,
          water and minerals.
        </p>

      </div>

      <div class="why-card">

        <div class="why-icon">
          🤝
        </div>

        <h3>
          Build Community
        </h3>

        <p>
          Recycling programs help communities
          work together for a greener future.
        </p>

      </div>

    </div>

  </section>


  <section class="recycle-items">

    <h2>
      What Can You Recycle?
    </h2>

    <div class="items-container">

      <div class="item-box">
        <h3>Plastic</h3>
        <p>Bottles, containers, packaging</p>
      </div>

      <div class="item-box">
        <h3>Paper</h3>
        <p>Newspapers, cardboard, office paper</p>
      </div>

      <div class="item-box">
        <h3>Glass</h3>
        <p>Bottles and jars</p>
      </div>

      <div class="item-box">
        <h3>Metal</h3>
        <p>Cans and foil</p>
      </div>

      <div class="item-box">
        <h3>E-Waste</h3>
        <p>Electronics and batteries</p>
      </div>

    </div>

  </section>


  <section class="cta">

    <h2>
      Ready to Make a Difference?
    </h2>

    <p>
      Start recycling today and help create
      a cleaner future for everyone.
    </p>

     <a href="recycle.php" class="primary-btn">
          Get Started →
        </a>
    

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