<?php

session_start();

include "../config/database.php";

if (!isset($_SESSION['user_id'])) {

    header("Location: ../Public/login.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $user_id = $_SESSION['user_id'];

    $reward_id = $_POST['reward_id'];

    // GET USER

    $userQuery =
    "SELECT * FROM users
    WHERE id='$user_id'";

    $userResult =
    mysqli_query($conn, $userQuery);

    $user =
    mysqli_fetch_assoc($userResult);

    $userPoints =
    $user['points'];

    // GET REWARD

    $rewardQuery =
    "SELECT * FROM rewards
    WHERE id='$reward_id'";

    $rewardResult =
    mysqli_query($conn, $rewardQuery);

    $reward =
    mysqli_fetch_assoc($rewardResult);

    $requiredPoints =
    $reward['points_required'];

    // CHECK POINTS

    if ($userPoints < $requiredPoints) {

        echo "
        <script>

            alert('Not enough points!');

            window.location.href='../User/redeem.php';

        </script>
        ";

        exit();
    }

    // INSERT REDEEM REQUEST

    $insertQuery = "

    INSERT INTO reward_redeems (

        user_id,
        reward_id,
        quantity,
        total_points,
        status

    )

    VALUES (

        '$user_id',
        '$reward_id',
        1,
        '$requiredPoints',
        'pending'

    )

    ";

    $result =
    mysqli_query($conn, $insertQuery);

    if ($result) {

        echo "
        <script>

            alert('Redeem request submitted! Waiting for admin approval.');

            window.location.href='../User/redeem.php';

        </script>
        ";

    } else {

        die(
            'SQL Error: ' .
            mysqli_error($conn)
        );

    }

} else {

    header("Location: ../User/redeem.php");
    exit();
}

?>

<?php

session_start();

include "../config/database.php";

if (!isset($_SESSION['user_id'])) {

    header("Location: ../Public/login.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $user_id = $_SESSION['user_id'];

    $reward_id = $_POST['reward_id'];

    // GET USER

    $userQuery =
    "SELECT * FROM users
    WHERE id='$user_id'";

    $userResult =
    mysqli_query($conn, $userQuery);

    $user =
    mysqli_fetch_assoc($userResult);

    $userPoints =
    $user['points'];

    // GET REWARD

    $rewardQuery =
    "SELECT * FROM rewards
    WHERE id='$reward_id'";

    $rewardResult =
    mysqli_query($conn, $rewardQuery);

    $reward =
    mysqli_fetch_assoc($rewardResult);

    $requiredPoints =
    $reward['points_required'];

    // CHECK POINTS

    if ($userPoints < $requiredPoints) {

        echo "
        <script>

            alert('Not enough points!');

            window.location.href='../User/redeem.php';

        </script>
        ";

        exit();
    }

    // INSERT REDEEM REQUEST

    $insertQuery = "

    INSERT INTO reward_redeems (

        user_id,
        reward_id,
        quantity,
        total_points,
        status

    )

    VALUES (

        '$user_id',
        '$reward_id',
        1,
        '$requiredPoints',
        'pending'

    )

    ";

    $result =
    mysqli_query($conn, $insertQuery);

    if ($result) {

        echo "
        <script>

            alert('Redeem request submitted! Waiting for admin approval.');

            window.location.href='../User/redeem.php';

        </script>
        ";

    } else {

        die(
            'SQL Error: ' .
            mysqli_error($conn)
        );

    }

} else {

    header("Location: ../User/redeem.php");
    exit();
}

?>
