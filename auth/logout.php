<?php

session_start();

// Remove all session
session_unset();

// Destroy session
session_destroy();

// Redirect homepage
header("Location: ../public/index.php");
exit();

?>