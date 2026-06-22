<?php

include "../config/database.php";

$leaderboard = mysqli_query(

    $conn,

    "SELECT *
    FROM users
    WHERE role = 'user'
    ORDER BY points DESC
    LIMIT 10"

);

$topUsers = [];

while($row = mysqli_fetch_assoc($leaderboard)){

    $topUsers[] = $row;

}

session_start();

if (!isset($_SESSION['user_id'])) {

    header("Location: ../Public/login.php");
    exit();
}

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
            <a href="recycle.php">Recycle</a>
            <a href="redeem.php">Redeem</a>
            <a href="contact.php">Contact</a>

        </nav>  
        <div class="user-avatar-container">
            <div class="user-avatar" onclick="toggleProfileMenu()">
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

  <section class="leaderboard-hero">
    <h1>Community Leaderboard</h1>
    <p>See who's making the biggest impact for greener future.</p>

  </section>

  <!-- TOP 3 -->
  <section class="top-users">

    <!-- SECOND -->
    <?php if(isset($topUsers[1])){ ?>
    <div class="top-card second">

        <div class="rank">🥈</div>

        <h3>
            <?php echo $topUsers[1]['fullname']; ?>
        </h3>

        <p>
            <?php echo number_format($topUsers[1]['points']); ?>
            Points
        </p>

    </div>
    <?php } ?>

    <!-- FIRST -->
    <?php if(isset($topUsers[0])){ ?>
    <div class="top-card first">

        <div class="crown">👑</div>

        <div class="rank">🥇</div>

        <h3>
            <?php echo $topUsers[0]['fullname']; ?>
        </h3>

        <p>
            <?php echo number_format($topUsers[0]['points']); ?>
            Points
        </p>

    </div>
    <?php } ?>

    <!-- THIRD -->
    <?php if(isset($topUsers[2])){ ?>
    <div class="top-card third">

        <div class="rank">🥉</div>

        <h3>
            <?php echo $topUsers[2]['fullname']; ?>
        </h3>

        <p>
            <?php echo number_format($topUsers[2]['points']); ?>
            Points
        </p>

    </div>
    <?php } ?>

</section>

  <!-- TABLE -->
  <section class="leaderboard-table-section">

    <div class="table-container">

      <table>

        <thead>

          <tr>
            <th>Rank</th>
            <th>User</th>
            <th>Total Points</th>
          </tr>

        </thead>

        <tbody>

          <?php

$rank = 1;

foreach($topUsers as $user){

?>

<tr>

    <td>
        #<?php echo $rank; ?>
    </td>

    <td>
        <?php echo $user['fullname']; ?>
    </td>

    <td>
        <?php echo number_format($user['points']); ?>
    </td>

</tr>

<?php

$rank++;

}

?>

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