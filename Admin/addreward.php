<?php

session_start();
include "../config/database.php";

$sql = "SELECT * FROM rewards ORDER BY id DESC";
$result = mysqli_query($conn,$sql);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reward Management | GoGreen</title>

    <!-- GOOGLE FONT -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="assets/css/addreward.css">
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
                    <a href="setting.php">Settings</a>
                    <a href="../Public/login.php">Sign Out</a>

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





    <!-- PAGE HEADER -->

    <section class="page-header">

        <div>

            <h1>
                Reward management
            </h1>

            <p>
                Create, edit, and remove rewards in the catalog.
            </p>

        </div>

        <button class="add-btn" onclick="openModal()">
            + Add reward
        </button>

    </section>

    <div class="reward-grid">

<?php while($reward = mysqli_fetch_assoc($result)) { ?>

<div class="reward-item">

    <div class="stock-badge">
        Stock: <?= $reward['stock']; ?>
    </div>

    <div class="reward-image">

        <img
        src="../uploads/rewards/<?= $reward['image']; ?>"
        alt=""
        style="
        width:100px;
        height:100px;
        object-fit:contain;
        ">

    </div>

    <div class="reward-content">

        <div class="reward-top">

            <div>

                <h3>
                    <?= $reward['reward_name']; ?>
                </h3>

                <p>
                    <?= $reward['description']; ?>
                </p>

            </div>

            <div class="points">

                <?= $reward['points_required']; ?>

                <br>

                pts

            </div>

        </div>

        <div class="reward-actions">

<button
class="edit-btn"
onclick="openEditReward(
'<?= $reward['id']; ?>',
'<?= htmlspecialchars($reward['reward_name'], ENT_QUOTES); ?>',
'<?= htmlspecialchars($reward['description'], ENT_QUOTES); ?>',
'<?= $reward['points_required']; ?>',
'<?= $reward['stock']; ?>'
)">
Edit
</button>

            <button
type="button"
class="delete-btn"
onclick="openDeleteModal(<?= $reward['id']; ?>)">
🗑
</button>

        </div>

    </div>

</div>

<?php } ?>

</div>

    <div class="modal" id="rewardModal">

        <div class="modal-box">

            <button class="close-modal" onclick="closeModal()">
                ✕
            </button>

            <div class="modal-header">

                <h2>Add reward</h2>

                <p>
                    Configure points, stock and visuals.
                </p>

            </div>

<form
action="../auth/add_reward.php"
method="POST"
enctype="multipart/form-data">
                <div class="upload-section">

                    <div class="preview-box">
                        🎁
                    </div>

                    <div class="upload-content">

                        <label>
                            Upload image
                        </label>

                       <input
type="file"
name="image">

                    </div>

                </div>

                <div class="form-row">

                    <div class="input-group">

                        <label>Name</label>

                        <input
type="text"
name="reward_name"
placeholder="Reward name"
required>

                    </div>

                    <div class="input-group">

                        <label>Category</label>

                        <select name="category">

                            <option>Merchandise</option>
                            <option>Voucher</option>
                            <option>Lifestyle</option>

                        </select>

                    </div>

                </div>

                <!-- <input
type="text"
name="reward_name"
id="edit_reward_name"> -->

                <div class="form-row">

                    <div class="input-group">

                        <label>Required points</label>

                        <input
type="number"
name="points_required"
value="100"
required>

                    </div>

                    <div class="input-group">

                        <label>Stock quantity</label>

                        <input
type="number"
name="stock"
value="10"
required>

                    </div>

                </div>

                <div class="input-group">

                    <label>Description</label>

                    <textarea
name="description"
id="edit_description"
placeholder="Optional details for users..."></textarea>
                </div>

                <div class="modal-actions">

                    <button 
                        type="button"
                        class="cancel-btn"
                        onclick="closeModal()"
                    >
                        Cancel
                    </button>

                    <button type="submit" class="save-btn">
                        Save reward
                    </button>

                </div>

            </form>

        </div>

    </div>

    <!-- EDIT MODAL -->

    <div class="modal" id="editRewardModal">

        <div class="modal-box">

            <button class="close-modal" onclick="closeEditModal()">
                ✕
            </button>

            <div class="modal-header">

                <h2>Edit reward</h2>

                <p>
                    Configure points, stock and visuals.
                </p>

            </div>

<form
action="../auth/update_reward.php"
method="POST"
enctype="multipart/form-data">

<input
type="hidden"
name="reward_id"
id="edit_reward_id">

                <div class="upload-section">

                    <div class="preview-box">
                        🛍️
                    </div>

                    <div class="upload-content">

                        <label>
                            Upload image
                        </label>

                        <input
type="file"
name="image">


                    </div>

                </div>

                <div class="form-row">

                    <div class="input-group">

                        <label>Name</label>

                       <input
type="text"
name="reward_name"
id="edit_reward_name">

                    </div>

                    <div class="input-group">

                        <label>Category</label>

                        <select name="category">

                            <option selected>
                                Merchandise
                            </option>

                            <option>
                                Voucher
                            </option>

                            <option>
                                Lifestyle
                            </option>

                        </select>

                    </div>

                </div>

                <div class="form-row">

                    <div class="input-group">

                        <label>Required points</label>

                        <input
type="number"
name="points_required"
id="edit_points">

                    </div>

                    <div class="input-group">

                        <label>Stock quantity</label>

                        <input
type="number"
name="stock"
id="edit_stock">

                    </div>

                </div>

                <div class="input-group">

                    <label>Description</label>

                    <textarea
name="description"
id="edit_description"
placeholder="Optional details for users..."></textarea>

                </div>

                <div class="modal-actions">

                    <button 
                        type="button"
                        class="cancel-btn"
                        onclick="closeEditModal()"
                    >
                        Cancel
                    </button>

                    <button type="submit" class="save-btn">
                        Save reward
                    </button>

                </div>

            </form>

        </div>

    </div>

    <!-- DELETE MODAL -->

    <div class="delete-modal" id="deleteModal">

        <div class="delete-box">

            <button 
                class="close-delete"
                onclick="closeDeleteModal()"
            >
                ✕
            </button>

            <div class="delete-content">

                <h2>
                    Delete reward?
                </h2>

                <p>
                    This will permanently remove 
                    "GoGreen Tote Bag" from the catalog.
                </p>

            </div>

            <form action="../auth/delete_reward.php" method="POST">

    <input
    type="hidden"
    name="reward_id"
    id="delete_reward_id">

    <div class="delete-actions">

        <button
        type="button"
        class="cancel-delete"
        onclick="closeDeleteModal()">
            Cancel
        </button>

        <button
        type="submit"
        class="confirm-delete">
            Delete
        </button>

    </div>

</form>

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
        
        // ADD MODAL

        function openModal(){

            document
            .getElementById("rewardModal")
            .classList.add("active");

        }

        function closeModal(){

            document
            .getElementById("rewardModal")
            .classList.remove("active");

        }

        // EDIT MODAL

       function openEditReward(
id,
name,
description,
points,
stock
){

    document.getElementById(
    "edit_reward_id"
    ).value = id;

    document.getElementById(
    "edit_reward_name"
    ).value = name;

    document.getElementById(
    "edit_description"
    ).value = description;

    document.getElementById(
    "edit_points"
    ).value = points;

    document.getElementById(
    "edit_stock"
    ).value = stock;

    document
    .getElementById("editRewardModal")
    .classList.add("active");

}

        function closeEditModal(){

            document
            .getElementById("editRewardModal")
            .classList.remove("active");

        }

        // DELETE MODAL

        function openDeleteModal(id){

    document.getElementById(
        "delete_reward_id"
    ).value = id;

    document.getElementById(
        "deleteModal"
    ).classList.add("active");

}

        function closeDeleteModal(){

            document
            .getElementById("deleteModal")
            .classList.remove("active");

        }

    </script>

</body>
</html>