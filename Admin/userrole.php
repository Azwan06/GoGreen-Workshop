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

$search = "";

if(isset($_GET['search'])){
    $search = mysqli_real_escape_string($conn,$_GET['search']);
}

$userQuery = "
SELECT *
FROM users
WHERE fullname LIKE '%$search%'
OR email LIKE '%$search%'
ORDER BY id DESC
";

$userResult = mysqli_query($conn,$userQuery);

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

    <link rel="stylesheet" href="assets/css/userrole.css">
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
                    <a href="setting.php">Settings</a>
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

    <section class="page-title">
        <h1>User Management</h1>
        <p>View and manage platform members</p>
    </section>

    <div class="search-container">

        <form method="GET" class="search-form">

    <input
        type="text"
        name="search"
        class="search-input"
        placeholder="🔍 Search user by name or email..."
        value="<?php echo htmlspecialchars($search); ?>"
    >

    <button type="submit" class="search-btn">
        Search
    </button>

</form>

        <div id="searchResult">

<?php if(mysqli_num_rows($userResult) == 0) { ?>

<p class="no-user">
    No user found.
</p>

<?php } ?>

<?php while($user = mysqli_fetch_assoc($userResult)) { ?>

<div class="user-card">

    <div class="user-left">

        <div class="user-initials">
            <?php echo strtoupper(substr($user['fullname'],0,1)); ?>
        </div>

        <div>
            <h3><?php echo htmlspecialchars($user['fullname']); ?></h3>
            <p><?php echo htmlspecialchars($user['email']); ?></p>
        </div>

    </div>

    <div class="user-right">

        <form action="../auth/update_role.php" method="POST">

            <input
                type="hidden"
                name="user_id"
                value="<?php echo $user['id']; ?>"
            >

            <select
                name="role"
                class="role-select"
                onchange="this.form.submit()"
            >

                <option value="user"
                <?php if($user['role']=='user') echo 'selected'; ?>>
                    User
                </option>

                <option value="worker"
                <?php if($user['role']=='worker') echo 'selected'; ?>>
                    Worker
                </option>

                <option value="admin"
                <?php if($user['role']=='admin') echo 'selected'; ?>>
                    Admin
                </option>

            </select>

        </form>

        <form action="../auth/update_status.php" method="POST">

            <input
                type="hidden"
                name="user_id"
                value="<?php echo $user['id']; ?>"
            >

            <?php if($user['status']=='banned') { ?>

                <input type="hidden"
                       name="status"
                       value="active">

                <button
                    type="submit"
                    class="status status-inactive">
                    Unban
                </button>

            <?php } else { ?>

                <input type="hidden"
                       name="status"
                       value="banned">

                <button
                    type="submit"
                    class="status status-active">
                    Ban
                </button>

            <?php } ?>

        </form>

    </div>

</div>

<?php } ?>

</div>
    </div>
    
    <footer>
        <p class="left-footer">
            © GoGreen. All rights reserved.
        </p>

        <p class="right-footer">
            Contact us: Al-Khawarizmi UTeM, Melaka, Malaysia
        </p>
    </footer>

    <script>
        
        // sidebar
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
        
        
    </script>

</body>
</html>