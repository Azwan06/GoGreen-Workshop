<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '../PHPMailer/src/Exception.php';
require '../PHPMailer/src/PHPMailer.php';
require '../PHPMailer/src/SMTP.php';

session_start();

include "../config/database.php";

// if (
//     !isset($_SESSION['user_id']) ||
//     $_SESSION['role'] != 'admin'
// ) {

//     header("Location: ../Public/login.php");
//     exit();
// }

// CHECK ID

if(!isset($_GET['id'])){

    header("Location: ../Admin/reqreward.php");
    exit();
}

$redeem_id = $_GET['id'];

// GET REWARD REQUEST

$query = "

SELECT *

FROM reward_redeems

WHERE id='$redeem_id'

";

$result =
mysqli_query($conn, $query);

$redeem =
mysqli_fetch_assoc($result);

if(!$redeem){

    die("Reward request not found");

}

$admin_id = $_SESSION['user_id'];

$serial =
"GG-".
date("Ymd").
"-".
str_pad($redeem_id,4,"0",STR_PAD_LEFT);

// PREVENT DOUBLE APPROVE

if($redeem['status'] != 'pending'){

    die("Request already processed");

}

// UPDATE STATUS

$update = "

UPDATE reward_redeems

SET

status='approved',
serial_number='$serial',
approved_at=NOW(),
approved_by='$admin_id'

WHERE id='$redeem_id'

";

mysqli_query($conn, $update);

$emailQuery = mysqli_query($conn, "

SELECT

u.fullname,
u.email,

r.reward_name,

rr.quantity,
rr.total_points,
rr.serial_number

FROM reward_redeems rr

JOIN users u
ON rr.user_id = u.id

JOIN rewards r
ON rr.reward_id = r.id

WHERE rr.id='$redeem_id'

");

$data = mysqli_fetch_assoc($emailQuery);

// SUCCESS



$mail = new PHPMailer(true);

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

$mail->addAddress($data['email']);

$mail->isHTML(true);

$mail->Subject = 'Reward Approved';

$mail->Body = "
<h2>Reward Approved</h2>

<p>Hello {$data['fullname']}</p>

<p>Your reward redemption has been approved.</p>

<b>Serial Number:</b> {$data['serial_number']}<br>
<b>Reward:</b> {$data['reward_name']}<br>
<b>Quantity:</b> {$data['quantity']}<br>
<b>Total Points:</b> {$data['total_points']}<br>
<b>Status:</b> APPROVED
";

try{

    $mail->send();

}catch(Exception $e){

    die("Email Error: " . $mail->ErrorInfo);

}


echo "

<script>

alert('Reward Approved Successfully!');

window.location.href='../Admin/reqreward.php';

</script>

";

?>
