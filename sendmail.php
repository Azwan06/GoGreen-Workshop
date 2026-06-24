<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '../PHPMailer/src/Exception.php';
require '../PHPMailer/src/PHPMailer.php';
require '../PHPMailer/src/SMTP.php';

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
    ";

    $mail->send();

    $_SESSION['reset_email'] = $email;

    echo 'OTP Sent Successfully';

} catch (Exception $e) {

    echo $mail->ErrorInfo;

}
?>