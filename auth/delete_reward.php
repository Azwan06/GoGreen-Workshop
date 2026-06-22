<?php

session_start();
include "../config/database.php";

if(isset($_POST['reward_id']))
{
    $id = $_POST['reward_id'];

    $sql = "DELETE FROM rewards WHERE id = '$id'";

    mysqli_query($conn,$sql);
}

header("Location: ../Admin/addreward.php");
exit();