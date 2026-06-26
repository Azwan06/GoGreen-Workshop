<<<<<<< HEAD
=======
//redeem

>>>>>>> hazeeq
<?php

session_start();

include "../config/database.php";

if (!isset($_SESSION['user_id'])) {

    header("Location: ../Public/login.php");
    exit();
}

$user_id = $_SESSION['user_id'];

// GET USER DATA

$userQuery =
"SELECT * FROM users WHERE id='$user_id'";

$userResult =
mysqli_query($conn, $userQuery);

$user =
mysqli_fetch_assoc($userResult);

$userPoints = $user['points'];

// GET REWARDS

$rewardQuery =
"SELECT * FROM rewards";

$rewardResult =
mysqli_query($conn, $rewardQuery);

?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta name="viewport"
    content="width=device-width, initial-scale=1.0">

    <title>
        Redeem Rewards
    </title>

    <link rel="preconnect"
    href="https://fonts.googleapis.com">

    <link rel="preconnect"
    href="https://fonts.gstatic.com"
    crossorigin>

    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap"
    rel="stylesheet">

    <link rel="stylesheet"
    href="assets/css/redeem.css">

</head>

<body>

<!-- HEADER -->

<header>

    <div class="logo">

        <img
        src="image/recycle_imag.png"
        alt="GoGreen Logo">

        GoGreen

    </div>

    <div class="header-right">

        <nav id="navMenu">

            <a href="home.php">
                Home
            </a>

            <a href="map.php">
                Map
            </a>

            <a href="media.php">
                Media
            </a>

            <a href="recycle.php">
                Recycle
            </a>

            <a href="redeem.php">
                Redeem
            </a>

            <a href="contact.php">
                Contact
            </a>

        </nav>

        <!-- PROFILE -->

        <div class="user-avatar-container">

            <div class="user-avatar"
            onclick="toggleProfileMenu()">

                <img
src="<?php echo !empty($user['profile_image'])
    ? '../uploads/profile/'.$user['profile_image']
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

                <a href="leaderboard.php">
                    Leaderboard
                </a>

<<<<<<< HEAD
                <a href="setting.php">
                    Settings
                </a>

=======
>>>>>>> hazeeq
                <a href="../auth/logout.php">
                    Sign Out
                </a>

            </div>

        </div>

    </div>

</header>

<!-- MAIN -->

<main class="redeem-page">

    <!-- WALLET -->

    <section class="wallet-section">

        <div class="wallet-card">

            <p class="wallet-title">
                POINTS WALLET
            </p>

            <h1 class="wallet-points">

                <?php
                echo $userPoints;
                ?>

                <span>
                    pts
                </span>

            </h1>

        </div>

    </section>

    <!-- TABS -->

    <div class="tabs">

        <button
        class="tab-btn active"
        onclick="showCatalog()">

            Catalog

        </button>

        <button
        class="tab-btn"
        onclick="showHistory()">

            History

        </button>

    </div>

    <!-- REWARD GRID -->

    <section
    class="reward-grid"
    id="catalogSection">

        <?php
        while($reward =
        mysqli_fetch_assoc($rewardResult)){
        ?>

        <div class="reward-card">

            <!-- IMAGE -->

            <div class="reward-image">

                
                <img src="../uploads/rewards/<?php echo $reward['image']; ?>" alt="">

            </div>

            <!-- CONTENT -->

            <div class="reward-content">

                <div class="reward-header">

                    <h2>

                        <?php
                        echo $reward['reward_name'];
                        ?>

                    </h2>

                    <span class="reward-badge">

                        <?php
                        echo $reward['points_required'];
                        ?>

                        pts

                    </span>

                </div>

                <p class="reward-description">

                    <?php
                    echo $reward['description'];
                    ?>

                </p>

                <!-- REDEEM FORM -->

                <form
                action="../auth/redeem_process.php"
                method="POST">

                    <input
                    type="hidden"
                    name="reward_id"
                    value="<?php echo $reward['id']; ?>">

                    <button
                    type="submit"
                    class="redeem-btn">

                        Redeem

                    </button>

                </form>

            </div>

        </div>

        <?php
        }
        ?>

    </section>

    <!-- HISTORY -->

    <section
    class="history-section"
    id="historySection"
    style="display:none;">

        <h2 class="history-title">

            Redeem History

        </h2>

        <?php

        $historyQuery = "

        SELECT
        reward_redeems.*,
        rewards.reward_name

        FROM reward_redeems

        JOIN rewards
        ON reward_redeems.reward_id = rewards.id

        WHERE reward_redeems.user_id='$user_id'

        ORDER BY reward_redeems.id DESC

        ";

        $historyResult =
        mysqli_query($conn, $historyQuery);

        if(mysqli_num_rows($historyResult) > 0){

            while($history =
            mysqli_fetch_assoc($historyResult)){

        ?>

        <div class="history-card">

            <div>

                <h3>

                    <?php
                    echo $history['reward_name'];
                    ?>

                </h3>

                <p>

                    Points:
                    <?php
                    echo $history['total_points'];
                    ?>

                </p>

            </div>

            <span class="history-status">

                <?php
                echo ucfirst($history['status']);
                ?>

            </span>

        </div>

        <?php

            }

        } else {

            echo "

            <p class='no-history'>

                No redeem history yet.

            </p>

            ";

        }

        ?>

    </section>

</main>

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

<script>

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

    // SHOW CATALOG

    function showCatalog(){

        document
        .getElementById("catalogSection")
        .style.display = "grid";

        document
        .getElementById("historySection")
        .style.display = "none";

    }

    // SHOW HISTORY

    function showHistory(){

        document
        .getElementById("catalogSection")
        .style.display = "none";

        document
        .getElementById("historySection")
        .style.display = "block";

    }

</script>

</body>
</html>

