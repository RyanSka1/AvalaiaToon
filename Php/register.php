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

$sql = "INSERT INTO users (username, password, email, cpf, phone, verified) VALUES (?, ?, ?, ?, ?, 0)";

$stmt = $conn->prepare($sql);
$stmt->bind_param("sssss", $username, $password, $email, $cpf, $phone);

if ($stmt->execute()) {
    $userId = $conn->insert_id;
    $hash = password_hash($userId, PASSWORD_DEFAULT);

    $subject = "Confirmação de cadastro em AvalaiaToon";
    $message = "Clique no link a seguir para confirmar seu cadastro: http://yourwebsite.com/confirm.php?user=$userId&hash=$hash";
    $headers = "From: no-reply@yourwebsite.com";

    mail($email, $subject, $message, $headers);

    echo "Usuário registrado com sucesso! Por favor, verifique seu e-mail para confirmar seu cadastro.";
} else {
    echo "Erro: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>
