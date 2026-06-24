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

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

      <!-- GOOGLE FONT -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

  <!-- CSS -->
  <link rel="stylesheet" href="assets/css/leaderboard.css">
</head>
<body>
    
<header>

    <div class="logo">
      <img src="image/recycle_imag.png" alt="GoGreen Logo">
      GoGreen
    </div>

    <nav id="navMenu">

      <a href="index.php">Home</a>
      <a href="about.php">About</a>
      <a href="media.php">Media</a>
      <a href="map.php">Map</a>
      <a href="leaderboard.php">Leaderboard</a>
      <a href="contactus.php">Contact</a>

      <button  class="sign-btn" onclick="window.location.href='login.php'">
        Sign In
      </button>

    </nav>

    <div class="menu-toggle" onclick="toggleMenu()">
      ☰
    </div>

  </header>

  <section class="leaderboard-hero">
    <h1>Community Leaderboard</h1>
    <p>See who's making the biggest impact for greener future.</p>

  </section>

  <!-- TOP 3 -->
  <section class="top-users">

    <?php if(isset($topUsers[1])){ ?>
    <div class="top-card second">
        <div class="rank">🥈</div>
        <h3><?php echo $topUsers[1]['fullname']; ?></h3>
        <p><?php echo number_format($topUsers[1]['points']); ?> Points</p>
    </div>
    <?php } ?>

    <?php if(isset($topUsers[0])){ ?>
    <div class="top-card first">
        <div class="crown">👑</div>
        <div class="rank">🥇</div>
        <h3><?php echo $topUsers[0]['fullname']; ?></h3>
        <p><?php echo number_format($topUsers[0]['points']); ?> Points</p>
    </div>
    <?php } ?>

    <?php if(isset($topUsers[2])){ ?>
    <div class="top-card third">
        <div class="rank">🥉</div>
        <h3><?php echo $topUsers[2]['fullname']; ?></h3>
        <p><?php echo number_format($topUsers[2]['points']); ?> Points</p>
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

  </script>
</body>
</html>