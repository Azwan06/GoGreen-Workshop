<?php

session_start();
include "../config/database.php";

$bin_name = mysqli_real_escape_string(
    $conn,
    $_POST['bin_name']
);

$latitude = $_POST['latitude'];
$longitude = $_POST['longitude'];

$status = mysqli_real_escape_string(
    $conn,
    $_POST['status']
);

$address = mysqli_real_escape_string(
    $conn,
    $_POST['address']
);

$bin_type = mysqli_real_escape_string(
    $conn,
    $_POST['bin_type']
);

mysqli_query(

    $conn,

    "INSERT INTO bins
    (
        bin_name,
        latitude,
        longitude,
        address,
        bin_type,
        status
    )
    VALUES
    (
        '$bin_name',
        '$latitude',
        '$longitude',
        '$address',
        '$bin_type',
        '$status'
    )"

);

header("Location: ../Admin/addbin.php");
exit();

?>