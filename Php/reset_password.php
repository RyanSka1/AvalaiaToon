<?php
$servername = "localhost";
$username = "username";
$password = "password";
$dbname = "AvalaiaToon";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$email = $_POST['email'];

$sql = "SELECT email FROM users WHERE email = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $email);
$stmt->execute();

$result = $stmt->get_result();
if ($result->num_rows > 0) {
    echo "Um link de redefinição de senha foi enviado para o seu email!";
} else {
    echo "E-mail não encontrado!";
}

$conn->close();
?>
