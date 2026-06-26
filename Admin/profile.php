<?php

session_start();

if (!isset($_SESSION['user_id'])) {

    header("Location: ../Public/login.php");
    exit();
}

include "../config/database.php";

$user_id = $_SESSION['user_id'];

$user = mysqli_fetch_assoc(
    mysqli_query(
        $conn,
        "SELECT * FROM users WHERE id='$user_id'"
    )
);

$history = mysqli_query(

    $conn,

    "SELECT *
    FROM recycle_submissions
    WHERE user_id = '$user_id'
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
</head>

<body>
    
    <header>
            
        <div class="header-left">

            <div class="menu-toggle" onclick="toggleMenu()">
                ☰
            </div>

            <div class="logo">
                <img src="image/recycle_imag.png" alt="GoGreen Logo">
                GoGreen
            </div>

        </div>

    </header>

    <div class="sidebar" id="sidebar">
        <button class="close-btn" onclick="toggleMenu()">✕</button>
        <h2 class="sidebar-logo">GoGreen</h2>

        <a href="dashboard.php">Dashboard</a>
        <a href="reqsub.php">Submissions</a>
        <a href="reqreward.php">Redemptions</a>
        <a href="addschedule.php">Schedule</a>
        <a href="addbin.php">Bin Map</a>
        <a href="reports.php">Reports</a>
        <a href="addreward.php">Rewards</a>
        <a href="userrole.php">Users</a>
        <a href="media.php">Media</a>
        
    </div>
 
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
                    
                    <p><strong>Status:</strong> <?php echo ucfirst($user['role']); ?></p>
                </div>
            </div>
        </section>

        <section class="info-widgets-grid">

    <div class="widget-card">

        <h3 class="widget-title">
            Account Settings
        </h3>

        <form
class="settings-form"
action="../auth/update_profile.php"
method="POST">

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

<form
class="upload-form"
action="../auth/update_profile_image.php"
method="POST"
enctype="multipart/form-data">

    <input
    type="hidden"
    name="redirect_page"
    value="admin">

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