<?php

session_start();
include "../config/database.php";

if(
    !isset($_SESSION['user_id']) ||
    $_SESSION['role'] != 'worker'
){
    header("Location: ../Public/login.php");
    exit();
}

$id = $_POST['schedule_id'];
$status = $_POST['status'];

mysqli_query($conn,"
UPDATE schedules
SET status='$status'
WHERE id='$id'
");

header("Location: ../Worker/schedule.php");
exit();

?>