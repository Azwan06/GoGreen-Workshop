<!DOCTYPE html>
<html>
<head>
    <title>Verify OTP</title>
</head>
<body>

<h2>Verify OTP</h2>

<form action="../auth/verify_reset_otp_process.php" method="POST">

    <input
    type="text"
    name="otp"
    placeholder="Enter OTP"
    required>

    <button type="submit">
        Verify OTP
    </button>

</form>

</body>
</html>