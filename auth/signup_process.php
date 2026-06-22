<?php

require_once __DIR__ . "/../config/database.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $fullname = mysqli_real_escape_string($conn, trim($_POST['fullname']));
    $username = mysqli_real_escape_string($conn, trim($_POST['username']));
    $email = strtolower(trim(mysqli_real_escape_string($conn, $_POST['email'])));
    $matric_id = mysqli_real_escape_string($conn, trim($_POST['matric_id']));
    $password = $_POST['password'];

    // Only allow UTeM email
    if (
        !str_ends_with($email, '@student.utem.edu.my') &&
        !str_ends_with($email, '@utem.edu.my')
    ) {

        echo "
        <script>
            alert('Only UTeM email is allowed!');
            window.location.href='../Public/signup.php';
        </script>
        ";
        exit();
    }

    // Check email already exists
    $checkEmail = "SELECT id FROM users WHERE email='$email'";
    $emailResult = mysqli_query($conn, $checkEmail);

    if (mysqli_num_rows($emailResult) > 0) {

        echo "
        <script>
            alert('Email already registered!');
            window.location.href='../Public/signup.php';
        </script>
        ";
        exit();
    }

    // Check matric ID already exists
    $checkMatric = "SELECT id FROM users WHERE matric_id='$matric_id'";
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

    // Default role
    $role = 'user';

    // Insert user
    $sql = "
    INSERT INTO users (

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

    ) VALUES (

        '$fullname',
        '$username',
        '$email',
        '$matric_id',
        '$hashedPassword',
        '$role',
        'active',
        0,
        0,
        'default.png'

    )";

    $result = mysqli_query($conn, $sql);

    if (!$result) {

        die('SQL Error: ' . mysqli_error($conn));

    } else {

        echo "
        <script>
            alert('Signup Successful!');
            window.location.href='../Public/login.php';
        </script>
        ";
        exit();
    }

} else {

    header('Location: ../Public/signup.php');
    exit();
}

?>