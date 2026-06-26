<<<<<<< HEAD
=======
<<<<<<<< HEAD:User/setting.php
========
//setting

>>>>>>>> hazeeq:Worker/setting.php
>>>>>>> hazeeq
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

?>
<!DOCTYPE html>
<html lang="en">
<<<<<<< HEAD
=======
<<<<<<<< HEAD:User/setting.php
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Profile & Settings - GoGreen</title>
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap"
      rel="stylesheet"
    />
    <link rel="stylesheet" href="assets/css/setting.css">
  </head>
  <body>
========
>>>>>>> hazeeq
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GoGreen Worker Pickup Status</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/setting.css">
</head>
<body>
<<<<<<< HEAD
=======
>>>>>>>> hazeeq:Worker/setting.php
>>>>>>> hazeeq
    
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

<<<<<<< HEAD
    </div>

    <div class="header-right">
=======
<<<<<<<< HEAD:User/setting.php
        <nav id="navMenu">
          
            <a href="home.php">Home</a>
            <a href="map.php">Map</a>
            <a href="media.php">Media</a>
            <a href="recycle.php">Recycle</a>
            <a href="redeem.php">Redeem</a>
            <a href="contact.php">Contact</a>

          <!-- <button class="sign-btn" onclick="window.location.href = '../Public/login.php'">
            Sign Out
          </button> -->
========
    </div>

    <div class="header-right">
>>>>>>>> hazeeq:Worker/setting.php
>>>>>>> hazeeq

      <nav id="navMenu">
        <a href="dashboard.php">Dashboard</a>
        <a href="schedule.php">Schedule</a>
        <a href="status.php">Reports</a>
      </nav>


      <div class="user-avatar-container">

    <div class="user-avatar"
         onclick="toggleProfileMenu()">

        <img src="<?php echo !empty($user['profile_image'])
? '../uploads/profile/'.$user['profile_image']
: '../uploads/profile/default.jpg'; ?>"
alt="Profile">>

    </div>

    <div class="profile-menu" id="profileMenu">

        <div class="profile-header">
            <h4><?= $user['username']; ?></h4>
            <p><?= $user['email']; ?></p>
        </div>

        <a href="profile.php">Profile</a>
        <a href="setting.php">Settings</a>
        <a href="../auth/logout.php">Sign Out</a>

    </div>

</div>
    </div>

    </header>

<main class="page-container">

      <div class="back-wrapper">
        <a href="javascript:history.back()" class="back-btn">← Back</a>
      </div>

      <div class="setting-layout">

        <h1>Profile & Settings</h1>
        <p>
          Manage your account, update your information, and customize your
          preferences.
        </p>
      </div>

      <div class="setting-layout">
        <!-- CARD FIRST -->

        <div class="card-container">
          <h2>Account Information</h2>
          <p>View and edit your personal details, email, and password.</p>

          <!-- PICTURE -->
          <div class="profile-picture-row">
<<<<<<< HEAD
=======
<<<<<<<< HEAD:User/setting.php
            <div class="avatar-circle">

    <img
    src="<?php echo !empty($user['profile_image'])
        ? '../uploads/profile/'.$user['profile_image']
        : '../uploads/profile/default.jpg'; ?>"
    alt="Profile">

</div>
           <div class="upload-controls">

    <span class="upload-label">
        Profile picture
    </span>

    <form
    action="../auth/update_profile_image.php"
    method="POST"
    enctype="multipart/form-data">

        <label class="btn-upload">

            <input
            type="file"
            name="profile_image"
            accept="image/*"
            onchange="this.form.submit()"
            hidden>

            ↑ Upload

        </label>

    </form>

    <span class="upload-hint">
        PNG, JPG up to 2MB
    </span>

</div>
</div>

<form
action="../auth/update_profile.php"
method="POST"
class="profile-form">
========
>>>>>>> hazeeq
            <div class="avatar-circle">??</div>
            <div class="upload-controls">
              <span class="upload-label">Profile picture</span>
              <label class="btn-upload">
                <form
action="../auth/update_profile_image.php"
method="POST"
enctype="multipart/form-data">

<input type="hidden"
name="redirect_page"
value="worker">

<input type="file"
name="profile_image">

<button type="submit">
Upload
</button>

</form>
                ↑ Upload
              </label>
              <span class="upload-hint">PNG, JPG up to 2MB</span>
            </div>
          </div>
<<<<<<< HEAD
=======
>>>>>>>> hazeeq:Worker/setting.php
>>>>>>> hazeeq

          <div class="form-grid">
            <div class="form-group">
              <label class="input-label">Full name</label>
<<<<<<< HEAD
              <input type="text" class="form-input" />
=======
              <input
type="text"
class="form-input"
name="fullname"
value="<?php echo htmlspecialchars($user['fullname']); ?>">
>>>>>>> hazeeq
            </div>

            <div class="form-group">
              <label class="input-label">Email</label>
<<<<<<< HEAD
              <input type="email" class="form-input" />
            </div>

            <div class="form-group">
              <label class="input-label">Department</label>
              <input type="text" class="form-input" />
=======
              <input
type="email"
class="form-input"
name="email"
value="<?php echo htmlspecialchars($user['email']); ?>"
required>
            </div>

            <div class="form-group">
              <label class="input-label">Faculty</label>
              <input
type="text"
class="form-input"
name="faculty"
value="<?php echo htmlspecialchars($user['faculty']); ?>">
>>>>>>> hazeeq
            </div>

            <div class="form-group">
              <label class="input-label">Role</label>
<<<<<<< HEAD
              <input type="text" class="form-input "value="Administrator" readonly/>
=======
              <input type="text" class="form-input" value="<?php echo ucfirst($user['role']); ?>" readonly/>
>>>>>>> hazeeq
            </div>
          </div>

          <div class="form-footer">
<<<<<<< HEAD
            <button type="button" class="btn-save">Save changes</button>
          </div>
        </div>

=======

    <button
    type="submit"
    class="btn-save">

        Save Changes

    </button>

</div>

</form>

</div>
>>>>>>> hazeeq
        <!-- CARD SECOND -->
        <div class="card-container">
            <h2>Preferences</h2>
           
            <div class="preferences-row">
                <h4>Email notifications</h4>
                <p>Pickup updates & news</p>
                <label class="switch">
                    <input type="checkbox" checked>
                    <span class="slider round"></span>
                </label>
            </div>


            <div  class="preferences-row">
                <h4>Push notifications</h4>
                <p>Real-time alerts</p>
                <label class="switch">
                    <input type="checkbox" checked>
                    <span class="slider round"></span>
                </label>
            </div>


            <div  class="preferences-row">
                <h4>Weekly digest</h4>
                <p>Sunday recap</p>
                <label class="switch">
                    <input type="checkbox" checked>
                    <span class="slider round"></span>
                </label>
            </div>
    
            


        </div>
      </div>
    </main>

    <footer>
      <p class="left-footer">© GoGreen. All rights reserved.</p>
      <p class="right-footer">
        Contact us: Al-Khawarizmi UTeM, Melaka, Malaysia
      </p>
    </footer>

    <script>
        
       function toggleProfileMenu()
{
    document
    .getElementById("profileMenu")
    .classList.toggle("active");
}

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