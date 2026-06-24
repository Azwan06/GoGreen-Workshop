<?php

session_start();

include "../config/database.php";

if (
    !isset($_SESSION['user_id']) ||
    $_SESSION['role'] != 'admin'
) {

    header("Location: ../Public/login.php");
    exit();
}

// CHECK ID

if(!isset($_GET['id'])){

    header("Location: ../Admin/reqsub.php");
    exit();
}

$submission_id = $_GET['id'];

// GET SUBMISSION

$query = "

SELECT *

FROM recycle_submissions

WHERE id='$submission_id'

";

$result =
mysqli_query($conn, $query);

$submission =
mysqli_fetch_assoc($result);

if(!$submission){

    die("Submission not found");

}

// AVOID DOUBLE PROCESS

if($submission['status'] != 'pending'){

    die("Submission already processed");

}

// UPDATE STATUS

$update = "

UPDATE recycle_submissions

SET status='rejected'

WHERE id='$submission_id'

";

mysqli_query($conn, $update);

// REDIRECT

echo "

<script>

alert('Submission Rejected');

window.location.href='../Admin/reqsub.php';

</script>

";

?>