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

  <title>Contact Us</title>

  <!-- GOOGLE FONT -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

  <!-- FONT AWESOME -->
  <link
    rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"
  />

  <!-- CSS -->
  <link rel="stylesheet" href="assets/css/contact.css">

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
                <a href="setting.php">Settings</a>
                <a href="../Public/login.php">Sign Out</a>
                
            </div>
        </div>
    </div>

  </header>

  <!-- CONTACT SECTION -->

  <section class="contact-section">

    <!-- TITLE -->

    <div class="contact-header">

      <h1>

        Contact GoGreen

      </h1>

      <p>

        We'd love to hear from you. Reach out for support,
        collaborations, or any inquiries regarding GoGreen.

      </p>

    </div>

    <!-- CONTENT -->

    <div class="contact-wrapper">

      <!-- LEFT -->

      <div class="contact-info">

        <!-- LOCATION -->

        <div class="contact-card">

          <div class="icon">

            <i class="fa-solid fa-location-dot"></i>

          </div>

          <h3>

            Location

          </h3>

          <p>

            Universiti Teknikal Malaysia Melaka (UTeM)

          </p>

        </div>

        <!-- EMAIL -->

        <div class="contact-card">

          <div class="icon">

            <i class="fa-regular fa-envelope"></i>

          </div>

          <h3>

            Email

          </h3>

          <p>

            gogreen@gmail.com

          </p>

        </div>

        <!-- PHONE -->

        <div class="contact-card">

          <div class="icon">

            <i class="fa-solid fa-phone"></i>

          </div>

          <h3>

            Phone

          </h3>

          <p>

            +60 14-9124116

          </p>

        </div>

      </div>

      <!-- RIGHT -->

      <div class="contact-form">

        <h2>

          Send Us A Message

        </h2>

        <form action="../auth/process_report.php"
      method="POST">

          <label for="name">Name</label>
          <input type="text" name="name" required>

          <label for="email">Email</label>
          <input type="email" name="email" required>

          <label for="phone">Phone</label>
          <input type="text" name="phone" required>

          <label for="report_type">Report Type</label>
          <select name="report_type" required>
              <option value="Contact">Contact</option>
              <option value="Pickup">Pickup</option>
          </select>

          <label for="location">Location</label>
          <input type="text" name="location">

          <label for="subject">Subject</label>
          <input type="text" name="subject" required>


<button type="submit">
    Submit
</button>

        </form>

      </div>

    </div>

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

  <!-- JS -->

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