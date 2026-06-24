<?php

session_start();

include "../config/database.php";

if (!isset($_SESSION['user_id'])) {

    header("Location: ../Public/login.php");
    exit();
}

$title = mysqli_real_escape_string(
    $conn,
    $_POST['title']
);

$content = mysqli_real_escape_string(
    $conn,
    $_POST['content']
);

$media_type = mysqli_real_escape_string(
    $conn,
    $_POST['media_type']
);

$audience = mysqli_real_escape_string(
    $conn,
    $_POST['audience']
);

$youtube_link = mysqli_real_escape_string(
    $conn,
    $_POST['youtube_link']
);

$created_by = $_SESSION['user_id'];

// VIDEO MUST HAVE LINK

if (
    $media_type == "Video" &&
    empty($youtube_link)
) {

    echo "
    <script>
        alert('Video must have a YouTube link!');
        window.history.back();
    </script>
    ";

    exit();
}

// IMAGE UPLOAD

$image = "";

if (!empty($_FILES['image']['name'])) {

    $image =
    time() . "_" .
    basename($_FILES['image']['name']);

    if (
        !move_uploaded_file(
            $_FILES['image']['tmp_name'],
            "../uploads/" . $image
        )
    ) {

        die("Failed to upload image");
    }
}

// INSERT DATABASE

$sql = "

INSERT INTO media_posts
(
    title,
    content,
    image,
    media_type,
    audience,
    youtube_link,
    created_by,
    created_at
)
VALUES
(
    '$title',
    '$content',
    '$image',
    '$media_type',
    '$audience',
    '$youtube_link',
    '$created_by',
    NOW()
)

";

if (mysqli_query($conn, $sql)) {

    echo "
    <script>
        alert('Media published successfully!');
        window.location.href='../Admin/media.php';
    </script>
    ";

} else {

    echo "
    <script>
        alert('Database Error!');
        window.history.back();
    </script>
    ";
}

?>
