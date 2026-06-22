<?php

session_start();
include "../config/database.php";

$user_id = $_SESSION['user_id'] ?? NULL;

$name = $_POST['name'];
$email = $_POST['email'];
$phone = $_POST['phone'];

$report_type = $_POST['report_type'];
$subject = $_POST['subject'];
$message = $_POST['message'];
$location = $_POST['location'];

$sql = "INSERT INTO reports
(
user_id,
name,
email,
phone,
report_type,
subject,
message,
location
)
VALUES
(
'$user_id',
'$name',
'$email',
'$phone',
'$report_type',
'$subject',
'$message',
'$location'
)";

mysqli_query($conn,$sql);

header("Location: ../User/contact.php?success=1");
exit();