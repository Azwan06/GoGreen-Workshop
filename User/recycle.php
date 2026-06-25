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

$user_id = $_SESSION['user_id'];

$userResult = mysqli_query(
    $conn,
    "SELECT * FROM users WHERE id='$user_id'"
);

$user = mysqli_fetch_assoc($userResult);

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
src="<?php echo !empty($user['profile_image'])
    ? '../uploads/profile/'.$user['profile_image']
    : '../uploads/profile/default.jpg'; ?>"
alt="Profile">

            </div>

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

                        <select name="waste_type" required>

                            <option value="" disabled selected>
                                Select material type
                            </option>

                            <option value="plastic">Plastic</option>
                            <option value="paper">Paper</option>
                            <option value="aluminum">Aluminum</option>
                            <option value="glass">Glass Bottles</option>

                        </select>

                    </div>

                    <div class="form-group">

                        <label>
                            Estimated Weight (kg)
                        </label>

                        <div class="weight-input-wrapper">

                            <input type="number" name="weight" step="0.1" min="0.1" placeholder="Weight(kg)" required>

                            <button type="button" class="clear-row-btn" onclick="clearRow(this)">
                                ↺
                            </button>

                        </div>

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
                    id="dropzoneArea"
                    onclick="document.getElementById('fileUploadInput').click();">

                    <div class="dropzone-content">

                        <p class="upload-main-text">
                            Upload a File
                        </p>

                        <p class="upload-sub-text">
                            CLICK to browse
                            
                        </p>

                    </div>

                    <input
                    type="file"
                    id="fileUploadInput"
                    name="image"
                    style="display: none;"
                    onchange="updateFileInfo(this)">

                </div>

                <div class="file-preview-wrapper" id="filePreviewWrapper" style="display: none;">
                <div id="fileInfoDisplay" class="file-info-banner"></div>
                <button type="button" class="clear-row-btn" onclick="clearFileInput()">↺</button>
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


<!-- ============================================================ -->
<!-- SUCCESS MODAL — shown after form is submitted via AJAX       -->
<!-- ============================================================ -->

<div class="modal-overlay" id="successModal" style="display:none;">

    <div class="modal-card">

        <!-- Header -->
        <div class="modal-header">

            <h2>✅ Submission Successful!</h2>

            <p>
                Here's a summary of what you've submitted:
            </p>

        </div>

        <!-- Materials table -->
        <table class="preview-table">

            <thead>
                <tr>
                    <th>#</th>
                    <th>Material</th>
                    <th>Weight (kg)</th>
                </tr>
            </thead>

            <tbody id="modalTableBody">
                <!-- Filled dynamically by JS -->
            </tbody>

            <!-- Total row -->
            <tfoot>
                <tr style="font-weight:700; background:#f4f9f4;">
                    <td colspan="2" style="padding:12px 10px; color:#2e7d32;">
                        Total Weight
                    </td>
                    <td id="modalTotalWeight"
                        style="padding:12px 10px; color:#2e7d32;">
                    </td>
                </tr>
            </tfoot>

        </table>

        <!-- Location & image proof -->
        <div class="preview-location" id="modalMeta">
            <!-- Filled dynamically by JS -->
        </div>

        <!-- Close button -->
        <div class="modal-footer">

            <button
            class="btn-modal-close"
            onclick="closeSuccessModal()">

                Done

            </button>

        </div>

    </div>

</div>


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

    function updateFileInfo(input) {
    var display  = document.getElementById("fileInfoDisplay");
    var wrapper  = document.getElementById("filePreviewWrapper");
    var dropzone = document.getElementById("dropzoneArea");

    if (input.files && input.files[0]) {
        display.innerHTML = "📎 <strong>" + input.files[0].name + "</strong>";
        wrapper.style.display  = "flex";
        dropzone.style.display = "none";
    } else {
        wrapper.style.display  = "none";
        dropzone.style.display = "block";
    }
}

function clearFileInput() {
    document.getElementById("fileUploadInput").value = "";
    document.getElementById("filePreviewWrapper").style.display = "none";
    document.getElementById("dropzoneArea").style.display = "block";
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

    // CLEAR FIRST ROW

    function clearRow(button) {
        const row = button.closest(".material-row");
        const select = row.querySelector('select[name="waste_type"]');
        const input = row.querySelector('input[name="weight"]');
        
        if (select) select.selectedIndex = 0;
        if (input) input.value = '';
    }


    // ============================================================
    // AJAX FORM SUBMIT — intercepts submit, sends each row,
    // then shows the success modal with a preview of all items.
    // ============================================================

    document.querySelector('.gogreen-submission-form').addEventListener('submit', async function(e) {
        e.preventDefault();

        const form       = this;
        const rows       = document.querySelectorAll('.material-row');
        const location   = form.querySelector('select[name="location"]').value;
        const imageFile  = form.querySelector('#fileUploadInput').files[0];
        const submitBtn  = form.querySelector('.btn-submit-form');

        // Collect submitted data for the modal preview
        const submittedItems = [];

        submitBtn.disabled  = true;
        submitBtn.innerText = "Submitting…";

        try {

            for (let i = 0; i < rows.length; i++) {

                const row       = rows[i];
                const wasteType = row.querySelector('select[name="waste_type"]').value;
                const weight    = row.querySelector('input[name="weight"]').value;

                submittedItems.push({ wasteType, weight: parseFloat(weight) });

                const formData = new FormData();
                formData.append('location',   location);
                formData.append('waste_type', wasteType);
                formData.append('weight',     weight);

                if (imageFile) {
                    formData.append('image', imageFile);
                }

                await fetch(form.action, {
                    method: 'POST',
                    body:   formData
                });
            }

            // All rows sent — show the summary modal
            showSuccessModal(submittedItems, location, imageFile ? imageFile.name : null);

        } catch (error) {

            console.error(error);
            alert('Something went wrong while submitting the form.');

        } finally {

            submitBtn.disabled  = false;
            submitBtn.innerText = "Submit Form";

        }
    });


    // BUILD AND SHOW THE SUCCESS MODAL

    function showSuccessModal(items, location, imageName) {

        const tbody = document.getElementById('modalTableBody');
        tbody.innerHTML = '';

        let totalWeight = 0;

        // Material label map for nicer display
        const labels = {
            plastic  : '♻️ Plastic',
            paper    : '📄 Paper',
            aluminum : '🔩 Aluminum',
            glass    : '🫙 Glass Bottles'
        };

        items.forEach(function(item, i) {

            const label = labels[item.wasteType] ||
                          item.wasteType.charAt(0).toUpperCase() + item.wasteType.slice(1);

            totalWeight += item.weight;

            tbody.innerHTML += `
                <tr>
                    <td style="color:#888; font-size:12px;">${i + 1}</td>
                    <td>${label}</td>
                    <td><strong>${item.weight.toFixed(1)}</strong> kg</td>
                </tr>
            `;
        });

        // Total weight footer
        document.getElementById('modalTotalWeight').textContent =
            totalWeight.toFixed(1) + ' kg';

        // Location and optional image proof
        let metaHTML = `<strong>📍 Pickup Location:</strong> ${location}`;

        if (imageName) {
            metaHTML += `<br><strong>📎 Proof Uploaded:</strong> ${imageName}`;
        }

        document.getElementById('modalMeta').innerHTML = metaHTML;

        // Show the overlay
        document.getElementById('successModal').style.display = 'flex';
    }


    // CLOSE MODAL AND RESET THE FORM

    function closeSuccessModal() {
    document.getElementById('successModal').style.display = 'none';
    document.querySelector('.gogreen-submission-form').reset();

    // Reset file upload area
    document.getElementById('filePreviewWrapper').style.display = 'none';
    document.getElementById('dropzoneArea').style.display = 'block';  // ← add this

    const container = document.getElementById('materialContainer');
    const rows      = container.querySelectorAll('.material-row');
    rows.forEach(function(row, i) {
        if (i > 0) row.remove();
    });
}

</script>
</body>
</html>