<?php

session_start();
include "../config/database.php";

$email = $_SESSION['reset_email'];

$otp = $_POST['otp'];

$sql = "
SELECT *
FROM users
WHERE email='$email'
AND otp_code='$otp'
";

$check = mysqli_query($conn, $sql);

$user = mysqli_fetch_assoc($check);

if($user){

    if(strtotime($user['otp_expiry']) < time()){

        echo "
        <script>
        alert('OTP Expired');
        window.location='../Public/forgotpass.php';
        </script>
        ";

        exit();
    }

    $_SESSION['otp_verified'] = true;

    header("Location: ../Public/reset_password.php");
    exit();
}

?>