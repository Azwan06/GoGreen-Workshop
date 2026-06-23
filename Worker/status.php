//status

<?php

session_start();

include "../config/database.php";

if (
    !isset($_SESSION['user_id']) ||
    $_SESSION['role'] != 'worker'
) {

    header("Location: ../Public/login.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GoGreen Worker Pickup Status</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/Worker.css">
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
        <a href="status.php">Pickup</a>
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
              <a href="notification.php">Notification</a>
              <a href="setting.php">Settings</a>
              <a href="../Public/login.php">Sign Out</a>
              
          </div>
      </div>
    </div>

    </header>

    <section class="dashboard">
      <div class="schedule-header">
        <div>
          <h1>Worker Pickup</h1>
          <p>View and update your assigned pickups for the day.</p>
        </div>

        <input type="date" class="date-picker" />
      </div>
      <div class="table-container">
      <div class="dashboard-table">
        <div class="table-header">
          <span>Time</span>
          <span>Location</span>
          <span>Status</span>
        </div>

        <div class="table-row">
            <span>8:00 AM</span>
            <span>Fakulti Teknologi Maklumat dan Komunikasi</span>
            <select class="status-select completed" onchange="changeStatus(this)">
        <option value="completed" selected>Completed</option>
        <option value="accepted">Accepted</option>
        <option value="pending">Pending</option>
    </select>

            </select>
        </div>

        <div class="table-row">
            <span>10:00 AM</span>
            <span>Masjid UTeM</span>
            <select class="status-select accepted" onchange="changeStatus(this)">
        <option value="accepted" selected>Accepted</option>
        <option value="completed">Completed</option>
        <option value="pending">Pending</option>
    </select>
        </div>
        <div class="table-row">
            <span>12:00 PM</span>
            <span>Kolej Satria</span>
            <select class="status-select pending" onchange="changeStatus(this)">
        <option value="pending" selected>Pending</option>
        <option value="accepted">Accepted</option>
        <option value="completed">Completed</option>
    </select>
        </div>
      </div>
     
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
        
        function toggleMenu() {
          document.getElementById("navMenu").classList.toggle("active");
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

    function changeStatus(select){

        select.classList.remove(
            "completed",
            "accepted",
            "pending"
        );

        select.classList.add(select.value);

    }
    </script>
</body>
</html>