<?php

session_start();

include "../config/database.php";

$worker_id = $_SESSION['user_id'];

$sql = "
SELECT *
FROM reports
WHERE worker_id='$worker_id'
ORDER BY id DESC
";

$result = mysqli_query($conn,$sql);

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
              <a href="../Public/login.php">Sign Out</a>
              
          </div>
      </div>
    </div>

    </header>

    <section class="dashboard">
      <div class="schedule-header">
        <div>
          <h1>Worker Reports</h1>
          <p>View and update your assigned reports for the day.</p>
        </div>

        <input type="date" class="date-picker" />
      </div>
      <div class="table-container">
      <div class="dashboard-table">
        <div class="table-header">
          <span>Type</span>
          <span>Location</span>
          <span>Status</span>
        </div>
<?php while($row = mysqli_fetch_assoc($result)) { ?>

<div class="table-row">

    <span>
        <?= $row['report_type']; ?>
    </span>

    <span>
        <?= $row['location']; ?>
    </span>

<div class="status-cell">

<form
action="../auth/update_report_status.php"
method="POST">

<input
type="hidden"
name="report_id"
value="<?= $row['id']; ?>">

<select
name="status"
class="status-select"

<?= ($row['status'] == 'Completed') ? 'disabled' : ''; ?>>

<option value="Assigned"
<?= $row['status']=='Assigned'?'selected':'' ?>>
Assigned
</option>

<option value="In Progress"
<?= $row['status']=='In Progress'?'selected':'' ?>>
In Progress
</option>

<option value="Completed"
<?= $row['status']=='Completed'?'selected':'' ?>>
Completed
</option>

</select>

<button
type="submit"
class="update-btn"

<?= ($row['status'] == 'Completed') ? 'disabled' : ''; ?>>

Update

</button>

</form>

</div>

</div>

<?php } ?>

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