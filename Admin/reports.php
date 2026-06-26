<?php

session_start();
include "../config/database.php";


$host = "localhost:3306";
$user = "root";
$pass = "";
$dbname = "gogreen";

$conn = mysqli_connect($host, $user, $pass, $dbname);
$sql = "SELECT * FROM reports ORDER BY id DESC";
$result = mysqli_query($conn, $sql);

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

    <link rel="stylesheet" href="assets/css/report.css">
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
                        <h4>
    <?php echo $_SESSION['fullname']; ?>
</h4>

<p>
    <?php echo $_SESSION['email']; ?>
</p>
                    </div>

                    <a href="profile.php">Profile</a>
                    <a href="../Public/login.php">Sign Out</a>

                </div>

            </div>

        </div>

    </header>


    <!-- SIDEBAR -->
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

        <h1>Reports & Issues</h1>

        <p>
            User-submitted reports across bins and zones.
        </p>

    </section>


    <!-- STATS -->
    


    <!-- SEARCH + FILTER -->
    <div class="report-controls">

        <input 
            id="searchInput" 
            placeholder="Search report..." 
            onkeyup="searchReport()"
        >

        <div class="filters">

            <button class="active" onclick="filter('All')">
                All
            </button>

            <button onclick="filter('Pending')">
                Pending
            </button>

            <button onclick="filter('Assigned')">
                Assigned
            </button>

            <button onclick="filter('Completed')">
                Completed
            </button>

            

        </div>

    </div>

    <?php while($row = mysqli_fetch_assoc($result)) { ?>

<div class="report" data-status="<?= $row['status']; ?>">

    <div class="report-left">

        <div class="warning-icon">
            ⚠
        </div>

        <div class="report-details">

            <h3>
                <?= $row['subject']; ?>
            </h3>

            <p>
                <?= $row['name']; ?>
                ·
                <?= $row['report_type']; ?>
                ·
                <?= $row['location']; ?>
            </p>

        </div>

    </div>

    <div class="report-right">

        <span class="status">
            <?= $row['status']; ?>
        </span>


<?php if($row['status'] == 'Pending'){ ?>

<button
class="assign-btn"
data-id="<?= $row['id']; ?>"
onclick="openPopup(this)">
Assign
</button>

<?php } else { ?>

<button
class="assign-btn"
disabled
style="opacity:.5;cursor:not-allowed;">
Assigned
</button>

<?php } ?>

    </div>

</div>

<?php } ?>


    <!-- ASSIGN POPUP -->
    <div class="assign-popup" id="assignPopup">

        <div class="popup-box">

            <h2>Select Worker</h2>

            <p>
                Choose worker for this report
            </p>

<form action="../auth/assign_worker.php" method="POST">

<input
type="hidden"
id="report_id"
name="report_id">

<select name="worker_id" required>

<?php

$workers = mysqli_query(
$conn,
"SELECT * FROM users WHERE role='worker'"
);

while($worker=mysqli_fetch_assoc($workers))
{
?>

<option value="<?= $worker['id']; ?>">

<?= $worker['fullname']; ?>

</option>

<?php
}
?>

</select>

<br><br>

<button type="submit" class="assign-btn">
Assign Worker
</button>

</form>

            </div>

            <button class="close-popup" onclick="closePopup()">
                Close
            </button>

        </div>

    </div>


    <!-- FOOTER -->
    <footer>

        <p class="left-footer">
            © GoGreen. All rights reserved.
        </p>

        <p class="right-footer">
            Contact us: Al-Khawarizmi UTeM, Melaka, Malaysia
        </p>

    </footer>


    <script>

        // SIDEBAR
        function toggleMenu(){

            document
            .getElementById("sidebar")
            .classList.toggle("active");
        }


        // PROFILE MENU
        function toggleProfileMenu(){

            document
            .getElementById("profileMenu")
            .classList.toggle("show");
        }


        document.addEventListener("click", function(event){

            const container = document.querySelector(".user-avatar-container");

            const menu = document.getElementById("profileMenu");

            if(!container.contains(event.target)){

                menu.classList.remove("show");
            }
        });


        // FILTER
        function filter(status){

            let items = document.querySelectorAll(".report");

            let buttons = document.querySelectorAll(".filters button");

            buttons.forEach(b => b.classList.remove("active"));

            event.target.classList.add("active");

            items.forEach(item=>{

                if(status === "All" || item.dataset.status === status){

                    item.style.display = "flex";

                }else{

                    item.style.display = "none";
                }
            });
        }


        // SEARCH
        function searchReport(){

            let input = document
            .getElementById("searchInput")
            .value
            .toLowerCase();

            let items = document.querySelectorAll(".report");

            items.forEach(item => {

                let text = item.innerText.toLowerCase();

                if(text.includes(input)){

                    item.style.display = "flex";

                }else{

                    item.style.display = "none";
                }
            });
        }


        // ASSIGN POPUP
        let currentReport = null;


        function openPopup(btn)
{
    document.getElementById("report_id").value =
        btn.dataset.id;

    document.getElementById("assignPopup")
        .style.display = "flex";
}

        function closePopup(){

            document
            .getElementById("assignPopup")
            .style.display = "none";
        }


    </script>

</body>
</html>