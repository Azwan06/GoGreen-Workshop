<?php

mysqli_report(MYSQLI_REPORT_OFF);

$host = "localhost:3306";
$user = "root";
$pass = "";
$dbname = "gogreen";

$conn = mysqli_connect($host, $user, $pass, $dbname);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
// echo "Connected successfully";

?>