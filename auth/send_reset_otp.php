<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

session_start();
include "../config/database.php";

require '../PHPMailer/src/Exception.php';
require '../PHPMailer/src/PHPMailer.php';
require '../PHPMailer/src/SMTP.php';

error_reporting(E_ALL);
ini_set('display_errors', 1);

if($_SERVER['REQUEST_METHOD'] != 'POST'){
    header("Location: ../Public/forgotpass.php");
    exit();
}

$email = mysqli_real_escape_string(
    $conn,
    $_POST['email']
);

$check = mysqli_query(
    $conn,
    "SELECT * FROM users WHERE email='$email'"
);

if(mysqli_num_rows($check) == 0){

    echo "
    <script>
        alert('Email not found');
        window.location='../Public/forgotpass.php';
    </script>
    ";

    exit();
}

$otp = rand(100000,999999);

$expiry = date(
    "Y-m-d H:i:s",
    strtotime("+10 minutes")
);

mysqli_query(
    $conn,
    "UPDATE users
     SET otp_code='$otp',
         otp_expiry='$expiry'
     WHERE email='$email'"
);

$mail = new PHPMailer(true);

try {

    $mail->isSMTP();
    $mail->Host       = 'smtp.gmail.com';
    $mail->SMTPAuth   = true;
    $mail->Username   = 'fahrulazwan89@gmail.com';
    $mail->Password   = 'pwld kryz xvpu kegy';
    $mail->SMTPSecure = 'tls';
    $mail->Port       = 587;

    $mail->setFrom(
        'fahrulazwan89@gmail.com',
        'GoGreen'
    );

    $mail->addAddress($email);

    $mail->isHTML(true);

    $mail->Subject = 'GoGreen Password Reset OTP';

    $mail->Body = "
        <h2>Password Reset Request</h2>

        <p>Your OTP Code:</p>

        <h1>$otp</h1>

        <p>This OTP is valid for 10 minutes.</p>

        <p>GoGreen Recycling System</p>
    ";

    $mail->send();

    $_SESSION['reset_email'] = $email;

    echo "
    <script>
        alert('OTP sent successfully');
        window.location='../Public/verify_reset_otp.php';
    </script>
    ";

} catch (Exception $e) {

    echo "Mailer Error: " . $mail->ErrorInfo;

}

?>