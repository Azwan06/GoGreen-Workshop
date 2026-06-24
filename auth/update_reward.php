<?php

session_start();

include "../config/database.php";

$reward_id = $_POST['reward_id'];
$reward_name = $_POST['reward_name'];
$description = $_POST['description'];
$points_required = $_POST['points_required'];
$stock = $_POST['stock'];

$sql = "

UPDATE rewards

SET

reward_name='$reward_name',
description='$description',
points_required='$points_required',
stock='$stock'

WHERE id='$reward_id'

";

mysqli_query($conn,$sql);

header("Location: ../Admin/addreward.php");
exit();

?>