<?php

session_start();
include "../config/database.php";

if ($_SESSION['role'] != 'admin') {
    header("Location: ../Public/login.php");
    exit();
}

$user_id = (int) $_POST['user_id'];

if ($user_id == $_SESSION['user_id']) {

    echo "
    <script>
        alert('You cannot ban yourself!');
        window.location.href='../Admin/userrole.php';
    </script>
    ";
    exit();
}

$status = mysqli_real_escape_string($conn, $_POST['status']);

$sql = "
UPDATE users
SET status='$status'
WHERE id=$user_id
";

mysqli_query($conn, $sql);

header("Location: ../Admin/userrole.php");
exit();

?>