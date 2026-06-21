<?php

session_start();

include "../config/database.php";

// if (
//     !isset($_SESSION['user_id']) ||
//     $_SESSION['role'] != 'admin'
// ) {

//     header("Location: ../Public/login.php");
//     exit();
// }

// GET SUBMISSIONS

$query = "

SELECT
recycle_submissions.*,
users.fullname

FROM recycle_submissions

INNER JOIN users
ON recycle_submissions.user_id = users.id

ORDER BY recycle_submissions.id DESC

";

$result = mysqli_query($conn, $query);

// COUNT STATUS

$pendingCountQuery = "

SELECT COUNT(*) AS total
FROM recycle_submissions
WHERE status='pending'

";

$pendingCountResult =
mysqli_query($conn, $pendingCountQuery);

$pendingCount =
mysqli_fetch_assoc($pendingCountResult)['total'];

$approvedCountQuery = "

SELECT COUNT(*) AS total
FROM recycle_submissions
WHERE status='approved'

";

$approvedCountResult =
mysqli_query($conn, $approvedCountQuery);

$approvedCount =
mysqli_fetch_assoc($approvedCountResult)['total'];

$rejectedCountQuery = "

SELECT COUNT(*) AS total
FROM recycle_submissions
WHERE status='rejected'

";

$rejectedCountResult =
mysqli_query($conn, $rejectedCountQuery);

$rejectedCount =
mysqli_fetch_assoc($rejectedCountResult)['total'];

?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta name="viewport"
    content="width=device-width, initial-scale=1.0">

    <title>
        GoGreen
    </title>
    
    <link rel="preconnect"
    href="https://fonts.googleapis.com">

    <link rel="preconnect"
    href="https://fonts.gstatic.com"
    crossorigin>

    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap"
    rel="stylesheet">

    <link rel="stylesheet"
    href="assets/css/reqsub.css">

</head>

<body>
    
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

<!-- SIDEBAR -->

<div class="sidebar"
id="sidebar">

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

<!-- BODY -->

<section class="page-title">

    <h1>
        Recycle Submissions
    </h1>

    <p>
        Preview user uploads and approve to credit points.
    </p>

</section>

<div class="container">

    <!-- TABS -->

    <div class="tabs">

        <button
        class="tab active"
        onclick="filterTab('pending', this)">

            Pending
            (<?php echo $pendingCount; ?>)

        </button>

        <button
        class="tab"
        onclick="filterTab('approved', this)">

            Approved
            (<?php echo $approvedCount; ?>)

        </button>

        <button
        class="tab"
        onclick="filterTab('rejected', this)">

            Rejected
            (<?php echo $rejectedCount; ?>)

        </button>

        <button
        class="tab"
        onclick="filterTab('all', this)">

            All

        </button>

    </div>

    <!-- SUBMISSIONS -->

    <?php
    while($row = mysqli_fetch_assoc($result)){
    ?>

    <div
    class="submission-card"
    data-status="<?php echo $row['status']; ?>">

        <div class="submission-left">

            <div class="submission-icon">

                <img
                src="../uploads/<?php echo $row['image']; ?>">

            </div>

            <div class="submission-details">

                <div class="submission-meta">

                    <span>

                        #<?php echo $row['id']; ?>

                    </span>

                    <span>-</span>

                    <span>

                        <?php
                        echo $row['created_at'];
                        ?>

                    </span>

                </div>

                <h3>

                    <?php
                    echo ucfirst($row['waste_type']);
                    ?>

                </h3>

                <p>

                    <?php
                    echo $row['weight'];
                    ?>

                    kg /

                    <?php
                    echo $row['points_earned'];
                    ?>

                    pts

                </p>

            </div>

        </div>

        <div class="submission-right">

            <div class="submission-user">

                <div class="user-avatar">

                    <?php

                    echo strtoupper(
                        substr(
                            $row['fullname'],
                            0,
                            1
                        )
                    );

                    ?>

                </div>

                <span class="user-name">

                    <?php
                    echo $row['fullname'];
                    ?>

                </span>

                <span
                class="status <?php echo $row['status']; ?>">

                    <?php
                    echo ucfirst($row['status']);
                    ?>

                </span>

            </div>

            <div class="submission-actions">

                <button
                class="btn preview-btn"
                onclick="openModal('../uploads/<?php echo $row['image']; ?>')">

                    Preview

                </button>

                <?php
                if($row['status'] == 'pending'){
                ?>

                <a
                href="../auth/approve_submission.php?id=<?php echo $row['id']; ?>"
                class="btn approve-btn">

                    Approve

                </a>

                <a
                href="../auth/reject_submission.php?id=<?php echo $row['id']; ?>"
                class="btn review-btn">

                    Reject

                </a>

                <?php
                }
                ?>

            </div>

        </div>

    </div>

    <?php
    }
    ?>

</div>

<!-- FOOTER -->

<footer>

    <p class="left-footer">
        © GoGreen. All rights reserved.
    </p>

    <p class="right-footer">
        Contact us: Al-Khawarizmi UTeM,
        Melaka, Malaysia
    </p>

</footer>

<!-- MODAL -->

<div
id="imageModal"
class="modal"
style="display:none;">

    <div class="modal-content">

        <span
        class="close"
        onclick="closeModal()">

            ✕

        </span>

        <img
        id="modalImg"
        src=""
        alt="Preview Image">

    </div>

</div>

<!-- SCRIPT -->

<script>

    // SIDEBAR

    function toggleMenu(){

        document
        .getElementById("sidebar")
        .classList.toggle("active");

    }

    // PROFILE

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
                container &&
                !container.contains(event.target)
            ){

                menu.classList.remove("show");

            }

        }

    );

    // IMAGE MODAL

    function openModal(imgSrc){

        document
        .getElementById("modalImg")
        .src = imgSrc;

        document
        .getElementById("imageModal")
        .style.display = "flex";

    }

    function closeModal(){

        document
        .getElementById("imageModal")
        .style.display = "none";

    }

    // FILTER TAB

    function filterTab(status, btn){

        const cards =
        document.querySelectorAll(
            ".submission-card"
        );

        const tabs =
        document.querySelectorAll(
            ".tab"
        );

        tabs.forEach(
            t => t.classList.remove("active")
        );

        btn.classList.add("active");

        cards.forEach(card => {

            const cardStatus =
            card.getAttribute("data-status");

            if(status === "all"){

                card.style.display = "flex";

            } else {

                card.style.display =
                (cardStatus === status)
                ? "flex"
                : "none";

            }

        });

    }

</script>

</body>
</html>

