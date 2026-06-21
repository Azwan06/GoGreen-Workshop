<?php

session_start();
include "../config/database.php";

$email = $_SESSION['reset_email'];

$password = $_POST['password'];
$confirm = $_POST['confirm_password'];

if($password != $confirm){

    echo "
    <script>
    alert('Password not match');
    history.back();
    </script>
    ";

    exit();
}

$hash = password_hash(
    $password,
    PASSWORD_DEFAULT
);

mysqli_query(

    $conn,

    "UPDATE users SET

    password='$hash',
    otp_code=NULL,
    otp_expiry=NULL

    WHERE email='$email'"

);

unset($_SESSION['reset_email']);

echo "
<script>
alert('Password updated successfully');
window.location='../Public/login.php';
</script>
";

?>