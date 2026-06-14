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
    <title>Leaderboard | GoGreen</title>

      <!-- GOOGLE FONT -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

  <!-- CSS -->
  <link rel="stylesheet" href="assets/css/leaderboard.css">
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
                    <h4>John Doe</h4>
                    <p>johndoe@student.utem.edu.my</p>
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

  <section class="leaderboard-hero">
    <h1>Community Leaderboard</h1>
    <p>See who's making the biggest impact for greener future.</p>

  </section>

  <!-- TOP 3 -->
  <section class="top-users">

    <!-- SECOND -->
    <div class="top-card second">

      <div class="rank">
        🥈
      </div>


      <h3>
        Sarah Lee
      </h3>

      <p>
        4,850 Points
      </p>

    </div>

    <!-- FIRST -->
    <div class="top-card first">

      <div class="crown">
        👑
      </div>

      <div class="rank">
        🥇
      </div>

      <h3>
        Daniel Wong
      </h3>

      <p>
        6,320 Points
      </p>

    </div>

    <!-- THIRD -->
    <div class="top-card third">

      <div class="rank">
        🥉
      </div>

      <h3>
        Aina Sofea
      </h3>

      <p>
        4,120 Points
      </p>

    </div>

  </section>

  <!-- TABLE -->
  <section class="leaderboard-table-section">

    <div class="table-container">

      <table>

        <thead>

          <tr>
            <th>Rank</th>
            <th>User</th>
            <th>Items Recycled</th>
            <th>Total Points</th>
          </tr>

        </thead>

        <tbody>

          <tr>
            <td>#1</td>
            <td>Daniel Wong</td>
            <td>580</td>
            <td>6,320</td>
          </tr>

          <tr>
            <td>#2</td>
            <td>Sarah Lee</td>
            <td>510</td>
            <td>4,850</td>
          </tr>

          <tr>
            <td>#3</td>
            <td>Aina Sofea</td>
            <td>470</td>
            <td>4,120</td>
          </tr>

          <tr>
            <td>#4</td>
            <td>Hakim</td>
            <td>420</td>
            <td>3,980</td>
          </tr>

          <tr>
            <td>#5</td>
            <td>Faris</td>
            <td>390</td>
            <td>3,650</td>
          </tr>

          <tr>
            <td>#6</td>
            <td>Nurul</td>
            <td>340</td>
            <td>3,210</td>
          </tr>

        </tbody>

      </table>

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