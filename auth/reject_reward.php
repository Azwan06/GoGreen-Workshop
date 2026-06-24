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

    header("Location: ../Admin/reqreward.php");
    exit();
}

$redeem_id = $_GET['id'];

// GET REWARD REQUEST

$query = "

SELECT *

FROM reward_redeems

WHERE id='$redeem_id'

";

$result =
mysqli_query($conn, $query);

$redeem =
mysqli_fetch_assoc($result);

if(!$redeem){

    die('Reward request not found');

}

// PREVENT DOUBLE PROCESS

if($redeem['status'] != 'pending'){

    die('Request already processed');

}

// RETURN USER POINTS

$user_id =
$redeem['user_id'];

$total_points =
$redeem['total_points'];

$returnPoints = "

UPDATE users

SET points = points + '$total_points'

WHERE id='$user_id'

";

mysqli_query($conn, $returnPoints);

// UPDATE STATUS

$update = "

UPDATE reward_redeems

SET status='rejected'

WHERE id='$redeem_id'

";

mysqli_query($conn, $update);

// SUCCESS

echo "

<script>

alert('Reward Request Rejected');

window.location.href='../Admin/reqreward.php';

</script>

";

?>