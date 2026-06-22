<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '../PHPMailer/src/Exception.php';
require '../PHPMailer/src/PHPMailer.php';
require '../PHPMailer/src/SMTP.php';

include "../config/database.php";

$report_id = $_POST['report_id'];
$status = $_POST['status'];
$getReport = mysqli_query(
$conn,
"SELECT * FROM reports
 WHERE id='$report_id'"
);

$report = mysqli_fetch_assoc($getReport);

$email = $report['email'];
$name = $report['name'];
$subject_report = $report['subject'];
$location = $report['location'];

mysqli_query(
$conn,
"
UPDATE reports
SET status='$status'
WHERE id='$report_id'
"
);

if($status == "Completed")
{

$mail = new PHPMailer(true);

try {

    $mail->isSMTP();
    $mail->Host = 'smtp.gmail.com';
    $mail->SMTPAuth = true;

    $mail->Username = 'fahrulazwan89@gmail.com';
    $mail->Password = 'pwld kryz xvpu kegy';

    $mail->SMTPSecure = 'tls';
    $mail->Port = 587;

    $mail->setFrom(
        'fahrulazwan89@gmail.com',
        'GoGreen'
    );

    $mail->addAddress($email);
    $mail->isHTML(true);
    $mail->Subject = 'GoGreen Report Completed';

    $mail->Body = "
    <h2>Report Completed</h2>

    <p>Hello $name,</p>

    <p>Your report has been completed successfully.</p>

    <p><strong>Subject:</strong> $subject_report</p>

    <p><strong>Location:</strong> $location</p>

    <p><strong>Status:</strong> Completed</p>

    <br>

    <p>Thank you for supporting GoGreen.</p>
    ";

$mail->send();

}
catch (Exception $e)
{
    die($mail->ErrorInfo);
}

}

header("Location: ../Worker/status.php");
exit();

?>