<?php

session_start();

require_once __DIR__ . "/../config/database.php";

if (!isset($_SESSION['user_id'])) {

    header("Location: ../Public/login.php");
    exit();
}

// GET BINS LOCATION

$binsQuery = "SELECT * FROM bins";

$binsResult = mysqli_query($conn, $binsQuery);

?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta name="viewport"
    content="width=device-width, initial-scale=1.0">

    <title>
        Recycle Submission
    </title>

    <link rel="preconnect"
    href="https://fonts.googleapis.com">

    <link rel="preconnect"
    href="https://fonts.gstatic.com"
    crossorigin>

    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap"
    rel="stylesheet">

    <link
    rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"/>

    <link rel="stylesheet"
    href="assets/css/recycle.css">

</head>

<body>

<!-- HEADER -->

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
                src="image/avatar.png"
                alt="User Avatar">

            </div>

            <div class="profile-menu"
            id="profileMenu">

                <div class="profile-info">

                    <h4>
                        <?php echo $_SESSION['fullname']; ?>
                    </h4>

                    <p>
                        <?php echo $_SESSION['email']; ?>
                    </p>

                </div>

                <a href="profile.php">
                    Profile
                </a>

                <a href="leaderboard.php">
                    Leaderboard
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

<!-- MAIN -->

<main class="form-page-container">

    <h1 class="page-main-title">
        Recycle Submission
    </h1>

    <section class="form-card">

        <div class="form-card-header">

            <h2>
                File Attachment Form
            </h2>

            <p>
                Please upload proof image.
            </p>

        </div>

        <!-- FORM -->

        <form
        class="gogreen-submission-form"
        action="../auth/recycle_process.php"
        method="POST"
        enctype="multipart/form-data">

            <!-- USER INFO -->

            <div class="form-row-grid">

                <div class="form-group">

                    <label>
                        Full Name
                    </label>

                    <input
                    type="text"
                    value="<?php echo $_SESSION['fullname']; ?>"
                    readonly>

                </div>

                <div class="form-group">

                    <label>
                        E-mail
                    </label>

                    <input
                    type="email"
                    value="<?php echo $_SESSION['email']; ?>"
                    readonly>

                </div>

            </div>

            <!-- MATERIAL -->

            <div id="materialContainer">

                <div class="form-row-grid material-row">

                    <div class="form-group">

                        <label>
                            Material Category
                        </label>

                        <select
                        name="waste_type"
                        required>

                            <option
                            value=""
                            disabled
                            selected>

                                Select material type

                            </option>

                            <option value="plastic">
                                Plastic
                            </option>

                            <option value="paper">
                                Paper
                            </option>

                            <option value="aluminum">
                                Aluminum
                            </option>

                            <option value="glass">
                                Glass Bottles
                            </option>

                        </select>

                    </div>

                    <div class="form-group">

                        <label>
                            Estimated Weight (kg)
                        </label>

                        <input
                        type="number"
                        name="weight"
                        step="0.1"
                        min="0.1"
                        placeholder="Weight(kg)"
                        required>

                    </div>

                </div>

            </div>

            <!-- ADD MATERIAL -->

            <button
            type="button"
            class="add-material-btn"
            onclick="addMaterialRow()">

                + Add Material

            </button>

            <!-- IMAGE -->

            <div class="form-group">

                <label>
                    Upload Documents (Proof)
                </label>

                <div
                class="dropzone-wrapper"
                onclick="document.getElementById('fileUploadInput').click();">

                    <div class="dropzone-content">

                        <p class="upload-main-text">
                            Upload a File
                        </p>

                        <p class="upload-sub-text">
                            Drag and drop files here
                            or click to browse
                        </p>

                    </div>

                    <input
                    type="file"
                    id="fileUploadInput"
                    name="image"
                    style="display: none;"
                    onchange="updateFileInfo(this)">

                </div>

                <div
                id="fileInfoDisplay"
                class="file-info-banner"
                style="display: none;">
                </div>

            </div>

            <!-- LOCATION -->

            <div class="form-group">

                <label>
                    Pickup Location
                </label>

                <select
                name="location"
                required>

                    <option
                    value=""
                    disabled
                    selected>

                        Select Pickup Location

                    </option>

                    <?php
                    while($bin = mysqli_fetch_assoc($binsResult)){
                    ?>

                        <option
value="<?php echo $bin['bin_name']; ?>">

    <?php echo $bin['bin_name']; ?>

</option>

                    <?php
                    }
                    ?>

                </select>

            </div>

            <!-- PICKUP -->

            <div class="form-row-grid">

                <div class="form-group">

                    <label>
                        Pickup Date
                    </label>

                    <input
                    type="date"
                    name="pickup_date"
                    required>

                </div>

                <div class="form-group">

                    <label>
                        Pickup Time
                    </label>

                    <input
                    type="time"
                    name="pickup_time"
                    required>

                </div>

            </div>

            <!-- SUBMIT -->

            <div class="form-submit-wrapper">

                <button
                type="submit"
                class="btn-submit-form">

                    Submit Form

                </button>

            </div>

        </form>

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

    // FILE DISPLAY

    function updateFileInfo(input){

        var display =
        document.getElementById(
            "fileInfoDisplay"
        );

        if (
            input.files &&
            input.files[0]
        ) {

            display.innerHTML =
            "Selected File: <strong>" +
            input.files[0].name +
            "</strong>";

            display.style.display =
            "block";

        } else {

            display.style.display =
            "none";

        }

    }

    // ADD MATERIAL ROW

    function addMaterialRow(){

        const container =
        document.getElementById(
            "materialContainer"
        );

        const row =
        document.createElement("div");

        row.classList.add(
            "form-row-grid",
            "material-row"
        );

        row.innerHTML = `

            <div class="form-group">

                <label>
                    Material Category
                </label>

                <select
                name="waste_type"
                required>

                    <option
                    value=""
                    disabled
                    selected>

                        Select material type

                    </option>

                    <option value="plastic">
                        Plastic
                    </option>

                    <option value="paper">
                        Paper
                    </option>

                    <option value="aluminum">
                        Aluminum
                    </option>

                    <option value="glass">
                        Glass Bottles
                    </option>

                </select>

            </div>

            <div class="form-group weight-group">

                <label>
                    Estimated Weight (kg)
                </label>

                <div class="weight-input-wrapper">

                    <input
                    type="number"
                    name="weight"
                    step="0.1"
                    min="0.1"
                    placeholder="Weight(kg)"
                    required>

                    <button
                    type="button"
                    class="delete-row-btn"
                    onclick="deleteMaterialRow(this)">

                        🗑

                    </button>

                </div>

            </div>

        `;

        container.appendChild(row);

    }

    // DELETE MATERIAL ROW

    function deleteMaterialRow(button){

        button
        .closest(".material-row")
        .remove();

    }

</script>

</body>
</html>

