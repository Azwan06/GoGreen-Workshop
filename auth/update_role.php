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
        alert('You cannot change your own role!');
        window.location.href='../Admin/userrole.php';
    </script>
    ";
    exit();
}

$role = mysqli_real_escape_string($conn, $_POST['role']);

$sql = "
UPDATE users
SET role='$role'
WHERE id=$user_id
";

mysqli_query($conn, $sql);

header("Location: ../Admin/userrole.php");
exit();

?>