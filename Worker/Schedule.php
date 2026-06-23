//schedule

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

$worker_id = $_SESSION['user_id'];

$selected_date = date('Y-m-d');

if(isset($_GET['date']) && !empty($_GET['date'])){
    $selected_date = $_GET['date'];
}

$routineQuery = "

SELECT
id,
task_title,
location,
schedule_time,
priority,
'Routine Task' AS task_description,
'pending' AS status

FROM worker_routine

WHERE worker_id = '$worker_id'

";

$routineResult =
mysqli_query($conn,$routineQuery);


$scheduleQuery = "

SELECT
id,
task_title,
location,
schedule_time,
priority,
task_description,
status

FROM schedules

WHERE worker_id = '$worker_id'
AND schedule_date = '$selected_date'

";

$scheduleResult =
mysqli_query($conn,$scheduleQuery);
?>

<!DOCTYPE html>
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

    <section class="dashboard">
      <div class="schedule-header">
        <div>
          <h1>Worker Schedule</h1>
          <p>Check your daily pickup schedule here.</p>
        </div>

        <form method="GET">

    <input
        type="date"
        name="date"
        class="date-picker"
        value="<?php echo $selected_date; ?>"
        onchange="this.form.submit()"
    >

</form>
      </div>
      <div class="table-container">
      <div class="dashboard-table">
<div class="table-header">

    <span>Time</span>
    <span>Task</span>
    <span>Description</span>
    <span>Location</span>
    <span>Priority</span>
    <span>Status</span>

</div>



<?php while($task = mysqli_fetch_assoc($routineResult)) { ?>

<div class="table-row">

    <span>
        <?php echo date(
            "g:i A",
            strtotime($task['schedule_time'])
        ); ?>
    </span>

    <span>
        <?php echo $task['task_title']; ?>
    </span>

    <span>
        Daily Collection Route
    </span>

    <span>
        <?php echo $task['location']; ?>
    </span>

    <span class="priority-<?php echo $task['priority']; ?>">
        <?php echo ucfirst($task['priority']); ?>
    </span>

    <div class="status-cell">

        <span
        style="
        background:#d4edda;
        color:#155724;
        padding:8px 15px;
        border-radius:8px;
        font-weight:600;
        ">
            Routine
        </span>

    </div>

</div>

<?php } ?>


<?php while($task = mysqli_fetch_assoc($scheduleResult)) { ?>

<div class="table-row">

    <span>
        <?php echo date(
            "g:i A",
            strtotime($task['schedule_time'])
        ); ?>
    </span>

    <span>
        <?php echo htmlspecialchars(
            $task['task_title']
        ); ?>
    </span>

    <span>
        <?php echo htmlspecialchars(
            $task['task_description']
        ); ?>
    </span>

    <span>
        <?php echo htmlspecialchars(
            $task['location']
        ); ?>
    </span>

    <span class="priority-<?php echo strtolower($task['priority']); ?>">
        <?php echo htmlspecialchars(
            $task['priority']
        ); ?>
    </span>

    <td>

<div class="status-cell">

<form
action="../auth/update_schedule_status.php"
method="POST">

    <input
        type="hidden"
        name="schedule_id"
        value="<?php echo $task['id']; ?>">

        <!-- dropdown status -->

    <select
        name="status"
        class="status-select <?php echo $task['status']; ?>"
        onchange="this.form.submit()">

        <option value="pending"
        <?php if($task['status']=='pending') echo 'selected'; ?>>
            Pending
        </option>

        <option value="ongoing"
        <?php if($task['status']=='ongoing') echo 'selected'; ?>>
            Ongoing
        </option>

        <option value="completed"
        <?php if($task['status']=='completed') echo 'selected'; ?>>
            Completed
        </option>

    </select>

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

  <!-- SCRIPT -->
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

    // STATUS COLOR CHANGE

    function changeStatus(select){

        select.classList.remove(
            "completed",
            "accepted",
            "pending"
        );

        select.classList.add(select.value);

    }

document.querySelectorAll('.status-select').forEach(select => {

    select.addEventListener('change', function(){

        this.classList.remove(
            'pending',
            'ongoing',
            'completed'
        );

        this.classList.add(this.value);

    });

});



</script>
  </body>
</html>
