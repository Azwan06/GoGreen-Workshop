<?php

require_once __DIR__ . "/../config/database.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $fullname = mysqli_real_escape_string($conn, $_POST['fullname']);
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $matric_id = mysqli_real_escape_string($conn, $_POST['matric_id']);
    $password = $_POST['password'];

    // Check email already exists
    $checkEmail = "SELECT * FROM users WHERE email='$email'";
    $emailResult = mysqli_query($conn, $checkEmail);

    if (mysqli_num_rows($emailResult) > 0) {

        header("Location: ../Public/login.php");
exit();

        exit();
    }

    // Check matric id already exists
    $checkMatric = "SELECT * FROM users WHERE matric_id='$matric_id'";
    $matricResult = mysqli_query($conn, $checkMatric);

    if (mysqli_num_rows($matricResult) > 0) {

        echo "
        <script>
            alert('Matric ID already exists!');
            window.location.href='../Public/signup.php';
        </script>
        ";

        exit();
    }

    // Hash password
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    // Insert user
    $sql = "INSERT INTO users (

        fullname,
        username,
        email,
        matric_id,
        password,
        role,
        status,
        email_verified,
        points,
        profile_image

    )

    VALUES (

        '$fullname',
        '$username',
        '$email',
        '$matric_id',
        '$hashedPassword',
        'user',
        'active',
        0,
        0,
        'default.png'

    )";

    // Execute query
    $result = mysqli_query($conn, $sql);

    // Check result
    if (!$result) {

        die("SQL Error: " . mysqli_error($conn));

    } else {

        echo "
        <script>
            alert('Signup Successful!');
            window.location.href='../Public/login.php';
        </script>
        ";
    }

} else {

    header("Location: ../Public/signup.php");
    exit();
}

?>
