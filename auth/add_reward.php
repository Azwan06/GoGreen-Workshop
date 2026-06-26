<?php

session_start();
include "../config/database.php";

$host = "localhost:3306";
$user = "root";
$pass = "";
$dbname = "gogreen";

$conn = mysqli_connect($host, $user, $pass, $dbname);


$reward_name = $_POST['reward_name'];
$description = $_POST['description'];
$points_required = $_POST['points_required'];
$stock = $_POST['stock'];
$category = $_POST['category'];

$image = "";

if(isset($_FILES['image']) && $_FILES['image']['error'] == 0)
{
    $image = time() . "_" . $_FILES['image']['name'];

    move_uploaded_file(
        $_FILES['image']['tmp_name'],
        "../uploads/rewards/" . $image
    );
}

$sql = "
INSERT INTO rewards
(
reward_name,
description,
points_required,
stock,
image,
status
)
VALUES
(
'$reward_name',
'$description',
'$points_required',
'$stock',
'$image',
'available'
)
";

mysqli_query($conn,$sql);

header("Location: ../Admin/addreward.php");
exit();

?>