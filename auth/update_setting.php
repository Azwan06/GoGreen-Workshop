<?php

session_start();
include "../config/database.php";

if (!isset($_SESSION['user_id'])) {
    header("Location: ../Public/login.php");
    exit();
}

$user_id = $_SESSION['user_id'];

$fullname = mysqli_real_escape_string(
    $conn,
    $_POST['fullname']
);

$email = mysqli_real_escape_string(
    $conn,
    $_POST['email']
);

$faculty = mysqli_real_escape_string(
    $conn,
    $_POST['faculty']
);

/* Check duplicate email */

$check = mysqli_query(
    $conn,
    "SELECT id
     FROM users
     WHERE email='$email'
     AND id != '$user_id'"
);

if (mysqli_num_rows($check) > 0) {

    echo "
    <script>
        alert('Email already exists!');
        window.location='../User/setting.php';
    </script>
    ";
    exit();
}

/* Update profile */

mysqli_query(

    $conn,

    "UPDATE users SET

    fullname='$fullname',
    email='$email',
    faculty='$faculty'

    WHERE id='$user_id'"

);

header("Location: ../User/setting.php");
exit();

?>