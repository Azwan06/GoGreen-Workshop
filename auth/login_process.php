<?php

session_start();

require_once __DIR__ . "/../config/database.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = $_POST['password'];

    // Check user by email
    $sql = "SELECT * FROM users WHERE email='$email'";

    $result = mysqli_query($conn, $sql);

    // Check if user exists
    if (mysqli_num_rows($result) > 0) {

        $user = mysqli_fetch_assoc($result);

        // Verify password
        if (password_verify($password, $user['password'])) {

            // Create session
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['fullname'] = $user['fullname'];
            $_SESSION['email'] = $user['email'];
            $_SESSION['role'] = $user['role'];

            // Redirect by role
            if ($user['role'] == 'admin') {

                header("Location: ../Admin/dashboard.php");

            } elseif ($user['role'] == 'worker') {

                header("Location: ../Worker/dashboard.php");

            } else {

                header("Location: ../User/home.php");

            }

            exit();

        } else {

            echo "
            <script>
                alert('Wrong Password!');
                window.location.href='../Public/login.php';
            </script>
            ";
        }

    } else {

        echo "
        <script>
            alert('User Not Found!');
            window.location.href='../Public/login.php';
        </script>
        ";
    }

} else {

    header("Location: ../Public/login.php");
    exit();
}

?>

