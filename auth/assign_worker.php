<?php

include "../config/database.php";

$report_id = $_POST['report_id'];
$worker_id = $_POST['worker_id'];

mysqli_query(
$conn,
"
UPDATE reports
SET
worker_id='$worker_id',
status='Assigned'
WHERE id='$report_id'
"
);

header("Location: ../Admin/reports.php");
exit();