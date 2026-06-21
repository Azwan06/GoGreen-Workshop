<?php

session_start();
include "../config/database.php";

if(!isset($_SESSION['user_id'])){
    header("Location: ../Public/login.php");
    exit();
}

$user_id = $_SESSION['user_id'];

if(isset($_FILES['profile_image']) && $_FILES['profile_image']['error'] == 0){

    $allowed = ['jpg','jpeg','png','webp'];

    $fileName = $_FILES['profile_image']['name'];
    $tmpName = $_FILES['profile_image']['tmp_name'];

    $ext = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));

    if(in_array($ext, $allowed)){

        $newName = time() . "_" . rand(1000,9999) . "." . $ext;

        move_uploaded_file(
            $tmpName,
            "../uploads/profile/" . $newName
        );

        mysqli_query(
            $conn,
            "UPDATE users
             SET profile_image='$newName'
             WHERE id='$user_id'"
        );
    }
}

header("Location: ../User/profile.php");
exit();

?>