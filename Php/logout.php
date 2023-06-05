<?php

include 'session_manager.php';
include 'db_conn.php';

// logout.php
session_start();
session_unset();
session_destroy();
header("Location: login.php");
exit;
?>
