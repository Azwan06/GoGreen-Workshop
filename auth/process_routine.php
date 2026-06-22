<?php

session_start();
include "../config/database.php";

$worker_id = $_POST['worker_id'];

$task_title =
mysqli_real_escape_string(
$conn,
$_POST['task_title']
);

$location =
mysqli_real_escape_string(
$conn,
$_POST['location']
);

$schedule_time =
$_POST['schedule_time'];

$priority =
$_POST['priority'];

$sql = "

INSERT INTO worker_routine
(
worker_id,
task_title,
location,
schedule_time,
priority
)

VALUES
(
'$worker_id',
'$task_title',
'$location',
'$schedule_time',
'$priority'
)

";

mysqli_query($conn,$sql);

header(
"Location: ../Admin/addschedule.php"
);

exit();