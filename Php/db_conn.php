<?php
$servername = "AvalaiaToon";
$username = "root";
$password = "root";
$dbname = "AvalaiaToon";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
