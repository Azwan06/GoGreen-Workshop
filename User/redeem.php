<?php

session_start();

if (!isset($_SESSION['user_id'])) {

    header("Location: ../Public/login.php");
    exit();
}

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

    <link rel="stylesheet" href="assets/css/redeem.css">
</head>

<body>

<!-- HEADER -->
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
      
        <nav id="navMenu">

            <a href="home.php">Home</a>
            <a href="map.php">Map</a>
            <a href="media.php">Media</a>
            <a href="recycle.php">Recycle</a>
            <a href="redeem.php">Redeem</a>
            <a href="contact.php">Contact</a>

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

                <a href="profile.html">Profile</a>
                <a href="leaderboard.html">Leaderboard</a>
                <a href="notification.html">Notification</a>
                <a href="setting.html">Settings</a>
                <a href="../Public/login.html">Sign Out</a>
                
            </div>

        </div>

    </div>

</header>
<!-- DASHBOARD -->
<section class="reward-dashboard">

    <!-- TOP -->
    <div class="reward-top">

        <!-- WALLET -->
        <div class="wallet-card">

            <p class="wallet-title">
                POINTS WALLET
            </p>

            <h1 id="pointDisplay">
                2840 <span>pts</span>
            </h1>

            <div class="wallet-stats">

                <div class="wallet-box">
                    <h3>18.4</h3>
                    <p>kg/mo</p>
                </div>

                <div class="wallet-box">
                    <h3>42.1</h3>
                    <p>kg CO₂</p>
                </div>

                <div class="wallet-box">
                    <h3>12</h3>
                    <p>day streak</p>
                </div>

            </div>

        </div>

        <!-- TUAH -->
        <div class="tuah-card">

            <h3>
                ✨ Tuah Indeks
            </h3>

            <h1 id="tiDisplay">
                712
            </h1>

            <div class="progress-bar">
                <div class="progress-fill"></div>
            </div>

            <p>
                Conversion: 1 indeks = 5 points
            </p>

            <div class="convert-box">

                <input
                type="number"
                id="redeemInput"
                placeholder="100">

                <button onclick="convertPoints()">
                    Convert →
                </button>

            </div>

        </div>

    </div>
<!-- TABS -->
<div class="tabs">

    <button class="tab-btn active"
    onclick="showCatalog()">

        Catalog

    </button>

    <button class="tab-btn"
    onclick="showHistory()">

        History

    </button>

</div>

<!-- REWARD GRID -->
<div class="reward-grid" id="catalogSection">

    <!-- CARD 1 -->
    <div class="reward-card">

        <div class="reward-image">
            👜
        </div>

        <div class="reward-content">

            <div class="reward-header">

                <h3>
                    GoGreen Tote Bag
                </h3>

                <span>
                    500 pts
                </span>

            </div>

            <p>
                Merchandise · 24 left
            </p>

            <button onclick="redeemReward('GoGreen Tote Bag', 500)">
                Redeem
            </button>

        </div>

    </div>

    <!-- CARD 2 -->
    <div class="reward-card">

        <div class="reward-image">
            🧴
        </div>

        <div class="reward-content">

            <div class="reward-header">

                <h3>
                    Reusable Water Bottle
                </h3>

                <span>
                    800 pts
                </span>

            </div>

            <p>
                Lifestyle · 12 left
            </p>

            <button onclick="redeemReward('Reusable Water Bottle', 800)">
                Redeem
            </button>

        </div>

    </div>

    <!-- CARD 3 -->
    <div class="reward-card">

        <div class="reward-image">
            🎟️
        </div>

        <div class="reward-content">

            <div class="reward-header">

                <h3>
                    UTeM Cafeteria Voucher
                </h3>

                <span>
                    1000 pts
                </span>

            </div>

            <p>
                Voucher · 50 left
            </p>

            <button onclick="redeemReward('UTeM Cafeteria Voucher', 1000)">
                Redeem
            </button>

        </div>

    </div>

</div>

<!-- HISTORY -->
<div class="history" id="historySection">

    <h3>
        Redemption History
    </h3>

    <div id="history-list"></div>

</div>
</section>


<!-- FOOTER -->
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

    // MOBILE MENU

    function toggleMenu(){

        document
        .getElementById("navMenu")
        .classList.toggle("active");

    }

    // PROFILE MENU

    function toggleProfileMenu(){

        document
        .getElementById("profileMenu")
        .classList.toggle("show");

    }

    document.addEventListener("click",function(event){

        const container =
        document.querySelector(".user-avatar-container");

        const menu =
        document.getElementById("profileMenu");

        if(!container.contains(event.target)){

            menu.classList.remove("show");

        }

    });

    // POINT SYSTEM

    let totalPoints = 2840;

    let tuahIndeks = 712;

    // UPDATE DISPLAY

    function updateDisplay(){

        document
        .getElementById("pointDisplay")
        .innerHTML =
        `${totalPoints} <span>pts</span>`;

        document
        .getElementById("tiDisplay")
        .innerHTML =
        tuahIndeks;

    }

    // CONVERT POINTS

    function convertPoints(){

        let input =
        document.getElementById("redeemInput");

        let value =
        parseInt(input.value);

        if(isNaN(value) || value <= 0){

            alert("Enter valid points");
            return;

        }

        if(totalPoints < value){

            alert("Not enough points!");
            return;

        }

        let tiEarned =
        Math.floor(value / 5);

        totalPoints -= value;

        tuahIndeks += tiEarned;

        alert(
            `${value} points converted into ${tiEarned} Tuah Indeks`
        );

        updateDisplay();

        addHistory(
            "Points Conversion",
            value
        );

        input.value = "";

    }

    // REDEEM REWARD

    function redeemReward(itemName, cost){

        if(totalPoints < cost){

            alert("Not enough points!");
            return;

        }

        let confirmRedeem =
        confirm(
            `Redeem ${itemName} for ${cost} points?`
        );

        if(confirmRedeem){

            totalPoints -= cost;

            alert(
                `${itemName} redeemed successfully!`
            );

            updateDisplay();

            addHistory(
                itemName,
                cost
            );

        }

    }

    // HISTORY

    function addHistory(name, cost){

        const history =
        document.getElementById("history-list");

        const item =
        document.createElement("div");

        item.classList.add("history-item");

        let today =
        new Date();

        let date =
        today.getDate() + "/" +
        (today.getMonth()+1) + "/" +
        today.getFullYear();

        item.innerHTML = `

            <strong>
                ${name}
            </strong>

            <br>

            <small>
                ${cost} pts • ${date}
            </small>

        `;

        history.prepend(item);

    }

    // INITIAL

    updateDisplay();


// TAB FUNCTIONS

function showCatalog(){

    document
    .getElementById("catalogSection")
    .style.display = "grid";

    document
    .getElementById("historySection")
    .style.display = "none";

    document
    .querySelectorAll(".tab-btn")[0]
    .classList.add("active");

    document
    .querySelectorAll(".tab-btn")[1]
    .classList.remove("active");

}

function showHistory(){

    document
    .getElementById("catalogSection")
    .style.display = "none";

    document
    .getElementById("historySection")
    .style.display = "block";

    document
    .querySelectorAll(".tab-btn")[1]
    .classList.add("active");

    document
    .querySelectorAll(".tab-btn")[0]
    .classList.remove("active");

}
</script>

</body>
</html>