<?php

session_start();

require_once __DIR__ . "/../config/database.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Get form data
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $email = strtolower(trim($email));

    $password = $_POST['password'];

    // Only allow UTeM email
    if (
        !str_ends_with($email, '@student.utem.edu.my') &&
        !str_ends_with($email, '@utem.edu.my')
    ) {

        echo "
        <script>
            alert('Only UTeM email is allowed!');
            window.location.href='../Public/login.php';
        </script>
        ";
        exit();
    }

    // Check user by email
    $sql = "
    SELECT *
    FROM users
    WHERE email='$email'
    LIMIT 1
    ";

    $result = mysqli_query($conn, $sql);

    if ($result && mysqli_num_rows($result) > 0) {

        $user = mysqli_fetch_assoc($result);

        // Verify password
        if (password_verify($password, $user['password'])) {

            // Check banned account
            if ($user['status'] == 'banned') {

                echo "
                <script>
                    alert('Your account has been banned.');
                    window.location.href='../Public/login.php';
                </script>
                ";
                exit();
            }

            // Create session
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['fullname'] = $user['fullname'];
            $_SESSION['email'] = $user['email'];
            $_SESSION['role'] = $user['role'];

            // Redirect by role
            if ($user['role'] == 'admin') {

                header("Location: ../Admin/dashboard.php");
                exit();

            } elseif ($user['role'] == 'worker') {

                header("Location: ../Worker/dashboard.php");
                exit();

            } elseif ($user['role'] == 'user') {

                header("Location: ../User/home.php");
                exit();

            } else {

                echo "
                <script>
                    alert('Invalid Role!');
                    window.location.href='../Public/login.php';
                </script>
                ";
                exit();
            }

        } else {

            echo "
            <script>
                alert('Wrong Password!');
                window.location.href='../Public/login.php';
            </script>
            ";
            exit();
        }

    } else {

        echo "
        <script>
            alert('User Not Found!');
            window.location.href='../Public/login.php';
        </script>
        ";
        exit();
    }

} else {

    header("Location: ../Public/login.php");
    exit();
}

?>