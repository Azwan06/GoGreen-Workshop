<?php

session_start();
include "../config/database.php";

$worker_id = $_POST['worker_id'];
$task_title = mysqli_real_escape_string($conn, $_POST['task_title']);
$task_description = mysqli_real_escape_string($conn, $_POST['task_description']);
$location = mysqli_real_escape_string($conn, $_POST['location']);
$schedule_date = $_POST['schedule_date'];
$schedule_time = $_POST['schedule_time'];
$priority = $_POST['priority'];

$sql = "

INSERT INTO schedules (

worker_id,
task_title,
task_description,
location,
schedule_date,
schedule_time,
priority,
status

)

VALUES (

'$worker_id',
'$task_title',
'$task_description',
'$location',
'$schedule_date',
'$schedule_time',
'$priority',
'pending'

)

";

$result = mysqli_query($conn, $sql);

if (!$result) {

    die("SQL Error: " . mysqli_error($conn));

}

echo "
<script>
    alert('Schedule Assigned Successfully!');
    window.location.href='../Admin/addschedule.php';
</script>
";

exit();

?>