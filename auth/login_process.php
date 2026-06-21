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

            // Redirect based on email domain
            $email_lower = strtolower($user['email']);

            if (str_ends_with($email_lower, '@student.utem.edu.my')) {
                header("Location: ../User/home.php");
                exit();

            } elseif (str_ends_with($email_lower, '@utem.edu.my')) {
                if (
                         
                          $_SESSION['role'] == 'worker'
                          
                       ) {
                        header("Location: ../Worker/dashboard.php");
                        exit();
                       }
                       else if (
                         
                          $_SESSION['role'] == 'admin'
                          
                       ){
                        header("Location: ../Admin/dashboard.php");
                        exit();
                       }

            } else {
                // fallback
                header("Location: ../User/home.php");
                exit();
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

