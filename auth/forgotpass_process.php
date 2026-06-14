<?php

require_once __DIR__ . "/../config/database.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $newPassword = $_POST['new_password'];
    $confirmPassword = $_POST['confirm_password'];

    // Check password match
    if ($newPassword != $confirmPassword) {

        echo "
        <script>
            alert('Password does not match!');
            window.location.href='../public/forgotpass.php';
        </script>
        ";

        exit();
    }

    // Check email exists
    $checkEmail = "SELECT * FROM users WHERE email='$email'";
    $result = mysqli_query($conn, $checkEmail);

    if (mysqli_num_rows($result) > 0) {

        // Hash new password
        $hashedPassword = password_hash($newPassword, PASSWORD_DEFAULT);

        // Update password
        $update = "UPDATE users 
                   SET password='$hashedPassword'
                   WHERE email='$email'";

        if (mysqli_query($conn, $update)) {

            echo "
            <script>
                alert('Password Updated Successfully!');
                window.location.href='../public/login.php';
            </script>
            ";

        } else {

            echo "
            <script>
                alert('Failed to Update Password!');
                window.location.href='../public/forgotpass.php';
            </script>
            ";
        }

    } else {

        echo "
        <script>
            alert('Email Not Found!');
            window.location.href='../public/forgotpass.php';
        </script>
        ";
    }

} else {

    header("Location: ../public/forgotpass.php");
    exit();
}

?>
