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

$result = mysqli_query(
    $conn,
    "SELECT * FROM media_posts ORDER BY id DESC"
);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
    content="width=device-width, initial-scale=1.0">

    <title>Media | GoGreen</title>

    <!-- GOOGLE FONT -->
    <link rel="preconnect"
    href="https://fonts.googleapis.com">

    <link rel="preconnect"
    href="https://fonts.gstatic.com"
    crossorigin>

    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap"
    rel="stylesheet">

    <link rel="stylesheet"
    href="assets/css/media.css">

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

    <!-- MAIN -->
    <section class="media-section">

        <!-- TITLE -->
        <div class="page-title">

            <h1>
                Media Blasts
            </h1>

            <p>
                Send posters, videos and ads to users and workers.
            </p>

        </div>

        <!-- GRID -->
        <div class="media-grid">

            <!-- LEFT -->
            <div class="media-form-card">

                <h2>
                    New Media
                </h2>

                <!-- TYPES -->
                <div class="media-types">

                    <div class="media-type active"
                    onclick="selectType(this,'Poster','🖼')">

                        <span>
                            🖼
                        </span>

                        <p>
                            Poster
                        </p>

                    </div>

                    <div class="media-type"
                    onclick="selectType(this,'Video','🎥')">

                        <span>
                            🎥
                        </span>

                        <p>
                            Video
                        </p>

                    </div>

                    <div class="media-type"
                    onclick="selectType(this,'Ad','📢')">

                        <span>
                            📢
                        </span>

                        <p>
                            Ad
                        </p>

                    </div>

                </div>

                <!-- FORM -->
                <form
action="../auth/process_media.php"
method="POST"
enctype="multipart/form-data">

<input
type="hidden"
id="media_type"
name="media_type"
value="Poster">

                    <!-- AUDIENCE -->
                    <div class="form-group">

                        <label>
                            Audience
                        </label>

                        <select
id="audience"
name="audience">

                            <option>
                                Everyone
                            </option>

                            <option>
                                Users
                            </option>

                            <option>
                                Workers
                            </option>

                        </select>

                    </div>

                    <!-- TITLE -->
                    <div class="form-group">

                        <label>
                            Title
                        </label>

                        <input
type="text"
name="title"
placeholder="Recycle-A-Thon this Friday"
required>

                    </div>

                    <!-- MESSAGE -->
                    <div class="form-group">

                        <label>
                            Message
                        </label>

                        <textarea
name="content"
placeholder="Write your media content..."
required>
</textarea>

                    </div>

                    <div class="form-group">

    <label>
        YouTube Link
    </label>

    <input
    type="url"
    id="youtube_link"
    name="youtube_link"
    placeholder="https://youtube.com/watch?v=..."
    >

    <small id="youtubeHint">

        Required for Video only

    </small>

</div>

                    <!-- FILE -->
                    <div class="form-group">

                        <label>
                            Upload Media
                        </label>

                        <label class="upload-box">

                            <input
type="file"
name="image"
accept="image/*"
hidden>

                            <span>
                                ⬆
                            </span>

                            <p>
                                Click to upload
                            </p>

                        </label>

                    </div>

                    <!-- BUTTON -->
                    <button type="submit"
                    class="publish-btn">

                        Publish & Blast

                    </button>

                </form>

            </div>

            <!-- RIGHT -->
            <div class="published-section">

                <h3>
                    Published Media
                </h3>

                <!-- LIST -->
                <div id="mediaList">

<?php while($row = mysqli_fetch_assoc($result)){ ?>

<div class="media-card">

    <div class="media-preview">

        <?php if(!empty($row['image'])){ ?>

        <img
        src="../uploads/<?php echo $row['image']; ?>"
        style="
        width:100%;
        height:220px;
        object-fit:cover;">

        <?php } ?>

    </div>

    <div class="media-info">

        <div class="media-tags">

            <span class="tag">
                <?php echo $row['media_type']; ?>
            </span>

            <span class="tag green">
                <?php echo $row['audience']; ?>
            </span>

            <small>
                <?php echo $row['created_at']; ?>
            </small>

        </div>

        <h2>
            <?php echo $row['title']; ?>
        </h2>

        <p>
            <?php echo $row['content']; ?>
        </p>

        <?php if(!empty($row['youtube_link'])){ ?>

        <a
        href="<?php echo $row['youtube_link']; ?>"
        target="_blank"
        class="youtube-link">

            ▶ Watch Video

        </a>

        <?php } ?>

    </div>

    <a
    class="delete-btn"
    href="../auth/delete_media.php?id=<?php echo $row['id']; ?>"
    onclick="return confirm('Delete media?')">

        🗑

    </a>

</div>

<?php } ?>

</div>

    </section>

    <!-- FOOTER -->
    <footer>

        <p>
            © GoGreen. All rights reserved.
        </p>

        <p>
            Contact us: Al-Khawarizmi UTeM, Melaka, Malaysia
        </p>

    </footer>

    <!-- SCRIPT -->
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
            !container.contains(event.target)
        ){
            menu.classList.remove("show");
        }

    }
);

let currentType = "Poster";
let currentIcon = "🖼";

function selectType(card,type,icon){

    document
    .querySelectorAll(".media-type")
    .forEach(item => {

        item.classList.remove("active");

    });

    card.classList.add("active");

    currentType = type;
    currentIcon = icon;

    document
    .getElementById("media_type")
    .value = type;

    console.log(type);

    const youtubeField =
document.getElementById(
    "youtube_link"
);

if(type === "Video"){

    youtubeField.required = true;

}
else{

    youtubeField.required = false;

}

}

</script>

</body>
</html>