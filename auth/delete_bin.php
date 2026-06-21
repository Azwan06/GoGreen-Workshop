<?php

session_start();

include "../config/database.php";

if(isset($_GET['id'])){

    $id = (int)$_GET['id'];

    mysqli_query(

        $conn,

        "DELETE FROM bins
        WHERE id = '$id'"

    );

}

header("Location: ../Admin/addbin.php");
exit();

?>