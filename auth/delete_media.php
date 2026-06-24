<?php

include "../config/database.php";

$id = $_GET['id'];

mysqli_query(
    $conn,
    "DELETE FROM media_posts
    WHERE id='$id'"
);

header("Location: ../Admin/media.php");
exit();

?>