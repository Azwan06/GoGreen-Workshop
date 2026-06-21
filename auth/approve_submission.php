<?php

session_start();

include "../config/database.php";

// if (
//     !isset($_SESSION['user_id']) ||
//     $_SESSION['role'] != 'admin'
// ) {

//     header("Location: ../Public/login.php");
//     exit();
// }

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

// AVOID DOUBLE APPROVE

if($submission['status'] != 'pending'){

    die("Submission already processed");

}

// CALCULATE POINTS

$weight =
$submission['weight'];

$points =
$weight * 10;

// UPDATE SUBMISSION

$updateSubmission = "

UPDATE recycle_submissions

SET

status='approved',
points_earned='$points'

WHERE id='$submission_id'

";

mysqli_query($conn, $updateSubmission);

// UPDATE USER POINTS

$user_id =
$submission['user_id'];

$updateUser = "

UPDATE users

SET points = points + '$points'

WHERE id='$user_id'

";

mysqli_query($conn, $updateUser);

// REDIRECT

echo "

<script>

alert('Submission Approved Successfully!');

window.location.href='../Admin/reqsub.php';

</script>

";

?>
\