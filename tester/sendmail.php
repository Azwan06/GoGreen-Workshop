<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';

$mail = new PHPMailer(true);

try {

    $mail->isSMTP();
    $mail->Host       = 'smtp.gmail.com';
    $mail->SMTPAuth   = true;
    $mail->Username   = 'fahrulazwan89@gmail.com';
    $mail->Password   = 'pwld kryz xvpu kegy';
    $mail->SMTPSecure = 'tls';
    $mail->Port       = 587;

    $mail->setFrom('fahrulazwan89@gmail.com', 'GoGreen');
    $mail->addAddress('EMAIL_PENERIMA');
    // $mail->addAddress('d032410282@student.utem.edu.my');

    $mail->isHTML(true);
    $mail->Subject = 'Test Email';
    $mail->Body    = 'PHPMailer berjaya!';

    $mail->send();

    echo "Email berjaya dihantar";

} catch (Exception $e) {
    echo "Mailer Error: {$mail->ErrorInfo}";
}
?>