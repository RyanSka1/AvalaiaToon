<?php
session_start();

if (isset($_SESSION['last_activity']) && (time() - $_SESSION['last_activity'] > 3600)) {
    // Last request was more than one hour ago
    session_unset();
    session_destroy();
    header("Location: login.php");
    exit();
}

if (!isset($_SESSION['authenticated']) || $_SESSION['authenticated'] !== true) {
    // The user is not authenticated
    header("Location: login.php");
    exit();
}

if (!isset($_SESSION['two_factor_authenticated']) || $_SESSION['two_factor_authenticated'] !== true) {
    // The user has not passed two-factor authentication
    header("Location: two_factor.html");
    exit();
}

// The user is authenticated and has passed two-factor authentication
$_SESSION['last_activity'] = time(); // update last activity time stamp
?>
