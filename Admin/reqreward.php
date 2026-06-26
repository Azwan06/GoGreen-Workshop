<?php

session_start();

include "../config/database.php";

$host = "localhost:3306";
$user = "root";
$pass = "";
$dbname = "gogreen";

$conn = mysqli_connect($host, $user, $pass, $dbname);

// if (
//     !isset($_SESSION['user_id']) ||
//     $_SESSION['role'] != 'admin'
// ) {

//     header("Location: ../Public/login.php");
//     exit();
// }

// GET REDEMPTIONS

$query = "

SELECT
reward_redeems.*,
users.fullname,
rewards.reward_name,
rewards.image

FROM reward_redeems

INNER JOIN users
ON reward_redeems.user_id = users.id

INNER JOIN rewards
ON reward_redeems.reward_id = rewards.id

ORDER BY reward_redeems.id DESC

";

$result =
mysqli_query($conn, $query);

// COUNTS

$pendingCount = mysqli_fetch_assoc(

    mysqli_query(
        $conn,
        "SELECT COUNT(*) AS total
        FROM reward_redeems
        WHERE status='pending'"
    )

)['total'];

$approvedCount = mysqli_fetch_assoc(

    mysqli_query(
        $conn,
        "SELECT COUNT(*) AS total
        FROM reward_redeems
        WHERE status='approved'"
    )

)['total'];

$rejectedCount = mysqli_fetch_assoc(

    mysqli_query(
        $conn,
        "SELECT COUNT(*) AS total
        FROM reward_redeems
        WHERE status='rejected'"
    )

)['total'];

?>

<!DOCTYPE html>
<html lang="en">

<head>

<meta charset="UTF-8">

<meta name="viewport"
content="width=device-width, initial-scale=1.0">

<title>
Request Rewards
</title>

<link rel="preconnect"
href="https://fonts.googleapis.com">

<link rel="preconnect"
href="https://fonts.gstatic.com"
crossorigin>

<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap"
rel="stylesheet">

<link rel="stylesheet"
href="assets/css/reqreward.css">

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
src="<?php echo !empty($_SESSION['profile_image'])
? '../uploads/profile/'.$_SESSION['profile_image']
: '../uploads/profile/default.jpg'; ?>"
alt="Profile">

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

            <a href="../auth/logout.php">
                Sign Out
            </a>

        </div>

    </div>

</div>

</header>

<!-- SIDEBAR -->

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

<!-- PAGE TITLE -->

<section class="page-title">

<h1>
Request Rewards
</h1>

<p>
Review and approve user reward redemption requests
</p>

</section>

<!-- CONTAINER -->

<div class="container">

<div class="tabs">

<button
class="tab active"
onclick="filterTab('pending',this)">

Pending
(<?php echo $pendingCount; ?>)

</button>

<button
class="tab"
onclick="filterTab('approved',this)">

Approved
(<?php echo $approvedCount; ?>)

</button>

<button
class="tab"
onclick="filterTab('rejected',this)">

Rejected
(<?php echo $rejectedCount; ?>)

</button>

</div>

<!-- LOOP -->

<?php
while($row = mysqli_fetch_assoc($result)){
?>

<div
class="submission-card"
data-status="<?php echo $row['status']; ?>">

<div class="submission-left">

<div class="submission-icon">

<img
src="../uploads/rewards/<?php echo $row['image']; ?>"
alt="">

</div>

<div class="submission-details">

<div class="submission-meta">

<span>

R-<?php echo $row['id']; ?>

</span>

<span>-</span>

<span>

<?php
echo $row['redeem_date'];
?>

</span>

</div>

<h3>

<?php
echo $row['reward_name'];
?>

</h3>

<p>

<?php
echo $row['total_points']; ?>

points redeemed

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
href="../auth/approve_reward.php?id=<?php echo $row['id']; ?>"
class="btn approve-btn">

Approve

</a>

<a
href="../auth/reject_reward.php?id=<?php echo $row['id']; ?>"
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

Contact us:
Al-Khawarizmi UTeM,
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

<script>

function toggleMenu(){

document
.getElementById("sidebar")
.classList.toggle("active");

}

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

card.style.display =
(cardStatus === status)
? "flex"
: "none";

});

}

</script>

</body>
</html>

