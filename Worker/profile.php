//profile

<?php

session_start();
include "../config/database.php";

if(!isset($_SESSION['user_id'])){
    header("Location: ../login.php");
    exit();
}

$user_id = $_SESSION['user_id'];

$userQuery = mysqli_query(
    $conn,
    "SELECT * FROM users WHERE id='$user_id'"
);

$user = mysqli_fetch_assoc($userQuery);

$history = mysqli_query(
    $conn,
    "SELECT *
     FROM recycle_submissions
     WHERE user_id='$user_id'
     ORDER BY created_at DESC"
);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GoGreen - Profile</title>
    
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="assets/css/profile.css">
</head><!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Worker Schedule</title>

    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />

    <link
      href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap"
      rel="stylesheet"
    />
    <link rel="stylesheet" href="assets/css/Worker.css" />
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
        <a href="dashboard.php">Dashboard</a>
        <a href="schedule.php">Schedule</a>
        <a href="status.php">Reports</a>
      </nav>
    
      <div class="user-avatar-container">
          <div class="user-avatar" onclick="toggleProfileMenu()">
              <img src="<?php echo !empty($user['profile_image'])
? '../uploads/profile/'.$user['profile_image']
: '../uploads/profile/default.jpg'; ?>"
alt="Profile">>
          </div>

          <div class="profile-menu" id="profileMenu">

              <div class="profile-info">
    <h4><?php echo $_SESSION['fullname']; ?></h4>
    <p><?php echo $_SESSION['email']; ?></p>
</div>

<a href="profile.php">Profile</a>
<a href="setting.php">Settings</a>
<a href="../auth/logout.php">Sign Out</a>
              
          </div>
      </div>
    </div>

    </header>
 
    <main class="profile-container">

        <div class="page-header">
            <a href="javascript:history.back()" class="back-btn">← Back</a>

            <h1 class="page-main-title">Profile</h1>
        </div>
    
        <section class="user-card-section">
            
<div class="avatar-wrapper">
    <div class="user-avatar">

        <img
        src="<?php echo !empty($user['profile_image'])
            ? '../uploads/profile/'.$user['profile_image']
            : '../uploads/profile/default.jpg'; ?>"
        alt="Profile">

    </div>
</div>
            
            <div class="user-card-body">
                <h1 class="user-name">
    <?php echo htmlspecialchars($user['fullname']); ?>
</h1>
                <div class="user-meta-grid">
                    <p><strong>Email:</strong> <?php echo htmlspecialchars($user['email']); ?></p>
                    <p><strong>Location:</strong> <?php echo !empty($user['address']) ? $user['address'] : 'Not Set'; ?></p>
                    <p><strong>Status:</strong> <?php echo ucfirst($user['role']); ?></p>
                </div>
            </div>
        </section>

        <section class="info-widgets-grid">

    <div class="widget-card">

        <h3 class="widget-title">
            Account Settings
        </h3>

       <form action="../auth/update_profile.php" method="POST">

<input type="hidden"
       name="redirect_page"
       value="worker">

    <div class="form-group">
        <label>Display Name</label>
        <input
        type="text"
        name="fullname"
        value="<?php echo htmlspecialchars($user['fullname']); ?>"
        required>
    </div>

    <div class="form-group">
        <label>Email Address</label>
        <input
        type="email"
        value="<?php echo htmlspecialchars($user['email']); ?>"
        readonly>
    </div>

    <button
    type="submit"
    class="btn-save">

        Save Changes

    </button>

</form>

<hr style="margin:20px 0;">

<form action="../auth/update_profile_image.php"
      method="POST"
      enctype="multipart/form-data">

<input type="hidden"
       name="redirect_page"
       value="worker">

    <label>
        Change Profile Photo
    </label>

    <input
    type="file"
    name="profile_image"
    accept="image/*"
    required>

    <button
    type="submit"
    class="btn-save2">

        Upload Photo

    </button>

</form>  
    </div>

</section>


        
    </main>

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
  .getElementById("sidebar")
  .classList.toggle("active");

}

    
    </script>
    
</body>
</html>