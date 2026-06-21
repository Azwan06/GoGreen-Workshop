<?php

session_start();
if (
    !isset($_SESSION['user_id']) ||
    $_SESSION['role'] != 'worker'
) {

    header("Location: ../Worker/dashboard.php");
    exit();
}
include "../config/database.php";

// if (
//  if   !isset($_SESSION['user_id']) ||
//     $_SESSION['role'] != 'admin'
// ) {

//     header("Location: ../Public/login.php");
//     exit();
// }

/* ================= TOTAL USERS ================= */

$totalUsersQuery = "

SELECT COUNT(*) AS total_users

FROM users

WHERE role='user'

";

$totalUsersResult =
mysqli_query($conn, $totalUsersQuery);

$totalUsers =
mysqli_fetch_assoc($totalUsersResult)['total_users'];

/* ================= TOTAL RECYCLED ================= */

$totalRecycleQuery = "

SELECT SUM(weight) AS total_weight

FROM recycle_submissions

WHERE status='approved'

";

$totalRecycleResult =
mysqli_query($conn, $totalRecycleQuery);

$totalRecycle =
mysqli_fetch_assoc($totalRecycleResult)['total_weight'];

if(!$totalRecycle){

    $totalRecycle = 0;

}

/* ================= PENDING REVIEW ================= */

$pendingQuery = "

SELECT COUNT(*) AS pending_total

FROM recycle_submissions

WHERE status='pending'

";

$pendingResult =
mysqli_query($conn, $pendingQuery);

$pendingTotal =
mysqli_fetch_assoc($pendingResult)['pending_total'];

/* ================= TOTAL REDEEMED ================= */

$redeemedQuery = "

SELECT SUM(total_points) AS total_points

FROM reward_redeems

WHERE status='approved'

";

$redeemedResult =
mysqli_query($conn, $redeemedQuery);

$totalRedeemed =
mysqli_fetch_assoc($redeemedResult)['total_points'];

if(!$totalRedeemed){

    $totalRedeemed = 0;

}

/* ================= TOP RECYCLERS ================= */

$leaderboardQuery = "

SELECT fullname, points

FROM users

WHERE role='user'

ORDER BY points DESC

LIMIT 3

";

$leaderboardResult =
mysqli_query($conn, $leaderboardQuery);

/* ================= RECENT SUBMISSIONS ================= */

$activityQuery = "

SELECT users.fullname,
recycle_submissions.waste_type,
recycle_submissions.created_at

FROM recycle_submissions

INNER JOIN users
ON recycle_submissions.user_id = users.id

ORDER BY recycle_submissions.created_at DESC

LIMIT 3

";

$activityResult =
mysqli_query($conn, $activityQuery);

?>

<!DOCTYPE html>
<html lang="ms">

<head>

    <meta charset="UTF-8">

    <meta name="viewport"
    content="width=device-width, initial-scale=1.0">

    <title>
        Dashboard | GoGreen
    </title>

    <!-- GOOGLE FONT -->

    <link rel="preconnect"
    href="https://fonts.googleapis.com">

    <link rel="preconnect"
    href="https://fonts.gstatic.com"
    crossorigin>

    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap"
    rel="stylesheet">

    <!-- FONT AWESOME -->

    <link rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"/>

    <!-- CHART JS -->

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <!-- CSS -->

    <link rel="stylesheet"
    href="assets/css/dashboard.css">

</head>

<body>

<!-- ================= HEADER ================= -->

<header>
            
    <div class="header-left">

        <div class="menu-toggle"
        onclick="toggleMenu()">

            ☰

        </div>

        <div class="logo">

            <img
            src="image/recycle_imag.png"
            alt="GoGreen Logo">

            GoGreen

        </div>

    </div>

    <div class="header-right">
        
        <div class="user-avatar-container">

            <div class="user-avatar"
            onclick="toggleProfileMenu()">

                <img
                src="image/avatar.png"
                alt="User Avatar">

            </div>

            <div class="profile-menu"
            id="profileMenu">

                <div class="profile-info">

                    <h4>

                        <?php
                        echo $_SESSION['fullname'];
                        ?>

                    </h4>

                    <p>

                        <?php
                        echo $_SESSION['email'];
                        ?>

                    </p>

                </div>

                <a href="profile.php">
                    Profile
                </a>

                <a href="notification.php">
                    Notification
                </a>

                <a href="setting.php">
                    Settings
                </a>

                <a href="../auth/logout.php">
                    Sign Out
                </a>

            </div>

        </div>

    </div>

</header>

<!-- ================= SIDEBAR ================= -->

<div class="sidebar" id="sidebar">

    <button class="close-btn"
    onclick="toggleMenu()">

        ✕

    </button>

    <h2 class="sidebar-logo">
        GoGreen
    </h2>

    <a href="dashboard.php">
        Dashboard
    </a>

    <a href="reqsub.php">
        Submissions
    </a>

    <a href="reqreward.php">
        Redemptions
    </a>

    <a href="addschedule.php">
        Schedule
    </a>

    <a href="addbin.php">
        Bin Map
    </a>

    <a href="pickups.php">
        Pickups
    </a>

    <a href="reports.php">
        Reports
    </a>

    <a href="addreward.php">
        Rewards
    </a>

    <a href="userrole.php">
        Users
    </a>

    <a href="media.php">
        Media
    </a>

</div>

<!-- ================= MAIN ================= -->

<div class="main">

    <!-- TOPBAR -->

    <div class="topbar">

        <div class="welcome">

            <h1>
                Welcome back, Admin! 🌱
            </h1>

            <p>
                Here's what's happening with GoGreen today.
            </p>

        </div>

    </div>

    <!-- ================= CARDS ================= -->

    <div class="cards">

        <!-- CARD 1 -->

        <div class="card">

            <div class="card-info">

                <p>
                    Total Users
                </p>

                <h2>

                    <?php
                    echo number_format($totalUsers);
                    ?>

                </h2>

                <span>
                    Registered users
                </span>

            </div>

            <div class="icon green">
                <i class="fa-solid fa-users"></i>
            </div>

        </div>

        <!-- CARD 2 -->

        <div class="card">

            <div class="card-info">

                <p>
                    Total Recycled
                </p>

                <h2>

                    <?php
                    echo number_format($totalRecycle,2);
                    ?>

                    kg

                </h2>

                <span>
                    Approved submissions
                </span>

            </div>

            <div class="icon green">
                <i class="fa-solid fa-recycle"></i>
            </div>

        </div>

        <!-- CARD 3 -->

        <div class="card">

            <div class="card-info">

                <p>
                    Pending Review
                </p>

                <h2>

                    <?php
                    echo $pendingTotal;
                    ?>

                </h2>

                <span>
                    Submissions
                </span>

            </div>

            <div class="icon orange">
                <i class="fa-solid fa-file-circle-check"></i>
            </div>

        </div>

        <!-- CARD 4 -->

        <div class="card">

            <div class="card-info">

                <p>
                    Points Redeemed
                </p>

                <h2>

                    <?php
                    echo number_format($totalRedeemed);
                    ?>

                    pts

                </h2>

                <span>
                    Approved redemptions
                </span>

            </div>

            <div class="icon green">
                <i class="fa-solid fa-gift"></i>
            </div>

        </div>

    </div>

    <!-- ================= GRID ================= -->

    <div class="grid">

        <!-- CHART -->

        <div class="box">

            <div class="box-header">

                <h3>
                    Recycling Activity
                </h3>

            </div>

            <div class="chart-container">

                <canvas id="recycleChart"></canvas>

            </div>

        </div>

        <!-- RECENT ACTIVITIES -->

        <div class="box">

            <div class="box-header">

                <h3>
                    Recent Activities
                </h3>

            </div>

            <?php
            while(
                $activity =
                mysqli_fetch_assoc($activityResult)
            ){
            ?>

            <div class="activity">

                <div class="activity-left">

                    <div class="activity-icon">

                        <i class="fa-solid fa-upload"></i>

                    </div>

                    <div>

                        <h4>

                            <?php
                            echo $activity['fullname'];
                            ?>

                            submitted

                            <?php
                            echo $activity['waste_type'];
                            ?>

                        </h4>

                        <span>

                            <?php
                            echo $activity['created_at'];
                            ?>

                        </span>

                    </div>

                </div>

            </div>

            <?php
            }
            ?>

        </div>

    </div>

    <!-- ================= SECOND GRID ================= -->

    <div class="grid">

        <!-- BIN STATUS -->

        <div class="box">

            <div class="box-header">

                <h3>
                    Bin Status
                </h3>

            </div>

            <div class="bin">

                <div class="bin-top">

                    <span>
                        Bin A-01
                    </span>

                    <span>
                        80%
                    </span>

                </div>

                <div class="progress">

                    <div class="green-bar"
                    style="width:80%"></div>

                </div>

            </div>

            <div class="bin">

                <div class="bin-top">

                    <span>
                        Bin A-02
                    </span>

                    <span>
                        45%
                    </span>

                </div>

                <div class="progress">

                    <div class="yellow-bar"
                    style="width:45%"></div>

                </div>

            </div>

            <div class="bin">

                <div class="bin-top">

                    <span>
                        Bin A-03
                    </span>

                    <span>
                        100%
                    </span>

                </div>

                <div class="progress">

                    <div class="red-bar"
                    style="width:100%"></div>

                </div>

            </div>

        </div>

        <!-- TOP RECYCLERS -->

        <div class="box">

            <div class="box-header">

                <h3>
                    Top Recyclers
                </h3>

            </div>

            <?php
            while(
                $leader =
                mysqli_fetch_assoc($leaderboardResult)
            ){
            ?>

            <div class="leader">

                <div class="leader-left">

                    <div class="avatar">

                        <?php

                        echo strtoupper(
                            substr(
                                $leader['fullname'],
                                0,
                                1
                            )
                        );

                        ?>

                    </div>

                    <div>

                        <h4>

                            <?php
                            echo $leader['fullname'];
                            ?>

                        </h4>

                    </div>

                </div>

                <div class="points">

                    <?php
                    echo $leader['points'];
                    ?>

                    pts

                </div>

            </div>

            <?php
            }
            ?>

        </div>

    </div>

</div>

<!-- ================= FOOTER ================= -->

<footer>

    <p class="left-footer">

        © GoGreen. All rights reserved.

    </p>

    <p class="right-footer">

        Contact us:
        Al-Khawarizmi UTeM,
        Melaka, Malaysia

    </p>

</footer>

<!-- ================= SCRIPT ================= -->

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

    document.addEventListener(

        "click",

        function(event){

            const container =
            document.querySelector(
                ".user-avatar-container"
            );

            const menu =
            document.getElementById(
                "profileMenu"
            );

            if(
                !container.contains(event.target)
            ){

                menu.classList.remove("show");

            }

        }

    );

    // CHART

    const ctx =
    document.getElementById('recycleChart');

    new Chart(ctx, {

        type: 'bar',

        data: {

            labels: [
                'Mon',
                'Tue',
                'Wed',
                'Thu',
                'Fri',
                'Sat',
                'Sun'
            ],

            datasets: [

                {
                    label: 'Plastic',
                    data: [200,400,650,420,700,520,300],
                    backgroundColor: '#2f9e63',
                    borderRadius: 8,
                    borderSkipped:false,
                    barThickness:28
                },

                {
                    label: 'Paper',
                    data: [120,250,300,240,350,280,180],
                    backgroundColor: '#3b82f6',
                    borderRadius: 8,
                    borderSkipped:false,
                    barThickness:28
                },

                {
                    label: 'Glass',
                    data: [80,150,220,170,260,180,120],
                    backgroundColor: '#14b8a6',
                    borderRadius: 8,
                    borderSkipped:false,
                    barThickness:28
                },

                {
                    label: 'Aluminum',
                    data: [50,100,140,110,190,130,90],
                    backgroundColor: '#f59e0b',
                    borderRadius: 8,
                    borderSkipped:false,
                    barThickness:28
                }

            ]
        },

        options: {

            responsive:true,
            maintainAspectRatio:false

        }

    });

</script>

</body>
</html>