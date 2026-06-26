<?php

session_start();

require_once __DIR__ . "/../config/database.php";

if (!isset($_SESSION['user_id'])) {

    header("Location: ../Public/login.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $user_id = $_SESSION['user_id'];

    $waste_type = mysqli_real_escape_string(
        $conn,
        $_POST['waste_type']
    );

    $weight = $_POST['weight'];

    $location = mysqli_real_escape_string(
        $conn,
        $_POST['location']
    );

    $pickup_date = $_POST['pickup_date'];

    $pickup_time = $_POST['pickup_time'];

    // IMAGE UPLOAD

    $imageName = "";

    if (
        isset($_FILES['image']) &&
        $_FILES['image']['error'] == 0
    ) {

        $targetDir = "../uploads/";

        // CREATE FOLDER IF NOT EXIST

        if (!file_exists($targetDir)) {

            mkdir($targetDir, 0777, true);

        }

        $imageName =
        time() . "_" .
        basename($_FILES["image"]["name"]);

        $targetFile =
        $targetDir . $imageName;

        move_uploaded_file(
            $_FILES["image"]["tmp_name"],
            $targetFile
        );
    }

    // INSERT DATABASE

    $sql = "INSERT INTO recycle_submissions(

        user_id,
        waste_type,
        weight,
        image,
        location,
        pickup_date,
        pickup_time

    )

    VALUES (

        '$user_id',
        '$waste_type',
        '$weight',
        '$imageName',
        '$location',
        '$pickup_date',
        '$pickup_time'

    )";

    $result = mysqli_query($conn, $sql);

    // SUCCESS

    if ($result) {

        echo "
        <script>

            alert('Recycle Submission Successful!');

            window.location.href='../User/recycle.php';

        </script>
        ";

    } else {

        die(
            'SQL Error: ' .
            mysqli_error($conn)
        );

    }

} else {

    header("Location: ../User/recycle.php");
    exit();
}

?>
<?php

session_start();

require_once __DIR__ . "/../config/database.php";

if (!isset($_SESSION['user_id'])) {

    header("Location: ../Public/login.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $user_id = $_SESSION['user_id'];

    $waste_type = mysqli_real_escape_string(
        $conn,
        $_POST['waste_type']
    );

    $weight = $_POST['weight'];

    $location = mysqli_real_escape_string(
        $conn,
        $_POST['location']
    );

    $pickup_date = $_POST['pickup_date'];

    $pickup_time = $_POST['pickup_time'];

    // IMAGE UPLOAD

    $imageName = "";

    if (
        isset($_FILES['image']) &&
        $_FILES['image']['error'] == 0
    ) {

        $targetDir = "../uploads/";

        // CREATE FOLDER IF NOT EXIST

        if (!file_exists($targetDir)) {

            mkdir($targetDir, 0777, true);

        }

        $imageName =
        time() . "_" .
        basename($_FILES["image"]["name"]);

        $targetFile =
        $targetDir . $imageName;

        move_uploaded_file(
            $_FILES["image"]["tmp_name"],
            $targetFile
        );
    }

    // INSERT DATABASE

    $sql = "INSERT INTO recycle_submissions(

        user_id,
        waste_type,
        weight,
        image,
        location,
        pickup_date,
        pickup_time

    )

    VALUES (

        '$user_id',
        '$waste_type',
        '$weight',
        '$imageName',
        '$location',
        '$pickup_date',
        '$pickup_time'

    )";

    $result = mysqli_query($conn, $sql);

    // SUCCESS

    if ($result) {

        echo "
        <script>

            alert('Recycle Submission Successful!');

            window.location.href='../User/recycle.php';

        </script>
        ";

    } else {

        die(
            'SQL Error: ' .
            mysqli_error($conn)
        );

    }

} else {

    header("Location: ../User/recycle.php");
    exit();
}

?>