<?php

session_start();
include "../config/database.php";

if (
    !isset($_SESSION['user_id']) ||
    $_SESSION['role'] != 'admin'
) {
    header("Location: ../Public/login.php");
    exit();
}

$workerSummary = mysqli_query($conn, "

SELECT
u.id,
u.fullname,
COUNT(s.id) AS total_tasks

FROM users u

LEFT JOIN schedules s
ON u.id = s.worker_id
AND s.status != 'completed'

WHERE u.role='worker'

GROUP BY u.id

ORDER BY u.fullname

");

$taskList = mysqli_query($conn, "

SELECT
s.*,
u.fullname

FROM schedules s

LEFT JOIN users u
ON s.worker_id = u.id

ORDER BY s.schedule_date DESC,
s.schedule_time DESC

");

$routineList = mysqli_query($conn, "

SELECT
wr.*,
u.fullname

FROM worker_routine wr

LEFT JOIN users u
ON wr.worker_id = u.id

ORDER BY
u.fullname,
wr.schedule_time

");


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Schedule | GoGreen</title>

    <!-- GOOGLE FONT -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="assets/css/addschedule.css">
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


        <div class="header-right">
        
            <div class="user-avatar-container">
                <div class="user-avatar" onclick="toggleProfileMenu()">
                    <img
src="<?php echo !empty($_SESSION['profile_image'])
? '../uploads/profile/'.$_SESSION['profile_image']
: '../uploads/profile/default.jpg'; ?>"
alt="Profile">
                </div>

                <div class="profile-menu" id="profileMenu">

                    <div class="profile-info">
                        <h4><?php echo $_SESSION['fullname']; ?></h4>
                        <p><?php echo $_SESSION['email']; ?></p>
                    </div>

                    <a href="profile.php">Profile</a>
                    <a href="../auth/logout.php">Sign Out</a>

                </div>
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

    <!-- PAGE TITLE -->
    <section class="page-title">

        <h1>
            Worker Schedule
        </h1>

        <p>
            Assign collection tasks to workers and manage schedules.
        </p>

    </section>

    <!-- WORKER SUMMARY -->
<div class="worker-container">

<?php while($worker = mysqli_fetch_assoc($workerSummary)) { ?>

    <div class="worker-summary">

        <div class="worker-avatar">

            <?php
            echo strtoupper(
                substr(
                    $worker['fullname'],
                    0,
                    1
                )
            );
            ?>

        </div>

        <div class="worker-info">

            <h3>
                <?php echo htmlspecialchars($worker['fullname']); ?>
            </h3>

            <p>
                Worker
            </p>

        </div>

        <div class="worker-active">

            <h2>
                <?php echo $worker['total_tasks']; ?>
            </h2>

            <span>
                active
            </span>

        </div>

    </div>

<?php } ?>

</div>

    <!-- TASK CONTAINER -->
    <div class="task-container">

        <div class="task-header">

            <h2>
                All Scheduled Tasks
            </h2>

        </div>
        <?php if(mysqli_num_rows($taskList) > 0) { ?>

<?php while($task = mysqli_fetch_assoc($taskList)) { ?>

<div class="task-row">

    <div class="task-date">

        <h4>
            <?php echo date(
                "d M Y",
                strtotime($task['schedule_date'])
            ); ?>
        </h4>

        <span>
            <?php echo date(
                "g:i A",
                strtotime($task['schedule_time'])
            ); ?>
        </span>

    </div>

    <div class="task-zone">
        <?php echo htmlspecialchars($task['location']); ?>
    </div>

    <div class="task-worker">

        <div class="mini-avatar">
            <?php echo strtoupper(substr($task['fullname'],0,1)); ?>
        </div>

        <?php echo htmlspecialchars($task['fullname']); ?>

    </div>

    <div class="task-status">
        <?php echo ucfirst($task['status']); ?>
    </div>

</div>

<?php } ?>

<?php } else { ?>

<div class="task-row">

    <div>No tasks assigned yet.</div>
    <div>-</div>
    <div>-</div>
    <div>-</div>

</div>

<?php } ?>
</div>
            

<div class="task-container">

    <div class="task-header">

        <h2>
            Routine Tasks
        </h2>

    </div>

<?php while($routine = mysqli_fetch_assoc($routineList)) { ?>

<div class="task-row">

    <div class="task-date">

        <h4>
            Daily
        </h4>

        <span>

            <?php
            echo date(
                "g:i A",
                strtotime(
                    $routine['schedule_time']
                )
            );
            ?>

        </span>

    </div>

    <div class="task-zone">

        <?php
        echo htmlspecialchars(
            $routine['location']
        );
        ?>

    </div>

    <div class="task-worker">

        <?php
        echo htmlspecialchars(
            $routine['fullname']
        );
        ?>

    </div>

    <div class="task-status">

        <?php
        echo ucfirst(
            $routine['priority']
        );
        ?>

    </div>

</div>

<?php } ?>

</div>

    <!-- MODAL -->
    <div class="worker-modal"
    id="workerModal">

        <div class="worker-modal-content">

            <div class="modal-header">

                <h2>
                    Assign New Task
                </h2>

                <span onclick="closeWorkerModal()">
                    ✕
                </span>

            </div>

            <!-- FORM -->
            <form
    id="taskForm"
    class="assign-form"
    method="POST"
    action="../auth/process_schedule.php"
>

                <!-- WORKER -->
                <div class="form-group">

                    <label>
                        Worker
                    </label>

                    <select name="worker_id" required>

<?php

$workers = mysqli_query(
    $conn,
    "SELECT id, fullname
     FROM users
     WHERE role='worker'
     ORDER BY fullname"
);

while($worker = mysqli_fetch_assoc($workers)) {

?>

<option value="<?php echo $worker['id']; ?>">

    <?php echo htmlspecialchars($worker['fullname']); ?>

</option>

<?php } ?>

</select>

                </div>

                <!-- BIN -->
                <div class="form-group">

                    <label>
                        Bin Location
                    </label>

                    <input
    type="text"
    name="location"
    placeholder="Example: Zone A - Bin FT-04"
    required>


                </div>

<div class="form-group">

    <label>Task Title</label>

    <input
        type="text"
        name="task_title"
        placeholder="Example: Recycle Collection FT-04"
        required
    >

</div>


                <!-- DATE -->
                <div class="form-group">

                    <label>
                        Schedule Date
                    </label>

                    <input type="date"
       name="schedule_date"
       required>

                </div>

                <!-- START -->
                <div class="form-group">

                    <label>
                        Start Time
                    </label>

                    <input
    type="time"
    name="schedule_time"
    required
>

                </div>

<div class="form-group">

    <label>
        Priority
    </label>

    <select name="priority" required>

        <option value="low">
            Low
        </option>

        <option value="medium" selected>
            Medium
        </option>

        <option value="high">
            High
        </option>

    </select>

</div>



                <!-- STATUS -->
                <input
    type="hidden"
    name="status"
    value="pending"
>

                <!-- NOTES -->
                <div class="form-group full-width">

                    <label>
                        Notes
                    </label>

                    <textarea
    name="task_description"
    placeholder="Additional instructions..."
></textarea>

                </div>

                <!-- BUTTONS -->
                <div class="form-buttons">

                    <button type="button"
                    class="cancel-btn"
                    onclick="closeWorkerModal()">

                        Cancel

                    </button>

                    <button type="submit"
                    class="save-btn">

                        Save Task

                    </button>

                </div>

            </form>

        </div>

    </div>

    <!-- FLOATING ADD BUTTON -->
<button class="floating-add-btn"
onclick="openWorkerModal()">

    +

</button>

<button
class="floating-routine-btn"
onclick="openRoutineModal()">

R

</button>

<div
class="worker-modal"
id="routineModal">

<div class="worker-modal-content">

<div class="modal-header">

    <h2>Add Routine Task</h2>

    <span onclick="closeRoutineModal()">
        ✕
    </span>

</div>

<form
action="../auth/process_routine.php"
method="POST"
class="assign-form"
>

<div class="form-group">

    <label>Worker</label>

    <select
        name="worker_id"
        required
    >

        <?php

        $workerRoutine = mysqli_query(
            $conn,
            "SELECT id, fullname
            FROM users
            WHERE role='worker'
            ORDER BY fullname"
        );

        while($worker = mysqli_fetch_assoc($workerRoutine)) {

        ?>

        <option value="<?php echo $worker['id']; ?>">

            <?php echo htmlspecialchars($worker['fullname']); ?>

        </option>

        <?php } ?>

    </select>

</div>

<div class="form-group">

    <label>Location</label>

    <input
        type="text"
        name="location"
        placeholder="Example: FTMK Bin"
        required
    >

</div>

<div class="form-group">

    <label>Task Title</label>

    <input
        type="text"
        name="task_title"
        placeholder="Example: Collect Bin"
        required
    >

</div>

<div class="form-group">

    <label>Routine Time</label>

    <input
        type="time"
        name="schedule_time"
        required
    >

</div>

<div class="form-group">

    <label>Priority</label>

    <select name="priority">

        <option value="low">
            Low
        </option>

        <option value="medium" selected>
            Medium
        </option>

        <option value="high">
            High
        </option>

    </select>

</div>

<div class="form-group full-width">

    <label>Description</label>

    <textarea
        name="description"
        placeholder="Daily collection route..."
    ></textarea>

</div>

<div class="form-buttons">

    <button
        type="button"
        class="cancel-btn"
        onclick="closeRoutineModal()"
    >
        Cancel
    </button>

    <button
        type="submit"
        class="save-btn"
    >
        Save Routine
    </button>

</div>

</form>

</div>
</div>

    <!-- FOOTER -->
    <footer>

        <p>
            © GoGreen. All rights reserved.
        </p>

        <p>
            Contact us: Al-Khawarizmi UTeM, Melaka, Malaysia
        </p>

    </footer>


    <!-- script -->
    <script>

    function toggleMenu(){
        document
        .getElementById("sidebar")
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

    function openWorkerModal(){
        document
        .getElementById("workerModal")
        .style.display = "flex";
    }

    function closeWorkerModal(){
        document
        .getElementById("workerModal")
        .style.display = "none";
    }

    function openRoutineModal(){

    document
    .getElementById("routineModal")
    .style.display = "flex";

}

function closeRoutineModal(){

    document
    .getElementById("routineModal")
    .style.display = "none";

}

</script>

</body>
</html>