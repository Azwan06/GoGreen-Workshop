<?php

session_start();

include "../config/database.php";

// if (!isset($_SESSION['user_id'])) {

//     header("Location: ../Public/login.php");
//     exit();
// }

$result = mysqli_query(

    $conn,

    "SELECT *
    FROM media_posts
    WHERE audience IN ('Everyone','Users')
    ORDER BY created_at DESC"

);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GoGreen</title>
    
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="assets/css/media.css">
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

    <section class="hero">
        <div class="hero-content">
            <h1>
                Recycle Awareness Media <br>
            </h1>
            <p>
                Watch, learn and get inspired by recycling videos, posters and community photos.
            </p>
        </div>
    </section>

    <section class="story">

    <h2>Media Feed</h2>

    <div class="medium">

        <?php
        while($row = mysqli_fetch_assoc($result)){
        ?>

        <div class="medium-container">

            <?php if(!empty($row['youtube_link'])){ ?>

                <a
                href="<?php echo $row['youtube_link']; ?>"
                target="_blank">

                    <img
                    src="../uploads/<?php echo $row['image']; ?>"
                    alt="Media">

                </a>

            <?php } else { ?>

                <img
                src="../uploads/<?php echo $row['image']; ?>"
                alt="Media">

            <?php } ?>

            <div class="medium-info">

                <span
                style="
                background:#2e8b57;
                color:white;
                padding:5px 10px;
                border-radius:20px;
                font-size:12px;">

                    <?php echo $row['media_type']; ?>

                </span>

                <h3>

                    <?php echo $row['title']; ?>

                </h3>

                <p>

                    <?php echo $row['content']; ?>

                </p>

                <small>

                    <?php echo $row['created_at']; ?>

                </small>

            </div>

        </div>

        <?php
        }
        ?>

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