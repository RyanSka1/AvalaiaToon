<?php
$servername = "localhost";
$username = "username";
$password = "password";
$dbname = "AvalaiaToon";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$username = $_POST['username'];
$password = password_hash($_POST['password'], PASSWORD_DEFAULT);
$email = $_POST['email'];
$cpf = $_POST['cpf'];
$phone = $_POST['phone'];

$sql = "INSERT INTO users (username, password, email, cpf, phone) VALUES (?, ?, ?, ?, ?)";

$stmt = $conn->prepare($sql);
$stmt->bind_param("sssss", $username, $password, $email, $cpf, $phone);

if ($stmt->execute()) {
    echo "Usuário registrado com sucesso!";
} else {
    echo "Erro: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>
