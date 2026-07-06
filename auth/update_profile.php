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

/* Update profile */

mysqli_query(
    $conn,
    "UPDATE users
     SET fullname='$fullname'
     WHERE id='$user_id'"
);

/* Get user role */
$result = mysqli_query(
    $conn,
    "SELECT role FROM users WHERE id='$user_id'"
);

$user = mysqli_fetch_assoc($result);

/* Redirect based on role */
if ($user['role'] == 'admin') {
    header("Location: ../Admin/profile.php");
} elseif ($user['role'] == 'worker') {
    header("Location: ../Worker/profile.php");
} else {
    header("Location: ../User/profile.php");
}

exit();
?>
?>